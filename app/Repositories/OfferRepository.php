<?php

namespace App\Repositories;

use App\Support\Offers\OfferFilters;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

class OfferRepository
{
    public function forIndex(OfferFilters $f): Collection
    {
        $q = $this->baseQuery($f);

        if ($f->isLoanWithParams()) {
            $amt = (int) $f->amount;
            $tm  = (int) $f->term;

            $q->where(function ($w) use ($amt) {
                $w->whereNull('o.amount_min')
                    ->orWhere('o.amount_min', '<=', $amt);
            })->where(function ($w) use ($amt) {
                $w->whereNull('o.amount_max')
                    ->orWhere('o.amount_max', '>=', $amt);
            });

            $q->where(function ($w) use ($tm) {
                $w->whereNull('o.term_min_months')
                    ->orWhere('o.term_min_months', '<=', $tm);
            })->where(function ($w) use ($tm) {
                $w->whereNull('o.term_max_months')
                    ->orWhere('o.term_max_months', '>=', $tm);
            });
        }

        $q = $this->applySort($q, $f);

        return $q->get();
    }

    protected function baseQuery(OfferFilters $f): Builder
    {
        $clicksSub = DB::raw('(SELECT offer_id, COUNT(*) AS clicks FROM clicks GROUP BY offer_id) c');

        return DB::table('offers as o')
            ->join('providers as p', 'p.id', '=', 'o.provider_id')
            ->where('o.status', 'active')
            ->when($f->type, fn($qq) => $qq->where('o.product_type', $f->type))
            ->leftJoin($clicksSub, 'o.id', '=', 'c.offer_id')
            ->select([
                'o.*',
                'p.name   as provider_name',
                'p.slug   as provider_slug',
                'p.network as provider_network',
                DB::raw('COALESCE(c.clicks,0) AS clicks'),
            ]);
    }

    protected function applySort(Builder $q, OfferFilters $f): Builder
    {
        return match ($f->sort) {
            'popular'  => $q->orderByDesc('clicks')->orderBy('o.brand'),
            'fastest'  => $q->orderByRaw("
            CASE COALESCE(o.payout_speed,'zzz')
                WHEN 'instant'   THEN 1
                WHEN 'same_day'  THEN 2
                WHEN '1_3_days'  THEN 3
                WHEN 'other'     THEN 4
                ELSE 5
            END
        ")->orderBy('o.brand'),
            'cheapest' => $q->orderByRaw('o.rrso IS NULL')->orderBy('o.rrso')->orderBy('o.brand'),
            'brand'    => $q->orderBy('o.brand')->orderBy('o.id'),
            default    => $q->orderBy('o.brand')->orderBy('o.id'),
        };
    }
}
