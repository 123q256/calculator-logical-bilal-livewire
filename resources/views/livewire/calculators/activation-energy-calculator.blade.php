<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Temperature --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['1'] ?? 'Temperature' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="temperature" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('tempUnit_dropdown')">
                                {{ $tempUnit }} ▾
                            </label>
                            @if ($showDropdown === 'tempUnit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('tempUnit', 'celsius')">{!! $lang['2'] ?? 'Celsius' !!}</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('tempUnit', 'fahrenheit')">{!! $lang['3'] ?? 'Fahrenheit' !!}</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('tempUnit', 'kelvin')">{!! $lang['4'] ?? 'Kelvin' !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Reaction Rate (k) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['5'] ?? 'Reaction Rate' }} [k]:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="rate" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('rateUnits_dropdown')">
                                {{ $rateUnits }} ▾
                            </label>
                            @if ($showDropdown === 'rateUnits_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-y-auto">
                                    @foreach (["sec", "min", "hour", "day", "week", "month", "year"] as $u)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('rateUnits', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Frequency Factor (A) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['13'] ?? 'Frequency Factor' }} [A]:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="const" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('constUnits_dropdown')">
                                {{ $constUnits }} ▾
                            </label>
                            @if ($showDropdown === 'constUnits_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-y-auto">
                                    @foreach (["sec", "min", "hour", "day", "week", "month", "year"] as $u)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('constUnits', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center items-center space-x-4 mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr>
        @if($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                  <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-5">
                    <div class="w-full">
                        <p><strong>{!! $lang['14'] !!} (Ea)</strong></p>
                        <p><strong class="text-green-600 text-[32px] mt-3">{!! round($detail['res'],3) !!} KJ</strong></p>
                        <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['15'] !!}</strong></p>
                                <p>{!! round($detail['joule'],2) !!}</p>
                            </div>
                            <div class="border-r-4  hidden d-md-block mt-3">&nbsp;</div>
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['16'] !!}</strong></p>
                                <p>{!! round($detail['megajoule'],2) !!}</p>
                            </div>
                            <div class="border-r-4  hidden d-md-block mt-3">&nbsp;</div>
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['17'] !!}</strong></p>
                                <p>{!! round($detail['calories'],2) !!}</p>
                            </div>
                            <div class="border-r-4  hidden d-md-block mt-3">&nbsp;</div>
                            <div class="mt-3 border-r-4 ">
                                <p><strong>{!! $lang['18'] !!}</strong></p>
                                <p>{!! round($detail['kilocalories'],2) !!}</p>
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            <p class="mt-3"><strong>{!! $lang['19'] !!}</strong></p>
                            <p class="mt-2">{!! $lang['1'] !!} = {!! round($detail['temperature'],2) !!}</p>
                            <p class="mt-2">{!! $lang['5'] !!} = {!! $detail['rate'] !!}</p>
                            <p class="mt-2">{!! $lang['13'] !!} = {!! $detail['const'] !!}</p>
                            <p class="mt-3"><strong>{!! $lang['20'] !!}</strong></p>
                            <p class="mt-2">Ea = {!! $lang['14'] !!}</p>
                            <p class="mt-2">R = {!! $lang['15'] !!} (-0.008314) J/(K⋅mol)</p>
                            <p class="mt-2">T = {!! $lang['22'] !!}</p>
                            <p class="mt-2">k = {!! $lang['23'] !!}</p>
                            <p class="mt-2">A = {!! $lang['25'] !!}</p>
                            <p class="mt-3"><strong>{!! $lang['26'] !!}</strong></p>
                            <p class="mt-2">Ea = -R * T * ln(k / A)</p>
                            <p class="mt-2">Ea = -0.008314 * {!! round($detail['temperature'],2) !!} * ln({!! $detail['rate'] !!} / {!! $detail['const'] !!})</p>
                            <p class="mt-2">Ea = ({!! -0.008314 * $detail['temperature'] !!}) * (ln({!! $detail['rate'] / $detail['const'] !!}))</p>
                            <p class="mt-2">Ea = ({!! -0.008314 * $detail['temperature'] !!}) * ({!! $detail['log'] !!})</p>
                            <p class="mt-2">Ea = {!! round(-0.008314 * $detail['temperature'] * $detail['log'],3) !!} KJ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endif
    </form>

    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
                "HTML-CSS": { linebreaks: { automatic: true }, scale: 100 },
                "CommonHTML": { linebreaks: { automatic: true } },
                tex2jax: { inlineMath: [['$', '$'], ['\\(', '\\)']] }
            });
        </script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('result-updated', (event) => {
                    setTimeout(() => {
                        if (window.MathJax) {
                            MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                        }
                    }, 100);
                });
            });
        </script>
    @endpush
</div>
