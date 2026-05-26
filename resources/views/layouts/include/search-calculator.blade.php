<div id="heroParts">
    <!-- HERO -->
    <section class="hero-bg py-12 sm:py-12 text-center">
        <div class="w-full mx-auto">
            <div class="max-w-3xl mx-auto px-6">
                <h1 class="text-2xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
                    Find the Right Calculator in Seconds
                </h1>
                <p class="text-gray-500 text-[18px] mb-10">
                    Access over 500 specialized calculators designed to make your
                    everyday calculations faster and more accurate.
                </p>

                <!-- Search Box + Dropdown wrapper -->
                <div id="hero-search-wrapper" class="relative max-w-xl mx-auto">
                    <!-- Search Icon -->
                    <svg id="hero-search-icon"
                         class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 z-10 cursor-pointer"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>

                    <!-- Input -->
                    <input id="hero-search-input"
                           type="text"
                           autocomplete="off"
                           class="w-full pl-12 pr-5 py-4 rounded-xl border border-gray-300 bg-white text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-indigo-300 transition shadow-sm"
                           placeholder="Search Calculators...">

                    <!-- Dropdown -->
                    <div id="hero-search-dropdown" class="absolute top-full left-0 w-full mt-1 z-50 hidden">
                        <ul id="hero-search-list"
                            class="suggestion max-h-64 overflow-y-auto shadow-md rounded-xl bg-white border-transparent divide-y divide-gray-100 text-left">
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
