<style>
    .flotr-legend{
        z-index: 1 !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="w-full  mb-lg-3 mb-2 mt-0 mt-lg-2 d-flex items-center">
               <p class="font-s-14 pe-lg-5">To Calculate:</p>
               <div class="flex align-items-center mt-lg-0 mt-1 align-items-center cursor-pointer">
                   <input name="form" id="form1" class="s_data cursor-pointer" value="summary" type="radio" checked/>
                   <label for="form1" class="font-s-14 text-blue pe-3 px-1 cursor-pointer">{{ $lang['s_data'] }}</label>
                   <input name="form" id="form" class="r_data ms-lg-0 ms-4 cursor-pointer" value="raw" type="radio" {{ isset($_POST['form']) && $_POST['form'] === 'raw' ? 'checked' : '' }}  />
                   <label for="form" class="font-s-14 text-blue ps-1 cursor-pointer">{{ $lang['r_data'] }}</label>
               </div>
           </div>
            <div class="grid grid-cols-1   mt-3  gap-4">
            <div class="w-full summary {{ isset($_POST['form']) && $_POST['form'] == 'raw' ? 'hidden' : '' }}">
                <div class="grid grid-cols-2   mt-3  gap-4">
                    <div class="space-y-2">
                        <label for="mean" class="font-s-14 text-blue mean">{{ $lang['x'] }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="mean" id="mean" value="{{ isset($_POST['mean'])?$_POST['mean']:'105' }}" class="input" aria-label="input" placeholder="e.g. 20.75" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="deviation" class="font-s-14 text-blue deviation">{{ $lang['y'] }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="deviation" id="deviation" value="{{ isset($_POST['deviation'])?$_POST['deviation']:'25' }}" class="input" aria-label="input" placeholder="e.g. 20.75" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full raw {{ isset($_POST['form']) && $_POST['form'] !== 'summary' ? '' : 'hidden' }}">
                <div class="grid grid-cols-1   mt-3  gap-4">
                    <div class="space-y-2">
                        <label for="type_r" class="font-s-14 text-blue">{{ $lang['d_type'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <select name="type_r" id="type_r" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['Sample'],$lang['Population']];
                                    $val = [1,2];
                                    optionsList($val,$name,isset($_POST['type_r'])?$_POST['type_r']:'2');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2 raw_mean">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['enter'] }} ({{ $lang['note_des'] }})</label>
                        <div class="w-100 py-2">
                            <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'12,43,11,2,33,76,12' }}</textarea>
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
                    <div class="w-full">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-100">
                                <tr>
                                    <td class="py-2 border-b">68% <?=$lang['ans']?></td>
                                    <td class="py-2 border-b"><b class="color_blue"><?=$detail['first']?></b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">95% <?=$lang['ans']?></td>
                                    <td class="py-2 border-b"><b class="color_blue"><?=$detail['second']?></b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">99.7% <?=$lang['ans']?></td>
                                    <td class="py-2 border-b"><b class="color_blue"><?=$detail['third']?></b></td>
                                </tr>
                                @if(request()->form == 'raw')
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['b']?></td>
                                    <td class="py-2 border-b"><b class="color_blue"><?=$detail['mean']?></b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['c']?></td>
                                    <td class="py-2 border-b"><b class="color_blue"><?=$detail['devi']?></b></td>
                                </tr>
                                @endif
                                @if (isset($detail['count']))
                                    <tr>
                                        <td class="py-2 border-b">Total Numbers:</td>
                                        <td class="py-2 border-b"><b class="color_blue"><?=$detail['count']?></b></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <p class="w-full mt-1 font-s-18 text-blue"><strong>To further divide up the percentages of the bell curve:</strong></p>
                        <ul class="w-full ps-3">
                            <li class="mt-1 ms-1">2.35% of data will be between <?=round($detail['mean'] - ($detail['devi']*3),2)?> & <?=round($detail['mean'] - ($detail['devi']*2),2)?></li>
                            <li class="mt-1 ms-1">13.5% of data will be between <?=round($detail['mean'] - ($detail['devi']*2),2)?> & <?=round($detail['mean'] - $detail['devi'],2)?></li>
                            <li class="mt-1 ms-1">34% of data will be between <?=round($detail['mean'] - $detail['devi'],2)?> & <?=round($detail['mean'],2)?></li>
                            <li class="mt-1 ms-1">34% of data will be between <?=round($detail['mean'],2)?> & <?=round($detail['mean'] + $detail['devi'],2)?></li>
                            <li class="mt-1 ms-1">13.5% of data will be between <?=round($detail['mean']+$detail['devi'],2)?> & <?=round($detail['mean'] + ($detail['devi']*2),2)?></li>
                            <li class="mt-1 ms-1">2.35% of data will be between <?=round($detail['mean']+($detail['devi']*2),2)?> & <?=round($detail['mean'] + ($detail['devi']*3),2)?></li>
                        </ul>
                        <div class="w-full mt-3 overflow-auto">
                            <div id="drawGraph" style="margin-top:2em;height:400px;width:100%;position:relative;"></div>
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
  var type_r = document.getElementById('type_r').value;
        updateTypeRDisplay(type_r);

        document.getElementById('type_r').addEventListener('change', function() {
            var type_r = this.value;
            updateTypeRDisplay(type_r);
        });

        function updateTypeRDisplay(type_r) {
            var meanText, deviationText;
            if (type_r == 1) {
                meanText = '<?=$lang['x']?> (x̅)';
                deviationText = '<?=$lang['y']?> (s)';
            } else {
                meanText = '<?=$lang['x']?> (μ)';
                deviationText = '<?=$lang['y']?> (σ)';
            }
            document.querySelectorAll('.mean').forEach(function(element) {
                element.textContent = meanText;
            });
            document.querySelectorAll('.deviation').forEach(function(element) {
                element.textContent = deviationText;
            });
        }

        document.querySelector('.s_data').addEventListener('click', function() {
            document.getElementById('after_title_line').innerHTML = "{{$lang['after_title']}}";
            document.querySelectorAll('.summary').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('.raw').forEach(function(element) {
                element.style.display = 'none';
            });
        });

        document.querySelector('.r_data').addEventListener('click', function() {
            document.getElementById('after_title_line').innerHTML = "{{$lang['after_title1']}}";
            document.querySelectorAll('.summary').forEach(function(element) {
                element.style.display = 'none';
            });
            document.querySelectorAll('.raw').forEach(function(element) {
                element.style.display = 'block';
            });
        });


</script>
    @if (isset($detail))
        <script type="text/javascript" src="<?=url('assets/js/graph.js')?>"></script>
        <script>
            function fnor(t, s, d) {
			    var l = t - s;
			    return Math.exp(-(l * l) / (2 * d * d)) / (Math.sqrt(2 * Math.PI) * d);
			}
			function f_nrm(t) {
			    if (0 === t) return 0.5;
			    var s,
			        d,
			        l,
			        n,
			        e,
			        r,
			        u = !1;
			    return (
			        0 > t && ((t = -t), (u = !0)),
			        (s = 1 / (1 + 0.2316419 * t)),
			        (d = s * s),
			        (l = d * s),
			        (n = l * s),
			        (e = n * s),
			        (r = fnor(t, 0, 1) * (0.31938153 * s + -0.356563782 * d + 1.781477937 * l + -1.821255978 * n + 1.330274429 * e)),
			        1 == u && (r = 1 - r),
			        r
			    );
			}
			function calRes() {
			    (temp.data = []), (dl1 = []), (dl2 = []), (dl3 = []), (dl4 = []), (dl5 = []), (dl6 = []), (dl7 = []), (dl8 = []), (m1 = parseFloat(<?=$detail['mean']?>)), (sd1 = parseFloat(<?=$detail['devi']?>));
			    var t = m1,
			        s = 3.2 * sd1;
			    (stmin = t - sd1),
			        (stplus = t + sd1),
			        (st2min = t - 2 * sd1),
			        (st2plus = t + 2 * sd1),
			        (st3min = t - 3 * sd1),
			        (st3plus = t + 3 * sd1);
			    var d = 0.08;
			    d = 5 > sd1 ? 0.008 : 0.08;
			    for (var l = -1 * s + m1; 1 * s + d + m1 > l; l += d)
			        dl1.push([l, fnor(l, m1, sd1)]),
			            Math.round(10 * l) / 10 >= stmin && Math.round(10 * l) / 10 <= stplus && (dl2.push([l, fnor(l, m1, sd1)]), dl2.push([l, 0])),
			            Math.round(10 * l) / 10 >= st2min && Math.round(10 * l) / 10 <= stmin && (dl3.push([l, fnor(l, m1, sd1)]), dl3.push([l, 0])),
			            Math.round(10 * l) / 10 >= stplus && Math.round(10 * l) / 10 <= st2plus && (dl4.push([l, fnor(l, m1, sd1)]), dl4.push([l, 0])),
			            Math.round(10 * l) / 10 > st3min && Math.round(10 * l) / 10 <= st2min && (dl5.push([l, fnor(l, m1, sd1)]), dl5.push([l, 0])),
			            Math.round(10 * l) / 10 >= st2plus && Math.round(10 * l) / 10 < st3plus && (dl6.push([l, fnor(l, m1, sd1)]), dl6.push([l, 0])),
			            Math.round(10 * l) / 10 <= st3min && Math.round(10 * l) / 10 >= st3plus && (dl7.push([l, fnor(l, m1, sd1)]), dl7.push([l, 0])),
			            Math.round(10 * l) / 10 == t && (dl8.push([l, fnor(l, m1, sd1)]), dl8.push([l, 0]));
			    temp.plot(document.getElementById("drawGraph"));
			}
			var  fnrnd = function (t, s) {
			        if (!parseInt(s)) var s = 0;
			        return 0 != s ? Math.round(Math.pow(10, s) * t) / Math.pow(10, s) : s;
			    };
			document.getElementById("drawGraph").style.height = "400px";
			var dl1 = [],
			    dl2 = [],
			    dl3 = [],
			    dl4 = [],
			    dl5 = [],
			    dl6 = [],
			    dl7 = [],
			    dl8 = [],
			    stmin,
			    stplus,
			    m1,
			    sd1,
			    st2min,
			    st2plus,
			    st3min,
			    st3plus;
			document.getElementById("drawGraph").style.height = "400px";
			var temp = {};
			(temp.data = []), (temp.lobf = null), (temp.b = 0), (temp.a = 0), (temp.n = 0);
			temp.plot = function (l) {
			    temp.lobf = Flotr.draw(
			        l,
			        [
			            { data: dl1, label: "99.7% &asymp; μ &plusmn; 3σ = " + m1 + " &plusmn; 3(" + sd1 + ") = " + st3min + " to " + st3plus, lines: { color: "#000000", show: !0, fill: !0 } },
			            { data: dl3, label: "95% &asymp; μ &plusmn; 2σ = " + m1 + " &plusmn; 2(" + sd1 + ") = " + st2min + " to " + st2plus, lines: { color: "#3e2723", show: !0 } },
			            { data: dl2, label: "68% &asymp; μ &plusmn; σ = " + m1 + " &plusmn; " + sd1 + " = " + stmin + " to " + stplus, lines: { color: "#0082B1", show: !0 } },
			            { data: dl4, lines: { color: "#3e2723", show: !0 } },
			            { data: dl5, lines: { color: "#b71c1c", show: !0 } },
			            { data: dl6, lines: { color: "#b71c1c", show: !0 } },
			            { data: dl7, label: "Mean (μ) = " + m1, lines: { color: "#cccccc", show: !0 } },
			            { data: dl8, lines: { color: "#cccccc", show: !0 } },
			        ],
			        {
			            xaxis: { title: "x" },
			            yaxis: { title: "<span style='font-size:14px;margin-left: -15px;'>f(x)</span>", autoscale: !0, autoscaleMargin: 3 },
			            colors: ["#b71c1c", "#3e2723", "#0082B1", "#cccccc", "#000000", "#cccccc", "#cccccc"],
			            HtmlText: !0,
			            fontSize: 7.5,
			            subtitle: " ",
			            grid: { hoverable: !0, autoHighlight: !1 },
			            mouse: {
			                track: !0,
			                relative: !0,
			                position: "n",
			                trackFormatter: function (l) {
			                    return "(" + l.x + ", " + l.y + ")";
			                },
			                lineColor: "#1991d0",
			                fillOpacity: 0,
			                sensibility: 15,
			            },
			            legend: { position: "nw", backgroundColor: "#D2E8FF" },
			        }
			    );
			};
            calRes();
    @endif

        </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>