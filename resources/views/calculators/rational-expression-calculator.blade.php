<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php $request = request();@endphp
                <div class="col-span-12">
                    <label for="to" class="font-s-14 text-blue"><?= $lang['1'] ?>:</label>
                    <div class="w-100 py-2">
                        <select name="to" class="input" id="to" aria-label="select">
                            <option value="1"><?=$lang[2]?></option>
                            <option value="2" {{ isset($request->to) && $request->to == '2' ? 'selected' : '' }}><?=$lang[3]?></option>
                            <option value="3" {{ isset($request->to) && $request->to == '3' ? 'selected' : '' }}><?=$lang[4]?></option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 basic {{ isset($request->to) && $request->to !== '1' ? 'hidden' : '' }}">
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="n1" class="font-s-14 text-blue"><?=$lang['5']?>:</label>
                        <div class="w-100 py-2">
                            <input type="text" name="n1" id="n1" class="input" aria-label="input" value="{{ isset($request->n1) ? $request->n1 : 'x^2-2x+1' }}" />
                        </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="d1" class="font-s-14 text-blue"><?=$lang['6']?>:</label>
                        <div class="w-100 py-2">
                            <input type="text" name="d1" id="d1" class="input" aria-label="input" value="{{ isset($request->d1) ? $request->d1 : 'x^2-1' }}" />
                        </div>
                    </div>
                </div>
                <div class="col-span-12 advance {{ isset($request->to) && $request->to == '2' ? '' : 'hidden' }}">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 flex items-center justify-center">
                        <p id="twoInput">
                            <input type="radio" name="to_cal" id="two" value="two" {{ isset($request->to_cal) && $request->to_cal==='two' ? 'checked':'checked' }}>
                            <label for="two" class="font-s-14"><?=$lang['7']?></label>
                        </p>
                        <p class="ms-4" id="threeInput">
                            <input type="radio" name="to_cal" id="three" value="three" {{ isset($request->to_cal) && $request->to_cal==='three' ? 'checked':'' }}>
                            <label for="three" class="font-s-14"><?=$lang['8']?></label>
                        </p>
                    </div>
                    <div class="col-span-12 far2 {{ isset($request->to_cal) && $request->to_cal==='three' ? 'hidden':'' }}">
                        <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-5">
                                <input type="text" name="n11" id="n11" class="input mb-2" value="{{ isset($request->n11)?$request->n11:'x^2-13' }}" placeholder="numerator" aria-label="input"/>
                                <hr>
                                <input type="text" name="d11" id="d11" class="input mt-2" value="{{ isset($request->d11)?$request->d11:'x^3-26' }}" placeholder="denominator" aria-label="input"/>
                            </div>
                            <div class="col-span-2 flex items-center">
                                <select name="action" class="input" id="to" aria-label="select">
                                    <option value="plus"><b>+</b></option>
                                    <option value="-" {{ isset($request->action) && $request->action == '-' ? 'selected' : '' }}><b>-</b></option>
                                    <option value="*" {{ isset($request->action) && $request->action == '*' ? 'selected' : '' }}><b>×</b></option>
                                    <option value="div" {{ isset($request->action) && $request->action == 'div' ? 'selected' : '' }}><b>÷</b></option>
                                </select>
                            </div>
                            <div class="col-span-5">
                                <input type="text" name="n22" id="n22" class="input mb-2" value="{{ isset($request->n22)?$request->n22:'x^3-3' }}" placeholder="numerator" aria-label="input"/>
                                <hr>
                                <input type="text" name="d22" id="d22" class="input mt-2" value="{{ isset($request->d22)?$request->d22:'x-2' }}" placeholder="denominator" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 far3 {{ isset($request->to_cal) && $request->to_cal==='three' ? '':'hidden' }}">
                        <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-3">
                                <input type="text" name="n13" id="n13" class="input mb-2" value="{{ isset($request->n13)?$request->n13:'x^2-13' }}" placeholder="numerator" aria-label="input"/>
                                <hr>
                                <input type="text" name="d13" id="d13" class="input mt-2" value="{{ isset($request->d13)?$request->d13:'x^3-26' }}" placeholder="denominator" aria-label="input"/>
                            </div>
                            <div class="col-span-2 flex items-center">
                                <select name="action1" class="input" aria-label="select">
                                    <option value="plus"><b>+</b></option>
                                    <option value="-" {{ isset($request->action1) && $request->action1 == '-' ? 'selected' : '' }}><b>-</b></option>
                                    <option value="*" {{ isset($request->action1) && $request->action1 == '*' ? 'selected' : '' }}><b>×</b></option>
                                    <option value="div" {{ isset($request->action1) && $request->action1 == 'div' ? 'selected' : '' }}><b>÷</b></option>
                                </select>
                            </div>
                            <div class="col-span-3">
                                <input type="text" name="n23" id="n23" class="input mb-2" value="{{ isset($request->n23)?$request->n23:'x^3-3' }}" placeholder="numerator" aria-label="input"/>
                                <hr>
                                <input type="text" name="d23" id="d23" class="input mt-2" value="{{ isset($request->d23)?$request->d23:'x-2' }}" placeholder="denominator" aria-label="input"/>
                            </div>
                            <div class="col-span-1 flex items-center">
                                <select name="action2" class="input" aria-label="select">
                                    <option value="plus"><b>+</b></option>
                                    <option value="-" {{ isset($request->action2) && $request->action2 == '-' ? 'selected' : '' }}><b>-</b></option>
                                    <option value="*" {{ isset($request->action2) && $request->action2 == '*' ? 'selected' : '' }}><b>×</b></option>
                                    <option value="div" {{ isset($request->action2) && $request->action2 == 'div' ? 'selected' : '' }}><b>÷</b></option>
                                </select>
                            </div>
                            <div class="col-span-3">
                                <input type="text" name="n33" id="n33" class="input mb-2" value="{{ isset($request->n33)?$request->n33:'2x^3+12-3x' }}" placeholder="numerator" aria-label="input"/>
                                <hr>
                                <input type="text" name="d33" id="d33" class="input mt-2" value="{{ isset($request->d33)?$request->d33:'3x-5' }}" placeholder="denominator" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="col-span-12 simple {{ isset($request->to) && $request->to == '3' ? '' : 'hidden' }}">
                    <label for="expr" class="font-s-14 text-blue"><?=$lang['9']?>:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="expr" id="expr" class="input" aria-label="input" value="{{ isset($request->expr) ? $request->expr : '(x^2+3)/(2x+1)-(x+1)/(3x+2)' }}" />
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
                    <div class="row">
                        @if($request->to == 1)
                            <div class="col-12 text-[16px]">
                                <p class="mt-2 text-[16px]">\( <?=$detail['ress']?> \)</p>
                                <p class="mt-2"><strong><?=$lang[11]?>:</strong></p>
                                <p class="mt-2">\( =<?=$detail['enter']?> \)</p>
                                <p class="mt-2">\( =\dfrac{<?=$detail['up']?>}{<?=$detail['down']?>} \)</p>
                                <p class="mt-2">\( =<?=$detail['ress']?> \)</p>
                            </div>
                        @elseif($request->to == 2)
                            @if($to_cal=='two')
                                <?php if(isset($detail['lcm']) && ($detail['action']=='+' || $detail['action']=='-')){ ?>
                                    <div class="col-12 text-[16px]">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11]?>:</strong></p>
                                        <p class="mt-2">\( <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action']?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                    </div>
                                <?php } elseif(isset($detail['lcm']) && ($detail['action']=='*' || $detail['action']=='÷')){ ?>
                                    <div class="col-12 text-center my-2">
                                        <p>
                                            <strong class="bg-white px-3 py-2 font-s-21 rounded-lg text-blue">
                                                \(
                                                    <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> = \dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>}      
                                                \)
                                            </strong>
                                        </p>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-12 text-center my-2">
                                        <p>
                                            <strong class="bg-white px-3 py-2 font-s-21 rounded-lg text-blue">
                                                \(
                                                    <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?>=<?=$detail['ans']?>
                                                \)
                                            </strong>
                                        </p>
                                    </div>
                                <?php } ?>
                            @else
                                <?php if(isset($detail['lcm']) && ($detail['action']=='+' || $detail['action']=='-') && ($detail['action1']=='+' || $detail['action1']=='-')){ ?>
                                    <div class="col-12 font-s-16">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11]?>:</strong></p>
                                        <p class="mt-2">\( <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=$detail['action1']?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action']?>\left(<?=$detail['center']?>\right)<?=$detail['action1']?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                    </div>
                                <?php } elseif(isset($detail['lcm']) && ($detail['action']=='+' || $detail['action']=='-') && ($detail['action1']=='*' || $detail['action1']=='÷')){ ?>
                                    <div class="col-12 font-s-16">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11]?>:</strong></p>
                                        <p class="mt-2">\( =<?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=$detail['action1']?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =<?=$detail['up']?> <?=$detail['action']?> \dfrac{<?=$detail['up1']?>}{<?=$detail['down1']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action']?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                    </div>
                                <?php } elseif(isset($detail['lcm']) && ($detail['action']=='*' || $detail['action']=='÷') && ($detail['action1']=='+' || $detail['action1']=='-')){ ?>
                                    <div class="col-12 font-s-16">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11]?>:</strong></p>
                                        <p class="mt-2">\( =<?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=$detail['action1']?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['up1']?>}{<?=$detail['down1']?>} <?=$detail['action1']?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action1']?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-12 text-center text-[16px]">
                                        <p>\( =<?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=$detail['action1']?> <?=$detail['thr']?> \)</p>
                                        <p class="my-3"><strong class="bg-sky px-3 py-2 text-[32px] rounded-lg text-blue">\( =<?=$detail['ans']?> \)</strong></p>
                                    </div>
                                <?php } ?>
                            @endif
                        @else
                            <div class="col-12 text-center text-[16px]">
                                <p class="my-3"><strong class="bg-sky px-3 py-4 text-[32px] rounded-lg text-blue">\( <?=$detail['enter']?>=<?=$detail['ans']?> \)</strong></p>
                            </div>
                        @endif
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
            document.querySelector('#twoInput').addEventListener('click', function() {
                document.querySelector('.far2').classList.remove('hidden');
                document.querySelector('.far3').classList.add('hidden');
            });
            document.querySelector('#threeInput').addEventListener('click', function() {
                document.querySelector('.far2').classList.add('hidden');
                document.querySelector('.far3').classList.remove('hidden');
            });
            document.getElementById('to').addEventListener('change', function() {
                var to = document.getElementById('to').value;
                if (to == 1) {
                    ['.basic'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.advance', '.simple'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                } else if (to == 2) {
                    ['.advance'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.basic', '.simple'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                } else if (to == 3) {
                    ['.simple'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.basic', '.advance'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
