<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                $request = request();
            @endphp
            <div class="col-span-12 flex justify-center items-center" style="gap: 20px">
                <p class="flex justify-center items-center">
                    <input type="radio" name="select" id="one" value="2" {{ isset($request->select) && $request->select == '1' ? '' : 'checked' }}>
                    <label for="one" class="text-blue ps-1 cursor-pointer"><?=$lang[3]?></label>
                </p>
                <p class="flex justify-center items-center">
                    <input type="radio" name="select" id="first" value="1" {{ isset($request->select) && $request->select == '1' ? 'checked' : '' }}>
                    <label for="first" class="text-blue ps-1 cursor-pointer"><?=$lang[2]?></label>
                </p>
            </div>
            <div class="{{ isset($request->select) && $request->select == '1' ? 'md:col-span-5 lg:col-span-5  ' : '' }} col-span-12 mt-0  oneSide">
                <label for="equ1" class="font-s-14 text-blue"><?= $lang['4'] ?>:</label>
                <div class="w-100 py-2">
                    <input type="text" name="equ1" id="equ1" class="input" aria-label="input" value="{{ isset($request->equ1) ? $request->equ1 : 'x^2-2x+1 > 34' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-2 lg:col-span-2  {{ isset($request->select) && $request->select == '1' ? '' : 'hidden' }} twoSide flex items-center">
                <label for="con" class="font-s-14 text-blue d-lg-inline hidden">&nbsp;</label>
                <div class="w-full py-2">
                    <label for="" >&nbsp;</label>
                    <select name="con" class="input" id="con" aria-label="select">
                        <option value="1">{{$lang['5']}}</option>
                        <option value="2" {{ isset($request->con) && $request->con == '2' ? 'selected' : '' }}>{{$lang['6']}}</option>
                    </select>
                </div>
            </div>
            <div class="md:col-span-5 lg:col-span-5   col-span-12 mt-0  {{ isset($request->select) && $request->select == '1' ? '' : 'hidden' }} twoSide">
                <label for="equ2" class="font-s-14 text-blue"><?= $lang['4'] ?>:</label>
                <div class="w-100 py-2">
                    <input type="text" name="equ2" id="equ2" class="input" aria-label="input" value="{{ isset($request->equ2) ? $request->equ2 : 'x^2-2x+1 > 34' }}" />
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
                            <div class="w-full">
                                @if($request->select == "2")
                                    <p class="mt-2 text-25px">\( \color{#1670a7}{ {{$detail['solution_inequality']}} } \)</p>
                                @else
                                    <p class="mt-2 font-s-22">
                                        \( ({{$detail['solution_inequality']}}) {{ $request->con === "1" ? '∩' : 'U' }} ({{$detail['latex_solution_eq_sec']}}) \)
                                    </p>
                                @endif
                            </div>
                            <div class="w-full  text-[18px]">
                                @isset($detail['steps'])
                                    <p class="mt-3"><strong>Steps to solve \( {{$request->equ1}} \)</strong></p>
                                    @foreach ($detail['steps'] as $item)
                                        <p class="mt-2">{{$item}}</p>
                                    @endforeach
                                @endisset
                                @isset($detail['steps_sec'])
                                    <p class="mt-3"><strong>Steps to solve \( {{$request->equ2}} \)</strong></p>
                                    @foreach ($detail['steps_sec'] as $item)
                                        <p class="mt-2">{{$item}}</p>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
        </script>
        <script>
            document.querySelectorAll('input[name="select"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var myDiv = document.querySelector('.myDiv');
                    if (document.getElementById('first').checked) {
                        document.querySelectorAll('.twoSide').forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                        document.querySelectorAll('.oneSide').forEach(function(element) {
                            element.classList.add('lg:col-span-5');
                        });
                    } else if (document.getElementById('one').checked) {
                        document.querySelectorAll('.twoSide').forEach(function(element) {
                            element.classList.add('hidden');
                        });
                        document.querySelectorAll('.oneSide').forEach(function(element) {
                            element.classList.remove('lg:col-span-5');
                        });
                    }
                });
            });
        </script>
        @isset($zain)
            <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
            <script src="{{ asset('assets/js/qchart.js') }}"></script>
            <script>
                <?php if($select==1){ ?>
                    <?php if(!empty($detail['graph'])){ ?>
                      function chart(){
                        var first = [];
                        <?php if (count($detail['graph'])==1) { ?>
                          first.push([<?=$detail['graph'][0]?>, 1]),
                          first.push([Infinity, 1]);
                          let min_val=<?=$detail['graph'][0]-1?>;
                          let max_val=<?=$detail['graph'][0]+12?>;
                          $('.right_arr').show();
                        <?php }elseif(isset($detail['graph']['less'])){ ?>
                          first.push([-Infinity, 1]),
                          first.push([<?=$detail['graph'][0]?>, 1]);
                          let max_val=<?=$detail['graph'][0]+1?>;
                          let min_val=<?=$detail['graph'][0]-12?>;
                          $('.left_arr').show();
                        <?php }else{ ?>
                          first.push([<?=$detail['graph'][0]?>, 1]),
                          first.push([<?=$detail['graph'][1]?>, 1]);
                          let min_val=<?= (int) $detail['graph'][0]-1.5?>;
                          let max_val=<?=$detail['graph'][1]+1.5?>;
                        <?php } ?>
                        $.plot(
                          $("#mychart"),
                            [
                              { data: first, points: { show: !0 }, lines: { show: !0 }, color: "#006B9F" },
                            ],
                            {
                              xaxis: { min: min_val, max: max_val },
                              legend: { position: "sw", backgroundColor: "#FFFFFF" },
                              yaxis: {
                                ticks: [
                                  [0, ""],
                                  [1, ""],
                                  [2, ""],
                                ],
                                min: 0,
                                max: 2,
                              },
                                grid: { backgroundColor: "#fafafa" },
                            }
                        );
                      }
                      chart();
                    <?php } ?>
                <?php }elseif($select==2 && isset($detail['jawab'])){ ?>
                    function chart(){
                      var first = [];
                      <?php if ($detail['one']=='>' || $detail['one']=='>=') { ?>
                        first.push([<?=$detail['jawab']?>, 1]),
                        first.push([Infinity, 1]);
                        let min_val=<?=$detail['jawab']-1?>;
                        let max_val=<?=$detail['jawab']+12?>;
                        $('.right_arr').show();
                      <?php }elseif($detail['one']=='<' || $detail['one']=='<='){ ?>
                        first.push([-Infinity, 1]),
                        first.push([<?=$detail['jawab']?>, 1]);
                        let max_val=<?=$detail['jawab']+1?>;
                        let min_val=<?=$detail['jawab']-12?>;
                        $('.left_arr').show();
                      <?php } ?>
                      $.plot(
                        $("#mychart"),
                          [
                            { data: first, points: { show: !0 }, lines: { show: !0 }, color: "#006B9F" },
                          ],
                          {
                            xaxis: { min: min_val, max: max_val },
                            legend: { position: "sw", backgroundColor: "#FFFFFF" },
                            yaxis: {
                              ticks: [
                                [0, ""],
                                [1, ""],
                                [2, ""],
                              ],
                              min: 0,
                              max: 2,
                            },
                              grid: { backgroundColor: "#fafafa" },
                          }
                      );
                    }
                    chart();
                <?php } ?>
            </script>
        @endisset
    @endpush
</form>
