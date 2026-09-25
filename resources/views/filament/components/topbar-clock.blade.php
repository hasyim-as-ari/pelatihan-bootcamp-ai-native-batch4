<div
    x-data="{
        date: '',
        day: '',
        wib: '',
        wita: '',
        wit: '',
        gmt: '',
        init() {
            this.update();
            setInterval(() => this.update(), 1000);
        },
        update() {
            const now = new Date();
            const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

            this.day = days[now.getDay()];
            const d = String(now.getDate()).padStart(2, '0');
            const m = months[now.getMonth()];
            const y = now.getFullYear();
            this.date = d + ' ' + m + ' ' + y;

            const pad = n => String(n).padStart(2, '0');
            const fmt = (h, min, s) => pad(h) + ':' + pad(min) + ':' + pad(s);

            // WIB  = UTC+7
            const utcMs = now.getTime() + (now.getTimezoneOffset() * 60000);
            const wibDate  = new Date(utcMs + (7 * 3600000));
            const witaDate = new Date(utcMs + (8 * 3600000));
            const witDate  = new Date(utcMs + (9 * 3600000));
            const gmtDate  = new Date(utcMs);

            this.wib  = fmt(wibDate.getHours(),  wibDate.getMinutes(),  wibDate.getSeconds());
            this.wita = fmt(witaDate.getHours(), witaDate.getMinutes(), witaDate.getSeconds());
            this.wit  = fmt(witDate.getHours(),  witDate.getMinutes(),  witDate.getSeconds());
            this.gmt  = fmt(gmtDate.getHours(),  gmtDate.getMinutes(),  gmtDate.getSeconds());
        }
    }"
    x-init="init()"
    style="
        display: inline-flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
        margin-left: 16px;
        padding: 5px 14px;
        background: rgba(255,255,255,0.11);
        border: 1px solid rgba(255,255,255,0.20);
        border-radius: 10px;
        backdrop-filter: blur(8px);
        box-shadow: 0 1px 6px 0 rgba(0,0,0,0.10);
        white-space: nowrap;
        vertical-align: middle;
    "
>
    {{-- Calendar / Date section --}}
    <div style="display:inline-flex;align-items:center;gap:6px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.80)" stroke-width="2" style="flex-shrink:0;">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8"  y1="2" x2="8"  y2="6"/>
            <line x1="3"  y1="10" x2="21" y2="10"/>
        </svg>
        <span style="font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.72);letter-spacing:0.02em;" x-text="day"></span>
        <span style="font-size:0.76rem;font-weight:700;color:#ffffff;letter-spacing:0.02em;" x-text="date"></span>
    </div>

    {{-- Divider --}}
    <div style="width:1px;height:20px;background:rgba(255,255,255,0.22);flex-shrink:0;"></div>

    {{-- Clock icon --}}
    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="rgba(255,255,255,0.80)" stroke-width="2" style="flex-shrink:0;">
        <circle cx="12" cy="12" r="10"/>
        <polyline points="12 6 12 12 16 14"/>
    </svg>

    {{-- WIB --}}
    <div style="display:inline-flex;flex-direction:column;align-items:center;gap:1px;">
        <span style="font-size:0.58rem;font-weight:700;color:rgba(255,255,255,0.60);letter-spacing:0.08em;line-height:1;">WIB</span>
        <span style="font-size:0.80rem;font-weight:700;color:#ffffff;letter-spacing:0.05em;font-variant-numeric:tabular-nums;font-family:'Courier New',monospace;line-height:1;" x-text="wib"></span>
    </div>

    <div style="width:1px;height:20px;background:rgba(255,255,255,0.15);flex-shrink:0;"></div>

    {{-- WITA --}}
    <div style="display:inline-flex;flex-direction:column;align-items:center;gap:1px;">
        <span style="font-size:0.58rem;font-weight:700;color:rgba(255,255,255,0.60);letter-spacing:0.08em;line-height:1;">WITA</span>
        <span style="font-size:0.80rem;font-weight:700;color:#ffe082;letter-spacing:0.05em;font-variant-numeric:tabular-nums;font-family:'Courier New',monospace;line-height:1;" x-text="wita"></span>
    </div>

    <div style="width:1px;height:20px;background:rgba(255,255,255,0.15);flex-shrink:0;"></div>

    {{-- WIT --}}
    <div style="display:inline-flex;flex-direction:column;align-items:center;gap:1px;">
        <span style="font-size:0.58rem;font-weight:700;color:rgba(255,255,255,0.60);letter-spacing:0.08em;line-height:1;">WIT</span>
        <span style="font-size:0.80rem;font-weight:700;color:#80deea;letter-spacing:0.05em;font-variant-numeric:tabular-nums;font-family:'Courier New',monospace;line-height:1;" x-text="wit"></span>
    </div>

    <div style="width:1px;height:20px;background:rgba(255,255,255,0.15);flex-shrink:0;"></div>

    {{-- GMT --}}
    <div style="display:inline-flex;flex-direction:column;align-items:center;gap:1px;">
        <span style="font-size:0.58rem;font-weight:700;color:rgba(255,255,255,0.60);letter-spacing:0.08em;line-height:1;">GMT</span>
        <span style="font-size:0.80rem;font-weight:700;color:#ef9a9a;letter-spacing:0.05em;font-variant-numeric:tabular-nums;font-family:'Courier New',monospace;line-height:1;" x-text="gmt"></span>
    </div>
</div>
