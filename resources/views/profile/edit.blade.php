<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-800">My Profile</h2>
                <p class="text-sm text-violet-600">Manage your account settings</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6 pb-12">
        
        <!-- Profile Information -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-violet-500/10 border border-violet-100/50 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-gray-100 bg-gradient-to-r from-violet-50/50 to-purple-50/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-violet-400 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg shadow-violet-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Profile Information</h3>
                        <p class="text-sm text-gray-500">Update your personal details.</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-teal-500/10 border border-teal-100/50 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-gray-100 bg-gradient-to-r from-teal-50/50 to-emerald-50/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-teal-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Update Password</h3>
                        <p class="text-sm text-gray-500">Ensure your account is secure.</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-red-500/10 border border-red-100/50 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-gray-100 bg-gradient-to-r from-red-50/50 to-orange-50/50">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg shadow-red-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Delete Account</h3>
                        <p class="text-sm text-gray-500">Permanently delete your account and data.</p>
                    </div>
                </div>
            </div>
            <div class="p-6 md:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
