<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    {{-- Calculation Method --}}
                    <div class="col-span-1 left">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="method" id="method" class="input">
                                <option value="normalize">{{ $lang[2] }}</option>
                                <option value="find">{{ $lang[3] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Dimensions --}}
                    <div class="col-span-1 left">
                        <label for="dimen" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="dimen" id="dimen" class="input">
                                <option value="3d">3D</option>
                                <option value="2d">2D</option>
                            </select>
                        </div>
                    </div>

                    {{-- Illustration Image --}}
                    <div class="col-span-2 flex justify-center py-4">
                        @if ($dimen == '3d')
                            <div id="uv_3d">
                                <img src="{{ asset('images/uv_3d.png') }}" class="uv_img" width="130px" alt="Unit Vector - 3d">
                            </div>
                        @else
                            <div id="uv_2d">
                                <img src="{{ asset('images/uv_2d.png') }}" class="uv_img" width="130px" alt="Unit Vector - 2d">
                            </div>
                        @endif
                    </div>

                    {{-- Conditional Component Inputs --}}
                    @if ($method == 'normalize')
                        <div class="col-span-1">
                            <label for="x" class="font-s-14 text-blue">x</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="0" />
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label for="y" class="font-s-14 text-blue">y</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="0" />
                            </div>
                        </div>
                        @if ($dimen == '3d')
                            <div class="col-span-2">
                                <label for="z" class="font-s-14 text-blue">z</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="z" id="z" class="input" placeholder="0" />
                                </div>
                            </div>
                        @endif
                    @else
                        {{-- Find component mode --}}
                        <div class="col-span-1 left">
                            <label for="find_comp" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                            <div class="w-100 py-2">
                                @if ($dimen == '2d')
                                    <select wire:model.live="find" id="find" class="input">
                                        <option value="x">x</option>
                                        <option value="y">y</option>
                                    </select>
                                @else
                                    <select wire:model.live="find1" id="find1" class="input">
                                        <option value="x">x</option>
                                        <option value="y">y</option>
                                        <option value="z">z</option>
                                    </select>
                                @endif
                            </div>
                        </div>

                        {{-- Input other components --}}
                        <div class="col-span-1">
                            @php 
                                $target = ($dimen == '2d') ? $find : $find1; 
                            @endphp
                            
                            @if ($target != 'x')
                                <div class="mb-4">
                                    <label for="fx" class="font-s-14 text-blue">x</label>
                                    <input type="number" step="any" wire:model.live="fx" id="fx" class="input" />
                                </div>
                            @endif

                            @if ($target != 'y')
                                <div class="mb-4">
                                    <label for="fy" class="font-s-14 text-blue">y</label>
                                    <input type="number" step="any" wire:model.live="fy" id="fy" class="input" />
                                </div>
                            @endif

                            @if ($dimen == '3d' && $target != 'z')
                                <div class="mb-4">
                                    <label for="fz" class="font-s-14 text-blue">z</label>
                                    <input type="number" step="any" wire:model.live="fz" id="fz" class="input" />
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @php
                                    $vx = $detail['vx'] ?? 0;
                                    $vy = $detail['vy'] ?? 0;
                                    $vz = $detail['vz'] ?? 0;
                                    $ex = $detail['fx'] ?? $fx;
                                    $ey = $detail['fy'] ?? $fy;
                                    $ez = $detail['fz'] ?? $fz;
                                    $deg = $detail['deg'] ?? 0;
                                    $magnitude = $detail['magnitude'] ?? 1;
                                    $x_val = $detail['x'] ?? $x;
                                    $y_val = $detail['y'] ?? $y;
                                    $z_val = $detail['z'] ?? $z;
                                @endphp

                                <p class="mt-2"><strong>{{ $lang[6] }}</strong></p>

                                @if ($method === 'normalize')
                                    <p class="mt-2 text-xl font-bold">
                                        \( (x, y{{ $dimen === '3d' ? ', z' : '' }}) = ({{ round($vx, 5) }}, {{ round($vy, 5) }}{{ $dimen === '3d' ? ', ' . round($vz, 5) : '' }}) \)
                                    </p>
                                    
                                    <div class="mt-6 space-y-4">
                                        <p><strong>{{ $lang[7] }}:</strong></p>
                                        <p><strong>{{ $lang[8] }}:</strong></p>
                                        @if ($dimen == '2d')
                                            <p>\( (x, y) = ({{ $x_val }}, {{ $y_val }}) \)</p>
                                        @else
                                            <p>\( (x, y, z) = ({{ $x_val }}, {{ $y_val }}, {{ $z_val }}) \)</p>
                                        @endif

                                        <p><strong>{{ $lang[9] }}:</strong></p>
                                        <p>\( |\vec v| = {{ round($magnitude, 5) }} \)</p>
                                        <p class="text-sm opacity-75">({{ $lang[10] }} <a href="{{ env('CURRENT_CALCULATOR_URL') }}/vector-magnitude-calculator/" target="_blank" class="text-blue-500 underline">Vector Magnitude Calculator</a> {{ $lang[11] }})</p>

                                        @if ($dimen == '2d')
                                            <p><strong>{{ $lang[12] }} θ:</strong></p>
                                            <p>\( θ = {{ round($deg, 4) }}^\circ \)</p>
                                        @endif

                                        <p>{{ $lang[13] }}.</p>
                                        <p><strong>{{ $lang[14] }}:</strong></p>
                                        <p>\( \vec e = \left (\dfrac{ {{ $x_val }} }{ {{ round($magnitude, 4) }} }, \dfrac{ {{ $y_val }} }{ {{ round($magnitude, 4) }} }{{ $dimen === '3d' ? ", \\dfrac{ $z_val }{ " . round($magnitude, 4) . " }" : "" }} \right ) \)</p>
                                        <p>\( \vec e \approx ({{ round($vx, 5) }}, {{ round($vy, 5) }}{{ $dimen === '3d' ? ", " . round($vz, 5) : "" }}) \)</p>
                                    </div>
                                @elseif ($method === 'find')
                                    <div class="mt-4 space-y-4">
                                        @if ($dimen == '2d')
                                            <p class="text-xl font-bold">
                                                \( (x, y) = ({{ isset($detail['fx']) ? '\color{#ff6d00}{' . round($detail['fx'], 4) . '}' : $fx }}, {{ isset($detail['fy']) ? '\color{#ff6d00}{' . round($detail['fy'], 4) . '}' : $fy }}) \)
                                            </p>
                                        @else
                                            <p class="text-xl font-bold">
                                                \( (x, y, z) = ({{ isset($detail['fx']) ? '\color{#ff6d00}{' . round($detail['fx'], 4) . '}' : $fx }}, {{ isset($detail['fy']) ? '\color{#ff6d00}{' . round($detail['fy'], 4) . '}' : $fy }}, {{ isset($detail['fz']) ? '\color{#ff6d00}{' . round($detail['fz'], 4) . '}' : $fz }}) \)
                                            </p>
                                        @endif
                                        
                                        <p><strong>{{ $lang[15] }}</strong></p>
                                        <p>\( |\vec e| = 1 \)</p>
                                        
                                        @if ($dimen == '2d')
                                            <p><strong>{{ $lang[12] }} θ:</strong></p>
                                            <p>\( θ = {{ round($deg, 4) }}^\circ \)</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    <link rel="stylesheet" href="{{ asset('katex/katex.min.css') }}">
    <script defer src="{{ asset('katex/katex.min.js') }}"></script>
    <script defer src="{{ asset('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('initKaTeX', () => {
               setTimeout(() => {
                   if (typeof renderMathInElement === 'function') {
                       renderMathInElement(document.body);
                   }
               }, 100);
           });
        });

        // Trigger KaTeX on initial load if result exists
        window.addEventListener('load', () => {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        });
    </script>
</div>
