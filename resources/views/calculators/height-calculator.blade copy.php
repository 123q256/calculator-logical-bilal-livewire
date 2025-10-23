<style>
    .pacetabs {
        left: 16.6%;
    }

    @media (max-width: 991px) {
        .pacetabs {
            left: 0;
        }
    }

    @media (max-width: 380px) {
        .calculator-box {
            padding-right: 0rem;
            padding-left: 0rem;
        }

        .font-s-14 {
            font-size: 12px;
        }
    }

    .velocitytab .v_active {
        border-bottom: 3px solid var(--light-blue);
    }

    .veloTabs:hover {
        background: #dcdcdc73;
    }

    .velocitytab .v_active strong {
        color: var(--light-blue);
    }

    .velocitytab p {
        position: relative;
        top: 2px
    }

    input[type="date"],
    input[type="time"] {
        min-width: 85%;
        margin: 0px auto;
    }

    .gap-10 {
        gap: 20px;
    }
</style>

<style>
    .example {
        cursor: pointer;
    }

    .new_textArea {
        outline: none;
        border: none;
        resize: none;
        overflow: hidden;
        width: 100%;
        font-size: 15px;
        box-sizing: border-box;
        line-height: 1.5;
        letter-spacing: .5px;
        background-color: #f5f5f5;
        max-width: 635px;
    }

    .new_textArea:empty::before {
        content: attr(aria-placeholder);
        color: gray;
        opacity: 0.6;
    }

    .icon_animation {
        display: inline-block;
        position: relative;
        width: 100%;
        height: 80px;
    }

    .icon_animation samp {
        display: inline-block;
        position: absolute;
        left: 0;
        /* Adjusted to start from the left edge */
        background: #EEF1F5;
        animation: icon_animation 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        height: 8px;
    }

    .main_area .icon_sty:hover .icon_animation samp {
        background: #fff;
    }

    .icon_animation samp:nth-child(1) {
        top: 10px;
        animation-delay: -0.24s;
    }

    .icon_animation samp:nth-child(2) {
        top: 28px;
        left: 0;
        /* Starts from the left edge */
        animation-delay: -0.12s;
    }

    .icon_animation samp:nth-child(3) {
        top: 47px;
        animation-delay: 0s;
    }

    .icon_animation samp:nth-child(4) {
        top: 66px;
        /* Adjusted for 4th element */
        animation-delay: 0.12s;
        /* Slightly delayed */
    }

    .icon_animation samp:nth-child(5) {
        top: 85px;
        /* Adjusted for 5th element */
        animation-delay: 0.24s;
        /* Further delayed */
    }

    @keyframes icon_animation {
        0% {
            left: 0;
            width: 0;
        }

        50%,
        100% {
            left: 0;
            /* Stays at the left edge */
            width: 100%;
            /* Expands to full width */
        }
    }

    #responseContainer {
        line-height: 2
    }

    #responseContainer ol,
    #responseContainer ul {
        padding-left: 20px
    }

    .mere_li p,
    .mere_li li:not(:has(p)) {
        font-size: 17px;
        letter-spacing: .5px;
        line-height: 1.5;
        color: #000000;
    }

    .mere_li p:not(:first-child),
    .mere_li ol p,
    .mere_li ul p,
    .mere_li li:not(:has(p)) {
        margin-top: 12px;
    }

    #responseContainer ol,
    #responseContainer ul {
        padding-left: 20px
    }

    #responseContainer h3,
    #responseContainer h2 {
        font-size: 18px;
        font-weight: 600 !important;
        margin-top: 12px;
        letter-spacing: .5px;
        line-height: 1.5;
        color: #1670a7;
    }
</style>

<style>
    /* Scroll Wrapper */
    .scroll-wrapper {
        overflow-x: auto;
        width: 100%;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        width: 100%;
        min-width: 100%;
        /* Remove fixed min-width */
        margin: 0 auto;
        font-family: Arial, sans-serif;
        background-color: white;
        padding: 5px 10px;
        /* Reduced padding for small screens */
        border-radius: 10px;
    }

    /* Chart Line */
    .chart-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #d8d8d8;
        padding: 5px 0;
    }

    .chart-line span {
        font-size: 14px;
    }

    .chart-line:last-child {
        border-bottom: none;
        margin-bottom: 10px;
    }

    .cm {
        text-align: left;
    }

    .ft-in {
        text-align: right;
    }

    /* Person Images */
    .person-image {
        position: absolute;
        bottom: 5px;
        z-index: 1;
        object-fit: contain;
    }

    /* Person Labels */
    .person-label {
        position: absolute;
        left: 50%;
        bottom: 100%;
        transform: translateX(-50%);
        font-weight: bold;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 4px 8px;
        border-radius: 5px;
        white-space: nowrap;
    }

    /* Image Positioning */
    .child-image {
        left: 28%;
    }

    .father-image {
        left: 45%;
    }

    .mother-image {
        left: 61%;
    }

    .image_text {
        position: absolute;
        left: 50%;
        bottom: 0;
        background-color: #b6b6b6;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .mother {
        left: 62%
    }

    .child {
        left: 30%
    }

    .father {
        left: 47%
    }

    /* Loader */
    .loader {
        width: 50px;
        height: 50px;
        border: 5px solid #ffffff;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: block;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .chart-container {
            padding: 5px;
            /* Further reduce padding */
        }

        .chart-line span {
            font-size: 12px;
            /* Smaller font size for small screens */
        }

        .image_text {
            font-size: 12px;
            /* Smaller font size for labels */
        }

        .person-image {
            width: 40px;
            /* Reduce image size */
            bottom: 3px;
        }

        .loader {
            left: 40%;
            top: 40%;
        }
    }

    @media (max-width: 480px) {
        .chart-line {
            padding: 3px 0;
            /* Reduce padding */
        }

        .chart-line span {
            font-size: 10px;
            /* Even smaller font size */
        }

        .image_text {
            font-size: 10px;
            /* Smaller font size for labels */
            padding: 3px 6px;
            /* Reduce padding */
        }

        .person-image {
            width: 30px;
            /* Further reduce image size */
            bottom: 3px;
        }

        .loader {
            left: 40%;
            top: 40%;
        }
    }

    .text-orange {
        color: #ff4500c4;
    }

    .font-s-38 {
        font-size: 38px;
    }

    .font-s-22 {
        font-size: 22px;
    }
</style>


<style>
    /* Scroll Wrapper */
    .scroll-wrapper {
        overflow-x: auto;
        width: 100%;
    }

    /* Chart Container */
    .chart-container-2 {
        position: relative;
        width: 100%;
        min-width: 100%;
        /* Remove fixed min-width */
        margin: 0 auto;
        font-family: Arial, sans-serif;
        background-color: white;
        padding: 5px 10px;
        /* Reduced padding for small screens */
        border-radius: 10px;
    }

    /* Chart Line */
    .chart-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #d8d8d8;
        padding: 5px 0;
    }

    .chart-line span {
        font-size: 14px;
    }

    .chart-line:last-child {
        border-bottom: none;
        margin-bottom: 10px;
    }

    .cm {
        text-align: left;
    }

    .ft-in {
        text-align: right;
    }

    /* Person Images */
    .person-image-2 {
        position: absolute;
        bottom: 5px;
        z-index: 1;
        object-fit: contain;
    }

    /* Person Labels */
    .image_text-2 {
        position: absolute;
        left: 50%;
        bottom: 100%;
        transform: translateX(-50%);
        font-weight: bold;
        background: #b6b6b6;
        color: #fff;
        padding: 4px 8px;
        border-radius: 5px;
        white-space: nowrap;
    }

    /* Image Positioning */
    .girl-image-2 {
        left: 21%;
    }

    .boy-image-2 {
        left: 35%;
    }

    .father-image-2 {
        left: 51%;
    }

    .mother-image-2 {
        left: 67%;
    }

    .girl-2 {
        left: 27%;
    }

    .boy-2 {
        left: 40%;
    }

    .father-2 {
        left: 56%;
    }

    .mother-2 {
        left: 73%;
    }

    /* Loader */
    .loader {
        height: 50px;
        border: 5px solid #ffffff;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: block;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .chart-container-2 {
            padding: 5px;
            /* Further reduce padding */
        }

        .chart-line span {
            font-size: 12px;
            /* Smaller font size for small screens */
        }

        .image_text-2 {
            font-size: 12px;
            /* Smaller font size for labels */
        }

        .person-image-2 {
            width: 40px;
            /* Reduce image size */
            bottom: 3px;
        }

        .loader {
            left: 40%;
            top: 40%;
        }
    }

    @media (max-width: 480px) {
        .chart-line {
            padding: 3px 0;
            /* Reduce padding */
        }

        .chart-line span {
            font-size: 10px;
            /* Even smaller font size */
        }

        .image_text-2 {
            font-size: 10px;
            /* Smaller font size for labels */
            padding: 3px 6px;
            /* Reduce padding */
        }

        .person-image-2 {
            width: 30px;
            /* Further reduce image size */
            bottom: 3px;
        }

        .loader {
            left: 40%;
            top: 40%;
        }
    }
</style>

<form class="row relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless (isset($detail))
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 mb-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif


            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 mx-auto px-2">
                        <div class="{{ $device == 'mobile' ? 'font-s-12' : '' }} velocitytab relative">
                            <p class="ms-1 mb-1 text-blue font-s-14">Select Method</p>
                            <div class="py-2 relative">
                                <select name="calculator_select" id="calculator_select"
                                    class="form-select input-select input cursor-pointer p-2 {{ $device == 'mobile' ? 'font-s-12' : '' }} border-b-dark"
                                    style="width: auto; display: inline-block; white-space: nowrap;">
                                    @if (app()->getLocale() != 'id')
                                        <option value="calculator1"
                                            {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] !== 'calculator2' ? 'selected' : '' }}>
                                            The Khamis-Roche Height Predictor
                                        </option>
                                    @endif
                                    <option value="calculator2"
                                        {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'calculator2' ? 'selected' : '' }}>
                                        {{ $lang['3'] }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">

                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                    <input type="hidden" name="calculator_n" value="calculator1" id="calculator_n">
                    <div class="col-span-6 calculators calculator1 ">
                        <label for="age" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select name="age" id="age" class="input">
                                @php
                                    function optionsList($arr1, $arr2, $unit)
                                    {
                                        foreach ($arr1 as $index => $name) {
                                            echo '<option value="' .
                                                $name .
                                                '"' .
                                                (isset($unit) && $name === $unit ? ' selected' : '') .
                                                '>' .
                                                $arr2[$index] .
                                                '</option>';
                                        }
                                    }
                                    $name = [
                                        '4',
                                        '4.5',
                                        '5',
                                        '5.5',
                                        '6',
                                        '6.5',
                                        '7',
                                        '7.5',
                                        '8',
                                        '8.5',
                                        '9',
                                        '9.5',
                                        '10',
                                        '10.5',
                                        '11',
                                        '11.5',
                                        '12',
                                        '12.5',
                                        '13',
                                        '13.5',
                                        '14',
                                        '14.5',
                                        '15',
                                        '15.5',
                                        '16',
                                        '16.5',
                                        '17',
                                        '17.5',
                                    ];
                                    $val = [
                                        '4',
                                        '4.5',
                                        '5',
                                        '5.5',
                                        '6',
                                        '6.5',
                                        '7',
                                        '7.5',
                                        '8',
                                        '8.5',
                                        '9',
                                        '9.5',
                                        '10',
                                        '10.5',
                                        '11',
                                        '11.5',
                                        '12',
                                        '12.5',
                                        '13',
                                        '13.5',
                                        '14',
                                        '14.5',
                                        '15',
                                        '15.5',
                                        '16',
                                        '16.5',
                                        '17',
                                        '17.5',
                                    ];
                                    optionsList($val, $name, isset(request()->age) ? request()->age : '4.5');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6 px-2 ps-lg-4">
                        <label for="gender" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select name="gender" id="gender" class="input">
                                @php
                                    $name = [$lang['7'], $lang['8']];
                                    $val = ['0', '1'];
                                    optionsList($val, $name, isset(request()->gender) ? request()->gender : '0');
                                @endphp
                            </select>
                        </div>
                    </div>

                    <div class="col-span-6 ft_in_child">
                        <label for="c-height-ft" class="font-s-14 text-blue">{!! $lang['10'] !!}:</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="c-height-ft" id="c-height-ft" class="input me-2"
                                aria-label="input" placeholder="ft"
                                value="{{ isset(request()->c_height_ft) ? request()->c_height_ft : 3 }}" />
                            <input type="number" step="any" name="c-height-in" id="c-height-in" class="input"
                                aria-label="input"
                                value="{{ isset(request()->c_height_in) ? request()->c_height_in : 1 }}" />
                            <label for="c-unit_h" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->c_unit_h) ? request()->c_unit_h : 'ft/in' }} ▾
                            </label>
                            <input type="text" name="c-unit_h"
                                value="{{ isset(request()->c_unit_h) ? request()->c_unit_h : 'ft/in' }}" id="c-unit_h"
                                class="d-none" />
                            <div class="units units_ft_in_child c-unit_h d-none" to="c-unit_h">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 h_cm_child d-none height-cm">
                        <label for="c-height-cm" class="font-s-14 text-blue">{{ $lang['10'] }} (cm):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="c-height-cm" id="c-height-cm" class="input"
                                aria-label="input" placeholder="cm"
                                value="{{ isset(request()->c_height_cm) ? request()->c_height_cm : 180 }}" />
                            <label for="c-unit_h_cm"
                                class="text-blue input-unit text-decoration-underline">{{ isset(request()->c_unit_h_cm) ? request()->c_unit_h_cm : 'cm' }}
                                ▾</label>
                            <input type="text" name="c-unit_h_cm"
                                value="{{ isset(request()->c_unit_h_cm) ? request()->c_unit_h_cm : 'cm' }}"
                                id="c-unit_h_cm" class="d-none" />
                            <div class="units units_ft_in_child c-unit_h_cm d-none" to="c-unit_h_cm">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="child_unit" id="child_unit"
                        value="{{ isset(request()->c_unit_h) ? request()->c_unit_h : 'ft/in' }}">

                    <div class="col-span-6 ps-lg-4 imperial_weight lbs_c">
                        <label for="c-weight-lbs-c" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="c-weight-lbs" id="c-weight-lbs-c" class="input"
                                aria-label="input" placeholder="lbs"
                                value="{{ isset(request()->c_weight_lbs) ? request()->c_weight_lbs : 38 }}" />
                            <label for="c-unit_w_c" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->c_unit_w) ? request()->c_unit_w : 'lbs' }} ▾
                            </label>
                            <input type="text" name="c-unit_w"
                                value="{{ isset(request()->c_unit_w) ? request()->c_unit_w : 'lbs' }}" id="c-unit_w_c"
                                class="d-none" />
                            <div class="units units_weight_c c-unit_w_c d-none" to="c-unit_w_c">
                                <p value="kg">kg</p>
                                <p value="lbs">lbs</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 ps-lg-4 metric_weight kg_c d-none">
                        <label for="c-weight-kg-c" class="font-s-14 text-blue">{!! $lang['11'] !!} (kg):</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="c-weight-kg" id="c-weight-kg-c" class="input"
                                aria-label="input" placeholder="kg"
                                value="{{ isset(request()->c_weight_kg) ? request()->c_weight_kg : 17.2 }}" />
                            <label for="c-unit_w_kg_c" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->c_unit_w_kg) ? request()->c_unit_w_kg : 'kg' }} ▾
                            </label>
                            <input type="text" name="c-unit_w_kg"
                                value="{{ isset(request()->c_unit_w_kg) ? request()->c_unit_w_kg : 'kg' }}"
                                id="c-unit_w_kg_c" class="d-none" />
                            <div class="units units_weight_c c-unit_w_kg_c d-none" to="c-unit_w_kg_c">
                                <p value="kg">kg</p>
                                <p value="lbs">lbs</p>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="mother_1_unit" value="ft/in" id="mother_1_unit">
                    <div class="col-span-6 imperial_input ft_in_m">
                        <label for="m-height-ft-m" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="m-height-ft" id="m-height-ft-m"
                                class="input me-2" aria-label="input" placeholder="ft"
                                value="{{ isset(request()->m_height_ft) ? request()->m_height_ft : 5 }}" />
                            <input type="number" step="any" name="m-height-in" id="m-height-in-m" class="input"
                                aria-label="input" placeholder="in"
                                value="{{ isset(request()->m_height_in) ? request()->m_height_in : 5 }}" />
                            <label for="m-unit_h_m" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->m_unit_h) ? request()->m_unit_h : 'ft/in' }} ▾
                            </label>
                            <input type="text" name="m-unit_h_m"
                                value="{{ isset(request()->m_unit_h) ? request()->m_unit_h : 'ft/in' }}" id="m-unit_h_m"
                                class="d-none" />
                            <div class="units units_ft_in_m m-unit_h_m d-none" to="m-unit_h_m">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 metric_input h_cm_m d-none">
                        <label for="m-height-cm-m" class="font-s-14 text-blue">{!! $lang['4'] !!} (cm):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="m-height-cm" id="m-height-cm-m" class="input"
                                aria-label="input" placeholder="cm"
                                value="{{ isset(request()->m_height_cm) ? request()->m_height_cm : 166 }}" />
                            <label for="m-unit_h_cm_m" class="text-blue input-unit text-decoration-underline">
                                {{ isset(request()->m_unit_h_cm) ? request()->m_unit_h_cm : 'cm' }} ▾
                            </label>
                            <input type="text" name="m-unit_h_cm"
                                value="{{ isset(request()->m_unit_h_cm) ? request()->m_unit_h_cm : 'cm' }}"
                                id="m-unit_h_cm_m" class="d-none" />
                            <div class="units units_ft_in_m m-unit_h_cm_m d-none" to="m-unit_h_cm_m">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="father_1_unit" value="ft/in" id="father_1_unit">

                    <div class="col-span-6 ps-lg-4 imperial_input ft_in_f">
                        <label for="f-height-ft-f" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="f-height-ft" id="f-height-ft-f"
                                class="input me-2" aria-label="input" placeholder="ft"
                                value="{{ isset(request()->f_height_ft) ? request()->f_height_ft : 5 }}" />
                            <input type="number" step="any" name="f-height-in" id="f-height-in-f" class="input"
                                aria-label="input" placeholder="in"
                                value="{{ isset(request()->f_height_in) ? request()->f_height_in : 9 }}" />
                            <label for="f-unit_h_f" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->f_unit_h) ? request()->f_unit_h : 'ft/in' }} ▾
                            </label>
                            <input type="text" name="f-unit_h"
                                value="{{ isset(request()->f_unit_h) ? request()->f_unit_h : 'ft/in' }}" id="f-unit_h_f"
                                class="d-none" />
                            <div class="units units_ft_in_f f-unit_h_f d-none" to="f-unit_h_f">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 ps-lg-4 metric_input h_cm_f d-none">
                        <label for="f-height-cm-f" class="font-s-14 text-blue">{!! $lang['5'] !!} (cm):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="f-height-cm" id="f-height-cm-f" class="input"
                                aria-label="input" placeholder="cm"
                                value="{{ isset(request()->f_height_cm) ? request()->f_height_cm : 176 }}" />
                            <label for="f-unit_h_cm_f" class="text-blue input-unit text-decoration-underline">
                                {{ isset(request()->f_unit_h_cm) ? request()->f_unit_h_cm : 'cm' }} ▾
                            </label>
                            <input type="text" name="f-unit_h_cm"
                                value="{{ isset(request()->f_unit_h_cm) ? request()->f_unit_h_cm : 'cm' }}"
                                id="f-unit_h_cm_f" class="d-none" />
                            <div class="units units_ft_in_f f-unit_h_cm_f d-none" to="f-unit_h_cm_f">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 calculators calculator2  {{ app()->getLocale() == 'id' ? 'd-block' : 'd-none' }}">
                <div class="row">
                    {{-- Mother height --}}
                    <div class="col-span-6 col-12 ft_in">
                        <label for="m-height-ft" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="m-height-ft" id="m-height-ft" class="input me-2"
                                aria-label="input" placeholder="ft"
                                value="{{ isset(request()->m_height_ft) ? request()->m_height_ft : 5 }}" />
                            <input type="number" step="any" name="m-height-in" id="m-height-in" class="input"
                                aria-label="input"
                                value="{{ isset(request()->m_height_in) ? request()->m_height_in : 9 }}" />
                            <label for="m-unit_h" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->m_unit_h) ? request()->m_unit_h : 'ft/in' }} ▾
                            </label>
                            <input type="text" name="m-unit_h"
                                value="{{ isset(request()->m_unit_h) ? request()->m_unit_h : 'ft/in' }}" id="m-unit_h"
                                class="d-none">
                            <div class="units units_ft_in m-unit_h d-none" to="m-unit_h">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 px-md-2 h_cm d-none height-cm">
                        <label for="height-cm" class="font-s-14 text-blue">{{ $lang['4'] }} (cm):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="height-cm" id="height-cm" class="input"
                                aria-label="input" placeholder="cm"
                                value="{{ isset(request()->m_height_cm) ? request()->m_height_cm : 175 }}" />
                            <label for="m-unit_h_cm"
                                class="text-blue input-unit text-decoration-underline">{{ isset(request()->m_unit_h_cm) ? request()->m_unit_h_cm : 'cm' }}
                                ▾</label>
                            <input type="text" name="m-unit_h_cm"
                                value="{{ isset(request()->m_unit_h_cm) ? request()->m_unit_h_cm : 'cm' }}"
                                id="m-unit_h_cm" class="d-none">
                            <div class="units units_ft_in m-unit_h_cm d-none" to="m-unit_h_cm">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    {{-- Hidden field for mother entry unit --}}
                    <input type="hidden" name="mother_entry_unit" id="mother_entry_unit"
                        value="{{ isset(request()->mother_entry_unit) ? request()->mother_entry_unit : 'ft/in' }}">

                    {{-- Father height --}}
                    <div class="col-span-6 col-12 ps-lg-4 ft_in_father">
                        <label for="f-height-ft" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                        <div class="flex w-100 py-2 relative">
                            <input type="number" step="any" name="f-height-ft" id="f-height-ft" class="input me-2"
                                aria-label="input" placeholder="ft"
                                value="{{ isset(request()->f_height_ft) ? request()->f_height_ft : 5 }}" />
                            <input type="number" step="any" name="f-height-in" id="f-height-in" class="input"
                                aria-label="input"
                                value="{{ isset(request()->f_height_in) ? request()->f_height_in : 9 }}" />
                            <label for="f-unit_h" class="text-blue input-unit text-decoration-underline ms-2">
                                {{ isset(request()->f_unit_h) ? request()->f_unit_h : 'ft/in' }} ▾
                            </label>
                            <input type="text" name="f-unit_h"
                                value="{{ isset(request()->f_unit_h) ? request()->f_unit_h : 'ft/in' }}" id="f-unit_h"
                                class="d-none">
                            <div class="units units_ft_in_father f-unit_h d-none" to="f-unit_h">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 px-md-2 h_cm_father d-none height-cm">
                        <label for="f-height-cm" class="font-s-14 text-blue">{{ $lang['5'] }} (cm):</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="f-height-cm" id="f-height-cm" class="input"
                                aria-label="input" placeholder="cm"
                                value="{{ isset(request()->f_height_cm) ? request()->f_height_cm : 180 }}" />
                            <label for="f-unit_h_cm"
                                class="text-blue input-unit text-decoration-underline">{{ isset(request()->f_unit_h_cm) ? request()->f_unit_h_cm : 'cm' }}
                                ▾</label>
                            <input type="text" name="f-unit_h_cm"
                                value="{{ isset(request()->f_unit_h_cm) ? request()->f_unit_h_cm : 'cm' }}"
                                id="f-unit_h_cm" class="d-none">
                            <div class="units units_ft_in_father f-unit_h_cm d-none" to="f-unit_h_cm">
                                <p value="cm">cm</p>
                                <p value="ft/in">ft/in</p>
                            </div>
                        </div>
                    </div>

                    {{-- Hidden field for father entry unit --}}
                    <input type="hidden" name="father_entry_unit" id="father_entry_unit"
                        value="{{ isset(request()->father_entry_unit) ? request()->father_entry_unit : 'ft/in' }}">
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    @else
        <div class="col-12 bg-light-blue result result_calculator radius-10 p-lg-3 p-2 ">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="col-12">
                @if ($detail['submit'] === 'calculator1')
                    <div class="col-12  radius-10 p-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class=" {{ $device == 'mobile' ? 'font-s-15' : 'font-s-22' }}  me-1">Estimated
                                Height:</span>
                            <strong
                                class="text-orange {{ $device == 'mobile' ? 'font-s-22' : 'font-s-38' }}">{{ $detail['final_ans'] }}</strong>
                        </div>
                    </div>


                    <div class="col-12 mt-3">
                        <strong class="font-s-18 text-blue ms-1">Height comparison chart:</strong>

                        @php
                            $finalAns = $detail['final_ans'];

                            // Check if final_ans is in "ft in" or "cm" format
                            if (preg_match('/(\d+)ft\s*(\d+)in/', $finalAns, $matches)) {
                                // Format is "ft in" (e.g., "8ft 7in")
                                $feet = (int) $matches[1];
                                $inches = (int) $matches[2];
                                $child_h = $feet * 30.48 + $inches * 2.54; // Convert to cm
                            } elseif (preg_match('/(\d+)\s*cm/', $finalAns, $matches)) {
                                // Format is "cm" (e.g., "165 cm")
                                $child_h = (int) $matches[1]; // Directly use cm value
                            } else {
                                // Fallback in case format is unexpected
                                $child_h = 0; // Or set a default value/error handling
                            }

                            $father_h = $detail['father_h']; // Assuming this is in cm
                            $mother_h = $detail['mother_h']; // Assuming this is in cm

                            // Determine the max height person
                            $maxHeightCM = max($child_h, $father_h, $mother_h);

                            // Chart height range based on max height
                            $range = 150;
                            $start = max(0, $maxHeightCM - $range);
                            $end = $maxHeightCM + $range;
                            $step = 15; // Default step for large screens
                            $test = 0;

                            // Adjust step for small screens
                            if (
                                isset($_SERVER['HTTP_USER_AGENT']) &&
                                preg_match(
                                    '/(Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini)/i',
                                    $_SERVER['HTTP_USER_AGENT'],
                                )
                            ) {
                                $step = 30; // Larger step for fewer lines on small screens
                            }
                        @endphp

                        <!-- Scroll Wrapper for Small Screens -->
                        <div class="scroll-wrapper mt-2">
                            <div class="chart-container">
                                <div class="chart-line ">
                                    <strong class="cm">cm</strong>
                                    <strong class="ft-in">ft/in</strong>
                                </div>
                                @for ($i = $end; $i >= $start; $i -= $step)
                                    @php
                                        $cmRounded = round($i);
                                        $feetChart = floor($cmRounded / 30.48);
                                        $inchesChart = round(($cmRounded / 30.48 - $feetChart) * 12, 1);

                                        if ($test == 0 || $test == 1) {
                                            $test++;
                                            continue;
                                        } else {
                                            $test++;
                                        }
                                    @endphp

                                    <div
                                        class="chart-line {{ round($i, 2) == round($maxHeightCM, 2) ? 'highlight' : '' }}">
                                        <span class="cm">{{ $cmRounded }}</span>
                                        <span class="ft-in">
                                            {{ $feetChart }}' {{ $inchesChart }}''
                                        </span>
                                    </div>
                                @endfor
                                <div class="loader"></div> <!-- Loader -->
                                <div class="imgs-container d-none">
                                    @if ($detail['gender'] == 0)
                                        <img src="{{ asset('assets/new-icon/son.svg') }}" alt="Child"
                                            class="person-image child-image">
                                    @else
                                        <img src="{{ asset('assets/new-icon/daughter.svg') }}" alt="Child"
                                            class="person-image child-image">
                                    @endif
                                    <img src="{{ asset('assets/new-icon/father.svg') }}" alt="Father"
                                        class="person-image father-image">
                                    <img src="{{ asset('assets/new-icon/mother.svg') }}" alt="Mother"
                                        class="person-image mother-image">

                                    <p class="image_text child">{{ $detail['gender'] == 0 ? 'Boy' : 'Girl' }}</p>
                                    <p class="image_text father">Father</p>
                                    <p class="image_text mother">Mother</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border  radius-20 p-3 mt-2 border-white d-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/new-icon/blube.png') }}" width="25" alt="">
                                <b class="ms-2 font-s-15">Tips For Health Growth</b>
                            </div>
                            <div class="ms-2">
                                <div class="d-flex mt-3 align-items-center">
                                    <img src="{{ asset('assets/new-icon/arrow.png') }}" width="15" alt="">
                                    <p class="ms-2 font-s-15">Maintain a Balanced Diet: Eat nutrient-rich foods, especially
                                        those high in calcium, protein, and vitamins
                                    </p>
                                </div>
                                <div class="d-flex mt-3 align-items-center">
                                    <img src="{{ asset('assets/new-icon/arrow.png') }}" width="15" alt="">
                                    <p class="ms-2 font-s-15">Get Enough Sleep: Try to have 8 -10 hours of sleep daily
                                    </p>
                                </div>
                                <div class="d-flex mt-3 align-items-center">
                                    <img src="{{ asset('assets/new-icon/arrow.png') }}" width="15" alt="">
                                    <p class="ms-2 font-s-15">Engage in Regular Exercise & Stretching: Performing regular
                                        exercise and stretching improves the posture and flexibility of your body</p>
                                </div>
                                <div class="d-flex mt-3 align-items-center">
                                    <img src="{{ asset('assets/new-icon/arrow.png') }}" width="15" alt="">
                                    <p class="ms-2 font-s-15">Maintain Good Posture: Avoid sitting, standing, or walking
                                        with your shoulders and back curved forward in a bent or lazy posture
                                    </p>
                                </div>
                                <div class="d-flex mt-3 align-items-center">
                                    <img src="{{ asset('assets/new-icon/arrow.png') }}" width="15" alt="">
                                    <p class="ms-2 font-s-15">Stay Active and Spend Some Time in the Sun: It will increase
                                        vitamin D production, which is essential for bone growth
                                    </p>
                                </div>
                                <div class="d-flex mt-3 align-items-center">
                                    <img src="{{ asset('assets/new-icon/arrow.png') }}" width="15" alt="">
                                    <p class="ms-2 font-s-15">Adopt a Healthy Lifestyle: Don't eat junk food, avoid smoking
                                        and caffeine, as they impact growth and bone health
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-6 px-md-3 py-2">
                            <div class="d-flex flex-wrap align-items-center  border radius-10 p-3">
                                <strong class="me-2">{!! $lang[14] !!} =</strong>
                                <strong
                                    class="text-orange {{ $device == 'mobile' ? 'font-s-22' : 'font-s-28' }}"><span>{{ $detail['final_ans_boy'] }}</span><span
                                        class="ms-1">{{ $detail['father_entry_unit'] == 'cm' ? 'cm' : '' }}</span></strong>
                            </div>
                        </div>
                        <div class="col-lg-6 px-md-3 py-2">
                            <div class="d-flex flex-wrap align-items-center  border radius-10 p-3">
                                <strong class="me-2">{!! $lang[13] !!} =</strong>
                                <strong
                                    class="text-orange {{ $device == 'mobile' ? 'font-s-22' : 'font-s-28' }}"><span>{{ $detail['final_ans_girl'] }}</span><span
                                        class="ms-1">{{ $detail['father_entry_unit'] == 'cm' ? 'cm' : '' }}</span></strong>
                            </div>
                        </div>
                    </div>
                    {{-- second chart --}}

                    <div class="col-12 mt-3">
                        <strong class="font-s-18 text-blue ms-1">Height Comparison Chart:</strong>

                        @php
                            $girls_height = $detail['girls_height'];
                            $boys_height = $detail['boys_height'];
                            $mother_height = $detail['mother_height'];
                            $father_height = $detail['father_height'];

                            // Determine the max height person
                            $maxHeightCM = max($girls_height, $boys_height, $mother_height, $father_height);

                            // Chart height range based on max height
                            $range = 150;
                            $start = max(0, $maxHeightCM - $range);
                            $end = $maxHeightCM + $range;
                            $step = 15; // Default step for large screens
                            $test = 0;

                            // Adjust step for small screens
                            if (
                                isset($_SERVER['HTTP_USER_AGENT']) &&
                                preg_match(
                                    '/(Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini)/i',
                                    $_SERVER['HTTP_USER_AGENT'],
                                )
                            ) {
                                $step = 30; // Larger step for fewer lines on small screens
                            }
                        @endphp

                        <!-- Scroll Wrapper for Small Screens -->
                        <div class="scroll-wrapper mt-2">
                            <div class="chart-container-2">
                                <div class="chart-line">
                                    <strong class="cm">cm</strong>
                                    <strong class="ft-in">ft/in</strong>
                                </div>
                                @for ($i = $end; $i >= $start; $i -= $step)
                                    @php
                                        $cmRounded = round($i);
                                        $feetChart = floor($cmRounded / 30.48);
                                        $inchesChart = round(($cmRounded / 30.48 - $feetChart) * 12, 1);

                                        if ($test == 0 || $test == 1) {
                                            $test++;
                                            continue;
                                        } else {
                                            $test++;
                                        }
                                    @endphp

                                    <div
                                        class="chart-line {{ round($i, 2) == round($maxHeightCM, 2) ? 'highlight' : '' }}">
                                        <span class="cm">{{ $cmRounded }}</span>
                                        <span class="ft-in">
                                            {{ $feetChart }}' {{ $inchesChart }}''
                                        </span>
                                    </div>
                                @endfor
                                <div class="loader"></div> <!-- Loader -->
                                <div class="imgs-container-2 d-none">
                                    <img src="{{ asset('assets/new-icon/daughter.svg') }}" alt="Girl"
                                        class="person-image-2 girl-image-2">
                                    <img src="{{ asset('assets/new-icon/son.svg') }}" alt="Boy"
                                        class="person-image-2 boy-image-2">
                                    <img src="{{ asset('assets/new-icon/father.svg') }}" alt="Father"
                                        class="person-image-2 father-image-2">
                                    <img src="{{ asset('assets/new-icon/mother.svg') }}" alt="Mother"
                                        class="person-image-2 mother-image-2">

                                    <p class="image_text-2 girl-2">Girl</p>
                                    <p class="image_text-2 boy-2">Boy</p>
                                    <p class="image_text-2 father-2">Father</p>
                                    <p class="image_text-2 mother-2">Mother</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card border  radius-20 p-3 mt-3 border-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/img/cate_images/ai-tools.png') }}" width="25" alt="">
                            <b class="ms-2 font-s-15 text-blue">{{ $lang['ask_with_ai'] }}</b>
                        </div>

                        @php

                            if ($detail['submit'] === 'calculator1') {
                                $prompts = [
                                    $lang['p-1-1'],
                                    $lang['p-1-2'],
                                    $lang['p-1-3'],
                                    $lang['p-1-4'],
                                    $lang['p-1-5'],
                                    $lang['p-1-6'],
                                ];
                            } else {
                                $prompts = [
                                    $lang['p-2-1'],
                                    $lang['p-2-2'],
                                    $lang['p-2-3'],
                                    $lang['p-2-4'],
                                    $lang['p-2-5'],
                                    $lang['p-2-6'],
                                ];
                            }

                            shuffle($prompts); // Randomize the array
                            $randomPrompts = array_slice($prompts, 0, 3); // Get first 3 random prompts
                        @endphp

                        <div class="propmts">
                            @foreach ($randomPrompts as $prompt)
                                <div class="d-flex mt-3 align-items-center radius-10 prompt-item">
                                    <span class="bg-gray p-2 radius-10 d-flex align-items-center example">
                                        <p class="me-2 font-s-15 m-0">{{ $prompt }}</p>
                                        <img src="{{ asset('assets/new-icon/uparrow.png') }}" width="12"
                                            alt="">
                                    </span>
                                </div>
                            @endforeach
                        </div>


                        <div class="d-flex align-items-center justify-content-between bg-gray mt-3 border radius-10 p-2">
                            <p name="input_name" class="new_textArea p-2" id="input_name"
                                aria-placeholder="Type your message..." contenteditable="true"></p>
                            <img loading="lazy" id="height_ai" class="cursor-pointer"
                                src="{{ asset('assets/new-icon/button.png') }}" width="30" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-12  radius-10 p-3 mt-3 mere_li overflow-auto pt-2 d-none" id="responseContainer">
                    <div class="col-12" id="textEffect">
                        <div class="icon_animation">
                            <samp></samp>
                            <samp></samp>
                            <samp></samp>
                            <samp></samp>
                            <samp></samp>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-[50%] mx-auto text-center my-3">
                <a class="  text-[#fff]  hover:text-white duration-200 font-[600] text-[14px] rounded-[25px] px-4 py-3 relative
                bg-[#2845F5] "
                    href="{{ url()->current() }}/">
                    <button type="button" class="calculate">{{ $lang['reset'] }}</button>
                </a>
            </div>
        </div>

    @endunless






    @push('calculatorJS')
        <script>
            function metric_click(element) {
                document.getElementById('unit_type').value = 'metric';
                element.classList.add('units_active');
                document.querySelector('.imperial').classList.remove('units_active');
                document.querySelectorAll('.imperial_input').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('.metric_input').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.w_unit').forEach(function(el) {
                    el.textContent = ' (kg)';
                });
                document.querySelectorAll('.h_unit').forEach(function(el) {
                    el.textContent = ' (cm)';
                });
                var lbs_to_kg = document.getElementById('c_weight').value;
                if (lbs_to_kg !== "") {
                    var input_kg = Math.round(lbs_to_kg / 2.205, 2);
                    document.getElementById('c_weight').value = input_kg;
                }
                var in_to_cm_child = document.getElementById('c_height').value;
                if (in_to_cm_child !== null) {
                    var input_cm_child = Math.round(in_to_cm_child * 2.54, 2);
                    document.getElementById('c_height_cm').value = input_cm_child;
                }
                var in_to_cm_mother = document.getElementById('m_height').value;
                if (in_to_cm_mother !== null) {
                    var input_cm_mother = Math.round(in_to_cm_mother * 2.54, 2);
                    document.getElementById('m_height_cm').value = input_cm_mother;
                }
                var in_to_cm_father = document.getElementById('f_height').value;
                if (in_to_cm_father !== null) {
                    var input_cm_father = Math.round(in_to_cm_father * 2.54, 2);
                    document.getElementById('f_height_cm').value = input_cm_father;
                }
                var s_in_to_cm_mother = document.getElementById('sm_height').value;
                if (s_in_to_cm_mother !== null) {
                    var s_input_cm_mother = Math.round(s_in_to_cm_mother * 2.54, 2);
                    document.getElementById('sm_height_cm').value = s_input_cm_mother;
                }
                var s_in_to_cm_father = document.getElementById('sf_height').value;
                if (s_in_to_cm_father !== null) {
                    var s_input_cm_father = Math.round(s_in_to_cm_father * 2.54, 2);
                    document.getElementById('sf_height_cm').value = s_input_cm_father;
                }
            }

            function imperial_click(element) {
                document.getElementById('unit_type').value = 'imperial';
                element.classList.add('units_active');
                document.querySelector('.metric').classList.remove('units_active');
                document.querySelectorAll('.imperial_input').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.metric_input').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('.w_unit').forEach(function(el) {
                    el.textContent = ' (lb)';
                });
                document.querySelectorAll('.h_unit').forEach(function(el) {
                    el.textContent = ' (ft/in)';
                });
                var kg_to_lbs = document.getElementById('c_weight').value;
                if (kg_to_lbs !== "") {
                    var input_lbs = Math.round(kg_to_lbs * 2.205, 2);
                    document.getElementById('c_weight').value = input_lbs;
                }
            }
            document.getElementById('calculator_select').addEventListener('change', function() {
                // Get the selected value from the dropdown
                let val = this.value;
                const after_title_line = document.getElementById('after_title_line');

                if (val == 'calculator1') {
                    after_title_line.innerHTML = "{{ $lang['after_title'] }}";
                } else {
                    after_title_line.innerHTML = "{{ $lang['after_title_Des2'] }}";
                }


                // Hide all calculator sections
                document.querySelectorAll('.calculators').forEach(function(calculator) {
                    calculator.style.display = 'none';
                });

                // Show the selected calculator section
                document.querySelector('.' + val).style.display = 'block';

                // Update the hidden input value
                document.getElementById('calculator_name').value = val;
            });
        </script>
        @isset($detail)
            <script src="https://cdn.jsdelivr.net/npm/katex/dist/contrib/auto-render.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/marked@3.0.7/marked.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script type="text/javascript">
                const inputName = document.getElementById("input_name");
                const responseContainer = document.getElementById("responseContainer");
                async function sendMessage() {
                    responseContainer.classList.remove("d-none");
                    document.getElementById("textEffect").classList.remove("d-none");

                    const message = inputName ? inputName.innerText : '';
                    const aiToolName = "{{ $cal_name }}";
                    const aiToolURL = "{{ $page }}";
                    Array.from(responseContainer.children).forEach(child => {
                        if (child.id !== "textEffect") {
                            responseContainer.removeChild(child);
                        }
                    });
                    try {
                        const response = await fetch('/ai-tools/', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message,
                                aiToolName,
                                aiToolURL
                            })
                        });
                        const reader = response.body.getReader();
                        const decoder = new TextDecoder("utf-8");
                        let currentContent = '';
                        const chatGPTMessage = document.createElement("div");
                        chatGPTMessage.className = "message chatgpt-message";
                        responseContainer.appendChild(chatGPTMessage);
                        document.getElementById("textEffect").classList.add("d-none");
                        while (true) {
                            const {
                                done,
                                value
                            } = await reader.read();
                            if (done) break;
                            const chunk = decoder.decode(value, {
                                stream: true
                            });
                            const lines = chunk.split("\n");
                            for (const line of lines) {
                                if (!line || line === "[DONE]") continue;
                                if (line.startsWith("data: ")) {
                                    try {
                                        const jsonString = line.substring(6);
                                        const parsedLine = JSON.parse(jsonString);
                                        const {
                                            choices
                                        } = parsedLine;
                                        const {
                                            delta
                                        } = choices[0];
                                        const {
                                            content
                                        } = delta;
                                        if (content) {
                                            // currentContent += content;
                                            const escapedContent = content.replace(/\\/g, "\\\\");
                                            currentContent += escapedContent;
                                            chatGPTMessage.innerHTML = marked.parse(currentContent);
                                            renderMathInElement(chatGPTMessage, {
                                                delimiters: [{
                                                        left: "\\(",
                                                        right: "\\)",
                                                        display: false
                                                    },
                                                    {
                                                        left: "\\[",
                                                        right: "\\]",
                                                        display: true
                                                    },
                                                    {
                                                        left: "$",
                                                        right: "$",
                                                        display: false
                                                    },
                                                    {
                                                        left: "$$",
                                                        right: "$$",
                                                        display: true
                                                    }
                                                ]
                                            });
                                        }
                                    } catch (e) {
                                        console.error("Error parsing line:", line, e);
                                    }
                                }
                            }
                        }
                        chatGPTMessage.querySelectorAll('.katex').forEach(katexNode => {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'own_katex';
                            katexNode.parentNode.replaceChild(wrapper, katexNode);
                            wrapper.appendChild(katexNode);
                        });
                    } catch (error) {
                        document.getElementById("textEffect").classList.add("d-none");
                        const errorMessage = document.createElement("div");
                        errorMessage.className = "message error-message";
                        errorMessage.textContent = "Error: " + error.message;
                        responseContainer.appendChild(errorMessage);
                    }
                }
                // sendMessage();
                document.getElementById('height_ai').addEventListener('click', function(e) {
                    responseContainer.classList.add("d-none");
                    if (!inputName.innerText) {
                        alert("Please enter text in the field.");
                        return;
                    }
                    sendMessage();
                });

                function showToast(message, bgColor, textColor) {
                    var x = document.getElementById("snackbar");
                    x.innerText = message;
                    x.style.backgroundColor = bgColor;
                    x.style.color = textColor;
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                        // Optionally, reset the styles after the snackbar disappears
                        x.style.backgroundColor = "";
                        x.style.color = "";
                    }, 3000);
                }
                document.addEventListener("DOMContentLoaded", function() {
                    if (window.MathJax) {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub, document.getElementById('calculator-answer')]);
                    }
                });
                document.addEventListener("click", function(event) {
                    if (event.target.closest('.own_katex')) {
                        const katexNode = event.target.closest('.own_katex').querySelector('.katex-mathml');
                        if (katexNode) {
                            const latexCode = katexNode.querySelector('annotation').textContent;
                            navigator.clipboard.writeText(latexCode).then(() => {
                                showToast(`✅ Copied Successfully!`, '#d4edda', '#155724');
                            }).catch(err => {
                                console.error("Failed to copy KaTeX code:", err);
                                showToast(`❌ Failed to copy KaTeX code`, '#f8d7da', '#721c24');
                            });
                        }
                    }
                });
            </script>
        @endisset

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let highlight = document.querySelector(".chart-line.highlight");
                let chartContainer = document.querySelector(".chart-container");
                let childImage = document.querySelector(".child-image");
                let fatherImage = document.querySelector(".father-image");
                let motherImage = document.querySelector(".mother-image");
                let child = document.querySelector(".child");
                let father = document.querySelector(".father");
                let mother = document.querySelector(".mother");

                let childHeightCM = {{ $child_h }};
                let fatherHeightCM = {{ $father_h }};
                let motherHeightCM = {{ $mother_h }};

                let maxHeightCM = Math.max(childHeightCM, fatherHeightCM, motherHeightCM);

                if (highlight && chartContainer) {
                    let chartHeightPX = chartContainer.clientHeight - 50; // Get chart height and leave some padding
                    let cmToPxRatio = chartHeightPX / ({{ $end }} -
                    {{ $start }}); // Convert CM range to pixels

                    let childHeightPX = (childHeightCM - {{ $start }}) * cmToPxRatio;
                    let fatherHeightPX = (fatherHeightCM - {{ $start }}) * cmToPxRatio;
                    let motherHeightPX = (motherHeightCM - {{ $start }}) * cmToPxRatio;

                    if (childImage) childImage.style.height = (childHeightPX + 20) + "px";
                    if (fatherImage) fatherImage.style.height = (fatherHeightPX + 20) + "px";
                    if (motherImage) motherImage.style.height = (motherHeightPX + 20) + "px";

                    if (child) child.style.bottom = (childHeightPX + 30) + "px";
                    if (father) father.style.bottom = (fatherHeightPX + 30) + "px";
                    if (mother) mother.style.bottom = (motherHeightPX + 30) + "px";
                }
            });
        </script>





        <script>
            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    // Update mother_entry_unit
                    document.getElementById('mother_entry_unit').value = val;

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="m-unit_h"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="m-unit_h_cm"]').textContent = val + ' ▾';
                    }

                    document.getElementById('m-unit_h').value = val; // Update hidden unit field
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('d-none');
                    });
                });
            });

            var units_ft_in_father = document.querySelectorAll('.units_ft_in_father p');
            units_ft_in_father.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in_father').getAttribute('to');
                    var val = this.getAttribute('value');

                    // Update father_entry_unit
                    document.getElementById('father_entry_unit').value = val;

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm_father').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in_father').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in_father [for="f-unit_h"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in_father').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm_father').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm_father [for="f-unit_h_cm"]').textContent = val + ' ▾';
                    }

                    document.getElementById('f-unit_h').value = val; // Update hidden unit field
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('d-none');
                    });
                });
            });
        </script>

        <script>
            var units_ft_in_child = document.querySelectorAll('.units_ft_in_child p');
            units_ft_in_child.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in_child').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm_child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in_child').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in_child [for="c-unit_h"]').textContent = val + ' ▾';
                        document.getElementById('c-unit_h').value = "ft/in";
                    } else {
                        document.querySelectorAll('.ft_in_child').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm_child').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm_child [for="c-unit_h_cm"]').textContent = val + ' ▾';
                        document.getElementById('c-unit_h_cm').value = "cm";
                    }

                    document.getElementById(toAttr).value = val;
                    document.getElementById('child_unit').value = val; // Update the hidden input
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('d-none');
                    });
                });
            });
        </script>


        <script>
            (function() {
                var units_ft_in_f = document.querySelectorAll('.units_ft_in_f p');
                var father_1_unit = document.querySelector('#father_1_unit');

                units_ft_in_f.forEach(function(element) {
                    element.addEventListener('click', function() {
                        var toAttr = this.closest('.units_ft_in_f').getAttribute('to');
                        var val = this.getAttribute('value');
                        father_1_unit.value = val;


                        if (val === 'ft/in') {
                            document.querySelectorAll('.metric_input.h_cm_f').forEach(function(elem) {
                                elem.style.display = 'none';
                            });
                            document.querySelectorAll('.imperial_input.ft_in_f').forEach(function(elem) {
                                elem.style.display = 'block';
                            });
                            document.querySelector('.imperial_input [for="f-unit_h_f"]').textContent = val +
                                ' ▾';
                        } else {
                            document.querySelectorAll('.imperial_input.ft_in_f').forEach(function(elem) {
                                elem.style.display = 'none';
                            });
                            document.querySelectorAll('.metric_input.h_cm_f').forEach(function(elem) {
                                elem.style.display = 'block';
                            });
                            document.querySelector('.metric_input [for="f-unit_h_cm_f"]').textContent =
                                val + ' ▾';
                        }

                        document.getElementById(toAttr).value = val;
                        document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                            elem.classList.toggle('d-none');
                        });
                    });
                });
            })();
        </script>

        <script>
            (function() {
                // Select all unit options (cm and ft/in) for mother's height
                var units_ft_in_m = document.querySelectorAll('.units_ft_in_m p');
                var mother_1_unit = document.querySelector('#mother_1_unit');
                // Add click event listener to each unit option
                units_ft_in_m.forEach(function(element) {
                    element.addEventListener('click', function() {

                        // Get the 'to' attribute to identify the target hidden input
                        var toAttr = this.closest('.units_ft_in_m').getAttribute('to');
                        var val = this.getAttribute('value');

                        mother_1_unit.value = val;



                        // Switch to ft/in
                        if (val === 'ft/in') {
                            // Hide metric (cm) input
                            document.querySelectorAll('.metric_input.h_cm_m').forEach(function(elem) {
                                elem.style.display = 'none';
                            });
                            // Show imperial (ft/in) input
                            document.querySelectorAll('.imperial_input.ft_in_m').forEach(function(elem) {
                                elem.style.display = 'block';
                            });
                            // Update the label text
                            document.querySelector('.imperial_input [for="m-unit_h_m"]').textContent = val +
                                ' ▾';
                        }
                        // Switch to cm
                        else {
                            // Hide imperial (ft/in) input
                            document.querySelectorAll('.imperial_input.ft_in_m').forEach(function(elem) {
                                elem.style.display = 'none';
                            });
                            // Show metric (cm) input
                            document.querySelectorAll('.metric_input.h_cm_m').forEach(function(elem) {
                                elem.style.display = 'block';
                            });
                            // Update the label text
                            document.querySelector('.metric_input [for="m-unit_h_cm_m"]').textContent =
                                val + ' ▾';
                        }

                        // Update the hidden input value
                        document.getElementById(toAttr).value = val;
                        // Toggle visibility of the unit dropdown
                        document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                            elem.classList.toggle('d-none');
                        });
                    });
                });
            })();
        </script>

        <script>
            (function() {
                var units_weight_c = document.querySelectorAll('.units_weight_c p');
                units_weight_c.forEach(function(element) {
                    element.addEventListener('click', function() {
                        var toAttr = this.closest('.units_weight_c').getAttribute('to');
                        var val = this.getAttribute('value');

                        if (val === 'lbs') {
                            document.querySelectorAll('.metric_weight.kg_c').forEach(function(elem) {
                                elem.style.display = 'none';
                            });
                            document.querySelectorAll('.imperial_weight.lbs_c').forEach(function(elem) {
                                elem.style.display = 'block';
                            });
                            document.querySelector('.imperial_weight [for="c-unit_w_c"]').textContent =
                                val + ' ▾';
                        } else {
                            document.querySelectorAll('.imperial_weight.lbs_c').forEach(function(elem) {
                                elem.style.display = 'none';
                            });
                            document.querySelectorAll('.metric_weight.kg_c').forEach(function(elem) {
                                elem.style.display = 'block';
                            });
                            document.querySelector('.metric_weight [for="c-unit_w_kg_c"]').textContent =
                                val + ' ▾';
                        }

                        document.getElementById(toAttr).value = val;
                        document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                            elem.classList.toggle('d-none');
                        });
                    });
                });
            })();
        </script>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const inputName = document.getElementById("input_name");

                document.querySelectorAll(".prompt-item").forEach(item => {
                    item.addEventListener("click", function() {
                        inputName.innerText = '';
                        const text = this.querySelector("p").innerText; // Get the text inside <p>
                        inputName.innerText = text;
                    });
                });
            });
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let highlight = document.querySelector(".chart-line.highlight");
                let chartContainer = document.querySelector(".chart-container-2");
                let girlImage = document.querySelector(".girl-image-2");
                let boyImage = document.querySelector(".boy-image-2");
                let fatherImage = document.querySelector(".father-image-2");
                let motherImage = document.querySelector(".mother-image-2");
                let girlLabel = document.querySelector(".girl-2");
                let boyLabel = document.querySelector(".boy-2");
                let fatherLabel = document.querySelector(".father-2");
                let motherLabel = document.querySelector(".mother-2");

                let girlHeightCM = {{ $girls_height }};
                let boyHeightCM = {{ $boys_height }};
                let fatherHeightCM = {{ $father_height }};
                let motherHeightCM = {{ $mother_height }};

                let maxHeightCM = Math.max(girlHeightCM, boyHeightCM, fatherHeightCM, motherHeightCM);

                if (highlight && chartContainer) {
                    let chartHeightPX = chartContainer.clientHeight - 50; // Get chart height and leave some padding
                    let cmToPxRatio = chartHeightPX / ({{ $end }} -
                    {{ $start }}); // Convert CM range to pixels

                    let girlHeightPX = (girlHeightCM - {{ $start }}) * cmToPxRatio;
                    let boyHeightPX = (boyHeightCM - {{ $start }}) * cmToPxRatio;
                    let fatherHeightPX = (fatherHeightCM - {{ $start }}) * cmToPxRatio;
                    let motherHeightPX = (motherHeightCM - {{ $start }}) * cmToPxRatio;

                    if (girlImage) girlImage.style.height = (girlHeightPX + 20) + "px";
                    if (boyImage) boyImage.style.height = (boyHeightPX + 20) + "px";
                    if (fatherImage) fatherImage.style.height = (fatherHeightPX + 20) + "px";
                    if (motherImage) motherImage.style.height = (motherHeightPX + 20) + "px";

                    if (girlLabel) girlLabel.style.bottom = (girlHeightPX + 30) + "px";
                    if (boyLabel) boyLabel.style.bottom = (boyHeightPX + 30) + "px";
                    if (fatherLabel) fatherLabel.style.bottom = (fatherHeightPX + 30) + "px";
                    if (motherLabel) motherLabel.style.bottom = (motherHeightPX + 30) + "px";
                }
            });
        </script>

        <script>
            const selectElement = document.querySelector('#calculator_select');
            const hiddenInput = document.querySelector('#calculator_n');

            selectElement.addEventListener('change', function() {

                hiddenInput.value = this.value;

            });
        </script>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let loader = document.querySelector('.loader');
                let imgsContainer = document.querySelector('.imgs-container');

                // Show loader and hide images initially
                loader.style.display = "block";
                imgsContainer.classList.add("d-none");

                // After 3 seconds, hide the loader and show images
                setTimeout(function() {
                    loader.style.display = "none";
                    imgsContainer.classList.remove("d-none");
                }, 3000);
            });

            document.addEventListener("DOMContentLoaded", function() {
                let loader = document.querySelector('.loader');
                let imgsContainer = document.querySelector('.imgs-container-2');

                // Show loader and hide images initially
                loader.style.display = "block";
                imgsContainer.classList.add("d-none");

                // After 3 seconds, hide the loader and show images
                setTimeout(function() {
                    loader.style.display = "none";
                    imgsContainer.classList.remove("d-none");
                }, 3000);
            });
        </script>
    @endpush
</form>
