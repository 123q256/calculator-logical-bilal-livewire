<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="serving" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select name="serving" id="serving" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3']];
                            $val = ["per 100 g","per serving"];
                            optionsList($val,$name,isset(request()->serving)?request()->serving:'per serving');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="location" class="label">{!! $lang['4'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select name="location" id="location" class="input">
                        @php
                            $name = [$lang['5'],$lang['6']];
                            $val = ["yes","no"];
                            optionsList($val,$name,isset(request()->location)?request()->location:'yes');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="carbohydrates" class="label">{!! $lang['7'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="carbohydrates" id="carbohydrates" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->carbohydrates)?request()->carbohydrates:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="fiber" class="label">{!! $lang['8'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="fiber" id="fiber" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->fiber)?request()->fiber:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="alcohol" class="label">{!! $lang['9'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="alcohol" id="alcohol" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->alcohol)?request()->alcohol:'30' }}" />
                </div>
            </div>
            <div class="col-span-12"><strong class="text-blue-500 text-[18px]">{{ $lang['10'] }}</strong></div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="contains" class="label">{!! $lang['11'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select name="contains" id="contains" class="input">
                        @php
                            $name = [$lang['5'],$lang['6']];
                            $val = ["yes","no"];
                            optionsList($val,$name,isset(request()->contains)?request()->contains:'no');
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
                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{!! (request()->serving == 'per serving') ? "Servings consumed = <span class='text-green-500 text-[28px]'>1</span>" : "Weight of your product = <span class='text-green-500 text-[28px]'>100</span>" !!}</strong>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{{ $lang['13'] }} =</strong>
                                    <strong class="text-green-500 text-[28px]">{{ $detail['Net_carbs'] }}</strong>
                                    <span>g</span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                    <strong>{{ $lang['14'] }} =</strong>
                                    <strong class="text-green-500 text-[28px]">{{ $detail['Net_carbs'] * 4 }}</strong>
                                    <span>kcal</span>
                                </div>
                            </div>
                        </div>
                        <!-- ----------------------------------- inputs --------------------------------- -->
                        @php $serving = (isset(request()->serving) && request()->serving == 'per serving') ? 'serving' : '100g' @endphp
                        <p class="font-s-18 mt-2"><strong>{{ $lang['15'] }}</strong></p>
                        <p class="mt-1">{{ $lang['7'] }} : {{ $detail['carbohydrates'] }} g per {{ $serving }}</p>
                        <p class="mt-1">{{ $lang['8'] }} : {{ $detail['fiber'] }} g per {{ $serving }}</p>
                        <p class="mt-1">{{ $lang['9'] }} : {{ $detail['alcohol'] }} g per {{ $serving }}</p>
                        <!-- -------------------------- Solution ----------------------- -->
                        <p class="font-s-18 mt-3"><strong>{{ $lang['16'] }}</strong></p>
                        <p class="mt-1">{{ $lang['17'] }}</p>
                        <p class="mt-1">{{ $lang['18'] }} = 
                            <span>Total carbohydrate - Fiber -</span>
                            <span class="fraction">
                                <span class="num">(Sugar alcohol)</span>
                                <span class="visually-hidden"></span>
                                <span class="den">2</span>
                            </span>
                        </p>
                        <p class="mt-1">{{ $lang['18'] }} = 
                            <span>{{ $detail['carbohydrates'] }} - {{ $detail['fiber'] }} -</span>
                            <span class="fraction">
                                <span class="num">({{ $detail['alcohol'] }})</span>
                                <span class="visually-hidden"></span>
                                <span class="den">2</span>
                            </span>
                        </p>
                        <p class="mt-1">{{ $lang['18'] }} = {{ $detail['Net_carbs'] }} g</p>
                        <p class="mt-1">{{ $lang['19'] }} = {{ $detail['Net_carbs'] * 4 }} kcal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>