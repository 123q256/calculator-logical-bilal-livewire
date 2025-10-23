<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="first" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first)?request()->first:'50' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="second" class="label">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="second" id="second" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7']];
                                $val = ["184.27","155.92",'141.75','184.27','198.45'];
                                optionsList($val,$name,isset(request()->second)?request()->second:'155.92');
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
                        <div class="w-full border-b pb-4">
                            <div class="w-full md:w-[80%] lg:w-[80%]">
                                <p><strong class="text-[#2845F5] mb-1">{{ $lang[25] }}</strong></p>
                                <div class="flex flex-wrap justify-between">
                                    <div class="px-3">
                                        <p>{{ $lang[8] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['meat_mass'], 2); }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[9] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['cheddar_cheese'], 2); }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[10] }}</p>
                                        <p>
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['monterey_cheese'], 2); }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border-b pb-4 mt-4">
                            <p class="my-2"><strong class="text-[#2845F5]">{{ $lang[26] }}</strong></p>
                            <div class="flex flex-wrap justify-between">
                                <div class="px-3">
                                    <p>{{ $lang[11] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['sour_cream'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3">
                                    <p>{{ $lang[12] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['guacamole'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3">
                                    <p>{{ $lang[13] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['taco_sauce'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                <div class="px-3">
                                    <p>{{ $lang[14] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['pico_de_gallo'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border-b pb-4 mt-4">
                            <p class="my-2"><strong class="text-[#2845F5]">{{ $lang[27] }}</strong></p>
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                    <p>{{ $lang[15] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['lettuce'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                    <p>{{ $lang[16] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['onions'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                    <p>{{ $lang[17] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['beans'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                    <p>{{ $lang[18] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['refried_beans'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-12  mt-[20px] gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                    <p>{{ $lang[19] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['tomatoes'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="col-span-6 md:col-span-3 lg:col-span-3 lg:border-r md:border-r">
                                    <p>{{ $lang[20] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['olives'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                                <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                    <p>{{ $lang[21] }}</p>
                                    <p class="col s12 white padding_10 center bdr-rad-7">
                                        <strong class="text-[28px] text-[#119154]">{{ round($detail['bell_pepper'], 2); }}</strong>
                                        <strong class="text-[#2845F5] font-s-20">g</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border-b pb-4 mt-4">
                            <div class="w-full md:w-[80%] lg:w-[80%]">
                                <p class="my-2"><strong class="text-[#2845F5]">{{ $lang[28] }}</strong></p>
                                <div class="flex flex-wrap justify-between">
                                    <div class="px-3">
                                        <p>{{ $lang[22] }}</p>
                                        <p class="col s12 white padding_10 center bdr-rad-7">
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['taco_shells'], 2); }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">#</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[23] }}</p>
                                        <p class="col s12 white padding_10 center bdr-rad-7">
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['tortillas'], 2); }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">#</strong>
                                        </p>
                                    </div>
                                    <div class="border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="px-3">
                                        <p>{{ $lang[24] }}</p>
                                        <p class="col s12 white padding_10 center bdr-rad-7">
                                            <strong class="text-[28px] text-[#119154]">{{ round($detail['rice'], 2); }}</strong>
                                            <strong class="text-[#2845F5] font-s-20">g</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                </div>
            </div>
        </div>

    @endisset
</form>