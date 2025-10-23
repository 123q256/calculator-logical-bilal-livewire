<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12"><strong class="text-blue-500 border-b">{{ $lang['1'] }}</strong></div>
                <div class="col-span-6">
                    <label for="a1" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a1" id="a1" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name=[$lang['3'],$lang['4']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->a1)?request()->a1:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a2" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a2" id="a2" class="input">
                            @php
                                $name=[$lang['6'],$lang['7'],$lang['8']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->a2)?request()->a2:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a3" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a3" id="a3" class="input">
                            @php
                                $name=[$lang['10'],$lang['11'],$lang['12']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->a3)?request()->a3:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a4" class="font-s-14 text-blue">{!! $lang['13'] !!} (5s):</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a4" id="a4" class="input">
                            @php
                                $name=[$lang['14'],$lang['15'],$lang['16']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->a4)?request()->a4:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a5" class="font-s-14 text-blue">{!! $lang['17'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a5" id="a5" class="input">
                            @php
                                $name=[$lang['14'],$lang['18'],$lang['19']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->a5)?request()->a5:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a6" class="font-s-14 text-blue">{!! $lang['20'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a6" id="a6" class="input">
                            @php
                                $name=[$lang['21'],$lang['22'],$lang['23']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->a6)?request()->a6:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a7" class="font-s-14 text-blue">{!! $lang['24'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a7" id="a7" class="input">
                            @php
                                $name=[$lang['14'],$lang['23']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->a7)?request()->a7:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a8" class="font-s-14 text-blue">{!! $lang['25'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a8" id="a8" class="input">
                            @php
                                $name = [$lang['26'],$lang['27']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->a8)?request()->a8:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a9" class="font-s-14 text-blue">{!! $lang['28'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a9" id="a9" class="input">
                            @php
                                $name=[$lang['29'],$lang['23']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->a9)?request()->a9:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a10" class="font-s-14 text-blue">{!! $lang['30'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="a10" id="a10" class="input">
                            @php
                                $name = [$lang['31'],$lang['32'],$lang['33']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->a10)?request()->a10:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12"><strong class="text-blue-500 border-b">{{ $lang['34'] }}</strong></div>
                <div class="col-span-6">
                    <label for="b1" class="font-s-14 text-blue">{!! $lang['37'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b1" id="b1" class="input">
                            @php
                                $name=[$lang['35'],$lang['36']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b1)?request()->b1:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b2" class="font-s-14 text-blue">{!! $lang['38'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b2" id="b2" class="input">
                            @php
                                $name=[$lang['39'],$lang['40']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b2)?request()->b2:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b3" class="font-s-14 text-blue">{!! $lang['41'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b3" id="b3" class="input">
                            @php
                                $name=[$lang['39'],$lang['42']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b3)?request()->b3:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b4" class="font-s-14 text-blue">{!! $lang['43'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b4" id="b4" class="input">
                            @php
                                $name=[$lang['44'],$lang['45']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b4)?request()->b4:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b5" class="font-s-14 text-blue">{!! $lang['46'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b5" id="b5" class="input">
                            @php
                                $name=[$lang['44'],$lang['47']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b5)?request()->b5:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b6" class="font-s-14 text-blue">{!! $lang['48'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b6" id="b6" class="input">
                            @php
                                $name = [$lang['49'],$lang['50']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b6)?request()->b6:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b7" class="font-s-14 text-blue">{!! $lang['51'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b7" id="b7" class="input">
                            @php
                                $name=[$lang['52'],$lang['53']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b7)?request()->b7:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b8" class="font-s-14 text-blue">{!! $lang['54'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b8" id="b8" class="input">
                            @php
                                $name=[$lang['55'],$lang['56'],$lang['57']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->b8)?request()->b8:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b9" class="font-s-14 text-blue">{!! $lang['58'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b9" id="b9" class="input">
                            @php
                                $name=[$lang['59'],$lang['60'],$lang['61']];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset(request()->b9)?request()->b9:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b10" class="font-s-14 text-blue">{!! $lang['62'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="b10" id="b10" class="input">
                            @php
                                $name = [$lang['63'],$lang['64']];
                                $val = ["0","1"];
                                optionsList($val,$name,isset(request()->b10)?request()->b10:'1');
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


    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  p-3 mt-3">
                        <div class="w-full ">
                            <div class="w-full  overflow-auto mb-2">
                                <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                    <tr>
                                        <td class="text-[#2845F5] border-b py-2">{{ $lang['65'] }}</td>
                                        <td class="border-b py-2">{{ $detail['add1'] }} / 16</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-[#2845F5] border-b py-2">{{ $lang['66'] }}</td>
                                        <td class="border-b py-2">{{ $detail['add2'] }} / 12</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-[#2845F5] py-2">{{ $lang['67'] }}</td>
                                        <td class="py-2">{{ $detail['add1'] + $detail['add2'] }} / 28</strong></td>
                                    </tr>
                                </table>
                            </div>
                            @if($detail['add3']<19)
                                <p><strong class="text-[[#2845F5]]">{{ $lang['68'] }} {{ $lang['71'] }}.</strong></p>
                            @elseif($detail['add3']>=19 && $detail['add3'] <=23)
                                <p><strong class="text-[#2845F5]">{{ $lang['69'] }} {{ $lang['71'] }}.</strong></p>
                            @elseif($detail['add3']>23): ?>
                                <p><strong class="text-[#2845F5]">{{ $lang['70'] }} {{ $lang['71'] }}.</strong></p>
                            @endif
                        </div>
                        <div class="w-full text-center my-[25px]">
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
    
    @endisset
</form>