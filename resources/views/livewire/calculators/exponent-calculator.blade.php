 <div>
   <form wire:submit.prevent="calculate">
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="b" class="font-s-14 text-blue">{{$lang[1]}} (b)</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="b" name="b" id="b" class="input" aria-label="input" @click="$wire.set('detail', null)"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="x" class="font-s-14 text-blue">{{$lang[2]}} (x)</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="x" name="x" id="x" class="input" aria-label="input" @click="$wire.set('detail', null)"/>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>Answer</strong></td>
                                        <td class="py-2 border-b">{{round($detail['result'], 4)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-2">
                                <p class="mt-2"><strong>{{$lang[4]}}</strong></p>
                                <p class="mt-2">({{$b}})<sup class="font-s-14">{{$x}}</sup> = ({{$detail['b']}})<sup class="font-s-14">{{$detail['x']}}</sup></p>
                                @if ($detail['x'] > 0 && $detail['x'] < 50)
                                    <p class="mt-2" style="overflow-x: auto">
                                        ({{$detail['b']}})<sup class="font-s-14">{{$detail['x']}}</sup> =
                                        @php 
                                            for ($i = 0; $i < round($detail['x']); $i++){
                                                $mul = ' × ';
                                                if($i+1 == round($detail['x'])){
                                                    $mul='';
                                                }
                                                echo $detail['b'].$mul;
                                            }
                                        @endphp 
                                    </p>
                                @endif
                                <p class="mt-2">({{$detail['b']}})<sup class="font-s-14">{{$detail['x']}}</sup> = {{round($detail['result'], 4)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
