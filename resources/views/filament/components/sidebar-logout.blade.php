<style>
    #sidebar-logout-btn svg {
        width: 18px !important;
        height: 18px !important;
        min-width: 18px !important;
        max-width: 18px !important;
        display: inline-block !important;
        flex-shrink: 0 !important;
    }
</style>

<div style="padding: 12px 16px !important; border-top: 1px solid rgba(255, 255, 255, 0.15) !important; margin-top: auto !important; width: 100% !important; box-sizing: border-box !important;">
    <form action="{{ filament()->getLogoutUrl() }}" method="post" style="margin: 0 !important; padding: 0 !important; width: 100% !important;">
        @csrf
        <button
            type="submit"
            id="sidebar-logout-btn"
            style="display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: flex-start !important; gap: 12px !important; width: 100% !important; background: rgba(255, 255, 255, 0.1) !important; border: 1px solid rgba(255, 255, 255, 0.18) !important; padding: 9px 12px !important; border-radius: 8px !important; cursor: pointer !important; text-align: left !important; color: #ffffff !important; text-decoration: none !important; transition: all 0.15s ease !important; outline: none !important;"
            onmouseover="this.style.backgroundColor='rgba(239, 68, 68, 0.85)'; this.style.borderColor='rgba(239, 68, 68, 1)'; this.querySelector('svg').style.color='#ffffff';"
            onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.1)'; this.style.borderColor='rgba(255, 255, 255, 0.18)'; this.querySelector('svg').style.color='#ff9999';"
            title="Sign out of system"
        >
            <svg
                style="width: 18px !important; height: 18px !important; min-width: 18px !important; max-width: 18px !important; display: inline-block !important; flex-shrink: 0 !important; color: #ff9999 !important; transition: color 0.15s ease !important;"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span style="font-size: 14px !important; font-weight: 600 !important; line-height: 1 !important; white-space: nowrap !important; letter-spacing: -0.01em !important; color: #ffffff !important;">
                Logout
            </span>
        </button>
    </form>
</div>
