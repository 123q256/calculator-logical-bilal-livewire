<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="max-w-lg mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Empty first column on md and above -->
                    <div class="hidden md:block"></div>

                    <!-- Feet1 input -->
                    <div class="space-y-2">
                        <label for="feet1" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full">
                            <input type="number" name="feet1" id="feet1" class="input w-full" aria-label="input"
                                wire:model="feet1" />
                        </div>
                    </div>

                    <!-- Inches1 input -->
                    <div class="space-y-2">
                        <label for="inches1" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-full">
                            <input type="number" name="inches1" id="inches1" class="input w-full" aria-label="input"
                                wire:model="inches1" />
                        </div>
                    </div>
                </div>

                <!-- Operations and second inputs -->
                <!-- Outer container -->
                <div class="sm:grid sm:grid-cols-3 sm:gap-3 mt-4">

                    <!-- Operations: full width on mobile -->
                    <div class="space-y-2 mb-3 sm:mb-0">
                        <label for="operations" class="font-s-14 text-blue">&nbsp;</label>
                        <select class="input mt-3 w-full" name="operations" id="operations" wire:model="operations">
                            <option value="1">+</option>
                            <option value="2">-</option>
                            <option value="3">×</option>
                            <option value="4">÷</option>
                        </select>
                    </div>

                    <!-- Feet2 & Inches2 container -->
                    <!-- Feet2 -->
                    <div class="space-y-2 flex-1">
                        <label for="feet2" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <input type="number" name="feet2" id="feet2" class="input mt-3 w-full" aria-label="input"
                            wire:model="feet2" />
                    </div>

                    <!-- Inches2 -->
                    <div class="space-y-2 flex-1">
                        <label for="inches2" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <input type="number" name="inches2" id="inches2" class="input mt-3 w-full" aria-label="input"
                            wire:model="inches2" />
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
                                <div class="lg:w-[70%] md:w-[80%] w-full gap-4 md:text-[18px] text-[16px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2">
                                                <strong>Answer</strong>
                                            </td>
                                            <td class="border-b py-2">
                                                @if (isset($detail['ft_div']))
                                                    <b>{{ round($detail['ft_div'], 2) }} </b>
                                                @elseif (isset($detail['ft']) || isset($detail['in']))
                                                    @if ($detail['ft'])
                                                        <b> {{ $detail['ft'] }}</b> <span
                                                            class="font-s-14">{{ $detail['ft_unit'] }} </span>
                                                    @endif
                                                    @if ($detail['in'])
                                                        <b> {{ $detail['in'] }}</b> <span
                                                            class="font-s-14">{{ $detail['in_unit'] }}</span>
                                                    @endif
                                                @else
                                                    @if ($detail['in2'])
                                                        <b> {{ round($detail['in2'], 2) }}</b> <span
                                                            class="font-s-14">{{ $detail['ft_unit'] }}<sup>2</sup>
                                                        </span>
                                                    @endif
                                                    @if ($detail['ft2'])
                                                        <b> {{ round($detail['ft2'], 2) }} </b> <span
                                                            class="font-s-14">{{ $detail['in_unit'] }}<sup>2</sup></span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-2"><strong><?= $lang['3'] ?></strong></td>
                                        </tr>

                                        <tr>
                                            @if ($detail['operations'] == '1' || $detail['operations'] == '2')
                                                <?php
                                                $f_ft = $detail['in'] / 12;
                                                $final_ft = $detail['ft'] + $f_ft;
                                                ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft']) { ?>
                                                    <?php echo number_format($final_ft, 2) . ' ' . 'ft'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '3')
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft2']) 
                                                    $f_ft2 = $detail['in2'] / 12;
                                                    $final_ft2 = $detail['ft2'] + $f_ft2;
                                                { ?>
                                                    <?php echo number_format($final_ft2, 2) . ' ' . 'ft'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '4')
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft_div'])
                                                    $ft_div2 = $detail['ft_div'] / 12;
                                                { ?>
                                                    <?php echo number_format($ft_div2, 2) . ' ' . 'ft'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '1' || $detail['operations'] == '2')
                                                <?php
                                                $f_in = $detail['ft'] * 12;
                                                $final_in = $detail['in'] + $f_in;
                                                ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft']) { ?>
                                                    <?php echo $final_in . ' ' . 'in'; ?>

                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '3')
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft2'])
                                                $f_in2 = $detail['ft2'] * 12;
                                                $final_in2 = $detail['in2'] + $f_in2; 
                                                { ?>
                                                    <?php echo number_format($final_in2, 2) . ' ' . 'in'; ?>

                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '4')
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft_div']) 
                                                    $ft_divin2 = $detail['ft_div'] * 12;
                                                { ?>
                                                    <?php echo number_format($ft_divin2, 2) . ' ' . 'in'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="pt-2"><strong><?= $lang['4'] ?></strong></td>
                                        </tr>
                                        <tr>
                                            @if ($detail['operations'] == '1' || $detail['operations'] == '2')
                                                <?php $m = $final_ft / 3.281; ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft']) { ?>
                                                    <?php echo number_format($m, 2) . ' ' . 'm'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '3')
                                                <?php
                                                $final_ft2 = $detail['ft2'] + $f_ft2;
                                                $m2 = $final_ft2 / 3.281;
                                                ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft2']) { ?>
                                                    <?php echo number_format($m2, 2) . ' ' . 'm'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '4')
                                                <?php
                                                $ft_div2 = $detail['ft_div'] / 12;
                                                $div_m = $ft_div2 / 3.281; ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft_div']) { ?>
                                                    <?php echo number_format($div_m, 2) . ' ' . 'm'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '1' || $detail['operations'] == '2')
                                                <?php $cm = $final_in * 2.54; ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft']) { ?>
                                                    <?php echo number_format($cm, 2) . ' ' . 'cm'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '3')
                                                <?php
                                                $final_in2 = $detail['in2'] + $f_in2;
                                                $cm2 = $final_in2 * 2.54; ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft2']) { ?>
                                                    <?php echo number_format($cm2, 2) . ' ' . 'cm'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                            @if ($detail['operations'] == '4')
                                                <?php
                                                $ft_divin2 = $detail['ft_div'] * 12;
                                                $div_cm = $ft_divin2 * 2.54; ?>
                                                <td class="border-b py-2">
                                                    <?php if ($detail['ft_div']) { ?>
                                                    <?php echo number_format($div_cm, 2) . ' ' . 'cm'; ?>
                                                    <?php } ?>
                                                </td>
                                            @endif
                                        </tr>
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
