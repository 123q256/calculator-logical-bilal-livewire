<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
         
            <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                <input type="hidden" name="type" id="type" value="first">
            <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  wed  {{ isset($_POST['type']) && $_POST['type'] !== 'first'  ? '' :'tagsUnit' }}" id="wed">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel {{ isset($_POST['type']) && $_POST['type'] == 'second' ? 'tagsUnit' :'' }}" id="rel">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
            </div>

            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 simple mt-2 {{ isset($_POST['type']) && $_POST['type'] !== 'first'  ? 'hidden' :'row' }}">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="w-100 py-2">
                                <select class="input" name="operations" id="operations">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {{ $arr2[$index] }}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['4'],$lang['5'],$lang['6']];
                                        $val = ['1','2','3'];
                                        optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'3');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 " id="f1">
                            <label for="first" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="text" name="first" id="first" class="input" aria-label="input" value="{{ isset($_POST['first']) ? $_POST['first'] : '23' }}" />
                                @php
                                    function unit_values($names, $values, $post){
                                        $unit = '';
                                        foreach($values as $key => $unit_value){
                                            if($post == $unit_value){
                                                $unit = $names[$key];
                                            }
                                        }
                                        return $unit;
                                    }
                                    $unit_names = ['km', 'mi'];
                                    $unit_values = ['1','2'];
                                    $post_value = isset($_POST['units1'])?$_POST['units1']:'';
                                    $result_unit = unit_values($unit_names, $unit_values, $post_value);
                                @endphp
                                <label for="units1" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['units1'])?$result_unit:'km' }} ▾</label>
                                <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'1' }}" id="units1" class="hidden">
                                <div class="units units1 hidden" to="units1">
                                    <p value="1" data-value="km">km</p>
                                    <p value="2" data-value="mi">mi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 " id="s2">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="text" name="second" id="second" class="input" aria-label="input" value="{{ isset($_POST['second']) ? $_POST['second'] : '8' }}" />
                                @php 
                                    $unit_names = [$lang[7], 'US gal', 'UK gal'];
                                    $unit_values = ['1','2','3'];
                                    $post_value = isset($_POST['units2'])?$_POST['units2']:'1';
                                    $result_unit = unit_values($unit_names, $unit_values, $post_value);
                                @endphp
                                <label for="units2" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['units2'])?$result_unit: $lang[7] }} ▾</label>
                                <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'1' }}" id="units2" class="hidden">
                                <div class="units units2 hidden" to="units2">
                                    <p value="1" data-value="{{$lang[7]}}">{{$lang[7]}}</p>
                                    <p value="2" data-value="US gal">US gal</p>
                                    <p value="2" data-value="UK gal">UK gal</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6  hidden" id="t3">
                            <label for="third" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="text" name="third" id="third" class="input" aria-label="input" value="{{ isset($_POST['third']) ? $_POST['third'] : '3' }}" />
                                @php 
                                    $unit_names = ['L/100km', 'US mpg', 'UK mpg', 'kmpl'];
                                    $unit_values = ['1','2','3','4'];
                                    $post_value = isset($_POST['units3'])?$_POST['units3']:'';
                                    $result_unit = unit_values($unit_names, $unit_values, $post_value);
                                @endphp
                                <label for="units3" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['units3'])?$result_unit:'L/100km' }} ▾</label>
                                <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'1' }}" id="units3" class="hidden">
                                <div class="units units3 hidden" to="units3">
                                    <P value="1" data-value="L/100km">L/100km</P>
                                    <P value="2" data-value="US mpg">US mpg</P>
                                    <P value="3" data-value="UK mpg">UK mpg</P>
                                    <P value="4" data-value="kmpl">kmpl</P>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="four" class="font-s-14 text-blue">{{$lang[8]}} ({{$lang[9]}}):</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="text" name="four" id="four" class="input" aria-label="input" value="{{ isset($_POST['four']) ? $_POST['four'] : '' }}" />
                                @php 
                                    $unit_names = [$currancy.' '.$lang[7], $currancy.' US gal', $currancy. ' UK gal'];
                                    $unit_values = ['1','2','3'];
                                    $post_value = isset($_POST['units4'])?$_POST['units4']:'';
                                    $result_unit = unit_values($unit_names, $unit_values, $post_value);
                                @endphp
                                <label for="units4" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['units4'])?$result_unit: $currancy.' '.$lang[7] }} ▾</label>
                                <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'1' }}" id="units4" class="hidden">
                                <div class="units units4 hidden" to="units4">
                                    <p value="1" data-value="{{$currancy.' '. $lang[7]}}">{{$currancy.' '. $lang[7]}}</p>
                                    <p value="2" data-value="US gal">{{$currancy}} US gal</p>
                                    <p value="2" data-value="UK gal">{{$currancy}} UK gal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-span-12 advance mt-2 {{ isset($_POST['type']) && $_POST['type'] !== 'first'  ? 'row' :'hidden' }}">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                            <label for="ad_first" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="text" name="ad_first" id="ad_first" class="input" aria-label="input" value="{{ isset($_POST['ad_first']) ? $_POST['ad_first'] : '2105' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_second" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="text" name="ad_second" id="ad_second" class="input" aria-label="input" value="{{ isset($_POST['ad_second']) ? $_POST['ad_second'] : '2251' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_third" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="text" name="ad_third" id="ad_third" class="input" aria-label="input" value="{{ isset($_POST['ad_third']) ? $_POST['ad_third'] : '4' }}" />
                                @php 
                                    $unit_names = [$lang[7], 'US gal', 'UK gal'];
                                    $unit_values = ['1','2','3'];
                                    $post_value = isset($_POST['ad_units3'])?$_POST['ad_units3']:'';
                                    $result_unit = unit_values($unit_names, $unit_values, $post_value);
                                @endphp
                                <label for="ad_units3" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['ad_units3'])?$result_unit: $lang[7] }} ▾</label>
                                <input type="text" name="ad_units3" value="{{ isset($_POST['ad_units3'])?$_POST['ad_units3']:'1' }}" id="ad_units3" class="hidden">
                                <div class="units ad_units3 hidden" to="ad_units3">
                                    <p value="1" data-value="{{$lang[7]}}">{{$lang[7]}}</p>
                                    <p value="2" data-value="US gal">US gal</p>
                                    <p value="2" data-value="UK gal">UK gal</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ad_four" class="font-s-14 text-blue">{{$lang[8]}} ({{$lang[9]}}):</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="text" name="ad_four" id="ad_four" class="input" aria-label="input" value="{{ isset($_POST['ad_four']) ? $_POST['ad_four'] : '' }}" />
                                @php 
                                    $unit_names = [$currancy.' '. $lang[7], $currancy. ' US gal', $currancy,' UK gal'];
                                    $unit_values = ['1','2','3'];
                                    $post_value = isset($_POST['ad_units4'])?$_POST['ad_units4']:'';
                                    $result_unit = unit_values($unit_names, $unit_values, $post_value);
                                @endphp
                                <label for="ad_units4" class="text-blue input-unit text-decoration-underline">{{ isset($_POST['ad_units4'])?$result_unit: $currancy.' '. $lang[7] }} ▾</label>
                                <input type="text" name="ad_units4" value="{{ isset($_POST['ad_units4'])?$_POST['ad_units4']:'1' }}" id="ad_units4" class="hidden">
                                <div class="units ad_units4 hidden" to="ad_units4">
                                    <p value="1" data-value="{{$currancy.' '. $lang[7]}}">{{$currancy.' '. $lang[7]}}</p>
                                    <p value="2" data-value="{{$currancy}} US gal">US gal</p>
                                    <p value="2" data-value="{{$currancy}} UK gal">UK gal</p>
                                </div>
                            </div>
                        </div>
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
            <div class="w-full my-2">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="w-full md:w-[60%] lg:w-[60%] lg:text-[18px] md:text-[18px] text-[14px]">
                    <table class="w-full">
                        @php
                            $type = request()->type;
                            $operations = request()->operations;
                        @endphp
                        @if ($type == "first") 
                            @if ($operations == "1")
                                @php
                                    $j5 = 1.609344 * $detail['jawab'];
                                    $j5 = round($j5, 3);
                                @endphp
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[4]}}<span> (miles)</span> :</strong></td>
                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }}<span> (mi)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[4]}}<span> ({{$lang[13]}})</span> :</strong></td>
                                    <td class="border-b py-2">{{ $j5 }}<span> (km)</span></td>
                                </tr>
                                @if(!empty($detail['cost']))
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[14]}} :</strong></td>
                                        <td class="border-b py-2">{{$currancy.' '.$detail['cost'] }}</td>
                                    </tr>
                                @endif
                            @elseif ($operations == "2")
                                @php
                                   $j2 = 3.78541 * $detail['jawab'];
                                    $j2 = round($j2, 3);
                                    $j3 = $detail['jawab'] / 1.201;
                                    $j3 = round($j3, 3);
                                @endphp
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[5]}} :</strong></td>
                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }} (US gal)</td>
                                </tr>
                                @if(!empty($detail['cost']))
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[14]}} :</strong></td>
                                        <td class="border-b py-2">{{$currancy.' '.$detail['cost'] }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[7]}}<span> ({{$lang[13]}})</span> :</strong></td>
                                    <td class="border-b py-2">{{ $j2 }} ({{$lang[7]}})</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[15]}}<span> ({{$lang[13]}})</span> :</strong></td>
                                    <td class="border-b py-2">{{ $j3 }} (UK gal)</td>
                                </tr>
                            @elseif ($operations == "3")
                                @php
                                    $j2 = 235.215 / $detail['jawab'];
                                    $j2 = round($j2, 3);
                                    $j3 = 1.2 * $detail['jawab'];
                                    $j3 = round($j3, 3);
                                    $j4 = 0.425144 * $detail['jawab'];
                                    $j4 = round($j4, 3);
                                @endphp
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[6]}} :</strong></td>
                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }} (US mpg)</td>
                                </tr>
                                @if(!empty($detail['cost']))
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[14]}} :</strong></td>
                                        <td class="border-b py-2">{{$currancy.' '.$detail['cost'] }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[16]}} 100 {{$lang[13]}} :</strong></td>
                                    <td class="border-b py-2">{{ $j2 }} (L/100km)</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[18]}} (US) :</strong></td>
                                    <td class="border-b py-2">{{ round($detail['jawab'], 3) }} (US mpg)</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[18]}}<span> (UK)</span> :</strong></td>
                                    <td class="border-b py-2">{{ $j3 }} ((UK mpg))</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[17]}}<span> (UK)</span> :</strong></td>
                                    <td class="border-b py-2">{{ $j4 }} (kmpl)</td>
                                </tr>
                            @endif
                        @elseif($type == "second")
                            @php
                                $j2 = 235.215 / $detail['mi_jawab'];
                                $j2 = round($j2, 3);
                                $j3 = 1.2 * $detail['mi_jawab'];
                                $j3 = round($j3, 3);
                                $j4 = 0.425144 * $detail['mi_jawab'];
                                $j4 = round($j4, 3);
                                $j22 = 235.215 / $detail['km_jawab'];
                                $j22 = round($j22, 3);
                                $j32 = 1.2 * $detail['km_jawab'];
                                $j32 = round($j32, 3);
                                $j42 = 0.425144 * $detail['km_jawab'];
                                $j42 = round($j42, 3);
                            @endphp       
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[4]}} :</strong></td>
                                <td class="border-b py-2">{{ $detail['distance'] }} ({{$lang[19]}})</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[6]}} :</strong></td>
                                <td class="border-b py-2">{{ round($detail['mi_jawab'], 3) }} (US mpg)</td>
                            </tr>
                            @if(!empty($detail['ad_cost']))
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang[14]}} :</strong></td>
                                    <td class="border-b py-2">{{$currancy.' '.$detail['ad_cost']}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[16]}} 100 {{$lang[13]}} :</strong></td>
                                <td class="border-b py-2">{{$j2}} (L/100km)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[18]}} (US) :</strong></td>
                                <td class="border-b py-2">{{  round($detail['mi_jawab'], 3) }} (US mpg)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[18]}} (UK) :</strong></td>
                                <td class="border-b py-2">{{ $j3 }} (UK mpg)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[17]}} :</strong></td>
                                <td class="border-b py-2">{{ $j4 }} (kmpl)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[4]}} :</strong></td>
                                <td class="border-b py-2">{{ round($detail['km_dis'], 3) }} (km)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[6]}} :</strong></td>
                                <td class="border-b py-2">{{ round($detail['km_jawab'], 3) }} (US mpg)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[16]}} 100 {{$lang[13]}} :</strong></td>
                                <td class="border-b py-2">{{$j22}} (L/100km)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[18]}} (US) :</strong></td>
                                <td class="border-b py-2">{{  round($detail['km_jawab'], 3) }} (US mpg)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[18]}} (UK) :</strong></td>
                                <td class="border-b py-2">{{ $j32 }} (UK mpg)</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang[17]}} :</strong></td>
                                <td class="border-b py-2">{{ $j42 }} (kmpl)</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.querySelectorAll('.wed').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('type').value = 'first'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.advance').forEach(function(hours1) {
                    hours1.classList.add('hidden');
                    hours1.classList.remove('row');
                });
                document.querySelectorAll('.simple').forEach(function(hours1) {
                    hours1.classList.add('row');
                    hours1.classList.remove('hidden');
                });
                document.querySelectorAll('.rel').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.other').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
            })
        });
        document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('type').value = 'second'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.advance').forEach(function(hours1) {
                    hours1.classList.add('row');
                    hours1.classList.remove('hidden');
                });
                document.querySelectorAll('.simple').forEach(function(hours1) {
                    hours1.classList.add('hidden');
                    hours1.classList.remove('row');
                });
                document.querySelectorAll('.wed').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.other').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
            })
        });
        var t3 = document.getElementById('t3');
        var s2 = document.getElementById('s2');
        var f1 = document.getElementById('f1');
        document.getElementById('operations').addEventListener('change',function() {
            var cal=this.value;
            if(cal=='1'){
                t3.style.display = "block";
                s2.style.display = "block";
                f1.style.display = "none";
            }else if(cal=='2'){
                f1.style.display = "block";
                t3.style.display = "block";
                s2.style.display = "none";
            }else if(cal=='3'){
                f1.style.display = "block";
                s2.style.display = "block";
                t3.style.display = "none";
            }
        });
        @if(isset($detail))
            var cal = document.getElementById('operations').value;
            if(cal=='1'){
                t3.style.display = "block";
                s2.style.display = "block";
                f1.style.display = "none";
            }else if(cal=='2'){
                f1.style.display = "block";
                t3.style.display = "block";
                s2.style.display = "none";
            }else if(cal=='3'){
                f1.style.display = "block";
                s2.style.display = "block";
                t3.style.display = "none";
            }
        @endif
    </script>
@endpush