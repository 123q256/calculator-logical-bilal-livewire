<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php 
                $request = request();
            @endphp
            <div class="col-span-12">
                <label for="EnterEq" class="font-s-14 text-blue">f(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'x-2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="EnterEq1" class="font-s-14 text-blue">g(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="EnterEq1" id="EnterEq1" class="input" value="{{ isset($request->EnterEq1)?$request->EnterEq1:'-2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="font-s-14 text-blue"><?=$lang['1']?>:</label>
                <div class="w-full py-2">
                    <input type="number" name="ub" id="ub" class="input" value="{{ isset($request->ub)?$request->ub:'3' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="lb" class="font-s-14 text-blue"><?=$lang['2']?>:</label>
                <div class="w-full py-2">
                    <input type="number" name="lb" id="lb" class="input" value="{{ isset($request->lb)?$request->lb:'2' }}" aria-label="input"/>
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
                                $ub= $request->ub;
                                $lb= $request->lb;
                            @endphp
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong><?=$lang['3']?></strong></p>
                                <p class="mt-3">\( \pi \int\limits_<?=$lb.'^'.$ub?> (<?=$detail['enter']?>)\, dx \)</p>
                                <p class="mt-3">\(= \pi \times <?=$detail['ress']?> ≈ <?=round($detail['ress1'],3)?>\)</p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['4']?></strong></p>
                                <p class="mt-3">\( \pi \int (<?=$detail['enter']?>)\, dx \)</p>
                                <p class="mt-3">\(= \pi \left(<?=$detail['res']?>\right) + \mathrm{constant}\)</p>
                                <p class="mt-3"><strong><?=$lang['5']?>:</strong></p>
                                <p class="mt-3">\( \int (<?=$detail['enter']?>)\, dx \)</p>
                                <div class="w-full  mt-3 res_step">
                                    <?=$detail['step']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        @if (isset($detail))
            <script>
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            </script>
        @endif
    @endpush
</form>