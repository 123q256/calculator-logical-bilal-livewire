<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php  $request = request(); @endphp
            <div class="col-span-8">
                <label for="input" class="font-s-14 text-blue"><?=$lang['1']?>:</label>
                <div class="w-100 py-2">
                    <input type="text" name="input" id="input" class="input" value="{{ isset($request->input)?$request->input:'2x^2 - 13x' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-1 flex items-center">
                <span class="font-s-14 text-blue">&nbsp;</span>
                <div class="w-100 py-2 mt-2 font-s-18 text-center">
                    <p><strong>=</strong></p>
                </div>
            </div>
            <div class="col-span-3">
                <label for="is_equal" class="font-s-14 text-blue">&nbsp;</label>
                <div class="w-100 py-2">
                    <input type="number" name="is_equal" id="is_equal" class="input" value="{{ isset($request->is_equal)?$request->is_equal:'2' }}" aria-label="input"/>
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
                        <div class="w-full text-center my-2">
                            <p><strong class="bg-white p-4 text-[21px] rounded-lg text-blue">\( <?=$detail['ans']?> \)</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>