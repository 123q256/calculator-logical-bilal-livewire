<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="inventory" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="inventory" id="inventory" class="input" aria-label="input" placeholder="30" value="{{ isset($_POST['inventory'])?$_POST['inventory']:'30' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="purchases" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="purchases" id="purchases" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['purchases'])?$_POST['purchases']:'10' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="e_inventory" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="e_inventory" id="e_inventory" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['e_inventory'])?$_POST['e_inventory']:'10' }}" />
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
                    <div class="col-lg-full mt-2">
                        <table class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['4'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['COGS'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['6'] }}</strong></p>
                        <p class="mt-2">{{ $lang['7'] }}</p>
                        <p class="mt-2"> COGS = Beginning inventory +  Purchases - Ending inventory </p>
                        <p class="mt-2"> COGS = {{ isset($_POST['inventory'])?$_POST['inventory']:'' }}  + {{ isset($_POST['purchases'])?$_POST['purchases']:'' }} - {{ isset($_POST['e_inventory'])?$_POST['e_inventory']:'' }} </p>
                        <p class="mt-2"> COGS = {{ $detail['COGS'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>