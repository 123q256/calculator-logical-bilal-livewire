<style>
    .table_input{
        border-collapse: collapse
    }
    .table_input tr td {
        width: 40px !important;
        height: 30px;
        border: 1px solid #ccc;
        padding: 0px;
        text-align: center;
    }
    .table_input input {
        border: none !important;
        outline: none;
        width: 100%;
        height: 100%;
        text-align: center
    }
    .bg-gray{
        background-color: #F6FAFC !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST" id="inputForm">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2">
                @php
                    $request = request();
                @endphp
                <div class="col-span-12">
                    <table id="inputTable" class="text-center">
                        <thead>
                            <tr class="text-center">
                                <th>X</th>
                                <th>P(x)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($request->xx) && isset($request->px))
                                @foreach($request->xx as $index => $xx)
                                    <tr>
                                        <td class="pt-2 pe-2"><input type="number" aria-label="input" name="xx[]" value="{{ $xx }}" class="input"></td>
                                        <td class="pt-2 ps-2"><input type="number" aria-label="input" name="px[]" value="{{ $request->px[$index] }}" step="0.01" class="input px-input" oninput="validatePx()"></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="pe-2"><input type="number" aria-label="input" required name="xx[]" value="2" class="input"></td>
                                    <td class="ps-2"><input type="number" aria-label="input" required name="px[]" value="0.2" step="0.01" class="input px-input" oninput="validatePx()"></td>
                                </tr>
                                <tr>
                                    <td class="pt-2 pe-2"><input type="number" aria-label="input" name="xx[]" value="3" class="input"></td>
                                    <td class="pt-2 ps-2"><input type="number" aria-label="input" name="px[]" value="0.8" step="0.01" class="input px-input" oninput="validatePx()"></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-span-5 md:col-span-3 lg:col-span-3">
                     <p class="w-full units_active bg-[#2845F5] text-white cursor-pointer p-1 mx-1 rounded-md col-3 text-center mt-2" onclick="addRow()">Add Row</p>
                </div>

                {{-- old desgin --}}
                <input type="hidden" name="check" id="check" value="txtar">
                <div class="col-12 hidden" id="t_area" >
                    <div class="row">
                        <div class="col-12 px-2">
                            <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} X ({{ $lang['2'] }})</label>
                            <div class="w-100 py-2">
                                <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'2, 3, 4, 5' }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 px-2">
                            <label for="textarea1" class="font-s-14 text-blue">{{ $lang['1'] }} P(X) ({{ $lang['2'] }})</label>
                            <div class="w-100 py-2">
                                <textarea name="x1" id="textarea1" class="textareaInput" aria-label="input" placeholder="e.g. 0.2, 0.2, 0.3, 0.3">{{ isset($_POST['x1'])?$_POST['x1']:'0.2, 0.2, 0.3, 0.3' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-2 hidden" id="tab" >
                    <div class="row">
                        <input type="hidden" value="14" name="td_value" id="td_value" aria-label="input">
                        <input type="hidden" value="0" name="show_val" id="show_val" aria-label="input">
                        <div class="col-12 px-2 overflow-auto">
                            <table class="table_input">
                                <thead>
                                    <tr id="t1">
                                        <td></td>
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>11</td>
                                        <td>12</td>
                                        <td>13</td>
                                        <td>14</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="t2">
                                        <td class="thd">
                                        <strong>X</strong>
                                        </td>
                                        <td><input class="tds" name="a1" id="a1" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a2" id="a2" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a3" id="a3" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a4" id="a4" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a5" id="a5" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a6" id="a6" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a7" id="a7" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a8" id="a8" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a9" id="a9" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a10" id="a10" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a11" id="a11" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a12" id="a12" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a13" id="a13" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="a14" id="a14" type="number" aria-label="input" step="any"></td>
                                    </tr>
                                    <tr id="t3">
                                        <td class="thd">
                                        <strong>Y</strong>
                                        </td>
                                        <td><input class="tds" name="b1" id="b1" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b2" id="b2" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b3" id="b3" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b4" id="b4" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b5" id="b5" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b6" id="b6" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b7" id="b7" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b8" id="b8" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b9" id="b9" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b10" id="b10" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b11" id="b11" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b12" id="b12" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b13" id="b13" type="number" aria-label="input" step="any"></td>
                                        <td><input class="tds" name="b14" id="b14" type="number" aria-label="input" step="any"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3 px-2  hidden">
                    <div id="inp-chnge" class="font-s-16 bg-light-blue text-blue px-3 py-2 radius-10 d-inline cursor-pointer">{{ $lang['3'] }}</div>
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
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['4']}}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['ress'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <div class="w-full mt-2">
                                <table class="w-full text-[18px]" style="border-collapse: collapse">
                                    <tr class="bg-[#2845F5] text-white">
                                        <td colspan="3" class="border p-2 text-center"><strong class="text-blue"><?=$lang['5']?></strong></td>
                                    </tr>
                                    <tr class="bg-gray">
                                        <td class="border p-2"><strong class="text-blue">x</strong></td>
                                        <td class="border p-2"><strong class="text-blue">P(x)</strong></td>
                                        <td class="border p-2"><strong class="text-blue">x * P(x)</strong></td>
                                    </tr>
                                    @php
                                        $request = request();
                                        for ($i=0; $i < $request->show_val; $i++) {
                                            echo $detail['show_val'.$i];
                                        }
                                    @endphp
                                    <tr class="bg-sky">
                                        <td class="border p-2"><strong class="text-blue">∑ xi = <?=$detail['sum1']?></strong></td>
                                        <td class="border p-2"><strong class="text-blue">∑ P(xi) = <?=$detail['sum2']?></strong></td>
                                        <td class="border p-2"><strong class="text-blue">∑ xi * P(xi) = <?=$detail['ress']?></strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full font-s-20 mt-3"><?=$lang['6']?></p>
                            <p class="w-full mt-2"><?=$lang['7']?>:</p>
                            <p class="w-full mt-2"><span class="color_blue font_size20"> <?=$lang['8']?> 1. </span>E(X) = μX = ∑ [ xi * P(xi) ]</p>
                            <p class="w-full mt-2"> <span class="color_blue font_size20"> <?=$lang['8']?> 2. </span>E(X) = <?=$detail['show_res']?></p>
                            <p class="w-full mt-2"> <span class="color_blue font_size20"> <?=$lang['8']?> 3. </span>E(X) = <?=$detail['show_res1']?></p>
                            <p class="w-full mt-2"> <span class="color_blue font_size20"> <?=$lang['8']?> 4. </span>E(X) = <?=$detail['ress']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('inp-chnge').addEventListener('click', function() {
            var tab = document.getElementById('tab');
            var t_area = document.getElementById('t_area');
            var check = document.getElementById('check').value;

            tab.style.display = tab.style.display === 'none' ? 'block' : 'none';
            t_area.style.display = t_area.style.display === 'none' ? 'block' : 'none';

            if (check === 'txtar') {
                document.getElementById('check').value = 'table';
                var result = document.getElementById('textarea').value.split(',');
                var result1 = document.getElementById('textarea1').value.split(',');
                var result_length = Math.max(result.length, result1.length);

                for (var i = 0; i < result_length; i++) {
                    if (i >= 14) {
                        document.getElementById('t1').innerHTML += '<td>' + i + '</td>';
                        document.getElementById('td_value').value++;
                    }
                    var j = i + 1;
                    if (document.getElementById('a' + j)) {
                        document.getElementById('a' + j).value = result[i].trim();
                    }
                }

                for (var i = 0; i < result_length; i++) {
                    if (i >= 14) {
                        document.getElementById('t2').innerHTML += '<td><input id="a' + i + '" type="number" step="any"></td>';
                    }
                    var j = i + 1;
                    if (document.getElementById('a' + j)) {
                        document.getElementById('a' + j).value = result[i].trim();
                    }
                }

                for (var i = 0; i < result_length; i++) {
                    if (i >= 14) {
                        document.getElementById('t3').innerHTML += '<td><input id="a' + i + '" type="number" step="any"></td>';
                    }
                    var j = i + 1;
                    if (document.getElementById('b' + j)) {
                        document.getElementById('b' + j).value = result1[i].trim();
                    }
                }
            } else {
                document.getElementById('check').value = 'txtar';
                document.getElementById('textarea').value = '';
                var tds_len = document.getElementById('t2').getElementsByTagName('td').length - 1;
                var txt_len = '';
                for (var i = 1; i <= tds_len; i++) {
                    var t_result = document.getElementById('a' + i).value;
                    if (t_result !== '') {
                        txt_len += t_result + ',';
                    }
                }
                txt_len = txt_len.slice(0, -1);
                document.getElementById('textarea').value = txt_len;

                var tds_len1 = document.getElementById('t3').getElementsByTagName('td').length - 1;
                var txt_len1 = '';
                for (var i = 1; i <= tds_len1; i++) {
                    var t_result1 = document.getElementById('b' + i).value;
                    if (t_result1 !== '') {
                        txt_len1 += t_result1 + ',';
                    }
                }
                txt_len1 = txt_len1.slice(0, -1);
                document.getElementById('textarea1').value = txt_len1;
            }
        });

        document.addEventListener('keyup', function(event) {
            if (event.target.classList.contains('tds')) {
                var tds = document.getElementById('t2').getElementsByTagName('td').length - 1;
                var t_name = event.target.id.split('a');
                if (t_name[1] == tds) {
                    tds++;
                    document.getElementById('t1').innerHTML += '<td>' + tds + '</td>';
                    document.getElementById('t2').innerHTML += '<td><input class="tds" id="a' + tds + '" type="number" step="any"></td>';
                    document.getElementById('t3').innerHTML += '<td><input class="tds1" id="b' + tds + '" type="number" step="any"></td>';
                }
            }
        });

        let rowCount = {{ count(old('xx', [2, 3])) }};
        function addRow() {
            if (rowCount < 10) {
                const table = document.getElementById('inputTable').getElementsByTagName('tbody')[0];
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td class="pt-2 pe-2"><input type="number" name="xx[]" class="input" value="" aria-label="input"></td>
                    <td class="pt-2 ps-2"><input type="number" name="px[]" class="input px-input" step="0.01" value="" aria-label="input" oninput="validatePx()"></td>
                    <td><img src="{{asset('images/belete_btn.png')}}" width="18px" height="18px" class="cursor-pointer remove" alt="Remove Row" onclick="removeRow(this)"></td>
                `;
                table.appendChild(newRow);
                rowCount++;
            }
        }
        function removeRow(element) {
            const row = element.closest('tr');
            row.remove();
            rowCount--;
        }
        function validateAndSubmitForm(event) {
            event.preventDefault();
            const rows = document.querySelectorAll('#inputTable tbody tr');
            rows.forEach(row => {
                const xxInput = row.querySelector('input[name="xx[]"]');
                const pxInput = row.querySelector('input[name="px[]"]');
                if (xxInput.value.trim() === '' || pxInput.value.trim() === '') {
                    row.remove();
                    rowCount--;
                }
            });

            if (document.querySelectorAll('#inputTable tbody tr').length > 0) {
                document.getElementById('inputForm').submit(); // Submit the form after validation
            } else {
                alert('Please fill all fields.');
            }
        }
        document.getElementById('inputForm').addEventListener('submit', validateAndSubmitForm);
        function validateAndSubmitForm() {
            const rows = document.querySelectorAll('#inputTable tbody tr');
            rows.forEach(row => {
                const xxInput = row.querySelector('input[name="xx[]"]');
                const pxInput = row.querySelector('input[name="px[]"]');
                if (xxInput.value.trim() === '' || pxInput.value.trim() === '') {
                    row.remove();
                    rowCount--;
                }
            });
            document.getElementById('inputForm').submit();
        }

        // function validatePx() {
        //     const pxInputs = document.querySelectorAll('.px-input');
        //     let totalPx = 0;
        //     pxInputs.forEach(input => {
        //         const value = parseFloat(input.value);
        //         if (!isNaN(value)) {
        //             totalPx += value;
        //         }
        //     });
        //     if (totalPx > 1 || totalPx < 1) {
        //         alert('The sum of P(X) must be 1.');
        //     }
        // }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>