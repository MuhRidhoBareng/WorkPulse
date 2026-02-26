<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <x-heroicon-o-photo style="width: 1.25rem; height: 1.25rem; color: #3b82f6;" />
                <span>Slideshow Laporan Disetujui</span>
            </div>
        </x-slot>

        @if($reports->count() > 0)
            <div
                x-data="{
                    active: 0,
                    total: {{ $reports->count() }},
                    timer: null,
                    init() { this.play(); },
                    play() {
                        this.stop();
                        this.timer = setInterval(() => {
                            this.active = (this.active + 1) % this.total;
                        }, 5000);
                    },
                    stop() {
                        if (this.timer) { clearInterval(this.timer); this.timer = null; }
                    },
                    goNext() {
                        this.stop();
                        this.active = (this.active + 1) % this.total;
                        this.play();
                    },
                    goPrev() {
                        this.stop();
                        this.active = this.active === 0 ? this.total - 1 : this.active - 1;
                        this.play();
                    },
                    goTo(i) {
                        this.stop();
                        this.active = i;
                        this.play();
                    }
                }"
                @mouseenter="stop()" @mouseleave="play()"
                style="position: relative; width: 100%;"
            >
                {{-- Slides container --}}
                <div style="position: relative; width: 100%; border-radius: 0.75rem; border: 1px solid #e2e8f0; overflow: hidden; background: #f8fafc;">
                    @foreach($reports as $index => $report)
                        <div
                            x-show="active === {{ $index }}"
                            x-cloak
                            @if($index === 0)
                                style="width: 100%;"
                            @else
                                style="position: absolute; top: 0; left: 0; width: 100%;"
                            @endif
                        >
                            {{-- Photo --}}
                            <div style="width: 100%; background: #f1f5f9; text-align: center; padding: 0.75rem;">
                                <img
                                    src="{{ $report['photo_url'] }}"
                                    alt="{{ $report['title'] }}"
                                    style="max-width: 100%; max-height: 400px; object-fit: contain; display: block; margin: 0 auto; border-radius: 0.375rem;"
                                >
                            </div>

                            {{-- Info --}}
                            <div style="padding: 0.875rem 1.25rem; text-align: center; background: white; border-top: 1px solid #e2e8f0;">
                                <h3 style="font-size: 1rem; font-weight: 700; color: #1e293b; margin: 0 0 0.25rem 0;">{{ $report['title'] }}</h3>
                                <p style="font-size: 0.8rem; color: #64748b; margin: 0 0 0.6rem 0; line-height: 1.4;">{{ $report['description'] }}</p>
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.2rem 0.6rem; background: #f8fafc; border-radius: 9999px; border: 1px solid #e2e8f0; font-size: 0.7rem; font-weight: 500; color: #475569;">
                                        <x-heroicon-o-user-circle style="width: 0.875rem; height: 0.875rem; color: #3b82f6;" />
                                        {{ $report['pamong_name'] }}
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.2rem 0.6rem; background: #f8fafc; border-radius: 9999px; border: 1px solid #e2e8f0; font-size: 0.7rem; font-weight: 500; color: #475569;">
                                        <x-heroicon-o-calendar-days style="width: 0.875rem; height: 0.875rem; color: #f59e0b;" />
                                        {{ $report['date'] }}
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.2rem 0.6rem; background: #ecfdf5; border-radius: 9999px; border: 1px solid #a7f3d0; font-size: 0.7rem; font-weight: 600; color: #047857;">
                                        <x-heroicon-o-check-badge style="width: 0.875rem; height: 0.875rem;" />
                                        Disetujui
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Nav arrows --}}
                @if($reports->count() > 1)
                    <button @click="goPrev()"
                        style="position: absolute; top: 40%; left: -0.75rem; transform: translateY(-50%); z-index: 20; width: 2rem; height: 2rem; border-radius: 50%; background: white; border: 1px solid #e2e8f0; color: #475569; box-shadow: 0 2px 6px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center;"
                    >
                        <x-heroicon-o-chevron-left style="width: 1rem; height: 1rem;" />
                    </button>
                    <button @click="goNext()"
                        style="position: absolute; top: 40%; right: -0.75rem; transform: translateY(-50%); z-index: 20; width: 2rem; height: 2rem; border-radius: 50%; background: white; border: 1px solid #e2e8f0; color: #475569; box-shadow: 0 2px 6px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center;"
                    >
                        <x-heroicon-o-chevron-right style="width: 1rem; height: 1rem;" />
                    </button>
                @endif

                {{-- Dots --}}
                @if($reports->count() > 1)
                    <div style="display: flex; justify-content: center; gap: 0.375rem; margin-top: 0.75rem;">
                        @foreach($reports as $index => $report)
                            <button
                                @click="goTo({{ $index }})"
                                :style="active === {{ $index }}
                                    ? 'width: 1.25rem; height: 0.375rem; border-radius: 9999px; background: #3b82f6; border: none; cursor: pointer; transition: all 0.3s;'
                                    : 'width: 0.375rem; height: 0.375rem; border-radius: 9999px; background: #cbd5e1; border: none; cursor: pointer; transition: all 0.3s;'"
                            ></button>
                        @endforeach
                    </div>
                @endif

                {{-- Counter --}}
                <div style="position: absolute; top: 0.75rem; right: 0.75rem; z-index: 20; background: rgba(0,0,0,0.4); color: white; font-size: 0.65rem; padding: 0.15rem 0.5rem; border-radius: 9999px; backdrop-filter: blur(4px); font-weight: 500;">
                    <span x-text="active + 1"></span> / {{ $reports->count() }}
                </div>
            </div>
        @else
            <div style="text-align: center; padding: 3rem 0; color: #94a3b8;">
                <x-heroicon-o-photo style="width: 3rem; height: 3rem; margin: 0 auto 0.75rem auto; opacity: 0.5;" />
                <p style="font-size: 0.875rem; font-weight: 500;">Belum ada laporan disetujui</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
