<x-filament-panels::page>
    @php
        $data = $this->getViewData();
        extract($data);
    @endphp

    <div class="space-y-6">
        {{-- Profile Header Card --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-2xl shadow-inner">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-slate-800">{{ $user->name }}</h2>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200">
                            Cadet / Student Pilot
                        </span>
                        @if($taruna && $taruna->status === 'active')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-500 mt-0.5">{{ $user->email }} &bull; NIM: {{ $taruna?->nim ?? '-' }} &bull; Batch {{ $taruna?->batch ?? '-' }} ({{ $taruna?->angkatan ?? '-' }})</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200/80">
                <div class="text-center">
                    <span class="block text-xs uppercase font-bold text-slate-400">Hours Flown</span>
                    <span class="text-lg font-bold text-slate-800">{{ number_format($totalHours, 1) }} <span class="text-xs font-medium text-slate-500">hrs</span></span>
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="text-center">
                    <span class="block text-xs uppercase font-bold text-slate-400">Quota</span>
                    <span class="text-lg font-bold text-indigo-600">{{ number_format($quotaHours, 1) }} <span class="text-xs font-medium text-slate-500">hrs</span></span>
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="text-center">
                    <span class="block text-xs uppercase font-bold text-slate-400">Progress</span>
                    <span class="text-lg font-bold text-emerald-600">{{ $progressPct }}%</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Cadet Academic & License Info --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Hours Progress Card --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold uppercase text-slate-500 tracking-wider">Flight Training Progress</span>
                        <span class="text-sm font-bold text-indigo-600">{{ number_format($totalHours, 1) }} / {{ number_format($quotaHours, 1) }} Hours ({{ $progressPct }}%)</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-500" style="width: {{ $progressPct }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-slate-500 mt-2">
                        <span>Remaining Quota: <strong>{{ number_format(max(0, $quotaHours - $totalHours), 1) }} hrs</strong></span>
                        <span>Max Daily: <strong>{{ number_format($taruna?->max_jam_terbang_harian ?? 4, 1) }} hrs/day</strong></span>
                    </div>
                </div>

                {{-- Detail Data Diri & Contact --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                    <div class="border-b border-slate-100 pb-4 mb-5">
                        <h3 class="text-base font-bold text-slate-800">Cadet Profile &amp; Program</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Academic program, assigned modules, and contact details</p>
                    </div>

                    <form wire:submit="save" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Program Studi</label>
                                <input type="text" disabled value="{{ $taruna?->program_study ?? 'Penerbang Sayap Tetap' }}"
                                    class="w-full text-sm bg-slate-100 border border-slate-200 rounded-xl px-3 py-2 text-slate-600 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Batch / Angkatan</label>
                                <input type="text" disabled value="Batch {{ $taruna?->batch ?? '-' }} &bull; Angkatan {{ $taruna?->angkatan ?? '-' }}"
                                    class="w-full text-sm bg-slate-100 border border-slate-200 rounded-xl px-3 py-2 text-slate-600 cursor-not-allowed">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Training Modules</label>
                                <input type="text" disabled value="{{ $taruna?->modul_penerbangan ?? 'PPL, CPL, IR' }}"
                                    class="w-full text-sm bg-slate-100 border border-slate-200 rounded-xl px-3 py-2 text-slate-600 cursor-not-allowed">
                                <span class="text-[11px] text-slate-400 mt-1 block">Configured by Head of Operations</span>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Phone Number (WhatsApp)</label>
                                <input type="text" wire:model="no_telepon" placeholder="e.g. 081234567890"
                                    class="w-full text-sm bg-white border border-slate-300 rounded-xl px-3 py-2 text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('no_telepon') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Save Contact Info
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- My Recent Schedules Card --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                <div class="border-b border-slate-100 pb-4 mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">My Schedules</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Upcoming training flights</p>
                    </div>
                    <a href="{{ route('filament.admin.resources.flight-schedules.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">
                        View All
                    </a>
                </div>

                @if($recentFlights->isNotEmpty())
                    <div class="divide-y divide-slate-100">
                        @foreach($recentFlights as $flight)
                            <div class="py-3 flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-mono font-bold text-indigo-600">{{ $flight->kode_jadwal }}</span>
                                        <span class="text-[11px] px-2 py-0.5 rounded-full font-semibold {{ $flight->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : 'bg-indigo-50 text-indigo-700' }}">
                                            {{ ucfirst($flight->status) }}
                                        </span>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-800 mt-1">
                                        Instructor: {{ $flight->instruktur?->nama ?? 'N/A' }}
                                    </p>
                                    <p class="text-[11px] text-slate-500">
                                        {{ \Carbon\Carbon::parse($flight->tanggal)->format('d M Y') }} &bull; {{ substr($flight->jam_mulai, 0, 5) }} - {{ substr($flight->jam_selesai, 0, 5) }}
                                    </p>
                                </div>
                                <div class="text-right text-xs">
                                    <span class="font-bold text-slate-700">{{ $flight->pesawat?->call_sign ?? '-' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-slate-400 text-xs">
                        No flight schedules assigned yet.
                    </div>
                @endif

                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('filament.admin.resources.reschedule-requests.create') }}"
                        class="w-full text-center block px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition">
                        Request Schedule Reschedule
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
