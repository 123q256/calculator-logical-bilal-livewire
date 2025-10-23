<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="wbc" class="label">{!! $lang['wbc'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="wbc" id="wbc" class="input" aria-label="input" placeholder="{{ $lang['normal'] }}" value="{{ isset($_POST['wbc'])?$_POST['wbc']:'' }}" />
                    <span class=" input_unit">×10³/μL</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="l" class="label">{!! $lang['l'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="l" id="l" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['l'])?$_POST['l']:'' }}" />
                    <span class=" input_unit">%</span>
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
                        <p class="w-full text-[20px] mt-2"><strong><?=$lang['alc']?></strong></p>
                        <p class="w-full text-[28px]">
                            @if(isset($detail['alc']))
                                <strong class="text-green-500">{{ $detail['alc'] }} ×10³/μL</strong>
                            @else
                                <strong class="text-green-500">0.0 ×10³/μL</strong>
                            @endif
                        </p>
                    </div>
                </div>
                
    
                </div>
            </div>
        </div>
    
    @endisset
</form>