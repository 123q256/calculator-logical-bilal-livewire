<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 text-center">
                <span class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['1'] }}:</span>
                <input type="radio" name="type" id="bedtime" value="basic" checked {{ isset($_POST['type']) && $_POST['type'] === 'basic' ? 'checked' : '' }}>
                <label for="bedtime" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['2'] }}:</label>
                <input type="radio" name="type" id="wkup" value="advance" {{ isset($_POST['type']) && $_POST['type'] === 'advance' ? 'checked' : '' }}>
                <label for="wkup" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="width" class="font-s-14 text-blue one_text">{{$lang['4']}}:</label>
                <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-8">
                        <input type="number" step="any" name="width" id="width" class="input" aria-label="input"  value="{{ isset(request()->width)?request()->width: '15'}}" />
                    </div>
                    <div class="col-span-4">
                        <select name="width_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["cm", "m", "in", "ft", "yd","mi","km","mm"];
                                $val = ["cm", "m", "in", "ft", "yd","mi","km","mm"];
                                optionsList($val,$name,isset(request()->units)?request()->units:'cm');
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="length" class="font-s-14 text-blue one_text">{{$lang['5']}}:</label>
                <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-8">
                        <input type="number" step="any" name="length" id="length" class="input" aria-label="input"  value="{{ isset(request()->length)?request()->length: '12'}}" />
                    </div>
                    <div class="col-span-4">
                        <select name="length_unit" class="input">
                            @php
                                $name = ["cm", "m", "in", "ft", "yd","mi","km","mm"];
                                $val = ["cm", "m", "in", "ft", "yd","mi","km","mm"];
                                optionsList($val,$name,isset(request()->units)?request()->units:'ft');
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="heigth" class="font-s-14 text-blue one_text">{{$lang['6']}}:</label>
                <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-8">
                        <input type="number" step="any" name="heigth" id="heigth" class="input" aria-label="input"  value="{{ isset(request()->heigth)?request()->heigth: '10'}}" />
                    </div>
                    <div class="col-span-4">
                        <select name="heigth_unit" class="input">
                            @php
                                $name = ["cm", "m", "in", "ft", "yd","mi","km","mm"];
                                $val = ["cm", "m", "in", "ft", "yd","mi","km","mm"];
                                optionsList($val,$name,isset(request()->units)?request()->units:'m');
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="quantity" class="font-s-14 text-blue one_text">{{$lang['8']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset(request()->quantity)?request()->quantity: '5'}}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sman1 {{ isset($_POST['type']) && $_POST['type'] === 'advance' ? 'block' : 'hidden' }}">
                <label for="weight" class="font-s-14 text-blue one_text">{{$lang['7']}}:</label>
                <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-8">
                        <input type="number" step="any" name="weight" id="weight" class="input" aria-label="input"  value="{{ isset(request()->weight)?request()->weight: '40'}}" />
                    </div>
                    <div class="col-span-4">
                        <select name="weight_unit" class="input">
                            <option value="ug">ug</option>
                            <option value="mg">mg</option>
                            <option value="g">g</option>
                            <option value="dag">dag</option>
                            <option value="lb">lb</option>
                            <option selected value="kg">kg</option>
                            <option value="t">t</option>
                            <option value="gr">gr</option>
                            <option value="dr">dr</option>
                            <option value="oz">oz</option>
                            <option value="stone">stone</option>
                            <option value="us-ton">US ton</option>
                            <option value="long-ton">Long ton</option>
                            <option value="earths">Earths</option>
                            <option value="me">me</option>
                            <option value="u">u</option>
                            <option value="oz-t">oz t</option>
                        </select>
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
                        @if (request()->type == 'basic')
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['9']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong class="text-blue">{{$detail['cbm']}} <span class="text-[20px]"> m<sup>3</sup></span></strong></p>
                            </div>
                        </div>
                        @else
                            <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['9']}} :</strong></td>
                                        <td class="border-b py-2"><?= $detail['cbm'];?> <span class="font-s-14"> m<sup>3</sup></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['10']}} :</strong></td>
                                        <td class="border-b py-2"><?= $detail['total_cbm'];?> <span class="font-s-14"> m<sup>3</sup></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                        <td class="border-b py-2"><?=$detail['total_weight'];?><span class="font-s-14"> Kg</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?=$lang[12]?> :</strong></td>
                                        <td class="border-b py-2"><?=$detail['total_volumetric_weight'];?><span class="font-s-14"> Kg</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">20 feet Standard Dry Container :</td>
                                        <td class="border-b py-2"><?=$detail['size_20'];?> <span class="font-s-14">Number of Cartons</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">40 feet Standard Dry Container :</td>
                                        <td class="border-b py-2"><?=$detail['size_40'];?> <span class="font-s-14">Number of Cartons</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">40 feet High Cube Dry Container :</td>
                                        <td class="border-b py-2"><?=$detail['size_40_hq'];?> <span class="font-s-14">Number of Cartons</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">45 feet High Cube Dry Container :</td>
                                        <td class="border-b py-2"><?=$detail['size_45_hq'];?> <span class="font-s-14">Number of Cartons</span></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var sman1 = document.querySelector('.sman1');
        document.getElementById('bedtime').addEventListener('click',function(){
            sman1.style.display = "none";
        });
        document.getElementById('wkup').addEventListener('click',function(){
            sman1.style.display = "block";
        }); 
    </script>
@endpush