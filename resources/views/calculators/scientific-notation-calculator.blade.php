<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'calculator' ? 'calculator':'converter' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
            <div class="lg:w-1/2 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white {{ isset($request->type) && $request->type === 'calculator' ? '':'tagsUnit' }} tab" data-value="converter" id="imperial">
                        {{ $lang['1'] }}
                </div>
            </div>
            <div class="lg:w-1/2 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{ isset($request->type) && $request->type === 'calculator' ? 'tagsUnit':'' }} hover:text-white tab" data-value="calculator" id="metric">
                    <?=$cal_name?>
                </div>
            </div>
          </div>
       </div>
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php $request = request(); @endphp

            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 {{ isset($request->type) && $request->type === 'calculator' ? 'd-none':'' }}" id="converter">
                    <p class="font-s-14"><strong><?=$lang['4']?>:</strong> <?=$lang['5']?></p>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="decimal" class="label">{{$lang['1']}}</label>
                        <div class="w-full py-2">
                            <input type="text" name="decimal" id="decimal" class="input" value="{{ isset($request->decimal)?$request->decimal:'1.356 x 10^5' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 {{ isset($request->type) && $request->type === 'calculator' ? '':'d-none' }}" id="calculator">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-2 hidden md:block lg:block"></div>
                        <div class="col-span-6 md:col-span-4 lg:col-span-4">
                            <label for="nbr1" class="label"><?=$lang['2']?>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="nbr1" id="nbr1" class="input" value="{{ isset($request->nbr1)?$request->nbr1:'3.12' }}" aria-label="input">
                            </div>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="mt-4 text-center"><strong>x 10 ^</strong></p>
                        </div>
                        <div class="col-span-4">
                            <label for="pwr1" class="label ">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" name="pwr1" id="pwr1" class="input" value="{{ isset($request->pwr1)?$request->pwr1:'4' }}" aria-label="input">
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <label for="opr" class="label hidden md:block lg:block">&nbsp;</label>
                            <div class="w-full py-2">
                                <select name="opr" class="input" id="opr" aria-label="select">
                                    <option value="+">+</option>
                                    <option value="-" {{ isset($request->opr) && $request->opr == '-' ? 'selected' : '' }}>-</option>
                                    <option value="*" {{ isset($request->opr) && $request->opr == '*' ? 'selected' : '' }}>*</option>
                                    <option value="/" {{ isset($request->opr) && $request->opr == '/' ? 'selected' : '' }}>/</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-4 lg:col-span-4">
                            <label for="nbr2" class="label"><?=$lang['3']?>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="nbr2" id="nbr2" class="input" value="{{ isset($request->nbr2)?$request->nbr2:'1.52' }}" aria-label="input">
                            </div>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="mt-4 text-center"><strong>x 10 ^</strong></p>
                        </div>
                        <div class="col-span-4">
                            <label for="pwr2" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" name="pwr2" id="pwr2" class="input" value="{{ isset($request->pwr2)?$request->pwr2:'-2' }}" aria-label="input">
                            </div>
                        </div>
                        
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
                                <p class="mt-2"><?=$lang[6]?></p>
                                <p class="mt-2 text-[21px]">
                                    <strong>
                                        <span id="mantissa"><?=((isset($detail['left']))?$detail['left']:$_GET['left'])?></span> <span class="text-muted">x 10</span><sup class="font-s-12" id="exponent"><?=((isset($detail['right']))?$detail['right']:$_GET['right'])?></sup>
                                    </strong>
                                </p>
                                <button type="button" class="calculate mt-2 right cursur-pointer bg-[#2845F5] text-white  rounded-lg" style="padding: 10px 15px;cursor: pointer;" onclick="raise_power();">←</button>
                                <button type="button" class="calculate mt-2 ms-2 left bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px;cursor: pointer;" onclick="lower_power();">→</button>
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><?=$lang['7']?></td>
                                            <td class="py-2 border-b"><?=((isset($detail['e_ans']))?$detail['e_ans']:$_GET['en'])?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><?=$lang['9']?></td>
                                            <td class="py-2 border-b"><?=((isset($detail['ee_ans']))?$detail['ee_ans']:$_GET['een'])?> x10<sup class="font-s-12"><?=((isset($detail['ee_p']))?$detail['ee_p']:$_GET['eep'])?></sup></td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="py-2 border-b" width="40%">&nbsp;</td>
                                            <td class="py-2 border-b"><?=((isset($detail['left']))?$detail['left']:$_GET['left'])?> x 10<sup class="font-s-12"><?=((isset($detail['right']))?$detail['right']:$_GET['right'])?></sup></td>
                                        </tr> --}}
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><?=$lang['8']?></td>
                                            <td class="py-2 border-b"><?=((isset($detail['ans']))?$detail['ans']:$_GET['real'])?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><?=$lang['13']?></td>
                                            <td class="py-2 border-b"><?=((isset($detail['right']))?$detail['right']:$_GET['right'])?></td>
                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" id="number" value="<?=((isset($detail['ans']))?$detail['ans']:$_GET['real'])?>">
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
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'calculator') {
                        ['#calculator'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('d-none');
                            });
                        });
                        ['#converter'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('d-none');
                            });
                        });
                    } else {
                        ['#calculator'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('d-none');
                            });
                        });
                        ['#converter'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('d-none');
                            });
                        });
                    }
                });
            });
        </script>
        @isset($detail)
        <script>
            function show_number(){
                var str=document.getElementById("number").value.split('.');
                if(str.length>1){
                    dp=str[1].length
                }else{
                    dp=0;
                }
                dp+=power;
                if(dp<0){
                    dp=0;
                }
                if(dp>20){dp=20;}
                document.getElementById("exponent").innerHTML=power;
                document.getElementById("mantissa").innerHTML=(document.getElementById("number").value/Math.pow(10,power)).toFixed(dp);
            }
            var power={{((isset($detail['right']))?$detail['right']:$_GET['right'])}};
            function raise_power(){
                power++;
                show_number();
            }
            function lower_power(){
                power--;
                show_number();
            }
        </script>
    @endisset
    @endpush
</form>