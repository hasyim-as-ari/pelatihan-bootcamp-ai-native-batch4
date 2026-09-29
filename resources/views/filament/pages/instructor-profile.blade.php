<x-filament-panels::page>
    @php
        $data = $this->getViewData();
        extract($data);
    @endphp

    <div class="space-y-6">
        {{-- Profile Header Card --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-2xl shadow-inner">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-slate-800">{{ $user->name }}</h2>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            Flight Instructor
                        </span>
                        @if($instruktur && $instruktur->status === 'aktif')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        @endif
                    </div>
                    <p class="text-sm text-slate-500 mt-0.5">{{ $user->email }} &bull; NIDN: {{ $instruktur?->nidn ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 bg-slate-50 px-4 py-2.5 rounded-xl border border-slate-200/80">
                <div class="text-center">
                    <span class="block text-xs uppercase font-bold text-slate-400">Total Hours</span>
                    <span class="text-lg font-bold text-slate-800">{{ number_format($totalTeachingHours ?: ($instruktur?->total_jam_terbang ?? 0), 1) }} <span class="text-xs font-medium text-slate-500">hrs</span></span>
                </div>
                <div class="h-8 w-px bg-slate-200"></div>
                <div class="text-center">
                    <span class="block text-xs uppercase font-bold text-slate-400">Max Daily</span>
                    <span class="text-lg font-bold text-blue-600">{{ number_format($instruktur?->max_jam_terbang_harian ?? 6, 1) }} <span class="text-xs font-medium text-slate-500">hrs</span></span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Availability & Contact Settings Form --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                <div class="border-b border-slate-100 pb-4 mb-5">
                    <h3 class="text-base font-bold text-slate-800">Instructor Availability & Contact</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Manage your daily flight capacity and contact information</p>
                </div>

                <form wire:submit="save" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Licenses & Ratings</label>
                            <input type="text" disabled value="{{ $instruktur?->lisensi ?? 'CPL, IR, FI' }}"
                                class="w-full text-sm bg-slate-100 border border-slate-200 rounded-xl px-3 py-2 text-slate-600 cursor-not-allowed">
                            <span class="text-[11px] text-slate-400 mt-1 block">Managed by Super Admin / Operations</span>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Phone Number</label>
                            <input type="text" wire:model="no_telepon" placeholder="e.g. 08123456789"
                                class="w-full text-sm bg-white border border-slate-300 rounded-xl px-3 py-2 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('no_telepon') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Max Daily Flight Hours (Hours/Day)</label>
                            <input type="number" step="0.5" min="1" max="12" wire:model="max_jam_terbang_harian"
                                class="w-full text-sm bg-white border border-slate-300 rounded-xl px-3 py-2 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <span class="text-[11px] text-slate-400 mt-1 block">Maximum teaching sorties duration per day</span>
                            @error('max_jam_terbang_harian') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Availability Notes / Standby Status</label>
                            <textarea wire:model="catatan" rows="3" placeholder="Notes on availability or duty preferences..."
                                class="w-full text-sm bg-white border border-slate-300 rounded-xl px-3 py-2 text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            @error('catatan') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-3">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Availability Settings
                        </button>
                    </div>
                </form>
            </div>

            {{-- Recent Flight Schedules --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                <div class="border-b border-slate-100 pb-4 mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">My Flight Schedules</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Assigned flight missions</p>
                    </div>
                    <a href="{{ route('filament.admin.resources.flight-schedules.index') }}" class="text-xs font-bold text-blue-600 hover:underline">
                        View All
                    </a>
                </div>

                @if($recentFlights->isNotEmpty())
                    <div class="divide-y divide-slate-100">
                        @foreach($recentFlights as $flight)
                            <div class="py-3 flex items-start justify-between gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-mono font-bold text-blue-600">{{ $flight->kode_jadwal }}</span>
                                        <span class="text-[11px] px-2 py-0.5 rounded-full font-semibold {{ $flight->status === 'completed' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700' }}">
                                            {{ ucfirst($flight->status) }}
                                        </span>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-800 mt-1">
                                        Cadet: {{ $flight->taruna?->nama ?? 'N/A' }}
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
                        No upcoming schedules found.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>
