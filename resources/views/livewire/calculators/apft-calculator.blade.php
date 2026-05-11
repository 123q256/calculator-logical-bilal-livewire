<div>
    <style>
        .bg-red { background-color: #B00020 !important; }
        .bg-dark-blue { background-color: #013D5B !important; }
        .radius-5 { border-radius: 5px !important; }
        .result-badge { 
            display: inline-block; 
            padding: 0.5rem 1.5rem; 
            border-radius: 5px; 
            color: white; 
            font-weight: 600; 
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                {{-- Method Selection --}}
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="method" class="font-s-14 text-blue">{!! $lang['for'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="method" id="method" class="input">
                                <option value="score">{{ $lang['score'] }}</option>
                                <option value="check">{{ $lang['check'] }}</option>
                                <option value="multi">{{ $lang['multi'] }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($method !== 'multi')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="age" class="font-s-14 text-blue">{!! $lang['Age'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{!! $lang['year'] !!}</span>
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="gender" class="font-s-14 text-blue">{!! $lang['gen'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <select wire:model.live="gender" id="gender" class="input">
                                    <option value="Male">{{ $lang['male'] }}</option>
                                    <option value="Female">{{ $lang['female'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    @if ($method === 'multi')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="number" class="font-s-14 text-blue">{!! $lang['nbr'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="number" id="number" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="weight" class="font-s-14 text-blue">{!! $lang['hw'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <select wire:model.live="weight" id="weight" class="input">
                                    <option value="1">{{ $lang['dis'] }}</option>
                                    <option value="2">{{ $lang['able'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    @if ($method === 'score')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="push" class="font-s-14 text-blue">{!! $lang['push'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="push" id="push" class="input" placeholder="00" />
                                <span class="text-blue input_unit">2 / {!! $lang['mini'] !!}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="sit" class="font-s-14 text-blue">{!! $lang['sit'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="sit" id="sit" class="input" placeholder="00" />
                                <span class="text-blue input_unit">2 / {!! $lang['mini'] !!}</span>
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-4 lg:col-span-4">
                            <label for="min" class="font-s-14 text-blue">{!! $lang['2mil'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="min" min="0" max="59" id="min" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{!! $lang['minute'] !!}</span>
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-2 lg:col-span-2">
                            <label for="sec" class="font-s-14 text-blue">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="sec" min="0" max="59" id="sec" class="input" placeholder="00" />
                                <span class="text-blue input_unit">{!! $lang['sec'] !!}</span>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Personnel List for Multi mode --}}
                @if ($method === 'multi' && !empty($submit_type))
                    <div class="w-full mt-10 space-y-4">
                        <div class="grid grid-cols-12 gap-2 text-center font-bold text-blue-700 text-[12px] hidden md:grid lg:grid">
                            <div class="col-span-2">{!! $lang['s_name'] !!}</div>
                            <div class="col-span-1">{{ $lang['Age'] }}</div>
                            <div class="col-span-2">{{ $lang['gen'] }}</div>
                            <div class="col-span-2">{{ $lang['push'] }} <br> 2 / {{ $lang['mini'] }}</div>
                            <div class="col-span-1">{{ $lang['sit'] }} <br> 2 / {{ $lang['mini'] }}</div>
                            @if ($submit_type === 'enable')
                                <div class="col-span-1">Height (in)</div>
                                <div class="col-span-1">Weight (lbs)</div>
                                <div class="col-span-2">{{ $lang['2mil'] }} (MM:SS)</div>
                            @else
                                <div class="col-span-2">{{ $lang['2mil'] }} (MM:SS)</div>
                            @endif
                        </div>

                        <div class="max-h-[400px] overflow-auto space-y-2 pr-2">
                            @foreach ($personnel as $i => $person)
                                <div class="grid grid-cols-12 gap-2 items-center border-b pb-2 md:border-none lg:border-none">
                                    <div class="col-span-12 md:col-span-2 lg:col-span-2">
                                        <input type="text" wire:model="personnel.{{ $i }}.name" class="input text-sm" placeholder="Name">
                                    </div>
                                    <div class="col-span-4 md:col-span-1 lg:col-span-1">
                                        <input type="number" min="17" max="56" wire:model="personnel.{{ $i }}.age" class="input text-sm" placeholder="Age">
                                    </div>
                                    <div class="col-span-8 md:col-span-2 lg:col-span-2">
                                        <select wire:model="personnel.{{ $i }}.gender" class="input text-sm">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-span-4 md:col-span-2 lg:col-span-2">
                                        <input type="number" wire:model="personnel.{{ $i }}.push" class="input text-sm" placeholder="Push">
                                    </div>
                                    <div class="col-span-4 md:col-span-1 lg:col-span-1">
                                        <input type="number" wire:model="personnel.{{ $i }}.sit" class="input text-sm" placeholder="Sit">
                                    </div>
                                    @if ($submit_type === 'enable')
                                        <div class="col-span-4 md:col-span-1 lg:col-span-1">
                                            <input type="number" wire:model="personnel.{{ $i }}.height" class="input text-sm" placeholder="H">
                                        </div>
                                        <div class="col-span-4 md:col-span-1 lg:col-span-1">
                                            <input type="number" wire:model="personnel.{{ $i }}.weight" class="input text-sm" placeholder="W">
                                        </div>
                                        <div class="col-span-8 md:col-span-2 lg:col-span-2">
                                            <input type="text" wire:model="personnel.{{ $i }}.2mile" class="input text-sm" placeholder="MM:SS">
                                        </div>
                                    @else
                                        <div class="col-span-8 md:col-span-4 lg:col-span-4">
                                            <input type="text" wire:model="personnel.{{ $i }}.2mile" class="input text-sm" placeholder="MM:SS">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="w-full">
                            <label class="font-bold text-blue-700">{!! $lang['pass'] !!}:</label>
                            <select wire:model="pass" class="input mt-1">
                                <option value="60">60% (Army)</option>
                                <option value="50">50% (BCT/RSP)</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>

            @include('inc.button')
        </div>
    </form>

    <div id="result-section">
        @if ($detail && (isset($detail['push_s']) || isset($detail['b_push']) || isset($detail['dis_res']) || isset($detail['able_res'])))
            <hr class="my-6">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6">
                @include('inc.copy-pdf')
                
                <div class="w-full overflow-auto mt-4">
                    @if (isset($detail['dis_res']) || isset($detail['able_res']))
                        <table class="w-full text-sm" cellspacing="0">
                            <tr class="bg-[#2845F5] text-white">
                                <th class="ps-4 pe-3 py-3 text-left">#</th>
                                <th class="px-3 text-left">{{ $lang['s'] }} <sub class="text-white">{{ $lang['push'] }} ({{ $lang['rep'] }})</sub></th>
                                <th class="px-3 text-left">{{ $lang['s'] }} <sub class="text-white">{{ $lang['sit'] }} ({{ $lang['rep'] }})</sub></th>
                                <th class="px-3 text-left">{{ $lang['s'] }} <sub class="text-white">{{ $lang['2mil'] }} (MM:SS)</sub></th>
                                <th class="px-3 text-left">{{ $lang['total'] }}</th>
                                @if (isset($detail['able_res']))
                                    <th class="px-3 text-left">{{ $lang['w'] }} (lbs)</th>
                                @endif
                            </tr>
                            {!! $detail['output'] !!}
                            <tr class="bg-[#2845F5]/10 font-bold">
                                <td class="ps-4 pe-3 py-3">{{ $lang['ave'] }}</td>
                                <td class="px-3">{{ round($detail['total_push'] / $detail['ave']) }}</td>
                                <td class="px-3">{{ round($detail['total_sit'] / $detail['ave']) }}</td>
                                <td class="px-3">{{ round($detail['total_run'] / $detail['ave']) }}</td>
                                <td class="px-3">{{ round($detail['total_score'] / $detail['ave']) }}</td>
                                @if (isset($detail['able_res']))
                                    <td>&nbsp;</td>
                                @endif
                            </tr>
                        </table>
                    @elseif ($method === 'score' && isset($detail['push_s']))
                        <table class="w-full text-sm" cellspacing="0">
                            <tr class="bg-[#2845F5] text-white">
                                <th class="ps-4 pe-3 py-2 text-left">{{ $lang['Activity'] }}</th>
                                <th class="px-3 text-left">{{ $lang['rept'] }}</th>
                                <th class="px-3 text-left">{{ $lang['pe'] }}</th>
                                <th class="px-3 text-left rounded-r">{{ $lang['res'] }}</th>
                            </tr>
                            <tr>
                                <td class="border-b px-3 py-3">{{ $lang['push'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $push }}</td>
                                <td class="border-b px-3">{{ $detail['push_s'] }}</td>
                                <td class="border-b px-3 text-center">
                                    <span class="inline-block px-6 py-2 rounded-[5px] text-white font-semibold {{ $detail['push_s'] < 60 ? 'bg-[#B00020]' : 'bg-[#013D5B]' }}">
                                        {{ $detail['push_s'] < 60 ? $lang['fail'] : $lang['pass'] }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b px-3 py-3">{{ $lang['sit'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $sit }}</td>
                                <td class="border-b px-3">{{ $detail['sit_s'] }}</td>
                                <td class="border-b px-3 text-center">
                                    <span class="inline-block px-6 py-2 rounded-[5px] text-white font-semibold {{ $detail['sit_s'] < 60 ? 'bg-[#B00020]' : 'bg-[#013D5B]' }}">
                                        {{ $detail['sit_s'] < 60 ? $lang['fail'] : $lang['pass'] }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b px-3 py-3">2 Mile Run (Time)</td>
                                <td class="border-b px-3">{{ $min }}:{{ str_pad($sec, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="border-b px-3">{{ $detail['run_s'] }}</td>
                                <td class="border-b px-3 text-center">
                                    <span class="inline-block px-6 py-2 rounded-[5px] text-white font-semibold {{ $detail['run_s'] < 60 ? 'bg-[#B00020]' : 'bg-[#013D5B]' }}">
                                        {{ $detail['run_s'] < 60 ? $lang['fail'] : $lang['pass'] }}
                                    </span>
                                </td>
                            </tr>
                            <tr class="font-bold">
                                <td class="px-3 py-3" colspan="2">{{ $lang['ts'] }}</td>
                                <td class="px-3">{{ $detail['total'] }}</td>
                                <td class="px-3 text-center">
                                    <span class="inline-block px-6 py-2 rounded-[5px] text-white font-semibold {{ ($detail['push_s'] < 60 || $detail['sit_s'] < 60 || $detail['run_s'] < 60) ? 'bg-[#B00020]' : 'bg-[#013D5B]' }}">
                                        {{ ($detail['push_s'] < 60 || $detail['sit_s'] < 60 || $detail['run_s'] < 60) ? $lang['fail'] : $lang['pass'] }}
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-blue-700 mb-4">{{ $lang['your'] }} & {{ $lang['min'] }}</h3>
                            <table class="w-full text-sm" cellspacing="0">
                                <tr class="bg-[#2845F5] text-white">
                                    <th class="ps-4 pe-3 py-2 text-left">{{ $lang['Activity'] }}</th>
                                    <th class="px-3 text-left">{{ $lang['your'] }}</th>
                                    <th class="px-3 text-left rounded-r">{{ $lang['min'] }}</th>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['push'] }}</td>
                                    <td class="border-b px-3">{{ $push }} ({{ $lang['rep'] }})</td>
                                    <td class="border-b px-3">{{ $detail['min_push'] }} ({{ $lang['rep'] }})</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['sit'] }}</td>
                                    <td class="border-b px-3">{{ $sit }} ({{ $lang['rep'] }})</td>
                                    <td class="border-b px-3">{{ $detail['min_sit'] }} ({{ $lang['rep'] }})</td>
                                </tr>
                                <tr>
                                    <td class="border-b px-3 py-3">{{ $lang['2mil'] }}</td>
                                    <td class="border-b px-3">{{ $min }}:{{ str_pad($sec, 2, '0', STR_PAD_LEFT) }} (MM:SS)</td>
                                    <td class="border-b px-3">{{ $detail['min_time'] }} (MM:SS)</td>
                                </tr>
                            </table>
                        </div>
                    @elseif ($method === 'check' && isset($detail['b_push']))
                        <h3 class="text-xl font-bold text-blue-700 mb-4">{{ $lang['min'] }}</h3>
                        <table class="w-full text-sm" cellspacing="0">
                            <tr class="bg-[#2845F5] text-white">
                                <th class="ps-4 pe-3 text-left"></th>
                                <th class="px-3 text-left">{{ $lang['push'] }}</th>
                                <th class="px-3 text-left">{{ $lang['sit'] }}</th>
                                <th class="px-3 text-left rounded-r py-2">{{ $lang['2mil'] }}</th>
                            </tr>
                            <tr>
                                <td class="border-b px-3 py-3 font-bold">APFT {{ $lang['bad'] }}</td>
                                <td class="border-b px-3">{{ $detail['b_push'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $detail['b_sit'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $detail['b_time'] }} (MM:SS)</td>
                            </tr>
                            <tr>
                                <td class="border-b px-3 py-3 font-bold">{{ $lang['bt'] }}</td>
                                <td class="border-b px-3">{{ $detail['basic_push'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $detail['basic_sit'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $detail['basic_time'] }} (MM:SS)</td>
                            </tr>
                            <tr>
                                <td class="border-b px-3 py-3 font-bold">{{ $lang['main'] }}</td>
                                <td class="border-b px-3">{{ $detail['main_push'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $detail['main_sit'] }} ({{ $lang['rep'] }})</td>
                                <td class="border-b px-3">{{ $detail['main_time'] }} (MM:SS)</td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
