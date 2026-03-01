<div id="drawer-navigation" style="z-index: 99999;"
    class="fixed top-0 left-0 h-screen overflow-y-auto transition-transform -translate-x-full bg-white w-80 shadow-2xl"
    tabindex="-1" aria-labelledby="drawer-navigation-label">

    <!-- Header -->
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-indigo-600">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2" />
                    <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2" />
                    <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2" />
                    <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2" />
                </svg>
            </div>
            <span class="font-semibold text-white text-sm">Calculator Online</span>
        </a>

        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
            class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/20 hover:bg-white/30 transition-colors">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Nav Content -->
    <div class="px-3 py-4">

        <!-- Main Links -->
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu</p>
        <ul class="space-y-1 mb-5">
            <li>
                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                    {{ Request::is('/') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ Request::is('/') ? 'bg-indigo-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    Home
                </a>
            </li>

            <li>
                <a href="{{ url('blog') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                    {{ Request::is('blog*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ Request::is('blog*') ? 'bg-indigo-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2zM9 12h6m-6 4h6" />
                        </svg>
                    </span>
                    Blogs
                </a>
            </li>

            <li>
                <a href="{{ url('contact-us') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                    {{ Request::is('contact-us') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">
                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                        {{ Request::is('contact-us') ? 'bg-indigo-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    Contact Us
                </a>
            </li>
        </ul>

        <!-- Divider -->
        <div class="border-t border-gray-100 mb-4"></div>

        <!-- Categories -->
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">All Categories</p>

        @php
            $databaseData = getDatabaseData();

            $categoryIcons = [
                'Health' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>',
                'Math' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
                'Everyday-Life' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>',
                'Finance' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>',
                'Physics' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                'Chemistry' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
                'Statistics' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m6 0V9a2 2 0 00-2-2H7a2 2 0 00-2 2v10m6 0V5a2 2 0 012-2h2a2 2 0 012 2v14m0 0h2"/>',
                'Construction' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                'Pets' =>
                    '<path stroke-linecap="round" stroke-linejoin="round" d="M14 10h.01M10 10h.01M7 14c0 2.21 2.239 4 5 4s5-1.79 5-4M9 7c0 1.105-.448 2-1 2S7 8.105 7 7s.448-2 1-2 1 .895 1 2zm6 0c0 1.105-.448 2-1 2s-1-.895-1-2 .448-2 1-2 1 .895 1 2z"/>',
                'Timedate' =>
                    '<circle cx="12" cy="12" r="9" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3"/>',
            ];

            $defaultIcon =
                '<path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>';
            $currentPath = Request::path();
        @endphp

        <ul class="space-y-1">
            @foreach ($databaseData as $item)
                @php
                    $icon = $categoryIcons[$item->cat_name] ?? $defaultIcon;
                    $slug = Str::lower(str_replace(' ', '-', $item->cat_name));
                    $isActive = $currentPath === $slug || str_starts_with($currentPath, $slug . '/');
                @endphp
                <li>
                    <a href="{{ url($slug) }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                        {{ $isActive ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">

                        <span
                            class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                            {{ $isActive ? 'bg-indigo-100' : 'bg-gray-100' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                {!! $icon !!}
                            </svg>
                        </span>

                        {{ $item->cat_name }}

                        @if ($isActive)
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                        @endif
                    </a>
                </li>
            @endforeach
            {{-- Unit Converter --}}
            @php $isUnitActive = $currentPath === 'unit-converter'; @endphp
            <li>
                <a href="{{ url('unit-converter') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
            {{ $isUnitActive ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600' }}">

                    <span
                        class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                {{ $isUnitActive ? 'bg-indigo-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4M4 17h12m0 0l-4-4m4 4l-4 4" />
                        </svg>
                    </span>

                    Unit Converter

                    @if ($isUnitActive)
                        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    @endif
                </a>
            </li>
        </ul>

        <!-- Divider -->
        <div class="border-t border-gray-100 my-4"></div>

        <!-- Auth Section -->
        {{-- @guest
            <ul class="space-y-1">
                <li>
                    <a href="{{ url('login') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </span>
                        Sign In
                    </a>
                </li>
                <li>
                    <a href="{{ url('register') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-all">
                        <span class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </span>
                        Sign Up
                    </a>
                </li>
            </ul>
        @else
            <!-- Logged In User -->
            <div class="flex items-center gap-3 px-3 py-3 bg-indigo-50 rounded-xl mb-3">
                <img class="w-10 h-10 rounded-full object-cover ring-2 ring-indigo-200"
                    src="{{ asset(Auth::user()->image ? 'avatars/' . Auth::user()->image : 'assets/images/profile_img.png') }}"
                    alt="User Photo">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <ul class="space-y-1">
                <li>
                    <a href="{{ url('profile') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="{{ url('change-password') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                        <span class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        Change Password
                    </a>
                </li>
                <li>
                    <a href="{{ route('logoutuser') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-all">
                        <span class="w-8 h-8 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </span>
                        Sign Out
                    </a>
                </li>
            </ul>
        @endguest --}}

    </div>
</div>
