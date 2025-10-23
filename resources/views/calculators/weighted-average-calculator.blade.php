<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 flex items-center justify-center font-s-16 mb-2">
                <div>&nbsp;</div>
                <div class="px-2 w-full text-center"><strong>{{$lang['5']}}</strong></div>
                <div class="px-2 w-full text-center"><strong>{{$lang['6']}}</strong></div>
            </div>
            <div class="col-span-12 flex items-center justify-center">
                <div class="label">x<sub class="font-s-14">1</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '5' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '6' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">2</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '8' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '9' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">3</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '15' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '18' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">4</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '53' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '80' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">5</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '53' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '67' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">6</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '51' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '54' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">7</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '25' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '28' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">8</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '56' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '57' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">9</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '53' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '54' }}" />
                </div>
            </div>
            <div class="col-span-12 flex items-center justify-center mt-3">
                <div class="label">x<sub class="font-s-14">10</sub></div>
                <div class="px-2">
                    <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]']) ? $_POST['weight[]'] : '50' }}" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]']) ? $_POST['value[]'] : '43' }}" />
                </div>
            </div>
            @isset($detail)
            <div class="col-span-12">
                @for ($i = 10; $i < count($detail['weights']); $i++)
                    <div class="flex items-center justify-center mt-3">
                        <div class="label">x<sub class="font-s-14">{{$i+1}}</sub></div>
                        <div class="px-2">
                            <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ $detail['weights'][$i] }}" />
                        </div>
                        <div class="px-2">
                            <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ $detail['values'][$i] }}" />
                        </div>
                    </div>
                @endfor
            </div>
            @endisset
            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" id="newRows">

                </div>
            </div>
            <div class="col-span-12 text-end mt-3">
                <button type="button" name="submit" id="newRow" title="Add More Fields" onclick="add_row(this)" class="px-3 py-2 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><span>+</span>Add Row</button>
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
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['1'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['weighted_average'],2)}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['weight_sum'],2)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['3']}}</strong></p>
                            <p class="mt-2">{{$lang['4']}}</p>
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">(x<sub class="font-s-14">1</sub> × w<sub class="font-s-14">1</sub>) + (x<sub class="font-s-14">2</sub> × w<sub class="font-s-14">2</sub>) + ..... + (x<sub class="font-s-14">n</sub> × w<sub class="font-s-14">n</sub>)</span>
                                    <span>(w<sub class="font-s-14">1</sub> + w<sub class="font-s-14">2</sub> + .... + w<sub class="font-s-14">n</sub>)</span>
                                </span> 
                            </p>
                            @php
                                $v=$detail['v'];
                                $sum=0;
                                $wv=$detail['wv'];
                                $values=$detail['values'];
                                $weights=$detail['weights'];
                                $suming=0;
                            @endphp
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">
                                        @php
                                            for ($j=0; $j<$v; $j++) { 
                                                echo "( $weights[$j] × $values[$j])";
                                                if ($j != $v-1) {
                                                    echo " +";
                                                }
                                            }
                                        @endphp
                                    </span>
                                    <span>
                                        @php
                                            for ($k=0;$k<$v;$k++) { 
                                                echo $weights[$k];
                                                if ($k != $v-1) {
                                                    echo " +";
                                                }
                                            }
                                        @endphp
                                    </span>
                                </span> 
                            </p>
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">
                                        @php
                                            for ($j=0; $j<$v; $j++) { 
                                                echo ($weights[$j] * $values[$j]);
                                                $suming=$suming+$values[$j]*$weights[$j];
                                                if ($j != $v-1) {
                                                    echo " +";
                                                }
                                            }
                                        @endphp
                                    </span>
                                    <span>{{$detail['weight_sum']}}</span>
                                </span> 
                            </p>
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">{{$suming}}</span>
                                    <span>{{$detail['weight_sum']}}</span>
                                </span> 
                            </p>
                            <p class="mt-2">
                                x̄ = {{$suming/$detail['weight_sum']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            let x = {{ isset($detail) ? (count($detail['weights'])+1) : 11 }};
            function add_row() {
                if (21 > x) {
                    var read = `
                        <div class="col-span-12 flex items-center justify-center mt-3">
                            <div class="label">x<sub class="font-s-14">`+ x +`</sub></div>
                            <div class="px-2">
                                <input type="number" step="any" name="weight[]" class="input" aria-label="input" value="{{ isset($_POST['weight[]'])?$_POST['weight[]']:'4' }}" />
                            </div>
                            <div class="px-2">
                                <input type="number" step="any" name="value[]" class="input" aria-label="input" value="{{ isset($_POST['value[]'])?$_POST['value[]']:'8' }}" />
                            </div>
                        </div>
                    `;
                    document.getElementById('newRows').insertAdjacentHTML('beforeend', read);
                } else {
                    alert('Only Twenty Fields are Allowed');
                }
                x++;
            }
        </script>
    @endpush
</form>