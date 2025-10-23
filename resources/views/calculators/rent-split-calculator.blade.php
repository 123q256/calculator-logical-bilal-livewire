<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    @if(!isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-6">
                    <label for="total_rent" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="total_rent" id="total_rent" class="input" aria-label="input"
                            value="{{ isset(request()->total_rent) ? request()->total_rent : '1000' }}" />
                            <span class="input_unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="total_area" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="total_area" id="total_area" class="input" aria-label="input"
                            value="{{ isset(request()->total_area) ? request()->total_area : '1200' }}" />
                            <span class="input_unit text-blue">ft<sup>2</sup></span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="bedrooms" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="bedrooms" id="bedrooms" class="input" aria-label="input"
                            value="{{ isset(request()->bedrooms) ? request()->bedrooms : '2' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <table class="w-full" id="rooms">
                        <tr>
                            <td class="text-center" width="10%"><strong>{{$lang[15]}} #</strong></td>
                            <td class="text-center" width="30%"><strong>{{$lang[16]}} (ft<sup>2</sup>)</strong></td>
                            <td class="text-center" width="30%"><strong>{{$lang[17]}}</strong></td>
                            <td class="text-center" width="30%"><strong>{{$lang[18]}}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <div class="w-full py-2  relative">
                                    <input type="number" step="any" name="room_area[1]" id="room_area[1]" class="input" aria-label="input"
                                        value="{{ isset(request()->room_area[1]) ? request()->room_area[1] : '350' }}" />
                                        <span class="input_unit text-blue">ft<sup>2</sup></span>
                                </div>
                            </td>
                            <td class="px-lg-2">
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="persons[1]" id="persons[1]" class="input" aria-label="input"
                                        value="{{ isset(request()->persons[1]) ? request()->persons[1] : '5' }}" />
                                </div>
                            </td>
                            <td>
                                <div class="w-full py-2">
                                    <select class="input" name="bath[1]" id="bath">
                                        <option selected value="100">{{$lang[12]}}</option>
                                        <option value="50">{{$lang[13]}}</option>
                                        <option value="0">{{$lang[14]}}</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <div class="w-full py-2  relative">
                                    <input type="number" step="any" name="room_area[2]" id="room_area[2]" class="input" aria-label="input"
                                        value="{{ isset(request()->room_area[2]) ? request()->room_area[2] : '275' }}" />
                                    <span class="input_unit text-blue">ft<sup>2</sup></span>
                                </div>
                            </td>
                            <td class="px-lg-2">
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="persons[2]" id="persons[2]" class="input" aria-label="input"
                                        value="{{ isset(request()->persons[2]) ? request()->persons[2] : '3' }}" />
                                </div>
                            </td>
                            <td>
                                <div class="w-full py-2">
                                    <select class="input" name="bath[2]" id="bath">
                                        <option selected value="100">{{$lang[12]}}</option>
                                        <option value="50">{{$lang[13]}}</option>
                                        <option value="0">{{$lang[14]}}</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row my-2">
                        <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">   
                            <table class="w-full">
                                @foreach($detail['room_rent'] as $key => $val)
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang[10]}} {{ $key }} {{$lang[11]}}</strong></td>
                                        <td class="border-b py-2">{{$currancy.' '.$val}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-[20px]">
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
    @endif
</form>
@push('calculatorJS')
    <script>
        function room(counter) {
            var html = '<tr>\
                            <td class="text-center">'+counter+'</td>\
                            <td>\
                                <div class="w-full py-2  relative">\
                                    <input type="number" step="any" name="room_area['+counter+']" id="room_area['+counter+']" class="input" aria-label="input"\
                                        value="{{ isset(request()->room_area['+counter+']) ? request()->room_area['+counter+'] : '275' }}" />\
                                        <span class="input_unit text-blue">ft<sup>2</sup></span>\
                                </div>\
                            </td>\
                            <td class="px-lg-2">\
                                <div class="w-full py-2">\
                                    <input type="number" step="any" name="persons['+counter+']" id="persons['+counter+']" class="input" aria-label="input"\
                                        value="{{ isset(request()->persons['+counter+']) ? request()->persons['+counter+'] : '2' }}" />\
                                </div>\
                            </td>\
                            <td>\
                                <div class="w-full py-2">\
                                    <select class="input" name="bath['+counter+']" id="bath">\
                                        <option selected value="100">{{$lang[12]}}</option>\
                                        <option value="50">{{$lang[13]}}</option>\
                                        <option value="0">{{$lang[14]}}</option>\
                                    </select>\
                                </div>\
                            </td>\
                        </tr>';
            
            var roomsTable = document.getElementById('rooms');
            roomsTable.insertAdjacentHTML('beforeend', html);
        }
        document.addEventListener("DOMContentLoaded", function() {
            'use strict';
            document.getElementById('bedrooms').addEventListener('change', function() {
                document.getElementById('rooms').innerHTML = '';
                var val = parseInt(this.value);
                if(val > 0 && val < 100){
                    var tableHeader = '<tr class="text-center" >\
                                            <td width="10%"><strong>{{$lang[15]}} #</strong></td>\
                                            <td width="30%"><strong>{{$lang[16]}} (ft<sup>2</sup>)</strong></td>\
                                            <td width="30%"><strong>{{$lang[17]}}</strong></td>\
                                            <td width="30%"><strong>{{$lang[18]}}</strong></td>\
                                        </tr>';
                    document.getElementById('rooms').insertAdjacentHTML('beforeend', tableHeader);

                    for (var i = 1; i <= val; i++) {
                        room(i);
                    }
                }
                else{
                    alert("No. of Rooms must be greater than 0 and less than 100");
                }
            });
        });
    </script>
@endpush