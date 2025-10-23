<style>
img{
    object-fit: contain;
}
</style>
    
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                @php $request = request(); @endphp
                <div class="col-span-12">
                    <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'4x^3+3x^2-6x+1' }}" aria-label="input"/>
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
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong>Derivative</strong></p>
                                <p class="mt-3">\(<?=$detail['simple']?>\)</p>
                                <p class="mt-3 text-[18px]"><strong>Factoring</strong></p>
                                <p class="mt-3">\(<?=$detail['fac']?>\)</p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['3']?></strong></p>
                                <p class="mt-3">\(<?=$detail['root']?>\)</p>
                                <p class="mt-3 text-[18px]"><strong>Local Minima</strong></p>
                                <p class="mt-3">\( (x,f(x))=<?=$detail['mini']?>\)</p>
                                <p class="mt-3 text-[18px]"><strong>Local Maxima</strong></p>
                                <p class="mt-3">\( (x,f(x))=<?=$detail['maxi']?>\)</p>
                                <p class="mt-3"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-3"><?=$lang['4']?>:</p>
                                <p class="mt-3 mb-3">\( \frac{d}{d x}\left(<?=$detail['enter']?>\right) \)</p>
                                <div class="w-full res_step">
                                    <?=$detail['buffer']?>
                                </div>
                                @if(isset($detail['wrt']))
                                    <p class="mt-3"><?=$lang['4']?>:</p>
                                    <p class="mt-3 mb-3">\( \frac{\partial}{\partial y}\left(<?=$detail['enter']?>\right) \)</p>
                                    <div class="w-full res_step">
                                        <?=$detail['step']?>
                                    </div>
                                    <p class="mt-3"><strong><?=$lang['6']?> f'(x,y) = 0</strong></p>
                                    <p class="mt-3">\( <?=$detail['ans']?> = 0\)</p>
                                    <p class="mt-3">\( <?=$detail['ans1']?> = 0\)</p>
                                @else
                                    <p class="mt-3"><?=$lang['6']?> f'(x) = 0</p>
                                    <p class="mt-3">\( <?=$detail['ans']?> = 0\)</p>
                                @endif
                                <p class="mt-3"><?=$lang['7']?>: \( <?=$detail['root']?>\)</p>
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