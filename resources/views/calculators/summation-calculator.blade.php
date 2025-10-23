<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['cal_meth'] = "simple_sum";
                }
            @endphp
            <div class="col-span-12 ">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <p class="col-span-12 label"><strong>{{$lang['calculate']}} {{$lang['1']}}:</strong></p>
                <p class="col-span-12 md:col-span-4 lg:col-span-4 simple_sum">
                    <input type="radio" name="cal_meth" id="simple_sum" value="simple_sum" {{ isset($_POST['cal_meth']) && $_POST['cal_meth']==='simple_sum' ? 'checked':'' }}>
                    <label for="simple_sum" class="font-s-14">{{$lang['2']}}</label>
                </p>
                <p class="col-span-12 md:col-span-6 lg:col-span-6 sigma_sum">
                    <input type="radio" name="cal_meth" id="sigma_sum" value="sigma_sum" {{ isset($_POST['cal_meth']) && $_POST['cal_meth']==='sigma_sum' ? 'checked':'' }}>
                    <label for="sigma_sum" class="font-s-14">{{$lang['3']}} (Σ) {{$lang['4']}}</label>
                </p>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_meth']) && $_POST['cal_meth']==='sigma_sum' ? 'hidden':'' }}" id="numsInput">
                <label for="nums" class="label">{{$lang[5]}} (,):</label>
                <div class="w-100 py-2">
                    <textarea aria-label="textarea input" id="nums" name="nums" class="textareaInput">{{ isset($_POST['nums'])?$_POST['nums']:'1,2,3,4,5' }}</textarea>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_meth']) && $_POST['cal_meth']==='sigma_sum' ? '':'hidden' }} sigmaInput">
                <label for="eq" class="label">{{$lang['6']}}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="eq" id="eq" value="{{ isset($_POST['eq'])?$_POST['eq']:'x^2' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_meth']) && $_POST['cal_meth']==='sigma_sum' ? '':'hidden' }} sigmaInput">
                <label for="x" class="label">{{$lang['7']}} (x) ({{$lang['9']}} ∞, {{$lang['10']}} oo):</label>
                <div class="w-100 py-2">
                    <input type="text" name="x" id="x" value="{{ isset($_POST['x'])?$_POST['x']:'1' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_meth']) && $_POST['cal_meth']==='sigma_sum' ? '':'hidden' }} sigmaInput">
                <label for="n" class="label">{{$lang['8']}} (n) ({{$lang['9']}} -∞, {{$lang['10']}} -oo):</label>
                <div class="w-100 py-2">
                    <input type="text" name="n" id="n" value="{{ isset($_POST['n'])?$_POST['n']:'5' }}" class="input" aria-label="input" />
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
                    <div class="w-full md:w-[60%] lg:w-[60%]   mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                <td class="py-2 border-b">\( {{$detail['sum']}} \)</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                <td class="py-2 border-b">\( {{$detail['tn']}} \)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-3"><strong>{{$lang['12']}}</strong></p>
                        @if($_POST['cal_meth'] === "simple_sum")
                            <p class="mt-3">∑({{$_POST['nums']}}) = {{preg_replace('/\,/','+',$_POST['nums'])}}</p>
                            <p class="mt-3">∑({{$_POST['nums']}}) = {{$detail['sum']}}</p>
                            <p class="mt-3">{{$lang['13']}} = {{$detail['tn']}}</p>
                        @else
                            @php
                                $enter=$detail['enter'];
                                $i_n=$detail['i_n'];
                                $solve=$detail['solve'];
                                $cnvrgnt=$detail['cnvrgnt'];
                            @endphp
                            @if($cnvrgnt==='True')
                                <p class="mt-3">\( x = {{$_POST['x']}} \) {{$lang['15']}} \( {{$_POST['n']}} \)</p>
                                <p class="mt-3">
                                    \( 
                                        x =
                                        @php
                                            foreach($i_n as $key => $value){
                                                if(count($i_n)>$key+1){
                                                echo $value.',';
                                                }else{
                                                echo $value;
                                                }
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3">{{$lang['16']}} x {{$lang['17']}} \( ({{$enter}}) \):</p>
                                <p class="mt-3">
                                    \( 
                                        \sum_{x={{$_POST['x']}}}^{{$_POST['n']}} {{$enter}} = 
                                        @php
                                            foreach($i_n as $key => $value){
                                                if(count($i_n)>$key+1){
                                                echo '('.preg_replace('/x/','('.$value.')',$enter).')+';
                                                }else{
                                                echo '('.preg_replace('/x/','('.$value.')',$enter).')';
                                                }
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3">
                                    \( 
                                        \sum_{x={{$_POST['x']}}}^{{$_POST['n']}} {{$enter}} = 
                                        @php
                                            foreach($solve as $key => $value){
                                                if(count($solve)>$key+1){
                                                echo round($value,2).'+';
                                                }else{
                                                echo round($value,2);
                                                }
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3">\( \sum_{x={{$_POST['x']}}}^{{$_POST['n']}} {{$enter}} = {{$detail['sum']}} \)</p>
                            @else
                                <p class="mt-3">{{$lang['18']}}</p>
                                <p class="mt-3">\( \sum_{x={{$_POST['x']}}}^{{{$_POST['n']}}} {{$enter}} \) {{$lang['19']}}</p>
                            @endif
                        @endif
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
            document.querySelectorAll('.simple_sum').forEach(function(element) {
                element.addEventListener("click", function() {
                    document.querySelectorAll('.sigmaInput').forEach(function(element) {
                        element.style.display = 'none';
                    });
                    document.getElementById('numsInput').style.display = 'block';
                });
            });
            document.querySelectorAll('.sigma_sum').forEach(function(element) {
                element.addEventListener("click", function() {
                    document.querySelectorAll('.sigmaInput').forEach(function(element) {
                        element.style.display = 'block';
                    });
                    document.getElementById('numsInput').style.display = 'none';
                });
            });
        </script>
    @endpush
</form>