<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php $request = request(); @endphp
           <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'three' ? 'three':'two' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'three' ? '':'tagsUnit' }}" id="imperial" data-value="two">
                            {{ $lang['1'] }} (x , y)
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'three' ? 'tagsUnit':'' }}" id="metric" data-value="three">
                            {{ $lang['1'] }} (x , y , z)
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="EnterEq" class="font-s-14 text-blue" id="functionText">
                        @if(isset($request->type) && $request->type === "three")
                            {{$lang['2']}} f(x, y, z):
                        @else
                            {{$lang['2']}} f(x, y):
                        @endif
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'x^2+y^3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4':'col-span-6' }}" id="xValue">
                    <label for="x" class="font-s-14 text-blue">x:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($request->x)?$request->x:'1' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="{{ isset($request->type) && $request->type === 'three' ? 'col-span-4':'col-span-6' }}" id="yValue">
                    <label for="y" class="font-s-14 text-blue">y:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="y" id="y" class="input" value="{{ isset($request->y)?$request->y:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-4 {{ isset($request->type) && $request->type === 'three' ? '':'hidden' }}" id="zValue">
                    <label for="z" class="font-s-14 text-blue">z:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="z" id="z" class="input" value="{{ isset($request->z)?$request->z:'2' }}" aria-label="input"/>
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
                            $EnterEq= $request->EnterEq;
                            $x= $request->x;
                            $y= $request->y;
                            $z= $request->z;
                            $type= $request->type;
                        @endphp
                        <div class="w-full">
                            @if($type==='two')
                                <p class="mt-3 text-[18px]">
                                    \( ∇(<?=$detail['enter']?>)|_{(x,y)=(<?=$x.','.$y?>)} = (<?=$detail['x1'].','.$detail['y1']?>) \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial f}{\partial y}\right)\)</p>
                                <p class="mt-3">\(\frac{\partial f}{\partial x} = <?=$detail['difs1']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal">
                                    <?=$detail['steps']?>
                                </div>
                                <p class="mt-3">\(\frac{\partial f}{\partial y} = <?=$detail['difs2']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat1" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal1">
                                    <?=$detail['steps1']?>
                                </div>
                                <p class="mt-3"><?=$lang['6']?></p>
                                <p class="mt-3">\(∇f(<?=$x.','.$y?>) = (<?=$detail['x1'].','.$detail['y1']?>)\)</p>
                                <p class="mt-3">\(∇(<?=$detail['enter']?>)(x,y) = (<?=$detail['difs1'].','.$detail['difs2']?>)\)</p>
                                <p class="mt-3"><?=$lang['3']?></p>
                                <p class="mt-3">\(∇(<?=$detail['enter']?>)|_{(x,y)=(<?=$x.','.$y?>)} = (<?=$detail['x1'].','.$detail['y1']?>)\)</p>
                            @else
                                <p class="mt-3 font-s-18">
                                    \( ∇(<?=$detail['enter']?>)|_{(x,y,z)=(<?=$x.','.$y.','.$z?>)} = (<?=$detail['x1'].','.$detail['y1'].','.$detail['z1']?>) \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial f}{\partial y},\frac{\partial f}{\partial z}\right)\)</p>
                                <p class="mt-3">\(\frac{\partial f}{\partial x} = <?=$detail['difs1']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal">
                                    <?=$detail['steps']?>
                                </div>
                                <p class="mt-3">\(\frac{\partial f}{\partial y} = <?=$detail['difs2']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat1" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal1">
                                    <?=$detail['steps1']?>
                                </div>
                                <p class="mt-3">\(\frac{\partial f}{\partial z} = <?=$detail['difs3']?>\)</p>
                                <div class="w-full mt-3">
                                    <button type="button" class="calculate repeat2" style="font-size: 16px;padding: 10px;cursor: pointer;">{{$lang['5']}}</button>
                                </div>
                                <div class="w-full res_step hidden" id="step_cal2">
                                    <?=$detail['steps2']?>
                                </div>
                                <p class="mt-3"><?=$lang['6']?></p>
                                <p class="mt-3">\(∇f(<?=$x.','.$y.','.$z?>) = (<?=$detail['x1'].','.$detail['y1'].','.$detail['z1']?>)\)</p>
                                <p class="mt-3">\(∇(<?=$detail['enter']?>)(x,y,z) = (<?=$detail['difs1'].','.$detail['difs2'].','.$detail['difs3']?>)\)</p>
                                <p class="mt-3"><?=$lang['3']?></p>
                                <p class="mt-3">\(∇(<?=$detail['enter']?>)|_{(x,y,z)=(<?=$x.','.$y.','.$z?>)} = (<?=$detail['x1'].','.$detail['y1'].','.$detail['z1']?>)\)</p>
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
                        document.querySelectorAll('#EnterEq').forEach(function(element) {
                            element.value = 'x^2+y^3+z^4';
                        });
                        document.querySelectorAll('#functionText').forEach(function(element) {
                            element.textContent = '{{$lang['2']}} f(x, y, z):';
                        });
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
                        document.querySelectorAll('#EnterEq').forEach(function(element) {
                            element.value = 'x^2+y^3';
                        });
                        document.querySelectorAll('#functionText').forEach(function(element) {
                            element.textContent = '{{$lang['2']}} f(x, y)';
                        });
                    }
                });
            });
        </script>
    @endpush
</form>