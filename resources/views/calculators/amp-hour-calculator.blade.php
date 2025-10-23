<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="w-full">
                <p class="d-inline pe-lg-3 ps-lg-2 text-blue"><?= $lang['1'] ?></p>
                <input type="radio" name="type" value="first" id="first" class="3d" checked>
                <label for="first" class="ps-1 pe-3 text-blue 3d"><?= $lang['2'] ?></label>
                <input type="radio" name="type" value="second" id="second" class="2d"
                    {{ isset(request()->type) && request()->type == 'second' ? 'checked' : '' }}>
                <label for="second" class="ps-1 pe-3 text-blue 2d"><?= $lang['3'] ?></label>
            </div>
            <div
                class="grid grid-cols-12 mt-3  gap-4 firsts {{ isset(request()->type) && request()->type !== 'first' ? 'hidden' : 'row' }}">
                <div class="col-span-12 md:col-span-6 lg:col-span-6 wow">
                    <label for="find" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="w-100 py-2">
                        <select name="find" id="find" class="input">
                            <option value="1"
                                {{ isset($_POST['find']) && $_POST['find'] == '1' ? 'selected' : '' }}>
                                {{ $lang['5'] }}</option>
                            <option value="2"
                                {{ isset($_POST['find']) && $_POST['find'] == '2' ? 'selected' : '' }}>
                                {{ $lang['6'] }}</option>
                            <option value="3"
                                {{ isset($_POST['find']) && $_POST['find'] == '3' ? 'selected' : '' }}>
                                {{ $lang['7'] }}</option>
                        </select>
                    </div>
                </div>
                <div
                    class="col-span-12 md:col-span-6 lg:col-span-6 vol {{ isset(request()->find) && request()->find == '2' ? 'hidden' : 'block' }}">
                    <label for="vol" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="vol" id="vol" class="input"
                            aria-label="input" value="{{ isset($_POST['vol']) ? $_POST['vol'] : '12' }}" />
                        <span class="text-blue input_unit roy">V</span>
                    </div>
                </div>
                <div
                    class="col-span-12 md:col-span-6 lg:col-span-6 bc {{ isset(request()->find) && request()->find !== '1' ? 'block' : 'hidden' }}">
                    <label for="bc" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bc" id="bc" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['bc']) ? $_POST['bc'] : '32' }}" aria-label="input" placeholder="00"
                            oninput="checkInput()" />
                        <label for="bc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('bc_unit_dropdown')">{{ isset($_POST['bc_unit']) ? $_POST['bc_unit'] : 'Ah' }}
                            ▾</label>
                        <input type="text" name="bc_unit"
                            value="{{ isset($_POST['bc_unit']) ? $_POST['bc_unit'] : 'Ah' }}" id="bc_unit"
                            class="hidden">
                        <div id="bc_unit_dropdown"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                            to="bc_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bc_unit', 'Ah')">Ah</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bc_unit', 'mAh')">mAh</p>
                        </div>
                    </div>
                </div>
                <div
                    class="col-span-12 md:col-span-6 lg:col-span-6 wt {{ isset(request()->find) && request()->find == '3' ? 'hidden' : 'block' }}">
                    <label for="wt_hour" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wt_hour" id="wt_hour" step="any"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['wt_hour']) ? $_POST['wt_hour'] : '26.4' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="wt_hour_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('wt_hour_unit_dropdown')">{{ isset($_POST['wt_hour_unit']) ? $_POST['wt_hour_unit'] : 'kJ' }}
                            ▾</label>
                        <input type="text" name="wt_hour_unit"
                            value="{{ isset($_POST['wt_hour_unit']) ? $_POST['wt_hour_unit'] : 'kJ' }}"
                            id="wt_hour_unit" class="hidden">
                        <div id="wt_hour_unit_dropdown"
                            class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden"
                            to="wt_hour_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_hour_unit', 'kJ')">kJ
                            </p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_hour_unit', 'MJ')">MJ
                            </p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_hour_unit', 'Wh')">Wh
                            </p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_hour_unit', 'kWh')">
                                kWh</p>

                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 c_rate">
                    <label for="c_rate" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="c_rate" id="c_rate" class="input"
                            aria-label="input" value="{{ isset($_POST['c_rate']) ? $_POST['c_rate'] : '2' }}" />
                        <span class="text-blue input_unit roy">C</span>
                    </div>
                </div>
            </div>
            <div
                class="grid grid-cols-12 mt-3  gap-4 second {{ isset(request()->type) && request()->type !== 'first' ? 'row' : 'hidden' }}">
                <div class="col-span-12 md:col-span-6 lg:col-span-6 load_size">
                    <label for="load_size" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="load_size" id="load_size" class="input"
                            aria-label="input"
                            value="{{ isset($_POST['load_size']) ? $_POST['load_size'] : '2' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 load_duration">
                    <label for="load_duration" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="load_duration" id="load_duration" class="input"
                            aria-label="input"
                            value="{{ isset($_POST['load_duration']) ? $_POST['load_duration'] : '2' }}" />
                    </div>
                </div>
                <div class="col-span-12 ">
                    <span class="text-blue font-s-16 pe-2"><?= $lang['11'] ?> :</span>
                    <input type="checkbox" name="temp_chk" {{ isset(request()->temp_chk) ? 'checked' : '' }}
                        class="lo" aria-label="input field">
                    <span class="px-2"><?= $lang['12'] ?> 0-85°F</span>
                    <div class="mt-2">
                        <span class="text-blue font-s-16 pe-2"><?= $lang['13'] ?> :</span>
                        <input type="checkbox" name="age_chk" class="lo" aria-label="input field"
                            {{ isset(request()->age_chk) ? 'checked' : '' }}>
                        <span class="px-2"><?= $lang['14'] ?></span>
                    </div>
                </div>
                <div class="col-span-12 ">
                    <p class="d-inline pe-lg-3 text-blue"><?= $lang['15'] ?></p>
                    <input type="radio" name="batteries" value="gel" id="g1"
                        {{ isset(request()->batteries) && request()->batteries == 'gel' ? 'checked' : '' }}>
                    <label for="g1" class="ps-1 pe-3 text-blue 3d"><?= $lang['16'] ?></label>
                    <input type="radio" name="batteries" value="agm" id="g2"
                        {{ isset(request()->batteries) && request()->batteries == 'agm' ? 'checked' : '' }}>
                    <label for="g2" class="ps-1 pe-3 text-blue 2d"><?= $lang['17'] ?></label>
                    <input type="radio" name="batteries" value="flooded" id="g3"
                        {{ isset(request()->batteries) && request()->batteries == 'flooded' ? 'checked' : '' }}>
                    <label for="g3" class="ps-1 pe-3 text-blue 2d"><?= $lang['18'] ?></label>
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
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
                            <div class="col-lg-8 font-s-18">
                                <table class="w-100">
                                    <?php if($detail['type']=="first"): ?>
                                    <?php if($detail['find']=="1"): ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['5'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['ans'], 2) ?><span class="font-s-14">
                                                (Ah)</span></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($detail['find']=="2"): ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['6'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['ans'], 3) ?><span class="font-s-14">
                                                (V)</span></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($detail['find']=="3"): ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['7'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['ans'], 3) ?><span class="font-s-14">
                                                (Wh)</span></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['19'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['dc'], 3) ?><span class="font-s-14">
                                                (A)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['20'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= round(1 / $detail['c_rate'], 3) ?><span
                                                class="font-s-14"> (hrs)</span></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($detail['type']=="second"): ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['21'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= round($detail['ans'], 2) ?><span class="font-s-14">
                                                (Ah)</span></td>
                                    </tr>
                                    <?php endif; ?>
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
        document.getElementById('first').addEventListener('click', function() {
            document.querySelectorAll('.firsts').forEach(el => {
                el.classList.add('row');
                el.classList.remove('hidden');
            });
            document.querySelectorAll('.second').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('row');
            });
        });
        document.getElementById('second').addEventListener('click', function() {
            document.querySelectorAll('.firsts').forEach(el => {
                el.classList.add('hidden');
                el.classList.remove('row');
            });
            document.querySelectorAll('.second').forEach(el => {
                el.classList.add('row');
                el.classList.remove('hidden');
            });
        });
        document.getElementById('find').addEventListener('change', function() {
            var a = this.value;

            function showElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.style.display = 'block';
                    });
                });
            }

            function hideElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.style.display = 'none';
                    });
                });
            }

            if (a === "1") {
                hideElements([".bc"]);
                showElements([".vol", ".wt", ".c_rate"]);
            } else if (a === "2") {
                hideElements([".vol"]);
                showElements([".bc", ".wt", ".c_rate"]);
            } else if (a === "3") {
                hideElements([".wt"]);
                showElements([".bc", ".vol", ".c_rate"]);
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>