<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['find'] = "sin";
                }
            @endphp
            <div class="col-span-12">
                <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="find" id="find">
                        <option value="All" {{ isset($_POST['find']) && $_POST['find']=='All'?'selected':'' }}>All</option>
                        <option value="sin" {{ isset($_POST['find']) && $_POST['find']=='sin'?'selected':'' }}>sin(x)</option>
                        <option value="cos" {{ isset($_POST['find']) && $_POST['find']=='cos'?'selected':'' }}>cos(x)</option>
                        <option value="tan" {{ isset($_POST['find']) && $_POST['find']=='tan'?'selected':'' }}>tan(x)</option>
                        <option value="cot" {{ isset($_POST['find']) && $_POST['find']=='cot'?'selected':'' }}>cot(x)</option>
                        <option value="sec" {{ isset($_POST['find']) && $_POST['find']=='sec'?'selected':'' }}>sec(x)</option>
                        <option value="csc" {{ isset($_POST['find']) && $_POST['find']=='csc'?'selected':'' }}>csc(x)</option>
                        <option value="arcsin" {{ isset($_POST['find']) && $_POST['find']=='arcsin'?'selected':'' }}>arcsin(x)</option>
                        <option value="arccos" {{ isset($_POST['find']) && $_POST['find']=='arccos'?'selected':'' }}>arccos(x)</option>
                        <option value="arctan" {{ isset($_POST['find']) && $_POST['find']=='arctan'?'selected':'' }}>arctan(x)</option>
                        <option value="arccsc" {{ isset($_POST['find']) && $_POST['find']=='arccsc'?'selected':'' }}>arccsc(x)</option>
                        <option value="arcsec" {{ isset($_POST['find']) && $_POST['find']=='arcsec'?'selected':'' }}>arcsec(x)</option>
                        <option value="arccot" {{ isset($_POST['find']) && $_POST['find']=='arccot'?'selected':'' }}>arccot(x)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="angle" class="font-s-14 text-blue">{{$lang[2]}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                    <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (degs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">radians (rad)</p>
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
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    @if($detail['method'] == "1")
                                        @if($detail['angle_unit'] == "deg")
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $detail['find'] }} ({{$detail['angle']}}°) =</strong></td>
                                                <td class="py-2 border-b">{{round($detail['ans1'], 5)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{$detail['angle']}}°) =</strong></td>
                                                <td class="py-2 border-b">{{round($detail['ans2'], 5)}} (rad)</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $detail['find'] }} ({{$detail['angle']}}) =</strong></td>
                                                <td class="py-2 border-b">{{round($detail['ans1'], 5)}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{$detail['angle']}} rad) =</strong></td>
                                                <td class="py-2 border-b">{{round($detail['ans2'], 5)}}°</td>
                                            </tr>
                                        @endif
                                    @elseif($detail['method'] == "2")
                                        @if($detail['angle_unit'] == "deg")
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sin ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['sin']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cos ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['cos']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>tan ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['tan']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cot ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['cot']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sec ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['sec']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>csc ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['csc']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsin ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['asin']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccos ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['atan']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arctan ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['acos']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccot ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['acot']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsec ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['asec']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccsc ({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{$detail['acsc']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{round($detail['angle'], 5)}}°)</strong></td>
                                                <td class="py-2 border-b">{{round($detail['fns'], 5)}} (rad)</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sin ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['sin']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cos ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['cos']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>tan ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['tan']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>cot ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['cot']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>sec ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['sec']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>csc ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['csc']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsin ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['asin']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccos ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['atan']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arctan ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['acos']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccot ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['acot']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arcsec ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['asec']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>arccsc ({{round($detail['angle'], 5)}})</strong></td>
                                                <td class="py-2 border-b">{{$detail['acsc']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>({{round($detail['angle'], 5)}}) rad</strong></td>
                                                <td class="py-2 border-b">{{round($detail['fns'], 5)}}°</td>
                                            </tr>
                
                                        @endif
                                    @elseif($detail['method'] == "3")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$detail['find']}} ({{$detail['angle']}})</strong></td>
                                            <td class="py-2 border-b">{{$detail['deg']}}°</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$detail['find']}} ({{$detail['angle']}})</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} (rad)</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            @isset($detail['naam'])
                                <div class="w-full mt-2">
                                    <div class="w-full md:w-[60%] lg:w-[60%]">
                                        <img src="{{ asset('images/'.$detail['naam'].'.webp') }}" width="100%" height="100%" alt="{{$detail['naam']}}" loading="lazy" decoding="async">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>