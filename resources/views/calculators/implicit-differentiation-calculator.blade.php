<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php 
                $request = request();
            @endphp
            <p class="col-span-12"><strong><?=$lang['1']?>: f(x,y) = g(x,y)</strong></p>
            <div class="col-span-12">
                <label for="EnterEq" class="label">f(x,y):</label>
                <div class="w-100 py-2">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'x^2+3y' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="EnterEq1" class="label">g(x,y):</label>
                <div class="w-100 py-2">
                    <input type="text" name="EnterEq1" id="EnterEq1" class="input" value="{{ isset($request->EnterEq1)?$request->EnterEq1:'3xy' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="with" class="label"><?=$lang['2']?> W.R.T:</label>
                <div class="w-100 py-2">
                    <select name="with" class="input" id="with" aria-label="select">
                        <option value="x">x</option>
                        <option value="y" {{ isset($request->with) && $request->with=='y'?'selected':'' }}>y</option>
                    </select>
                </div>
            </div>
            <p class="col-span-12"><strong><?=$lang['3']?> (x,y): (<?=$lang['5']?>)</strong></p>
            <div class="col-span-6">
                <label for="x" class="label">x:</label>
                <div class="w-100 py-2">
                    <input type="number" name="x" id="x" class="input" value="{{ isset($request->x)?$request->x:'' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y" class="label">y:</label>
                <div class="w-100 py-2">
                    <input type="number" name="y" id="y" class="input" value="{{ isset($request->y)?$request->y:'' }}" aria-label="input"/>
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
                            @php
                                $EnterEq= $request->EnterEq;
                                $EnterEq1= $request->EnterEq1;
                                $x= $request->x;
                                $y= $request->y;
                                $with= $request->with;
                            @endphp
                            @if($with=='x')
                                <div class="w-full text-center font-s-20">
                                    <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\frac{dy}{dx} = <?=$detail['res']?>} \)</strong></p>
                                </div>
                                @if(is_numeric($x) && is_numeric($y))
                                    <div class="w-full text-center font-s-20 mt-3">
                                        <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\frac{dy}{dx}|_{(x,y)=(<?=$x.','.$y?>)} = <?=round($detail['resf'],3)?>} \)</strong></p>
                                    </div>
                                @endif
                            @else
                                <div class="w-full text-center font-s-20">
                                    <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\frac{dx}{dy} = <?=$detail['res']?>} \)</strong></p>
                                </div>
                                @if(is_numeric($x) && is_numeric($y))
                                    <div class="w-full text-center font-s-20 mt-3">
                                        <p class="my-3"><strong class="bg-[#ffffff] px-3 py-4 text-[32px] rounded-lg text-blue-500">\( \color{#1670a7} {\frac{dx}{dy}|_{(x,y)=(<?=$x.','.$y?>)} = <?=round($detail['resf'],3)?>} \)</strong></p>
                                    </div>
                                @endif
                            @endif
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