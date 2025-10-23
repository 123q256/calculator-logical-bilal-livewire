<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-3 lg:gap-3">

            <div class="col-span-12 ">
                <label for="b" class="font-s-14 text-blue">{!! $lang['b'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="b" id="b" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["<2 mg/dL (<34.2 µmol/L)","2-3 mg/dL (34.2-51.3 µmol/L)","3 mg/dL (>51.3 µmol/L)"];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['b'])?$_POST['b']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 ">
                <label for="a" class="font-s-14 text-blue">{!! $lang['a'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="a" id="a" class="input">
                        @php
                            $name = ["3.5 g/dL (>35 g/L)","2.8-3.5 g/dL (28-35 g/L)","<2.8 g/dL (<28 g/L)"];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['a'])?$_POST['a']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-64">
                <label for="i" class="font-s-14 text-blue">{!! $lang['i'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="i" id="i" class="input">
                        @php
                            $name = ["<1.7","1.7-2.2","2.2"];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['i'])?$_POST['i']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="as" class="font-s-14 text-blue">{!! $lang['as'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="as" id="as" class="input">
                        @php
                            $name = [$lang['a1'],$lang['a2'],$lang['a3']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['as'])?$_POST['as']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-64">
                <label for="e" class="font-s-14 text-blue">{!! $lang['e'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="e" id="e" class="input">
                        @php
                            $name = [$lang['e1'],$lang['e2'],$lang['e3']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['e'])?$_POST['e']:'1');
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
                            <p class="w-full text-[20px] mt-2"><strong><?=$cal_name?></strong></p>
                            <p class="w-full text-[28px]">
                                @if(isset($detail['ans']))
                                    <strong class="text-green-500">{!! $detail['ans'] !!}</strong>
                                @else
                                    <strong class="text-green-500">0.0 <span class="text-green-500 text-[25px]">Points</span></strong>
                                @endif
                            </p>
                            <p class="w-full text-[25px] mt-2">
                                <strong class="font-s-21">{{ $lang['class'] }} :</strong>
                                @if(isset($detail['class']))
                                    <strong>{!! $detail['class'] !!}</strong>
                                @else
                                    <strong>Nan</strong>
                                @endif
                            </p>
                            <p class="w-full text-[18px] mt-2">
                                @if(isset($detail['ansa']))
                                    {{ $detail['ansa'] }}
                                @else
                                    {{ $lang['life'] }}
                                @endif
                            </p>
                            <div class="col-10 border-t my-3"></div>
                            <p class="w-full text-[18px]">
                                @if(isset($detail['ansb']))
                                    {{ $detail['ansb'] }}
                                @else
                                    {{ $lang['inter'] }}
                                @endif
                            </p>
                            <div class="col-10 border-t my-3"></div>
                            <p class="w-full text-[18px]">
                                <span>{{ $lang['one_y'] }} :</span>
                                @if(isset($detail['percent1']))
                                    <strong>{{ $detail['percent1'] }} %</strong>
                                @else
                                    <strong>00 %</strong>
                                @endif
                            </p>
                            <div class="col-10 border-t my-3"></div>
                            <p class="w-full text-[18px]">
                                <span>{{ $lang['two_y'] }} :</span>
                                @if(isset($detail['percent2']))
                                    <strong>{{ $detail['percent2'] }} %</strong>
                                @else
                                    <strong>00 %</strong>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>