<div class="space-y-4 text-sm text-gray-700 dark:text-gray-200">
    <div class="flex items-center justify-between pb-3 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-2">
            @php
                $badgeColors = [
                    'LOGIN' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-950/50 dark:text-emerald-300 dark:border-emerald-800',
                    'LOGOUT' => 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700',
                    'INSERT' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-950/50 dark:text-blue-300 dark:border-blue-800',
                    'UPDATE' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-950/50 dark:text-amber-300 dark:border-amber-800',
                    'DELETE' => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-950/50 dark:text-red-300 dark:border-red-800',
                    'PRINT' => 'bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-950/50 dark:text-purple-300 dark:border-purple-800',
                    'EXPORT' => 'bg-teal-50 text-teal-700 border-teal-200 dark:bg-teal-950/50 dark:text-teal-300 dark:border-teal-800',
                    'VIEW' => 'bg-sky-50 text-sky-700 border-sky-200 dark:bg-sky-950/50 dark:text-sky-300 dark:border-sky-800',
                ];
                $colorClass = $badgeColors[$log->action_type] ?? 'bg-gray-100 text-gray-700 border-gray-200';
            @endphp
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $colorClass }}">
                {{ $log->action_type }}
            </span>
            <span class="font-medium text-gray-900 dark:text-white text-base">
                {{ $log->module_name }}
            </span>
        </div>
        <span class="text-xs text-gray-500 dark:text-gray-400">
            {{ $log->created_at?->format('d M Y, H:i:s') }}
        </span>
    </div>

    {{-- Detail Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-gray-50 dark:bg-gray-800/60 p-3 rounded-lg border border-gray-200/70 dark:border-gray-700/60">
        <div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 block">User:</span>
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $log->user?->name ?? 'User #' . $log->user_id }}
            </span>
            @if($log->user?->email)
                <span class="text-xs text-gray-500 block">{{ $log->user->email }} ({{ $log->user->role_label }})</span>
            @else
                <span class="text-xs text-gray-400 block">ID: {{ $log->user_id }}</span>
            @endif
        </div>

        <div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 block">IP Address:</span>
            <span class="font-mono text-sm font-semibold text-gray-900 dark:text-white">{{ $log->ip_address }}</span>
        </div>

        @if($log->record_id)
        <div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 block">Associated Record ID:</span>
            <span class="font-mono font-medium text-gray-800 dark:text-gray-200">#{{ $log->record_id }}</span>
        </div>
        @endif

        <div class="{{ $log->record_id ? '' : 'md:col-span-2' }}">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 block">User Agent (Browser / Device):</span>
            <span class="text-xs text-gray-600 dark:text-gray-300 break-all font-mono">{{ $log->user_agent ?? '-' }}</span>
        </div>
    </div>

    {{-- Keterangan --}}
    <div>
        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 block mb-1">
            Activity Description
        </span>
        <div class="p-3 bg-white dark:bg-gray-900 rounded-md border border-gray-200 dark:border-gray-800 text-gray-800 dark:text-gray-200">
            {{ $log->description }}
        </div>
    </div>

    {{-- Nilai Data (old_values & new_values) jika ada --}}
    @if($log->old_values || $log->new_values)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pt-2">
        @if($log->old_values)
        <div>
            <span class="text-xs font-semibold uppercase tracking-wider text-amber-600 dark:text-amber-400 block mb-1">
                Old Values (Before Change)
            </span>
            <pre class="p-2.5 bg-amber-50/50 dark:bg-gray-950 border border-amber-200 dark:border-amber-900/50 rounded text-xs font-mono text-gray-800 dark:text-gray-200 overflow-x-auto max-h-48">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
        @endif

        @if($log->new_values)
        <div class="{{ $log->old_values ? '' : 'md:col-span-2' }}">
            <span class="text-xs font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 block mb-1">
                New Values (After Change)
            </span>
            <pre class="p-2.5 bg-emerald-50/50 dark:bg-gray-950 border border-emerald-200 dark:border-emerald-900/50 rounded text-xs font-mono text-gray-800 dark:text-gray-200 overflow-x-auto max-h-48">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
        @endif
    </div>
    @endif
</div>
