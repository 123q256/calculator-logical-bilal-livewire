<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="input" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <input type="text" name="input" id="input" wire:model.live="input" class="input" aria-label="input" />
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
    @if(isset($detail) && isset($detail['answer']))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['2'] }}</strong></td>
                                    <td class="py-2 border-b">\( {{$detail['answer']}} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px] overflow-auto mt-3">
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
    @endif
</form>

@push('calculatorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
    </script>
    <script>
        window.MJrerender = function() {
            if (typeof MathJax !== 'undefined' && MathJax.Hub) {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            }
        }
    </script>
@endpush
</div>
