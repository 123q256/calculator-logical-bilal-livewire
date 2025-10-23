<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12">
                <label for="to" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="to" id="to">
                        <option value="1">{{$lang[2]}}</option>
                        <option value="2"{{ isset($_POST['to']) && $_POST['to'] == '2' ? 'selected' : '' }}>{{$lang[3]}}</option>
                    </select>
                </div>
            </div>
            <p class="col-span-12 text-center my-3 text-[18px]">
                @if (isset($_POST['to']) && $_POST['to'] === '2')
                    <strong id="changeText">{{$lang[6]}}: y = mx + c</strong>
                @else
                    <strong id="changeText">{{$lang[4]}}: Ax + By + C = 0 </strong>
                @endif
            </p>
            <div class="{{ isset($_POST['to']) && $_POST['to']==='2' ? 'md:col-span-6 lg:col-span-6 col-span-6':'md:col-span-4 lg:col-span-4 col-span-4' }} px-2 mt-0 mt-lg-2" id="aInput">
                <label for="a" class="font-s-14 text-blue">{{$lang[5]}} <span id="enter_a">A</span></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : '2' }}" aria-label="input" />
                </div>
            </div>
            <div class="{{ isset($_POST['to']) && $_POST['to']==='2' ? 'md:col-span-6 lg:col-span-6 col-span-6':'md:col-span-4 lg:col-span-4 col-span-4' }} px-2 mt-0 mt-lg-2" id="bInput">
                <label for="b" class="font-s-14 text-blue">{{$lang[5]}} <span id="enter_b">B</span></label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : '-6' }}" aria-label="input" />
                </div>
            </div>
            <div class="md:col-span-4 lg:col-span-4 col-span-4 {{ isset($_POST['to']) && $_POST['to']==='2' ? 'hidden':'' }}" id="cInput">
                <label for="c" class="font-s-14 text-blue">{{$lang[5]}} C</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="c" id="c" class="input" value="{{ isset($_POST['c']) ? $_POST['c'] : '-13' }}" aria-label="input" />
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
                        @if($_POST['to'] === "1")
                            <div class="col-span-12 text-center text-[18px]">
                                <p>{{$lang['6']}}</p>
                                <p class="my-3"><strong>y = mx + c</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[22px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block">
                                    <strong>
                                        y = {{round($detail['m'], 3)}}x 
                                        @php
                                            if ($detail['nb']<0) {
                                                echo '+ '.round(abs($detail['nb']), 3);
                                            }else{
                                                echo '- '.round($detail['nb'], 3);
                                            }
                                        @endphp
                                    </strong>
                                </p>
                            </div>
                        </div>
                            <div class="col-span-12 text-[16px]">
                                <p class="mt-2"><strong>{{ $lang[7] }}:</strong></p>
                                <p class="mt-2">{{ $lang[4] }}:</p>
                                <p class="mt-2">{{ $_POST['a'] }}x {{ ($_POST['b'] < 0) ? '- '.abs($_POST['b']) : '+ '.$_POST['b'] }}y  {{ $_POST['c'] }} = 0</p>
                                <p class="mt-2">{{ $lang[8] }} 'x' {{ $lang[9] }}:</p>
                                {{-- @dd($_POST['c']); --}}
                                <p class="mt-2">{{ $_POST['b'] }}y = {{ $_POST['a']*(-1) }}x {{ $_POST['c'] < 0 ? ' + '.abs($_POST['c']) : '- '.($_POST['c']) }}</p>
                                <p class="mt-2">{{ $lang[10] }} y:</p>
                                <p class="mt-2">y = ({{ $_POST['a']*(-1) }}x {{ ($_POST['c'] < 0) ? '+ '.abs($_POST['c']) : '- '.$_POST['c'] }})/{{ $_POST['b'] }}</p>
                                <p class="mt-2">y = ({{ $_POST['a']*(-1) }}/{{ $_POST['b'] }})x ({{ ($_POST['c'] < 0) ? '+ '.abs($_POST['c']) : '- '.$_POST['c'] }}/{{ $_POST['b'] }})</p>
                                <p class="mt-2">{{ $lang[6] }}</p>
                                <p class="mt-2">y = {{ $detail['m'] }}x {{ ($detail['nb'] < 0) ? '+ '.abs($detail['nb']) : '- '.$detail['nb'] }}</p>
                            </div>
                            <div class="col-span-6 mt-2">
                                <table class="w-100 font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang[11]}} (m)</td>
                                        <td class="py-2 border-b"><strong>{{(($detail['m']!='')?$detail['m']:'0.0')}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">Y - {{$lang[12]}} (c)</td>
                                        <td class="py-2 border-b"><strong>{{ ($detail['nb'] < 0) ? '+ '.abs($detail['nb']) : '- '.$detail['nb'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">X - {{$lang[12]}}</td>
                                        <td class="py-2 border-b"><strong>{{round((-1)*$detail['nb']/$detail['m'],2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang[13]}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['m']*100}} %</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang[14]}} (θ)</td>
                                        <td class="py-2 border-b"><strong>{{(($detail['angle']!='')?$detail['angle']:'0.0 deg')}} deg</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="col-span-12 text-center font-s-20">
                                <p>{{$lang['4']}}</p>
                                <p class="my-3"><strong class="font-s-20">Ax + By + C = 0</strong></p>
                                <p class="my-3">
                                    <strong class="bg-white px-3 py-2 font-s-32 radius-10 text-blue">
                                        {{(($detail['A']!=1)?$detail['A']:'')}}x
                                        @php
                                            if ($detail['B']<0) {
                                                echo '- '.abs($detail['B']);
                                            }else{
                                                echo '+ '.$detail['B'];
                                            }
                                        @endphp
                                        y {{$detail['B']<0 ? '- '.abs($detail['C']) : '+ '.abs($detail['C'])}} = 0
                                    </strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('to').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText').textContent = '{{$lang[4]}}: Ax + By = C';
                    ['#cInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#aInput', '#bInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            console.log('Element:', element);
                            element.classList.remove('md:col-span-6 lg:col-span-6', 'col-span-6');
                            element.classList.add('md:col-span-4 lg:col-span-4', 'col-span-4');
                        });
                    });
                } else {
                    document.getElementById('changeText').textContent = '{{$lang[6]}}: y = mx + c';
                    ['#cInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#aInput', '#bInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            console.log('Element:', element);
                            element.classList.remove('md:col-span-4 lg:col-span-4', 'col-span-4');
                            element.classList.add('md:col-span-6 lg:col-span-6', 'col-span-6');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>