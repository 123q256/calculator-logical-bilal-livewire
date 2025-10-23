<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            @php $request = request();@endphp
            <div class="col-span-12 flex justify-center">
            <p class="my-1 text-center"><img src="{{asset('images/geom_seq.svg')}}" width="150px" class="px-3" alt="geometric"></p>
            </div>
            <div class="col-span-12">
                <label for="find" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select name="find" class="input" id="find" aria-label="select">
                        <option value="gs">{{$lang['2']}}</option>
                        <option value="a1" {{ isset($request->find) && $request->find == 'a1' ? 'selected' : '' }}>{{$lang['3']." (a₁)"}}</option>
                        <option value="r" {{ isset($request->find) && $request->find == 'r' ? 'selected' : '' }}>{{$lang['4']." (r)"}}</option>
                        <option value="n" {{ isset($request->find) && $request->find == 'n' ? 'selected' : '' }}>{{$lang['5']." (n)"}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 mb-1 items-center justify-evenly {{ isset($request->find) && $request->find === 'n' ? 'flex' : 'hidden' }}" id="cwInput">
                <p class="label"><strong>Calculate by:</strong></p>
                <p id="nthInput">
                    <input type="radio" name="cw" id="nth" value="nth" {{ isset($request->cw) && $request->cw==='nth' ? 'checked':'checked' }}>
                    <label for="nth" class="font-s-14">{{$lang['10']}}</label>
                </p>
                <p id="s_nInput">
                    <input type="radio" name="cw" id="s_n" value="s_n" {{ isset($request->cw) && $request->cw==='s_n' ? 'checked':'' }}>
                    <label for="s_n" class="font-s-14">{{$lang['7']}}</label>
                </p>
            </div>
            <div class="col-span-12 {{ isset($request->find) && $request->find === 'a1' ? 'hidden' : '' }}" id="a1Input">
                <label for="a1" class="label">{{$lang['3']}} (a₁)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="a1" id="a1" class="input" value="{{ isset($request->a1)?$request->a1:'2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($request->find) && $request->find === 'r' ? 'hidden' : '' }}" id="rInput">
                <label for="r" class="label">{{$lang['4']}} (r)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="r" id="r" class="input" value="{{ isset($request->r)?$request->r:'2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($request->find) && ($request->find === 'a1' || $request->find === 'r' || $request->find === 'n') ? 'hidden' : '' }}" id="nInput">
                <label for="n" class="label">{{$lang['5']}} (n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="n" id="n" min="1" max="20" class="input" value="{{ isset($request->n)?$request->n:'10' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($request->find) && $request->find === 'n' && isset($request->cw) && $request->cw === 'nth' ? '' : 'hidden' }}" id="anInput">
                <label for="an" class="label">{{$lang['6']}} a(n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="an" id="an" class="input" value="{{ isset($request->an)?$request->an:'4' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 {{ isset($request->find) && $request->find === 'n' && isset($request->cw) && $request->cw === 's_n' ? '' : 'hidden' }}" id="snInput">
                <label for="sn" class="label">{{$lang['7']}} S(n)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="sn" id="sn" class="input" value="{{ isset($request->sn)?$request->sn:'4' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 mb-1 {{ isset($request->find) && ($request->find === 'a1' || $request->find === 'r') ? 'flex' : 'hidden' }} items-center justify-evenly" id="a_nInput">
                <p class="label">a</p>
                <div class="flex items-center px-2">
                    (&nbsp;<input type="number" step="any" name="n1" id="n1" class="input flex " value="{{ isset($request->n1)?$request->n1:'3' }}" aria-label="input"/>&nbsp;)
                </div>
                <p class="text-[18px] pe-2">=</p>
                <div>
                    <input type="number" step="any" name="a_n" id="a_n" class="input flex " value="{{ isset($request->a_n)?$request->a_n:'16' }}" aria-label="input"/>
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
                        @php
                            $find= $request->find;
                            $cw= $request->cw;
                            $a1= $request->a1;
                            $r= $request->r;
                            $n= $request->n;
                            $an= $request->an;
                            $sn= $request->sn;
                            $n1= $request->n1;
                            $a_n= $request->a_n;
                        @endphp
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
            
                            <table class="w-full text-[18px]">
                                @if($find==='gs')
                                <div class="row-12 bg-white border p-3 overflow-auto">
                                    <div class="w-full text-center text-[16px]">
                                        <p>n-th term (a<sub class="font-s-14">{{$n}}</sub>)</p>
                                        <p class="my-2"><strong class="px-3 font-s-20 radius-10 text-blue">{{round($detail['an_val'],4)}}</strong></p>
                                    </div>
                                    <div class="w-full text-center text-[16px]">
                                        <p>Geometric Sum (S<sub class="font-s-14">{{$n}}</sub>) </p>
                                        <p class="my-2"><strong class=" px-3 font-s-20 radius-10 text-blue">{{round($detail['sn_val'],4)}}</strong></p>
                                    </div>
                                    <div class="w-full text-center text-[16px]">
                                        <p>{{$lang['11']}}</p>
                                        <p class="my-2"><strong class="px-3 font-s-20 radius-10 text-blue"> \( {{$detail['seq']}} \)</strong></p>
                                    </div>
                                </div>
                                @elseif($find==='a1')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>a<sub class="font-s-14">1</sub></strong></td>
                                        <td class="py-2 border-b">{{round($detail['a1_val'],4)}}</td>
                                    </tr>
                                @elseif($find==='r')
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>r</strong></td>
                                        <td class="py-2 border-b">{{round($detail['r_val'],4)}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n</strong></td>
                                        <td class="py-2 border-b">{{round($detail['n_val'],4)}}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['8']}}:</strong></p>
                            @if($find==='gs')
                                <p class="mt-2"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">\( a_1 = {{$a1}}, r = {{$r}}, n = {{$n}} \)</p>
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">\( a_n = a_1 * r^{n-1} \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = ({{$a1}})*({{$r}})^{ {{$n}} - 1} \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = ({{$a1}})*({{$r}})^{{{$n-1}}} \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = ({{$a1}})*({{pow($r,($n-1))}}) \)</p>
                                <p class="mt-2">\( a_{\text{{{$n}}}} = {{$detail['an_val']}} \)</p>
                                <p class="mt-2"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-2">\( S_n = \dfrac{a_1*(1 - r^n)}{1 - r} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1}}*(1 - {{$r}}^{ {{$n}}})}{1 - {{$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1}}*(1 - {{pow($r,$n)}})}{ {{1-$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1}}*({{1-pow($r,$n)}})}{ {{1-$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = \dfrac{ {{$a1*(1-pow($r,$n))}} }{ {{1-$r}}} \)</p>
                                <p class="mt-2">\( S_{\text{{{$n}}}} = {{$detail['sn_val']}} \)</p>
                                
                                <div id="container" class="col-lg-8 mx-auto my-3" style="height:350px;"></div>
                            @elseif($find==='a1')
                                <p class="mt-2">\( a₁ = \dfrac{a_n}{r^{n-1}} \)</p>
                                <p class="mt-2">\( a₁ = \dfrac{ {{$a_n}} }{({{$r}})^{ {{$n1}} - 1}} \)</p>
                                <p class="mt-2">\( a₁ = \dfrac{ {{$a_n}} }{({{$r}})^{ {{$n1-1}} }} \)</p>
                                <p class="mt-2">\( a₁ = \dfrac{ {{$a_n}} }{ {{pow($r,($n1-1))}} } \)</p>
                                <p class="mt-2">\( a₁ = {{$detail['a1_val']}} \)</p>
                            @elseif($find==='r')
                                <p class="mt-2">\( r = \sqrt[\large{n-1}]{\dfrac{a_n}{a_1}} \)</p>
                                <p class="mt-2">\( r = \sqrt[\large{ {{$n1}} }-1]{\dfrac{ {{$a_n}} }{ {{$a1}} }} \)</p>
                                <p class="mt-2">\( r = \sqrt[\large{ {{$n1-1}} }]{ {{$a_n/$a1}} } \)</p>
                                <p class="mt-2">\( r = {{$detail['r_val']}} \)</p>
                            @else
                                @if($cw==='nth')
                                    <p class="mt-2">\( n = \dfrac{log \left(\dfrac{a_n}{a_1} \right)}{log(r)}+1 \)</p>
                                    <p class="mt-2">\( n = \dfrac{log \left(\dfrac{ {{$an}} }{ {{$a1}} } \right)}{log({{$r}})}+1 \)</p>
                                    <p class="mt-2">\( n = \dfrac{log({{$an/$a1}})}{log({{$r}})}+1 \)</p>
                                    <p class="mt-2">\( n = {{log(($an/$a1))/log($r)}}+1 \)</p>
                                    <p class="mt-2">\( n = {{$detail['n_val']}} \)</p>
                                @else
                                    <p class="mt-2">\( n = \dfrac{log \left (\left(\left( \dfrac{S_n}{a_1} \right)*(1-r)-1 \right) * (-1) \right)}{log(r)} \)</p>
                                    <p class="mt-2">\( n = \dfrac{log \left (\left(\left( \dfrac{ {{$sn}} }{ {{$a1}} } \right)*(1-{{$r}})-1 \right) * (-1) \right)}{log({{$r}})} \)</p>
                                    <p class="mt-2">\( n = \dfrac{log((({{$sn/$a1}})*({{1-$r}})-1)*(-1))}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = \dfrac{log(({{($sn/$a1)*(1-$r)}}-1)*(-1))}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = \dfrac{log(({{($sn/$a1)*(1-$r)-1}})*(-1))}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\(
                                    n = \dfrac{log({{((($sn/$a1)*(1-$r))-1)*(-1)}})}{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = \dfrac{ {{log(((($sn/$a1)*(1-$r))-1)*(-1))}} }{ {{log($r)}} } \)</p>
                                    <p class="mt-2">\( n = {{$detail['n_val']}} \)</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @if(isset($detail) && $request->find == "gs")
            <script src="https://code.highcharts.com/highcharts.js"></script>
            @php
                $data='';
                for($i=1; $i < 11; $i++){
                    $sum=pow($a1,$i);
                    if($i<11){
                    if($i===10)
                        $data.="$sum";
                    else{
                        $data.="$sum, ";
                    }
                    }
                }
            @endphp
            <script>
                Highcharts.chart('container',{
                title:{
                    text: '<b>Geometric Sequence</b>'
                },
                xAxis:{
                    min:0,
                },
                yAxis:{
                    title: {text:''},
                    type: 'logarithmic',
                    minorTickInterval: 0.1,
                    accessibility:{
                        rangeDescription: 'Range: 0.1 to 1000'
                    }
                },
                legend:{
                    enabled:false,
                },
                tooltip:{
                    headerFormat: '<b>Geometric Sequence</b><br /><br />',
                    pointFormat: 'n = {point.x}, aₙ = {point.y}'
                },
                series:[{
                data:[{{$data}}],
                pointStart: 1
                }]
            });
            </script>
        @endif
        <script>
            document.querySelector('#nthInput').addEventListener('click', function() {
                ['#anInput'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.remove('hidden');
                    });
                });
                ['#snInput'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.add('hidden');
                    });
                });
            });
            document.querySelector('#s_nInput').addEventListener('click', function() {
                ['#snInput'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.remove('hidden');
                    });
                });
                ['#anInput'].forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.add('hidden');
                    });
                });
            });
            document.getElementById('find').addEventListener('change', function() {
                var findValue = this.value
                switch (findValue) {
                    case 'gs':
                        ['#a1Input', '#rInput', '#nInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#cwInput', '#anInput', '#snInput', '#a_nInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        break;
                    case 'a1':
                        ['#rInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#a_nInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                                element.classList.add('flex');
                            });
                        });
                        ['#a1Input', '#nInput', '#cwInput', '#anInput', '#snInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        break;
                    case 'r':
                        ['#a1Input'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#a_nInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                                element.classList.add('flex');
                            });
                        });
                        ['#rInput', '#nInput', '#cwInput', '#anInput', '#snInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        break;
                    case 'n':
                        ['#cwInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                                element.classList.add('flex');
                            });
                        });
                        ['#a1Input', '#rInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#nInput', '#a_nInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        const checkedValue = document.querySelector('input[name="cw"]:checked').value;
                        if (checkedValue === 'nth') {
                            ['#anInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.remove('hidden');
                                });
                            });
                            ['#snInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.add('hidden');
                                });
                            });
                        } else {
                            ['#anInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.add('hidden');
                                });
                            });
                            ['#snInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.remove('hidden');
                                });
                            });
                        }
                        break;
                }
            });
        </script>
    @endpush
</form>