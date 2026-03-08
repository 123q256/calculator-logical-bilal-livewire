<div>
    @if (app()->getLocale() == 'id')
        {{-- ══════════════════════════════════════════════════════
             ID LOCALE
        ══════════════════════════════════════════════════════ --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2 md:gap-4 lg:gap-4">

                    {{-- ── Row 1: angka_1 % of angka_2 ── --}}
                    <div class="d-flex align-items-center justify-content-center mt-1 mt-lg-4">
                        <p style="white-space: nowrap">{{ $lang['what'] }} {{ $lang['is'] }}</p>
                        <div class="px-3">
                            <input type="number" step="any" wire:model.live="angka_1"
                                   class="input" placeholder="" />
                        </div>
                        <p style="white-space: nowrap">% {{ $lang['of'] }}</p>
                        <div class="px-3">
                            <input type="number" step="any" wire:model.live="angka_2"
                                   class="input" placeholder="" />
                        </div>
                        @if($device == 'desktop')
                            <p style="white-space: nowrap">=</p>
                            <div class="px-3">
                                <input type="number" readonly step="any" class="input"
                                       value="{{ $detail ? ($detail['hasil_1'] ?? '') : '' }}" />
                            </div>
                            <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                                <button wire:click="calculate(1)" class="calculate">{{ $lang['calculate'] }}</button>
                                @if($detail)
                                    <button wire:click="resetForm" class="reset ms-2 mt-2">
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if($device == 'mobile')
                        <div class="d-flex mt-2 align-items-center mt-3 text-center">
                            <p style="white-space: nowrap" class="col-2 font-s-25">=</p>
                            <div class="px-3 d-inline ms-3">
                                <input type="number" readonly step="any" class="input"
                                       value="{{ $detail ? ($detail['hasil_1'] ?? '') : '' }}" />
                            </div>
                        </div>
                        <div class="text-center mt-1 d-flex justify-content-center flex-wrap mt-3">
                            <button wire:click="calculate(1)" class="calculate">{{ $lang['calculate'] }}</button>
                            @if($detail)
                                <button wire:click="resetForm" class="reset ms-2 mt-2">
                                    {{ $lang['reset'] ?? 'RESET' }}
                                </button>
                            @endif
                        </div>
                        <hr class="mt-3">
                    @endif

                    {{-- ── Row 2: pembilang / penyebut ── --}}
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <p class="pe-lg-2 col-2">{{ $lang['what'] }} % {{ $lang['of'] }}</p>
                        <table class="{{ $device == 'mobile' ? 'w-100' : '' }} text-center px-4">
                            <tr class="text-center">
                                <td class="border-b-dark pb-1 text-center">
                                    <input type="number" step="any" wire:model.live="pembilang_1"
                                           class="input" placeholder="" />
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td class="pt-1 text-center">
                                    <input type="number" step="any" wire:model.live="penyebut_1"
                                           class="input" placeholder="" />
                                </td>
                            </tr>
                        </table>
                        <p class="ps-2">=</p>
                        <div class="px-lg-5 px-2">
                            <input type="number" readonly step="any" class="input"
                                   value="{{ $detail ? round($detail['hasil_2'] ?? 0, 2) : '' }}" />
                        </div>
                        @if($device == 'desktop')
                            <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                                <button wire:click="calculate(2)" class="calculate">{{ $lang['calculate'] }}</button>
                                @if($detail)
                                    <button wire:click="resetForm" class="reset ms-2 mt-2">
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if($detail && ($detail['hasil_2'] ?? false))
                        <div class="mt-3" id="step_2_wrapper">
                            <textarea readonly class="textareaInput">{{ '( ' . $pembilang_1 . ' / ' . $penyebut_1 . ' ) x 100%' }} = {{ round($detail['hasil_2'], 2) }}%</textarea>
                        </div>
                    @endif

                    @if($device == 'mobile')
                        <div class="text-center my-3 d-flex justify-content-center flex-wrap">
                            <button wire:click="calculate(2)" class="calculate">{{ $lang['calculate'] }}</button>
                            @if($detail)
                                <button wire:click="resetForm" class="reset ms-2 mt-2">
                                    {{ $lang['reset'] ?? 'RESET' }}
                                </button>
                            @endif
                        </div>
                        <hr class="mb-3">
                    @endif

                    {{-- ── Row 3: angka_3 is angka_4 % from ? ── --}}
                    <div class="d-flex align-items-center justify-content-center mt-2 mt-lg-4">
                        <div class="px-lg-3 px-1">
                            <input type="number" step="any" wire:model.live="angka_3"
                                   class="input" placeholder="" />
                        </div>
                        <p style="white-space: nowrap">{{ $lang['is'] }}</p>
                        <div class="px-lg-3 px-1">
                            <input type="number" step="any" wire:model.live="angka_4"
                                   class="input" placeholder="" />
                        </div>
                        <p style="white-space: nowrap">% {{ $lang['from'] }} ?</p>
                        <div class="px-lg-3 px-1">
                            <input type="number" readonly step="any" class="input"
                                   value="{{ $detail ? round($detail['hasil_3'] ?? 0, 2) : '' }}" />
                        </div>
                        @if($device == 'desktop')
                            <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                                <button wire:click="calculate(3)" class="calculate">{{ $lang['calculate'] }}</button>
                                @if($detail)
                                    <button wire:click="resetForm" class="reset ms-2 mt-2">
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if($detail && ($detail['hasil_3'] ?? false))
                        <div class="mt-3" id="step_3_wrapper">
                            <textarea readonly class="textareaInput">{{ '( ' . $angka_3 . ' / ' . $angka_4 . ' ) x 100%' }} = {{ round($detail['hasil_3'], 2) }}%</textarea>
                        </div>
                    @endif

                    @if($device == 'mobile')
                        <div class="text-center my-3 d-flex justify-content-center flex-wrap">
                            <button wire:click="calculate(3)" class="calculate">{{ $lang['calculate'] }}</button>
                            @if($detail)
                                <button wire:click="resetForm" class="reset ms-2 mt-2">
                                    {{ $lang['reset'] ?? 'RESET' }}
                                </button>
                            @endif
                        </div>
                        <hr class="mb-2">
                    @endif

                    {{-- ── Row 4: perubahan_1 to perubahan_2 ── --}}
                    <p class="mt-lg-4 mb-3">{{ $lang['6'] }}</p>
                    <div class="d-flex align-items-center justify-content-center mt-0">
                        <p style="white-space: nowrap">{{ $lang['from'] }}</p>
                        <div class="px-lg-3 px-2">
                            <input type="number" step="any" wire:model.live="perubahan_1"
                                   class="input" placeholder="" />
                        </div>
                        <p style="white-space: nowrap">{{ $lang['to'] }}</p>
                        <div class="px-lg-3 px-2">
                            <input type="number" step="any" wire:model.live="perubahan_2"
                                   class="input" placeholder="" />
                        </div>
                        <p style="white-space: nowrap">?</p>
                        <div class="ps-lg-3 pe-lg-1 px-2">
                            <input type="number" readonly step="any" class="input"
                                   value="{{ $detail ? ($detail['hasil_4'] ?? '') : '' }}" />
                        </div>
                        <p class="px-lg-2">%</p>
                        @if($device == 'desktop')
                            <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                                <button wire:click="calculate(4)" class="calculate">{{ $lang['calculate'] }}</button>
                                @if($detail)
                                    <button wire:click="resetForm" class="reset ms-2 mt-2">
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if($detail && ($detail['hasil_4'] ?? false))
                        <div class="mt-3" id="step_4_wrapper">
                            <textarea readonly class="textareaInput">{{ '( ' . $perubahan_2 . ' - ' . $perubahan_1 . ' ) / ' . $perubahan_1 . ' x 100%' }} = {{ round($detail['hasil_4'], 2) }}%</textarea>
                        </div>
                    @endif

                    @if($device == 'mobile')
                        <div class="text-center my-3 d-flex justify-content-center flex-wrap">
                            <button wire:click="calculate(4)" class="calculate">{{ $lang['calculate'] }}</button>
                            @if($detail)
                                <button wire:click="resetForm" class="reset ms-2 mt-2">
                                    {{ $lang['reset'] ?? 'RESET' }}
                                </button>
                            @endif
                        </div>
                    @endif

                </div>
            </div>

            @if($type == 'calculator')
                @include('inc.button')
            @endif
            @if($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

    @else
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-2 md:gap-4 lg:gap-4">

                    {{-- Method Select --}}
                    <div class="col-12 mt-0 mt-lg-2">
                        <label class="font-s-14 text-blue">{{ $lang['choose'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="method" class="input" id="method">
                                <optgroup label="Y = P% × X">
                                    <option value="1">{{ $lang['what'] }} {{ $lang['is'] }} P% {{ $lang['of'] }} X?</option>
                                    <option value="2">Y {{ $lang['what'] }} {{ $lang['percent'] }} {{ $lang['of'] }} X?</option>
                                    <option value="3">Y {{ $lang['is'] }} P% {{ $lang['of'] }} {{ $lang['what'] }}?</option>
                                </optgroup>
                                <optgroup label="P% × X = Y">
                                    <option value="4">{{ $lang['what'] }} % {{ $lang['of'] }} X {{ $lang['is'] }} Y?</option>
                                    <option value="5">P% {{ $lang['of'] }} {{ $lang['what'] }} {{ $lang['is'] }} Y?</option>
                                    <option value="6">P% {{ $lang['of'] }} X {{ $lang['is'] }} {{ $lang['what'] }}?</option>
                                </optgroup>
                                <optgroup label="Y ÷ X = P%">
                                    <option value="7">Y {{ $lang['out'] }} {{ $lang['of'] }} {{ $lang['what'] }} {{ $lang['is'] }} P%?</option>
                                    <option value="8">{{ $lang['what'] }} {{ $lang['out'] }} {{ $lang['of'] }} X {{ $lang['is'] }} P%?</option>
                                    <option value="9">Y {{ $lang['out'] }} {{ $lang['of'] }} X {{ $lang['is'] }} {{ $lang['what'] }} %?</option>
                                </optgroup>
                                <optgroup label="X + (X × P%) = Y">
                                    <option value="10">X {{ $lang['plus'] }} P% {{ $lang['is'] }} {{ $lang['what'] }}?</option>
                                    <option value="11">X {{ $lang['plus'] }} {{ $lang['what'] }} % {{ $lang['is'] }} Y?</option>
                                    <option value="12">{{ $lang['what'] }} {{ $lang['plus'] }} P% {{ $lang['is'] }} Y?</option>
                                </optgroup>
                                <optgroup label="X − (X × P%) = Y">
                                    <option value="13">X {{ $lang['minus'] }} P% {{ $lang['is'] }} {{ $lang['what'] }}?</option>
                                    <option value="14">X {{ $lang['minus'] }} {{ $lang['what'] }} % {{ $lang['is'] }} Y?</option>
                                    <option value="15">{{ $lang['what'] }} {{ $lang['minus'] }} P% {{ $lang['is'] }} Y?</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    {{-- Dynamic label row --}}
                    <div class="flex items-center justify-center mt-0 mt-lg-2">
                        {{-- text1 -- only show for methods: 1,4,8,12,15 --}}
                        @php
                            $showText1 = in_array($method, ['1','4','8','12','15']);
                            $text1 = match($method) {
                                '1'  => $lang['what'].' '.$lang['is'],
                                '4'  => $lang['what'].' % '.$lang['of'],
                                '8'  => $lang['what'].' '.$lang['out'].' '.$lang['of'],
                                '12' => $lang['what'].' '.$lang['plus'],
                                '15' => $lang['what'].' '.$lang['minus'],
                                default => ''
                            };
                            $text2 = match($method) {
                                '1'  => '% '.$lang['of'],
                                '2'  => $lang['is'].' '.$lang['what'].' % '.$lang['of'],
                                '3'  => $lang['is'],
                                '4'  => '% '.$lang['is'],
                                '5'  => '% '.$lang['of'].' '.$lang['what'].' '.$lang['is'],
                                '6'  => '% '.$lang['of'],
                                '7'  => $lang['out'].' '.$lang['of'].' '.$lang['what'].' '.$lang['is'],
                                '8'  => $lang['is'],
                                '9'  => $lang['out'].' '.$lang['of'],
                                '10' => $lang['plus'],
                                '11' => $lang['plus'].' '.$lang['what'].' % '.$lang['is'],
                                '12' => '% '.$lang['is'],
                                '13' => $lang['minus'],
                                '14' => $lang['minus'].' '.$lang['what'].' % '.$lang['is'],
                                '15' => '% '.$lang['is'],
                                default => '% '.$lang['of'],
                            };
                            $text3 = match($method) {
                                '3'  => '% '.$lang['of'].' '.$lang['what'].' ?',
                                '6'  => $lang['is'].' '.$lang['what'].' ?',
                                '7'  => '% ?',
                                '8'  => '% ?',
                                '9'  => $lang['is'].' '.$lang['what'].' % ?',
                                '10' => '% '.$lang['is'].' '.$lang['what'].' ?',
                                '13' => '% '.$lang['is'].' '.$lang['what'].'?',
                                default => '?',
                            };
                            $pPlaceholder = match($method) {
                                '2','3','5','7','9','10','11' => 'Y',
                                '4','8','13','14'             => 'X',
                                '12','15'                     => 'P',
                                default                       => 'P',
                            };
                            $xPlaceholder = match($method) {
                                '3','5','10','13' => 'P',
                                '2','4','9'       => 'X',
                                '7','11','14'     => 'Y',
                                '8'               => 'P',
                                default           => 'X',
                            };
                        @endphp

                        @if($showText1)
                            <p style="white-space: nowrap" id="text1">{{ $text1 }}</p>
                        @endif
                        <div class="px-3">
                            <input type="number" step="any" wire:model.live="p"
                                   class="input" placeholder="{{ $pPlaceholder }}" />
                        </div>
                        <p style="white-space: nowrap" id="text2">{{ $text2 }}</p>
                        <div class="px-3">
                            <input type="number" step="any" wire:model.live="x"
                                   class="input" placeholder="{{ $xPlaceholder }}" />
                        </div>
                        <p style="white-space: nowrap" id="text3">{{ $text3 }}</p>
                    </div>

                </div>
            </div>

            @if($type == 'calculator')
                @include('inc.button')
            @endif
            @if($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        {{-- ── Result Section (EN) ── --}}
        @if($detail)
            <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div>
                    @if($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-[16px]">
                                <p class="mt-2 text-[18px]"><strong>{{ $detail['ans'] }}</strong></p>

                                @if($method === '1')
                                    <p class="mt-2">{{ $detail['ans'] }} {{ $lang['is'] }} {{ $p }} % {{ $lang['of'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $lang['what'].' '.$lang['is'] }} {{ $p.'% '.$lang['of'].' '.$x }} ?</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = P% * X</p>
                                    <p class="mt-2">Y = {{ $p.'% * '.$x }}</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">Y = ({{ $p.'/100) * '.$x }})</p>
                                    <p class="mt-2">Y = {{ $p/100 .' * '. $x }}</p>
                                    <p class="mt-2">Y = {{ $detail['ans'] }}</p>

                                @elseif($method === '2')
                                    <p class="mt-2">{{ $p }} {{ $lang['is'] }} {{ $detail['ans'] }} of {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['is'].' '.$lang['what'].' % '.$lang['of'].' '.$x }} ?</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: P% = Y / X</p>
                                    <p class="mt-2">P% = {{ $p.' / '.$x }}</p>
                                    <p class="mt-2">P% = {{ $x != 0 ? $p/$x : 'N/A' }}</p>
                                    <p class="mt-2">{{ $lang['dec'] }}:</p>
                                    <p class="mt-2">P% = {{ ($x != 0 ? $p/$x : 0).' * 100' }}</p>
                                    <p class="mt-2">P% = {{ $detail['ans'] }}%</p>

                                @elseif($method === '3')
                                    <p class="mt-2">{{ $p }} is {{ $x }} % of {{ $detail['ans'] }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['is'].' '.$x.' '.$lang['of'].' '.$lang['what'] }} ?</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: X = Y / P%</p>
                                    <p class="mt-2">X = {{ $p.' / '.$x }}%</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">X = {{ $p.' / ('.$x }} / 100)</p>
                                    <p class="mt-2">X = {{ $p.' / '.($x/100) }}</p>
                                    <p class="mt-2">= {{ $detail['ans'] }}</p>

                                @elseif($method === '4')
                                    <p class="mt-2">{{ $detail['ans'] }} {{ $lang['of'] }} {{ $p }} {{ $lang['is'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['is'].' '.$lang['what'].' % '.$lang['of'].' '.$x }} ?</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: P% = Y / X</p>
                                    <p class="mt-2">P% = {{ $x.' / '.$p }}</p>
                                    <p class="mt-2">P% = {{ $p != 0 ? $x/$p : 'N/A' }}</p>
                                    <p class="mt-2">{{ $lang['dec'] }}:</p>
                                    <p class="mt-2">P% = {{ ($p != 0 ? $x/$p : 0).' * 100' }}</p>
                                    <p class="mt-2">P% = {{ $detail['ans'] }}</p>

                                @elseif($method === '5')
                                    <p class="mt-2">{{ $p }}% {{ $lang['of'] }} {{ $detail['ans'] }} {{ $lang['is'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.'% '.$lang['of'].' '.$lang['what'].' '.$lang['is'].' '.$x }} ?</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: X = Y / P%</p>
                                    <p class="mt-2">X = {{ $x.' / '.$p }}%</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">X = {{ $x.' / ('.$p }} / 100)</p>
                                    <p class="mt-2">X = {{ $x.' / '.($p/100) }}</p>
                                    <p class="mt-2">X = {{ $detail['ans'] }}</p>

                                @elseif($method === '6')
                                    <p class="mt-2">{{ $p }}% {{ $lang['of'] }} {{ $x }} {{ $lang['is'] }} {{ $detail['ans'] }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.'% '.$lang['of'].' '.$x.' '.$lang['is'].' '.$lang['what'] }} ?</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = P% * X</p>
                                    <p class="mt-2">Y = {{ $p.'% * '.$x }}</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">Y = ({{ $p.' / 100) * '.$x }})</p>
                                    <p class="mt-2">Y = {{ ($p/100).' * '.$x }}</p>
                                    <p class="mt-2">Y = {{ $detail['ans'] }}</p>

                                @elseif($method === '7')
                                    <p class="mt-2">{{ $p }} {{ $lang['out'].' '.$lang['of'] }} {{ $detail['ans'] }} {{ $lang['is'] }} {{ $x }}%</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['out'].' '.$lang['of'].' '.$lang['what'].' '.$lang['is'].' '.$x.'% ?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: X = Y / P%</p>
                                    <p class="mt-2">X = {{ $p.' / '.$x }}%</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">X = {{ $p.' / ('.$x.' / 100)' }}</p>
                                    <p class="mt-2">X = {{ $p.' / '.($x/100) }}</p>
                                    <p class="mt-2">X = {{ $detail['ans'] }}</p>

                                @elseif($method === '8')
                                    <p class="mt-2">{{ $detail['ans'] }} {{ $lang['out'].' '.$lang['of'] }} {{ $p.' '.$lang['is'] }} {{ $x }}%</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $lang['what'].' '.$lang['out'].' '.$lang['of'] }} {{ $p.' '.$lang['is'].' '.$x.'% ?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = P% * X</p>
                                    <p class="mt-2">Y = {{ $x.'% * '.$p }}</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">Y = ({{ $x.' / 100) * '.$p }})</p>
                                    <p class="mt-2">Y = {{ ($x/100).' * '.$p }}</p>
                                    <p class="mt-2">Y = {{ $detail['ans'] }}</p>

                                @elseif($method === '9')
                                    <p class="mt-2">{{ $p }} {{ $lang['out'].' '.$lang['of'] }} {{ $x.' '.$lang['is'] }} {{ $detail['ans'] }}%</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['out'].' '.$lang['of'].' '.$x.'% ?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: P% = Y / X</p>
                                    <p class="mt-2">P% = {{ $p.' / '.$x }}</p>
                                    <p class="mt-2">P% = {{ $x != 0 ? $p/$x : 'N/A' }}</p>
                                    <p class="mt-2">{{ $lang['dec'] }}:</p>
                                    <p class="mt-2">P% = ({{ $x != 0 ? $p/$x : 0 }}) * 100</p>
                                    <p class="mt-2">P% = {{ $detail['ans'] }}</p>

                                @elseif($method === '10')
                                    <p class="mt-2">{{ $p }} {{ $lang['plus'] }} {{ $x }}% {{ $lang['is'] }} {{ $detail['ans'] }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' plus '.$x.'% is what?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = X + (X × P%)</p>
                                    <p class="mt-2">Y = X(1 + P%)</p>
                                    <p class="mt-2">Y = {{ $p }} * (1 + {{ $x }}%)</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">Y = {{ $p }} * (1 + ({{ $x }} / 100))</p>
                                    <p class="mt-2">Y = {{ $p }} * (1 + {{ $x/100 }})</p>
                                    <p class="mt-2">Y = {{ $p }} * ({{ 1 + $x/100 }})</p>
                                    <p class="mt-2">Y = {{ $detail['ans'] }}</p>

                                @elseif($method === '11')
                                    <p class="mt-2">{{ $p }} {{ $lang['plus'] }} {{ $detail['ans'] }} {{ $lang['is'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['plus'].' '.$lang['what'].' % '.$lang['is'].' '.$x.'?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = X + (X × P%)</p>
                                    <p class="mt-2">Y = X(1 + P%)</p>
                                    <p class="mt-2">{{ $lang['sol_f'] }} P</p>
                                    <p class="mt-2">P% = Y/X - 1</p>
                                    <p class="mt-2">P% = {{ $x }}/{{ $p }} - 1</p>
                                    <p class="mt-2">P% = {{ $p != 0 ? $x/$p : 'N/A' }} - 1</p>
                                    <p class="mt-2">P% = {{ $p != 0 ? $x/$p - 1 : 'N/A' }}</p>
                                    <p class="mt-2">{{ $lang['dec'] }}:</p>
                                    <p class="mt-2">P% = {{ $p != 0 ? $x/$p - 1 : 0 }} * 100</p>
                                    <p class="mt-2">P% = {{ $detail['ans'] }}</p>

                                @elseif($method === '12')
                                    <p class="mt-2">{{ $detail['ans'] }} {{ $lang['plus'] }} {{ $p }}% {{ $lang['is'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $lang['what'].' '.$lang['plus'].' '.$p.'% '.$lang['is'].' '.$x.'?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = X + (X × P%)</p>
                                    <p class="mt-2">Y = X(1 + P%)</p>
                                    <p class="mt-2">{{ $lang['sol_f'] }} X</p>
                                    <p class="mt-2">X = Y/(1 + P%)</p>
                                    <p class="mt-2">X = {{ $x }}/(1 + {{ $p }}%)</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">X = {{ $x }}/(1 + {{ $p/100 }})</p>
                                    <p class="mt-2">X = {{ $x }}/({{ 1 + $p/100 }})</p>
                                    <p class="mt-2">X = {{ $detail['ans'] }}</p>

                                @elseif($method === '13')
                                    <p class="mt-2">{{ $p }} {{ $lang['minus'] }} {{ $x }}% {{ $lang['is'] }} {{ $detail['ans'] }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['minus'].' '.$x.'% '.$lang['is'].' '.$lang['what'].'?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = X - (X × P%)</p>
                                    <p class="mt-2">Y = X(1 - P%)</p>
                                    <p class="mt-2">Y = {{ $p }} * (1 - {{ $x }}%)</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">Y = {{ $p }} * (1 - ({{ $x }} / 100))</p>
                                    <p class="mt-2">Y = {{ $p }} * (1 - {{ $x/100 }})</p>
                                    <p class="mt-2">Y = {{ $p }} * ({{ 1 - $x/100 }})</p>
                                    <p class="mt-2">Y = {{ $detail['ans'] }}</p>

                                @elseif($method === '14')
                                    <p class="mt-2">{{ $p }} {{ $lang['minus'] }} {{ $detail['ans'] }} {{ $lang['is'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $p.' '.$lang['minus'].' '.$lang['is'].' % '.$x.'?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = X - (X × P%)</p>
                                    <p class="mt-2">Y = X(1 - P%)</p>
                                    <p class="mt-2">{{ $lang['sol_f'] }} P</p>
                                    <p class="mt-2">P% = 1 - Y/X</p>
                                    <p class="mt-2">P% = 1 - {{ $x }}/{{ $p }}</p>
                                    <p class="mt-2">P% = 1 - {{ $p != 0 ? $x/$p : 'N/A' }}</p>
                                    <p class="mt-2">P% = {{ $p != 0 ? 1 - $x/$p : 'N/A' }}</p>
                                    <p class="mt-2">{{ $lang['dec'] }}:</p>
                                    <p class="mt-2">P% = {{ $p != 0 ? 1 - $x/$p : 0 }} * 100</p>
                                    <p class="mt-2">P% = {{ $detail['ans'] }}</p>

                                @else {{-- method 15 --}}
                                    <p class="mt-2">{{ $detail['ans'] }} {{ $lang['minus'] }} {{ $p }}% {{ $lang['is'] }} {{ $x }}</p>
                                    <p class="mt-2"><strong>{{ $lang['sol'] }}:</strong></p>
                                    <p class="mt-2">{{ $lang['what'].' '.$lang['minus'].' '.$p.'% '.$lang['is'].' '.$x.'?' }}</p>
                                    <p class="mt-2">{{ $lang['eq'] }}: Y = X - (X × P%)</p>
                                    <p class="mt-2">Y = X(1 - P%)</p>
                                    <p class="mt-2">{{ $lang['sol_f'] }} X</p>
                                    <p class="mt-2">X = Y/(1 - P%)</p>
                                    <p class="mt-2">X = {{ $x }}/(1 - {{ $p }}%)</p>
                                    <p class="mt-2">{{ $lang['conv'] }}:</p>
                                    <p class="mt-2">X = {{ $x }}/(1 - {{ $p/100 }})</p>
                                    <p class="mt-2">X = {{ $x }}/({{ 1 - $p/100 }})</p>
                                    <p class="mt-2">X = {{ $detail['ans'] }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif

    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</div>