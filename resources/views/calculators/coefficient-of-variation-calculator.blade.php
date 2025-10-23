<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="w-full raw {{ isset($_POST['form']) && $_POST['form']=='summary' ? 'd-none' : '' }}">
                    <div class="grid grid-cols-1   gap-4">
                        <div class="space-y-2 px-2">
                            <div class="pt-2 pb-3 d-lg-flex justify-content-between align-items-center">
                                    <input name="type_" id="type_" class="r_data" value="1" type="radio" checked {{ isset($_POST['type_']) && $_POST['type_'] =='1' ? 'checked' : '' }} />
                                    <label for="type_" class="label pe-lg-0 pe-4">{{ $lang['sample'] }}</label>
                                    <input name="type_" id="types" class="r_data" value="2" type="radio" {{ isset($_POST['type_']) && $_POST['type_'] =='2' ? 'checked' : '' }} />
                                    <label for="types" class="label">{{ $lang['pop'] }}</label>
                            </div>
                        </div>
                        <div class="space-y-2 raw_mean">
                            <label for="x" class="label">{{ $lang['x'] }} ({{ $lang['note_value'] }})</label>
                            <div class="w-100 py-2">
                                <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'12, 23, 45, 33, 65, 54, 54' }}</textarea>
                            </div>
                        </div>
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
                    <div class="row">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['d'] }}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[25px] w-auto bg-[#2845F5] text-white px-3 py-2 rounded d-inline-block my-3">
                                <strong class="text-blue">
                                    {{$detail['c']}}
                                </strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><img src="<?=url('images/sample.webp')?>" alt="{{ $lang['a'] }}" loading="lazy" width="25" height="25"></td>
                                    <td class="py-2 border-b"><?=$lang['a']?></td>
                                    <td class="py-2 border-b"><b><?=(($detail['t_n'])?$detail['t_n']:'0')?></b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><img src="<?=url('images/mean.webp')?>" alt="{{ $lang['b'] }}" loading="lazy" width="25" height="25"></td>
                                    <td class="py-2 border-b"><?=$lang['b']?></td>
                                    <td class="py-2 border-b"><b><?=(($detail['m'])?$detail['m']:'0')?></b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><img src="<?=url('images/deviation.webp')?>" alt="{{ $lang['c'] }}" loading="lazy" width="25" height="25"></td>
                                    <td class="py-2 border-b"><?=$lang['c']?></td>
                                    <td class="py-2 border-b"><b><?=(($detail['d'])?$detail['d']:'0')?></b></td>
                                </tr>
                                {{-- <tr>
                                    <td class="py-2 border-b"><img src="<?=url('images/coeffi.webp')?>" alt="{{ $lang['d'] }}" loading="lazy" width="25" height="25"></td>
                                    <td class="py-2 border-b"><?=$lang['d']?></td>
                                    <td class="py-2 border-b"><b><?=(($detail['c'])?$detail['c']:'0')?></b></td>
                                </tr> --}}
                                <tr>
                                    <td class="py-2 border-b"><img src="<?=url('images/coeffi.webp')?>" alt="{{ $lang['d'] }}" loading="lazy" width="25" height="25"></td>
                                    <td class="py-2 border-b"><?=$lang['d']?> %</td>
                                    <td class="py-2 border-b"><b><?=(($detail['c'])?($detail['c']*100).' %':'0 %')?></b></td>
                                </tr>
                            </table>
                            @php
                                $x = request()->x;
                                $arr = $detail['arr'];
                                $m = $detail['m'];
                                $sum = 0;
                            @endphp
                            <p class="mt-3">
                                <strong>{{$lang['1']}}</strong>
                            </p>
                            <div>
                                <p class="mt-3">
                                    {{$lang['2']}} = 
                                    {{request()->x}}
                                </p>
                                <p class="mt-3">
                                    {{$lang['3']}} = {{$detail['count']}}
                                </p>
                            </div>
                            <p class="mt-2">
                                <span class="mb-5"> @if(request()->type_ == 1)
                                    x&#772;
                                    @else
                                    μ
                                    @endif  =
                                </span>
                                <span class="fraction"> 
                                    <span class="num">{{$lang['4']}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">{{$lang['5']}}</span>
                                </span>
                            </p>
                            <p>
                                <span class="mb-5"> @if(request()->type_ == 1)
                                    x&#772;
                                    @else
                                    μ
                                    @endif  =
                                </span>
                                <span class="fraction"> 
                                    <span class="num">{{$detail['replace']}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">{{$detail['count']}}</span>
                                </span>
                            </p>
                            <p>
                                <span class="mb-5"> @if(request()->type_ == 1)
                                    x&#772;
                                    @else
                                    μ
                                    @endif  =
                                </span>
                                <span class="fraction"> 
                                    <span class="num">{{$detail['sum']}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">{{$detail['count']}}</span>
                                </span>
                            </p>
                            <p class="mt-2">
                                    @if(request()->type_ == 1)
                                    x&#772;
                                    @else
                                    μ
                                    @endif  = {{$detail['m']}}
                            </p>
                            @if (request()->type_ == '1')
                                <p class="mt-4">
                                    \(s = \sqrt{\frac{\sum_{i=1}^{n}(x_i - \bar{x})^2}{n-1}}\)
                                </p>
                                <p class="mt-4">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                    <span class="mt-2">
                                        @foreach ($arr as $key => $value)
                                        (  {{$value}} {{"-"}} {{$m}} ) <sup>2</sup> <span class="{{$key < count($arr) -1 ? '' : 'd-none' }}">+</span>
                                        @endforeach
                                    </span>
                                </p>
                                <p class="mt-4">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                    <span class="mt-2">
                                        @foreach ($arr as $key => $value)
                                        (  {{$value - $m}} )<sup>2</sup> <span class="{{$key < count($arr) -1 ? '' : 'd-none' }}">+</span>
                                        @endforeach
                                    </span>
                                </p>
                                <p class="mt-3 d-none">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                    @foreach ($arr as $key => $value)
                                        @php
                                            $difference = $value - $m; // Calculate the difference
                                            $squaredValue = pow($difference, 2); // Calculate squared difference
                                            $sum += $squaredValue; // Add it to the sum
                                        @endphp
                                    @endforeach
                                    {{-- {{$sum}} --}}
                                </p>
                                <p class="mt-4">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = {{$sum}}
                                </p>
                                <p class="mt-4"> 
                                    S.D =
                                    \(\sqrt{\frac{ {{$sum}} }{ {{$detail['count']}} -1}}\)
                                </p>
                                <p class="mt-4"> 
                                    S.D =
                                    \(\sqrt{\frac{ {{$sum}}} { {{$detail['count']-1}} }}\)
                                </p>
                                <p class="mt-4"> S.D =
                                    \(\sqrt{ {{$sum / ($detail['count']-1)}} }\)
                                </p>
                                <p class="mt-4"> S.D =
                                {{$detail['d']}}
                                </p>
                                <p>  
                                    <span class="mb-5">{{$lang['6']}} (CV) =
                                    </span>
                                    <span class="fraction"> 
                                        <span class="num">s</span>
                                        <span class="visually-hidden"></span>
                                        <span class="den">x</span>
                                    </span>
                                </p>
                                <p>  
                                    <span class="mb-5"> CV =
                                    </span>
                                    <span class="fraction"> 
                                        <span class="num">{{$detail['d']}}</span>
                                        <span class="visually-hidden"></span>
                                        <span class="den">{{$detail['m']}}</span>
                                    </span>
                                </p>
                                <p>  
                                    CV = {{$detail['c']}}
                                </p>
                            @else
                                <p class="mt-4">
                                    {{-- \(\sigma = \sqrt{\frac{\sum_{i=1}^{n}(x_i - \mu)^2}{n}}\) --}}
                                    \(s = \sqrt{\frac{\sum_{i=1}^{n}(x_i - \mu)^2}{n}}\)
                                </p>
                                <p class="mt-4">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                    <span class="mt-2">
                                        @foreach ($arr as $key => $value)
                                        (  {{$value}} {{"-"}} {{$m}} ) <sup>2</sup> <span class="{{$key < count($arr) -1 ? '' : 'd-none' }}">+</span>
                                        @endforeach
                                    </span>
                                </p>
                                <p class="mt-4">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                    <span class="mt-2">
                                        @foreach ($arr as $key => $value)
                                        (  {{$value - $m}} )<sup>2</sup> <span class="{{$key < count($arr) -1 ? '' : 'd-none' }}">+</span>
                                        @endforeach
                                    </span>
                                </p>
                                <p class="mt-3 d-none">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                    @foreach ($arr as $key => $value)
                                        @php
                                            $difference = $value - $m; // Calculate the difference
                                            $squaredValue = pow($difference, 2); // Calculate squared difference
                                            $sum += $squaredValue; // Add it to the sum
                                        @endphp
                                    @endforeach
                                    {{-- {{$sum}} --}}
                                </p>
                                <p class="mt-4">
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = {{$sum}}
                                </p>
                                <p class="mt-4"> 
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) =
                                    \(\sqrt{\frac{ {{$sum}} }{ {{$detail['count']}}}}\)
                                </p>
                                <p class="mt-4"> 
                                    \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) =
                                    \(\sqrt{\frac{ {{$sum}}} { {{$detail['count']}} }}\)
                                </p>
                                <p class="mt-4">  σ  =
                                    \(\sqrt{ {{$sum / ($detail['count'])}} }\)
                                </p>
                                <p class="mt-4">  σ  =
                                    {{$detail['d']}}
                                </p>
                                <p>  
                                    <span class="mb-5">{{$lang['6']}} (CV) =
                                    </span>
                                    <span class="fraction">
                                        
                                        
                                        <span class="num"> μ</span>
                                        <span class="visually-hidden"></span>
                                        <span class="den"> σ</span>
                                    </span>
                                </p>
                                <p>  
                                    <span class="mb-5"> CV =
                                    </span>
                                    <span class="fraction"> 
                                        <span class="num">{{$detail['d']}}</span>
                                        <span class="visually-hidden"></span>
                                        <span class="den">{{$detail['m']}}</span>
                                    </span>
                                </p>
                                <p>  
                                    CV = {{$detail['c']}}
                                </p>                       
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if(isset($detail))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css" integrity="sha384-nB0miv6/jRmo5UMMR1wu3Gz6NLsoTkbqJghGIsx//Rlm+ZU03BU6SQNC66uf4l5+" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js" integrity="sha384-7zkQWkzuo3B5mTepMUcHkMB5jZaolc2xDwL6VFqjFALcbeS9Ggm/Yr2r3Dy4lfFg" crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js" integrity="sha384-43gviWU0YVjaDtb/GhzOouOXtZMP/7XUzwPTstBeZFe/+rCMvRwr4yROQP43s0Xk" crossorigin="anonymous"
        onload="renderMathInElement(document.body);"></script>
    @endif
    <script>
        // Initial setup based on value of '#event', '#data_for', '#type', and '#type_'
        var event = document.getElementById('event').value;
        updateEventText(event);

        var dataFor = document.getElementById('data_for').value;
        toggleDisplay('.pro', dataFor == 1);
        toggleDisplay('.raw_mean', dataFor != 1);

        var type = document.getElementById('type').value;
        updateMeanAndDeviationText(type == 1);

        var type_ = document.getElementById('type_').value;
        updateMeanAndDeviationText(type_ == 1);

        // Event listener for '#event' change event
        document.getElementById('event').addEventListener('change', function() {
            var event = this.value;
            updateEventText(event);
        });

        // Event listener for '#data_for' change event
        document.getElementById('data_for').addEventListener('change', function() {
            var dataFor = this.value;
            toggleDisplay('.pro', dataFor == 1);
            toggleDisplay('.raw_mean', dataFor != 1);
        });

        // Event listener for '#type' change event
        document.getElementById('type').addEventListener('change', function() {
            var type = this.value;
            updateMeanAndDeviationText(type == 1);
        });

        // Event listener for '#type_' change event
        document.getElementById('type_').addEventListener('change', function() {
            var type_ = this.value;
            updateMeanAndDeviationText(type_ == 1);
        });

        // Event listeners for summary and raw data buttons
        document.querySelector('.s_data').addEventListener('click', function() {
            toggleDisplay('.summary', true);
            toggleDisplay('.raw', false);
        });

        document.querySelector('.r_data').addEventListener('click', function() {
            toggleDisplay('.summary', false);
            toggleDisplay('.raw', true);
        });

        // Function to update event text
        function updateEventText(event) {
            var eventText;
            switch (event) {
                case '1':
                    eventText = 'Event Proportions';
                    break;
                case '2':
                    eventText = 'Event Rate %';
                    break;
                case '3':
                    eventText = 'Number of events';
                    break;
                default:
                    eventText = '';
            }
            document.querySelector('.event').textContent = eventText;
        }

        // Function to toggle element display
        function toggleDisplay(selector, isVisible) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.style.display = isVisible ? 'block' : 'none';
            });
        }

        // Function to update mean and deviation text
        function updateMeanAndDeviationText(isType1) {
            var meanText = isType1 ? 'Mean (x̅)' : 'Mean (μ)';
            var deviationText = '<?=$lang['sd']?> ' + (isType1 ? '(s)' : '(σ)');
            if (isType1) {
                document.querySelectorAll('.sample').forEach(function(element) {
                    element.style.display = 'block';
                });
            } else {
                document.querySelectorAll('.sample').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
            document.querySelectorAll('.mean').forEach(function(element) {
                element.textContent = meanText;
            });
            document.querySelectorAll('.deviation').forEach(function(element) {
                element.textContent = deviationText;
            });
        }

    </script>
@endpush