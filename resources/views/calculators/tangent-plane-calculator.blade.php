<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
           @php $request = request(); @endphp
           <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'three' ? 'three':'two' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'three' ? '':'tagsUnit' }}" id="imperial" data-value="two">
                            {{ $lang['10'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'three' ? 'tagsUnit':'' }}" id="metric" data-value="three">
                            {{ $lang['11'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="eq" class="label">{{$lang['1']}}</label>
                <div class="w-100 py-2">
                    <input type="text" name="eq" id="eq" class="input" value="{{ isset($request->eq)?$request->eq:'x^3 - 3xy + y^3' }}" aria-label="input"/>
                </div>
            </div>
            <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4':'col-span-6' }}" id="xValue">
                <label for="x" class="label"><?=$lang['2']?> x:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($request->x)?$request->x:'1' }}" aria-label="input"/>
                </div>
            </div>
            <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4':'col-span-6' }}" id="yValue">
                <label for="y" class="label"><?=$lang['2']?> y:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y" id="y" class="input" value="{{ isset($request->y)?$request->y:'2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-4 {{ isset($request->type) && $request->type === 'three' ? '':'hidden' }}" id="zValue">
                <label for="z" class="label"><?=$lang['2']?> z:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="z" id="z" class="input" value="{{ isset($request->z)?$request->z:'5' }}" aria-label="input"/>
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
                        @php
                            $eq = $request->eq;
                            $x = $request->x;
                            $y = $request->y;
                            $z = $request->z;
                            $submit = $request->type;
                            $eq=$detail['eq'];
                            $t=$detail['t'];
                            $diffa=$detail['diffa'];
                            $diffb=$detail['diffb'];
                            $stepsx=$detail['stepsx'];
                            $stepsy=$detail['stepsy'];
                            $a=$detail['a'];
                            $b=$detail['b'];
                            $c=$detail['c'];
                            $s1=preg_replace('/x/',"($x)",$diffa);
                            $s1=preg_replace('/y/',"($y)",$s1);
                            $s2=preg_replace('/x/',"($x)",$diffb);
                            $s2=preg_replace('/y/',"($y)",$s2);
                            $s3=preg_replace('/x/',"($x)",$eq);
                            $s3=preg_replace('/y/',"($y)",$s3);
                        @endphp
                        <div class="w-full text-[16px]">
                            @if($submit==='two')
                                <p class="mt-3 text-[18px]">\( z = <?=preg_replace('/frac/','dfrac',$t)?> \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?>:</strong></p>
                                <p class="mt-3"><?=$lang['6']?>:</p>
                                <p class="mt-3">\( z = a(x - x_0) + b(y - y_0) + z_0 \)</p>
                                <p class="mt-3"><?=$lang['7']?> w.r.t (x): \( f'(x) \)</p>
                                <p class="mt-3">\( <?=$diffa?>\)</p>
                                <div class="w-full my-3">
                                    <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['13']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal">
                                    <?=$stepsx?>
                                </div>
                                <p class="mt-3"><?=$lang['7']?> w.r.t (y): \( f'(y) \)</p>
                                <p class="mt-3">\( <?=$diffb?>\)</p>
                                <div class="w-full my-3">
                                    <button type="button" class="calculate repeat1" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['13']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal1">
                                    <?=$stepsy?>
                                </div>
                                <p class="mt-3"><?=$lang['8']?> (a):</p>
                                <p class="mt-3">\( f_x = <?=$diffa?> \)</p>
                                <p class="mt-3">\( f_x(<?=$x?>, <?=$y?>) = <?=$s1?> \)</p>
                                <p class="mt-3">\( f_x(<?=$x?>, <?=$y?>) = <?=$a?> \)</p>
                                <p class="mt-3"><?=$lang['8']?> (b):</p>
                                <p class="mt-3">\( f_y = <?=$diffb?> \)</p>
                                <p class="mt-3">\( f_y(<?=$x?>, <?=$y?>) = <?=$s2?> \)</p>
                                <p class="mt-3">\( f_y(<?=$x?>, <?=$y?>) = <?=$b?> \)</p>
                                <p class="mt-3"><?=$lang['8']?> \( (z_0) \):</p>
                                <p class="mt-3">\( f(x, y) = <?=$eq?> \)</p>
                                <p class="mt-3">\( f(<?=$x?>, <?=$y?>) = <?=$s3?> \)</p>
                                <p class="mt-3">\( f(<?=$x?>, <?=$y?>) = <?=$c?> \)</p>
                                <p class="mt-3">Finally, <?=$lang['8']?> (z):</p>
                                <p class="mt-3">\( x_0 = <?=$x?>, \space y_0 = <?=$y?>, \space z_0 = <?=$c?> \)</p>
                                <p class="mt-3">\( z = a(x - x_0) + b(y - y_0) + z_0 \)</p>
                                <p class="mt-3">\( z = (<?=$a?>)(x - (<?=$x?>)) + (<?=$b?>)(y - (<?=$y?>)) + (<?=$c?>) \)</p>
                                <p class="mt-3">\( z = \color{#1670a7}{<?=$t?>} \)</p>
                            @else
                                @php
                                    $diffc=$detail['diffc'];
                                    $stepsz=$detail['stepsz'];
                                    $ans=$detail['ans'];
                                    $s1=preg_replace('/x/',"($x)",$diffa);
                                    $s1=preg_replace('/y/',"($y)",$s1);
                                    $s1=preg_replace('/z/',"($z)",$s1);
                                    $s2=preg_replace('/x/',"($x)",$diffb);
                                    $s2=preg_replace('/y/',"($y)",$s2);
                                    $s2=preg_replace('/z/',"($z)",$s2);
                                    $s3=preg_replace('/x/',"($x)",$diffc);
                                    $s3=preg_replace('/y/',"($y)",$s3);
                                    $s3=preg_replace('/z/',"($z)",$s3);
                                @endphp
                                <p class="mt-3 text-[18px]">\( z = <?=preg_replace('/frac/','dfrac',$detail['ans'])?> \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?>:</strong></p>
                                <p class="mt-3"><?=$lang['6']?>:</p>
                                <p class="mt-3">\( a(x - x_0) + b(y - y_0) + c(z - z_0) = 0 \)</p>
                                <p class="mt-3"><?=$lang['7']?> w.r.t (x): \( f'(x) \)</p>
                                <p class="mt-3">\( <?=$diffa?>\)</p>
                                <div class="w-full my-3">
                                    <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['13']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal">
                                    <?=$stepsx?>
                                </div>
                                <p class="mt-3"><?=$lang['7']?> w.r.t (y): \( f'(y) \)</p>
                                <p class="mt-3">\( <?=$diffb?>\)</p>
                                <div class="w-full my-3">
                                    <button type="button" class="calculate repeat1" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['13']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal1">
                                    <?=$stepsy?>
                                </div>
                                <p class="mt-3"><?=$lang['7']?> w.r.t (z): \( f'(z) \)</p>
                                <p class="mt-3">\( <?=$diffc?>\)</p>
                                <div class="w-full my-3">
                                    <button type="button" class="calculate repeat2" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['13']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal2">
                                    <?=$stepsz?>
                                </div>
                                <p class="mt-3"><?=$lang['8']?> (a):</p>
                                <p class="mt-3">\( f_x = <?=$diffa?> \)</p>
                                <p class="mt-3">\( f_x(<?=$x?>, <?=$y?>, <?=$z?>) = <?=$s1?> \)</p>
                                <p class="mt-3">\( f_x(<?=$x?>, <?=$y?>, <?=$z?>) = <?=$a?> \)</p>
                                <p class="mt-3"><?=$lang['8']?> (b):</p>
                                <p class="mt-3">\( f_y = <?=$diffb?> \)</p>
                                <p class="mt-3">\( f_y(<?=$x?>, <?=$y?>, <?=$z?>) = <?=$s2?> \)</p>
                                <p class="mt-3">\( f_y(<?=$x?>, <?=$y?>, <?=$z?>) = <?=$b?> \)</p>
                                <p class="mt-3"><?=$lang['8']?> (c):</p>
                                <p class="mt-3">\( f(x, y) = <?=$diffc?> \)</p>
                                <p class="mt-3">\( f(<?=$x?>, <?=$y?>, <?=$z?>) = <?=$s3?> \)</p>
                                <p class="mt-3">\( f(<?=$x?>, <?=$y?>, <?=$z?>) = <?=$c?> \)</p>
                                <p class="mt-3"><?=$lang['9']?>, <?=$lang['8']?> <?=$lang['4']?>:</p>
                                <p class="mt-3">\( x_0 = <?=$x?>, \space y_0 = <?=$y?>, \space z_0 = <?=$z?> \)</p>
                                <p class="mt-3">\( a(x - x_0) + b(y - y_0) + c(z - z_0) = 0 \)</p>
                                <p class="mt-3">\( (<?=$a?>)(x - (<?=$x?>)) + (<?=$b?>)(y - (<?=$y?>)) + (<?=$c?>)(z - (<?=$z?>)) = 0 \)</p>
                                <p class="mt-3">\( <?=$t?> = 0 \)</p>
                                <p class="mt-3"><?=$lang['12']?>:</p>
                                <p class="mt-3">\( z = \color{#ff6d00}{<?=$ans?>} \)</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        @if (isset($detail))
            <script>
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            </script>
        @endif
        @isset($detail)
            <script>
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
            </script>
        @endisset
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'three') {
                        ['#zValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#xValue', '#yValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('col-span-6');
                                element.classList.add('col-span-4');
                            });
                        });
                        document.querySelectorAll('#eq').forEach(function(element) {
                            element.value = 'x^2 + y^2 + z^2 = 30';
                        });
                        document.getElementById('y').value = '-2';
                    } else {
                        ['#zValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        ['#xValue', '#yValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('col-span-6');
                                element.classList.remove('col-span-4');
                            });
                        });
                        document.querySelectorAll('#eq').forEach(function(element) {
                            element.value = 'x^3 - 3xy + y^3';
                        });
                        document.getElementById('y').value = '2';
                    }
                });
            });
        </script>
    @endpush
</form>