<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail) || isset($detail['disable']) || isset($detail['enable']))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                @if(isset($detail['disable']))
                    <input type="hidden" name="submit_type" value="dis">
                    <p class="col-2 text-center"><strong>{!! $lang['s_name'] !!}</strong></p>
                    <p class="col-2 text-center"><strong>{{ $lang['Age'] }}</strong></p>
                    <p class="col-2 text-center"><strong>{{ $lang['gen'] }}</strong></p>
                    <p class="col-2 text-center"><strong>{{ $lang['push'] }}</strong> <br> 2 / {{ $lang['mini'] }}</p>
                    <p class="col-2 text-center"><strong>{{ $lang['sit'] }}</strong> <br> 2 / {{ $lang['mini'] }}</p>
                    <p class="col-2 text-center"><strong>{{ $lang['2mil'] }}</strong> <br> MM:SS</p>
                    <div class="col-12 mt-2 overflow-auto" style="height: 400px">
                        <div class="row">
                            {!! $detail['input'] !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="p-1"><strong>{{ $lang['pass'] }}</strong></p>
                        <select name="pass" class="input">
                            <option value="60">60% (Army)</option>
                            <option value="50">50% (BCT/RSP)</option>
                        </select>
                    </div>
                @elseif(isset($detail['enable']))
                    <input type="hidden" name="submit_type" value="enable">
                    <p class="col-2 text-center"><strong>{{ $lang['s_name'] }}</strong></p>
                    <p class="col-1 text-center"><strong>{{ $lang['Age'] }}</strong></p>
                    <p class="col-2 text-center"><strong>{{ $lang['gen'] }}</strong></p>
                    <p class="col-2 text-center"><strong>{{ $lang['push'] }}</strong> <br> 2 / {{ $lang['mini'] }}</p>
                    <p class="col-1 text-center"><strong>{{ $lang['sit'] }}</strong> <br> 2 / {{ $lang['mini'] }}</p>
                    <p class="col-1 text-center"><strong>Height</strong> <br> (in)</p>
                    <p class="col-1 text-center"><strong>Weight</strong> <br> (lbs)</p>
                    <p class="col-2 text-center"><strong>{{ $lang['2mil'] }}</strong> <br> MM:SS</p>
                    <div class="col-12 mt-2 overflow-auto weight_h" style="height: 400px">
                        <div class="row">
                            {!! $detail['input'] !!}
                        </div>
                    </div>
                    <div class="col-12">
                        <p class="p-1"><strong>{{ $lang['pass'] }}</strong></p>
                        <select name="pass" class="input">
                            <option value="60">60% (Army)</option>
                            <option value="50">50% (BCT/RSP)</option>
                        </select>
                    </div>
                @else
                    <input type="hidden" name="submit_type" value="">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="method" class="font-s-14 text-blue">{!! $lang['for'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select name="method" id="method" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['score'],$lang['check'],$lang['multi']];
                                    $val = ["score","check","multi"];
                                    optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'score');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 age">
                        <label for="age" class="font-s-14 text-blue">{!! $lang['Age'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                            <span class="text-blue input_unit">{!! $lang['year'] !!}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 age">
                        <label for="gender" class="font-s-14 text-blue">{!! $lang['gen'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select name="gender" id="gender" class="input">
                                @php
                                    $name = [$lang['male'],$lang['female']];
                                    $val = ["Male","Female"];
                                    optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 multi hidden">
                        <label for="number" class="font-s-14 text-blue">{!! $lang['nbr'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="number" id="number" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['number'])?$_POST['number']:'' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 multi hidden">
                        <label for="weight" class="font-s-14 text-blue">{!! $lang['hw'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select name="weight" id="weight" class="input">
                                @php
                                    $name = [$lang['dis'],$lang['able']];
                                    $val = ["1","2"];
                                    optionsList($val,$name,isset($_POST['weight'])?$_POST['weight']:'1');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 score">
                        <label for="push" class="font-s-14 text-blue">{!! $lang['push'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="push" id="push" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['push'])?$_POST['push']:'45' }}" />
                            <span class="text-blue input_unit">2 / {!! $lang['mini'] !!}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 score">
                        <label for="sit" class="font-s-14 text-blue">{!! $lang['sit'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="sit" id="sit" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['sit'])?$_POST['sit']:'55' }}" />
                            <span class="text-blue input_unit">2 / {!! $lang['mini'] !!}</span>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-4 lg:col-span-4 score">
                        <label for="min" class="font-s-14 text-blue">{!! $lang['2mil'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="min" min="0" max="59" id="min" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['min'])?$_POST['min']:'14' }}" />
                            <span class="text-blue input_unit">{!! $lang['minute'] !!}</span>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-2 lg:col-span-2 score">
                        <label for="sec" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="sec" min="0" max="59" id="sec" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['sec'])?$_POST['sec']:'35' }}" />
                            <span class="text-blue input_unit">{!! $lang['sec'] !!}</span>
                        </div>
                    </div>
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
    

    @elseif(isset($detail))
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full overflow-auto mt-2">
                            @if(isset($detail['dis_res']))
                                <table class="w-full" cellspacing="0">
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="rounded-l ps-4 pe-3 py-3">#</td>
                                        <td class="px-3">{{ $lang['s'] }} <sub class="text-white">{{ $lang['push'] }} ({{ $lang['rep'] }})</sub></td>
                                        <td class="px-3">{{ $lang['s'] }} <sub class="text-white">{{ $lang['sit'] }} ({{ $lang['rep'] }})</sub></td>
                                        <td class="px-3">{{ $lang['s'] }} <sub class="text-white">{{ $lang['2mil'] }} (MM:SS)</sub></td>
                                        <td class="rounded-r px-3">{{ $lang['total'] }}</td>
                                    </tr>
                                    {!! $detail['output'] !!}
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="rounded-l ps-4 pe-3 py-3">{{ $lang['ave'] }}</td>
                                        <td class="px-3">{{ round($detail['total_push']/$detail['ave']) }}</td>
                                        <td class="px-3">{{ round($detail['total_sit']/$detail['ave']) }}</td>
                                        <td class="px-3">{{ round($detail['total_run']/$detail['ave']) }}</td>
                                        <td class="rounded-r px-3">{{ round($detail['total_score']/$detail['ave']) }}</td>
                                    </tr>
                                </table>
                            @elseif(isset($detail['able_res']))
                                <table class="w-full" cellspacing="0">
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="rounded-l ps-4 pe-3 py-3">#</td>
                                        <td class="px-3">{{ $lang['s'] }} <sub class="text-white">{{ $lang['push'] }} ({{ $lang['rep'] }})</sub></td>
                                        <td class="px-3">{{ $lang['s'] }} <sub class="text-white">{{ $lang['sit'] }} ({{ $lang['rep'] }})</sub></td>
                                        <td class="px-3">{{ $lang['s'] }} <sub class="text-white">{{ $lang['2mil'] }} (MM:SS)</sub></td>
                                        <td class="px-3">{{ $lang['total'] }}</td>
                                        <td class="rounded-r px-3">{{ $lang['w'] }} (lbs)</td>
                                    </tr>
                                    {!! $detail['output'] !!}
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="rounded-l ps-4 pe-3 py-3">{{ $lang['ave'] }}</td>
                                        <td class="px-3">{{ round($detail['total_push']/$detail['ave']) }}</td>
                                        <td class="px-3">{{ round($detail['total_sit']/$detail['ave']) }}</td>
                                        <td class="px-3">{{ round($detail['total_run']/$detail['ave']) }}</td>
                                        <td class="px-3">{{ round($detail['total_score']/$detail['ave']) }}</td>
                                        <td class="rounded-r px-3">&nbsp;</td>
                                    </tr>
                                </table>
                            @else
                                @if($_POST['method']=='score')
                                    <div class="w-full overflow-auto mt-2">
                                        <table class="w-full" cellspacing="0">
                                            <tr class="bg-[#2845F5] text-white">
                                                <td class="rounded-l ps-4 pe-3 py-2">{{ $lang['Activity'] }}</td>
                                                <td class="px-3">{{ $lang['rept'] }}</td>
                                                <td class="px-3">{{ $lang['pe'] }}</td>
                                                <td class="rounded-r px-3">{{ $lang['res'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3">{{ $lang['push'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $_POST['push'] }}</td>
                                                <td class="border-b px-3">{{ $detail['push_s'] }}</td>
                                                <td class="border-b px-3">
                                                    <p class="text-center p-1 rounded-lg {{ $detail['push_class'] }}">
                                                        @if($detail['push_s'] < 60)
                                                            {{ $lang['fail'] }}
                                                        @else
                                                            {{ $lang['pass'] }}
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3">{{ $lang['sit'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $_POST['sit'] }}</td>
                                                <td class="border-b px-3">{{ $detail['sit_s'] }}</td>
                                                <td class="border-b px-3">
                                                    <p class="text-center p-1 rounded-lg {{ $detail['sit_class'] }}">
                                                        @if($detail['push_s'] < 60)
                                                            {{ $lang['fail'] }}
                                                        @else
                                                            {{ $lang['pass'] }}
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3">2 Mile Run (Time)</td>
                                                <td class="border-b px-3">{{ $_POST['min'] }}:{{ $_POST['sec'] }}</td>
                                                <td class="border-b px-3">{{ $detail['run_s'] }}</td>
                                                <td class="border-b px-3">
                                                    <p class="text-center p-1 rounded-lg {{ $detail['run_class'] }}">
                                                        @if($detail['push_s'] < 60)
                                                            {{ $lang['fail'] }}
                                                        @else
                                                            {{ $lang['pass'] }}
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3" colspan="2"><strong>{{ $lang['ts'] }}</strong></td>
                                                <td class="border-b px-3"><strong>{{ $detail['total'] }}</strong></td>
                                                <td class="border-b px-3">
                                                    <p class="text-center p-1 rounded-lg {{ $detail['total_class'] }}">
                                                        @if($detail['push_s'] < 60)
                                                            {{ $lang['fail'] }}
                                                        @else
                                                            {{ $lang['pass'] }}
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full text-[20px] mt-3"><strong>{{ $lang['your'] }} & {{ $lang['min'] }}</strong></p>
                                    <div class="w-full overflow-auto mt-2">
                                        <table class="w-full" cellspacing="0">
                                            <tr class="bg-[#2845F5] text-white">
                                                <td class="rounded-l ps-4 pe-3 py-2">{{ $lang['Activity'] }}</td>
                                                <td class="px-3">{{ $lang['your'] }}</td>
                                                <td class="rounded-r px-3">{{ $lang['min'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3">{{ $lang['push'] }}</td>
                                                <td class="border-b px-3">{{ $_POST['push'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['min_push'] }} ({{ $lang['rep'] }})</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3">{{ $lang['sit'] }}</td>
                                                <td class="border-b px-3">{{ $_POST['sit'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['min_sit'] }} ({{ $lang['rep'] }})</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3">{{ $lang['2mil'] }}</td>
                                                <td class="border-b px-3">{{ $_POST['min'] }}:{{ $_POST['sec'] }} (MM:SS)</td>
                                                <td class="border-b px-3">{{ $detail['min_time'] }} (MM:SS)</td>
                                            </tr>
                                        </table>
                                    </div>
                                @else
                                    <p class="w-full text-[20px]"><strong>{{ $lang['min'] }}</strong></p>
                                    <div class="w-full overflow-auto mt-2">
                                        <table class="w-full" cellspacing="0">
                                            <tr class="bg-[#2845F5] text-white">
                                                <td class="rounded-l ps-4 pe-3"></td>
                                                <td class="px-3">{{ $lang['push'] }}</td>
                                                <td class="px-3">{{ $lang['sit'] }}</td>
                                                <td class="rounded-r px-3 py-2">{{ $lang['2mil'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3"><strong>APFT {{ $lang['bad'] }}</strong></td>
                                                <td class="border-b px-3">{{ $detail['b_push'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['b_sit'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['b_time'] }} (MM:SS)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3"><strong>{{ $lang['bt'] }}</strong></td>
                                                <td class="border-b px-3">{{ $detail['basic_push'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['basic_sit'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['basic_time'] }} (MM:SS)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b px-3 py-3"><strong>{{ $lang['main'] }}</strong></td>
                                                <td class="border-b px-3">{{ $detail['main_push'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['main_sit'] }} ({{ $lang['rep'] }})</td>
                                                <td class="border-b px-3">{{ $detail['main_time'] }} (MM:SS)</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="w-full text-center my-[30px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endif
    @push('calculatorJS')
        <script>
            var get_method = document.getElementById('method');
            if(get_method){
                var method = get_method.value;
                if (method === 'check') {
                    document.querySelectorAll('.score, .multi').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.age').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.calculate').textContent = '{{ $lang['cal'] }}';
                } else if (method === 'score') {
                    document.querySelectorAll('.score').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.multi').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.age').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.calculate').textContent = '{{ $lang['cal'] }}';
                } else if (method === 'multi') {
                    document.querySelectorAll('.score').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.multi').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.age').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelector('.calculate').textContent = 'Begin';
                }

                get_method.addEventListener('change', function() {
                    var method = this.value;
                    if (method === 'check') {
                        document.querySelectorAll('.score, .multi').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.calculate').textContent = '{{ $lang['cal'] }}';
                    } else if (method === 'score') {
                        document.querySelectorAll('.score').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.multi').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.calculate').textContent = '{{ $lang['cal'] }}';
                    } else if (method === 'multi') {
                        document.querySelectorAll('.score').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.multi').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelectorAll('.age').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelector('.calculate').textContent = 'Begin';
                    }
                });
            }

        </script>
    @endpush
</form>