 <div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[45%] md:w-[45%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 text-center">

            <div class="col-span-12 text-left">
                <label for="shap" class="label">{{ $lang['select'] }}:</label>
                <div class="w-100 py-2">
                    <select wire:model.live="shap" class="input" aria-label="select" name="shap" id="shap">
                        <option value="3">{{$lang['tri']}}</option>
                        <option value="4">{{$lang['pol']}}</option>
                        <option value="n">{{$lang['n']}}</option>
                    </select>
                </div>
            </div>
            @if($shap !== '3')
            <div class="col-span-12 text-left nInput">
                <span class="label">N:</span>
                <div class="w-100 py-2">
                    <input wire:model.live="total" type="number" step="any" name="total" min="2" max="10" id="nValue" class="input" aria-label="input" />
                </div>
            </div>
            @endif

            @php
                $limit = ($shap == '3') ? 3 : $total;
            @endphp

            @for($i = 1; $i <= $limit; $i++)
                <p class="col-span-12"><strong>{{$lang['x']}} (x<sub class="font-s-14">{{$i}}</sub>, y<sub class="font-s-14">{{$i}}</sub>)</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="points.{{$i}}.x" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="points.{{$i}}.y" class="input" aria-label="input" />
                    </div>
                </div>
            @endfor
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
                            <div class="w-full   mt-2">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['anst'] }}</strong></td>
                                        <td class="py-2 border-b">({{$detail['ans']}})</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>Solution</strong></p>
                                <p class="mt-2">Input Data:</p>
                                @if($shap=='3' || $total=='3')
                                    <p class="mt-2" >Point 1(x<sub class="font-s-14">1</sub>, y<sub class="font-s-14">1</sub>) = ({{$points[1]['x']}}, {{$points[1]['y']}})<br>Point 2(x<sub class="font-s-14">2</sub>, y<sub class="font-s-14">2</sub>) = ({{$points[2]['x']}}, {{$points[2]['y']}})<br>Point 3(x<sub class="font-s-14">3</sub>, y<sub class="font-s-14">3</sub>) = ({{$points[3]['x']}}, {{$points[3]['y']}})</p>
                                    <p class="mt-2">
                                        Formula of Centroid = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">x<sub class="font-s-14">1</sub> + x<sub class="font-s-14">2</sub> + x<sub class="font-s-14">3</sub></span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">y<sub class="font-s-14">1</sub> + y<sub class="font-s-14">2</sub> + y<sub class="font-s-14">3</sub></span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">{{$points[1]['x']}} + {{$points[2]['x']}} + {{$points[3]['x']}}</span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$points[1]['y']}} + {{$points[2]['y']}} + {{$points[3]['y']}}</span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">{{$points[1]['x'] + $points[2]['x'] + $points[3]['x']}}</span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$points[1]['y'] + $points[2]['y'] + $points[3]['y']}}</span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = ({{$detail['ans']}})
                                    </p>
                                @else
                                    @for($i=1; $i<=$detail['n']; $i++)
                                        <p class="mt-2">Point {{$i}} (x<sub class="font-s-14">{{$i}}</sub>, y<sub class="font-s-14">{{$i}}</sub>) = ({{$points[$i]['x']}}, {{$points[$i]['y']}})</p>
                                    @endfor
                                    <p class="mt-2">
                                        Formula of Centroid = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    x<sub class="font-s-14">{{$i}}</sub>
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    y<sub class="font-s-14">{{$i}}</sub>
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    {{$points[$i]['x']}}
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    {{$points[$i]['y']}}
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">
                                                {{$detail['x3']}}
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$detail['y3']}}</span>
                                            <span>{{$detail['n']}}</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = ({{$detail['ans']}})
                                    </p>
                                @endif
                                <div class="col-12 text-center mt-3">
                                    @if($shap === '3')
                                        <img src="{{asset('images/triangle.webp')}}" height="100%" width="200px" alt="trianle details image first" loading="lazy" decoding="async">
                                    @elseif($shap === '4')
                                        <img src="{{asset('images/pol.webp')}}" height="100%" width="200px" alt="trianle details image second" loading="lazy" decoding="async">
                                    @else
                                        <img src="{{asset('images/npoint.webp')}}" height="100%" width="200px" alt="trianle details image third" loading="lazy" decoding="async">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
