<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
      
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto space-y-4">

                <!-- FROM SELECT (Full Width Top) -->
                <div class="space-y-2 relative w-full">
                    <label for="from" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
                    <select name="from" id="from" wire:model="from" wire:change="changeFrom"
                        class="input my-2 w-full">
                        <option value="1">{{ $lang['rise'] }} & {{ $lang['run'] }}</option>
                        <option value="2">{{ $lang['rise'] }} & {{ $lang['rafter'] }}</option>
                        <option value="3">{{ $lang['run'] }} & {{ $lang['rafter'] }}</option>
                        <option value="4">{{ $lang['rise'] }} & {{ $lang['pit'] }} (%)</option>
                        <option value="5">{{ $lang['rise'] }} & {{ $lang['roof'] }}</option>
                        <option value="6">{{ $lang['rise'] }} & {{ $lang['pit'] }} (x:12)</option>
                        <option value="7">{{ $lang['run'] }} & {{ $lang['pit'] }} (%)</option>
                        <option value="8">{{ $lang['run'] }} & {{ $lang['roof'] }}</option>
                        <option value="9">{{ $lang['run'] }} & {{ $lang['pit'] }} (x:12)</option>
                    </select>
                </div>

                <!-- X & Y Inputs in One Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- X INPUT -->
                    <div class="space-y-2">
                        <label for="x" class="font-s-14 text-blue change-1">
                            @if (in_array($from, [3, 7, 8, 9]))
                                {{ $lang['run'] }}
                            @else
                                {{ $lang['rise'] }}
                            @endif
                        </label>
                        <div class="relative w-full">
                            <input type="number" name="x" id="x" step="any" wire:model="x"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click="toggleUnitDropdown">
                                {{ $unit }} ▾
                            </label>
                            <input type="hidden" name="unit" id="unit" value="{{ $unit }}" />
                            @if ($showUnitDropdown)
                                <div
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('m')">meter (m)
                                    </p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('in')">inch (in)
                                    </p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('yd')">yard (yd)
                                    </p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ft')">foot (ft)
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Y INPUT -->
                    <div class="space-y-2">
                        <label for="y" class="font-s-14 text-blue change-2">
                            @if (in_array($from, [2, 3]))
                                {{ $lang['rafter'] }}
                            @elseif(in_array($from, [4, 9, 7, 6]))
                                {{ $lang['pit'] }}
                            @elseif(in_array($from, [5, 8]))
                                {{ $lang['roof'] }}
                            @else
                                {{ $lang['run'] }}
                            @endif
                        </label>

                        <!-- Standard Y Input -->
                        <div
                            class="relative w-full run mt-3 {{ in_array($from, [5, 8]) ? 'hidden' : 'inline-block' }}">
                            <input type="number" step="any" wire:model="y"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label
                                class="absolute cursor-pointer text-sm underline right-6 top-4 {{ in_array($from, [4, 6, 7, 9]) ? 'hidden' : '' }}"
                                wire:click="toggleUnitRDropdown">
                                {{ $unit_r }} ▾
                            </label>
                            <input type="hidden" name="unit_r" value="{{ $unit_r }}">
                            @if ($showUnitRDropdown)
                                <div
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 {{ in_array($from, [4, 6, 7, 9]) ? 'hidden' : '' }}">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnitR('m')">meter (m)
                                    </p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnitR('in')">inch
                                        (in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnitR('yd')">yard
                                        (yd)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnitR('ft')">foot
                                        (ft)</p>
                                </div>
                            @endif
                        </div>

                        <!-- Angle Input -->
                        <div class="relative w-full angel {{ in_array($from, [5, 8]) ? 'inline-block' : 'hidden' }}">
                            <input type="number" name="y" id="y_angle" step="any" wire:model="y"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label for="unit_a" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click="toggleUnitADropdown">
                                {{ $unit_a }} ▾
                            </label>
                            <input type="hidden" name="unit_a" value="{{ $unit_a }}">
                            @if ($showUnitADropdown)
                                <div
                                    class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnitA('deg')">deg</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnitA('red')">red</p>
                                </div>
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
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg   items-center justify-center">
                        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3">
                            <div class="w-full my-4">
                                <div class="w-full md:w-[80%] lg:w-[70%] overflow-auto">
                                    <table class="w-full">
                                        <tbody>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['run'] }} :</strong></td>
                                                <td class="border-b py-2 ">
                                                    {{ $detail['run'] != '' ? $detail['run'] . ' m' : '0.0m' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['rise'] }} :</strong></td>
                                                <td class="border-b py-2 ">
                                                    {{ $detail['rise'] != '' ? $detail['rise'] . ' m' : '0.0m' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['rafter'] }} :</strong></td>
                                                <td class="border-b py-2 ">
                                                    {{ $detail['rafter'] != '' ? $detail['rafter'] . ' m' : '0.0m' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['roof'] }} :</strong></td>
                                                <td class="border-b py-2 ">
                                                    {{ $detail['angle'] != '' ? $detail['angle'] . ' deg' : '0.0 deg' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['roof'] }} (%)
                                                        ({{ $lang['slope'] }}) :</strong></td>
                                                <td class="border-b py-2 ">
                                                    {{ $detail['pitch'] != '' ? $detail['pitch'] . '%' : '0.0%' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['roof'] }} (x:12) :</strong>
                                                </td>
                                                <td class="border-b py-2 ">
                                                    <?= $detail['x'] != '' ? $detail['x'] . '<span class=' . 'font-s-14' . '> :12</span>' : '0.0 <span class="."font-s-14"."> :12</span>' ?>
                                                    in</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['p'] }}
                                                        ({{ $lang['rise'] }}/{{ $lang['span'] }}) :
                                                </td>
                                                <td class="border-b py-2 ">{{ $detail['P'] != '' ? $detail['P'] : '0.0' }}
                                                    ft</td>
                                                </strong>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['rad'] }} :</strong></td>
                                                <td class="border-b py-2 ">
                                                    {{ isset($detail['angle']) ? round($detail['angle'] * 0.0174533, 4) : '0.0' }}
                                                </td>
                                            </tr>
                                        </tbody>
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
