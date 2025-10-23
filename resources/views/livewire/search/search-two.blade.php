<div>
    <!-- Search Bar -->
    <div
        class="flex items-center bg-white border border-gray-300 shadow-sm rounded-full pr-5 pl-3 py-2 focus-within:ring-2 focus-within:ring-blue-500 transition-all duration-200 relative">
        <input id="searchInput" wire:model.live.debounce.300ms="search" wire:keydown.arrow-up.prevent="moveHighlight('up')"
            wire:keydown.arrow-down.prevent="moveHighlight('down')" wire:keydown.enter.prevent="selectCalculator"
            wire:focus="$set('showSuggestions', true)" wire:click="$set('showSuggestions', true)" type="text"
            class="flex-1 bg-transparent text-gray-800 placeholder-gray-400 focus:outline-none text-sm border-none"
            placeholder="Search Calculators..." autocomplete="off">

        @if ($search)
            <button wire:click="clearSearch" class="mr-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        @endif

        <img src="{{ asset('assets/images/svgs/search.svg') }}"
            class="w-5 h-5 text-gray-500 hover:text-blue-500 transition-colors" alt="search" title="search" />
    </div>

    <!-- Suggestions -->
    @if ($showSuggestions)
        <div class="relative mt-1">
            <ul
                class="absolute w-full max-h-64 overflow-y-auto shadow-lg rounded-lg bg-white z-50 divide-y divide-gray-100">
                @forelse($suggestions as $index => $calculator)
                    <li wire:key="calc-{{ $index }}"
                        class="{{ $highlightIndex === $index ? 'bg-blue-50' : 'hover:bg-gray-50' }} px-4 py-3 cursor-pointer flex items-center justify-between"
                        wire:mouseover="$set('highlightIndex', {{ $index }})"
                        wire:click="selectCalculator({{ $index }})">
                        <div>
                            <div class="font-medium text-gray-900">
                                {!! $this->highlight($calculator[0]) !!}
                            </div>

                        </div>
                        @if (!empty($calculator[2]))
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $calculator[2] }}
                            </div>
                        @endif

                    </li>
                @empty
                    <li class="px-4 py-3 text-gray-500">
                        No results found for "{{ $search }}"
                    </li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
