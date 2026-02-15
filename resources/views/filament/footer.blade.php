<style>
    .footer-gradient-line {
        height: 3px;
        background: linear-gradient(90deg, #0F172A, #2563EB, #F59E0B, #10B981, #0F172A);
        background-size: 300% 100%;
        animation: gradientShift 6s ease infinite;
    }
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
</style>

<footer class="mt-6 py-4">
    <div class="footer-gradient-line"></div>
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 max-w-7xl mx-auto pt-4">
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1.5">
                <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo Kemendikdasmen" class="h-7 w-auto rounded">
                <img src="{{ asset('images/logo-kotamobagu.png') }}" alt="Logo Kotamobagu" class="h-7 w-auto">
            </div>
            <div class="h-5 w-px bg-gray-200 dark:bg-gray-600"></div>
            <div>
                <p class="text-sm font-bold text-gray-700 dark:text-gray-300">SPNF SKB</p>
                <p class="text-[10px] text-gray-400">Kota Kotamobagu</p>
            </div>
        </div>
        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SPNF SKB Kota Kotamobagu. All rights reserved.</p>
    </div>
</footer>
