<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[80%] w-full mx-auto mt-2">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ $calc_type === 'first' ? 'tagsUnit' : '' }}" wire:click="$set('calc_type', 'first')">
                            {{ $lang['10'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ $calc_type === 'second' ? 'tagsUnit' : '' }}" wire:click="$set('calc_type', 'second')">
                            {{ $lang['11'] }}
                    </div>
                </div>
            </div>
            @if ($calc_type === 'first')
            <div class="w-full" id="hexCalculator">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="bnr_frs" class="font-s-14 text-blue">{{$lang["6"]}}:</label>
                    <div class="w-full py-2">
                        <input type="text" wire:model.live="bnr_frs" id="bnr_frs" class="input uppercase" aria-label="input"
                            x-on:keypress="if (!((event.which >= 48 && event.which <= 57) || (event.which >= 97 && event.which <= 102) || (event.which >= 65 && event.which <= 70))) event.preventDefault();"
                            x-on:paste="if(event.clipboardData.getData('Text').length > 0) event.preventDefault();" />
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="bnr_sec" class="font-s-14 text-blue">{{$lang["7"]}}:</label>
                    <div class="flex gap-2">
                        <div class="w-[30%] py-2">
                            <select wire:model.live="bnr_slc" class="input" id="bnr_slc" aria-label="select">
                                <option value="add">+</option>
                                <option value="sub">-</option>
                                <option value="mult">*</option>
                                <option value="divd">/</option>
                            </select>
                        </div>
                        <div class="w-[70%] py-2">
                            <input type="text" wire:model.live="bnr_sec" id="bnr_sec" class="input uppercase" aria-label="input"
                                x-on:keypress="if (!((event.which >= 48 && event.which <= 57) || (event.which >= 97 && event.which <= 102) || (event.which >= 65 && event.which <= 70))) event.preventDefault();"
                                x-on:paste="if(event.clipboardData.getData('Text').length > 0) event.preventDefault();" />
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            @if ($calc_type === 'second')
            <div class="w-full my-3" id="hexConverter" x-data="{ options: @entangle('options') }">
                <div class="col-12 mt-0 mt-lg-2 flex justify-around ">
                    <p id="hex_to_dec">
                        <input type="radio" wire:model.live="options" id="option1" value="1" class="cursor-pointer">
                        <label for="option1" class="font-s-14 cursor-pointer"><?=$lang[12]?></label>
                    </p>
                    <p id="dec_to_hex">
                        <input type="radio" wire:model.live="options" id="option2" value="2" class="cursor-pointer">
                        <label for="option2" class="font-s-14 cursor-pointer"><?=$lang[13]?></label>
                    </p>
                </div>
                <div class="col-12 mt-0 mt-lg-2 flex justify-around ">
                    <p id="hex_to_dec">
                        <input type="radio" wire:model.live="options" id="option3" value="3" class="cursor-pointer">
                        <label for="option3" class="font-s-14 cursor-pointer"><?=$lang[14]?></label>
                    </p>
                    <p id="hex_to_dec">
                        <input type="radio" wire:model.live="options" id="option4" value="4" class="cursor-pointer">
                        <label for="option4" class="font-s-14 cursor-pointer"><?=$lang[15]?></label>
                    </p>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="nmbr" class="font-s-14 text-blue">{{$lang["16"]}}:</label>
                    <div class="w-full py-2">
                        <input type="text" wire:model.live="nmbr" id="nmbr" class="input uppercase" aria-label="input"
                            x-on:keypress="
                               if (options == '1' || options == '3') {
                                   if (!((event.which >= 48 && event.which <= 57) || (event.which >= 97 && event.which <= 102) || (event.which >= 65 && event.which <= 70))) event.preventDefault();
                               } else if (options == '2') {
                                   if (!(event.which >= 48 && event.which <= 57)) event.preventDefault();
                               } else if (options == '4') {
                                   if (!(event.which == 48 || event.which == 49 || event.which == 8)) event.preventDefault();
                               }
                            "
                            x-on:paste="if(event.clipboardData.getData('Text').length > 0) event.preventDefault();" />
                    </div>
                </div>
            </div>
            @endif
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
                            @if($detail['type']=="first")
                                <div class="col-lg-6 mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong><?=$lang[17]?></strong></td>
                                            <td class="py-2 border-b"><?=$detail['hx']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[3]?></td>
                                            <td class="py-2 border-b"><?=$detail['dc']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[2]?></td>
                                            <td class="py-2 border-b"><?=$detail['bn']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[5]?></td>
                                            <td class="py-2 border-b"><?=$detail['oc']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[17]?></td>
                                            <td class="py-2 border-b"><?=$detail['hx']?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-3"><strong><?=$lang[18]?>:</strong></p>
                                    <p class="mt-3"><?=$lang[19]?></p>
                                    <p class="mt-3"><?php echo $detail['first_ans1']." ".$detail['op']." ".$detail['second_ans1']." = ".$detail['hx']; ?></p>
                                    <p class="mt-3"><?=$lang[20]?></p>
                                    <p class="mt-3"><?php echo $detail['first_ans']." ".$detail['op']." ".$detail['second_ans']." = ".$detail['dc']; ?></p>
                                </div>
                            @else
                                <div class="w-full text-center my-2">
                                    <p><strong class="bg-[#2845F5] text-white  px-3 py-2 text-[21px] rounded-lg text-blue"><?=$detail['answer']." ".$detail['text'] ?></strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</form>
</div>
