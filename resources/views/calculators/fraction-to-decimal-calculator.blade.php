<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            @php
            if (!isset($detail)) {
                $_POST['round'] = "8";
            }
            @endphp
            <div class="flex grid-cols-1 lg:grid-cols-1 lg:flex-row justify-center items-center mt-3 w-full">
                <div class="w-full lg:pr-2">
                    <input type="number" step="any" name="n1" id="n1" class="input mb-2" value="{{ isset($_POST['n1'])?$_POST['n1']:'3' }}" placeholder="whole number" aria-label="input"/>
                </div>
                <div class="w-full lg:pl-2">
                    <input type="number" step="any" name="n2" id="n2" class="input mb-2" value="{{ isset($_POST['n2'])?$_POST['n2']:'2' }}" placeholder="numerator" aria-label="input"/>
                    <hr class="my-4"> <!-- Only show hr on mobile -->
                    <input type="number" step="any" name="d1" id="d1" class="input mt-2" value="{{ isset($_POST['d1'])?$_POST['d1']:'5' }}" placeholder="denominator" aria-label="input"/>
                </div>
            </div>

            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2">
                    <label for="round" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="round" class="input" id="round" aria-label="select">
                        <option value="0" {{ isset($_POST['round']) && $_POST['round'] == '0' ? 'selected' : '' }}>nearest 1</option>
                        <option value="1" {{ isset($_POST['round']) && $_POST['round'] == '1' ? 'selected' : '' }}>to 1dp</option>
                        <option value="2" {{ isset($_POST['round']) && $_POST['round'] == '2' ? 'selected' : '' }}>to 2dp</option>
                        <option value="3" {{ isset($_POST['round']) && $_POST['round'] == '3' ? 'selected' : '' }}>to 3dp</option>
                        <option value="4" {{ isset($_POST['round']) && $_POST['round'] == '4' ? 'selected' : '' }}>to 4dp</option>
                        <option value="8" {{ isset($_POST['round']) && $_POST['round'] == '8' ? 'selected' : '' }}>{{ $lang['2'] }}</option>
                    </select>
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
                    <div class="w-full  bg-light-blue  p-3 radius-10 mt-3">
                        <div class="row">
                            <div class="col-12 font-s-16">
                                <p class="mt-3 font-s-18">\( {{(isset($_POST['n1'])?$_POST['n1']:'')}} \dfrac{ {{$_POST['n2']}} }{ {{$_POST['d1']}} } = {{$detail['ans']}} \)</p>
                                @if(is_numeric($_POST['n1']))
                                    <p class="mt-3"><strong>{{$lang['ex']}}:</strong></p>
                                    <p class="mt-3">{{$lang['input']}} \( {{(isset($_POST['n1'])?$_POST['n1']:'')}} \dfrac{ {{$_POST['n2']}} }{ {{$_POST['d1']}} } \)</p>
                                    <p class="mt-3">{{$lang['step']}} # 1 = \( \dfrac{ ({{$detail['totalN']}}) }{ ({{$detail['totalD']}}) } \)</p>
                                    <p class="mt-3">{{$lang['step']}} # 2 = \( \dfrac{ ({{$detail['totalN'].'÷'.$detail['g']}}) }{ ({{$detail['totalD'].'÷'.$detail['g']}}) } \)</p>
                                    @if($detail['btm']=='1')
                                        <p class="mt-3">{{$lang['an']}} = {{$detail['upr']}}</p>
                                    @else
                                        <p class="mt-3">{{$lang['an']}} = \( \dfrac{ {{$detail['upr']}} }{ {{$detail['btm']}} } \)</p>    
                                    @endif
                                    @if($detail['upr']>$detail['btm'] && $detail['btm']!='1')
                                        @php
                                            $bta=$detail['upr'] % $detail['btm'];
                                            $shi=floor($detail['upr'] / $detail['btm']);
                                        @endphp
                                        <p class="mt-3">{{$lang['or']}} = {{$shi}} \( \dfrac{ {{$bta}} }{ {{$detail['btm']}} } \)</p>    
                                    @endif
                                    <p class="mt-3">{{$lang['dec']}}: {{round($detail['upr']/$detail['btm'],4)}}</p>    
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
    @endpush
</form>