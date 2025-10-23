<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
           <input type="hidden" name="hidden_val" id="hidden_val" class="hidden_val" value="0">
            <div class="grid grid-cols-12 mt-3  gap-2">
                 
                      

                <div class="col-span-10 mt-lg-2">
                    <label for="EnterEq" class="font-s-14 text-blue" >{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input 
                            type="text" 
                            name="EnterEq" 
                            id="EnterEq" 
                            class="input" 
                            aria-label="input" 
                            placeholder="(6x^2 - 4)"
                            value="{{ isset($_POST['EnterEq']) ? $_POST['EnterEq'] : '(6x^2 - 4)' }}" 
                        />
                    </div>
                </div>
                <div class="col-span-2 mt-lg-2">
                    <label for="EnterEq" class="font-s-14 text-blue" >&nbsp;</label>
                    <span class="text-blue keyshow " >
                        <img 
                            src="{{ asset('images/keyboard.png') }}" 
                            class="keyboardImg transform w-9 h-9" 
                            alt="keyboard"  
                        >
                    </span>
                </div>

                <div class="col-span-12 mt-lg-2 hidden  justify-center keyboard">
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" onclick="clear_input();">CLS</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" value="+">+</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" value="-">-</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" value="/">/</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" value="*">*</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" value="^">^</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600" value="sqrt(">√</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600 inp_wraps" value="(">(</button>
                    <button type="button" class="btn buttn  py-2 mx-1 mb-2 bg-blue-700 text-white rounded-sm h-9 px-4 uppercase shadow-md hover:bg-blue-600 inp_wraps" value=")">)</button>
                </div>
                

                <div class="col-span-2">
                    <label for="x" class="font-s-14 text-blue">&nbsp;</label>
                    <p class="p_set pt-3"><strong>x = {{ $lang['2'] }}</strong></p>
                </div>
                <div class="col-span-10">
                    <label for="x" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="x" id="x" class="input" aria-label="input"
                            placeholder="413" value="{{ isset($_POST['x']) ? $_POST['x'] : '4' }}" />
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
                    @php
                        $parem = $detail['equation'];
                        $deriv = $detail['deriv'];
                        $steps = $detail['steps'];
                    @endphp
                    <div class="w-full text-[18px] ">
                        <p class="mt-2">{{ $lang['3'] }}</p>
                        <p class="mt-2">\( { \partial ({{ $parem }}) \over {\partial x}} \)<span>\( {{ $lang['4'] }}
                                \space x = {{ $_POST['x'] }} \)</span></p>
                        <p class="mt-2">{{ $lang['5'] }}</p>
                        <p class="mt-2">\( {{ $deriv }} \)</p>
                        <p class="mt-2">{{ $lang['6'] }}:</p>
                        <div class="mt-2 px-3"> {!! $steps !!}</div>
                        <p class="mt-2"><strong>3. {{ $lang['7'] }}:</strong> \( {{ $deriv }} \)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
@if (isset($detail))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
    MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
</script>
@endif
<script>

        document.querySelector('.keyshow').addEventListener('click', function() {
            document.querySelector('.keyboard').classList.toggle('hidden');
              // Toggle the value between 0 and 1
            var hiddenVal = document.getElementById('hidden_val');
            hiddenVal.value = hiddenVal.value === '0' ? '1' : '0';
        });


    @if(isset($detail))
    var type = "{{$_POST['hidden_val']}}";
    if(type == 1){
        document.querySelector('.keyboard').classList.toggle('hidden');
        var hiddenVal = document.getElementById('hidden_val');
        hiddenVal.value = hiddenVal.value === '0' ? '1' : '0';
    }

    @endif
    document.addEventListener('DOMContentLoaded', function() {
        var buttons = document.querySelectorAll('.buttn');
        var enterEqInput = document.getElementById('EnterEq');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var val = button.value;
                enterEqInput.value += val;
            });
        });
    });

    function clear_input() {
        var check = confirm("Are you sure you want to clear Equation?");
        if (check === true) {
            document.getElementById('EnterEq').value = '';
        }
    }
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>