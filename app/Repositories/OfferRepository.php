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
            $q->where('o.amount_min', '<=', $f->amount)
                ->where('o.amount_max', '>=', $f->amount)
                ->where('o.term_min_months', '<=', $f->term)
                ->where('o.term_max_months', '>=', $f->term);
        }

        $q = $this->applySort($q, $f);

        return $q->get();
    }

    protected function baseQuery(OfferFilters $f): Builder
    {
        $clicksSub = DB::raw('(SELECT offer_id, COUNT(*) AS clicks FROM clicks GROUP BY offer_id) c');

        return DB::table('offers as o')
            ->where('o.status', 'active')
            ->when($f->type, fn($qq) => $qq->where('o.product_type', $f->type))
            ->leftJoin($clicksSub, 'o.id', '=', 'c.offer_id')
            ->select([
                'o.*',
                DB::raw('COALESCE(c.clicks,0) AS clicks'),
            ]);
    }

    protected function applySort(Builder $q, OfferFilters $f): Builder
    {
        return match ($f->sort) {
            'popular' => $q->orderByDesc('clicks'),
            'fastest' => $q->orderByRaw("FIELD(o.payout_speed,'instant','same_day','1_3_days') ASC"),
            'brand'   => $q->orderBy('o.brand')->orderBy('o.id'),
            'cheapest' => $q->orderBy('o.id'),
            default   => $q->orderBy('o.brand')->orderBy('o.id'),
        };
    }
}
