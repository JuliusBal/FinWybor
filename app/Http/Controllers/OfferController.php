<?php

namespace App\Http\Controllers;

use App\Services\OfferService;
use App\Support\Offers\OfferFilters;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct(private OfferService $service) {}

    public function index(Request $r)
    {
        $f = OfferFilters::fromRequest($r);
        $offers = $this->service->list($f);

        $payload = [
            'offers' => $offers,
            'amount' => $f->amount,
            'term'   => $f->term,
            'type'   => $f->type,
            'sort'   => $f->sort,
        ];

        if ($r->ajax()) {
            return view('offers._list', $payload);
        }

        return view('offers.index', $payload);
    }

    public function apiIndex(Request $r)
    {
        $f = OfferFilters::fromRequest($r);
        $offers = $this->service->list($f);

        return response()->json([
            'offers' => $offers->map(fn($o) => (array) $o)->values(),
        ]);
    }

    public function loans(Request $r)
    {
        $r->merge(['type' => 'loan']);

        return $this->index($r);
    }
    public function cards(Request $r)
    {
        $r->merge(['type' => 'card']);

        return $this->index($r);
    }
    public function insurance(Request $r)
    {
        $r->merge(['type' => 'insurance']);
        return $this->index($r);
    }
}
