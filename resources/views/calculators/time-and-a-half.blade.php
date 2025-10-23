<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="normal_pay" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="normal_pay" id="normal_pay" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['normal_pay'])?$_POST['normal_pay']:'15' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="normal_time" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="normal_time" id="normal_time" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['normal_time'])?$_POST['normal_time']:'0' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="over_time" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="over_time" id="over_time" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['over_time'])?$_POST['over_time']:'50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="multiplier" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2" >
                    <select name="multiplier" id="multiplier" class="input">
                        <option  value="1.5" {{ isset($_POST['multiplier']) && $_POST['multiplier']=='1.5'?'selected':''}}>{{ $lang[13] }}</option>
                        <option value="2" {{ isset($_POST['multiplier']) && $_POST['multiplier']=='2'?'selected':''}}>{{ $lang[14] }}</option>
                        <option value="3" {{ isset($_POST['multiplier']) && $_POST['multiplier']=='3'?'selected':''}}>{{ $lang[15] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="pay_period" class="label">Pay Period:</label>
                <div class="w-100 py-2">
                    <select name="pay_period" id="pay_period" class="input">
                        <option  value="52" {{ isset($_POST['pay_period']) && $_POST['pay_period']=='52'?'selected':''}}>{{ $lang[16] }}</option>
                        <option value="26" {{ isset($_POST['pay_period']) && $_POST['pay_period']=='26'?'selected':''}}>{{ $lang[17] }}</option>
                        <option value="24" {{ isset($_POST['pay_period']) && $_POST['pay_period']=='24'?'selected':''}}>{{ $lang[18] }}</option>
                        <option value="12" {{ isset($_POST['pay_period']) && $_POST['pay_period']=='12'?'selected':''}}>{{ $lang[19] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="currency" class="label">{{ $lang[5]}}</label>
                <div class="w-100 py-2">
                    <select name="currency" id="currency" class="input">
                        <option  value="$" {{ isset($_POST['currency']) && $_POST['currency']=='$'?'selected':''}}>$</option>
                        <option value="£" {{ isset($_POST['currency']) && $_POST['currency']=='£'?'selected':''}}>£</option>
                        <option value="€" {{ isset($_POST['currency']) && $_POST['currency']=='€'?'selected':''}}>€</option>
                        <option value="¥" {{ isset($_POST['currency']) && $_POST['currency']=='3'?'selected':''}}>¥</option>
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
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                            <table class="w-100 text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>
                                        @if($detail['multiplier'] == 1.5)
                                        {{ $lang[8] }}
                                        @elseif($detail['multiplier'] == 2)
                                            {{ $lang[20] }}
                                        @elseif($detail['multiplier'] == 3)
                                            {{ $lang[22] }}
                                        @endif
                                    </strong></td>
                                    <td class="py-2 border-b">{{ $detail['currency'] }}{{ round($detail['half'],2) }}</td>
                                </tr>
                            </table>
                        </div>
                
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                            <table class="w-full font-s-18">
                                @if($detail['over_time'] > 0)
                               <tr>
                                  <td class="py-2 border-b" width="70%"> {{$lang[7]}}</td>
                                   <td class="py-2 border-b"> <strong>{{ $detail['currency'].' '.round($detail['total'],2) }}</strong></td>
                               </tr>
                               @endif
                               @if($detail['normal_time'] > 0)   
                               <tr>
                                <td class="py-2 border-b" width="70%"> {{$lang[9]}}</td>
                                 <td class="py-2 border-b"> <strong>{{ $detail['currency'].' '.round($detail['standered_pay'],2) }}</strong></td>
                               </tr>
                               <tr>
                                <td class="py-2 border-b" width="70%"> {{$lang[10]}}</td>
                                 <td class="py-2 border-b"> <strong>{{ $detail['currency'].' '.round($detail['Regular_Pay_per_Year'],2) }}</strong></td>
                               </tr>
                               @endif
                               @if($detail['multiplier'] >0) 
                
                               <tr>
                                <td class="py-2 border-b" width="70%"> {{$lang[11]}}</td>
                                 <td class="py-2 border-b"> <strong>{{ $detail['currency'].' '.round($detail['Overtime_Pay_per_Year'],2) }}</strong></td>
                               </tr>
                               @endif
                
                               @if($detail['normal_time'] > 0)  
                               <tr>
                                <td class="py-2 border-b" width="70%"> {{$lang[12]}}</td>
                                 <td class="py-2 border-b"> <strong>{{ $detail['currency'].' '.round($detail['Total_Pay_per_Year'],2)}}</strong></td>
                               </tr>
                               @endif
                            </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>