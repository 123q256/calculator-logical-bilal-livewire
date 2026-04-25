<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Number of Isotopes --}}
                    <div class="col-span-12">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['1'] ?? 'Number of Isotopes' !!}:</label>
                        <div class="relative w-full mt-2">
                            <select wire:model.live="isotopes_no" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none bg-white font-medium appearance-none cursor-pointer">
                                @for ($i = 2; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                ▾
                            </div>
                        </div>
                    </div>

                    {{-- Isotope Rows --}}
                    <div class="col-span-12 space-y-8">
                        @for ($i = 0; $i < $isotopes_no; $i++)
                            <div class="grid grid-cols-12 gap-4 items-end border-b border-gray-100 pb-6 last:border-0">
                                {{-- Abundance --}}
                                <div class="col-span-12 md:col-span-6">
                                    <label class="font-s-14 text-blue font-bold">{{ $lang['2'] ?? 'Abundance' }} (f_{{ $i + 1 }}):</label>
                                    <div class="relative w-full mt-2">
                                        <input type="number" step="any" wire:model.live="per.{{ $i }}" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('per_unit_{{ $i }}')">
                                            {{ $per_unit[$i] == 'decimal' ? ($lang['3'] ?? 'decimal') : '%' }} ▾
                                        </label>
                                        @if ($showDropdown === 'per_unit_' . $i)
                                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit({{ $i }}, 'decimal')">{!! $lang['3'] ?? 'decimal' !!}</p>
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit({{ $i }}, '%')">%</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Mass --}}
                                <div class="col-span-12 md:col-span-6">
                                    <label class="font-s-14 text-blue font-bold">{!! $lang['4'] ?? 'Atomic Mass' !!} (m_{{ $i + 1 }}):</label>
                                    <div class="relative w-full mt-2">
                                        <input type="number" step="any" wire:model.live="mass.{{ $i }}" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                        <span class="absolute right-6 top-4 text-sm text-blue font-bold">amu</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
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

        @if($detail)
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
               <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="bg-[#F6FAFC] border radius-10 px-3 py-2">
                            <strong>{!! $lang['7'] !!} =</strong>
                            <strong class="text-green font-s-28">{!! $detail['amSum'] !!}</strong>
                            <strong>amu</strong>
                        </div>
                        <div class="col-12">
                            <p class="mt-3"><strong class="font-s-18">{!! $lang['8'] !!}</strong></p>
                            <p class="mt-2">{!! $lang['9'] !!} (f) = @foreach($per as $key => $value) {!! $value.', ' !!} @endforeach</p>
                            <p class="mt-2">{!! $lang['10'] !!} (m) = @foreach($mass as $key => $value) {!! $value.', ' !!} @endforeach</p>
                            <p class="mt-3"><strong class="font-s-18">{!! $lang['11'] !!}</strong></p>
                            @if($per_unit[0] == "decimal")
                                <p class="mt-2">AM = f<sub>1</sub>m<sub>1</sub> + f<sub>2</sub>m<sub>2</sub> + f<sub>3</sub>m<sub>3</sub> ... + f<sub>n</sub>m<sub>n</sub></p>
                                <p class="mt-2">AM =
                                    @for($i = 0; $i < $isotopes_no; $i++)
                                        {!! ($i == 0) ? "(".$per[$i]." x ".$mass[$i].")" : " + (".$per[$i]." x ".$mass[$i].")" !!}
                                    @endfor
                                </p>
                            @else
                                <p class="mt-2"><strong>{!! $lang['13'] !!}: </strong>{!! $lang['12'] !!}</p>
                                <p class="mt-2">AM = (f<sub>1</sub>m<sub>1</sub> + f<sub>2</sub>m<sub>2</sub> + f<sub>3</sub>m<sub>3</sub> ... + f<sub>n</sub>m<sub>n</sub>) / 100</p>
                                <p class="mt-2">AM = [
                                    @for($i = 0; $i < $isotopes_no; $i++)
                                        {!! ($i == 0) ? "(".$per[$i]." x ".$mass[$i].")" : " + (".$per[$i]." x ".$mass[$i].")" !!}
                                    @endfor
                                    ] / 100
                                </p>
                            @endif
                            <p class="mt-2">AM = <strong>{!! $detail['amSum'] !!}</strong></p>
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
