<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="w-full lg:w-8/12 justify-center mx-auto mt-3">
            <div class="w-full lg:w-10/12 justify-center mx-auto mt-3">
                <div class="w-full lg:w-12/12 px-2 mb-3">
                    <div class="flex justify-between w-full">
                        <div class="w-9/12">
                            <label for="known" class="label">{{ $lang['1'] }}</label>
                            <div class="py-2">
                                <select name="known" id="known" class="border text-gray-900 text-sm rounded-l-lg rounded-r-none block w-full p-2.5">
                                    <option value="1" {{ isset($_POST['known']) && $_POST['known'] == '1' ? 'selected' : '' }}>
                                        {{ $lang['2'] }}
                                    </option>
                                    <option value="2" {{ isset($_POST['known']) && $_POST['known'] == '2' ? 'selected' : '' }}>
                                        {{ $lang['3'] }}
                                    </option>
                                    <option value="3" {{ isset($_POST['known']) && $_POST['known'] == '3' ? 'selected' : '' }}>
                                        {{ $lang['4'] }}
                                    </option>
                                    <option value="4" {{ isset($_POST['known']) && $_POST['known'] == '4' ? 'selected' : '' }}>
                                        {{ $lang['5'] }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="w-3/12">
                            <label for="known" class="label">&nbsp;</label>
                            <div class="py-2">
                                <select id="sldsp" name="sldsp" class=" border border-gray-300 text-gray-900 rounded-r-lg  rounded-l-none  text-sm rounded-e-lg border-s-gray-100 border-s-2 block w-full p-2.5   ">
                                    <option value="m" {{ isset($_POST['sldsp']) && $_POST['sldsp'] == 'm' ? 'selected' : '' }}>
                                        m </option>
                                    <option value="in" {{ isset($_POST['sldsp']) && $_POST['sldsp'] == 'in' ? 'selected' : '' }}>
                                        in</option>
                                    <option value="ft" {{ isset($_POST['sldsp']) && $_POST['sldsp'] == 'ft' ? 'selected' : '' }}>
                                        ft </option>
                                    <option value="km" {{ isset($_POST['sldsp']) && $_POST['sldsp'] == 'km' ? 'selected' : '' }}>
                                        km</option>
                                    <option value="mi" {{ isset($_POST['sldsp']) && $_POST['sldsp'] == 'mi' ? 'selected' : '' }}>
                                        mi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <div class="relative mt-2 rounded-md ">
                            <div class="lg:w-12/12" id="disp_blk_av">
                                <label for="av" class="label">{{ $lang['6'] }}</label>
                                <div class="relative w-full py-2">
                                    <input type="number" name="av" step="any" id="av"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['av']) ? $_POST['av'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="slav" class="absolute  cursor-pointer text-sm underline right-3 top-5" onclick="toggleDropdown('slav_dropdown')">{{ isset(request()->slav)?request()->slav:'m/s' }} ▾</label>
                                    <input type="text" name="slav" value="{{ isset(request()->slav)?request()->slav:'m/s' }}" id="slav" class="hidden">
                                    <div id="slav_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slav', 'm/s')">m/s</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slav', 'ft/s')">ft/s</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slav', 'km/h')">km/h</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slav', 'km/s')">km/s</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slav', 'mi/s')">mi/s</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slav', 'mph')">mph</p>
                                    </div>
                                </div>
                            </div>
                
                            <div class="lg:w-12/12 " id="disp_blk_tm">
                                <label for="tm" class="label">{{ $lang['7'] }}</label>
                                <div class="relative w-full py-2">
                                    <input type="number" name="tm" step="any" id="tm"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tm']) ? $_POST['tm'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="sltm" class="absolute  cursor-pointer text-sm underline right-3 top-5" onclick="toggleDropdown('sltm_dropdown')">{{ isset(request()->sltm)?request()->sltm:'sec' }} ▾</label>
                                    <input type="text" name="sltm" value="{{ isset(request()->sltm)?request()->sltm:'sec' }}" id="sltm" class="hidden">
                                    <div id="sltm_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sltm', 'sec')">sec</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sltm', 'min')">min</p>
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sltm', 'h')">h</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div  class="hidden w-full lg:w-12/12 px-2 mb-3" id="disp_blk_iv">
                        <div class="lg:w-12/12">
                            <label for="iv" class="label">{{ $lang['8'] }}</label>
                            <div class="relative w-full py-2">
                                <input type="number" name="iv" step="any" id="iv"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['iv']) ? $_POST['iv'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="sliv" class="absolute  cursor-pointer text-sm underline right-3 top-5" onclick="toggleDropdown('sliv_dropdown')">{{ isset(request()->sliv)?request()->sliv:'sec' }} ▾</label>
                                <input type="text" name="sliv" value="{{ isset(request()->sliv)?request()->sliv:'sec' }}" id="sliv" class="hidden">
                                <div id="sliv_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sliv', 'm/s')">m/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sliv', 'ft/s')">ft/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sliv', 'km/h')">km/h</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sliv', 'km/s')">km/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sliv', 'mi/s')">mi/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sliv', 'mph')">mph</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-12/12 px-2 hidden" id="disp_blk_fv">
                        <label for="fv" class="label">{{ $lang['9'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="fv" step="any" id="fv"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fv']) ? $_POST['fv'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="slfv" class="absolute  cursor-pointer text-sm underline right-3 top-5" onclick="toggleDropdown('slfv_dropdown')">{{ isset(request()->slfv)?request()->slfv:'sec' }} ▾</label>
                            <input type="text" name="slfv" value="{{ isset(request()->slfv)?request()->slfv:'sec' }}" id="slfv" class="hidden">
                            <div id="slfv_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slfv', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slfv', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slfv', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slfv', 'km/s')">km/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slfv', 'mi/s')">mi/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slfv', 'mph')">mph</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-12/12 px-2 hidden" id="disp_blk_acc">
                        <label for="acc" class="label">{{ $lang['10'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="acc" step="any" id="acc"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['acc']) ? $_POST['acc'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="slacc" class="absolute  cursor-pointer text-sm underline right-3 top-5" onclick="toggleDropdown('slacc_dropdown')">{{ isset(request()->slacc)?request()->slacc:'sec' }} ▾</label>
                            <input type="text" name="slacc" value="{{ isset(request()->slacc)?request()->slacc:'sec' }}" id="slacc" class="hidden">
                            <div id="slacc_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slacc', 'm/s²')">m/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slacc', 'ft/s²')">ft/s²</p>
                            </div>
                        </div>
                    </div>

                <div class="row hidden" id="disp_blk_10v">
                    @for ($i = 0; $i < 10; $i++)
                    <div class="w-full lg:w-12/12 px-2 mb-3">
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="vloc_{{ $i }}" class="label">v {{ $i }}</label>
                                <div class="relative w-full py-2">
                                    <!-- Number Input Field -->
                                    <input 
                                        type="number" 
                                        name="vloc_{{ $i }}" 
                                        step="any" 
                                        id="vloc_{{ $i }}" 
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" 
                                        value="{{ old('vloc_'.$i, '10') }}" 
                                        aria-label="input" 
                                        placeholder="00" 
                                        oninput="checkInput()"
                                    />
                                    <!-- Label acting as a dropdown trigger -->
                                    <label 
                                        for="slvloc_{{ $i }}" 
                                        class="absolute  cursor-pointer text-sm underline right-3 top-5" 
                                        onclick="toggleDropdown('slvloc_{{ $i }}_dropdown')">
                                        {{ request()->input('slvloc_'.$i, 'sec') }} ▾
                                    </label>
                                    <!-- Hidden input to store the unit value -->
                                    <input 
                                        type="hidden" 
                                        name="slvloc_{{ $i }}" 
                                        value="{{ request()->input('slvloc_'.$i, 'sec') }}" 
                                        id="slvloc_{{ $i }}"
                                    />
                                    <!-- Dropdown for unit selection -->
                                    <div 
                                        id="slvloc_{{ $i }}_dropdown" 
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-full mt-1 right-0 hidden">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slvloc_{{ $i }}', 'm/s')">m/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slvloc_{{ $i }}', 'ft/s')">ft/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slvloc_{{ $i }}', 'km/h')">km/h</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slvloc_{{ $i }}', 'km/s')">km/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slvloc_{{ $i }}', 'mi/s')">mi/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('slvloc_{{ $i }}', 'mph')">mph</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <label for="timi_{{ $i }}" class="label">v {{ $i }}</label>
                                <div class="relative w-full py-2">
                                    <!-- Number Input Field -->
                                    <input 
                                        type="number" 
                                        name="timi_{{ $i }}" 
                                        step="any" 
                                        id="timi_{{ $i }}" 
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" 
                                        value="{{ old('timi_'.$i, '10') }}" 
                                        aria-label="input" 
                                        placeholder="00" 
                                        oninput="checkInput()"
                                    />
                                    <!-- Label acting as a dropdown trigger -->
                                    <label 
                                        for="sltimi_{{ $i }}" 
                                        class="absolute  cursor-pointer text-sm underline right-3 top-5" 
                                        onclick="toggleDropdown('sltimi_{{ $i }}_dropdown')">
                                        {{ request()->input('sltimi_'.$i, 'sec') }} ▾
                                    </label>
                                    <!-- Hidden input to store the unit value -->
                                    <input 
                                        type="hidden" 
                                        name="sltimi_{{ $i }}" 
                                        value="{{ request()->input('sltimi_'.$i, 'sec') }}" 
                                        id="sltimi_{{ $i }}"
                                    />
                                    <!-- Dropdown for unit selection -->
                                    <div 
                                        id="sltimi_{{ $i }}_dropdown" 
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-full mt-1 right-0 hidden">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sltimi_{{ $i }}', 'sec')">sec</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sltimi_{{ $i }}', 'min')">min</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sltimi_{{ $i }}', 'h')">h</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
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
                <div class="w-full   rounded-lg mt-2 ">
                    <div class="lg:w-[50%] md:w-[50%] w-full text-xl mt-4">
                        @if(request('known') !== null && request('known') !== "")
                            <div class="w-full">
                                <table class="w-full lg:text-lg border-separate border-spacing-4 text-sm">
                                    <tr>
                                        <td class="py-2 border-b w-3/4 font-semibold">{{ $lang[11] }}</td>
                                        <td class="py-2 border-b">{{ $detail['dsp'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            @if(request('known') == "1")
                                <p class="mt-2"><img src="{{ asset('images/displacement-formula-3.webp') }}" class="w-full h-24 object-contain" alt="Displacement Calculator Formula 3"></p>
                            @elseif(request('known') == "2")
                                <p class="mt-2"><img src="{{ asset('images/displacement-formula-2.webp') }}" class="w-full h-24 object-contain" alt="Displacement Calculator Formula 2"></p>
                            @elseif(request('known') == "3")
                                <p class="mt-2"><img src="{{ asset('images/displacement-formula-1.webp') }}" class="w-full h-24 object-contain" alt="Displacement Calculator Formula 1"></p>
                            @elseif(request('known') == "4")
                                <p class="mt-2 font-semibold text-sm">{{ $lang['13'] }}</p>
                                <div class="lg:w-1/2 mt-2 ">
                                    <table class="w-full lg:text-lg border-separate border-spacing-4 text-sm">
                                        <tr>
                                            <td class="py-2 border-b font-semibold">{{ $detail['dspft'] }} ft</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b font-semibold">{{ $detail['dspkm'] }} km</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b font-semibold">{{ $detail['dspmi'] }} miles</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset



<script>
       document.getElementById("known").addEventListener("change", function() {
        var d = document.getElementById("known").value;
            if (d === "1") {
                toggleElements("#disp_blk_av", false);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", true);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", true);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "2") {
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", false);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", false);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "3") {
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", false);
                toggleElements("#disp_blk_fv", false);
                toggleElements("#disp_blk_acc", true);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "4") {
                toggleElements("#disp_blk_10v", false);
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", true);
                toggleElements("#disp_blk_iv", true);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", true);
            }
        });
        function toggleElements(selector, disable, value) {
            var elements = document.querySelectorAll(selector + " input, " + selector + " select");

            elements.forEach(function(element) {
                element.disabled = disable;
                if (value !== undefined) {
                    element.value = value;
                }
            });

            if (disable) {
                document.querySelector(selector).classList.add("hidden");
            } else {
                document.querySelector(selector).classList.remove("hidden");
            }
        }
    @if(isset($detail))
        var d = "{{$_POST['known']}}";

        if (d === "1") {
                toggleElements("#disp_blk_av", false);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", true);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", true);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "2") {
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", false);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", false);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "3") {
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", false);
                toggleElements("#disp_blk_fv", false);
                toggleElements("#disp_blk_acc", true);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "4") {
                toggleElements("#disp_blk_10v", false);
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", true);
                toggleElements("#disp_blk_iv", true);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", true);
            }
        function toggleElements(selector, disable, value) {
            var elements = document.querySelectorAll(selector + " input, " + selector + " select");

            elements.forEach(function(element) {
                element.disabled = disable;
                if (value !== undefined) {
                    element.value = value;
                }
            });

            if (disable) {
                document.querySelector(selector).classList.add("hidden");
            } else {
                document.querySelector(selector).classList.remove("hidden");
            }
        }
    @endif

    @if(isset($error))
        var d = "{{$_POST['known']}}";

        if (d === "1") {
                toggleElements("#disp_blk_av", false);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", true);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", true);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "2") {
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", false);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", false);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "3") {
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", false);
                toggleElements("#disp_blk_iv", false);
                toggleElements("#disp_blk_fv", false);
                toggleElements("#disp_blk_acc", true);
                toggleElements("#disp_blk_10v", true);
            } else if (d === "4") {
                toggleElements("#disp_blk_10v", false);
                toggleElements("#disp_blk_av", true);
                toggleElements("#disp_blk_tm", true);
                toggleElements("#disp_blk_iv", true);
                toggleElements("#disp_blk_fv", true);
                toggleElements("#disp_blk_acc", true);
            }
        function toggleElements(selector, disable, value) {
            var elements = document.querySelectorAll(selector + " input, " + selector + " select");

            elements.forEach(function(element) {
                element.disabled = disable;
                if (value !== undefined) {
                    element.value = value;
                }
            });

            if (disable) {
                document.querySelector(selector).classList.add("hidden");
            } else {
                document.querySelector(selector).classList.remove("hidden");
            }
        }
    @endif

</script>
</form>



