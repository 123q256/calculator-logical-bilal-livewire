<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            @if(in_array($unit, ['1','2']))
            <div class="grid grid-cols-1 gap-4 mb-4">
                <div class="w-full px-2">
                    <p class="font-s-14"><strong class="text-blue">{!! $lang['1'] !!}</strong></p>
                </div>
            </div>
            @endif
            <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="chemical_selection" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <select wire:model.live="chemical_selection" id="chemical_selection" class="input">
                        <option value="9">{{ $lang['4'] }}</option>
                        <option value="8">{{ $lang['3'] }}</option>
                    </select>
                </div>
                <div class="space-y-2" id="selection2">
                    <label for="chemical_name" class="font-s-14 text-blue">&nbsp;</label>
                    <select wire:model.live="chemical_name" id="chemical_name" class="input">
                        @foreach($chemical_options as $val => $name)
                            <option value="{{ $val }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 gap-4" style="{{ $unit == '3' ? 'display:none;' : '' }}">
                <div class="space-y-2" id="molar_mass">
                    <label for="mm" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="mm" id="mm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $mm_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('mm_unit', 'g/mol'); open = false">g/mol</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('mm_unit', 'dag/mol'); open = false">dag/mol</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('mm_unit', 'kg/mol'); open = false">kg/mol</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 gap-4">
                <div class="space-y-2">
                    <p><strong class="text-blue">{{ $lang['6'] }}</strong></p>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="unit" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                    <select wire:model.live="unit" id="unit" class="input">
                        <option value="1">{{ $lang['8'] }}</option>
                        <option value="2">{{ $lang['9'] }}(g)</option>
                        <option value="3">{{ $lang['5'] }}</option>
                    </select>
                </div>
                <div class="space-y-2" id="mass" style="{{ in_array($unit, ['1','3']) ? '' : 'display:none;' }}">
                    <label for="m" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="m" id="m" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $m_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('m_unit', 'ng'); open = false">nanograms (ng)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('m_unit', 'µg'); open = false">micrograms (µg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('m_unit', 'mg'); open = false">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('m_unit', 'g'); open = false">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('m_unit', 'dag'); open = false">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('m_unit', 'kg'); open = false">kilograms (kg)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2" id="no_moles" style="{{ in_array($unit, ['2','3']) ? '' : 'display:none;' }}">
                    <label for="nm" class="font-s-14 text-blue">{!! $lang['8'] !!}:</label>
                    <div class="relative w-full" x-data="{ open: false }">
                        <input type="number" wire:model="nm" id="nm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $nm_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" style="display:none;">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('nm_unit', 'mol'); open = false">moles (mol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('nm_unit', 'mmol'); open = false">millimoles (mmol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('nm_unit', 'μmol'); open = false">micromoles (μmol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('nm_unit', 'nmol'); open = false">nanomoles (nmol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="$set('nm_unit', 'pmol'); open = false">picomoles (pmol)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
        @include('inc.button')
        @endif
        @if ($type=='widget')
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
                <div class="w-full p-3 radius-10 mt-3">
                    <div class="w-full mt-2">
                        @if(isset($detail['ans1']) && isset($detail['ans2']))
                            <p><strong>{!! $lang['8'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans1']) !!} <span class="text-[#119154] text-[20px]">(mol)</span></strong></p>
                            <p><strong>{!! $lang['10'] !!} / {!! $lang['11'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans2']) !!}</strong></p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['12'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['5'] !!} = {!! $detail['ans91'] !!} g / mol <br>{!! $lang['9'] !!} = {!! $detail['ans90'] !!} g <br>{!! $lang['8'] !!} = ? <br> {!! $lang['10'] !!} / {!! $lang['11'] !!} = ?</p>
                            <p class="my-2"><strong>{!! $lang['13'] !!}</strong></p>
                            <p class="my-2">{!! $lang['8'] !!} = {!! $lang['9'] !!} / {!! $lang['5'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $lang['8'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['14'] !!}: </strong>{!! $lang['15'] !!}</p>
                            <p class="my-2">{!! $lang['8'] !!} = {!! $detail['ans90'] !!} / {!! $detail['ans91'] !!}</p>
                            <p class="my-2">{!! $lang['8'] !!} = {!! $detail['ans1'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans1'] !!} * 6.02214085774</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans2'] !!}</p>
                        @endif
                        @if(isset($detail['ans3']) && isset($detail['ans4']))
                            <p><strong>{!! $lang['9'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans3']) !!} <span class="text-[#119154] text-[20px]">(g)</span></strong></p>
                            <p><strong>{!! $lang['10'] !!} / {!! $lang['11'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans4']) !!}</strong></p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['12'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['5'] !!} = {!! $detail['ans90'] !!} (g/mol)
                            <br>{!! $lang['8'] !!} = {!! $detail['ans91'] !!} (mol) <br>{!! $lang['9'] !!} = ? <br>{!! $lang['10'] !!} / {!! $lang['11'] !!} = ?</p>
                            <p class="my-2"><strong>{!! $lang['13'] !!}</strong></p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $lang['8'] !!} * {!! $lang['5'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $lang['8'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['14'] !!}: </strong>{!! $lang['15'] !!}</p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $detail['ans90'] !!} * {!! $detail['ans91'] !!}</p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $detail['ans3'] !!} (g)</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans91'] !!} * 6.02214085774</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans4'] !!}</p>
                        @endif
                        @if(isset($detail['ans5']) && isset($detail['ans6']))
                            <p><strong>{!! $lang['5'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans5']) !!} <span class="text-[#119154] text-[20px]">(g/mol)</span></strong></p>
                            <p><strong>{!! $lang['10'] !!}/{!! $lang['11'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans6']) !!}</strong></p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['12'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $detail['ans90'] !!} g <br>{!! $lang['8'] !!} = {!! $detail['ans91'] !!} mol <br>{!! $lang['5'] !!} = ? <br>{!! $lang['10'] !!} / {!! $lang['11'] !!} = ?</p>
                            <p class="my-2"><strong>{!! $lang['13'] !!}</strong></p>
                            <p class="my-2">{!! $lang['5'] !!} = {!! $lang['9'] !!} / {!! $lang['8'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $lang['8'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['14'] !!}: </strong>{!! $lang['15'] !!}</p>
                            <p class="my-2">{!! $lang['5'] !!} = {!! $detail['ans90'] !!} / {!! $detail['ans91'] !!}</p>
                            <p class="my-2">{!! $lang['5'] !!} = {!! $detail['ans5'] !!} (g/mol)</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans91'] !!} * 6.02214085774</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans6'] !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
