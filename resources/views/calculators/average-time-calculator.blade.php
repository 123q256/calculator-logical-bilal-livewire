<style>
    input[type="number"]:disabled {
        cursor: not-allowed
    }
</style>
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
 
            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <span class="col-span-12 text-blue text-[25px] pe-4">&nbsp;</span>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 pe-1">
                    <div class="w-100 py-2">                                  
                        <input type="checkbox" name="checkbox1" id="hours_check" onclick="hours_disables(this)"
                        value="1" checked />
                        <label for="hours_check">{{$lang['1']}}</label>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 px-1 ">
                    <div class="w-100 py-2">                                  
                        <input type="checkbox" name="checkbox2" id="min_check" onclick="minutes_disables(this)"
                        value="1" checked />
                        <label for="min_check">{{$lang['2']}}</label>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 px-1 ">
                    <div class="w-100 py-2">                                  
                        <input type="checkbox" name="checkbox3" id="sec_check" onclick="seconds_disables(this)"
                        value="1" checked />
                        <label for="sec_check">{{$lang['3']}}</label>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 px-1  {{ isset($_POST['clock_format']) && $_POST['clock_format'] !== '12' ? 'd-none' : 'd-block' }}">
                    <div class="w-100 py-2">                                  
                        <input type="checkbox" name="checkbox4" id="milli_check" onclick="milli_disables(this)"
                        value="1" checked onclick="handleCheckboxChange()"/>
                        <label for="milli_check">{{$lang['4']}}</label>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="col-span-12 align-items-center">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-3 flex">
                    <span class="col-span-12 text-blue text-[25px] pe-4">&nbsp;</span>
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inhour[]" class="input hours" aria-label="input"
                        value="{{ isset(request()->inhour[0]) ? request()->inhour[0] : '' }}" placeholder="<?= $lang[5] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[5] ?>'"  />
                    </div>
                </div>
                <div class="col-span-3 ">
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inminutes[]" class="input minutes" aria-label="input"
                        value="{{ isset(request()->inminutes[0]) ? request()->inminutes[0] : '' }}" placeholder="<?= $lang[6] ?>" class="validate minutes" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[6] ?>'"  />
                    </div>
                </div>
                <div class="col-span-3 ">
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inseconds[]" class="input seconds" aria-label="input"
                        value="{{ isset(request()->inseconds[0]) ? request()->inseconds[0] : '' }}" placeholder="<?= $lang[7] ?>" class="validate seconds" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[7] ?>'"  />
                    </div>
                </div>
                <div class="col-span-3 flex">
                    <div class="w-100 py-2 ">                                  
                        <input type="number" min="0" name="inmiliseconds[]" class="input milliseconds" aria-label="input"
                        value="{{ isset(request()->inmiliseconds[0]) ? request()->inmiliseconds[0] : '' }}" placeholder="<?= $lang[8] ?>" class="validate milliseconds" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[8] ?>'"  />
                    </div>
                    <span class="col-span-12 text-blue text-[25px] pe-4">&nbsp;</span>
                </div>
                </div>
            </div>
            <div class="col-span-12 align-items-center">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <input type="hidden" id="count_val" name="count_val" value="2">
                <div class="col-span-3 ps-1 flex items-center">
                    <span class="text-blue text-[25px] pe-2">+</span>
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inhour[]" class="input hours" aria-label="input"
                        value="{{ isset(request()->inhour[0]) ? request()->inhour[0] : '' }}" placeholder="<?= $lang[5] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[5] ?>'" />
                    </div>
                </div>
                <div class="col-span-3 ">
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inminutes[]" class="input minutes" aria-label="input"
                        value="{{ isset(request()->inminutes[0]) ? request()->inminutes[0] : '' }}" placeholder="<?= $lang[6] ?>" class="validate minutes" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[6] ?>'"  />
                    </div>
                </div>
                <div class="col-span-3 ">
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inseconds[]" class="input seconds" aria-label="input"
                        value="{{ isset(request()->inseconds[0]) ? request()->inseconds[0] : '' }}" placeholder="<?= $lang[7] ?>" class="validate seconds" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[7] ?>'"  />
                    </div>
                </div>
                <div class="col-span-3 flex">
                    <div class="w-100 py-2">                                  
                        <input type="number" min="0" name="inmiliseconds[]" class="input milliseconds" aria-label="input"
                        value="{{ isset(request()->inmiliseconds[0]) ? request()->inmiliseconds[0] : '' }}" placeholder="<?= $lang[8] ?>" class="validate milliseconds" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[8] ?>'"  />
                    </div>
                    <span class="col-span-12 text-blue text-[25px] pe-4">&nbsp;</span>
                </div>
                </div>
            </div>
            <div class="col-span-12 khali_div">
                <div class="row_container">
                </div>
            </div>
            <div class="col-span-12 text-end pe-2">
                <span id="newRow" onclick="add_row(this)" class="px-3 py-2 bg-white text-blue border radius-5 cursor-pointer">+ <?= $lang[9] ?></span>
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

    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full my-2">
                            <div class="col-lg-10 font-s-18 overflow-auto">
                                <table class="w-full">
                                    <?php foreach ($detail['hour_list'] as $key => $value) { ?>
                                        <tr>
                                            <td class="border-b py-2">
                                                <span>
                                                    <?php
                                                    $develop = $key;
                                                    if (++$develop === count($detail['hour_list'])) {
                                                        echo "+";
                                                    } else {
                                                        echo "&nbsp;";
                                                    }
                                                    ?>
                                                </span>
                                                <?= $value ?> <?= $lang[5] ?>
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['min_list'][$key] ?>
                                                <?= $lang[6] ?>
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['sec_list'][$key] ?>
                                                <?= $lang[7] ?>
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['mili_list'][$key] ?>
                                                <?= $lang[8] ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="border-b py-2">
                                            <b class="font_size30 text-accent-4 orange-text">
                                                <?= round($detail['time_hour']) ?>
                                            </b>
                                            <?= $lang[5] ?>
                                        </td>
                                        <td class="border-b py-2">
                                            <b class="font_size30 text-accent-4 orange-text">
                                                <?= round($detail['time_minutes']) ?>
                                            </b>
                                            <?= $lang[6] ?>
                                        </td>
                                        <td class="border-b py-2">
                                            <b class="font_size30 text-accent-4 orange-text">
                                                <?= round($detail['time_seconds']) ?>
                                            </b>
                                            <?= $lang[7] ?>
                                        </td>
                                        <td class="border-b py-2">
                                            <b class="font_size30 text-accent-4 orange-text">
                                                <?= round($detail['time_miliseconds'], 2) ?>
                                            </b>
                                            <?= $lang[8] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 text-center my-[30px]">
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
    
    @endif
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@push('calculatorJS')
    <script>
    $(document).on('click', '.remove', function() {
        $(this).closest('.dynamic_row').remove();
        $('#count_val').val(x + 1);
        updateRowCount();
    });
    
    var x = 0;
    function updateRowCount() {
        var rowCount = $(".row_container .dynamic_row").length;
        x = rowCount; // Update x with the current row count
    }

    function add_row(element) {
        var lenght = $(".append").length;
        if (x < 18) {
            var read = `
        <div class="dynamic_row d-lg-flex align-items-center">
              <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-3 flex items-center">
                <span class="text-blue text-[25px] pe-2">+</span>
                <div class="w-100 py-2">                                  
                    <input type="number" min="0" name="inhour[]" class="input hours" aria-label="input"
                    value="{{ isset(request()->inhour[0]) ? request()->inhour[0] : '' }}" placeholder="<?= $lang[5] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[5] ?>'"  />
                </div>
            </div>
            <div class="col-span-3 ">
                <div class="w-100 py-2">                                  
                    <input type="number" min="0" name="inminutes[]" class="input minutes" aria-label="input"
                    value="{{ isset(request()->inminutes[0]) ? request()->inminutes[0] : '' }}" placeholder="<?= $lang[6] ?>" class="validate minutes" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[6] ?>'"  />
                </div>
            </div>
            <div class="col-span-3 ">
                <div class="w-100 py-2">                                  
                    <input type="number" min="0" name="inseconds[]" class="input seconds" aria-label="input"
                    value="{{ isset(request()->inseconds[0]) ? request()->inseconds[0] : '' }}" placeholder="<?= $lang[7] ?>" class="validate seconds" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[7] ?>'"  />
                </div>
            </div>
            <div class="col-span-3 flex items-center">
                <div class="w-100 py-2">                                  
                    <input type="number" min="0" name="inmiliseconds[]" class="input milliseconds" aria-label="input"
                    value="{{ isset(request()->inmiliseconds[0]) ? request()->inmiliseconds[0] : '' }}" placeholder="<?= $lang[8] ?>" class="validate milliseconds" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= $lang[8] ?>'"  />
                </div>
                <img src="<?= asset('images/belete_btn.png') ?>" width="18px" height="18px" class="cursor-pointer remove mx-2" alt="<?= $cal_name ?>" class="right">
            </div>
            </div>
        </div>`;
            var $read = $(read);
            if (!$("#hours_check").prop("checked")) {
                $read.find(".hours").prop("disabled", true);
            }
            if (!$("#min_check").prop("checked")) {
                $read.find(".minutes").prop("disabled", true);
            }
            if (!$("#sec_check").prop("checked")) {
                $read.find(".seconds").prop("disabled", true);
            }
            if (!$("#milli_check").prop("checked")) {
                $read.find(".milliseconds").prop("disabled", true);
            }
            $(".row_container").append($read);
            x++;
            $('#count_val').val(x + 2);
            updateRowCount();
        } else {
            alert('Max Limit Reached');
        }
    }


        function hours_disables(element) {
            if ($(element).prop("checked") == true) {
                $('.hours').prop("disabled", false);
            } else if ($(element).prop("checked") == false) {
                $('.hours').prop("disabled", true);
            }
        }

        function minutes_disables(element) {
            if ($(element).prop("checked") == true) {
                $('.minutes').prop("disabled", false);
            } else if ($(element).prop("checked") == false) {
                $('.minutes').prop("disabled", true);
            }
        }

        function seconds_disables(element) {
            if ($(element).prop("checked") == true) {
                $('.seconds').prop("disabled", false);
            } else if ($(element).prop("checked") == false) {
                $('.seconds').prop("disabled", true);
            }
        }

        function milli_disables(element) {
            if ($(element).prop("checked") == true) {
                $('.milliseconds').prop("disabled", false);
            } else if ($(element).prop("checked") == false) {
                $('.milliseconds').prop("disabled", true);
            }
        }

    </script>
@endpush
