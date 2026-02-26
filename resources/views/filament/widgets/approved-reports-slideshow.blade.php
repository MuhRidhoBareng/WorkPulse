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
                x-data='{
                    slides: @json($reports),
                    active: 0,
                    timer: null,
                    fading: false,
                    get total() { return this.slides.length; },
                    get current() { return this.slides[this.active]; },
                    init() { this.play(); },
                    play() {
                        this.stop();
                        this.timer = setInterval(() => this.fadeToNext(), 5000);
                    },
                    stop() {
                        if (this.timer) {
                            clearInterval(this.timer);
                            this.timer = null;
                        }
                    },
                    fadeTo(index) {
                        if (this.fading || index === this.active) return;
                        this.fading = true;
                        setTimeout(() => {
                            this.active = index;
                            setTimeout(() => { this.fading = false; }, 50);
                        }, 300);
                    },
                    fadeToNext() {
                        this.fadeTo((this.active + 1) % this.total);
                    },
                    fadeToPrev() {
                        this.fadeTo(this.active === 0 ? this.total - 1 : this.active - 1);
                    },
                    goNext() { this.stop(); this.fadeToNext(); this.play(); },
                    goPrev() { this.stop(); this.fadeToPrev(); this.play(); },
                    goTo(i) { this.stop(); this.fadeTo(i); this.play(); }
                }'
                @mouseenter="stop()" @mouseleave="play()"
                style="position: relative; width: 100%;"
            >
                {{-- Single slide container --}}
                <div style="border-radius: 0.75rem; border: 1px solid #e2e8f0; overflow: hidden; background: #f8fafc;">

                    {{-- Photo --}}
                    <div style="width: 100%; background: #f1f5f9; text-align: center; padding: 1rem; min-height: 200px; display: flex; align-items: center; justify-content: center;">
                        <img
                            :src="current.photo_url"
                            :alt="current.title"
                            :style="fading ? 'opacity: 0; transition: opacity 0.3s ease;' : 'opacity: 1; transition: opacity 0.3s ease;'"
                            style="max-width: 100%; max-height: 400px; object-fit: contain; display: block; margin: 0 auto; border-radius: 0.5rem;"
                        >
                    </div>

                    {{-- Info --}}
                    <div
                        :style="fading ? 'opacity: 0; transition: opacity 0.3s ease;' : 'opacity: 1; transition: opacity 0.3s ease;'"
                        style="padding: 1rem 1.25rem; text-align: center; background: white; border-top: 1px solid #e2e8f0;"
                    >
                        <h3 x-text="current.title" style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin: 0 0 0.25rem 0;"></h3>
                        <p x-text="current.description" style="font-size: 0.8rem; color: #64748b; margin: 0 0 0.75rem 0; line-height: 1.5;"></p>

                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.25rem 0.65rem; background: #f8fafc; border-radius: 9999px; border: 1px solid #e2e8f0; font-size: 0.7rem; font-weight: 500; color: #475569;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#3b82f6" style="width: 0.875rem; height: 0.875rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                <span x-text="current.pamong_name"></span>
                            </span>
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.25rem 0.65rem; background: #f8fafc; border-radius: 9999px; border: 1px solid #e2e8f0; font-size: 0.7rem; font-weight: 500; color: #475569;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#f59e0b" style="width: 0.875rem; height: 0.875rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                <span x-text="current.date"></span>
                            </span>
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.25rem 0.65rem; background: #ecfdf5; border-radius: 9999px; border: 1px solid #a7f3d0; font-size: 0.7rem; font-weight: 600; color: #047857;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 0.875rem; height: 0.875rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                                Disetujui
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Nav --}}
                <template x-if="total > 1">
                    <div>
                        <button @click="goPrev()"
                            style="position: absolute; top: 40%; left: -0.5rem; transform: translateY(-50%); z-index: 20; width: 2.25rem; height: 2.25rem; border-radius: 50%; background: white; border: 1px solid #e2e8f0; color: #475569; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                            onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2)'; this.style.transform='translateY(-50%) scale(1.1)';"
                            onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'; this.style.transform='translateY(-50%) scale(1)';"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>
                        </button>
                        <button @click="goNext()"
                            style="position: absolute; top: 40%; right: -0.5rem; transform: translateY(-50%); z-index: 20; width: 2.25rem; height: 2.25rem; border-radius: 50%; background: white; border: 1px solid #e2e8f0; color: #475569; box-shadow: 0 2px 8px rgba(0,0,0,0.1); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                            onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2)'; this.style.transform='translateY(-50%) scale(1.1)';"
                            onmouseout="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'; this.style.transform='translateY(-50%) scale(1)';"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>
                        </button>
                    </div>
                </template>

                {{-- Dots --}}
                <template x-if="total > 1">
                    <div style="display: flex; justify-content: center; gap: 0.375rem; margin-top: 0.75rem;">
                        <template x-for="(slide, idx) in slides" :key="idx">
                            <button
                                @click="goTo(idx)"
                                :style="active === idx
                                    ? 'width: 1.25rem; height: 0.4rem; border-radius: 9999px; background: #3b82f6; border: none; cursor: pointer; transition: all 0.3s;'
                                    : 'width: 0.4rem; height: 0.4rem; border-radius: 9999px; background: #cbd5e1; border: none; cursor: pointer; transition: all 0.3s;'"
                            ></button>
                        </template>
                    </div>
                </template>

                {{-- Counter --}}
                <div style="position: absolute; top: 0.75rem; right: 0.75rem; z-index: 20; background: rgba(0,0,0,0.45); color: white; font-size: 0.7rem; padding: 0.2rem 0.6rem; border-radius: 9999px; backdrop-filter: blur(4px); font-weight: 600;">
                    <span x-text="active + 1"></span> / <span x-text="total"></span>
                </div>
            </div>
        @else
            <div style="text-align: center; padding: 3rem 0; color: #94a3b8;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 3rem; height: 3rem; margin: 0 auto 0.75rem auto; opacity: 0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 0 0 1.5-1.5V5.25a1.5 1.5 0 0 0-1.5-1.5H3.75a1.5 1.5 0 0 0-1.5 1.5v14.25c0 .828.672 1.5 1.5 1.5Z" /></svg>
                <p style="font-size: 0.875rem; font-weight: 500;">Belum ada laporan disetujui</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
