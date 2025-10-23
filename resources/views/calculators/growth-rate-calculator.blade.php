<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 ">
                <label for="operation" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 ">
                    <select name="operation" id="operation" class="input">
                        <option  value="1" {{ isset($_POST['operation']) && $_POST['operation']=='1'?'selected':''}}>{{ $lang['2']}}</option>
                        <option value="2" {{ isset($_POST['operation']) && $_POST['operation']=='2'?'selected':''}}>{{ $lang['3'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 my-3">
                @if(isset($detail['operation']))
                    @if($detail['operation'] == "2")
                    <p class="" id="f_2"><b>{{$lang[1]}} 
                        <sub>annual</sub>  =
                        (<span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                            <span class="num">V <sub> present  </sub>  -  V <sub> past</sub> </span>
                            <span class="visually-hidden"> / </span>
                            <span class="den">Vpast</span>
                        </span>)
                        <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                            <span class="num">1</span>
                            <span class="visually-hidden"> / </span>
                            <span class="den">t</span>
                        </span>
                        -1</b>
                    </p>
                    <p id="f_1" class="hidden">
                        <b> {{$lang[1]}} =
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">Vpresent - Vpast </span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">Vpast</span>
                            </span>
                        </b>
                    </p>
                    @elseif($detail['operation'] == "1")
                    <p class="hidden" id="f_2"><b>{{$lang[1]}} 
                        <sub>annual</sub>  =
                        (<span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                            <span class="num">V <sub> present  </sub>  -  V <sub> past</sub> </span>
                            <span class="visually-hidden"> / </span>
                            <span class="den">Vpast</span>
                        </span>)
                        <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                            <span class="num">1</span>
                            <span class="visually-hidden"> / </span>
                            <span class="den">t</span>
                        </span>
                        -1</b>
                    </p>
                    <p id="f_1">
                        <b> {{$lang[1]}} =
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">Vpresent - Vpast </span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">Vpast</span>
                            </span>
                        </b>
                    </p>
                    @endif
                @else
                <p id="f_1">
                    <b> {{$lang[1]}} =
                         <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                             <span class="num">Vpresent - Vpast </span>
                             <span class="visually-hidden"> / </span>
                             <span class="den">Vpast</span>
                         </span>
                     </b>
                 </p>
                 <p class="hidden" id="f_2"><b>{{$lang[1]}} 
                     <sub>annual</sub>  =
                     (<span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                         <span class="num">V <sub> present  </sub>  -  V <sub> past</sub> </span>
                         <span class="visually-hidden"> / </span>
                         <span class="den">Vpast</span>
                     </span>)
 
                     <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                         <span class="num">1</span>
                         <span class="visually-hidden"> / </span>
                         <span class="den">t</span>
                     </span>
                       -1</b>
                 </p>
            @endif
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="present_val" class="label">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="present_val" id="present_val" class="input" aria-label="input" placeholder="2400" value="{{ isset($_POST['present_val'])?$_POST['present_val']:'2400' }}" />
                    <span class="text-blue input-unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="past_val" class="label">{{ $lang['5'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="past_val" id="past_val" class="input" aria-label="input" placeholder="1200" value="{{ isset($_POST['past_val'])?$_POST['past_val']:'1200' }}" />
                    <span class="text-blue input-unit">{{ $currancy }}</span>
                </div>
            </div>
            @if(isset($detail['operation']))
                @if($detail['operation'] == "2")
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="time_vals">
                        <label for="time_val" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="time_val" id="time_val" class="input" aria-label="input" placeholder="2400" value="{{ isset($_POST['time_val'])?$_POST['time_val']:'2400' }}" />
                            <span class="text-blue input-unit">{{ $currancy }}</span>
                        </div>
                    </div>
                @else
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="time_vals">
                        <label for="time_val" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="time_val" id="time_val" class="input" aria-label="input" placeholder="2400" value="{{ isset($_POST['time_val'])?$_POST['time_val']:'2400' }}" />
                            <span class="text-blue input-unit">{{ $currancy }}</span>
                        </div>
                    </div>
                @endif
            @else
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="time_vals">
                <label for="time_val" class="label">{{ $lang['6'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="time_val" id="time_val" class="input" aria-label="input" placeholder="2400" value="{{ isset($_POST['time_val'])?$_POST['time_val']:'2400' }}" />
                    <span class="text-blue input-unit">{{ $currancy }}</span>
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
 

    @isset($detail)
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @if($detail['operation'] == "1")
                     <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                <td class="py-2 border-b">{{round($detail['growth_percent'], 2)}} %</td>
                            </tr>
                        </table>
                      </div>
                        <div class="mt-2">
                            <p class="mt-2"><strong><?=$lang[8]?>:</strong></p>      
                            <p class="mt-2">\(\text{<?=$lang[2]?>} =\dfrac{<?=$detail['present_val']?>-<?=$detail['past_val']?>}{<?=$detail['past_val']?>}\)</p>
                            <p class="mt-2">\(\text{<?=$lang[2]?>} =\dfrac{<?=$detail['growth_diff']?>}{<?=$detail['past_val']?>}\)</p>
                            <p class="mt-2">\(\text{<?=$lang[2]?>} =<?=round($detail['growth_val'],4)?>\)</p>
                            <p class="mt-2">\(\%\text{<?=$lang[2]?>} =<?=round($detail['growth_val'],4)?>\times {100}\)</p>
                            <p class="mt-2">\(\%\text{<?=$lang[2]?>} =\)<strong><span class="text-accent-4 font_size22 orange-text"><?=round($detail['growth_percent'], 2)?>%</span></strong></p>
                        </div>  
                        @elseif($detail['operation'] == "2")
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['growth_percent'], 2)}} %</td>
                                </tr>
                            </table>
                          </div>
                        <div class="mt-2">
                            <p class="mt-2"><strong><?=$lang[8]?>:</strong></p>      
                            <p class="mt-2">\(\text{<?=$lang[3]?>} =(\dfrac{<?=$detail['present_val']?>}{<?=$detail['past_val']?>})^{\frac{1}{<?=$detail['time_val']?>}}-1\)</p>
                            <p class="mt-2">\(\text{<?=$lang[3]?>} =(<?=round($detail['growth_sub'],4)?>)^{\frac{1}{<?=$detail['time_val']?>}}-1\)</p>
                            <p class="mt-2">\(\text{<?=$lang[3]?>} =(<?=round($detail['g_val'],4)?>)-1\)</p>
                            <p class="mt-2">\(\text{<?=$lang[3]?>} =<?=round($detail['growth_val'],4)?>\)</p>
                            <p class="mt-2">\(\%\text{<?=$lang[3]?>} =<?=round($detail['growth_val'],4)?>\times {100}\)</p>
                            <p class="mt-2">\(\%\text{<?=$lang[3]?>} =\)<strong><span class="text-accent-4 font_size22 orange-text"><?=round($detail['growth_percent'], 2)?>%</span></strong></p>
                        </div>                  
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
@if(isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
@endif
<script>
document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var operation = document.getElementById('operation');
    operation.addEventListener('change', function() {
        var selectValue = this.value;
        if (selectValue == "2") {
            document.getElementById('f_2').style.display = 'block';
            document.querySelectorAll('.time_value').forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('time_vals').style.display = 'block';
            document.getElementById('f_1').style.display = 'none';
        } else {
            document.getElementById('f_2').style.display = 'none';
            document.querySelectorAll('.time_value').forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('time_vals').style.display = 'none';
            document.getElementById('f_1').style.display = 'block';
        }
    });
});


@if(isset($error))
var type = "{{$_POST['operation']}}";
if (type == "2") {
            document.getElementById('f_2').style.display = 'block';
            document.querySelectorAll('.time_value').forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('time_vals').style.display = 'block';
            document.getElementById('f_1').style.display = 'none';
        } else {
            document.getElementById('f_2').style.display = 'none';
            document.querySelectorAll('.time_value').forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById('time_vals').style.display = 'none';
            document.getElementById('f_1').style.display = 'block';
        }
 @endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>