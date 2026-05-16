<div x-data="{ openUnit: false, unit: @entangle('angle_unit').live }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="angle" class="font-s-14 text-blue">{{ $lang['1'] }} (θ)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="angle" id="angle" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                            
                            {{-- Unit Dropdown --}}
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 h-full flex items-center z-[1001]">
                                <label class="cursor-pointer text-sm underline select-none text-black" @click="openUnit = !openUnit">
                                    <span x-text="unit"></span> ▾
                                </label>
                                <div x-show="openUnit" @click.away="openUnit = false" x-transition x-cloak
                                     class="absolute z-[1002] bg-white border border-gray-300 rounded-md w-auto top-full right-0 shadow-lg mt-1 text-left">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'deg'; openUnit = false">degrees (deg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'rad'; openUnit = false">radians (rad)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'mrad'; openUnit = false">milliradians (mrad)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm text-black" @click="unit = 'piradians'; openUnit = false">* π rad (pirad)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 flex justify-center text-center">
                        <img src="{{ asset('images/cot_prop.svg') }}" height="100%" width="70%" alt="Cotangent Graph" style="object-fit: contain;" loading="lazy" decoding="async">
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
                                <table class="w-full text-[18px]">
                                    @php
                                        if($angle_unit === 'deg'){
                                            $deg = '°';
                                        }elseif($angle_unit === 'piradians'){
                                            $deg = ' * π';
                                        }else{
                                            $deg = '';
                                        }
                                        $cot = $detail['cot'];
                                        $table = array("1.73205081"=>"\sqrt 3", "-1.73205081"=>"-\sqrt 3", "0.57735027"=>"1\over {\sqrt 3} \) = \( {{\sqrt 3} \over 3}", "-0.57735027"=>"-1\over {\sqrt 3} \) = \( {-{\sqrt 3} \over 3}");
                                    @endphp
                                    @if($angle_unit === 'deg')
                                        @php
                                            $val = '';
                                            foreach($table as $key => $value){
                                                if("$key" === "$cot"){
                                                    $val = $value;
                                                }
                                            }
                                        @endphp
                                        @if(!empty($val))
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cot({{ $angle.$deg }})</strong></td>
                                                <td class="py-2 border-b">\( {{$val}} \)</td>
                                            </tr>
                                        @endif
                                    @endif
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>cot({{ $angle.$deg }})</strong></td>
                                        <td class="py-2 border-b">{{ $cot }}</td>
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
