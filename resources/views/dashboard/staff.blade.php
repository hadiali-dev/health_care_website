<x-app-layout>
    <x-slot name="header">
        <!-- Clean Single Navigation Bar -->
        <div class="flex items-center justify-between w-full">
            <!-- Brand / Title -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl flex items-center justify-center shadow-md shadow-emerald-600/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-lg text-slate-800 tracking-tight">CareTrack</h2>
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Medical Portal</p>
                </div>
            </div>

            <!-- Center Navigation Tabs -->
            <nav class="flex items-center gap-1 bg-slate-100/80 p-1 rounded-xl border border-slate-200/60">
                <button onclick="switchTab('dashboard')" id="nav-btn-dashboard" class="nav-tab active-tab px-4 py-1.5 text-xs font-bold rounded-lg transition-all duration-200">
                    Dashboard
                </button>
                <button onclick="switchTab('reports')" id="nav-btn-reports" class="nav-tab inactive-tab px-4 py-1.5 text-xs font-bold rounded-lg transition-all duration-200">
                    Reports
                </button>
                <button onclick="switchTab('profile')" id="nav-btn-profile" class="nav-tab inactive-tab px-4 py-1.5 text-xs font-bold rounded-lg transition-all duration-200">
                    Profile
                </button>
            </nav>
        </div>
    </x-slot>

    <!-- Success Toast Alert for AJAX Updates -->
    <div id="toast-notification" class="fixed bottom-5 right-5 z-50 transform translate-y-10 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-slate-900 text-white px-5 py-3 rounded-xl shadow-xl flex items-center gap-3 text-xs font-medium">
            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span id="toast-message">Status updated successfully</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        @if (session('success'))
            <div class="bg-emerald-50/80 border border-emerald-200 p-4 rounded-2xl shadow-sm flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-emerald-900 text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- TAB 1: DASHBOARD (PATIENT DIRECTORY) -->
        <div id="tab-content-dashboard" class="tab-pane active-pane">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-600/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Patient Directory</h3>
                            <p class="text-xs text-slate-500">Manage patient health statuses in real time.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-50 border border-emerald-200/60 rounded-full">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-xs font-semibold text-emerald-700">{{ $patients->total() }} Registered Patients</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead>
                            <tr class="text-slate-400 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100 bg-slate-50/30">
                                <th class="py-3.5 px-6">Patient Information</th>
                                <th class="py-3.5 px-6">Gender</th>
                                <th class="py-3.5 px-6">Health Status</th>
                                <th class="py-3.5 px-6 text-right">Update Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse ($patients as $patient)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                                {{ strtoupper(substr($patient->full_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900">{{ $patient->full_name }}</div>
                                                <div class="text-xs text-slate-500">{{ $patient->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-600 capitalize">
                                            {{ $patient->gender }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6" id="badge-container-{{ $patient->id }}">
                                        @if($patient->health_status === 'healthy')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                Healthy
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                <svg class="w-3.5 h-3.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                Needs Attention
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('patients.update_status', $patient->id) }}" method="POST" class="inline-flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="health_status" 
                                                onchange="updatePatientStatusAjax(event, '{{ route('patients.update_status', $patient->id) }}', '{{ $patient->id }}')" 
                                                class="text-xs font-medium border border-slate-200 rounded-xl bg-slate-50 focus:bg-white focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/20 py-1.5 pl-3 pr-8 cursor-pointer transition-colors">
                                                <option value="healthy" {{ $patient->health_status == 'healthy' ? 'selected' : '' }}>Mark Healthy</option>
                                                <option value="patient" {{ $patient->health_status == 'patient' ? 'selected' : '' }}>Mark Sick</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 px-6 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </div>
                                            <p class="text-slate-600 font-semibold text-sm">No patients registered yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($patients->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $patients->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- TAB 2: REPORTS (DYNAMIC PATIENT REPORTS LIST) -->
        <div id="tab-content-reports" class="tab-pane hidden-pane">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 p-6 md:p-8">
                <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                    <div class="w-12 h-12 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Medical Reports Feed</h3>
                        <p class="text-xs text-slate-500">Submitted patient symptom logs and health updates.</p>
                    </div>
                </div>

                <!-- Display Patient Reports Feed -->
                @if(isset($reports) && count($reports) > 0)
                    <div class="space-y-4">
                        @foreach($reports as $report)
                            <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-200/80 hover:bg-white hover:shadow-md transition-all">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                            {{ strtoupper(substr($report->user->full_name ?? $report->patient_name ?? 'P', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 text-sm">
                                                {{ $report->user->full_name ?? $report->patient_name ?? 'Patient' }}
                                            </div>
                                            <div class="text-xs text-slate-400">
                                                {{ $report->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[11px] font-medium text-slate-400">
                                            {{ isset($report->created_at) ? $report->created_at->diffForHumans() : 'Recently' }}
                                        </span>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Delete this report?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Report">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-3 bg-white p-3.5 rounded-xl border border-slate-200/60 text-xs text-slate-700 leading-relaxed">
                                    {{ $report->report_text ?? $report->message ?? $report->content }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                        <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <p class="text-sm font-semibold text-slate-700">No reports submitted yet.</p>
                        <p class="text-xs text-slate-400 mt-1">When patients submit symptom logs, they will appear right here.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- TAB 3: PROFILE -->
        <div id="tab-content-profile" class="tab-pane hidden-pane">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 p-6 md:p-8 space-y-6">
                <div class="flex items-center gap-4 pb-6 border-b border-slate-100">
                    <div class="w-16 h-16 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shadow-emerald-600/20">
                        {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ Auth::user()->full_name }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-2 px-3 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-md">
                            Medical Staff
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Gender</span>
                        <span class="block text-sm font-semibold text-slate-800 capitalize mt-1">{{ Auth::user()->gender ?? 'N/A' }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Account Type</span>
                        <span class="block text-sm font-semibold text-slate-800 capitalize mt-1">{{ Auth::user()->account_type ?? 'Staff' }}</span>
                    </div>
                </div>

                <!-- Sign Out at bottom of Profile Page -->
                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white font-semibold text-xs rounded-xl shadow-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-pane').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('block');
            });
            document.querySelectorAll('.nav-tab').forEach(el => {
                el.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
                el.classList.add('text-slate-500');
            });

            const targetPane = document.getElementById('tab-content-' + tabName);
            const targetBtn = document.getElementById('nav-btn-' + tabName);

            if (targetPane) {
                targetPane.classList.remove('hidden');
                targetPane.classList.add('block');
            }
            if (targetBtn) {
                targetBtn.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
                targetBtn.classList.remove('text-slate-500');
            }
        }

        async function updatePatientStatusAjax(event, routeUrl, patientId) {
            const selectEl = event.target;
            const newStatus = selectEl.value;
            const badgeContainer = document.getElementById('badge-container-' + patientId);

            try {
                const response = await fetch(routeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    body: JSON.stringify({ health_status: newStatus })
                });

                if (response.ok || response.status === 200 || response.redirected) {
                    if (newStatus === 'healthy') {
                        badgeContainer.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Healthy
                            </span>`;
                    } else {
                        badgeContainer.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <svg class="w-3.5 h-3.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                Needs Attention
                            </span>`;
                    }
                    showToast("Health status updated successfully!");
                }
            } catch (error) {
                showToast("Error updating status.");
            }
        }

        function showToast(message) {
            const toast = document.getElementById('toast-notification');
            document.getElementById('toast-message').innerText = message;
            toast.classList.remove('translate-y-10', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', () => switchTab('dashboard'));
    </script>
</x-app-layout>