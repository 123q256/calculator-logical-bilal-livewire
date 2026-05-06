<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        @if ($errors->any())
            <div class="text-red-500 text-lg font-semibold w-full">
                @foreach ($errors->all() as $validation_error)
                    <p>{{ $validation_error }}</p>
                @endforeach
            </div>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <table class="w-full">
                        <tr>
                            <td colspan="3" class="pb-2">
                                <label for="s_f_input" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="number" wire:model.live="s_f" id="s_f_input" class="input" aria-label="input" placeholder="2" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="pt-2">
                                <label for="str_f_input" class="font-s-14 text-blue my-2">{{ $lang['2'] }}:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" wire:model.live="str_f" id="str_f_input" class="input my-2" aria-label="input" placeholder="str" />
                            </td>
                            <td>
                                <input type="number" wire:model.live="dex_f" id="dex_f_input" class="input my-2" aria-label="input" placeholder="dex" />
                            </td>
                            <td>
                                <input type="number" wire:model.live="int_f" id="int_f_input" class="input my-2" aria-label="input" placeholder="int" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="pb-2">
                                <label for="r_f_input" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" wire:model.live="r_f" id="r_f_input" class="input" aria-label="input" placeholder="R" />
                            </td>
                            <td>
                                <input type="number" wire:model.live="g_f" id="g_f_input" class="input" aria-label="input" placeholder="G" />
                            </td>
                            <td>
                                <input type="number" wire:model.live="b_f" id="b_f_input" class="input" aria-label="input" placeholder="B" />
                            </td>
                        </tr>
                    </table>
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

                <div class="w-full mt-5">
                    <div class="overflow-auto">
                        <table class="w-full text-left border-collapse" id="table">
                          <thead>
                            <tr class="bg-gray-100">
                              <th class="border-b py-3 px-4 font-semibold text-sm">{{$lang['5']}}</th>
                              <th class="border-b py-3 px-4 font-semibold text-sm">{{$lang['6']}}<br><span class="tab_sub text-xs">({{$lang['7']}})</span></th>
                              <th class="border-b py-3 px-4 font-semibold text-sm">{{$lang['8']}}</th>
                              <th class="border-b py-3 px-4 font-semibold text-sm">{{$lang['9']}}<br><span class="tab_sub text-xs">({{$lang['10']}})</span></th>
                              <th class="border-b py-3 px-4 font-semibold text-sm">{{$lang['11']}}<br><span class="tab_sub text-xs">({{$lang['7']}})</span></th>
                              <th class="border-b py-3 px-4 font-semibold text-sm">{{$lang['12']}}<br><span class="tab_sub text-xs">({{$lang['13']}})</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($detail['results'] as $res)
                                <tr class="border-b hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50/50' : '' }}">
                                    <td class="py-3 px-4 text-sm">{{ $res['name'] }}</td>
                                    <td class="py-3 px-4 text-sm"><span class="highlighted"><b>{{ $res['avgCost'] }}</b></span></td>
                                    <td class="py-3 px-4 text-sm">{{ $res['chance'] }}</td>
                                    <td class="py-3 px-4 text-sm">{{ $res['avgTries'] }}</td>
                                    <td class="py-3 px-4 text-sm">{{ $res['cost'] }}</td>
                                    <td class="py-3 px-4 text-sm">{{ $res['stdDev'] }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
