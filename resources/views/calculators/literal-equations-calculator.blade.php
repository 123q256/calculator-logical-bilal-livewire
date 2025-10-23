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
        padding: 7px 15px;
        border-radius: 5px;
        cursor: pointer;
        color: #000000;
      }
    
    </style>

<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['find'] = "x";
                }
            @endphp
            @isset($detail)
                <style>
                    #exampleLoadBtn{
                        background: #1670a712
                    }
                </style>
            @endisset

            <div class="col-span-12">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center">
                        <label for="equ" class="label">{{ $lang['1'] }}</label>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 flex justify-end">
                        <button type="button" class="flex items-center" id="exampleLoadBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-4 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            Load Example
                        </button>
                    </div>
                </div>
                <div class="w-100 py-2">
                    <input type="text" name="equ" id="equ" class="input" value="{{ isset($_POST['equ']) ? $_POST['equ'] : '4x+7=2x+1' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="find" class="label">{{ $lang['6'] }}</label>
                <div class="w-full py-2">
                    <select name="find" class="input" id="find" aria-label="select">
                        <option value="a" {{ isset($_POST['find']) && $_POST['find']=='a'?'selected':'' }}>a</option>
                        <option value="b" {{ isset($_POST['find']) && $_POST['find']=='b'?'selected':'' }}>b</option>
                        <option value="c" {{ isset($_POST['find']) && $_POST['find']=='c'?'selected':'' }}>c</option>
                        <option value="x" {{ isset($_POST['find']) && $_POST['find']=='x'?'selected':'' }}>x</option>
                        <option value="y" {{ isset($_POST['find']) && $_POST['find']=='y'?'selected':'' }}>y</option>
                        <option value="z" {{ isset($_POST['find']) && $_POST['find']=='z'?'selected':'' }}>z</option>
                        <option value="t" {{ isset($_POST['find']) && $_POST['find']=='t'?'selected':'' }}>t</option>
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
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[20px]">\( {{$detail['final']}} \)</p>
                            @isset($detail['explain'])
                                <p class="mt-3"><strong>{{$lang['4']}}:</strong></p>
                            @endisset
                            @foreach ($detail['explain'] as $key => $value)
                                <p class="mt-3">{!!$value!!}</p>
                                <p class="mt-3">\( {!!$detail['steps'][$key]!!} \)</p>
                                @if(isset($detail['final_steps'][$key]))
                                    <p class="mt-3">\( {!!$detail['final_steps'][$key]!!} \)</p>
                                @else
                                    <p class="mt-3">\( {!!$detail['final']!!} \)</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.querySelector('#exampleLoadBtn').addEventListener('click', function() {
                var eq = [
                    "4x+7=2x+1",
                    "3x+2y=6",
                    "4y=2x - 12",
                    "6a-3b=27",
                    "3x+y=5+5x",
                ];
                var t = eq[Math.floor(Math.random() * eq.length)];
                document.querySelector("#equ").value = t;
            });
        </script>
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>
    @endpush
</form>