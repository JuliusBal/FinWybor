<div class="mt-6">
    @if($type==='loan')
        {{-- DESKTOP table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm bg-white rounded-xl shadow-soft border border-black/5 overflow-hidden">
                <thead class="bg-brand-900/95 text-white">
                <tr>
                    <th class="text-left p-3 font-semibold">Marka</th>
                    <th class="text-left p-3 font-semibold">RRSO</th>
                    <th class="text-left p-3 font-semibold">Rata</th>
                    <th class="text-left p-3 font-semibold">Całkowity</th>
                    <th class="text-left p-3 font-semibold">Nadpłata</th>
                    <th class="text-left p-3 font-semibold">Wypłata</th>
                    <th class="text-right p-3 font-semibold">Akcja</th>
                </tr>
                </thead>
                <tbody>
                @forelse($offers as $o)
                    @php
                        $speed = $o->payout_speed ?? '';
                        $label = $speed === 'instant' ? 'Natychmiast' : ($speed === 'same_day' ? 'Dziś' : ($speed === '1_3_days' ? '1–3 dni' : '—'));
                        $chip  = 'bg-brand-800/8 text-brand-800 border border-brand-800/20';
                    @endphp
                    <tr id="offer-{{ $o->id }}" class="border-t border-black/5 hover:bg-brand-800/5">
                        <td class="p-3">
                            <div class="font-semibold text-brand-800">{{ $o->brand }}</div>
                            <div class="text-xs text-black/60">{{ strtoupper($o->currency) }} · {{ $amount }} PLN · {{ $term }} mies.</div>
                        </td>
                        <td class="p-3">
                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs bg-brand-800/10 text-brand-800 border border-brand-800/20">
                                {{ $o->rrso ?? '—' }}%
                            </span>
                        </td>
                        <td class="p-3">{{ isset($o->monthly_payment) ? number_format($o->monthly_payment, 2, ',', ' ').' PLN' : '—' }}</td>
                        <td class="p-3">{{ isset($o->total_cost) ? number_format($o->total_cost, 2, ',', ' ').' PLN' : '—' }}</td>
                        <td class="p-3">
                            @if(isset($o->overpayment))
                                <span class="inline-flex px-2.5 py-1 rounded text-xs bg-brand-500/10 text-brand-500 border border-brand-500/20">
                                    {{ number_format($o->overpayment, 2, ',', ' ') }} PLN
                                </span>
                            @else
                                —
                            @endif
                        </td>
                        <td class="p-3">
                            <span class="inline-flex px-2.5 py-1 rounded text-xs {{ $chip }}">{{ $label }}</span>
                        </td>
                        <td class="p-3 text-right">
                            <form method="post" action="{{ route('click.store') }}" class="inline">
                                @csrf
                                <input type="hidden" name="offer_id" value="{{ $o->id }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="term" value="{{ $term }}">
                                <button class="inline-flex items-center gap-2 bg-brand-400 hover:bg-brand-500 text-white px-4 py-2 rounded-lg shadow-soft">
                                    Weź pożyczkę
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center">
                            <div class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border border-black/10 bg-white">
                                <span class="font-medium text-brand-800">Brak ofert</span>
                                <span class="text-black/60">Spróbuj zmienić parametry lub sortowanie.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE cards --}}
        <div class="md:hidden space-y-3">
            @forelse($offers as $o)
                @php
                    $speed = $o->payout_speed ?? '';
                    $label = $speed === 'instant' ? 'Natychmiast' : ($speed === 'same_day' ? 'Dziś' : ($speed === '1_3_days' ? '1–3 dni' : '—'));
                @endphp
                <div id="offer-{{ $o->id }}" class="bg-white rounded-xl shadow-soft border border-black/5 p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="text-base font-semibold text-brand-800">{{ $o->brand }}</div>
                            <div class="text-xs text-black/60 mt-1">{{ strtoupper($o->currency) }} · {{ $amount }} PLN · {{ $term }} mies.</div>
                        </div>
                        <span class="text-xs px-2.5 py-1 rounded-full bg-brand-800/10 text-brand-800 border border-brand-800/20">
                            RRSO: {{ $o->rrso ?? '—' }}%
                        </span>
                    </div>

                    @if(isset($o->monthly_payment))
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                            <div><div class="text-[11px] text-black/60">Rata</div><div class="font-semibold text-brand-900">{{ number_format($o->monthly_payment, 2, ',', ' ') }} PLN</div></div>
                            <div><div class="text-[11px] text-black/60">Całkowity</div><div class="font-semibold text-brand-900">{{ number_format($o->total_cost, 2, ',', ' ') }} PLN</div></div>
                            <div><div class="text-[11px] text-black/60">Nadpłata</div><div class="font-semibold text-brand-500">{{ number_format($o->overpayment, 2, ',', ' ') }} PLN</div></div>
                        </div>
                    @endif

                    <div class="mt-3 flex items-center justify-between">
                        <span class="inline-flex px-2.5 py-1 rounded text-xs bg-brand-800/8 text-brand-800 border border-brand-800/20">{{ $label }}</span>
                        <form method="post" action="{{ route('click.store') }}">
                            @csrf
                            <input type="hidden" name="offer_id" value="{{ $o->id }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="term" value="{{ $term }}">
                            <button class="bg-brand-400 hover:bg-brand-500 text-white px-4 py-2 rounded-lg shadow-soft">Weź pożyczkę</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border border-black/10 bg-white">
                        <span class="font-medium text-brand-800">Brak ofert</span>
                        <span class="text-black/60">Zmień parametry i spróbuj ponownie.</span>
                    </div>
                </div>
            @endforelse
        </div>

    @elseif($type==='card')
        {{-- Cards listing for credit cards --}}
        <div class="grid md:grid-cols-2 gap-3">
            @forelse($offers as $o)
                <div id="offer-{{ $o->id }}" class="bg-white rounded-xl shadow-soft border border-black/5 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-base font-semibold text-brand-800">{{ $o->brand }}</div>
                            <div class="text-xs text-black/60 mt-1">
                                Opłata roczna: {{ $o->annual_fee ?? '—' }} PLN
                                @if(!is_null($o->grace_days)) • Grace: {{ $o->grace_days }} dni @endif
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs bg-brand-800/10 text-brand-800 border border-brand-800/20">Karta</span>
                    </div>
                    <div class="mt-4 flex items-center justify-end">
                        <form method="post" action="{{ route('click.store') }}">
                            @csrf
                            <input type="hidden" name="offer_id" value="{{ $o->id }}">
                            <button class="inline-flex items-center gap-2 bg-brand-400 hover:bg-brand-500 text-white px-4 py-2 rounded-lg shadow-soft">
                                Złóż wniosek
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="p-6 text-center bg-white rounded-xl border border-black/10">Brak kart dla podanych parametrów.</div>
                </div>
            @endforelse
        </div>

    @else
        {{-- Insurance listing --}}
        <div class="grid md:grid-cols-2 gap-3">
            @forelse($offers as $o)
                <div id="offer-{{ $o->id }}" class="bg-white rounded-xl shadow-soft border border-black/5 p-4 md:p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-base font-semibold text-brand-800">{{ $o->brand }}</div>
                            <div class="text-xs text-black/60 mt-1">
                                Ubezpieczenie: {{ strtoupper($o->insurance_kind ?? '—') }}
                                @if(!is_null($o->premium_from)) • Składka od: {{ $o->premium_from }} PLN @endif
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs bg-brand-800/10 text-brand-800 border border-brand-800/20">Ubezpieczenie</span>
                    </div>
                    <div class="mt-4 flex items-center justify-end">
                        <form method="post" action="{{ route('click.store') }}">
                            @csrf
                            <input type="hidden" name="offer_id" value="{{ $o->id }}">
                            <button class="inline-flex items-center gap-2 bg-brand-400 hover:bg-brand-500 text-white px-4 py-2 rounded-lg shadow-soft">
                                Oblicz polisę
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13.172 12 8.222 7.05l1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="p-6 text-center bg-white rounded-xl border border-black/10">Brak ubezpieczeń dla podanych parametrów.</div>
                </div>
            @endforelse
        </div>
    @endif
</div>

@if(method_exists($offers,'links'))
    <div class="mt-6">
        {{ $offers->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>
@endif
