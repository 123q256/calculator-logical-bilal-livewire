<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php $request = request(); @endphp
            <div class="col-span-12">
                <label for="EnterEq" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'2x + 4' }}" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" width="35" style="top: 31px" height="35" alt="keyboard" loading="lazy" decoding="async" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9">
                </div>
                <div class="col-span-12 hidden keyboard">
                    <button type="button" class="bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" onclick="clear_input();">CLS</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="+">+</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="-">-</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="/">/</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="*">*</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="^">^</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="sqrt(">√</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value="(">(</button>
                    <button type="button" class="keyBtn bg-green-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" value=")">)</button>
                </div>
            </div>
            <div class="col-span-12">
                <label for="x" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($request->x)?$request->x:'2' }}" aria-label="input"/>
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
                            <div class="w-full text-center my-3">
                                <p><strong class="bg-[#ffffff] p-3 text-[21px] rounded-lg">\( \color{#000000}{ {{$detail['ans']}} } \)</strong></p>
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
        <script>
            function clear_input() {
                var check = confirm("Are you sure you want to clear Equation?");
                if (check === true) {
                    document.getElementById('EnterEq').value = '';
                }
            }
            document.querySelectorAll('.keyBtn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var val = this.value;
                    var enterEq = document.getElementById('EnterEq');
                    enterEq.value += val;
                    var equ = enterEq.value;
                    EquPreview(equ, 0);
                });
            });
            document.querySelectorAll('.keyboardImg').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.keyboard').forEach(function(keyboard) {
                        if (keyboard.style.display === 'none' || keyboard.style.display === '') {
                            keyboard.style.display = 'block';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        } else {
                            keyboard.style.display = 'none';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        }
                    });
                });
            });
        </script>
    @endpush
</form>