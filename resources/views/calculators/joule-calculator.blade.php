<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-7">
                <label for="mass" class="label">{{ $lang[1] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="mass" id="mass" class="input" value="{{ isset($_POST['mass'])?$_POST['mass']:'5' }}" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-5">
                <label for="mass_unit" class="label">&nbsp;</label>
                <div class="w-full py-2 position-relative">
                    <select name="mass_unit" id="mass_unit" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["kg","g","mg","mu-gr","ct","Hundredweight (l)","Hundredweight (s)","lbs","troy","ozm","troy","Slug","Ton (s)"];
                            $val = ["1","0.001","0.000001","0.000000001","0.0002","50.80235","45.35924","0.4535924","0.3732417","0.02834952","0.03110348","14.5939","907.1847"];
                            optionsList($val,$name,isset($_POST['mass_unit'])?$_POST['mass_unit']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-7">
                <label for="velocity" class="label">{{ $lang[2] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="velocity" id="velocity" class="input" value="{{ isset($_POST['velocity'])?$_POST['velocity']:'4' }}" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-5">
                <label for="velocity_unit" class="label">&nbsp;</label>
                <div class="w-full py-2 position-relative">
                    <select name="velocity_unit" id="velocity_unit" class="input">
                        @php
                            $name = ["m/s","ft/min","ft/s","km/hr","Knot (int'l)","mph","Mile (nautical)/hour","Mile (US)/minute","Mile (US)/second","Speed of light (c)","Mach (STP)(a)"];
                            $val = ["1","0.00508","0.3048","0.2777778","0.5144444","0.44707","0.514444","26.8224","1609.344","299792458","340.006875"];
                            optionsList($val,$name,isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="joule_unit" class="label">{{ $lang[3] }}</label>
                <div class="w-full py-2 position-relative">
                    <select name="joule_unit" id="joule_unit" class="input">
                        @php
                            $name = ["Joule (J)","BTU (mean)","BTU (thermochemical)","Calorie (SI) (cal)","Electron volt (eV)","Erg (erg)","Foot-pound force","Foot-poundal","Horsepower-hour","Kilocalorie (SI)(kcal)","Kilowatt-hour (kW hr)","Ton of TNT","Volt-coulomb (V Cb)","Watt-hour (W hr)","Watt-second (W sec)"];
                            $val = ["Joule (J)","BTU (mean)","BTU (thermochemical)","Calorie (SI) (cal)","Electron volt (eV)","Erg (erg)","Foot-pound force","Foot-poundal","Horsepower-hour","Kilocalorie (SI)(kcal)","Kilowatt-hour (kW hr)","Ton of TNT","Volt-coulomb (V Cb)","Watt-hour (W hr)","Watt-second (W sec)"];
                            optionsList($val,$name,isset($_POST['joule_unit'])?$_POST['joule_unit']:'Joule (J)');
                        @endphp
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
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @php
                                $request = request();
                                $mass = trim( $request->mass );
                                $mass_unit = trim( $request->mass_unit );
                                $velocity = trim( $request->velocity );
                                $velocity_unit = trim( $request->velocity_unit );
                                $joule_unit = trim( $request->joule_unit );
                            @endphp
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong><?= $lang[4] ?> (<?= $lang[5] ?>)</strong>
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                    <strong class="text-blue">{{ round($detail['answer'], 7) }} <span class="text-[14px]">{{ $joule_unit; }}</span></strong>
                                </p>
                            </div>
                        </div>
                            <p class="col-12 mt-3 text-[18px]"><strong><?= $lang[6] ?></strong></p>
                            <p class="col-12 mt-2"><?= $lang[7] ?></p>
                            <p class="col-12 mt-2"><?= $lang[8] ?>.</p>
                            <p class="col-12 mt-2">(K) = 1/2 *(m)*(v)^2</p>
                            <p class="col-12 mt-2"><?= $lang[9] ?>s</p>
                            <p class="col-12 mt-2"><?= $lang[10] ?></p>
                            <p class="col-12 mt-2"><?= $lang[11] ?></p>
                            <p class="col-12 mt-2">K = 1/2 *(<?php echo $mass; ?>)*(<?php echo $velocity;?>)^2</p>
                            <p class="col-12 mt-2">K = <?= $detail['answer'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    
@endpush