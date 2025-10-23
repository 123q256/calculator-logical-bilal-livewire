<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 mx-auto">
                <label for="round" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="round" id="round" class="input" aria-label="input" value="{{isset($_POST['round']) ? $_POST['round'] : '4.567'}}" />
                    <span class="text-blue input_unit">{{$currancy }}</span>
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
                            <div class="w-full text-center text-[18px]">
                                <p>{{ $lang['2'] }}</p>
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg text-blue">>{{$currancy }} {{ $detail['result'] }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>