<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="want" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="want" id="want" wire:model.live="want">
                            <option value="1">{{$lang['2']}}</option>
                            <option value="2">{{$lang['3']}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="unit" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="unit" id="unit" wire:model.live="unit">
                            <option value="1">{{$lang['5']}}°</option>
                            <option value="2">π {{$lang['6']}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="angle" class="label">{{$lang[7]}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="angle" id="angle" class="input" wire:model.live="angle" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 {{ $want === '2' ? 'block' : 'hidden' }}">
                    <label for="angle2" class="label">{{$lang[7]}} 2:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="angle2" id="angle2" class="input" wire:model.live="angle2" aria-label="input"/>
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
                        @if ($detail['want']==1 && $detail['unit']==1)
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['angle']+360}}°, {{$detail['angle']+(360*2)}}°, {{$detail['angle']+(360*3)}}°, {{$detail['angle']+(360*4)}}° ....</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['angle']-360}}°, {{$detail['angle']-(360*2)}}°, {{$detail['angle']-(360*3)}}°, {{$detail['angle']-(360*4)}}° ....</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" colspan="2"><strong>{{$detail['angle']}}° = {{$detail['upr'].'/'.$detail['btm']}} π ≈ {{$detail['rad']}} π</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @elseif ($detail['want']==1 && $detail['unit']==2)
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" colspan="2">Coterminal angle in [0, 2π) range: <strong>{{$detail['two']}} π</strong>, located in the <strong>{{$detail['q']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['pos']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['neg']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" colspan="2">{{$detail['angle']}} π = {{$detail['deg']}}°</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full text-center my-2">
                                <p>
                                    <strong class="bg-white px-3 py-2 font-s-21 radius-10 text-blue">
                                        @if($detail['check']==1)
                                            {{$lang['10']}}
                                        @else
                                            {{$lang['11']}}
                                        @endif
                                    </strong>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
