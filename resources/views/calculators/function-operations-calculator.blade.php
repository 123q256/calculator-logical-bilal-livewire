<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['variable'] = "x";
                }
            @endphp
            <div class="col-span-12">
                <label for="fx" class="font-s-14 text-blue">{{$lang['1']}} f:</label>
                <div class="w-100 py-2">
                    <input type="text" name="fx" id="fx" value="{{ isset($_POST['fx'])?$_POST['fx']:'2x + 1' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="gx" class="font-s-14 text-blue">{{$lang['1']}} g:</label>
                <div class="w-100 py-2">
                    <input type="text" name="gx" id="gx" value="{{ isset($_POST['gx'])?$_POST['gx']:'3x - 13' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="variable" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                <div class="w-100 py-2">
                    <select name="variable" class="input" id="variable" aria-label="select">
                        @foreach(range('a', 'z') as $char)
                            <option value="{{ $char }}" {{ isset($_POST['variable']) && $_POST['variable'] == "$char" ? 'selected' : '' }}>{{ $char }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="point" class="font-s-14 text-blue">{{$lang['3']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="point" id="point" value="{{ isset($_POST['point'])?$_POST['point']:'' }}" class="input" aria-label="input" />
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
                            <div class="w-full text-[18px]">
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">\( (f + g)({{$detail['x']}})={{$detail['add']}} \)</p>
                                <p class="mt-3">\( (f - g)({{$detail['x']}})={{$detail['sub']}} \)</p>
                                <p class="mt-3">\( (f \times g)({{$detail['x']}})={{$detail['mul']}} \)</p>
                                <p class="mt-3">\( (f \div g)({{$detail['x']}})={{$detail['div']}} \)</p>
                                @isset($detail['point'])
                                    <p class="mt-3">{{$lang['5']}} {{$detail['x']}} = {{$detail['point']}}</p>
                                    <p class="mt-3">\( (f + g)({{$detail['point']}})={{$detail['add1']}} \)</p>
                                    <p class="mt-3">\( (f - g)({{$detail['point']}})={{$detail['sub1']}} \)</p>
                                    <p class="mt-3">\( (f \times g)({{$detail['point']}})={{$detail['mul1']}} \)</p>
                                    <p class="mt-3">\( (f \div g)({{$detail['point']}})={{$detail['div1']}} \)</p>
                                @endisset
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-3">\( (f + g)({{$detail['x']}})=({{$detail['fox']}}) + ({{$detail['gox']}})={{$detail['add']}} \)</p>
                                <p class="mt-3">\( (f - g)({{$detail['x']}})=({{$detail['fox']}}) - ({{$detail['gox']}})={{$detail['sub']}} \)</p>
                                <p class="mt-3">\( (f \times g)({{$detail['x']}})=({{$detail['fox']}}) \times ({{$detail['gox']}})={{$detail['mul']}} \)</p>
                                <p class="mt-3">\( (f \div g)({{$detail['x']}}) = \frac{{{$detail['fox']}}}{{{$detail['gox']}}}={{$detail['div']}} \)</p>
                                @isset($detail['point'])
                                    <p class="mt-3">{{$lang['5']}} {{$detail['x']}} = {{$detail['point']}}</p>
                                    <p class="mt-3">\( (f + g)({{$detail['point']}})={{str_replace($detail['x'],'('.$detail['point'].')',$detail['add'])}}={{$detail['add1']}} \)</p>
                                    <p class="mt-3">\( (f - g)({{$detail['point']}})={{str_replace($detail['x'],'('.$detail['point'].')',$detail['sub'])}}={{$detail['sub1']}} \)</p>
                                    <p class="mt-3">\( (f \times g)({{$detail['point']}})={{str_replace($detail['x'],'('.$detail['point'].')',$detail['mul'])}}={{$detail['mul1']}} \)</p>
                                    <p class="mt-3">\( (f \div g)({{$detail['point']}})={{str_replace($detail['x'],'('.$detail['point'].')',$detail['div'])}}={{$detail['div1']}} \)</p>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        @push('calculatorJS')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
        @endpush
    @endisset
</form>