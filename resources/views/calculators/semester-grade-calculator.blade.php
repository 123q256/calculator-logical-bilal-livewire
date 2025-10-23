@php
 if (isset($_POST['submit'])) {
    $f_grade = $_POST['f_grade'];
    $f_weight = $_POST['f_weight'];
    $s_grade = $_POST['s_grade'];
    $s_weight = $_POST['s_weight'];
    $l_grade = $_POST['l_grade'];
    $l_weight = $_POST['l_weight'];
} elseif (isset($_GET['res_link'])) {

    $f_grade = $_GET['f_grade'];
    $f_weight = $_GET['f_weight'];
    $s_grade = $_GET['s_grade'];
    $s_weight = $_GET['s_weight'];
    $l_grade = $_GET['l_grade'];
    $l_weight = $_GET['l_weight'];
}   
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[75%] md:w-[75%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <p class=" col-span-12"><strong class="text-blue">{{$lang['1']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="f_grade" class="label">{{ $lang['2'] }}</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="f_grade" id="f_grade" class="input" aria-label="input"  value="{{ isset($_POST['f_grade'])?$_POST['f_grade']: '100'}}" />
                    <span class="input_unit text-blue">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="f_weight" class="label">{{ $lang['3'] }}</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="f_weight" id="f_weight" class="input" aria-label="input"  value="{{ isset($_POST['f_weight'])?$_POST['f_weight']: '43'}}" />
                    <span class="input_unit text-blue">%</span>
                </div>
            </div>
            <p class=" col-span-12"><strong class="text-blue">{{$lang['4']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="s_grade" class="label">{{ $lang['2'] }}</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="s_grade" id="s_grade" class="input" aria-label="input"  value="{{ isset($_POST['s_grade'])?$_POST['s_grade']:'25' }}" />
                    <span class="input_unit text-blue">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="s_weight" class="label">{{ $lang['3'] }}</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="s_weight" id="s_weight" class="input" aria-label="input"  value="{{ isset($_POST['s_weight'])?$_POST['s_weight']:'41' }}" />
                    <span class="input_unit text-blue">%</span>
                </div>
            </div>
            <p class=" col-span-12"><strong class="text-blue">{{$lang['5']}}</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="l_grade" class="label">{{ $lang['2'] }}</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="l_grade" id="l_grade" class="input" aria-label="input"  value="{{ isset($_POST['l_grade'])?$_POST['l_grade']:'10' }}" />
                    <span class="input_unit text-blue">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="l_weight" class="label">{{ $lang['3'] }}</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="l_weight" id="l_weight" class="input" aria-label="input"  value="{{ isset($_POST['l_weight'])?$_POST['l_weight']:'-10' }}" />
                    <span class="input_unit text-blue">%</span>
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
                        <div class="w-full my-2">
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['6']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                    <strong class="text-blue">{{$detail['semesterGrade']}} %</strong></p>
                            </div>
                        </div>
                            <div class="bg-white radius-10 border py-4">
                                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        @push('calculatorJS')
            <script>
                window.onload = function() {
                    var chart = new CanvasJS.Chart("chartContainer", {
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Weights of semester grade elements [%]"
                        },
                        data: [{
                            type: "pie",
                            startAngle: 25,
                            toolTipContent: "<b>{label}</b>: {y}%",
                            showInLegend: "true",
                            legendText: "{label}",
                            indexLabelFontSize: 16,
                            indexLabel: "{label} - {y} %",
                            dataPoints: [{
                                    y: {{ $f_weight }},
                                    label: "First Quarter"
                                },
                                {
                                    y: {{ $s_weight }},
                                    label: "Second Quarter"
                                },
                                {
                                    y: {{ $l_weight }},
                                    label: "Final Exam"
                                },
                            ]
                        }]
                    });
                    chart.render();
                }
            </script>
        @endpush
    @endisset
</form>