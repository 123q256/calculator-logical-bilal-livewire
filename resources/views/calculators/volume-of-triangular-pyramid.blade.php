<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-span-12">
                    <label for="selection" class="label">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <select name="selection" id="selection" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name=[$lang['2'],$lang['3']];
                                $val = ["1","2"];
                                optionsList($val,$name,isset($_POST['selection'])?$_POST['selection'] : '1');
                            @endphp
                        </select>
                    </div>
                </div>
              

                <div class="col-span-12 tri">
                    <label for="triangle_type" class="label">{{ $lang['4'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="triangle_type" id="triangle_type">
                            <?php
                                $name=[$lang['5'],$lang['6']." (SSS) ",$lang['7']." (SAS) ",$lang['8']." (ASA) "];
                                $val = ["1","2","3","4"];
                                optionsList($val,$name,isset($_POST['triangle_type'])?$_POST['triangle_type'] : '1');
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 base_height">
                    <label for="base_height" class="label"><?=$lang['9']?> (h):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="base_height" id="base_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['base_height']) ? $_POST['base_height'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="base_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('base_height_unit_dropdown')">{{ isset($_POST['base_height_unit'])?$_POST['base_height_unit']:'m' }} ▾</label>
                        <input type="text" name="base_height_unit" value="{{ isset($_POST['base_height_unit'])?$_POST['base_height_unit']:'m' }}" id="base_height_unit" class="hidden">
                        <div id="base_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="base_height_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('base_height_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 pyramid_base_area">
                    <label for="pyramid_base_area" class="label">{{ $lang['10'] }} (A):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pyramid_base_area" id="pyramid_base_area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pyramid_base_area']) ? $_POST['pyramid_base_area'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pyramid_base_area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pyramid_base_area_unit_dropdown')">{{ isset($_POST['pyramid_base_area_unit'])?$_POST['pyramid_base_area_unit']:'m' }} ▾</label>
                        <input type="text" name="pyramid_base_area_unit" value="{{ isset($_POST['pyramid_base_area_unit'])?$_POST['pyramid_base_area_unit']:'m' }}" id="pyramid_base_area_unit" class="hidden">
                        <div id="pyramid_base_area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pyramid_base_area_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('pyramid_base_area_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 base">
                    <label for="base" class="label"><?=$lang['11']?> (b):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="base" id="base" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['base']) ? $_POST['base'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="base_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('base_unit_dropdown')">{{ isset($_POST['base_unit'])?$_POST['base_unit']:'m' }} ▾</label>
                        <input type="text" name="base_unit" value="{{ isset($_POST['base_unit'])?$_POST['base_unit']:'m' }}" id="base_unit" class="hidden">
                        <div id="base_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="base_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('base_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 sidea">
                    <label for="sidea" class="label"><?=$lang['12']?> a:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="sidea" id="sidea" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sidea']) ? $_POST['sidea'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="sidea_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sidea_length_unit_dropdown')">{{ isset($_POST['sidea_length_unit'])?$_POST['sidea_length_unit']:'m' }} ▾</label>
                        <input type="text" name="sidea_length_unit" value="{{ isset($_POST['sidea_length_unit'])?$_POST['sidea_length_unit']:'m' }}" id="sidea_length_unit" class="hidden">
                        <div id="sidea_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sidea_length_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sidea_length_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 sideb">
                    <label for="sideb" class="label"><?=$lang['12']?> b:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="sideb" id="sideb" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sideb']) ? $_POST['sideb'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="sideb_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sideb_length_unit_dropdown')">{{ isset($_POST['sideb_length_unit'])?$_POST['sideb_length_unit']:'m' }} ▾</label>
                        <input type="text" name="sideb_length_unit" value="{{ isset($_POST['sideb_length_unit'])?$_POST['sideb_length_unit']:'m' }}" id="sideb_length_unit" class="hidden">
                        <div id="sideb_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sideb_length_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sideb_length_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 sidec">
                    <label for="sidec" class="label"><?=$lang['12']?> c:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="sidec" id="sidec" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sidec']) ? $_POST['sidec'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="sidec_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sidec_length_unit_dropdown')">{{ isset($_POST['sidec_length_unit'])?$_POST['sidec_length_unit']:'m' }} ▾</label>
                        <input type="text" name="sidec_length_unit" value="{{ isset($_POST['sidec_length_unit'])?$_POST['sidec_length_unit']:'m' }}" id="sidec_length_unit" class="hidden">
                        <div id="sidec_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sidec_length_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sidec_length_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 angle_beta">
                    <label for="angle_beta" class="label"><?=$lang['13']?> β:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_beta" id="angle_beta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_beta']) ? $_POST['angle_beta'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_beta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_beta_unit_dropdown')">{{ isset($_POST['angle_beta_unit'])?$_POST['angle_beta_unit']:'rad' }} ▾</label>
                        <input type="text" name="angle_beta_unit" value="{{ isset($_POST['angle_beta_unit'])?$_POST['angle_beta_unit']:'rad' }}" id="angle_beta_unit" class="hidden">
                        <div id="angle_beta_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_beta_unit">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('angle_beta_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 angle_gamma">
                    <label for="angle_gamma" class="label"><?=$lang['12']?> γ:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_gamma" id="angle_gamma" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_gamma']) ? $_POST['angle_gamma'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_gamma_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_gamma_unit_dropdown')">{{ isset($_POST['angle_gamma_unit'])?$_POST['angle_gamma_unit']:'rad' }} ▾</label>
                        <input type="text" name="angle_gamma_unit" value="{{ isset($_POST['angle_gamma_unit'])?$_POST['angle_gamma_unit']:'rad' }}" id="angle_gamma_unit" class="hidden">
                        <div id="angle_gamma_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_gamma_unit">
                            @foreach (["deg","rad"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('angle_gamma_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 pyramid_height">
                    <label for="pyramid_height" class="label"><?=$lang['14']?> (H):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pyramid_height" id="pyramid_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pyramid_height']) ? $_POST['pyramid_height'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pyramid_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pyramid_height_unit_dropdown')">{{ isset($_POST['pyramid_height_unit'])?$_POST['pyramid_height_unit']:'m' }} ▾</label>
                        <input type="text" name="pyramid_height_unit" value="{{ isset($_POST['pyramid_height_unit'])?$_POST['pyramid_height_unit']:'m' }}" id="pyramid_height_unit" class="hidden">
                        <div id="pyramid_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pyramid_height_unit">
                            @foreach (["mm","cm","m","km","in","ft","yd","mi"] as $item)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('pyramid_height_unit', '{{ $item }}')"> {{ $item }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
               
                
            </div>
            <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                <img src="<?=asset('images/picture1.png')?>" alt="Flow Rate Calculator" width="130" height="130" class="change_img"> 

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
                            <div class="w-full my-2">
                                <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <?php if(!empty($detail['volume'])): ?>
                                    <table class="w-full">
                                        <?php if(!empty($detail['pba'])): ?>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['10']}} :</strong></td>
                                                <td class="border-b py-2"><?=round($detail['pba'],5)?><span class="font-s-14"> (cm<sup>2</sup>)</span></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td width="45%" class="border-b py-2"><strong><?=$lang['15']?> :</strong></td>
                                            <td class="border-b py-2"><strong><?=round($detail['volume'],5)?><span class="font_size22 font-s-14"> (cm<sup>3</sup>)</span> </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2" colspan="2"><strong><?=$lang['16']?></strong></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*1000;?> <span class="font-s-14">cubic millimeters (mm<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.001;?> <span class="font-s-14"> cubic decimeters (dm<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.000001;?> <span class="font-s-14">cubic meters (m<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.000000000000001;?> <span class="font-s-14">cubic kilometers (km<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.061024;?> <span class="font-s-14">cubic inches (in<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.000035315;?> <span class="font-s-14">cubic feet (ft<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']*0.00000130795;?> <span class="font-s-14">cubic  yards (yd<sup>3</sup>)</span></td>
                                        </tr>
                                        <tr>
                                        <td class="border-b py-2"><?=$lang['15']?> :</td>
                                        <td class="border-b py-2"><?=$detail['volume']/4168000000000000;?> <span class="font-s-14">cubic miles (mi<sup>3</sup>)</span></td>
                                        </tr>
                    
                                    </table>
                                <?php endif; ?>
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
        var selection = document.getElementById('selection').value;
        if(selection == 1){
            document.querySelectorAll('.tri').forEach(function(el) {
                el.style.display = 'block';
            });
            document.querySelectorAll('.base, .base_height, .pyramid_height').forEach(function(el) {
                el.style.display = 'block';
            });
            document.querySelectorAll('.sidea, .sideb, .sidec, .angle_gamma, .angle_beta, .pyramid_base_area').forEach(function(el) {
                el.style.display = 'none';
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('selection').addEventListener('change', function() {
                var q = this.value;
                var triangleValue = document.getElementById('triangle_type').value;
                
                if (q === "1") {
                    document.querySelectorAll('.tri').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelector('.change_img').src = "{{asset('images/picture1.png')}}";
                    document.querySelector('.change_img').classList.add('pollard');
                    document.querySelectorAll('.base, .base_height, .pyramid_height').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.sidea, .sideb, .sidec, .angle_gamma, .angle_beta, .pyramid_base_area').forEach(function(el) {
                        el.style.display = 'none';
                    });

                    switch (triangleValue) {
                        case '1':
                            document.querySelector('.change_img').src = "{{asset('images/picture1.png')}}";
                            break;
                        case '2':
                            document.querySelectorAll('.sidea, .sideb, .sidec, .pyramid_height').forEach(function(el) {
                                el.style.display = 'block';
                            });
                            document.querySelectorAll('.angle_gamma, .angle_beta, .pyramid_base_area, .base, .base_height').forEach(function(el) {
                                el.style.display = 'none';
                            });
                            document.querySelector('.change_img').src = "{{asset('images/picture2.png')}}";
                            break;
                        case '3':
                            document.querySelectorAll('.sidea, .sideb, .angle_gamma, .pyramid_height').forEach(function(el) {
                                el.style.display = 'block';
                            });
                            document.querySelectorAll('.sidec, .angle_beta, .pyramid_base_area, .base, .base_height').forEach(function(el) {
                                el.style.display = 'none';
                            });
                            document.querySelector('.change_img').src = "{{asset('images/picture3.png')}}";
                            break;
                        case '4':
                            document.querySelectorAll('.sidea, .angle_beta, .angle_gamma, .pyramid_height').forEach(function(el) {
                                el.style.display = 'block';
                            });
                            document.querySelectorAll('.sidec, .sideb, .pyramid_base_area, .base, .base_height').forEach(function(el) {
                                el.style.display = 'none';
                            });
                            document.querySelector('.change_img').src = "{{asset('images/picture.png')}}";
                            break;
                    }
                } else if (q === "2") {
                    console.log(q);
                    document.querySelectorAll('.pyramid_height, .pyramid_base_area').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.base, .base_height, .angle_gamma, .angle_beta, .sidea, .sideb, .sidec').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.tri').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelector('.change_img').src = "{{asset('images/picture5.png')}}";
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('triangle_type').addEventListener('change', function() {
                var typ = this.value;
                var elementsToShow = [];
                var elementsToHide = [];
                var imgSrc = '';

                if (typ === '1') {
                    elementsToShow = ['.base', '.base_height', '.pyramid_height'];
                    elementsToHide = ['.sidea', '.sideb', '.sidec', '.angle_gamma', '.angle_beta', '.pyramid_base_area'];
                    imgSrc = "{{asset('images/picture1.png')}}";
                } else if (typ === '2') {
                    elementsToShow = ['.sidea', '.sideb', '.sidec', '.pyramid_height'];
                    elementsToHide = ['.angle_gamma', '.angle_beta', '.pyramid_base_area', '.base', '.base_height'];
                    imgSrc = "{{asset('images/picture2.png')}}";
                } else if (typ === '3') {
                    elementsToShow = ['.sidea', '.sideb', '.angle_gamma', '.pyramid_height'];
                    elementsToHide = ['.sidec', '.angle_beta', '.pyramid_base_area', '.base', '.base_height'];
                    imgSrc = "{{asset('images/picture3.png')}}";
                } else if (typ === '4') {
                    elementsToShow = ['.sidea', '.angle_beta', '.angle_gamma', '.pyramid_height'];
                    elementsToHide = ['.sidec', '.sideb', '.pyramid_base_area', '.base', '.base_height'];
                    imgSrc = "{{asset('images/picture4.png')}}";
                }

                // Show elements
                elementsToShow.forEach(function(cls) {
                    document.querySelectorAll(cls).forEach(function(el) {
                        el.style.display = 'block';
                    });
                });

                // Hide elements
                elementsToHide.forEach(function(cls) {
                    document.querySelectorAll(cls).forEach(function(el) {
                        el.style.display = 'none';
                    });
                });

                // Change image source
                document.querySelector('.change_img').setAttribute('src', imgSrc);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.calculate').addEventListener('click', function(e) {
                var betaUnit = document.getElementById('beta_unit').value;
                var gammaUnit = document.getElementById('gamma_unit').value;
                var betaValue = parseFloat(document.getElementById('angle_beta').value);
                var gammaValue = parseFloat(document.getElementById('angle_gamma').value);

                document.getElementById('beta_unit').addEventListener('change', function() {
                    if (betaUnit === 'deg') {
                        betaUnit = 57.3;
                        betaValue *= betaUnit;
                        if (betaValue > 179) {
                            alert('Angles should be between 0 and 180 degrees');
                            return false;
                        }
                    } else {
                        betaUnit = 0.017453;
                        if (betaValue > 179) {
                            alert('Angles should be between 0 and 180 degrees');
                            return false;
                        }
                    }
                });

                document.getElementById('gamma_unit').addEventListener('change', function() {
                    if (gammaUnit === 'deg') {
                        gammaUnit = 57.3;
                        gammaValue *= gammaUnit;
                        if (gammaValue > 179) {
                            alert('Angles should be between 0 and 180 degrees');
                            return false;
                        }
                    } else {
                        gammaUnit = 0.017453;
                        if (gammaValue > 179) {
                            alert('Angles should be between 0 and 180 degrees');
                            return false;
                        }
                    }
                });

                var sum = betaValue + gammaValue;
                if (sum > 179) {
                    alert('The sum of two angles cannot exceed 180 degrees.');
                    return false;
                }
            });
        });

        @if(isset($detail) || isset($error))
                var q = document.getElementById('selection').value;
                var triangleValue = document.getElementById('triangle_type').value;
                
                if (q === "1") {
                    document.querySelectorAll('.tri').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelector('.change_img').src = "{{asset('images/picture1.png')}}";
                    document.querySelector('.change_img').classList.add('pollard');
                    document.querySelectorAll('.base, .base_height, .pyramid_height').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.sidea, .sideb, .sidec, .angle_gamma, .angle_beta, .pyramid_base_area').forEach(function(el) {
                        el.style.display = 'none';
                    });

                    switch (triangleValue) {
                        case '1':
                            document.querySelector('.change_img').src = "{{asset('images/picture1.png')}}";
                            break;
                        case '2':
                            document.querySelectorAll('.sidea, .sideb, .sidec, .pyramid_height').forEach(function(el) {
                                el.style.display = 'block';
                            });
                            document.querySelectorAll('.angle_gamma, .angle_beta, .pyramid_base_area, .base, .base_height').forEach(function(el) {
                                el.style.display = 'none';
                            });
                            document.querySelector('.change_img').src = "{{asset('images/picture2.png')}}";
                            break;
                        case '3':
                            document.querySelectorAll('.sidea, .sideb, .angle_gamma, .pyramid_height').forEach(function(el) {
                                el.style.display = 'block';
                            });
                            document.querySelectorAll('.sidec, .angle_beta, .pyramid_base_area, .base, .base_height').forEach(function(el) {
                                el.style.display = 'none';
                            });
                            document.querySelector('.change_img').src = "{{asset('images/picture3.png')}}";
                            break;
                        case '4':
                            document.querySelectorAll('.sidea, .angle_beta, .angle_gamma, .pyramid_height').forEach(function(el) {
                                el.style.display = 'block';
                            });
                            document.querySelectorAll('.sidec, .sideb, .pyramid_base_area, .base, .base_height').forEach(function(el) {
                                el.style.display = 'none';
                            });
                            document.querySelector('.change_img').src = "{{asset('images/picture.png')}}";
                            break;
                    }
                } else if (q === "2") {
                    console.log(q);
                    document.querySelectorAll('.pyramid_height, .pyramid_base_area').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.base, .base_height, .angle_gamma, .angle_beta, .sidea, .sideb, .sidec').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelectorAll('.tri').forEach(function(el) {
                        el.style.display = 'none';
                    });
                    document.querySelector('.change_img').src = "{{asset('images/picture5.png')}}";
                }
        @endif
   </script>
@endpush