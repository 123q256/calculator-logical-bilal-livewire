<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ratios" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="ratios" id="ratios" class="input">
                                @php
                                    $presets = [
                                        'custom' => $lang['2'],
                                        '7680x4320' => "7680 x 4320 " . ($lang['3'] ?? ''),
                                        '5120x2880' => "5120 x 2880 " . ($lang['4'] ?? ''),
                                        '3840 × 2160' => "3840 × 2160 " . ($lang['5'] ?? ''),
                                        '2048x1536' => "2048 x 1536 " . ($lang['6'] ?? ''),
                                        '1920x1200' => "1920 x 1200 " . ($lang['7'] ?? ''),
                                        '1920x1080' => "1920 x 1080 " . ($lang['8'] ?? ''),
                                        '1334x750' => "1334 x 750 " . ($lang['9'] ?? ''),
                                        '1200x630' => "1200 x 630 " . ($lang['10'] ?? ''),
                                        '1136x640' => "1136 x 640 " . ($lang['11'] ?? ''),
                                        '1024x768' => "1024 x 768 " . ($lang['12'] ?? ''),
                                        '1024x512' => "1024 x 512 " . ($lang['13'] ?? ''),
                                        '960x640' => "960 x 640 " . ($lang['14'] ?? ''),
                                        '800x600' => "800 x 600",
                                        '728x90' => "728 x 90 " . ($lang['15'] ?? ''),
                                        '720x576' => "720 x 576 " . ($lang['16'] ?? ''),
                                        '640x480' => "640 x 480 " . ($lang['17'] ?? ''),
                                        '576x486' => "576 x 486 " . ($lang['18'] ?? ''),
                                        '320x480' => "320 x 480 " . ($lang['19'] ?? ''),
                                    ];
                                @endphp
                                @foreach($presets as $val => $name)
                                    <option value="{{ $val }}">{!! $name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="w1" class="label">{{ $lang['20'] }} (W₁):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="w1" id="w1" class="input" aria-label="input" placeholder="1920" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="h1" class="label">{{ $lang['21'] }} (H₁):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="h1" id="h1" class="input" aria-label="input" placeholder="1080" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="w2" class="label">{{ $lang['20'] }} (W₂) {{ $lang['22'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="w2" id="w2" class="input" aria-label="input" placeholder="400" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="h2" class="label">{{ $lang['21'] }} (H₂) {{ $lang['22'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="h2" id="h2" class="input" aria-label="input" placeholder="" />
                        </div>
                    </div>
                    <p class="col-span-12"><strong>{{ $lang['23'] }}: </strong>{{ $lang['24'] }}.</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-1">
                                <div class="w-full md:w-[80%] lg:w-[80%] font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{ $lang['25'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['asp_ratio'] }}</td>
                                        </tr>
                                        @if(isset($detail['ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ ($detail['check'] === 'h2') ? 'New Height' : 'New Width' }} :</strong></td>
                                                <td class='border-b py-2'>{{ $detail['ans'] }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2" class="pt-2 pb-1"><strong>{{ $lang['26'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ (isset($detail['ans'])) ? 'Original' : '' }} {{ $lang['27'] }} :</td>
                                            <td class='border-b py-2'>{{ "{$w1} x {$h1}" }}</td>
                                        </tr>
                                        @if(isset($detail['ans']))
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['28'] }} :</td>
                                                <td class='border-b py-2'>{{ ($detail['check'] === 'h2') ? "$w2 x " . $detail['ans'] : $detail['ans'] . " x $h2" }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['29'] }} :</td>
                                            <td class='border-b py-2'>{{ $detail['pixels'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['30'] }} :</td>
                                            <td class='border-b py-2'>{{ $detail['mode'] }}</td>
                                        </tr>
                                    </table>
                                    <p class="mt-4"><strong>{{ $lang['31'] }}:</strong></p>
                                    <div class="flex justify-start mt-3 w-full overflow-visible">
                                        <div class="inline-block p-2 border bg-gray-50 rounded-lg max-w-full">
                                            <p class="text-center bg-white border rounded shadow-md flex items-center justify-center" style="{{ $detail['vsl_ratio'] }}; max-width: 100%; box-sizing: border-box;">
                                                {{ $lang['25'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
