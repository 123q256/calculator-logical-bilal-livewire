<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6">
                        <label for="slct1" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="slct1" id="slct1">
                                <option value="1">{{ $lang['2'] }} (r)</option>
                                <option value="2">{{ $lang['3'] }} (V)</option>
                                <option value="3">{{ $lang['4'] }} (A)</option>
                                <option value="4">{{ $lang['5'] }} (C)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="rad" class="label" id="textChanged">
                            @if ($slct1 == '2')
                                {{ $lang['3'] }} (V):
                            @elseif ($slct1 == '3')
                                {{ $lang['4'] }} (A):
                            @elseif ($slct1 == '4')
                                {{ $lang['5'] }} (C):
                            @else
                                {{ $lang['2'] }} (r):
                            @endif
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="rad" id="rad" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="pi" class="label">pi π:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="pi" id="pi" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="unit" class="label">{{ $lang['6'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="unit" id="unit">
                                <option value="cm">cm</option>
                                <option value="m">m</option>
                                <option value="in">in</option>
                                <option value="ft">ft</option>
                                <option value="yd">yd</option>
                            </select>
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div>
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full lg:w-[70%] overflow-auto mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['2'] }} (r)</td>
                                            <td class="py-2 border-b">{{ $detail['rad'] }} {{ $unit }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['3'] }} (V)</td>
                                            <td class="py-2 border-b">{{ $detail['vol'] }} {{ $unit }}<sup class="font-s-14">3</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['4'] }} (A)</td>
                                            <td class="py-2 border-b">{{ $detail['area'] }} {{ $unit }}<sup class="font-s-14">2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['5'] }} (C)</td>
                                            <td class="py-2 border-b">{{ $detail['c'] }} {{ $unit }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['7'] }} Pi π</strong></p>
                                <div class="w-full lg:w-[70%] overflow-auto mt-3">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['3'] }} (V)</td>
                                            <td class="py-2 border-b">{{ $detail['v1'] }} π {{ $unit }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['4'] }} (A)</td>
                                            <td class="py-2 border-b">{{ $detail['s1'] }} π {{ $unit }}<sup class="font-s-14">2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $lang['5'] }} (C)</td>
                                            <td class="py-2 border-b">{{ $detail['c1'] }} π {{ $unit }}</td>
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
