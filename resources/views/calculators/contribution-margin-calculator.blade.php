<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="selling_price" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="selling_price" id="selling_price" class="input" aria-label="input" placeholder="20" value="{{ isset($_POST['selling_price'])?$_POST['selling_price']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="variable_cost" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="variable_cost" id="variable_cost" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['variable_cost'])?$_POST['variable_cost']:'10' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="number_units" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 ">
                    <input type="number" step="any" name="number_units" id="number_units" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['number_units'])?$_POST['number_units']:'15' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="fixed_cost" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="fixed_cost" id="fixed_cost" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['fixed_cost'])?$_POST['fixed_cost']:'10' }}" />
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
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['5'] }}</strong></td>
                            <td class="py-2 border-b">{{$detail['contribution_margin']}} {{ $currancy }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['6'] }}</strong></td>
                            <td class="py-2 border-b">{{$detail['contribution_margin_ratio']}} %</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['7'] }}</strong></td>
                            <td class="py-2 border-b">{{$detail['profit']}} {{ $currancy }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endisset
</form>