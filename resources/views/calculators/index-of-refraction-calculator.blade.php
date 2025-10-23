<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="selection" id="selection">
                            <option value="1" {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}> {{ $lang[2] }} </option>
                            <option value="2"  {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}> {{ $lang[3] }} </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 mt-3 medium gap-4">
                <div class="col-span-6 medium">
                    <label for="medium_v" class="font-s-14 text-blue" id="m_text">{{ $lang['4'] }} 1:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="medium_v" id="medium_v">
                            <option value="0"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '0' ? 'selected' : '' }}>
                                {{ $lang[5] }} </option>
                            <option value="299792.5"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '299792.5' ? 'selected' : '' }}>
                                {{ $lang[6] }} </option>
                            <option value="299704.6"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '299704.6' ? 'selected' : '' }}>
                                {{ $lang[7] }} </option>
                            <option value="224900.6"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '224900.6' ? 'selected' : '' }}>
                                {{ $lang[8] }} </option>
                            <option value="220435.6"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '220435.6' ? 'selected' : '' }}>
                                {{ $lang[9] }} </option>
                            <option value="228849"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '228849' ? 'selected' : '' }}>
                                {{ $lang[10] }} </option>
                            <option value="201203"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '201203' ? 'selected' : '' }}>
                                {{ $lang[11] }} </option>
                            <option value="197232"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '197232' ? 'selected' : '' }}>
                                {{ $lang[12] }} </option>
                            <option value="123932.4"
                                {{ isset($_POST['medium_v']) && $_POST['medium_v'] == '123932.4' ? 'selected' : '' }}>
                                {{ $lang[13] }} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 custom_m">
                    <label for="medium_value" class="font-s-14 text-blue">{{ $lang['14'] }} (v)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="medium_value" id="medium_value" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['medium_value']) ? $_POST['medium_value'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="medium_value_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('medium_value_unit_dropdown')">{{ isset($_POST['medium_value_unit'])?$_POST['medium_value_unit']:'m/s' }} ▾</label>
                       <input type="text" name="medium_value_unit" value="{{ isset($_POST['medium_value_unit'])?$_POST['medium_value_unit']:'m/s' }}" id="medium_value_unit" class="hidden">
                       <div id="medium_value_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="medium_value_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit', 'mi/s')">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit', 'c')">c</p>
                         
                       </div>
                    </div>
                  </div>
            </div>
            <div class="grid grid-cols-12 mt-3 medium2 hidden gap-4">
                <div class="col-span-6 ">
                    <label for="medium_v2" class="font-s-14 text-blue">{{ $lang['4'] }} 2:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="medium_v2" id="medium_v2">
                            <option value="0"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '0' ? 'selected' : '' }}>
                                {{ $lang[5] }} </option>
                            <option value="299792.5"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '299792.5' ? 'selected' : '' }}>
                                {{ $lang[6] }} </option>
                            <option value="299704.6"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '299704.6' ? 'selected' : '' }}>
                                {{ $lang[7] }} </option>
                            <option value="224900.6"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '224900.6' ? 'selected' : '' }}>
                                {{ $lang[8] }} </option>
                            <option value="220435.6"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '220435.6' ? 'selected' : '' }}>
                                {{ $lang[9] }} </option>
                            <option value="228849"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '228849' ? 'selected' : '' }}>
                                {{ $lang[10] }} </option>
                            <option value="201203"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '201203' ? 'selected' : '' }}>
                                {{ $lang[11] }} </option>
                            <option value="197232"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '197232' ? 'selected' : '' }}>
                                {{ $lang[12] }} </option>
                            <option value="123932.4"
                                {{ isset($_POST['medium_v2']) && $_POST['medium_v2'] == '123932.4' ? 'selected' : '' }}>
                                {{ $lang[13] }} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 custom_m">
                    <label for="medium_value2" class="font-s-14 text-blue">{{ $lang['14'] }} (v<sub>2</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="medium_value2" id="medium_value2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['medium_value2']) ? $_POST['medium_value2'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="medium_value_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('medium_value_unit1_dropdown')">{{ isset($_POST['medium_value_unit1'])?$_POST['medium_value_unit1']:'m/s' }} ▾</label>
                       <input type="text" name="medium_value_unit1" value="{{ isset($_POST['medium_value_unit1'])?$_POST['medium_value_unit1']:'m/s' }}" id="medium_value_unit1" class="hidden">
                       <div id="medium_value_unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="medium_value_unit1">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit1', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit1', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit1', 'mi/s')">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('medium_value_unit1', 'c')">c</p>
                         
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
                    @if (isset($_POST['selection']) && $_POST['selection'] == '1')
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[15] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2  rounded-lg text-white">{{ round($detail['index_of_refrection'], 6) }}</strong></p>
                    </div>
                    @else
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[3] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2  rounded-lg text-white">{{ round($detail['reflective_index'], 6) }}</strong></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
@if(isset($error))
    var selectValue = "{{$_POST['selection']}}";
    var medium1 = document.querySelector('.medium1');
    var medium2 = document.querySelector('.medium2');
    var mediums = document.querySelectorAll('.medium');
    var mText = document.getElementById('m_text');

    if (selectValue == "2") {
        if (medium1) medium1.classList.remove('hidden');
        if (medium2) medium2.classList.remove('hidden');
        mText.textContent = "{{$lang[4]}} 1";
    } else {
        mText.textContent = "{{$lang[4]}}";
        mediums.forEach(function(element) {
            element.classList.remove('hidden');
        });
        if (medium1) medium1.classList.add('hidden');
        if (medium2) medium2.classList.add('hidden');
    }

@endif

@if(isset($detail))
    var selectValue = "{{$_POST['selection']}}";
    var medium1 = document.querySelector('.medium1');
    var medium2 = document.querySelector('.medium2');
    var mediums = document.querySelectorAll('.medium');
    var mText = document.getElementById('m_text');

    if (selectValue == "2") {
        if (medium1) medium1.classList.remove('hidden');
        if (medium2) medium2.classList.remove('hidden');
        mText.textContent = "{{$lang[4]}} 1";
    } else {
        mText.textContent = "{{$lang[4]}}";
        mediums.forEach(function(element) {
            element.classList.remove('hidden');
        });
        if (medium1) medium1.classList.add('hidden');
        if (medium2) medium2.classList.add('hidden');
    }

@endif
document.getElementById('selection').addEventListener('change', function() {
    var selectValue = this.value;
    var medium1 = document.querySelector('.medium1');
    var medium2 = document.querySelector('.medium2');
    var mediums = document.querySelectorAll('.medium');
    var mText = document.getElementById('m_text');

    if (selectValue == "2") {
        if (medium1) medium1.classList.remove('hidden');
        if (medium2) medium2.classList.remove('hidden');
        mText.textContent = "{{$lang[4]}} 1";
    } else {
        mText.textContent = "{{$lang[4]}}";
        mediums.forEach(function(element) {
            element.classList.remove('hidden');
        });
        if (medium1) medium1.classList.add('hidden');
        if (medium2) medium2.classList.add('hidden');
    }
});

  document.querySelectorAll('#medium_v').forEach(function(element) {
    element.addEventListener('change', function() {
        var selectedValue = this.value;
        document.querySelectorAll('.medium_value').forEach(function(mediumValueElement) {
            mediumValueElement.value = selectedValue;
        });
    });
});


document.getElementById('medium_value').addEventListener('click', function() {
    var mediumV = document.getElementById('medium_v');
    mediumV.value = mediumV.querySelector('option:first-child').value;
});


document.getElementById('medium_v2').addEventListener('change', function() {
    var selectedValue2 = this.value;
    document.getElementById('medium_value2').value = selectedValue2;
});


document.getElementById('medium_value2').addEventListener('click', function() {
    var mediumV2 = document.getElementById('medium_v2');
    mediumV2.value = mediumV2.querySelector('option:first-child').value;
});
       
</script>
@endpush

