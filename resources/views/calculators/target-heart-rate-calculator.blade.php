<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="method" class="label">{!! $lang['method'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="method" id="method" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['basic'],$lang['m_2'],$lang['m_3'],'Karvonen by Age & HRR'];
                                $val = ["1","2",'3','4'];
                                optionsList($val,$name,isset(request()->method)?request()->method:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6  mhr_formula"> 
                    <label for="formula" class="label">MHR {!! $lang['for'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="formula" id="formula" class="input">
                            @php
                                $name = ["Haskell & Fox (basic, for men)","Haskell & Fox (basic, for women)","Robergs & Landwehr","Londeree and Moeschberger","Miller et al.","Tanaka, Monahan, & Seals","Jackson et al.","Nes, et al.","Gellish (for men)","Gellish (for women)","Martha Gulati et al. (for women)"];
                                $val = ["1","2",'3','4','5','6','7','8','9','10','11'];
                                optionsList($val,$name,isset(request()->formula)?request()->formula:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 age">
                    <label for="age" class="label">{!! $lang['your'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'' }}" />
                        <span class="text-blue input_unit">{{ $lang['year'] }}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 rhr hidden">
                    <label for="rhr" class="label">RHR <span class="bg-white text-blue radius-circle px-2 ms-1" title="{!! $lang['rhr'] !!}">?</span>:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="rhr" id="rhr" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->rhr)?request()->rhr:'' }}" />
                        <span class="text-blue input_unit">bpm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hrr hidden">
                    <label for="hrr" class="label">HRR <span class="bg-white text-blue radius-circle px-2 ms-1" title="{!! $lang['hrr'] !!}">?</span>:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="hrr" id="hrr" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->hrr)?request()->hrr:'' }}" />
                        <span class="text-blue input_unit">bpm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 mhr hidden">
                    <label for="mhr" class="label">MHR <span class="bg-white text-blue radius-circle px-2 ms-1" title="{!! $lang['mhr'] !!}">?</span>:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="mhr" id="mhr" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mhr)?request()->mhr:'' }}" />
                        <span class="text-blue input_unit">bpm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 mhr hidden">
                    <label for="rhrm" class="label">RHR <span class="bg-white text-blue radius-circle px-2 ms-1" title="{!! $lang['rhr'] !!}">?</span>:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="rhrm" id="rhrm" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->rhrm)?request()->rhrm:'' }}" />
                        <span class="text-blue input_unit">bpm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="percent" class="label">{!! $lang['desire'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="percent" id="percent" class="input" min="1" max="100" aria-label="input" placeholder="00" value="{{ isset(request()->percent)?request()->percent:'' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="ideal" class="label">{!! $lang['train'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="ideal" id="ideal" class="input">
                            @php
                                $name = [$lang['bf'],$lang['sf'],$lang['tmax']];
                                $val = ["0.65","0.75",'0.85'];
                                optionsList($val,$name,isset(request()->ideal)?request()->ideal:'0.65');
                            @endphp
                        </select>
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
                        @if(request()->method=='2' || request()->method=='3')
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899">
                                <strong>{{ $lang['hrr'] }} (HRR) =</strong>
                                <strong class="text-green-700 text-[28px]">{{ $detail['mhr']-$detail['rhr'] }}</strong>
                                <strong>bpm</strong>
                            </div>
                        @elseif(request()->method=='4')
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899">
                                <strong>{{ $lang['rhr'] }} (RHR) =</strong>
                                <strong class="text-green-700 text-[28px]">{{ $detail['rhr'] }}</strong>
                                <strong>bpm</strong>
                            </div>
                        @endif
                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-2" style="border: 1px solid #c1b8b899">
                            <strong>{{ $lang['tar_des'] }} =</strong>
                            <strong class="text-green-700 text-[28px]">
                                @if(request()->method=='1')
                                    {{ round($detail['mhr'] * (request()->percent / 100)) }}
                                @elseif (request()->method=='2' || request()->method=='3' || request()->method=='4')
                                    {{ round((($detail['mhr'] - $detail['rhr']) * (request()->percent / 100)) + $detail['rhr']) }}
                                @endif
                            </strong>
                            <strong>bpm</strong>
                        </div>
                        <div class="bg-sky border rounded-lg px-3 py-2 mt-2">
                            <strong>{{ $lang['ihr'] }} =</strong>
                            <strong class="text-green-700 text-[28px]">
                                @if(request()->method=='1')
                                    {{ round($detail['mhr'] * request()->ideal) }}
                                @elseif (request()->method=='2' || request()->method=='3' || request()->method=='4')
                                    {{ round((($detail['mhr'] - $detail['rhr']) * request()->ideal) + $detail['rhr']) }}
                                @endif
                            </strong>
                            <strong>bpm</strong>
                        </div>
                        <div class="bg-sky border rounded-lg px-3 py-2 mt-2">
                            <strong>{{ $lang['mhr'] }} (MHR) =</strong>
                            <strong class="text-green-700 text-[28px]">{{ $detail['mhr'] }}</strong>
                            <strong>bpm</strong>
                        </div>
                        <div class="w-full overflow-auto mt-4">
                            <table class="w-full" cellspacing="0">
                                @if($_POST['method']!=1)
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="text-center border-b-4 border-indigo-500 radius-t-10 ps-4 px-3 py-2" colspan="3">{{ $lang['chat1'] }}</td>
                                    </tr>
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="radius-bl-10 ps-4 px-3 py-2">{{ $lang['target'] }}</td>
                                        <td class="px-3">% {{ $lang['in'] }}</td>
                                        <td class="radius-br-10 px-3">{{ $lang['thr'] }}</td>
                                    </tr>
                                @else
                                    <tr class="bg-[#2845F5] text-white">
                                        <td class="radius-l-10 ps-4 px-3 py-2">{{ $lang['target'] }}</td>
                                        <td class="px-3">% {{ $lang['in'] }}</td>
                                        <td class="radius-r-10 px-3">{{ $lang['thr'] }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['max'] }} <strong>VO<sub>2</sub> {{ $lang['max_z'] }}</strong></td>
                                    <td class="border-b px-3 py-2">90% - 100%</td>
                                    <td class="border-b px-3 py-2">
                                        <strong>
                                            @if($_POST['method']=='1')
                                                {{ round($detail['mhr'] * 0.9).' - '.round($detail['mhr'] * 1) }}
                                            @elseif($_POST['method']=='2' || $_POST['method']=='3' || $_POST['method']=='4')
                                                {{ round((($detail['mhr'] - $detail['rhr']) * 0.9) + $detail['rhr']).' - '.round((($detail['mhr'] - $detail['rhr']) * 1) + $detail['rhr']) }}
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['Hard'] }} <strong>{{ $lang['an_zone'] }}</strong></td>
                                    <td class="border-b px-3 py-2">80% - 90%</td>
                                    <td class="border-b px-3 py-2">
                                        <strong>
                                            @if ($_POST['method']=='1')
                                                {{ round($detail['mhr'] * 0.8).' - '.round($detail['mhr'] * 0.9) }}
                                            @elseif($_POST['method']=='2' || $_POST['method']=='3' || $_POST['method']=='4')
                                                {{ round((($detail['mhr'] - $detail['rhr']) * 0.8) + $detail['rhr']).' - '.round((($detail['mhr'] - $detail['rhr']) * 0.9) + $detail['rhr']) }}
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['mod'] }} <strong>{{ $lang['ar_zone'] }}</strong></td>
                                    <td class="border-b px-3 py-2">70% - 80%</td>
                                    <td class="border-b px-3 py-2">
                                        <strong>
                                            @if($_POST['method']=='1')
                                                {{ round($detail['mhr'] * 0.7).' - '.round($detail['mhr'] * 0.8) }}
                                            @elseif($_POST['method']=='2' || $_POST['method']=='3' || $_POST['method']=='4')
                                                {{ round((($detail['mhr'] - $detail['rhr']) * 0.7) + $detail['rhr']).' - '.round((($detail['mhr'] - $detail['rhr']) * 0.8) + $detail['rhr']) }}
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['Light'] }} <strong>{{ $lang['fat_zone'] }}</strong></td>
                                    <td class="border-b px-3 py-2">60% - 70%</td>
                                    <td class="border-b px-3 py-2">
                                        <strong>
                                            @if($_POST['method']=='1')
                                                {{ round($detail['mhr'] * 0.6).' - '.round($detail['mhr'] * 0.7) }}
                                            @elseif($_POST['method']=='2' || $_POST['method']=='3' || $_POST['method']=='4')
                                                {{ round((($detail['mhr'] - $detail['rhr']) * 0.6) + $detail['rhr']).' - '.round((($detail['mhr'] - $detail['rhr']) * 0.7) + $detail['rhr']) }}
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-2">{{ $lang['v_light'] }} <strong>{{ $lang['w_zone'] }}</strong></td>
                                    <td class="px-3 py-2">50% - 60%</td>
                                    <td class="px-3 py-2">
                                        <strong>
                                            @if($_POST['method']=='1')
                                                {{ round($detail['mhr'] * 0.5).' - '.round($detail['mhr'] * 0.6) }}
                                            @elseif($_POST['method']=='2' || $_POST['method']=='3' || $_POST['method']=='4')
                                                {{ round((($detail['mhr'] - $detail['rhr']) * 0.5) + $detail['rhr']).' - '.round((($detail['mhr'] - $detail['rhr']) * 0.6) + $detail['rhr']) }}
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full overflow-auto mt-4">
                            <table class="w-full" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="text-center border-b-2 border-white radius-t-10 ps-4 px-3 py-2" colspan="3">{{ $lang['chart2'] }}</td>
                                </tr>
                                <tr class="bg-[#2845F5] text-white">
                                    <td class="radius-bl-10 ps-4 px-3 py-2">{{ $lang['target'] }}</td>
                                    <td class="px-3">% {{ $lang['in'] }}</td>
                                    <td class="radius-br-10 px-3">{{ $lang['thr'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['max'] }} <strong>VO<sub>2</sub> {{ $lang['max_z'] }}</strong></td>
                                    <td class="border-b px-3 py-2">{{ round(($detail['mhr']-15)/$detail['mhr']*100) }}% - {{ round(($detail['mhr'])/$detail['mhr']*100) }}%</td>
                                    <td class="border-b px-3 py-2"><strong>{{ $detail['mhr']-15 }} - {{ $detail['mhr'] }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['Hard'] }} <strong>{{ $lang['an_zone'] }}</strong></td>
                                    <td class="border-b px-3 py-2">{{ round(($detail['mhr']-25)/$detail['mhr']*100) }}% - {{ round(($detail['mhr']-15)/$detail['mhr']*100) }}%</td>
                                    <td class="border-b px-3 py-2"><strong>{{ $detail['mhr']-25 }} - {{ $detail['mhr']-15 }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['mod'] }} <strong>{{ $lang['ar_zone'] }}</strong></td>
                                    <td class="border-b px-3 py-2">{{ round(($detail['mhr']-35)/$detail['mhr']*100) }}% - {{ round(($detail['mhr']-25)/$detail['mhr']*100) }}%</td>
                                    <td class="border-b px-3 py-2"><strong>{{ $detail['mhr']-35 }} - {{ $detail['mhr']-25 }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-2">{{ $lang['Light'] }} <strong>{{ $lang['fat_zone'] }}</strong></td>
                                    <td class="border-b px-3 py-2">{{ round(($detail['mhr']-45)/$detail['mhr']*100) }}% - {{ round(($detail['mhr']-35)/$detail['mhr']*100) }}%</td>
                                    <td class="border-b px-3 py-2"><strong>{{ $detail['mhr']-45 }} - {{ $detail['mhr']-35 }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-3 py-2">{{ $lang['v_light'] }} <strong>{{ $lang['w_zone'] }}</strong></td>
                                    <td class="px-3 py-2">{{ round(($detail['mhr']-55)/$detail['mhr']*100) }}% - {{ round(($detail['mhr']-45)/$detail['mhr']*100) }}%</td>
                                    <td class="px-3 py-2"><strong>{{ $detail['mhr']-55 }} - {{ $detail['mhr']-45 }}</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            var method = document.getElementById('method').value;
            updateDisplay(method);

            document.getElementById('method').addEventListener('change', function() {
                var method = this.value;
                updateDisplay(method);
            });

            function updateDisplay(method) {
                if (method === '1') {
                    document.querySelectorAll('.age, .mhr_formula').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.rhr, .mhr, .hrr').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method === '2') {
                    document.querySelectorAll('.age, .rhr, .mhr_formula').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.mhr, .hrr').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method === '3') {
                    document.querySelectorAll('.mhr').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.age, .rhr, .mhr_formula, .hrr').forEach(function(el) {
                        el.style.display = 'none';
                    });
                } else if (method === '4') {
                    document.querySelectorAll('.age, .hrr, .mhr_formula').forEach(function(el) {
                        el.style.display = 'block';
                    });
                    document.querySelectorAll('.rhr, .mhr').forEach(function(el) {
                        el.style.display = 'none';
                    });
                }
            }
        </script>
    @endpush
</form>