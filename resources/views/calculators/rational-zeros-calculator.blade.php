<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request();@endphp
            <div class="col-span-12">
                <label for="no_of" class="font-s-14 text-blue"><?= $lang['17'] ?></label>
                <div class="w-100 py-2">
                    <select name="no_of" class="input" id="no_of" aria-label="select">
                        <option value="2">2</option>
                        <option value="3" {{ isset($request->no_of) && $request->no_of == '3' ? 'selected' : '' }}>3</option>
                        <option value="4" {{ isset($request->no_of) && $request->no_of == '4' ? 'selected' : '' }}>4</option>
                        <option value="5" {{ isset($request->no_of) && $request->no_of == '5' ? 'selected' : '' }}>5</option>
                        <option value="6" {{ isset($request->no_of) && $request->no_of == '6' ? 'selected' : '' }}>6</option>
                        <option value="7" {{ isset($request->no_of) && $request->no_of == '7' ? 'selected' : '' }}>7</option>
                        <option value="8" {{ isset($request->no_of) && $request->no_of == '8' ? 'selected' : '' }}>8</option>
                        <option value="9" {{ isset($request->no_of) && $request->no_of == '9' ? 'selected' : '' }}>9</option>
                    </select>
                </div>
            </div>
            <p class="col-span-12 text-center mt-2 text-[14px] p2 {{ isset($request->no_of) && $request->no_of !== '2' ? 'hidden' : '' }}">\( P(x) =   a_{1}{x}^2 \pm a_{2}{x} \pm a_{3} \)</p>
            <p class="col-span-12 text-center mt-2 text-[14px] p3 {{ isset($request->no_of) && $request->no_of == '3' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^3 \pm a_{2}{x}^2 \pm a_{3}{x}\pm a_{4} \) </p>
            <p class="col-span-12 text-center mt-2 text-[14px] p4 {{ isset($request->no_of) && $request->no_of == '4' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^4 \pm a_{2}{x}^3 \pm a_{3}{x}^2 \pm a_{4}{x} \pm a_{5} \)</p>
            <p class="col-span-12 text-center mt-2 text-[14px] p5 {{ isset($request->no_of) && $request->no_of == '5' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^5 \pm a_{2}{x}^4 \pm a_{3}{x}^3 \pm a_{4}{x}^2 \pm a_{5}{x} \pm a_{6} \)</p>
            <p class="col-span-12 text-center mt-2 text-[14px] p6 {{ isset($request->no_of) && $request->no_of == '6' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^6 \pm a_{2}{x}^5 \pm a_{3}{x}^4 \pm a_{4}{x}^3 \pm a_{5}{x}^2 \pm a_{6}{x} \pm a_{7}  \) </p>
            <p class="col-span-12 text-center mt-2 text-[14px] p7 {{ isset($request->no_of) && $request->no_of == '7' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^7 \pm a_{2}{x}^6 \pm a_{3}{x}^5 \pm a_{4}{x}^4 \pm a_{5}{x}^3 \pm a_{6}{x}^2 \pm a_{7}{x} \pm a_{8} \)</p>
            <p class="col-span-12 text-center mt-2 text-[14px] p8 {{ isset($request->no_of) && $request->no_of == '8' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^8 \pm a_{2}{x}^7 \pm a-{3}{x}^6 \pm a_{4}{x}^5 \pm a_{5}{x}^4 \pm a_{6}{x}^3 \pm a_{7}{x}^2 \pm a_{8}{x} \pm a_{9} \) </p>
            <p class="col-span-12 text-center mt-2 text-[14px] p9 {{ isset($request->no_of) && $request->no_of == '9' ? '' : 'hidden' }}">\( P(x) = a_{1}{x}^9 \pm a_{2}{x}^8 \pm a_{3}{x}^7 \pm a_{4}{x}^6 \pm a_{5}{x}^5 \pm a_{6}{x}^4 \pm a_{7}{x}^3 \pm a_{8}{x}^2 \pm a_{9}{x} \pm a_{10} \)</p>
      
            </div>
            <div class="grid grid-cols-3 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-4 mt-0 mt-lg-2 px-2">
                <label for="v1" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">1</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v1" id="v1" class="input" aria-label="input" value="{{ isset($request->v1) ? $request->v1 : '1' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2">
                <label for="v2" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">2</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v2" id="v2" class="input" aria-label="input" value="{{ isset($request->v2) ? $request->v2 : '5' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2">
                <label for="v3" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">3</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v3" id="v3" class="input" aria-label="input" value="{{ isset($request->v3) ? $request->v3 : '6' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '3' ? '' : 'hidden' }} vc4" id="a4">
                <label for="v4" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">4</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v4" id="v4" class="input" aria-label="input" value="{{ isset($request->v4) ? $request->v4 : '4' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '4' ? '' : 'hidden' }} vc5" id="a5">
                <label for="v5" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">5</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v5" id="v5" class="input" aria-label="input" value="{{ isset($request->v5) ? $request->v5 : '5' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '5' ? '' : 'hidden' }} vc6" id="a6">
                <label for="v6" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">6</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v6" id="v6" class="input" aria-label="input" value="{{ isset($request->v6) ? $request->v6 : '6' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '6' ? '' : 'hidden' }} vc7" id="a7">
                <label for="v7" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">7</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v7" id="v7" class="input" aria-label="input" value="{{ isset($request->v7) ? $request->v7 : '7' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '7' ? '' : 'hidden' }} vc8" id="a8">
                <label for="v8" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">8</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v8" id="v8" class="input" aria-label="input" value="{{ isset($request->v8) ? $request->v8 : '8' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '8' ? '' : 'hidden' }} vc9" id="a9">
                <label for="v9" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">9</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v9" id="v9" class="input" aria-label="input" value="{{ isset($request->v9) ? $request->v9 : '9' }}" />
                </div>
            </div>
            <div class="col-4 mt-0 mt-lg-2 px-2 {{ isset($request->no_of) && $request->no_of >= '9' ? '' : 'hidden' }} vc10" id="a10">
                <label for="v10" class="font-s-14 text-blue">a<sub class="font-s-12 text-blue">10</sub>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="v10" id="v10" class="input" aria-label="input" value="{{ isset($request->v10) ? $request->v10 : '10' }}" />
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
                                <p class="mt-3 text-[18px]"><strong><?=$lang[2]?></strong></p>
                                <p class="mt-3"> 
                                    <strong>
                                    \(
                                      <?php 
                                        $indexes = array_keys($detail['final_result'], 0);
                                        $j = 0;
                                       for($i=0; $i < count($detail['main_ans2']); $i++){ 
                                              if (in_array("0", $detail['final_result'])) {
                                                if($detail['final_result'][$i] == 0 ){
                                                  $j++;
                                                  echo $detail['ans'][$i]; 
                                                  if($j <= (count($indexes)-1)){
                                                    echo ",";
                                                  }
                                                }
                                              }else{
                                                echo "No \ Rational \ Roots";
                                                break;
                                              }
                                          }
                                      ?>
                                    \)
                                    </strong>
                                </p>
                                <p class="mt-3 font-s-18"><strong><?=$lang[15]?></strong></p>
                                <p class="mt-3">
                                    <strong>
                                    \( 
                                    <?php 
                      
                                      for($i=0; $i < count($detail['uq']); $i++){
                                        echo $detail['uq'][$i];
                                        if($i < (count($detail['uq'])-1)){
                                          echo ", ";
                                        }
                                      }
                                      ?>
                                    \)
                                    </strong> 
                                </p>
                                <p class="mt-3"><strong><?=$lang[3]?></strong></p>
                                <p class="mt-3"><?=$lang[4]?></p>
                                <p class="mt-3"><?=$lang[5]?> <?=$detail['p']?></p>
                                <p class="mt-3"> <?=$lang[6]?></p>
                                <p class="mt-3">
                                    
                                        \(  
                                            <?php 
                                            for($i=0; $i < count($detail['final_p']); $i++){
                                            echo $detail['final_p'][$i];
                                            if($i < (count($detail['final_p'])-1)){
                                                echo ", ";
                                            }
                                            }
                                            ?>
                                        \)
                                     
                                </p>
                                <p class="mt-3"><?=$lang[7]?> <?=$detail['q']?></p>
                                <p class="mt-3">
                                    
                                        \(  
                                            <?php 
                                            for($i=0; $i < count($detail['final_q']); $i++){
                                                echo $detail['final_q'][$i];
                                                if($i < (count($detail['final_q'])-1)){
                                                    echo ", ";
                                                }
                                            }
                                            ?>
                                        \)
                                     
                                </p>
                                <p class="mt-3"><?=$lang[9]?></p>
                                <p class="mt-3"><?=$lang[10]?> </p>
                                <p class="mt-3">
                                
                                    \(  
                                    <?php 
                
                                        for($i=0; $i < count($detail['main_ans']); $i++){
                                        echo $detail['main_ans'][$i];
                                        if($i < (count($detail['main_ans'])-1)){
                                            echo ", ";
                                        }
                                        }
                                    ?>
                                    \)
                                 
                                </p>
                                <p class="mt-3"><?=$lang[11]?></p>
                                <p class="mt-3"><?=$lang[12]?></p>
                                <p class="col s12 margin_zero center padding_0 font_size16">
                                    
                                        \(  
                                            <?php 
                                                for($i=0; $i < count($detail['uq']); $i++){
                                                echo $detail['uq'][$i];
                                                if($i < (count($detail['uq'])-1)){
                                                    echo ", ";
                                                }
                                                }
                                            ?>
                                        \)
                                     
                                </p>
                                <p class="mt-3"><?=$lang[13]?></p>
                                <?php for($i=0; $i < count($detail['uq']); $i++){ ?>
                                    <p class="mt-3">\(<?=$lang[18]?>  <?=$detail['uq'][$i]?>\)</p>
                                    <p class="mt-3 "><?=$lang[19]?>  <?=$detail['eq'][$i]?></p>
                                    <p class="mt-3 "><?=$detail['result'][$i]?></p>
                                    <p class="mt-3 "><?=$lang[14]?>  \(<?=($detail['final_result'][$i])?>\)</p>
                                <?php }?>
                                <p class="mt-3"><?=$lang[16]?>
                                    
                                    \(
                                        <?php 
                                            $indexes = array_keys($detail['final_result'], 0);
                                            $j = 0;
                                        for($i=0; $i < count($detail['main_ans2']); $i++){ 
                                                if (in_array("0", $detail['final_result'])) {
                                                    if($detail['final_result'][$i] == 0 ){
                                                    $j++;
                                                    echo $detail['ans'][$i]; 
                                                    if($j <= (count($indexes)-1)){
                                                        echo ", ";
                                                    }
                                                    }
                                                }else{
                                                    echo "No \ Rational \ Roots";
                                                    break;
                                                }
                                            }
                                        ?>
                                    \)
                                    
                                </p>
                                <p class="mt-3"><?=$lang[15]?></p>
                                <p class="mt-3">
                                    \( 
                                    <?php 
                      
                                      for($i=0; $i < count($detail['uq']); $i++){
                                        echo $detail['uq'][$i];
                                        if($i < (count($detail['uq'])-1)){
                                          echo ", ";
                                        }
                                      }
                                      ?>
                                      \)
                                </p>
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
            document.getElementById('no_of').addEventListener('change', function() {
                var val = this.value;
                function showElements(selectors) {
                    selectors.forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.style.display = 'block';
                        });
                    });
                }
                function hideElements(selectors) {
                    selectors.forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.style.display = 'none';
                        });
                    });
                }
                hideElements(['.p2', '.p3', '.p4', '.p5', '.p6', '.p7', '.p8', '.p9', '.vc4', '.vc5', '.vc6', '.vc7', '.vc8', '.vc9', '.vc10']);
                if (val === '2') {
                    showElements(['.p2', '.vc1', '.vc2', '.vc3']);
                } else if (val === '3') {
                    showElements(['.p3', '.vc4']);
                } else if (val === '4') {
                    showElements(['.p4', '.vc4', '.vc5']);
                } else if (val === '5') {
                    showElements(['.p5', '.vc4', '.vc5', '.vc6']);
                } else if (val === '6') {
                    showElements(['.p6', '.vc4', '.vc5', '.vc6', '.vc7']);
                } else if (val === '7') {
                    showElements(['.p7', '.vc4', '.vc5', '.vc6', '.vc7', '.vc8']);
                } else if (val === '8') {
                    showElements(['.p8', '.vc4', '.vc5', '.vc6', '.vc8', '.vc9']);
                } else if (val === '9') {
                    showElements(['.p9', '.vc4', '.vc5', '.vc6', '.vc7', '.vc8', '.vc9', '.vc10']);
                }
            });
        </script>
    @endpush
</form>
