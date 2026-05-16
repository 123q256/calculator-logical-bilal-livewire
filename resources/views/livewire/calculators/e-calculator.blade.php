<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="cal" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" id="cal" aria-label="select">
                                <option value="ex">eˣ</option>
                                <option value="10x">10ˣ</option>
                                <option value="ax">aˣ</option>
                            </select>
                        </div>
                    </div>

                    @if($cal === 'ax')
                        <div class="col-span-12">
                            <label for="a" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a" id="a" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12">
                        <label for="x" class="font-s-14 text-blue">x:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ count($detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">
                                            <strong>
                                                @if($cal === 'ex')
                                                    e
                                                @elseif($cal === '10x')
                                                    10
                                                @else
                                                    {{ $a }}
                                                @endif
                                                <sup class="text-[14px]">{{ $x }}</sup>
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b">{{ round($detail['exp'], 8) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-4">
                                <p><strong>{{ $lang['3'] }}</strong></p>
                                @if($cal === 'ex')
                                    <p class="mt-2">e<sup>x</sup> = ?</p>
                                    <p class="mt-2">(2.71828)<sup>{{ $x }}</sup> = {{ round($detail['exp'], 8) }}</p>
                                @elseif($cal === '10x')
                                    <p class="mt-2">10<sup>x</sup> = ?</p>
                                    <p class="mt-2">(10)<sup>{{ $x }}</sup> = {{ round($detail['exp'], 8) }}</p>
                                @else
                                    <p class="mt-2">a<sup>x</sup> = ?</p>
                                    <p class="mt-2">({{ $a }})<sup>{{ $x }}</sup> = {{ round($detail['exp'], 8) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
