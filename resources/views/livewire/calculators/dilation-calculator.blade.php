<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

                    <div class="col-span-12">
                        <label for="nbr" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" wire:model.live="nbr" id="nbr">
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>

                    {{-- Point A (always shown) --}}
                    <div class="col-span-6">
                        <label for="a1" class="label">{{ $lang['2'] }} A:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a1" id="a1" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="z1" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="z1" id="z1" class="input" aria-label="input" />
                        </div>
                    </div>

                    {{-- Point B (always shown) --}}
                    <div class="col-span-6">
                        <label for="a2" class="label">{{ $lang['2'] }} B:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a2" id="a2" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="z2" class="label">&nbsp;</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="z2" id="z2" class="input" aria-label="input" />
                        </div>
                    </div>

                    {{-- Point C (shown if nbr >= 3) --}}
                    @if ($nbr >= 3)
                        <div class="col-span-6">
                            <label for="a3" class="label">{{ $lang['2'] }} C:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a3" id="a3" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z3" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="z3" id="z3" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    {{-- Point D (shown if nbr >= 4) --}}
                    @if ($nbr >= 4)
                        <div class="col-span-6">
                            <label for="a4" class="label">{{ $lang['2'] }} D:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a4" id="a4" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z4" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="z4" id="z4" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    {{-- Point E (shown if nbr >= 5) --}}
                    @if ($nbr >= 5)
                        <div class="col-span-6">
                            <label for="a5" class="label">{{ $lang['2'] }} E:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a5" id="a5" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z5" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="z5" id="z5" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    {{-- Point F (shown if nbr >= 6) --}}
                    @if ($nbr >= 6)
                        <div class="col-span-6">
                            <label for="a6" class="label">{{ $lang['2'] }} F:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a6" id="a6" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z6" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="z6" id="z6" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    {{-- Point G (shown if nbr >= 7) --}}
                    @if ($nbr >= 7)
                        <div class="col-span-6">
                            <label for="a7" class="label">{{ $lang['2'] }} G:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a7" id="a7" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z7" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="z7" id="z7" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    {{-- Point H (shown if nbr >= 8) --}}
                    @if ($nbr >= 8)
                        <div class="col-span-6">
                            <label for="a8" class="label">{{ $lang['2'] }} H:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="a8" id="a8" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="z8" class="label">&nbsp;</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="z8" id="z8" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12">
                        <label for="dil" class="label">{{ $lang['3'] }}</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="dil" id="dil" class="input" aria-label="input" />
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
                                <div class="w-full lg:w-[80%] mt-2 overflow-auto">
                                    <table class="w-full text-[18px]">
                                        @for($i=0; $i < $nbr; $i++)
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }} O{{ $detail['abc'][$i] }}</strong></td>
                                                <td class="py-2 border-b">({{ $detail['aval'][$i] * $dil }} , {{ $detail['zval'][$i] * $dil }})</td>
                                            </tr>
                                        @endfor
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
