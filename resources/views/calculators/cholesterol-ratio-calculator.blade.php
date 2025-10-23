<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
      @if (isset($error))
      <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
     @endif
     <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
          <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

              <div class="col-span-12">
                  <p><strong class="text-blue">{{ $lang['1'] }} : </strong><strong>{{ $lang['2'] }}.</strong></p>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="tc" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="tc" id="tc" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tc']) ? $_POST['tc'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="tc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tc_unit_dropdown')">{{ isset($_POST['tc_unit'])?$_POST['tc_unit']:'mg/dL' }} ▾</label>
                    <input type="text" name="tc_unit" value="{{ isset($_POST['tc_unit'])?$_POST['tc_unit']:'mg/dL' }}" id="tc_unit" class="hidden">
                    <div id="tc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tc_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tc_unit', 'mg/dL')">milligrams per deciliter (mg/dL)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tc_unit', 'mmol/L')">millimoles per liter (mmol/L)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
              <label for="hc" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
              <div class="relative w-full mt-[7px]">
                  <input type="number" name="hc" id="hc" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hc']) ? $_POST['hc'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                  <label for="hc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hc_unit_dropdown')">{{ isset($_POST['hc_unit'])?$_POST['hc_unit']:'mg/dL' }} ▾</label>
                  <input type="text" name="hc_unit" value="{{ isset($_POST['hc_unit'])?$_POST['hc_unit']:'mg/dL' }}" id="hc_unit" class="hidden">
                  <div id="hc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hc_unit">
                      <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hc_unit', 'mg/dL')">milligrams per deciliter (mg/dL)</p>
                      <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hc_unit', 'mmol/L')">millimoles per liter (mmol/L)</p>
                  </div>
               </div>
          </div>
           
          <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="lc" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
            <div class="relative w-full mt-[7px]">
                <input type="number" name="lc" id="lc" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['lc']) ? $_POST['lc'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                <label for="lc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('lc_unit_dropdown')">{{ isset($_POST['lc_unit'])?$_POST['lc_unit']:'mg/dL' }} ▾</label>
                <input type="text" name="lc_unit" value="{{ isset($_POST['lc_unit'])?$_POST['lc_unit']:'mg/dL' }}" id="lc_unit" class="hidden">
                <div id="lc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="lc_unit">
                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('lc_unit', 'mg/dL')">milligrams per deciliter (mg/dL)</p>
                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('lc_unit', 'mmol/L')">millimoles per liter (mmol/L)</p>
                </div>
             </div>
           </div>
           <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="tr" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
            <div class="relative w-full mt-[7px]">
                <input type="number" name="tr" id="tr" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tr']) ? $_POST['tr'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                <label for="tr_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tr_unit_dropdown')">{{ isset($_POST['tr_unit'])?$_POST['tr_unit']:'mg/dL' }} ▾</label>
                <input type="text" name="tr_unit" value="{{ isset($_POST['tr_unit'])?$_POST['tr_unit']:'mg/dL' }}" id="tr_unit" class="hidden">
                <div id="tr_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tr_unit">
                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tr_unit', 'mg/dL')">milligrams per deciliter (mg/dL)</p>
                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tr_unit', 'mmol/L')">millimoles per liter (mmol/L)</p>
                </div>
             </div>
           </div>
          
              <div class="col-span-12 md:col-span-6 lg:col-span-6">
                  <label for="gender" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                  <div class="w-100 py-2 position-relative">
                      <select name="gender" id="gender" class="input">
                          @php
                              function optionsList($arr1,$arr2,$unit){
                              foreach($arr1 as $index => $name){
                          @endphp
                              <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                  {{ $arr2[$index] }}
                              </option>
                          @php
                              }}
                              $name = [$lang['8'],$lang['9']];
                              $val = ["male","female"];
                              optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'male');
                          @endphp
                      </select>
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
                      $ans1=$detail['ans1'];
                      $ans2=$detail['ans2'];
                      $ans3=$detail['ans3'];
                      $ans4=$detail['ans4'];
                      $ans5=$detail['ans5'];
                      $ans6=$detail['ans6'];
                      if($detail['gender']=="male"){
                        if($ans1<3.4){
                          $line1=$lang['21'];
                        }else if($ans1>=3.4 && $ans1<=4.4){
                          $line1=$lang['22'];
                        }else if($ans1>=4.5 && $ans1<=7.2){
                          $line1=$lang['23'];
                        }else if($ans1>=7.3 && $ans1<=16.5){
                          $line1=$lang['24'];
                        }else if($ans1>16.6){
                          $line1=$lang['25'];
                        }
                        if($ans2<1.1 && $ans2>0){
                          $line2=$lang['21'];
                        }else if($ans2>=1.1 && $ans2<=4.9){
                          $line2=$lang['23'];
                        }else if($ans2>=5 && $ans2<=7.1){
                          $line2=$lang['24'];
                        }else if($ans2>7.2){
                          $line2=$lang['25'];
                        }else if($ans2<0){
                          $line2="";
                        }
                      }else if($detail['gender']=="female"){
                         if($ans1<3.3){
                          $line1=$lang['21'];
                        }else if($ans1>=3.3 && $ans1<=4.1){
                          $line1=$lang['22'];
                        }else if($ans1>=4.2 && $ans1<=5.7){
                          $line1=$lang['23'];
                        }else if($ans1>=5.8 && $ans1<=9){
                          $line1=$lang['24'];
                        }else if($ans1>9.1){
                          $line1=$lang['25'];
                        }
                        if($ans2<1.5 && $ans1>0){
                          $line2=$lang['21'];
                        }else if($ans2>=1.6 && $ans2<=4.1){
                          $line2=$lang['23'];
                        }else if($ans2>=4.2 && $ans2<=5.5){
                          $line2=$lang['24'];
                        }else if($ans2>5.6){
                          $line2=$lang['25'];
                        }else if($ans<0){
                          $line2="";
                        }
                      }
                      if($ans3<200 && $ans3>0){
                        $line3=$lang['26'];
                      }else if($ans3>=200 && $ans3<=239){
                         $line3=$lang['27'];
                      }else if($ans3>=240){
                         $line3=$lang['28'];
                      }else if($ans<0){
                        $line3="";
                      }
                       if($ans4>60){
                        $line4=$lang['26'];
                      }else if($ans4>=40 && $ans4<=60){
                         $line4=$lang['27'];
                      }else if($ans4<40 && $ans4>0){
                         $line4=$lang['28'];
                      }else if($ans4<0){
                        $line4=" ";
                      }
                      if($ans5<100 && $ans5>0){
                        $line5=$lang['26'];
                      }else if($ans5>=100 && $ans5<=129){
                         $line5=$lang['29'];
                      }else if($ans5>=130 && $ans5<=159){
                         $line5=$lang['27'];
                      }else if($ans5>=160 && $ans5<=189){
                         $line5=$lang['28'];
                      }else if($ans5>=190){
                        $line5=$lang['30'];
                      }else if($ans5<0){
                        $line5="";
                      }
                       if($ans6<130 && $ans6>0){
                        $line6=$lang['26'];
                      }else if($ans6>=130 && $ans6<=149){
                         $line6=$lang['29'];
                      }else if($ans6>=150 && $ans6<=199){
                         $line6=$lang['27'];
                      }else if($ans6>=200){
                         $line6=$lang['28'];
                      }else{
                         $line6="";
                      }
                    @endphp
                    <div class="col s12">
                       <p class="text-[18px]"><strong class="text-[#2845F5]">{{ $lang['10'] }}:</strong></p>
                    </div>
                    <p class="col s12 kevin"><span class="text-[#2845F5] me-1">■</span><strong> {{ $lang['11'] }} </strong> = <strong class="text-[#119154] text-[20px]">{{ round($detail['ans1'],2) }}</strong> – {{ $lang['12'] }} <strong>{{ $line1  }}</strong> {{ $lang['13'] }}.</p>
                    <p class="col s12 kevin margin_top_10"><span class="text-[#2845F5] me-1">■</span><strong >  {{ $lang['14'] }}</strong> = <strong class="text-[#119154] text-[20px]">{{ round($detail['ans2'],2) }}</strong> – {{ $lang['12'] }} <strong>{{ $line2  }}</strong> {{ $lang['13'] }}.</p>
                    <p class="col s12 kevin margin_top_10"><span class="text-[#2845F5] me-1">■</span> {{ $lang['15'] }} <strong> {{ $lang['3'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{ $detail['ans3'] }}</strong> (mg/dl) {{ $lang['17'] }} <strong> {{ $line3;  }}.</strong></p>
                    <p class="col s12 kevin margin_top_10"><span class="text-[#2845F5] me-1">■</span> {{ $lang['15'] }} <strong> {{ $lang['18'] }}</strong> {{ $lang['16'] }}  <strong class="text-[#119154] text-[20px]">{{ $detail['ans4'] }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line4;  }}.</strong></p>
                    <p class="col s12 kevin margin_top_10"><span class="text-[#2845F5] me-1">■</span> {{ $lang['15'] }} <strong> {{ $lang['19'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{ $detail['ans5'] }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line5  }}</strong>.</p>
                    <p class="col s12 kevin margin_top_10"><span class="text-[#2845F5] me-1">■</span> {{ $lang['15'] }} <strong> {{ $lang['20'] }}</strong> {{ $lang['16'] }} <strong class="text-[#119154] text-[20px]">{{  $detail['ans6']  }}</strong> (mg/dl) {{ $lang['17'] }} <strong>{{ $line6  }}</strong>.</p>
                </div>
            </div>


          </div>
      </div>
  </div>
  
    @endisset
</form>