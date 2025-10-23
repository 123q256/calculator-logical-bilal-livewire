<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="spend" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="spend" id="spend" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['spend'])?$_POST['spend']:'5000000' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="guest" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="guest" id="guest" class="input" aria-label="input" placeholder="500" value="{{ isset($_POST['guest'])?$_POST['guest']:'500' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 ">{{ $lang['3'] }}</div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="dress" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="dress" id="dress" class="input" aria-label="input" placeholder="90000" value="{{ isset($_POST['dress'])?$_POST['dress']:'90000' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="jewelery" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="jewelery" id="jewelery" class="input" aria-label="input" placeholder="350000" value="{{ isset($_POST['jewelery'])?$_POST['jewelery']:'350000' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="accessories" class="label">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="accessories" id="accessories" class="input" aria-label="input" placeholder="100000" value="{{ isset($_POST['accessories'])?$_POST['accessories']:'100000' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ring" class="label">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="ring" id="ring" class="input" aria-label="input" placeholder="75000" value="{{ isset($_POST['ring'])?$_POST['ring']:'75000' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="makeup" class="label">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="makeup" id="makeup" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['makeup'])?$_POST['makeup']:'275000' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12">
                        <details class="px-2 my-1 click1" id="click1" >
                            <summary class="col py-3 px-3 border cursor-pointer" style="border: 1px solid #afa3a3;"><strong class="mx-3">{{ $lang['9'] }}</strong></summary>
                            <input type="hidden" name="clickvalue1" class="clickvalue1" value="{{ isset($_POST['clickvalue1'])?$_POST['clickvalue1']:'0' }}" id="clickvalue1">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-6">
                                    <label for="stationery" class="label">{{ $lang['10'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="stationery" id="stationery" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['stationery'])?$_POST['stationery']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="photography" class="label">{{ $lang['11'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="photography" id="photography" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['photography'])?$_POST['photography']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="florist" class="label">{{ $lang['12'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="florist" id="florist" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['florist'])?$_POST['florist']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="planner" class="label">{{ $lang['13'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="planner" id="planner" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['planner'])?$_POST['planner']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                            </div>
                        </details>
                    </div>
                    <div class="col-span-12">
                        <details class="px-2 my-1 click2" id="click2" >
                            <summary class="col  py-3 px-3 border cursor-pointer" style="border: 1px solid #afa3a3;"><strong class="mx-3">{{ $lang['14']}}</strong></summary>
                            <input type="hidden" name="clickvalue2" class="clickvalue2" value="0" id="clickvalue2">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-6">
                                    <label for="venue" class="label">{{ $lang['15'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="venue" id="venue" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['venue'])?$_POST['venue']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="dinner" class="label">{{ $lang['16'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="dinner" id="dinner" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['dinner'])?$_POST['dinner']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="catering" class="label">{{ $lang['17'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="catering" id="catering" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['catering'])?$_POST['catering']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="cake" class="label">{{ $lang['18'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="cake" id="cake" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['cake'])?$_POST['cake']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="DJs" class="label">{{ $lang['19'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="DJs" id="DJs" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['DJs'])?$_POST['DJs']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="liquors" class="label">{{ $lang['20'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="liquors" id="liquors" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['liquors'])?$_POST['liquors']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                            </div>
                        </details>
                    </div>
                    <div class="col-span-12">
                        <details class="px-2 my-1 click3" id="click3" >
                            <summary class="col  py-3 px-3 border cursor-pointer"  style="border: 1px solid #afa3a3;"><strong style="padding-left: 20px;">{{ $lang['21'] }}</strong></summary>
                            <input type="hidden" name="clickvalue3" class="clickvalue3" value="{{ isset($_POST['clickvalue3'])?$_POST['clickvalue3']:'0' }}" id="clickvalue3">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-6">
                                    <label for="ceremony" class="label">{{ $lang['22'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="ceremony" id="ceremony" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['ceremony'])?$_POST['ceremony']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="officiant" class="label">{{ $lang['23'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="officiant" id="officiant" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['officiant'])?$_POST['officiant']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                            </div>
                        </details>
                    </div>
                    <div class="col-span-12">
                        <details class="px-2 my-1 click4" id="click4" >
                            <summary class="col  py-3 px-3 border cursor-pointer"  style="border: 1px solid #afa3a3;"><strong id="trans" class="mx-3">{{ $lang['24'] }}</strong></summary>
                            <input type="hidden" name="clickvalue4" class="clickvalue4" value="{{ isset($_POST['clickvalue4'])?$_POST['clickvalue4']:'0' }}" id="clickvalue4">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-6">
                                    <label for="hotel" class="label">{{ $lang['25'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="hotel" id="hotel" class="input" aria-label="input" placeholder="o" value="{{ isset($_POST['hotel'])?$_POST['hotel']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="transportation" class="label">{{ $lang['26'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="transportation" id="transportation" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['transportation'])?$_POST['transportation']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                            </div>
                        </details>
                    </div>
                    <div class="col-span-12">
                        <details class="px-2 my-1 click5" id="click5" >
                            <summary class="col  py-3 px-3 border cursor-pointer"  style="border: 1px solid #afa3a3;"><strong class="mx-3">{{ $lang['27'] }}</strong></summary>
                            <input type="hidden" name="clickvalue5" class="clickvalue5" value="{{ isset($_POST['clickvalue5'])?$_POST['clickvalue5']:'0' }}" id="clickvalue5">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                                <div class="col-span-6">
                                    <label for="other" class="label">{{ $lang['28'] }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="other" id="other" class="input" aria-label="input" placeholder="275000" value="{{ isset($_POST['other'])?$_POST['other']:'0' }}" min="0" />
                                        <span class="text-blue input_unit">{{ $currancy}}</span>
                                    </div>
                                </div>
                            </div>
                        </details>
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['29'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['average_cost'],2)}}</td>
                            </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['30'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['budget_balance'],0)}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                            <p class="my-3">
                                @if($detail['budget_balance'] == '0')
                                <p style="color:green"> {{$lang['31']}}</p>
                                @elseif($detail['budget_balance'] > '0')
                                <p style="color:green"> {{$lang['32']}}</p>
                                @elseif($detail['budget_balance'] < '0')
                                <p style="color:red"> {{$lang['33']}}</p>
                                @endif
                            </p>
                            @php
                                $dataPoints = array();
                                if ($detail['bride_groom'] != 0) {
                                    $dataPoints[] = array("label" => $lang['3'], "y" => $detail['bride_groom']);
                                }
                                if ($detail['sub_contractors'] != 0) {
                                    $dataPoints[] = array("label" =>  $lang['9'], "y" => $detail['sub_contractors']);
                                }
                                if ($detail['food_drinks'] != 0) {
                                    $dataPoints[] = array("label" => $lang['14'], "y" => $detail['food_drinks']);
                                }
                                if ($detail['ceremony_total'] != 0) {
                                    $dataPoints[] = array("label" => $lang['21'], "y" => $detail['ceremony_total']);
                                }
                                if ($detail['trans_accomo'] != 0) {
                                    $dataPoints[] = array("label" => $lang['24'], "y" => $detail['trans_accomo']);
                                }
                                if ($detail['other'] != 0) {
                                    $dataPoints[] = array("label" => $lang['34'], "y" => $detail['other']);
                                }
                            @endphp
                            <div class="mt-3">
                                @if($detail['average_cost'] != '0' )
                                    <div id="chartContainer" style="height: 270px; width: 100%;"></div>
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



<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('click1').addEventListener('click', function() {
        if (this.getAttribute('open')) {
            document.querySelector('.clickvalue1').value = "";
        } else {
            document.querySelector('.clickvalue1').value = "1";
        }
    });

    document.getElementById('click2').addEventListener('click', function() {
        if (this.getAttribute('open')) {
            document.querySelector('.clickvalue2').value = "";
        } else {
            document.querySelector('.clickvalue2').value = "2";
        }
    });

    document.getElementById('click3').addEventListener('click', function() {
        if (this.getAttribute('open')) {
            document.querySelector('.clickvalue3').value = "";
        } else {
            document.querySelector('.clickvalue3').value = "3";
        }
    });

    document.getElementById('click4').addEventListener('click', function() {
        if (this.getAttribute('open')) {
            document.querySelector('.clickvalue4').value = "";
        } else {
            document.querySelector('.clickvalue4').value = "4";
        }
    });

    document.getElementById('click5').addEventListener('click', function() {
        if (this.getAttribute('open')) {
            document.querySelector('.clickvalue5').value = "";
        } else {
            document.querySelector('.clickvalue5').value = "5";
        }
    });
});
</script>
 @if(isset($detail))
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var clickvalue1 = "{{ $detail['clickvalue1'] }}";
    var clickvalue2 = "{{ $detail['clickvalue2'] }}";
    var clickvalue3 = "{{ $detail['clickvalue3'] }}";
    var clickvalue4 = "{{ $detail['clickvalue4'] }}";
    var clickvalue5 = "{{ $detail['clickvalue5'] }}";

    if (clickvalue1 == 1) {
        document.getElementById('click1').setAttribute('open', '');
    }
    if (clickvalue2 == 2) {
        document.getElementById('click2').setAttribute('open', '');
    }
    if (clickvalue3 == 3) {
        document.getElementById('click3').setAttribute('open', '');
    }
    if (clickvalue4 == 4) {
        document.getElementById('click4').setAttribute('open', '');
    }
    if (clickvalue5 == 5) {
        document.getElementById('click5').setAttribute('open', '');
    }
});
</script>

 @endif
 @if(isset($error))
<script>
   document.addEventListener('DOMContentLoaded', function() {
    var clickvalue1 = "{{$_POST['clickvalue1']}}";
    var clickvalue2 = "{{$_POST['clickvalue2']}}";
    var clickvalue3 = "{{$_POST['clickvalue3']}}";
    var clickvalue4 = "{{$_POST['clickvalue4']}}";
    var clickvalue5 = "{{$_POST['clickvalue5']}}";

    if (clickvalue1 == 1) {
        // Add the 'open' attribute to the element with id 'click1'
        document.getElementById('click1').setAttribute('open', '');
    }
    if (clickvalue2 == 2) {
        // Add the 'open' attribute to the element with id 'click2'
        document.getElementById('click2').setAttribute('open', '');
    }
    if (clickvalue3 == 3) {
        // Add the 'open' attribute to the element with id 'click3'
        document.getElementById('click3').setAttribute('open', '');
    }
    if (clickvalue4 == 4) {
        // Add the 'open' attribute to the element with id 'click4'
        document.getElementById('click4').setAttribute('open', '');
    }
    if (clickvalue5 == 5) {
        // Add the 'open' attribute to the element with id 'click5'
        document.getElementById('click5').setAttribute('open', '');
    }
});
</script>
 @endif
 @if(isset($detail))
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <script>
     window.onload = function() {
       var charts = new CanvasJS.Chart("chartContainer", {
         theme: "light2",
         animationEnabled: true,
         data: [{
           type: "pie",
           indexLabel: "{y}",
           yValueFormatString: "#,##0.00\" {{ $currancy}}\"",
           indexLabelPlacement: "outside",
           indexLabelFontColor: "#36454F",
           indexLabelFontSize: 18,
           showInLegend: true,
           legendText: "{label}",
           dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
       });
       var colors = ["#2d4d76", "#4575b4", "#74add1", "#abd9e9", "#e0f3f8","#ffffbf"];
         for (var i = 0; i < charts.options.data[0].dataPoints.length; i++) {
             charts.options.data[0].dataPoints[i].color = colors[i % colors.length];
         }
       charts.render();
     }
   </script>
   @endif
@endpush
