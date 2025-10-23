<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-6">
                <label for="initial" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="initial" id="initial" class="input" aria-label="input"
                        placeholder="413" value="{{ isset($_POST['initial']) ? $_POST['initial'] : '10000' }}" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="discount" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="discount" id="discount" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['discount']) ? $_POST['discount'] : '50' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 ">
                <div class="grid grid-cols-12 mt-3  gap-4 add_year">
                <div class="col-span-12 ">
                    <p class="col mx-3"><strong>{{ $lang[3] }}</strong></p>
                </div>
                <div class="col-span-6">
                    <label for="year0" class="label">{{ $lang['4'] }} 1</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year[]" id="year0" class="input" aria-label="input"
                            placeholder="413" value="{{ isset($_POST['year[]']) ? $_POST['year[]'] : '5000' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="year1" class="label">{{ $lang['4'] }} 2</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year[]" id="year1" class="input" aria-label="input"
                            placeholder="413" value="{{ isset($_POST['year[]']) ? $_POST['year[]'] : '5000' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="year2" class="label">{{ $lang['4'] }} 3</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year[]" id="year2" class="input" aria-label="input"
                            placeholder="413" value="{{ isset($_POST['year[]']) ? $_POST['year[]'] : '5000' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="year3" class="label">{{ $lang['4'] }} 4</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year[]" id="year3" class="input" aria-label="input"
                            placeholder="413" value="{{ isset($_POST['year[]']) ? $_POST['year[]'] : '5000' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="year4" class="label">{{ $lang['4'] }} 5</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year[]" id="year4" class="input" aria-label="input"
                            placeholder="413" value="{{ isset($_POST['year[]']) ? $_POST['year[]'] : '5000' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="year5" class="label">{{ $lang['4'] }} 6</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="year[]" id="year5" class="input"
                            aria-label="input" placeholder="413"
                            value="{{ isset($_POST['year[]']) ? $_POST['year[]'] : '5000' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                @isset($_POST['year'])
                    @for ($i = 6; $i < count($_POST['year']); $i++)
                        <div class="col-span-6">
                            <label for="year{{$i}}" class="label">{{ $lang['4'] }}
                                {{ $i + 1 }}</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="year[]" id="year{{$i}}" class="input"
                                    aria-label="input" placeholder="413" value="{{ $_POST['year'][$i] }}" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                    @endfor
                @endisset
            </div>
            </div>
            <div class="col-span-12  text-end mt-3">
                <button type="button" name="submit" title="Add New Time" id="newRow" onclick="add_row(this)"
                    class="px-3 py-2 mx-1 addmore bg-[#2845F5] text-white rounded-[10px]"><span>+</span>{{ $lang[5] }}</button>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            @php $chal_v = $detail['dataPoints'] @endphp
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                <td class="py-2 border-b"> {{ $currancy }} {{ $detail['npv_ans'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['gross_return'] }}%</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] }} </strong></td>
                                <td class="py-2 border-b"> {{ $currancy }} {{ $detail['net_cash_flow'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 text-center text-[20px] mt-4">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    @if (isset($error))

        <script>
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'remove_input') {
                    event.target.closest('div').remove();
                    x--;
                    updateLabels();
                }
            });
            var numbers = {{ count($_POST['year']) + 1 }};
            var x = numbers;

            function add_row(element) {
                if (x < 100) {
                    var read =
                        '<div class="col-span-6">' +
                        '<label for="year" class="label flex justify-between">' +
                        '<span class="text-blue"> <?php echo $lang[4]; ?> ' + (x) + ' </span>' +
                        '<img src="<?php echo asset('images/delete_btn.png'); ?>" width="15" height="auto" class="right object-contain" alt="<?php echo $cal_name; ?>" id="remove_input">' +
                        '</label>' +
                        '<div class="w-100 py-2 relative">' +
                        '<input type="number" step="any" name="year[]" id="year" class="input" aria-label="input" placeholder="413" value="<?php echo isset($_POST['year[]']) ? $_POST['year[]'] : '5000'; ?>" />' +
                        '<span class="text-blue input_unit"><?php echo $currancy; ?></span>' +
                        '</div>' +
                        '</div>';

                    document.querySelector(".add_year").insertAdjacentHTML('beforeend', read);
                    x++;
                    updateLabels();
                } else {
                    alert('<?php echo $lang[11]; ?>');
                }
            }

            function updateLabels() {
                var labels = document.querySelectorAll('.add_year .col-lg-6 .font-s-14 .text-blue');
                labels.forEach(function(label, index) {
                    label.textContent = ' <?php echo $lang[4]; ?> ' + (index + numbers);
                });
            }
            // Initial call to updateLabels to correct any initial discrepancies
            updateLabels();
        </script>
    @elseif(isset($detail))
        <script>
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'remove_input') {
                    event.target.closest('div').remove();
                    x--;
                    updateLabels();
                }
            });


            var numbers = {{ count($_POST['year']) + 1 }};
            var x = numbers;

            function add_row(element) {
                if (x < 100) {
                    var read =
                        '<div class="col-span-6">' +
                        '<label for="year" class="label flex justify-between">' +
                        '<span class="text-blue"> <?php echo $lang[4]; ?> ' + (x) + ' </span>' +
                        '<img src="<?php echo asset('images/delete_btn.png'); ?>" width="15" height="auto" class="right object-contain" alt="<?php echo $cal_name; ?>" id="remove_input">' +
                        '</label>' +
                        '<div class="w-100 py-2 relative">' +
                        '<input type="number" step="any" name="year[]" id="year" class="input" aria-label="input" placeholder="413" value="<?php echo isset($_POST['year[]']) ? $_POST['year[]'] : '5000'; ?>" />' +
                        '<span class="text-blue input_unit"><?php echo $currancy; ?></span>' +
                        '</div>' +
                        '</div>';

                    document.querySelector(".add_year").insertAdjacentHTML('beforeend', read);
                    x++;
                    updateLabels();
                } else {
                    alert('<?php echo $lang[11]; ?>');
                }
            }

            function updateLabels() {
                var labels = document.querySelectorAll('.add_year .col-lg-6 .font-s-14 .text-blue');
                labels.forEach(function(label, index) {
                    label.textContent = ' <?php echo $lang[4]; ?> ' + (index + numbers);
                });
            }
            // Initial call to updateLabels to correct any initial discrepancies
            updateLabels();
        </script>
    @else
        <script>
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'remove_input') {
                    event.target.closest('div').remove();
                    x--;
                    updateLabels();
                }
            });

            var x = 7;

            function add_row(element) {
                if (x < 100) {
                    var read =
                        '<div class="col-span-6">' +
                        '<label for="year" class="label flex justify-between">' +
                        '<span class="text-blue"> <?php echo $lang[4]; ?> ' + (x) + ' </span>' +
                        '<img src="<?php echo asset('images/delete_btn.png'); ?>" width="15" height="auto" class="right object-contain" alt="<?php echo $cal_name; ?>" id="remove_input">' +
                        '</label>' +
                        '<div class="w-100 py-2 relative">' +
                        '<input type="number" step="any" name="year[]" id="year" class="input" aria-label="input" placeholder="413" value="<?php echo isset($_POST['year[]']) ? $_POST['year[]'] : '5000'; ?>" />' +
                        '<span class="text-blue input_unit"><?php echo $currancy; ?></span>' +
                        '</div>' +
                        '</div>';

                    document.querySelector(".add_year").insertAdjacentHTML('beforeend', read);
                    x++;
                    updateLabels();
                } else {
                    alert('<?php echo $lang[11]; ?>');
                }
            }

            function updateLabels() {
                var labels = document.querySelectorAll('.add_year .col-lg-6 .font-s-14 .text-blue');
                labels.forEach(function(label, index) {
                    label.textContent = ' <?php echo $lang[4]; ?> ' + (index + 7);
                });
            }
            // Initial call to updateLabels to correct any initial discrepancies
            updateLabels();
        </script>
    @endisset
    <script>
        @if (isset($detail))
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                    title: {
                        text: "{{ $lang[9] }}"
                    },
                    axisY: {
                        title: "{{ $lang[8] }} ({{ $currancy }})"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "{{ $lang[10] }}",
                        dataPoints: <?= $chal_v ?>
                    }],
                });
                chart.render();
            }
        @endisset
    </script>
@endpush
