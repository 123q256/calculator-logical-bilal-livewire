<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Section 1: Balance --}}
                    <div class="col-span-12 mb-2">
                        <strong class="text-[#2845F5] border-b border-[#2845F5] pb-1 font-s-18">{{ $lang['1'] ?? 'Balance Assessment' }}</strong>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a1" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a1" id="a1" class="input">
                                <option value="0">{!! $lang['3'] !!}</option>
                                <option value="1">{!! $lang['4'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a2" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a2" id="a2" class="input">
                                <option value="0">{!! $lang['6'] !!}</option>
                                <option value="1">{!! $lang['7'] !!}</option>
                                <option value="2">{!! $lang['8'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a3" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a3" id="a3" class="input">
                                <option value="0">{!! $lang['10'] !!}</option>
                                <option value="1">{!! $lang['11'] !!}</option>
                                <option value="2">{!! $lang['12'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a4" class="font-s-14 text-blue">{!! $lang['13'] !!} (5s):</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a4" id="a4" class="input">
                                <option value="0">{!! $lang['14'] !!}</option>
                                <option value="1">{!! $lang['15'] !!}</option>
                                <option value="2">{!! $lang['16'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a5" class="font-s-14 text-blue">{!! $lang['17'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a5" id="a5" class="input">
                                <option value="0">{!! $lang['14'] !!}</option>
                                <option value="1">{!! $lang['18'] !!}</option>
                                <option value="2">{!! $lang['19'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a6" class="font-s-14 text-blue">{!! $lang['20'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a6" id="a6" class="input">
                                <option value="0">{!! $lang['21'] !!}</option>
                                <option value="1">{!! $lang['22'] !!}</option>
                                <option value="2">{!! $lang['23'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a7" class="font-s-14 text-blue">{!! $lang['24'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a7" id="a7" class="input">
                                <option value="0">{!! $lang['14'] !!}</option>
                                <option value="1">{!! $lang['23'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a8" class="font-s-14 text-blue">{!! $lang['25'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a8" id="a8" class="input">
                                <option value="0">{!! $lang['26'] !!}</option>
                                <option value="1">{!! $lang['27'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a9" class="font-s-14 text-blue">{!! $lang['28'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a9" id="a9" class="input">
                                <option value="0">{!! $lang['29'] !!}</option>
                                <option value="1">{!! $lang['23'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="a10" class="font-s-14 text-blue">{!! $lang['30'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="a10" id="a10" class="input">
                                <option value="0">{!! $lang['31'] !!}</option>
                                <option value="1">{!! $lang['32'] !!}</option>
                                <option value="2">{!! $lang['33'] !!}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Section 2: Gait --}}
                    <div class="col-span-12 mt-6 mb-2">
                        <strong class="text-[#2845F5] border-b border-[#2845F5] pb-1 font-s-18">{{ $lang['34'] ?? 'Gait Assessment' }}</strong>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b1" class="font-s-14 text-blue">{!! $lang['37'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b1" id="b1" class="input">
                                <option value="0">{!! $lang['35'] !!}</option>
                                <option value="1">{!! $lang['36'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b2" class="font-s-14 text-blue">{!! $lang['38'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b2" id="b2" class="input">
                                <option value="0">{!! $lang['39'] !!}</option>
                                <option value="1">{!! $lang['40'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b3" class="font-s-14 text-blue">{!! $lang['41'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b3" id="b3" class="input">
                                <option value="0">{!! $lang['39'] !!}</option>
                                <option value="1">{!! $lang['42'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b4" class="font-s-14 text-blue">{!! $lang['43'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b4" id="b4" class="input">
                                <option value="0">{!! $lang['44'] !!}</option>
                                <option value="1">{!! $lang['45'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b5" class="font-s-14 text-blue">{!! $lang['46'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b5" id="b5" class="input">
                                <option value="0">{!! $lang['44'] !!}</option>
                                <option value="1">{!! $lang['47'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b6" class="font-s-14 text-blue">{!! $lang['48'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b6" id="b6" class="input">
                                <option value="0">{!! $lang['49'] !!}</option>
                                <option value="1">{!! $lang['50'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b7" class="font-s-14 text-blue">{!! $lang['51'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b7" id="b7" class="input">
                                <option value="0">{!! $lang['52'] !!}</option>
                                <option value="1">{!! $lang['53'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b8" class="font-s-14 text-blue">{!! $lang['54'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b8" id="b8" class="input">
                                <option value="0">{!! $lang['55'] !!}</option>
                                <option value="1">{!! $lang['56'] !!}</option>
                                <option value="2">{!! $lang['57'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b9" class="font-s-14 text-blue">{!! $lang['58'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b9" id="b9" class="input">
                                <option value="0">{!! $lang['59'] !!}</option>
                                <option value="1">{!! $lang['60'] !!}</option>
                                <option value="2">{!! $lang['61'] !!}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label for="b10" class="font-s-14 text-blue">{!! $lang['62'] !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="b10" id="b10" class="input">
                                <option value="0">{!! $lang['63'] !!}</option>
                                <option value="1">{!! $lang['64'] !!}</option>
                            </select>
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
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 mt-3">
                        <div class="w-full ">
                            <div class="w-full lg:w-[70%] overflow-auto mb-2">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['65'] }}</td>
                                        <td class="border-b py-2">{{ $detail['add1'] }} / 16</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['66'] }}</td>
                                        <td class="border-b py-2">{{ $detail['add2'] }} / 12</strong></td>
                                    </tr>
                                    <tr>
                                        <td class=" py-2">{{ $lang['67'] }}</td>
                                        <td class="py-2">{{ $detail['add1'] + $detail['add2'] }} / 28</strong></td>
                                    </tr>
                                </table>
                            </div>
                            @if($detail['add3'] < 19)
                                <p><strong>{{ $lang['68'] }} {{ $lang['71'] }}.</strong></p>
                            @elseif($detail['add3'] >= 19 && $detail['add3'] <= 23)
                                <p><strong>{{ $lang['69'] }} {{ $lang['71'] }}.</strong></p>
                            @elseif($detail['add3'] > 23)
                                <p><strong>{{ $lang['70'] }} {{ $lang['71'] }}.</strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
