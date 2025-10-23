<style>
img{
    object-fit: none;
}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <div class="col-12">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
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
                                    $name = [$lang[2]." (n=3)",$lang[3]." (n=4)",$lang[4]." (n=5)",$lang[5]." (n=6)",$lang[6]." (n=7)",$lang[7]." (n=8)",$lang[8]." (n=9)",$lang[9]." (n=10)",$lang[10]." (n=11)",$lang[11]," (n=12)",$lang[12]." (n=13)",$lang[13]." (n=14)",$lang[14]." (n > 14)"];
                                    $val = [3,4,5,6,7,8,9,10,11,12,13,14,15];
                                    optionsList($val,$name,isset($_POST['operations'])?$_POST['operations'] : 5);
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-12 hidden" id="ep">
                        <label for="npolygon" class="font-s-14 text-blue"><?=$lang[15]?> n:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="npolygon" id="npolygon" class="input" aria-label="input" value="{{ isset($_POST['npolygon'])?$_POST['npolygon']:'' }}" />
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="calculation" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <select class="input" name="calculation" id="calculation">
                                <?php
                                    $name = [$lang[17]." a:",$lang[18]." r:",$lang[19]." R:",$lang[20]." A:",$lang[21]." P:"];
                                    $val = ['01','02','03','04','05'];
                                    optionsList($val,$name,isset($_POST['calculation'])?$_POST['calculation'] : '01');
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="labl" class="font-s-14 text-blue" id="lb">{{ $lang['17'] }} a:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="labl" id="labl" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['labl']) ? $_POST['labl'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units_dropdown')">{{ isset($_POST['units'])?$_POST['units']:'m' }} ▾</label>
                            <input type="text" name="units" value="{{ isset($_POST['units'])?$_POST['units']:'m' }}" id="units" class="hidden">
                            <div id="units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'mm')">millimetre  (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                  
                    <div class="col-12">
                        <label for="pie" class="font-s-14 text-blue">Pi π:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="pie" id="pie" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['pie'])?$_POST['pie']:'3.1415926535898' }}" />
                        </div>
                    </div>
                </div>
                <div class="col-span-6 flex items-center ps-lg-3 justify-center">
                    <img src="<?=asset('images/pentagon.svg?v=0')?>" id="im" alt="Polygon Calculator" width="100" height="100">
                    
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
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[22]?> (n) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['nvalue']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[17]?> (a) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['side_a'].' '.$detail['unit']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[18]?> (r) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['inradius'].' '.$detail['unit']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[19]?> (R) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['circumradius'].' '.$detail['unit']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[20]?> (A) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['area'].' '.$detail['unit']?><sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[21]?> (P) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['perimeter'].' '.$detail['unit']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[23]?> (x) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['interior'].'°'?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[24]?> (y) :</strong></td>
                                        <td class="border-b py-2"><?=$detail['extrior'].'°'?></td>
                                    </tr>
                                </table>
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
    document.addEventListener('DOMContentLoaded', function() {
        var operations = document.getElementById('operations');
        var ep = document.getElementById('ep');
        var im = document.getElementById('im');

        operations.addEventListener('change', function() {
            var cal = this.value;
            var imagePath = '';

            ep.style.display = 'none';

            switch(cal) {
                case '3':
                    imagePath = '<?=asset("images/trigon.svg")?>';
                    break;
                case '4':
                    imagePath = '<?=asset("images/tetragon.svg")?>';
                    break;
                case '5':
                    imagePath = '<?=asset("images/pentagon.svg?v=0")?>';
                    break;
                case '6':
                    imagePath = '<?=asset("images/hexagon.svg")?>';
                    break;
                case '7':
                    imagePath = '<?=asset("images/heptagon.svg")?>';
                    break;
                case '8':
                    imagePath = '<?=asset("images/octagon.svg")?>';
                    break;
                case '9':
                    imagePath = '<?=asset("images/nonagon.svg")?>';
                    break;
                case '10':
                    imagePath = '<?=asset("images/decagon.svg")?>';
                    break;
                case '11':
                    imagePath = '<?=asset("images/undecagon.svg")?>';
                    break;
                case '12':
                    imagePath = '<?=asset("images/dodecagon.svg")?>';
                    break;
                case '13':
                    imagePath = '<?=asset("images/tridecagon.svg")?>';
                    break;
                case '14':
                    imagePath = '<?=asset("images/tetradecagon.svg")?>';
                    break;
                case '15':
                    ep.style.display = 'block';
                    imagePath = '<?=asset("images/polygonn.svg")?>';
                    break;
            }

            im.src = imagePath;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var calculation = document.getElementById('calculation');
        var lb = document.getElementById('lb');

        calculation.addEventListener('change', function() {
            var a = this.value;
            var labelText = "";

            switch(a) {
                case '01':
                    labelText = "Side Length a:";
                    break;
                case '02':
                    labelText = "Inradius r:";
                    break;
                case '03':
                    labelText = "Circumradius R:";
                    break;
                case '04':
                    labelText = "Area A:";
                    break;
                case '05':
                    labelText = "Perimeter P:";
                    break;
            }

            lb.textContent = labelText;
        });
    });

    @if(isset($detail) || isset($error))
        document.addEventListener('DOMContentLoaded', function() {
            var operations = document.getElementById('operations');
            var ep = document.getElementById('ep');
            var im = document.getElementById('im');
            var cal = operations.value;
            var imagePath = '';
            ep.style.display = 'none';

            switch(cal) {
                case '3':
                    imagePath = '<?=asset("images/trigon.svg")?>';
                    break;
                case '4':
                    imagePath = '<?=asset("images/tetragon.svg")?>';
                    break;
                case '5':
                    imagePath = '<?=asset("images/pentagon.svg?v=0")?>';
                    break;
                case '6':
                    imagePath = '<?=asset("images/hexagon.svg")?>';
                    break;
                case '7':
                    imagePath = '<?=asset("images/heptagon.svg")?>';
                    break;
                case '8':
                    imagePath = '<?=asset("images/octagon.svg")?>';
                    break;
                case '9':
                    imagePath = '<?=asset("images/nonagon.svg")?>';
                    break;
                case '10':
                    imagePath = '<?=asset("images/decagon.svg")?>';
                    break;
                case '11':
                    imagePath = '<?=asset("images/undecagon.svg")?>';
                    break;
                case '12':
                    imagePath = '<?=asset("images/dodecagon.svg")?>';
                    break;
                case '13':
                    imagePath = '<?=asset("images/tridecagon.svg")?>';
                    break;
                case '14':
                    imagePath = '<?=asset("images/tetradecagon.svg")?>';
                    break;
                case '15':
                    ep.style.display = 'block';
                    imagePath = '<?=asset("images/polygonn.svg")?>';
                    break;
            }

            im.src = imagePath;
        });
        document.addEventListener('DOMContentLoaded', function() {
            var calculation = document.getElementById('calculation');
            var lb = document.getElementById('lb');
            var a = calculation.value;
            var labelText = "";

            switch(a) {
                case '01':
                    labelText = "Side Length a:";
                    break;
                case '02':
                    labelText = "Inradius r:";
                    break;
                case '03':
                    labelText = "Circumradius R:";
                    break;
                case '04':
                    labelText = "Area A:";
                    break;
                case '05':
                    labelText = "Perimeter P:";
                    break;
            }

            lb.textContent = labelText;
        });
    @endif

</script>
@endpush