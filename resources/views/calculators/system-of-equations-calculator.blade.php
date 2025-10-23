<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php $request = request();@endphp
                <div class="col-span-12">
                    <label for="operations" class="text-[14px] text-blue"><?= $lang['1'] ?></label>
                    <div class="w-full py-2">
                        <select name="operations" class="input" id="operations" aria-label="select">
                            <option value="1">{{$lang[2]}}</option>
                            <option value="2" {{ isset($request->operations) && $request->operations == '2' ? 'selected' : '' }}>{{$lang[3]}}</option>
                        </select>
                    </div>
                </div>
                <p class="col-span-12 text-center mt-2 text-[14px] {{ isset($request->operations) && $request->operations == '2' ? 'hidden' : '' }}" id="math_1">
                    \( 
                        \begin{cases}
                            \text{$a_1x + b_1y = k_1$}\\
                            \text{$a_2x + b_2y = k_2$}\\
                        \end{cases} 
                    \)
                </p>
                <p class="col-span-12 text-center mt-2 text-[14px] {{ isset($request->operations) && $request->operations == '2' ? '' : 'hidden' }}" id="math_2">
                    \( 
                        \begin{cases}
                            \text{$a_1x + b_1y + c_1z = k_1$}\\
                            \text{$a_2x + b_2y + c_2z = k_2$}\\
                            \text{$a_3x + b_3y + c_3z = k_3$}\\
                        \end{cases} 
                    \)
                </p>
                <div class="col-span-12 {{ isset($request->operations) && $request->operations == '2' ? 'hidden' : '' }} twoInput">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-4">
                            <label for="a1_f" class="text-[14px] text-blue">a<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="a1_f" id="a1_f" class="input" aria-label="input" value="{{ isset($request->a1_f) ? $request->a1_f : '1' }}" />
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="b1_f" class="text-[14px] text-blue">b<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="b1_f" id="b1_f" class="input" aria-label="input" value="{{ isset($request->b1_f) ? $request->b1_f : '3' }}" />
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="k1_f" class="text-[14px] text-blue">k<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="k1_f" id="k1_f" class="input" aria-label="input" value="{{ isset($request->k1_f) ? $request->k1_f : '5' }}" />
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="a2_f" class="text-[14px] text-blue">a<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="a2_f" id="a2_f" class="input" aria-label="input" value="{{ isset($request->a2_f) ? $request->a2_f : '7' }}" />
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="b2_f" class="text-[14px] text-blue">b<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="b2_f" id="b2_f" class="input" aria-label="input" value="{{ isset($request->b2_f) ? $request->b2_f : '9' }}" />
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="k2_f" class="text-[14px] text-blue">k<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="k2_f" id="k2_f" class="input" aria-label="input" value="{{ isset($request->k2_f) ? $request->k2_f : '11' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 {{ isset($request->operations) && $request->operations == '2' ? '' : 'hidden' }} threeInput">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-3">
                            <label for="a1_s" class="text-[14px] text-blue">a<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="a1_s" id="a1_s" class="input" aria-label="input" value="{{ isset($request->a1_s) ? $request->a1_s : '1' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="b1_s" class="text-[14px] text-blue">b<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="b1_s" id="b1_s" class="input" aria-label="input" value="{{ isset($request->b1_s) ? $request->b1_s : '2' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="c1_s" class="text-[14px] text-blue">c<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="c1_s" id="c1_s" class="input" aria-label="input" value="{{ isset($request->c1_s) ? $request->c1_s : '3' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="k1_s" class="text-[14px] text-blue">k<sub class="font-s-12 text-blue">1</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="k1_s" id="k1_s" class="input" aria-label="input" value="{{ isset($request->k1_s) ? $request->k1_s : '4' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="a2_s" class="text-[14px] text-blue">a<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="a2_s" id="a2_s" class="input" aria-label="input" value="{{ isset($request->a2_s) ? $request->a2_s : '5' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="b2_s" class="text-[14px] text-blue">b<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="b2_s" id="b2_s" class="input" aria-label="input" value="{{ isset($request->b2_s) ? $request->b2_s : '6' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="c2_s" class="text-[14px] text-blue">c<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="c2_s" id="c2_s" class="input" aria-label="input" value="{{ isset($request->c2_s) ? $request->c2_s : '7' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="k2_s" class="text-[14px] text-blue">k<sub class="font-s-12 text-blue">2</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="k2_s" id="k2_s" class="input" aria-label="input" value="{{ isset($request->k2_s) ? $request->k2_s : '12' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="a3_s" class="text-[14px] text-blue">a<sub class="font-s-12 text-blue">3</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="a3_s" id="a3_s" class="input" aria-label="input" value="{{ isset($request->a3_s) ? $request->a3_s : '15' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="b3_s" class="text-[14px] text-blue">b<sub class="font-s-12 text-blue">3</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="b3_s" id="b3_s" class="input" aria-label="input" value="{{ isset($request->b3_s) ? $request->b3_s : '17' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="c3_s" class="text-[14px] text-blue">c<sub class="font-s-12 text-blue">3</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="c3_s" id="c3_s" class="input" aria-label="input" value="{{ isset($request->c3_s) ? $request->c3_s : '25' }}" />
                            </div>
                        </div>
                        <div class="col-span-3">
                            <label for="k3_s" class="text-[14px] text-blue">k<sub class="font-s-12 text-blue">3</sub>:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="k3_s" id="k3_s" class="input" aria-label="input" value="{{ isset($request->k3_s) ? $request->k3_s : '2' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="method" class="text-[14px] text-blue">Method</label>
                    <div class="w-full py-2">
                        <select name="method" class="input" id="method" aria-label="select">
                            <option value="1">Gauss-Jordan Elimination</option>
                            <option value="2" {{ isset($request->method) && $request->method == '2' ? 'selected' : '' }}>Inverse Matrix Method</option>
                            <option value="3" {{ isset($request->method) && $request->method == '3' ? 'selected' : '' }}>Cramer's Rule</option>
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
                <div class="w-full mt-3">
                    <div class="w-full">
                        @php
                            $operations= $request->operations;
                            $method= $request->method;
                            $a1_f= $request->a1_f;
                            $b1_f= $request->b1_f;
                            $k1_f= $request->k1_f;
                            $a2_f= $request->a2_f;
                            $b2_f= $request->b2_f;
                            $k2_f= $request->k2_f;
                            $a1_s= $request->a1_s;
                            $b1_s= $request->b1_s;
                            $c1_s= $request->c1_s;
                            $k1_s= $request->k1_s;
                            $a2_s= $request->a2_s;
                            $b2_s= $request->b2_s;
                            $c2_s= $request->c2_s;
                            $k2_s= $request->k2_s;
                            $a3_s= $request->a3_s;
                            $b3_s= $request->b3_s;
                            $c3_s= $request->c3_s;
                            $k3_s= $request->k3_s;
                        @endphp
                        @if($operations==1)
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>x =</strong></td>
                                        <td class="py-2 border-b"><?=$detail['x']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>y =</strong></td>
                                        <td class="py-2 border-b"><?=$detail['y']?></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="mt-3"><strong><?=$lang[5]?></strong></p>
                            @if($method==1)
                                <p class="mt-3"><?=$lang[6]?> \( \begin{cases} <?=((!empty($a1_f)?$a1_f.'x':''))?> <?=((!empty($b1_f)?'+ ('.$b1_f.')y':''))?> = <?=((!empty($k1_f)?$k1_f:0))?> \\ <?=((!empty($a2_f)?$a2_f.'x':''))?> <?=((!empty($b2_f)?'+ ('.$b2_f.')y':''))?> = <?=((!empty($k2_f)?$k2_f:0))?>\end{cases} \) for \(x,y\) <?=$lang[7]?> Gauss-Jordan Elimination method.</p>
                                <p class="mt-3"><?=$lang[8]?>: \( \left[
                                \begin{array}{cc|c}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?> & <?=((!empty($k1_f)?$k1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?> & <?=((!empty($k2_f)?$k2_f:0))?>\\\end{array}\right] \)</p>
                                <p class="mt-3">Apply Gauss-Jordan Elimination method: (<?=$lang[9]?> <a href="https://technical-calculator.com/gaussian-elimination-calculator/" class="text-blue-500 underline" target="_blank">Gaussian Elimination Calculator</a>)</p>
                                <p class="mt-3">\( \left[
                                \begin{array}{cc|c}<?=$detail['a1_f']?> & <?=$detail['b1_f']?> & <?=$detail['k1_f']?>\\<?=$detail['n1']?> & <?=round($detail['n2'],4)?> & <?=round($detail['n3'],4)?>\\\end{array}\right] \)</p>
                                <p class="mt-3">Now substitute:</p>
                                <p class="mt-3">\( y = \dfrac{<?=round($detail['n3'],4)?>}{<?=round($detail['n2'],4)?>} = <?=$detail['y']?> \) </p>
                                <p class="mt-3">\( x = \dfrac{<?=$detail['k1_f']?> - (<?=$detail['b1_f']?>)(<?=round($detail['y'],4)?>)}{<?=$detail['a1_f']?>} = <?=$detail['x']?> \)</p>
                            @elseif($method==2)
                                <p class="mt-3"><?=$lang[6]?> \(\begin{cases} <?=((!empty($a1_f)?$a1_f.'x':''))?> <?=((!empty($b1_f)?'+ ('.$b1_f.')y':''))?> = <?=((!empty($k1_f)?$k1_f:0))?> \\ <?=((!empty($a2_f)?$a2_f.'x':''))?> <?=((!empty($b2_f)?'+ ('.$b2_f.')y':''))?> = <?=((!empty($k2_f)?$k2_f:0))?>\end{cases}\) for \(x,y\) <?=$lang[7]?> inverse matrix method.</p>
                                <p class="mt-3"><?=$lang[8]?>: \(
                                \begin{bmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{bmatrix} \begin{bmatrix}x\\y\\\end{bmatrix} = \begin{bmatrix}<?=$k1_f?>\\<?=$k2_f?>\\\end{bmatrix}\)</p>
                                <p class="mt-3"><?=$lang[11]?>: \(
                                \begin{bmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{bmatrix}^1 \begin{bmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{bmatrix} \begin{bmatrix}x\\y\\\end{bmatrix} = \begin{bmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{bmatrix}^1 \begin{bmatrix}<?=$k1_f?>\\<?=$k2_f?>\\\end{bmatrix}\)</p>
                                <p class="mt-3">Rewrite equestion: \( \begin{bmatrix}x\\y\\\end{bmatrix} = \begin{bmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{bmatrix}^1 \begin{bmatrix}<?=$k1_f?>\\<?=$k2_f?>\\\end{bmatrix}\)</p>
                                <p class="mt-3"><?=$lang[13]?>: \( \begin{bmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{bmatrix}^1 = \begin{bmatrix}<?=round($detail['inv'][0][0],4)?> & <?=round($detail['inv'][0][1],4)?>\\<?=round($detail['inv'][1][0],4)?> & <?=round($detail['inv'][1][1],4)?>\\\end{bmatrix}\) (<?=$lang[9]?> <a href="https://technical-calculator.com/inverse-matrix-calculator/" class="text-blue-500 underline" target="_blank">Inverse Matrix Calculator</a>)</p>
                                <p class="mt-3"><?=$lang[12]?>: \( \begin{bmatrix}x\\y\\\end{bmatrix} = \begin{bmatrix}<?=round($detail['inv'][0][0],4)?> & <?=round($detail['inv'][0][1],4)?>\\<?=round($detail['inv'][1][0],4)?> & <?=round($detail['inv'][1][1],4)?>\\\end{bmatrix} \begin{bmatrix}<?=$k1_f?>\\<?=$k2_f?>\\\end{bmatrix} = \begin{bmatrix}<?=$detail['x']?>\\<?=$detail['y']?>\\\end{bmatrix}\) (<?=$lang[9]?> <a href="https://technical-calculator.com/matrix-multiplication-calculator/" class="text-blue-500 underline" target="_blank">Matrix Multiplication Calculator</a>)</p>
                            @elseif($method==3)
                                <p class="mt-3"><?=$lang[6]?> \( \begin{cases} <?=$a1_f?> x + <?=$b1_f?> y = <?=$k1_f?> \\ <?=$a2_f?> x + <?=$b2_f?> y = <?=$k2_f?> \end{cases} \) for \(x,y\) <?=$lang[7]?> Cramer's rule.</p>
                                <p class="mt-3"><?=$lang[8]?>: \( \left[
                                    \begin{array}{cc|c}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?> & <?=$k1_f?>\\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?> & <?=$k2_f?>\\\end{array}\right] \)</p>
                                <p class="mt-3"><?=$lang[10]?> (<?=$lang[9]?> <a href="https://technical-calculator.com/determinant-calculator/" class="text-blue-500 underline" target="_blank">Determinant Calculator</a>)\( D = \begin{vmatrix}<?=((!empty($a1_f)?$a1_f:0))?> & <?=((!empty($b1_f)?$b1_f:0))?> \\<?=((!empty($a2_f)?$a2_f:0))?> & <?=((!empty($b2_f)?$b2_f:0))?>\\\end{vmatrix} = <?=$detail['det1']?>\)</p>
                                <p class="mt-3">Substitute the x-column with the Right Hand Side (RHS) \( D_x = \begin{vmatrix}<?=$k1_f?> & <?=$b1_f?> \\<?=$k2_f?> & <?=$b2_f?>\\\end{vmatrix} = <?=$detail['det2']?> \)</p>
                                <p class="mt-3">Substitute the y-column with the Right Hand Side (RHS) \( D_y = \begin{vmatrix}<?=$a1_f?> & <?=$k1_f?> \\<?=$a2_f?> & <?=$k2_f?>\\\end{vmatrix} = <?=$detail['det3']?> \)</p>
                                <p class="mt-3"><?=$lang[12]?>:</p>
                                <p class="mt-3">\( x = \dfrac{D_x}{D} = \dfrac{<?=$detail['det2']?>}{<?=$detail['det1']?>} = <?=$detail['x']?> \)</p>
                                <p class="mt-3">\( y = \dfrac{D_y}{D} = \dfrac{<?=$detail['det3']?>}{<?=$detail['det1']?>} = <?=$detail['y']?> \)</p>
                            @endif
                            <p class="mt-3">\( x = <?=$detail['x']?>\)</p>
                            <p class="mt-3">\( y = <?=$detail['y']?>\)</p>
                        @else
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>x =</strong></td>
                                        <td class="py-2 border-b"><?=round($detail['x'], 3)?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>y =</strong></td>
                                        <td class="py-2 border-b"><?=round($detail['y'], 3)?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>z =</strong></td>
                                        <td class="py-2 border-b"><?=round($detail['z'], 3)?></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="mt-3"><strong><?=$lang[5]?></strong></p>
                            @if($method==1)
                                <p class="mt-3"><?=$lang[6]?> \( \begin{cases} <?=((!empty($a1_s)?$a1_s.'x':''))?> <?=((!empty($b1_s)?'+ ('.$b1_s.')y':''))?> <?=((!empty($c1_s)?'+ ('.$c1_s.')z':''))?> = <?=$k1_s?> \\ <?=((!empty($a2_s)?$a2_s.'x':''))?> <?=((!empty($b2_s)?'+ ('.$b2_s.')y':''))?> <?=((!empty($c2_s)?'+ ('.$c2_s.')z':''))?> = <?=$k2_s?> \\ <?=((!empty($a3_s)?$a3_s.'x':''))?> <?=((!empty($b3_s)?'+ ('.$b3_s.')y':''))?> <?=((!empty($c3_s)?'+ ('.$c3_s.')z':''))?> = <?=$k3_s?> \end{cases}\) for \(x,y,z\) <?=$lang[7]?> Gauss-Jordan Elimination method.</p>
                                <p class="mt-3"><?=$lang[8]?>: \( \left[
                                \begin{array}{ccc|c}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?> & <?=$k1_s?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?> & <?=$k2_s?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?> & <?=$k3_s?>\\\end{array}\right]\)</p>
                                <p class="mt-3">Apply Gauss-Jordan Elimination method: (<?=$lang[9]?> <a href="https://technical-calculator.com/gaussian-elimination-calculator/" class="text-blue-500 underline" target="_blank">Gaussian Elimination Calculator</a>)\( \left[
                                \begin{array}{ccc|c}1 & 0 & 0 & <?=round($detail['x'],5)?>\\0 & 1 & 0 & <?=round($detail['y'],5)?>\\0 & 0 & 1 & <?=round($detail['z'],5)?>\\\end{array}\right]\)</p>
                            @elseif($method==2)
                                <p class="mt-3"><?=$lang[6]?> \( \begin{cases} <?=((!empty($a1_s)?$a1_s.'x':''))?> <?=((!empty($b1_s)?'+ ('.$b1_s.')y':''))?> <?=((!empty($c1_s)?'+ ('.$c1_s.')z':''))?> = <?=$k1_s?> \\ <?=((!empty($a2_s)?$a2_s.'x':''))?> <?=((!empty($b2_s)?'+ ('.$b2_s.')y':''))?> <?=((!empty($c2_s)?'+ ('.$c2_s.')z':''))?> = <?=$k2_s?> \\ <?=((!empty($a3_s)?$a3_s.'x':''))?> <?=((!empty($b3_s)?'+ ('.$b3_s.')y':''))?> <?=((!empty($c3_s)?'+ ('.$c3_s.')z':''))?> = <?=$k3_s?> \end{cases}\) for \(x,y,z\) <?=$lang[7]?> inverse matrix method.</p>
                                <p class="mt-3"><?=$lang[8]?>: \(
                                \begin{bmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{bmatrix} \begin{bmatrix}x\\y\\z\\\end{bmatrix} = \begin{bmatrix}<?=((!empty($k1_s)?$k1_s:0))?>\\<?=((!empty($k2_s)?$k2_s:0))?>\\<?=((!empty($k3_s)?$k3_s:0))?>\\\end{bmatrix}\)</p>
                                <p class="mt-3"><?=$lang[11]?>: \(
                                \begin{bmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{bmatrix}^1 \begin{bmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{bmatrix}  \begin{bmatrix}x\\y\\z\\\end{bmatrix} = \begin{bmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{bmatrix}^1 \begin{bmatrix}<?=((!empty($k1_s)?$k1_s:0))?>\\<?=((!empty($k2_s)?$k2_s:0))?>\\<?=((!empty($k3_s)?$k3_s:0))?>\\\end{bmatrix} \)</p>
                                <p class="mt-3">Rewrite equestion: \( \begin{bmatrix}x\\y\\z\\\end{bmatrix} = \begin{bmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{bmatrix} ^1 \begin{bmatrix}<?=((!empty($k1_s)?$k1_s:0))?>\\<?=((!empty($k2_s)?$k2_s:0))?>\\<?=((!empty($k3_s)?$k3_s:0))?>\\\end{bmatrix}\)</p>
                                <p class="mt-3"><?=$lang[13]?>: \( \begin{bmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{bmatrix} ^1 = \begin{bmatrix}<?=round($detail['inv'][0][0],4)?> & <?=round($detail['inv'][0][1],4)?> & <?=round($detail['inv'][0][2],4)?>\\<?=round($detail['inv'][1][0],4)?> & <?=round($detail['inv'][1][1],4)?> & <?=round($detail['inv'][1][2],4)?>\\<?=round($detail['inv'][2][0],4)?> & <?=round($detail['inv'][2][1],4)?> & <?=round($detail['inv'][2][2],4)?>\\\end{bmatrix}\) (<?=$lang[9]?> <a href="https://technical-calculator.com/inverse-matrix-calculator/" class="text-blue-500 underline" target="_blank">Inverse Matrix Calculator</a>)</p>
                                <p class="mt-3"><?=$lang[12]?>: \( \begin{bmatrix}x\\y\\z\\\end{bmatrix} = \begin{bmatrix}<?=round($detail['inv'][0][0],4)?> & <?=round($detail['inv'][0][1],4)?> & <?=round($detail['inv'][0][2],4)?>\\<?=round($detail['inv'][1][0],4)?> & <?=round($detail['inv'][1][1],4)?> & <?=round($detail['inv'][1][2],4)?>\\<?=round($detail['inv'][2][0],4)?> & <?=round($detail['inv'][2][1],4)?> & <?=round($detail['inv'][2][2],4)?>\\\end{bmatrix} \begin{bmatrix}<?=((!empty($k1_s)?$b3_s:0))?>\\<?=((!empty($k2_s)?$k2_s:0))?>\\<?=((!empty($k3_s)?$k3_s:0))?>\\\end{bmatrix} = \begin{bmatrix}<?=$detail['x']?>\\<?=$detail['y']?>\\<?=$detail['z']?>\\\end{bmatrix}\) (<?=$lang[9]?> <a href="https://technical-calculator.com/matrix-multiplication-calculator/" class="text-blue-500 underline" target="_blank">Matrix Multiplication Calculator</a>)</p>
                            @elseif($method==3)
                                <p class="mt-3"><?=$lang[6]?> \( \begin{cases} <?=((!empty($a1_s)?$a1_s.'x':''))?> <?=((!empty($b1_s)?'+ ('.$b1_s.')y':''))?> <?=((!empty($c1_s)?'+ ('.$c1_s.')z':''))?> = <?=$k1_s?> \\ <?=((!empty($a2_s)?$a2_s.'x':''))?> <?=((!empty($b2_s)?'+ ('.$b2_s.')y':''))?> <?=((!empty($c2_s)?'+ ('.$c2_s.')z':''))?> = <?=$k2_s?> \\ <?=((!empty($a3_s)?$a3_s.'x':''))?> <?=((!empty($b3_s)?'+ ('.$b3_s.')y':''))?> <?=((!empty($c3_s)?'+ ('.$c3_s.')z':''))?> = <?=$k3_s?> \end{cases}\) for \(x,y,z\) <?=$lang[7]?> Cramer's rule.</p>
                                <p class="mt-3"><?=$lang[8]?>: \( \left[
                                \begin{array}{ccc|c}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?> & <?=$k1_s?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?> & <?=$k2_s?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?> & <?=$k3_s?>\\\end{array}\right] \)</p>
                                <p class="mt-3"><?=$lang[10]?> (<?=$lang[9]?> <a href="https://technical-calculator.com/determinant-calculator/" class="text-blue-500 underline" target="_blank">Determinant Calculator</a>) \( D = \begin{vmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{vmatrix} = <?=$detail['det1']?> \)</p>
                                <p class="mt-3">Substitute the x-column with the Right Hand Side (RHS) \( D_x = \begin{vmatrix}<?=((!empty($k1_s)?$k1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($k2_s)?$k2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($k3_s)?$k3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{vmatrix} = <?=$detail['det2']?>\)</p>
                                <p class="mt-3">Substitute the y-column with the Right Hand Side (RHS) \( D_y = \begin{vmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($k1_s)?$k1_s:0))?> & <?=((!empty($c1_s)?$c1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($k2_s)?$k2_s:0))?> & <?=((!empty($c2_s)?$c2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($k3_s)?$k3_s:0))?> & <?=((!empty($c3_s)?$c3_s:0))?>\\\end{vmatrix} = <?=$detail['det3']?>\)</p>
                                <p class="mt-3">Substitute the z-column with the Right Hand Side (RHS) \( D_z = \begin{vmatrix}<?=((!empty($a1_s)?$a1_s:0))?> & <?=((!empty($b1_s)?$b1_s:0))?> & <?=((!empty($k1_s)?$k1_s:0))?>\\<?=((!empty($a2_s)?$a2_s:0))?> & <?=((!empty($b2_s)?$b2_s:0))?> & <?=((!empty($k2_s)?$k2_s:0))?>\\<?=((!empty($a3_s)?$a3_s:0))?> & <?=((!empty($b3_s)?$b3_s:0))?> & <?=((!empty($k3_s)?$k3_s:0))?>\\\end{vmatrix} = <?=$detail['det4']?>\)</p>
                                <p class="mt-3"><?=$lang[12]?>:</p>
                                <p class="mt-3">\( x = \dfrac{D_x}{D} = \dfrac{<?=$detail['det2']?>}{<?=$detail['det1']?>} = <?=$detail['x']?>\)</p>
                                <p class="mt-3">\( y = \dfrac{D_y}{D} = \dfrac{<?=$detail['det3']?>}{<?=$detail['det1']?>} = <?=$detail['y']?>\)</p>
                                <p class="mt-3">\( z = \dfrac{D_z}{D} = \dfrac{<?=$detail['det4']?>}{<?=$detail['det1']?>} = <?=$detail['z']?>\)</p>
                            @endif  
                            <p class="mt-3">\( x = <?=$detail['x']?>\)</p>
                            <p class="mt-3">\( y = <?=$detail['y']?>\)</p>  
                            <p class="mt-3">\( z = <?=$detail['z']?>\)</p>  
                        @endif
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
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                var r = this.value;
                if (r === "1"){
                    ['#math_1', '.twoInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#math_2', '.threeInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(r === "2"){
                    ['#math_1', '.twoInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['#math_2', '.threeInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
