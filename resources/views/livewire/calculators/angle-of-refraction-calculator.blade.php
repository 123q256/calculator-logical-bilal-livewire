<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6">
                <div class="row">
                    <div class="w-full px-2 mb-4">
                        <label for="calculation" class="font-s-14 text-blue">{{ $lang[1] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="calculation" id="calculation" class="input">
                                <option value="from1">Find n1 | Given n2, θ₁ and θ₂</option>
                                <option value="from2">Find n2 | Given n1, θ₁ and θ₂</option>
                                <option value="from3">Find θ₁ | Given n1, n2 and θ₂</option>
                                <option value="from4">Find θ₂ | Given n1, n2 and θ₁</option>
                            </select>
                        </div>
                    </div>

                    @if($calculation !== 'from1')
                    <div class="w-full mb-4">
                        <div class="row">
                            <div class="w-full px-2">
                                <label for="medium1" class="font-s-14 text-blue">{{ $lang[12] }} 1</label>
                                <div class="w-100 py-2 position-relative">
                                    <select wire:model.live="medium1" id="medium1" class="input">
                                        <option value="vacuum">{{$lang[2]}}</option>
                                        <option value="air">{{$lang[3]}}</option>
                                        <option value="water">{{$lang[4]}} 20°C 🌊</option>
                                        <option value="ethanol">{{$lang[5]}}</option>
                                        <option value="ice">{{$lang[6]}} 🧊</option>
                                        <option value="acrylic">{{$lang[7]}}</option>
                                        <option value="window">{{$lang[8]}}</option>
                                        <option value="diamond">{{$lang[9]}}</option>
                                        <option value="custom">{{$lang[10]}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-2">
                                <label for="n1" class="font-s-14 text-blue">{{ $lang[11] }} 1 (n₁)</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model="n1" id="n1" class="input" placeholder="00" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($calculation !== 'from2')
                    <div class="w-full mb-4">
                        <div class="row">
                            <div class="w-full px-2">
                                <label for="medium2" class="font-s-14 text-blue">{{ $lang[12] }} 2</label>
                                <div class="w-100 py-2 position-relative">
                                    <select wire:model.live="medium2" id="medium2" class="input">
                                        <option value="vacuum">{{$lang[2]}}</option>
                                        <option value="air">{{$lang[3]}}</option>
                                        <option value="water">{{$lang[4]}} 20°C 🌊</option>
                                        <option value="ethanol">{{$lang[5]}}</option>
                                        <option value="ice">{{$lang[6]}} 🧊</option>
                                        <option value="acrylic">{{$lang[7]}}</option>
                                        <option value="window">{{$lang[8]}}</option>
                                        <option value="diamond">{{$lang[9]}}</option>
                                        <option value="custom">{{$lang[10]}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-2">
                                <label for="n2" class="font-s-14 text-blue">{{ $lang[11] }} 2 (n₂)</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" wire:model="n2" id="n2" class="input" placeholder="00" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($calculation !== 'from3')
                    <div class="w-full px-2 mb-4">
                        <label for="angle_first" class="font-s-14 text-blue">{{ $lang[13] }} (θ₁)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" wire:model="angle_first" id="angle_first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                           <label for="angle_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('angle_f_unit')">{{ $angle_f_unit }} ▾</label>
                           @if($dropdowns['angle_f_unit'] ?? false)
                           <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                               @foreach(['deg', 'rad', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'μrad', '* π rad'] as $unit)
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_f_unit', '{{ $unit }}', 'angle_f_unit')">{{ $unit }}</p>
                               @endforeach
                           </div>
                           @endif
                        </div>
                      </div>
                    @endif

                    @if($calculation !== 'from4')
                      <div class="w-full px-2 mb-3">
                        <label for="angle_second" class="font-s-14 text-blue">{{ $lang[19] }} (θ₂)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" wire:model="angle_second" id="angle_second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00"/>
                           <label for="angle_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('angle_s_unit')">{{ $angle_s_unit }} ▾</label>
                           @if($dropdowns['angle_s_unit'] ?? false)
                           <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                               @foreach(['deg', 'rad', 'gon', 'tr', 'arcmin', 'arcsec', 'mrad', 'μrad', '* π rad'] as $unit)
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('angle_s_unit', '{{ $unit }}', 'angle_s_unit')">{{ $unit }}</p>
                               @endforeach
                           </div>
                           @endif
                        </div>
                      </div>
                    @endif
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 text-center px-2">
                <img class="mx-auto" src="{{url('images/snells_img.svg')}}" alt="Refraction Diagram" width="250px" height="165px">
            </div>
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>

    <hr>
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  mt-3">
                    <div class="w-full">
                        @if ($detail['calculation'] === "from1")
                            <div class="text-center">
                                <p class="text-[19px]"><strong>{{ $lang[11] }} 1 (n₁)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ round($detail['jawab'], 6) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[19px]"><strong>{{ $lang[14] }}</strong></p>
                                <p>n₂ {{ $lang[15] }} 2 = {{ $n2 }}</p>
                                <p>{{ $lang[13] }} (θ₁) = {{ $angle_first }} {{ $angle_f_unit }}</p>
                                <p>{{ $lang[19] }} (θ₂) = {{ $angle_second }} {{ $angle_s_unit }}</p>
                                <p class="text-[19px]"><strong>{{ $lang[16] }}</strong></p>
                                <p>{{ $lang[17] }} = (n₂ * sin(θ₂)) / sin(θ₁)</p>
                                <p>{{ $lang[18] }}</p>
                                <p>n₁ = ({{ $n2 }} * sin({{ $angle_second }})) / sin({{ $angle_first }})</p>
                                <p>n₁ = {{ round($detail['jawab'], 6) }}</p>
                            </div>
                        @elseif($detail['calculation'] === "from2")
                            <div class="text-center">
                                <p class="text-[19px]"><strong>{{ $lang[11] }} 2 (n₂)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ round($detail['jawab'], 6) }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[19px]"><strong>{{ $lang[14] }}</strong></p>
                                <p>n₁ {{ $lang[15] }} 1 = {{ $n1 }}</p>
                                <p>{{ $lang[13] }} (θ₁) = {{ $angle_first }} {{ $angle_f_unit }}</p>
                                <p>{{ $lang[19] }} (θ₂) = {{ $angle_second }} {{ $angle_s_unit }}</p>
                                <p class="text-[19px]"><strong>{{ $lang[16] }}</strong></p>
                                <p>{{ $lang[17] }} = (n₁ * sin(θ₁)) / sin(θ₂)</p>
                                <p>{{ $lang[18] }}</p>
                                <p>n₂ = ({{ $n1 }} * sin({{ $angle_first }})) / sin({{ $angle_second }})</p>
                                <p>n₂ = {{ round($detail['jawab'], 6) }}</p>
                            </div>
                        @elseif($detail['calculation'] === "from3")
                            <div class="text-center">
                                <p class="text-[19px]"><strong>{{ $lang[13] }} (θ₁)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ round(($detail['jawab'] * 57.2958), 6) }} deg</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[19px]"><strong>{{ $lang[14] }}</strong></p>
                                <p>n₁ {{ $lang[15] }} 1 = {{ $n1 }}</p>
                                <p>n₂ {{ $lang[15] }} 2 = {{ $n2 }}</p>
                                <p>{{ $lang[19] }} (θ₂) = {{ $angle_second }} {{ $angle_s_unit }}</p>
                                <p class="text-[19px]"><strong>{{ $lang[16] }}</strong></p>
                                <p>{{ $lang[17] }} = sin<sup>-1</sup>((n₂ * sin(θ₂)) / n₁)</p>
                                <p>{{ $lang[18] }}</p>
                                <p>θ₁ =  sin<sup>-1</sup>(({{ $n2 }} * sin({{ $angle_second }})) / {{ $n1 }})</p>
                                <p>θ₁ = {{ round(($detail['jawab'] * 57.2958), 6) }} deg</p>
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-[19px]"><strong>{{ $lang[19] }} (θ₂)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ round(($detail['jawab'] * 57.2958), 6) }} deg</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[19px]"><strong>{{ $lang[14] }}</strong></p>
                                <p>n₁ {{ $lang[15] }} 1 = {{ $n1 }}</p>
                                <p>n₂ {{ $lang[15] }} 2 = {{ $n2 }}</p>
                                <p>{{ $lang[13] }} (θ₁) = {{ $angle_first }} {{ $angle_f_unit }}</p>
                                <p class="text-[19px]"><strong>{{ $lang[16] }}</strong></p>
                                <p>{{ $lang[17] }} = sin<sup>-1</sup>((n₁ * sin(θ₁)) / n₂)</p>
                                <p>{{ $lang[18] }}</p>
                                <p>θ₂ =  sin<sup>-1</sup>(({{ $n1 }} * sin({{ $angle_first }})) / {{ $n2 }})</p>
                                <p>θ₂ = {{ round(($detail['jawab'] * 57.2958), 6) }} deg</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>

