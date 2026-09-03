<x-app-layout>
    <x-slot name="header">
        <!-- Include Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        
        <!-- Header Bar with Brand Logo & Hamburger Menu Only -->
        <div class="flex items-center justify-between w-full">
            <!-- Brand / Title -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl flex items-center justify-center shadow-md shadow-emerald-600/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-lg text-slate-800 tracking-tight">Patient Portal</h2>
                    <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Health Monitoring</p>
                </div>
            </div>

            <!-- Hamburger Menu Button (3 Lines Only) -->
            <button onclick="toggleSidebar(true)" aria-label="Open Navigation Menu" class="p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/20 flex items-center gap-2">
                <span class="text-xs font-bold text-slate-600 hidden sm:inline-block">Menu</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </x-slot>

    <!-- Slide-Out Sidebar Drawer -->
    <div id="sidebar-overlay" onclick="toggleSidebar(false)" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 opacity-0 pointer-events-none transition-opacity duration-300"></div>
    <aside id="sidebar-drawer" class="fixed top-0 right-0 h-full w-72 bg-white z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between p-6">
        <div>
            <!-- Drawer Header -->
            <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white font-extrabold text-xs">
                        CT
                    </div>
                    <span class="font-bold text-slate-900 text-sm">Navigation Menu</span>
                </div>
                <button onclick="toggleSidebar(false)" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Drawer Links -->
            <div class="mt-6 space-y-2">
                <button onclick="switchTab('dashboard'); toggleSidebar(false);" id="drawer-btn-dashboard" class="drawer-link w-full text-left px-4 py-3 rounded-xl font-semibold text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard</span>
                </button>
                <button onclick="switchTab('reports'); toggleSidebar(false);" id="drawer-btn-reports" class="drawer-link w-full text-left px-4 py-3 rounded-xl font-semibold text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Reports</span>
                </button>
                <button onclick="switchTab('profile'); toggleSidebar(false);" id="drawer-btn-profile" class="drawer-link w-full text-left px-4 py-3 rounded-xl font-semibold text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profile</span>
                </button>
            </div>
        </div>

        <!-- Logout at bottom of Sidebar -->
        <div class="pt-6 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-3 bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        @if (session('success'))
            <div class="bg-emerald-50/80 border border-emerald-200 p-4 rounded-2xl shadow-sm flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-emerald-900 text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- TAB 1: DASHBOARD (MAP & ALERTS) -->
        <div id="tab-content-dashboard" class="tab-pane active-pane space-y-6">
            <!-- Warning Alert -->
            <div id="nearby-alert" class="hidden bg-amber-50/90 border border-amber-200 p-4 rounded-2xl shadow-sm items-start gap-3">
                <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h3 class="text-amber-900 text-sm font-bold">Health Warning Alert</h3>
                    <p id="nearby-message" class="text-amber-800 text-xs mt-0.5"></p>
                </div>
            </div>

            <!-- The Map Card -->
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-tr from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Nearby Patients Map</h3>
                                <p class="text-xs text-slate-500">Checking for active health alerts within 200 meters.</p>
                            </div>
                        </div>
                        <button onclick="fetchLocation()" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span>Refresh GPS</span>
                        </button>
                    </div>

                    <!-- Map Container -->
                    <div class="relative w-full h-[420px] bg-slate-100 rounded-xl border border-slate-200 overflow-hidden">
                        <!-- Loading Overlay -->
                        <div id="map-loading" class="absolute inset-0 bg-white/95 backdrop-blur-sm z-[1000] flex flex-col items-center justify-center transition-opacity">
                            <div class="w-12 h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin mb-3"></div>
                            <span id="loading-text" class="text-slate-600 text-xs font-semibold">Acquiring GPS Signal...</span>
                        </div>
                        <!-- Leaflet Map Canvas -->
                        <div id="map" class="w-full h-full z-0"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: REPORTS CONTENT -->
        <div id="tab-content-reports" class="tab-pane hidden-pane">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
                        <div class="w-12 h-12 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">How are you feeling today?</h3>
                            <p class="text-xs text-slate-500">Submit a health report directly to your assigned medical staff.</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('reports.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="report_text" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                                Health Notes &amp; Symptoms
                            </label>
                            <textarea id="report_text" name="report_text" rows="5" required 
                                placeholder="Describe your symptoms, pain levels, medication reactions, or any health concerns..."
                                class="w-full bg-slate-50/50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 block p-4 transition-all duration-200 placeholder:text-slate-400"></textarea>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="submit" 
                                class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 font-semibold rounded-xl text-xs px-6 py-3 text-center transition-all duration-200 shadow-md shadow-emerald-600/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                <span>Submit Report</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- TAB 3: PROFILE CONTENT -->
        <div id="tab-content-profile" class="tab-pane hidden-pane">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-900/5 border border-slate-200/80 p-6 md:p-8 space-y-6">
                <!-- User Details Card -->
                <div class="flex items-center gap-4 pb-6 border-b border-slate-100">
                    <div class="w-16 h-16 bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shadow-emerald-600/20">
                        {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ Auth::user()->full_name }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-2 px-3 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-md">
                            Patient Account
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Gender</span>
                        <span class="block text-sm font-semibold text-slate-800 capitalize mt-1">{{ Auth::user()->gender ?? 'N/A' }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Current Health Status</span>
                        <span class="block text-sm font-semibold capitalize mt-1 {{ Auth::user()->health_status === 'healthy' ? 'text-emerald-600' : 'text-amber-600' }}">
                            {{ Auth::user()->health_status ?? 'Healthy' }}
                        </span>
                    </div>
                </div>

                <!-- LOGOUT BUTTON AT BOTTOM OF PROFILE PAGE -->
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

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
        // Toggle Sidebar Drawer
        function toggleSidebar(show) {
            const sidebar = document.getElementById('sidebar-drawer');
            const overlay = document.getElementById('sidebar-overlay');
            if (show) {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                sidebar.classList.remove('translate-x-full');
            } else {
                overlay.classList.add('opacity-0', 'pointer-events-none');
                sidebar.classList.add('translate-x-full');
            }
        }

        // Switch Tabs dynamically
        function switchTab(tabName) {
            document.querySelectorAll('.tab-pane').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('block');
            });
            document.querySelectorAll('.drawer-link').forEach(el => {
                el.classList.remove('bg-emerald-50', 'text-emerald-700', 'font-bold');
                el.classList.add('text-slate-700');
            });

            const targetPane = document.getElementById('tab-content-' + tabName);
            const targetDrawerBtn = document.getElementById('drawer-btn-' + tabName);

            if (targetPane) {
                targetPane.classList.remove('hidden');
                targetPane.classList.add('block');
            }
            if (targetDrawerBtn) {
                targetDrawerBtn.classList.add('bg-emerald-50', 'text-emerald-700', 'font-bold');
                targetDrawerBtn.classList.remove('text-slate-700');
            }

            // Invalidate Map size if user switches to Dashboard map
            if (tabName === 'dashboard' && map) {
                setTimeout(() => map.invalidateSize(), 200);
            }
        }

        let map = null;
        let markers = [];

        const sickIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        const userIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        function fetchLocation() {
            const loadingText = document.getElementById('loading-text');
            const loadingOverlay = document.getElementById('map-loading');
            
            if (loadingOverlay) loadingOverlay.style.display = 'flex';
            if (loadingText) loadingText.innerText = 'Acquiring GPS Signal...';

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    position => sendPositionToServer(position), 
                    showError, 
                    { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
                );
            } else {
                if (loadingText) {
                    loadingText.innerText = "Geolocation is not supported by this browser.";
                    loadingText.classList.add('text-rose-500');
                }
            }
        }

        async function sendPositionToServer(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const loadingText = document.getElementById('loading-text');

            if (loadingText) loadingText.innerText = `Lat: ${lat.toFixed(5)}, Lng: ${lng.toFixed(5)} - Sending...`;

            try {
                const response = await fetch("{{ route('map.nearby') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ latitude: lat, longitude: lng })
                });

                const data = await response.json();
                
                if (data.status === 'success') {
                    renderMap(lat, lng, data.nearby_patients);
                }
            } catch (error) {
                if (loadingText) {
                    loadingText.innerText = "Error connecting to secure server.";
                    loadingText.classList.add('text-rose-500');
                }
            }
        }

        function renderMap(lat, lng, nearbyPatients) {
            const overlay = document.getElementById('map-loading');
            if (overlay) overlay.style.display = 'none';

            if (!map) {
                map = L.map('map').setView([lat, lng], 16);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);
            } else {
                map.setView([lat, lng], 16);
                markers.forEach(marker => map.removeLayer(marker));
                markers = [];
            }

            const userMarker = L.marker([lat, lng], {icon: userIcon}).addTo(map)
                .bindPopup('<b>You are here</b><br>Your exact location')
                .openPopup();
            
            markers.push(userMarker);

            const alertBox = document.getElementById('nearby-alert');
            const alertMsg = document.getElementById('nearby-message');

            if (nearbyPatients.length > 0) {
                if (alertBox) {
                    alertBox.classList.remove('hidden');
                    alertBox.classList.add('flex');
                }
                if (alertMsg) alertMsg.innerText = `Warning: There are ${nearbyPatients.length} sick patient(s) within 200 meters of your location!`;

                nearbyPatients.forEach(patient => {
                    const patientMarker = L.marker([patient.latitude, patient.longitude], {icon: sickIcon})
                        .addTo(map)
                        .bindPopup(`<b>Health Alert</b><br>Sick patient<br>Distance: ${Math.round(patient.distance)}m away`);
                    markers.push(patientMarker);
                });

            } else {
                if (alertBox) {
                    alertBox.classList.add('hidden');
                    alertBox.classList.remove('flex');
                }
            }
        }

        function showError(error) {
            const loadingText = document.getElementById('loading-text');
            if (!loadingText) return;

            loadingText.classList.add('text-rose-500');
            
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    loadingText.innerText = "Location permission denied. Please allow location access.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    loadingText.innerText = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    loadingText.innerText = "The request timed out.";
                    break;
                default:
                    loadingText.innerText = "An unknown error occurred.";
                    break;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            switchTab('dashboard');
            fetchLocation();
        });
        window.addEventListener('pageshow', fetchLocation);
    </script>
</x-app-layout>