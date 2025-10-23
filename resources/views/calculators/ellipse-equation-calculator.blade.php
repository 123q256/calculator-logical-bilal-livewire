<style>
img{
    object-fit: contain;
}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-12">
                <label for="selection" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <select name="selection" class="input" id="selection" aria-label="select">
                        <option value="1">{{$lang['2']}}</option>
                        <option value="2" {{ isset($request->selection) && $request->selection=='2'?'selected':'' }}>{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 text-[18px] text-center">
                <p class="{{ isset($request->selection) && $request->selection === '2' ? 'hidden' : '' }} equation">\( Ax^2+Bx^2=C \)</p>
                <p class="{{ isset($request->selection) && $request->selection === '2' ? '' : 'hidden' }} equation1">\( \frac{(x-c1)^2}{a^2} + \frac{(y-c2)^2}{b^2} = 1 \)</p>
            </div>
            <div class="{{ isset($request->selection) && $request->selection === '2' ? 'col-span-6' : 'col-span-4' }} aValue">
                <label for="d1" class="label" id="alpha">{{ isset($request->selection) && $request->selection === '2' ? 'a' : 'A' }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="d1" id="d1" class="input" aria-label="input" value="{{ isset($request->d1)?$request->d1:'3' }}" />
                </div>
            </div>
            <div class="{{ isset($request->selection) && $request->selection === '2' ? 'col-span-6' : 'col-span-4' }} bValue">
                <label for="second_value" class="label" id="beta">{{ isset($request->selection) && $request->selection === '2' ? 'b' : 'B' }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="second_value" id="second_value" class="input" aria-label="input" value="{{ isset($request->second_value)?$request->second_value:'6' }}" />
                </div>
            </div>
            <div class="col-span-4 {{ isset($request->selection) && $request->selection === '2' ? 'hidden' : '' }} cValue">
                <label for="n2" class="label">C:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="n2" id="n2" class="input" aria-label="input" value="{{ isset($request->n2)?$request->n2:'8' }}" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($request->selection) && $request->selection === '2' ? '' : 'hidden' }} c1">
                <label for="c1" class="label">c1:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="c1" id="c1" class="input" aria-label="input" value="{{ isset($request->c1)?$request->c1:'4' }}" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($request->selection) && $request->selection === '2' ? '' : 'hidden' }} c2">
                <label for="c2" class="label">c2:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="c2" id="c2" class="input" aria-label="input" value="{{ isset($request->c2)?$request->c2:'4' }}" />
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
                    <div class="w-full overflow-auto">
                        @php
                            $d1= $request->d1;
                            $n2= $request->n2;
                            $second_value= $request->second_value;
                            $c1= $request->c1;
                            $c2= $request->c2;
                            $selection= $request->selection;
                            $method=$detail['method'];
                        @endphp
                        @if($detail['method'] === "1")
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong><?=$lang['4']?></strong></p>
                                <p class="mt-3">\(\dfrac{(x-0)^2}{ \dfrac{<?php echo $detail['upr']; ?>}{<?php echo ($detail['btm']); ?>} } + \dfrac{(y-0)^2}{\dfrac{<?php echo $detail['upr1']; ?>}{<?php echo ($detail['btm1']); ?>}} = 1\)</p>
                                <div class="print">
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['5']?></strong></p>
                                </div>
                                <?php
                                    $x =$detail['upr'];
                                    $y =$detail['upr1'];
                                    if ($x > $y) {
                                        $temp = $x;
                                        $x = $y;
                                        $y = $temp;
                                    }
                                    for($i = 1; $i < ($x+1); $i++) {
                                        if ($x%$i == 0 && $y%$i == 0)
                                        $gcd = $i;
                                    }
                                    $lcm = ($x*$y)/$gcd;
                                ?>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['3']?>:</strong></p>
                                <div class="col-12 mt-3 standard_form"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['6']?>:</strong></p>
                                <p class="mt-3">\(\dfrac{<?php echo $detail['btm']; ?>x^2}{<?php echo ($detail['upr']); ?>} + \dfrac{<?php echo $detail['btm1']; ?>y^2}{<?php echo ($detail['upr1']); ?>}=1 \)</p>
                                <p class="mt-3 font-s18"><strong><?=$lang['2']?>:</strong></p>
                                <?php $calculate_lcm=$lcm/$detail['upr'] ?>
                                <?php $calculate_lcm2=$lcm/$detail['upr1'] ?>
                                <p class="mt-3">\(<?php echo $calculate_lcm*$detail['btm'] ?>{x^2}+<?php echo $calculate_lcm2*$detail['btm1'];?>{y^2}-<?php echo $lcm ?>= 0 \) </p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['7']?> c</strong></p>
                                <div class="col-12 mt-3 linear_eccentricity"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['8']?> c</strong></p>
                                <div class="col-12 mt-3 eccentricity"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['9']?>:</strong></p>
                                <div class="col-12 mt-3 first_vertex"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['10']?>:</strong></p>
                                <div class="col-12 mt-3 second_vertex"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['11']?>:</strong></p>
                                <div class="col-12 mt-3 first_co_vertex"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['12']?>:</strong></p>
                                <div class="col-12 mt-3 second_co_vertex"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['13']?>:</strong></p>
                                <div class="col-12 mt-3 first_focus"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['14']?>:</strong></p>
                                <div class="col-12 mt-3 second_focus"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['15']?></strong></p>
                                <div class="col-12 mt-3 area"></div>
                                {{-- <p class="mt-3"><?php echo $detail['area']; ?></p> --}}
                                <p class="mt-3 text-[18px]"><strong><?=$lang['16']?></strong></p>
                                <p class="mt-3"><strong>\( \left[\begin{array}{ccc}h-a,h+a\\\end{array}\right] =\)</strong></p>
                                <div class="col-12 mt-3 domain"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['17']?></strong></p>
                                <p class="mt-3">
                                    \( \left[
                                        \begin{array}{ccc}
                                        k-b,k+b\\
                                        \end{array}
                                        \right] =
                                    \)
                                </p>
                                <div class="col-12 mt-3 range"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['18']?></strong></p>
                                <p class="mt-3">(0,0)</p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['19']?></strong></p>
                                <div class="col-12 mt-3 major_axis"></div>
                                {{-- <p class="mt-3"><?php echo $detail['major_axis']; ?></p> --}}
                                <p class="mt-3 text-[18px]"><strong><?=$lang['20']?></strong></p>
                                <div class="col-12 mt-3 semi_major_axis"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['21']?></strong></p>
                                <div class="col-12 mt-3 minor_axis"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['22']?></strong></p>
                                <div class="col-12 mt-3 semi_minor_axis"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['23']?>: </strong></p>
                                <div class="col-12 mt-3 first_latus_rectum"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['24']?>: </strong></p>
                                <div class="col-12 mt-3 second_latus_rectum"></div>
                                <p class="mt-3 text-[18px]"><strong>x-<?=$lang['25']?>:</strong></p>
                                <div class="col-12 mt-3 x-intercepts"></div>
                                <p class="mt-3 text-[18px]"><strong>y-<?=$lang['25']?>:</strong></p>
                                <div class="col-12 mt-3 y-intercepts"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['26']?>:</strong></p>
                                <div class="col-12 mt-3 circumference"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['27']?>:</strong></p>
                                <div class="col-12 mt-3 first_directix"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['28']?>:</strong></p>
                                <div class="col-12 mt-3 second_directix"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['29']?>:</strong></p>
                                <div class="col-12 mt-3 focal_parameter"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['30']?>:</strong></p>
                                <div class="col-12 mt-3 latera_recta"></div>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['31']?>:</strong></p>
                                <div id="box1" class="col-lg-8 mx-auto mt-4" style="height: 500px;"></div>
                            </div>
                        @else
                            <div class="w-full text-[16px]">
                                @if($detail['d1']>=$detail['c2'])
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['32']?></strong></p>
                                    <p class="mt-3">\(=\dfrac{2b^2}{a}\)</p>
                                    <p class="mt-3">\(=\dfrac{2*<?php echo $detail['c2']?>*<?php echo $detail['c2']?>}{<?php echo $detail['d1']; ?>}\)</p>
                                    <p class="mt-3">\(=<?php echo (2*$detail['c2']*$detail['c2'])/($detail['d1']) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['7']?></strong></p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut a^2-b^2}\)</p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut <?php echo $detail['d1']*$detail['d1'] ?> -<?php echo $detail['c2']*$detail['c2'] ?>} \)</p>
                                    <p class="mt-3">=<?php echo $detail['calculate_eccentricity'];?></p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['8']?></strong></p>
                                    <p class="mt-3">\(=\dfrac{\sqrt{\mathstrut a^2-b^2}}{a} \)</p>
                                    <p class="mt-3">\(=\dfrac{\sqrt{\mathstrut <?php echo $detail['d1']*$detail['d1'] ?> -<?php echo $detail['c2']*$detail['c2'] ?>}}{<?php echo $detail['d1'] ?>} \)</p>
                                    <p class="mt-3">\(=<?php echo sqrt(($detail['d1'])*$detail['d1']-($detail['c2']*$detail['c2'])) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['19']?></strong></p>
                                    <p class="mt-3">\(<?php echo 2*$detail['d1']; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['20']?></strong></p>
                                    <p class="mt-3">\(<?php echo (2*$detail['d1'])/2; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['21']?></strong></p>
                                    <p class="mt-3">\(<?php echo 2*$detail['c2']; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['22']?></strong></p>
                                    <p class="mt-3">\(<?php echo (2*$detail['c2'])/2; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['16']?></strong></p>
                                    <p class="mt-3">\(\Bigg(-<?php echo $detail['d1'] ?>,<?php echo $detail['d1'] ?>\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['17']?></strong></p>
                                    <p class="mt-3">\(\Bigg(-<?php echo $detail['c2'] ?>,<?php echo $detail['c2'] ?>\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong>x-<?=$lang['25']?></strong></p>
                                    <p class="mt-3">\(\Bigg(-<?php echo $detail['d1'] ?>,0\Bigg) \Bigg(<?php echo $detail['d1'] ?>,0\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong>y-<?=$lang['25']?></strong></p>
                                    <p class="mt-3">\(\Bigg(0,-<?php echo $detail['c2'] ?>\Bigg) \Bigg(0,<?php echo $detail['c2'] ?>\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['23']?> y=</strong></p>
                                    <p class="mt-3">\(=-<?php echo sqrt(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1'])) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['24']?> y=</strong></p>
                                    <p class="mt-3">\(=<?php echo sqrt(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1'])) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['13']?> F1</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                    <p class="mt-3"><?php echo $detail['center2']; ?></p>
                                    <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                    <p class="mt-3"><?php $wade=sqrt(($detail['d1']*$detail['d1'])-($detail['c2']*$detail['c2']));echo -$wade+$detail['center1'];?></p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['13']?> F2</strong></p> 
                                    <p class="mt-3">Y-<?=$lang['33']?></p>
                                    <p class="mt-3"><?php echo $detail['center2']; ?></p>
                                    <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                    <p class="mt-3">\(\Bigg(\sqrt{\mathstrut a^2-b^2}+c2,c1\Bigg)\)</p>
                                    <p class="mt-3"><?php $wade=sqrt(($detail['d1']*$detail['d1'])-($detail['c2']*$detail['c2']));echo $wade+$detail['center1'];?></p>
                                @else
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['34']?></strong></p>
                                    <p class="mt-3">\(=\dfrac{2b^2}{a}\)</p>
                                    <p class="mt-3">\(=\dfrac{2*<?php echo $detail['d1']?>*<?php echo $detail['d1']?>}{<?php echo $detail['c2']; ?>}\)</p>
                                    <p class="mt-3">\(=<?php echo (2*$detail['d1']*$detail['d1'])/($detail['c2']) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['7']?></strong></p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut b^2-a^2}\)</p>
                                    <p class="mt-3">\(=\sqrt{\mathstrut <?php echo $detail['c2']*$detail['c2'] ?> -<?php echo $detail['d1']*$detail['d1'] ?>} \)</p>
                                    <p class="mt-3">\(=<?php echo sqrt(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1'])) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['8']?></strong></p>
                                    <p class="mt-3">\(=\dfrac{\sqrt{\mathstrut b^2-a^2}}{b} \)</p>
                                    <p class="mt-3">=<?php echo $detail['calculate_eccentricity'];?></p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['19']?></strong></p>
                                    <p class="mt-3">\(<?php echo 2*$detail['c2']; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['20']?></strong></p>
                                    <p class="mt-3">\(<?php echo (2*$detail['c2'])/2; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['21']?></strong></p>
                                    <p class="mt-3">\(<?php echo 2*$detail['d1']; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['22']?></strong></p>
                                    <p class="mt-3">\(<?php echo (2*$detail['d1'])/2; ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['16']?></strong></p>
                                    <p class="mt-3">\(\Bigg(-<?php echo $detail['d1'] ?>,<?php echo $detail['d1'] ?>\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['17']?></strong></p>
                                    <p class="mt-3">\(\Bigg(-<?php echo $detail['c2'] ?>,<?php echo $detail['c2'] ?>\Bigg)\)</p>
                                    <p class="mt-3 text-[18px]"><strong>x-<?=$lang['25']?></strong></p>
                                    <p class="mt-3">\(\Bigg(-<?php echo $detail['d1'] ?>,0\Bigg) \Bigg(<?php echo $detail['d1'] ?>,0\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong>y-<?=$lang['25']?></strong></p>
                                    <p class="mt-3">\(\Bigg(0,-<?php echo $detail['c2'] ?>\Bigg) \Bigg(0,<?php echo $detail['c2'] ?>\Bigg) \)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['23']?> y=</strong></p>
                                    <p class="mt-3">\(=-<?php echo sqrt(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1'])) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['24']?> y=</strong></p>
                                    <p class="mt-3">\(=<?php echo sqrt(($detail['c2'])*$detail['c2']-($detail['d1']*$detail['d1'])) ?>\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['13']?> F1</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                    <p class="mt-3"><?php echo $detail['center1']; ?></p>
                                    <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                    <p class="mt-3"><?php $wade=sqrt(($detail['c2']*$detail['c2'])-($detail['d1']*$detail['d1']));echo -$wade+$detail['center2'];?></p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['13']?> F2</strong></p>
                                    <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                    <p class="mt-3"><?php echo $detail['center1']; ?></p>
                                    <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                    <p class="mt-3"><?php $wade=sqrt(($detail['c2']*$detail['c2'])-($detail['d1']*$detail['d1']));echo $wade+$detail['center2'];?></p>
                                @endif
                                <p class="mt-3 text-[18px]"><strong><?=$lang['15']?></strong></p>
                                <p class="mt-3">\(=πab \)</p>
                                <p class="mt-3">\(=π*<?php echo $detail['d1']?>*<?php echo $detail['c2']; ?> \)</p>
                                <p class="mt-3">=<?php echo $detail['area'];?></p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['35']?></strong></p>
                                <?php $first_pass=3.14*($detail['d1']+$detail['c2']); ?>
                                <p class="mt-3">=<?php echo $first_pass ;?></p>      
                                <p class="mt-3 text-[18px]"><strong><?=$lang['18']?></strong></p>
                                <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['center1'] ?></p>
                                <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['center2'] ?></p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['36']?> V1 (<?=$lang['37']?>)</strong></p>
                                <p class="mt-3">\(\Bigg(-a+c1,c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo -$detail['d1']+$detail['center1']; ?></p>
                                <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['center2']; ?></p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['36']?> V2 (<?=$lang['37']?>)</strong></p>
                                <p class="mt-3">\(\Bigg(a+c1,c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['d1']+$detail['center1']; ?></p>
                                <p class="mt-3 fonts-18"><strong>Y-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['center2']; ?></p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['36']?> V3 (<?=$lang['38']?>)</strong></p>
                                <p class="mt-3">\(\Bigg(c1,-b+c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['center1']; ?></p>
                                <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo -$detail['c2']+$detail['center2']; ?></p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['36']?> V4 (<?=$lang['38']?>)</strong></p>
                                <p class="mt-3">\(\Bigg(c1,-b+c2\Bigg)\)</p>
                                <p class="mt-3 text-[18px]"><strong>X-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['center1']; ?></p>
                                <p class="mt-3 text-[18px]"><strong>Y-<?=$lang['33']?></strong></p>
                                <p class="mt-3"><?php echo $detail['c2']+$detail['center2']; ?></p>
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
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
             document.getElementById('selection').addEventListener('change', function() {
                var findValue = this.value
                switch (findValue) {
                    case '1':
                        document.getElementById('alpha').textContent = "A";
                        document.getElementById('beta').textContent = "B";
                        ['.aValue', '.bValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('col-span-6');
                                element.classList.add('col-span-4');
                            });
                        });
                        ['.cValue', '.equation'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['.equation1', '.c1', '.c2'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        break;
                    case '2':
                        document.getElementById('alpha').textContent = "a";
                        document.getElementById('beta').textContent = "b";
                        ['.aValue', '.bValue'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('col-span-6');
                                element.classList.remove('col-span-4');
                            });
                        });
                        ['.cValue', '.equation'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        ['.equation1', '.c1', '.c2'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        break;
                }
            });
        </script>
        @if(isset($detail) && $method === "1")
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script>
                function simplify_expression(number) {
                    var a = number;
                    var newnum = a;
                    var newtext = '';
                    var checker = 2;
                    while (checker * checker <= newnum) {
                        if (newnum % checker == 0) {
                            newtext = newtext + checker;
                            newnum = newnum / checker;
                            if (newnum != 1 || newnum == 1) {
                                newtext = newtext + ',';
                            }
                        } else {
                            checker++;
                        }
                    }
                    if (newnum != 1 || newnum == 1) {
                        newtext = newtext + newnum;
                    }
                    if (newtext == '' + a) {
                        newtext = a;
                    }
                    var r = [];
                    var r1 = [];
                    var r2 = [];
                    var r3 = [];
                    var r4 = [];
                    r = newtext.split(',');

                    var results = new Array();

                    for (var j = 0; j < r.length; j++) {
                        var key = r[j].toString(); // make it an associative array
                        if (!results[key]) {
                            results[key] = 1
                        } else {
                            results[key] = results[key] + 1;
                        }
                    }
                    var str = ''; // Display the results
                    for (var j in results) {
                        str += '\t' + j + ': ' + '\t' + results[j] + '\n'
                        r1.push(results[j]);
                        r2.push(j);
                    }
                    for (var t = 0; t < r1.length; t++) {
                        if (r1[t] == 1) {
                            var a = r2[t];
                            r4.push(a);
                        } else if (r1[t] == 2) {
                            var a = r2[t];
                            r3.push(a);
                        } else if (r1[t] == 3) {
                            var a = r2[t];
                            r3.push(a);
                            r4.push(a);
                        } else if (r1[t] == 4) {
                            var a = r2[t];
                            var b = a * a;
                            r3.push(b);
                        } else if (r1[t] == 5) {
                            var a = r2[t];
                            var b = a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 6) {
                            var a = r2[t];
                            var b = a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 7) {
                            var a = r2[t];
                            var b = a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 8) {
                            var a = r2[t];
                            var b = a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 9) {
                            var a = r2[t];
                            var b = a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 10) {
                            var a = r2[t];
                            var b = a * a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 11) {
                            var a = r2[t];
                            var b = a * a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 12) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 13) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 14) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 15) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 16) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 17) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 18) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 19) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 20) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a * a * a * a;
                            r3.push(b);
                        } else if (r1[t] == 21) {
                            var a = r2[t];
                            var b = a * a * a * a;
                            r3.push(b);
                            r4.push(a);
                        } else if (r1[t] == 10) {
                            var a = r2[t];
                            var b = a * a * a * a * a * a * a * a * a * a;
                            r3.push(b);
                        }

                        //alert(r1[t]);
                    }

                    var p = 1;
                    var p1 = 1;

                    for (var i = 0; i < r4.length; i++) {
                        p = p * r4[i];
                    }
                    for (var i = 0; i < r3.length; i++) {
                        p1 = p1 * r3[i];
                    }
                    return [p1, p];
                    document.getElementById('res1').value = p1;
                    document.getElementById('res').value = p;
                }
                var w = simplify_expression("<?php echo $detail["upr"] ?>");
                var x = simplify_expression("<?php echo $detail["btm"]; ?>");
                var y = simplify_expression("<?php echo $detail["upr1"]; ?>");
                var z = simplify_expression("<?php echo $detail["btm1"]; ?>");
                var first_simplication = "<?php echo $detail["upr"]; ?>";
                var second_simplication = "<?php echo $detail["btm"]; ?>";
                var third_simplication = "<?php echo $detail["upr1"]; ?>";
                var four_simplication = "<?php echo $detail["btm1"]; ?>";
                var first_value = first_simplication / second_simplication;
                var second_value = third_simplication / four_simplication;
                let n = "<?php echo $detail['btm']; ?>";
                if (Math.ceil(Math.sqrt(n)) ==
                    Math.floor(Math.sqrt(n))) {} else {}
                //Check for Second denomirator
                let n1 = "<?php echo $detail['btm1']; ?>";
                if (Math.ceil(Math.sqrt(n1)) ==
                    Math.floor(Math.sqrt(n1))) {} else {}
                if (w[0] == "1" && w[1] != "1") {
                    let n = "<?php echo $detail['btm']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "}\\Bigg)^2}";
                        $(".print").append("$$a=\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},$$");
                        divide = (Math.sqrt(w[1])) / x[0];
                        value_a = (Math.sqrt(w[1])) / x[0];
                        if (first_value > second_value) {
                            $(".first_vertex").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(" + divide + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{ccc}\\frac{\\sqrt" + w[1] + "}{" + x[0] + "},\\frac{\\sqrt" + w[1] + "}{" + x[0] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + divide + "," + divide + "\\ \\end{array} \\right]$$");
                            $(".major_axis").append("$$2a=\\frac{2\\sqrt" + w[1] + "}{" + x[0] + "}≈" + 2 * divide + "$$");
                            $(".semi_major_axis").append("$$=\\frac{\\sqrt" + w[1] + "}{" + x[0] + "}≈" + divide + "$$");
                            var calculation1 = divide;
                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(" + divide + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + divide + ",0\\Bigg),$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(" + divide + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "},\\frac{\\sqrt" + w[1] + "}{" + x[0] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + divide + "," + divide + "\\ \\end{array} \\right]$$");
                            $(".minor_axis").append("$$2a=\\dfrac{2\\sqrt" + w[1] + "}{" + x[0] + "}≈" + 2 * divide + "$$");
                            $(".semi_minor_axis").append("$$=\\dfrac{\\sqrt" + w[1] + "}{" + x[0] + "}≈" + divide + "$$");
                            var calculation2 = divide;
                        }
                    } else {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "}\\Bigg)^2}";
                        value_a = (Math.sqrt(w[1] * x[1])) / (x[0] * x[1]);
                        $(".print").append("$$a=\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},$$");
                        //Checking for greater value 
                        var tree = (Math.sqrt(w[1] * x[1])) / (x[0] * x[1]);
                        if (first_value > second_value) {
                            $(".first_vertex").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + tree + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(" + tree + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + tree + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(" + tree + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},\\frac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + tree + "," + tree + "\\ \\end{array} \\right]$$");
                            trick = (tree * 2);
                            $(".major_axis").append("$$2a=\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] / 2 + "}≈" + trick + "$$");
                            $(".semi_major_axis").append("$$\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "}≈" + tree + "$$");
                            var calculation1 = divide;
                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + tree + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(" + tree + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + tree + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + tree + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "},\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + tree + "," + tree + "\\ \\end{array} \\right]$$");
                            trick = (tree * 2);
                            $(".minor_axis").append("$$2a=\\dfrac{2\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "}≈" + trick + "$$");
                            $(".semi_minor_axis").append("$$\\dfrac{\\sqrt" + w[1] * x[1] + "}{" + x[0] * x[1] + "}≈" + tree + "$$");
                            var calculation2 = divide;
                        }
                    }
                } else if (w[0] != "1" && w[1] == "1") {
                    var divide = w[0] / x[0];

                    let n = "<?php echo $detail['btm']; ?>";
                    var value_a = w[0] / x[0];
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh = "$$\\dfrac{x^2}{\\Bigg(" + divide + "\\Bigg)^2}$$";
                        //Check for Greater Value
                        if (first_value > second_value) {
                            var divide = w[0] / x[0];
                            $(".print").append("$$a=" + divide + ",$$");
                            $(".first_vertex").append("$$\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(" + divide + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(" + divide + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[\\begin{array}{}-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}\\ \\end{array}\\right]$$");
                            $(".major_axis").append("$$2a=" + divide * 2 + "$$");
                            $(".semi_major_axis").append("$$" + divide + "$$");
                            var calculation1 = divide;
                        } else {
                            var divide = w[0] / x[0];
                            $(".print").append("$$a=" + divide + "$$");
                            $(".first_co_vertex").append("$$\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$(" + divide + ",0)$$");
                            $(".x-intercepts").append("$$\\Bigg(-" + divide + ",0\\Bigg");
                            $(".x_intercepts").append("$$\\Bigg(-" + divide + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[\\begin{array}{}-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}\\ \\end{array}\\right]$$");
                            $(".minor_axis").append("$$2a=" + divide * 2 + "$$");
                            $(".semi_minor_axis").append("$$" + divide + "$$");
                            var calculation2 = divide;
                        }

                    } else {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] * x[0] + "}\\Bigg)^2}";
                        var value_a = (w[0] * (Math.sqrt(x[1]))) / (x[1] * x[0]);
                        $(".print").append("$$a=\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] * x[0] + "},$$");
                        //Check for Greater Value
                        if (first_value > second_value) {
                            var first_vertex = (w[0] * Math.sqrt(x[1])) / x[1];
                            $(".first_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{}\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            $(".major_axis").append("$$2a=\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] / 2 + "}≈" + first_vertex * 2 + "$$");
                            $(".semi_major_axis").append("$$\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "}≈" + first_vertex + "$$");
                            var calculation1 = divide;
                        } else {
                            var first_vertex = (w[0] * Math.sqrt(x[1])) / x[1];
                            $(".first_co_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{}\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "},\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            $(".minor_axis").append("$$2a=\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] / 2 + "}≈" + first_vertex * 2 + "$$");
                            $(".semi_minor_axis").append("$$\\dfrac{" + w[0] + "\\sqrt" + x[1] + "}{" + x[1] + "}≈" + first_vertex + "$$");
                            var calculation2 = first_vertex;
                        }
                    }
                } else if (w[0] == "1" && w[1] == "1") {

                    let n = "<?php echo $detail['btm']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" + w[0] + "}{" + x[0] + "}\\Bigg)^2}";
                        var value_a = w[0] / x[0];
                        $(".print").append("$$a=\\dfrac{" + w[0] + "}{" + x[0] + "},$$");
                        if (first_value > second_value) {
                            first_vertex = w[0] / x[0];
                            $(".first_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            $(".major_axis").append("$$2a=\\dfrac{" + 2 + "*" + w[0] + "}{" + x[0] + "}=" + 2 * (w[0] / x[0]) + "$$");
                            $(".semi_major_axis").append("$$=\\dfrac{" + w[0] + "}{" + x[0] + "}=" + (w[0] / x[0]) + "$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{}\\dfrac{" + w[0] + "}{" + x[0] + "},\\dfrac{" + w[0] + "}{" + x[0] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            var calculation1 = divide;
                        } else {
                            first_vertex = w[0] / x[0];
                            $(".minor_axis").append("$$2a=\\dfrac{" + 2 + "*" + w[0] + "}{" + x[0] + "}=" + 2 * (w[0] / x[0]) + "$$");
                            $(".semi_minor_axis").append("$$=\\dfrac{" + w[0] + "}{" + x[0] + "}=" + (w[0] / x[0]) + "$$");
                            $(".first_co_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "}{" + x[0] + "},0\\Bigg)≈\\Bigg(-" + first_vertex + ",0\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{}\\dfrac{" + w[0] + "}{" + x[0] + "},\\dfrac{" + w[0] + "}{" + x[0] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            var calculation2 = first_vertex;
                        }
                    } else {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "}\\Bigg)^2},";
                        var value_a = (Math.sqrt(x[1])) / (x[0] * x[1]);
                        $(".print").append("$$a=\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "}$$");
                        dividing = ((Math.sqrt(x[1])) / ((x[0] * x[1]) / 2));
                        if (first_value > second_value) {
                            $(".major_axis").append("$$=\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] / 2 + "}≈" + dividing + "$$");
                            $(".semi_major_axis").append("$$=\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "}≈" + dividing / 2 + "$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + dividing + ",0\\Bigg),$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(" + dividing + "\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{}\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + dividing + "," + dividing + "\\ \\end{array} \\right] $$");

                        } else {
                            $(".minor_axis").append("$$=\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] / 2 + "}≈" + dividing + "$$");
                            $(".semi_minor_axis").append("$$=\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "}≈" + dividing / 2 + "$$");
                            $(".first_co_vertex").append("$$=\\Bigg(-\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + dividing / 2 + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$=\\Bigg(\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(" + dividing / 2 + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(-" + dividing + ",0\\Bigg),$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},0\\Bigg)≈\\Bigg(" + dividing + "\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{}\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "},\\dfrac{\\sqrt" + x[1] + "}{" + x[0] * x[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + dividing + "," + dividing + "\\ \\end{array} \\right] $$");
                            var calculation2 = dividing / 2;
                        }
                    }
                } else if (w[0] != "1" && w[1] != "1") {

                    let n = "<?php echo $detail['btm']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + x[0] + "}\\Bigg)},";
                        var zain = (w[0]) * (Math.sqrt(w[1])) / x[0];
                        var value_a = (w[0] * (Math.sqrt(w[1]))) / x[0];
                        $(".print").append("$$a=\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + x[0] + "}");
                        //Check For Greater Value
                        if (first_value > second_value) {
                            $(".first_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈-" + zain + "$$");
                            $(".second_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈" + zain + "$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈-" + zain + ",$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈" + zain + ",$$");
                            $(".domain").append("$$\\left[-\\begin{array}{ccc}\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + x[0] + "},\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + x[0] + "}\\ \\end{array}\\right]$$");
                            $(".domain").append("$$\\left[-\\begin{array}{ccc}" + zain + "," + zain + "\\ \\end{array}\\right]$$");
                            var calculation1 = divide;

                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈\\Bigg(-" + zain + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈\\Bigg(" + zain + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈-" + zain + ",$$");
                            $(".x-intercepts").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + "" + x[0] + "},0\\Bigg)≈" + zain + ",$$");
                            $(".domain").append("$$\\left[-\\begin{array}{ccc}\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + x[0] + "},\\dfrac{" + w[0] + "\\sqrt" + w[1] + "}{" + x[0] + "}\\ \\end{array}\\right]$$");
                            $(".domain").append("$$\\left[-\\begin{array}{ccc}" + zain + "," + zain + "\\ \\end{array}\\right]$$");
                            var calculation2 = zain;
                        }
                    } else {
                        var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}\\Bigg)},";
                        var value_a = (w[0] * Math.sqrt(w[1] * x[1])) / x[1];
                        $(".print").append("$$a=\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}$$");
                        if (first_value > second_value) {
                            var sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}\\Bigg)^2}";
                            calculate_second_vertex = (w[0] * (Math.sqrt(w[1] * x[1]))) / x[1];
                            $(".first_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(-" + calculate_second_vertex + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(" + calculate_second_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈-" + calculate_second_vertex + "$$");
                            $(".x-intercepts").append("$$=\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".domain").append("$$\\left[\\begin{array}{}-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}\\ \\end{array}\\right]≈$$");
                            $(".domain").append("$$\\left[-\\begin{array}{ccc}" + calculate_second_vertex + "," + calculate_second_vertex + "\\ \\end{array}\\right]$$");
                            $(".major_axis").append("$$2a=\\dfrac{" + w[0] * 2 + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}≈" + calculate_second_vertex * 2 + "$$");
                            $(".semi_major_axis").append("$$\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}≈" + calculate_second_vertex + "$$");
                            var calculation1 = calculate_second_vertex;
                        } else {
                            calculate_second_vertex = (w[0] * (Math.sqrt(w[1] * x[1]))) / x[1];
                            $(".second_co_vertex").append("$$\\Bigg(\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(" + calculate_second_vertex + ",0\\Bigg)$$");
                            $(".first_co_vertex").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈\\Bigg(-" + calculate_second_vertex + ",0\\Bigg)$$");
                            $(".x-intercepts").append("$$\\Bigg(-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},0\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".domain").append("$$\\left[\\begin{array}{}-\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "},\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}\\ \\end{array}\\right]≈$$");
                            $(".domain").append("$$\\left[-\\begin{array}{ccc}" + calculate_second_vertex + "," + calculate_second_vertex + "\\ \\end{array}\\right]$$");
                            $(".minor_axis").append("$$2b=\\dfrac{" + w[0] * 2 + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}≈" + calculate_second_vertex * 2 + "$$");
                            $(".semi_minor_axis").append("$$\\dfrac{" + w[0] + "\\sqrt" + w[1] * x[1] + "}{" + x[1] + "}≈" + calculate_second_vertex + "$$")
                        }
                    }
                }
                if (y[0] == "1" && y[1] != "1") {
                    let n = "<?php echo $detail['btm1']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)^2}";
                        $(".print").append("$$,b=\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}$$");
                        $(".standard_form").append("Standard Form");
                        divide = (Math.sqrt(y[1])) / z[0];
                        value_b = (Math.sqrt(y[1])) / z[0];
                        if (second_value > first_value) {
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "},\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + divide + "," + divide + "\\ \\end{array} \\right]$$");
                            $(".major_axis").append("$$2a=\\dfrac{2\\sqrt" + y[1] + "}{" + z[0] + "}≈" + 2 * divide + "$$");
                            $(".semi_major_axis").append("$$=\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}≈" + divide + "$$");
                            var calculation1 = divide;
                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".domain").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "},\\dfrac{\\sqrt" + y[1] + "}{" + z[0] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + divide + "," + divide + "\\ \\end{array} \\right]$$");
                            $(".minor_axis").append("$$2a=\\dfrac{2\\sqrt" + y[1] + "}{" + z[0] + "}≈" + 2 * divide + "$$");
                            $(".semi_minor_axis").append("$$=\\dfrac{2\\sqrt" + y[1] + "}{" + z[0] + "}≈" + divide + "$$");
                            var calculation2 = divide;
                        }
                    } else {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)^2}";
                        value_b = (Math.sqrt(y[1] * z[1])) / (z[0] * z[1]);
                        $(".print").append("$$,b=\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}$$");
                        //Checking for greater value 
                        var tree = (Math.sqrt(y[1] * z[1])) / (z[0] * z[1]);
                        if (second_value > first_value) {
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + tree + ",0\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0," + tree + ",0\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + tree + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0," + tree + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "},\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + tree + "," + tree + "\\ \\end{array} \\right]$$");
                            trick = (tree * 2);
                            $(".major_axis").append("$$2a=\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] / 2 + "}≈" + trick + "$$");
                            $(".semi_major_axis").append("$$\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}≈" + tree + "$$");
                            var calculation1 = tree;
                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + tree + "\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0," + tree + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + tree + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0," + tree + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{ccc}\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "},\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}\\ \\end{array}\\right]≈\\left[-\\begin{array}{ccc}" + tree + "," + tree + "\\ \\end{array} \\right]$$");
                            trick = (tree * 2);
                            $(".minor_axis").append("$$2a=\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] / 2 + "}≈" + trick + "$$");
                            $(".semi_minor_axis").append("$$\\dfrac{\\sqrt" + y[1] * z[1] + "}{" + z[0] * z[1] + "}≈" + tree + "$$");
                            var calculation2 = tree;

                        }
                    }
                } else if (y[0] != "1" && y[1] == "1") {

                    let n = "<?php echo $detail['btm1']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var divide = y[0] / z[0];
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(" + divide + "\\Bigg)^2}";
                        var value_b = y[0] / z[0];
                        //Check for Greater Value
                        if (second_value > first_value) {
                            var divide = y[0] / z[0];
                            $(".print").append("$$,b=" + divide + "$$");
                            $(".first_vertex").append("$$\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-" + divide + "\\Bigg),\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0," + divide + "\\Bigg),\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".range").append("$$\\left[\\begin{array}{}-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "},\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\ \\end{array}\\right]$$");
                            $(".major_axis").append("$$2a=" + divide * 2 + "$$");
                            $(".semi_major_axis").append("$$" + divide + "$$");
                            var calculation1 = divide;
                        } else {
                            var divide = y[0] / z[0];
                            $(".print").append("$$a=" + divide + "$$");
                            $(".first_co_vertex").append("$$\\Bigg(0,-" + divide + "\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-" + divide + "\\Bigg),\\Bigg(0," + divide + "\\Bigg)$$");
                            $(".range").append("$$\\left[\\begin{array}{}-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "},\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\ \\end{array}\\right]$$");
                            $(".minor_axis").append("$$2a=" + divide * 2 + "$$");
                            $(".semi_minor_axis").append("$$" + divide + "$$");
                            var calculation2 = divide;
                        }

                    } else {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] * z[0] + "}\\Bigg)^2}";
                        var value_b = (y[0] * (Math.sqrt(z[1]))) / (z[1] * z[0]);
                        $(".print").append("$$,b=\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] * z[0] + "}$$");
                        //Check for Greater Value
                        if (second_value > first_value) {
                            var first_vertex = (y[0] * Math.sqrt(z[1])) / z[1];
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{}\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "},\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            $(".major_axis").append("$$2a=\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] / 2 + "}≈" + first_vertex * 2 + "$$");
                            $(".semi_major_axis").append("$$\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}≈" + first_vertex + "$$");
                            var calculation1 = first_vertex;
                        } else {
                            var first_vertex = (y[0] * Math.sqrt(z[1])) / z[1];


                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{}\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "},\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            $(".minor_axis").append("$$2a=\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] / 2 + "}≈" + first_vertex * 2 + "$$");
                            $(".semi_minor_axis").append("$$\\dfrac{" + y[0] + "\\sqrt" + z[1] + "}{" + z[1] + "}≈" + first_vertex + "$$");
                            var calculation2 = first_vertex;
                        }
                    }
                } else if (y[0] == "1" && y[1] == "1") {
                    let n = "<?php echo $detail['btm1']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)^2}";
                        var value_b = y[0] / z[0];
                        $(".print").append("$$b=\\dfrac{" + y[0] + "}{" + z[0] + "}$$");
                        if (second_value > first_value) {
                            first_vertex = y[0] / z[0];
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".major_axis").append("$$=\\dfrac{" + 2 * y[0] + "}{" + z[0] * z[1] + "}≈" + (2 * y[0]) / (z[0] * z[1]) + "$$");
                            $(".semi_major_axis").append("$$=\\dfrac{" + z[1] + "}{" + z[0] * z[1] + "}≈" + first_vertex + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{}\\dfrac{" + y[0] + "}{" + z[0] + "},\\dfrac{" + y[0] + "}{" + z[0] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            var calculation1 = first_vertex;

                        } else {
                            first_vertex = y[0] / z[0];
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + ",0\\Bigg)$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0,-" + first_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "}{" + z[0] + "}\\Bigg)≈\\Bigg(0," + first_vertex + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{}\\dfrac{" + y[0] + "}{" + z[0] + "},\\dfrac{" + y[0] + "}{" + z[0] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + first_vertex + "," + first_vertex + "\\ \\end{array} \\right] $$");
                            var calculation2 = first_vertex;
                        }
                    } else {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)^2}";
                        var value_b = (Math.sqrt(z[1])) / (z[0] * z[1]);
                        $(".print").append("$$,b=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}$$");
                        dividing = ((Math.sqrt(z[1])) / ((z[0] * z[1]) / 2));
                        if (second_value > first_value) {
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + dividing + "\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0," + dividing + "\\Bigg)$$");
                            $(".major_axis").append("$$=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] / 2 + "}≈" + dividing + "$$");
                            $(".semi_major_axis").append("$$=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}≈" + dividing / 2 + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0-\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + dividing + ",0\\Bigg),$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0," + dividing + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{}\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "},\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + dividing + "," + dividing + "\\ \\end{array} \\right] $$");
                            var calculation1 = dividing;
                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈-" + dividing / 2 + "$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈" + dividing / 2 + "$$");
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈-" + dividing / 2 + "$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈" + dividing / 2 + "$$");
                            $(".minor_axis").append("$$=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] / 2 + "}≈" + dividing + "$$");
                            $(".semi_minor_axis").append("$$=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}≈" + dividing / 2 + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0,-" + dividing + ",0\\Bigg),$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\Bigg)≈\\Bigg(0" + dividing + "\\Bigg)$$");
                            $(".range").append("$$ \\left[-\\begin{array}{}\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "},\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}\\ \\end{array} \\right] ≈ \\left[-\\begin{array}{}" + dividing + "," + dividing + "\\ \\end{array} \\right] $$");
                            var calculation2 = dividing / 2;
                        }
                    }
                } else if (y[0] != "1" && y[1] != "1") {
                    let n = "<?php echo $detail['btm1']; ?>";
                    if (Math.ceil(Math.sqrt(n)) ==
                        Math.floor(Math.sqrt(n))) {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + z[0] + "}\\Bigg)}";

                        var zain = (y[0]) * (Math.sqrt(y[1])) / z[0];
                        var value_b = (y[0] * (Math.sqrt(y[1]))) / z[0];
                        $(".print").append("$$b=\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + z[0] + "}$$");

                        //Check For Greater Value
                        if (second_value > first_value) {
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈-" + zain + "$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈" + zain + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈-" + zain + ",$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈" + zain + ",$$");
                            $(".range").append("$$\\left[-\\begin{array}{ccc}\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + z[0] + "},\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + z[0] + "}\\ \\end{array}\\right]$$");
                            $(".range").append("$$\\left[-\\begin{array}{ccc}" + zain + "," + zain + "\\ \\end{array}\\right]$$");
                            $(".major_axis").append("$$=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] / 2 + "}≈" + dividing + "$$");
                            $(".semi_major_axis").append("$$=\\dfrac{\\sqrt" + z[1] + "}{" + z[0] * z[1] + "}≈" + dividing / 2 + "$$");
                            var calculation1 = zain;

                        } else {
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈-" + zain + "$$");
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈" + zain + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈-" + zain + ",$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + "" + z[0] + "}\\Bigg)≈" + zain + ",$$");
                            $(".range").append("$$\\left[-\\begin{array}{ccc}\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + z[0] + "},\\dfrac{" + y[0] + "\\sqrt" + y[1] + "}{" + z[0] + "}\\ \\end{array}\\right]$$");
                            $(".range").append("$$\\left[-\\begin{array}{ccc}" + zain + "," + zain + "\\ \\end{array}\\right]$$");
                            var calculation2 = zain;
                        }

                    } else {
                        var sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)}";
                        var value_b = (y[0] * (Math.sqrt(y[1] * z[1]))) / z[1];;
                        $(".print").append("$$b=\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}$$");
                        if (second_value > first_value) {
                            calculate_second_vertex = (y[0] * (Math.sqrt(y[1] * z[1]))) / z[1];
                            $(".second_vertex").append("$$\\Bigg(-0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(-0," + calculate_second_vertex + "\\Bigg)$$");
                            $(".second_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0," + calculate_second_vertex + "\\Bigg)$$");
                            $(".first_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0,-" + calculate_second_vertex + "\\Bigg)$$");
                            $(".first_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈\\Bigg(0," + calculate_second_vertex + "\\Bigg)$$");
                            $(".y-intercepts").append("$$\\Bigg(-0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".y-intercepts").append("$$\\Bigg(-0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".range").append("$$\\left[\\begin{array}{}-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "},\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\ \\end{array}\\right]≈$$");
                            $(".range").append("$$\\left[-\\begin{array}{ccc}" + calculate_second_vertex + "," + calculate_second_vertex + "\\ \\end{array}\\right]$$");
                            $(".major_axis").append("$$2a=\\dfrac{" + y[0] * 2 + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}≈" + calculate_second_vertex * 2 + "$$");
                            $(".semi_major_axis").append("$$\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}≈" + calculate_second_vertex + "$$");
                        } else {
                            calculate_second_vertex = (y[0] * (Math.sqrt(y[1] * z[1]))) / z[1];
                            $(".second_co_vertex").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".first_co_vertex").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0,-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".y-intercepts").append("$$\\Bigg(0,\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\Bigg)≈" + calculate_second_vertex + "$$");
                            $(".range").append("$$\\left[\\begin{array}{}-\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "},\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}\\ \\end{array}\\right]≈$$");
                            $(".range").append("$$\\left[-\\begin{array}{ccc}" + calculate_second_vertex + "," + calculate_second_vertex + "\\ \\end{array}\\right]$$");
                            $(".minor_axis").append("$$2b=\\dfrac{" + y[0] * 2 + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}≈" + calculate_second_vertex * 2 + "$$");
                            $(".semi_minor_axis").append("$$\\dfrac{" + y[0] + "\\sqrt" + y[1] * z[1] + "}{" + z[1] + "}≈" + calculate_second_vertex + "$$");
                        }
                    }
                }
                $(".standard_form").append("$$" + sheikh + "+" + sheikh2 + "=1$$");
                if (first_value > second_value) {
                    var d = ((value_a * value_a) - (value_b * value_b));
                    var eccentricity = Math.sqrt(d) / value_a;
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut a^2-b^2}$$<br>");
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut(" + Math.round(value_a, 5) + ")^{2}" + "-(" + Math.round(value_b, 5) + "})^{2}$$<br>");
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut" + Math.round(value_a, 5) * Math.round(value_a, 2) + "-" + Math.round(value_b, 5) * Math.round(value_b, 5) + "}$$<br>");
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut" + d + "}$$<br>");
                    $(".linear_eccentricity").append("$$≈" + Math.sqrt(d) + "$$");
                    $(".eccentricity").append("$$=\\dfrac{c}{b}$$<br>");
                    $(".eccentricity").append("$$=\\dfrac{" + Math.sqrt(d) + "}{" + value_a + "}$$<br>");
                    $(".eccentricity").append("$$≈" + eccentricity + "$$");
                    $(".first_latus_rectum").append("$$≈-" + Math.sqrt(d) + "$$");
                    $(".second_latus_rectum").append("$$≈-" + Math.sqrt(d) + "$$");
                    $(".first_focus").append("$$\\Bigg(≈-" + Math.sqrt(d) + ",0\\Bigg)$$");
                    $(".second_focus").append("$$\\Bigg(≈" + Math.sqrt(d) + ",0\\Bigg)$$");
                    $(".area").append("$$≈​πab $$<br>");
                    $(".area").append("$$≈​π" + "*" + Math.round(value_a, 5) + "*" + Math.round(value_b, 5) + "$$<br>");
                    $(".area").append("$$≈ " + 3.14 * Math.round(value_a, 5) * Math.round(value_b) + "$$");
                    $(".first_directix").append("$$k-\\dfrac{a^2}{c}$$");
                    $(".first_directix").append("$$≈\\dfrac{" + 0 + "-(" + Math.round(value_a * value_a, 2) + ")^2}{" + eccentricity + "}$$<br>");
                    $(".first_directix").append("$$≈" + (0 - (value_a * value_a)) / Math.sqrt(d) + "$$");
                    $(".second_directix").append("$$k+\\dfrac{a^2}{c}$$");
                    $(".second_directix").append("$$≈\\dfrac{" + 0 + "+(" + Math.round(value_a * value_a, 2) + ")^2}{" + eccentricity + "}$$<br>");
                    $(".second_directix").append("$$≈" + (0 + (value_a * value_a)) / Math.sqrt(d) + "$$");
                    $(".latera_recta").append("$$=\\dfrac{2b^2}{a}$$");
                    $(".latera_recta").append("$$≈\\dfrac{2*(" + Math.round(value_b * value_b, 2) + ")^2}{" + value_a + "}$$<br>");
                    $(".latera_recta").append("$$≈" + (2 * value_b * value_b) / (value_a) + "$$");
                    $(".circumference").append("$$≈4*a*E\\Bigg(\\dfrac{π}{2}|e^2\\Bigg)$$<br>");
                    $(".circumference").append("$$≈" + 4 * value_a * Math.exp(3.14 / 2) + "$$");
                    $(".focal_parameter").append("$$=\\dfrac{b^2}{c}$$");
                    $(".focal_parameter").append("$$=\\dfrac{(" + Math.round(value_b * value_b, 2) + ")^2}{" + eccentricity + "}$$<br>");
                    $(".focal_parameter").append("$$≈" + (Math.round(value_b * value_b)) / Math.sqrt(d) + "$$");
                    var calculation1 = value_a;
                    var calculation2 = value_b;
                } else if (second_value > first_value) {
                    var d = ((value_b * value_b) - (value_a * value_a));
                    var eccentricity = Math.sqrt(d) / value_b;
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut b^2-a^2}$$<br>");
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut(" + Math.round(value_b * value_b) + ")^2-" + Math.round(value_a * value_a) + "}$$<br>");
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut" + value_b * value_b + "-" + value_a * value_a + "}$$<br>");
                    $(".linear_eccentricity").append("$$=\\sqrt{\\mathstrut" + d + "}$$<br>");
                    $(".linear_eccentricity").append("$$≈" + Math.sqrt(d) + "$$");
                    $(".first_focus").append("$$≈\\Bigg(0,-" + Math.sqrt(d) + "\\Bigg)$$");
                    $(".second_focus").append("$$≈\\Bigg(0," + Math.sqrt(d) + "\\Bigg)$$");
                    $(".eccentricity").append("$$=\\dfrac{c^2}{b^2}$$");
                    $(".eccentricity").append("$$=\\dfrac{" + Math.sqrt(d) + "}{" + value_b + "}$$");
                    $(".eccentricity").append("$$≈" + eccentricity + "$$");
                    $(".first_latus_rectum").append("$$≈-" + Math.sqrt(d) + "$$");
                    $(".second_latus_rectum").append("$$≈-" + Math.sqrt(d) + "$$");
                    $(".area").append("$$≈​& πab$$<br>");
                    $(".area").append("$$ ≈​&π" + "*&" + value_a + "*&" + value_b + "$$<br>");
                    $(".area").append("$$ ≈ " + 3.14 * value_a * value_b + "$$");
                    $(".first_directix").append("$$k-\\dfrac{b^2}{c}$$<br>");
                    $(".first_directix").append("$$≈\\dfrac{" + 0 + "-(" + Math.round(value_b * value_b, 2) + ")^2}{" + eccentricity + "}$$");
                    $(".first_directix").append("$$≈" + (0 - (value_b * value_b)) / Math.sqrt(d) + "$$");
                    $(".second_directix").append("$$k+\\dfrac{b^2}{c}$$");
                    $(".second_directix").append("$$≈\\dfrac{" + 0 + "+(" + Math.round(value_b * value_b, 2) + ")^2}{" + eccentricity + "}$$<br>");
                    $(".second_directix").append("$$≈" + (0 + (value_b * value_b)) / Math.sqrt(d) + "$$");
                    $(".latera_recta").append("$$=\\dfrac{2a^2}{b}$$");
                    $(".latera_recta").append("$$≈\\dfrac{2*" + Math.round(value_a, 5) + "*" + Math.round(value_a, 5) + "}{" + Math.round(value_b, 5) + "}$$<br>");
                    $(".latera_recta").append("$$≈" + (2 * value_a * value_a) / (value_b) + "$$");
                    $(".circumference").append("$$≈4*b*E\\Bigg(\\dfrac{π}{2}|e^2\\Bigg)$$");
                    $(".circumference").append("$$≈" + 4 * value_b * Math.exp(3.14 / 2) + "$$");
                    $(".focal_parameter").append("$$=\\dfrac{a^2}{c}$$");
                    $(".focal_parameter").append("$$=\\dfrac{" + value_a + "*" + value_a + "}{" + eccentricity + "}$$<br>");
                    $(".focal_parameter").append("$$≈" + (value_a * value_a) / Math.sqrt(d) + "$$");
                    var calculation1 = value_b;
                    var calculation2 = value_a;
                }
            </script>
        @endif
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/1.2.1/jsxgraph.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/1.2.1/jsxgraphcore.js"></script>
        <script>
        var board = JXG.JSXGraph.initBoard('box1', { boundingbox: [-5, 5, 5, -5], axis: true, showClearTraces: true});
        var f1 = board.create('glider', [calculation1,0, board.defaultAxes.x], {name:"f'"});
        var f2 = board.create('glider', [-calculation1,0, board.defaultAxes.x], {name:"f"});
        var ell = board.create('ellipse', [f1, f2, [0,calculation2]]);
        </script>
    @endpush
</form>