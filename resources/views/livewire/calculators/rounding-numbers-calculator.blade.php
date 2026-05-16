 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="number" class="label">{{$lang['enter']}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="number" name="number" id="number" class="input" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="per" class="label">{{ $lang['per'] }}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="per" name="per" id="per" class="input">
                            @php
                                $val = ["-6", "-5", "-4", "-3", "-2", "-1", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17"];
                            @endphp
                            @foreach($val as $index => $v)
                                <option value="{{ $v }}">
                                    {{ $lang[$index + 1] }}({{ $v > 0 ? '+'.$v : $v }})
                                </option>
                            @endforeach
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['ans']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['ans']}}</td>
                                    </tr>
                                    @if($per != 0)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Whole Number</strong></td>
                                            <td class="py-2 border-b">{{$detail['one']}}</td>
                                        </tr>
                                    @endif
                                    @if($per != -1)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Tenth</strong></td>
                                            <td class="py-2 border-b">{{$detail['two']}}</td>
                                        </tr>
                                    @endif
                                    @if($per != -2)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Hundredth</strong></td>
                                            <td class="py-2 border-b">{{$detail['three']}}</td>
                                        </tr>
                                    @endif
                                    @if($per != -3)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>Rounded to Nearest Thousandth</strong></td>
                                            <td class="py-2 border-b">{{$detail['four']}}</td>
                                        </tr>    
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="window.MJrerender && window.MJrerender()"></script>
    <script>
        window.MJrerender = function() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        }
    </script>
@endpush
</div>
