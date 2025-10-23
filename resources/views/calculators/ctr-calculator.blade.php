<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
            <div class="col-span-12">
                <label for="impression" class="label">{{ $lang['1'] }}</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="impression" id="impression" class="input" aria-label="input" placeholder="5" value="{{ isset($_POST['impression'])?$_POST['impression']:'5' }}" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="clicks" class="label">{{ $lang['2'] }}</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="clicks" id="clicks" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['clicks'])?$_POST['clicks']:'50' }}" />
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
                                <td class="py-2 border-b" width="70%"><strong>Click Through Rate (CTR)</strong></td>
                                <td class="py-2 border-b">{{round($detail['ctr']*100,3) }} %</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['4']  }}</strong></p>
                        <p class="mt-2">{{ $lang['5']  }}:</p>
                        <p class="mt-2">CTR =  Number of Click / Ad Impressions</p>
                        <p class="mt-2">CTR =  {{ isset($_POST['impression'])?$_POST['impression']:'' }}/ {{ isset($_POST['clicks'])?$_POST['clicks']:'' }}</p>
                        <p class="mt-2">CTR = {{ round($detail['ctr'],3)  }} x 100</p>
                        <p class="mt-2">CTR = {{ round($detail['ctr'] *100,3) }}  %</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>