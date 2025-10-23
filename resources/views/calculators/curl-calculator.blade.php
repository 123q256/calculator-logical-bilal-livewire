<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php $request = request(); @endphp
                <div class="col-span-12">
                    <p>\(\mathbf{\vec{F}}\left(x,y,z\right)\)</p>
                </div>
                <div class="col-span-4">
                    <label for="xeq" class="font-s-14 text-blue">x:</label>
                    <div class="w-full py-2">
                        <input type="text" name="xeq" id="xeq" class="input" aria-label="input" value="{{ isset($request->xeq)?$request->xeq:'cos(x)' }}" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="yeq" class="font-s-14 text-blue">y:</label>
                    <div class="w-full py-2">
                        <input type="text" name="yeq" id="yeq" class="input" aria-label="input" value="{{ isset($request->yeq)?$request->yeq:'sin(xyz)' }}" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="zeq" class="font-s-14 text-blue">z:</label>
                    <div class="w-full py-2">
                        <input type="text" name="zeq" id="zeq" class="input" aria-label="input" value="{{ isset($request->zeq)?$request->zeq:'(6x + 4)' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <p>\(\left(x_{0}, y_{0}, z_{0}\right)\) (<?=$lang['1']?>)</p>
                </div>
                <div class="col-span-4">
                    <label for="x" class="font-s-14 text-blue">\(x_{0}\):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x" id="x" class="input" aria-label="input" value="{{ isset($request->x)?$request->x:'' }}" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="y" class="font-s-14 text-blue">\(y_{0}\):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y" id="y" class="input" aria-label="input" value="{{ isset($request->y)?$request->y:'' }}" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="z" class="font-s-14 text-blue">\(z_{0}\):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="z" id="z" class="input" aria-label="input" value="{{ isset($request->z)?$request->z:'' }}" />
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
                    @php
                        $xeq= $request->xeq;
                        $yeq= $request->yeq;
                        $zeq= $request->zeq;
                        $x= $request->x;
                        $y= $request->y;
                        $z= $request->z;
                    @endphp
                    <div class="w-full text-[16px]">
                        <?php if(isset($detail['ev1'])){ ?>
                            <p class="mt-3 font-s-18"><strong>\( \left(<?=$detail['ev1']?>,<?=$detail['ev2']?>,<?=$detail['ev3']?>\right) \)</strong></p>
                        <?php }else{ ?>
                            <p class="mt-3 font-s-18"><strong>\( \left(<?=$detail['ans1']?>,<?=$detail['ans2']?>,<?=$detail['ans3']?>\right) \)</strong></p>
                        <?php } ?>
                        <p class="mt-3"><strong><?=$lang['3']?></strong></p>
                        <p class="mt-3"><?=$lang['4']?>:</p>
                        <p class="mt-3"><?=$lang['calculate']?> \(\operatorname{<?=$lang['5']?>}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)}\) 
                            <?php if(isset($detail['ev1'])){ ?>
                                <?=$lang['6']?> \((x_0,y_0,z_0) = \left(<?=$x?>,<?=$y?>,<?=$z?>\right)\)
                            <?php } ?>
                        </p>
                        <p class="mt-3"><?=$lang['7']?>, \(\operatorname{<?=$lang['5']?>}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \nabla\times \left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)\), </p>
                        <p class="mt-3">or, equivalently, \(\operatorname{<?=$lang['5']?>}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \left|\begin{array}{ccc}\mathbf{\vec{i}} & \mathbf{\vec{j}} & \mathbf{\vec{k}}\\\frac{\partial}{\partial x} & \frac{\partial}{\partial y} & \frac{\partial}{\partial z}\\ <?=$detail['enx']?> & <?=$detail['eny']?> & <?=$detail['enz']?>\end{array}\right|.\)</p>
                        <p class="mt-3">Thus, \(\operatorname{<?=$lang['5']?>}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \left(\frac{\partial}{\partial y} \left(<?=$detail['enz']?>\right) - \frac{\partial}{\partial z} \left(<?=$detail['eny']?>\right), \frac{\partial}{\partial z} \left(<?=$detail['enx']?>\right) - \frac{\partial}{\partial x} \left(<?=$detail['enz']?>\right), \frac{\partial}{\partial x} \left(<?=$detail['eny']?>\right) - \frac{\partial}{\partial y} \left(<?=$detail['enx']?>\right)\right).\)</p>
                        <p class="mt-3"><?=$lang['8']?>:</p>
                        <p class="mt-3">\(\frac{\partial}{\partial y} \left(<?=$detail['enz']?>\right) = <?=$detail['one']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial z} \left(<?=$detail['eny']?>\right) = <?=$detail['two']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial z} \left(<?=$detail['enx']?>\right) = <?=$detail['three']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial x} \left(<?=$detail['enz']?>\right) = <?=$detail['four']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial x} \left(<?=$detail['eny']?>\right) = <?=$detail['five']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial y} \left(<?=$detail['enx']?>\right) = <?=$detail['six']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3"><?=$lang['11']?>:</p>
                        <p class="mt-3">\(\operatorname{<?=$lang['5']?>}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \left(<?=$detail['ans1']?>,<?=$detail['ans2']?>,<?=$detail['ans3']?>\right)\)</p>
                        <?php if(isset($detail['ev1'])){ ?>
                            <p class="mt-3"><?=$lang['12']?>:</p>
                            <p class="mt-3">\(\operatorname{<?=$lang['5']?>}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)}|_{(x_0,y_0,z_0) = \left(<?=$x?>,<?=$y?>,<?=$z?>\right)} = \left(<?=$detail['ev1']?>,<?=$detail['ev2']?>,<?=$detail['ev3']?>\right)\)</p>
                        <?php } ?>
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
    @endpush
</form>