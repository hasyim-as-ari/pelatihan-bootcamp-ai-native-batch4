<script>
    // Ensure dark mode is completely removed so content area is white
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
    }
    localStorage.setItem('theme', 'light');
</script>

<style>
    /* ==========================================================================
       FOAMS Custom Theme:
       - Sidebar & Header: #0066ee (Aviation Royal Blue)
       - Content Area: Pure White (#ffffff) with high-contrast dark text
       ========================================================================== */

    /* 1. SIDEBAR CONTAINER & BACKGROUNDS */
    #fi-main-sidebar,
    .fi-sidebar,
    .fi-sidebar-header-ctn,
    .fi-sidebar-header,
    .fi-sidebar-nav,
    .fi-sidebar-footer {
        background-color: #0066ee !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
    }

    .fi-sidebar {
        border-right: 1px solid rgba(255, 255, 255, 0.12) !important;
    }

    /* 2. TOPBAR / HEADER CONTAINER & BACKGROUNDS */
    .fi-topbar-ctn,
    .fi-topbar {
        background-color: #0066ee !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15) !important;
        box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.12) !important;
    }

    /* 3. SIDEBAR NAVIGATION GROUP LABELS */
    .fi-sidebar-group-label {
        color: rgba(255, 255, 255, 0.72) !important;
        font-size: 0.72rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.06em !important;
        text-transform: uppercase !important;
    }

    .fi-sidebar-group-btn .fi-icon,
    .fi-sidebar-group-collapse-btn,
    .fi-sidebar-group-dropdown-trigger-btn .fi-icon {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .fi-sidebar-group-btn:hover,
    .fi-sidebar-group-dropdown-trigger-btn:hover {
        background-color: rgba(255, 255, 255, 0.08) !important;
        border-radius: 8px !important;
    }

    /* 4. SIDEBAR INACTIVE ITEMS */
    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn {
        color: rgba(255, 255, 255, 0.9) !important;
        transition: all 0.15s ease-in-out !important;
    }

    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn > .fi-icon {
        color: rgba(255, 255, 255, 0.82) !important;
    }

    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-label {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500 !important;
    }

    /* 5. SIDEBAR INACTIVE ITEMS HOVER */
    .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover {
        background-color: rgba(255, 255, 255, 0.14) !important;
        color: #ffffff !important;
    }

    .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover > .fi-icon,
    .fi-sidebar-item:not(.fi-active) > .fi-sidebar-item-btn:hover .fi-sidebar-item-label {
        color: #ffffff !important;
    }

    /* 6. SIDEBAR ACTIVE ITEM */
    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn {
        background-color: rgba(255, 255, 255, 0.22) !important;
        backdrop-filter: blur(8px) !important;
        color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12) !important;
        border-radius: 8px !important;
    }

    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn > .fi-icon {
        color: #ffffff !important;
    }

    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn > .fi-sidebar-item-label {
        color: #ffffff !important;
        font-weight: 700 !important;
    }

    /* 7. NESTED TREE LINES & BULLETS */
    .fi-sidebar-item-grouped-border-part {
        background-color: rgba(255, 255, 255, 0.45) !important;
    }

    .fi-sidebar-item-grouped-border-part-not-first,
    .fi-sidebar-item-grouped-border-part-not-last {
        background-color: rgba(255, 255, 255, 0.25) !important;
    }

    /* 8. TOPBAR BUTTONS & ICONS */
    .fi-topbar button,
    .fi-topbar .fi-icon-btn,
    .fi-topbar-open-sidebar-btn,
    .fi-topbar-close-sidebar-btn,
    .fi-topbar-open-collapse-sidebar-btn,
    .fi-topbar-close-collapse-sidebar-btn,
    .fi-sidebar-open-collapse-sidebar-btn,
    .fi-sidebar-close-collapse-sidebar-btn {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .fi-topbar button:hover,
    .fi-topbar .fi-icon-btn:hover {
        background-color: rgba(255, 255, 255, 0.14) !important;
        color: #ffffff !important;
    }

    .fi-topbar .fi-icon {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    /* 9. TOPBAR BREADCRUMBS */
    .fi-topbar .fi-breadcrumbs-item-label,
    .fi-breadcrumbs .fi-breadcrumbs-item-label {
        color: rgba(255, 255, 255, 0.85) !important;
    }

    .fi-topbar .fi-breadcrumbs-item:last-child .fi-breadcrumbs-item-label,
    .fi-breadcrumbs .fi-breadcrumbs-item:last-child .fi-breadcrumbs-item-label {
        color: #ffffff !important;
        font-weight: 600 !important;
    }

    .fi-topbar .fi-breadcrumbs-item-separator,
    .fi-breadcrumbs .fi-breadcrumbs-item-separator {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    /* 10. TOPBAR USER MENU TRIGGER */
    .fi-topbar .fi-user-menu-trigger,
    .fi-topbar .fi-user-menu-trigger-text {
        color: #ffffff !important;
    }

    /* Replace "SA" avatar img with a clean user SVG icon */
    .fi-topbar .fi-user-menu-trigger .fi-user-avatar,
    .fi-topbar .fi-user-menu button .fi-user-avatar {
        /* Hide the actual img (initials from UiAvatars) */
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        position: absolute !important;
        pointer-events: none !important;
    }

    /* The trigger button itself becomes our styled user icon button */
    .fi-topbar .fi-user-menu-trigger {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        background: rgba(255, 255, 255, 0.18) !important;
        border: 2px solid rgba(255, 255, 255, 0.35) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18) !important;
        transition: background 0.18s ease, border-color 0.18s ease, box-shadow 0.18s ease !important;
        cursor: pointer !important;
        position: relative !important;
        overflow: visible !important;
    }

    .fi-topbar .fi-user-menu-trigger:hover {
        background: rgba(255, 255, 255, 0.28) !important;
        border-color: rgba(255, 255, 255, 0.55) !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.22) !important;
    }

    /* Inject SVG user icon using CSS pseudo-element */
    .fi-topbar .fi-user-menu-trigger::after {
        content: '';
        display: block !important;
        width: 22px !important;
        height: 22px !important;
        flex-shrink: 0 !important;
        background-color: #ffffff !important;
        -webkit-mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='12' cy='7' r='4'/%3E%3C/svg%3E") !important;
        -webkit-mask-size: contain !important;
        -webkit-mask-repeat: no-repeat !important;
        -webkit-mask-position: center !important;
        mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='12' cy='7' r='4'/%3E%3C/svg%3E") !important;
        mask-size: contain !important;
        mask-repeat: no-repeat !important;
        mask-position: center !important;
    }

    /* 11. SIDEBAR SCROLLBAR */
    .fi-sidebar-nav::-webkit-scrollbar {
        width: 5px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }
    .fi-sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.35);
    }

    /* 12. CONTENT AREA BACKGROUND & CARD STYLING (PURE WHITE) */
    .fi-body,
    .fi-main-ctn,
    .fi-main,
    .fi-page {
        background-color: #ffffff !important;
        color: #0f172a !important;
    }

    /* Page Heading (Dashboard, etc.) */
    .fi-header-heading {
        color: #0f172a !important;
        font-weight: 700 !important;
    }

    .fi-header-subheading {
        color: #475569 !important;
    }

    /* Sections, Cards, Widgets */
    .fi-section,
    .fi-widget,
    .fi-card,
    .fi-ta-ctn {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
    }

    /* Account Widget (Welcome Admin Super) */
    .fi-account-widget .fi-section {
        background-color: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05) !important;
    }

    .fi-account-widget-heading {
        color: #0f172a !important;
        font-weight: 700 !important;
    }

    .fi-account-widget-user-name {
        color: #64748b !important;
    }

    .fi-account-widget-logout-form button,
    .fi-account-widget button {
        background-color: #f8fafc !important;
        color: #334155 !important;
        border: 1px solid #e2e8f0 !important;
    }

    .fi-account-widget-logout-form button:hover,
    .fi-account-widget button:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
    }

    /* Safety fallback if html or body retains .dark */
    html.dark .fi-body,
    html.dark .fi-main-ctn,
    html.dark .fi-main,
    html.dark .fi-page {
        background-color: #ffffff !important;
        color: #0f172a !important;
    }

    html.dark .fi-section,
    html.dark .fi-widget,
    html.dark .fi-widget > * {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border-color: #e2e8f0 !important;
    }

    html.dark .fi-header-heading,
    html.dark .fi-section-header-heading,
    html.dark .fi-account-widget-heading {
        color: #0f172a !important;
    }

    html.dark .fi-account-widget-user-name,
    html.dark .fi-section-header-description,
    html.dark .fi-header-subheading {
        color: #64748b !important;
    }

    html.dark .fi-account-widget-logout-form button,
    html.dark .fi-account-widget button {
        background-color: #f8fafc !important;
        color: #334155 !important;
        border: 1px solid #e2e8f0 !important;
    }

    /* ==========================================================================
       13. ALL "NEW" / "ADD" / CREATE ACTION BUTTONS (SIDEBAR BLUE #0066ee & WHITE TEXT)
       ========================================================================== */
    .fi-btn.fi-color-primary,
    .fi-btn-color-primary,
    .fi-ac-create-action,
    .fi-ac-create-action .fi-btn,
    a.fi-btn[href*="/create"],
    .fi-page-header-actions .fi-btn.fi-color-primary,
    .fi-ta-header-actions .fi-btn.fi-color-primary,
    .fi-fo-repeater-add-btn,
    .fi-fo-builder-block-picker-trigger {
        background-color: #0066ee !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 1px 3px 0 rgba(0, 102, 238, 0.35) !important;
        transition: all 0.15s ease-in-out !important;
    }

    .fi-btn.fi-color-primary:hover,
    .fi-btn-color-primary:hover,
    .fi-ac-create-action:hover,
    .fi-ac-create-action .fi-btn:hover,
    a.fi-btn[href*="/create"]:hover,
    .fi-page-header-actions .fi-btn.fi-color-primary:hover,
    .fi-ta-header-actions .fi-btn.fi-color-primary:hover,
    .fi-fo-repeater-add-btn:hover,
    .fi-fo-builder-block-picker-trigger:hover {
        background-color: #0052c2 !important;
        color: #ffffff !important;
        box-shadow: 0 3px 8px 0 rgba(0, 102, 238, 0.45) !important;
    }

    .fi-btn.fi-color-primary:focus-visible,
    a.fi-btn[href*="/create"]:focus-visible {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(0, 102, 238, 0.4) !important;
    }

    /* Text & Icons inside all New / Add / Create buttons */
    .fi-btn.fi-color-primary *,
    .fi-btn-color-primary *,
    .fi-ac-create-action *,
    a.fi-btn[href*="/create"] *,
    .fi-page-header-actions .fi-btn.fi-color-primary *,
    .fi-ta-header-actions .fi-btn.fi-color-primary *,
    .fi-fo-repeater-add-btn *,
    .fi-fo-builder-block-picker-trigger * {
        color: #ffffff !important;
        fill: currentColor !important;
    }

    .fi-btn.fi-color-primary .fi-btn-label,
    .fi-btn-color-primary .fi-btn-label,
    a.fi-btn[href*="/create"] .fi-btn-label,
    .fi-page-header-actions .fi-btn .fi-btn-label {
        color: #ffffff !important;
        font-weight: 600 !important;
    }

    .fi-btn.fi-color-primary .fi-icon,
    .fi-btn-color-primary .fi-icon,
    a.fi-btn[href*="/create"] .fi-icon {
        color: #ffffff !important;
    }

    /* ==========================================================================
       TABLE FILTERS (ABOVE CONTENT) STYLING:
       Matching "SELECT BATCH", "SELECT STUDENT", and "FILTER" button
       ========================================================================== */
    .fi-ta-filters-above-content-ctn {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        padding: 1rem 1.25rem !important;
        margin-bottom: 1rem !important;
    }

    .fi-ta-filters-above-content-ctn .fi-ta-filters-header {
        display: none !important;
    }

    .fi-ta-filters-above-content-ctn label,
    .fi-ta-filters-above-content-ctn .fi-fo-field-wrp-label {
        font-weight: 700 !important;
        font-size: 0.78rem !important;
        letter-spacing: 0.05em !important;
        color: #0f4a56 !important;
        text-transform: uppercase !important;
    }

    .fi-ta-filters-above-content-ctn .fi-ta-filters-actions-ctn {
        display: flex !important;
        justify-content: flex-end !important;
        align-items: center !important;
        gap: 0.75rem !important;
        margin-top: 0.75rem !important;
        padding-top: 0.75rem !important;
        border-top: 1px dashed #e2e8f0 !important;
    }

    .fi-ta-filters-above-content-ctn .fi-ta-filters-actions-ctn button {
        letter-spacing: 0.05em !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        padding: 0.5rem 1.5rem !important;
    }
</style>
