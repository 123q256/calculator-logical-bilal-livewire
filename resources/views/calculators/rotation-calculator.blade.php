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
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-6">
                <label for="point_rotate_one" class="font-s-14 text-blue"><?=$lang['1'] ?></label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="point_rotate_one" id="point_rotate_one" class="input" aria-label="input" value="{{ isset($request->point_rotate_one)?$request->point_rotate_one:'1' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="point_rotate_two" class="font-s-14 text-blue">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="point_rotate_two" id="point_rotate_two" class="input" aria-label="input" value="{{ isset($request->point_rotate_two)?$request->point_rotate_two:'2' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="angle" class="font-s-14 text-blue"><?=$lang['2'] ?></label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="angle" id="angle" class="input" aria-label="input" value="{{ isset($request->angle)?$request->angle:'45' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="unit" class="font-s-14 text-blue"><?=$lang['3'] ?></label>
                <div class="w-full py-2">
                    <select name="unit" class="input" id="unit" aria-label="select">
                        <option value="radians">{{$lang['7']}}</option>
                        <option value="degrees" {{ isset($request->unit) && $request->unit=='degrees'?'selected':'' }}>{{$lang['6']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="point_around_one" class="font-s-14 text-blue"><?=$lang['4'] ?></label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="point_around_one" id="point_around_one" class="input" aria-label="input" value="{{ isset($request->point_around_one)?$request->point_around_one:'56' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="point_around_two" class="font-s-14 text-blue">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="point_around_two" id="point_around_two" class="input" aria-label="input" value="{{ isset($request->point_around_two)?$request->point_around_two:'90' }}" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="direction" class="font-s-14 text-blue"><?=$lang['5'] ?></label>
                <div class="w-full py-2">
                    <select name="direction" class="input" id="direction" aria-label="select">
                        <option value="anticlockwise">{{$lang['9']}}</option>
                        <option value="clockwise" {{ isset($request->direction) && $request->direction=='clockwise'?'selected':'' }}>{{$lang['8']}}</option>
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full overflow-auto">
                        @php
                            $point_rotate_one= $request->point_rotate_one;
                            $point_rotate_two= $request->point_rotate_two;
                            $angle= $request->angle;
                            $unit= $request->unit;
                            $point_around_one= $request->point_around_one;
                            $point_around_two= $request->point_around_two;
                            $direction= $request->direction;
                            if($detail['direction']=="anticlockwise" && ($detail['unit']=="radians" || $detail['unit']=="degrees")) {
                                $find_value=round(sin($detail['angle']*(-1)),5);
                                $find_value2=round(cos($detail['angle']*(-1)),5);
                                $find_point_one=($detail['point_around_one']-$detail['point_around_one']*$find_value2)-$detail['point_around_two']*($find_value);
                                $find_point_two=($detail['point_around_two']-$detail['point_around_two']*$find_value2)+$detail['point_around_one']*($find_value);
                            }
                            if($detail['direction']=="clockwise" && ($detail['unit']=="radians" || $detail['unit']=="degrees")) {
                                $find_value=round(sin($detail['angle']*(-1)),5);
                                $find_value2=round(cos($detail['angle']*(-1)),5);
                                $find_point_one=($detail['point_around_one']-$detail['point_around_one']*$find_value2)-$detail['point_around_two']*($find_value);
                                $find_point_two=($detail['point_around_two']-$detail['point_around_two']*$find_value2)+$detail['point_around_one']*($find_value);
                            }
                        @endphp
                        <div class="w-full font-s-16">
                            <p class="mt-3 text-[18px]"><strong><?=$lang['10'];?></strong></p>
                            <p class="mt-3">(<?php echo round($detail['formula_one'],3) ?>,<?php echo round($detail['formula_two'],3); ?>)</p>
                            <?php if(($detail['direction']=="anticlockwise" || $detail['direction']=="clockwise") && ($detail['unit']=="radians" || $detail['unit']=="degrees")){ ?>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['11']?></strong></p>
                                <p class="mt-3">\( =\begin{bmatrix} <?php echo $find_value2; ?> & <?php echo $find_value; ?>\\<?php echo $find_value*(-1) ?> & <?php echo $find_value2; ?>\end{bmatrix} \)</p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['26']?>:</strong></p>
                                <p class="mt-3">\( (x,y) \overset{}\dashrightarrow (<?php echo $find_value2 ?> x+<?php echo $find_value ?> y+<?php echo $find_point_one ?>,<?php echo $find_value ?> x+<?php echo $find_value2; ?> y+<?php echo $find_point_two; ?>) \)</p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['12']?>:</strong></p>
                                <p class="mt-3">\( \begin{bmatrix}  x\\y \end{bmatrix} \overset{}\dashrightarrow \begin{bmatrix}  <?php echo $find_point_one ?>\\<?php echo $find_point_two; ?> \end{bmatrix} + \begin{bmatrix} <?php echo $find_value2; ?> & <?php echo $find_value; ?>\\<?php echo $find_value*(-1) ?> & <?php echo $find_value2; ?>\end{bmatrix} \begin{bmatrix}  x\\y \end{bmatrix} \)</p>
                                <p class="mt-3 text-[18px]"><strong><?=$lang['13'];?></strong></p>
                                <p class="mt-3"><?=$lang['25']?></p>
                                <p class="mt-3"><?=$lang['27']?> (<?php echo $detail['point_rotate_one'] ?>,<?php echo $detail['point_rotate_two']; ?>) <?=$lang['28']?> <?php echo $detail['angle']; ?>\(^0\) <?php echo $detail['direction'] ?> <?=$lang['29']?> (<?php echo $detail['point_around_one'] ?>,<?php echo $detail['point_around_two']; ?>).</p>
                                <p class="mt-3 text-[18px]"><strong>Transformed Point</strong></p>
                                <p class="mt-3"><?=$lang['14']?> (<?php echo $detail['point_rotate_one'] ?>,<?php echo $detail['point_rotate_two']?>) <?=$lang['15']?> (<?php echo $detail['point_rotate_one'] ?>-<?php echo $detail['point_around_one'] ?>),(<?php echo $detail['point_rotate_two'] ?>-<?php echo $detail['point_around_two'] ?>)=(<?php echo $detail['point_rotate_one']-$detail['point_around_one'] ?>,<?php echo $detail['point_rotate_two']-$detail['point_around_two'] ?>),(<?php echo $detail['point_rotate_one'] ?>,<?php echo $detail['point_around_two']; ?>) <?=$lang['15'];?> (<?php echo $detail['point_around_one'] ?>-<?php echo $detail['point_around_one'] ?>,<?php echo $detail['point_around_two'] ?>-<?php echo $detail['point_around_two'] ?>)=(<?php echo $detail['point_rotate_one']-$detail['point_rotate_one'] ?>,<?php echo $detail['point_rotate_two']-$detail['point_rotate_two'] ?>)</p>
                                <p class="mt-3"><?=$lang['16']?> \((x,y)\) <?=$lang['17'];?> \((θ)\) <?=$lang['18']?> \((xcos(θ)−ysin(θ),xsin(θ)+ycos(θ))\).</p>
                                <p class="mt-3"><?=$lang['19']?> x = <?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?> , y = <?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?> <?=$lang['20']?> \(θ\) = <?php echo $detail['angle']; ?>\(^0\)</p>
                                <p class="mt-3"><?=$lang['21'];?> </p>
                                <p class="mt-3">\(=(<?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?>  cos (<?php echo $detail['angle']; ?>^0) - (<?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?>  sin (<?php echo $detail['angle']; ?>^0)),<?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?> sin (<?php echo $detail['angle']; ?>^0) + <?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?> cos (<?php echo $detail['angle']; ?>)^0)\)</p>
                                <p class="mt-3"> \(=(<?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?> (<?php echo round(cos($detail['angle']),3); ?>) - (<?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?> (<?php echo round(sin($detail['angle2']),3); ?>)),<?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?>  (<?php echo round(sin($detail['angle']),3); ?>) + <?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?> (<?php echo round(cos($detail['angle']),3); ?>))\)</p>
                                <p class="mt-3"><?=$lang['22'];?></p>
                                <p class="mt-3">(<?php echo $detail['point_rotate_one'] ?>,<?php echo $detail['point_rotate_two']; ?>)\(\overset{}\dashrightarrow\)(<?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?> (<?php echo round(cos($detail['angle']),3); ?>) - (<?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?> (<?php echo round(sin($detail['angle']),3); ?>))+<?php echo $detail['point_around_one'] ?>,<?php echo $detail['point_rotate_one']-$detail['point_around_one']; ?>  (<?php echo round(sin($detail['angle']),3); ?>) + <?php echo $detail['point_rotate_two']-$detail['point_around_two']; ?> (<?php echo round(cos($detail['angle']),3); ?>)+<?php echo $detail['point_around_two']; ?>)</p>
                                <p class="mt-3">=(<?php echo $detail['formula_one'] ?>,<?php echo $detail['formula_two']; ?>)</p>
                                <?php if($detail['angle']>0){ ?>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['11']?></strong></p>
                                    <p class="mt-3">\(\begin{bmatrix} cos(θ) & -sin(θ) \\ sin(θ) & cos(θ) \end{bmatrix}\)</p>
                                    <p class="mt-3">\(=\begin{bmatrix} cos(<?php echo $detail['angle'] ?>) & -sin(<?php echo $detail['angle'] ?>) \\ sin(<?php echo $detail['angle'] ?>) & cos(<?php echo $detail['angle']; ?>) \end{bmatrix}\)</p>
                                    <p class="mt-3">\(=\begin{bmatrix} <?php echo $find_value2; ?> & <?php echo $find_value; ?>\\<?php echo $find_value*(-1) ?> & <?php echo $find_value2; ?>\end{bmatrix}\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['26']?></strong></p>
                                    <p class="mt-3">\((x,y) \overset{}\dashrightarrow (cos(<?php echo $detail['angle'] ?>)x-ysin(<?php echo $detail['angle'] ?>)+<?php echo $detail['point_around_two'] ?>sin(<?php echo $detail['angle']; ?>)-<?php echo $detail['point_around_two'] ?>cos(<?php echo $detail['angle']; ?>)+<?php echo $detail['point_around_two']; ?>)\)</p>
                                    <p class="mt-3"> \((x,y) \overset{}\dashrightarrow (<?php echo $find_value2 ?> x+<?php echo $find_value ?> y+<?php echo $find_point_one ?>,<?php echo $find_value ?> x+<?php echo $find_value2; ?> y+<?php echo $find_point_two; ?>)\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['12']?>:</strong></p>
                                    <p class="mt-3">\( \begin{bmatrix}  x\\y \end{bmatrix} \overset{}\dashrightarrow \begin{bmatrix}  -2*(<?php echo -$detail['point_around_one']/2?>+<?php  echo $detail['point_around_one']/2;?>*cos(<?php echo $detail['angle']; ?>)-<?php echo $detail['point_around_two']/2; ?>*sin(<?php echo $detail['angle']; ?>))\\-2*(-<?php echo $detail['point_around_two']/2 ?>+<?php echo $detail['point_around_two']/2 ?> cos(<?php echo $detail['angle']; ?>)+<?php echo $detail['point_around_one']/2 ?> sin (<?=$detail['angle']?>)) \end{bmatrix} + \begin{bmatrix} cos(<?php echo $detail['angle'] ?>) & -sin(<?php echo $detail['angle'] ?>) \\ sin(<?php echo $detail['angle'] ?>) & cos(<?php echo $detail['angle']; ?>)\end{bmatrix} \begin{bmatrix}  x\\y \end{bmatrix} \)</p>
                                    <p class="mt-3">\( \begin{bmatrix}  x\\y \end{bmatrix} \overset{}\dashrightarrow \begin{bmatrix}  <?php echo $find_point_one ?>\\<?php echo $find_point_two; ?> \end{bmatrix} + \begin{bmatrix} <?php echo $find_value2; ?> & <?php echo $find_value; ?>\\<?php echo $find_value*(-1) ?> & <?php echo $find_value2; ?>\end{bmatrix} \begin{bmatrix}  x\\y \end{bmatrix} \)</p>
                                <?php }else if($detail['angle']<0){ ?>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['11']?></strong></p>
                                    <p class="mt-3">\( \begin{bmatrix} cos(θ) & sin(θ) \\ -sin(θ) & cos(θ) \end{bmatrix}\)</p>
                                    <p class="mt-3">\(\begin{bmatrix} cos(<?php echo $detail['angle']*(-1) ?>) & sin(<?php echo $detail['angle']*(-1) ?>) \\ -sin(<?php echo $detail['angle']*(-1) ?>) & cos(<?php echo $detail['angle']*(-1) ?>) \end{bmatrix}\)</p>
                                    <p class="mt-3">\(=\begin{bmatrix} <?php echo $find_value2; ?> & <?php echo $find_value; ?>\\<?php echo $find_value*(-1) ?> & <?php echo $find_value2; ?>\end{bmatrix}\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['26']?></strong></p>
                                    <p class="mt-3">\( (x,y) \overset{}\dashrightarrow (cos(<?php echo $detail['angle']*(-1) ?>)x+ysin(<?php echo $detail['angle']*(-1) ?>)-<?php echo $detail['point_around_two'] ?>sin(<?php echo $detail['angle']*(-1); ?>)-<?php echo $detail['point_around_one']; ?>cos(<?php echo $detail['angle']*(-1);  ?>)+<?php echo $detail['point_around_one']; ?>,-sin(<?php echo $detail['angle']*(-1); ?>)x+<?php echo $detail['point_around_one'] ?>sin(<?php echo $detail['angle']*(-1); ?>)+ycos(<?php echo $detail['angle']*(-1); ?>)-<?php echo $detail['point_around_two'] ?>cos(<?php echo $detail['angle']*(-1); ?>)+<?php echo $detail['point_around_two']; ?>) \)</p>
                                    <p class="mt-3"> \((x,y) \overset{}\dashrightarrow (<?php echo $find_value2 ?> x+<?php echo $find_value ?> y+<?php echo $find_point_one ?>,<?php echo $find_value ?> x+<?php echo $find_value2; ?> y+<?php echo $find_point_two; ?>)\)</p>
                                    <p class="mt-3 text-[18px]"><strong><?=$lang['12']?>:</strong></p>
                                    <p class="mt-3">\( \begin{bmatrix}  x\\y \end{bmatrix} \overset{}\dashrightarrow \begin{bmatrix}  -2*(<?php echo $detail['point_around_one']/2 ?>+<?php echo $detail['point_around_one'] ?>     cos(<?php echo $detail['angle']*(-1); ?>)+<?php echo $detail['point_around_two'] ?> sin (<?=$detail['angle']*(-1)?>)) \\-2*(<?php echo $detail['point_around_two'] ?>+<?php echo $detail['point_around_two'] ?>cos(<?php echo $detail['angle']*(-1); ?>)-<?php echo $detail['point_around_one'] ?> sin (<?=$detail['angle']*(-1)?>)) \end{bmatrix} + \begin{bmatrix} cos(<?php echo $detail['angle']*(-1) ?>) & sin(<?php echo $detail['angle']*(-1) ?>) \\ -sin(<?php echo $detail['angle']*(-1) ?>) & cos(<?php echo $detail['angle']*(-1) ?>)\end{bmatrix} \begin{bmatrix}  x\\y \end{bmatrix} \)</p>
                                    <p class="mt-3">\( \begin{bmatrix}  x\\y \end{bmatrix} \overset{}\dashrightarrow \begin{bmatrix}  <?php echo $find_point_one ?>\\<?php echo $find_point_two; ?> \end{bmatrix} + \begin{bmatrix} <?php echo $find_value2; ?> & <?php echo $find_value; ?>\\<?php echo $find_value*(-1) ?> & <?php echo $find_value2; ?>\end{bmatrix} \begin{bmatrix}  x\\y \end{bmatrix} \)</p>
                                <?php }?>
                              <?php } ?> 
                        </div>
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
    @endpush
</form>