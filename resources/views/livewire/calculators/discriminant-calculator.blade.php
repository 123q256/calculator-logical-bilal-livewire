 <div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['pol'] }}:</label>
                    <select class="input" aria-label="select" wire:model.live="to_calculate" name="to_calculate" id="to_calculate">
                        <option value="2d">{{$lang['sec']}}</option>
                        <option value="3d">{{$lang['thir']}}</option>
                        <option value="4d">{{$lang['for']}}</option>
                    </select>
                </div>
            </div>
                <p class="w-full  mt-3 text-center">
                    <strong>
                        @if($to_calculate === '3d')
                            Enter a,b,c,d in ax³ + bx² + cx + d = 0
                        @elseif($to_calculate === '4d')
                            Enter a,b,c,d,e in ax⁴ + bx³ + cx² + dx + e = 0
                        @else
                            Enter a,b,c in ax² + bx + c = 0
                        @endif
                    </strong>
                </p>
                <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 {{ $to_calculate === '4d' ? '' : 'hidden' }}">
                    <label for="value4" class="font-s-14 text-blue">a</label>
                    <input type="number" step="any" wire:model.live="value4" name="value4" id="value4" class="input" aria-label="input"/>
                </div>
                <div class="space-y-2 {{ ($to_calculate === '3d' || $to_calculate === '4d') ? '' : 'hidden' }}">
                    <label for="value3" class="font-s-14 text-blue">
                        {{ $to_calculate === '3d' ? 'a' : 'b' }}
                    </label>
                    <input type="number" step="any" wire:model.live="value3" name="value3" id="value3" class="input" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="value2" class="font-s-14 text-blue">
                        @if($to_calculate === '3d')
                            b
                        @elseif($to_calculate === '4d')
                            c
                        @else
                            a
                        @endif
                    </label>
                    <input type="number" step="any" wire:model.live="value2" name="value2" id="value2" class="input" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="value1" class="font-s-14 text-blue">
                        @if($to_calculate === '3d')
                            c
                        @elseif($to_calculate === '4d')
                            d
                        @else
                            b
                        @endif
                    </label>
                    <input type="number" step="any" wire:model.live="value1" name="value1" id="value1" class="input" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="value" class="font-s-14 text-blue">
                        @if($to_calculate === '3d')
                            d
                        @elseif($to_calculate === '4d')
                            e
                        @else
                            c
                        @endif    
                    </label>
                    <input type="number" step="any" wire:model.live="value" name="value" id="value" class="input" aria-label="input"/>
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
                <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                    <div class=" lg:flex-row">
                        <div class="w-full lg:w-1/2 mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b" style="width: 60%;"><strong>{{$lang['dis']}}</strong></td>
                                    <td class="py-2 border-b">{{number_format($detail['sd'], 2)}}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-2 text-base">{{$lang['nature']}}: <span class="text-blue-600">{{$detail['nrs']}}</span></p>
                        <p class="mt-3 text-base"><strong>{{$lang['sol']}}:</strong></p>
                        @if($to_calculate == '2d')
                            @php $a=$value2; $b=$value1; $c=$value; @endphp
                            <div class="w-full text-base">
                                <p class="mt-2">Equation: {{ $a }}x² {{ $b < 0 ? '- ' : '+ ' }}{{ abs($b) }}x {{ $c < 0 ? '- ' : '+ ' }}{{ abs($c) }} = 0</p>
                                <p class="mt-2">{{$lang['g_f']}} : b<sup class="text-sm">2</sup>-4ac=0</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">D = ({{$b}})<sup class="text-sm">2</sup> - 4 x {{$a}} x {{$c}}</p>
                                <p class="mt-2">D = {{pow($b, 2)}} - {{4*$a*$c}}</p>
                                <p class="mt-2">D = {{$detail['sd']}}</p>
                            </div>
                        @elseif($to_calculate == '3d')
                            @php $a=$value3; $b=$value2; $c=$value1; $d=$value; @endphp
                            <div class="w-full text-base">
                                <p class="mt-2">Equation: {{ $a }}x³ {{ $b < 0 ? '- ' : '+ ' }}{{ abs($b) }}x² {{ $c < 0 ? '- ' : '+ ' }}{{ abs($c) }}x {{ $d < 0 ? '- ' : '+ ' }}{{ abs($d) }} = 0</p>
                                <p class="mt-2">{{$lang['g_f']}} : b²c² - 4ac³ - 4b³d - 27a²d² + 18abcd</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}, d={{$d}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">D = ({{$b}})<sup class="text-sm">2</sup> x ({{$c}})<sup class="text-sm">2</sup> - (4) x {{$a}} x ({{$c}})<sup class="text-sm">3</sup> - (4) x ({{$b}})<sup class="text-sm">3</sup> x {{$d}} - 27 x ({{$a}})<sup class="text-sm">2</sup> x ({{$d}})<sup class="text-sm">2</sup> + (18) x {{$a}} x {{$b}} x {{$c}} x {{$d}}</p>
                                <p class="mt-2">D = {{pow($b, 2)}} x {{pow($c, 2)}} - 4 x {{$a}} x {{pow($c, 3)}} - 4x{{pow($b, 3)}} x {{$d}} - 27 x {{pow($a, 2)}} x {{pow($d, 2)}} + 18 x {{$a}} x {{$b}} x {{$c}} x {{$d}}</p>
                                <p class="mt-2">D = ({{pow($b, 2)*pow($c, 2)}}) - ({{4*$a*pow($c, 3)}}) - ({{4*pow($b, 3)*$d}}) - ({{27*pow($a, 2)*pow($d, 2)}}) + ({{18*$a*$b*$c*$d}})</p>
                                <p class="mt-2">D = {{$detail['sd']}}</p>
                            </div>
                        @else
                            @php $a=$value4; $b=$value3; $c=$value2; $d=$value1; $e=$value; @endphp
                            <div class="w-full text-base">
                                <p class="mt-2">Equation: {{ $a }}x⁴ {{ $b < 0 ? '- ' : '+ ' }}{{ abs($b) }}x³ {{ $c < 0 ? '- ' : '+ ' }}{{ abs($c) }}x² {{ $d < 0 ? '- ' : '+ ' }}{{ abs($d) }}x {{ $e < 0 ? '- ' : '+ ' }}{{ abs($e) }} = 0</p>
                                <p class="mt-2">{{$lang['g_f']}} : 256a³e³ - 192a²bde²-128a²c²e² + 144a²cd²e -27a²d⁴ + 144ab²ce² - 6ab²d²e - 80abc²de +18abcd³ + 16ac⁴e - 4ac³d² - 27b⁴e² +18b³cde - 4b³d³ - 4b²c³e + b²c²d²</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}, d={{$d}}, e={{$e}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">D = 256 x ({{$a}})<sup>3</sup> x ({{$e}})<sup>3</sup> - (192) x ({{$a}})<sup>2</sup> x {{$b}} x {{$d}} x ({{$e}})<sup>2</sup> - (128) x ({{$a}})<sup>2</sup> x ({{$c}})<sup>2</sup> x ({{$e}})<sup>2</sup> + (144) x ({{$a}})<sup>2</sup> x {{$c}} x ({{$d}})<sup>2</sup> x {{$e}} - (27) x ({{$a}})<sup>2</sup> x ({{$d}})<sup>4</sup> + (144) x {{$a}} x ({{$b}})<sup>2</sup> x {{$c}} x ({{$e}})<sup>2</sup> - (6) x {{$a}} x ({{$b}})<sup>2</sup> x ({{$d}})<sup>2</sup> x {{$e}} - (80) x {{$a}} x {{$b}} x ({{$c}})<sup>2</sup> x {{$d}} x {{$e}} + (18) x {{$a}} x {{$b}} x {{$c}} x ({{$d}})<sup>3</sup> + (16) x {{$a}} x ({{$c}})<sup>4</sup> x {{$e}} - (4) x {{$a}} x ({{$c}})<sup>3</sup> x ({{$d}})<sup>2</sup> - (27) x ({{$b}})<sup>4</sup> x ({{$e}})<sup>2</sup> + (18) x ({{$b}})<sup>3</sup> x {{$c}} x {{$d}} x {{$e}} - (4) x ({{$b}})<sup>3</sup> x ({{$d}})<sup>3</sup> - (4) x ({{$b}})<sup>2</sup> x ({{$c}})<sup>3</sup> x {{$e}} + ({{$b}})<sup>2</sup> x ({{$c}})<sup>2</sup> x ({{$d}})<sup>2</sup></p>
                                <p class="mt-2">D = {{$detail['sd']}}</p>
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
