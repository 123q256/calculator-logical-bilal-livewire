<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="real" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Real GDP' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="real" id="real" class="input" aria-label="real" placeholder="413" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="real_unit" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="real_unit" id="real_unit" class="input">
                                <option value="{{ $lang[6] ?? 'thousand' }}">{{ $lang['6'] ?? 'Thousand' }}</option>
                                <option value="{{ $lang[7] ?? 'million' }}">{{ $lang['7'] ?? 'Million' }}</option>
                                <option value="{{ $lang[8] ?? 'billion' }}">{{ $lang['8'] ?? 'Billion' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="population" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Population' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="population" id="population" class="input" aria-label="population" placeholder="413" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="population_unit" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-full py-2">
                            <select wire:model.live="population_unit" id="population_unit" class="input">
                                <option value="{{ $lang[6] ?? 'thousand' }}">{{ $lang['6'] ?? 'Thousand' }}</option>
                                <option value="{{ $lang[7] ?? 'million' }}">{{ $lang['7'] ?? 'Million' }}</option>
                                <option value="{{ $lang[8] ?? 'billion' }}">{{ $lang['8'] ?? 'Billion' }}</option>
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }}</strong></td>
                                <td class="py-2 border-b"> {{ round($detail['answer'], 4) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 text-[16px]">
                        <p class="mt-2"><strong>{{$lang['4']}}</strong></p>
                        <p class="mt-2">{{$lang['5']}}.</p>
                        <p class="mt-2">
                            {{$lang['3']}} = 
                               <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                   <span class="num">{{$lang['1']}}</span>
                                   <span class="visually-hidden"> / </span>
                                   <span class="den">{{$lang['2']}}</span>
                               </span>
                           </p>
                           <p class="mt-2">
                               {{ $lang['3'] ?? 'GDP Per Capita' }} = 
                                  <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                      <span class="num">{{ $real + 0 }} ({{ $real_unit }})</span>
                                      <span class="visually-hidden"> / </span>
                                      <span class="den">{{ $population + 0 }} ({{ $population_unit }})</span>
                                  </span>
                              </p>
                        <p class="mt-2"> {{ $lang['3'] ?? 'GDP Per Capita' }} = {{ round($detail['answer'], 4) + 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
