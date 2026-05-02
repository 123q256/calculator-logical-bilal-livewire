<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                {{-- Country Selector (Tag Style) --}}
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1 mb-6">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('uk')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type == 'uk' ? 'tagsUnit' : '' }}">
                            {{ $lang['uk'] ?? 'United Kingdom' }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setUnitType('aus')"
                            class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type == 'aus' ? 'tagsUnit' : '' }}">
                            {{ $lang['aus'] ?? 'Australia' }}
                        </div>
                    </div>
                </div>

                @if ($unit_type == 'uk')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- UK Method --}}
                        <div class="space-y-2">
                            <label for="uk_method" class="font-s-14 text-blue">{{ $lang['t_cal'] ?? 'Type of Buyer' }}</label>
                            <select wire:model.live="uk_method" id="uk_method" class="input">
                                <option value="single">{{ $lang['s'] ?? 'Single Property' }}</option>
                                <option value="add">{{ $lang['a'] ?? 'Additional Property' }}</option>
                                <option value="first">{{ $lang['f'] ?? 'First-Time Buyer' }}</option>
                            </select>
                        </div>
                        {{-- UK Purchase Price --}}
                        <div class="space-y-2 relative">
                            <label for="value" class="font-s-14 text-blue">{{ $lang['purchase_price'] ?? 'Purchase Price' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="value" id="value" class="input" placeholder="5000000">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">£</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($unit_type == 'aus')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Aus Purchase Price --}}
                        <div class="space-y-2 relative">
                            <label for="ausval" class="font-s-14 text-blue">{{ $lang['purchase_price'] ?? 'Purchase Price' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="ausval" id="ausval" class="input" placeholder="20">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">$</span>
                            </div>
                        </div>
                        {{-- State --}}
                        <div class="space-y-2">
                            <label for="aus_method" class="font-s-14 text-blue">{{ $lang['state'] ?? 'State' }}</label>
                            <select wire:model.live="aus_method" id="aus_method" class="input">
                                <option value="nsw">{{ $lang['nsw'] ?? 'NSW' }}</option>
                                <option value="act">{{ $lang['act'] ?? 'ACT' }}</option>
                                <option value="nt">{{ $lang['nt'] ?? 'NT' }}</option>
                                <option value="qld">{{ $lang['qld'] ?? 'QLD' }}</option>
                                <option value="sa">{{ $lang['sa'] ?? 'SA' }}</option>
                                <option value="tas">{{ $lang['tas'] ?? 'TAS' }}</option>
                                <option value="vic">{{ $lang['vic'] ?? 'VIC' }}</option>
                                <option value="wa">{{ $lang['wa'] ?? 'WA' }}</option>
                            </select>
                        </div>
                        {{-- First Home Buyer --}}
                        <div class="space-y-2">
                            <label for="first" class="font-s-14 text-blue">{{ $lang['f'] ?? 'First Home Buyer?' }}</label>
                            <select wire:model.live="first" id="first" class="input">
                                <option value="no">{{ $lang['no'] ?? 'No' }}</option>
                                <option value="yes">{{ $lang['yes'] ?? 'Yes' }}</option>
                            </select>
                        </div>
                        {{-- Property Type --}}
                        <div class="space-y-2">
                            <label for="property" class="font-s-14 text-blue">{{ $lang['property'] ?? 'Property Type' }}</label>
                            <select wire:model.live="property" id="property" class="input">
                                <option value="live">{{ $lang['pa'] ?? 'Primary Home' }}</option>
                                <option value="invest">{{ $lang['pb'] ?? 'Investment' }}</option>
                                <option value="land">{{ $lang['pc'] ?? 'Vacant Land' }}</option>
                            </select>
                        </div>
                    </div>
                @endif
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
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full lg:p-2 md:p-2 rounded-lg mt-3">
                        @if(isset($detail['Add']))
                        <div class="lg:w-[80%] w-full overflow-auto mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b" style="width: 70%"><strong>{{ $lang['stamp_duty'] }} </strong></td>
                                    <td class="py-2 border-b">
                                        @if(isset($detail['stamp_duty']))
                                        {{"£".$detail['stamp_duty']}}
                                        @else
                                        £0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" style="width: 70%"><strong>{{ $lang['effective_data'] }} </strong></td>
                                    <td class="py-2 border-b">
                                        @if(isset($detail['percent']))
                                        {{ $detail['percent']."%" }}
                                        @else
                                        0%
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="lg:w-[80%] w-full overflow-auto  mt-2">
                            <table class="w-full text-base">
                                <tr>
                                    <td class="py-2 border-b font-bold">{{ $lang['tax_bnad']}}</td>
                                    <td class="py-2 border-b font-bold">%</td>
                                    <td class="py-2 border-b font-bold">{{ $lang['taxable_sum']}}</td>
                                    <td class="py-2 border-b font-bold">{{ $lang['tax']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">less than £125k</td>
                                    <td class="py-2 border-b">0</td>
                                    @if ($detail['a'] != '')
                                    <td class="py-2 border-b">£ {{ $detail['as'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['a'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">£125k to £250k</td>
                                    <td class="py-2 border-b">2</td>
                                    @if ($detail['b'] != '')
                                    <td class="py-2 border-b">£{{ $detail['bs'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['b'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">£250k to £925k</td>
                                    <td class="py-2 border-b">5</td>
                                    @if ($detail['c'] != '')
                                    <td class="py-2 border-b">£{{ $detail['cs'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['c'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">£925k to £1.5m</td>
                                    <td class="py-2 border-b">10</td>
                                    @if ($detail['d'] != '')
                                    <td class="py-2 border-b">£{{ $detail['ds'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['d'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">rest over £1.5m</td>
                                    <td class="py-2 border-b">12</td>
                                    @if ($detail['e'] != '')
                                    <td class="py-2 border-b">£{{ $detail['es'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['e'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        @endif
                        @if(isset($detail['Sub']))
                        <div class="lg:w-[80%] w-full overflow-auto  mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['t_a']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_a']!='')? "$".$detail['aus_a']:'$0.0')}}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['1st_ans']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_b']!='')? "$".$detail['aus_b']:'$0.0')}}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['2nd_ans']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_c']!='')? "$".$detail['aus_c']:'$0.0')}}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['3rd_ans']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_d']!='')? "$".$detail['aus_d']:'$0.0')}}</b></td>
                                </tr>
                            </table>
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
            </div>
        @endisset
    </form>
</div>
