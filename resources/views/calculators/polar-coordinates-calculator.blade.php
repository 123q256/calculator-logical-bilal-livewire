<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="chose" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="chose" id="chose">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['chose']) && $_POST['chose']=='2'?'selected':'' }}>{{$lang[3]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x1" class="font-s-14 text-blue" id="changeText1">
                    @if (isset($_POST['chose']) && $_POST['chose'] === '2')
                        r
                    @else
                        x
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="text" name="x1" id="x1" class="input" value="{{ isset($_POST['x1'])?$_POST['x1']:'2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x2" class="font-s-14 text-blue" id="changeText2">
                    @if (isset($_POST['chose']) && $_POST['chose'] === '2')
                        θ
                    @else
                        y
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="text" name="x2" id="x2" class="input" value="{{ isset($_POST['x2'])?$_POST['x2']:'sqrt(2)' }}" aria-label="input"/>
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
                            <div class="w-full text-[16px]">
                                @if($detail['chose']==='1')
                                    <p class="mt-2 font-s-18">\((r, \theta) = ({{$detail['mag']}} , {{$detail['one']}} \text{ rad})\)</p>
                                    <p class="mt-3"><strong>{{$lang['5']}}:</strong></p>
                                    <p class="mt-3">{{$lang['6']}} \( (x,y) = ({{$detail['ex'].','.$detail['ey']}})\) {{$lang['7']}}.</p>
                                    <p class="mt-3">{{$lang['8']}} \(r=\sqrt{x^2+y^2}\)</p>
                                    <p class="mt-3">{{$lang['9']}} \(r=\sqrt{ {{$detail['ex']}}^2+{{$detail['ey']}}^2} = {{$detail['mag']}}\)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }θ=atan(\frac{y}{x}) \)</p>
                                    <p class="mt-3">\( \text{so } θ=atan(\frac{ {{$detail['ey']}} }{ {{$detail['ex']}} }) = {{$detail['one']}}\)</p>
                                    <p class="mt-3">\( \text{ {{$lang['4']}} } (r, \theta) = ({{$detail['mag']}} , {{$detail['one']}} \text{ rad})\)</p>
                                    <p class="mt-3">{{$lang['11']}}: </p>
                                    <p class="mt-3">\( θ = {{$detail['one']}} + π\)</p>
                                    <p class="mt-3">\( \text{ {{$lang['14']}} } (r, \theta) = ({{$detail['mag']*(-1)}} , {{$detail['two']}} \text{ rad})\)</p>
                                @else
                                    <p class="mt-2 font-s-18">\((x, y) = ({{$detail['x1']}} , {{$detail['y1']}})\)</p>
                                    <p class="mt-3"><strong>{{$lang['5']}}:</strong></p>
                                    <p class="mt-3">{{$lang['6']}} \( (r,\theta) = ({{$detail['ex'].','.$detail['ey']}})\) {{$lang['12']}}.</p>
                                    <p class="mt-3">{{$lang['13']}}:</p>
                                    <p class="mt-3">\( x=r \times cos(\theta) , y=r \times sin(\theta)\)</p>
                                    <p class="mt-3">\(  \text{ {{$lang['9']}}, }x={{$detail['ex']}} \times cos({{$detail['ey']}}) , y={{$detail['ex']}} \times sin({{$detail['ey']}})\)</p>
                                    <p class="mt-3">\(  \text{ {{$lang['4']}} }(x,y) = ({{$detail['x1'].','.$detail['y1']}})\)</p>
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
        <script>
            document.getElementById('chose').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText1').textContent = "x";
                    document.getElementById('changeText2').textContent = "y";
                }else{
                    document.getElementById('changeText1').textContent = "r";
                    document.getElementById('changeText2').textContent = 'θ';
                }
            });
        </script>
    @endpush
</form>