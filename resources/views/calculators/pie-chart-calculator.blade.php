<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if (!isset($detail))    
      
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-3  gap-4">
                <div class="w-full">
                    <div class="grid grid-cols-12 gap-4" id="myForm">
                        <div class="col-span-6">
                            <label for="choices1" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="choices[]" required id="choices1" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="choices2" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="choices[]" required id="choices2" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="choices3" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="choices[]" required id="choices3" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="choices4" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="choices[]" required id="choices4" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4" id="dynamicInputs">
            
                    </div>
                </div>
                <div class="w-full flex justify-end px-2">
                    <button type="button" id="addInputButton" class="bg-[#2845F5] text-white border radius-10 px-4 py-1"><strong class="text-blue"><span class="font-s-18 text-blue">+</span> &nbsp;Add</strong></button>
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
    @endif
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-2">
                        <div class="w-full">
                            @php
                                $letters = $detail['letters'];
                                $values = $detail['values'];
                                $percentage = $detail['percentage'];
                                $degree = $detail['degree'];
                                $chal_v = $detail['new_combine'];
                            @endphp
                            <div class="w-full overflow-auto mt-3">
                                <table class="w-full" style="border-collapse: collapse">
                                    <tr class="bg-sky">
                                        <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['5'] ?></strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['6'] ?></strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['7'] ?></strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['8'] ?></strong></td>
                                    </tr>
                                    @php
                                        $totalRows = max(count($letters), count($values), count($percentage), count($degree));
                                        for ($i = 0; $i < $totalRows; $i++) {
                                            echo "<tr class='bg-white'>";
                                            echo "<td class='p-2 border text-center'>" . $letters[] = ($i < count($letters) ? $letters[$i] : "") . "</td>";
                                            echo "<td class='p-2 border text-center'>" . $values[] = ($i < count($values) ? $values[$i] : "") . "</td>";
                                            echo "<td class='p-2 border text-center'>" . ($i < count($percentage) ? $percentage[$i] : "") . " %" . "</td>";
                                            echo "<td class='p-2 border text-center'>" . ($i < count($degree) ? $degree[$i] : "") . "°" . "</td>";
                                            echo "</tr>";
                                        }
                                    @endphp
                                </table>
                            </div>
                            <div class="w-full mt-3 mb-5">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                            <div class="w-full text-center my-[20px]">
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
        </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <script>
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Pie Chart"
                },
                data: [{
                    type: "pie",
                    startAngle: 25,
                    toolTipContent: "<b>{label}</b>: {y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - {y}",
                    dataPoints: <?= $chal_v ?>
                }]
            });

            chart.render();
        </script>
    @endif
    <script>
        const maxInputs = 20;
        let currentGroup = 4;

        // Function to add a new input field with group labels
        function addInput() {
            const dynamicInputs = document.getElementById('dynamicInputs');

            if (currentGroup < maxInputs) {
                const inputNumber = currentGroup + 1; // Start numbering from 3 (default inputs)
                const groupName = String.fromCharCode(65 + currentGroup); // A, B, C, ...

                const div = document.createElement('div');
                div.classList.add('col-span-6', 'position-relative');
                div.innerHTML = `
                    <label for="choices${inputNumber}" class="font-s-14 text-blue">Group ${groupName} :</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="choices[]" required id="choices${inputNumber}" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <img src="{{url('assets/img/close.png')}}" alt="Remove" onclick="removeInput(this)" width='13' style="position:absolute;right:10px;top:7px" class="remove">
                `;
                    
                dynamicInputs.appendChild(div);

                currentGroup++;
            } else {
                alert('You have reached the maximum limit of ' + maxInputs + ' groups.');
            }
        }

        // Function to remove an input field and decrement the group count
        function removeInput(button) {
            const dynamicInputs = document.getElementById('dynamicInputs');
            const div = button.parentElement;
            dynamicInputs.removeChild(div);
            currentGroup--;
        }

        // Add an event listener to the "Add Input" button
        if (document.getElementById('addInputButton')) {
            document.getElementById('addInputButton').addEventListener('click', addInput);
        }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>