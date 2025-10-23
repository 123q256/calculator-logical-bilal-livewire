<style>
  img{object-fit: contain;}
</style>
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
                <label for="selection" class="font-s-14 text-blue"><?= $lang['1'] ?>:</label>
                <div class="w-full py-2">
                    <select name="selection" class="input" id="selection" aria-label="select">
                        <option value="1">{{$lang['2']."(r)"}}</option>
                        <option value="2" {{ isset($request->selection) && $request->selection == '2' ? 'selected' : '' }}>{{$lang['3']."(d)"}}</option>
                        <option value="3" {{ isset($request->selection) && $request->selection == '3' ? 'selected' : '' }}>{{$lang['4']. "(a)"}}</option>
                        <option value="4" {{ isset($request->selection) && $request->selection == '4' ? 'selected' : '' }}>{{$lang['5']."(p)"}}</option>
                        <option value="6" {{ isset($request->selection) && $request->selection == '6' ? 'selected' : '' }}>{{$lang['6']."(A)"}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="radius" class="font-s-14 text-blue rad">
                    @if(isset($request->selection) && $request->selection == '2')
                        <?=$lang['3']?> (d):
                    @elseif(isset($request->selection) && $request->selection == '3')
                        <?=$lang['4']?> (a):
                    @elseif(isset($request->selection) && $request->selection == '4')
                        <?=$lang['5']?> (p):
                    @elseif(isset($request->selection) && $request->selection == '6')
                        <?=$lang['6']?> (A):
                    @else
                        Radius (r):
                    @endif
                </label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="radius" id="radius" class="input" aria-label="input" value="{{ isset($request->radius) ? $request->radius : '7' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="pi" class="font-s-14 text-blue"><?=$lang['7']?> π = :</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="pi" id="pi" class="input" aria-label="input" value="{{ isset($request->pi) ? $request->pi : '3.1415926535898' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="units" class="font-s-14 text-blue"><?=$lang['8']?>:</label>
                <div class="w-full py-2">
                    <select name="units" class="input" id="units" aria-label="select">
                        <option value="cm">cm</option>
                        <option value="m" {{ isset($request->units) && $request->units == 'm' ? 'selected' : '' }}>m</option>
                        <option value="in" {{ isset($request->units) && $request->units == 'in' ? 'selected' : '' }}>in</option>
                        <option value="ft" {{ isset($request->units) && $request->units == 'ft' ? 'selected' : '' }}>ft</option>
                        <option value="yd" {{ isset($request->units) && $request->units == 'yd' ? 'selected' : '' }}>yd</option>
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
                              if($detail['unit']=="cm"){
                              $assign="cm<sup class='font-s-14'>2</sup>";
                              } else if($detail['unit']=="m"){
                              $assign="m<sup class='font-s-14'>2</sup>";
                              } else if($detail['unit']=="mm"){
                              $assign="mm<sup class='font-s-14'>2</sup>";
                              } else if($detail['unit']=="ft"){
                              $assign="ft<sup class='font-s-14'>2</sup>";
                              } else if($detail['unit']=="yd"){
                              $assign="yd<sup class='font-s-14'>2</sup>";
                              }
                          @endphp
                          <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                              <table class="w-full font-s-18">
                                  <tr>
                                      <td class="py-2 border-b" width="60%"><strong><?=$lang['2']?> (r)</strong></td>
                                      <td class="py-2 border-b"><?=$detail['radius']?> {{$detail['unit']}}</td>
                                  </tr>
                                  <tr>
                                      <td class="py-2 border-b" width="60%"><strong><?=$lang['3']?> (d)</strong></td>
                                      <td class="py-2 border-b"><?=$detail['diameter']?> {{$detail['unit']}}</td>
                                  </tr>
                                  <tr>
                                      <td class="py-2 border-b" width="60%"><strong><?=$lang['4']?> (a)</strong></td>
                                      <td class="py-2 border-b"><?=$detail['arc_length']?> {{$detail['unit']}}</td>
                                  </tr>
                                  <tr>
                                      <td class="py-2 border-b" width="60%"><strong><?=$lang['5']?> (p)</strong></td>
                                      <td class="py-2 border-b"><?=$detail['perimeter']?> {{$detail['unit']}}</td>
                                  </tr>
                                  <tr>
                                      <td class="py-2 border-b" width="60%"><strong><?=$lang['6']?> (a)</strong></td>
                                      <td class="py-2 border-b"><?=$detail['area']?> {!!$assign!!}</td>
                                  </tr>
                              </table>
                          </div>
                          <div class="w-full text-[16px]">
                              <p class="mt-3"><strong><?=$lang['14']?></strong></p>
                              <?php if($detail['selection']=="1"){
                                  ?>
                                      <p class="mt-3">\( \textbf{<?=$lang['3']?>} \, (d) = 2r \)</p>
                                      <p class="mt-3">\( d = 2 \times <?php echo $detail['radius']; ?> \)</p>
                                      <p class="mt-3">
                                        \( d = <?=round($detail['radius']*2,3)?>\)
                                      </p>
                                      <p class="mt-3">\( \textbf{<?=$lang['4']?>} \,(a) = \pi r \)</p>
                                      <p class="mt-3">\( a = \pi\times 7 \)</p>
                                      <p class="mt-3">\( a = <?php echo round($detail['arc_length'],3)?> \)</p>
                                      <p class="mt-3">\( 
                                        \textbf{<?=$lang['6']?>} \, (A) = \dfrac{\pi \times r^2}{2} \)</p>
                                      <p class="mt-3">\( A = \dfrac{\pi \times <?php echo round($detail['radius'],3) ?>^2}{2} \)</p>
                                      <p class="mt-3">\( A = <?php  echo round($detail['pi']*$detail['radius']*$detail['radius']/2,3) ?> \)</p>
                                      <p class="mt-3">\( \textbf{<?=$lang['5']?> (p)} = πr + 2r \,\) </p>
                                      <p class="mt-3">\( p = <?php echo $detail['radius']; ?>\pi + 2 \times <?php echo $detail['radius'] ?> \)</p>
                                      <p class="mt-3">
                                          \( p = <?=$detail['perimeter'] ?>\)
                                      </p>
                                  <?php } ?>
                                  <?php if($detail['selection']=="2"){
                                  ?>
                                      <p class="mt-3">
                                        \( \textbf{<?=$lang['2']?>} \, (r) = \dfrac{d}{2}\)
                                      </p>
                                      <p class="mt-3">
                                        \( r = \dfrac{<?php echo round($detail['diameter'],3); ?>}{2}\)
                                      </p>
                                      <p class="mt-3">
                                        \( r = <?php echo round($detail['radius'],3)?>\)
                                      </p>
                                      <p class="mt-3">
                                        \( \textbf{<?=$lang['4']?>} \, (a) = r\pi\)
                                      </p>
                                      <p  class="mt-3">
                                        \( a = <?php echo $detail['radius']; ?> \times <?php echo $detail['pi'] ?>\)
                                      </p> 
                                      <p class="mt-3">
                                        \( a = <?php echo round($detail['pi']*$detail['radius'],3)?>\)
                                      </p>
                                      <p class="mt-3">
                                        \( \textbf{<?=$lang['6']?>} \, (A) =  \dfrac{π \times r^2}{2}\)
                                      </p>
                                      <p class="mt-3">
                                        \( A = \dfrac{π \times <?php echo $detail['radius'] ?>^2}{2}\)
                                      </p>
                                      <p class="mt-3">
                                          \( A = <?php echo round($detail['area'],3);?>\)
                                        </p>
                                      <p class="mt-3">
                                          \( \textbf{<?=$lang['5']?>} = πr + 2r \,\) 
                                        </p>
                                      <p class="mt-3">
                                          \( p = <?php echo $detail['radius']; ?>\pi + 2 \times <?php echo $detail['radius'] ?>\) 
                                        </p>
                                      <p class="mt-3 text-accent-4 orange-text">
                                          \( p = <?php echo round($detail['perimeter'],3);?>\) 
                                        </p>
                                  <?php } ?>
                                  <?php if($detail['selection']=="3"){//Given Circumference (a)
                                  ?>
                                        <p class="mt-3">
                                        \( \textbf{<?=$lang['2']?>} \, (r) = \dfrac{c}{\pi} \)</p>
                                        <p class="mt-3">
                                          \( r = \dfrac{<?php echo $detail['arc_length']; ?>}{\pi}\)
                                        </p>
                                        <p class="mt-3">
                                        \( r = <?php echo round($detail['radius'],3);?>\) 
                                        </p>
                                        <p class="mt-3">
                                          \( \textbf{<?=$lang['3']?>} \, (d) = r*2\)
                                        </p>
                                        <p class="mt-3">
                                          \( d = <?php echo $detail['radius']; ?> \times <?php echo 2 ?>\)
                                        </p>
                                        <p class="mt-3">
                                          \( d = <?php echo round($detail['diameter'],3);?>\) 
                                        </p>
                                        <p class="col s12 font_size20 center margin_top_15">
                                          \( \textbf{<?=$lang['6']?>} \, (A) = \dfrac{\pi r^2}{2}\)
                                        </p>
                                        <p class="col s12 font_size20 center margin_top_15">
                                            \( A =  \dfrac{\pi \times <?php echo $detail['radius'] ?>^2}{2}\)
                                        </p>
                                        <p class="mt-3">
                                          \( A = <?php echo round($detail['area'],3);?>\) 
                                        </p>
                                        <p class="mt-3">
                                          \( \textbf{<?=$lang['5']?>}= πr + 2r \,\)
                                        </p>
                                        <p class="mt-3">
                                          \( p = <?php echo $detail['radius']; ?>\pi + 2 \times <?php echo $detail['radius'] ?>\)
                                        </p>
                                        <p class="mt-3">
                                          \( p = <?php echo round($detail['perimeter'],3);?>\) 
                                        </p>
                                  <?php } ?>
                                    <?php if($detail['selection']=="4"){//Given Perimeter
                                  ?>
                                      <p class="mt-3">\(  \textbf{<?=$lang['2']?>} \, (r) =\dfrac{p}{\pi+2}\)
                                      </p>
                                      <p class="mt-3">
                                        \( r = \dfrac{<?php echo $detail['perimeter']; ?>}{<?php echo $detail['pi']+2;?>}\)
                                      </p>
                                      <p class="mt-3">
                                        \( r = <?php echo round($detail['radius'],3);?>\) 
                                      </p>
                                      <p class="mt-3">
                                        \( \textbf{<?=$lang['4']?>} \, (a) = r\pi\)
                                      </p>
                                      <p class="mt-3">
                                        \( a = <?php echo $detail['radius']; ?> \times <?php echo $detail['pi'] ?>\)
                                      </p>
                                        <p class="mt-3">
                                        \( a =<?php echo round($detail['pi']*$detail['radius'],3)?> \) 
                                      </p>
                                      <p class="mt-3">
                                          \( \textbf{<?=$lang['6']?>} \, A = \dfrac{\pi \times r^2}{2}\)
                                      </p>
                                      <p class="mt-3">
                                          \( A = \dfrac{\pi \times <?php echo $detail['radius'] ?>^2}{2}\)
                                      </p>
                                      <p class="mt-3">
                                        \( A =<?php echo round($detail['area'],3);?> \) 
                                      </p>
                                      <p  class="mt-3">
                                      \( \textbf{<?=$lang['5']?>(p)} = πr + 2r \,\)   
                                      </p>
                                      <p  class="mt-3">
                                        \( p = <?php echo $detail['radius']; ?>\pi + 2 \times <?php echo $detail['radius'] ?>\)   
                                      </p>
                                      <p class="mt-3">
                                        \( p =<?php echo round($detail['perimeter'],3);?> \) 
                                      </p>
                                  <?php } ?>
                                  <?php if($detail['selection']=="6"){//Given Area
                                  ?>
                                      <p class="mt-3">\(  \textbf{<?=$lang['2']?>} \, (r) = \sqrt{\dfrac{2*a}{\pi}}  \)</p>
                                      <p class="mt-3">
                                        \( r = \sqrt{\dfrac{2*<?php echo $detail['area']; ?>}{\pi}}\)
                                      </p>
                                      <p class="mt-3">
                                        \( r =<?php echo round($detail['radius'],3);?> \) 
                                      </p>
                                      <p class="mt-3">
                                          \( \textbf{<?=$lang['4']?>} \, (a) = \pi r\)
                                      </p>
                                      <p class="mt-3">
                                          \( a = <?php echo $detail['radius']; ?> \times <?php echo $detail['pi'] ?>\)
                                      </p>
                                        <p class="mt-3">
                                          \( a =<?php echo round($detail['pi']*$detail['radius'],3);?> \) 
                                        </p>
                                        <p class="mt-3">
                                        \( \textbf{<?=$lang['3']?>} \, (d) = r*2\)
                                        </p>
                                        <p class="mt-3">
                                          \( d =<?php echo $detail['radius'] ?>*2\)
                                        </p>
                                        <p class="mt-3">
                                          \( d =<?php echo round($detail['diameter'],3);?> \) 
                                        </p>
                                        <p class="mt-3">
                                          \( \textbf{<?=$lang['5']?>} (p) = πr + 2r \,\)
                                        </p>
                                        <p class="mt-3">
                                          \( p = <?php echo $detail['radius']; ?>\pi + 2 \times <?php echo $detail['radius'] ?>\)
                                        </p>
                                          <p class="mt-3">
                                          \( p =<?php echo round($detail['perimeter'],3);?> \) 
                                        </p>
                                  <?php } ?>
                          </div>
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
            document.getElementById('selection').addEventListener('change', function() {
                var val1 = this.value;
                var radElement = document.querySelector('.rad');
                if (val1 === "1") {
                    radElement.textContent = "<?=$lang['2']?> (r):";
                } else if (val1 === "2") {
                    radElement.textContent = "<?=$lang['3']?> (d):";
                } else if (val1 === "3") {
                    radElement.textContent = "<?=$lang['4']?> (a):";
                } else if (val1 === "4") {
                    radElement.textContent = "<?=$lang['5']?> (p):";
                } else if (val1 === "6") {
                    radElement.textContent = "<?=$lang['6']?> (A):";
                }
            });
        </script>
    @endpush
</form>
