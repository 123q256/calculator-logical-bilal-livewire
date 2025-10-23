<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    

   
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="cigarettes" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="cigarettes" id="cigarettes" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->cigarettes)?request()->cigarettes:'6' }}" />
                    <span class="text-[#2845F5] input_unit change_unit">/ {!! $lang['2'] !!}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="size" class="label">{!! $lang['3'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="size" id="size" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->size)?request()->size:'20' }}" />
                    <span class="text-[#2845F5] input_unit change_unit">{!! $lang['4'] !!}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="years" class="label">{!! $lang['5'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="years" id="years" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->years)?request()->years:'5' }}" />
                    <span class="text-[#2845F5] input_unit change_unit">{!! $lang['6'] !!}</span>
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
                        <div class="w-full md:w-[80%] lg:w-[80%] flex flex-column flex-md-row justify-between">
                            <div class="">
                                <p>{{ $lang[7] }}</p>
                                <p><strong class="text-[#119154] text-[32px]">{{ round($detail['PY'],1) }}</strong></p>
                            </div>
                            <div class="border-r hidden md:block lg:block">&nbsp;</div>
                            <div class="">
                                <p>{{ $lang[8] }}</p>
                                <p><strong class="text-[#119154] text-[32px]">{{ round($detail['PL']) }}</strong></p>
                            </div>
                            <div class="border-r hidden md:block lg:block">&nbsp;</div>
                            <div class="">
                                <p>{{ $lang[9] }}</p>
                                <p><strong class="text-[#119154] text-[32px]">{{ round($detail['CL'],1) }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>