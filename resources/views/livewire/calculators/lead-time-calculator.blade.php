<div>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[90%] w-full mx-auto ">
                <div class="grid grid-cols-1  gap-4">
                    <div class="space-y-2 relative">
                        <label for="type" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <select class="input" wire:model="types" wire:change="changetype" name="type" id="type">
                            <option value="manufac">{{ $lang['24'] }}</option>
                            <option value="order">{{ $lang['25'] }}</option>
                            <option value="supply">{{ $lang['26'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 {{ $types == 'manufac' ? 'd-block' : 'hidden' }}">
                        <label for="pre_time" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>

                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" wire:model="pre_time" step="any" id="pre_time"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input"
                                placeholder="00">

                            <label for="pre_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                @click="open = !open">
                                {{ $pre_units }} ▾
                            </label>

                            <input type="hidden" wire:model="pre_units" id="pre_units">

                            <div x-show="open" x-cloak
                                class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0"
                                @click.away="open = false">
                                @foreach (['days', 'sec', 'min', 'hrs', 'wks', 'mos', 'yrs'] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setPreUnit('{{ $name }}')" @click="open = false">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 {{ $types == 'manufac' ? 'd-block' : 'hidden' }}">
                        <label for="p_time" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>

                        <div class="relative w-full" x-data="{ showDropdown: false }">
                            <input type="number" step="any" wire:model.lazy="p_time"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                @click="showDropdown = !showDropdown">
                                {{ $p_units }} ▾
                            </label>

                            <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0"
                                x-show="showDropdown" @click.away="showDropdown = false" x-transition x-cloak>
                                @foreach (['days', 'sec', 'min', 'hrs', 'wks', 'mos', 'yrs'] as $name)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                        wire:click="$set('p_units', '{{ $name }}')"
                                        @click="showDropdown = false">
                                        {{ $name }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 {{ $types === 'manufac' ? 'd-block' : 'hidden' }}">
                        <label for="post_time" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Post Time' }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            <input type="number" name="post_time" id="post_time" step="any" wire:model="post_time"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            <label for="post_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                x-on:click="open = !open">
                                {{ $post_units }} ▾
                            </label>

                            <input type="text" id="post_units" name="post_units" class="hidden"
                                wire:model="post_units" />

                            <div id="post_units_dropdown"
                                class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0"
                                x-show="open" x-on:click.outside="open = false" x-cloak>
                                @foreach (['days', 'sec', 'min', 'hrs', 'wks', 'mos', 'yrs'] as $unit)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                        x-on:click="$wire.set('post_units', '{{ $unit }}'); open = false">
                                        {{ $unit }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 date {{ $types == 'order' ? 'd-block' : 'hidden' }}">
                        <label for="place_time" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <input type="datetime-local" step="any" name="" id="place_time" class="input"
                            aria-label="input" wire:model="place_time" />
                    </div>
                    <div class="space-y-2 date {{ $types == 'order' ? 'd-block' : 'hidden' }}">
                        <label for="receive_time" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                        <input type="datetime-local" wire:model="receive_time" step="any" name="receive_time"
                            id="receive_time" class="input" aria-label="input" />
                    </div>


                    <div class="space-y-2 supplys {{ $types == 'supply' ? 'd-block' : 'hidden' }}">
                        <label for="s_delay" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false }">
                            {{-- Delay input --}}
                            <input type="number" wire:model="s_delay" id="s_delay" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- Unit dropdown toggle --}}
                            <label for="supply_units" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                x-on:click="open = !open">
                                {{ $supply_units }} ▾
                            </label>

                            {{-- Hidden input (optional) --}}
                            <input type="text" wire:model="supply_units" id="supply_units" class="hidden" />

                            {{-- Dropdown options --}}
                            <div x-show="open" x-cloak
                                class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-6 right-0 top-5">
                                @foreach (['days', 'sec', 'min', 'hrs', 'wks', 'mos', 'yrs'] as $unit)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                        wire:click="setUnit('supply_units', '{{ $unit }}')"
                                        x-on:click="open = false">
                                        {{ $unit }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 supplys {{ $types === 'supply' ? 'd-block' : 'hidden' }}">
                        <label for="r_delay" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="r_delay" id="r_delay" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            <div x-data="{ open: false }" class="">
                                <label class="absolute cursor-pointer text-sm underline right-6 top-3"
                                    x-on:click="open = !open">
                                    {{ $r_units }} ▾
                                </label>

                                <input type="text" wire:model="r_units" id="r_units" class="hidden" />

                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-6 right-0 top-6"
                                    x-show="open" x-cloak>
                                    @foreach (['days', 'sec', 'min', 'hrs', 'wks', 'mos', 'yrs'] as $unit)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                            wire:click="setUnit('r_units', '{{ $unit }}')"
                                            x-on:click="open = false">
                                            {{ $unit }}
                                        </p>
                                    @endforeach
                                </div>
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2 overflow-auto">
                                <div class="lg:w-[60%] md:w-[80%] w-full gap-4 text-[16px]">
                                    <?php if (isset($detail['type'])) { ?>
                                    @if ($detail['type'] == 'manufac')
                                        @php
                                            $manufac = round($detail['manufac'], 2);
                                        @endphp
                                        <div class="rounded-lg  p-4">
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">
                                                        <strong><?= $lang['9'] ?>:</strong></td>
                                                    <td class="border-b py-2"><?= $manufac ?> <?= $lang['10'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] . ' ' . $lang['12'] ?>
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $manufac * 86400 ?> <?= $lang['13'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] . ' ' . $lang['14'] ?>
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $manufac * 1440 ?> <?= $lang['15'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['16'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $manufac * 24 ?> <?= $lang['17'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['18'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($manufac / 7, 4) ?> <?= $lang['19'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['20'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($manufac / 30.417, 4) ?> <?= $lang['21'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['22'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($manufac / 365, 4) ?> <?= $lang['23'] ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($detail['type'] == 'order')
                                        @php
                                            $timeDiff = $detail['diff_minutes'];
                                        @endphp
                                        <div class="rounded-lg  p-4">
                                            <p><span><strong><?= $detail['timeDiff'] ?></strong></p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['12'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $timeDiff * 60 ?> <?= $lang['13'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['14'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $timeDiff * 1 ?> <?= $lang['15'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['10'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($timeDiff / 1440) ?> <?= $lang['10'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['18'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($timeDiff / 10080, 6) ?> <?= $lang['19'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['20'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($timeDiff / 43800, 6) ?> <?= $lang['21'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['22'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($timeDiff / 525600, 6) ?> <?= $lang['23'] ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif

                                    @if ($detail['type'] == 'supply')
                                        @php
                                            $supply = round($detail['supply'], 2);
                                        @endphp
                                        <div class="rounded-lg  p-4">
                                            <p><span><strong><?= $supply ?> <?= $lang['10'] ?></strong></p>
                                            <table class="w-full">
                                                <tr>
                                                    <td width="60%" class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['12'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $supply * 86400 ?> <?= $lang['13'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['14'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $supply * 1440 ?> <?= $lang['15'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['16'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= $supply * 24 ?> <?= $lang['17'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['18'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($supply / 7, 4) ?> <?= $lang['19'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['20'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($supply / 30.417, 4) ?> <?= $lang['21'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">
                                                        <?= $lang['11'] ?> <?= $lang['22'] ?> :
                                                    </td>
                                                    <td class="border-b py-2">
                                                        <?= round($supply / 365, 4) ?> <?= $lang['23'] ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endisset
    </form>

</div>
