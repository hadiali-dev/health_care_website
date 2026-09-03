<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold tracking-tight text-slate-900">Welcome Back</h2>
        <p class="text-sm text-slate-500 mt-1">Please sign in to access your account</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200/80 flex gap-3 text-left">
            <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-rose-800">Please review the following errors</h3>
                <ul class="mt-1.5 text-xs text-rose-700 list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5">
                Email Address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="name@example.com"
                class="w-full bg-slate-50/50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 block px-3.5 py-2.5 transition-all duration-200 placeholder:text-slate-400">
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-700">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold hover:underline transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required 
                placeholder="••••••••"
                class="w-full bg-slate-50/50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 block px-3.5 py-2.5 transition-all duration-200 placeholder:text-slate-400">
        </div>

    

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" 
                class="w-full inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 active:from-emerald-800 active:to-teal-800 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 font-semibold rounded-xl text-sm px-5 py-3 text-center transition-all duration-200 shadow-md shadow-emerald-600/20 hover:shadow-lg hover:shadow-emerald-600/30">
                <span>Sign In</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </button>
        </div>
        
        <!-- Secondary CTA -->
        <div class="text-center mt-5 pt-4 border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 hover:underline transition-colors">Sign up here</a>
            </p>
        </div>
    </form>
</x-guest-layout>