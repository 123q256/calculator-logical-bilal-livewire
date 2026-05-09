<div>
 <style>
    @media (max-width: 480px) {
        .calculator-box{
            padding-right: 0rem;
            padding-left: 0rem;
        }
        .font-s-14{
            font-size: 12px;
        }
    }
    @media (max-width: 320px) {
        .margin-top{
            margin-top: 0.5rem;
        }
    }
</style>
 <form wire:submit.prevent="calculate">
 
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 ">
                   <label for="mean" class="font-s-14 text-blue">{{ $lang['1'] }} (λ):</label>
                   <input type="number" step="any" wire:model.live="mean" id="mean" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 ">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['2'] }} (x):</label>
                    <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input" placeholder="00"/>
                </div>
           </div>
                <div class="grid grid-cols-1  mt-4  gap-4">
                <div class="space-y-2 ">
                    <label for="con" class="font-s-14 text-blue">{{$lang['25']}}:</label>
                    <select wire:model.live="con" id="con" class="input" autocomplete="off">
                        <option value="1">{{ $lang['3'] }} P(X = x)</option>
                        <option value="2">{{ $lang['4'] }} P(X < x)</option>
                        <option value="3">{{ $lang['5'] }} P(X ≤ x)</option>
                        <option value="4">{{ $lang['6'] }} P(X > x)</option>
                        <option value="5">{{ $lang['7'] }} P(X ≥ x)</option>
                    </select>
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
            <div class="rounded-lg mt-4  flex items-center justify-center">
                <div class="w-full">
                    @php
                        // The Livewire properties $x, $mean, and $con are automatically available here.
                    @endphp
                    @if ($con=='1')
                        <div class="text-center">
                            <p class=""><strong><?=$lang['8']?> <?=$x?> <?=$lang['21']?> P(X = <?=$x?>)</strong></p>
                            <p class="bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-blue font-s-18">{{ $detail['ans'] }}</strong>
                            </p>
                        </div>
                        <p class="col-12 mt-3 "><strong class="text-blue font-s-18"><?=$lang['10']?>:</strong></p>
                        <p class="col-12 mt-3"><?=$lang['11']?>: <strong>λ = <?=$mean?> , x = <?=$x?></strong></p>
                        <p class="col-12 mt-3"><?=$lang['12']?>: \(P(x)=\dfrac{e^{-λ}.λ^x}{x!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^<?=$x?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{2.718^{-<?=$mean?>}.<?=$mean?>^<?=$x?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['expo']}} * <?=$detail['power']?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['sumofex']}}}{<?=$detail['fact']?>}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=<?=$detail['ans']?>\)</p>
                    @elseif($con=='2')
                        <div class="text-center">
                            <p class=""><strong><?=$lang['9']?> <?=$x?> <?=$lang['21']?> P(X < <?=$x?>)</strong></p>
                            <p class="  px-3 py-2 radius-10 d-inline-block my-3">
                                <strong class="text-blue font-s-18">{{ $detail['ans'] }}</strong>
                            </p>
                        </div>
                        @if ($x>1)
                            <p class="col-12 mt-3 "><strong class="text-blue font-s-18"><?=$lang['10']?>:</strong></p>
                            <p class="col-12 mt-3"><?=$lang['11']?>: <strong>λ = <?=$mean?> , x = <?=$x?></strong></p>
                            <p class="col-12 mt-3"><?=$lang['14']?> <?=$x?> <?=$lang['15']?>: <strong>X = <?php 
                                for ($i=0; $i < $x; $i++) { 
                                    echo $i.', ';
                                }
                            ?></strong><?=$lang['17']?> P (X).</p>
                            <p class="col-12 mt-3"><strong>\(
                                <?php 
                                    for ($i=0; $i < $x; $i++) { 
                                        if ($i!=($x-1)) {
                                            echo "P($i) + ";
                                        }else{
                                            echo "P($i)";
                                        }
                                    }
                                ?>
                            \)</strong></p>
                            <p class="col-12 mt-3"><strong><?=$lang['13']?></strong></p>
                            <p class="col-12 mt-3"><strong>P(0)</strong></p>
                            <p class="col-12 mt-3"><?=$lang['12']?>: \(P(x)=\dfrac{e^{-λ}.λ^x}{x!}\)</p>
                            <p class="col-12 mt-3">\(P(0)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^0}{0!}\)</p>
                            @if (!empty($detail['details']))
                                @foreach ($detail['details'] as $currentX => $data)
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^<?=$currentX?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['expo']?> * <?=$data['power']?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['sumofex']?>}{<?=$data['fact']?>}\)</p>
                                    <p class="col-12 mt-3"><strong>\(P(<?=$currentX?>)=<?=$data['value']?>\)</strong></p>
                                @endforeach
                            @else
                                <p>No details found.</p>
                            @endif
                            <p class="col-12 mt-3"><strong><?=$lang['16']?></strong></p>
                            <p class="col-12 mt-3"><strong>\(
                                <?php 
                                    for ($i=0; $i < $x; $i++) { 
                                        if ($i!=($x-1)) {
                                            echo "P($i) + ";
                                        }else{
                                            echo "P($i)";
                                        }
                                    }
                                ?>
                            \)</strong></p>
                            <p class="col-12 mt-3"><?=$detail['sum']?></p>
                            <p class="col-12 mt-3 "><strong class="text-blue font-s-18">= <?=$detail['ans']?></strong></p>
                        @endif
                    @elseif($con=='3')
                        <div class="text-center">
                            <p class=""><strong><?=$lang['22']?> <?=$x?> <?=$lang['21']?> P(X ≤ <?=$x?>)</strong></p>
                            <p class=" bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                <strong class="text-blue font-s-18">{{ $detail['ans'] }}</strong>
                            </p>
                        </div>
                        <p class="col-12 mt-3"><strong class="text-blue font-s-18"><?=$lang['10']?>:</strong></p>
                        <p class="col-12 mt-3"><?=$lang['11']?>: <strong>λ = <?=$mean?> , x = <?=$x?></strong></p>
                        <p class="col-12 mt-3"><?=$lang['14']?> <?=$x?> <?=$lang['15']?>: <strong>X = <?php 
                            for ($i=0; $i <= $x; $i++) { 
                                echo $i.', ';
                            }
                            ?></strong><?=$lang['17']?> P (X).</p>
                        <p class="col-12 mt-3"><strong>\(
                            <?php 
                                for ($i=0; $i <= $x; $i++) { 
                                    if ($i!=$x) {
                                        echo "P($i) + ";
                                    }else{
                                        echo "P($i)";
                                    }
                                }
                                ?>
                        \)</strong></p>
                        <p class="col-12 mt-3"><strong><?=$lang['13']?></strong></p>
                        <p class="col-12 mt-3"><strong>P(0)</strong></p>
                        <p class="col-12 mt-3"><?=$lang['12']?>: \(P(x)=\dfrac{e^{-λ}.λ^x}{x!}\)</p>
                        <p class="col-12 mt-3">\(P(0)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^0}{0!}\)</p>
                        {{-- <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{2.718^{-<?=$mean?>}.<?=$mean?>^<?=$x?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['expo']}} * <?=$detail['power']?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['sumofex']}}}{<?=$detail['fact']?>}\)</p> --}}
                            @if (!empty($detail['details']))
                                @foreach ($detail['details'] as $currentX => $data)
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^<?=$currentX?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['expo']?> * <?=$data['power']?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['sumofex']?>}{<?=$data['fact']?>}\)</p>
                                    <p class="col-12 mt-3"><strong>\(P(<?=$currentX?>)=<?=$data['value']?>\)</strong></p>
                                @endforeach
                            @else
                                <p>No details found.</p>
                            @endif
                        <?php if($x!=0){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['16']?></strong></p>
                            <p class="col-12 mt-3"><strong>\(
                                <?php 
                                    for ($i=0; $i <= $x; $i++) { 
                                        if ($i!=$x) {
                                            echo "P($i) + ";
                                        }else{
                                            echo "P($i)";
                                        }
                                    }
                                    ?>
                            \)</strong></p>
                            <p class="col-12 mt-3"><?=$detail['sum']?></p>
                            <p class="col-12 mt-3 "><strong class="text-blue font-s-18">= <?=$detail['ans']?></strong></p>
                        <?php } ?>
                    @elseif($con=='4')
                        <div class="text-center">
                            <p class=""><strong><?=$lang['20']?> <?=$x?> <?=$lang['21']?> P(X > <?=$x?>)</strong></p>
                            <p class=" bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                <strong class="text-blue font-s-18">{{ 1-$detail['ans'] }}</strong>
                            </p>
                        </div>
                        <p class="col-12 mt-2 "><strong class="text-blue font-s-18"><?=$lang['10']?>:</strong></p>
                        <p class="col-12 mt-3"><?=$lang['11']?>: <strong>λ = <?=$mean?> , x = <?=$x?></strong></p>
                        <p class="col-12 mt-3"><?=$lang['18']?> <?=$x?> <?=$lang['19']?> 1.</p>
                        <p class="col-12 mt-3">\(P(X > <?=$x?>) = 1 - P(X ≤ <?=$x?>)\)</p>
                        <p class="col-12 mt-3"><?=$lang['14']?> <?=$x?> <?=$lang['15']?>: <strong>X = <?php 
                            for ($i=0; $i <= $x; $i++) { 
                                echo $i.', ';
                            }
                            ?></strong><?=$lang['17']?> P (X).</p>
                        <p class="col-12 mt-3"><strong>\(
                            <?php 
                                for ($i=0; $i <= $x; $i++) { 
                                    if ($i!=$x) {
                                        echo "P($i) + ";
                                    }else{
                                        echo "P($i)";
                                    }
                                }
                                ?>
                        \)</strong></p>
                        <p class="col-12 mt-3"><strong><?=$lang['13']?></strong></p>
                        <p class="col-12 mt-3"><strong>P(0)</strong></p>
                        <p class="col-12 mt-3"><?=$lang['12']?>: \(P(x)=\dfrac{e^{-λ}.λ^x}{x!}\)</p>
                        <p class="col-12 mt-3">\(P(0)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^0}{0!}\)</p>
                        {{-- <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{2.718^{-<?=$mean?>}.<?=$mean?>^<?=$x?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['expo']}} * <?=$detail['power']?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['sumofex']}}}{<?=$detail['fact']?>}\)</p>
                        <p class="col-12 mt-3"><strong>\(P(0)=<?=$detail['first']?>\)</strong></p> --}}
                            @if (!empty($detail['details']))
                                @foreach ($detail['details'] as $currentX => $data)
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^<?=$currentX?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['expo']?> * <?=$data['power']?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['sumofex']?>}{<?=$data['fact']?>}\)</p>
                                    <p class="col-12 mt-3"><strong>\(P(<?=$currentX?>)=<?=$data['value']?>\)</strong></p>
                                @endforeach
                            @else
                                <p>No details found.</p>
                            @endif
                        <?php if($x!=0){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['16']?></strong></p>
                            <p class="col-12 mt-3"><strong>\(
                                <?php 
                                    for ($i=0; $i <= $x; $i++) { 
                                        if ($i!=$x) {
                                            echo "P($i) + ";
                                        }else{
                                            echo "P($i)";
                                        }
                                    }
                                    ?>
                            \)</strong></p>
                            <p class="col-12 mt-3"><?=$detail['sum']?></p>
                            <p class="col-12 mt-3 "><strong class="text-blue font-s-18">= <?=$detail['ans']?></strong></p>
                        <?php } ?>
                        <p class="col-12 mt-3"><strong><?=$lang['24']?> 1</strong></p>
                        <p class="col-12 mt-3">\(P(X > <?=$x?>) = 1 - P(X ≤ <?=$x?>)\)</p>
                        <p class="col-12 mt-3">\(P(X > <?=$x?>) = 1 - <?=$detail['ans']?>\)</p>
                        <p class="col-12 mt-3">\(P(X > <?=$x?>) = <?=1-$detail['ans']?>\)</p>
                    @elseif($con=='5')
                        <div class="text-center">
                            <p class=""><strong>Probability of at least <?=$x?> <?=$lang['21']?> P(X ≥ <?=$x?>)</strong></p>
                            <p class=" bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                <strong class="text-blue font-s-18">{{ 1-$detail['ans'] }}</strong>
                            </p>
                        </div>         
                        <p class="col-12 mt-3"><strong class="text-blue font-s-18"><?=$lang['10']?>:</strong></p>
                        <p class="col-12 mt-3"><?=$lang['11']?>: <strong>λ = <?=$mean?> , x = <?=$x?></strong></p>
                        <p class="col-12 mt-3"><?=$lang['23']?> <?=$x?> <?=$lang['19']?> 1.</p>
                        <p class="col-12 mt-3">\(P(X ≥ <?=$x?>) = 1 - P(X < <?=$x?>)\)</p>
                        <p class="col-12 mt-3"><?=$lang['14']?> <?=$x?> <?=$lang['15']?>: <strong>X = <?php 
                            for ($i=0; $i < $x; $i++) { 
                                echo $i.', ';
                            }
                            ?></strong><?=$lang['17']?> P (X).</p>
                        <p class="col-12 mt-3"><strong>\(
                            <?php 
                                for ($i=0; $i < $x; $i++) { 
                                    if ($i!=($x-1)) {
                                        echo "P($i) + ";
                                    }else{
                                        echo "P($i)";
                                    }
                                }
                                ?>
                        \)</strong></p>
                        <p class="col-12 mt-3"><strong><?=$lang['13']?></strong></p>
                        <p class="col-12 mt-3"><strong>P(0)</strong></p>
                        <p class="col-12 mt-3"><?=$lang['12']?>: \(P(x)=\dfrac{e^{-λ}.λ^x}{x!}\)</p>
                        <p class="col-12 mt-3">\(P(0)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^0}{0!}\)</p>
                        {{-- <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{2.718^{-<?=$mean?>}.<?=$mean?>^<?=$x?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['expo']}} * <?=$detail['power']?>}{<?=$x?>!}\)</p>
                        <p class="col-12 mt-3">\(P(<?=$x?>)=\dfrac{ {{$detail['sumofex']}}}{<?=$detail['fact']?>}\)</p> --}}
                            @if (!empty($detail['details']))
                                @foreach ($detail['details'] as $currentX => $data)
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{e^{-<?=$mean?>}.<?=$mean?>^<?=$currentX?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['expo']?> * <?=$data['power']?>}{<?=$currentX?>!}\)</p>
                                    <p class="col-12 mt-3">\(P(<?=$currentX?>)=\dfrac{ <?=$data['sumofex']?>}{<?=$data['fact']?>}\)</p>
                                    <p class="col-12 mt-3"><strong>\(P(<?=$currentX?>)=<?=$data['value']?>\)</strong></p>
                                @endforeach
                            @else
                                <p>No details found.</p>
                            @endif

                        {{-- <p class="col-12 mt-3"><strong>\(P(0)=<?=$detail['first']?>\)</strong></p> --}}
                        <?php if($x!=0){ ?>
                            <p class="col-12 mt-3"><strong><?=$lang['16']?></strong></p>
                            <p class="col-12 mt-3"><strong>\(
                                <?php 
                                    for ($i=0; $i < $x; $i++) { 
                                        if ($i!=($x-1)) {
                                            echo "P($i) + ";
                                        }else{
                                            echo "P($i)";
                                        }
                                    }
                                    ?>
                            \)</strong></p>
                            <p class="col-12 mt-3"><?=$detail['sum']?></p>
                            <p class="col-12 mt-3 "><strong class="text-blue font-s-18">= <?=$detail['ans']?></strong></p>
                        <?php } ?>
                        <p class="col-12 mt-3"><strong><?=$lang['24']?> 1</strong></p>
                        <p class="col-12 mt-3">\(P(X ≥ <?=$x?>) = 1 - P(X < <?=$x?>)\)</p>
                        <p class="col-12 mt-3">\(P(X ≥ <?=$x?>) = 1 - <?=$detail['ans']?>\)</p>
                        <p class="col-12 mt-3">\(P(X ≥ <?=$x?>) = <?=1-$detail['ans']?>\)</p>
                    @endif
                    <div class="col-12 mt-3"
                         x-data="{
                            xValue: {{ $x ?? 0 }},
                            chartData: [{{ $detail['chart'] }}],
                            render() {
                                if (typeof Highcharts === 'undefined') {
                                    setTimeout(() => this.render(), 200);
                                    return;
                                }
                                
                                let data = [...this.chartData];
                                let index = parseInt(this.xValue);
                                if (index >= 0 && index < data.length) {
                                    data[index] = {
                                        y: data[index],
                                        color: '#ca8d8d' 
                                    };
                                }

                                Highcharts.chart(this.$refs.canvas, {
                                    chart: { type: 'column' },
                                    title: { text: null },
                                    xAxis: { categories: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], title: { text: 'x' } },
                                    yAxis: { title: { text: 'P(X=x)' } },
                                    tooltip: { crosshairs: true, shared: true },
                                    credits: { enabled: false },
                                    legend: { enabled: false },
                                    series: [{ name: 'P(X=x) = ', data: data }]
                                });
                            }
                         }"
                         x-init="render()"
                         @chart-updated.window="
                            chartData = $event.detail.detail.chart.split(',').map(Number); 
                            xValue = $event.detail.x; 
                            render();
                         "
                         wire:ignore>
                        <div x-ref="canvas" style="height:250px;" class="w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ url('js/jquery.fractionpainter.js') }}"></script>
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
</div>
