<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Solve For --}}
                    <div class="col-span-12">
                        <label class="font-s-14 text-blue font-bold">{!! $lang['1'] ?? 'Solve For' !!}:</label>
                        <div class="relative w-full mt-2">
                            <select wire:model.live="solve" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none bg-white font-medium appearance-none cursor-pointer">
                                <option value="1">{!! $lang['3'] ?? 'Bond Order' !!}</option>
                                <option value="2">{!! $lang['2'] ?? 'Bonding Electrons' !!}</option>
                                <option value="3">{!! $lang['1'] ?? 'Antibonding Electrons' !!}</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                                ▾
                            </div>
                        </div>
                    </div>

                    {{-- First Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">
                            @if($solve == '1') {!! $lang['2'] ?? 'Bonding Electrons' !!} [Be]
                            @else {!! $lang['3'] ?? 'Bond Order' !!} [Bo]
                            @endif:
                        </label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="f_input" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                        </div>
                    </div>

                    {{-- Second Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">
                            @if($solve == '3') {!! $lang['2'] ?? 'Bonding Electrons' !!} [Be]
                            @else {!! $lang['1'] ?? 'Antibonding Electrons' !!} [Ae]
                            @endif:
                        </label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="s_input" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
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
                        <div class="bg-sky border rounded px-3 py-2">
                            <strong>
                                @if(request()->solve === "1")
                                    {!! $lang[3] !!}
                                @elseif(request()->solve === "2")
                                    {!! $lang[2] !!}
                                @else
                                    {!! $lang[1] !!}
                                @endif
                                =
                            </strong>
                            <strong class="text-[#119154] md:text-[25px] lg:text-[25px]">{!! round($detail['answer'], 2) !!}</strong>
                        </div>
                        <div class="col-12">
                            <p class="mt-3"><strong>{!! $lang[5] !!}</strong></p>
                            @if(request()->solve === "1")
                                <p class="mt-2">{!! $lang[2] !!} = {!! request()->f_input !!} </p>
                                <p class="mt-2">{!! $lang[1] !!} = {!! request()->s_input !!}</p>
                                <p class="mt-3"><strong>{!! $lang[6] !!}</strong></p>
                                <p class="mt-2">{!! $lang[7] !!} = 1/2 * (Be - Ae)</p>
                                <p class="mt-2">Bo = 0.5 * ({!! request()->f_input !!} - {!! request()->s_input !!})</p>
                                <p class="mt-2">Bo = {!! $detail['answer'] !!} </p>
                            @elseif(request()->solve === "2")
                                <p class="mt-2">{!! $lang[3] !!} = {!! request()->f_input !!} </p>
                                <p class="mt-2">{!! $lang[1] !!} = {!! request()->s_input !!}</p>
                                <p class="mt-3"><strong>{!! $lang[6] !!}</strong></p>
                                <p class="mt-2">{!! $lang[7] !!} = (2 * Bo) + Ae</p>
                                <p class="mt-2">Be = (2 * {!! request()->f_input !!}) + {!! request()->s_input !!}</p>
                                <p class="mt-2">Be = {!! $detail['answer'] !!} </p>
                            @else
                                <p class="mt-2">{!! $lang[3] !!} = {!! request()->f_input !!} </p>
                                <p class="mt-2">{!! $lang[2] !!} = {!! request()->s_input !!}</p>
                                <p class="mt-3"><strong>{!! $lang[6] !!}</strong></p>
                                <p class="mt-2">{!! $lang[7] !!} = -1 * ((Bo * 2) - Be)</p>
                                <p class="mt-2">Ae = -1 * (({!! request()->f_input !!} * 2) - {!! request()->s_input !!})</p>
                                <p class="mt-2">Ae = {!! $detail['answer'] !!} </p>
                            @endif
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
