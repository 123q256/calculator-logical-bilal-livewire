<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12  mx-auto mt-2  w-full">
            <input type="hidden" name="unit_type" id="unit_type" value="m1">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                        Force Calculator
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                        Net Force Calculator
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <div class="grid grid-cols-12 inp_wrap gap-4 mt-4" id="inp_wrap">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cal" class="font-s-14 text-blue">{{$lang['1']}}</label>
                        <div class="w-full py-2 position-relative">
                            <select name="cal" id="cal" class="input">
                                <option value="f"  {{ isset($_POST['cal']) && $_POST['cal']=='f'?'selected':''}}  >{{$lang[2]}} (F)</option>
                                <option value="m"  {{ isset($_POST['cal']) && $_POST['cal']=='m'?'selected':''}}  >{{$lang[3]}} (m)</option>
                                <option value="a"  {{ isset($_POST['cal']) && $_POST['cal']=='a'?'selected':''}}  >{{$lang[4]}} (a)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="f">
                        <label for="f" class="font-s-14 text-blue">{{ $lang['2'] }} (F)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="f" id="f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f']) ? $_POST['f'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'dyn' }} ▾</label>
                            <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'dyn' }}" id="f_unit" class="hidden">
                            <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'dyn')">dyn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kgf')">kgf</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'n')">n</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mn')">mn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'gn')">gn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'tn')">tn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kip')">kip</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'ibf')">ibf</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'ozf')">ozf</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'pdl')">pdl</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="m">
                        <label for="m" class="font-s-14 text-blue">{{ $lang['3'] }} (m)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="m" id="m" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m']) ? $_POST['m'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="m_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m_unit_dropdown')">{{ isset($_POST['m_unit'])?$_POST['m_unit']:'ug' }} ▾</label>
                            <input type="text" name="m_unit" value="{{ isset($_POST['m_unit'])?$_POST['m_unit']:'ug' }}" id="m_unit" class="hidden">
                            <div id="m_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="m_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'ug')">ug</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'mg')">mg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'g')">g</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'dag')">dag</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'kg')">kg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 't')">t</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'gr')">gr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'dr')">dr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'oz')">oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'lb')">lb</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'stone')">stone</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'us_ton')">US ton</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'long_ton')">Long ton</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'earths')">Earths</p>
                               
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="a">
                        <label for="a" class="font-s-14 text-blue">{{ $lang['4'] }} (a)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="a" id="a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['a']) ? $_POST['a'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('a_unit_dropdown')">{{ isset($_POST['a_unit'])?$_POST['a_unit']:'in_s2' }} ▾</label>
                            <input type="text" name="a_unit" value="{{ isset($_POST['a_unit'])?$_POST['a_unit']:'in_s2' }}" id="a_unit" class="hidden">
                            <div id="a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="a_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'in_s2')">in/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'ft_s2')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'cm_s2')">cm/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'm_s2')">m/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'mi_s2')">mi/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'mi_hs')">mi/(h.s)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'km_s2')">km/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'km_hs')">km/(h.s)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sigfig" class="font-s-14 text-blue">{{$lang['5']}}</label>
                        <div class="w-full py-2 position-relative">
                            <select name="sigfig" id="sigfig" class="input">
                                <option value="auto"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='auto'?'selected':''}}  >Auto</option>
                                <option value="3"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='3'?'selected':''}}  >3</option>
                                <option value="4"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='4'?'selected':''}}  >4</option>
                                <option value="5"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='5'?'selected':''}}  >5</option>
                                <option value="6"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='6'?'selected':''}}  >6</option>
                                <option value="7"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='7'?'selected':''}}  >7</option>
                                <option value="8"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='8'?'selected':''}}  >8</option>
                                <option value="9"  {{ isset($_POST['sigfig']) && $_POST['sigfig']=='9'?'selected':''}}  >9</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <div class="grid grid-cols-12 hidden inp_wrap gap-4" id="inp_wraps">
                    <div class="col-span-12 ">
                        <label for="question" class="font-s-14 text-blue">{{$lang['1']}}</label>
                        <div class="w-full py-2 position-relative">
                            <select name="question" id="question" class="input">
                                <option value="yes"  {{ isset($_POST['question']) && $_POST['question']=='yes'?'selected':''}}  >{{$lang[8]}}</option>
                                <option value="no"  {{ isset($_POST['question']) && $_POST['question']=='no'?'selected':''}}  >{{$lang[9]}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12" id="a_f">
                        <label for="a_f" class="font-s-14 text-blue">{{ $lang['10'] }} (a)</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="a_f" id="a_f" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['a_f'])?$_POST['a_f']:'15' }}" />
                            <span class="text-blue input_unit">N</span>
                        </div>
                    </div>
                    <div class="col-span-12 " id="g_f">
                        <label for="g_f" class="font-s-14 text-blue">{{ $lang['11'] }} (g)</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="g_f" id="g_f" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['g_f'])?$_POST['g_f']:'15' }}" />
                            <span class="text-blue input_unit">N</span>
                        </div>
                    </div>
                    <div class="col-span-12  hidden" id="f_v">
                        <label for="f_v" class="font-s-14 text-blue">{{ $lang['12'] }} (,)</label>
                        <div class="w-full py-2 position-relative">
                            <textarea aria-label="textarea input" name="f_v" class="input py-2" rows="3">{{ isset($_POST['f_v']) ? $_POST['f_v'] : '13,9,8,15,7' }} </textarea>

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
                        <div class="col-12  font-s-20">
                                @if(isset($_POST['unit_type']) && $_POST['unit_type']=="m1")
                                    @php
                                        $ans=$detail['ans'];
                                        if($_POST['cal']==='f'){
                                            $head='Force (F)';
                                            $m=$detail['m'];
                                            $a=$detail['a'];
                                        }elseif($_POST['cal']==='m'){
                                            $head='Mass (m)';
                                            $f=$detail['f'];
                                            $a=$detail['a'];
                                        }elseif($_POST['cal']==='a'){
                                            $head="Acceleration (a)";
                                            $f=$detail['f'];
                                            $m=$detail['m'];
                                        }
                                    @endphp
                                    <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                        <table class="w-full text-[18px]">
                                           <tr>
                                              <td class="py-2 border-b" width="40%"><strong>{{$head}}</strong></td>
                                               <td class="py-2 border-b"> {{$ans}}</td>
                                           </tr>
                                        </table>
                                  </div>
                                    <div class="mt-2">
                                    <p class="mt-2">{{$lang[13]}}:</p>
                                        @if($_POST['cal']==='f')
                                            <p class="mt-2">\( F = m * a \)</p>
                                            <p class="mt-2">\( F = {{$m}} \space kg * {{$a}} \space m/s^2 \)</p>
                                            <p class="mt-2">\( F = {{$m*$a}} \space N \)</p>
                                        @elseif($_POST['cal']==='m')
                                            <p class="mt-2">\( m = \dfrac{F}{a} \)</p>
                                            <p class="mt-2">\( m = \dfrac{ {{$f}} \space N}{ {{$a}} \space m/s^2} \)</p>
                                            <p class="mt-2">\( m = {{$f/$a}} \space kg \)</p>
                                        @elseif($_POST['cal']==='a')
                                            <p class="mt-2">\( a = \dfrac{F}{m} \)</p>
                                            <p class="mt-2">\( a = \dfrac{ {{$f}} \space N}{ {{$m}} \space kg} \)</p>
                                            <p class="mt-2">\( a = {{$f/$m}} \space m/s^2 \)</p>
                                       @endif
                                    </div>
                                @elseif(isset($_POST['unit_type']) && $_POST['unit_type']=="m2")
                                    @php  @$nf=$detail['nf'];
                                        @$ex=$detail['ex'];
                                    @endphp
                                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b" width="40%"><strong>{{$lang[14]}} (n)</strong></td>
                                                <td class="py-2 border-b"> {{$nf}} N</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <p class="mt-2">{{$lang[13]}}:</p>
                                        @if($_POST['question']==='yes')
                                            <p class="mt-2">n = a + g</p>
                                            <p class="mt-2">n = {{$_POST['a_f']}} + {{$_POST['g_f']}}</p>
                                            <p class="mt-2">n = {{$nf}}</p>
                                        @elseif($_POST['question']==='no')
                                            <p class="mt-2">n = Σ(x)</p>
                                            <p class="mt-2">n = {{$ex}}</p>
                                            <p class="mt-2">n = {{$nf}}</p>
                                        @endif
                                    </div>
                                @endif
                    </div>
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
@endpush
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>

    

@if(isset($detail))
    @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'm1')

    document.querySelectorAll('.imperial').forEach(function(element) {
                document.getElementById('imperial').classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "m1"
                var priceElasticity = document.getElementById('inp_wraps');
                var revenue = document.getElementById('inp_wrap');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
    @endif
    @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'm2')

    document.querySelectorAll('.metric').forEach(function(element) {
                document.getElementById('metric').classList.add('tagsUnit')

                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "m2"
                var priceElasticity = document.getElementById('inp_wraps');
                var revenue = document.getElementById('inp_wrap');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
            })

    @endif
    @endif

     document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.imperial').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "m1"
                var priceElasticity = document.getElementById('inp_wraps');
                var revenue = document.getElementById('inp_wrap');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        })

        document.querySelectorAll('.metric').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "m2"
                var priceElasticity = document.getElementById('inp_wraps');
                var revenue = document.getElementById('inp_wrap');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
            })
        })
    });


    @if(isset($detail))

    var value = "{{$_POST['cal']}}";
    var fElement = document.getElementById("f");
    var mElement = document.getElementById("m");
    var aElement = document.getElementById("a");

    if (value === "f") {
        fElement.classList.add('hidden');
        mElement.classList.remove('hidden');
        aElement.classList.remove('hidden');
    } else if (value === "m") {
        fElement.classList.remove('hidden');
        mElement.classList.add('hidden');
        aElement.classList.remove('hidden');
    } else if (value === "a") {
        fElement.classList.remove('hidden');
        mElement.classList.remove('hidden');
        aElement.classList.add('hidden');
    }

    @endif
    @if(isset($error))

var value = "{{$_POST['cal']}}";
var fElement = document.getElementById("f");
var mElement = document.getElementById("m");
var aElement = document.getElementById("a");

if (value === "f") {
    fElement.classList.add('hidden');
    mElement.classList.remove('hidden');
    aElement.classList.remove('hidden');
} else if (value === "m") {
    fElement.classList.remove('hidden');
    mElement.classList.add('hidden');
    aElement.classList.remove('hidden');
} else if (value === "a") {
    fElement.classList.remove('hidden');
    mElement.classList.remove('hidden');
    aElement.classList.add('hidden');
}

@endif


    document.getElementById('cal').addEventListener('change', function() {
    var value = this.value;
    var fElement = document.getElementById("f");
    var mElement = document.getElementById("m");
    var aElement = document.getElementById("a");

    if (value === "f") {
        fElement.classList.add('hidden');
        mElement.classList.remove('hidden');
        aElement.classList.remove('hidden');
    } else if (value === "m") {
        fElement.classList.remove('hidden');
        mElement.classList.add('hidden');
        aElement.classList.remove('hidden');
    } else if (value === "a") {
        fElement.classList.remove('hidden');
        mElement.classList.remove('hidden');
        aElement.classList.add('hidden');
    }
});



@if(isset($detail))

var value = "{{$_POST['question']}}";


var a_fElement = document.getElementById("a_f");
    var g_fElement = document.getElementById("g_f");
    var f_vElement = document.getElementById("f_v");

    if (value === "yes") {
        a_fElement.classList.remove('hidden');
        g_fElement.classList.remove('hidden');
        f_vElement.classList.add('hidden');
    } else if (value === "no") {
        f_vElement.classList.remove('hidden');
        a_fElement.classList.add('hidden');
        g_fElement.classList.add('hidden');
    }

@endif

@if(isset($error))

var value = "{{$_POST['question']}}";


var a_fElement = document.getElementById("a_f");
    var g_fElement = document.getElementById("g_f");
    var f_vElement = document.getElementById("f_v");

    if (value === "yes") {
        a_fElement.classList.remove('hidden');
        g_fElement.classList.remove('hidden');
        f_vElement.classList.add('hidden');
    } else if (value === "no") {
        f_vElement.classList.remove('hidden');
        a_fElement.classList.add('hidden');
        g_fElement.classList.add('hidden');
    }

@endif

document.getElementById('question').addEventListener('change', function() {
    var value = this.value;
    var a_fElement = document.getElementById("a_f");
    var g_fElement = document.getElementById("g_f");
    var f_vElement = document.getElementById("f_v");

    if (value === "yes") {
        a_fElement.classList.remove('hidden');
        g_fElement.classList.remove('hidden');
        f_vElement.classList.add('hidden');
    } else if (value === "no") {
        f_vElement.classList.remove('hidden');
        a_fElement.classList.add('hidden');
        g_fElement.classList.add('hidden');
    }
});



</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>