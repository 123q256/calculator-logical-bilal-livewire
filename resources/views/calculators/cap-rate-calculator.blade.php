<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="prop_val" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="prop_val" id="prop_val" class="input" aria-label="input" placeholder="200000" value="{{ isset($_POST['prop_val'])?$_POST['prop_val']:'200000' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ann_grs_inc" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="ann_grs_inc" id="ann_grs_inc" class="input" aria-label="input" placeholder="30000" value="{{ isset($_POST['ann_grs_inc'])?$_POST['ann_grs_inc']:'30000' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="op_exp" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="op_exp" id="op_exp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['op_exp']) ? $_POST['op_exp'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="op_exp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('op_exp_unit_dropdown')">{{ isset($_POST['op_exp_unit'])?$_POST['op_exp_unit']:'percent (%)' }} ▾</label>
                    <input type="text" name="op_exp_unit" value="{{ isset($_POST['op_exp_unit'])?$_POST['op_exp_unit']:'percent (%)' }}" id="op_exp_unit" class="hidden">
                    <div id="op_exp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="op_exp_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('op_exp_unit', 'percent (%)')">percent (%)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('op_exp_unit', '{{$currancy}}')">currancy ({{$currancy}})</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="op_exp" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="op_exp" id="op_exp" value="{{ isset($_POST['op_exp'])?$_POST['op_exp']:'25' }}" class="input" aria-label="input" placeholder="2" />
                    <label for="op_exp_unit" class="text-blue input_unit text-decoration-underline">{{ isset($_POST['op_exp_unit'])?$_POST['op_exp_unit']:'%' }} ▾</label>
                    <input type="text" name="op_exp_unit" value="{{ isset($_POST['op_exp_unit'])?$_POST['op_exp_unit']:'%' }}" id="op_exp_unit" class="d-none">
                    <div class="units op_exp_unit d-none" to="op_exp_unit">
                        <p value="%">percent (%)</p>
                        <p value="{{$currancy}}">currancy ({{$currancy}})</p>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="vac_rate" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="vac_rate" id="vac_rate" class="input" aria-label="input" placeholder="30000" value="{{ isset($_POST['vac_rate'])?$_POST['vac_rate']:'30000' }}" />
                    <span class="text-blue input_unit">%</span>
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
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                        <table class="w-100 text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                <td class="py-2 border-b">{{$detail['cap']}} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                <td class="py-2 border-b">{{ $currancy }} {{$detail['grs_op_inc']}} </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                <td class="py-2 border-b">{{ $currancy }} {{$detail['ann_net_inc']}} </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"> <strong>{{$lang['8']}}:</strong></p>
                        <p class="mt-2">{{$lang['6']}} = {{$lang['9']}} - {{$lang['10']}}</p>
                        <p class="mt-2">{{$lang['6']}} = {{$currancy.$detail['ann_grs_inc']}} - {{$currancy.$detail['vac_rate1']}} = {{$currancy.$detail['grs_op_inc']}}</p>
                        @if(isset($detail['percent']))
                        <p class="mt-2">{{$lang['7']}} = ((100 - <?=$lang['11']?>) %) * ((100 - <?=$lang['10']?>) %) * <?=$lang['9']?></p>
                        <p class="mt-2">{{$lang['7']}} = ((100 - {{$currancy.$detail['op_exp']}}) / 100) * ((100 - {{$currancy.$detail['vac_rate']}}) / 100) * {{$currancy.$detail['ann_grs_inc']}} = {{ $currancy.$detail['ann_net_inc']}}</p>
                        @else
                        <p class="mt-2">{{$lang['7']}} = <?=$lang['6']?> - <?=$lang['11']?></p>
                        <p class="mt-2">{{$lang['7']}} = {{$currancy.$detail['grs_op_inc']}} - {{$currancy.$detail['op_exp']}} = {{ $currancy.$detail['ann_net_inc']}}</p>
                        @endif
                        <p class="mt-2">{{$lang['12']}} = ({{$lang['7']}} / <?=$lang['13']?>) * 100</p>
                        <p class="mt-2">{{$lang['12']}} = ({{$currancy.$detail['ann_net_inc']}} / {{$currancy.$detail['prop_val']}}) * 100 = {{ $detail['cap']}}%</p>
                        <p class="mt-2">{{$lang['12']}} = {{ $detail['cap']}}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>