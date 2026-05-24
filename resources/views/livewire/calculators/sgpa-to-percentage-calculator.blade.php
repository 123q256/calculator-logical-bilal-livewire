<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab {{ $calc_type === 'first' ? 'tagsUnit' : '' }}" wire:click="$set('calc_type', 'first')">
                            {{ $lang['4'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab {{ $calc_type === 'second' ? 'tagsUnit' : '' }}" wire:click="$set('calc_type', 'second')">
                            {{ $lang['5'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-5   gap-2 md:gap-4 lg:gap-4">

            @if ($calc_type === 'first')
            <div class="col-span-12" id="simpleInput">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="selection" class="input" id="selection" aria-label="select">
                            <option value="1">{{"SGPA ".$lang[2]}}</option>
                            <option value="2">{{"SGPA ".$lang[3]." CGPA"}}</option>
                        </select>
                    </div>
                </div>
                @if ($selection == '1')
                <div class="col-12 mt-0 mt-lg-2 sgpa1">
                    <label for="sgp" class="font-s-14 text-blue">Enter Your SGPA:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="sgp" id="sgp" class="input" aria-label="input"/>
                    </div>
                </div>
                @endif
                @if ($selection == '2')
                <div class="finch2">
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="number_of_semesters" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="number_of_semesters" id="number_of_semesters" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="sum" class="font-s-14 text-blue">{{ $lang['8'] }} SGPAs {{ $lang['9'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="sum" id="sum" class="input" aria-label="input"/>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
            
            @if ($calc_type === 'second')
            <div id="advancedInput" class="col-span-12" x-data="{ rows: $wire.entangle('rowCount') }">
                @for ($i = 0; $i < 12; $i++)
                    <div class="col-12 mt-0 mt-lg-2" x-show="rows > {{ $i }}" style="{{ $i > 0 ? 'display: none;' : '' }}" x-cloak>
                        <span class="font-s-14 text-blue">Enter Semester {{ $i + 1 }} SGPA:</span>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="sgpa.{{ $i }}" class="input" aria-label="input"/>
                        </div>
                    </div>
                @endfor
                <div class="col-12 text-end mt-3" id="btn2">
                    <button type="button" @click="if(rows < 12) { rows++; $wire.set('detail', null); }" title="Add More Fields" class="px-3 py-2 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><span>+</span>{{$lang[6]}}</button>
                </div>
            </div>
            @endif
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
                            @isset($detail['percentage'])
                                <div class="w-full text-center text-[20px]">
                                    <p>CGPA</p>
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[25px] rounded-lg text-blue">{{$detail['percentage']}}</strong></p>
                                </div>
                            @endisset
                            @isset($detail['final_gpa'])
                                <div class="w-full text-center text-[20px]">
                                    <p>{{$lang[10]}}</p>
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[25px] rounded-lg text-blue">{{$detail['final_gpa']}}%</strong></p>
                                </div>
                            @endisset
                            @isset($detail['final_result'])
                                <div class="w-full text-center text-[20px]">
                                    <p>{{$lang[11]}} CGPA {{$lang[12]}}</p>
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[25px] rounded-lg text-blue">{{$detail['final_result']}}</strong></p>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
