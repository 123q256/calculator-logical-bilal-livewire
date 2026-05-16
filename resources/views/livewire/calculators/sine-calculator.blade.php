<div x-data="{ openUnit: false }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12" x-data="{ openUnit: false, unit: @entangle('angle_unit').live }">
                        <label for="angle" class="font-s-14 text-blue">{{ $lang['1'] }} (θ)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="angle" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            
                            {{-- Unit Dropdown --}}
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 h-full flex items-center z-[1001]">
                                <label class="cursor-pointer text-sm underline select-none" @click="openUnit = !openUnit">
                                    <span x-text="unit"></span> ▾
                                </label>
                                <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                     class="absolute z-[1002] bg-white border border-gray-300 rounded-md w-40 top-full right-0 shadow-lg mt-1 text-left">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'deg'; openUnit = false">degrees (deg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'rad'; openUnit = false">radians (rad)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'pirad'; openUnit = false">* π rad (pirad)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 text-center flex justify-center">
                        <img src="{{ asset('images/sin_prop.png') }}" height="100%" width="90%" alt="Sine Formula Image" style="object-fit: contain;" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ count($detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[16px]">
                                    @php
                                        $unitLabel = ($angle_unit === 'deg') ? '°' : (($angle_unit === 'pirad') ? ' * π' : '');
                                        $sinVal = $detail['sin'];
                                        $specialValues = [
                                            "0.8660254" => "{\sqrt 3} \over 2",
                                            "0.70710678" => "{\sqrt 2} \over 2",
                                            "0.5" => "1 \over 2"
                                        ];
                                        
                                        $radicalVal = '';
                                        if ($angle_unit === 'deg') {
                                            $absSin = abs(floatval($sinVal));
                                            foreach ($specialValues as $key => $latex) {
                                                if (abs($absSin - floatval($key)) < 0.00001) {
                                                    $radicalVal = (floatval($sinVal) < 0 ? '-' : '') . $latex;
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp

                                    @if(!empty($radicalVal))
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>sin({{ $angle }}{{ $unitLabel }})</strong></td>
                                            <td class="py-2 border-b">\( {{ $radicalVal }} \)</td>
                                        </tr>
                                    @endif
                                    
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>sin({{ $angle }}{{ $unitLabel }})</strong></td>
                                        <td class="py-2 border-b">{{ $sinVal }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('math-updated', () => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                Livewire.hook('morph.updated', ({ el }) => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(el);
                    }
                });
            });
        </script>
    @endpush
</div>
