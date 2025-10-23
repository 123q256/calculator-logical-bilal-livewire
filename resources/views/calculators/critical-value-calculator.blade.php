<style>
    @media (min-width: 992px) {
        .font-lg-14{
            font-size: 14px;
        }
    }
    @media (max-width: 620px) {
        .velocitytab {
            min-width: 400px;
        }
    }
    
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .velocitytab p{
        position: relative;
        top: 2px
    }
    table{
        width: 100% !important;
    }
    .bg-gray{
        background-color: #F6FAFC !important;
    }
</style>
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        
        {{-- <div class="col-lg-11 mx-auto">
           <div class="row d-flex align-items-center">
               <div class="col-lg-2 py-2 font-s-14">{{$lang['to_calc']}}:</div>
               <div class="col-lg-10 pb-2 overflow-auto">
                   <div class="d-flex justify-content-between font-s-12 font-lg-14 velocitytab border-b-dark position-relative">
                       <p class="cursor-pointer veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] !== 't_val' ? ''  : 'v_active' }} "  id="t_val" data-value="t_val"><strong>T Value</strong></p>
                       <p class="cursor-pointer veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'z_val' ? 'v_active'  : '' }} " id="z_val" data-value="z_val"><strong>Z Value</strong></p>
                       <p class="cursor-pointer veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'f_val' ? 'v_active'  : '' }} " id="f_val" data-value="f_val"><strong>F Value</strong></p>
                       <p class="cursor-pointer veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'chi_val' ? 'v_active'  : '' }} " id="chi_val" data-value="chi_val"><strong>Chi-Square Value</strong></p>
                       <p class="cursor-pointer veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'r_val' ? 'v_active'  : '' }} " id="r_val" data-value="r_val"><strong>R Value</strong></p>
                   </div>
               </div>
              
           </div>
       </div> --}}

       <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[90%] w-full">
        <div class="col-lg-2 py-2 font-s-14">{{$lang['to_calc']}}:</div>
        <input type="hidden" name="calculator_name" id="calculator_name" value="{{ isset($_POST['calculator_name'])?$_POST['calculator_name']:'t_val' }}">
        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
            <div class="lg:w-1/5 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white veloTabs  {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] !== 't_val' ? ''  : 'tagsUnit' }}" data-value="t_val" id="t_val">
                    T Value
                </div>
            </div>
            <div class="lg:w-1/5 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'z_val' ? 'tagsUnit'  : '' }}" data-value="z_val" id="z_val">
                    Z Value
                </div>
            </div>
            <div class="lg:w-1/5 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'f_val' ? 'tagsUnit'  : '' }}" data-value="f_val" id="f_val">
                    F Value
                </div>
            </div>
            <div class="lg:w-1/5 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 lg:text-[13px]  hover_tags hover:text-white veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'chi_val' ? 'tagsUnit'  : '' }} " data-value="chi_val" id="chi_val">
                    Chi-Square Value
                </div>
            </div>
            <div class="lg:w-1/5 w-full px-2 py-1">
                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white veloTabs {{ isset($_POST['calculator_name']) && $_POST['calculator_name'] == 'r_val' ? 'tagsUnit'  : '' }}" data-value="r_val" id="r_val">
                    R Value
                </div>
            </div>
        </div>
    </div>


       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-5">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <div class="row">
                        <div class="col-12 f_input">
                            <label for="first" class="font-s-14 text-blue" id="txt1">Significance Level α: (0 to 0.5)</label>
                            <div class="w-full py-2">
                                <input type="number" min="0" max="0.5" step="any" name="first" id="first" value="{{ isset($_POST['first'])?$_POST['first']:'0.3' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-12 s_input">
                            <label for="second" class="font-s-14 text-blue" id="txt2">Degrees of Freedom Numerator</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="second" id="second" value="{{ isset($_POST['second'])?$_POST['second']:'7' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-12 t_input">
                            <label for="third" class="font-s-14 text-blue" id="txt3">{{ $lang['d_f'] }}</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="third" id="third" value="{{ isset($_POST['third'])?$_POST['third']:'45' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <p class="col-12 font-s-18 mt-4"><strong id="main_text" class="text-blue">How Does T Critical Value Calculator Work?</strong></p>
                    <ul class="col-12 mt-2 ms-1">
                        <li class="my-2 ms-3" id="f_li">Enter <strong>Significance Level(α)</strong> In The Input Box.</li>
                        <li class="my-2 ms-3" id="s_li">Put the&nbsp;<strong>Degrees Of Freedom</strong> In The Input Box.</li>
                        <li class="my-2 ms-3 d-none" id="extra_li">Enter Degree of freedom denominator in required input box.</li>
                        <li class="my-2 ms-3" id="t_li">Hit The <strong>Calculate </strong>Button&nbsp;To Find <strong>T</strong> Critical Value.</li>
                    </ul>
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
                        <?php if ($detail['submit'] == "t_val") { ?>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b">T Value for Right Tailed Probability</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_jawab'][0] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">T Value for Left Tailed Probability</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_jawab'][1] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">T Value for Two Tailed Probability</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['t_jawab'][2] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <?=$detail['t_jawab'][3]?>
                            <?=$detail['t_jawab'][4]?>
                        <?php }elseif ($detail['submit'] == "z_val") { ?>
                            <div class="w-full  mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b">Z Value</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['z_jawab'][2], 6) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Z Value for Right Tailed Probability</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['z_jawab'][1], 6) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Z Value for Left Tailed Probability</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['z_jawab'][0], 6) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Z Value for Two Tailed Probability</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['z_jawab'][3] }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php }elseif ($detail['submit'] == "chi_val") { ?>
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b">Right Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="chi__right"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Left Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="chi__left"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Two Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="chi__two"></strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php }elseif ($detail['submit'] == "f_val") { ?>
                            <div class="w-full  mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b">Right Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="f__right"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Left Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="f__left"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Two Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="f__two"></strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php }elseif ($detail['submit'] == "r_val") { ?>
                            <div class="w-full  mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b">Right Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="r__right"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Left Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="r__left"></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">Two Tailed</td>
                                        <td class="py-2 border-b"><strong class="text-blue" id="r__two"></strong></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstat/1.9.1/jstat.min.js"></script>
    @endif
    <script>
        @if (isset($detail))
            <?php if($detail['submit'] == 'chi_val'){ ?>
                var alpha = <?=$detail['value']?>;
                var df = <?=$detail['degree']?>;
                var rightChiSquareFn = jStat.chisquare.inv(1 - alpha, df);
                var leftCiSquareFn = jStat.chisquare.inv(alpha, df);
                var twoTailLeftChiSquareFn = jStat.chisquare.inv(alpha/2, df);
                var twoTailRightChiSquareFn = jStat.chisquare.inv(1-alpha/2, df);
                document.getElementById('chi__right').textContent = rightChiSquareFn.toFixed(4);
                document.getElementById('chi__left').textContent = leftCiSquareFn.toFixed(4);
                document.getElementById('chi__two').textContent = twoTailLeftChiSquareFn.toFixed(4) +' & ' + twoTailRightChiSquareFn.toFixed(4);
            <?php } ?>
            <?php if($detail['submit'] == 'f_val'){ ?>
                var alpha = <?=$detail['first']?>;
                var fValue_num_df = <?=$detail['second']?>;
                var fValue_denom_df = <?=$detail['third']?>;
                var rightFfn = jStat.centralF.inv( 1 - alpha,  fValue_num_df , fValue_denom_df );
                var leftFfn = jStat.centralF.inv( alpha,  fValue_num_df , fValue_denom_df );
                var twoTailLeftFfn = jStat.centralF.inv( alpha/2,  fValue_num_df , fValue_denom_df );
                var twoTailRightFfn = jStat.centralF.inv( 1-alpha/2,  fValue_num_df , fValue_denom_df );
                document.getElementById('f__right').textContent = rightFfn.toFixed(4)
                document.getElementById('f__left').textContent = leftFfn.toFixed(4)
                document.getElementById('f__two').textContent = twoTailLeftFfn.toFixed(4) +' & ' + twoTailRightFfn.toFixed(4)
            <?php } ?>
            <?php if($detail['submit'] == 'r_val'){ ?>
                var rValue_alpha = <?=$detail['value']?>;
                var rValue_df = <?=$detail['degree']?>;
                var t = jStat.studentt.inv(1 - rValue_alpha, rValue_df);
                var _2t = jStat.studentt.inv(1 - rValue_alpha / 2, rValue_df);
                var one_tailed = t / Math.sqrt(Math.pow(t, 2) + rValue_df);
                var two_tailed = _2t / Math.sqrt(Math.pow(_2t, 2) + rValue_df);
                document.getElementById('r__right').textContent = one_tailed.toFixed(4)
                document.getElementById('r__left').textContent = '-'+one_tailed.toFixed(4) 
                document.getElementById('r__two').textContent = two_tailed.toFixed(4)
            <?php } ?>
        @endif
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('t_val').addEventListener('click', function() {
                updateCalculator('t_val', "Significance Level α: (0 to 0.5)", "Degrees of Freedom", "t_val", 
                                "How Does T Critical Value Calculator Work?", 
                                "Enter <strong>Significance Level(&alpha;)</strong> In The Input Box.", 
                                "Put the <strong>Degrees Of Freedom</strong> In The Input Box.", 
                                "Hit The <strong>Calculate</strong> Button To Find <strong>T</strong> Critical Value.");
            });

            document.getElementById('z_val').addEventListener('click', function() {
                updateCalculator('z_val', "Significance Level α: (0 to 1)", "", "z_val", 
                                "How Does Z Critical Value Calculator Work?", 
                                "Enter The <strong>Significance Level(&alpha;)</strong> In The Input Box.", 
                                "Use The <strong>Calculate</strong> Button To Get The <strong>Z</strong> Critical Value.", 
                                "");
            });

            document.getElementById('chi_val').addEventListener('click', function() {
                updateCalculator('chi_val', "Significance Level α: (0 to 0.5)", "Degrees of Freedom", "chi_val", 
                                "How Does This Calculator Work?", 
                                "Enter <strong>Significance Level(&alpha;)</strong> In Required Input Box.", 
                                "Enter <strong>Degree of freedom</strong> In Required Input Box.", 
                                "Click The <strong>Calculate</strong> Button.");
            });

            document.getElementById('f_val').addEventListener('click', function() {
                updateCalculator('f_val', "Significance Level α: (0 to 0.5)", "Degrees of Freedom Denominator:", "f_val", 
                                "How Does F Critical Value Calculator Work?", 
                                "Enter <strong>Significance Level(&alpha;)</strong>", 
                                "Enter <strong>Degree of freedom</strong> of numerator in required input box.", 
                                "Click The <strong>Calculate</strong> Button.");
            });

            document.getElementById('r_val').addEventListener('click', function() {
                updateCalculator('r_val', "Significance Level α: (0 to 0.5)", "Degrees of Freedom", "r_val", 
                                "How Does R Critical Value Calculator Work?", 
                                "Enter <strong>Significance Level(&alpha;)</strong> In Required Input Box.", 
                                "Enter <strong>Degree of freedom</strong> In Required Input Box.", 
                                "Click The <strong>Calculate</strong> Button.");
            });
            let cal_name = document.getElementById('calculator_name').value;
            document.getElementById(cal_name).click();
            function updateCalculator(value, txt1, txt3, calculateVal, mainText, f_li, s_li, t_li) {
                var pacetabs = document.querySelectorAll('.veloTabs');
                pacetabs.forEach(function(tab) {
                    tab.classList.remove('tagsUnit');
                });

                document.getElementById(value).classList.add('tagsUnit');
                document.querySelectorAll('.f_input, .t_input').forEach(function(elem) {
                    elem.style.display = 'block';
                });
                document.querySelectorAll('#t_li').forEach(function(elem) {
                    elem.style.display = 'list-item';
                });
                document.querySelectorAll('.s_input, #extra_li').forEach(function(elem) {
                    elem.style.display = 'none';
                });
                document.getElementById('txt1').textContent = txt1;
                document.getElementById('txt3').textContent = txt3;
                document.getElementById('calculator_name').value = calculateVal;
                document.getElementById('main_text').textContent = mainText;
                document.getElementById('f_li').innerHTML = f_li;
                document.getElementById('s_li').innerHTML = s_li;
                document.getElementById('t_li').innerHTML = t_li;

                if (value === 'f_val') {
                    document.querySelectorAll('.s_input').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('#extra_li').forEach(function(elem) {
                        elem.style.display = 'list-item';
                    });
                }

                if (value === 'z_val') {
                    document.querySelectorAll('.t_input, #t_li').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                }
            }
        });
    </script>
@endpush