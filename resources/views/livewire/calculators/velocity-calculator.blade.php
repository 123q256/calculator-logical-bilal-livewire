<div>
  <style>
    @media (max-width: 380px) {
        .calculator-box{ padding-left: 0.5rem; padding-right: 0.5rem; }
    }
    #onetw{ outline: 0 }
    .katex{ text-align: left !important; }
    .gap-2{ gap : 4px; }
  </style>

   <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="container mx-auto">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="$set('velo_value', '1')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white @if ($velo_value == '1') tagsUnit @endif ">
                            {{ $lang['d_c'] ?? 'Distance Calc' }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="$set('velo_value', '2')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white @if ($velo_value == '2') tagsUnit @endif">
                            {{ $lang['a'] ?? 'Acceleration' }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div wire:click="$set('velo_value', '3')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white @if ($velo_value == '3') tagsUnit @endif">
                            {{ $lang['av'] ?? 'Avg Velocity' }}
                        </div>
                    </div>
                </div>
            </div>

            @if($velo_value == '1')
            <div class="container mx-auto mt-4">
                <div class="lg:w-1/2 w-full px-2 mb-4">
                    <label for="dimension" class="font-s-14 text-blue">{{ $lang['to_calc'] ?? 'To calculate' }}</label>
                    <div class="w-full relative">
                        <select wire:model.live="dem" id="dimension" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue">
                            <option value="dc">{{ $lang['d'] ?? 'Distance' }}</option>
                            <option value="av">{{ $lang['v'] ?? 'Velocity' }}</option>
                            <option value="t">{{ $lang['t'] ?? 'Time' }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex flex-wrap">
                    @if($dem == 'av' || $dem == 't')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['d'] ?? 'Distance' }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="x" required id="x" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00" />
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $dis_unit }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['in', 'ft', 'yd', 'm', 'cm', 'km', 'mi'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('dis_unit', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endif
                    
                    @if($dem == 'dc' || $dem == 't')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="z" class="font-s-14 text-blue">{{ $lang['v'] ?? 'Velocity' }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="vel" required id="z" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00" />
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $val_units }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['m/s', 'km/h', 'ft/s', 'mph', 'kn', 'ft/m', 'cm/s', 'm/min'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('val_units', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($dem == 'dc' || $dem == 'av')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="y" class="font-s-14 text-blue">{{ $lang['t'] ?? 'Time' }}</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="y" required id="y" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00" />
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $time_unit }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('time_unit', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            @if($velo_value == '3')
            <div class="container mx-auto mt-4">
                <div class="space-y-4">
                    @foreach($z as $index => $velItem)
                    <div class="flex flex-wrap items-end relative">
                        <div class="lg:w-[45%] w-full px-2 mb-4">
                            <label class="font-s-14 text-blue">{{ $lang['v'] ?? 'Speed' }} {{ $index > 0 ? $index + 1 : '1' }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" step="any" wire:model="z.{{ $index }}" required class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00" />
                                <div x-data="{ open: false }" class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                        {{ $val_unit[$index] ?? 'm/s' }} ▾
                                    </label>
                                    <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                        @foreach (['m/s', 'km/h', 'ft/s', 'mph', 'kn', 'ft/m', 'cm/s', 'm/min'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('val_unit', '{{ $val }}', {{ $index }})">{{ $val }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:w-[45%] w-full px-2 mb-4">
                            <div class="flex justify-between">
                                <label class="font-s-14 text-blue">{{ $lang['t'] ?? 'Time' }} {{ $index > 0 ? $index + 1 : '1' }}</label>
                                @if($index > 0)
                                    <button type="button" wire:click="removeRow({{ $index }})" class="text-red-500 font-bold border-0 bg-transparent text-sm hover:text-red-700 bg-red-100 rounded-full h-5 w-5 flex items-center justify-center">✖</button>
                                @endif
                            </div>
                            <div class="relative w-full mt-1">
                                <input type="number" step="any" wire:model="aty.{{ $index }}" required class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00" />
                                <div x-data="{ open: false }" class="">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                        {{ $ytime_unit[$index] ?? 'sec' }} ▾
                                    </label>
                                    <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                        @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('ytime_unit', '{{ $val }}', {{ $index }})">{{ $val }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="w-full px-2 mt-2">
                    <button type="button" wire:click="addRow" class="bg-blue-600 text-white p-2 rounded-md cursor-pointer hover:bg-blue-700 font-semibold">+ {{ $lang['adrow'] ?? 'Add Row' }}</button>
                </div>
            </div>
            @endif

            @if($velo_value == '2')
            <div class="container mx-auto mt-4">
                <div class="lg:w-1/2 w-full px-2 mb-4">
                    <label for="collection" class="font-s-14 text-blue">{{ $lang['to_calc'] ?? 'To calculate' }}</label>
                    <div class="w-full relative mt-1">
                        <select wire:model.live="collection" id="collection" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue">
                            <option value="1">{{ $lang['i_v'] ?? 'Initial Velocity' }}</option>
                            <option value="2">{{ $lang['f_v'] ?? 'Final Velocity' }}</option>
                            <option value="3">{{ $lang['a'] ?? 'Acceleration' }}</option>
                            <option value="4">{{ $lang['t'] ?? 'Time' }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap mt-3">
                    @if($collection != '1')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="x1" class="font-s-14 text-blue">{{ $lang['i_v'] ?? 'Initial Velocity' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" step="any" wire:model="x1" required id="x1" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00"/>
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $iv_unit }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['m/s', 'km/h', 'ft/s', 'mph', 'kn', 'ft/m', 'cm/s', 'm/min'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('iv_unit', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($collection != '2')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="z1" class="font-s-14 text-blue">{{ $lang['f_v'] ?? 'Final Velocity' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" step="any" wire:model="z1" required id="z1" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00"/>
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $fv_unit }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['m/s', 'km/h', 'ft/s', 'mph', 'kn', 'ft/m', 'cm/s', 'm/min'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('fv_unit', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($collection != '4')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="y1" class="font-s-14 text-blue">{{ $lang['t'] ?? 'Time' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" step="any" wire:model="y1" required id="y1" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00"/>
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $atime_unit }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('atime_unit', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($collection != '3')
                    <div class="lg:w-1/2 w-full px-2 mb-4">
                        <label for="acc" class="font-s-14 text-blue">{{ $lang['a'] ?? 'Acceleration' }}</label>
                        <div class="relative w-full mt-1">
                            <input type="number" step="any" wire:model="acc" required id="acc" class="border border-blue-500 p-2 rounded-lg focus:ring-2 w-full text-blue" placeholder="00"/>
                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3 text-blue" @click="open = !open" @click.outside="open = false">
                                    {{ $acc_unit }} ▾
                                </label>
                                <div x-show="open" style="display: none;" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-84 overflow-y-auto">
                                    @foreach (['m/s²', 'cm/s²', 'in/s²', 'ft/s²', 'km/s²', 'mi/s²', 'g'] as $val)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('acc_unit', '{{ $val }}')">{{ $val }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            @if ($type == 'calculator')
               @include('inc.button')
              @endif
              @if ($type=='widget')
              @include('inc.widget-button')
               @endif
        </div>

        @isset($detail)
        <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type=='calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>
            @php
                $ans_t = $detail['ans_t'] ?? '';
                $unit = $detail['unit'] ?? '';
            @endphp
            <div class="grid grid-cols-12 gap-4 mt-4">
                <div class="col-span-12 text-center">
                    <p class="font-s-18 mb-2 font-bold text-black">
                        {{ $ans_t }}
                    </p>
                    <div class="flex items-center justify-center gap-2">
                        <div class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold text-xl" id="circle_result" data-initial-value="{{ $detail['ans'] ?? '' }}">
                            {{ $detail['ans'] ?? '' }}
                        </div>
                        
                        <div class="relative border border-gray-300 rounded-md bg-white h-full flex items-center">
                            <select wire:model.live="circle_unit_result" class="outline-none bg-transparent py-2 pl-2 pr-6 appearance-none cursor-pointer text-sm font-semibold">
                                @php
                                    if($ans_t == 'Distance'){
                                        $options = ["m"=>"m","cm"=>"cm","in"=>"in","ft"=>"ft","yd"=>"yd","km"=>"km","mi"=>"mi"];
                                    }elseif($ans_t == 'Final Velocity' || $ans_t == 'Initial Velocity' || $ans_t == 'Velocity' || $ans_t == 'Avrage Velocity') {
                                        $options = ["m/s"=>"m/s","km/h"=>"km/h","ft/s"=>"ft/s","mph"=>"mph","kn"=>"kn","ft/m"=>"ft/m","cm/s"=>"cm/s"];
                                    }elseif($ans_t == 'Time'){
                                        $options = ["s"=>"sec","m"=>"min","h"=>"hrs","d"=>"days","w"=>"weeks","mo"=>"months","y"=>"year"];
                                    }elseif($ans_t == 'Acceleration'){
                                        $options = ["m/s²"=>"m/s²","cm/s²"=>"cm/s²","in/s²"=>"in/s²","ft/s²"=>"ft/s²","km/s²"=>"km/s²","mi/s²"=>"mi/s²","g"=>"g"];
                                    } else {
                                        $options = ["m"=>"m"];
                                    }
                                @endphp
                                @foreach($options as $val => $name)
                                    <option value="{{ $val }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </form>
</div>
