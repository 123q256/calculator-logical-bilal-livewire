@php
    $category = request()->category;
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">

            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="category" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="category" id="category" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'], $lang['3']];
                                $val = ["log","board"];
                                optionsList($val,$name,isset($_POST['category'])?$_POST['category']:'log');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="woodSelector" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select id="woodSelector" name="woodSelector" class="input">
                            <option value="46@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '46@' ? 'selected' : '' }}><?= $lang['5'] ?></option>
                            <option value="55@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '55@' ? 'selected' : '' }}><?= $lang['6'] ?></option>
                            <option value="47@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '47@' ? 'selected' : '' }}><?= $lang['7'] ?></option>
                            <option value="48@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '48@' ? 'selected' : '' }}><?= $lang['8'] ?></option>
                            <option value="48@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '48@@' ? 'selected' : '' }}><?= $lang['9'] ?></option>
                            <option value="43"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '43' ? 'selected' : '' }}><?= $lang['10'] ?></option>
                            <option value="51@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '51@' ? 'selected' : '' }}><?= $lang['11'] ?></option>
                            <option value="42"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '42' ? 'selected' : '' }}><?= $lang['12'] ?></option>
                            <option value="54@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '54@' ? 'selected' : '' }}><?= $lang['13'] ?></option>
                            <option value="50@@@@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '50@@@@@@' ? 'selected' : '' }}><?= $lang['14'] ?></option>
                            <option value="57"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '57' ? 'selected' : '' }}><?= $lang['15'] ?></option>
                            <option value="46@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '46@@' ? 'selected' : '' }}><?= $lang['16'] ?></option>
                            <option value="45@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '45@' ? 'selected' : '' }}><?= $lang['17'] ?></option>
                            <option value="28"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '28' ? 'selected' : '' }}><?= $lang['18'] ?></option>
                            <option value="45@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '45@@' ? 'selected' : '' }}><?= $lang['19'] ?></option>
                            <option value="55@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '55@@' ? 'selected' : '' }}><?= $lang['20'] ?></option>
                            <option value="50@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '50@' ? 'selected' : '' }}><?= $lang['21'] ?></option>
                            <option value="49@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '49@' ? 'selected' : '' }}><?= $lang['22'] ?></option>
                            <option value="54@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '54@@' ? 'selected' : '' }}><?= $lang['23'] ?></option>
                            <option value="39@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '39@' ? 'selected' : '' }}><?= $lang['24'] ?></option>
                            <option value="29"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '29' ? 'selected' : '' }}><?= $lang['25'] ?></option>
                            <option value="47@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '47@@' ? 'selected' : '' }}><?= $lang['26'] ?></option>
                            <option value="45@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '45@@@' ? 'selected' : '' }}><?= $lang['27'] ?></option>
                            <option value="50@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '50@@' ? 'selected' : '' }}><?= $lang['28'] ?></option>
                            <option value="50@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '50@@@' ? 'selected' : '' }}><?= $lang['29'] ?></option>
                            <option value="49@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '49@@' ? 'selected' : '' }}><?= $lang['30'] ?></option>
                            <option value="41@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '41@' ? 'selected' : '' }}><?= $lang['31'] ?></option>
                            <option value="64@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '64@' ? 'selected' : '' }}><?= $lang['32'] ?></option>
                            <option value="63@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '63@' ? 'selected' : '' }}><?= $lang['33'] ?></option>
                            <option value="41@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '41@@' ? 'selected' : '' }}><?= $lang['34'] ?></option>
                            <option value="51@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '51@@' ? 'selected' : '' }}><?= $lang['35'] ?></option>
                            <option value="58@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '58@' ? 'selected' : '' }}><?= $lang['36'] ?></option>
                            <option value="61@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '61@' ? 'selected' : '' }}><?= $lang['37'] ?></option>
                            <option value="59"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '59' ? 'selected' : '' }}><?= $lang['38'] ?></option>
                            <option value="50@@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '50@@@@' ? 'selected' : '' }}><?= $lang['39'] ?></option>
                            <option value="45@@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '45@@@@' ? 'selected' : '' }}><?= $lang['40'] ?></option>
                            <option value="56"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '56' ? 'selected' : '' }}><?= $lang['41'] ?></option>
                            <option value="62@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '62@' ? 'selected' : '' }}><?= $lang['42'] ?></option>
                            <option value="66"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '66' ? 'selected' : '' }}><?= $lang['43'] ?></option>
                            <option value="52@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '52@' ? 'selected' : '' }}><?= $lang['44'] ?></option>
                            <option value="76"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '76' ? 'selected' : '' }}><?= $lang['45'] ?></option>
                            <option value="64@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '64@@' ? 'selected' : '' }}><?= $lang['46'] ?></option>
                            <option value="63@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '63@@' ? 'selected' : '' }}><?= $lang['47'] ?></option>
                            <option value="63@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '63@@@' ? 'selected' : '' }}><?= $lang['48'] ?></option>
                            <option value="64@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '64@@' ? 'selected' : '' }}><?= $lang['49'] ?></option>
                            <option value="62@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '62@@' ? 'selected' : '' }}><?= $lang['50'] ?></option>
                            <option value="62@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '62@@@' ? 'selected' : '' }}><?= $lang['51'] ?></option>
                            <option value="61@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '61@@' ? 'selected' : '' }}><?= $lang['52'] ?></option>
                            <option value="63@@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '63@@@@' ? 'selected' : '' }}><?= $lang['53'] ?></option>
                            <option value="53"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '53' ? 'selected' : '' }}><?= $lang['54'] ?></option>
                            <option value="39@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '39@@' ? 'selected' : '' }}><?= $lang['55'] ?></option>
                            <option value="55@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '55@@@' ? 'selected' : '' }}><?= $lang['56'] ?></option>
                            <option value="46@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '46@@@' ? 'selected' : '' }}><?= $lang['57'] ?></option>
                            <option value="58@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '58@@' ? 'selected' : '' }}><?= $lang['58'] ?></option>
                            <option value="52@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '52@@' ? 'selected' : '' }}><?= $lang['59'] ?></option>
                            <option value="36"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '36' ? 'selected' : '' }}><?= $lang['60'] ?></option>
                            <option value="38"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '38' ? 'selected' : '' }}><?= $lang['61'] ?></option>
                            <option value="50@@@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '50@@@@@' ? 'selected' : '' }}><?= $lang['62'] ?></option>
                            <option value="44"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '44' ? 'selected' : '' }}><?= $lang['63'] ?></option>
                            <option value="34"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '34' ? 'selected' : '' }}><?= $lang['64'] ?></option>
                            <option value="32@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '32@' ? 'selected' : '' }}><?= $lang['65'] ?></option>
                            <option value="55@@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '55@@@@' ? 'selected' : '' }}><?= $lang['66'] ?></option>
                            <option value="52@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '52@@@' ? 'selected' : '' }}><?= $lang['67'] ?></option>
                            <option value="47@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '47@@@' ? 'selected' : '' }}><?= $lang['68'] ?></option>
                            <option value="58@@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '58@@@' ? 'selected' : '' }}><?= $lang['69'] ?></option>
                            <option value="32@@"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === '32@@' ? 'selected' : '' }}><?= $lang['70'] ?></option>
                            <option value="custom"  {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === 'custom' ? 'selected' : '' }}><?= $lang['71'] ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 denisty {{ isset($_POST['woodSelector']) && $_POST['woodSelector'] === "custom" ? 'd-block' : 'd-none' }}">
                    <label for="custom" class="font-s-14 text-blue ">{{ $lang['87'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="custom" id="custom" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['custom']) ? $_POST['custom'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="custom_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('custom_unit_dropdown')">{{ isset($_POST['custom_unit'])?$_POST['custom_unit']:'kg/m³' }} ▾</label>
                        <input type="text" name="custom_unit" value="{{ isset($_POST['custom_unit'])?$_POST['custom_unit']:'kg/m³' }}" id="custom_unit" class="hidden">
                        <div id="custom_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="custom_unit">
                            @foreach (["kg/m³","lb/ft","lb/yf","g/cm³","kg/cm³","g/m³"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('custom_unit', '{{ $name }}')"> {{ $name }}</p>
                          @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="small_end" class="font-s-14 text-blue smallend">{{ $lang['73'] }} d<sub>s</sub>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="small_end" id="small_end" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['small_end']) ? $_POST['small_end'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="small_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('small_unit_dropdown')">{{ isset($_POST['small_unit'])?$_POST['small_unit']:'in' }} ▾</label>
                        <input type="text" name="small_unit" value="{{ isset($_POST['small_unit'])?$_POST['small_unit']:'in' }}" id="small_unit" class="hidden">
                        <div id="small_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="small_unit">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('small_unit', '{{ $name }}')"> {{ $name }}</p>
                          @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['89'] }} L:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'m' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'m' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            @foreach (["cm","m","in","ft","yd"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                          @endforeach
                        </div>
                     </div>
                </div>
                  
            </div>
            <div class="col-span-6 flex items-center">
                <div>
                    <img src="{{asset('images/wood_log.webp')}}" alt="Wood log" class="max-width mt-5  img1" width="500px" height="150px">
                    <div class="col-12 mt-3 mt-lg-5">
                        <label for="large_end" class="font-s-14 text-blue largeend">{{ $lang['75'] }} d<sub>l</sub>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="large_end" id="large_end" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['large_end']) ? $_POST['large_end'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="large_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('large_unit_dropdown')">{{ isset($_POST['large_unit'])?$_POST['large_unit']:'in' }} ▾</label>
                            <input type="text" name="large_unit" value="{{ isset($_POST['large_unit'])?$_POST['large_unit']:'in' }}" id="large_unit" class="hidden">
                            <div id="large_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="large_unit">
                                @foreach (["cm","m","in","ft","yd","mm"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('large_unit', '{{ $name }}')"> {{ $name }}</p>
                              @endforeach
                            </div>
                         </div>
                    </div>
                    
               </div>
            </div>
                
            <p class="col-span-12"><strong>{{ $lang['76'] }}</strong></p>
            <div class="col-span-6">

                <div class="col-12 mt-0 mt-lg-2">
                    <label for="stack_w" class="font-s-14 text-blue">{{ $lang['77'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="stack_w" id="stack_w" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['stack_w']) ? $_POST['stack_w'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="stackw_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('stackw_unit_dropdown')">{{ isset($_POST['stackw_unit'])?$_POST['stackw_unit']:'in' }} ▾</label>
                        <input type="text" name="stackw_unit" value="{{ isset($_POST['stackw_unit'])?$_POST['stackw_unit']:'in' }}" id="stackw_unit" class="hidden">
                        <div id="stackw_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="stackw_unit">
                            @foreach (["cm", "m", "in", "ft", "yd", "mm"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('stackw_unit', '{{ $name }}')"> {{ $name }}</p>
                          @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="stack_h" class="font-s-14 text-blue">{{ $lang['78'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="stack_h" id="stack_h" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['stack_h']) ? $_POST['stack_h'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="stackh_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('stackh_unit_dropdown')">{{ isset($_POST['stackh_unit'])?$_POST['stackh_unit']:'in' }} ▾</label>
                        <input type="text" name="stackh_unit" value="{{ isset($_POST['stackh_unit'])?$_POST['stackh_unit']:'in' }}" id="stackh_unit" class="hidden">
                        <div id="stackh_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="stackh_unit">
                            @foreach (["cm", "m", "in", "ft", "yd", "mm"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('stackh_unit', '{{ $name }}')"> {{ $name }}</p>
                          @endforeach
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-span-6 flex items-center">
                <img src="{{asset('images/stack_log.webp')}}" alt="Stack log" class="max-width img2" width="500px" height="150px">
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <table class="w-full">
                                @if($category == 'log')
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['79']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{ $detail['dm_of_mid'] }} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['80']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['volume']}} cu ft</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['81']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['weight']}} lb</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['82']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['quantity_stack']}} </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['83']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['weight_stack']}} lb</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['80']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{ $detail['volume'] }}  cu ft
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['84']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['weight']}} lb</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['85']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['quantity_stack']}} </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['86']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$detail['weight_stack']}} lb</td>
                                    </tr>
                                @endif
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
        document.getElementById("category").addEventListener("change", function() {
            var value = this.value;
            var setImg = document.querySelector(".img1");
            var setImg2 = document.querySelector(".img2");
            var small = document.querySelector(".smallend");
            var large = document.querySelector(".largeend");
            if (value === "log") {
                large.innerHTML = "{{$lang['75']}} d<sub>l</sub>:"
                small.innerHTML = "{{$lang['73']}} d<sub>s</sub>:"
                setImg.setAttribute("src", '{{asset("images/wood_log.webp")}}');
                setImg2.setAttribute("src", '{{asset("images/stack_log.webp")}}');
            }else {
                large.innerHTML = "{{$lang['74']}} t:"
                small.innerHTML = "{{$lang['72']}} w:"
                setImg.setAttribute("src", "{{asset('images/wood_board.webp')}}");
                setImg2.setAttribute("src", "{{asset('images/stack_board.webp')}}");
            }
        });
        document.getElementById("woodSelector").addEventListener("change", function() {
            var value = this.value;
            var denisty = document.querySelector(".denisty");
            if (value == 'custom') {
                denisty.classList.add('d-block');
                denisty.classList.remove('d-none');
            }else {
                denisty.classList.add('d-none');
                denisty.classList.remove('d-block');
            }
        });
    </script>
@endpush