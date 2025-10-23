<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-6">
                <label for="age" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'18' }}" />
                    <span class="text-blue input_unit">years</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="gender" class="label">{!! $lang['2'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="gender" id="gender" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name=["Male","Female"];
                            $val = ["male","female"];
                            optionsList($val,$name,isset(request()->gender)?request()->gender:'male');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="RHR" class="label">{!! $lang['3'] !!} ({!! $lang['4'] !!}):</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="RHR" id="RHR" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->RHR)?request()->RHR:'' }}" />
                    <span class="text-blue input_unit">bpm</span>
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
                @php
                    $age = request()->age;
                    $gender = request()->gender;
                    $RHR = request()->RHR;
                @endphp
                <div class="col-12">
                    @if(is_numeric($detail['MHR']))
                        <p><strong>{{ $lang[6] }}</strong></p>
                        <p><strong class="text-green-700 text-[32px]">{{ $detail['MHR'] }}</strong> <span class="text-green-700 text-[20px]">bpm</span></p>
                    @endif
                    @if(is_numeric($detail['HRR']))
                        <p><strong>{{ $lang[7] }}</strong></p>
                        <p><strong class="text-green-700 text-[32px]">{{ $detail['HRR'] }}</strong> <span class="text-green-700 text-[20px]">bpm</span></p>
                    @endif
                    @if(!empty($detail['res_normal']))
                        <p class="mt-1"><strong class="text-blue">{{ $detail['res_normal'] }}</strong></p>
                    @endif
                    <p class="my-2"><strong class="text-blue-700 border-b-2">Fat Burning Zone</strong></p>
                    <div class="w-full overflow-auto">
                        <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                            <tr>
                                <th class="text-start border-b py-2">Method</th>
                                <th class="text-start border-b py-2">THR in bpm</th>
                            </tr>
                            <tr>
                                <td class="border-b py-2">60-80% of maximum heart rate</td>
                                <td class="border-b py-2"><strong>{{ round($detail['percent_lower']) }} - {{ round($detail['percent_upper']) }}</strong></td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">Zoladz method</td>
                                <td class="border-b py-2"><strong>{{ round($detail['zoladz_lower']) }} - {{ round($detail['zoladz_upper']) }}</strong></td>
                            </tr>
                            @if(is_numeric($detail['karvonen_lower']) && is_numeric($detail['karvonen_upper']))
                                <tr>
                                    <td class="py-2">Karvonen method</td>
                                    <td class="py-2"><strong>{{ round($detail['karvonen_lower']) }} - {{ round($detail['karvonen_upper']) }}</strong></td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <p class="mt-3 mb-2"><strong class="text-blue-700 border-b-2">{{ $lang[27] }}:</strong></p>
                    <p><strong>{{ $lang[1] }}</strong>: {{ $age }}</p>
                    <p><strong>{{ $lang[19] }}</strong>: {{ $gender }}</p>
                    @if(is_numeric($RHR))
                        <p><strong>{{ $lang[20] }}</strong>: {{ $RHR }}</p>
                    @endif
                    <p class="mt-3 mb-2"><strong class="text-blue-700 border-b-2">{{ $lang[21] }}:</strong></p>
                    <p><strong>{{ $lang[22] }}</strong></p>
                    <p>{{ $lang[22] }}: 220 - Age</p>
                    <p>{{ $lang[22] }}: 220 - {{ $age }}</p>
                    <p>{{ $lang[22] }}: {{ $detail['MHR'] }} bpm</p>
                    @if(is_numeric($RHR))
                        <p class="mt-2"><strong>{{ $lang[23] }}</strong></p>
                        <p>{{ $lang[23] }}: {{ $lang[22] }} - {{ $lang[22] }}</p>
                        <p>{{ $lang[23] }}: {{ $detail['MHR'] }} - {{ $RHR }}</p>
                        <p>{{ $lang[23] }}: {{ $detail['HRR'] }} bpm</p>
                    @endif
                    <p class="mt-2"><strong>60-80% {{ $lang[24] }}</strong></p>
                    <p>THR = [60% x {{ $lang[22] }}] - [80% x {{ $lang[22] }}]</p>
                    <p>THR = [60% x {{ $detail['MHR'] }}] - [80% x {{ $detail['MHR'] }}]</p>
                    <p>THR = {{ round($detail['percent_lower']) }} - {{ round($detail['percent_upper']) }} bpm</p>
                    
                    <p class="mt-2"><strong>{{ $lang[25] }}</strong></p>
                    <p>THR = HRmax − Adjuster ± 5 bpm</p>
                    <p>THR = [{{ $detail['MHR'] }} - 50 ± 5] - [{{ $detail['MHR'] }} - 40 ± 5]</p>
                    <p>THR = [{{ $detail['MHR'] - 50  }} ± 5] - [{{ $detail['MHR'] - 40 }} ± 5]</p>
                    <p>THR = {{ $detail['zoladz_lower'] }} - {{ $detail['zoladz_upper'] }} bpm</p>
        
                    @if(is_numeric($detail['karvonen_lower']) && is_numeric($detail['karvonen_upper']))
                        <p class="mt-2"><strong>{{ $lang[26] }}</strong></p>
                        <p>THR = [60% of HRR + RHR] - [80% of HRR + RHR]</p>
                        <p>THR = [{{ round($detail['HRR']*60/100) }} + {{ $RHR }}] - [{{ round($detail['HRR']*60/100) }} + {{ $RHR }}]</p>
                        <p>THR = {{ round($detail['karvonen_lower']) }} - {{ round($detail['karvonen_upper']) }} bpm</p>
                    @endif
                    @if(!empty($detail['res0']))
                        <p class="my-2"><strong class="text-blue-700 border-b-2">{{ $lang[11] }}:</strong></p>
                        <div class="w-full overflow-auto">
                            <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                <tr>
                                    <td class="border-b py-2">{{ $lang[12] }}:</td>
                                    <td class="border-b py-2">{{ $detail['res0'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang[13] }}:</td>
                                    <td class="border-b py-2">{{ $detail['res1'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang[14] }}:</td>
                                    <td class="border-b py-2">{{ $detail['res2'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang[15] }}:</td>
                                    <td class="border-b py-2">{{ $detail['res3'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang[16] }}:</td>
                                    <td class="border-b py-2">{{ $detail['res4'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang[17] }}:</td>
                                    <td class="border-b py-2">{{ $detail['res5'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">{{ $lang[18] }}:</td>
                                    <td class="py-2">{{ $detail['res6'] }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            </div>
        </div>
    </div>
    @endisset
</form>