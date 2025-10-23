<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
      @if (isset($error))
      <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
     @endif
     <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
          <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php $request = request(); @endphp
            <div class="col-span-12">
                <label for="no" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="no" id="no" class="input" value="{{ isset($request->no)?$request->no:'48765454' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="divisible" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="divisible" id="divisible" class="input" value="{{ isset($request->divisible)?$request->divisible:'3645' }}" aria-label="input"/>
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
                    <style>
                        .result .tableAns tr td{ 
                            border: 1px solid #ddd;
                            padding: 10px 15px 
                        }
                        .bdr_btm{
                            border-bottom: 3px solid #000 !important;
                        }
                        .bdr_top{
                            border-top: 3px solid #000 !important;
                        }
                        .bdr_rht{
                            border-left: 3px solid #000 !important;
                        }
                    </style>
                    <div class="w-full">
                        @php
                            $no = $request->no;
                            $divisible = $request->divisible;
                            $counter1     = $detail['divisible_array'];
                            $counter2     = $detail['number_array'];
                            $counter3     = str_split($detail['division']);
                            $counter4     = $detail['multiply']; //Multiplication Value
                            $counter5     = $detail['read']; //Subtracting Value
                            $counter6     = count($counter4) + count($counter5);
                            $stokes       = $detail['stokes'];
                            $stokes_split = str_split($stokes);
                            $tree_array   = $detail['tree_array'];
                            $p_length     = $detail['p_length'];
                        @endphp
                        <div class="w-full text-[16px] overflow-auto">
                            <p class="mt-2 font-s-20"><strong><?php echo $detail['number'] ?> <span class="black-text"> <?=$lang[4]?>
                                <?php if($detail['modulus'] == 0){?> <?=$lang[5]?> <?php } else{?> <?=$lang[6]?> <?php } ?>
                                <?=$lang[7]?></span> <?php echo $detail['divisible']?></strong></p>
                            <p class="mt-2"><strong>Solution</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] my-3 tableAns">
                                <table style="border-collapse: collapse">
                                    <tr>
                                        <?php
                                          $upper    = $counter1;
                                          $countLen = count($upper);
                                          for ($col = 0; $col < $countLen; $col++) { 
                                              $stokes_split = str_split($stokes);
                                              echo "<td width='20px' height='20px'></td>";
                                          }
                                          for ($col1 = 0; $col1 < count($counter3); $col1++){ 
                                            echo "<td width='20px' height='20px' class='bdr_btm'>".$counter3[$col1]."</td>";
                                          }
                                          for ($col9 = count($counter3); $col9 < count($counter2); $col9++){ 
                                            echo "<td width='20px' height='20px' class='bdr_btm'></td>";
                                          }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                          for ($col2 = 0; $col2 < count($counter1); $col2++) { 
                                            echo "<td width='20px' height='20px'>".$counter1[$col2]."</td>";
                                          }
                                          for ($col3 = 0; $col3 < count($counter2); $col3++) { 
                                            if($col3 == 0){
                                              echo "<td width='20px' height='20px' class='bdr_rht'>".$counter2[$col3]."</td>";
                                            }
                                            else{
                                              echo "<td width='20px' height='20px'>".$counter2[$col3]."</td>";
                                            }
                                          }
                                        ?>
                                    </tr>
                                    <tr>
                                        <?php
                                          $space = 0;
                                          for ($l = 0; $l < count($counter4) ; $l++) { 
                                            $l1       = strlen($counter4[$l]);
                                            $nbrs     = str_split($counter4[$l]);
                                            $l2       = strlen($counter5[$l]);
                                            $nbrs2    = str_split($counter5[$l]);
                                            $upper    = $counter1;
                                            $countLen = count($upper);
                                            $co       = strlen($p_length[$l]);
                                            echo"<tr>";
                                              if($l == 0){
                                                for ($col = 0; $col < ($countLen + $space); $col++) { 
                                                  if($col == ($countLen+$space)-1){
                                                    echo "<td class='center' width='20px' height='20px'>-</td>";
                                                  }  
                                                  else{
                                                    echo "<td width='20px' height='20px'></td>"; 
                                                  } 
                                                }
                                              }
                                              else{
                                                for ($col = 0; $col < ($countLen + $space - 1); $col++) {
                                                  if($col == ($countLen+$space-1)-1){
                                                    echo "<td class='center' width='20px' height='20px'>-</td>";
                                                  }  
                                                  else{
                                                    echo "<td width='20px' height='20px'></td>"; 
                                                  } 
                                                }
                                              }
                
                                              foreach ($nbrs as $key => $value) {
                                                echo "<td width='20px' height='20px' style='border-bottom:3px solid black'>".$value."</td>";
                                              } 
                
                                              if($l == 0){
                                                for ($col = count($nbrs); $col < (count($counter2)-$space); $col++) { 
                                                  echo "<td width='20px' height='20px'></td>";
                                                }
                                              }
                                              else{
                                                for ($col = count($nbrs); $col < (count($counter2)-$space+1); $col++) { 
                                                  echo "<td width='20px' height='20px'></td>";
                                                }
                                              }
                                            echo"</tr>";
                
                                            echo"<tr>";
                                              for ($col = 0; $col < ($countLen + $space); $col++) { 
                                                echo "<td width='20px' height='20px'></td>";
                                              }
                                              
                                              foreach ($nbrs2 as $key2 => $value2) {
                                                echo "<td width='20px' height='20px'>".$value2."</td>";
                                              }
                                              
                                              for ($col3 = count($nbrs2); $col3 < (count($counter2)-$space); $col3++) { 
                                                echo "<td width='20px' height='20px'></td>";
                                              }  
                                            echo"</tr>";
                                            $space = $space + 1;
                                          }
                                        ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
  
    @endisset
</form>