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
                if(!isset($request->with)) {
                    $request->with = "x";
                }
            @endphp
         <div class="col-span-9">
                <label for="EnterEq" class="text-[14px]"><?=$lang['1']?>:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'(x-3)^n/n' }}" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">

                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="text-[14px]"><?=$lang[2]?>:</label>
                <div class="w-100 py-2">
                    <select name="with" class="input" id="with" aria-label="select">
                        <option value="x">x</option>
                        <option value="y" {{ isset($request->with) && $request->with=='y'?'selected':'' }}>y</option>
                        <option value="z" {{ isset($request->with) && $request->with=='z'?'selected':'' }}>z</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 hidden keyboard">
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" onclick="clear_input();">CLS</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="+">+</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="-">-</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="/">/</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="*">*</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="^">^</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="sqrt(">√</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="(">(</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value=")">)</button>
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
                        <div class="w-full text-[18px]">
                        {{-- {!!$detail['specificHtml']!!} --}}
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2 px-2 py-1">
                            <table class="w-full text-[18px]">
                                @isset($detail['radius'])
                                    <tr>
                                        <td class="py-2 border-b">Radius of Convergence</td>
                                        <td class="py-2 border-b"><strong>\( {{$detail['radius']}} \)</strong></td>
                                    </tr>
                                @endisset
                                @isset($detail['interval'])
                                    <tr>
                                        <td class="py-2 border-b">Interval of Convergence</td>
                                        <td class="py-2 border-b"><strong>\( {{$detail['interval']}} \)</strong></td>
                                    </tr>
                                @endisset
                            </table>
                        </div>
                            <p class="mt-3 text-center"><strong><?=$lang[3]?></strong></p>
                            <p class="bg-[#ffffff] border rounded-lg px-3 py-2 mt-2 text-[18px] overflow-auto text-center">\(\left|<?=$detail['ans']?>\right| \le 1\)</p>
                            <p class="my-3"><strong><?=$lang[4]?></strong></p>
                            <p class="my-3"><?=$lang[5]?></p>
                            <p class="my-3 font-s-20">\( \sum_{n=1}^\infty<?=$detail['enter']?>\)</p>
                            <p class="my-3"><?=$lang[6]?></p>
                            <p class="my-3"><?=$lang[7]?> L < 1:</p>
                            <p class="my-3 font-s-20">\( L=\lim_{n \to \infty}\left|\dfrac{a_{n+1}}{a_n}\right|\)</p>
                            <p class="my-3">\( a_n=<?=$detail['enter']?>\)</p>
                            <p class="my-3 font-s-20">\( L=\lim_{n \to \infty}\left|\dfrac{<?=str_replace('n', 'n+1', $detail['enter'])?>}{<?=$detail['enter']?>}\right|\)</p>
                            <div class="overflow-auto">
                                <p class="mb-3 mt-4 font-s-20 ">\( L=\lim_{n \to \infty}\left|<?=$detail['equs']?>\right|\)</p>
                            </div>
                            <p class="my-3"><?=$lang[8]?>:</p>
                            <p class="my-3">\( L=\left|<?=$detail['ans']?>\right|\)</p>
                            <p class="my-3"><?=$lang[9]?></p>
                            <p class="my-3">\( \left|<?=$detail['ans']?>\right| \le 1\)</p>
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
         @isset($detail)
         @endisset
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