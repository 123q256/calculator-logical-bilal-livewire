<div>
<style>
img{
    object-fit: contain;
}
</style>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="selection" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <select name="selection" class="input" id="selection" aria-label="select" wire:model.live="selection">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2">{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 text-[18px] text-center" wire:key="equation-{{ $selection }}" wire:ignore>
                @if($selection === '1')
                    <p class="equation">\( Ax^2+Bx^2=C \)</p>
                @else
                    <p class="equation1">\( \frac{(x-c1)^2}{a^2} + \frac{(y-c2)^2}{b^2} = 1 \)</p>
                @endif
            </div>
            
            <div class="{{ $selection === '2' ? 'col-span-6' : 'col-span-4' }} aValue">
                <label for="d1" class="label" id="alpha">{{ $selection === '2' ? 'a' : 'A' }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="d1" id="d1" class="input" aria-label="input" wire:model.live="d1" />
                </div>
            </div>
            <div class="{{ $selection === '2' ? 'col-span-6' : 'col-span-4' }} bValue">
                <label for="second_value" class="label" id="beta">{{ $selection === '2' ? 'b' : 'B' }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="second_value" id="second_value" class="input" aria-label="input" wire:model.live="second_value" />
                </div>
            </div>
            
            @if($selection === '1')
            <div class="col-span-4 cValue">
                <label for="n2" class="label">C:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="n2" id="n2" class="input" aria-label="input" wire:model.live="n2" />
                </div>
            </div>
            @endif
            
            @if($selection === '2')
            <div class="col-span-6 c1">
                <label for="c1" class="label">c1:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="c1" id="c1" class="input" aria-label="input" wire:model.live="c1" />
                </div>
            </div>
            <div class="col-span-6 c2">
                <label for="c2" class="label">c2:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="c2" id="c2" class="input" aria-label="input" wire:model.live="c2" />
                </div>
            </div>
            @endif
            
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
                    <div class="w-full overflow-auto">
                        @if($detail['method'] === "1")
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['4'] }}</strong></p>
                                <p class="mt-3">\( \dfrac{(x-0)^2}{ \dfrac{ {{ $detail['upr'] }} }{ {{ $detail['btm'] }} } } + \dfrac{(y-0)^2}{\dfrac{ {{ $detail['upr1'] }} }{ {{ $detail['btm1'] }} }} = 1 \)</p>
                                <div class="print">
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['5'] }}</strong></p>
                                    <p class="mt-3"><span>{{ $detail['print_a'] }}</span></p>
                                    <p class="mt-3"><span>{{ $detail['print_b'] }}</span></p>
                                </div>
                                
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['3'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['standard_form'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['6'] }}:</strong></p>
                                <p class="mt-3">\( \dfrac{ {{ $detail['btm'] }} x^2}{ {{ $detail['upr'] }} } + \dfrac{ {{ $detail['btm1'] }} y^2}{ {{ $detail['upr1'] }} }=1 \)</p>
                                <p class="mt-3 font-s18"><strong>{{ $lang['2'] }}:</strong></p>
                                @php
                                    $x = $detail['upr'];
                                    $y = $detail['upr1'];
                                    if ($x > $y) {
                                        $temp = $x;
                                        $x = $y;
                                        $y = $temp;
                                    }
                                    $gcd = 1;
                                    for ($i = 1; $i < ($x + 1); $i++) {
                                        if ($x % $i == 0 && $y % $i == 0) {
                                            $gcd = $i;
                                        }
                                    }
                                    $lcm = ($x * $y) / $gcd;
                                    $calculate_lcm = $lcm / $detail['upr'];
                                    $calculate_lcm2 = $lcm / $detail['upr1'];
                                @endphp
                                <p class="mt-3">\( {{ $calculate_lcm * $detail['btm'] }} {x^2} + {{ $calculate_lcm2 * $detail['btm1'] }} {y^2} - {{ $lcm }} = 0 \)</p>
                                
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['7'] }} c</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['linear_eccentricity'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['8'] }} c</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['eccentricity'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['9'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['first_vertex'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['10'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['second_vertex'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['11'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['first_co_vertex'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['12'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['second_co_vertex'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['13'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['first_focus'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['14'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['second_focus'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['15'] }}</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['area_val'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['16'] }}</strong></p>
                                <p class="mt-3"><strong>\( \left[\begin{array}{ccc}h-a,h+a\\\end{array}\right] =\)</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['domain'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['17'] }}</strong></p>
                                <p class="mt-3">
                                    \( \left[
                                        \begin{array}{ccc}
                                        k-b,k+b\\
                                        \end{array}
                                        \right] =
                                    \)
                                </p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['range'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['18'] }}</strong></p>
                                <p class="mt-3">(0,0)</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['19'] }}</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['major_axis'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['20'] }}</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['semi_major_axis'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['21'] }}</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['minor_axis'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['22'] }}</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['semi_minor_axis'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['23'] }}: </strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['first_latus_rectum'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['24'] }}: </strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['second_latus_rectum'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>x-{{ $lang['25'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['x_intercepts'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>y-{{ $lang['25'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['y_intercepts'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['26'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['circumference'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['27'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['first_directix'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['28'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['second_directix'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['29'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['focal_parameter'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['30'] }}:</strong></p>
                                <div class="col-12 mt-3">
                                    <span>{{ $detail['latera_recta'] }}</span>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['31'] }}:</strong></p>
                                <div wire:ignore>
                                    <div id="box1" class="col-lg-8 mx-auto mt-4" style="height: 500px;"></div>
                                </div>
                            </div>
                        @else
                            <div class="w-full text-[16px]">
                                @if($detail['d1']>=$detail['c2'])
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['32'] }}</strong></p>
                                    <p class="mt-3">\(=\dfrac{2b^2}{a}\)</p>
                                    <p class="mt-3">\(=\dfrac{2*{{ $detail['c2'] }}*{{ $detail['c2'] }} } { {{ $detail['d1'] }} }\)</p>
                                    <p class="mt-3">\(= {{ (2*$detail['c2']*$detail['c2'])/($detail['d1']) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['7'] }}</strong></p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut a^2-b^2}\)</p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut {{ $detail['d1']*$detail['d1'] }} - {{ $detail['c2']*$detail['c2'] }} } \)</p>
                                    <p class="mt-3">={{ $detail['calculate_eccentricity'] }}</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['8'] }}</strong></p>
                                    <p class="mt-3">\(=\dfrac{\sqrt{\mathstrut a^2-b^2}}{a} \)</p>
                                    <p class="mt-3">\(=\dfrac{\sqrt{\mathstrut {{ $detail['d1']*$detail['d1'] }} - {{ $detail['c2']*$detail['c2'] }} } } { {{ $detail['d1'] }} } \)</p>
                                    <p class="mt-3">\(= {{ sqrt(abs(($detail['d1'])*$detail['d1']-($detail['c2']*$detail['c2']))) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['19'] }}</strong></p>
                                    <p class="mt-3">\( {{ 2*$detail['d1'] }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['20'] }}</strong></p>
                                    <p class="mt-3">\( {{ (2*$detail['d1'])/2 }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['21'] }}</strong></p>
                                    <p class="mt-3">\( {{ 2*$detail['c2'] }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['22'] }}</strong></p>
                                    <p class="mt-3">\( {{ (2*$detail['c2'])/2 }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['16'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(-{{ $detail['d1'] }},{{ $detail['d1'] }}\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['17'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(-{{ $detail['c2'] }},{{ $detail['c2'] }}\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong>x-{{ $lang['25'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(-{{ $detail['d1'] }},0\Bigg) \Bigg({{ $detail['d1'] }},0\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong>y-{{ $lang['25'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(0,-{{ $detail['c2'] }}\Bigg) \Bigg(0,{{ $detail['c2'] }}\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['23'] }} y=</strong></p>
                                    <p class="mt-3">\(=-{{ sqrt(abs(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1']))) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['24'] }} y=</strong></p>
                                    <p class="mt-3">\(= {{ sqrt(abs(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1']))) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['13'] }} F1</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">{{ $detail['center2'] }}</p>
                                    <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">
                                        @php $wade=sqrt(abs(($detail['d1']*$detail['d1'])-($detail['c2']*$detail['c2']))); @endphp
                                        {{ -$wade+$detail['center1'] }}
                                    </p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['13'] }} F2</strong></p> 
                                    <p class="mt-3">Y-{{ $lang['33'] }}</p>
                                    <p class="mt-3">{{ $detail['center2'] }}</p>
                                    <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(\sqrt{\mathstrut a^2-b^2}+c2,c1\Bigg)\)</p>
                                    <p class="mt-3">{{ $wade+$detail['center1'] }}</p>
                                @else
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['34'] }}</strong></p>
                                    <p class="mt-3">\(=\dfrac{2b^2}{a}\)</p>
                                    <p class="mt-3">\(=\dfrac{2*{{ $detail['d1'] }}*{{ $detail['d1'] }} } { {{ $detail['c2'] }} }\)</p>
                                    <p class="mt-3">\(= {{ (2*$detail['d1']*$detail['d1'])/($detail['c2']) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['7'] }}</strong></p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut b^2-a^2}\)</p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut {{ $detail['c2']*$detail['c2'] }} - {{ $detail['d1']*$detail['d1'] }} } \)</p>
                                    <p class="mt-3">\(= {{ sqrt(abs(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1']))) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['8'] }}</strong></p>
                                    <p class="mt-3">\(=\dfrac{\sqrt{\mathstrut b^2-a^2}}{b} \)</p>
                                    <p class="mt-3">={{ $detail['calculate_eccentricity'] }}</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['19'] }}</strong></p>
                                    <p class="mt-3">\( {{ 2*$detail['c2'] }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['20'] }}</strong></p>
                                    <p class="mt-3">\( {{ (2*$detail['c2'])/2 }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['21'] }}</strong></p>
                                    <p class="mt-3">\( {{ 2*$detail['d1'] }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['22'] }}</strong></p>
                                    <p class="mt-3">\( {{ (2*$detail['d1'])/2 }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['16'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(-{{ $detail['d1'] }},{{ $detail['d1'] }}\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['17'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(-{{ $detail['c2'] }},{{ $detail['c2'] }}\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong>x-{{ $lang['25'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(-{{ $detail['d1'] }},0\Bigg) \Bigg({{ $detail['d1'] }},0\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong>y-{{ $lang['25'] }}</strong></p>
                                    <p class="mt-3">\(\Bigg(0,-{{ $detail['c2'] }}\Bigg) \Bigg(0,{{ $detail['c2'] }}\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['23'] }} y=</strong></p>
                                    <p class="mt-3">\(=-{{ sqrt(abs(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1']))) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['24'] }} y=</strong></p>
                                    <p class="mt-3">\(= {{ sqrt(abs(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1']))) }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['13'] }} F1</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">{{ $detail['center1'] }}</p>
                                    <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">
                                        @php $wade=sqrt(abs(($detail['c2']*$detail['c2'])-($detail['d1']*$detail['d1']))); @endphp
                                        {{ -$wade+$detail['center2'] }}
                                    </p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['13'] }} F2</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">{{ $detail['center1'] }}</p>
                                    <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                    <p class="mt-3">{{ $wade+$detail['center2'] }}</p>
                                @endif
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['15'] }}</strong></p>
                                <p class="mt-3">\(=πab \)</p>
                                <p class="mt-3">\(=π*{{ $detail['d1'] }}*{{ $detail['c2'] }} \)</p>
                                <p class="mt-3">={{ $detail['area'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['35'] }}</strong></p>
                                @php $first_pass = 3.14 * ($detail['d1'] + $detail['c2']); @endphp
                                <p class="mt-3">={{ $first_pass }}</p>      
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['18'] }}</strong></p>
                                <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['center1'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['center2'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['36'] }} V1 ({{ $lang['37'] }})</strong></p>
                                <p class="mt-3">\(\Bigg(-a+c1,c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ -$detail['d1']+$detail['center1'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['center2'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['36'] }} V2 ({{ $lang['37'] }})</strong></p>
                                <p class="mt-3">\(\Bigg(a+c1,c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['d1']+$detail['center1'] }}</p>
                                <p class="mt-3 fonts-18"><strong>Y-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['center2'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['36'] }} V3 ({{ $lang['38'] }})</strong></p>
                                <p class="mt-3">\(\Bigg(c1,-b+c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['center1'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ -$detail['c2']+$detail['center2'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['36'] }} V4 ({{ $lang['38'] }})</strong></p>
                                <p class="mt-3">\(\Bigg(c1,-b+c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['center1'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>Y-{{ $lang['33'] }}</strong></p>
                                <p class="mt-3">{{ $detail['c2']+$detail['center2'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body); window.MJrerender = function() { renderMathInElement(document.body); }"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/1.2.1/jsxgraph.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/1.2.1/jsxgraphcore.js"></script>
    <script>
        window.MJrerender = function() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        }
        window.drawEllipseGraph = function(calculation1, calculation2) {
            if (typeof JXG === 'undefined') return;
            try {
                var el = document.getElementById('box1');
                if (el) el.innerHTML = '';
                var board = JXG.JSXGraph.initBoard('box1', { boundingbox: [-5, 5, 5, -5], axis: true, showClearTraces: true});
                var f1 = board.create('glider', [parseFloat(calculation1), 0, board.defaultAxes.x], {name:"f'"});
                var f2 = board.create('glider', [-parseFloat(calculation1), 0, board.defaultAxes.x], {name:"f"});
                var ell = board.create('ellipse', [f1, f2, [0, parseFloat(calculation2)]]);
            } catch(e) {
                console.error(e);
            }
        }
        
        document.addEventListener('livewire:initialized', () => {
            if (typeof MJrerender === 'function') MJrerender();
            
            Livewire.hook('morph.updated', (el, component) => {
                setTimeout(() => {
                    if (typeof MJrerender === 'function') MJrerender();
                }, 50);
            });
        });

        document.addEventListener('livewire:navigated', function () {
            if (typeof MJrerender === 'function') MJrerender();
            @if(isset($detail) && isset($detail['calculation1']) && isset($detail['calculation2']))
                window.drawEllipseGraph({{ $detail['calculation1'] }}, {{ $detail['calculation2'] }});
            @endif
        });
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof MJrerender === 'function') MJrerender();
            @if(isset($detail) && isset($detail['calculation1']) && isset($detail['calculation2']))
                window.drawEllipseGraph({{ $detail['calculation1'] }}, {{ $detail['calculation2'] }});
            @endif
        });
    </script>
    @endpush
</form>
</div>
