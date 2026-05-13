<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Enthalpy --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['1'] ?? 'Enthalpy' !!} :</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="enthalpy" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('enthalpy_dropdown')">
                                {{ $enthalpy_units }} ▾
                            </label>
                            @if ($showDropdown === 'enthalpy_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('enthalpy_units', 'J')">J</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('enthalpy_units', 'KJ')">KJ</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('enthalpy_units', 'cal')">cal</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('enthalpy_units', 'kcal')">kcal</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Entropy --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['2'] ?? 'Entropy' !!} :</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="entropy" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('entropy_dropdown')">
                                {{ $entropy_units }} ▾
                            </label>
                            @if ($showDropdown === 'entropy_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('entropy_units', 'J')">J</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('entropy_units', 'KJ')">KJ</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('entropy_units', 'cal')">cal</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('entropy_units', 'kcal')">kcal</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Temperature --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['3'] ?? 'Temperature' !!} [T]:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="temperature" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('t_units_dropdown')">
                                {{ $t_units }} ▾
                            </label>
                            @if ($showDropdown === 't_units_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('t_units', 'K')">K</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('t_units', '°C')">°C</p>
                                    <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('t_units', '°F')">°F</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
        </div>

        @if($detail)
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
         <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="bg-[#F6FAFC] border rounded  p-3 px-3 py-2">
                        <p>
                            <strong>{!! $lang['4'] !!} =</strong>
                            <strong class="text-[#119154] text-[28px]">{!! round($detail['gibbs'], 2) !!} KJ</strong>
                        </p>
                        <p>{!! ($detail['gibbs'] < 0) ? $lang['9'] : $lang['10'] !!}</p>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-3 md:grid-cols-3 gap-4 text-center">
                        <div class="mt-3 border-r border-gray-200">
                            <p class="text-xs font-bold text-gray-500 uppercase">J</p>
                            <p class="font-bold">{!! round($detail['gibbs'] * 1000, 2) !!}</p>
                        </div>
                        <div class="mt-3 border-r border-gray-200 last:border-0 md:last:border-r lg:last:border-0">
                            <p class="text-xs font-bold text-gray-500 uppercase">cal</p>
                            <p class="font-bold">{!! round($detail['gibbs'] * 239, 2) !!}</p>
                        </div>
                        <div class="mt-3">
                            <p class="text-xs font-bold text-gray-500 uppercase">kcal</p>
                            <p class="font-bold">{!! round($detail['gibbs'] * 0.239, 2) !!}</p>
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="mt-3"><strong>{!! $lang['6'] !!}</strong></p>
                        <p class="mt-2">{!! $lang['1'] !!} : {!! request()->enthalpy . " " . request()->enthalpy_units !!}</p>
                        <p class="mt-2">{!! $lang['2'] !!} : {!! request()->entropy . " " . request()->entropy_units !!} </p>
                        <p class="mt-2">{!! $lang['3'] !!} : {!! request()->temperature . " " . request()->t_units !!}</p>
                        <p class="mt-3"><strong>{!! $lang['7'] !!}</strong></p>
                        <p class="mt-2">{!! $lang['8'] !!} :</p>
                        <p class="mt-2">\( \Delta G = \Delta H - T \times \Delta S \)</p>
                        <p class="mt-2">\( \text {ΔG} = (\text {{!! request()->enthalpy; !!}} - \text {{!! request()->entropy; !!}} \times \text {{!! request()->temperature; !!}}) \)</p>
                        <p class="mt-2">\( \text {ΔG} = \text {{!! round($detail['gibbs'], 2) !!}} \text { KJ}\)</p>
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
