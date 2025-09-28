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

    public function loansLanding(Request $r)
    {
        $defaults = [
            'type'   => 'loan',
            'amount' => (int) ($r->query('amount', 3000)),
            'term'   => (int) ($r->query('term', 6)),
            'sort'   => $r->query('sort', 'fastest'),
        ];

        $r->merge($defaults + $r->query());

        $f = OfferFilters::fromRequest($r);
        $offers = $this->service->list($f);

        $baseAction = url('/kredyty-gotowkowe');

        $pageTitle       = 'Kredyty gotówkowe – porównaj oferty';
        $pageDescription = 'Sprawdź RRSO, ratę, całkowity koszt i czas wypłaty. Porównaj kredyty gotówkowe i złóż wniosek online.';
        $canonical       = $baseAction;

        $payload = [
            'offers'          => $offers,
            'amount'          => $f->amount,
            'term'            => $f->term,
            'type'            => $f->type,
            'sort'            => $f->sort,
            'baseAction'      => $baseAction,
            'pageTitle'       => $pageTitle,
            'pageDescription' => $pageDescription,
            'canonical'       => $canonical,
        ];

        if ($r->ajax()) {
            return view('offers._list', $payload);
        }

        return view('offers.loans-landing', $payload);
    }
}
