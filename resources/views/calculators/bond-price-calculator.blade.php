<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="frequency" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="frequency" id="frequency" class="input">
                            <option value="1"  {{ isset($_POST['frequency']) && $_POST['frequency']=='1'?'selected':''}}   >Annually</option>
                            <option value="2"  {{ isset($_POST['frequency']) && $_POST['frequency']=='2'?'selected':''}}  >Semi-Annually</option>
                            <option value="4"  {{ isset($_POST['frequency']) && $_POST['frequency']=='4'?'selected':''}}  >Quarterly</option>
                            <option value="12"  {{ isset($_POST['frequency']) && $_POST['frequency']=='12'?'selected':''}}  >Monthly</option>
                            <option value="52"  {{ isset($_POST['frequency']) && $_POST['frequency']=='52'?'selected':''}}  >Weekly</option>
                            <option value="365"  {{ isset($_POST['frequency']) && $_POST['frequency']=='365'?'selected':''}}  >Daily</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="faceValue" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="faceValue" id="faceValue" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['faceValue'])?$_POST['faceValue']:'2000' }}" />
                        <span class="input_unit"> {{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="couponRate" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="couponRate" id="couponRate" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['couponRate'])?$_POST['couponRate']:'5' }}" />
                        <span class="input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="yearsToMaturity" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="yearsToMaturity" id="yearsToMaturity" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['yearsToMaturity'])?$_POST['yearsToMaturity']:'7' }}" />
                        <span class="input_unit">years</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="yield" class="label">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="yield" id="yield" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['yield'])?$_POST['yield']:'5' }}" />
                        <span class="input_unit">%</span>
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
                        <table class="w-100 font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['7'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['couponPayment'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong> {{ $lang['8'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $currancy}} {{ abs($detail['annual']) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['5'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{ $detail['bondPrice'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>