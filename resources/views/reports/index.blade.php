<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-800">Patient Reports</h2>
                <p class="text-sm text-amber-600">Review incoming health reports</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        @if (session('success'))
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-sm flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($reports as $report)
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-200 p-6 flex flex-col md:flex-row gap-4 justify-between items-start">
                    <div class="flex items-start gap-4 w-full">
                        <!-- Avatar -->
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center font-bold text-white text-lg shadow-md shrink-0">
                            {{ substr($report->user->full_name, 0, 1) }}
                        </div>
                        
                        <div class="w-full">
                            <div class="flex flex-col md:flex-row md:items-center justify-between mb-2 w-full gap-2">
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $report->user->full_name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $report->user->email }}</p>
                                </div>
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-gray-400 bg-gray-100 px-3 py-1.5 rounded-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $report->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <div class="bg-gradient-to-br from-gray-50 to-slate-50 p-4 rounded-xl border border-gray-100 text-sm text-gray-700 leading-relaxed whitespace-pre-line mt-3">
                                {{ $report->report_text }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delete Button -->
                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Permanently delete this report?');" class="shrink-0 pt-1 md:pt-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200" title="Delete Report">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete
                        </button>
                    </form>
                </div>
            @empty
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-gray-100 shadow-sm p-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 mb-6">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">All Caught Up!</h3>
                    <p class="text-gray-500 mt-2">No health reports require your attention at this time.</p>
                </div>
            @endforelse
        </div>

        @if ($reports->hasPages())
            <div class="pt-4">
                {{ $reports->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
