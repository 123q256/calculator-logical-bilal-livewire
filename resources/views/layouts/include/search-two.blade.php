<div class="w-full">
    <!-- Search Box + Dropdown wrapper -->
    <div id="modal-search-wrapper" class="relative">

        <!-- Search Icon -->
        <svg id="modal-search-icon" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 z-10 cursor-pointer" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
        </svg>

        <input id="modal-search-input"
            type="text"
            class="w-full pl-12 pr-5 py-4 rounded-xl border border-gray-300 bg-white text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-indigo-300 transition shadow-sm"
            placeholder="Search Calculators..."
            autocomplete="off">

        <!-- Dropdown -->
        <div id="modal-search-dropdown" class="absolute top-full left-0 w-full mt-1 z-50 hidden">
            <ul id="modal-search-list" class="max-h-64 overflow-y-auto shadow-md rounded-xl bg-white divide-y divide-gray-100 text-left">
            </ul>
        </div>
    </div>
</div>
