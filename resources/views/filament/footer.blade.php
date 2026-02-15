<style>
    .footer-gradient-line {
        height: 3px;
        background: linear-gradient(90deg, #1F4E79, #3B82F6, #8B5CF6, #EC4899);
        background-size: 200% 100%;
        animation: gradientShift 4s ease infinite;
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
            <img src="{{ asset('images/logo-kemendikdasmen.jpg') }}" alt="Logo" class="h-7 w-auto">
            <div>
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">WorkPulse</p>
                <p class="text-xs text-gray-400">Sistem Monitoring Kinerja — SKB Dinas Pendidikan</p>
            </div>
        </div>
        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} SKB Dinas Pendidikan. All rights reserved.</p>
    </div>
</footer>
