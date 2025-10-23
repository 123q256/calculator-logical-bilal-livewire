<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="EnterEq1" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="EnterEq1" id="EnterEq1" value="{{ isset($_POST['EnterEq1'])?$_POST['EnterEq1']:'6x+x^3' }}" class="input" aria-label="input" placeholder=" " />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="upper" class="font-s-14 text-blue">{{ $lang[2] }}: (inf = ∞ , pi = π)</label>
                    <div class="w-100 py-2">
                        <input type="text" name="upper" id="upper" value="{{ isset($_POST['upper'])?$_POST['upper']:'inf' }}" class="input" aria-label="input" placeholder=" " />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="lower" class="font-s-14 text-blue">{{ $lang[3] }}: (inf = ∞ , pi = π)</label>
                    <div class="w-100 py-2">
                        <input type="text" name="lower" id="lower" value="{{ isset($_POST['lower'])?$_POST['lower']:'0' }}" class="input" aria-label="input" placeholder=" " />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="with" class="font-s-14 text-blue">W.R.T</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="with" id="with" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ['x','y'];
                                $val = ['x','y'];
                                optionsList($val,$name,isset($_POST['with'])?$_POST['with']:'space');
                            @endphp
                        </select>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['4']?>:</td>
                                        <td class="py-2 border-b"><strong>\( \int\limits_{<?=$detail['lb'].'}^{'.$detail['ub']?>} \left(<?=$detail['enter']?>\right)\, d<?=$detail['with']?> \)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['5']?>:</td>
                                        <td class="py-2 border-b"><strong>=\( <?=$detail['ans']?>\)</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full mt-3 text-[21px] text-blue-500">{{ $lang[6] }}</p>
                            <div class="w-full mt-3 px-3">
                                <?=$detail['steps']?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
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