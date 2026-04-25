<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Volume --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['1'] ?? 'Volume' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="volume" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold " wire:click="toggleOverlay('volume_dropdown')">
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

                    {{-- Temperature --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['2'] ?? 'Temperature' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="temp" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold " wire:click="toggleOverlay('temp_dropdown')">
                                {{ $temp_units }} ▾
                            </label>
                            @if ($showDropdown === 'temp_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["°C", "°F", "K"] as $u)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('temp', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Pressure --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="font-s-14 text-blue font-bold">{{ $lang['3'] ?? 'Pressure' }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" step="any" wire:model.live="pressure" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold " wire:click="toggleOverlay('pressure_dropdown')">
                                {{ $pressure_units }} ▾
                            </label>
                            @if ($showDropdown === 'pressure_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-72 overflow-y-auto">
                                    @foreach (["Pa", "bar", "psi", "at", "atm", "Torr", "hPa", "kPa", "MPa", "GPa", "inHg", "mmHg"] as $u)
                                        <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer whitespace-nowrap text-sm" wire:click="setUnit('pressure', '{{ $u }}')">{{ $u }}</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
            <div class="rounded-lg  flex items-center justify-center">

                <div class="w-full  bg-light-blue result p-3 radius-10 mt-3">
                    <div class="w-full ">
                        @if(isset($detail['vstp']))
                            @php $v2 = round($detail['vstp'],3) @endphp
                            <div class="col-lg-6">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div>
                                        <p><strong>{!! $lang['4'] !!}</strong></p>
                                        <p><strong class="text-green text-[20px] md:text-[30px]">{!! round($detail['vstp'],3)!!} L</strong></p>
                            </div>
                                    <div class="border-end d-none d-md-block">&nbsp;</div>
                            <div>
                                        <p><strong>{!! $lang['5'] !!}</strong></p>
                                        <p><strong class="text-green text-[20px] md:text-[30px]">{!! round($detail['moles'],3)!!}</strong></p>
                            </div>
                                </div>
                            </div>
                            <p class="mt-2"><strong class="text-[18px] md:text-[20px]">{!! $lang['6'] !!}:</strong></p>
                            <p class="mt-2">\(V_{STP} = V \times (\dfrac{273.15}{T}) \times (\dfrac{P}{760})\)</p>
                            <p class="mt-2"><strong class="text-[18px] md:text-[20px]">{!! $lang['7'] !!}:</strong></p>
                            <p class="mt-2">{!! $lang['4'] !!} [V]  = {!! round($detail['volume'],2)!!} L</p>
                            <p class="mt-2">{!! $lang['8'] !!} [T]  = {!! round($detail['temp'],2)!!} K</p>
                            <p class="mt-2">{!! $lang['9'] !!} [P]  = {!! round($detail['pressure'],2)!!} Torr</p>
                            <p class="mt-2"><strong class="text-[18px] md:text-[20px]">{!! $lang['11'] !!}:</strong></p>
                            <p class="mt-2">\(V_{STP} = V \times (\dfrac{273.15}{T}) \times (\dfrac{P}{760})\)</p>
                            <p class="mt-2">\(V_{STP} = {!! $detail['volume']!!} \times (\dfrac{273.15}{{!! $detail['temp']!!}}) \times (\dfrac{{!! $detail['pressure']!!}}{760})\)</p>
                            <p class="mt-2">\(V_{STP} = {!! $detail['volume']!!} \times ({!! round(273.15 / $detail['temp'],4)!!}) \times ({!! round($detail['pressure']/760,4)!!})\)</p>
                            <p class="mt-2 font-s-18">\(V_{STP}\) = <strong>{!! round($detail['vstp'],3)!!} L</strong></p>
                            <p class="mt-3"><strong>{!! $lang['12'] !!}</strong></p>
                            <p class="mt-2">\(Moles_{STP} = \dfrac{V_{STP} }{ 22.4}\)</p>
                            <p class="mt-2">\(Moles_{STP} = \dfrac{ {!! round($detail['vstp'],2)!!} }{ 22.4}\)</p>
                            <p class="mt-2 font-s-18">\(Moles_{STP} \)= <strong>{!! round($detail['moles'],3)!!}</strong></p>
                            <p class="mt-4"><strong class="font-s-18">\(V_{STP}\) {!! $lang['13'] !!}:</strong></p>
                            <div class="col-12 overflow-auto mt-3">
                                <table class="col-12 col-lg-7" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!}  {!! $lang['15'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1000000 !!}</strong> mm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['15'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1000 !!}</strong> cm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['17'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1 !!}</strong> dm³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['18'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 0.001 !!}</strong> m³</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['19'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 61.024 !!}</strong> cu in</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['20'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 0.035 !!}</strong> cu ft</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\) {!! $lang['14'] !!} {!! $lang['20'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 0.001 !!}</strong> cu yd</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">\(V_{STP}\)  {!! $lang['15'] !!}</td>
                                        <td class="border-b py-2 ps-2"><strong>{!! $v2 * 1000 !!}</strong> ml</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">\(V_{STP}\) {!! $lang['22'] !!}</td>
                                        <td class="py-2 ps-2"><strong>{!! $v2 * 100 !!}</strong> cl</td>
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
