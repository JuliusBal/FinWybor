<?php

namespace App\Support\Offers;

use Illuminate\Http\Request;

final class OfferFilters
{
    public string $type;
    public int    $amount;
    public int    $term;
    public string $sort;

    private function __construct(string $type, int $amount, int $term, string $sort)
    {
        $this->type   = $type ?: 'loan';
        $this->amount = max(0, $amount);
        $this->term   = max(0, $term);
        $this->sort   = $sort ?: 'brand';
    }

    public static function fromRequest(Request $r): self
    {
        return new self(
            $r->query('type', 'loan'),
            (int) $r->query('amount', 3000),
            (int) $r->query('term', 6),
            $r->query('sort', 'brand'),
        );
    }

    public function isLoanWithParams(): bool
    {
        return $this->type === 'loan' && $this->amount > 0 && $this->term > 0;
    }
}
