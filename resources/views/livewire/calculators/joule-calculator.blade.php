<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-2 md:gap-4">
                <div class="col-span-12 md:col-span-7">
                    <label for="mass" class="label">{{ $lang[1] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="mass" id="mass" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-5">
                    <label for="mass_unit" class="label">&nbsp;</label>
                    <div class="w-full py-2">
                        <select wire:model.live="mass_unit" id="mass_unit" class="input">
                            <option value="1">kg</option>
                            <option value="0.001">g</option>
                            <option value="0.000001">mg</option>
                            <option value="0.000000001">mu-gr</option>
                            <option value="0.0002">ct</option>
                            <option value="50.80235">Hundredweight (l)</option>
                            <option value="45.35924">Hundredweight (s)</option>
                            <option value="0.4535924">lbs</option>
                            <option value="0.3732417">troy</option>
                            <option value="0.02834952">ozm</option>
                            <option value="0.03110348">troy</option>
                            <option value="14.5939">Slug</option>
                            <option value="907.1847">Ton (s)</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-7">
                    <label for="velocity" class="label">{{ $lang[2] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="velocity" id="velocity" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-5">
                    <label for="velocity_unit" class="label">&nbsp;</label>
                    <div class="w-full py-2">
                        <select wire:model.live="velocity_unit" id="velocity_unit" class="input">
                            <option value="1">m/s</option>
                            <option value="0.00508">ft/min</option>
                            <option value="0.3048">ft/s</option>
                            <option value="0.2777778">km/hr</option>
                            <option value="0.5144444">Knot (int'l)</option>
                            <option value="0.44707">mph</option>
                            <option value="0.514444">Mile (nautical)/hour</option>
                            <option value="26.8224">Mile (US)/minute</option>
                            <option value="1609.344">Mile (US)/second</option>
                            <option value="299792458">Speed of light (c)</option>
                            <option value="340.006875">Mach (STP)(a)</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-12">
                    <label for="joule_unit" class="label">{{ $lang[3] }}</label>
                    <div class="w-full py-2">
                        <select wire:model.live="joule_unit" id="joule_unit" class="input">
                            <option value="Joule (J)">Joule (J)</option>
                            <option value="BTU (mean)">BTU (mean)</option>
                            <option value="BTU (thermochemical)">BTU (thermochemical)</option>
                            <option value="Calorie (SI) (cal)">Calorie (SI) (cal)</option>
                            <option value="Electron volt (eV)">Electron volt (eV)</option>
                            <option value="Erg (erg)">Erg (erg)</option>
                            <option value="Foot-pound force">Foot-pound force</option>
                            <option value="Foot-poundal">Foot-poundal</option>
                            <option value="Horsepower-hour">Horsepower-hour</option>
                            <option value="Kilocalorie (SI)(kcal)">Kilocalorie (SI)(kcal)</option>
                            <option value="Kilowatt-hour (kW hr)">Kilowatt-hour (kW hr)</option>
                            <option value="Ton of TNT">Ton of TNT</option>
                            <option value="Volt-coulomb (V Cb)">Volt-coulomb (V Cb)</option>
                            <option value="Watt-hour (W hr)">Watt-hour (W hr)</option>
                            <option value="Watt-second (W sec)">Watt-second (W sec)</option>
                        </select>
                    </div>
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
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong>{{ $lang[4] }} ({{ $lang[5] }})</strong>
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                        <strong>{{ round($detail['answer'], 7) }} <span class="text-[14px]">{{ $joule_unit }}</span></strong>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mt-3 space-y-2">
                                <p class="text-[18px]"><strong>{{ $lang[6] }}</strong></p>
                                <p>{{ $lang[7] }}</p>
                                <p>{{ $lang[8] }}.</p>
                                <p>(K) = 1/2 * (m) * (v)²</p>
                                <p>{{ $lang[9] }}s</p>
                                <p>{{ $lang[10] }}</p>
                                <p>{{ $lang[11] }}</p>
                                <p>K = 1/2 * ({{ $mass }}) * ({{ $velocity }})²</p>
                                <p>K = {{ $detail['answer'] }} {{ $joule_unit }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
