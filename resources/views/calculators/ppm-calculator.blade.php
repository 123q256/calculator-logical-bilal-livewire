<style>
    .pacetabs{
        left: 20.7%;
    }
    @media (max-width: 991px){
        .pacetabs{
            left: 0;
        }
    }
</style>
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

            <div class="w-fullcol-lg-9 mx-auto mt-5  w-full pacetabs">
                <input type="hidden" name="calculator_name" id="calculator_name" value="calculator1">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white tagsUnit imperial" id="calculator1" data-value="calculator1">
                                {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white metric" id="calculator2" data-value="calculator2">
                                {{ $lang['2'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-5   gap-4">
                <div class="w-full calculators calculator1">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="operations" class="label">{!! $lang['3'] !!}:</label>
                                <select name="operations" id="operations" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['4'],$lang['5'],$lang['6'],"PPM","PPB","PPT"];
                                        $val = ["1","2","3","4","5","6"];
                                        optionsList($val,$name,isset(request()->operations)?request()->operations:'1');
                                    @endphp
                                </select>
                        </div>
                        <div class="space-y-2 tno ">
                            <label for="first" class="label" id="pakis">{!! $lang['4'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first)?request()->first:'4' }}" />
                                <span class="text-blue input_unit" id="txt1"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full calculators calculator2 hidden">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="drop1" class="" style="font-size: 12px">{!! $lang['7'] !!} (ppm) {!! $lang['8'] !!}:</label>
                                <select name="drop1" id="drop1" class="input">
                                    @php
                                        $name = [$lang[9],$lang[10],$lang[11]];
                                        $val = ["1","2","3"];
                                        optionsList($val,$name,isset(request()->drop1)?request()->drop1:'1');
                                    @endphp
                                </select>
                        </div>
                        <div class="space-y-2">
                            <label for="drop2" class="label anderson">measured in:</label>
                                <select name="drop2" id="drop2" class="input">
                                    @php
                                        $name = ["Air","Water"];
                                        $val = ["1","2"];
                                        optionsList($val,$name,isset(request()->drop2)?request()->drop2:'1');
                                    @endphp
                                </select>
                        </div>
                        <div class="space-y-2" id="chal1">
                            <label for="drop3" class="label anderson">{!! $lang['12'] !!}:</label>
                                <select name="drop3" id="drop3" class="input">
                                    @php
                                        $name = ["[".$lang['13']."]","Ammonia [NH3]","Argon [Ar]","Carbon Dioxide [CO2]","Carbon Monoxide [CO]","Helium [He]","Hydrogen [H2]","Hydrogen Sulfide [H2S]","Krypton [Kr]","Methane [CH4]","Neon [Ne]","Nitric Oxide [NO]","Nitrogen [N2]","Nitrogen Dioxide [NO2]","Nitrous Oxide [N2O]","Oxygen [O2]","Ozone [O3]","Sulfur Dioxide [SO2]","Water [H2O]","Xenon [Xe]"];
                                        $val = ["","17.03","39.95","44.01","28.01","4.00","2.02","34.08","83.80","16.04","20.18","30.01","28.01","46.01","44.01","32.00","48.00","64.06","18.02","131.29"];
                                        optionsList($val,$name,isset(request()->drop3)?request()->drop3:'');
                                    @endphp
                                </select>
                        </div>
                        <div class="space-y-2 " id="chal2">
                            <label for="second" class="label" id="pakis">M:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->second)?request()->second:'2' }}" />
                                <span class="text-blue input_unit" id="txt">g/mol</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="drop4" class="label anderson">{!! $lang['14'] !!}:</label>
                                <select name="drop4" id="drop4" class="input">
                                    @php
                                        $name = [$lang['15']." ppm",$lang['15']." mg/m3"];
                                        $val = ["1","2"];
                                        optionsList($val,$name,isset(request()->drop4)?request()->drop4:'');
                                    @endphp
                                </select>
                        </div>
                        <div class="space-y-2 ">
                            <label for="third" class="label" id="text_change2">Xppm:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->third)?request()->third:'2' }}" />
                                <span class="text-blue input_unit" id="txt2">ppm</span>
                            </div>
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
                    <div class="w-full">
                        @if($detail['type']=="calculator1")
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 mt-5   gap-4">
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>{!! $lang[4] !!} =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer1'] !!}</strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>{!! $lang[5] !!} =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer2'] !!} <span class="text-[#119154]">(%)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>{!! $lang[6] !!} =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer3'] !!} <span class="text-[#119154]">(‰)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>PPM =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer4'] !!} <span class="text-[#119154]">(PPM)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>PPB =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer5'] !!} <span class="text-[#119154]">(PPB)</span></strong>
                                    </div>
                                </div>
                                <div class="space-y-2 py-2">
                                    <div class="bg-[#F6FAFC] border rounded px-3 py-2">
                                        <strong>PPT =</strong>
                                        <strong class="text-[#119154] font-s-22">{!! $detail['answer6'] !!} <span class="text-[#119154]">(PPT)</span></strong>
                                    </div>
                                </div>
                            </div>
                        @elseif($detail['type']=="calculator2")
                            <p class="text-center text-[20px]"><strong>{!! $lang[16] !!}</strong></p>
                            @if(request()->drop4==1)
                                <p class="text-center"><strong class="text-[#119154]-700 text-[24px]">{!! $detail['jawab2'] !!} <span class="text-[#119154] font-s-20">mg/m3</span></strong></p>
                            @elseif(request()->drop4==2)
                                <p class="text-center"><strong class="text-[#119154]-700 text-[24px]">{!! $detail['jawab2'] !!} <span class="text-[#119154] font-s-20">ppm</span></strong></p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let val = "{{ !empty(request()->calculator_name) ? request()->calculator_name : 'calculator1' }}"
                document.querySelectorAll('.calculators').forEach(function(calculator) {
                    calculator.style.display = 'none';
                });
                document.querySelector('.' + val).style.display = 'block';
                document.querySelectorAll('.pacetab').forEach(function(tab) {
                    tab.classList.remove('tagsUnit');
                });
                document.querySelector('#' + val).classList.add('tagsUnit');
                document.getElementById("calculator_name").value = val;
                document.querySelectorAll('.pacetab').forEach(function(tab) {
                    tab.addEventListener('click', function() {
                        let val = this.getAttribute('data-value');
                        document.querySelectorAll('.calculators').forEach(function(calculator) {
                            calculator.style.display = 'none';
                        });
                        document.querySelector('.' + val).style.display = 'block';
                        document.querySelectorAll('.pacetab').forEach(function(tab) {
                            tab.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                        document.getElementById("calculator_name").value = val;
                    });
                });

                var valNum = document.getElementById('drop3').value;
                document.getElementById('second').value = valNum;

                document.getElementById('drop3').addEventListener('change', function() {
                    var valNum = this.value;
                    document.getElementById('second').value = valNum;
                });

                function operations(){
                    var cal = document.getElementById('operations').value;
                    var pakis = document.getElementById('pakis');
                    var txt1 = document.getElementById('txt1');

                    if (cal == '1') {
                        pakis.textContent = '{!! $lang[4] !!}:';
                        txt1.textContent = '';
                    } else if (cal == '2') {
                        pakis.textContent = '{!! $lang[5] !!}:';
                        txt1.textContent = '%';
                    } else if (cal == '3') {
                        pakis.textContent = '{!! $lang[6] !!}:';
                        txt1.textContent = '‰';
                    } else if (cal == '4') {
                        pakis.textContent = 'PPM:';
                        txt1.textContent = 'ppm';
                    } else if (cal == '5') {
                        pakis.textContent = 'PPB:';
                        txt1.textContent = 'ppb';
                    } else if (cal == '6') {
                        pakis.textContent = 'PPT:';
                        txt1.textContent = 'ppt';
                    }
                }

                operations()

                document.getElementById('operations').addEventListener('change', function() {
                    operations()
                });

                function drop1(){
                    var cal = document.getElementById('drop1').value;
                    var chal1 = document.getElementById('chal1');
                    var chal2 = document.getElementById('chal2');

                    if (cal == '1' || cal == '2') {
                        chal1.style.display = 'block';
                        chal2.style.display = 'block';
                    } else if (cal == '3') {
                        chal1.style.display = 'none';
                        chal2.style.display = 'none';
                    }
                }

                drop1()

                document.getElementById('drop1').addEventListener('change', function() {
                    drop1()
                });

                function drop4(){
                    var cal = document.getElementById('drop4').value;
                    var textChange2 = document.getElementById('text_change2');
                    var txt2 = document.getElementById('txt2');

                    if (cal == '1') {
                        textChange2.textContent = 'Xppm:';
                        txt2.textContent = 'ppm';
                    } else if (cal == '2') {
                        textChange2.textContent = 'Xmg/m3:';
                        txt2.textContent = 'mg/m3';
                    }
                }

                drop4()

                document.getElementById('drop4').addEventListener('change', function() {
                    drop4()
                });
            });
        </script>
    @endpush
</form>