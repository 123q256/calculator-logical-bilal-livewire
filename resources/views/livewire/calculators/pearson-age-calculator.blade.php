<div>

    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <p class="w-full">{{ $lang['13'] ?? 'Calculate your age using Pearson method:' }}</p>

                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4 mt-5">
                    <div class="space-y-2 relative">
                        <label for="date1" class="label">{{ $lang['dob'] ?? 'Date of Birth' }}:</label>
                        <input type="date" wire:model="date1" id="date1" class="input" />
                        @error('date1')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="date" class="label">{{ $lang['today_date'] ?? 'Today\'s Date' }}:</label>
                        <input type="date" wire:model="date" id="date" class="input" />
                        @error('date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
        <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full p-3 radius-10 mt-3">
                            <div class="row my-2">
                                <div class="col-lg-8 font-s-18">
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong><?= $lang['your_age'] ?> :</strong></td>
                                            <td width="45%" class="border-b py-2"><b><?= $detail['Age_years'] ?></b>
                                                <span class="font-s-16"><?= $lang['years'] ?></span>
                                                <b><?= $detail['Age_months'] ?></b> <span
                                                    class="font-s-16"><?= $lang['months'] ?></span>
                                                <b><?= $detail['Age_days'] ?></b> <span
                                                    class="font-s-16"><?= $lang['days'] ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong><?= $lang['next'] ?> :</strong></td>
                                            <td class="border-b py-2"><b><?= $detail['N_r_months'] ?></b> <span
                                                    class="font-s-16"><?= $lang['months'] ?></span>
                                                <b><?= $detail['N_r_days'] ?></b> <span
                                                    class="font-s-16"><?= $lang['days'] ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <?php
                                if ($detail['birth_month'] == '1') {
                                    $des = $lang['m1'];
                                } elseif ($detail['birth_month'] == '2') {
                                    $des = $lang['m2'];
                                } elseif ($detail['birth_month'] == '3') {
                                    $des = $lang['m3'];
                                } elseif ($detail['birth_month'] == '4') {
                                    $des = $lang['m4'];
                                } elseif ($detail['birth_month'] == '5') {
                                    $des = $lang['m5'];
                                } elseif ($detail['birth_month'] == '6') {
                                    $des = $lang['m6'];
                                } elseif ($detail['birth_month'] == '7') {
                                    $des = $lang['m7'];
                                } elseif ($detail['birth_month'] == '8') {
                                    $des = $lang['m8'];
                                } elseif ($detail['birth_month'] == '9') {
                                    $des = $lang['m9'];
                                } elseif ($detail['birth_month'] == '10') {
                                    $des = $lang['m10'];
                                } elseif ($detail['birth_month'] == '11') {
                                    $des = $lang['m11'];
                                } elseif ($detail['birth_month'] == '12') {
                                    $des = $lang['m12'];
                                }
                                $des = explode('@', $des);
                                ?>
                                <p class="font-s-18 mt-3 mb-1"><b><?= $des[0] ?></b></p>
                                <div colspan="2" class="flex font-s-18 d-flex align-items-center gap-3 mt-lg-1 mt-2">
                                    <img src="<?= asset('assets/img/Star.png') ?>" alt="star">
                                    <span class="ps-2"><?= $des[1] ?></span>
                                </div>
                                <div colspan="2" class="flex font-s-18 d-flex align-items-center gap-3 mt-lg-1 mt-2">
                                    <img src="<?= asset('assets/img/Star.png') ?>" alt="star">
                                    <span class="ps-2"><?= $des[2] ?></span>
                                </div>
                                <div colspan="2" class="flex font-s-18 d-flex align-items-center gap-3 mt-lg-1 mt-2">
                                    <img src="<?= asset('assets/img/Star.png') ?>" alt="star">
                                    <span class="ps-2"><?= $des[3] ?></span>
                                </div>
                                <div colspan="2" class="flex font-s-18 d-flex align-items-center gap-3 mt-lg-1 mt-2">
                                    <img src="<?= asset('assets/img/Star.png') ?>" alt="star">
                                    <span class="ps-2"><?= $des[4] ?></span>
                                </div>
                                <div class="col-lg-8 font-s-18">
                                    <table class="w-100">
                                        <tr>
                                            <td class="pt-3 pb-1">
                                                <strong><?= $lang['lived'] ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center gap-3">
                                                <img src="<?= asset('assets/img/year.png') ?>" width="40px" height="40px"
                                                    alt="year">
                                                <?= $lang['years'] ?> :
                                            </td>
                                            <td width="45%" class="border-b py-2">
                                                <?= $detail['Age_years'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center gap-3">
                                                <img src="<?= asset('assets/img/days.png') ?>" width="40px" height="40px"
                                                    alt="days">
                                                <?= $lang['days'] ?> :
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['Days'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center gap-3">
                                                <img src="<?= asset('assets/img/hours.png') ?>" width="40px"
                                                    height="40px" alt="hours">
                                                <?= $lang['hours'] ?> :
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['Hours'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center gap-3">
                                                <img src="<?= asset('assets/img/min.png') ?>" width="40px" height="40px"
                                                    alt="min">
                                                <?= $lang['minute'] ?> :
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['Min'] ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center gap-3">
                                                <img src="<?= asset('assets/img/sec.png') ?>" width="40px" height="40px"
                                                    alt="sec">
                                                <?= $lang['seconds'] ?> :
                                            </td>
                                            <td class="border-b py-2">
                                                <?= $detail['Sec'] ?>
                                            </td>
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
