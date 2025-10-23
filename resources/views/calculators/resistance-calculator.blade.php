<style>
    .input-field .fas{right: 33px;font-size: 16px;}
    #converter,#t3,.hide_third,.hide_temp{
      display: none;
    }
    #f_op table tr td{
      padding: 5px;
    }
    #f_op table tr{
      border-bottom: none;
    }
    .b_text{
      color: #000;
      border: 1px solid #ccc;
      /*padding: 5px;*/
    }
    .w_text{
      color: #fff;
      border: 1px solid #ccc;
      /*padding: 5px;*/
    }
    .black{
      background-color: #000;
    }
    .brown{
      background-color: #964b00;
    }
    .red{
      background-color: #ff0000;
    }
    .orange{
      background-color: #ffa500;
    }
    .yellow{
      background-color: #ffff00;
    }
    .green{
      background-color: #9acd32;
    }
    .blue{
      background-color: #6495ed;
    }
    .violet{
      background-color: #9400d3;
    }
    .grey{
      background-color: #a0a0a0;
    }
    .white{
      background-color: #fff;
    }
    .gold{
      background-color: #cfb53b;
    }
    .silver{
      background-color: #c0c0c0;
    }
    .over_flow{
      overflow: auto;
    }
    .main_div{
      position: relative;
    }
    .color_div{
      display: inline-block;
      position: absolute;
      width: 15px;
    } 
    .color1{
      left: 109px;
      top: 0;
      /*width: 15px;*/
      height: 101px;
      /*background-color: red;*/
    }
    .color2{
      /*position: absolute;*/
      top: 10px;
      left: 160px;
      /*width: 15px;*/
      height: 82px;
      /*background-color: green;*/
    }
    .color3{
      /*position: absolute;*/
      top: 10px;
      left: 196px;
      /*width: 15px;*/
      height: 82px;
      /*background-color: yellow;*/
    }
    .color4{
      /*position: absolute;*/
      top: 10px;
      left: 230px;
      /*width: 15px;*/
      height: 82px;
      /*background-color: blue;*/
    }
    .color5{
      /*position: absolute;*/
      top: 10px;
      left: 312px;
      /*width: 15px;*/
      height: 82px;
      /*background-color: brown;*/
    }
    .color6{
      /*position: absolute;*/
      top: 10px;
      left: 370px;
      /*width: 15px;*/
      height: 100px;
      /*background-color: pink;*/
    }
    .div_center{
      width: 60%;
      margin: 0px auto;
      position: relative;
    }
    @media (max-width: 610px){
      .div_center{
        width: 100%;
      }
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-2">

        <div class="col-span-12 mx-auto">
            <label for="operations" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
            <div class="w-100 py-2"> 
                <select name="operations" id="operations" class="input">
                    @php
                        function optionsList($arr1,$arr2,$unit){
                        foreach($arr1 as $index => $name){
                    @endphp
                        <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                            {{ $arr2[$index] }}
                        </option>
                    @php
                        }}
                        $name = [$lang['2'],$lang['3'],$lang['4']];
                        $val = ['1','2','3'];
                        optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']: '1');
                    @endphp
                </select>
            </div>
        </div>
        <div class="col-span-12 {{ isset(request()->operations) && request()->operations !== '1' ? "hidden" : "" }}" id="f_op">
            <div class="w-full">
                <label for="band" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                <div class="w-100 py-2"> 
                    <select name="band" id="band" class="input">
                        @php
                            $name = ["3 ".$lang['6'],"4 ".$lang['6'],"5 ".$lang['6'],"6 ".$lang['6']];
                            $val = ['3','4','5','6'];
                            optionsList($val,$name,isset($_POST['band'])?$_POST['band']: "4");
                        @endphp
                    </select>
                </div>
            </div>
            <div class="w-full overflow-auto">
                <table>
                <!-- <table class="highlight striped"> -->
                <tr>
                    <td colspan="5"><p class="font_size20 color_blue padding_left_only"><strong>1<sup>st</sup> <?=$lang[7]?>:</strong></p></td>
                </tr>
                <tr >
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="first" value="black" type="radio">
                        <span><font class="black w_text">black</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="brown" type="radio">
                        <span><font class="brown w_text">brown</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="red" type="radio">
                        <span><font class="red w_text">red</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="orange" type="radio">
                        <span><font class="orange b_text">orange</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="yellow" type="radio" checked>
                        <span><font class="yellow b_text">yellow</font></span>
                    </label>
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="first" value="green" type="radio">
                        <span><font class="green b_text">green</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="blue" type="radio">
                        <span><font class="blue b_text">blue</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="violet" type="radio">
                        <span><font class="violet w_text">violet</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="grey" type="radio">
                        <span><font class="grey b_text">grey</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="first" value="white" type="radio">
                        <span><font class="white b_text">white</font></span>
                    </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><p class="font_size20 color_blue padding_left_only"><strong>2<sup>nd</sup> <?=$lang[7]?>:</strong></p></td>
                </tr>
                <tr>
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="second" value="black" type="radio">
                        <span><font class="black w_text">black</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="brown" type="radio">
                        <span><font class="brown w_text">brown</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="red" type="radio" checked>
                        <span><font class="red w_text">red</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="orange" type="radio">
                        <span><font class="orange b_text">orange</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="yellow" type="radio">
                        <span><font class="yellow b_text">yellow</font></span>
                    </label>
                    </td>
                </tr>
                <tr>
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="second" value="green" type="radio">
                        <span><font class="green b_text">green</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="blue" type="radio">
                        <span><font class="blue b_text">blue</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="violet" type="radio">
                        <span><font class="violet w_text">violet</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="grey" type="radio">
                        <span><font class="grey b_text">grey</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="second" value="white" type="radio">
                        <span><font class="white b_text">white</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_third">
                    <td colspan="5"><p class="font_size20 color_blue padding_left_only"><strong>3<sup>rd</sup> <?=$lang[7]?>:</strong></p></td>
                </tr>
                <tr class=" hide_third">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="third" value="black" type="radio">
                        <span><font class="black w_text">black</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="brown" type="radio">
                        <span><font class="brown w_text">brown</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="red" type="radio">
                        <span><font class="red w_text">red</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="orange" type="radio">
                        <span><font class="orange b_text">orange</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="yellow" type="radio">
                        <span><font class="yellow b_text">yellow</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_third">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="third" value="green" type="radio">
                        <span><font class="green b_text">green</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="blue" type="radio" checked>
                        <span><font class="blue b_text">blue</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="violet" type="radio">
                        <span><font class="violet w_text">violet</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="grey" type="radio">
                        <span><font class="grey b_text">grey</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="third" value="white" type="radio">
                        <span><font class="white b_text">white</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_mul">
                    <td colspan="5"><p class="font_size20 color_blue padding_left_only"><strong><?=$lang[8]?>:</strong></p></td>
                </tr>
                <tr class=" hide_mul">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="multi" value="black" type="radio">
                        <span><font class="black w_text">black</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="brown" type="radio">
                        <span><font class="brown w_text">brown</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="red" type="radio">
                        <span><font class="red w_text">red</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="orange" type="radio">
                        <span><font class="orange b_text">orange</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="yellow" type="radio">
                        <span><font class="yellow b_text">yellow</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_mul">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="multi" value="green" type="radio">
                        <span><font class="green b_text">green</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="blue" type="radio">
                        <span><font class="blue b_text">blue</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="violet" type="radio" checked>
                        <span><font class="violet w_text">violet</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="grey" type="radio">
                        <span><font class="grey b_text">grey</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="white" type="radio">
                        <span><font class="white b_text">white</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_mul">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="multi" value="gold" type="radio">
                        <span><font class="gold b_text">gold</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="multi" value="silver" type="radio">
                        <span><font class="silver b_text">silver</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_tol">
                    <td colspan="5"><p class="font_size20 color_blue padding_left_only"><strong><?=$lang[9]?>:</strong></p></td>
                </tr>
                <tr class=" hide_tol">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="tolerance" value="brown" type="radio">
                        <span><font class="brown w_text">brown</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="red" type="radio">
                        <span><font class="red w_text">red</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="orange" type="radio" checked>
                        <span><font class="orange b_text">orange</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="yellow" type="radio">
                        <span><font class="yellow b_text">yellow</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="green" type="radio">
                        <span><font class="green b_text">green</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_tol">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="tolerance" value="blue" type="radio">
                        <span><font class="blue b_text">blue</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="violet" type="radio">
                        <span><font class="violet w_text">violet</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="grey" type="radio">
                        <span><font class="grey b_text">grey</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="gold" type="radio">
                        <span><font class="gold b_text">gold</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="tolerance" value="silver" type="radio">
                        <span><font class="silver b_text">silver</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_temp">
                    <td colspan="5"><p class="font_size20 color_blue padding_left_only"><strong><?=$lang[10]?>:</strong></p></td>
                </tr>
                <tr class=" hide_temp">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="temp" value="black" type="radio">
                        <span><font class="black w_text">black</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="brown" type="radio">
                        <span><font class="brown w_text">brown</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="red" type="radio">
                        <span><font class="red w_text">red</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="orange" type="radio">
                        <span><font class="orange b_text">orange</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="yellow" type="radio">
                        <span><font class="yellow b_text">yellow</font></span>
                    </label>
                    </td>
                </tr>
                <tr class=" hide_temp">
                    <td class="py-2">
                    <label>
                        <input class="with-gap" name="temp" value="green" type="radio" checked>
                        <span><font class="green b_text">green</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="blue" type="radio">
                        <span><font class="blue b_text">blue</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="violet" type="radio">
                        <span><font class="violet w_text">violet</font></span>
                    </label>
                    </td>
                    <td>
                    <label>
                        <input class="with-gap" name="temp" value="grey" type="radio">
                        <span><font class="grey b_text">grey</font></span>
                    </label>
                    </td>
                </tr>
                </table>
            </div>
        </div>
        <div class="col-span-12 {{ isset(request()->operations) && request()->operations === '2' ? "block" : "hidden" }}" id="s_op">
            <p class="font-s-16 text-blue"><?=$lang[11]?>:</p>
            <div class="py-2">
            <textarea aria-label="textarea input" id="textarea" placeholder="12, 23, 45" name="x"class="textareaInput"><?=((isset($_POST['x']))?$_POST['x']:'12,32,12,4,55,12,13,5')?></textarea>
            </div>
        </div>
        <div class=" col-span-12 {{ isset(request()->operations) && request()->operations === '3' ? "" : "hidden" }}" id="l_op">
          
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <p class="text-blue font-s-14" id="lb_1"><?=$lang[12]?>:</p>
                    <div id="f1" class="grid grid-cols-12 mt-3  gap-2">
                        <div class="col-span-6">
                            <input type="number" step="any" name="length" value="<?=isset($_POST['length'])?$_POST['length']:'100'?>" class="input">
                        </div>
                        <div class="col-span-6">
                            <select class="input" name="l_unit">
                            <option value="ft">ft</option>
                            <option value="yd">yd</option>
                            <option value="in">in</option>
                            <option value="mile">mile</option>
                            <option value="m" selected>m</option>
                            <option value="km">km</option>
                            <option value="cm">cm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="s2" class="col-span-6">
                    <p class="text-blue font-s-14" id="lb_2"><?=$lang[13]?>:</p>
                    <div class="grid grid-cols-12 mt-3  gap-2">
                        <div class="col-span-6 pe-2">
                        <input type="number" step="any" name="diameter" value="<?=isset($_POST['diameter'])?$_POST['diameter']:'0.05'?>" class="input">
                        </div>
                        <div class="col-span-6">
                            <select class="input" name="d_unit">
                                <option value="ft">ft</option>
                                <option value="yd">yd</option>
                                <option value="in">in</option>
                                <option value="mile">mile</option>
                                <option value="m">m</option>
                                <option value="km">km</option>
                                <option value="cm" selected>cm</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 mt-3  gap-2">
                <div class="col-span-6">
                   <p class="text-blue font-s-14 pb-2"><?=$lang[14]?>:</p>
                    <select class="input" name="material" id="material">
                        <option value="63000000"><?=$lang[15]?></option>
                        <option value="59600000"><?=$lang[16]?></option>
                        <option value="58000000" selected><?=$lang[17]?></option>
                        <option value="45200000"><?=$lang[18]?></option>
                        <option value="37800000"><?=$lang[19]?></option>
                    </select>
                </div>
                <div class="col-span-6">
                    <label for="conductivity" class="text-blue font-s-14"><?=$lang[20]?>:</p>
                    <div class="relative py-2">
                        <input type="number" class="input" step="any" name="conductivity" value="<?=isset($_POST['conductivity'])?$_POST['conductivity']:'58000000'?>" id="conductivity">
                        <i class="text-blue input_unit">S/m</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12">
            <p class="my-2">
            <span class="font_size18"><?=$lang[21]?>:</span>
            <span><a href="<?=asset('ohms-law-calculator/')?>/" target="_blank" rel="noopener">Ohms Law Calculator</a></span>,
            <span><a href="<?=asset('parallel-resistor-calculator/')?>/" target="_blank" rel="noopener">Parallel Resistor Calculator</a></span>
            </p>
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
                            $calc = request()->calc;
                            $appli=request()->appli;
                            $r_type=request()->r_type;
                        @endphp
                        <div class="w-full text-center">
                            <?php
                            $operations = request()->operations;
                            $band = request()->band;
                            $first = request()->first;
                            $second = request()->second;
                            $third = request()->third;
                            $multi = request()->multi;
                            $tolerance = request()->tolerance;
                            $temp = request()->temp;
                            $x = request()->x;
                            $length = request()->length;
                            $l_unit = request()->l_unit;
                            $diameter = request()->diameter;
                            $d_unit = request()->d_unit;
                        if ($operations == "1") {
                          ?>
                          <div class="col-12 text-center">
                            <div class="div_center overflow-auto">
                              <img src="<?=asset('images/Resistor.svg')?>" id="im" alt="Resistor Image" width="500px" height="300px">
                              <div class="color_div color1 <?=$first?>"></div>
                              <div class="color_div color2 <?=$second?>"></div>
                              <?php
                              if ($band == "5" || $band == "6") {
                                ?>
                                  <div class="color_div color4 <?=$third?>"></div>
                                <?php
                              }
                              ?>
                              <div class="color_div color3 <?=$multi?>"></div>                  
                              <?php
                              if ($band == "5" || $band == "4" || $band == "6") {
                                ?>
                                  <div class="color_div color5 <?=$tolerance?>"></div>
                                <?php
                              }
                              if ($band == "6") {
                                ?>
                                  <div class="color_div color6 <?=$temp?>"></div>
                                <?php
                              }
                              ?>
                            </div>
                        </div>
                            <p class="text-[25px] bg-w-auto bg-sku px-3 py-2  d-inline-block my-3"><strong class="text-blue"><?= $detail['answer'] ?></strong></p>
                
                          <?php
                        }else if ($operations == "2"){
                          ?>
                            <div class="text-center">
                                <p class="font-s-20"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center ">
                                <p class="text-[25px] bg-w-auto bg-[#2845F5] rounded-lg text-white px-3 py-2  d-inline-block my-3"><strong class="text-blue"><?= $detail['answer'] ?></strong></p>
                            </div>
                        </div>
                          <?php
                        }else if ($operations == "3") {
                          ?>
                            <div class="text-center">
                                <p class="font-s-20"><strong>{{$lang['24']}}</strong></p>
                                <div class="flex justify-center ">
                                <p class="text-[25px] bg-w-auto bg-[#2845F5] rounded-lg text-white px-3 py-2  d-inline-block my-3"><strong class="text-blue"><?= $detail['answer'] ?> ohm (Ω)</strong></p>
                            </div>
                        </div>
                          <?php
                        }
                        ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('operations').addEventListener('change', function() {
            var cal = this.value;
            var f_op = document.getElementById('f_op');
            var s_op = document.getElementById('s_op');
            var l_op = document.getElementById('l_op');

            if (cal === '1') {
                f_op.classList.add('row');
                f_op.classList.remove('hidden');
                s_op.classList.add('hidden');
                s_op.classList.remove('row');
                l_op.classList.add('hidden');
                l_op.classList.remove('row');
            } else if (cal === '2') {
                s_op.classList.add('row');
                s_op.classList.remove('hidden');
                f_op.classList.add('hidden');
                f_op.classList.remove('row');
                l_op.classList.add('hidden');
                l_op.classList.remove('row');
            } else if (cal === '3') {
                l_op.classList.add('row');
                l_op.classList.remove('hidden');
                f_op.classList.add('hidden');
                f_op.classList.remove('row');
                s_op.classList.add('hidden');
                s_op.classList.remove('row');
            }
        });

        document.getElementById('material').addEventListener('change', function() {
            var v2 = this.value;
            document.getElementById('conductivity').value = v2;
        });

        document.getElementById('band').addEventListener('change', function() {
            var cal = this.value;
            if (cal === '3') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'none';
                document.querySelector('.hide_tol').style.display = 'none';
                document.querySelector('.hide_third').style.display = 'none';
            } else if (cal === '4') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_tol').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'none';
                document.querySelector('.hide_third').style.display = 'none';
            } else if (cal === '5') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_tol').style.display = 'block';
                document.querySelector('.hide_third').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'none';
            } else if (cal === '6') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_tol').style.display = 'block';
                document.querySelector('.hide_third').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'block';
            }
        });
        @if(isset($detail) || isset($error))
            var cal =  document.getElementById('band').value;
            if (cal === '3') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'none';
                document.querySelector('.hide_tol').style.display = 'none';
                document.querySelector('.hide_third').style.display = 'none';
            } else if (cal === '4') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_tol').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'none';
                document.querySelector('.hide_third').style.display = 'none';
            } else if (cal === '5') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_tol').style.display = 'block';
                document.querySelector('.hide_third').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'none';
            } else if (cal === '6') {
                document.querySelector('.hide_mul').style.display = 'block';
                document.querySelector('.hide_tol').style.display = 'block';
                document.querySelector('.hide_third').style.display = 'block';
                document.querySelector('.hide_temp').style.display = 'block';
            }
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>