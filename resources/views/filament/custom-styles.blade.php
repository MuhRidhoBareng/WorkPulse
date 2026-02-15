<style>
    /* ===============================================
       WorkPulse — Filament Admin Custom Animations
       =============================================== */

    /* Keyframes */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    /* ---- Sidebar ---- */
    .fi-sidebar {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .fi-sidebar-nav-groups {
        animation: fadeIn 0.4s ease-out both;
    }
    .fi-sidebar-item {
        animation: slideInLeft 0.4s ease-out both;
        transition: all 0.2s ease !important;
    }
    .fi-sidebar-item:nth-child(1) { animation-delay: 0.05s; }
    .fi-sidebar-item:nth-child(2) { animation-delay: 0.1s; }
    .fi-sidebar-item:nth-child(3) { animation-delay: 0.15s; }
    .fi-sidebar-item:nth-child(4) { animation-delay: 0.2s; }
    .fi-sidebar-item:nth-child(5) { animation-delay: 0.25s; }

    .fi-sidebar-item a {
        border-radius: 0.5rem !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .fi-sidebar-item a:hover {
        transform: translateX(4px);
        background-color: rgba(245, 158, 11, 0.08) !important;
    }
    .fi-sidebar-item-active a {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.05)) !important;
        border-left: 3px solid rgb(245, 158, 11) !important;
    }

    /* ---- Content area ---- */
    .fi-page {
        animation: fadeInUp 0.4s ease-out both !important;
    }
    .fi-header {
        animation: slideDown 0.35s ease-out both !important;
    }

    /* ---- Widget cards ---- */
    .fi-wi-stats-overview-stat {
        animation: fadeInUp 0.5s ease-out both;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 0.75rem !important;
        overflow: hidden;
    }
    .fi-wi-stats-overview-stat:nth-child(1) { animation-delay: 0.05s; }
    .fi-wi-stats-overview-stat:nth-child(2) { animation-delay: 0.1s; }
    .fi-wi-stats-overview-stat:nth-child(3) { animation-delay: 0.15s; }
    .fi-wi-stats-overview-stat:nth-child(4) { animation-delay: 0.2s; }

    .fi-wi-stats-overview-stat:hover {
        transform: translateY(-4px) !important;
        box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.12) !important;
    }

    /* ---- Chart widgets ---- */
    .fi-wi-chart {
        animation: scaleIn 0.5s ease-out both;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 0.75rem !important;
    }
    .fi-wi-chart:nth-child(1) { animation-delay: 0.15s; }
    .fi-wi-chart:nth-child(2) { animation-delay: 0.25s; }
    .fi-wi-chart:nth-child(3) { animation-delay: 0.35s; }

    .fi-wi-chart:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.1) !important;
    }

    /* ---- Table rows (resource lists) ---- */
    .fi-ta-row {
        animation: fadeIn 0.3s ease-out both;
        transition: all 0.2s ease !important;
    }
    .fi-ta-row:hover {
        background-color: rgba(245, 158, 11, 0.04) !important;
    }
    .fi-ta-row:nth-child(1) { animation-delay: 0.02s; }
    .fi-ta-row:nth-child(2) { animation-delay: 0.04s; }
    .fi-ta-row:nth-child(3) { animation-delay: 0.06s; }
    .fi-ta-row:nth-child(4) { animation-delay: 0.08s; }
    .fi-ta-row:nth-child(5) { animation-delay: 0.10s; }
    .fi-ta-row:nth-child(6) { animation-delay: 0.12s; }
    .fi-ta-row:nth-child(7) { animation-delay: 0.14s; }
    .fi-ta-row:nth-child(8) { animation-delay: 0.16s; }
    .fi-ta-row:nth-child(9) { animation-delay: 0.18s; }
    .fi-ta-row:nth-child(10) { animation-delay: 0.20s; }

    /* ---- Buttons ---- */
    .fi-btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .fi-btn:hover {
        transform: scale(1.03) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }
    .fi-btn:active {
        transform: scale(0.97) !important;
    }

    /* ---- Modal animation ---- */
    .fi-modal-window {
        animation: scaleIn 0.25s ease-out both !important;
    }

    /* ---- Notification toast ---- */
    .fi-no-notification {
        animation: slideInLeft 0.3s ease-out both !important;
    }

    /* ---- Cards / sections ---- */
    .fi-section {
        animation: fadeInUp 0.4s ease-out both;
        transition: all 0.3s ease !important;
        border-radius: 0.75rem !important;
    }
    .fi-section:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06) !important;
    }

    /* ---- Form groups ---- */
    .fi-fo-field-wrp {
        animation: fadeIn 0.3s ease-out both;
    }

    /* ---- Top bar polish ---- */
    .fi-topbar {
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        transition: all 0.3s ease !important;
    }

    /* ---- Brand logo pulse on hover ---- */
    .fi-sidebar-header a img,
    .fi-sidebar-header a svg {
        transition: all 0.3s ease !important;
    }
    .fi-sidebar-header a:hover img,
    .fi-sidebar-header a:hover svg {
        transform: scale(1.05);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    /* ---- Smooth page transitions ---- */
    .fi-main {
        min-height: calc(100vh - 4rem);
        display: flex;
        flex-direction: column;
    }
    .fi-main > * {
        flex-shrink: 0;
    }

    /* ---- Scrollbar styling ---- */
    .fi-sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.15);
        border-radius: 20px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.25);
    }

    /* ---- Loading shimmer for stats ---- */
    .fi-wi-stats-overview-stat::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(245, 158, 11, 0.3), transparent);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
        border-radius: 0.75rem 0.75rem 0 0;
    }
</style>
