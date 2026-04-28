<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 grid grid-cols-1 gap-4">
                        <div class="space-y-2">
                            <label for="type_field" class="font-s-14 text-blue">{{ $lang[1] ?? 'Type' }}:</label>
                            <select wire:model.live="type_field" id="type_field" class="input">
                                <option value="1">{{ $lang[2] ?? 'Tension on a string' }}</option>
                                <option value="2">{{ $lang[3] ?? 'Tension on an incline' }}</option>
                            </select>
                        </div>

                        {{-- Mode 1: Tension on a string --}}
                        @if ($type_field == '1')
                            <div class="space-y-2">
                                <label for="operations1" class="font-s-14 text-blue">{{ $lang[4] ?? 'Operations' }}:</label>
                                <select wire:model.live="operations1" id="operations1" class="input">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        @endif

                        {{-- Mode 2: Tension on an incline --}}
                        @if ($type_field == '2')
                            <div class="space-y-2">
                                <label for="operations2" class="font-s-14 text-blue">{{ $lang[5] ?? 'Operations' }}:</label>
                                <select wire:model.live="operations2" id="operations2" class="input">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        @endif

                        {{-- Input 1: Mass --}}
                        <div class="space-y-2">
                            <label for="first" class="font-s-14 text-blue">
                                @if($type_field == '2' && ($operations2 == '2' || $operations2 == '3'))
                                    First object's Mass:
                                @else
                                    Object's Mass:
                                @endif
                            </label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="first" id="first" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit1')">{{ $unit1 }} ▾</label>
                                @if ($openDropdown === 'unit1')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['mg', 'g', 'kg', 't', 'oz', 'lb'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit1', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Input 2: Second Mass (Conditional) --}}
                        @if ($type_field == '2' && ($operations2 == '2' || $operations2 == '3'))
                            <div class="space-y-2">
                                <label for="second" class="font-s-14 text-blue">Second object's Mass:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="second" id="second" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit2')">{{ $unit2 }} ▾</label>
                                    @if ($openDropdown === 'unit2')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['mg', 'g', 'kg', 't', 'oz', 'lb'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit2', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Input 3: Third Mass (Conditional) --}}
                        @if ($type_field == '2' && $operations2 == '3')
                            <div class="space-y-2">
                                <label for="third" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Mass' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="third" id="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit3')">{{ $unit3 }} ▾</label>
                                    @if ($openDropdown === 'unit3')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['mg', 'g', 'kg', 't', 'oz', 'lb'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit3', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Input 4: Gravity (Conditional) --}}
                        @if ($type_field == '1')
                            <div class="space-y-2">
                                <label for="four" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Gravity' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="four" id="four" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit4')">{{ $unit4 }} ▾</label>
                                    @if ($openDropdown === 'unit4')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['m/s²', 'g', 'ft/s²'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit4', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Input 5: Angle Alpha / Theta --}}
                        @if (($type_field == '1' && $operations1 == '2') || $type_field == '2')
                            <div class="space-y-2">
                                <label for="five" class="font-s-14 text-blue">
                                    @if($type_field == '1') Angle α: @else Angle θ: @endif
                                </label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="five" id="five" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit5')">{{ $unit5 }} ▾</label>
                                    @if ($openDropdown === 'unit5')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['deg', 'rad', 'gon'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit5', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Input 6: Angle Beta (Conditional) --}}
                        @if ($type_field == '1' && $operations1 == '2')
                            <div class="space-y-2">
                                <label for="six" class="font-s-14 text-blue">Angle β:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="six" id="six" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit6')">{{ $unit6 }} ▾</label>
                                    @if ($openDropdown === 'unit6')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['deg', 'rad', 'gon'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit6', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Input 7: Tension / Acceleration (Conditional) --}}
                        @if ($type_field == '2')
                            <div class="space-y-2">
                                <label for="seven" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Tension' }}:</label>
                                <div class="relative w-full">
                                    <input type="number" step="any" wire:model.live="seven" id="seven" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('unit7')">{{ $unit7 }} ▾</label>
                                    @if ($openDropdown === 'unit7')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['N', 'kN', 'MN', 'lbf', 'kip'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit7', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Image and Visualization --}}
                    <div class="lg:space-y-[50px] md:space-y-[50px] space-y-2 flex flex-col items-center">
                        <div class="w-full text-center">
                            @if ($type_field == '1')
                                @if ($operations1 == '1')
                                    <img src="{{ url('assets/img/tension1.webp') }}" alt="Tension 1" width="300" class="mx-auto">
                                @else
                                    <img src="{{ url('assets/img/tension2.webp') }}" alt="Tension 2" width="300" class="mx-auto">
                                @endif
                            @else
                                @if ($operations2 == '1')
                                    <img src="{{ url('assets/img/tension3.webp') }}" alt="Tension 3" width="300" class="mx-auto">
                                @elseif ($operations2 == '2')
                                    <img src="{{ url('assets/img/tension4.webp') }}" alt="Tension 4" width="300" class="mx-auto">
                                @else
                                    <img src="{{ url('assets/img/tension5.webp') }}" alt="Tension 5" width="300" class="mx-auto">
                                @endif
                            @endif
                        </div>
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
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 mt-5">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <p class="col-12 mt-2 font-s-21"><strong class="text-blue">{{ $lang[12] ?? 'Result' }}</strong></p>
                        
                        <div class="col-lg-6 mt-2 overflow-auto">
                            <table class="w-full font-s-18">
                                @if (isset($detail['weight']))
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[13] ?? 'Weight' }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['weight'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['t_ans'], 4) }} (N)</strong></td>
                                    </tr>
                                @elseif (isset($detail['weight2']))
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[13] ?? 'Weight' }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['weight2'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['t1_ans'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 2</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['t2_ans'], 4) }} (N)</strong></td>
                                    </tr>
                                @elseif (isset($detail['op21']))
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[15] ?? 'Acceleration' }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} (m/s²)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['op21'], 4) }} (N)</strong></td>
                                    </tr>
                                @elseif (isset($detail['op22']))
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[15] ?? 'Acceleration' }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} (m/s²)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['op22'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 2</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['answer2'], 4) }} (N)</strong></td>
                                    </tr>
                                @elseif (isset($detail['op23']))
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[15] ?? 'Acceleration' }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['ans'], 4) }} (m/s²)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 1</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['answer2'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 2</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['op23'], 4) }} (N)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">{{ $lang[14] ?? 'Tension' }} 3</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['answer4'], 4) }} (N)</strong></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            jax: ["input/TeX", "input/AsciiMath", "output/CommonHTML"],
            extensions: ["tex2jax.js", "asciimath2jax.js"],
            tex2jax: { inlineMath: [['`','`']] },
            messageStyle: "none"
        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('initKaTeX', () => {
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    }
                }, 100);
            });

            Livewire.hook('morph.updated', (el, component) => {
                if (window.MathJax) {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            });
        });
    </script>
    @endpush
</div>
