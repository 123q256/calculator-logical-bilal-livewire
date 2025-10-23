<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="lg:col-span-6 md:col-span-6 col-span-12">
                <label for="f_input" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="f_input" id="f_input" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->f_input)?request()->f_input:'7' }}" />
                </div>
            </div>
            <div class="lg:col-span-6 md:col-span-6 col-span-12">
                <label for="s_input" class="label">{!! $lang['2'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="s_input" id="s_input" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->s_input)?request()->s_input:'5' }}" />
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
                        <div class="w-full text-center">
                            <p>{{ $lang[3] }}</p>
                            <p><strong class="text-[#119154] text-[32px]">{{ round($detail['answer'], 2) }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>