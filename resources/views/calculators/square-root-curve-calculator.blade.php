<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="percentage" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="percentage" id="percentage" class="input" aria-label="input" value="<?= isset($_POST['percentage']) ? $_POST['percentage'] : '10' ?>" />
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
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[2] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['answer'], 3)}} %</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px] mt-2">          
                            <p><strong>{{$lang[3]}}</strong></p>
                            <p class="mt-2">{{$lang[4]}}</p>
                            <p class="mt-2">{{$lang[2]}} = {{ $lang[5] }} ({{$lang[1]}}) × 10</p>
                            <p class="mt-2">{{$lang[2]}} = √({{$_POST['percentage']}}) × 10</p>
                            <p class="mt-2">{{$lang[2]}} = {{round($detail['answer'], 3)}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>