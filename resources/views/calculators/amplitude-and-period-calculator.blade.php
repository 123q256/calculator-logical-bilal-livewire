<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="trigonometric_unit" class="font-s-14 text-blue">{{ $lang['1'] }} f:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="trigonometric_unit" id="trigonometric_unit">
                            <option value="1">sine</option>
                            <option value="2"
                                {{ isset($_POST['trigonometric_unit']) && $_POST['trigonometric_unit'] == '2' ? 'selected' : '' }}>
                                cosine</option>
                        </select>
                    </div>
                </div>
                <p class="col-span-12 text-center my-3">
                    @if (isset($_POST['trigonometric_unit']) && $_POST['trigonometric_unit'] === '2')
                        f(x) = A × <span id="changeText">cosine</span>(Bx-C) + D
                    @else
                        f(x) = A × <span id="changeText">sin</span>(Bx-C) + D
                    @endif
                </p>
                <div class="col-span-6">
                    <label for="first_number" class="font-s-14 text-blue">A</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="first_number" id="first_number" class="input"
                            value="{{ isset($_POST['first_number']) ? $_POST['first_number'] : '2' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="second_number" class="font-s-14 text-blue">B</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="second_number" id="second_number" class="input"
                            value="{{ isset($_POST['second_number']) ? $_POST['second_number'] : '3' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="third_number" class="font-s-14 text-blue">C</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="third_number" id="third_number" class="input"
                            value="{{ isset($_POST['third_number']) ? $_POST['third_number'] : '4' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="fourth_number" class="font-s-14 text-blue">D</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="fourth_number" id="fourth_number" class="input"
                            value="{{ isset($_POST['fourth_number']) ? $_POST['fourth_number'] : '5' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x_not" class="font-s-14 text-blue">x₀</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="x_not" id="x_not" class="input"
                            value="{{ isset($_POST['x_not']) ? $_POST['x_not'] : '1' }}" aria-label="input" />
                        <span class="text-blue input_unit">{{ $lang['2'] }}</span>
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
                        @php
                            function change_coefficient($number){
                                if ($number == -1) {
                                    return '-';
                                } elseif ($number != 1) {
                                    return $number;
                                } else {
                                    return '';
                                }
                            }
                            function changeFunction($sinOrCos, $A, $B, $C, $D){
                                $result = '';
                                $result .= change_coefficient($A);
                                if ($sinOrCos == 1) {
                                    $result .= 'sin';
                                } else {
                                    $result .= 'cos';
                                }
                                $result .= '(';
                                if ($C < 0) {
                                    $result .= change_coefficient($B) . 'x' . '+' . $C * -1;
                                } else {
                                    $result .= change_coefficient($B) . 'x' . '-' . $C;
                                }
                                $result .= ')';
                                if ($D < 0) {
                                    $result .= $D * -1;
                                } else {
                                    $result .= '+' . $D;
                                }
                                return $result;
                            }
                            $answer = changeFunction(
                                $detail['operation'],
                                $detail['first_number'],
                                $detail['fifth_number'],
                                $detail['sixth_number'],
                                $detail['fourth_number'],
                            );
                            if(!empty($_POST['x_not'])){
                                if ($detail['operation'] == '1' && $detail['sixth_number'] > 0) {
                                    $first_section =
                                        sin($detail['fifth_number'] * $_POST['x_not']) * cos($detail['sixth_number']) -
                                        cos($detail['fifth_number'] * $_POST['x_not']) * sin($detail['sixth_number']);
                                    $final_section = $detail['first_number'] * $first_section + $detail['fourth_number'];
                                } elseif ($detail['operation'] == '1' && $detail['sixth_number'] < 0) {
                                    $first_section =
                                        sin($detail['fifth_number'] * $_POST['x_not']) * cos($detail['sixth_number']) +
                                        cos($detail['fifth_number'] * $_POST['x_not']) * sin($detail['sixth_number']);
                                    $final_section = $detail['first_number'] * $first_section + $detail['fourth_number'];
                                } elseif ($detail['operation'] == '2' && $detail['sixth_number'] < 0) {
                                    $first_section =
                                        cos($detail['fifth_number'] * $_POST['x_not']) * cos($detail['sixth_number']) +
                                        sin($detail['fifth_number'] * $_POST['x_not']) * sin($detail['sixth_number']);
                                    $final_section = $detail['first_number'] * $first_section + $detail['fourth_number'];
                                } elseif ($detail['operation'] == '2' && $detail['sixth_number'] > 0) {
                                    $first_section =
                                        cos($detail['fifth_number'] * $_POST['x_not']) * cos($detail['sixth_number']) -
                                        sin($detail['fifth_number'] * $_POST['x_not']) * sin($detail['sixth_number']);
                                    $final_section = $detail['first_number'] * $first_section + $detail['fourth_number'];
                                }
                            }
                        @endphp
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                @if(!empty($_POST['x_not']))
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>f(x₀)</strong></td>
                                        <td class="py-2 border-b">{{ $final_section }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                    <td class="py-2 border-b">{{ $answer}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['4'] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['first_number'],4)}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['5'] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['second_number'],6)}} π</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['6'] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['third_number'],6)}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['fourth_number'],4)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('trigonometric_unit').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText').textContent = 'sine';
                } else {
                    document.getElementById('changeText').textContent = 'cosine';
                }
            });
        </script>
    @endpush
</form>
