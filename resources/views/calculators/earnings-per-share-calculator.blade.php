<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="net_income" class="font-s-14 text-blue">{{ $lang['1'] }}(I):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="net_income" id="net_income" class="input" aria-label="input" placeholder="8" value="{{ isset($_POST['net_income'])?$_POST['net_income']:'8' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="dividends" class="font-s-14 text-blue">{{ $lang['2'] }}(D):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="dividends" id="dividends" class="input" aria-label="input" placeholder="4" value="{{ isset($_POST['dividends'])?$_POST['dividends']:'4' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="common_shares" class="font-s-14 text-blue">{{ $lang['3'] }}(S):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="common_shares" id="common_shares" class="input" aria-label="input" placeholder="4" value="{{ isset($_POST['common_shares'])?$_POST['common_shares']:'2' }}" />
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
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} ({{ $lang[6] }}) </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ round($detail['share_dividends'], 2) }} {{ $lang[5] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                            <p class="mt-2">{{$lang[6]}} = (I - D) / S</p>
                            <p class="mt-2">{{$lang[6]}} = ({{ $currancy }} {{ isset($_POST['net_income'])?$_POST['net_income']:'' }} - {{ $currancy }} {{ isset($_POST['dividends'])?$_POST['dividends']:'4' }} ) / 2</p>
                            <p class="mt-2">{{$lang[6]}} = {{ $currancy }}  {{ $_POST['net_income'] - $_POST['dividends']  }} / 2</p>
                            <p class="mt-2">{{$lang[6]}} = {{ $currancy }} {{round($detail['share_dividends'], 2)}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>