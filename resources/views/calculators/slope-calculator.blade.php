<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
              @if (isset($error))
              <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
             @endif
             <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                  <div class="grid grid-cols-1   gap-4">
                      <div class="space-y-2">
                        <label for="type" class="text-blue">{{ $lang['type'] }}:</label>
                          <select class="input " name="type" id="type" aria-label="input select">
                            <option value="1"
                                {{ isset($_POST['type']) && $_POST['type'] === '1' ? 'selected' : '' }}><?=$lang['1p']?>, <?=$lang['slope']." & ".$lang['distance']?>
                            </option>
                            <option value="2"
                                {{ isset($_POST['type']) && $_POST['type'] === '2' ? 'selected' : 'selected' }}><?=$lang['2p']?></option>
                            <option value="3"
                                {{ isset($_POST['type']) && $_POST['type'] === '3' ? 'selected' : '' }}><?=$lang['1p']?>, <?=$lang['slope']." & X or Y"?></option>
                            <option value="4"
                                {{ isset($_POST['type']) && $_POST['type'] === '4' ? 'selected' : '' }}><?=$lang['1p']?> & <?=$lang['slope']?></option>
                            <option value="line"
                                {{ isset($_POST['type']) && $_POST['type'] === 'line' ? 'selected' : '' }}>{{$lang['line']}}</option>
                        </select>
                      </div>
                  </div>
                  <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-2  gap-4 common">
                    <div class="space-y-2">
                      <label for="x1" class="font-s-14 text-blue">{{ $lang['x1'] }}:</label>
                      <input type="number" name="x1" id="x1" class="input" aria-label="input"
                      value="{{ isset($_POST['x1']) ? $_POST['x1'] : '2' }}" />
                    </div>
                    <div class="space-y-2">
                      <label for="y1" class="font-s-14 text-blue">{{ $lang['y1'] }}:</label>
                      <input type="number" name="y1" id="y1" class="input" aria-label="input"
                      value="{{ isset($_POST['y1']) ? $_POST['y1'] : '3' }}" />
                    </div>

                  </div>
                  <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-2  gap-4 twopoint">
                    <div class="space-y-2">
                      <label for="x2" class="font-s-14 text-blue">{{ $lang['x2'] }}:</label>
                      <input type="number" name="x2" id="x2" class="input" aria-label="input"
                      value="{{ isset($_POST['x2']) ? $_POST['x2'] : '4' }}" />
                    </div>
                    <div class="space-y-2">
                      <label for="y2" class="font-s-14 text-blue">or {{ $lang['y2'] }}:</label>
                      <input type="number" name="y2" id="y2" class="input" aria-label="input"
                      value="{{ isset($_POST['y2']) ? $_POST['y2'] : '5' }}" />
                    </div>

                  </div>
                  <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-2  gap-4  hidden onepoint">
                      <div class="space-y-2">
                        <label for="m" class="font-s-14 text-blue">{{ $lang['slope'] }}:</label>
                        <input type="number" name="m" id="m" class="input" aria-label="input"
                        value="{{ isset($_POST['m']) ? $_POST['m'] : '' }}" placeholder="00" />
                      </div>
                      <div class="space-y-2">
                        <i class="col-1 ps-4 pt-3">or</i>
                        <label for="angle" class="font-s-14 text-blue"><?=$lang['angle']?>°:</label>
                        <input type="number" name="angle" id="angle" class="input" aria-label="input"
                        value="{{ isset($_POST['angle']) ? $_POST['angle'] : '5' }}" />
                      </div>
                      <div class="space-y-2 distance">
                        <label for="dis" class="font-s-14 text-blue"><?=$lang['distance']?>:</label>
                        <input type="number" name="dis" id="dis" class="input" aria-label="input"
                        value="{{ isset($_POST['dis']) ? $_POST['dis'] : '13' }}" />
                      </div>

                  </div>
                  <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  mt-2 gap-4 hidden pline">
                    <div class="space-y-2">
                      <label for="x" class="px-lg-3 font-s-14 text-blue">{{ $lang['enter'] }}:  <i class="ps-2">x</i></label>
                      <input type="number" name="x" id="x" class="input" aria-label="input"
                      value="{{ isset($_POST['x']) ? $_POST['x'] : '3' }}" />
                    
                    </div>
                    <div class="space-y-2">
                      <label for="m" class="font-s-14 text-blue"><i class="ps-2">y</i></label>
                      <input type="number" name="y" class="input" aria-label="input"
                      value="{{ isset($_POST['y']) ? $_POST['y'] : '-9' }}" />
                     
                    </div>
                    <div class="space-y-2">
                      <label for="m" class="font-s-14 text-blue"> <span class="ps-2">=0</span></label>
                      <input type="number" name="b" class="input" aria-label="input"
                      value="{{ isset($_POST['b']) ? $_POST['b'] : '11' }}" />
                     
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
                  <div class="w-full bg-light-blue  p-3 radius-10 mt-3">
                      @php
                          $type = request()->type;
                          $x1=request()->x1;
                          $x2=request()->x2;
                          $y1=request()->y1;
                          $y2=request()->y2;
                          $dis=request()->dis;
                          $m=request()->m;
                          $angle=request()->angle;
                          $x=request()->x;
                          $y=request()->y;
                          $b=request()->b;
                                  @endphp
                      <div class="row font-s-18">
                          <?php if($type=='2'){ ?>
                              <p class="mt-2"><strong><?=$lang['slope']?></strong></p>
                              <p class="mt-2"><strong><?=$detail['slope']?></strong></p>
                              <p class="mt-2"><strong><?=$lang['si']?>: y = mx + b</strong></p>
                              <p class="mt-2"><strong>y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></strong></p>
                              
                              <p class="mt-2 font-s-25 text-blue text-center"><?=$lang['ans']?></p>
          
                              <p class="mt-2 font-s-25 ">Solution:</p>
                              <p class="mt-2 "><strong>Your Input: \(P = (x_1,y_1)\) and \(Q = (x_2,y_2)\) , \(P = (<?=$x1.','.$y1?>)\) and \(Q = (<?=$x2.','.$y2?>)\)</strong></p>
                              <p class="mt-2 ">Formula to find Slope: \[m=\frac{y_2 - y_1}{x_2-x_1}\]</p>
                              <p class="mt-2 ">We have \(x_1=<?=$x1?> , y_1=<?=$y1?>\)  , \(x_2=<?=$x2?> \text{ and } y_2=<?=$y2?>\)</p>
                              <p class="mt-2 ">Plug the given values into the formula for slope:
                                  \[m=\frac{(<?=$y2?>)-(<?=$y1?>)}{(<?=$x2?>)-(<?=$x1?>)} = <?=$detail['slope']?>\]
                              </p>
                              
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                        <tr>
                                          <td class="border-b py-2"><b>Percentage Grade  :</b></td>
                                          <td class="border-b py-2"><?=$detail['slope']*100?> %</td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['angle']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['angle']!='')?$detail['angle']:'0.0 deg')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['distance']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['distance']!='')?$detail['distance']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['x']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['x']!='')?$detail['x']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['y']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['y']!='')?$detail['y']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>X - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=round((-1)*$detail['b']/$detail['slope'],2)?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['b']?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                <div class="col-lg-8" style="float: none;margin:15px auto;">
                                  <div id="box1" class="col s12 padding_0" style="height: 500px;"></div>
                              </div>
                          <?php } ?>
                          <?php if($type=='line'){ ?>
                              <p class="mt-2 font-s-25 text-blue text-center"><?=$lang['ans']?></p>
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['slope']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['slope']!='')?$detail['slope']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Percentage Grade :</b></td>
                                          <td class="border-b py-2"><?=$detail['slope']*100?> %</td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['angle']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['angle']!='')?$detail['angle']:'0.0 deg')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>X - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=round((-1)*$detail['b']/$detail['slope'],2)?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['b']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['si']?>: y = mx + b :</b></td>
                                          <td class="border-b py-2">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                          <?php } ?>
                          <?php if($type=='3'){ ?>
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                          <tr>
                                          <td class="border-b py-2"><b>X₂ :</b></td>
                                          <td class="border-b py-2"><?=$detail['x2']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y₂ :</b></td>
                                          <td class="border-b py-2"><?=$detail['y2']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['x']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['x']!='')?$detail['x']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['y']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['y']!='')?$detail['y']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['slope']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['slope']!='')?$detail['slope']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Percentage Grade :</b></td>
                                          <td class="border-b py-2"><?=$detail['slope']*100?> %</td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['angle']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['angle']!='')?$detail['angle']:'0.0 deg')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['distance']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['distance']!='')?$detail['distance']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>X - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=round((-1)*$detail['b']/$detail['slope'],2)?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['b']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['si']?>: y = mx + b :</b></td>
                                          <td class="border-b py-2">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></td>
                                        </tr>
                                      </tbody>
                                  </table>
                                <div class="col-lg-8">
                                  <div id="box1" class="col s12 padding_0" style="height: 500px;"></div>
                              </div>
                          <?php } ?>
                          <?php if($type=='4'){ ?>
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['slope']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['slope']!='')?$detail['slope']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Percentage Grade :</b></td>
                                          <td class="border-b py-2"><?=$detail['slope']*100?> %</td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['angle']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['angle']!='')?$detail['angle']:'0.0 deg')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>X - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=round((-1)*$detail['b']/$detail['slope'],2)?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['b']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['si']?>: y = mx + b :</b></td>
                                          <td class="border-b py-2">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                          <?php } ?>
                          <?php if($type=='1'){ ?>
                              <p class="mt-2 font-s-25 text-blue text-center">Right Side</p>
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                        <tr>
                                          <td class="border-b py-2"><b>X₂ :</b></td>
                                          <td class="border-b py-2"><?=$detail['x2r']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y₂ :</b></td>
                                          <td class="border-b py-2"><?=$detail['y2r']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['x']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['xr']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['y']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['yr']?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                <div class="col-lg-8">
                                  <div id="box1" class="col s12 padding_0" style="height: 500px;"></div>
                              </div>
                                <p class="mt-2 font-s-25 text-blue text-center">Left Side</p>
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                        <tr>
                                          <td class="border-b py-2"><b>X₂ :</b></td>
                                          <td class="border-b py-2"><?=$detail['x2l']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y₂ :</b></td>
                                          <td class="border-b py-2"><?=$detail['y2l']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['x']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['xl']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['y']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['yl']?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                <div class="col s12 margin_top_15">
                                  <div id="box" class="col s12 padding_0" style="height: 500px;"></div>
                              </div>
                                <p class="col s12 center color_blue font_s25 center">&nbsp;</p>
                        
                                  <table class="w-full md:w[50%] lg:w[50%]">
                                      <tbody >
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['slope']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['slope']!='')?$detail['slope']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Percentage Grade :</b></td>
                                          <td class="border-b py-2"><?=$detail['slope']*100?> %</td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['angle']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['angle']!='')?$detail['angle']:'0.0 deg')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['distance']?> :</b></td>
                                          <td class="border-b py-2"><?=(($detail['distance']!='')?$detail['distance']:'0.0')?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>X - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=round((-1)*$detail['b']/$detail['slope'],2)?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b>Y - <?=$lang['in']?> :</b></td>
                                          <td class="border-b py-2"><?=$detail['b']?></td>
                                        </tr>
                                        <tr>
                                          <td class="border-b py-2"><b><?=$lang['si']?>: y = mx + b :</b></td>
                                          <td class="border-b py-2">y = <?=$detail['slope'].'x'?> <?=(($detail['b']<0)?$detail['b']:"+ ".$detail['b'])?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                          <?php } ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML">
      </script>
        <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
        <script>
            <?php if($type=='2'){
                $x2=(($x2<0)?$x2-10:"-".$x2+10);
                $x1=(($x1<0)?($x1-10)*(-1):$x1+10);
                $y2=(($y2<0)?$y2-10:"-".$y2+10);
                $y1=(($y1<0)?($y1-10)*(-1):$y1+10);
            ?>
            var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [<?=$x2?>, <?=$y1?>, <?=$x1?>, <?=$y2?>], axis:true});
            var p1 = board.create('point', [<?=$x1?>, <?=$y1?>]);
            var p2 = board.create('point', [<?=$x2?>, <?=$y2?>]);
            var l1 = board.create('line', [p1, p2]);
            <?php } ?>
            <?php if($type=='3'){
                $x2=(($detail['x2']<0)?$detail['x2']-10:"-".$detail['x2']+10);
                $x1=(($x1<0)?($x1-10)*(-1):$x1+10);
                $y2=(($detail['y2']<0)?$detail['y2']-10:"-".$detail['y2']+10);
                $y1=(($y1<0)?($y1-10)*(-1):$y1+10);
            ?>
            var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [<?=$x2?>, <?=$y1?>, <?=$x1?>, <?=$y2?>], axis:true});
            var p1 = board.create('point', [<?=$x1?>, <?=$y1?>]);
            var p2 = board.create('point', [<?=$detail['x2']?>, <?=$detail['y2']?>]);
            var l1 = board.create('line', [p1, p2]);
            <?php } ?>
            <?php if($type=='1'){
                $x2=(($detail['x2r']<0)?$detail['x2r']-10:"-".$detail['x2r']+10);
                $x1=(($detail['xr']<0)?($detail['xr']-10)*(-1):$detail['xr']+10);
                $y2=(($detail['y2r']<0)?$detail['y2r']-10:"-".$detail['y2r']+10);
                $y1=(($detail['yr']<0)?($detail['yr']-10)*(-1):$detail['yr']+10);
            ?>
            var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [<?=$x2?>, <?=$y1?>, <?=$x1?>, <?=$y2?>], axis:true});
            var p1 = board.create('point', [<?=$detail['xr']?>, <?=$detail['yr']?>]);
            var p2 = board.create('point', [<?=$detail['x2r']?>, <?=$detail['y2r']?>]);
            var l1 = board.create('line', [p1, p2]);
            <?php 
                $x2=(($detail['x2l']<0)?$detail['x2l']-10:"-".$detail['x2l']+10);
                $x1=(($detail['xl']<0)?($detail['xl']-10)*(-1):$detail['xl']+10);
                $y2=(($detail['y2l']<0)?$detail['y2l']-10:"-".$detail['y2l']+10);
                $y1=(($detail['yl']<0)?($detail['yl']-10)*(-1):$detail['yl']+10);
            ?>
            var board = JXG.JSXGraph.initBoard('box', {boundingbox: [<?=$x2?>, <?=$y1?>, <?=$x1?>, <?=$y2?>], axis:true});
            var p1 = board.create('point', [<?=$detail['xl']?>, <?=$detail['yl']?>]);
            var p2 = board.create('point', [<?=$detail['x2l']?>, <?=$detail['y2r']?>]);
            var l1 = board.create('line', [p1, p2]);
            <?php } ?>
        </script>
    @endisset
</form>

@push('calculatorJS')
<script>
    var elements = {
        'twopoint': document.querySelectorAll('.twopoint'),
        'common': document.querySelectorAll('.common'),
        'onepoint': document.querySelectorAll('.onepoint'),
        'pline': document.querySelectorAll('.pline'),
        'or': document.querySelectorAll('.or'),
        'distance': document.querySelectorAll('.distance')
    };

    var displayFlex = (selector) => {
        elements[selector].forEach((element) => {
            element.style.display = 'flex';
        });
    };

    var displayNone = (selector) => {
        elements[selector].forEach((element) => {
            element.style.display = 'none';
        });
    };

    var displayBlock = (selector) => {
        elements[selector].forEach((element) => {
            element.style.display = 'block';
        });
    };

    @if(isset($detail) || isset($error))
    var type = document.getElementById('type').value;
        if (type === '2') {
            displayFlex('twopoint');
            displayFlex('common');
            displayNone('onepoint');
            displayNone('pline');
            displayNone('or');
        } else if (type === '1') {
            displayNone('twopoint');
            displayFlex('common');
            displayFlex('onepoint');
            displayBlock('distance');
            displayNone('pline');
            displayNone('or');
        } else if (type === 'line') {
            displayNone('twopoint');
            displayNone('common');
            displayNone('onepoint');
            displayFlex('pline');
            displayNone('or');
        } else if (type === '3') {
            displayFlex('twopoint');
            displayFlex('common');
            displayFlex('onepoint');
            displayNone('distance');
            displayNone('pline');
            displayFlex('or');
        } else if (type === '4') {
            displayNone('twopoint');
            displayFlex('common');
            displayFlex('onepoint');
            displayNone('distance');
            displayNone('pline');
        }
    @endif
    document.getElementById('type').addEventListener('change', function() {
        var type = this.value;

        var elements = {
            'twopoint': document.querySelectorAll('.twopoint'),
            'common': document.querySelectorAll('.common'),
            'onepoint': document.querySelectorAll('.onepoint'),
            'pline': document.querySelectorAll('.pline'),
            'or': document.querySelectorAll('.or'),
            'distance': document.querySelectorAll('.distance')
        };

        var displayFlex = (selector) => {
            elements[selector].forEach((element) => {
                element.style.display = 'flex';
            });
        };

        var displayNone = (selector) => {
            elements[selector].forEach((element) => {
                element.style.display = 'none';
            });
        };

        var displayBlock = (selector) => {
            elements[selector].forEach((element) => {
                element.style.display = 'block';
            });
        };

        if (type === '2') {
            displayFlex('twopoint');
            displayFlex('common');
            displayNone('onepoint');
            displayNone('pline');
            displayNone('or');
        } else if (type === '1') {
            displayNone('twopoint');
            displayFlex('common');
            displayFlex('onepoint');
            displayBlock('distance');
            displayNone('pline');
            displayNone('or');
        } else if (type === 'line') {
            displayNone('twopoint');
            displayNone('common');
            displayNone('onepoint');
            displayFlex('pline');
            displayNone('or');
        } else if (type === '3') {
            displayFlex('twopoint');
            displayFlex('common');
            displayFlex('onepoint');
            displayNone('distance');
            displayNone('pline');
            displayFlex('or');
        } else if (type === '4') {
            displayNone('twopoint');
            displayFlex('common');
            displayFlex('onepoint');
            displayNone('distance');
            displayNone('pline');
        }
    });


</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>