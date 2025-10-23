<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-6 text-center">
                <p><strong>{{ $lang['1'] }}</strong></p>
            </div>
            <div class="col-span-6 text-center">
                <p><strong>{{ $lang['8'] }}</strong></p>
            </div>
            <div class="col-span-6">
                <label for="as_real" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="as_real"  min="0"  id="as_real" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['as_real'])?$_POST['as_real']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="li_real" class="label">{{ $lang['9'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="li_real"  min="0" id="li_real" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['li_real'])?$_POST['li_real']:'10' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="as_check" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="as_check"  min="0" id="as_check" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['as_check'])?$_POST['as_check']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="li_card" class="label">{{ $lang['10'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="li_card"  min="0" id="li_card" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['li_card'])?$_POST['li_card']:'10' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="as_saving" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="as_saving"  min="0" id="as_saving" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['as_saving'])?$_POST['as_saving']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="li_loan" class="label">{{ $lang['11'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="li_loan"  min="0" id="li_loan" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['li_loan'])?$_POST['li_loan']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="as_retire" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="as_retire"  min="0" id="as_retire" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['as_retire'])?$_POST['as_retire']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="li_stload" class="label">{{ $lang['12'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="li_stload"  min="0" id="li_stload" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['li_stload'])?$_POST['li_stload']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="as_car" class="label">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="as_car"  min="0" id="as_car" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['as_car'])?$_POST['as_car']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="li_car" class="label">{{ $lang['13'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="li_car"  min="0" id="li_car" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['li_car'])?$_POST['li_car']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="as_other" class="label">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="as_other"  min="0" id="as_other" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['as_other'])?$_POST['as_other']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="li_other" class="label">{{ $lang['14'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="li_other"  min="0" id="li_other" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['li_other'])?$_POST['li_other']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
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
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['15'] }}</strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{$detail['net_worth']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['1'] }}</strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{$detail['assets']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['8'] }}</strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{$detail['liabilities']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>