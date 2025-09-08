{{-- resources/views/offers/_skeleton.blade.php --}}
<div class="h-full w-full bg-white/85 backdrop-blur-sm">
    <div class="mx-auto h-full p-4 md:p-6">
        {{-- Desktop skeleton table --}}
        <div class="hidden md:block h-full">
            <div class="bg-white rounded-xl shadow-soft border border-black/5 overflow-hidden h-full">
                <div class="p-3 border-b border-black/10">
                    <div class="h-5 w-40 bg-slate-200 rounded animate-pulse"></div>
                </div>
                <div class="divide-y divide-black/5">
                    @for($i=0;$i<6;$i++)
                        <div class="grid grid-cols-12 gap-3 p-3">
                            <div class="col-span-4 h-5 bg-slate-200 rounded animate-pulse"></div>
                            <div class="col-span-1 h-5 bg-slate-200 rounded animate-pulse"></div>
                            <div class="col-span-2 h-5 bg-slate-200 rounded animate-pulse"></div>
                            <div class="col-span-2 h-5 bg-slate-200 rounded animate-pulse"></div>
                            <div class="col-span-1 h-5 bg-slate-200 rounded animate-pulse"></div>
                            <div class="col-span-2 h-9 bg-slate-200 rounded animate-pulse justify-self-end"></div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Mobile skeleton cards --}}
        <div class="md:hidden space-y-3">
            @for($i=0;$i<3;$i++)
                <div class="bg-white rounded-xl shadow-soft border border-black/5 p-4">
                    <div class="flex items-start justify-between">
                        <div class="h-5 w-40 bg-slate-200 rounded animate-pulse"></div>
                        <div class="h-6 w-24 bg-slate-200 rounded-full animate-pulse"></div>
                    </div>
                    <div class="mt-3 grid grid-cols-3 gap-2">
                        <div class="h-8 bg-slate-200 rounded animate-pulse"></div>
                        <div class="h-8 bg-slate-200 rounded animate-pulse"></div>
                        <div class="h-8 bg-slate-200 rounded animate-pulse"></div>
                    </div>
                    <div class="mt-3 flex justify-between">
                        <div class="h-6 w-28 bg-slate-200 rounded animate-pulse"></div>
                        <div class="h-9 w-28 bg-slate-200 rounded animate-pulse"></div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
