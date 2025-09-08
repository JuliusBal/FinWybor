<?php

namespace App\Services;

use App\Repositories\OfferRepository;
use App\Support\Offers\OfferFilters;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class OfferService
{
    public function __construct(private OfferRepository $repo) {}

    public function list(OfferFilters $f): Collection
    {
        $key = sprintf(
            'offers:v2:type:%s:amount:%d:term:%d:sort:%s',
            $f->type, $f->amount, $f->term, $f->sort
        );

        return Cache::tags(['offers', "offers:type:{$f->type}"])
            ->remember($key, now()->addMinutes(5), function () use ($f) {
                $rows = $this->repo->forIndex($f);

                if ($f->isLoanWithParams()) {
                    $rows = $rows->map(function ($o) use ($f) {
                        if ($o->product_type === 'loan') {
                            $calc = $this->annuity((float)$f->amount, (int)$f->term, (float)($o->monthly_rate ?? 0), (float)($o->setup_fee ?? 0));
                            $o->monthly_payment = round($calc['monthly'], 2);
                            $o->total_cost      = round($calc['total'], 2);
                            $o->overpayment     = round($calc['overpayment'], 2);
                        }
                        return $o;
                    });
                }

                if ($f->sort === 'cheapest') {
                    $rows = $rows->sortBy(function ($x) {
                        if (isset($x->overpayment) && $x->overpayment > 0) {
                            return $x->overpayment;
                        }
                        return is_numeric($x->rrso ?? null) ? (float)$x->rrso : PHP_FLOAT_MAX;
                    })->values();
                }

                return $rows->values();
            });
    }

    private function annuity(float $amount, int $months, float $monthlyRate, float $setupFee = 0.0): array
    {
        if ($months <= 0) return ['monthly'=>0,'total'=>0,'overpayment'=>0];

        if ($monthlyRate <= 0) {
            $monthly = ($amount + $setupFee) / $months;
            $total   = $monthly * $months;
            return ['monthly'=>$monthly, 'total'=>$total, 'overpayment'=>$total - $amount];
        }

        $r = $monthlyRate;
        $factor  = ($r * pow(1 + $r, $months)) / (pow(1 + $r, $months) - 1);
        $monthly = $amount * $factor;
        $total   = $monthly * $months + $setupFee;

        return ['monthly'=>$monthly, 'total'=>$total, 'overpayment'=>$total - $amount];
    }
}
