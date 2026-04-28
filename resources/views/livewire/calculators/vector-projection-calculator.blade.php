<div>
  

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Global Controls --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="dimension" class="label">{{ $lang[1] }}</label>
                        <select wire:model.live="dem" id="dimension" class="input">
                            <option value="2">2D</option>
                            <option value="3">3D</option>
                        </select>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="representation_a" class="label">{{ $lang['2'] }} (A) {{ $lang['3'] }}</label>
                        <select wire:model.live="vector_representation" id="representation_a" class="input">
                            <option value="coor">{{ $lang['4'] }}</option>
                            <option value="point">{{ $lang['5'] }}</option>
                        </select>
                    </div>

                    {{-- Vector A Inputs --}}
                    <div class="col-span-12 p-4 bg-blue-50 rounded-lg">
                        <p class="font-bold text-blue-700 mb-4">{{ $lang[2] }} (a)</p>
                        @if ($vector_representation == 'coor')
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-4 relative">
                                    <input type="text" inputmode="decimal" wire:model.live="ax" class="input pr-8" placeholder="x" />
                                    <i class="absolute right-3 top-3 text-blue-600 font-bold">i</i>
                                </div>
                                <div class="col-span-4 relative">
                                    <input type="text" inputmode="decimal" wire:model.live="ay" class="input pr-8" placeholder="y" />
                                    <i class="absolute right-3 top-3 text-blue-600 font-bold">j</i>
                                </div>
                                @if ($dem == '3')
                                    <div class="col-span-4 relative">
                                        <input type="text" inputmode="decimal" wire:model.live="az" class="input pr-8" placeholder="z" />
                                        <i class="absolute right-3 top-3 text-blue-600 font-bold">k</i>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6 space-y-4">
                                    <p class="text-sm font-semibold text-gray-600 border-b">{{ $lang[6] }}</p>
                                    <div class="grid grid-cols-3 gap-2">
                                        <input type="text" inputmode="decimal" wire:model.live="first_a" class="input" placeholder="x1" />
                                        <input type="text" inputmode="decimal" wire:model.live="second_a" class="input" placeholder="y1" />
                                        @if ($dem == '3')
                                            <input type="text" inputmode="decimal" wire:model.live="third_a" class="input" placeholder="z1" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-6 space-y-4">
                                    <p class="text-sm font-semibold text-gray-600 border-b">{{ $lang[7] }}</p>
                                    <div class="grid grid-cols-3 gap-2">
                                        <input type="text" inputmode="decimal" wire:model.live="first_b" class="input" placeholder="x2" />
                                        <input type="text" inputmode="decimal" wire:model.live="second_b" class="input" placeholder="y2" />
                                        @if ($dem == '3')
                                            <input type="text" inputmode="decimal" wire:model.live="third_b" class="input" placeholder="z2" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Vector B Representation Toggle --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="representation_b" class="label">{{ $lang['2'] }} (B) {{ $lang['3'] }}</label>
                        <select wire:model.live="vector_b" id="representation_b" class="input">
                            <option value="coor">{{ $lang['4'] }}</option>
                            <option value="point">{{ $lang['5'] }}</option>
                        </select>
                    </div>

                    {{-- Vector B Inputs --}}
                    <div class="col-span-12 p-4 bg-gray-50 rounded-lg">
                        <p class="font-bold text-gray-700 mb-4">{{ $lang[8] }} (b)</p>
                        @if ($vector_b == 'coor')
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-4 relative">
                                    <input type="text" inputmode="decimal" wire:model.live="bx" class="input pr-8" placeholder="x" />
                                    <i class="absolute right-3 top-3 text-gray-600 font-bold">i</i>
                                </div>
                                <div class="col-span-4 relative">
                                    <input type="text" inputmode="decimal" wire:model.live="by" class="input pr-8" placeholder="y" />
                                    <i class="absolute right-3 top-3 text-gray-600 font-bold">j</i>
                                </div>
                                @if ($dem == '3')
                                    <div class="col-span-4 relative">
                                        <input type="text" inputmode="decimal" wire:model.live="bz" class="input pr-8" placeholder="z" />
                                        <i class="absolute right-3 top-3 text-gray-600 font-bold">k</i>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6 space-y-4">
                                    <p class="text-sm font-semibold text-gray-600 border-b">{{ $lang[6] }}</p>
                                    <div class="grid grid-cols-3 gap-2">
                                        <input type="text" inputmode="decimal" wire:model.live="first_aa" class="input" placeholder="x1" />
                                        <input type="text" inputmode="decimal" wire:model.live="second_aa" class="input" placeholder="y1" />
                                        @if ($dem == '3')
                                            <input type="text" inputmode="decimal" wire:model.live="third_aa" class="input" placeholder="z1" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-6 space-y-4">
                                    <p class="text-sm font-semibold text-gray-600 border-b">{{ $lang[7] }}</p>
                                    <div class="grid grid-cols-3 gap-2">
                                        <input type="text" inputmode="decimal" wire:model.live="first_bb" class="input" placeholder="x2" />
                                        <input type="text" inputmode="decimal" wire:model.live="second_bb" class="input" placeholder="y2" />
                                        @if ($dem == '3')
                                            <input type="text" inputmode="decimal" wire:model.live="third_bb" class="input" placeholder="z2" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="text-left space-y-6 overflow-auto">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    {{-- Vector Projection --}}
                    <div>
                        <p class="text-gray-600 font-semibold mb-2">Vector Projection</p>
                        <div class="text-2xl">
                            @if ($dem == '3')
                                $$\text{proj}_{\vec{u}}(\vec{v}) = \left( \frac{ {{ $detail['call0'] * $detail['ax'] }} }{ {{ $detail['call1'] }} }, \frac{ {{ $detail['call0'] * $detail['ay'] }} }{ {{ $detail['call1'] }} }, \frac{ {{ $detail['call0'] * $detail['az'] }} }{ {{ $detail['call1'] }} } \right)$$
                            @else
                                $$\text{proj}_{\vec{u}}(\vec{v}) = \left( \frac{ {{ $detail['call0'] * $detail['ax'] }} }{ {{ $detail['call1'] }} }, \frac{ {{ $detail['call0'] * $detail['ay'] }} }{ {{ $detail['call1'] }} } \right)$$
                            @endif
                        </div>
                    </div>

                    {{-- Scalar Projection --}}
                    <div>
                        <p class="text-gray-600 font-semibold mb-2">Scalar Projection</p>
                        <div class="text-2xl">
                            $$|\text{proj}_{\vec{u}}(\vec{v})| = \frac{ {{ $detail['vector_unit'] }} }{\sqrt{ {{ $detail['vector_u'] }} }}$$
                        </div>
                    </div>

                    {{-- Steps --}}
                    <div class="space-y-4 pt-4 border-t border-gray-100 mx-auto italic overflow-auto">
                        <p class="text-xl font-bold not-italic">
                            $$\text{Vector Projection} = \text{proj}_{\vec{u}}(\vec{v}) = \frac{\vec{v} \cdot \vec{u}}{||\vec{u}||^2} \vec{u}$$
                        </p>

                        <p class="text-lg">
                            $$\vec{v} \cdot \vec{u} = {{ $detail['vector_unit'] }}$$
                            <span class="text-sm block">(for steps, see <a href="{{ url('dot-product-calculator/') }}" target="_blank" class="text-blue-500 underline">Dot Product Calculator</a>)</span>
                        </p>

                        <p class="text-lg">
                            $$||\vec{u}|| = \sqrt{ {{ $detail['vector_u'] }} }$$
                            <span class="text-sm block">(for steps, see <a href="{{ url('vector-magnitude-calculator/') }}" target="_blank" class="text-blue-500 underline">Vector Magnitude Calculator</a>)</span>
                        </p>

                        <p class="text-xl">
                            @if ($dem == '3')
                                $$\text{proj}_{\vec{u}}(\vec{v}) = \frac{ {{ $detail['vector_unit'] }} }{(\sqrt{ {{ $detail['vector_u'] }} })^2} \cdot ({{ $detail['ax'] }}, {{ $detail['ay'] }}, {{ $detail['az'] }})$$
                            @else
                                $$\text{proj}_{\vec{u}}(\vec{v}) = \frac{ {{ $detail['vector_unit'] }} }{(\sqrt{ {{ $detail['vector_u'] }} })^2} \cdot ({{ $detail['ax'] }}, {{ $detail['ay'] }})$$
                            @endif
                        </p>

                        <p class="text-xl">
                            @if ($dem == '3')
                                $$\text{proj}_{\vec{u}}(\vec{v}) = \frac{ {{ $detail['call0'] }} }{ {{ $detail['call1'] }} } \cdot ({{ $detail['ax'] }}, {{ $detail['ay'] }}, {{ $detail['az'] }})$$
                            @else
                                $$\text{proj}_{\vec{u}}(\vec{v}) = \frac{ {{ $detail['call0'] }} }{ {{ $detail['call1'] }} } \cdot ({{ $detail['ax'] }}, {{ $detail['ay'] }})$$
                            @endif
                        </p>

                        <p class="text-xl font-bold not-italic">
                            @if ($dem == '3')
                                $$\text{Vector Projection proj}_{\vec{u}}(\vec{v}) = \left( \frac{ {{ $detail['call0'] * $detail['ax'] }} }{ {{ $detail['call1'] }} }, \frac{ {{ $detail['call0'] * $detail['ay'] }} }{ {{ $detail['call1'] }} }, \frac{ {{ $detail['call0'] * $detail['az'] }} }{ {{ $detail['call1'] }} } \right)$$
                            @else
                                $$\text{Vector Projection proj}_{\vec{u}}(\vec{v}) = \left( \frac{ {{ $detail['call0'] * $detail['ax'] }} }{ {{ $detail['call1'] }} }, \frac{ {{ $detail['call0'] * $detail['ay'] }} }{ {{ $detail['call1'] }} } \right)$$
                            @endif
                        </p>

                        <p class="text-xl">
                            $$\text{Scalar Projection } |\text{proj}_{\vec{u}}(\vec{v})| = \frac{\vec{v} \cdot \vec{u}}{||\vec{u}||}$$
                        </p>

                        <p class="text-xl font-bold not-italic">
                            $$\text{Scalar Projection } |\text{proj}_{\vec{u}}(\vec{v})| = \frac{ {{ $detail['vector_unit'] }} }{\sqrt{ {{ $detail['vector_u'] }} }}$$
                        </p>
                    </div>
                </div>
            </div>
        @endisset
    </form>
      @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            function performMathRender() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body, {
                        delimiters: [
                            {left: '$$', right: '$$', display: true},
                            {left: '$', right: '$', display: false},
                            {left: '\\(', right: '\\)', display: false},
                            {left: '\\[', right: '\\]', display: true}
                        ],
                        throwOnError : false
                    });
                }
            }

            document.addEventListener('livewire:init', () => {
                performMathRender(); // Initial render
                Livewire.on('mathRendered', (event) => {
                    setTimeout(performMathRender, 200);
                });
            });
        </script>
    @endpush
</div>
