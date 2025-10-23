<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-span-12">
                <p class="py-2"><strong>{{$lang[1]}}:</strong></p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input1" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input1" id="input1" class="input" aria-label="input" placeholder="21" value="{{ isset($_POST['input1'])?$_POST['input1']:'21' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input2" class="label">{{ $lang['3'] }} / {{ $lang['4'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input2" id="input2" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['input2'])?$_POST['input2']:'19' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input3" class="label">{{ $lang['5'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input3" id="input3" class="input" aria-label="input" placeholder="17" value="{{ isset($_POST['input3'])?$_POST['input3']:'17' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input4" class="label">{{ $lang['6'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input4" id="input4" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['input4'])?$_POST['input4']:'35' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input5" class="label">{{ $lang['8'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input5" id="input5" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['input5'])?$_POST['input5']:'45' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input6" class="label">{{ $lang['9'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input6" id="input6" class="input" aria-label="input" placeholder="27" value="{{ isset($_POST['input6'])?$_POST['input6']:'27' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input7" class="label">{{ $lang['10'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input7" id="input7" class="input" aria-label="input" placeholder="23" value="{{ isset($_POST['input7'])?$_POST['input7']:'23' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input8" class="label">{{ $lang['11'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input8" id="input8" class="input" aria-label="input" placeholder="13" value="{{ isset($_POST['input8'])?$_POST['input8']:'13' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input9" class="label">{{ $lang['12'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input9" id="input9" class="input" aria-label="input" placeholder="19" value="{{ isset($_POST['input9'])?$_POST['input9']:'19' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input10" class="label">{{ $lang['13'] }} / {{ $lang['14'] }} / IRA {{ $lang['15'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input10" id="input10" class="input" aria-label="input" placeholder="13" value="{{ isset($_POST['input10'])?$_POST['input10']:'49' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input11" class="label">{{ $lang['16'] }} / {{ $lang['17'] }} / {{ $lang['18'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input11" id="input11" class="input" aria-label="input" placeholder="13" value="{{ isset($_POST['input11'])?$_POST['input11']:'12' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input12" class="label">{{ $lang['19'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input12" id="input12" class="input" aria-label="input" placeholder="38" value="{{ isset($_POST['input12'])?$_POST['input12']:'38' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input13" class="label">{{ $lang['20'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input13" id="input13" class="input" aria-label="input" placeholder="25" value="{{ isset($_POST['input13'])?$_POST['input13']:'25' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <p class="my-2"><strong>Deductions:</strong></p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input14" class="label">{{ $lang['21'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input14" id="input14" class="input" aria-label="input" placeholder="22" value="{{ isset($_POST['input14'])?$_POST['input14']:'22' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input15" class="label">{{ $lang['22'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input15" id="input15" class="input" aria-label="input" placeholder="14" value="{{ isset($_POST['input15'])?$_POST['input15']:'14' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input16" class="label">{{ $lang['23'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input16" id="input16" class="input" aria-label="input" placeholder="19" value="{{ isset($_POST['input16'])?$_POST['input16']:'19' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input17" class="label">{{ $lang['24'] }} / IRAs:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input17" id="input17" class="input" aria-label="input" placeholder="23" value="{{ isset($_POST['input17'])?$_POST['input17']:'23' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input18" class="label">{{ $lang['25'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input18" id="input18" class="input" aria-label="input" placeholder="45" value="{{ isset($_POST['input18'])?$_POST['input18']:'45' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input19" class="label">{{ $lang['26'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input19" id="input19" class="input" aria-label="input" placeholder="45" value="{{ isset($_POST['input19'])?$_POST['input19']:'43' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input20" class="label">{{ $lang['27'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input20" id="input20" class="input" aria-label="input" placeholder="67" value="{{ isset($_POST['input20'])?$_POST['input20']:'67' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input21" class="label">{{ $lang['28'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input21" id="input21" class="input" aria-label="input" placeholder="67" value="{{ isset($_POST['input21'])?$_POST['input21']:'57' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input22" class="label">{{ $lang['29'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input22" id="input22" class="input" aria-label="input" placeholder="57" value="{{ isset($_POST['input22'])?$_POST['input22']:'32' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input23" class="label">{{ $lang['30'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input23" id="input23" class="input" aria-label="input" placeholder="57" value="{{ isset($_POST['input23'])?$_POST['input23']:'32' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="input24" class="label">{{ $lang['31'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="input24" id="input24" class="input" aria-label="input" placeholder="32" value="{{ isset($_POST['input24'])?$_POST['input24']:'32' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-100 text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['33'] }} </strong></td>
                                    <td class="py-2 border-b">{{ $detail['add1'] }} {{ $currancy}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong> {{ $lang['34'] }} </strong></td>
                                    <td class="py-2 border-b"> {{ abs($detail['add2']) }} {{ $currancy}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['35'] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['minus'] }} {{ $currancy}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>