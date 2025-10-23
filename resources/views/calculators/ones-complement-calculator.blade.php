<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if(!isset($detail)){
                    $_POST['bits'] = "8";
                    $_POST['cal'] = "bnry_cal";
                }
            @endphp
            <div class="col-span-12 flex items-center justify-evenly">
                <p class="label"><strong>{{$lang['1']}}:</strong></p>
                <p class="bnry_cal">
                    <input type="radio" name="cal" id="bnry_cal" value="bnry_cal" {{ isset($_POST['cal']) && $_POST['cal']==='bnry_cal' ? 'checked':'' }}>
                    <label for="bnry_cal" class="font-s-14">{{$lang['2']}}</label>
                </p>
                <p class="dec_cal">
                    <input type="radio" name="cal" id="dec_cal" value="dec_cal" {{ isset($_POST['cal']) && $_POST['cal']==='dec_cal' ? 'checked':'' }}>
                    <label for="dec_cal" class="font-s-14">{{$lang['3']}}</label>
                </p>
                <p class="hex_cal">
                    <input type="radio" name="cal" id="hex_cal" value="hex_cal" {{ isset($_POST['cal']) && $_POST['cal']==='hex_cal' ? 'checked':'' }}>
                    <label for="hex_cal" class="font-s-14">{{$lang['4']}}</label>
                </p>
            </div>
            <p class="col-span-12 text-center my-3 text-[14px] {{ isset($_POST['cal']) && $_POST['cal']!=='bnry_cal' ? 'hidden':'' }}" id="dec_rng">
                {{$lang['2']}} {{$lang['8']}} = <span id="dec_range">-127 to 127</span>
            </p>
            <p class="col-span-12 text-center my-3 text-[14px] {{ isset($_POST['cal']) && $_POST['cal']==='dec_cal' ? '':'hidden' }}" id="bnry_rng">
                {{$lang['3']}} {{$lang['8']}} = <span id="bnry_range">8 {{$lang['13']}} ({{$lang['14']}})</span>
            </p>
            <p class="col-span-12 text-center my-3 text-[14px] {{ isset($_POST['cal']) && $_POST['cal']==='hex_cal' ? '':'hidden' }}" id="hex_rng">
                {{$lang['4']}} {{$lang['8']}} = <span id="hex_range">0-9 {{$lang['15']}} A-F (16-{{$lang['13']}})</span>
            </p>
            <div class="col-span-12 {{ isset($_POST['cal']) && $_POST['cal']!=='bnry_cal' ? 'hidden':'' }}" id="dec">
                <label for="dec_val" class="label">{{$lang['2']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="dec" id="dec_val" min="-127" max="127" class="input" value="{{ isset($_POST['dec'])?$_POST['dec']:'5' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal']) && $_POST['cal']==='dec_cal' ? '':'hidden' }}" id="bnry">
                <label for="bnry_val" class="label">{{$lang['3']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" maxlength="8" name="bnry" id="bnry_val" class="input" value="{{ isset($_POST['bnry'])?$_POST['bnry']:'0101' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal']) && $_POST['cal']==='hex_cal' ? '':'hidden' }}" id="hex">
                <label for="hex_val" class="label">{{$lang['4']}}</label>
                <div class="w-full py-2">
                    <input type="text" step="any" maxlength="16" name="hex" id="hex_val" class="input" value="{{ isset($_POST['hex'])?$_POST['hex']:'F' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal']) && $_POST['cal']==='hex_cal' ? 'hidden':'' }}" id="bit">
                <label for="bits" class="label">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="bits" id="bits">
                        <option value="4">4-bit</option>
                        <option value="8" {{ isset($_POST['bits']) && $_POST['bits'] == '8' ? 'selected' : '' }}>8-bit</option>
                        <option value="12" {{ isset($_POST['bits']) && $_POST['bits'] == '12' ? 'selected' : '' }}>12-bit</option>
                        <option value="16" {{ isset($_POST['bits']) && $_POST['bits'] == '16' ? 'selected' : '' }}>16-bit</option>
                        <option value="other" {{ isset($_POST['bits']) && $_POST['bits'] == 'other' ? 'selected' : '' }}>{{$lang['6']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal']) && $_POST['bits']==='other' && ($_POST['cal']==='dec_cal' || $_POST['cal']==='bnry_cal') ? '':'hidden' }}" id="no_of_bits">
                <label for="n_o_b" class="label">{{$lang['7']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" min="2" max="70" name="no_of_bits" id="n_o_b" class="input" value="{{ isset($_POST['no_of_bits'])?$_POST['no_of_bits']:'8' }}" aria-label="input"/>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b">{!!$detail['_1s']!!}</td>
                                    </tr>
                                </table>
                                <p class="mt-2 font-s-16"><strong>{{$lang['10']}} {{$detail['bit']}}-bit {{$lang['11']}}:</strong></p>
                                <table class="w-full text-[18px] mt-2">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['2']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['dec']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['3']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['binary']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['4']}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['hex']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">1's {{$lang['12']}}</td>
                                        <td class="py-2 border-b"><strong>{!!$detail['_1s']!!}</strong></td>
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
            function bits() {
                var bitsValue = document.getElementById('bits').value;
                var noOfBits = document.getElementById('n_o_b');
                var binaryVal = document.getElementById('bnry_val');
                var decimalVal = document.getElementById('dec_val');
                var binaryRange = document.getElementById('bnry_range');
                var decimalRange = document.getElementById('dec_range');
                if (bitsValue === 'other') {
                    document.getElementById('no_of_bits').style.display = 'block';
                    noOfBits.addEventListener('input', function () {
                        var inputVal = parseInt(this.value);
                        if (inputVal !== '' && !isNaN(inputVal)) {
                            if (document.querySelector('input[name="cal"]:checked').value === 'bnry_cal') {
                                var min = Math.pow(2, inputVal - 1) * (-1);
                                var max = Math.pow(2, inputVal - 1) - 1;
                                if (inputVal < 55) {
                                    decimalVal.min = min;
                                    decimalVal.max = max;
                                    decimalRange.textContent = min + ' to ' + max;
                                    document.getElementById('dec_rng').style.display = 'block';
                                } else {
                                    decimalVal.min = '';
                                    decimalVal.max = '';
                                    decimalRange.textContent = '';
                                    document.getElementById('dec_rng').style.display = 'none';
                                }
                            } else {
                                binaryVal.maxLength = inputVal;
                                binaryRange.textContent = inputVal + ' Digits (without leading zeros)';
                            }
                        } else {
                            decimalVal.min = '';
                            decimalVal.max = '';
                            decimalRange.textContent = '';
                            binaryVal.maxLength = '';
                            binaryRange.textContent = '';
                        }
                    });
                } else {
                    document.getElementById('no_of_bits').style.display = 'none';
                    if (bitsValue === '4' || bitsValue === '8' || bitsValue === '12' || bitsValue === '16') {
                        noOfBits.value = bitsValue;
                        if (document.querySelector('input[name="cal"]:checked').value === 'bnry_cal') {
                            var min, max;
                            switch (bitsValue) {
                                case '4':
                                    min = -8;
                                    max = 7;
                                    break;
                                case '8':
                                    min = -127;
                                    max = 127;
                                    break;
                                case '12':
                                    min = -2048;
                                    max = 2047;
                                    break;
                                case '16':
                                    min = -32768;
                                    max = 32767;
                                    break;
                            }
                            decimalVal.min = min;
                            decimalVal.max = max;
                            decimalRange.textContent = min + ' to ' + max;
                        } else {
                            binaryVal.maxLength = parseInt(bitsValue);
                            binaryRange.textContent = bitsValue + ' Digits (without leading zeros)';
                        }
                    }
                }
            }
            document.getElementById('bnry_cal').addEventListener('click', function() {
                document.getElementById('dec').style.display = 'block';
                document.getElementById('dec_rng').style.display = 'block';
                document.getElementById('bit').style.display = 'block';
                document.getElementById('bnry').style.display = 'none';
                document.getElementById('bnry_rng').style.display = 'none';
                document.getElementById('hex').style.display = 'none';
                document.getElementById('hex_rng').style.display = 'none';
                bits();
            });
            document.getElementById('dec_cal').addEventListener('click', function() {
                document.getElementById('bnry').style.display = 'block';
                document.getElementById('bnry_rng').style.display = 'block';
                document.getElementById('bit').style.display = 'block';
                document.getElementById('dec').style.display = 'none';
                document.getElementById('dec_rng').style.display = 'none';
                document.getElementById('hex').style.display = 'none';
                document.getElementById('hex_rng').style.display = 'none';
                bits();
            });
            document.getElementById('hex_cal').addEventListener('click', function() {
                document.getElementById('hex').style.display = 'block';
                document.getElementById('hex_rng').style.display = 'block';
                document.getElementById('dec').style.display = 'none';
                document.getElementById('dec_rng').style.display = 'none';
                document.getElementById('bnry').style.display = 'none';
                document.getElementById('bnry_rng').style.display = 'none';
                document.getElementById('bit').style.display = 'none';
            });
            document.getElementById('bits').addEventListener('change', function() {
                bits();
            });
            document.getElementById('bnry_val').addEventListener('keydown', function(e) {
                if (![48, 49, 8, 13, 17, 65, 67, 86].includes(e.which)) {
                    e.preventDefault();
                }
            });
        </script>
        @if(isset($_POST['bits']) && $_POST['bits'] === 'other')
            @if(!empty($_POST['no_of_bits']))
                @if($_POST['cal']==='bnry_cal')
                    @if ($_POST['no_of_bits'] < 55)
                        <script>
                            var min = Math.pow(2, {{$_POST['no_of_bits']}} - 1) * (-1);
                            var max = Math.pow(2, {{$_POST['no_of_bits']}} - 1) - 1;
                            document.getElementById('dec_val').setAttribute('min', min);
                            document.getElementById('dec_val').setAttribute('max', max);
                            document.getElementById('dec_range').textContent = min + ' to ' + max;
                            document.getElementById('dec_rng').style.display = 'block';
                        </script>
                    @else
                        <script>
                            document.getElementById('dec_val').setAttribute('min', '');
                            document.getElementById('dec_val').setAttribute('max', '');
                            document.getElementById('dec_range').textContent = '';
                            document.getElementById('dec_rng').style.display = 'none';
                        </script>
                    @endif
                @else
                    <script>
                        document.getElementById('bnry_val').setAttribute('maxlength', {{$_POST['no_of_bits']}});
                        document.getElementById('bnry_range').textContent = '{{$_POST['no_of_bits']}} Digits (without leading zeros)';
                    </script>
                @endif
            @else
                <script>
                    document.getElementById('dec_val').setAttribute('min', '');
                    document.getElementById('dec_val').setAttribute('max', '');
                    document.getElementById('dec_range').textContent = '';
                    document.getElementById('bnry_val').setAttribute('maxlength', '');
                    document.getElementById('bnry_range').textContent = '';
                </script>
            @endif
        @elseif(isset($_POST['bits']) && $_POST['bits'] === '4')
            @if ($_POST['cal'] === 'bnry_cal')
                <script>
                    document.getElementById('dec_val').setAttribute('min', '-8');
                    document.getElementById('dec_val').setAttribute('max', '7');
                    document.getElementById('dec_range').textContent = '-8 to 7';
                </script>
            @else
                <script>
                    document.getElementById('bnry_val').setAttribute('maxlength', '4');
                    document.getElementById('bnry_range').textContent = '4 Digits (without leading zeros)';
                </script>
            @endif
        @elseif(isset($_POST['bits']) && $_POST['bits'] === '8')
            @if ($_POST['cal'] === 'bnry_cal')
                <script>
                    document.getElementById('dec_val').setAttribute('min', '-127');
                    document.getElementById('dec_val').setAttribute('max', '127');
                    document.getElementById('dec_range').textContent = '-127 to 127';
                </script>
            @else
                <script>
                    document.getElementById('bnry_val').setAttribute('maxlength', '8');
                    document.getElementById('bnry_range').textContent = '8 Digits (without leading zeros)';
                </script>
            @endif
        @elseif(isset($_POST['bits']) && $_POST['bits'] === '12')
            @if ($_POST['cal'] === 'bnry_cal')
                <script>
                    document.getElementById('dec_val').setAttribute('min', '-2048');
                    document.getElementById('dec_val').setAttribute('max', '2047');
                    document.getElementById('dec_range').textContent = '-2048 to 2047';
                </script>
            @else
                <script>
                    document.getElementById('bnry_val').setAttribute('maxlength', '12');
                    document.getElementById('bnry_range').textContent = '12 Digits (without leading zeros)';
                </script>
            @endif
        @elseif(isset($_POST['bits']) && $_POST['bits'] === '16')
            @if ($_POST['cal'] === 'bnry_cal')
                <script>
                    document.getElementById('dec_val').setAttribute('min', '-32768');
                    document.getElementById('dec_val').setAttribute('max', '32767');
                    document.getElementById('dec_range').textContent = '-32768 to 32767';
                </script>
            @else
                <script>
                    document.getElementById('bnry_val').setAttribute('maxlength', '16');
                    document.getElementById('bnry_range').textContent = '16 Digits (without leading zeros)';
                </script>
            @endif
        @endif
    @endpush
</form>