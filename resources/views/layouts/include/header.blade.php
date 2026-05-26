  <!-- NAVBAR -->
  <header class="bg-gradient-to-r from-blue-700 to-blue-500 text-white top-0 shadow-md" style="z-index: 99;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
      <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
          <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/>
            <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/>
            <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/>
            <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/>
          </svg>
        </div>
        <span class="font-semibold text-white text-sm">Calculator Online</span>
      </div>
      </a>
      <!-- Desktop Nav Links -->
      <nav class="hidden md:flex items-center gap-7 text-sm text-blue-50 font-medium">
        <a href="{{ url('/') }}" class="text-white">Home</a>
        <div class="relative" id="cat-dropdown-wrap">
          <button onclick="toggleCatDropdown()" class="flex items-center gap-1 text-white focus:outline-none">
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
        <a href="{{ url('blog') }}" class="text-white">Blogs</a>
        <a href="{{ url('contact-us') }}" class="text-white">Contact Us</a>
      </nav>
      <!-- Desktop Actions -->
      <div class="hidden md:flex items-center gap-2">
         <button class="flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full backdrop-blur-md transition-all duration-300 shadow-sm hover:shadow-md group open-modal">
          <svg class="w-4 h-4 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
          </svg>
          <span class="text-sm font-medium text-white/90 group-hover:text-white">Search...</span>
          <span class="hidden lg:flex items-center justify-center px-1.5 py-0.5 rounded border border-white/30 text-[10px] text-white/70 ml-2 font-mono">⌘K</span>
        </button>
      </div>
      <!-- Mobile: Search icon + Hamburger -->
      <div class="flex md:hidden items-center gap-2">
        <button class="p-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full backdrop-blur-md transition-all duration-300 shadow-sm active:scale-95 open-modal" id="scrollToTopBtn">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
          </svg>
        </button>
        <button id="hamburger-btn" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                 aria-controls="drawer-navigation" class="p-2 rounded-lg hover:bg-white/10">
          <svg id="hamburger-icon" class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg id="close-icon" class="w-5 h-5 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
    @include('layouts.include.drawer-navigation')
  </header>
