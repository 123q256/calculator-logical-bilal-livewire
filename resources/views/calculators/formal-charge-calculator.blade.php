<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="V" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                                <input type="number" step="any" name="V" id="V" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->V)?request()->V:'6' }}" />
                        </div>
                        <div class="space-y-2">
                            <label for="LP" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                                <input type="number" step="any" name="LP" id="LP" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->LP)?request()->LP:'2' }}" />
                        </div>
                        <div class="space-y-2">
                            <label for="BE" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                                <input type="number" step="any" name="BE" id="BE" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->BE)?request()->BE:'8' }}" />
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
                        <p>{!! $lang['4'] !!} (FC):</p>
                        <p><strong class="text-[#119154] text-[30px]">{!! $detail['formal'] !!}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>