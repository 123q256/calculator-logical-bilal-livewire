
<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="payment" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="payment" id="payment" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['payment'])?$_POST['payment']:'12' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="interest" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="interest" id="interest" class="input" aria-label="input" placeholder="2" value="{{ isset($_POST['interest'])?$_POST['interest']:'2' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="term" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="term" id="term" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['term']) ? $_POST['term'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="term_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('term_unit_dropdown')">{{ isset($_POST['term_unit'])?$_POST['term_unit']:'mons' }} ▾</label>
                        <input type="text" name="term_unit" value="{{ isset($_POST['term_unit'])?$_POST['term_unit']:'mons' }}" id="term_unit" class="hidden">
                        <div id="term_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="term_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('term_unit', 'mons')">mons</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('term_unit', 'yrs')">yrs</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="term" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="term" id="term" class="input" aria-label="input" placeholder="3" value="{{ isset($_POST['term'])?$_POST['term']:'3' }}" />
                        <label for="term_unit" class="text-blue input_unit text-decoration-underline">{{ isset($_POST['term_unit'])?$_POST['term_unit']:'mons' }} ▾</label>
                        <input type="text" name="term_unit" value="{{ isset($_POST['term_unit'])?$_POST['term_unit']:'mons' }}" id="term_unit" class="d-none">
                        <div class="units term_unit d-none" to="term_unit">
                            <p value="mons">mons</p>
                            <p value="yrs">yrs</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="term" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <select class="input mt-2" name="compounding" id="operation">
                        <option value="1" {{ isset($_POST['compounding']) && $_POST['compounding']=='1'?'selected':''}} selected>{{$lang['5']}}</option>
                        <option value="2" {{ isset($_POST['compounding']) && $_POST['compounding']=='2'?'selected':''}}>{{$lang['6']}}</option>
                        <option value="4" {{ isset($_POST['compounding']) && $_POST['compounding']=='4'?'selected':''}}>{{$lang['7']}}</option>
                        <option value="12" {{ isset($_POST['compounding']) && $_POST['compounding']=='12'?'selected':''}}>{{$lang['8']}}</option>
                        <option value="52" {{ isset($_POST['compounding']) && $_POST['compounding']=='52'?'selected':''}}>{{$lang['9']}}</option>
                        <option value="365" {{ isset($_POST['compounding']) && $_POST['compounding']=='365'?'selected':''}}>{{$lang['10']}}</option>
                        <option value="366" {{ isset($_POST['compounding']) && $_POST['compounding']=='366'?'selected':''}}>{{$lang['11']}}</option>
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="payment_fre" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <select name="payment_fre" id="payment_fre" class="input mt-2">
                        <option value="1" {{ isset($_POST['payment_fre']) && $_POST['payment_fre']=='1'?'selected':''}} selected>{{$lang['5']}}</option>
                        <option value="2" {{ isset($_POST['payment_fre']) && $_POST['payment_fre']=='2'?'selected':''}}>{{$lang['6']}}</option>
                        <option value="4" {{ isset($_POST['payment_fre']) && $_POST['payment_fre']=='4'?'selected':''}}>{{$lang['7']}}</option>
                        <option value="12" {{ isset($_POST['payment_fre']) && $_POST['payment_fre']=='12'?'selected':''}}>{{$lang['8']}}</option>
                        <option value="52" {{ isset($_POST['payment_fre']) && $_POST['payment_fre']=='52'?'selected':''}}>{{$lang['9']}}</option>
                        <option value="365" {{ isset($_POST['payment_fre']) && $_POST['payment_fre']=='365'?'selected':''}}>{{$lang['10']}}</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="annuity_type" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                    <select name="annuity_type" id="annuity_type" class="input mt-2">
                        <option value="1" {{ isset($_POST['annuity_type']) && $_POST['annuity_type']=='1'?'selected':''}} selected>{{$lang['14']}}</option>
                        <option value="2" {{ isset($_POST['annuity_type']) && $_POST['annuity_type']=='2'?'selected':''}}>{{$lang['15']}}</option>
                    </select>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="g" class="font-s-14 text-blue">{{ $lang['16'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="g" id="g" class="input" aria-label="input" placeholder="13" value="{{ isset($_POST['g'])?$_POST['g']:'13' }}" />
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['17'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{ $detail['annuity'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['18'] }} </strong></td>
                                <td class="py-2 border-b">{{ $detail['term'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['19'] }} </strong></td>
                                <td class="py-2 border-b">{{ $detail['equ'] }}%</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['20'] }} </strong></td>
                                <td class="py-2 border-b">{{ $detail['equ2'] }}%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>