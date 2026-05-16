<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            @if(app()->getLocale() != "tr")
                <p class="my-2 text-[16px] px-2">{{ $lang['1'] }}</p>
            @endif

            @php
                $inputs = [
                    ['id' => 'x1', 'label' => 'x₁', 'val' => $x1],
                    ['id' => 'y1', 'label' => 'y₁', 'val' => $y1],
                    ['id' => 'x2', 'label' => 'x₂', 'val' => $x2],
                    ['id' => 'y2', 'label' => 'y₂', 'val' => $y2],
                    ['id' => 'x3', 'label' => 'x₃', 'val' => $x3],
                    ['id' => 'y3', 'label' => 'y₃', 'val' => $y3],
                ];
                $filled_count = collect($inputs)->filter(fn($i) => strlen(trim((string)$i['val'])) > 0)->count();
            @endphp

            @if($filled_count == 6)
                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 my-4 rounded-r-lg">
                    <p class="text-amber-700 font-semibold flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Please leave one field empty to calculate its value. (Enter only five values)
                    </p>
                </div>
            @endif

            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                @foreach($inputs as $input)
                    <div class="col-span-6">
                        <label for="{{ $input['id'] }}" class="label">{{ $input['label'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" 
                                wire:model.live="{{ $input['id'] }}" 
                                id="{{ $input['id'] }}" 
                                class="input"
                            />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if ($type == 'calculator')
            @include('inc.button')
        @endif
           @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </div>

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">
                                        <strong>
                                            @php
                                                if(isset($detail['x1'])){ echo "x1"; }
                                                elseif(isset($detail['y1'])){ echo "y1"; }
                                                elseif(isset($detail['x2'])){ echo "x2"; }
                                                elseif(isset($detail['y2'])){ echo "y2"; }
                                                elseif(isset($detail['x3'])){ echo "x3"; }
                                                elseif(isset($detail['y3'])){ echo "y3"; }
                                            @endphp
                                        </strong>
                                    </td>
                                    <td class="py-2 border-b">
                                        @php
                                            if(isset($detail['x1'])){ echo $detail['x1']; }
                                            elseif(isset($detail['y1'])){ echo $detail['y1']; }
                                            elseif(isset($detail['x2'])){ echo $detail['x2']; }
                                            elseif(isset($detail['y2'])){ echo $detail['y2']; }
                                            elseif(isset($detail['x3'])){ echo $detail['x3']; }
                                            elseif(isset($detail['y3'])){ echo $detail['y3']; }
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full">
                            <p class="mt-3"><strong>{{$lang['2']}}</strong></p>
                            <p class="mt-3">{{$lang['3']}}</p>
                            <p class="mt-3">\( x₁ = {{ (isset($detail['x1'])) ? '?' : $x1 }}, \)</p>
                            <p class="mt-3">\( y₁ = {{ (isset($detail['y1'])) ? '?' : $y1 }}, \)</p>
                            <p class="mt-3">\( x₂ = {{ (isset($detail['x2'])) ? '?' : $x2 }}, \)</p>
                            <p class="mt-3">\( y₂ = {{ (isset($detail['y2'])) ? '?' : $y2 }}, \)</p>
                            <p class="mt-3">\( x₃ = {{ (isset($detail['x3'])) ? '?' : $x3 }}, \)</p>
                            <p class="mt-3">\( y₃ = {{ (isset($detail['y3'])) ? '?' : $y3 }} \)</p>
                            <p class="mt-3">{{$lang['4']}}</p>
                            @php
                                $s1=$detail['s1'];
                                $s2=$detail['s2'];
                                $s3=$detail['s3'];
                                $s4=$detail['s4'];
                                $s5=$detail['s5'];
                            @endphp 
                            @if(isset($detail['x1']))
                                <p class="mt-3">\( x₁ = \) \( { ( y₃ - y₁ ) * ( x₂ - x₃ ) \over ( y₃ - y₂ ) } \)\( + x₃ \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">\( x₁ = \) \( { ( y₃ - y₁ ) * ( x₂ - x₃ ) \over ( y₃ - y₂ ) } \)\( + x₃ \)</p>
                                <p class="mt-3">\( x₁ = \) \( { ( {{ $y3 }} - {{ $y1 }} ) * ( {{ $x2 }} - {{ $x3 }} ) \over ( {{ $y3 }} - {{ $y2 }} ) } \)\( + {{ $x3 }} \)</p>
                                <p class="mt-3">\( x₁ = \) \( { ( {{ $s1 }} ) * ( {{ $s2 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $x3 }} \)</p>
                                <p class="mt-3">\( x₁ = \) \( { ( {{ $s4 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $x3 }} \)</p>
                                <p class="mt-3">\( x₁ = {{ $s5 }} + {{ $x3 }} \)</p>
                                <p class="mt-3">\( x₁ = {{ $detail['x1'] }} \)</p>
                            @elseif(isset($detail['y1']))
                                <p class="mt-3">\( y₁ = \) \( { ( x₂ - x₁ ) * ( y₃ - y₂ ) \over ( x₃ - x₁ ) } \)\( + y₂ \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">\( y₁ = \) \( { ( x₂ - x₁ ) * ( y₃ - y₂ ) \over ( x₃ - x₁ ) } \)\( + y₂ \)</p>
                                <p class="mt-3">\( y₁ = \) \( { ( {{ $x2 }} - {{ $x1 }} ) * ( {{ $y3 }} - {{ $y2 }} ) \over ( {{ $x3 }} - {{ $x1 }} ) } \)\( + {{ $y2 }} \)</p>
                                <p class="mt-3">\( y₁ = \) \( { ( {{ $s1 }} ) * ( {{ $s2 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $y2 }} \)</p>
                                <p class="mt-3">\( y₁ = \) \( { ( {{ $s4 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $y2 }} \)</p>
                                <p class="mt-3">\( y₁ = {{ $s5 }} + {{ $y2 }} \)</p>
                                <p class="mt-3">\( y₁ = {{ $detail['y1'] }} \)</p>
                            @elseif(isset($detail['x2']))
                                <p class="mt-3">\( x₂ = \) \( { ( y₁ - y₂ ) * ( x₃ - x₁ ) \over ( y₁ - y₃ ) } \)\( + x₁ \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">\( x₂ = \) \( { ( y₁ - y₂ ) * ( x₃ - x₁ ) \over ( y₁ - y₃ ) } \)\( + x₁ \)</p>
                                <p class="mt-3">\( x₂ = \) \( { ( {{ $y1 }} - {{ $y2 }} ) * ( {{ $x3 }} - {{ $x1 }} ) \over ( {{ $y1 }} - {{ $y3 }} ) } \)\( + {{ $x1 }} \)</p>
                                <p class="mt-3">\( x₂ = \) \( { ( {{ $s1 }} ) * ( {{ $s2 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $x1 }} \)</p>
                                <p class="mt-3">\( x₂ = \) \( { ( {{ $s4 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $x1 }} \)</p>
                                <p class="mt-3">\( x₂ = {{ $s5 }} + {{ $x1 }} \)</p>
                                <p class="mt-3">\( x₂ = {{ $detail['x2'] }} \)</p>
                            @elseif(isset($detail['y2']))
                                <p class="mt-3">\( y₂ = \) \( { ( x₃ - x₂ ) * ( y₃ - y₁ ) \over ( x₃ - x₂ ) } \)\( + y₃ \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">\( y₂ = \) \( { ( x₃ - x₂ ) * ( y₃ - y₁ ) \over ( x₃ - x₂ ) } \)\( + y₃ \)</p>
                                <p class="mt-3">\( y₂ = \) \( { ( {{ $x3 }} - {{ $x2 }} ) * ( {{ $y3 }} - {{ $y1 }} ) \over ( {{ $x3 }} - {{ $x2 }} ) } \)\( + {{ $y3 }} \)</p>
                                <p class="mt-3">\( y₂ = \) \( { ( {{ $s1 }} ) * ( {{ $s2 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $y3 }} \)</p>
                                <p class="mt-3">\( y₂ = \) \( { ( {{ $s4 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $y3 }} \)</p>
                                <p class="mt-3">\( y₂ = {{ $s5 }} + {{ $y3 }} \)</p>
                                <p class="mt-3">\( y₂ = {{ $detail['y2'] }} \)</p>
                            @elseif(isset($detail['x3']))
                                <p class="mt-3">\( x₃ = \) \( { ( y₃ - y₂ ) * ( x₁ - x₂ ) \over ( y₁ - y₂ ) } \)\( + x₂ \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">\( x₃ = \) \( { ( y₃ - y₂ ) * ( x₁ - x₂ ) \over ( y₁ - y₂ ) } \)\( + x₂ \)</p>
                                <p class="mt-3">\( x₃ = \) \( { ( {{ $y3 }} - {{ $y2 }} ) * ( {{ $x1 }} - {{ $x2 }} ) \over ( {{ $y1 }} - {{ $y2 }} ) } \)\( + {{ $x2 }} \)</p>
                                <p class="mt-3">\( x₃ = \) \( { ( {{ $s1 }} ) * ( {{ $s2 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $x2 }} \)</p>
                                <p class="mt-3">\( x₃ = \) \( { ( {{ $s4 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $x2 }} \)</p>
                                <p class="mt-3">\( x₃ = {{ $s5 }} + {{ $x2 }} \)</p>
                                <p class="mt-3">\( x₃ = {{ $detail['x3'] }} \)</p>
                            @elseif(isset($detail['y3']))
                                <p class="mt-3">\( y₃ = \) \( { ( x₃ - x₁ ) * ( y₂ - y₁ ) \over ( x₂ - x₁ ) } \)\( + y₁ \)</p>
                                <p class="mt-3">{{$lang['5']}}</p>
                                <p class="mt-3">\( y₃ = \) \( { ( x₃ - x₁ ) * ( y₂ - y₁ ) \over ( x₂ - x₁ ) } \)\( + y₁ \)</p>
                                <p class="mt-3">\( y₃ = \) \( { ( {{ $x3 }} - {{ $x1 }} ) * ( {{ $y2 }} - {{ $y1 }} ) \over ( {{ $x2 }} - {{ $x1 }} ) } \)\( + {{ $y1 }} \)</p>
                                <p class="mt-3">\( y₃ = \) \( { ( {{ $s1 }} ) * ( {{ $s2 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $y1 }} \)</p>
                                <p class="mt-3">\( y₃ = \) \( { ( {{ $s4 }} ) \over ( {{ $s3 }} ) } \)\( + {{ $y1 }} \)</p>
                                <p class="mt-3">\( y₃ = {{ $s5 }} + {{ $y1 }} \)</p>
                                <p class="mt-3">\( y₃ = {{ $detail['y3'] }} \)</p>
                                @php
                                    $px1 = isset($detail['x1']) ? $detail['x1'] : $x1;
                                    $py1 = isset($detail['y1']) ? $detail['y1'] : $y1;
                                    $px2 = isset($detail['x2']) ? $detail['x2'] : $x2;
                                    $py2 = isset($detail['y2']) ? $detail['y2'] : $y2;
                                    $px3 = isset($detail['x3']) ? $detail['x3'] : $x3;
                                    $py3 = isset($detail['y3']) ? $detail['y3'] : $y3;

                                    $xs = [(float)$px1, (float)$px2, (float)$px3];
                                    $ys = [(float)$py1, (float)$py2, (float)$py3];
                                    $minX = min($xs); $maxX = max($xs);
                                    $minY = min($ys); $maxY = max($ys);
                                    $padX = ($maxX - $minX) ?: 10;
                                    $padY = ($maxY - $minY) ?: 10;
                                    $bbox = [$minX - $padX * 0.2, $maxY + $padY * 0.2, $maxX + $padX * 0.2, $minY - $padY * 0.2];
                                @endphp

                                <div wire:key="graph-{{ $renderCount }}" 
                                    x-data="{
                                        initGraph() {
                                            if (typeof JXG === 'undefined') return;
                                            var board = JXG.JSXGraph.initBoard('box1', {
                                                boundingbox: [{{ (float)$x2 - 5 }}, {{ (float)$y1 + 5 }}, {{ (float)$x1 + 5 }}, {{ (float)$y2 - 5 }}], 
                                                axis:true
                                            });
                                            var p1 = board.create('point', [{{ (float)$x1 }}, {{ (float)$y1 }}], {name: 'P1'});
                                            var p2 = board.create('point', [{{ (float)$x2 }}, {{ (float)$y2 }}], {name: 'P2'});
                                            var p3 = board.create('point', [{{ (float)$px3 }}, {{ (float)$py3 }}], {name: 'P3', color: 'red'});
                                            var l1 = board.create('line', [p1, p2]);
                                        }
                                    }" 
                                    x-init="initGraph()" 
                                    id="box1" class="col-lg-10 mt-4 mx-auto" style="height: 350px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>

@push('calculatorJS')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
    <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Listen for math-updated event
            Livewire.on('math-updated', (event) => {
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            });

            // Initial render
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        });
    </script>
@endpush

