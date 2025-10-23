<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="equ" class="label">{{$lang[1]}}:</label>
                <div class="w-full py-2">
                    <input type="text" name="equ" id="equ" value="{{ isset($_POST['equ'])?$_POST['equ']:'3x(2y+13)' }}" class="input" aria-label="input" />
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
                        <div class="col-12 text-center font-s-20">
                            <p>{{$lang[3]}}</p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 text-white py-2 text-[32px] rounded-lg">`{{$detail['ans']}}`</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @push('calculatorJS')
        <script type="text/javascript" async
            src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
        </script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Register.StartupHook("AsciiMath Jax Config",function () {
                var AM = MathJax.InputJax.AsciiMath.AM;
                AM.symbols.push({
                    input:'rightleftharpoons',
                    tag:'mo',
                    output:'\u21CC',
                    tex:'rightleftharpoons',
                    ttype:'d'
                });
            });
        </script>
        
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
                jax: ["input/TeX", "input/AsciiMath", "output/CommonHTML"],
                extensions: ["tex2jax.js", "asciimath2jax.js"],
                TeX: {
                    extensions: ["AMSmath.js", "AMSsymbols.js", "noErrors.js", "noUndefined.js"]
                },
                tex2jax: {
                    inlineMath: [['`','`']]
                },
                asciimath2jax: {
                    delimiters: [['#','#']]
                },
                CommonHTML: {
                    linebreaks: {
                        automatic: true
                    }
                },
                messageStyle: "none",
                MathMenu: {
                    showLocale: false,
                    showRenderer: false
                }
            });
        </script>
        @endpush
    @endisset
</form>