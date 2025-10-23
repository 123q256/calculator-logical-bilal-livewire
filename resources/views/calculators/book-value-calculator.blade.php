<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="acquisition" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" type="any" name="acquisition" id="acquisition" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['acquisition'])?$_POST['acquisition']:'413' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="depreciation" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" type="any" name="depreciation" id="depreciation" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['depreciation'])?$_POST['depreciation']:'50' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
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
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['3'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy }}{{ $detail['book'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['5']}}</strong></p>
                        <p class="mt-2">{{ $lang['6']}} :</p>
                        <p class="mt-2">Book Value = Acquisition Cost -  Depreciation </p>
                        <p class="mt-2">Book Value = {{ isset($_POST['acquisition'])?$_POST['acquisition']:'' }} -  {{ isset($_POST['depreciation'])?$_POST['depreciation']:'' }}</p>
                        <p class="mt-2">Book Value = {{ isset($_POST['currancy'])?$_POST['currancy']:'' }}   {{ $detail['book'] }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>