<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <span class="me-3"><strong>{{ $lang[1] }}:</strong></span>
                <label for="frst" class="me-1 me-md-3 cursor-pointer">
                    <input name="type" id="frst" value="frst" type="radio" checked {{ isset($_POST['type']) && $_POST['type'] === 'frst' ? 'checked' : '' }} />
                    <span><?=$lang[2]?></span>
                </label>
                <label for="scnd" class="cursor-pointer">
                    <input name="type" id="scnd" value="scnd" type="radio" {{ isset($_POST['type']) && $_POST['type'] === 'scnd' ? 'checked' : '' }} />
                    <span><?=$lang[3]?></span>
                </label>
            </div>
            <div class="col-span-12 mt-3" id="calculator">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="label">{!! $lang['4'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['first'])?$_POST['first']:'56' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="second" class="label">{!! $lang['5'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['second'])?$_POST['second']:'54' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="third" class="label">{!! $lang['6'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['third'])?$_POST['third']:'7' }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 mt-3 hidden" id="converter">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="operations" class="label">{!! $lang['7'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="operations" id="operations" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['8'],$lang['9']];
                                    $val = ["1","2"];
                                    optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'1');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="four" class="label" id="pakis">{!! $lang['10'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['four'])?$_POST['four']:'54.67' }}" />
                            <span class="text-blue input_unit" id="txt">%</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($lang['after_title']))
                <p class="font-s-14 px-3">{!! $lang['after_title'] !!}</p>
            @endif
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
                            $typee = $detail['request']->type;
                            $operations = $detail['request']->operations;
                            $first = $detail['request']->first;
                            $second = $detail['request']->second;
                            $third = $detail['request']->third;
                            $four = $detail['request']->four;
                        @endphp
                        @if ($typee == "scnd")
                            @if ($operations == 1)
                                <p class="bg-[#F6FAFC] text-[18px] rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899;">
                                    <span class="text-green font-s-28">{{ $four }}</span>% = 1 in
                                    <strong class="font-s-20">
                                        {{ round($detail['f_ans'], 4) }}
                                    </strong>
                                    {{ $lang[12] }}
                                </p>
                            @elseif ($operations == 2)
                                <p class="bg-[#F6FAFC] text-[18px] rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899;">
                                    <span class="text-green font-s-28">
                                        {{ round($detail['f_ans'], 4) }}
                                    </span>
                                    % = 1 in <strong>{{ $four }}</strong> {{ $lang[12] }}
                                </p>
                            @endif
                        @endif
                        <p class="bg-[#F6FAFC] text-[18px] rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899;">
                            <span class="">{{ $lang[13] }}</span> (p) = <span class="text-[28px] text-green-700">{{ round($detail['pfreq'], 4) }}</span> (%)
                        </p>
                        <p class="bg-[#F6FAFC] text-[18px] rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899;">
                            <span class="">{{ $lang[14] }}</span> (q) = <span class="text-[28px] text-green-700">{{ round($detail['qfreq'], 4) }}</span> (%)
                        </p>
                        <table class="w-full md:w-[80%] lg:w-[80%]  mt-3 text-[18px]">
                            <tr>
                                <td class="p-2">
                                    <span>{{ $lang[15] }}</span>
                                </td>
                                <td>
                                    <strong>p² = <span class="text-green-700">{{ round($detail['p_square'], 4) }}</span></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2">
                                    <span>{{ $lang[16] }}</span>
                                </td>
                                <td>
                                    <strong>2pq = <span class="text-green-700">{{ round($detail['p_q'], 4) }}</span></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2">
                                    <span>{{ $lang[17] }}</span>
                                </td>
                                <td>
                                    <strong>q² = <span class="text-green-700">{{ round($detail['q_square'], 4) }}</span></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                var cal = this.value;
                if (cal === '1') {
                    document.getElementById('pakis').textContent = '{{ $lang[10] }}:';
                    document.getElementById('txt').textContent = '%';
                } else if (cal === '2') {
                    document.getElementById('pakis').textContent = '{{ $lang[18] }}';
                    document.getElementById('txt').textContent = '';
                }
            });

            document.getElementById('frst').addEventListener('click', function() {
                document.getElementById('converter').style.display = 'none';
                document.getElementById('calculator').style.display = 'block';
            });

            document.getElementById('scnd').addEventListener('click', function() {
                document.getElementById('converter').style.display = 'block';
                document.getElementById('calculator').style.display = 'none';
            });

            @isset($detail)
                var cal = document.getElementById('operations').value;
                if (cal === '1') {
                    document.getElementById('pakis').textContent = '{{ $lang[10] }}:';
                    document.getElementById('txt').textContent = '%';
                } else if (cal === '2') {
                    document.getElementById('pakis').textContent = '{{ $lang[18] }}';
                    document.getElementById('txt').textContent = '';
                }

                if (document.getElementById('frst').checked) {
                    document.getElementById('converter').style.display = 'none';
                    document.getElementById('calculator').style.display = 'block';
                } else {
                    document.getElementById('converter').style.display = 'block';
                    document.getElementById('calculator').style.display = 'none';
                }
            @endisset
        </script>
    @endpush
</form>