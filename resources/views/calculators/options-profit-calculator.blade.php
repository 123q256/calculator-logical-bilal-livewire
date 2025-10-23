<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="ot" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <select name="ot" id="ot" class="input mt-2">
                        <option selected value="c" {{ isset($_POST['ot']) && $_POST['ot']=='c'?'selected':''}}>{{ $lang['15']}}</option>
                        <option value="p" {{ isset($_POST['ot']) && $_POST['ot']=='p'?'selected':''}}>{{ $lang['16'] }}</option>
                    </select>
                </div>
                <div class="col-span-6">
                    <label for="sp" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="sp" id="sp" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['sp'])?$_POST['sp']:'10' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="op" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="op" id="op" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['op'])?$_POST['op']:'10' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="stp" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="stp" id="stp" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['stp'])?$_POST['stp']:'10' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="nc" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="nc" id="nc" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['nc'])?$_POST['nc']:'10' }}" />
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
            <div class="d-flex justify-content-between">
                <p class="text-blue font-s-21"><strong>{{ $lang['res'] }}:</strong></p>
                @if ($type=='calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>
            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                <table class="w-full text-[18px]">
                    <tr>
                        @if($detail['ans'] > 0)
                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }} </strong></td>
                        @else
                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }} </strong></td>
                        @endif
                        <td class="py-2 border-b">{{$currancy }} {{ $detail['ans'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="w-full text-[18px]">

                    <p class="mt-2"><strong>{{ $lang['8'] }}</strong></p>
                    <p class="mt-2"> {{$lang['9']}} = {{ $lang['10']}} x 100</p>
                    <p class="mt-2"> {{$lang['9']}} = {{$detail['nc']}} x 100 </p>
                    <p class="mt-2"> {{$lang['9']}} = {{$currancy }} {{$detail['ec']}} </p>
                    <p class="mt-2"> {{$lang['11']}} ={{$lang['2']}} x {{$lang['9']}} </p>
                    <p class="mt-2"> {{$lang['11']}} ={{$detail['sp']}} x {{$detail['ec']}} 
                    <p class="mt-2"> {{$lang['11']}} ={{$currancy }} {{$detail['sp']*$detail['ec']}}</p>
                    <p class="mt-2"> {{$lang['12']}}  = {{$lang['4']}} x {{ $lang['9']}}</p>
                    <p class="mt-2"> {{$lang['12']}}  = {{$detail['stp']}} x {{$detail['ec']}} </p>
                    <p class="mt-2"> {{$lang['12']}}  = {{$currancy }} {{$detail['stp']*$detail['ec']}} </p>
                    <p class="mt-2"> {{$lang['13']}} = {{$lang['1']}} x <?=$lang['9']?></p>
                    <p class="mt-2"> {{$lang['13']}} = {{$detail['op']}} x {{$detail['ec']}}  
                    <p class="mt-2"> {{$lang['13']}} = {{$currancy }} {{$detail['op']*$detail['ec']}} </p>
                    @if($detail['ot'] == 'c')
                    <p class="mt-2"> {{$lang['14']}} = {{$lang['11']}} - {{$lang['12']}} - {{ $lang['13'] }}</p>
                    <p class="mt-2"> {{$lang['14']}} = {{($detail['sp']*$detail['ec'])}} - {{($detail['stp']*$detail['ec'])}} - {{($detail['op']*$detail['ec'])}}</p>
                    <p class="mt-2"> {{$lang['14']}} = {{$currancy }} {{$detail['ans']}} </p>
                    @else
                    <p class="mt-2"> {{$lang['14']}} = {{$lang['12']}} -{{$lang['11']}} - {{ $lang['13'] }}</p>
                    <p class="mt-2"> {{$lang['14']}} = {{($detail['stp']*$detail['ec'])}} - {{($detail['sp']*$detail['ec'])}} - {{($detail['op']*$detail['ec'])}}</p>
                    <p class="mt-2"> {{$lang['14']}} = {{$currancy }} {{$detail['ans']}} </p>
                    @endif
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>