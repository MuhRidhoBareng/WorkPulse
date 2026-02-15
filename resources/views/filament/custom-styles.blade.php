<style>
    /* ================================================
       SPNF SKB — Premium Filament Admin Styles
       ================================================ */

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
    @keyframes glowPulse {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }
    @keyframes borderGlow {
        0%, 100% { border-color: rgba(37, 99, 235, 0.15); }
        50% { border-color: rgba(37, 99, 235, 0.35); }
    }

    /* ---- Sidebar ---- */
    .fi-sidebar {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        background: linear-gradient(180deg, #0F172A 0%, #1E293B 100%) !important;
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
    .fi-sidebar-item:nth-child(6) { animation-delay: 0.3s; }

    .fi-sidebar-item a {
        border-radius: 0.625rem !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        margin: 2px 8px !important;
    }
    .fi-sidebar-item a:hover {
        transform: translateX(4px);
        background: rgba(37, 99, 235, 0.12) !important;
    }
    .fi-sidebar-item-active a {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.2), rgba(37, 99, 235, 0.08)) !important;
        border-left: 3px solid #2563EB !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1) !important;
    }

    /* Sidebar group labels */
    .fi-sidebar-group-label {
        color: rgba(148, 163, 184, 0.7) !important;
        font-size: 0.65rem !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
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
        border-radius: 0.875rem !important;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.04) !important;
    }
    .fi-wi-stats-overview-stat:nth-child(1) { animation-delay: 0.05s; }
    .fi-wi-stats-overview-stat:nth-child(2) { animation-delay: 0.1s; }
    .fi-wi-stats-overview-stat:nth-child(3) { animation-delay: 0.15s; }
    .fi-wi-stats-overview-stat:nth-child(4) { animation-delay: 0.2s; }

    .fi-wi-stats-overview-stat:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12) !important;
        border-color: rgba(37, 99, 235, 0.15) !important;
    }

    /* Shimmer top line on stat cards */
    .fi-wi-stats-overview-stat::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #2563EB, #F59E0B, #10B981);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
        border-radius: 0.875rem 0.875rem 0 0;
    }

    /* ---- Chart widgets ---- */
    .fi-wi-chart {
        animation: scaleIn 0.5s ease-out both;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 0.875rem !important;
        border: 1px solid rgba(0, 0, 0, 0.04) !important;
    }
    .fi-wi-chart:nth-child(1) { animation-delay: 0.15s; }
    .fi-wi-chart:nth-child(2) { animation-delay: 0.25s; }
    .fi-wi-chart:nth-child(3) { animation-delay: 0.35s; }

    .fi-wi-chart:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 12px 30px -8px rgba(0, 0, 0, 0.1) !important;
    }

    /* ---- Table rows ---- */
    .fi-ta-row {
        animation: fadeIn 0.3s ease-out both;
        transition: all 0.2s ease !important;
    }
    .fi-ta-row:hover {
        background-color: rgba(37, 99, 235, 0.03) !important;
    }
    .fi-ta-row:nth-child(1) { animation-delay: 0.02s; }
    .fi-ta-row:nth-child(2) { animation-delay: 0.04s; }
    .fi-ta-row:nth-child(3) { animation-delay: 0.06s; }
    .fi-ta-row:nth-child(4) { animation-delay: 0.08s; }
    .fi-ta-row:nth-child(5) { animation-delay: 0.10s; }

    /* ---- Buttons ---- */
    .fi-btn {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 0.625rem !important;
    }
    .fi-btn:hover {
        transform: scale(1.03) translateY(-1px) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12) !important;
    }
    .fi-btn:active {
        transform: scale(0.97) !important;
    }

    /* ---- Modal ---- */
    .fi-modal-window {
        animation: scaleIn 0.25s ease-out both !important;
        border-radius: 1rem !important;
    }

    /* ---- Notification toast ---- */
    .fi-no-notification {
        animation: slideInLeft 0.3s ease-out both !important;
        border-radius: 0.75rem !important;
    }

    /* ---- Cards / sections ---- */
    .fi-section {
        animation: fadeInUp 0.4s ease-out both;
        transition: all 0.3s ease !important;
        border-radius: 0.875rem !important;
        border: 1px solid rgba(0, 0, 0, 0.04) !important;
    }
    .fi-section:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06) !important;
    }

    /* ---- Form groups ---- */
    .fi-fo-field-wrp {
        animation: fadeIn 0.3s ease-out both;
    }

    /* ---- Top bar polish ---- */
    .fi-topbar {
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        background: rgba(255, 255, 255, 0.9) !important;
        transition: all 0.3s ease !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    /* ---- Brand logo ---- */
    .fi-sidebar-header a img,
    .fi-sidebar-header a svg {
        transition: all 0.3s ease !important;
    }
    .fi-sidebar-header a:hover img,
    .fi-sidebar-header a:hover svg {
        transform: scale(1.05);
        filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.15));
    }

    /* ---- Scrollbar ---- */
    .fi-sidebar-nav::-webkit-scrollbar { width: 4px; }
    .fi-sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .fi-sidebar-nav::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* ---- Page transitions ---- */
    .fi-main {
        min-height: calc(100vh - 4rem);
        display: flex;
        flex-direction: column;
    }
    .fi-main > * { flex-shrink: 0; }

    /* ============================================
       MOBILE BUG FIXES
       ============================================ */

    /* Fix: Profile avatar not loading on mobile */
    .fi-avatar {
        overflow: hidden !important;
        flex-shrink: 0 !important;
    }
    .fi-avatar img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    /* Fix: User menu dropdown disappearing on mobile */
    .fi-user-menu {
        position: relative !important;
        z-index: 50 !important;
    }

    /* Fix: Dropdown z-index and click handling on mobile */
    [x-data] .fi-dropdown-panel,
    .fi-dropdown-panel {
        z-index: 9999 !important;
        position: absolute !important;
    }

    /* Prevent dropdown from being clipped by overflow */
    .fi-topbar nav {
        overflow: visible !important;
    }
    .fi-topbar {
        overflow: visible !important;
        z-index: 50 !important;
    }

    /* Fix sidebar overlay on mobile */
    @media (max-width: 1023px) {
        .fi-sidebar {
            z-index: 40 !important;
        }
        .fi-sidebar-close-overlay {
            z-index: 39 !important;
        }

        /* Ensure user menu works on mobile */
        .fi-user-menu .fi-dropdown-panel {
            position: fixed !important;
            right: 8px !important;
            top: auto !important;
            bottom: auto !important;
            min-width: 200px !important;
        }

        /* Fix mobile topbar clipping */
        .fi-topbar,
        .fi-topbar > * {
            overflow: visible !important;
        }
    }

    /* ============================================
       PREMIUM ENHANCEMENTS
       ============================================ */

    /* Dashboard grid items */
    .fi-widgets {
        animation: fadeIn 0.4s ease-out both;
    }

    /* Badge styling */
    .fi-badge {
        transition: all 0.2s ease !important;
    }
    .fi-badge:hover {
        transform: scale(1.05) !important;
    }

    /* Tab transitions */
    .fi-tabs-item {
        transition: all 0.2s ease !important;
    }

    /* Pagination */
    .fi-pagination {
        animation: fadeIn 0.4s ease-out 0.3s both;
    }

    /* Empty state */
    .fi-ta-empty-state {
        animation: fadeInUp 0.5s ease-out both;
    }

    /* Global focus ring styling */
    *:focus-visible {
        outline: 2px solid rgba(37, 99, 235, 0.4) !important;
        outline-offset: 2px !important;
        border-radius: 4px;
    }
</style>
