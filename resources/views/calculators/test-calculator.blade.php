<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['grades'] = "2";
                }
            @endphp
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="grades" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="grades" id="grades">
                        <option value="1" {{ isset($_POST['grades']) && $_POST['grades']=='1'?'selected':'' }}>A,B,C,D,......</option>
                        <option value="2" {{ isset($_POST['grades']) && $_POST['grades']=='2'?'selected':'' }}>A+,A,A-,B+,......</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="first" id="first" value="{{ isset($_POST['first'])?$_POST['first']:'50' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="second" id="second" value="{{ isset($_POST['second'])?$_POST['second']:'15' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="increment" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="increment" id="increment" value="{{ isset($_POST['increment'])?$_POST['increment']:'1' }}" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12 text-center mt-3 mb-1"><strong>{{ $lang['5'] }}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="aplus" class="font-s-14 text-blue">{{ $lang['6'] }} A+ ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="aplus" id="aplus" class="input" aria-label="input" value="<?= isset($_POST['aplus']) ? $_POST['aplus'] : '97' ?>" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 notHide">
                <label for="a" class="font-s-14 text-blue">{{ $lang['6'] }} A ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a" id="a" value="{{ isset($_POST['a'])?$_POST['a']:'93' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="aminus" class="font-s-14 text-blue">{{ $lang['6'] }} A- ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="aminus" id="aminus" class="input" aria-label="input" value="<?= isset($_POST['aminus']) ? $_POST['aminus'] : '90' ?>" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="bplus" class="font-s-14 text-blue">{{ $lang['6'] }} B+ ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="bplus" id="bplus" value="{{ isset($_POST['bplus'])?$_POST['bplus']:'87' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 notHide">
                <label for="b" class="font-s-14 text-blue">{{ $lang['6'] }} B ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="b" id="b" class="input" aria-label="input" value="<?= isset($_POST['b']) ? $_POST['b'] : '83' ?>" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="bminus" class="font-s-14 text-blue">{{ $lang['6'] }} B- ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="bminus" id="bminus" value="{{ isset($_POST['bminus'])?$_POST['bminus']:'80' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="cplus" class="font-s-14 text-blue">{{ $lang['6'] }} C+ ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="cplus" id="cplus" class="input" aria-label="input" value="<?= isset($_POST['cplus']) ? $_POST['cplus'] : '77' ?>" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 notHide">
                <label for="c" class="font-s-14 text-blue">{{ $lang['6'] }} C ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="c" id="c" value="{{ isset($_POST['c'])?$_POST['c']:'73' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="cminus" class="font-s-14 text-blue">{{ $lang['6'] }} C- ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="cminus" id="cminus" class="input" aria-label="input" value="<?= isset($_POST['cminus']) ? $_POST['cminus'] : '70' ?>" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="dplus" class="font-s-14 text-blue">{{ $lang['6'] }} D+ ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="dplus" id="dplus" value="{{ isset($_POST['dplus'])?$_POST['dplus']:'67' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 notHide">
                <label for="d" class="font-s-14 text-blue">{{ $lang['6'] }} D ≥</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="d" id="d" class="input" aria-label="input" value="<?= isset($_POST['d']) ? $_POST['d'] : '63' ?>" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hide {{ isset($_POST['grades']) && $_POST['grades']=='1' ? 'hidden':'' }}">
                <label for="dminus" class="font-s-14 text-blue">{{ $lang['6'] }} D- ≥</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="dminus" id="dminus" value="{{ isset($_POST['dminus'])?$_POST['dminus']:'63' }}" class="input" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['per']}} %</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['8'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['letter_ans']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['9'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['correct']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['10'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['correct']}}/{{$detail['first']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-3 text-center">                    
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b"><strong># {{$lang[11]}}</strong></td>
                                        <td class="py-2 border-b"><strong># {{$lang[12]}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[6]}} (%)</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[13]}}</strong></td>
                                    </tr>
                                    @for ($i = 0; $i <  count($detail['q_array']) - 1; $i++)
                                        <tr>
                                            <td class="py-2 border-b">{{$detail['q_array'][$i]}}</td>
                                            <td class="py-2 border-b">{{$detail['i_array'][$i]}}</td>
                                            <td class="py-2 border-b">{{$detail['g_array'][$i]}}</td>
                                            <td class="py-2 border-b">{{$detail['l_array'][$i]}}</td>
                                        </tr>
                                    @endfor
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
            document.getElementById('grades').addEventListener('change', function() {
                if(this.value === "1"){
                    ['.hide'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else{
                    ['.hide'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>