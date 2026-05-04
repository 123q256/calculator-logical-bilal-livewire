<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[90%] w-full">
                    <div class="row">
                        <div class="col-12 col-lg-9 mt-2 lg:w-[90%] w-full mx-auto">
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $to_cal === 'decimal' ? 'tagsUnit' : '' }}"
                                        wire:click="$set('to_cal', 'decimal')">
                                        {{ $lang['1'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $to_cal === 'mint' ? 'tagsUnit' : '' }}"
                                        wire:click="$set('to_cal', 'mint')">
                                        {{ $lang['2'] }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mx-auto">
                            <div class="row">
                                {{-- Decimal Mode --}}
                                @if ($to_cal === 'decimal')
                                    <div class="lg:w-[80%] w-full mx-auto mt-5">
                                    <p class="font-bold mb-4">{{ $lang['5'] }} 1</p>
                                    <div class="grid grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="lat1" class="text-sm block">{{ $lang['3'] }} 1:</label>
                                            <input type="number" step="any" wire:model.live="lat1" id="lat1"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                                        </div>
                                        <div>
                                            <label for="long1" class="text-sm block">{{ $lang['4'] }} 1:</label>
                                            <input type="number" step="any" wire:model.live="long1" id="long1"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                                        </div>
                                    </div>

                                    <p class="font-bold mt-6 mb-4">{{ $lang['5'] }} 2</p>
                                    <div class="grid grid-cols-2 gap-4 mt-2">
                                        <div>
                                            <label for="lat2" class="text-sm block">{{ $lang['3'] }} 2:</label>
                                            <input type="number" step="any" wire:model.live="lat2" id="lat2"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                                        </div>
                                        <div>
                                            <label for="long2" class="text-sm block">{{ $lang['4'] }} 2:</label>
                                            <input type="number" step="any" wire:model.live="long2" id="long2"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                                        </div>
                                    </div>
                                    </div>
                                @endif

                                {{-- DMS Mode --}}
                                @if ($to_cal === 'mint')
                                    <div class="mt-5">
                                    <p class="mb-2 font-bold">{{ $lang['5'] }} 1</p>
                                    <div class="lg:flex items-center">
                                        <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">{{ $lang['3'] }}</div>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['6'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="deg1"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['7'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="mint1"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['8'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="sec1"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div>
                                                <label class="label">&nbsp;</label>
                                                <div class="w-full py-2">
                                                    <select wire:model.live="dir1" class="w-full border border-gray-300 rounded-md p-2">
                                                        <option value="N">N</option>
                                                        <option value="S">S</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:flex items-center">
                                        <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">{{ $lang['4'] }}</div>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['6'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="deg2"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['7'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="mint2"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['8'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="sec2"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:mt-2">
                                                <label class="label">&nbsp;</label>
                                                <div class="w-full py-2">
                                                    <select wire:model.live="dir2" class="w-full border border-gray-300 rounded-md p-2">
                                                        <option value="E">E</option>
                                                        <option value="W">W</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-2 font-bold">{{ $lang['5'] }} 2</p>
                                    <div class="lg:flex items-center">
                                        <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">{{ $lang['3'] }}</div>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['6'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="deg21"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['7'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="mint21"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:pr-2">
                                                <label class="label">{{ $lang['8'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="sec21"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:mt-2">
                                                <label class="label">&nbsp;</label>
                                                <div class="w-full py-2">
                                                    <select wire:model.live="dir21" class="w-full border border-gray-300 rounded-md p-2">
                                                        <option value="N">N</option>
                                                        <option value="S">S</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lg:flex items-center">
                                        <div class="lg:w-[10%] w-full mt-0 pt-2 lg:mt-2 lg:pr-2">{{ $lang['4'] }}</div>
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-2">
                                            <div class="lg:mt-2 lg:pr-2">
                                                <label class="label">{{ $lang['6'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="deg22"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:mt-2 lg:pr-2">
                                                <label class="label">{{ $lang['7'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="mint22"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="lg:mt-2 lg:pr-2">
                                                <label class="label">{{ $lang['8'] }}:</label>
                                                <div class="w-full py-2">
                                                    <input type="number" step="any" wire:model.live="sec22"
                                                        class="w-full border border-gray-300 rounded-md p-2" />
                                                </div>
                                            </div>
                                            <div class="mt-0 lg:mt-2">
                                                <label class="label">&nbsp;</label>
                                                <div class="w-full py-2">
                                                    <select wire:model.live="dir22" class="w-full border border-gray-300 rounded-md p-2">
                                                        <option value="E">E</option>
                                                        <option value="W">W</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg ">
                        <div class="w-full col-12 p-3 rounded-lg">
                            <div class="my-4">
                                <div class="w-full lg:w-10/12">
                                    <p class="font-bold text-lg">{{ $lang['9'] }}</p>
                                    <table class="w-full text-lg mt-4">
                                        @if ($to_cal === 'decimal')
                                            <tr>
                                                <td colspan="2" class="py-2">[{{ $lat1 }}, {{ $long1 }}]
                                                    {{ $lang['10'] }} [{{ $lat2 }}, {{ $long2 }}]</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 pr-4">{{ number_format($detail['mile'] ?? 0, 1) }}</td>
                                                <td class="py-2">Miles</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 pr-4">{{ number_format($detail['km'] ?? 0, 1) }}</td>
                                                <td class="py-2">KM</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="2" class="py-2">
                                                    [{{ $deg1 }}° {{ $mint1 }}' {{ $sec1 }}" {{ $dir1 }},
                                                    {{ $deg2 }}° {{ $mint2 }}' {{ $sec2 }}" {{ $dir2 }}]
                                                    <br>{{ $lang['10'] }} <br>
                                                    [{{ $deg21 }}° {{ $mint21 }}' {{ $sec21 }}" {{ $dir21 }},
                                                    {{ $deg22 }}° {{ $mint22 }}' {{ $sec22 }}" {{ $dir22 }}]
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 pr-4">{{ number_format($detail['mile'] ?? 0, 1) }}</td>
                                                <td class="py-2 ">Miles</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 pr-4">{{ number_format($detail['km'] ?? 0, 1) }}</td>
                                                <td class="py-2 ">KM</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
