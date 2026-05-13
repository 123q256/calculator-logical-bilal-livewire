<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto space-y-8">
                {{-- Personal Information Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['4'] }}</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="m1" class="label">{!! $lang['5'] !!}:</label>
                            <select wire:model.live="m1" id="m1" class="input mt-1 cursor-pointer">
                                <option value="m">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="male">{{ $lang['2'] }}</option>
                                <option value="female">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m2" class="label">{!! $lang['6'] !!}:</label>
                            <select wire:model.live="m2" id="m2" class="input mt-1 cursor-pointer">
                                <option value="other">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="white">{{ $lang['7'] }}</option>
                                <option value="black">{{ $lang['8'] }}</option>
                                <option value="hispanic">{{ $lang['9'] }}</option>
                                <option value="asian">{{ $lang['10'] }}</option>
                                <option value="amindian">{{ $lang['11'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m3" class="label">{!! $lang['18'] !!}:</label>
                            <select wire:model.live="m3" id="m3" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['13'] }}</option>
                                <option value="2">{{ $lang['14'] }}</option>
                                <option value="1">{{ $lang['15'] }}</option>
                                <option value="0">{{ $lang['16'] }}</option>
                                <option value="-1">{{ $lang['17'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m5" class="label">{!! $lang['24'] !!}:</label>
                            <select wire:model.live="m5" id="m5" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">7-8 {{ $lang['25'] }}</option>
                                <option value="1">8-9 {{ $lang['25'] }}</option>
                                <option value="0">6-7 {{ $lang['25'] }}</option>
                                <option value="-1">{{ $lang['26'] }}</option>
                                <option value="-2">{{ $lang['27'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Health & Lifestyle Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['28'] }}</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="m6" class="label">{!! $lang['29'] !!} (HDL):</label>
                            <select wire:model.live="m6" id="m6" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['30'] }} 160 (&lt; 3)</option>
                                <option value="2">160-200 (3-4)</option>
                                <option value="1">200-240 (4-5)</option>
                                <option value="-1">240-280 (5-6)</option>
                                <option value="-2">{{ $lang['31'] }} 280 (&gt; 6)</option>
                            </select>
                        </div>
                        <div>
                            <label for="m7" class="label">{!! $lang['32'] !!} ({!! $lang['33'] !!} / {!! $lang['34'] !!}):</label>
                            <select wire:model.live="m7" id="m7" class="input mt-1 cursor-pointer">
                                <option value="005">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['30'] }} 160 (&lt; 3)</option>
                                <option value="2">160-200 (3-4)</option>
                                <option value="1">200-240 (4-5)</option>
                                <option value="-1">240-280 (5-6)</option>
                                <option value="-2">{{ $lang['31'] }} 280 (&gt; 6)</option>
                            </select>
                        </div>
                        <div>
                            <label for="m8" class="label">{!! $lang['35'] !!}?:</label>
                            <select wire:model.live="m8" id="m8" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['36'] }}</option>
                                <option value="1">{{ $lang['37'] }} 10 years {{ $lang['38'] }}</option>
                                <option value="1">{{ $lang['39'] }} 10 years ago</option>
                                <option value="0">{{ $lang['40'] }}</option>
                                <option value="-1">{{ $lang['41'] }}</option>
                                <option value="-1">1{{ $lang['42'] }}</option>
                                <option value="-3">2{{ $lang['43'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m11" class="label">{!! $lang['84'] !!}:</label>
                            <select wire:model.live="m11" id="m11" class="input mt-1 cursor-pointer">
                                <option value="001">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['85'] }}</option>
                                <option value="1">{{ $lang['86'] }}</option>
                                <option value="0">{{ $lang['87'] }}</option>
                                <option value="0">{{ $lang['88'] }}</option>
                                <option value="-1">{{ $lang['89'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="m12" class="label">{!! $lang['90'] !!} ({{ $lang['91'] }},{{ $lang['92'] }},{{ $lang['93'] }}):</label>
                        <select wire:model.live="m12" id="m12" class="input mt-1 cursor-pointer">
                            <option value="001">{{ $lang['1'] }}</option>
                            <option disabled>----------</option>
                            <option value="0">60 minutes, {{ $lang['94'] }}</option>
                            <option value="2">30 minutes, {{ $lang['95'] }}</option>
                            <option value="1">20-30 minutes, {{ $lang['96'] }} 3-5 {{ $lang['97'] }}</option>
                            <option value="0">10-20 minutes, {{ $lang['98'] }} 1-2 {{ $lang['97'] }}</option>
                            <option value="-1">{{ $lang['99'] }}</option>
                        </select>
                    </div>
                </div>

                {{-- Nutrition Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['100'] }}</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="m13" class="label">{!! $lang['101'] !!} ({{ $lang['102'] }},{{ $lang['103'] }},{{ $lang['104'] }}):</label>
                            <select wire:model.live="m13" id="m13" class="input mt-1 cursor-pointer">
                                <option value="001">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['105'] }}</option>
                                <option value="1">{{ $lang['106'] }}</option>
                                <option value="0">{{ $lang['107'] }}</option>
                                <option value="0">{{ $lang['108'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m14" class="label">{!! $lang['109'] !!}:</label>
                            <select wire:model.live="m14" id="m14" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['110'] }}</option>
                                <option value="1">{{ $lang['111'] }}</option>
                                <option value="0">{{ $lang['112'] }}</option>
                                <option value="-1">{{ $lang['113'] }}</option>
                                <option value="-2">{{ $lang['114'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m16" class="label">{!! $lang['122'] !!}:</label>
                            <select wire:model.live="m16" id="m16" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['123'] }}</option>
                                <option value="1">{{ $lang['124'] }}</option>
                                <option value="0">{{ $lang['125'] }}</option>
                                <option value="-1">{{ $lang['126'] }}</option>
                                <option value="-2">{{ $lang['127'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m17" class="label">{!! $lang['128'] !!}:</label>
                            <select wire:model.live="m17" id="m17" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['129'] }}</option>
                                <option value="1">{{ $lang['130'] }}</option>
                                <option value="0">{{ $lang['131'] }}</option>
                                <option value="0">{{ $lang['132'] }}</option>
                                <option value="-1">{{ $lang['133'] }}</option>
                                <option value="-2">{{ $lang['134'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m18" class="label">{!! $lang['135'] !!}:</label>
                            <select wire:model.live="m18" id="m18" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['136'] }}</option>
                                <option value="1">{{ $lang['137'] }}</option>
                                <option value="0">{{ $lang['138'] }}</option>
                                <option value="-1">{{ $lang['139'] }}</option>
                                <option value="-2">{{ $lang['140'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Psychosocial Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['141'] }} ({{ $lang['142'] }})</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="m19" class="label">{!! $lang['143'] !!}:</label>
                            <select wire:model.live="m19" id="m19" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['144'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['145'] }}</option>
                                <option value="1">{{ $lang['146'] }}</option>
                                <option value="0">{{ $lang['147'] }}</option>
                                <option value="-1">{{ $lang['148'] }}</option>
                                <option value="-2">{{ $lang['149'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m20" class="label">{!! $lang['150'] !!}:</label>
                            <select wire:model.live="m20" id="m20" class="input mt-1 cursor-pointer">
                                <option value="0">{{ $lang['144'] }}</option>
                                <option disabled>----------</option>
                                <option value="00">{{ $lang['151'] }}</option>
                                <option value="1">{{ $lang['152'] }} 5 years ago</option>
                                <option value="0">{{ $lang['153'] }} 30 years old</option>
                                <option value="0">{{ $lang['154'] }}</option>
                                <option value="-2">{{ $lang['155'] }} 35 years old</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Well-being Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['156'] }}</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="m21" class="label">{!! $lang['157'] !!}:</label>
                            <select wire:model.live="m21" id="m21" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['158'] }}</option>
                                <option value="1">{{ $lang['159'] }}</option>
                                <option value="0">{{ $lang['160'] }}</option>
                                <option value="-1">{{ $lang['161'] }}</option>
                                <option value="-2">{{ $lang['162'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m22" class="label">{!! $lang['163'] !!}:</label>
                            <select wire:model.live="m22" id="m22" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">3 {{ $lang['164'] }}</option>
                                <option value="1">2 {{ $lang['165'] }}</option>
                                <option value="0">{{ $lang['166'] }}</option>
                                <option value="-1">{{ $lang['167'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m23" class="label">{!! $lang['174'] !!}:</label>
                            <select wire:model.live="m23" id="m23" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">5 {{ $lang['175'] }}</option>
                                <option value="1">From 2 - 4 {{ $lang['176'] }}</option>
                                <option value="0">{{ $lang['159'] }} 1 {{ $lang['177'] }}</option>
                                <option value="0">{{ $lang['178'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m24" class="label">{!! $lang['179'] !!}:</label>
                            <select wire:model.live="m24" id="m24" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['180'] }}</option>
                                <option value="1">{{ $lang['181'] }}</option>
                                <option value="0">{{ $lang['182'] }}</option>
                                <option value="0">{{ $lang['183'] }}</option>
                                <option value="0">{{ $lang['184'] }}</option>
                                <option value="-1">{{ $lang['185'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Preventive Care Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['198'] }}</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="m27" class="label">{!! $lang['199'] !!}:</label>
                            <select wire:model.live="m27" id="m27" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['200'] }}</option>
                                <option value="1">{{ $lang['201'] }}</option>
                                <option value="0">{{ $lang['202'] }}</option>
                                <option value="-1">{{ $lang['203'] }}</option>
                                <option value="-2">{{ $lang['204'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m28" class="label">{!! $lang['211'] !!}:</label>
                            <select wire:model.live="m28" id="m28" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['212'] }}</option>
                                <option value="1">{{ $lang['213'] }}</option>
                                <option value="0">{{ $lang['214'] }}</option>
                                <option value="-1">{{ $lang['215'] }}</option>
                                <option value="-2">{{ $lang['216'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m30" class="label">{!! $lang['205'] !!}:</label>
                            <select wire:model.live="m30" id="m30" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['206'] }}</option>
                                <option value="1">{{ $lang['207'] }}</option>
                                <option value="0">{{ $lang['208'] }}</option>
                                <option value="-1">{{ $lang['209'] }}</option>
                                <option value="-2">{{ $lang['210'] }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="m31" class="label">{!! $lang['168'] !!}:</label>
                            <select wire:model.live="m31" id="m31" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['169'] }}</option>
                                <option value="2">{{ $lang['170'] }}</option>
                                <option value="1">{{ $lang['171'] }}</option>
                                <option value="0">{{ $lang['172'] }}</option>
                                <option value="-1">{{ $lang['173'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Safety & Environment Section --}}
                <div class="space-y-4">
                    <strong class="text-blue-700 text-xl pb-1 block">{{ $lang['55'] }}</strong>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="m34" class="label">{!! $lang['56'] !!}:</label>
                            <select wire:model.live="m34" id="m34" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['57'] }} 11.000km/year</option>
                                <option value="1">11.000-24.000km/year</option>
                                <option value="0">24.000-32.000km/year</option>
                                <option value="-1">{{ $lang['58'] }} 32.000 km/year</option>
                            </select>
                        </div>
                        <div>
                            <label for="m35" class="label">{!! $lang['51'] !!}:</label>
                            <select wire:model.live="m35" id="m35" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['52'] }}</option>
                                <option value="1">{{ $lang['54'] }} 75%</option>
                                <option value="0">{{ $lang['53'] }}</option>
                                <option value="-1">{{ $lang['41'] }} (25%)</option>
                                <option value="-2">{{ $lang['46'] }}</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="m36" class="label">{!! $lang['45'] !!}:</label>
                            <select wire:model.live="m36" id="m36" class="input mt-1 cursor-pointer">
                                <option value="00">{{ $lang['1'] }}</option>
                                <option disabled>----------</option>
                                <option value="0">{{ $lang['46'] }}</option>
                                <option value="1">{{ $lang['47'] }}</option>
                                <option value="0">{{ $lang['48'] }}</option>
                                <option value="-1">{{ $lang['49'] }}</option>
                                <option value="-1">{{ $lang['50'] }}</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="age" class="label">{!! $lang['44'] !!}:</label>
                            <input type="number" wire:model.live="age" id="age" class="input mt-1" placeholder="00">
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%]">
                                <div class="flex flex-wrap justify-between">
                                    <div>
                                        <p>{{ $lang['223'] }}</p>
                                        <p class="text-[28px]"><strong class="text-green-700">{{ $detail['typ'] }}</strong></p>
                                    </div>
                                    <div class="lg:border-r-2 md:border-r-2">&nbsp;</div>
                                    <div>
                                        <p>{{ $lang['224'] }}</p>
                                        <p class="text-[28px]"><strong class="text-green-700">{{ $detail['exp'] }}</strong></p>
                                    </div>
                                    <div class="lg:border-r-2 md:border-r-2">&nbsp;</div>
                                    <div>
                                        <p>{{ $lang['225'] }}</p>
                                        <p class="text-[28px]"><strong class="text-green-700">{{ $detail['bio'] }}</strong></p>
                                    </div>
                                </div>
                                <p class="text-[18px] mt-3"><strong class="text-blue-700">{{ $lang['233'] }} (Years)</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['226'] }}</sub></td>
                                            <td class="border-b py-2"><strong>{{ $detail['per'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['227'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['med'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['228'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['cad'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['229'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['nut'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['230'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['psychT'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['231'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['saf'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['232'] }} =</td>
                                            <td class="border-b py-2"><strong>{{ $detail['tot'] }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
