<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="to_cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select class="input" name="to_cal" id="to_cal">
                        <option value="1" {{ isset($_POST['to_cal']) && $_POST['to_cal'] == '1' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="2" {{ isset($_POST['to_cal']) && $_POST['to_cal'] == '2' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                        <option value="3" {{ isset($_POST['to_cal']) && $_POST['to_cal'] == '3' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                    </select>
                </div>
                <div class="space-y-2 temp">
                    <label for="temp" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="temp" id="temp" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp'])?$_POST['temp']:'25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_unit_dropdown')">{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }} ▾</label>
                        <input type="text" name="temp_unit" value="{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }}" id="temp_unit" class="hidden">
                        <div id="temp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', 'K')">K</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="hum" class="font-s-14 text-blue">{{ $lang['3'] }}(%):</label>
                    <input type="number" step="any" name="hum" id="hum" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['hum'])?$_POST['hum']:'50' }}" />
                </div>
                <div class="space-y-2 dew hidden">
                    <label for="dew" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="dew" id="dew" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dew'])?$_POST['dew']:'25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dew_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dew_unit_dropdown')">{{ isset($_POST['dew_unit'])?$_POST['dew_unit']:'°C' }} ▾</label>
                        <input type="text" name="dew_unit" value="{{ isset($_POST['dew_unit'])?$_POST['dew_unit']:'°C' }}" id="dew_unit" class="hidden">
                        <div id="dew_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dew_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dew_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dew_unit', 'K')">K</p>
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
            {{-- result --}}
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue   rounded-lg mt-3">
                        @if($_POST['to_cal']=='1')
                        <div class="w-full md:w-1/3 text-lg">
                            <p class="mt-2 py-2 border-b">{{ $lang['5'] }}</p>
                            <p class="mt-2 py-2 border-b"><strong>{{ round($detail['dew'], 5) }} °C</strong></p>
                            <p class="mt-2 py-2 border-b">{{ round($detail['dew'] * (9 / 5) + 32, 5) }} °F</p>
                            <p class="mt-2 py-2 border-b">{{ round($detail['dew'] + 273.15, 5) }} K</p>
                        </div>
                        @elseif($_POST['to_cal']=='2')
                        <div class="w-full text-center text-lg">
                            <p>{{ $lang[3] }}</p>
                            <p class="my-3">
                                <strong class="px-3 py-2 text-2xl rounded-lg shadow-lg bg-black text-white">{{ round($detail['hum'], 5) }} %</strong>
                            </p>
                        </div>
                        @elseif($_POST['to_cal']=='3')
                        <div class="w-full md:w-1/3 text-lg">
                            <p class="mt-2 py-2 border-b">{{ $lang['6'] }}</p>
                            <p class="mt-2 py-2 border-b"><strong>{{ round($detail['temp'], 5) }} °C</strong></p>
                            <p class="mt-2 py-2 border-b">{{ round($detail['temp'] * (9 / 5) + 32, 5) }} °F</p>
                            <p class="mt-2 py-2 border-b">{{ round($detail['temp'] + 273.15, 5) }} K</p>
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>

<script>

@if(isset($error))
    var cal = "{{$_POST['to_cal']}}";
    document.querySelectorAll('.temp, .hum, .dew').forEach(el => el.classList.add('hidden')); // Hide all by default

    if (cal == 1) {
        document.querySelectorAll('.temp, .hum').forEach(el => el.classList.remove('hidden'));
    } else if (cal == 2) {
        document.querySelectorAll('.temp, .dew').forEach(el => el.classList.remove('hidden'));
    } else if (cal == 3) {
        document.querySelectorAll('.hum, .dew').forEach(el => el.classList.remove('hidden'));
    }

@endif
@if(isset($detail))
    var cal = "{{$_POST['to_cal']}}";
    document.querySelectorAll('.temp, .hum, .dew').forEach(el => el.classList.add('hidden')); // Hide all by default

    if (cal == 1) {
        document.querySelectorAll('.temp, .hum').forEach(el => el.classList.remove('hidden'));
    } else if (cal == 2) {
        document.querySelectorAll('.temp, .dew').forEach(el => el.classList.remove('hidden'));
    } else if (cal == 3) {
        document.querySelectorAll('.hum, .dew').forEach(el => el.classList.remove('hidden'));
    }

@endif
document.getElementById('to_cal').addEventListener('change', function() {
    let cal = this.value;
    document.querySelectorAll('.temp, .hum, .dew').forEach(el => el.classList.add('hidden')); // Hide all by default

    if (cal == 1) {
        document.querySelectorAll('.temp, .hum').forEach(el => el.classList.remove('hidden'));
    } else if (cal == 2) {
        document.querySelectorAll('.temp, .dew').forEach(el => el.classList.remove('hidden'));
    } else if (cal == 3) {
        document.querySelectorAll('.hum, .dew').forEach(el => el.classList.remove('hidden'));
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>