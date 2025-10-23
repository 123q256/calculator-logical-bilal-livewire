<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="input" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <input type="text" name="input" id="input" value="{{ isset($_POST['input'])?$_POST['input']:'2x^2 - 13 + x^2 + 5 -2y^3 + 3y^3' }}" class="input" aria-label="input" />
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['2'] }}</strong></td>
                                    <td class="py-2 border-b">\( {{$detail['answer']}} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>{{$lang['3']}}</strong></p>
                            @php
                                $sol = 0;
                            @endphp
                            @foreach($detail['steps'] as $key => $value)
                                @if (!empty($value))
                                    <p class="mt-3">{{ $value }}</p>
                                    @php
                                    $show = '';
                                    for ($i = 0; $i <= $key; $i++) {
                                        if (empty($show)) {
                                            $detail['finals'][$i] = str_replace('+', '', $detail['finals'][$i]);
                                        }
                                        $show .= $detail['finals'][$i];
                                    }
                                    for ($i = $key + 1; $i < count($detail['final']); $i++) {
                                        $show .= $detail['final'][$i];
                                    }
                                    @endphp
                                    <p class="mt-3">\( {{ $show }} \)</p>
                                @endif
                            @endforeach
                            <p class="mt-3">{{ $lang['5'] }}:</p>
                            <p class="mt-3">\( {{ $detail['answer'] }} \)</p>
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