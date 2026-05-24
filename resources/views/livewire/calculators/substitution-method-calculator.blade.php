<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-8 ">
                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 ">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" wire:model.live="operations" id="operations">
                                <option value="1">{{$lang['2']}}</option>
                                <option value="2">{{$lang['3']}}</option>
                            </select>
                        </div>
                    </div>
                    @if ($operations == '1')
                    <div class="col-span-12 math_1">
                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-4">
                                <label for="a1_f" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="a1_f" id="a1_f" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="b1_f" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="b1_f" id="b1_f" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="k1_f" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="k1_f" id="k1_f" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="a2_f" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="a2_f" id="a2_f" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="b2_f" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="b2_f" id="b2_f" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="k2_f" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="k2_f" id="k2_f" class="input" aria-label="input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($operations == '2')
                    <div class="col-span-12 math_2">
                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-3">
                                <label for="a1_s" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="a1_s" id="a1_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="b1_s" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="b1_s" id="b1_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="c1_s" class="font-s-14 text-blue">c<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="c1_s" id="c1_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="k1_s" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="k1_s" id="k1_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="a2_s" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="a2_s" id="a2_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="b2_s" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="b2_s" id="b2_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="c2_s" class="font-s-14 text-blue">c<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="c2_s" id="c2_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="k2_s" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="k2_s" id="k2_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="a3_s" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="a3_s" id="a3_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="b3_s" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="b3_s" id="b3_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="c3_s" class="font-s-14 text-blue">c<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="c3_s" id="c3_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="k3_s" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model.live="k3_s" id="k3_s" class="input" aria-label="input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
                <div class="col-span-4  text-[20px] flex items-center">
                    @if ($operations == '1')
                    <div class="col-12 math_1">
                        <p>
                            <strong>
                                a<sub class="font-s-16">1</sub> x + b<sub class="font-s-16">1</sub>y = k<sub class="font-s-16">1</sub>
                            </strong>
                        </p>
                        <p class="mt-1">
                            <strong>
                                a<sub class="font-s-16">2</sub> x + b<sub class="font-s-16">2</sub>y = k<sub class="font-s-16">2</sub>
                            </strong>
                        </p>
                    </div>
                    @endif
                    @if ($operations == '2')
                    <div class="col-12 math_2">
                        <p>
                            <strong>
                                a<sub class="font-s-16">1</sub> x + b<sub class="font-s-16">1</sub>y + c<sub class="font-s-16">1</sub>z = k<sub class="font-s-16">1</sub>
                            </strong>
                        </p>
                        <p class="mt-1">
                            <strong>
                                a<sub class="font-s-16">2</sub> x + b<sub class="font-s-16">2</sub>y + c<sub class="font-s-16">2</sub>z = k<sub class="font-s-16">2</sub>
                            </strong>
                        </p>
                        <p class="mt-1">
                            <strong>
                                a<sub class="font-s-16">3</sub> x + b<sub class="font-s-16">3</sub>y + c<sub class="font-s-16">3</sub>z = k<sub class="font-s-16">3</sub>
                            </strong>
                        </p>
                    </div>
                    @endif
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
                        @if($operations === "1")
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18"> 
                                    <tr>
                                        <td class="py-2 border-b" width="35%"><strong>{{$lang[4]}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$detail['main_ans']}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang[5]}}</strong></p>
                                <p class="mt-2">{{$lang[6]}}:</p>
                                <p class="mt-2">{{$detail['f1_equation']}}</p>
                                <p class="mt-2">{{$detail['f2_equation']}}</p>
                                <p class="mt-2">{{$detail['first']}}</p>
                                <p class="mt-2">{{$detail['second']}}</p>
                                <p class="mt-2">{{$detail['third']}}</p>
                                <p class="mt-2">{{$detail['four']}}</p>
                                <p class="mt-2">{{$detail['five']}}</p>
                                <p class="mt-2">{{$detail['six']}}</p>
                                @isset($detail['seven'])
                                    <p class="mt-2">{{$detail['seven']}}</p>
                                @endisset
                                <p class="mt-2">{{$detail['answer1']}}</p>
                                <p class="mt-2">{{$detail['answer2']}}</p>
                                <p class="mt-2">{{$detail['answer3']}}</p>
                                <p class="mt-2">{{$detail['answer4']}}</p>
                                <p class="mt-2">{{$detail['answer5']}}</p>
                                <p class="mt-2">{{$detail['answer6']}}</p>
                                <p class="mt-2">{{$detail['answer7']}}</p>
                                <p class="mt-2">{{$detail['answer8']}}</p>
                            </div>
                        @else
                            <div class="w-full text-center text-[20px]">
                                <p>{{$lang[4]}}</p>
                                <p class="font-s-16">{{$detail['s_fans']}}</p>
                                @isset($detail['s_fans2'])
                                    <p class="my-3">
                                        <strong class="bg-white px-3 py-2 radius-10 text-blue">
                                            {{$detail['s_fans2']}}
                                        </strong>
                                    </p>
                                @endisset
                                @isset($detail['s_fans3'])
                                    <p class="my-3 font-s-16">{{$detail['s_fans3']}}</p>
                                @endisset
                                @isset($detail['s_fans4'])
                                    <p class="my-3 font-s-16">{{$detail['s_fans4']}}</p>
                                @endisset
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
</div>
