<style>
    .blue {
        background: #1565C0
    }

    .teal {
        background: #006C61
    }

    .green {
        background: #00C853
    }

    .yellow {
        background: #FBC02D
    }

    .red {
        background: #FF1744
    }

    .scale-up {
        transform: scale(1.1)
    }

    @media (max-width: 767px) {
        .scale-up {
            transform: scale(1.05)
        }
    }

    .radius-top {
        border-radius: 10px 10px 0px 0px;
    }

    .font-s-34 {
        font-size: 34px;
    }

    .hover_div {
        transition: transform .2s;
    }

    .col-12 {
        width: 100%;
    }

    .new_table {
        width: 100%;
        max-width: 100%;
        table-layout: fixed;
        /* Ensures proper distribution of columns */
    }

    .font_w {
        font-weight: bold;
    }

    .active_tr {
        background-image: linear-gradient(45deg, #156ba1d0, #57b4eb) !important;
    }

    .active_tr td {
        color: white !important;
    }

    .click_me:hover {
        background-image: linear-gradient(45deg, #99ea48, #99ea48) !important;
    }

    .line-height {
        line-height: 28px;
    }

    .gap-2 {
        gap: 15px;
    }

    .new_table .click_me:nth-child(odd) {
        background-color: #1670a712;
        /* color: #fff; */
    }

    .radius-top {
        border-radius: 10px 10px 0px 0px;
    }

    .font-s-34 {
        font-size: 34px;
    }

    .hover_div {
        transition: transform .2s;
    }

    .col-12 {
        width: 100%;
    }

    .new_table {
        width: 100%;
        max-width: 100%;
        table-layout: fixed;
    }

    .font_w {
        font-weight: bold;
    }

    .content tbody tr:hover td p {
        color: white !important;
    }


    .text-light-green {
        color: #84D23C;
    }



    /* Apply borders to tbody cells */
    .top-table tbody tr:first-child {
        border-top: 8px solid white;
        /* Adds a visual gap */
    }

    .spacer-row td {
        height: 8px;
        border: none;
    }


    .top-table td {
        border: 1px solid #D4D4D4;
    }

    .table-wrapper {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #ddd;
    }

    .statistics td {
        font-size: 14px;
    }

    .text-secondary {
        text-[14px]c7572 !import.bg-[#99ea48] {
            background: #1670a7;
        }
    }

    .br-top {
        border-radius: 10px 10px 0px 0px;
    }

    .first_c {
        color: #0D47A1;
        font-weight: bold;
    }

    .second_c {
        color: #00897B;
        font-weight: bold;
    }

    .third_c {
        color: #00C853;
        font-weight: bold;
    }

    .fourth_c {
        color: #ab9326;
        font-weight: bold;
    }

    .fifth_c {
        color: #FF1744;
        font-weight: bold;
    }

    .border-b {
        border-bottom: 2px solid #f2f2f2;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }



    .modal-content {
        margin: auto;
        padding: 10px;
        width: 1000px;
        max-width: 100%;
        border-radius: 20px;
    }

    #method_info_modal .modal-content {
        width: 400px;
    }

    #image_modal .modal-content {
        width: 300px;
    }

    .m-t-35 {
        margin-top: 35px;
    }

    .f-w-600 {
        font-weight: 600;
    }
</style>
<form class="row relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless (isset($detail))
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mb-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[60%] w-full mx-auto ">
                @php
                    function optionsList($arr1, $arr2, $unit)
                    {
                        foreach ($arr1 as $index => $name) {
                            echo '<option value="' .
                                htmlspecialchars($name) .
                                '"' .
                                (isset($unit) && $name === $unit ? ' selected' : '') .
                                '>' .
                                htmlspecialchars($arr2[$index]) .
                                '</option>';
                        }
                    }
                @endphp
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 px-2 flex mb-2 items-center">
                        <label for="gender" class="pe-lg-3 pe-2 label">{!! $lang['gender'] !!}:</label>
                        <div class="w-full flex gap-4">
                            @php
                                $genders = [
                                    ['value' => 'Male', 'label' => $lang['male']],
                                    ['value' => 'Female', 'label' => $lang['female']],
                                ];
                                $selectedGender = $_COOKIE['gender'] ?? 'Male';
                            @endphp

                            @foreach ($genders as $gender)
                                <div class="form-check flex items-center">
                                    <input type="radio" name="gender" id="gender_{{ $gender['value'] }}"
                                        value="{{ $gender['value'] }}" class="form-check-input me-2"
                                        {{ $selectedGender === $gender['value'] ? 'checked' : '' }}>
                                    <label for="gender_{{ $gender['value'] }}" class="label pe-2 pe-lg-3">
                                        {{ $gender['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-11 px-2 methods">
                        <label for="method" class="label">Methods:</label>
                        <div class="w-full py-2 relative">
                            <select name="method" id="method" class="input">
                                @php
                                    $name = [
                                        $lang['70'],
                                        $lang['24'] . '(' . $lang['22'] . ')',
                                        $lang['25'] . ' 7 (' . $lang['23'] . ')',
                                        $lang['25'] . ' 4 (' . $lang['23'] . ')',
                                        $lang['25'] . ' 3 (' . $lang['23'] . ')',
                                        $lang['26'] . '(' . $lang['23'] . ')',
                                        $lang['27'] . '(' . $lang['23'] . ')',
                                    ];
                                    $val = ['7', '1', '2', '3', '4', '5', '6'];
                                    optionsList($val, $name, $_COOKIE['method'] ?? '7');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center mt-3">
                        <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}" id="method_info"
                            width="16px" alt="">
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="age" id="age" class="input"
                                aria-label="input" placeholder="00" value="{{ $_COOKIE['age'] ?? 25 }}" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="weight" id="weight" class="input"
                                aria-label="input" placeholder="00" value="{{ $_COOKIE['weight'] ?? 150 }}" />
                            <label for="unit"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit'] ?? 'lbs' }}
                                ▾</label>
                            <input type="text" name="unit" value="{{ $_COOKIE['unit'] ?? 'lbs' }}" id="unit"
                                class="hidden">
                            <div class="units unit hidden" to="unit">
                                <p value="lbs">lbs</p>
                                <p value="kg">kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 px-2 ft_in">
                        <label for="height-ft" class="label">{!! $lang['height'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="height-ft" id="height-ft" class="input"
                                aria-label="input" placeholder="ft" value="{{ $_COOKIE['height-ft'] ?? 5 }}" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2 ps-lg-0 ft_in ">
                        <label for="height-in" class="label">&nbsp;</label>
                        <input type="text" name="unit_ft_in" value="{{ $_COOKIE['unit_ft_in'] ?? 'ft/in' }}"
                            id="unit_ft_in" class="hidden">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="height-in" id="height-in" class="input"
                                aria-label="input" value="{{ $_COOKIE['height-in'] ?? 9 }}" />
                            <label for="unit_h"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_h'] ?? 'ft/in' }}
                                ▾</label>
                            <input type="text" name="unit_h" value="{{ $_COOKIE['unit_h'] ?? 'ft/in' }}"
                                id="unit_h" class="hidden">
                            <div class="units units_ft_in unit_h hidden" to="unit_h">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 h_cm hidden  height-cm">
                        <label for="height-cm" class="label">{{ $lang['height'] }} (cm):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="height-cm" id="height-cm" class="input"
                                aria-label="input" placeholder="cm" value="{{ $_COOKIE['height-cm'] ?? 175 }}" />
                            <label for="unit_h_cm"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_h_cm'] ?? 'cm' }}
                                ▾</label>
                            <input type="text" name="unit_h_cm" value="{{ $_COOKIE['unit_h_cm'] ?? 'cm' }}"
                                id="unit_h_cm" class="hidden">
                            <div class="units units_ft_in unit_h_cm hidden" to="unit_h_cm">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="hightUnit" id="hightUnit"
                        value="{{ $_COOKIE['hightUnit'] ?? 'ft/in' }}">
                    <div class="col-span-6 px-2 navy neck {{ $_COOKIE['method'] !== '1' ? 'hidden' : '' }}">
                        <label for="neck" class="label">{{ $lang['neck'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="neck" id="neck" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['neck'] ?? 19 }}" />
                            <label for="unit_n"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_n'] ?? 'in' }}
                                ▾</label>
                            <input type="text" name="unit_n" value="{{ $_COOKIE['unit_n'] ?? 'in' }}"
                                id="unit_n" class="hidden">
                            <div class="units unit_n hidden" to="unit_n">
                                <p value="in">inches (in)</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 px-2 navy  waist {{ $_COOKIE['method'] !== '1' ? 'hidden' : '' }}">
                        <label for="waist" class="label">{{ $lang['waist'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="waist" id="waist" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['waist'] ?? '30' }}" />
                            <label for="unit_w"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_w'] ?? 'in' }}
                                ▾</label>
                            <input type="text" name="unit_w" value="{{ $_COOKIE['unit_w'] ?? 'in' }}"
                                id="unit_w" class="hidden">
                            <div class="units unit_w hidden" to="unit_w">
                                <p value="in">inches (in)</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 px-2 hip {{ $_COOKIE['method'] === 'female' ? 'hidden' : '' }}"
                        id="hipInput">
                        <label for="hip" class="label">{{ $lang['hip'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="hip" id="hip" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['hip'] ?? '30' }}" />
                            <label for="unit_hip"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_hip'] ?? 'in' }}
                                ▾</label>
                            <input type="text" name="unit_hip" value="{{ $_COOKIE['unit_hip'] ?? 'in' }}"
                                id="unit_hip" class="hidden">
                            <div class="units unit_hip hidden" to="unit_hip">
                                <p value="in">inches (in)</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-span-6 px-2 chest {{ $_COOKIE['method'] == '2' || $_COOKIE['method'] == '5' ? '' : 'hidden' }}">
                        <label for="chest" class="label flex items-center">
                            <span>{!! $lang['28'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('chest')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="chest" id="chest" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['chest'] ?? '' }}" />
                            <label for="unit_chest"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_chest'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_chest" value="{{ $_COOKIE['unit_chest'] ?? 'mm' }}"
                                id="unit_chest" class="hidden">
                            <div class="units unit_chest hidden" to="unit_chest">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 px-2 abd {{ $_COOKIE['method'] == '2' || $_COOKIE['method'] == '3' || $_COOKIE['method'] == '5' ? '' : 'hidden' }}">
                        <label for="abd" class="label flex items-center">
                            <span>{!! $lang['29'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('abd')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="abd" id="abd" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['abd'] ?? '' }}" />
                            <label for="unit_abd"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_abd'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_abd" value="{{ $_COOKIE['unit_abd'] ?? 'mm' }}"
                                id="unit_abd" class="hidden">
                            <div class="units unit_abd hidden" to="unit_abd">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 px-2 thigh {{ $_COOKIE['method'] == '2' || $_COOKIE['method'] == '3' || $_COOKIE['method'] == '4' || $_COOKIE['method'] == '5' ? '' : 'hidden' }}">
                        <label for="thigh" class="label flex items-center">
                            <span>{!! $lang['30'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('thigh')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="thigh" id="thigh" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['thigh'] ?? '' }}" />
                            <label for="unit_thigh"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_thigh'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_thigh" value="{{ $_COOKIE['unit_thigh'] ?? 'mm' }}"
                                id="unit_thigh" class="hidden">
                            <div class="units unit_thigh hidden" to="unit_thigh">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 px-2 tricep {{ $_COOKIE['method'] == '2' || $_COOKIE['method'] == '3' || $_COOKIE['method'] == '4' || $_COOKIE['method'] == '5' || $_COOKIE['method'] == '6' ? '' : 'hidden' }}">
                        <label for="tricep" class="label flex items-center">
                            <span>{!! $lang['31'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('tri')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="tricep" id="tricep" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['tricep'] ?? '' }}" />
                            <label for="unit_tricep"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_tricep'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_tricep" value="{{ $_COOKIE['unit_tricep'] ?? 'mm' }}"
                                id="unit_tricep" class="hidden">
                            <div class="units unit_tricep hidden" to="unit_tricep">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 px-2 sub {{ $_COOKIE['method'] == '2' || $_COOKIE['method'] == '5' || $_COOKIE['method'] == '6' ? '' : 'hidden' }}">
                        <label for="sub" class="label flex items-center">
                            <span>{!! $lang['32'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('sub')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="sub" id="sub" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['sub'] ?? '' }}" />
                            <label for="unit_sub"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_sub'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_sub" value="{{ $_COOKIE['unit_sub'] ?? 'mm' }}"
                                id="unit_sub" class="hidden">
                            <div class="units unit_sub hidden" to="unit_sub">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 px-2 sup {{ $_COOKIE['method'] == '2' || $_COOKIE['method'] == '3' || $_COOKIE['method'] == '4' || $_COOKIE['method'] == '5' || $_COOKIE['method'] == '6' ? '' : 'hidden' }}">
                        <label for="sup" class="label flex items-center">
                            <span>{!! $lang['33'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('sup')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="sup" id="sup" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['sup'] ?? '' }}" />
                            <label for="unit_sup"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_sup'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_sup" value="{{ $_COOKIE['unit_sup'] ?? 'mm' }}"
                                id="unit_sup" class="hidden">
                            <div class="units unit_sup hidden" to="unit_sup">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 px-2 mid {{ $_COOKIE['method'] == '2' ? '' : 'hidden' }}">
                        <label for="mid" class="label flex items-center">
                            <span>{!! $lang['34'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('mid')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="mid" id="mid" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['mid'] ?? '' }}" />
                            <label for="unit_mid"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_mid'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_mid" value="{{ $_COOKIE['unit_mid'] ?? 'mm' }}"
                                id="unit_mid" class="hidden">
                            <div class="units unit_mid hidden" to="unit_mid">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-span-6 px-2 bicep {{ $_COOKIE['method'] == '5' || $_COOKIE['method'] == '6' ? '' : 'hidden' }}">
                        <label for="bicep" class="label flex items-center">
                            <span>{!! $lang['35'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('bicep')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="bicep" id="bicep" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['bicep'] ?? '' }}" />
                            <label for="unit_bicep"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_bicep'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_bicep" value="{{ $_COOKIE['unit_bicep'] ?? 'mm' }}"
                                id="unit_bicep" class="hidden">
                            <div class="units unit_bicep hidden" to="unit_bicep">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 px-2 back {{ $_COOKIE['method'] == '5' ? '' : 'hidden' }}">
                        <label for="back" class="label flex items-center">
                            <span>{!! $lang['36'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('back')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="back" id="back" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['back'] ?? '' }}" />
                            <label for="unit_back"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_back'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_back" value="{{ $_COOKIE['unit_back'] ?? 'mm' }}"
                                id="unit_back" class="hidden">
                            <div class="units unit_back hidden" to="unit_back">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 px-2 calf {{ $_COOKIE['method'] == '5' ? '' : 'hidden' }}">
                        <label for="calf" class="label flex items-center">
                            <span>{!! $lang['37'] !!}:</span>
                            <img class="cursor-pointer" src="{{ asset('images/calorie_deficit/info.png') }}"
                                onclick="imgmodal('calf')" id="info_img" width="12px" alt="">
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="calf" id="calf" min="1"
                                class="input" aria-label="input" value="{{ $_COOKIE['calf'] ?? '' }}" />
                            <label for="unit_calf"
                                class="text-blue input-unit text-decoration-underline">{{ $_COOKIE['unit_calf'] ?? 'mm' }}
                                ▾</label>
                            <input type="text" name="unit_calf" value="{{ $_COOKIE['unit_calf'] ?? 'mm' }}"
                                id="unit_calf" class="hidden">
                            <div class="units unit_calf hidden" to="unit_calf">
                                <p value="mm">mm</p>
                                <p value="in">in</p>
                                <p value="cm">cm</p>
                            </div>
                        </div>
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

        <div id="method_info_modal" class="modal">
            <div class="modal-content bg-white">
                <div class="flex justify-between items-center">
                    <p class="text-blue f-w-600 mx-auto" id="method_info_title"></p>
                    <img class="cursor-pointer btn-close" src="{{ asset('assets/img/cancel.png') }}" width="12px"
                        height="12px" alt="">
                </div>

                <p class="mt-2 text-center font-s-12" id="method_info_description"></p>

                <div class="flex justify-content-center mt-3">
                    <span class="bg-dark-blue text-white p-2 font-s-12 radius-10 cursor-pointer btn-close">Okay</span>
                </div>
            </div>
        </div>


        <div id="image_modal" class="modal">
            <div class="modal-content bg-white">
                <div class="flex justify-between items-center">
                    <p class="text-blue f-w-600 mx-auto" id="method_info_title"></p>
                    <img class="cursor-pointer btn-close-image" src="{{ asset('assets/img/cancel.png') }}"
                        width="12px" height="12px" alt="">
                </div>

                <div class="text-center" style="min-height: 160px;">
                    <img src="" id="method_info_image" width="150px" alt="">
                </div>

                <p class="mt-2  font-s-12" id="image_info_description"></p>

            </div>
        </div>


    @endunless
    @isset($detail)
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg shadow-md space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif

                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="col-12">

                            @if (request()->method == 1 || request()->calculator_type == 'simple')
                                <div class="col-lg-12 mx-auto">
                                    <div class="grid grid-cols-12 gap-3">
                                        <div class="col-span-12 md:col-span-6 pe-lg-2">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>{{ $lang['body_fat'] }}</strong></p>
                                                <p class="font-s-32"><strong
                                                        class="text-light-green">{{ $detail['army'] }}%</strong></p>
                                            </div>
                                        </div>

                                        <div class="col-span-12 md:col-span-6 ps-lg-2 mt-2 mt-lg-0">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>Your Body Fat in {{ $detail['fat_weight_unit'] }}</strong></p>
                                                <p class="font-s-32">
                                                    <strong
                                                        class="text-light-green">{{ number_format($detail['fat_weight'], 2) }}
                                                        {{ $detail['fat_weight_unit'] }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-[12px] col-span-12 text-center font_w my-2">
                                            Note: It is generally recommended to maintain a body fat level of 15% or lower
                                            for men and 25% or lower for women.
                                        </p>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#99ea48] br-top ">1) American Council on
                                                Exercise (Male, Body Fat 59%)</p>
                                        </div>
                                        <div class="col-12">
                                            <table class="table new_table font-s-14" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray ">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 2 && $detail['army'] < 6 ? 'first_c' : '' }}">
                                                        <td class='p-2'>Essential</td>
                                                        <td class='p-2'>2 to 5.9 %</td>
                                                        <td class='p-2'>67 to 70 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 6 && $detail['army'] < 14 ? 'second_c' : '' }}">
                                                        <td class='p-2'>Athletes</td>
                                                        <td class='p-2'>6 to 13.9 %</td>
                                                        <td class='p-2'>70 to 76 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 14 && $detail['army'] < 18 ? 'third_c' : '' }}">
                                                        <td class='p-2'>Fitness</td>
                                                        <td class='p-2'>14 to 17.9 %</td>
                                                        <td class='p-2'>76 to 80 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 18 && $detail['army'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2'>Acceptable</td>
                                                        <td class='p-2'>18 to 24.9 %</td>
                                                        <td class='p-2'>80 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Obese</td>
                                                        <td class='p-2'>25 % and over</td>
                                                        <td class='p-2'>87 lb and over</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#99ea48] br-top ">2) WHO/NIH Guidelines,
                                                Gallagher et al. (Male 20 to 39 yrs, Body Fat 59 %)</p>
                                        </div>
                                        <div class="col-12">
                                            <table class="table new_table  font-s-14" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) < 8 ? 'second_c' : '' }}">
                                                        <td class='p-2'>Underfat</td>
                                                        <td class='p-2'>under 8 %</td>
                                                        <td class='p-2'>under 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 8 && $detail['army'] < 20 ? 'third_c' : '' }}">
                                                        <td class='p-2'>Healthy</td>
                                                        <td class='p-2'>8 to 19.9 %</td>
                                                        <td class='p-2'>71 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 20 && $detail['army'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2'>Overfat</td>
                                                        <td class='p-2'>20 to 24.9 %</td>
                                                        <td class='p-2'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Obese</td>
                                                        <td class='p-2'>25 % and over</td>
                                                        <td class='p-2'>87 lb and over</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#99ea48] br-top ">3) American College of
                                                Sports Medicine* (Male 20 to 29 yrs, Body Fat 59%)</p>
                                        </div>
                                        <div class="col-12">
                                            <table class="table new_table font-s-14" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 4.2 && $detail['army'] <= 7.8 ? 'first_c' : '' }}">
                                                        <td class='p-2'>Very Lean</td>
                                                        <td class='p-2'>4.2 to 7.8 %</td>
                                                        <td class='p-2'>68 to 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 7.9 && $detail['army'] <= 11.4 ? 'second_c' : '' }}">
                                                        <td class='p-2'>Excellent</td>
                                                        <td class='p-2'>7.9 to 11.4 %</td>
                                                        <td class='p-2'>71 to 74 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 11.5 && $detail['army'] <= 15.7 ? 'third_c' : '' }}">
                                                        <td class='p-2'>Good</td>
                                                        <td class='p-2'>11.5 to 15.7 %</td>
                                                        <td class='p-2'>74 to 78 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 15.8 && $detail['army'] <= 19.6 ? 'fourth_c' : '' }}">
                                                        <td class='p-2'>Fair</td>
                                                        <td class='p-2'>15.8 to 19.6 %</td>
                                                        <td class='p-2'>78 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 19.7 && $detail['army'] <= 24.8 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Poor</td>
                                                        <td class='p-2'>19.7 to 24.8 %</td>
                                                        <td class='p-2'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['army'] ?? 0) >= 24.9 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Very Poor</td>
                                                        <td class='p-2'>24.9 % and over</td>
                                                        <td class='p-2'>87 lb and over</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>



                                    <div class="row bg-gradient radius-10 hidden">
                                        <p class=" text-center text-white p-2" colspan="2">{{ $lang['13'] }}</p>
                                    </div>
                                    <div class="col-12 overflow-auto mt-2 table-wrapper hidden">
                                        <table class="col-12 table-border radius-10" cellspacing="0">
                                            <thead class="mb-2">

                                            </thead>
                                            <tbody class="top-table">

                                                <tr>
                                                    <td class="px-3 py-2">{{ $lang['fat_mass'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['fat_mass'] }} kg</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3 py-2">{{ $lang['lean_mass'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['lean_mass'] }} kg</strong></td>
                                                </tr>
                                                <tr class="hidden">
                                                    <td class="px-3 py-2">{{ $lang['child'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['child_body_fat'] }} %</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3 py-2">{{ $lang['adult'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['adult_body_fat'] }} %</strong>
                                                    </td>
                                                </tr>
                                                <tr
                                                    class="{{ isset(request()->gender) && request()->gender === 'Female' ? '' : 'hidden' }}">
                                                    <td class="px-3 py-2">{{ $lang['bai'] }}</td>
                                                    <td class="text-center px-3 py-2"><strong
                                                            class="text-blue">{{ $detail['BAI'] }} %</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-10 relative mx-auto" style="top:-12px">
                                        <div class="flex flex-column flex-sm-row text-center font-s-14 hidden">
                                            <div
                                                class="col blue px-2 py-1 radius-sm-10 radius-l-10 {{ isset($detail['Essential']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['1'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '10-13 %' : '2-5 %' }}</span>
                                            </div>
                                            <div
                                                class="col teal text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Athletes']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['2'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '14-20 %' : '6-13 %' }}</span>
                                            </div>
                                            <div
                                                class="col green text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Fitness']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['3'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '21-24 %' : '14-17 %' }}</span>
                                            </div>
                                            <div
                                                class="col yellow text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Average']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['4'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '25-31 %' : '18-25 %' }}</span>
                                            </div>
                                            <div
                                                class="col red text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 radius-r-10 {{ isset($detail['Obese']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['5'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '31+ %' : '25+ %' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden">
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['6'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['army'] }}%</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['7'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['body_fat'] }}%</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['8'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['army'] }}%</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p class="font-s-12"><strong>{{ $lang['9'] }}</strong></p>
                                                <p><strong class="text-blue">{{ $detail['ymca'] }}%</strong></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="col-lg-12 mx-auto">
                                    <div class="row">
                                        <div class="col-md-6 pe-md-2">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>{{ $lang['body_fat'] }}</strong></p>
                                                <p class="font-s-32"><strong
                                                        class="text-light-green">{{ $detail['body_fat'] }}%</strong></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-md-2 mt-2 mt-md-0">
                                            <div class="bg-sky text-center border radius-10 p-3 ">
                                                <p><strong>Your Body Fat in {{ $detail['fat_weight_unit'] }}</strong></p>
                                                <p class="font-s-32">
                                                    <strong
                                                        class="text-light-green">{{ number_format($detail['fat_weight'], 2) }}
                                                        {{ $detail['fat_weight_unit'] }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <p class="font-s-12 text-center font_w my-2">
                                            Note: It is generally recommended to maintain a body fat level of 15% or lower
                                            for men and 25% or lower for women.
                                        </p>
                                    </div>

                                    <div class="row bg-gradient radius-10">
                                        <p class=" text-center text-white p-2" colspan="2">
                                            {{ isset($lang['secoun_table_h']) ? $lang['secoun_table_h'] : 'Body Fat Percentage Ranges' }}
                                        </p>
                                    </div>

                                    <div class="col-12 overflow-auto mt-2 table-wrapper ">
                                        <table class="col-12" cellspacing="0">
                                            <tbody class="{{ $device == 'mobile' ? 'font-s-14' : '' }}">

                                                <tr>
                                                    <th class="text-start border-b p-2">{{ $lang['10'] }}</th>
                                                    <th class="text-start border-b p-2">{{ $lang['11'] }}</th>
                                                    <th class="text-start border-b p-2">{{ $lang['12'] }}</th>
                                                </tr>
                                                <tr
                                                    class="{{ isset($detail['Essential']) ? $detail['Essential'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['1'] }}</td>
                                                    <td class="border-b p-2">10-13 %</td>
                                                    <td class="border-b p-2">2-5 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Athletes']) ? $detail['Athletes'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['2'] }}</td>
                                                    <td class="border-b p-2">14-20 %</td>
                                                    <td class="border-b p-2">6-13 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Fitness']) ? $detail['Fitness'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['3'] }}</td>
                                                    <td class="border-b p-2">21-24 %</td>
                                                    <td class="border-b p-2">14-17 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Average']) ? $detail['Average'] : '' }}">
                                                    <td class="border-b p-2">{{ $lang['4'] }}</td>
                                                    <td class="border-b p-2">25-31 %</td>
                                                    <td class="border-b p-2">18-25 %</td>
                                                </tr>
                                                <tr class="{{ isset($detail['Obese']) ? $detail['Obese'] : '' }}">
                                                    <td class="p-2">{{ $lang['5'] }}</td>
                                                    <td class="p-2">31+ %</td>
                                                    <td class="p-2">25+ %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#99ea48] br-top ">1) American Council on
                                                Exercise (Male, Body Fat 59%)</p>
                                        </div>
                                        <div class="col-12">
                                            <table class="table new_table font-s-14" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray ">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 2 && $detail['body_fat'] < 6 ? 'first_c' : '' }}">
                                                        <td class='p-2'>Essential</td>
                                                        <td class='p-2'>2 to 5.9 %</td>
                                                        <td class='p-2'>67 to 70 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 6 && $detail['body_fat'] < 14 ? 'second_c' : '' }}">
                                                        <td class='p-2'>Athletes</td>
                                                        <td class='p-2'>6 to 13.9 %</td>
                                                        <td class='p-2'>70 to 76 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 14 && $detail['body_fat'] < 18 ? 'third_c' : '' }}">
                                                        <td class='p-2'>Fitness</td>
                                                        <td class='p-2'>14 to 17.9 %</td>
                                                        <td class='p-2'>76 to 80 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 18 && $detail['body_fat'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2'>Acceptable</td>
                                                        <td class='p-2'>18 to 24.9 %</td>
                                                        <td class='p-2'>80 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Obese</td>
                                                        <td class='p-2'>25 % and over</td>
                                                        <td class='p-2'>87 lb and over</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#99ea48] br-top ">2) WHO/NIH Guidelines,
                                                Gallagher et al. (Male 20 to 39 yrs, Body Fat 59 %)</p>
                                        </div>
                                        <div class="col-12">
                                            <table class="table new_table  font-s-14" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) < 8 ? 'second_c' : '' }}">
                                                        <td class='p-2'>Underfat</td>
                                                        <td class='p-2'>under 8 %</td>
                                                        <td class='p-2'>under 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 8 && $detail['body_fat'] < 20 ? 'third_c' : '' }}">
                                                        <td class='p-2'>Healthy</td>
                                                        <td class='p-2'>8 to 19.9 %</td>
                                                        <td class='p-2'>71 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 20 && $detail['body_fat'] < 25 ? 'fourth_c' : '' }}">
                                                        <td class='p-2'>Overfat</td>
                                                        <td class='p-2'>20 to 24.9 %</td>
                                                        <td class='p-2'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 25 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Obese</td>
                                                        <td class='p-2'>25 % and over</td>
                                                        <td class='p-2'>87 lb and over</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="border radius-10 mt-3 statistics">
                                        <div class="row text-center ">
                                            <p class="text-[14px] py-2 font_w  bg-[#99ea48] br-top ">3) American College of
                                                Sports Medicine* (Male 20 to 29 yrs, Body Fat 59%)</p>
                                        </div>
                                        <div class="col-12">
                                            <table class="table new_table font-s-14" cellspacing="0">
                                                <tbody>
                                                    <tr class="bg-gray">
                                                        <td class='p-2 fw-bold'>Category</td>
                                                        <td class='p-2 fw-bold'>Body Fat</td>
                                                        <td class='p-2 fw-bold'>Weight</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 4.2 && $detail['body_fat'] <= 7.8 ? 'first_c' : '' }}">
                                                        <td class='p-2'>Very Lean</td>
                                                        <td class='p-2'>4.2 to 7.8 %</td>
                                                        <td class='p-2'>68 to 71 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 7.9 && $detail['body_fat'] <= 11.4 ? 'second_c' : '' }}">
                                                        <td class='p-2'>Excellent</td>
                                                        <td class='p-2'>7.9 to 11.4 %</td>
                                                        <td class='p-2'>71 to 74 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 11.5 && $detail['body_fat'] <= 15.7 ? 'third_c' : '' }}">
                                                        <td class='p-2'>Good</td>
                                                        <td class='p-2'>11.5 to 15.7 %</td>
                                                        <td class='p-2'>74 to 78 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 15.8 && $detail['body_fat'] <= 19.6 ? 'fourth_c' : '' }}">
                                                        <td class='p-2'>Fair</td>
                                                        <td class='p-2'>15.8 to 19.6 %</td>
                                                        <td class='p-2'>78 to 82 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 19.7 && $detail['body_fat'] <= 24.8 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Poor</td>
                                                        <td class='p-2'>19.7 to 24.8 %</td>
                                                        <td class='p-2'>82 to 87 lb</td>
                                                    </tr>
                                                    <tr
                                                        class="click_me {{ ($detail['body_fat'] ?? 0) >= 24.9 ? 'fifth_c' : '' }}">
                                                        <td class='p-2'>Very Poor</td>
                                                        <td class='p-2'>24.9 % and over</td>
                                                        <td class='p-2'>87 lb and over</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-md-10 relative mx-auto" style="top:-12px">
                                        <div class="flex flex-column flex-sm-row text-center font-s-14 hidden">
                                            <div
                                                class="col blue px-2 py-1 radius-sm-10 radius-l-10 {{ isset($detail['Essential']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['1'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '10-13 %' : '2-5 %' }}</span>
                                            </div>
                                            <div
                                                class="col teal text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Athletes']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['2'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '14-20 %' : '6-13 %' }}</span>
                                            </div>
                                            <div
                                                class="col green text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Fitness']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['3'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '21-24 %' : '14-17 %' }}</span>
                                            </div>
                                            <div
                                                class="col yellow text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 {{ isset($detail['Average']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['4'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '25-31 %' : '18-25 %' }}</span>
                                            </div>
                                            <div
                                                class="col red text-white radius-sm-10 px-2 py-1 mt-1 mt-sm-0 radius-r-10 {{ isset($detail['Obese']) ? 'scale-up' : '' }}">
                                                <p class="text-white">{{ $lang['5'] }}</p>
                                                <span
                                                    class="text-white">{{ request()->gender == 'Female' ? '31+ %' : '25+ %' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row hidden">
                                        <div class="col-lg-6 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p><strong>{{ $lang['fat_mass'] }}</strong></p>
                                                <p><strong class="text-green">{{ $detail['body_fat_w'] }}</strong></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 p-2">
                                            <div class="bg-sky text-center border radius-10 px-3 py-2">
                                                <p><strong>{{ $lang['lean_mass'] }}</strong></p>
                                                <p><strong class="text-green">{{ $detail['lbm'] }}</strong></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center my-[30px]">
                <a href="{{ url()->current() }}/"
                    class="calculate px-6 py-3 sm:px-10 sm:py-4 font-semibold bg-[#99EA48] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base"
                    id="">
                    @if (app()->getLocale() == 'en')
                        RESET
                    @else
                        {{ $lang['reset'] ?? 'RESET' }}
                    @endif
                </a>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.querySelectorAll('input[name="gender"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var x = document.querySelector('input[name="gender"]:checked').value;
                    if (x === 'Female') {
                        document.getElementById('hipInput').classList.remove('hidden');
                    } else {
                        document.getElementById('hipInput').classList.add('hidden');
                    }
                });
            });

            document.querySelector('.simple').addEventListener('click', function() {
                document.getElementById('calculator_type').value = 'simple';
                document.querySelector('.advance').classList.remove('units_active');
                this.classList.add('units_active');
                document.querySelectorAll('.navy').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll(
                    '.chest, .abd, .thigh, .tricep, .sub, .sup, .mid, .bicep, .back, .calf, .methods').forEach(
                    function(el) {
                        el.style.display = 'none';
                    });
            });

            document.querySelector('.advance').addEventListener('click', function() {
                document.getElementById('calculator_type').value = 'advance';
                document.querySelector('.simple').classList.remove('units_active');
                this.classList.add('units_active');
                document.querySelector('.methods').style.display = 'block';
                var method = document.getElementById('method').value;
                if (method == 1) {
                    document.querySelectorAll('.navy').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.chest, .abd, .thigh, .tricep, .sub, .sup, .mid, .bicep, .back, .calf')
                        .forEach(function(el) {
                            el.style.display = 'none';
                        });
                } else if (method == 2) {
                    document.querySelectorAll('.chest, .abd, .thigh, .tricep, .sub, .sup, .mid').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .bicep, .back, .calf').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 3) {
                    document.querySelectorAll('.abd, .thigh, .tricep, .sup').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .chest, .sub, .mid, .bicep, .back, .calf').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 4) {
                    document.querySelectorAll('.thigh, .tricep, .sup').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .chest, .abd, .sub, .mid, .bicep, .back, .calf').forEach(function(
                        el) {
                        el.style.display = 'none';
                    });
                } else if (method == 5) {
                    document.querySelectorAll('.chest, .abd, .thigh, .tricep, .sub, .sup, .bicep, .back, .calf')
                        .forEach(function(el) {
                            el.style.display = 'block';
                        });
                    document.querySelectorAll('.navy, .mid').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 6) {
                    document.querySelectorAll('.tricep, .sub, .sup, .bicep').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .chest, .abd, .thigh, .mid, .back, .calf').forEach(function(el) {
                        el.style.display = 'none';
                    });
                }
            });

            document.getElementById('method').addEventListener('change', function() {
                var method = this.value;
                if (method == 1) {
                    document.querySelectorAll('.navy').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.chest, .abd, .thigh, .tricep, .sub, .sup, .mid, .bicep, .back, .calf')
                        .forEach(function(el) {
                            el.style.display = 'none';
                        });
                } else if (method == 2) {
                    document.querySelectorAll('.chest, .abd, .thigh, .tricep, .sub, .sup, .mid').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .bicep, .back, .calf').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 3) {
                    document.querySelectorAll('.abd, .thigh, .tricep, .sup').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .chest, .sub, .mid, .bicep, .back, .calf').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 4) {
                    document.querySelectorAll('.thigh, .tricep, .sup').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .chest, .abd, .sub, .mid, .bicep, .back, .calf').forEach(function(
                        el) {
                        el.style.display = 'none';
                    });
                } else if (method == 5) {
                    document.querySelectorAll('.chest, .abd, .thigh, .tricep, .sub, .sup, .bicep, .back, .calf')
                        .forEach(function(el) {
                            el.style.display = 'block';
                        });
                    document.querySelectorAll('.navy, .mid').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 6) {
                    document.querySelectorAll('.tricep, .sub, .sup, .bicep').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.navy, .chest, .abd, .thigh, .mid, .back, .calf').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method == 7) {
                    document.querySelectorAll('.navy').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll(
                        '.neck, .waist, .height-cm, .chest, .abd, .thigh, .tricep, .sub, .sup, .mid, .bicep, .back, .calf'
                        ).forEach(function(el) {
                        el.style.display = 'none';
                    });
                }
            });

            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');



                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                        document.getElementById('hightUnit').value = "ft/in";
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.getElementById('hightUnit').value = "cm";
                    }

                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            var val = document.getElementById('hightUnit').value;
            console.log("aa gya");
            if (val === 'ft/in') {
                document.querySelectorAll('.h_cm').forEach(function(elem) {
                    elem.style.display = 'none';
                });
                document.querySelectorAll('.ft_in').forEach(function(elem) {
                    elem.style.display = 'block';
                });
                document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
            } else {

                document.querySelectorAll('.ft_in').forEach(function(elem) {
                    elem.style.display = 'none';
                });
                document.querySelectorAll('.h_cm').forEach(function(elem) {
                    elem.style.display = 'block';
                });
                document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
            }



            ['click'].forEach(event => {
                document.getElementById('method_info').addEventListener(event, function() {
                    let modal = document.getElementById('method_info_modal');
                    if (modal) {
                        modal.style.display = "flex";
                        modal.style.justifyContent = "center";
                        modal.style.alignItems = "center";
                        modal.style.paddingTop = "0px";

                        var method = document.getElementById('method').value;
                        let title = '';
                        let description = '';

                        if (method == 1) {
                            title = 'U.S. Navy Method';
                            description =
                                'The US Navy method includes the neck, waist, and hip circumference measurements to estimate the body fat percentage. To measure the body parts, use a flexible tape.';
                        } else if (method == 2) {
                            title = 'Jackson-Pollock 7 (Fat Caliper)';
                            description =
                                'This method includes measuring the thickness of subcutaneous fat (the fat just beneath the skin) at seven specific locations on your body. It is done using the calipers.';
                        } else if (method == 3) {
                            title = 'Jackson-Pollock 4 (Fat Caliper)';
                            description =
                                'This method estimates an individual\'s body fat percentage by measuring subcutaneous fat (the fat just beneath the skin).';
                        } else if (method == 4) {
                            title = 'Jackson-Pollock 3 (Fat Caliper)';
                            description =
                                'It is designed to provide a quick and easy assessment of body fat, measuring only three specific sites of the body. The selected measurement sites differ between men and women.';
                        } else if (method == 5) {
                            title = 'Parillo (Fat Caliper)';
                            description =
                                'This method measures nine sites of your body. It is good for individuals with higher muscle mass and lower body fat percentages.';
                        } else if (method == 6) {
                            title = 'Durnin/Wormsley (Fat Caliper)';
                            description =
                                'This method includes measuring skinfold thickness at four specific sites of your body. It is considered applicable to a wide range of individuals.';
                        } else if (method == 7) {
                            title = 'Estimate from BMI';
                            description =
                                'Determine your body fat percentage and body fat weight based on your BMI along with other factors, such as gender, age, weight, and height.';
                        }

                        document.getElementById('method_info_title').textContent = title;
                        document.getElementById('method_info_description').textContent = description;


                    } else {
                        console.error("Modal element not found!");
                    }
                });
            });


            document.querySelectorAll('.btn-close').forEach(function(elem) {
                elem.addEventListener('click', function() {
                    let modal = document.getElementById('method_info_modal');
                    if (modal) {
                        modal.style.display = "none";
                    } else {
                        console.error("Modal element not found!");
                    }
                });

                document.getElementById('method_info_modal').addEventListener('click', function(event) {
                    let modalContent = document.querySelector('.modal-content');
                    if (modalContent && !modalContent.contains(event.target)) {
                        this.style.display = "none"; // Hide the modal
                    }
                });

                document.getElementById('image_modal').addEventListener('click', function(event) {
                    let modalContent = document.querySelector('.modal-content');
                    if (modalContent && !modalContent.contains(event.target)) {
                        this.style.display = "none"; // Hide the modal
                    }
                });

            });

            function imgmodal(input) {
                let modal = document.getElementById('image_modal');
                if (!modal) {
                    console.error("Modal element not found!");
                    return;
                }

                let gender = document.querySelector('input[name="gender"]:checked');
                if (!gender) {
                    console.error("Gender not selected");
                    return;
                }

                let imgsrc = (gender.value === 'Male') ?
                    "/assets/man/man_" + input + ".png" :
                    "/assets/women/women_" + input + ".png";

                let img = document.getElementById('method_info_image');
                if (img) {
                    img.src = imgsrc;
                } else {
                    console.error("Image element not found!");
                }

                let descriptions = {
                    chest: {
                        Male: "You should pinch diagonally, about halfway between the armpit and the nipple.",
                        Female: "You should pinch diagonally, about one-third of the way between the armpit and the nipple."
                    },
                    mid: {
                        Male: "Raise your arm and take a vertical pinch just below nipple level on the midaxillary line that goes downward from the center of the armpit.",
                        Female: "Raise your arm and take a vertical pinch just below nipple level on the midaxillary line that goes downward from the center of the armpit."
                    },
                    tri: {
                        Male: "Raise your arm and take a vertical pinch just below nipple level on the midaxillary line, which goes directly downward from the center of the armpit.",
                        Female: "Raise your arm and take a vertical pinch just below nipple level on the midaxillary line, which goes directly downward from the center of the armpit."
                    },
                    sub: {
                        Male: "You should take a diagonal pinch at a 45-degree angle, 1 to 2 cm below the bottom point of the shoulder blade.",
                        Female: "You should take a diagonal pinch at a 45-degree angle, 1 to 2 cm below the bottom point of the shoulder blade."
                    },
                    sup: {
                        Male: "You should take a diagonal pinch above the front protrusion of the hip bone, slightly toward the front from the side of the waist.",
                        Female: "You should take a diagonal pinch above the front protrusion of the hip bone, slightly toward the front from the side of the waist."
                    },
                    abd: {
                        Male: "Take a vertical pinch about 2.5 cm or 1 inch from your belly button.",
                        Female: "Take a vertical pinch about 2.5 cm or 1 inch from your belly button."
                    },
                    thigh: {
                        Male: "Pinch vertically on the front surface of the thigh, midway between the knee and hip.",
                        Female: "Pinch vertically on the front surface of the thigh, midway between the knee and hip."
                    },
                    bi: {
                        Male: "Pinch vertically on the front side of the middle upper arm, directly over the bicep muscle. Keep your arm relaxed.",
                        Female: "Pinch vertically on the front side of the middle upper arm, directly over the bicep muscle. Keep your arm relaxed."
                    }
                };

                let des = document.getElementById('image_info_description');

                des.textContent = descriptions[input] && descriptions[input][gender.value] ?
                    descriptions[input][gender.value] :
                    "Description not available.";


                modal.style.display = "flex";
                modal.style.justifyContent = "center";
                modal.style.alignItems = "center";
                modal.style.paddingTop = "0px";
            }
        </script>
    @endpush
</form>
