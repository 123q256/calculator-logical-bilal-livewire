<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-2 md:gap-4 lg:gap-4">
            @php $request = request(); @endphp
            <div class="col-12 mt-0 mt-lg-2">
                <label for="x" class="label"><?=$lang['enter']?></label>
                <div class="w-full py-2">
                    <input type="text" name="x" id="x" class="input" value="{{ isset($request->x) ? $request->x : '135900000' }}" aria-label="input" />
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
                                <p class="mt-2"><?=$lang[2]?></p>
                                <p class="mt-2 font-s-21">
                                    <strong>
                                        <span id="mantissa"><?=((isset($detail['left']))?$detail['left']:$_GET['left'])?></span> <span class="text-muted">x 10</span> <sup class="text-[12px]" id="exponent"><?=((isset($detail['right']))?$detail['right']:$_GET['right'])?></sup>
                                    </strong>
                                </p>
                                <button type="button" class="calculate mt-2 right cursur-pointer bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px;cursor: pointer;" onclick="raise_power();">←</button>
                                <button type="button" class="calculate mt-2 ms-2 left bg-[#2845F5] text-white rounded-lg" style="padding: 10px 15px;cursor: pointer;" onclick="lower_power();">→</button>
                                <p class="mt-3">Standard form is also known as Scientific Notation. <a href="https://calculator-online.net/scientific-notation-calculator/" class="text-blue" target="_blank">Scientific Notation Calculator</a></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><?=$lang['e_n']?></td>
                                            <td class="py-2 border-b"><?=((isset($detail['e_ans']))?$detail['e_ans']:$_GET['en'])?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><?=$lang['en_n']?></td>
                                            <td class="py-2 border-b"><?=((isset($detail['ee_ans']))?$detail['ee_ans']:$_GET['een'])?> x10<sup class="text-[12px]"><?=((isset($detail['ee_p']))?$detail['ee_p']:$_GET['eep'])?></sup></td>
                                        </tr>
                                        <?php if($detail['real_num'] === 0){ ?>
                                            <tr>
                                                <td class="py-2 border-b"><?=$lang['r_n']?></td>
                                                <td class="py-2 border-b"><?=((isset($detail['number']))?$detail['number']:$_GET['real'])?></td>
                                            </tr>
                                        <?php }else{ ?>
                                            <tr>
                                                <td class="py-2 border-b"><?=$lang['sc_n']?></td>
                                                <td class="py-2 border-b"><span id="mantissa"><?=((isset($detail['left']))?$detail['left']:$_GET['left'])?></span>
                                                    <span class="text-muted">x 10</span>
                                                    <sup class="text-[12px]" id="exponent"><?=((isset($detail['right']))?$detail['right']:$_GET['right'])?></sup></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <input type="hidden" id="number" value="<?=((isset($detail['number']))?$detail['number']:$_GET['real'])?>">
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
