<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <input type="hidden" name="mycurrency" value="{{ $currancy }}" id="mycurrency">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input"
                        placeholder="15" value="{{ isset($_POST['first']) ? $_POST['first'] : '15' }}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input"
                        placeholder="500" value="{{ isset($_POST['second']) ? $_POST['second'] : '500' }}" />
                    <span class="input_unit">{{ $currancy }}</span>
                </div>
                <div class="space-y-2">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="third" id="third"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full"
                            value="{{ isset($_POST['third']) ? $_POST['third'] : '5' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit']) ? $_POST['t_unit'] : '%' }}
                            ▾</label>
                        <input type="text" name="t_unit"
                            value="{{ isset($_POST['t_unit']) ? $_POST['t_unit'] : '%' }}" id="t_unit"
                            class="hidden">
                        <div id="t_unit_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', '%')">%</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                onclick="setUnit('t_unit', {{ $currancy }})">{{ $currancy }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 relative">
                    <label for="four" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <input type="number" step="any" name="four" id="four" class="input" aria-label="input"
                        placeholder="500" value="{{ isset($_POST['four']) ? $_POST['four'] : '500' }}" />
                    <span class="input_unit">{{ $currancy }}</span>
                </div>
                <div class="space-y-2">
                    <label for="five" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="five" id="five"
                            class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                            value="{{ isset($_POST['five']) ? $_POST['five'] : '5' }}" aria-label="input"
                            placeholder="00" oninput="checkInput()" />
                        <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                            onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit']) ? $_POST['f_unit'] : '%' }}
                            ▾</label>
                        <input type="text" name="f_unit"
                            value="{{ isset($_POST['f_unit']) ? $_POST['f_unit'] : '%' }}" id="f_unit"
                            class="hidden">
                        <div id="f_unit_dropdown"
                            class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', '%')">%</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                onclick="setUnit('f_unit', {{ $currancy }})">{{ $currancy }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="cgt" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <input type="number" step="any" name="cgt" id="cgt" class="input"
                        aria-label="input" placeholder="6"
                        value="{{ isset($_POST['cgt']) ? $_POST['cgt'] : '6' }}" />
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
        {{-- result --}}

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue  rounded-lg mt-6">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-4">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[3] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['b_c'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['netby_ans'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[5] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['s_c'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[7] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ round($detail['netsa_ans']) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[8] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ round($detail['profit']) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[9] }} (ROI) </strong></td>
                                    <td class="py-2 border-b">{{ round($detail['roi_ans'], 4) }} %</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-4/5"><strong>{{ $lang[10] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ round($detail['break_ans'], 2) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-center text-xl mt-6">
                            <div class="my-4">
                                <div id="chartContainer" class="h-44 w-full"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    @isset($detail)
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script>
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Stock Calculator"
                    },
                    axisX: {
                        interval: 1
                    },
                    axisY2: {
                        interlacedColor: "#2845F5",
                        gridColor: "rgb(39 52 131)"
                    },
                    data: [{
                        type: "bar",
                        name: "companies",
                        axisYType: "secondary",
                        color: "#014D65",
                        dataPoints: [{
                                y: {{ $detail['netby_ans'] }},
                                label: "Net Buy Price"
                            },
                            {
                                y: {{ $detail['netsa_ans'] }},
                                label: "Net Sell Price"
                            }
                        ]
                    }]
                });
                chart.render();
            }
        </script>
    @endisset

@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>