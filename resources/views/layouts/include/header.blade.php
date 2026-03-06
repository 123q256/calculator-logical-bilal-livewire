  <!-- NAVBAR -->
  <header class="border-b border-gray-200 bg-white sticky top-0" style="z-index: 99;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
      <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
          <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/>
            <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/>
            <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/>
            <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/>
          </svg>
        </div>
        <span class="font-semibold text-gray-900 text-sm">Calculator Online</span>
      </div>
      </a>
      <!-- Desktop Nav Links -->
      <nav class="hidden md:flex items-center gap-7 text-sm text-gray-600 font-medium">
        <a href="{{ url('/') }}" class="hover:text-gray-900 transition-colors">Home</a>
        <div class="relative" id="cat-dropdown-wrap">
          <button onclick="toggleCatDropdown()" class="flex items-center gap-1 hover:text-gray-900 transition-colors focus:outline-none">
            Categories
            <svg id="cat-chevron" class="w-3.5 h-3.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <!-- Dropdown -->
          <div id="cat-dropdown"
            class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-gray-200 py-2 z-50 hidden">
            <!-- Arrow pointer -->
            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-l border-t border-gray-200 rotate-45"></div>
              @include('layouts.include.sub_menu')
          </div>
        </div>
        <a href="{{ url('blog') }}" class="hover:text-gray-900 transition-colors {{ Request::is('blog*') ? 'active-tags' : '' }}">Blogs</a>
        <a href="{{ url('contact-us') }}" class="hover:text-gray-900 transition-colors {{ Request::is('contact-us') ? 'active-tags' : '' }} ">Contact Us</a>
      </nav>
      <!-- Desktop Actions -->
      <div class="hidden md:flex items-center gap-2">
     
         <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors open-modal">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
          </svg>
        </button>
      </div>
      <!-- Mobile: Search icon + Hamburger -->
      <div class="flex md:hidden items-center gap-2">
        <button class="p-2 rounded-lg hover:bg-gray-100 transition-colors open-modal" id="scrollToTopBtn">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
          </svg>
        </button>
        <button id="hamburger-btn" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                 aria-controls="drawer-navigation" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
          <svg id="hamburger-icon" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg id="close-icon" class="w-5 h-5 text-gray-700 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
    @include('layouts.include.drawer-navigation')
  </header>
