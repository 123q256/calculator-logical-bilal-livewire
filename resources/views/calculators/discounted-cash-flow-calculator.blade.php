<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <label for="main_unit" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <select class="input" name="main_unit" id="main_unit" onchange="mySelection(this)">
                        <option value="{{ $lang[2] }}"
                            {{ isset($_POST['main_unit']) && $_POST['main_unit'] == $lang[2] ? 'selected' : '' }}>
                            {{ $lang[2] }}</option>
                        <option value="{{ $lang[3] }}"
                            {{ isset($_POST['main_unit']) && $_POST['main_unit'] == $lang[3] ? 'selected' : '' }}>
                            {{ $lang[3] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" id="first">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <p class="col-span-12 px-2"><strong><?= $lang[4] ?></strong></p>
                    <div class="col-span-12" >
                        <div class="grid grid-cols-12 mt-3  gap-4" id="inputContainer">
                            @if(isset($error))
                                @foreach ($_POST['input'] as $key => $share_val)
                                <div class="col-span-6">
                                    <label for="input2" class="label">FCFF {{ $key }}</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" name="input[]" id="input{{ $key }}"
                                            class="input" aria-label="input" placeholder="50"
                                            value="{{ $share_val }}" />
                                        <span class=" input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                @if (isset($detail['input']))
                                    @php $i= 1;@endphp
                                    @foreach ($detail['input'] as $value)
                                        <div class="col-span-6">
                                            <label for="input2" class="label">FCFF {{ $i }}</label>
                                            <div class="w-full py-2 relative">
                                                <input type="number" step="any" name="input[]" id="input{{ $i }}"
                                                    class="input" aria-label="input" placeholder="50"
                                                    value="{{ $value }}" />
                                                <span class=" input_unit">{{ $currancy }}</span>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                @else
                                    <div class="col-span-6">
                                        <label for="input1" class="label">FCFF 1</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" name="input[]" id="input1" class="input"
                                                aria-label="input" placeholder="50"
                                                value="{{ isset($_POST['input[]']) ? $_POST['input[]'] : '50' }}" />
                                            <span class=" input_unit">{{ $currancy }}</span>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input2" class="label">FCFF 2</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" name="input[]" id="input2" class="input"
                                                aria-label="input" placeholder="50"
                                                value="{{ isset($_POST['input[]']) ? $_POST['input[]'] : '50' }}" />
                                            <span class=" input_unit">{{ $currancy }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 text-end mt-3">
                        <button type="button" name="submit" id="addInput" onclick="add_row(this)"
                            class="px-3 py-2 mx-1 addmore bg-[#2845F5] text-white rounded-[10px]"><span>+</span>Add </button>
                    </div>
                    <p class="my-2 col-span-12"><strong>{{ $lang[5] }}</strong></p>
                    <div class="col-span-6">
                        <label for="cash" class="label">{{ $lang[6] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="cash" id="cash" class="input"
                                aria-label="input" placeholder="50"
                                value="{{ isset($_POST['cash']) ? $_POST['cash'] : '50' }}" />
                            <span class=" input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="outstanding" class="label">{{ $lang[7] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="outstanding" id="outstanding" class="input"
                                aria-label="input" placeholder="60000"
                                value="{{ isset($_POST['outstanding']) ? $_POST['outstanding'] : '60000' }}" />
                            <span class=" input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <p class="my-2 col-span-12"><strong>{{ $lang[8] }}</strong></p>
                    <div class="col-span-6">
                        <label for="perpetual" class="label">{{ $lang[9] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="perpetual" id="perpetual" class="input"
                                aria-label="input" placeholder="4.48"
                                value="{{ isset($_POST['perpetual']) ? $_POST['perpetual'] : '4.48' }}" />
                            <span class=" input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="wacc" class="label">{{ $lang[10] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="wacc" id="wacc" class="input"
                                aria-label="input" placeholder="4.48"
                                value="{{ isset($_POST['wacc']) ? $_POST['wacc'] : '9.94' }}" />
                            <span class=" input_unit">%</span>
                        </div>
                    </div>
                    <p class="my-2 col-span-12"><strong>{{ $lang[11] }}</strong></p>
                    <div class="col-span-6">
                        <label for="shares" class="label">{{ $lang[12] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="shares" id="shares" class="input"
                                aria-label="input" placeholder="1000"
                                value="{{ isset($_POST['shares']) ? $_POST['shares'] : '1000' }}" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="price" class="label">{{ $lang[13] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="price" id="price" class="input"
                                aria-label="input" placeholder="17"
                                value="{{ isset($_POST['price']) ? $_POST['price'] : '17' }}" />
                            <span class=" input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 hidden" id="second">
                <p class="my-2 px-2"><strong>{{ $lang[14] }}</strong></p>
                <div class="col-lg-6 col-12 px-2  mt-0 mt-lg-2">
                    <label for="earnings" class="label">{{ $lang[15] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="earnings" id="earnings" class="input"
                            aria-label="input" placeholder="200"
                            value="{{ isset($_POST['earnings']) ? $_POST['earnings'] : '200' }}" />
                        <span class=" input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="discount" class="label">{{ $lang[16] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="discount" id="discount" class="input"
                            aria-label="input" placeholder="11"
                            value="{{ isset($_POST['discount']) ? $_POST['discount'] : '11' }}" />
                        <span class=" input_unit">%</span>
                    </div>
                </div>
                <p class="my-2 px-2"><strong>{{ $lang[17] }}</strong></p>
                <div class="col-lg-4 col-12 px-2  mt-0 mt-lg-2">
                    <label for="growth" class="label">{{ $lang[18] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="growth" id="growth" class="input"
                            aria-label="input" placeholder="200"
                            value="{{ isset($_POST['growth']) ? $_POST['growth'] : '200' }}" />
                        <span class=" input_unit">%</span>
                    </div>
                </div>
                <div class="col-5 mt-0 mt-lg-2" id="predictable">
                    <label for="growth_time" class="label">{{ $lang[19] }}...</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="growth_time" id="growth_time" class="input"
                            aria-label="input" placeholder="1"
                            value="{{ isset($_POST['growth_time']) ? $_POST['growth_time'] : '1' }}" />
                        <span class=" input_unit">%</span>
                    </div>
                </div>
                <div class="col-3 px-2  mt-0 mt-lg-2 dubble_input hidden">
                    <label for="growth_time_one" class="label">{{ $lang[19] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="growth_time_one" id="growth_time_one"
                            class="input" aria-label="input" placeholder="200"
                            value="{{ isset($_POST['growth_time_one']) ? $_POST['growth_time_one'] : '200' }}" />
                        <span class=" input_unit">yrs</span>
                    </div>
                </div>
                <div class="col-2 px-2  mt-0 mt-lg-2 dubble_input hidden">
                    <label for="growth_time_sec" class="label">&nbsp;</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="growth_time_sec" id="growth_time_sec"
                            class="input" aria-label="input" placeholder="1"
                            value="{{ isset($_POST['growth_time_sec']) ? $_POST['growth_time_sec'] : '1' }}" />
                        <span class=" input_unit">mos</span>
                    </div>
                </div>
                <div class="col-3 px-2 mt-0 mt-lg-2 ">
                    <label for="growth_unit" class="label">{{ $lang[18] }}</label>
                    <div class="w-full py-2 relative">
                        <select class="input" name="growth_unit" id="growth_unit" onchange="secSelection(this)">
                            <option value="mos"
                                {{ isset($_POST['growth_unit']) && $_POST['growth_unit'] == 'mos' ? 'selected' : '' }}> mos
                            </option>
                            <option value="yrs"
                                {{ isset($_POST['growth_unit']) && $_POST['growth_unit'] == 'yrs' ? 'selected' : '' }}> yrs
                            </option>
                            <option value="yrs/mos"
                                {{ isset($_POST['growth_unit']) && $_POST['growth_unit'] == 'yrs/mos' ? 'selected' : '' }}>
                                yrs/mos</option>
                        </select>
                    </div>
                </div>
                <p class="my-2 px-2"><strong>{{ $lang[20] }}</strong></p>
                <div class="col-lg-4 col-12 px-2  mt-0 mt-lg-2">
                    <label for="terminal" class="label">{{ $lang[21] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="terminal" id="terminal" class="input"
                            aria-label="input" placeholder="200"
                            value="{{ isset($_POST['terminal']) ? $_POST['terminal'] : '200' }}" />
                        <span class=" input_unit">%</span>
                    </div>
                </div>
                <div class="col-5 mt-0 mt-lg-2" id="terminals">
                    <label for="terminal_time" class="label">{{ $lang[19] }}...</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="terminal_time" id="terminal_time" class="input"
                            aria-label="input" placeholder="1"
                            value="{{ isset($_POST['terminal_time']) ? $_POST['terminal_time'] : '1' }}" />
                        <span class=" input_unit">%</span>
                    </div>
                </div>

                <div class="col-3 px-2  mt-0 mt-lg-2 dub_input hidden">
                    <label for="terminal_one" class="label">{{ $lang[19] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="terminal_one" id="terminal_one" class="input"
                            aria-label="input" placeholder="200"
                            value="{{ isset($_POST['terminal_one']) ? $_POST['terminal_one'] : '200' }}" />
                        <span class=" input_unit">yrs</span>
                    </div>
                </div>
                <div class="col-2 px-2  mt-0 mt-lg-2 dub_input hidden">
                    <label for="terminal_sec" class="label">&nbsp;</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="terminal_sec" id="terminal_sec" class="input"
                            aria-label="input" placeholder="1"
                            value="{{ isset($_POST['terminal_sec']) ? $_POST['terminal_sec'] : '1' }}" />
                        <span class=" input_unit">mos</span>
                    </div>
                </div>
                <div class="col-3 px-2 mt-0 mt-lg-2 ">
                    <label for="terminal_unit" class="label">{{ $lang[18] }}</label>
                    <div class="w-full py-2 relative">
                        <select class="input" name="terminal_unit" id="terminal_unit"
                            onchange="threeSelection(this)">
                            <option value="mos"
                                {{ isset($_POST['terminal_unit']) && $_POST['terminal_unit'] == 'mos' ? 'selected' : '' }}>
                                mos</option>
                            <option value="yrs"
                                {{ isset($_POST['terminal_unit']) && $_POST['terminal_unit'] == 'yrs' ? 'selected' : '' }}>
                                yrs</option>
                            <option value="yrs/mos"
                                {{ isset($_POST['terminal_unit']) && $_POST['terminal_unit'] == 'yrs/mos' ? 'selected' : '' }}>
                                yrs/mos</option>
                        </select>
                    </div>
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
    </div>
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @if ($_POST['main_unit'] === 'Earnings per share (EPS)')
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <p class="mt-2"><strong>{{ $lang[28] }}</strong></p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[29] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ round($detail['groeth_answer'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[30] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ round($detail['terminal_answer'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                    <td class="py-2 border-b">
                                        {{ $currancy }}{{ round($detail['Total_intrinsic_answer'], 4) }}</td>
                                </tr>
                            </table>
                        </div>
                    @else
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <p class="mt-2"><strong>{{ $lang[14] }}</strong></p>
                            <p class="mt-2">{{ $lang[22] }}:</p>
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[23] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ round($detail['terminal_value'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[24] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ round($detail['answer_sec'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[24] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ round($detail['equdiry'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[24] }} </strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ round($detail['fair_val'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[24] }} </strong></td>
                                    <td class="py-2 border-b">{{ round($detail['percentage'], 4) }} %</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
<script>
    var maxInputs = 8;
    var inputContainer = document.getElementById("inputContainer");
    var addButton = document.getElementById("addInput");

    var x = 3; // Initial input counter

    @if (isset($detail))
        var detailExists = true;
        var length = "{{ $detail['length'] }}";
        x = parseInt(length); // Convert string to integer
    @else
        var detailExists = false;
    @endif

    // Function to add a new input field
    addButton.addEventListener("click", function(e) {
        e.preventDefault();
        if (x < maxInputs) {
            var newInput = document.createElement("div");
            newInput.className = "col-span-6";
            newInput.innerHTML = '<label for="y" class="label">FCFF ' + x + '</label> \
            <div class="w-full py-2 relative"> \
                <input type="number" step="any" name="input[]" value="50" id="input' + x + '" class="input" aria-label="input" placeholder="50" /> \
                <span class=" input_unit">{{ $currancy }}</span> \
            </div>';

            inputContainer.appendChild(newInput);
            x++;
        }
    });
    @if (isset($detail))
        var growth_unit = "{{ $detail['growth_unit'] }}";
        if (growth_unit === 'yrs/mos') {
            var dubbleInputs = document.querySelectorAll('.dubble_input');
            dubbleInputs.forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('predictable').style.display = 'none';
        } else {
            var dubbleInputs = document.querySelectorAll('.dubble_input');
            dubbleInputs.forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('predictable').style.display = 'block';
        }
    @endif
    @if (isset($detail))
        var terminal_unit = "{{ $detail['terminal_unit'] }}";
        if (terminal_unit === 'yrs/mos') {
            var dubInputs = document.querySelectorAll('.dub_input');
            dubInputs.forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('terminals').style.display = 'none';
        } else {
            var dubInputs = document.querySelectorAll('.dub_input');
            dubInputs.forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('terminals').style.display = 'block';
        }
    @endif

    @if (isset($detail))
        var type = "{{ $detail['main_unit'] }}";

        var firstElement = document.getElementById('first');
        var secondElement = document.getElementById('second');

        if (type === "Free cash flow to firm (FCFF)") {
            firstElement.classList.remove('hidden');
            secondElement.classList.add('hidden');
        } else {
            secondElement.classList.remove('hidden');
            firstElement.classList.add('hidden');
        }
    @endif


@if(isset($error))
var aja = "{{$_POST['growth_unit']}}";
    if (aja === 'yrs/mos') {
            var dubbleInputs = document.querySelectorAll('.dubble_input');
            dubbleInputs.forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('predictable').style.display = 'none';
        } else {
            var dubbleInputs = document.querySelectorAll('.dubble_input');
            dubbleInputs.forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('predictable').style.display = 'block';
        }
 @endif


 @if(isset($error))
var aja = "{{$_POST['terminal_unit']}}";
if (aja === 'yrs/mos') {
            var dubInputs = document.querySelectorAll('.dub_input');
            dubInputs.forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('terminals').style.display = 'none';
        } else {
            var dubInputs = document.querySelectorAll('.dub_input');
            dubInputs.forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('terminals').style.display = 'block';
        }
 @endif

 @if(isset($error))
var type = "{{$_POST['main_unit']}}";

    var firstElement = document.getElementById('first');
    var secondElement = document.getElementById('second');
if (type === "Free cash flow to firm (FCFF)") {
            firstElement.classList.remove('hidden');
            secondElement.classList.add('hidden');
        } else {
            secondElement.classList.remove('hidden');
            firstElement.classList.add('hidden');
        }
 @endif




    function mySelection(chal) {
        var aja = chal.value;
        var firstElement = document.getElementById('first');
        var secondElement = document.getElementById('second');

        if (aja === "Free cash flow to firm (FCFF)") {
            firstElement.classList.remove('hidden');
            secondElement.classList.add('hidden');
        } else {
            secondElement.classList.remove('hidden');
            firstElement.classList.add('hidden');
        }
    }

    function secSelection(chal) {
        var aja = chal.value;

        if (aja === 'yrs/mos') {
            var dubbleInputs = document.querySelectorAll('.dubble_input');
            dubbleInputs.forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('predictable').style.display = 'none';
        } else {
            var dubbleInputs = document.querySelectorAll('.dubble_input');
            dubbleInputs.forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('predictable').style.display = 'block';
        }
    }

    function threeSelection(chal) {
        var aja = chal.value;
        if (aja === 'yrs/mos') {
            var dubInputs = document.querySelectorAll('.dub_input');
            dubInputs.forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('terminals').style.display = 'none';
        } else {
            var dubInputs = document.querySelectorAll('.dub_input');
            dubInputs.forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('terminals').style.display = 'block';
        }
    }
</script>
@endpush
