<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['operations'] = "area";
                }
            @endphp
            <div class="col-span-12">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" id="operations" name="operations">
                        <option value="side" {{ isset($_POST['operations']) && $_POST['operations']==='side'?'selected':'' }}><?=$lang[2]?> P, s, K, h | <?=$lang[3]?> a</option>
                        <option value="perimeter" {{ isset($_POST['operations']) && $_POST['operations']==='perimeter'?'selected':'' }}><?=$lang[2]?> a, s, K, h | <?=$lang[3]?> P</option>
                        <option value="semiperimeter" {{ isset($_POST['operations']) && $_POST['operations']==='semiperimeter'?'selected':'' }}><?=$lang[2]?> a, P, K, h | <?=$lang[3]?> s</option>
                        <option value="area" {{ isset($_POST['operations']) && $_POST['operations']==='area'?'selected':'' }}><?=$lang[2]?> a, P, s, h | <?=$lang[3]?> K</option>
                        <option value="altitude" {{ isset($_POST['operations']) && $_POST['operations']==='altitude'?'selected':'' }}><?=$lang[2]?> a, P, s, K | <?=$lang[3]?> h</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="first" class="font-s-14 text-blue" id="txt">K:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'cm' }} ▾</label>
                    <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'cm' }}" id="unit1" class="hidden">
                    <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mm')">milimeters (mm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'm')">meters (m)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'km')">kilometers (km)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'yd')">yards (yd)</p>
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
                    <div class="w-full bg-light-blue p-3 radius-10 mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[4] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['a'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[5] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['k'], 3)}} {{$detail['unit']}}<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[6] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['p'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['s'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['h'], 3)}} {{$detail['unit']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                if(this.value === "side"){
                    document.getElementById('txt').textContent = 'a:';
                    document.getElementById('first').placeholder = '{{$lang[4]}}';
                }else if(this.value === 'perimeter'){
                    document.getElementById('txt').textContent = 'p:';
                    document.getElementById('first').placeholder = '{{$lang[6]}}';
                }else if(this.value === 'semiperimeter'){
                    document.getElementById('txt').textContent = 's:';
                    document.getElementById('first').placeholder = '{{$lang[7]}}';
                }else if(this.value === 'area'){
                    document.getElementById('txt').textContent = 'K:';
                    document.getElementById('first').placeholder = '{{$lang[5]}}';
                }else if(this.value === 'altitude'){
                    document.getElementById('txt').textContent = 'h:';
                    document.getElementById('first').placeholder = '{{$lang[8]}}';
                }
            });
        </script>
    @endpush
</form>