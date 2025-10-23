<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
           
                <div class="col-span-12">
                    <label for="return_best" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="return_best" id="return_best" class="input"
                            aria-label="input" placeholder="100"
                            value="{{ isset($_POST['return_best']) ? $_POST['return_best'] : '100' }}" />
                            <span class="text-blue input-unit">{{$currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="return_choose" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="return_choose" id="return_choose" class="input"
                            aria-label="input" placeholder="1000"
                            value="{{ isset($_POST['return_choose']) ? $_POST['return_choose'] : '50' }}" />
                            <span class="text-blue input-unit">{{$currancy }}</span>
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
                        <div class="col-12 text-center text-[20px]">
                            <p>{{ $lang[3] }}</p>
                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ round($detail['OpportunityCost'], 4) }}{{$currancy }}</strong></p>
                        </div>
                        <p class="mt-2"> <strong>{{ $lang['5'] }}:</strong></p>
                        <p class="mt-2"> {{ $lang['6'] }}:</p>
                        <p class="mt-2"> = {{$lang['1']}} -  {{$lang['2']}}</p>
                        <p class="mt-2"> = {{$detail['return_best']}} -  {{$detail['return_choose']}}</p>
                        <p class="mt-2"> = {{ round($detail['OpportunityCost'], 4) }}{{ $currancy }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>

