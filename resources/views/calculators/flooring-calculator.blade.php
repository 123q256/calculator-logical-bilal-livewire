<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
        
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
           
                    <div class="col-span-6">
                        <label for="room_length" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="room_length[]" id="room_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset(request()->room_length[0]) ? request()->room_length[0] : '22' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="room_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_length_unit_dropdown')">{{ isset(request()->room_length_unit[0])?request()->room_length_unit[0]:'cm' }} ▾</label>
                            <input type="text" name="room_length_unit[]" value="{{ isset(request()->room_length_unit[0])?request()->room_length_unit[0]:'cm' }}" id="room_length_unit" class="hidden">
                            <div id="room_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="room_length_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'ft')">ft</p>
                            </div>
                        </div>
                     </div>

                    <div class="col-span-6">
                        <label for="room_width" class="font-s-14 text-blue one_text">{{$lang['2']}}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="room_width[]" id="room_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset(request()->room_width[0]) ? request()->room_width[0] : '13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="room_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_width_unit_dropdown')">{{ isset(request()->room_width_unit[0])?request()->room_width_unit[0]:'cm' }} ▾</label>
                            <input type="text" name="room_width_unit[]" value="{{ isset(request()->room_width_unit[0])?request()->room_width_unit[0]:'cm' }}" id="room_width_unit" class="hidden">
                            <div id="room_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="room_width_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'ft')">ft</p>
                            </div>
                        </div>
                     </div>
                   
                    <div class="khali_div col-span-12">
                    </div>
                    <div class="col-span-12 my-2">
                        <span title="Add More Fields" class="units_active p-2 bg-[#2845F5] text-white radius-5 cursor-pointer rounded" id="btn7"><b><span>+</span><?=$lang['3']?></b></button>
                    </div>
                    <p class="col-span-12">{{$lang['4']}} (Optional):</p>
                    <div class="col-span-6">
                        <label for="cost" class="font-s-14 text-blue one_text">{{$lang['5']}}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="cost" id="cost" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cost'])?$_POST['cost']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="cost_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cost_unit_dropdown')">{{ isset($_POST['cost_unit'])?$_POST['cost_unit']: $currancy.' m²'  }} ▾</label>
                            <input type="hidden" name="currancy" value="{{$currancy}}">
                            <input type="text" name="cost_unit" value="{{ isset($_POST['cost_unit'])?$_POST['cost_unit']: $currancy.' m²'  }}" id="cost_unit" class="hidden">
                            <div id="cost_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cost_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cost_unit', '{{$currancy}} m²')">{{$currancy}} m²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cost_unit', '{{$currancy}} ft²')">{{$currancy}} ft²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cost_unit', '{{$currancy}} yd²')">{{$currancy}} yd²</p>
                            </div>
                        </div>
                     </div>
                    <div class="col-span-6">
                        <label for="waste_factor" class="font-s-14 text-blue one_text">{{$lang['6']}} %:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="waste_factor" id="waste_factor" class="input" aria-label="input"
                                value="{{ isset(request()->waste_factor) ? request()->waste_factor : '' }}" />
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

    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full justify-content-between">
                        @php
                            $cost = request()->cost;   
                        @endphp
                        <div class="row my-1">
                            <div class="col-lg-6 font-s-18">
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['area']}} (m<sup>2</sup>)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['8']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['total_material']}} (m<sup>2</sup>)</td>
                                    </tr>
                                    @if(!empty($cost))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['9']}} :</strong></td>
                                            <td class="border-b py-2">{{$currancy.' '.$detail['price']}}</td>
                                        </tr>
                                    @endif
                                </table>
                                <p class="mt-2 mb-1"><strong>{{$lang['10']}}</strong></p>
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-1">{{$lang['7']}} :</td>
                                        <td class="border-b">{{round($detail['area']*10.764,4)}} square feet (ft<sup>2</sup>)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-1">{{$lang['7']}} :</td>
                                        <td class="border-b">{{round($detail['area']*1.196,4)}}  square yards (yd<sup>2</sup>)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="w-full text-center mt-[15px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
            </div>
        </div>
        </div>
    </div>
    @endif
</form>
@push('calculatorJS')
    <script>
        var x=0;

        document.getElementById("btn7").addEventListener('click', function(){
        if(4>x){
            var read =
                `  <div class="grid grid-cols-12  gap-4">
                <div class="col-span-6">
                <label for="room_length${x}" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="room_length[]" id="room_length${x}" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset(request()->room_length[0]) ? request()->room_length[0] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="room_length_unit${x}" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_length_unit${x}_dropdown')">{{ isset(request()->room_length_unit[0])?request()->room_length_unit[0]:'cm' }} ▾</label>
                    <input type="text" name="room_length_unit[]" value="{{ isset(request()->room_length_unit[0])?request()->room_length_unit[0]:'cm' }}" id="room_length_unit${x}" class="hidden">
                    <div id="room_length_unit${x}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden room_length_unit${x}" to="room_length_unit${x}">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit${x}', 'cm')">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit${x}', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit${x}', 'in')">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit${x}', 'ft')">ft</p>
                    </div>
                </div>
                </div>
                 <div class="col-span-6">
                <label for="room_width${x}" class="font-s-14 text-blue one_text">{{$lang['2']}}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="room_width[]" id="room_width${x}" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset(request()->room_width[0]) ? request()->room_width[0] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="room_width_unit${x}" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_width_unit${x}_dropdown')">{{ isset(request()->room_width_unit[0])?request()->room_width_unit[0]:'cm' }} ▾</label>
                    <input type="text" name="room_width_unit[]" value="{{ isset(request()->room_width_unit[0])?request()->room_width_unit[0]:'cm' }}" id="room_width_unit${x}" class="hidden">
                    <div id="room_width_unit${x}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden room_width_unit${x}" to="room_width_unit${x}">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit${x}', 'cm')">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit${x}', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit${x}', 'in')">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit${x}', 'ft')">ft</p>
                    </div>
                </div>
                </div>
                    </div>`
            document.querySelector(".khali_div").insertAdjacentHTML('beforeend', read);
        }else{
            alert('Only Five Fields are Allowed');
        }
        x++;
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>