<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-photo class="w-5 h-5 text-primary-500" />
                <span>Slideshow Laporan Disetujui</span>
            </div>
        </x-slot>

        @if($reports->count() > 0)
            <div
                x-data="{
                    active: 0,
                    total: {{ $reports->count() }},
                    timer: null,
                    init() { this.start(); },
                    start() { this.timer = setInterval(() => this.next(), 5000); },
                    stop() { clearInterval(this.timer); },
                    next() { this.active = (this.active + 1) % this.total; },
                    prev() { this.active = this.active === 0 ? this.total - 1 : this.active - 1; },
                    jump(i) { this.active = i; this.stop(); this.start(); }
                }"
                @mouseenter="stop()" @mouseleave="start()"
                class="relative w-full"
            >
                {{-- Container with explicitly defined min-height for responsiveness --}}
                <div class="relative w-full overflow-hidden rounded-xl bg-slate-50 border border-slate-200" style="min-height: 450px;">
                    @foreach($reports as $index => $report)
                        <div
                            x-show="active === {{ $index }}"
                            x-transition:enter="transition ease-in-out duration-500"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in-out duration-500"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0 w-full h-full p-4 flex flex-col items-center justify-center text-center"
                        >
                             {{-- Photo --}}
                             <div class="w-full flex-1 flex items-center justify-center overflow-hidden rounded-lg bg-gray-100 mb-4 relative group">
                                <img
                                    src="{{ $report['photo_url'] }}"
                                    alt="{{ $report['title'] }}"
                                    class="max-w-full max-h-[300px] object-contain shadow-sm rounded-md"
                                    loading="lazy"
                                >
                            </div>

                            {{-- Info --}}
                            <div class="w-full">
                                <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $report['title'] }}</h3>
                                <p class="text-sm text-slate-500 mb-3 line-clamp-2 max-w-2xl mx-auto">{{ $report['description'] }}</p>

                                <div class="flex items-center justify-center gap-4 text-xs font-medium text-slate-600">
                                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white rounded-full border border-slate-200 shadow-sm">
                                        <x-heroicon-o-user-circle class="w-4 h-4 text-primary-500" />
                                        <span>{{ $report['pamong_name'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 px-3 py-1 bg-white rounded-full border border-slate-200 shadow-sm">
                                        <x-heroicon-o-calendar-days class="w-4 h-4 text-amber-500" />
                                        <span>{{ $report['date'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-200 shadow-sm">
                                        <x-heroicon-o-check-badge class="w-4 h-4" />
                                        <span>Disetujui</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Navigation Arrows --}}
                @if($reports->count() > 1)
                    <button @click="prev(); stop(); start();"
                            class="absolute top-1/2 left-2 -translate-y-1/2 z-10 p-2 rounded-full bg-white/80 hover:bg-white text-slate-700 shadow-md backdrop-blur-sm transition-transform hover:scale-110 focus:outline-none">
                        <x-heroicon-o-chevron-left class="w-5 h-5" />
                    </button>
                    <button @click="next(); stop(); start();"
                            class="absolute top-1/2 right-2 -translate-y-1/2 z-10 p-2 rounded-full bg-white/80 hover:bg-white text-slate-700 shadow-md backdrop-blur-sm transition-transform hover:scale-110 focus:outline-none">
                        <x-heroicon-o-chevron-right class="w-5 h-5" />
                    </button>
                @endif

                {{-- Indicators --}}
                @if($reports->count() > 1)
                    <div class="absolute top-4 right-4 z-10 flex space-x-1.5 bg-black/30 p-1.5 rounded-full backdrop-blur-sm">
                        @foreach($reports as $index => $report)
                            <button
                                @click="jump({{ $index }})"
                                :class="active === {{ $index }} ? 'bg-white w-4' : 'bg-white/50 w-1.5 hover:bg-white/80'"
                                class="h-1.5 rounded-full transition-all duration-300"
                            ></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-slate-400 bg-slate-50 border border-slate-200 rounded-xl border-dashed">
                <x-heroicon-o-photo class="w-12 h-12 mb-3 opacity-50" />
                <p class="text-sm font-medium">Belum ada laporan disetujui</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
