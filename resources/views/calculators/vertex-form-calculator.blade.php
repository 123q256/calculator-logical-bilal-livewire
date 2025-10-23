<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
    }
    .velocitytab .tagsUnit{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .tagsUnit{
        color: white
    }
    .velocitytab p{
        position: relative;
        top: 2px;
        font-weight: 600;
    }
    .velocitytab p:hover{
        background: gainsboro;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST" id="myForm">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php $request = request(); @endphp
               <div class=" mx-auto mt-2  w-full">
                <input type="hidden" name="type" value="{{ isset($request->type) ? $request->type : 'standard' }}" id="type">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 velocitytab">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors veloTabs duration-300  hover_tags hover:text-white  {{ isset($request->type) && $request->type == 'vertex' ? '':'tagsUnit' }}" id="imperial">
                                {{ $lang['12'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors veloTabs duration-300  hover_tags hover:text-white {{ isset($request->type) && $request->type == 'vertex' ? 'tagsUnit':'' }}" data-value="vertex" id="vertex">
                                {{ $lang['11'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div id="simpleInput" class=" col-span-12">
                <p class="text-center my-2text-[14px}">  <strong>Standard Form :</strong> y = ax<sup class="font-s-12">2</sup> + bx + c</p>
                     <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-4">
                        <label for="a1" class="label">Enter a:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="a1" id="a1" class="input" value="{{ isset($request->a1)?$request->a1:'' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b1" class="label">Enter b:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="b1" id="b1" class="input" value="{{ isset($request->b1)?$request->b1:'' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c1" class="label">Enter c:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c1" id="c1" class="input" value="{{ isset($request->c1)?$request->c1:'' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div id="advancedInput" class="hidden col-span-12">
                <p class="text-center my-2text-[14px}"><strong>Vertex Form : </strong>f(x) = A (x - H)<sup class="font-s-12">2</sup> + K</p>
                     <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-4">
                        <label for="a" class="label">Enter A:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($request->a)?$request->a:'12' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b" class="label">Enter H:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($request->b)&& $request->b == null ?'' : $request->b }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c" class="label">Enter K:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c" id="c" class="input" value="{{ isset($request->c)&& $request->c == null ?'' : $request->c }}" aria-label="input"/>
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
                    @php
                        $a = $detail['A'];
                        $b = $detail['B'];
                        $c = $detail['C'];
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                            <table class="w-full text-[18px]">
                                @if($detail['submit'] === "standard")
                                    <tr>
                                        <td class="py-2 border-b" width="35%"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            \( f({{$detail['variable_ans']}}) = {{$detail['vertex']}} \)
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="35%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            \( f({{$detail['variable_ans']}}) = {{$detail['A']}} {{$detail['variable_ans']}}^2 {{(($detail['B'] < 0) ? $detail['B'] : ' + ' . $detail['B'])}} {{$detail['variable_ans']}} {{ (($detail['C'] < 0) ? $detail['C'] : ' + ' . $detail['C']) }} \)
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <p class="mt-2 text-[16px]"><strong>{{$lang['7']}}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b">
                                        \( P({{$detail['firstx']}}, {{round($detail['yaxis'],3)}}) \)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%">{{ $lang['9'] }}</td>
                                    <td class="py-2 border-b">
                                        \( P(0, {{$detail['C']}}) \)
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['15']}}</strong></p>
                            <p class="mt-2">{{$lang[16]}}:</p>
                            <p class="mt-2 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $detail['A'] }}{{ $detail['variable_ans'] }}^2 {{ (($detail['B'] < 0) ? $detail['B'] : ' + ' . $detail['B']) }}{{ $detail['variable_ans'] }} {{ (($detail['C'] < 0) ? $detail['C'] : ' + ' . $detail['C']) }}\)</p>
                            <p class="mt-2">({{$lang[17]}})</p>
                            <p class="col s12 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $a }} \left({{ $detail['variable_ans'] }}^2 {{ (($b / $a < 0) ? $b / $a : ' + ' . $b / $a) }}{{ $detail['variable_ans'] }} {{ (($c < 0) ? $c : ' + ' . $c) }}\right)\)</p>
                            <p class="mt-2">({{$lang[18]}})</p>
                            <p class="col s12 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $a }} \left({{ $detail['variable_ans'] }}^2 {{ (($b / $a < 0) ? $b / $a : ' + ' . $b / $a) }}{{ $detail['variable_ans'] }} + \left( \dfrac{ {{ $b }} }{ {{ $a * 2 }} } \right)^2 - \left( \dfrac{ {{ $b }} }{ {{ $a * 2 }} } \right)^2 + \dfrac{ {{ $c }} }{ {{ $a }} }\right)\)</p>
                            <p class="mt-2">({{$lang[19]}})</p>
                            <p class="col s12 overflow-auto">\(f({{ $detail['variable_ans'] }}) = {{ $a }} \left(\left({{ $detail['variable_ans'] }} + \frac{ {{ $b }} }{ {{ $a * 2 }} }\right)^2 - \left(\dfrac{ {{ $b }} }{ {{ $a * 2 }} }\right)^2 + \dfrac{ {{ $c }} }{ {{ $a }} }\right) \)</p>
                            <p class="mt-2">({{$lang[20]}})</p>
                            <p class="col s12 overflow-auto" style="height: 50px;">\(f({{ $detail['variable_ans'] }}) = {{ $a }} \left(\left({{ $detail['variable_ans'] }} + \frac{ {{ $b }} }{ {{ $a * 2 }} }\right)^2 + \dfrac{ {{ $detail['yaxis'] * (pow($a * $detail['round1'], 2) / $a) }} }{ {{ pow($a * $detail['round1'], 2) }} }\right) \)</p>
                            <p class="mt-2">({{$lang[21]}})</p>
                            <p class="col s12 overflow-auto"  style="height: 53px;">\(f({{ $detail['variable_ans'] }}) = {{ $a }}\left({{ $detail['variable_ans'] }} + \frac{ {{ $b }} }{ {{ $a * 2 }} }\right)^2 + \dfrac{ {{ $detail['yaxis'] * (pow($a * $detail['round1'], 2) / $a) }} }{ {{ pow($a * $detail['round1'], 2) / $a }} } \)</p>
                            <p class="mt-2">{{$lang[22]}}:</p>
                            <div id="chart_div" class="col-lg-10 mx-auto my-3" style="height: 500px;"></div>
                            <div class="flex justify-center item-center text-[18px] ">
                                <p class="flex"><img src="{{asset('images/vertex.png')}}" alt="vertex" class="px-2 object-contain">Vertex </p>
                                <p class="flex"><img src="{{asset('images/y-axis.png')}}" alt="Y-axis" class="px-2 object-contain">Y-Intercept</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                google.charts.load("current", {
                    packages: ["corechart"]
                });
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var a = '{{$detail['A']}}';
                    var b = '{{$detail['B']}}';
                    var c = '{{$detail['C']}}';
                    var firstx = '{{($detail['B'] * (-1)) / ($detail['A'] * 2)}}';
                    firstx = parseFloat(firstx) + parseFloat(25);
                    var adata = [
                        ['X', 'Y', {
                            'type': 'string',
                            'role': 'style'
                        }]
                    ];
                    for (var i = 0; i <= 50; i++) {
                        var first_part = Math.pow(firstx, 2) * a;
                        var second_part = b * firstx;
                        if (second_part < 0 && c < 0) {
                            var eq = first_part + ' ' + second_part + ' ' + c;
                        }
                        if (second_part < 0 && c >= 0) {
                            var eq = first_part + ' ' + second_part + ' + ' + c;
                        }
                        if (second_part >= 0 && c < 0) {
                            var eq = first_part + ' + ' + second_part + ' ' + c;
                        }
                        if (second_part >= 0 && c >= 0) {
                            var eq = first_part + ' + ' + second_part + ' + ' + c;
                        }
                        var yaxis = eval(eq);
                        yaxis = parseFloat(yaxis);
                        firstx = parseFloat(firstx);
                        if ((firstx).toFixed({{$detail['round1']}}) == {{$detail['firstx']}} && (yaxis).toFixed({{$detail['round2']}}) == {{$detail['yaxis']}}) {
                            adata.push([firstx, yaxis, 'point { size: 5; fill-color: #a52714; }']);
                        } else if ((firstx) == 0 && (yaxis).toFixed({{$detail['round3']}}) == {{$detail['C']}}) {
                            adata.push([0, {{$detail['C']}}, 'point { size: 5; fill-color: #33a1e3; }']);
                        } else {
                            adata.push([firstx, yaxis, null]);
                        }
                        // data.addRow([firstx, yaxis]);
                        firstx = parseFloat(firstx) - 1;
                    }
                    var data = google.visualization.arrayToDataTable(adata);
                    var options = {
                        legend: 'none',
                        colors: ['#13699E'],
                        lineWidth: 1,
                        pointSize: 5,
                        hAxis: {
                            title: 'x-axis'
                        },
                        vAxis: {
                            title: 'y-axis'
                        },
                    };
                    var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                }
                // function drawChart() {
                //     var a = '{{$detail['A']}}';
                //     var b = '{{$detail['B']}}';
                //     var c = '{{$detail['C']}}';
                //     var firstx = '{{($detail['B'] * (-1)) / ($detail['A'] * 2)}}';
                //     firstx = parseFloat(firstx) + parseFloat(25);
                //     var adata = [
                //         ['X', 'Y', {
                //             'type': 'string',
                //             'role': 'style'
                //         }]
                //     ];
                //     for (var i = 0; i <= 50; i++) {
                //         var first_part = Math.pow(firstx, 2) * a;
                //         var second_part = b * firstx;
                //         if (second_part < 0 && c < 0) {
                //             var eq = first_part + ' ' + second_part + ' ' + c;
                //         }
                //         if (second_part < 0 && c >= 0) {
                //             var eq = first_part + ' ' + second_part + ' + ' + c;
                //         }
                //         if (second_part >= 0 && c < 0) {
                //             var eq = first_part + ' + ' + second_part + ' ' + c;
                //         }
                //         if (second_part >= 0 && c >= 0) {
                //             var eq = first_part + ' + ' + second_part + ' + ' + c;
                //         }
                //         var yaxis = eval(eq);
                //         yaxis = parseFloat(yaxis);
                //         firstx = parseFloat(firstx);
                //         if ((firstx).toFixed({{$detail['round1']}}) == {{$detail['firstx']}} && (yaxis).toFixed({{$detail['round2']}}) == {{$detail['yaxis']}}) {
                //             adata.push([firstx, yaxis, 'point { size: 5; fill-color: #a52714; }']);
                //         } else if ((firstx) == 0 && (yaxis).toFixed({{$detail['round3']}}) == {{$detail['C']}}) {
                //             adata.push([0, {{$detail['C']}}, 'point { size: 5; fill-color: #33a1e3; }']);
                //         } else {
                //             adata.push([firstx, yaxis, null]);
                //         }
                //         firstx = parseFloat(firstx) - 1;
                //     }
                //     var data = google.visualization.arrayToDataTable(adata);
                //     var options = {
                //         legend: 'none',
                //         colors: ['#13699E'],
                //         lineWidth: 1,
                //         pointSize: 5,
                //         hAxis: {
                //             title: 'x-axis',
                //             viewWindow: {
                //                 min: -10,  // Set the minimum value for the Y-axis
                //                 max: 10    // Set the maximum value for the Y-axis
                //             }
                //         },
                //         vAxis: {
                //             title: 'y-axis',
                //             viewWindow: {
                //                 min: -30,  // Set the minimum value for the Y-axis
                //                 max: 30    // Set the maximum value for the Y-axis
                //             }
                //         },
                //     };
                //     var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
                //     chart.draw(data, options);
                // }
            </script>
        @endisset
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
            <script defer src="{{ url('katex/katex.min.js') }}"></script>
            <script defer src="{{ url('katex/auto-render.min.js') }}" 
            onload="renderMathInElement(document.body);"></script>
        <script>
            document.querySelectorAll('.veloTabs').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.veloTabs').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    
                    // var type = document.getElementById('type').value = val;
                    if (val === 'vertex') {
                        ['#advancedInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });

                        ['#simpleInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        document.getElementById('type').value = 'vertex';
                      
                    } else {
                        ['#simpleInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });

                        ['#advancedInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        document.getElementById('type').value = 'standard';
                       
                    }
                });
            });
            @if(isset($detail))
                var type =  document.getElementById('type').value;
                if (type == 'vertex') {
                    ['#advancedInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });

                    ['#simpleInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                        document.getElementById('standard').classList.remove('tagsUnit');
                        document.getElementById('vertex').classList.add('tagsUnit');
                        document.getElementById('type').value = 'vertex';
                    
                } else {
                    ['#simpleInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });

                    ['#advancedInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    document.getElementById('type').value = 'standard';
                    document.getElementById('standard').classList.add('tagsUnit');
                    document.getElementById('vertex').classList.remove('tagsUnit');
                    
                }
            @endif

            var submitButton = document.querySelector('button[name="submit"]');
            if (submitButton) {
                submitButton.addEventListener('click', function(event) {
                    var type = document.getElementById('type').value;
                    if(type == 'vertex'){
                        var a = document.getElementById('a').value;
                        if (a == 0 || a === '') {
                            alert('Enter a, In vertex equation a is not equal 0');
                            event.preventDefault();
                        }
                    }else if(type == 'standard'){
                        var a1 = document.getElementById('a1').value;
                        if (a1 == 0 || a1 === '') {
                            alert('Enter a, In quadratic equation a is not equal 0');
                            event.preventDefault();
                        }
                    } 
                });
            }
        </script>
    @endpush
</form>