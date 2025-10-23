<style>
    @keyframes blink {
    0%, 100% {
      border-color: transparent;
    }
    50% {
      border-color: #2845F5;
    }
  }

  #exampleLoadBtn {
    animation: blink 1s infinite;
    border: 2px solid transparent; /* Default border transparent */
    background: #1670a712;
    padding: 7px 10px;
    border-radius: 100px;
    cursor: pointer;
    font-size: 12px;
    color: #000000;
  }
    </style>

<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
  <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @isset($detail)
                    <style>
                        #exampleLoadBtn{
                            background: #1670a712
                        }
                    </style>
                @endisset
                @php $request = request(); @endphp
                <div class="col-span-12">
                 
                    <div class="">
                        <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                            <div class="flex items-center col-span-12 md:col-span-8 lg:col-span-8">
                        <label for="EnterEq" class="text-[12px] ">{{$lang['1']}} {{$lang['2']}} e^(3t) {{$lang['3']}} e^{3t}</label>
                        </div>
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 flex justify-end">
                        <button type="button" class="  flex border rounded-lg p-1  items-center" id="exampleLoadBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-5 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            Load Example
                        </button>
                        </div>
                        </div>
                    </div>
                    <div class="w-full py-2 relative">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'6e^{-5t} + e^{3t} + 5t^3 - 9' }}" aria-label="input"/>
                        <img src="{{ asset('images/keyboard.png') }}" width="35" style="top: 31px" height="35" alt="keyboard" loading="lazy" decoding="async" class="keyboardImg  absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9">
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
                                <p><strong class="bg-[#ffffff]  p-3 text-[25px] rounded-lg">\( \color{#1670a7}{ {{$detail['ans']}} } \)</strong></p>
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
            document.querySelector('#exampleLoadBtn').addEventListener('click', function() {
                var eq = [
                    "t^2",
                    "(10t)^3/2",
                    "sin(2t)",
                    "cos(5t)",
                    "e^3t",
                ];
                var t = eq[Math.floor(Math.random() * eq.length)];
                document.querySelector("#EnterEq").value = t;
            });
        </script>
    @endpush
</form>