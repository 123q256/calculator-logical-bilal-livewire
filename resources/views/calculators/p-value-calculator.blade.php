<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
            
                <div class="col-span-12">
                    <label for="with" class="font-s-14 text-blue">{{ $lang['5'] }}?</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="with" id="with">
                            <option value="z" {{ isset($_POST['with']) && $_POST['with'] == 'z' ? 'selected' : '' }}>
                                {{ $lang['6'] }} </option>
                            <option value="t" {{ isset($_POST['with']) && $_POST['with'] == 't' ? 'selected' : '' }}>
                                {{ $lang['7'] }}</option>
                            <option value="chi" {{ isset($_POST['with']) && $_POST['with'] == 'chi' ? 'selected' : '' }}>
                                {{ $lang['8'] }}</option>
                            <option value="f" {{ isset($_POST['with']) && $_POST['with'] == 'f' ? 'selected' : '' }}>
                                {{ $lang['9'] }}</option>
                            <option value="r" {{ isset($_POST['with']) && $_POST['with'] == 'r' ? 'selected' : '' }}>
                                Pearson r score</option>
                            <option value="q" {{ isset($_POST['with']) && $_POST['with'] == 'q' ? 'selected' : '' }}>
                                Tukey
                                q score</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 want_find">
                    <label for="tail" class="font-s-14 text-blue">{{ $lang['1'] }}?</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="tail" id="tail">
                            <option value="0" {{ isset($_POST['tail']) && $_POST['tail'] == '0' ? 'selected' : '' }}>
                                {{ $lang['2'] }} </option>
                            <option value="2" {{ isset($_POST['tail']) && $_POST['tail'] == '2' ? 'selected' : '' }}>
                                One-tailed P-value </option>
                            {{-- <option value="-1"  {{ isset($_POST['tail']) && $_POST['tail']=='-1'?'selected':''}}> {{$lang['3']}}</option>
                            <option value="1"  {{ isset($_POST['tail']) && $_POST['tail']=='1'?'selected':''}}> {{$lang['4']}}</option> --}}
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="score" class="font-s-14 text-blue z-text">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="score" id="score"
                            value="{{ isset($_POST['score']) ? $_POST['score'] : '0.02' }}" class="input"
                            aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 d-none deg1">
                    <label for="deg" class="font-s-14 text-blue deg-text">{{ $lang['10'] }} (d):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="deg" id="deg"
                            value="{{ isset($_POST['deg']) ? $_POST['deg'] : '3' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 d-none deg2">
                    <label for="deg2" class="font-s-14 text-blue">{{ $lang['11'] }} (d₂):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="deg2" id="deg2"
                            value="{{ isset($_POST['deg2']) ? $_POST['deg2'] : '3' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 d-none n_score">
                    <label for="degree_freedom" class="font-s-14 text-blue">Degrees of freedom (within-groups):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="degree_freedom" id="degree_freedom"
                            value="{{ isset($_POST['degree_freedom']) ? $_POST['degree_freedom'] : '' }}" class="input"
                            aria-label="input" placeholder="00" />
                    </div>
                </div>
                {{-- 4 --}}
                {{-- <div class="col-span-12 d-none r_score">
                    <label for="r_score" class="font-s-14 text-blue">R Score:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="r_score" id="r_score"
                            value="{{ isset($_POST['r_score']) ? $_POST['r_score'] : '' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 d-none r_score">
                    <label for="n_score" class="font-s-14 text-blue">N:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="n_score" id="n_score"
                            value="{{ isset($_POST['n_score']) ? $_POST['n_score'] : '' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div> --}}
            
                {{-- 5 --}}
                {{-- <div class="col-span-12 d-none valueof_q">
                    <label for="value_q" class="font-s-14 text-blue">The value of q:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="value_q" id="value_q"
                            value="{{ isset($_POST['value_q']) ? $_POST['value_q'] : '' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 d-none n_score">
                    <label for="number_of" class="font-s-14 text-blue">Number of groups (or means):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="number_of" id="number_of"
                            value="{{ isset($_POST['number_of']) ? $_POST['number_of'] : '' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 d-none n_score">
                    <label for="degree_freedom" class="font-s-14 text-blue">Degrees of freedom (within-groups):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="degree_freedom" id="degree_freedom"
                            value="{{ isset($_POST['degree_freedom']) ? $_POST['degree_freedom'] : '' }}" class="input" aria-label="input"
                            placeholder="00" />
                    </div>
                </div> --}}
            
                <div class="col-span-12  my-2">
                    <p class="font-s-14 text-blue my-1">Significance Level:</p>
                    <table id="RadioButtonList1">
                        <tbody class="flex">
                            <tr>
                                <td>
                                    <input id="RadioButtonList1_0" type="radio" name="level" value=".01">
                                    <label for="RadioButtonList1_0">0.01</label>
                                </td>
                            </tr>
                            <tr class="px-3">
                                <td>
                                    <input id="RadioButtonList1_1" type="radio"name="level" value=".05"
                                        checked="checked">
                                    <label for="RadioButtonList1_1">0.05</label>
                                </td>
                            </tr>
                            <tr class="px-3 level_radio">
                                <td><input id="RadioButtonList1_2" type="radio" name="level" value=".10">
                                    <label for="RadioButtonList1_2">0.10</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- <div class="col-span-12">
                    <label for="level" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="level" id="level" min="0" max="1" value="{{ isset($_POST['level'])?$_POST['level']:'0.05' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div> --}}
            
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
                                {{-- <p class="font-s-20">
                                    <strong>
                                        @if ($detail['tail'] == '0')
                                            {{ $lang['2'] }}
                                        @elseif ($detail['tail'] == '-1')
                                            {{ $lang['3'] }}
                                        @elseif ($detail['tail'])
                                            {{ $lang['4'] }}
                                        @endif
                                    </strong>
                                </p> --}}
                                <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white" id="testResult">{{ $detail['p'] }}</strong>
                                </p>
                            </div>
                        </div>
                        </div>
                        <p class="w-full lg:text-[20px] md:text-[20px] text-center" id="p_grater">
                            @if ($detail['inter'] == 'not')
                            {{ $lang['14'] }} p < {{ $detail['level'] }} @else {{ $lang['15'] }} p < {{ $detail['level'] }}
                            @endif
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')


    @if (isset($detail) && request()->with == 'q')
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jstat@latest/dist/jstat.min.js"></script>
        <script>
            let qscore = {{ $detail['score'] }};
            let nmeans = {{ $detail['deg'] }};
            let doff = {{ $detail['degree_freedom'] }};
            let sig = {{ $detail['level'] }};
            let valu15 = "{{ $lang['15'] }}";
            let valu14 = "{{ $lang['14'] }}";
            let result = (1 - jStat.tukey.cdf(qscore, nmeans, doff)).toFixed(5).substring(1);
            console.log(sig);
            if (sig == 0.05 && result < sig) {
                if (result < "0.00001") {
                    $('#testResult').html('.00001');
                    $('#p_grater').html(valu15 + 'p < .05');
                } else {
                    $('#testResult').html(result);
                    $('#p_grater').html(valu15 + 'p < .05');
                }
            } else if (sig == 0.05 && result >= sig) {
                $('#testResult').html(result);
                $('#p_grater').html(valu14 + 'p < .05');
            } else if (sig == 0.01 && result < sig) {
                if (result < "0.00001") {
                    $('#testResult').html('.00001');
                    $('#p_grater').html(valu15 + 'p < .01');
                } else {
                    $('#testResult').html(result);
                    $('#p_grater').html(valu15 + 'p < .01');
                }
            } else {
                $('#testResult').html(result);
                $('#p_grater').html(valu14 + 'p < .01');
            }
        </script>
    @endif
    <script>
        // Initial setup
        var val = document.getElementById('with').value;
        if (val === 'z') {
            document.querySelector('.z-text').textContent = '<?= $lang['6'] ?>';
            document.querySelector('.deg1').style.display = 'none';
            document.querySelector('.deg2').style.display = 'none';
            document.querySelector('.want_find').style.display = 'block';
            document.querySelector('.level_radio').style.display = 'block';
        } else if (val === 't') {
            document.querySelector('.z-text').textContent = '<?= $lang['7'] ?>';
            document.querySelector('.deg2').style.display = 'none';
            document.querySelector('.deg1').style.display = 'block';
            document.querySelector('.want_find').style.display = 'block';
            document.querySelector('.level_radio').style.display = 'block';
            document.querySelector('.deg-text').textContent = '<?= $lang['10'] ?> (d):';
        } else if (val === 'chi') {
            document.querySelector('.z-text').textContent = '<?= $lang['8'] ?>';
            document.querySelector('.deg2').style.display = 'none';
            document.querySelector('.deg1').style.display = 'block';
            document.querySelector('.want_find').style.display = 'none';
            document.querySelector('.level_radio').style.display = 'block';
            document.querySelector('.deg-text').textContent = '<?= $lang['10'] ?> (d):';
        } else if (val === 'f') {
            document.querySelector('.z-text').textContent = '<?= $lang['9'] ?>';
            document.querySelector('.deg-text').textContent = '<?= $lang['13'] ?> (d₁):';
            document.querySelector('.deg1').style.display = 'block';
            document.querySelector('.deg2').style.display = 'block';
            document.querySelector('.want_find').style.display = 'none';
            document.querySelector('.level_radio').style.display = 'block';
        } else if (val === 'r') {
            document.querySelector('.z-text').textContent = 'R Score:';
            document.querySelector('.deg2').style.display = 'none';
            document.querySelector('.deg1').style.display = 'block';
            document.querySelector('.n_score').style.display = 'none';
            document.querySelector('.deg-text').textContent = 'N:';
            document.querySelector('.want_find').style.display = 'none';
            document.querySelector('.level_radio').style.display = 'block';
        } else if (val === 'q') {
            document.querySelector('.z-text').textContent = 'The value of q:';
            document.querySelector('.deg-text').textContent = 'Number of groups (or means):';
            document.querySelector('.deg1').style.display = 'block';
            document.querySelector('.deg2').style.display = 'none';
            document.querySelector('.n_score').style.display = 'block';
            document.querySelector('.want_find').style.display = 'none';
            document.querySelector('.level_radio').style.display = 'none';
        }
        @if (isset($detail) || isset($error))
            var type = "{{ isset($_POST['level']) ? $_POST['level'] : '' }}";
            if (type === '.01') {
                document.getElementById('RadioButtonList1_0').checked = true;
            } else if (type === '.05') {
                document.getElementById('RadioButtonList1_1').checked = true;
            } else if (type === '.10') {
                document.getElementById('RadioButtonList1_2').checked = true;
            }
        @endif
        // Event listener for the 'change' event
        document.getElementById('with').addEventListener('change', function() {
            var val = this.value;
            if (val === 'z') {
                document.querySelector('.z-text').textContent = '<?= $lang['6'] ?>';
                document.querySelector('.deg1').style.display = 'none';
                document.querySelector('.deg2').style.display = 'none';
                document.querySelector('.n_score').style.display = 'none';
                document.querySelector('.want_find').style.display = 'block';
                document.querySelector('.level_radio').style.display = 'block';
            } else if (val === 't') {
                document.querySelector('.z-text').textContent = '<?= $lang['7'] ?>';
                document.querySelector('.deg2').style.display = 'none';
                document.querySelector('.deg1').style.display = 'block';
                document.querySelector('.n_score').style.display = 'none';
                document.querySelector('.want_find').style.display = 'block';
                document.querySelector('.level_radio').style.display = 'block';
                document.querySelector('.deg-text').textContent = '<?= $lang['10'] ?> (d):';
            } else if (val === 'chi') {
                document.querySelector('.z-text').textContent = '<?= $lang['8'] ?>';
                document.querySelector('.deg2').style.display = 'none';
                document.querySelector('.deg1').style.display = 'block';
                document.querySelector('.n_score').style.display = 'none';
                document.querySelector('.want_find').style.display = 'none';
                document.querySelector('.level_radio').style.display = 'block';
                document.querySelector('.deg-text').textContent = '<?= $lang['10'] ?> (d):';
            } else if (val === 'f') {
                document.querySelector('.z-text').textContent = '<?= $lang['9'] ?>';
                document.querySelector('.deg-text').textContent = '<?= $lang['13'] ?> (d₁):';
                document.querySelector('.deg1').style.display = 'block';
                document.querySelector('.n_score').style.display = 'none';
                document.querySelector('.want_find').style.display = 'none';
                document.querySelector('.deg2').style.display = 'block';
                document.querySelector('.level_radio').style.display = 'block';
            } else if (val === 'r') {
                document.querySelector('.z-text').textContent = 'R Score:';
                document.querySelector('.deg2').style.display = 'none';
                document.querySelector('.deg1').style.display = 'block';
                document.querySelector('.n_score').style.display = 'none';
                document.querySelector('.deg-text').textContent = 'N:';
                document.querySelector('.want_find').style.display = 'none';
                document.querySelector('.level_radio').style.display = 'block';
            } else if (val === 'q') {
                document.querySelector('.z-text').textContent = 'The value of q:';
                document.querySelector('.deg-text').textContent = 'Number of groups (or means):';
                document.querySelector('.deg1').style.display = 'block';
                document.querySelector('.deg2').style.display = 'none';
                document.querySelector('.n_score').style.display = 'block';
                document.querySelector('.want_find').style.display = 'none';
                document.querySelector('.level_radio').style.display = 'none';
            }
        });
    </script>
@endpush
