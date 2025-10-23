<style>
    #add_hour:hover, #add_overtime:hover{
        text-decoration: underline
    }
    .input_unit{
        top: 21px !important
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       @php $request = request(); @endphp
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12"><b class="label">How often are you paid?</b></p>
            <div class="col-span-6">
                <label for="paytype" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2"> 
                    <select name="paytype" id="paytype" class="input" aria-label="select">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Weekly", "Bi-Weekly", "Monthly", "Semi-Monthly"];
                            $val = ["52", "26", "12", "24"];
                            optionsList($val,$name,isset($request->paytype)?$request->paytype:'52');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="status" class="label">Your Filing Status?</label>
                <div class="w-full py-2"> 
                    <select name="status" id="status" class="input">
                        @php
                            $name = ["Single", "Married", "Head of the House"];
                            $val = ["single", "married", "head_of_household"];
                            optionsList($val,$name,isset($_POST['status'])?$_POST['status']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <p class="col-span-12"><b class="label">How are you paid?</b></p>
            <div class="col-span-4">
                <p class="label">Type:</p>
                <div class="w-full py-2">
                    <select name="paidtype[]" class="input" aria-label="select" onchange="change_paid(this)">
                        <option value="hourly">Hourly</option>
                        <option value="salary" {{ isset($request->paidtype[0]) && $request->paidtype[0]=='salary'?'selected':'' }}>Salary</option>
                    </select>
                </div>
            </div>
            <div class="col-span-4 salary {{ isset($request->paidtype[0]) && $request->paidtype[0] === 'salary' ? '' : 'd-none' }}">
                <p class="label">Gross Pay Method:</p>
                <div class="w-full py-2">
                    <select name="grosspay[]" class="input" aria-label="select">
                        <option value="per_year">Per Year</option>
                        <option value="pay_period" {{ isset($request->grosspay[0]) && $request->grosspay[0]=='pay_period'?'selected':'' }}>Pay Per Period</option>
                    </select>
                </div>
            </div>
            <div class="col-span-4 hourly {{ isset($request->paidtype[0]) && $request->paidtype[0] === 'salary' ? 'd-none' : '' }}">
                <p class="label">{{ $lang['3'] }}:</p>
                <div class="w-full py-2 position-relative"> 
                    <input type="number" step="any" name="working[]" class="input" aria-label="input"  value="{{ isset($request->working[0])?$request->working[0]:'8' }}" />
                    <span class="text-blue input_unit">{{$currancy}}</span>
                </div>
            </div>
            <div class="col-span-4">
                <p class="label">{{ $lang['2'] }}:</p>
                <div class="w-full py-2 position-relative"> 
                    <input type="number" step="any" name="wage[]" class="input" aria-label="input"  value="{{ isset($request->wage[0])?$request->wage[0]:'15' }}" />
                    <span class="text-blue input_unit">{{$currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
            @isset($request->submit)
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    @for ($i = 1; $i < count($request->paidtype); $i++)
                        <div class="col-span-4">
                            <p class="label">Type:</p>
                            <div class="w-full py-2">
                                <select name="paidtype[]" class="input" aria-label="select" onchange="change_paid(this)">
                                    <option value="hourly" {{ isset($request->paidtype[$i]) && $request->paidtype[$i]=='hourly'?'selected':'' }}>Hourly</option>
                                    <option value="salary" {{ isset($request->paidtype[$i]) && $request->paidtype[$i]=='salary'?'selected':'' }}>Salary</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-4 salary {{ isset($request->paidtype[$i]) && $request->paidtype[$i] === 'salary' ? '' : 'd-none' }}">
                            <p class="label">Gross Pay Method:</p>
                            <div class="w-full py-2">
                                <select name="grosspay[]" class="input" aria-label="select">
                                    <option value="per_year" {{ isset($request->grosspay[$i]) && $request->grosspay[$i]=='per_year'?'selected':'' }}>Per Year</option>
                                    <option value="pay_period" {{ isset($request->grosspay[$i]) && $request->grosspay[$i]=='pay_period'?'selected':'' }}>Pay Per Period</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-4 hourly {{ isset($request->paidtype[$i]) && $request->paidtype[$i] === 'salary' ? 'd-none' : '' }}">
                            <p class="label">{{ $lang['3'] }}:</p>
                            <div class="w-full py-2 position-relative"> 
                                <input type="number" step="any" name="working[]" class="input" aria-label="input"  value="{{ isset($request->working[$i])?$request->working[$i]:'8' }}" />
                                <span class="text-blue input_unit">{{$currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <p class="label">{{ $lang['2'] }}:</p>
                            <div class="w-full py-2 position-relative"> 
                                <input type="number" step="any" name="wage[]" class="input" aria-label="input"  value="{{ isset($request->wage[$i])?$request->wage[$i]:'15' }}" />
                                <span class="text-blue input_unit">{{$currancy}}</span>
                            </div>
                        </div>
                    @endfor
                </div>
            @endisset
            </div>
            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" id="newpaid">
                </div>
            </div>
            <div class="col-span-12 flex px-2 items-center">
                <img loading="lazy" decoding="async" src="{{ asset('images/hourly_add.png') }}" alt="more hourly add icon" height="15px" width="15px">
                <p class="label ms-1 text-blue-500 cursor-pointer" id="add_hour" onclick="more_paid()">Add Another</p>
            </div>
            <p class="col-span-12"><b class="label">Any overtime?</b></p>
            <div class="col-span-4">
                <p class="label">Type:</p>
                <div class="w-full py-2">
                    <select name="overtimeType[]" class="input" aria-label="select">
                        <option value="overtime">Overtime</option>
                        <option value="doubletime" {{ isset($request->overtimeType[0]) && $request->overtimeType[0]=='doubletime'?'selected':'' }}>Double Time</option>
                    </select>
                </div>
            </div>
            <div class="col-span-4">
                <p class="label">{{ $lang['3'] }}:</p>
                <div class="w-full py-2 position-relative"> 
                    <input type="number" step="any" name="h_over[]" class="input" aria-label="input"  value="{{ isset($request->h_over[0])?$request->h_over[0]:'' }}" placeholder="0" />
                    <span class="text-blue input_unit">{{$currancy}}</span>
                </div>
            </div>
            <div class="col-span-4">
                <p class="label">{{ $lang['2'] }}:</p>
                <div class="w-full py-2 position-relative"> 
                    <input type="number" step="any" name="w_over[]" class="input" aria-label="input"  value="{{ isset($request->w_over[0])?$request->w_over[0]:'' }}" placeholder="0" />
                    <span class="text-blue input_unit">{{$currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
            @isset($request->submit)
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    @for ($i = 1; $i < count($request->overtimeType); $i++)
                        <div class="col-span-4">
                            <p class="label">Type:</p>
                            <div class="w-full py-2">
                                <select name="overtimeType[]" class="input" aria-label="select">
                                    <option value="overtime" {{ isset($request->overtimeType[$i]) && $request->overtimeType[$i]=='overtime'?'selected':'' }}>Overtime</option>
                                    <option value="doubletime" {{ isset($request->overtimeType[$i]) && $request->overtimeType[$i]=='doubletime'?'selected':'' }}>Double Time</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <p class="label">{{ $lang['3'] }}:</p>
                            <div class="w-full py-2 position-relative"> 
                                <input type="number" step="any" name="h_over[]" class="input" aria-label="input"  value="{{ isset($request->h_over[$i])?$request->h_over[$i]:'' }}" placeholder="0" />
                                <span class="text-blue input_unit">{{$currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <p class="label">{{ $lang['2'] }}:</p>
                            <div class="w-full py-2 position-relative"> 
                                <input type="number" step="any" name="w_over[]" class="input" aria-label="input"  value="{{ isset($request->w_over[$i])?$request->w_over[$i]:'' }}" placeholder="0" />
                                <span class="text-blue input_unit">{{$currancy}}</span>
                            </div>
                        </div>
                    @endfor
                </div>
            @endisset
            </div>
            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" id="newovertime">

                </div>
            </div>
            <div class="col-span-12 flex px-2 items-center">
                <img loading="lazy" decoding="async" src="{{ asset('images/hourly_add.png') }}" alt="more overtime add icon" height="15px" width="15px">
                <p class="label ms-1 text-blue-500 cursor-pointer" id="add_overtime" onclick="more_overtime()">Add Another</p>
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
                        <div class="w-full my-2">
                            <div class="text-center">
                                <p class="font-s-20"><strong>Take Home Salary</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">{{$currancy}} {{$detail['take_home']}}</strong></p>
                            </div>
                        </div>
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[16px]">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2 text-[18px]"><b>Earnings</b></td>
                                        <td class="border-b py-2 text-[18px]"><b>{{$currancy}} {{$detail['total_weekly_salary']}}</b></td>
                                    </tr>
                                    @for ($i = 0; $i < count($detail['salaries']); $i++)
                                        <tr>
                                            <td class="border-b py-2">{!! $request->paidtype[$i] === "hourly" 
                                                ? "Hourly <span class='font-s-12'>(" . $currancy . $request->working[$i] . " × " . $currancy . $request->wage[$i] . ")</span>" 
                                                : "Salary <span class='font-s-12'>(" . ($request->grosspay[$i] === "per_year" ? "Per Year" : "Pay Per Period") . ")</span>" !!}
                                            </td>
                                            <td class="border-b py-2">{{$currancy}} {{round($detail['salaries'][$i], 2)}}</td>
                                        </tr>
                                    @endfor
                                    @isset($detail['overtimes'])
                                        @for ($i = 0; $i < count($detail['overtimes']); $i++)
                                            <tr>
                                                <td class="border-b py-2">{!! $request->overtimeType[$i] === "overtime" 
                                                    ? "Overtime <span class='font-s-12'>(1.5 × ".$request->h_over[$i]." hrs × ".$currancy.$request->w_over[$i] . ")</span>" 
                                                    : "Double Time <span class='font-s-12'>(2 × ".$request->h_over[$i]." hrs × ".$currancy.$request->w_over[$i] . ")</span>" !!}
                                                </td>
                                                <td class="border-b py-2">{{$currancy}} {{round($detail['overtimes'][$i], 2)}}</td>
                                            </tr>
                                        @endfor
                                    @endisset
                                    <tr>
                                        <td class="border-b py-2 text-[18px]"><b>Taxes</b></td>
                                        <td class="border-b py-2 text-[18px]"><b>{{$currancy}} {{$detail['total_tax']}}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Federal Income Tax</td>
                                        <td class="border-b py-2">{{$currancy}} {{$detail['federalTax']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Medicare Tax</td>
                                        <td class="border-b py-2">{{$currancy}} {{$detail['medicareTax']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Social Security Tax</td>
                                        <td class="border-b py-2">{{$currancy}} {{$detail['socialSecurityTax']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 text-[18px]"><b>Benefits</b></td>
                                        <td class="border-b py-2 text-[18px]"><b>{{$currancy}} 0</b></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 text-[18px]"><b>Take Home</b></td>
                                        <td class="border-b py-2 text-[18px]"><b>{{$currancy}} {{$detail['take_home']}}</b></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%]  mx-auto mt-3">
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                        <div class="pay-calc-graph"></div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        let x = 1;
        let y = 1;
        function more_overtime() {
            if (21 > x) {
                var read = `
                    <div class="col-span-4">
                        <p class="label">Type:</p>
                        <div class="w-full py-2">
                            <select name="overtimeType[]" class="input" aria-label="select">
                                <option value="overtime">Overtime</option>
                                <option value="doubletime">Double Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <p class="label">{{ $lang['3'] }}:</p>
                        <div class="w-full py-2 position-relative"> 
                            <input type="number" step="any" name="h_over[]" class="input" aria-label="input"  value="" placeholder="0" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <p class="label">{{ $lang['2'] }}:</p>
                        <div class="w-full py-2 position-relative"> 
                            <input type="number" step="any" name="w_over[]" class="input" aria-label="input"  value="" placeholder="0" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                `;
                document.getElementById('newovertime').insertAdjacentHTML('beforeend', read);
            } else {
                alert('Only Twenty Fields are Allowed');
            }
            x++;
        }
        function more_paid() {
            if (21 > y) {
                var read = `
                    <div class="col-span-4">
                        <p class="label">Type:</p>
                        <div class="w-full py-2">
                            <select name="paidtype[]" class="input" aria-label="select" onchange="change_paid(this)">
                                <option value="hourly">Hourly</option>
                                <option value="salary">Salary</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4 salary d-none">
                        <p class="label">Gross Pay Method:</p>
                        <div class="w-full py-2">
                            <select name="grosspay[]" class="input" aria-label="select">
                                <option value="per_year">Per Year</option>
                                <option value="pay_period">Pay Per Period</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4 hourly">
                        <p class="label">{{ $lang['3'] }}:</p>
                        <div class="w-full py-2 position-relative"> 
                            <input type="number" step="any" name="working[]" class="input" aria-label="input"  value="8" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <p class="label">{{ $lang['2'] }}:</p>
                        <div class="w-full py-2 position-relative"> 
                            <input type="number" step="any" name="wage[]" class="input" aria-label="input"  value="15" />
                            <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                `;
                document.getElementById('newpaid').insertAdjacentHTML('beforeend', read);
            } else {
                alert('Only Twenty Fields are Allowed');
            }
            y++;
        }
        function change_paid(element) {
            const selectedValue = element.value;
            let nextSibling = element.closest(".col-lg-4").nextElementSibling;

            while (nextSibling && !nextSibling.classList.contains("salary") && !nextSibling.classList.contains("hourly")) {
                nextSibling = nextSibling.nextElementSibling;
            }

            if (nextSibling && nextSibling.classList.contains("salary")) {
                nextSibling.style.display = selectedValue === "salary" ? "block" : "none";
                nextSibling = nextSibling.nextElementSibling;

                if (nextSibling && nextSibling.classList.contains("hourly")) {
                    nextSibling.style.display = selectedValue === "hourly" ? "block" : "none";
                }
            } else if (nextSibling && nextSibling.classList.contains("hourly")) {
                nextSibling.style.display = selectedValue === "hourly" ? "block" : "none";
                nextSibling = nextSibling.nextElementSibling;

                if (nextSibling && nextSibling.classList.contains("salary")) {
                    nextSibling.style.display = selectedValue === "salary" ? "block" : "none";
                }
            }
        }
    </script>
    @isset($detail)
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <script>
            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    // title:{
                    //     text: "Email Categories",
                    //     horizontalAlign: "left"
                    // },
                    data: [{
                        type: "doughnut",
                        startAngle: 60,
                        indexLabelFontSize: 16,
                        // indexLabel: "{label} - #percent%",
                        indexLabel: "{label} - {{$currancy}} {y}",
                        toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                        dataPoints: [
                            { y: {{$detail['take_home']}}, label: "Take Home" },
                            { y: {{$detail['total_tax']}}, label: "Taxes" },
                        ]
                    }]
                });
                chart.render();
                }
        </script>
    @endisset
@endpush