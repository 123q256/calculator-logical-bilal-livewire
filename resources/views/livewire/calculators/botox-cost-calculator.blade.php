<div x-data="{ 
    solve: @entangle('solve'),
    get label1() {
        if (this.solve == '2') return '{{ $lang[4] }}';
        if (this.solve == '3') return '{{ $lang[3] }}';
        return '{{ $lang[4] }}';
    },
    get label2() {
        if (this.solve == '2') return '{{ $lang[2] }}';
        if (this.solve == '3') return '{{ $lang[2] }}';
        return '{{ $lang[3] }}';
    },
    get showUnit1() { return this.solve != '3'; },
    get showUnit2() { return this.solve != '1'; }
}">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    {{-- Solve For --}}
                    <div class="w-full">
                        <label for="solve" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="solve" id="solve" class="input">
                                <option value="1">{{ $lang[2] }}</option>
                                <option value="2">{{ $lang[3] }}</option>
                                <option value="3">{{ $lang[4] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Input 1 --}}
                    <div class="w-full">
                        <label x-text="label1 + ':'" class="label"></label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="input_f" id="input_f" step="any" class="input" placeholder="00" />
                            <span x-show="showUnit1" class="absolute right-6 top-3.5 font-bold text-gray-400" x-cloak>{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- Input 2 --}}
                    <div class="w-full md:col-span-2">
                        <label x-text="label2 + ':'" class="label"></label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="input_s" id="input_s" step="any" class="input" placeholder="00" />
                            <span x-show="showUnit2" class="absolute right-6 top-3.5 font-bold text-gray-400" x-cloak>{{ $currancy }}</span>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full text-center">
                            <p class="text-[]20px">
                                <strong>
                                    @php
                                        if ($solve === "1") {
                                            echo $lang[2];
                                            $money = $currancy;
                                        }else if ($solve === "2") {
                                            echo $lang[3];
                                            $money = '';
                                        }else{
                                            echo $lang[4];
                                            $money = $currancy;
                                        }
                                    @endphp
                                </strong>
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">

                                <strong class="text-[25px]">{{round($detail['answer'], 4)}}<span class="font-s-20"> {{$money}} </span>
                                </strong></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
