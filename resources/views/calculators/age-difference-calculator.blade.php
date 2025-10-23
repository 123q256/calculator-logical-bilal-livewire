<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto  rounded-lg  space-y-6 my-3">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

            <div class="w-full mx-auto my-2 ">
                <input type="hidden" name="selection" id="calculator_time" value="{{ isset(request()->selection) ? request()->selection : '1' }}">
                <div class="grid grid-cols-1  lg:grid-cols-3 md:grid-cols-3  gap-4 flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 ">
                    <div class="space-y-2  px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white   pacetab {{ isset(request()->selection) && request()->selection !== '1'  ? '' :'tagsUnit' }}" id="btw_first" onclick="change_tab(tab_val='f_tab')">
                            Birthdates
                        </div>
                    </div>
                    <div class="space-y-2  px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === '2'  ? 'tagsUnit' :'' }}" id="btw_second"  onclick="change_tab(tab_val='s_tab')">
                            Years
                        </div>
                    </div>
                    <div class="space-y-2  px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === '3'  ? 'tagsUnit' :'' }}" id="btw_third" onclick="change_tab(tab_val='t_tab')">
                            Ages
                        </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-5 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2   birthdates {{ isset(request()->selection) && request()->selection !== '1'  ? 'hidden' :'d-block' }}">
                    <label for="dob_f" class="font-s-14 text-blue">Birthday of First Person:</label>
                    <input type="date" name="dob_f" id="dob_f" class="input" aria-label="input" value="{{ isset(request()->dob_f) ? request()->dob_f : '1999-11-05' }}" />
                </div>
                <div class="space-y-2   birthdates {{ isset(request()->selection) && request()->selection !== '1'  ? 'hidden' :'d-block' }}">
                    <label for="dob_s" class="font-s-14 text-blue">Birthday of Second Person:</label>
                    <input type="date" name="dob_s" id="dob_s" class="input" aria-label="input" value="{{ isset(request()->dob_s) ? request()->dob_s : '1999-08-07' }}" />
                </div>
                <div class="space-y-2    years {{ isset(request()->selection) && request()->selection == '2'  ? 'd-block' :'hidden' }}">
                    <label for="year_1" class="font-s-14 text-blue">Birth Year 1:</label>
                    <select name="year_1" id="year_1" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $startYear = 1910;
                            $currentYear = date("Y");
                            $name = [];
                            $val = [];
                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                $name[] = $year;
                                $val[] = $year;
                            }
                            optionsList($val,$name,isset($_POST['year_1'])?$_POST['year_1']: 2002);
                        @endphp
                    </select>
                </div>
                <div class="space-y-2   years {{ isset(request()->selection) && request()->selection == '2'  ? 'd-block' :'hidden' }}">
                    <label for="year_2" class="font-s-14 text-blue">Birth Year 2:</label>
                    <select name="year_2" id="year_2" class="input">
                        @php 
                            $startYear = 1910;
                            $currentYear = date("Y");
                            $name = [];
                            $val = [];
                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                $name[] = $year;
                                $val[] = $year;
                            }
                            optionsList($val,$name,isset($_POST['year_2'])?$_POST['year_2']: $currentYear);
                        @endphp
                    </select>
                </div>
                <div class="space-y-2   ages {{ isset(request()->selection) && request()->selection == '3'  ? 'd-block' :'hidden' }}">
                    <label for="age_1" class="font-s-14 text-blue">Age 1:</label>
                    <input type="number" name="age_1" id="age_1" class="input" aria-label="input" value="{{ isset(request()->age_1) ? request()->age_1 : '21' }}" />
                </div>
                <div class="space-y-2   ages {{ isset(request()->selection) && request()->selection == '3'  ? 'd-block' :'hidden' }}">
                    <label for="age_2" class="font-s-14 text-blue">Age 2:</label>
                    <input type="number" name="age_2" id="age_2" class="input" aria-label="input" value="{{ isset(request()->age_2) ? request()->age_2 : '25' }}" />
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
</div>
</div>



        
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                        <div class="my-2">
                            <div class="lg:w-3/4 w-full text-lg">
                                <table class="w-full">
                                    <tr>
                                        <td class="w-7/12 border-b py-2 font-semibold">Age Difference :</td>
                                        <td class="border-b py-2">
                                            <b><?= $detail['age_diff_Year'] ?></b> Years 
                                            <b><?= isset($detail['age_diff_Month']) ? $detail['age_diff_Month'] : '' ?></b> 
                                            {{ isset($detail['age_diff_Month']) ? 'Months' : '' }}
                                            <b><?= isset($detail['age_diff_Day']) ? $detail['age_diff_Day'] : '' ?></b> 
                                            {{ isset($detail['age_diff_Day']) ? 'Days' : '' }}
                                        </td>
                                    </tr>
                                    @if(isset($detail['age_diff_remaining_days']))
                                    <tr>
                                        <td class="border-b py-2 font-semibold">Age Difference in Weeks :</td>
                                        <td class="border-b py-2">
                                            <b><?= $detail['age_diff_weeks'] ?></b> Weeks <b><?= $detail['age_diff_remaining_days'] ?></b> Days
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="border-b py-2 font-semibold">Age Difference in Days:</td>
                                        <td class="border-b py-2">
                                            <b class="text-2xl text-blue-500"><?= $detail['age_diff_in_days'] ?></b> Days
                                        </td>
                                    </tr>
                                    @if(request()->selection == 1)
                                    <tr>
                                        <td class="w-7/12 border-b py-2 font-semibold">First Person is :</td>
                                        <td class="border-b py-2"><?= "{$detail['age_diff_Year']} Years {$detail['age_diff_Month']} Months {$detail['age_diff_Day']} Days" ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold">Age of First Person :</td>
                                        <td class="border-b py-2"><?= "{$detail['ageFYear']} Years {$detail['ageFMonth']} Months {$detail['ageFDay']} Days" ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold">Age of Second Person :</td>
                                        <td class="border-b py-2"><?= "{$detail['ageSYear']} Years {$detail['ageSMonth']} Months {$detail['ageSDay']} Days" ?></td>
                                    </tr>
                                    @endif
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
		 function change_tab(element) {
            if (element === "f_tab") {
                document.getElementById("btw_first").classList.add('tagsUnit');
                document.getElementById("btw_second").classList.remove('tagsUnit');
                document.getElementById("btw_third").classList.remove('tagsUnit');
                document.querySelectorAll('.birthdates').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.years, .ages').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelector('[name="selection"]').value = "1";
            } else if (element === "s_tab") {
                document.getElementById("btw_second").classList.add('tagsUnit');
                document.getElementById("btw_first").classList.remove('tagsUnit');
                document.getElementById("btw_third").classList.remove('tagsUnit');
                document.querySelectorAll('.birthdates, .ages').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('.years').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelector('[name="selection"]').value = "2";
            } else {
                document.getElementById("btw_third").classList.add('tagsUnit');
                document.getElementById("btw_first").classList.remove('tagsUnit');
                document.getElementById("btw_second").classList.remove('tagsUnit');
                document.querySelectorAll('.birthdates, .years').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('.ages').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelector('[name="selection"]').value = "3";
            }
        }
	</script>
@endpush