<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="conducting_wire_size" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <select name="conducting_wire_size" id="conducting_wire_size" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["6 AWG", "8 AWG", "10 AWG", "12 AWG", "14 AWG", "16 AWG", "18 AWG"];
                            $val = ["5", "3", "2.5", "2.25", "2", "1.75", "1.5"];
                            optionsList($val,$name,isset($_POST['conducting_wire_size'])?$_POST['conducting_wire_size']: '2.25' );
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="clamps" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <select name="clamps" id="clamps" class="input">
                        @php
                            $name = ["No", "Yes"];
                            $val = ["no", "yes"];
                            optionsList($val,$name,isset($_POST['clamps'])?$_POST['clamps']: 'no' );
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="conducting_wire" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <input type="number" step="any" name="conducting_wire" id="conducting_wire" class="input" aria-label="input"  value="{{ isset($_POST['conducting_wire'])?$_POST['conducting_wire']:'10' }}" />
                        <span class="input_unit text-blue">{{$lang['3']}}</span>
                </div>
                <div class="space-y-2">
                    <label for="fittings" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <select name="fittings" id="fittings" class="input">
                        @php
                            $name = ["No", "Yes"];
                            $val = ["no", "yes"];
                            optionsList($val,$name,isset($_POST['fittings'])?$_POST['fittings']: 'no' );
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="devices" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                    <input type="number" step="any" name="devices" id="devices" class="input" aria-label="input"  value="{{ isset($_POST['devices'])?$_POST['devices']:'5' }}" />
                        <span class="input_unit text-blue">{{$lang['6']}}</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="grounding_conductor" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                    <input type="number" step="any" name="grounding_conductor" id="grounding_conductor" class="input" aria-label="input"  value="{{ isset($_POST['grounding_conductor'])?$_POST['grounding_conductor']:'10' }}" />
                    <span class="input_unit text-blue">{{$lang['3']}}</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="largest_wire_size" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                    <select name="largest_wire_size" id="largest_wire_size" class="input">
                        @php
                           $name = ["6 AWG", "8 AWG", "10 AWG", "12 AWG", "14 AWG", "16 AWG", "18 AWG"];
                            $val = ["5", "3", "2.5", "2.25", "2", "1.75", "1.5"];
                            optionsList($val,$name,isset($_POST['largest_wire_size'])?$_POST['largest_wire_size']: '2.25' );
                        @endphp
                    </select>
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
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                        <div class="flex flex-wrap my-2">
                            <div class="w-full text-lg">
                                <table class="w-full">
                                    @if ($detail['conducting_wire_size'] == $detail['largest_wire_size'])
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2 w-7/10"><strong>{{$lang['10']}} :</strong></td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['total_volume_allowance_needed']}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2 w-7/10"><strong>{{$lang['11']}} :</strong></td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['larg_cond_wire']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2"><strong>{{$lang['12']}} :</strong></td>
                                            <td class="border-b border-[#99EA48] py-2">{{round($detail['grounding_fill_vol_allownce'],1)}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="border-b border-[#99EA48] py-2"><strong>{{$lang['13']}} :</strong></td>
                                        <td class="border-b border-[#99EA48] py-2">{{$detail['total_box_vol']}} (c<sup>3</sup>)</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-lg mt-3">
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2 w-7/10">{{ $lang[14] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['conducting_wire']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[15] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['conducting_wire_size']}} <span>(c<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[16] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['conductor_fill_volume']}} <span>(c<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[17] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['clamp_vol_allownce']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[18] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['clamp_fill_vol']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[19] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['fitt_vol_allownce']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[20] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['fitt_fill_vol']}} <span>(c<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[21] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['device_vol_allownce']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[22] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['device_fill_vol']}} <span>(c<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[23] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['grounding_fill_vol_allownce']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[24] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['largest_wire_size']}} <span>(c<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-[#99EA48] py-2">{{ $lang[25] }} :</td>
                                            <td class="border-b border-[#99EA48] py-2">{{$detail['grounding_fill_vol']}} <span>(c<sup>3</sup>)</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>