<div>
    <div x-data="{
        open: false,
        @entangle('showSuggestions'),
        close() {
            this.open = false;
            $wire.hideSuggestions();
        }
    }" class="w-full">

        <!-- Search Box + Dropdown wrapper -->
        <div class="relative" x-on:click.away="close()">

            <!-- Search Icon -->
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 z-10" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
            </svg>

            <!-- Clear Button -->
            @if ($search)
                <button wire:click="clearSearch"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-10 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            @endif

            <input
                wire:model.live.debounce.300ms="search"
                wire:keydown.arrow-up.prevent="moveHighlight('up')"
                wire:keydown.arrow-down.prevent="moveHighlight('down')"
                wire:keydown.enter.prevent="selectCalculator"
                wire:focus="$set('showSuggestions', true)"
                type="text"
                class="w-full pl-12 {{ $search ? 'pr-10' : 'pr-5' }} py-4 rounded-xl border border-gray-300 bg-white text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-indigo-300 transition shadow-sm"
                placeholder="Search Calculators..."
                autocomplete="off"
                x-on:focus="open = true">

            <!-- Dropdown -->
            <div x-show="open" class="absolute top-full left-0 w-full mt-1 z-50" x-cloak>
                <ul class="max-h-64 overflow-y-auto shadow-md rounded-xl bg-white divide-y divide-gray-100 text-left">
                    @forelse($suggestions as $index => $calculator)
                        <li wire:key="calc-{{ $index }}"
                            class="{{ $highlightIndex === $index ? 'bg-indigo-50' : 'hover:bg-gray-50' }} flex justify-between items-center"
                            wire:mouseover="$set('highlightIndex', {{ $index }})">
                            <a href="/{{ $calculator[1] }}"
                                class="block py-2.5 px-4 cursor-pointer flex-grow text-sm text-gray-700"
                                wire:click.prevent="selectCalculator({{ $index }})">
                                {!! $this->highlight($calculator[0]) !!}
                            </a>
                            <span class="text-xs text-gray-400 pr-4 whitespace-nowrap">{{ $calculator[2] ?? '' }}</span>
                        </li>
                    @empty
                        @if($search)
                            <li class="py-3 px-4 text-gray-500 italic text-sm">
                                No results found for "{{ $search }}"
                            </li>
                        @endif
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</div>