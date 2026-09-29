<x-filament-panels::page>
    @php
        $data = $this->getViewData();
        extract($data);
    @endphp

    {{-- CUSTOM DASHBOARD STYLES --}}
    <style>
        /* Reset fi-page padding for full-width dashboard */
        .fi-page { padding: 0 !important; }
        .fi-page-header { display: none !important; }

        /* Dashboard container */
        .foams-dashboard {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            padding: 0;
        }

        /* ── TOP HEADER BAR ─────────────────────────────────────────── */
        .dash-header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 18px 28px 16px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .dash-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #0066ee;
            margin-bottom: 6px;
        }
        .dash-breadcrumb-sep { color: #94a3b8; }
        .dash-live-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            letter-spacing: 0.04em;
        }
        .dash-live-dot {
            width: 6px; height: 6px;
            background: #16a34a;
            border-radius: 50%;
            animation: pulse-dot 1.5s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.7); }
        }
        .dash-title { font-size: 1.65rem; font-weight: 800; color: #0f172a; margin: 0; line-height: 1.2; }
        .dash-subtitle { font-size: 0.82rem; color: #64748b; margin-top: 4px; }
        .dash-header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        .dash-opwindow {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 0.8rem;
            color: #475569;
        }
        .dash-opwindow-icon { color: #0066ee; }
        .dash-opwindow-label { font-weight: 700; color: #0f172a; font-size: 0.78rem; }
        .btn-quick-sortie {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #0066ee;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 0.84rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.18s, box-shadow 0.18s;
            box-shadow: 0 2px 8px rgba(0,102,238,0.3);
        }
        .btn-quick-sortie:hover { background: #0052c2; box-shadow: 0 4px 14px rgba(0,102,238,0.4); }

        /* ── CONTENT GRID ────────────────────────────────────────────── */
        .dash-content { padding: 20px 24px; display: flex; flex-direction: column; gap: 20px; }

        /* ── STAT CARDS ROW ─────────────────────────────────────────── */
        .dash-stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }
        @media (max-width: 1200px) { .dash-stats-row { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 600px)  { .dash-stats-row { grid-template-columns: 1fr; } }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: box-shadow 0.18s;
        }
        .stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.09); }
        .stat-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .stat-card-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #64748b;
        }
        .stat-icon-wrap {
            width: 38px; height: 38px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .stat-icon-wrap.blue   { background: #dbeafe; color: #0066ee; }
        .stat-icon-wrap.green  { background: #dcfce7; color: #16a34a; }
        .stat-icon-wrap.yellow { background: #fef3c7; color: #d97706; }
        .stat-icon-wrap.orange { background: #ffedd5; color: #ea580c; }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1;
        }
        .stat-value span.unit { font-size: 1rem; font-weight: 600; color: #475569; margin-left: 2px; }
        .stat-sub {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .stat-sub-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .stat-sub-num { font-size: 1.1rem; font-weight: 800; color: #0f172a; }
        .stat-sub-lbl { font-size: 0.68rem; color: #64748b; font-weight: 500; margin-top: 1px; }
        .stat-sub-item.in-flight .stat-sub-num { color: #f59e0b; }
        .stat-sub-item.done .stat-sub-num { color: #10b981; }
        .stat-sub-item.sched .stat-sub-num { color: #0066ee; }

        .stat-growth {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
        }
        .stat-growth.up   { background: #dcfce7; color: #16a34a; }
        .stat-growth.down { background: #fee2e2; color: #dc2626; }
        .stat-vs { font-size: 0.72rem; color: #94a3b8; }

        .fleet-bar-wrap { width: 100%; }
        .fleet-bar-track {
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            border-radius: 99px;
            overflow: hidden;
            margin-top: 4px;
        }
        .fleet-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, #10b981, #0066ee);
            transition: width 0.6s ease;
        }
        .fleet-detail { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 6px; }
        .fleet-detail-item { display: flex; align-items: center; gap: 5px; font-size: 0.72rem; color: #475569; }
        .fleet-dot { width: 8px; height: 8px; border-radius: 50%; }

        .reschedule-num {
            font-size: 2rem; font-weight: 800; color: #ea580c;
        }
        .reschedule-lbl { font-size: 0.75rem; color: #64748b; }
        .reschedule-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #0066ee;
            font-size: 0.78rem;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.15s;
        }
        .reschedule-link:hover { color: #0052c2; }

        /* ── MIDDLE ROW: CHART + FLEET STATUS ───────────────────────── */
        .dash-mid-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
        }
        @media (max-width: 900px) { .dash-mid-row { grid-template-columns: 1fr; } }

        .dash-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }
        .dash-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .dash-card-title { font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0; }
        .dash-card-desc  { font-size: 0.75rem; color: #64748b; margin-top: 2px; }
        .dash-card-badge { font-size: 0.72rem; font-weight: 700; color: #475569;
            background: #f1f5f9; border: 1px solid #e2e8f0;
            padding: 3px 10px; border-radius: 8px; }

        /* Chart filter tabs */
        .chart-filter-tabs {
            display: flex;
            gap: 2px;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 3px;
        }
        .chart-filter-tab {
            padding: 4px 12px;
            font-size: 0.72rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            background: transparent;
            color: #64748b;
            transition: all 0.15s;
        }
        .chart-filter-tab.active, .chart-filter-tab:hover {
            background: #0066ee;
            color: #fff;
        }
        .chart-legend {
            display: flex;
            gap: 16px;
            margin-bottom: 12px;
        }
        .chart-legend-item { display: flex; align-items: center; gap: 6px; font-size: 0.75rem; color: #475569; font-weight: 500; }
        .chart-legend-dot { width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0; }

        /* Donut chart */
        .donut-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }
        .donut-canvas-wrap {
            position: relative;
            width: 180px; height: 180px;
        }
        .donut-center-label {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .donut-pct { font-size: 1.6rem; font-weight: 800; color: #0f172a; }
        .donut-pct-lbl { font-size: 0.65rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; }
        .donut-legend {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 16px;
            width: 100%;
        }
        .donut-legend-item { display: flex; align-items: center; gap: 7px; }
        .donut-legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .donut-legend-info { display: flex; flex-direction: column; }
        .donut-legend-val  { font-size: 0.82rem; font-weight: 700; color: #0f172a; }
        .donut-legend-lbl  { font-size: 0.68rem; color: #64748b; }

        /* ── BOTTOM ROW: SCHEDULES + ACTIVITY ───────────────────────── */
        .dash-bottom-row {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 16px;
        }
        @media (max-width: 900px) { .dash-bottom-row { grid-template-columns: 1fr; } }

        /* Schedules table */
        .sched-table { width: 100%; border-collapse: collapse; }
        .sched-table th {
            background: #f8fafc;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #64748b;
            padding: 8px 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .sched-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.8rem;
            color: #334155;
            vertical-align: middle;
        }
        .sched-table tr:last-child td { border-bottom: none; }
        .sched-table tr:hover td { background: #f8fafc; }
        .sched-code { font-weight: 700; color: #0066ee; font-size: 0.78rem; font-family: monospace; line-height: 1.3; }
        .sched-date { font-weight: 600; color: #0f172a; font-size: 0.79rem; }
        .sched-time { font-size: 0.72rem; color: #64748b; }
        .sched-cadet { font-weight: 600; color: #0f172a; }
        .sched-nim  { font-size: 0.72rem; color: #64748b; }

        .sched-status-badge {
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .sched-status-badge.draft       { background:#f1f5f9; color:#64748b; }
        .sched-status-badge.scheduled   { background:#dbeafe; color:#1d4ed8; }
        .sched-status-badge.in_flight   { background:#fef3c7; color:#b45309; }
        .sched-status-badge.completed   { background:#dcfce7; color:#166534; }
        .sched-status-badge.cancelled   { background:#fee2e2; color:#991b1b; }
        .sched-status-badge.rescheduled { background:#ede9fe; color:#5b21b6; }

        .view-all-link {
            color: #0066ee;
            font-size: 0.78rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: color 0.15s;
        }
        .view-all-link:hover { color: #0052c2; }

        .sched-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px 0;
            font-size: 0.75rem;
            color: #64748b;
            border-top: 1px solid #f1f5f9;
            flex-wrap: wrap;
            gap: 8px;
        }

        /* Activity feed */
        .activity-feed { display: flex; flex-direction: column; gap: 12px; }
        .activity-item {
            display: flex;
            gap: 12px;
            padding: 10px 12px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #f1f5f9;
            transition: border-color 0.15s;
        }
        .activity-item:hover { border-color: #e2e8f0; }
        .activity-icon-wrap {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 0.9rem;
        }
        .ai-orange { background: #ffedd5; color: #ea580c; }
        .ai-blue   { background: #dbeafe; color: #0066ee; }
        .ai-green  { background: #dcfce7; color: #16a34a; }
        .ai-purple { background: #ede9fe; color: #7c3aed; }
        .ai-red    { background: #fee2e2; color: #dc2626; }
        .ai-gray   { background: #f1f5f9; color: #64748b; }

        .activity-body { flex: 1; min-width: 0; }
        .activity-desc {
            font-size: 0.78rem;
            color: #334155;
            line-height: 1.45;
            font-weight: 500;
        }
        .activity-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }
        .activity-time { font-size: 0.68rem; color: #94a3b8; }
        .activity-module-tag {
            font-size: 0.64rem;
            font-weight: 700;
            background: #e2e8f0;
            color: #475569;
            padding: 1px 6px;
            border-radius: 4px;
        }

        .view-audit-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: 100%;
            justify-content: center;
            margin-top: 4px;
            padding: 9px 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s;
        }
        .view-audit-btn:hover { background: #f1f5f9; color: #0f172a; border-color: #cbd5e1; }
    </style>

    <div class="foams-dashboard">

        {{-- ── TOP HEADER ───────────────────────────────── --}}
        <div class="dash-header">
            <div>
                <div class="dash-breadcrumb">
                    <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"/><path d="M3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"/></svg>
                    FLIGHT CONTROL CENTER
                    <span class="dash-breadcrumb-sep">/</span>
                    <span class="dash-live-badge">
                        <span class="dash-live-dot"></span>
                        Live Operations
                    </span>
                </div>
                <h1 class="dash-title">Operations Dashboard</h1>
                <p class="dash-subtitle">Real-time flight training monitoring, sortie progression &amp; fleet readiness overview</p>
            </div>
            <div class="dash-header-right">
                <div class="dash-opwindow">
                    <svg class="dash-opwindow-icon" width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    <div>
                        <div style="font-size:0.68rem;color:#94a3b8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">OPERATIONAL WINDOW</div>
                        <div class="dash-opwindow-label">Today: {{ $today }}</div>
                    </div>
                </div>
                <a href="{{ route('filament.admin.resources.flight-schedules.create') }}" class="btn-quick-sortie">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Quick Sortie
                </a>
            </div>
        </div>

        {{-- ── MAIN CONTENT ─────────────────────────────── --}}
        <div class="dash-content">

            {{-- ── ROW 1: STAT CARDS ──────────────────── --}}
            <div class="dash-stats-row">

                {{-- Card 1: Today's Flights --}}
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">Today's Flights</span>
                        <div class="stat-icon-wrap blue">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $todaySchedules }} <span class="unit">sorties</span></div>
                    <div class="stat-sub">
                        <div class="stat-sub-item in-flight">
                            <span class="stat-sub-num">{{ $inFlight }}</span>
                            <span class="stat-sub-lbl">In Flight</span>
                        </div>
                        <div class="stat-sub-item done">
                            <span class="stat-sub-num">{{ $done }}</span>
                            <span class="stat-sub-lbl">Done</span>
                        </div>
                        <div class="stat-sub-item sched">
                            <span class="stat-sub-num">{{ $scheduled }}</span>
                            <span class="stat-sub-lbl">Scheduled</span>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Total Flight Hours --}}
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">Total Flight Hours</span>
                        <div class="stat-icon-wrap green">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($totalHours, 1, '.', ',') }} <span class="unit">hrs</span></div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        @if($hoursGrowth >= 0)
                        <span class="stat-growth up">
                            <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                            +{{ $hoursGrowth }}%
                        </span>
                        @else
                        <span class="stat-growth down">
                            <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $hoursGrowth }}%
                        </span>
                        @endif
                        <span class="stat-vs">vs. last month period</span>
                    </div>
                </div>

                {{-- Card 3: Fleet Readiness --}}
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">Fleet Readiness</span>
                        <div class="stat-icon-wrap yellow">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ $readyPesawat }}/{{ $totalPesawat }} <span class="unit">({{ $readyPercent }}%)</span></div>
                    <div class="fleet-bar-wrap">
                        <div class="fleet-bar-track">
                            <div class="fleet-bar-fill" style="width:{{ $readyPercent }}%"></div>
                        </div>
                    </div>
                    <div class="fleet-detail">
                        <div class="fleet-detail-item">
                            <span class="fleet-dot" style="background:#10b981"></span>
                            {{ $available }} Active
                        </div>
                        <div class="fleet-detail-item">
                            <span class="fleet-dot" style="background:#f59e0b"></span>
                            {{ $maintenancePesawat }} Maint.
                        </div>
                    </div>
                </div>

                {{-- Card 4: Pending Reschedules --}}
                <div class="stat-card">
                    <div class="stat-card-header">
                        <span class="stat-card-label">Pending Reschedules</span>
                        <div class="stat-icon-wrap orange">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>
                    <div class="reschedule-num">{{ $pendingReschedule }}</div>
                    <div class="reschedule-lbl">awaiting approval</div>
                    <a href="{{ route('filament.admin.resources.reschedule-requests.index') }}" class="reschedule-link">
                        Review Slot Requests
                        <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </a>
                </div>

            </div>{{-- end stats row --}}

            {{-- ── ROW 2: CHART + FLEET DONUT ─────────── --}}
            <div class="dash-mid-row">

                {{-- Flight Activity Chart --}}
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div>
                            <p class="dash-card-title">Flight Activity &amp; Hours Trend</p>
                            <p class="dash-card-desc">Sortie frequency correlated against logged block training time</p>
                        </div>
                        <div class="chart-filter-tabs" id="chart-filter-tabs">
                            <button class="chart-filter-tab active" data-period="7days" onclick="switchChartPeriod('7days', this)">Last 7 Days</button>
                            <button class="chart-filter-tab" data-period="month" onclick="switchChartPeriod('month', this)">This Month</button>
                            <button class="chart-filter-tab" data-period="year" onclick="switchChartPeriod('year', this)">This Year</button>
                        </div>
                    </div>
                    <div class="chart-legend">
                        <div class="chart-legend-item">
                            <div class="chart-legend-dot" style="background:#0066ee;"></div>
                            Schedules Planned (Count)
                        </div>
                        <div class="chart-legend-item">
                            <div class="chart-legend-dot" style="background:#10b981;"></div>
                            Flight Hours (Logged)
                        </div>
                    </div>
                    <div style="position:relative;height:220px;">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>

                {{-- Aircraft Status Donut --}}
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div>
                            <p class="dash-card-title">Aircraft Status</p>
                            <p class="dash-card-desc">Fleet availability breakdown &amp; dispatch readiness</p>
                        </div>
                        <span class="dash-card-badge">Total {{ $totalPesawat }}</span>
                    </div>
                    <div class="donut-wrap">
                        <div class="donut-canvas-wrap">
                            <canvas id="fleetDonut" width="180" height="180"></canvas>
                            <div class="donut-center-label">
                                <div class="donut-pct">{{ $readyPercent }}%</div>
                                <div class="donut-pct-lbl">Fleet Ready</div>
                            </div>
                        </div>
                        <div class="donut-legend">
                            <div class="donut-legend-item">
                                <div class="donut-legend-dot" style="background:#10b981"></div>
                                <div class="donut-legend-info">
                                    <span class="donut-legend-val">Available ({{ $available }})</span>
                                    <span class="donut-legend-lbl">Operational</span>
                                </div>
                            </div>
                            <div class="donut-legend-item">
                                <div class="donut-legend-dot" style="background:#0066ee"></div>
                                <div class="donut-legend-info">
                                    <span class="donut-legend-val">In Use ({{ $inUse }})</span>
                                    <span class="donut-legend-lbl">Currently flying</span>
                                </div>
                            </div>
                            <div class="donut-legend-item">
                                <div class="donut-legend-dot" style="background:#f59e0b"></div>
                                <div class="donut-legend-info">
                                    <span class="donut-legend-val">Maintenance ({{ $maintenance }})</span>
                                    <span class="donut-legend-lbl">Scheduled MX</span>
                                </div>
                            </div>
                            <div class="donut-legend-item">
                                <div class="donut-legend-dot" style="background:#ef4444"></div>
                                <div class="donut-legend-info">
                                    <span class="donut-legend-val">Grounded ({{ $grounded }})</span>
                                    <span class="donut-legend-lbl">AOG / Unfit</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- end mid row --}}

            {{-- ── ROW 3: RECENT SCHEDULES + ACTIVITY ─── --}}
            <div class="dash-bottom-row">

                {{-- Recent Schedules --}}
                <div class="dash-card" style="padding:0;overflow:hidden;">
                    <div style="padding:18px 20px 14px;display:flex;align-items:flex-start;justify-content:space-between;">
                        <div>
                            <p class="dash-card-title">Recent Flight Schedules</p>
                            <p class="dash-card-desc">Operational sortie roster with live status updates</p>
                        </div>
                        <a href="{{ route('filament.admin.resources.flight-schedules.index') }}" class="view-all-link">
                            View All Schedules
                            <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="sched-table">
                            <thead>
                                <tr>
                                    <th>Sortie Code</th>
                                    <th>Date &amp; Slot</th>
                                    <th>Cadet</th>
                                    <th>Instructor</th>
                                    <th>Tail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSchedules as $s)
                                <tr>
                                    <td>
                                        <div class="sched-code">{{ $s->kode_jadwal }}</div>
                                    </td>
                                    <td>
                                        <div class="sched-date">{{ $s->tanggal?->format('d M Y') }}</div>
                                        <div class="sched-time">{{ substr($s->jam_mulai,0,5) }} – {{ substr($s->jam_selesai,0,5) }} WIB</div>
                                    </td>
                                    <td>
                                        <div class="sched-cadet">{{ $s->taruna?->nama ?? '—' }}</div>
                                        <div class="sched-nim">{{ $s->taruna?->nim ?? '' }}</div>
                                    </td>
                                    <td style="font-size:0.8rem;">{{ $s->instruktur?->nama ?? '—' }}</td>
                                    <td>
                                        <span style="font-size:0.78rem;font-weight:700;background:#f1f5f9;color:#475569;padding:2px 7px;border-radius:5px;">
                                            {{ $s->pesawat?->nomor_registrasi ?? '—' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="sched-status-badge {{ $s->status }}">
                                            {{ match($s->status) {
                                                'draft' => 'Draft',
                                                'scheduled' => 'Scheduled',
                                                'in_flight' => 'In Flight',
                                                'completed' => 'Completed',
                                                'cancelled' => 'Cancelled',
                                                'rescheduled' => 'Rescheduled',
                                                default => ucfirst($s->status)
                                            } }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align:center;color:#94a3b8;padding:28px 0;">
                                        No flight schedules found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="sched-pagination">
                        <span>Rows per page: <strong>5</strong> &nbsp;·&nbsp; Showing 1–{{ min(5, count($recentSchedules)) }} of {{ $todaySchedules + $done }} sorties</span>
                        <a href="{{ route('filament.admin.resources.flight-schedules.index') }}" style="color:#0066ee;font-size:0.75rem;font-weight:600;text-decoration:none;">View All →</a>
                    </div>
                </div>

                {{-- Latest Activity Logs --}}
                <div class="dash-card">
                    <div class="dash-card-header" style="margin-bottom:14px;">
                        <div>
                            <p class="dash-card-title" style="display:flex;align-items:center;gap:8px;">
                                Latest Activity Logs
                                <span style="font-size:0.65rem;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;padding:2px 7px;border-radius:20px;font-weight:700;">Live</span>
                            </p>
                            <p class="dash-card-desc">Live operational audit stream</p>
                        </div>
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="#94a3b8" style="flex-shrink:0;margin-top:3px;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="activity-feed">
                        @forelse($latestActivities as $log)
                        @php
                            $iconColor = match($log->action_type) {
                                'INSERT' => 'ai-blue',
                                'UPDATE' => 'ai-orange',
                                'DELETE' => 'ai-red',
                                'LOGIN'  => 'ai-green',
                                'LOGOUT' => 'ai-gray',
                                'EXPORT', 'PRINT' => 'ai-purple',
                                default  => 'ai-gray',
                            };
                            $icon = match($log->action_type) {
                                'INSERT' => '<path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>',
                                'UPDATE' => '<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>',
                                'DELETE' => '<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>',
                                'LOGIN'  => '<path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>',
                                'LOGOUT' => '<path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>',
                                default  => '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>',
                            };
                        @endphp
                        <div class="activity-item">
                            <div class="activity-icon-wrap {{ $iconColor }}">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">{!! $icon !!}</svg>
                            </div>
                            <div class="activity-body">
                                <div class="activity-desc">
                                    <strong>{{ $log->user?->name ?? 'User #'.$log->user_id }}</strong>
                                    — {{ Str::limit($log->description, 80) }}
                                </div>
                                <div class="activity-meta">
                                    <span class="activity-time">{{ $log->created_at?->diffForHumans() }}</span>
                                    <span class="activity-module-tag">{{ $log->module_name }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div style="text-align:center;color:#94a3b8;padding:20px 0;font-size:0.82rem;">No activity logs yet.</div>
                        @endforelse
                    </div>
                    <a href="{{ route('filament.admin.resources.activity-logs.index') }}" class="view-audit-btn" style="margin-top:12px;">
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                        View Complete Activity Audit →
                    </a>
                </div>

            </div>{{-- end bottom row --}}

        </div>{{-- end dash-content --}}
    </div>{{-- end foams-dashboard --}}

    {{-- ── CHART.JS SCRIPTS ──────────────────────────────────── --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        // ── Data from PHP ──────────────────────────────────────
        const initialData = {
            '7days': {
                labels: @json($chartLabels),
                jadwal: @json($chartJadwal),
                hours:  @json($chartHours),
            }
        };

        let activityChart = null;

        // ── Bar Chart (Activity & Hours) ───────────────────────
        function buildBarChart(labels, jadwal, hours) {
            const ctx = document.getElementById('activityChart').getContext('2d');
            if (activityChart) activityChart.destroy();
            activityChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Flight Schedules',
                            data: jadwal,
                            backgroundColor: 'rgba(0,102,238,0.85)',
                            borderColor: '#0066ee',
                            borderWidth: 1.5,
                            borderRadius: 6,
                            borderSkipped: false,
                        },
                        {
                            label: 'Flight Hours (Hrs)',
                            data: hours,
                            backgroundColor: 'rgba(16,185,129,0.85)',
                            borderColor: '#10b981',
                            borderWidth: 1.5,
                            borderRadius: 6,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15,23,42,0.9)',
                            titleColor: '#f1f5f9',
                            bodyColor: '#cbd5e1',
                            cornerRadius: 8,
                            padding: 10,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { size: 11, weight: '500' } }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(226,232,240,0.7)', drawTicks: false },
                            border: { dash: [4, 4] },
                            ticks: { color: '#94a3b8', font: { size: 11 }, padding: 6 }
                        }
                    }
                }
            });
        }

        // ── Donut Chart (Fleet Status) ──────────────────────────
        function buildDonutChart() {
            const ctx2 = document.getElementById('fleetDonut').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Available', 'In Use', 'Maintenance', 'Grounded'],
                    datasets: [{
                        data: [{{ $available }}, {{ $inUse }}, {{ $maintenance }}, {{ $grounded }}],
                        backgroundColor: ['#10b981', '#0066ee', '#f59e0b', '#ef4444'],
                        borderColor: '#ffffff',
                        borderWidth: 3,
                        hoverBorderWidth: 3,
                    }]
                },
                options: {
                    responsive: false,
                    cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15,23,42,0.9)',
                            titleColor: '#f1f5f9',
                            bodyColor: '#cbd5e1',
                            cornerRadius: 8,
                            padding: 10,
                        }
                    },
                    animation: { animateRotate: true, duration: 900 }
                }
            });
        }

        // ── Period Switcher (fetch new data via AJAX) ───────────
        async function switchChartPeriod(period, btn) {
            // Update active tab UI
            document.querySelectorAll('.chart-filter-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            if (initialData[period]) {
                buildBarChart(initialData[period].labels, initialData[period].jadwal, initialData[period].hours);
                return;
            }

            // Fetch dynamic data
            try {
                const res = await fetch(`/admin/dashboard/chart-data?period=${period}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                if (res.ok) {
                    const d = await res.json();
                    initialData[period] = d;
                    buildBarChart(d.labels, d.jadwal, d.hours);
                }
            } catch(e) {
                // fallback: show empty
                buildBarChart([], [], []);
            }
        }

        // ── Init on DOM ready ───────────────────────────────────
        document.addEventListener('DOMContentLoaded', function () {
            buildBarChart(
                initialData['7days'].labels,
                initialData['7days'].jadwal,
                initialData['7days'].hours
            );
            buildDonutChart();
        });
    </script>
</x-filament-panels::page>
