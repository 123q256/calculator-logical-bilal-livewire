<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="col-12 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-all {{ $unit_type === 'm1' ? 'bg-blue-600 text-white shadow-md tagsUnit' : 'text-blue-600 hover:bg-gray-50' }}"
                                wire:click="setUnitType('m1')">
                                Force Calculator
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-all {{ $unit_type === 'm2' ? 'bg-blue-600 text-white shadow-md tagsUnit' : 'text-blue-600 hover:bg-gray-50' }}"
                                wire:click="setUnitType('m2')">
                                Net Force Calculator
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-4">
                    @if($unit_type === 'm1')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4 mt-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="font-s-14 text-blue">{{$lang['1']}}</label>
                                    <div class="w-full py-2">
                                        <select wire:model.live="cal" class="input">
                                            <option value="f">{{$lang[2]}} (F)</option>
                                            <option value="m">{{$lang[3]}} (m)</option>
                                            <option value="a">{{$lang[4]}} (a)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="font-s-14 text-blue">{{$lang['5']}}</label>
                                    <div class="w-full py-2">
                                        <select wire:model.live="sigfig" class="input">
                                            <option value="auto">Auto</option>
                                            @foreach(range(3,9) as $i)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if($cal !== 'f')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label class="font-s-14 text-blue">{{ $lang['2'] }} (F)</label>
                                        <div class="relative w-full mt-[7px]">
                                            <input type="number" wire:model.live="f" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('f_unit_dropdown')">
                                                {{ $f_unit }} ▾
                                            </label>
                                            @if($openDropdown === 'f_unit_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-40 overflow-y-auto">
                                                    @foreach(['dyn','kgf','n','mn','gn','tn','kip','ibf','ozf','pdl'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('f_unit', '{{$u}}')">{{$u}}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($cal !== 'm')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label class="font-s-14 text-blue">{{ $lang['3'] }} (m)</label>
                                        <div class="relative w-full mt-[7px]">
                                            <input type="number" wire:model.live="m" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('m_unit_dropdown')">
                                                {{ $m_unit === 'us_ton' ? 'US ton' : ($m_unit === 'long_ton' ? 'Long ton' : $m_unit) }} ▾
                                            </label>
                                            @if($openDropdown === 'm_unit_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-40 overflow-y-auto">
                                                    @foreach(['ug','mg','g','dag','kg','t','gr','dr','oz','lb','stone','us_ton','long_ton','earths'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('m_unit', '{{$u}}')">{{ $u === 'us_ton' ? 'US ton' : ($u === 'long_ton' ? 'Long ton' : $u) }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($cal !== 'a')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label class="font-s-14 text-blue">{{ $lang['4'] }} (a)</label>
                                        <div class="relative w-full mt-[7px]">
                                            <input type="number" wire:model.live="a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('a_unit_dropdown')">
                                                {{ str_replace(['_s2','_hs'], ['/s²','/(h.s)'], $a_unit) }} ▾
                                            </label>
                                            @if($openDropdown === 'a_unit_dropdown')
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-40 overflow-y-auto">
                                                    @foreach(['in_s2','ft_s2','cm_s2','m_s2','mi_s2','mi_hs','km_s2','km_hs'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('a_unit', '{{$u}}')">{{ str_replace(['_s2','_hs'], ['/s²','/(h.s)'], $u) }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12">
                                    <label class="font-s-14 text-blue">{{$lang['1']}}</label>
                                    <div class="w-full py-2">
                                        <select wire:model.live="question" class="input">
                                            <option value="yes">{{$lang[8]}}</option>
                                            <option value="no">{{$lang[9]}}</option>
                                        </select>
                                    </div>
                                @if($question === 'yes')
                                    <div class="col-span-12" wire:key="q-yes-1">
                                        <label class="font-s-14 text-blue">{{ $lang['10'] }} (a)</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.live="a_f" class="input" placeholder="00" />
                                            <span class="text-blue input_unit">N</span>
                                        </div>
                                    </div>
                                    <div class="col-span-12" wire:key="q-yes-2">
                                        <label class="font-s-14 text-blue">{{ $lang['11'] }} (g)</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.live="g_f" class="input" placeholder="00" />
                                            <span class="text-blue input_unit">N</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-span-12" wire:key="q-no">
                                        <label class="font-s-14 text-blue">{{ $lang['12'] }} (,)</label>
                                        <div class="w-full py-2">
                                            <textarea wire:model.live="f_v" class="input py-2" rows="3"></textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
  
            <hr>
    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="col-12 font-s-20">
                            @if($unit_type === "m1")
                                @php
                                    $ans = $detail['ans'];
                                    if($cal === 'f'){
                                        $head = 'Force (F)';
                                        $m_val = $detail['m'];
                                        $a_val = $detail['a'];
                                    } elseif($cal === 'm'){
                                        $head = 'Mass (m)';
                                        $f_val = $detail['f'];
                                        $a_val = $detail['a'];
                                    } elseif($cal === 'a'){
                                        $head = "Acceleration (a)";
                                        $f_val = $detail['f'];
                                        $m_val = $detail['m'];
                                    }
                                @endphp
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><strong>{{$head}}</strong></td>
                                            <td class="py-2 border-b">{{$ans}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <p class="font-bold mb-2">{{$lang[13]}}:</p>
                                    @if($cal === 'f')
                                        <p>\[ F = m \cdot a \]</p>
                                        <p>\[ F = {{ $m_val }} \text{ kg} \cdot {{ $a_val }} \text{ m/s}^2 \]</p>
                                        <p class="font-bold text-blue-600">\[ F = {{ $m_val * $a_val }} \text{ N} \]</p>
                                    @elseif($cal === 'm')
                                        <p>\[ m = \frac{F}{a} \]</p>
                                        <p>\[ m = \frac{ {{ $f_val }} \text{ N}}{ {{ $a_val }} \text{ m/s}^2} \]</p>
                                        <p class="font-bold text-blue-600">\[ m = {{ $f_val / $a_val }} \text{ kg} \]</p>
                                    @elseif($cal === 'a')
                                        <p>\[ a = \frac{F}{m} \]</p>
                                        <p>\[ a = \frac{ {{ $f_val }} \text{ N}}{ {{ $m_val }} \text{ kg}} \]</p>
                                        <p class="font-bold text-blue-600">\[ a = {{ $f_val / $m_val }} \text{ m/s}^2 \]</p>
                                    @endif
                                </div>
                            @elseif($unit_type === "m2")
                                @php
                                    $nf = $detail['nf'];
                                    $ex = $detail['ex'] ?? null;
                                @endphp
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="40%"><strong>{{$lang[14]}} (n)</strong></td>
                                            <td class="py-2 border-b">{{$nf}} N</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg overflow-auto">
                                    <p class="font-bold mb-2">{{$lang[13]}}:</p>
                                    @if($question === 'yes')
                                        <p>\[ n = a + g \]</p>
                                        <p>\[ n = {{ $a_f }} + {{ $g_f }} \]</p>
                                        <p class="font-bold text-blue-600">\[ n = {{ $nf }} \]</p>
                                    @elseif($question === 'no')
                                        <p>\[ n = \Sigma(x) \]</p>
                                        <p>\[ n = {{ $ex }} \]</p>
                                        <p class="font-bold text-blue-600">\[ n = {{ $nf }} \]</p>
                                    @endif
                                </div>
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
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            function renderMath() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }
            document.addEventListener('livewire:navigated', renderMath);
            document.addEventListener('livewire:init', () => {
                Livewire.on('math-rendered', () => {
                    setTimeout(renderMath, 150);
                });
            });
            // Re-render math after any Livewire update
            document.addEventListener('livewire:update', renderMath);
        </script>
    @endpush
      </form>
</div>
