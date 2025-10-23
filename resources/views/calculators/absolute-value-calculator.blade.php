<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php 
               $request = request();
               if (!isset($request->options)) {
                   $request->options = "1";
               }
           @endphp
           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'm1' ? 'm2':'m1' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'm2' ? '':'tagsUnit' }}" data-value="m1" id="imperial">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'm2' ? 'tagsUnit':'' }}" data-value="m2" id="metric">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 mt-5">

            <div class="col-span-12 {{ isset($request->type) && $request->type === 'm2' ? 'hidden':'' }}" id="m1Inputs">
                <div class="d-flex align-items-center justify-content-center">
                    <p><strong>| x | =</strong></p>
                    <div class="ps-2">
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="n" id="n" class="input" value="{{ isset($request->n) ? $request->n : '-5' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 row {{ isset($request->type) && $request->type === 'm2' ? '':'hidden' }}" id="m2Inputs">
                <div class="d-flex align-items-center justify-content-center">
                    <div>
                        <div class="w-100 py-2">
                            <input type="text" name="eq" id="eq" class="input" value="{{ isset($request->eq) ? $request->eq : '|3x+1|' }}" aria-label="input" />
                        </div>
                    </div>
                    <p class="px-2"><strong>=</strong></p>
                    <div>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="n1" id="n1" class="input" value="{{ isset($request->n1) ? $request->n1 : '4' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="var" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2">
                        <select id="var" name="var" class="input dtrmn_mtrx_slct">
                            <?php
                              function optnsList($arr1,$arr2,$frst,$var){
                              foreach($arr1 as $index => $name){
                            ?>
                            <option value="<?php echo $name ?>" <?php if(isset($var)){ echo $name === $var ? " selected" : ""; }else{ echo $name === $frst ? " selected" : ""; } ?>><?php echo $arr2[$index] ?></option>
                            <?php
                                }
                              }
                              $name=["x","y","z","u","v","w"];
                                $val=["x","y","z","u","v","w"];
                              optnsList($val,$name,"3",$request->var);
                            ?>
                        </select>
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
                            <?php if($request->type==='m1'){ ?>
                                <div class="col-12 text-center my-2">
                                    <p><strong class="bg-[#ffffff] px-3 py-2 text-[32px] rounded-lg text-blue-500">\( |<?=$request->n?>| = \space <?=$detail['res']?> \)</strong></p>
                                </div>
                              <?php }else{
                                $res1=$detail['res1'];
                                $eq=$detail['eq'];
                                $n1=$detail['n1'];
                                $check1=$detail['check1'];
                                $check11=$detail['check11'];
                                $check2=$detail['check2'];
                                $check22=$detail['check22'];
                              ?>
                                {{-- <p class="mt-2 font-s-18">\( <?=$eq?> = <?=$n1?> \quad : \quad  <?=preg_replace('/frac/','dfrac',$detail['res'])?>, <?=preg_replace('/frac/','dfrac',$res1)?> \)</p> --}}
                                <div class="col-12 text-center my-2">
                                    <p><strong class="bg-sky p-4 font-s-21 rounded-lg text-blue-500">\( <?=$eq?> = <?=$n1?> \quad : \quad  <?=preg_replace('/frac/','dfrac',$detail['res'])?>, <?=preg_replace('/frac/','dfrac',$res1)?> \)</strong></p>
                                </div>
                                <?php if($check1==$check11 && $check2!=$check22){ ?>
                                  <p class="mt-2">\( <?=$var?> = <?=preg_replace('/frac/','dfrac',$detail['res'])?> \) (<?=$lang['5']?>)</p>
                                  <p class="mt-2">\( <?=$var?> = <?=preg_replace('/frac/','dfrac',$res1)?> \) (<?=$lang['6']?>)</p>
                                <?php }elseif($check11!=$check11 && $check2==$check22){ ?>
                                  <p class="mt-2">\( <?=$var?> = <?=preg_replace('/frac/','dfrac',$res1)?> \) (<?=$lang['5']?>)</p>
                                  <p class="mt-2">\( <?=$var?> = <?=preg_replace('/frac/','dfrac',$detail['res'])?> \) (<?=$lang['6']?>)</p>
                                <?php } ?>
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
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'm2') {
                        ['#m1Inputs'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        ['#m2Inputs'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                    } else {
                        ['#m1Inputs'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#m2Inputs'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    }
                });
            });
        </script>
    @endpush
</form>