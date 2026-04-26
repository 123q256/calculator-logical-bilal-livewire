<div>
    <style>
        .calculator-box .katex-display {
            margin: 0rem !important;
        }
    </style>
    
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto space-y-8">
                <!-- Vector A Section -->
                <div class="space-y-4 border-b pb-6 border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <h3 class="font-bold text-lg text-gray-800 shrink-0">{{ $lang['a'] ?? 'First vector (a)' }}</h3>
                        <div class="w-full md:w-auto grow max-w-md">
                            <select wire:model.live="a_rep" class="border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 outline-none focus:ring-0 w-full">
                                <option value="coor">{{ $lang['coor'] ?? 'by Coordinates' }}</option>
                                <option value="point">{{ $lang['point'] ?? 'by Points' }}</option>
                            </select>
                        </div>
                    </div>

                    @if($a_rep == 'coor')
                    <div class="grid grid-cols-3 gap-4">
                        <div class="relative">
                            <input type="number" wire:model.live="ax" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none pr-8" placeholder="50" />
                            <span class="absolute right-3 top-2.5 text-blue-600 font-bold">i</span>
                        </div>
                        <div class="relative">
                            <input type="number" wire:model.live="ay" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none pr-8" placeholder="50" />
                            <span class="absolute right-3 top-2.5 text-blue-600 font-bold">j</span>
                        </div>
                        <div class="relative">
                            <input type="number" wire:model.live="az" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none pr-8" placeholder="50" />
                            <span class="absolute right-3 top-2.5 text-blue-600 font-bold">k</span>
                        </div>
                    </div>
                    @else
                    <div class="space-y-4">
                        <p class="text-sm font-medium text-gray-500 italic">{{ $lang['ini'] ?? 'Initial Point' }} (A)</p>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="number" wire:model.live="a1" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Ax" />
                            <input type="number" wire:model.live="a2" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Ay" />
                            <input type="number" wire:model.live="a3" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Az" />
                        </div>
                        <p class="text-sm font-medium text-gray-500 italic">{{ $lang['ter'] ?? 'Terminal Point' }} (B)</p>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="number" wire:model.live="b1" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Bx" />
                            <input type="number" wire:model.live="b2" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="By" />
                            <input type="number" wire:model.live="b3" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Bz" />
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Vector B Section -->
                <div class="space-y-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <h3 class="font-bold text-lg text-gray-800 shrink-0">{{ $lang['b'] ?? 'Second vector (b)' }}</h3>
                        <div class="w-full md:w-auto grow max-w-md">
                            <select wire:model.live="b_rep" class="border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 outline-none focus:ring-0 w-full">
                                <option value="coor">{{ $lang['coor'] ?? 'by Coordinates' }}</option>
                                <option value="point">{{ $lang['point'] ?? 'by Points' }}</option>
                            </select>
                        </div>
                    </div>

                    @if($b_rep == 'coor')
                    <div class="grid grid-cols-3 gap-4">
                        <div class="relative">
                            <input type="number" wire:model.live="bx" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none pr-8" placeholder="7" />
                            <span class="absolute right-3 top-2.5 text-blue-600 font-bold">i</span>
                        </div>
                        <div class="relative">
                            <input type="number" wire:model.live="by" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none pr-8" placeholder="8" />
                            <span class="absolute right-3 top-2.5 text-blue-600 font-bold">j</span>
                        </div>
                        <div class="relative">
                            <input type="number" wire:model.live="bz" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none pr-8" placeholder="9" />
                            <span class="absolute right-3 top-2.5 text-blue-600 font-bold">k</span>
                        </div>
                    </div>
                    @else
                    <div class="space-y-4">
                        <p class="text-sm font-medium text-gray-500 italic">{{ $lang['ini'] ?? 'Initial Point' }} (A)</p>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="number" wire:model.live="aa1" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Ax" />
                            <input type="number" wire:model.live="aa2" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Ay" />
                            <input type="number" wire:model.live="aa3" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Az" />
                        </div>
                        <p class="text-sm font-medium text-gray-500 italic">{{ $lang['ter'] ?? 'Terminal Point' }} (B)</p>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="number" wire:model.live="bb1" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Bx" />
                            <input type="number" wire:model.live="bb2" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="By" />
                            <input type="number" wire:model.live="bb3" step="any" class="border border-gray-300 p-2 rounded-lg w-full outline-none" placeholder="Bz" />
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="w-full flex justify-center mt-6">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        @if($detail)
        <hr class="my-8">
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
            <div class="space-y-6">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif

                <div class="bg-white p-6 rounded-xl space-y-6">
                    <div>
                        <h4 class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-4">{{ $lang['input'] ?? 'Input Vectors' }}</h4>
                        <div class="space-y-4 overflow-auto">
                            @if($a_rep == 'point')
                                <p class="math">$$\vec a = \vec {AB} = (B_x-A_x , B_y-A_y , B_z-A_z) = ({{$b1}}-({{$a1}}) , {{$b2}}-({{$a2}}) , {{$b3}}-({{$a3}})) = ({{$res_ax}} , {{$res_ay}} , {{$res_az}})$$</p>
                            @endif
                            <p class="math text-xl">$$\vec a = {{$res_ax}} \vec i {{(($res_ay < 0) ? $res_ay : "+" . $res_ay)}} \vec j {{(($res_az < 0) ? $res_az : "+" . $res_az)}} \vec k$$</p>
                            
                            @if($b_rep == 'point')
                                <p class="math">$$\vec b = \vec {AB} = (B_x-A_x , B_y-A_y , B_z-A_z) = ({{$bb1}}-({{$aa1}}) , {{$bb2}}-({{$aa2}}) , {{$bb3}}-({{$aa3}})) = ({{$res_bx}} , {{$res_by}} , {{$res_bz}})$$</p>
                            @endif
                            <p class="math text-xl">$$\vec b = {{$res_bx}} \vec i {{(($res_by < 0) ? $res_by : "+" . $res_by)}} \vec j {{(($res_bz < 0) ? $res_bz : "+" . $res_bz)}} \vec k$$</p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-4">{{ $lang['sol'] ?? 'Step-by-Step Solution' }}</h4>
                        <div class="space-y-6 overflow-x-auto pb-4 overflow-auto">
                            <p class="math">$$\vec a \times \vec b = \begin{vmatrix} i & j & k \\ a_x & a_y & a_z \\ b_x & b_y & b_z \end{vmatrix} = \begin{vmatrix} i & j & k \\ {{$res_ax}} & {{$res_ay}} & {{$res_az}} \\ {{$res_bx}} & {{$res_by}} & {{$res_bz}} \end{vmatrix}$$</p>
                            
                            <p class="math">$$= \begin{vmatrix} {{$res_ay}} & {{$res_az}} \\ {{$res_by}} & {{$res_bz}} \end{vmatrix} \vec i - \begin{vmatrix} {{$res_ax}} & {{$res_az}} \\ {{$res_bx}} & {{$res_bz}} \end{vmatrix} \vec j + \begin{vmatrix} {{$res_ax}} & {{$res_ay}} \\ {{$res_bx}} & {{$res_by}} \end{vmatrix} \vec k$$</p>
                            
                            <p class="math">$$= (({{$res_ay}} \cdot {{$res_bz}}) - ({{$res_by}} \cdot {{$res_az}}))\vec i - (({{$res_ax}} \cdot {{$res_bz}}) - ({{$res_bx}} \cdot {{$res_az}}))\vec j + (({{$res_ax}} \cdot {{$res_by}}) - ({{$res_bx}} \cdot {{$res_ay}}))\vec k$$</p>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h4 class="text-blue-800 text-sm font-bold uppercase tracking-wider mb-4">{{ $lang['ans'] ?? 'Final Result' }}</h4>
                        <div class="space-y-4 overflow-auto">
                            <p class="math text-2xl text-blue-900 font-bold">$$\vec a \times \vec b = {{$ans_a1}} \vec i {{(($ans_a2 < 0) ? $ans_a2 : "+" . $ans_a2)}} \vec j {{(($ans_a3 < 0) ? $ans_a3 : "+" . $ans_a3)}} \vec k$$</p>
                            <p class="math text-lg text-blue-700">$$\vec a \times \vec b = ({{$ans_a1}}, {{$ans_a2}}, {{$ans_a3}})$$</p>
                            <hr class="border-blue-200 my-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-600 uppercase text-lg font-bold">{{ $lang['vecm'] ?? 'Vector Magnitude' }}</p>
                                    <p class="text-lg font-bold">|a × b| = {{ $megni }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 uppercase text-lg font-bold">{{ $lang['scoor'] ?? 'Spherical Coordinates' }}</p>
                                    <p class="text-lg">r = {{ $megni }}, θ = {{ round($polar, 4) }}°, φ = {{ round($phi, 4) }}°</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body, {
            delimiters: [
                {left: '$$', right: '$$', display: true},
                {left: '$', right: '$', display: false}
            ]
        });"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('math-rendered', () => {
                    setTimeout(() => {
                        renderMathInElement(document.body);
                    }, 50);
                });
            });
        </script>
    @endpush
</div>
