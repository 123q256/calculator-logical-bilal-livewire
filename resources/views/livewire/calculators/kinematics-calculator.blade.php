<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <div class="col-span-12">
                        <label for="known" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input" wire:model.live="known" id="known">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                                <option value="4">{{ $lang['5'] }}</option>
                                <option value="5">{{ $lang['6'] }}</option>
                                <option value="6">{{ $lang['7'] }}</option>
                                <option value="7">{{ $lang['8'] }}</option>
                                <option value="8">{{ $lang['9'] }}</option>
                                <option value="9">{{ $lang['10'] }}</option>
                                <option value="10">{{ $lang['11'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Distance (cdis) --}}
                    @if (in_array($known, [5, 6, 7, 8, 9, 10]))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_dis">
                            <label for="cdis" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="cdis" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('cdisU')">{{ $cdisU }} ▾</label>
                                @if ($openDropdown === 'cdisU')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m', 'cm', 'in', 'ft', 'km', 'mi', 'yd'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('cdisU', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Initial Velocity (iv) --}}
                    @if (in_array($known, [1, 2, 3, 5, 7, 9]))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_vli">
                            <label for="iv" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="iv" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('ivU')">{{ $ivU }} ▾</label>
                                @if ($openDropdown === 'ivU')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m/s', 'ft/s', 'km/h', 'km/s', 'mi/s', 'mph'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('ivU', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Final Velocity (fv) --}}
                    @if (in_array($known, [1, 2, 4, 6, 8, 9]))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_vlf">
                            <label for="fv" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="fv" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('fvU')">{{ $fvU }} ▾</label>
                                @if ($openDropdown === 'fvU')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m/s', 'ft/s', 'km/h', 'km/s', 'mi/s', 'mph'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('fvU', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Time (ct) --}}
                    @if (in_array($known, [1, 3, 4, 5, 6, 10]))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_tim">
                            <label for="ct" class="font-s-14 text-blue">{{ $lang['15'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="ct" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('ctU')">{{ $ctU }} ▾</label>
                                @if ($openDropdown === 'ctU')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['sec', 'min', 'h'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('ctU', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Acceleration (cac) --}}
                    @if (in_array($known, [2, 3, 4, 7, 8, 10]))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_acc">
                            <label for="cac" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="cac" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('cacU')">{{ $cacU }} ▾</label>
                                @if ($openDropdown === 'cacU')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m/s²', 'ft/s²'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('cacU', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
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
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                                <table class="w-full text-[18px]">
                                    @if (isset($detail['ans']))
                                        @foreach ($detail['ans'] as $ans)
                                            <tr>
                                                <td class="py-2 border-b" width="50%"><strong>{{ $ans['label'] }}</strong>
                                                </td>
                                                <td class="py-2 border-b">{{ $ans['value'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @if (isset($detail['frms']))
                                        @foreach ($detail['frms'] as $frm)
                                            <tr wire:key="frm-row-{{ md5($frm['label'] . $frm['value']) }}">
                                                <td class="py-2 border-b" width="50%" wire:ignore>
                                                    <strong>\({{ $frm['label'] }}\)</strong>
                                                </td>
                                                <td class="py-2 border-b" wire:ignore>
                                                    <strong>\({{ $frm['value'] }}\)</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                                <p class="col"><strong>{{ $lang['17'] }}</strong></p>
                                <table class="w-full text-[18px]">
                                    @if (isset($detail['knowns']))
                                        @foreach ($detail['knowns'] as $kn)
                                            <tr>
                                                <td class="py-2 border-b" width="50%">{{ $kn['label'] }}</td>
                                                <td class="py-2 border-b"><strong>{{ $kn['value'] }}</strong></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @if (isset($detail))
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morph.updated', () => {
                    setTimeout(() => {
                        if (window.MathJax) {
                            MathJax.typesetPromise();
                        }
                    }, 50);
                });
            });
        </script>
    @endif
</div>
