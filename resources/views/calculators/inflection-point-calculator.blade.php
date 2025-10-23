<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       @php $request = request(); @endphp
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="eq" class="label">{{$lang['1']}}:</label>
                    <div class="w-full py-2 relative">
                        <input type="text" name="eq" id="eq" class="input" value="{{ isset($request->eq)?$request->eq:'x*e^(-3x)' }}" aria-label="input"/>
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
                        <div class="row">
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[16px]"><strong>{{$lang['4']}} {{$lang['5']}}</strong></p>
                                <?php if(isset($detail['ip_1'])){ ?>
                                    <p class="mt-3">\( (<?=$detail['ip1'].', '.$detail['ip11']?>) \)</p>
                                <?php }elseif(isset($detail['no'])){ ?>
                                    <p class="mt-3">\( <?=$lang['6']?> \space <?=$lang['4']?> \space <?=$lang['5']?> \)</p>
                                <?php }else{ ?>
                                    <p class="mt-3">\( (<?=$detail['ip1'].', '.$detail['ip2']?>) \)</p>
                                    <p class="mt-3">\( (<?=$detail['ip11'].', '.$detail['ip22']?>) \)</p>
                                <?php } ?>
                                <?php if(isset($detail['no'])){ ?>
                                    <p class="mt-3 text-[16px]"><strong><?=$lang['10']?></strong></p>
                                    <p class="mt-3">\( (<?='-\infty , \infty'?>) \)</p>
                                    <p class="mt-3 text-[16px]"><strong><?=$lang['11']?></strong></p>
                                    <p class="mt-3">\( <?='\emptyset'?> \)</p>
                                <?php }else{ ?>
                                    <p class="mt-3 text-[16px]"><strong><?=$lang['10']?></strong></p>
                                    <p class="mt-3">\( (<?=$detail['ip1'].', \infty'?>) \)</p>
                                    <p class="mt-3 text-[16px]"><strong><?=$lang['11']?></strong></p>
                                    <p class="mt-3">\( (<?='-\infty , '.$detail['ip1']?>) \)</p>
                                <?php } ?>
                                <?php if(isset($detail['iptype'])){ ?>
                                    <?php if($detail['iptype']<0){ ?>
                                        <p class="mt-3 text-[16px]"><strong><?=$lang['12']?></strong></p>
                                        <p class="mt-3">\( <?=$lang['13']?> \space <?=$lang['14']?> \space <?=$lang['15']?> \)</p>
                                    <?php }else{ ?>
                                        <p class="mt-3 text-[16px]"><strong><?=$lang['12']?></strong></p>
                                        <p class="mt-3">\( <?=$lang['16']?> \space <?=$lang['14']?> \space <?=$lang['17']?> \)</p>
                                    <?php } ?>
                                <?php } ?>
                                <p class="mt-3 text-[16px]"><strong>\( f' (x)\) <?=$lang['7']?></strong></p>
                                <p class="mt-3">\( <?=$detail['diff']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['8']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal">
                                    <?=$detail['step']?>
                                </div>
                                <p class="mt-3 text-[16px]"><strong>\( f'' (x)\) <?=$lang['7']?></strong></p>
                                <p class="mt-3">\( <?=$detail['diff1']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat1" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['8']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal1">
                                    <?=$detail['step1']?>
                                </div>
                                <p class="mt-3 text-[16px]"><strong>\( f''' (x)\) <?=$lang['7']?></strong></p>
                                <p class="mt-3">\( <?=$detail['diff2']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat2" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['8']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal2">
                                    <?=$detail['step2']?>
                                </div>
                                <p class="mt-3 text-[16px]"><strong><?=$lang['9']?></strong></p>
                                <?php if(isset($detail['root'])){ ?>
                                    <p class="mt-3">\( <?=$detail['root']?>\)</p>
                                <?php }else{ ?>
                                    <p class="mt-3">\( <?=$lang['6']?> \space <?=$lang['9']?> \)</p>
                                <?php } ?>
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
                // document.addEventListener('DOMContentLoaded', function() {
                var repeatElement = document.querySelectorAll('.repeat');
                repeatElement.forEach(function(repeatElement) {
                    repeatElement.addEventListener('click', function() {
                        var elementsToToggle = document.querySelectorAll('#step_cal');
                        elementsToToggle.forEach(function(element) {
                            if (element.style.display === 'none' || element.style.display === '') {
                                element.style.display = 'block';
                                element.style.maxHeight = '0';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-out';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                });
                                setTimeout(function() {
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            } else {
                                element.style.maxHeight = element.scrollHeight + 'px';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-in';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = '0';
                                });
                                setTimeout(function() {
                                    element.style.display = 'none';
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            }
                        });
                    });
                });
                var repeatElement1 = document.querySelectorAll('.repeat1');
                repeatElement1.forEach(function(repeatElement) {
                    repeatElement.addEventListener('click', function() {
                        var elementsToToggle = document.querySelectorAll('#step_cal1');
                        elementsToToggle.forEach(function(element) {
                            if (element.style.display === 'none' || element.style.display === '') {
                                element.style.display = 'block';
                                element.style.maxHeight = '0';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-out';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                });
                                setTimeout(function() {
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            } else {
                                element.style.maxHeight = element.scrollHeight + 'px';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-in';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = '0';
                                });
                                setTimeout(function() {
                                    element.style.display = 'none';
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            }
                        });
                    });
                });
                var repeatElement2 = document.querySelectorAll('.repeat2');
                repeatElement2.forEach(function(repeatElement) {
                    repeatElement.addEventListener('click', function() {
                        var elementsToToggle = document.querySelectorAll('#step_cal2');
                        elementsToToggle.forEach(function(element) {
                            if (element.style.display === 'none' || element.style.display === '') {
                                element.style.display = 'block';
                                element.style.maxHeight = '0';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-out';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                });
                                setTimeout(function() {
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            } else {
                                element.style.maxHeight = element.scrollHeight + 'px';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-in';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = '0';
                                });
                                setTimeout(function() {
                                    element.style.display = 'none';
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            }
                        });
                    });
                });
                // });
            </script>
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
                    var enterEq = document.getElementById('eq');
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