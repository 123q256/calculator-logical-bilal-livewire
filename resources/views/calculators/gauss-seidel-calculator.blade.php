<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
      @if (isset($error))
      <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
     @endif
     <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
          <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            @php 
                $request = request();
                if(!isset($request->number)) {
                    $request->number = "2";
                }
            @endphp
            <div class="col-span-12 mx-auto mt-0 mt-lg-2 px-2">
                <label for="number" class="font-s-14 text-blue"><?= $lang['1'] ?>:</label>
                <div class="w-full py-2">
                    <select name="number" class="input" id="number" aria-label="select">
                        <option value="1">2</option>
                        <option value="2" {{ isset($request->number) && $request->number == '2' ? 'selected' : '' }}>3</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 flex items-center mt-0 mt-lg-2">
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix0_0" class="input" aria-label="input" value="{{ isset($request->matrix0_0) ? $request->matrix0_0 : '1' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">1</span> <span class="font-s-18 text-blue">+</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix0_1" class="input" aria-label="input" value="{{ isset($request->matrix0_1) ? $request->matrix0_1 : '2' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">2</span> <span class="font-s-18 text-blue">+</span></p>
                <p class="px-2 font-s-14 text-blue thirdInputEqual {{ isset($request->number) && $request->number == '1' ? '' : 'd-none' }}" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">2</span> <span class="font-s-18 text-blue">=</span></p>
                <div class="thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}">
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix0_2" class="input" aria-label="input" value="{{ isset($request->matrix0_2) ? $request->matrix0_2 : '2' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">3</span> <span class="font-s-18 text-blue">=</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($request->value[0]) ? $request->value[0] : '7' }}" />
                    </div>
                </div>
            </div>
            <div class="col-span-12 flex items-center mt-0 mt-lg-2">
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix1_0" class="input" aria-label="input" value="{{ isset($request->matrix1_0) ? $request->matrix1_0 : '8' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">1</span> <span class="font-s-18 text-blue">+</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix1_1" class="input" aria-label="input" value="{{ isset($request->matrix1_1) ? $request->matrix1_1 : '9' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">2</span> <span class="font-s-18 text-blue">+</span></p>
                <p class="px-2 font-s-14 text-blue thirdInputEqual {{ isset($request->number) && $request->number == '1' ? '' : 'd-none' }}" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">2</span> <span class="font-s-18 text-blue">=</span></p>
                <div class="thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}">
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix1_2" class="input" aria-label="input" value="{{ isset($request->matrix1_2) ? $request->matrix1_2 : '9' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">3</span> <span class="font-s-18 text-blue">=</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($request->value[1]) ? $request->value[1] : '7' }}" />
                    </div>
                </div>
            </div>
            <div class="col-span-12 flex items-center mt-0 mt-lg-2 thirdInputs {{ isset($request->number) && $request->number == '1' ? 'd-none' : '' }}">
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix2_0" class="input" aria-label="input" value="{{ isset($request->matrix2_0) ? $request->matrix2_0 : '6' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">1</span> <span class="font-s-18 text-blue">+</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix2_1" class="input" aria-label="input" value="{{ isset($request->matrix2_1) ? $request->matrix2_1 : '5' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">2</span> <span class="font-s-18 text-blue">+</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="matrix2_2" class="input" aria-label="input" value="{{ isset($request->matrix2_2) ? $request->matrix2_2 : '10' }}" />
                    </div>
                </div>
                <p class="px-2 font-s-14 text-blue" style="white-space: nowrap;word-spacing: 8px;">x<sub class="font-s-12 text-blue">3</span> <span class="font-s-18 text-blue">=</span></p>
                <div>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($request->value[2]) ? $request->value[2] : '7' }}" />
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
                      @php
                          $no=$detail['number'];
                          $upper=$detail['upper'];
                          $lower=$detail['lower'];
                          $inverse=$detail['invrse'];
                          $value=$detail['value'];
                          $result=$detail['result'];
                          $result2=$detail['result2'];
                          $main_resultt=$detail['main_result'];
                      @endphp
                      <div class="w-full text-[16px]">
                          <p class="mt-3 text-[18px]"><strong>x=A<sup class="font-s-14">-1</sup>b</strong></p>
                          <p class="mt-3">
                              \(
                                  \begin{bmatrix}
                                  <?php 
                                      for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<1;$l++){  
                                          if($l!=0){
                                          ?>
                                          &
                                          <?php
                                          }
                                          echo round($main_resultt[$k][$l],2);
                                      } ?>
                                      \\ 
                                      <?php
                                  }
                                  ?>
                                  \end{bmatrix}
                              \)
                          </p>
                          <div class="col-lg-4 mt-3">
                              <table class="w-full font-s-16">
                                  @for($k=0;$k<=$no;$k++)
                                      @php $m=$k+1; @endphp
                                      @for($l=0;$l<1;$l++)
                                          <tr>
                                              <td class="py-2 border-b" width="30%"><strong>x <sub class="font-s-14">{{$m}}</sub></strong></td>
                                              <td class="py-2 border-b">{{round($main_resultt[$k][$l],2)}}</td>
                                          </tr>
                                      @endfor
                                  @endfor
                              </table>
                          </div>
                          <p class="mt-3 font-s-18"><strong><?=$lang['3']?> L</strong></p> 
                          <p class="mt-3">
                              \(
                                \begin{bmatrix}<?php 
                                  for($k=0;$k<=$no;$k++){
                                    for($l=0;$l<=$no;$l++){  
                                      if($l!=0){
                                      ?>
                                      &
                                      <?php
                                    }
                                    echo $upper[$k][$l];
                                  } ?>
                                  \\ 
                                  <?php
                                }
                                ?>
                                \end{bmatrix}
                              \)
                          </p>
                          <p class="mt-3 font-s-18"><strong><?=$lang['4']?> L</strong></p> 
                          <p class="mt-3">
                              \(
                                \begin{bmatrix}
                                  <?php 
                                  for($k=0;$k<=$no;$k++){
                                    for($l=0;$l<=$no;$l++){  
                                      if($l!=0){
                                        ?>
                                        &
                                        <?php
                                      }
                                      echo $lower[$k][$l];
                                    } ?>
                                    \\ 
                                  <?php
                                  }
                                  ?>
                                \end{bmatrix}
                              \)
                          </p>
                          <p class="mt-3 font-s-18"><strong><?=$lang['5']?> L<sup class="font-s-14">-1</sup>*</strong></p>  
                          <p class="mt-3">
                              \(
                                \begin{bmatrix}
                                <?php 
                                  for($k=0;$k<=$no;$k++){
                                    for($l=0;$l<=$no;$l++){  
                                      if($l!=0){
                                        ?>
                                        &
                                        <?php
                                      }
                                      echo round($inverse[$k][$l],2);
                                    } ?>
                                    \\ 
                                  <?php
                                  }
                                  ?>
                                \end{bmatrix}
                              \)
                          </p>
                          <p class="mt-3 font-s-18"><strong><?=$lang['6']?> T</strong></p>
                          <p class="mt-3">
                              \(
                                -\begin{bmatrix}
                                <?php 
                                  for($k=0;$k<=$no;$k++){
                                    for($l=0;$l<=$no;$l++){  
                                      if($l!=0){
                                        ?>
                                        &
                                        <?php
                                      }
                                      if($l>1){
                                        ?>
                                        <?php 
                                      }
                                      echo round($inverse[$k][$l],2);
                                    } ?>
                                    \\ 
                                  <?php
                                  }
                                  ?>
                                \end{bmatrix}
                                  \times 
                                  \begin{bmatrix}<?php 
                                    for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<=$no;$l++){  
                                        if($l!=0){
                                          ?>
                                          &
                                          <?php
                                        }
                                        echo $upper[$k][$l];
                                    } ?>
                                    \\ 
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix}=
                                \begin{bmatrix}<?php 
                                    for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<=$no;$l++){  
                                        if($l!=0){
                                          ?>
                                          &
                                          <?php
                                        }
                                        echo round($result[$k][$l],2);
                                    } ?>
                                    \\ 
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix}
                              \)
                            </p>
                            <p class="mt-3 font-s-18"><strong><?=$lang['6']?> C</strong></p>  
                            <p class="mt-3">
                              \(
                                \begin{bmatrix}
                                <?php 
                                  for($k=0;$k<=$no;$k++){
                                    for($l=0;$l<=$no;$l++){  
                                      if($l!=0){
                                        ?>
                                        &
                                        <?php
                                      }
                                      echo round($inverse[$k][$l],2);
                                    } ?>
                                    \\ 
                                  <?php
                                  }
                                  ?>
                                \end{bmatrix}
                                  \times 
                                  \begin{bmatrix} 
                                  <?php 
                                  for($o=0;$o<=$no;$o++){
                                    echo $value[$o];
                                    ?>
                                      \\
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix} =
                                  \begin{bmatrix}<?php 
                                    for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<1;$l++){  
                                        if($l!=0){
                                          ?>
                                          &
                                          <?php
                                        }
                                        echo round($result2[$k][$l],2);
                                    } ?>
                                    \\ 
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix}
                              \)
                              <p class="mt-3 font-s-18"><strong><?=$lang['7']?></strong></p>  
                              <p class="mt-3">
                              <?php
                                for ($i=0; $i <=19 ; $i++) {?>
                                  \(
                                  \times^{(<?php echo $i ?>)}=<?php if($i==0){?>
                                  \begin{bmatrix}<?php 
                                    for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<1;$l++){  
                                        if($l!=0){
                                          ?>
                                          &
                                          <?php
                                        }
                                        echo round($result2[$k][$l],2);
                                    } ?>
                                    \\ 
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix}
                                    <?php }else{ ?>
                                    \begin{bmatrix}
                                      <?php 
                                        for($k=0;$k<=$no;$k++){
                                          for($l=0;$l<=$no;$l++){  
                                            if($l!=0){
                                              ?>
                                              &
                                              <?php
                                            }
                                            echo round($result[$k][$l],2);
                                          } ?>
                                          \\ 
                                        <?php
                                        }
                                        ?>
                                    \end{bmatrix}
                                    \times
                                    <?php if($i==1){ ?>
                                      \begin{bmatrix}<?php 
                                    for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<1;$l++){  
                                        if($l!=0){
                                          ?>
                                          &
                                          <?php
                                        }
                                        echo round($result2[$k][$l],2);
                                    } ?>
                                    \\ 
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix}
                                    <?php }else{ ?>
                                      \begin{bmatrix}
                                  <?php
                                  for ($j=0; $j<count($result);$j++) {
                                    for ($k=0;$k <1;$k++) { 
                                      $result33[$j][$k]=0; 
                                      for($m=0;$m<count($result2);$m++){
                                        if($i==2){
                                          $result33[$j][$k]+=($result[$j][$m]*$result2[$m][$k]);
                                        }else{
                                          $result33[$j][$k]+=($result[$j][$m]*$resulttt[$m][$k]);
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  <?php 
                                    for ($n=0; $n <count($result3) ; $n++) { 
                                        for ($z=0; $z <1 ; $z++) {
                                          $resulttt[$n][$z]=0;
                                            $resulttt[$n][$z]=$result33[$n][$z]+$result2[$n][$z];
                                            echo round($resulttt[$n][$z],3);
                                        }
                                        ?>
                                        \\
                                        <?php
                                    }
                                ?>
                                \end{bmatrix} 
                                    <?php } ?>  
                                      + 
                                    \begin{bmatrix}<?php 
                                    for($k=0;$k<=$no;$k++){
                                      for($l=0;$l<1;$l++){  
                                        if($l!=0){
                                          ?>
                                          &
                                          <?php
                                        }
                                        echo round($result2[$k][$l],2);
                                    } ?>
                                    \\ 
                                    <?php
                                  }
                                  ?>
                                \end{bmatrix}
                                  =
                                  \begin{bmatrix}
                                  <?php
                                  for ($j=0; $j<count($result);$j++) {
                                    for ($k=0;$k <1;$k++) { 
                                      $result3[$j][$k]=0; 
                                      for($m=0;$m<count($result2);$m++){
                                        if($i==1){
                                          $result3[$j][$k]+=($result[$j][$m]*$result2[$m][$k]);
                                        }else{
                                          $result3[$j][$k]+=($result[$j][$m]*$resultt[$m][$k]);
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  <?php 
                                    for ($n=0; $n <count($result3) ; $n++) { 
                                        for ($z=0; $z <1 ; $z++) {
                                          $resultt[$n][$z]=0;
                                            $resultt[$n][$z]=$result3[$n][$z]+$result2[$n][$z];
                                            echo round($resultt[$n][$z],3);
                                        }
                                        ?>
                                        \\
                                        <?php
                                    }
                                ?>
                                \end{bmatrix}
                                
                
                                    <?php };
                                    ?>
                                  \)
                                  <?php
                                }
                                ?>
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
            document.getElementById('number').addEventListener('change', function() {
                var r = this.value;
                if (r === "1"){
                    ['.thirdInputs'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.thirdInputEqual'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if(r === "2"){
                    ['.thirdInputs'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    ['.thirdInputEqual'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
