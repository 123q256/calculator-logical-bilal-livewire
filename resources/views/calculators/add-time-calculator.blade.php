<style>
    .mera_table table thead tr {
        margin-top: 10px !important;
    }
    .filled-in{
        width: 15px;
        height: auto;
        margin-right: 10px
    }
    [type="checkbox"] + span:not(.lever) {
        position: relative;
        cursor: pointer;
        display: inline-block;
        font-size: 1rem;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    input[type="number"]:not(.browser-default):disabled{
        color: rgba(0, 0, 0, 0.42)
    }
    .time_table tbody tr .plus {
        font-size: 30px;
        margin-bottom: 12px !important;
    }
    .time_table tbody tr p {
        font-size: 20px;
        margin-bottom: 12px !important;
    }
    .mera_table table tr {
        border-bottom: 0px !important;
    }
    .del_btn {
        padding: 12px
    }
    .add {
        padding-right: 42px
    }
    .add_btn {
        border-radius: 10px !important;
        float: right
    }
    .khali_div td {
        padding-top: 0px !important;
        margin-top: 0px !important;
    }
    td ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: var(--pClr) !important;
    }
    #remove{
        cursor: pointer
    }
    input[type="number"]:disabled {
        cursor: not-allowed
    }
    .result tr{
        border-bottom: 2px solid #ddd !important
    }
    .result tr:last-child{
        border-bottom: none !important
    }
    @media (max-width: 480px){
        .border_form{
            padding: 10px !important
        }
        .add{
            margin-right: 0px !important;
            margin-top: 10px !important
        }
    }
    table tr td {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }
    td{
        padding: 15px 5px;
        display: table-cell;
        text-align: left;
        vertical-align: middle;
        border-radius: 2px;
    }
    .p_5{
        padding: 5px
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
       
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
        <input type="hidden" id="count_val" name="count_val" value="2">
        <div class="grid grid-cols-1 gap-4">
            <div class="w-full overflow-auto mera_table">
                <table class="w-full time_table table-auto border-collapse" cellspacing="0">
                    <thead>
                        <tr>
                            <td></td>
                            <td>
                                <label class="flex items-center">
                                    <input type="checkbox" name="checkbox1" id="hours_check" onclick="hours_disables(this)" value="1" class="input filled-in" checked>
                                    <span class="text-black"><?= $lang[1] ?></span>
                                </label>
                            </td>
                            <td></td>
                            <td>
                                <label class="flex items-center">
                                    <input type="checkbox" name="checkbox2" id="min_check" onclick="minutes_disables(this)" value="1" class="input filled-in" checked>
                                    <span class="text-black"><?= $lang[2] ?></span>
                                </label>
                            </td>
                            <td></td>
                            <td>
                                <label class="flex items-center">
                                    <input type="checkbox" name="checkbox3" id="sec_check" onclick="seconds_disables(this)" value="1" class="input filled-in" checked>
                                    <span class="text-black"><?= $lang[3] ?></span>
                                </label>
                            </td>
                            <td></td>
                            <td>
                                <label class="flex items-center">
                                    <input type="checkbox" name="checkbox4" id="milli_check" onclick="milli_disables(this)" value="1" class="input filled-in" checked onclick="handleCheckboxChange()">
                                    <span class="text-black"><?= $lang[4] ?></span>
                                </label>
                            </td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="f_time">
                            <td>
                                <p></p>
                            </td>
                            <td>
                                <input type="number" min="0" name="inhour[]" placeholder="hours" onfocus="this.placeholder = ''" onblur="this.placeholder = 'hours'" class="input hours">
                            </td>
                            <td>
                                <p>:</p>
                            </td>
                            <td class="minutes">
                                <input type="number" min="0" name="inminutes[]" placeholder="minutes" class="input minutes" onfocus="this.placeholder = ''" onblur="this.placeholder = 'minutes'">
                            </td>
                            <td>
                                <p>:</p>
                            </td>
                            <td class="seconds">
                                <input type="number" min="0" name="inseconds[]" placeholder="seconds" class="input seconds" onfocus="this.placeholder = ''" onblur="this.placeholder = 'seconds'">
                            </td>
                            <td>
                                <p>:</p>
                            </td>
                            <td class="milliseconds">
                                <input type="number" min="0" name="inmiliseconds[]" placeholder="milliseconds" class="input milliseconds" onfocus="this.placeholder = ''" onblur="this.placeholder = 'milliseconds'">
                            </td>
                            <td class="del_btn">
                                <p class="p_5">&nbsp;</p>
                            </td>
                        </tr>
                        <tr class="s_time">
                            <td>
                                <p class="plus text-blue">+</p>
                            </td>
                            <td>
                                <input type="number" min="1" name="inhour[]" placeholder="hours" class="input hours">
                            </td>
                            <td>
                                <p>:</p>
                            </td>
                            <td class="minutes">
                                <input type="number" min="1" name="inminutes[]" placeholder="minutes" class="input minutes">
                            </td>
                            <td>
                                <p>:</p>
                            </td>
                            <td class="seconds">
                                <input type="number" min="1" name="inseconds[]" placeholder="seconds" class="input seconds">
                            </td>
                            <td>
                                <p>:</p>
                            </td>
                            <td class="milliseconds">
                                <input type="number" min="0" name="inmiliseconds[]" placeholder="milliseconds" class="input milliseconds">
                            </td>
                            <td class="del_btn">
                                <p class="p_5">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="khali_div"></tbody>
                </table>
            </div>
            <div class="w-full add">
                <button type="button" title="Add New Time" id="newRow" onclick="add_row(this)" class="add_btn units_active sm:px-10 sm:py-2 font-semibold bg-[#2845F5] text-white rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base">
                    <div class="flex items-center justify-center">
                        <strong class=" font-semibold text-lg pe-2">+</strong>
                        <strong class=""><?= $lang[5] ?></strong>
                    </div>
                </button>
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
        
              
    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue result p-3 radius-10 mt-3">
                        <div class="row">
                            <div class="w-full overflow-auto">
                                <table class="w-full" cellspacing="0">
                                    @foreach($detail['hour_list'] as $key => $value)
                                        <tr>
                                            <td class="border-b p-2">
                                                <p class="text-center">
                                                    @php
                                                        if (++$develop === count($detail['hour_list'])) {
                                                            echo "+";
                                                        }
                                                    @endphp
                                                    {!! $value !!}
                                                    <span class="font_size16"> {!! $lang[1] !!}</span>
                                                </p>
                                            </td>
                                            <td class="border-b p-2">
                                                <p class="text-center">{!! $detail['min_list'][$key] !!}
                                                    {!! $lang[2] !!}
                                                </p>
                                            </td>
                                            <td class="border-b p-2">
                                                <p class="text-center">{!! $detail['sec_list'][$key] !!}
                                                    {!! $lang[3] !!}
                                                </p>
                                            </td>
                                            <td class="border-b p-2">
                                                <p class="text-center">{!! $detail['mili_list'][$key] !!}
                                                    {!! $lang[4] !!}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="p-2">
                                            <p class="text-center">
                                                <strong class="text-green font-s-25">
                                                    {!! round($detail['time_hour']) !!}
                                                </strong>
                                                {!! $lang[1] !!}
                                            </p>
                                        </td>
                                        <td class="p-2">
                                            <p class="text-center">
                                                <strong class="text-green font-s-25">
                                                    {!! round($detail['time_minutes']) !!}
                                                </strong>
                                                {!! $lang[2] !!}
                                            </p>
                                        </td>
                                        <td class="p-2">
                                            <p class="text-center">
                                                <strong class="text-green font-s-25">
                                                    {!! round($detail['time_seconds']) !!}
                                                </strong>
                                                {!! $lang[3] !!}
                                            </p>
                                        </td>
                                        <td class="p-2">
                                            <p class="text-center">
                                                <strong class="text-green font-s-25">
                                                    {!! round($detail['time_miliseconds']) !!}
                                                </strong>
                                                {!! $lang[4] !!}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="w-full text-center mt-[60px] ">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'remove') {
                    event.target.closest('tr').remove();
                    updateRowCount();
                }
            });

            var x = 0;

            function updateRowCount() {
                var rowCount = document.querySelectorAll(".khali_div tr").length;
                x = rowCount; // Update x with the current row count
            }

            function add_row() {
                if (x < 18) {
                    var read = `
                        <td><p class="plus text-blue">+</p></td>
                        <td><input type="number" min="1" name="inhour[]" placeholder="hours" class="input hours"></td>
                        <td><p>:</p></td>
                        <td class="minutes"><input type="number" min="1" name="inminutes[]" placeholder="minutes" class="input minutes"></td>
                        <td><p>:</p></td>
                        <td class="seconds"><input type="number" min="1" name="inseconds[]" placeholder="seconds" class="input seconds"></td>
                        <td><p>:</p></td>
                        <td class="milliseconds"><input type="number" min="0" name="inmiliseconds[]" placeholder="milliseconds" class="input milliseconds"></td>
                        <td><img src="{{ asset('assets/img/belete_btn.png') }}" width="32" height="32" class="p_5 remove" alt="Delete" id="remove"></td>
                    `;
                    var div = document.createElement('tr');
                    div.innerHTML = read;
                    
                    if (!document.getElementById("hours_check").checked) {
                        div.querySelector(".hours").disabled = true;
                    }
                    if (!document.getElementById("min_check").checked) {
                        div.querySelector(".minutes").disabled = true;
                    }
                    if (!document.getElementById("sec_check").checked) {
                        div.querySelector(".seconds").disabled = true;
                    }
                    if (!document.getElementById("milli_check").checked) {
                        div.querySelector(".milliseconds").disabled = true;
                    }

                    document.querySelector(".khali_div").appendChild(div);
                    x++;
                    document.getElementById('count_val').value = x + 2;
                    updateRowCount();
                } else {
                    alert('Max Limit Reached');
                }
            }

            function hours_disables(element) {
                var hoursInputs = document.querySelectorAll('.hours');
                hoursInputs.forEach(function(input) {
                    input.disabled = !element.checked;
                });
            }

            function minutes_disables(element) {
                var minutesInputs = document.querySelectorAll('.minutes');
                minutesInputs.forEach(function(input) {
                    input.disabled = !element.checked;
                });
            }

            function seconds_disables(element) {
                var secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    input.disabled = !element.checked;
                });
            }

            function milli_disables(element) {
                var millisecondsInputs = document.querySelectorAll('.milliseconds');
                millisecondsInputs.forEach(function(input) {
                    input.disabled = !element.checked;
                });
            }
        </script>
    @endpush
</form>
