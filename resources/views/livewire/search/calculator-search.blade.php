<div id="heroParts">
    <!-- HERO -->
    <section class="hero-bg py-12 sm:py-12 text-center">
       <div x-data="{
    open: false,
    @entangle('showSuggestions'),
    close() {
        this.open = false;
        $wire.hideSuggestions();
    }
}" class="w-full mx-auto">
            <div class="max-w-3xl mx-auto px-6">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
                    Find the Right Calculator in Seconds
                </h1>
                <p class="text-gray-500 text-[14px] mb-10">
                    Access over 500 specialized calculators designed to make your
                    everyday calculations faster and more accurate.
                </p>

                <!-- Search Box + Dropdown wrapper -->
               <div class="relative max-w-xl mx-auto" x-on:click.away="close()">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 z-10" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                    <input wire:model.live="search"
                        wire:keydown.arrow-up.prevent="moveHighlight('up')"
                        wire:keydown.arrow-down.prevent="moveHighlight('down')"
                        wire:keydown.enter.prevent="selectCalculator"
                        wire:focus="$set('showSuggestions', true)"
                        type="text"
                        class="w-full pl-12 pr-5 py-4 rounded-xl border border-gray-300 bg-white text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-indigo-300 transition shadow-sm"
                        placeholder="Search Calculators..."
                        x-on:focus="open = true">

                    <!-- Dropdown -->
                    <div x-show="open" class="absolute top-full left-0 w-full mt-1 z-50" x-cloak>
                        <ul class="suggestion max-h-64 overflow-y-auto shadow-md rounded-xl bg-white border-transparent divide-y divide-gray-100 text-left">
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
        </div>

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </section>
</div>