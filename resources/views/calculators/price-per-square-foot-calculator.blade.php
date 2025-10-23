<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                <div class="col-span-12">
                    <label for="calculate" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                    <div class="w-100 py-2">
                        <select name="calculate" id="calculate" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name=[$lang['2'],$lang['3'],$lang['4']];
                                $val =["1","2","3"];
                                optionsList($val,$name,isset(request()->calculate)?request()->calculate:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="pp" class="font-s-14 text-blue contente">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="pp" id="pp" class="input"   value="{{ isset($_POST['pp'])?$_POST['pp']:'290000' }}" />
                        <span class="text-blue input-unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="area_measure" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area_measure" id="area_measure" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area_measure'])?$_POST['area_measure']:'1400' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_measure_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_measure_unit_dropdown')">{{ isset($_POST['area_measure_unit'])?$_POST['area_measure_unit']:'ft²' }} ▾</label>
                        <input type="text" name="area_measure_unit" value="{{ isset($_POST['area_measure_unit'])?$_POST['area_measure_unit']:'ft²' }}" id="area_measure_unit" class="hidden">
                        <div id="area_measure_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_measure_unit">
                            @foreach (["ft²","m²","in²","yd²"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_measure_unit', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                <p class="col-span-12 mt-2">{{$lang['7']}}</p>
                <div class="col-span-12">
                    <label for="compare" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <select name="compare" id="compare" class="input">
                            @php
                                $name=[$lang['13'],$lang['14']];
                                $val =["1","2"];
                                optionsList($val,$name,isset(request()->compare)?request()->compare:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 saman1 hidden">
                    <label for="pp1" class="font-s-14 text-blue contente">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="pp1" id="pp1" class="input"   value="{{ isset($_POST['pp1'])?$_POST['pp1']:'290000' }}" />
                        <span class="text-blue input-unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 saman1 hidden">
                    <label for="area_measure1" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area_measure1" id="area_measure1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area_measure1'])?$_POST['area_measure1']:'1400' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_measure_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_measure_unit1_dropdown')">{{ isset($_POST['area_measure_unit1'])?$_POST['area_measure_unit1']:'ft²' }} ▾</label>
                        <input type="text" name="area_measure_unit1" value="{{ isset($_POST['area_measure_unit1'])?$_POST['area_measure_unit1']:'ft²' }}" id="area_measure_unit1" class="hidden">
                        <div id="area_measure_unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_measure_unit1">
                            @foreach (["ft²","m²","in²","yd²"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_measure_unit1', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                    </div>
                 </div>
                <p class="mt-2 col-span-12 saman1 hidden">{{$lang['11']}}</p>
                <div class="col-span-12 mt-0 mt-lg-2 saman1 hidden">
                    <label for="compare2" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <select name="compare2" id="compare2" class="input">
                            @php
                                $name=[$lang['13'],$lang['14']];
                                $val =["1","2"];
                                optionsList($val,$name,isset(request()->compare2)?request()->compare2:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 saman2 hidden">
                    <label for="pp2" class="font-s-14 text-blue contente">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="number" step="any" name="pp2" id="pp2" class="input"   value="{{ isset($_POST['pp2'])?$_POST['pp2']:'290000' }}" />
                        <span class="text-blue input-unit">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 saman2 hidden">
                    <label for="area_measure2" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area_measure2" id="area_measure2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area_measure2'])?$_POST['area_measure2']:'1400' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_measure_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_measure_unit2_dropdown')">{{ isset($_POST['area_measure_unit2'])?$_POST['area_measure_unit2']:'ft²' }} ▾</label>
                        <input type="text" name="area_measure_unit2" value="{{ isset($_POST['area_measure_unit2'])?$_POST['area_measure_unit2']:'ft²' }}" id="area_measure_unit2" class="hidden">
                        <div id="area_measure_unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_measure_unit2">
                            @foreach (["ft²","m²","in²","yd²"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('area_measure_unit2', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
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
                    <div class="w-full bg-light-blue result p-3 radius-10 mt-3">
                        <div class="w-full py-2">
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <?php if($detail['calculate']=="1"){?>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong><?=$lang['5']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                            <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res'],2)?></td>
                                        </tr>
                                    </table>
                                    <div class="">
                                        <p class="mt-2 "><?=$lang['15']?>:</p>
                                    </div>
                                    <div class="">
                                        <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><?=$lang['5']?></td>
                                            <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res']*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                        </tr>
                                            <tr>
                                            <td class="border-b py-2"><?=$lang['5']?></td>
                                            <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res']*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                        </tr>
                                            <tr>
                                            <td class="border-b py-2"><?=$lang['5']?></td>
                                            <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res']*9,3)?><span class="font-s-14"> (yd)<sup>2</sup></span></td>
                                        </tr>
                                        </table>
                                    </div>
                                    <?php if(request()->compare=="2"){ ?>
                                        <div class="">
                                            <p class="font-s-20 mt-3"><?=$lang['7']?> : </p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong><?=$lang['5']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res1'],2)?></td>
                                            </tr>
                                        </table>
                                        <div class="">
                                            <p class="mt-2 "><?=$lang['15']?>:</p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><?=$lang['5']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res1']*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['5']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res1']*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['5']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res1']*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                            </tr>
                                        </table>
                                    <?php } ?>
                                    <?php if(request()->compare2=="2"){ ?>
                                        <div class="font-s-20">
                                            <p class="mt-3"><?=$lang['11']?> : </p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong><?=$lang['5']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res2'],2)?></td>
                                            </tr>
                                        </table>
                                        <div class="">
                                            <p class="mt-2"><?=$lang['15']?>:</p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><?=$lang['5']?></td>
                                                <td class="border-b py-2"> <?=$currancy ?> <?=round($detail['res2']*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['5']?></td>
                                                <td class="border-b py-2"> <?=$currancy ?> <?=round($detail['res2']*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['5']?></td>
                                                <td class="border-b py-2"> <?=$currancy ?> <?=round($detail['res2']*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                            </tr>
                                        </table>
                                    <?php } ?>
                                <?php } ?>
                
                                <?php if($detail['calculate']=="2"){ ?>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong><?=$lang['9']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                            <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res'],2)?></td>
                                        </tr>
                                    </table>
                                     <p class="mt-2"><?=$lang['15']?>:</p>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><?=$lang['9']?></td>
                                            <td class="border-b py-2"><?$currancy ?> <?=round($detail['res']*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['9']?></td>
                                            <td class="border-b py-2"><?$currancy ?> <?=round($detail['res']*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['9']?></td>
                                            <td class="border-b py-2"><?$currancy ?> <?=round($detail['res']*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                        </tr>
                                    </table>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong><?=$lang['10']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                            <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res']*12,2)?></td>
                                        </tr>
                                    </table>
                                    <p class="mt-2"><?=$lang['15']?>:</p>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><?=$lang['10']?></td>
                                            <td class="border-b py-2"><?$currancy ?> <?=round(($detail['res']*12)*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['10']?></td>
                                            <td class="border-b py-2"><?$currancy ?> <?=round(($detail['res']*12)*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['10']?></td>
                                            <td class="border-b py-2"><?$currancy ?> <?=round(($detail['res']*12)*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                        </tr>
                                    </table>
                                    <?php if(request()->compare=="2"){ ?>
                                            <p class="font-s-20 mt-2"><?=$lang['7']?> : </p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong><?=$lang['9']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res1'],2)?></td>
                                                </tr>
                                            </table>
                                            <p class="mt-2"><?=$lang['15']?>:</p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><?=$lang['9']?></td>
                                                    <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res1']*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><?=$lang['9']?></td>
                                                    <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res1']*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><?=$lang['9']?></td>
                                                    <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res1']*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                                </tr>
                                            </table>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2"><strong><?=$lang['10']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                    <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res1']*12,2)?></td>
                                                </tr>
                                            </table>
                                            <div class="">
                                                <p class="mt-2"><?=$lang['15']?>:</p>
                                            </div>
                                            <table class="w-full">
                                                <tr>
                                                    <td  width="60%" class="border-b py-2"><?=$lang['10']?></td>
                                                    <td class="border-b py-2"><?=$currancy ?> <?=round(($detail['res1']*12)*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><?=$lang['10']?></td>
                                                    <td class="border-b py-2"><?=$currancy ?> <?=round(($detail['res1']*12)*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><?=$lang['10']?></td>
                                                    <td class="border-b py-2"><?=$currancy ?> <?=round(($detail['res1']*12)*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                                </tr>
                                            </table>
                                    <?php } ?>
                                    <?php if(request()->compare2=="2"){ ?>
                                        <div class="">
                                            <p class="font-s-20 mt-2"><?=$lang['11']?> : </p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong><?=$lang['9']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res2'],2)?></td>
                                            </tr>
                                        </table>
                                        <div class="">
                                            <p class="mt-2 "><?=$lang['15']?>:</p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><?=$lang['9']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res2']*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['9']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round($detail['res2']*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['9']?></td>
                                                <td class="border-b py-2"><?=round($detail['res2']*9,3)?> <?= $currancy ?> <span class="font-s-14">(yd)<sup>2</sup></span></strong></td>
                                            </tr>
                                        </table>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong><?=$lang['10']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?= $currancy ?> <?=round($detail['res2']*12,2)?></td>
                                            </tr>
                                        </table>
                                        <div class="">
                                            <p class="mt-2"><?=$lang['15']?>:</p>
                                        </div>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><?=$lang['10']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round(($detail['res2']*12)*10.7639,3)?> <span class="font-s-14">(m)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['10']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round(($detail['res2']*12)*0.00694444,3)?> <span class="font-s-14">(in)<sup>2</sup></span></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><?=$lang['10']?></td>
                                                <td class="border-b py-2"><?=$currancy ?> <?=round(($detail['res2']*12)*9,3)?> <span class="font-s-14">(yd)<sup>2</sup></span></td>
                                            </tr>
                                        </table>
                                   <?php } ?>
                                <?php }?>
                
                                <?php if($detail['calculate']=="3"){ ?>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong><?=$lang['16']?> <span class="font-s-14"> (ft<sup>2</sup>)</span></strong></td>
                                            <td class="border-b py-2"><?=$currancy?> </span></span> <?=round($detail['res'],2)?></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong><?=$lang['17']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                            <td class="border-b py-2"><?=$currancy?> </span></span> <?=round($detail['res']/12,2)?></td>
                                        </tr>
                                        <?php if(request()->compare=="2"): ?>
                                            <tr>
                                                <td colspan="2" class="pt-2"><?=$lang['7']?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong><?=$lang['16']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?=$currancy ?> </span></span> <?=round($detail['res1'],2)?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong><?=$lang['17']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?=$currancy ?> </span></span> <?=round($detail['res1']/12,2)?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if(request()->compare2=="2"): ?>
                                            <tr>
                                                <td colspan="2" class="pt-2"><?=$lang['11']?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong><?=$lang['16']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?=$currancy ?> </span></span> <?=round($detail['res2'],2)?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong><?=$lang['17']?> <span class="font-s-14">(ft<sup>2</sup>)</span></strong></td>
                                                <td class="border-b py-2"><?=$currancy ?> </span></span> <?=round($detail['res2']/12,2)?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                <?php }?>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>

@push('calculatorJS')
    <script>
        var saman1 = document.querySelectorAll('.saman1');
        var saman2 = document.querySelectorAll('.saman2');
        var contente = document.querySelectorAll('.contente');
        @if(isset($error) || isset($detail))
            var calculate = document.getElementById('calculate').value;
            if(calculate === '1'){
                contente.forEach(element => {
                    element.innerHTML = "<?=$lang['5']?>:";
                });
            }else if(calculate === '2'){
                contente.forEach(element => {
                    element.innerHTML = "<?=$lang['9']?>:";
                });
            }else{
                contente.forEach(element => {
                    element.innerHTML = "<?=$lang['18']?>:";
                });
            }
            var compare = document.getElementById('compare').value;
            if(compare === '1'){
                saman1.forEach(element => {
                    element.style.display="none";
                });
                saman2.forEach(element => {
                    element.style.display="none";
                });
            }else{
                saman1.forEach(element => {
                    element.style.display="block";
                });
                saman2.forEach(element => {
                    element.style.display="none";
                });
            }
            var compare2 = document.getElementById('compare2').value;
            if(compare2 === '1'){
                saman2.forEach(element => {
                    element.style.display="none";
                });
            }else{
                saman2.forEach(element => {
                    element.style.display="block";
                });
            }
        @endif
        document.getElementById('calculate').addEventListener('change',function(){
            var calculate = this.value;
            if(calculate === '1'){
                contente.forEach(element => {
                    element.innerHTML = "<?=$lang['5']?>:";
                });
            }else if(calculate === '2'){
                contente.forEach(element => {
                    element.innerHTML = "<?=$lang['9']?>:";
                });
            }else{
                contente.forEach(element => {
                    element.innerHTML = "<?=$lang['18']?>:";
                });
            }
        });
        document.getElementById('compare').addEventListener('change',function(){
            var compare = this.value;
            if(compare === '1'){
                saman1.forEach(element => {
                    element.style.display="none";
                });
                saman2.forEach(element => {
                    element.style.display="none";
                });
            }else{
                saman1.forEach(element => {
                    element.style.display="block";
                });
                saman2.forEach(element => {
                    element.style.display="none";
                });
            }
        });
        document.getElementById('compare2').addEventListener('change',function(){
            var compare2 = this.value;
            if(compare2 === '1'){
                saman2.forEach(element => {
                    element.style.display="none";
                });
            }else{
                saman2.forEach(element => {
                    element.style.display="block";
                });
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>