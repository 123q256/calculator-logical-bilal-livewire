<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <input type="hidden" name="hidden_currency" id="hidden_currency" value="{{$currancy}}">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="90" value="{{ isset($_POST['first'])?$_POST['first']:'90' }}" />
                        <span class="text-blue input-unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="operations1" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="operations1" id="operations1">
                            <option value="1" {{ isset($_POST['operations1']) && $_POST['operations1']=='1'?'selected':''}}>{{ $lang[3] }}</option>
                            <option value="2" {{ isset($_POST['operations1']) && $_POST['operations1']=='2'?'selected':''}}>{{ $lang[4] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 other">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="90" value="{{ isset($_POST['second'])?$_POST['second']:'90' }}" />
                        <span class="text-blue input-unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 other">
                    <label for="third" class="font-s-14 text-blue">{{ $lang[6] }} ({{ $lang['11'] }}):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="90" value="{{ isset($_POST['third'])?$_POST['third']:'90' }}" />
                        <span class="text-blue input-unit">{{ $currancy}}</span>
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
                    @if($detail['operations1'] == 1)
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto  mt-2">
                            <table class="w-100 font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['answer1'], 4) }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] }} </strong></td>
                                <td class="py-2 border-b"> {{ $currancy}} {{ $detail['answer2'] }}</td>
                            </tr>
                    
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="col my-3">
                                <p id="line"> {{$detail['line']}} </p>
                            </div>
                            <div class="col my-3">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    @elseif($detail['operations1']  == 2)
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-100 font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['9'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $currancy}} {{ $detail['answer1'] }} </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['10'] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['answer2'], 4) }} %</td>
                            </tr>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="col my-3">
                                <p id="line"> {{$detail['line']}} </p>
                            </div>
                            <div class="col my-3">
                                <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
@isset($detail)

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>

let dropVals = "{{$detail['operations1']}}";

var otherElements = document.querySelectorAll('.other');

if (dropVals === '1') {
    otherElements.forEach(function(element) {
        element.style.display = 'block';
    });
} else if (dropVals === '2') {
    otherElements.forEach(function(element) {
        element.style.display = 'none';
    });
}

    window.onload = function() {
        let dropVal = "{{$detail['operations1']}}";
        if (dropVal  == "1") {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "ROAS"
                },
                data: [{
                    type: "column",
                    dataPoints: [{
                            y: {{$detail['first']}},
                            label: "Ad spend"
                        },
                        {
                            y: ({{$detail['first']* 8}} ),
                            label: "Ad revenue target"
                        },
                        {
                            y:  {{$detail['second']}},
                            label: "Ad revenue"
                        }
                    ]
                }]
            });
            chart.render();
        } else if (dropVal  == "2") {
            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "ROAS"
                },
                data: [{
                    type: "column",
                    dataPoints: [{
                            y:  {{$detail['first']}},
                            label: "Ad spend"
                        },
                        {
                            y: {{$detail['answer1']}},
                            label: "Ad revenue target"
                        }
                    ]
                }]
            });
            chart2.render();
        }
    }

</script>
@endisset
<script>

    'use strict';
    var operations1 = document.getElementById('operations1');
    operations1.addEventListener('change', function() {
        var cal = this.value;
        var otherElements = document.querySelectorAll('.other');
        if (cal === '1') {
            otherElements.forEach(function(element) {
                element.style.display = 'block';
            });
        } else if (cal === '2') {
            otherElements.forEach(function(element) {
                element.style.display = 'none';
            });
        }
    });

    @if(isset($error))
var type = "{{$_POST['operations1']}}";
var otherElements = document.querySelectorAll('.other');
if (type === '1') {
            otherElements.forEach(function(element) {
                element.style.display = 'block';
            });
        } else if (type === '2') {
            otherElements.forEach(function(element) {
                element.style.display = 'none';
            });
        }
 @endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>