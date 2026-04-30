<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-8">
                    <label for="incidence" class="labele">{{ $lang[1] }} (I):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="incidence" id="incidence" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="incidence_unit" class="labele">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="incidence_unit" id="incidence_unit" class="input">
                            <option value="circle">{{ $lang[6] }}</option>
                            <option value="cycle">{{ $lang[7] }}</option>
                            <option value="degree">{{ $lang[8] }}</option>
                            <option value="gon">{{ $lang[9] }}</option>
                            <option value="gradian">{{ $lang[10] }}</option>
                            <option value="mil">{{ $lang[11] }}</option>
                            <option value="milliradian">{{ $lang[12] }}</option>
                            <option value="minute">{{ $lang[13] }}</option>
                            <option value="minutes of arc">{{ $lang[14] }}</option>
                            <option value="point">{{ $lang[15] }}</option>
                            <option value="quadrant">{{ $lang[16] }}</option>
                            <option value="quartercircle">{{ $lang[17] }}</option>
                            <option value="radian">{{ $lang[18] }}</option>
                            <option value="revolution">{{ $lang[19] }}</option>
                            <option value="right angle">{{ $lang[20] }}</option>
                            <option value="second">{{ $lang[21] }}</option>
                            <option value="semicircle">{{ $lang[22] }}</option>
                            <option value="sextant">{{ $lang[23] }}</option>
                            <option value="sign">{{ $lang[24] }}</option>
                            <option value="turn">{{ $lang[25] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-8">
                    <label for="emergence" class="labele">{{ $lang[2] }} (E):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="emergence" id="emergence" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="emergence_unit" class="labele">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="emergence_unit" id="emergence_unit" class="input">
                            <option value="circle">{{ $lang[6] }}</option>
                            <option value="cycle">{{ $lang[7] }}</option>
                            <option value="degree">{{ $lang[8] }}</option>
                            <option value="gon">{{ $lang[9] }}</option>
                            <option value="gradian">{{ $lang[10] }}</option>
                            <option value="mil">{{ $lang[11] }}</option>
                            <option value="milliradian">{{ $lang[12] }}</option>
                            <option value="minute">{{ $lang[13] }}</option>
                            <option value="minutes of arc">{{ $lang[14] }}</option>
                            <option value="point">{{ $lang[15] }}</option>
                            <option value="quadrant">{{ $lang[16] }}</option>
                            <option value="quartercircle">{{ $lang[17] }}</option>
                            <option value="radian">{{ $lang[18] }}</option>
                            <option value="revolution">{{ $lang[19] }}</option>
                            <option value="right angle">{{ $lang[20] }}</option>
                            <option value="second">{{ $lang[21] }}</option>
                            <option value="semicircle">{{ $lang[22] }}</option>
                            <option value="sextant">{{ $lang[23] }}</option>
                            <option value="sign">{{ $lang[24] }}</option>
                            <option value="turn">{{ $lang[25] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-8">
                    <label for="prism" class="labele">{{ $lang[3] }} (A):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="prism" id="prism" class="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="prism_unit" class="labele">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="prism_unit" id="prism_unit" class="input">
                            <option value="circle">{{ $lang[6] }}</option>
                            <option value="cycle">{{ $lang[7] }}</option>
                            <option value="degree">{{ $lang[8] }}</option>
                            <option value="gon">{{ $lang[9] }}</option>
                            <option value="gradian">{{ $lang[10] }}</option>
                            <option value="mil">{{ $lang[11] }}</option>
                            <option value="milliradian">{{ $lang[12] }}</option>
                            <option value="minute">{{ $lang[13] }}</option>
                            <option value="minutes of arc">{{ $lang[14] }}</option>
                            <option value="point">{{ $lang[15] }}</option>
                            <option value="quadrant">{{ $lang[16] }}</option>
                            <option value="quartercircle">{{ $lang[17] }}</option>
                            <option value="radian">{{ $lang[18] }}</option>
                            <option value="revolution">{{ $lang[19] }}</option>
                            <option value="right angle">{{ $lang[20] }}</option>
                            <option value="second">{{ $lang[21] }}</option>
                            <option value="semicircle">{{ $lang[22] }}</option>
                            <option value="sextant">{{ $lang[23] }}</option>
                            <option value="sign">{{ $lang[24] }}</option>
                            <option value="turn">{{ $lang[25] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="deviation_unit" class="labele">{{ $lang[4] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="deviation_unit" id="deviation_unit" class="input">
                            <option value="circle">{{ $lang[6] }}</option>
                            <option value="cycle">{{ $lang[7] }}</option>
                            <option value="degree">{{ $lang[8] }}</option>
                            <option value="gon">{{ $lang[9] }}</option>
                            <option value="gradian">{{ $lang[10] }}</option>
                            <option value="mil">{{ $lang[11] }}</option>
                            <option value="milliradian">{{ $lang[12] }}</option>
                            <option value="minute">{{ $lang[13] }}</option>
                            <option value="minutes of arc">{{ $lang[14] }}</option>
                            <option value="point">{{ $lang[15] }}</option>
                            <option value="quadrant">{{ $lang[16] }}</option>
                            <option value="quartercircle">{{ $lang[17] }}</option>
                            <option value="radian">{{ $lang[18] }}</option>
                            <option value="revolution">{{ $lang[19] }}</option>
                            <option value="right angle">{{ $lang[20] }}</option>
                            <option value="second">{{ $lang[21] }}</option>
                            <option value="semicircle">{{ $lang[22] }}</option>
                            <option value="sextant">{{ $lang[23] }}</option>
                            <option value="sign">{{ $lang[24] }}</option>
                            <option value="turn">{{ $lang[25] }}</option>
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
                            <p class="text-[18px]"><strong>{{$lang['5']}} (D)</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                <strong class="">{{ round($detail['deviation'], 4) }} {{ $deviation_unit }}</strong>
                            </p>
                        </div>
                    </div>
                        <p class="col-12 mt-3 text-[18px]"><strong>{{ $lang[31] }}</strong></p>
                        <p class="col-12 mt-2">({{ $lang[26] }})</p>
                        <p class="col-12 mt-2">{{ $lang[5] }} = {{ $lang[1] }} + {{ $lang[2] }} - {{ $lang[3] }}</p>
                        <p class="col-12 mt-2">D = I + E - A</p>
                        <p class="col-12 mt-2">{{ $lang[27] }}</p>
                        <p class="col-12 mt-2">{{ $lang[1] }}: {{ $incidence }} -> {{ round($detail['incidence'], 4) }}({{ $incidence_unit }})</p>
                        <p class="col-12 mt-2">{{ $lang[2] }}: {{ $emergence }} -> {{ round($detail['emergence'], 4) }}({{ $emergence_unit }}) </p>
                        <p class="col-12 mt-2">{{ $lang[3] }}: {{ $prism }} -> {{ round($detail['prism'], 4) }}({{ $prism_unit }})</p>
                        <p class="col-12 mt-2">{{ $lang[28] }}</p>
                        <p class="col-12 mt-2">D = I + E - A -> {{ round($detail['incidence'], 4) }} + {{ round($detail['emergence'], 4) }} - {{ round($detail['prism'], 4) }}</p>
                        <p class="col-12 mt-2">{{ $lang[29] }}</p>
                        <p class="col-12 mt-2">D = {{ round($detail['deviation'], 4) }}</p>
                        <p class="col-12 mt-2">{{ $lang[30] }}</p>
                        <p class="col-12 mt-2">D = {{ round($detail['deviation'], 4) }} {{ $deviation_unit }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
</div>
