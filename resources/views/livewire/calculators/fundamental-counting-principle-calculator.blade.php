<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto" x-data="{
           choices: @entangle('choices').live,
           ordinalSuffix(number) {
                if ([11, 12, 13].includes(number % 100)) {
                    return number + 'th';
                }
                switch (number % 10) {
                    case 1: return number + 'st';
                    case 2: return number + 'nd';
                    case 3: return number + 'rd';
                    default: return number + 'th';
                }
           }
       }">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

            <!-- First Input -->
            <div class="col-span-12">
                <span class="font-s-14 text-blue">{{ $lang['2'] }}:</span>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" x-model="choices[0]" class="input pr-10" aria-label="input" />
                </div>
            </div>

            <!-- Second Input -->
            <div class="col-span-12">
                <span class="font-s-14 text-blue">{{ $lang['3'] }}:</span>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" x-model="choices[1]" class="input pr-10" aria-label="input" />
                </div>
            </div>

            <!-- Additional Inputs -->
            <template x-for="(choice, index) in choices" :key="index">
                <template x-if="index > 1">
                    <div class="col-span-12">
                        <span class="font-s-14 text-blue" x-text="'Number of choices for the ' + ordinalSuffix(index + 1) + ' thing:'"></span>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" x-model="choices[index]" class="input pr-10" aria-label="input" />
                            <button type="button" @click="choices.splice(index, 1)" class="absolute right-2 top-[18px] text-red-500 hover:text-red-700" title="Remove">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </template>
            </template>

            <div class="col-span-12 text-end mt-3">
                <button type="button" @click="choices.length < 10 ? choices.push(7) : alert('Only Ten Fields are Allowed')" title="Add New Room" class="px-3 py-2 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><span>+</span>{{$lang[6]}}</button>
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
    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['answer'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full  text-[16px]">
                                <p class="mt-2"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">{{$lang['1']}}</p>
                                <p class="mt-2">
                                    @php
                                        foreach ($detail['choices'] as $key => $value) {
                                            echo $value;
                                            if ($key < count($detail['choices']) - 1) {
                                                echo " × ";
                                            }
                                        }
                                    @endphp
                                    = {{round($detail['answer'], 2) }}
                                </p>
                                <p class="mt-2">{{$lang['5']}} {{count($detail['choices'])}} {{$lang['6']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset

</form>
</div>
