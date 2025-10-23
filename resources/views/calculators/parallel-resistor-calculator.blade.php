<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="mode" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="mode" id="mode" class="input">
                        <option value="1" {{ isset($_POST['mode']) && $_POST['mode'] == '1' ? 'selected' : '' }}>
                            {{ $lang[2] }}</option>
                        <option value="2" {{ isset($_POST['mode']) && $_POST['mode'] == '2' ? 'selected' : '' }}>
                            {{ $lang[3] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 hidden miss">
                <label for="missing" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="missing" id="missing" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['missing'])?$_POST['missing']:'500' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="mis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mis_unit_dropdown')">{{ isset($_POST['mis_unit'])?$_POST['mis_unit']:'mΩ' }} ▾</label>
                   <input type="text" name="mis_unit" value="{{ isset($_POST['mis_unit'])?$_POST['mis_unit']:'mΩ' }}" id="mis_unit" class="hidden">
                   <div id="mis_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mis_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mis_unit', 'mΩ')">mΩ</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mis_unit', 'Ω')">Ω</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mis_unit', 'kΩ')">kΩ</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mis_unit', 'MΩ')">MΩ</p>
                   </div>
                </div>
              </div>
            <div class="col-span-12" >
                <div class="grid grid-cols-12 mt-3  gap-4" id="more">
                <div class="col-span-6">
                    <label for="res_val" class="font-s-14 text-blue">{{ $lang['4'] }} 1:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="res_val[]" id="res_val" class="input"
                            aria-label="input" placeholder="50"
                            value="{{ isset($_POST['res_val[]']) ? $_POST['res_val[]'] : '50' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="mis_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="unit[]" id="unit" class="input">
                            <option value="0.001"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '0.001' ? 'selected' : '' }}>mΩ
                            </option>
                            <option value="1"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}>vΩ
                            </option>
                            <option value="1000"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '1000' ? 'selected' : '' }}>kΩ
                            </option>
                            <option value="1000000"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '1000000' ? 'selected' : '' }}>
                                vΩ</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="res_val" class="font-s-14 text-blue">{{ $lang['4'] }} 2:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="res_val[]" id="res_val" class="input"
                            aria-label="input" placeholder="50"
                            value="{{ isset($_POST['res_val[]']) ? $_POST['res_val[]'] : '50' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="mis_unit" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="unit[]" id="unit" class="input">
                            <option value="0.001"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '0.001' ? 'selected' : '' }}>mΩ
                            </option>
                            <option value="1"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}>vΩ
                            </option>
                            <option value="1000"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '1000' ? 'selected' : '' }}>kΩ
                            </option>
                            <option value="1000000"
                                {{ isset($_POST['unit']) && $_POST['unit'] == '1000000' ? 'selected' : '' }}>
                                vΩ</option>
                        </select>
                    </div>
                </div>
                @isset($_POST['res_val'])

                    @for ($i = 2; $i < count($_POST['res_val']); $i++)
                        <div class="col-span-6">
                            <label for="res_val" class="font-s-14 text-blue">{{ $lang['4'] }}
                                {{ $i + 1 }}</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="res_val[]" id="res_val" class="input"
                                    aria-label="input" placeholder="50" value="{{ $_POST['res_val'][$i] }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="mis_unit" class="font-s-14 text-blue">&nbsp;</label>
                            <div class="w-100 py-2 position-relative">
                                <select name="unit[]" id="unit" class="input">
                                    <option value="0.001"
                                        {{ isset($_POST['unit']) && $_POST['unit'] == '0.001' ? 'selected' : '' }}>mΩ
                                    </option>
                                    <option value="1"
                                        {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}>vΩ
                                    </option>
                                    <option value="1000"
                                        {{ isset($_POST['unit']) && $_POST['unit'] == '1000' ? 'selected' : '' }}>kΩ
                                    </option>
                                    <option value="1000000"
                                        {{ isset($_POST['unit']) && $_POST['unit'] == '1000000' ? 'selected' : '' }}>
                                        vΩ</option>
                                </select>
                            </div>
                        </div>
                    @endfor
                @endisset
            </div>
            </div>
            <div class="col-span-12">
                <div class="col-12 text-end mt-3">
                    <button type="button" name="submit" id="btn7"
                        class="px-3 py-2 mx-1 addmore bg-[#2845F5] text-white rounded-lg" ><span>+</span>{{ $lang[6] }}</button>
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
                        <div class="w-full md:w-[40%] lg:w-[40%] mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['answer'], 2) }} ({{ $detail['unit'] }})</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                
                            @if ($detail['mode'] == 1)
                                <p class="mt-2">{{ $lang[8] }}
                                    <strong>{{ round($detail['answer'], 2) . ' ' . $detail['unit'] }}</strong>
                                </p>
                            @elseif($detail['mode'] == 2)
                                @if ($detail['answer'] > 0)
                                    <p class="mt-2">{{ $lang[9] }}
                                        <strong>{{ round($detail['answer'], 2) . ' ' . $detail['unit'] }}</strong>
                                    </p>
                                @elseif ($detail['answer'] == 0)
                                    <p class="mt-2">{{ $lang[10] }}. </p>
                                @else
                                    <p class="mt-2">{{ $lang[11] }} </p>
                                @endif
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
    document.getElementById('mode').addEventListener('change', function() {
        var cal = this.value;
        var missElements = document.querySelectorAll('.miss');
        if (cal == '1') {
            missElements.forEach(function(element) {
                element.classList.add('hidden');
            });
        } else if (cal == '2') {
            missElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
    });

    @if (isset($detail))
        var cal = "{{ $detail['mode'] }}";

        var missElements = document.querySelectorAll('.miss');
        if (cal == '1') {
            missElements.forEach(function(element) {
                element.classList.add('hidden');
            });
        } else if (cal == '2') {
            missElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
    @endif

    @if (isset($detail))

        document.addEventListener('DOMContentLoaded', function() {
            'use strict';

            var x = 0;
            document.getElementById('btn7').addEventListener('click', function() {
                // if(8>x){
                if (28 > x) {
                    var y = x + {{ count($_POST['res_val']) + 1 }};
                    var read = `
                <div class="col-span-6">
                        <label for="res_val" class="font-s-14 text-blue">{{ $lang['4'] }} ${y}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="res_val[]" id="res_val" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['res_val[]']) ? $_POST['res_val[]'] : '50' }}" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="unit" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="unit[]" id="unit" class="input">
                                <option value="0.001"  {{ isset($_POST['unit']) && $_POST['unit'] == '0.001' ? 'selected' : '' }}  >mΩ</option>
                                <option value="1"  {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}  >vΩ</option>
                                <option value="1000"  {{ isset($_POST['unit']) && $_POST['unit'] == '1000' ? 'selected' : '' }}  >kΩ</option>
                                <option value="1000000"  {{ isset($_POST['unit']) && $_POST['unit'] == '1000000' ? 'selected' : '' }}  >vΩ</option>
                            </select>
                        </div>
                    </div>
                    `;
                    document.getElementById('more').insertAdjacentHTML('beforeend', read);
                } else {
                    alert('{{ $lang[12] }}');
                }
                x++;
            });

        });
    @elseif (isset($error))

        document.addEventListener('DOMContentLoaded', function() {
            'use strict';

            var x = 0;
            document.getElementById('btn7').addEventListener('click', function() {
                // if(8>x){
                if (28 > x) {
                    var y = x + {{ count($_POST['res_val']) + 1 }};
                    var read = `
                <div class="col-span-6">
                        <label for="res_val" class="font-s-14 text-blue">{{ $lang['4'] }} ${y}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="res_val[]" id="res_val" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['res_val[]']) ? $_POST['res_val[]'] : '50' }}" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="unit" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="unit[]" id="unit" class="input">
                                <option value="0.001"  {{ isset($_POST['unit']) && $_POST['unit'] == '0.001' ? 'selected' : '' }}  >mΩ</option>
                                <option value="1"  {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}  >vΩ</option>
                                <option value="1000"  {{ isset($_POST['unit']) && $_POST['unit'] == '1000' ? 'selected' : '' }}  >kΩ</option>
                                <option value="1000000"  {{ isset($_POST['unit']) && $_POST['unit'] == '1000000' ? 'selected' : '' }}  >vΩ</option>
                            </select>
                        </div>
                    </div>
                    `;
                    document.getElementById('more').insertAdjacentHTML('beforeend', read);
                } else {
                    alert('{{ $lang[12] }}');
                }
                x++;
            });

        });
    @else

        document.addEventListener('DOMContentLoaded', function() {
            'use strict';

            var x = 0;
            document.getElementById('btn7').addEventListener('click', function() {
                // if(8>x){
                if (28 > x) {
                    var y = x + 3;
                    var read = `
                 <div class="col-span-6">
                    <label for="res_val" class="font-s-14 text-blue">{{ $lang['4'] }} ${y}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="res_val[]" id="res_val" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['res_val[]']) ? $_POST['res_val[]'] : '50' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="unit" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="unit[]" id="unit" class="input">
                            <option value="0.001"  {{ isset($_POST['unit']) && $_POST['unit'] == '0.001' ? 'selected' : '' }}  >mΩ</option>
                            <option value="1"  {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}  >vΩ</option>
                            <option value="1000"  {{ isset($_POST['unit']) && $_POST['unit'] == '1000' ? 'selected' : '' }}  >kΩ</option>
                            <option value="1000000"  {{ isset($_POST['unit']) && $_POST['unit'] == '1000000' ? 'selected' : '' }}  >vΩ</option>
                        </select>
                    </div>
                </div>
                `;
                    document.getElementById('more').insertAdjacentHTML('beforeend', read);
                } else {
                    alert('{{ $lang[12] }}');
                }
                x++;
            });

        });
    @endif
</script>
@endpush

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>