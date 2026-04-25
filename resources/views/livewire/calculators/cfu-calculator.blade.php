<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Number of Colonies --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['1'] ?? 'Number of Colonies' !!} [nc]:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="nc" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                        </div>
                    </div>

                    {{-- Dilution Factor --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['2'] ?? 'Dilution Factor' !!} [DF]:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="df" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                        </div>
                    </div>

                    {{-- Volume --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['3'] ?? 'Volume' }} [vc]:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="volume" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('volume_dropdown')">
                                {{ $volume_units }} ▾
                            </label>
                            @if ($showDropdown === 'volume_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-72 overflow-y-auto">
                                    @foreach (["mm³", "cm³", "dm³", "m³", "cu in", "cu ft", "cu yd", "ml", "cl", "l"] as $u)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('volume', '{{ $u }}')">{{ $u }}</p>
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
                            @if(isset($detail['cfu']))
                                @php $cfu = round($detail['cfu'],3) @endphp
                                <p><strong class="font-s-18">{!! $lang['4'] !!}</strong></p>
                                <p><strong class="text-[#119154] text-[32px]">{!! $detail['cfu'] !!} m³</strong></p>
                                <p class="mt-3"><strong class="font-s-18">{!! $lang['5'] !!}</strong></p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{(n_c \times DF)}{V_c}\)</p>
                                <p class="mt-2"><strong class="font-s-18">{!! $lang['6'] !!}</strong></p>
                                <p class="mt-2">\( \text{ {!! $lang['7'] !!} } [n_c]  \text{= {!! $detail['nc'] !!}} \)</p>
                                <p class="mt-2">\( \text{ {!! $lang['8'] !!} [DF]  = {!! $detail['df'] !!}}\) </p>
                                <p class="mt-2">\( \text{ {!! $lang['9'] !!} } [V_c]  \text{= {!! $detail['volume'] !!} m³}\)</p>
                                <p class="mt-3"><strong class="font-s-18">{!! $lang['8'] !!}</strong></p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{(n_c \times DF)}{V_c}\)</p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{({!! $detail['nc'] !!} \times {!! $detail['df'] !!})}{ {!! $detail['volume'] !!} }\)</p>
                                <p class="mt-2">\({!! $lang['4'] !!}  = \dfrac{{!! $detail['res'] !!}}{{!! $detail['volume'] !!}}\)</p>
                                <p class="mt-3">\({!! $lang['4'] !!}  = {!! $detail['cfu'] !!} m³\)</p>
                                <p class="mt-4"><strong class="font-s-18">{!! $lang['4'] !!}</strong></p>
                                <div class="col-12 overflow-auto mt-3">
                                    <table class="col-12 col-lg-7" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $lang['12'] !!} {!! $lang['12'] !!}</td>
                                            <td class="border-b py-2 ps-2"><strong>{!! $cfu * 0.001!!}</strong> cells/L</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">{!! $lang['12'] !!} {!! $lang['14'] !!}</td>
                                            <td class="border-b py-2 ps-2"><strong>{!! $cfu * 1e-9 !!}</strong> cells/µL</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">{!! $lang['15'] !!} {!! $lang['14'] !!}</td>
                                            <td class="py-2 ps-2"><strong>{!! $cfu * 1E-12 !!}</strong> K/µL</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
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
