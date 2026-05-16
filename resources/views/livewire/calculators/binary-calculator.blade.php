 <div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 md:col-span-4 lg:col-span-4  ">
                    <label for="bnr_slc" class="label">&nbsp;</label>
                </div>
                <div class="col-span-5 md:col-span-4 lg:col-span-4  ">
                    <label for="bnr_frs" class="label py-2 mb-3">{{$lang["6"]}}:</label>
                    <input type="text" wire:model.live="bnr_frs" name="bnr_frs" id="bnr_frs" class="input mt-2" aria-label="input" @click="$wire.set('detail', null)"/>
                </div>
                <div class="col-span-4 md:col-span-4 lg:col-span-4 ">
                    <label for="bnr_tpe1" class="label">&nbsp;</label>
                    <select wire:model.live="bnr_tpe1" name="bnr_tpe1" class="input mt-2" id="bnr_tpe1" aria-label="select" @change="$wire.set('detail', null)">
                        <option value="binary">{{ $lang["2"] }}</option>
                        <option value="decimal">{{$lang["3"]}}</option>
                        <option value="hexadecimal">{{$lang["4"]}}</option>
                        <option value="octal">{{$lang["5"]}}</option>
                    </select>
                </div>
        
            </div>
            <div class="grid grid-cols-12  mt-4 gap-4">
                <div class="col-span-3 md:col-span-4 lg:col-span-4 ">
                    <label for="bnr_slc" class="label">&nbsp;</label>
                    <select wire:model.live="bnr_slc" name="bnr_slc" class="input mt-2" id="bnr_slc" aria-label="select" @change="$wire.set('detail', null)">
                        <option value="add">+</option>
                        <option value="sub">-</option>
                        <option value="mult">*</option>
                        <option value="divd">/</option>
                    </select>
                </div>
                <div class="col-span-5 md:col-span-4 lg:col-span-4 order-1 md:order-2">
                    <label for="bnr_sec" class="label">{{$lang["7"]}}:</label>
                    <input type="text" wire:model.live="bnr_sec" name="bnr_sec" id="bnr_sec" class="input mt-2" aria-label="input" @click="$wire.set('detail', null)"/>
                </div>
                <div class="col-span-4 md:col-span-4 lg:col-span-4 order-2 ">
                    <label for="bnr_tpe2" class="label">&nbsp;</label>
                    <select wire:model.live="bnr_tpe2" name="bnr_tpe2" class="input mt-2" id="bnr_tpe2" aria-label="select" @change="$wire.set('detail', null)">
                        <option value="binary">{{ $lang["2"] }}</option>
                        <option value="decimal">{{$lang["3"]}}</option>
                        <option value="hexadecimal">{{$lang["4"]}}</option>
                        <option value="octal">{{$lang["5"]}}</option>
                    </select>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  rounded-lg mt-3">
                    <div class="flex flex-col">
                        <div class="lg:w-[70%] overflow-auto mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["2"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['bn'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["3"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['dc'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["4"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['hx'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["5"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['oc'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.querySelector("input#bnr_frs").addEventListener("keypress", function(e) {
                var inputType = document.querySelector("#bnr_tpe1").value;
                var validKeys = [];
                switch (inputType) {
                    case "binary":
                        validKeys = [48, 49, 8];
                        break;
                    case "hexadecimal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 97, 98, 99, 100, 101, 102];
                        break;
                    case "octal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55];
                        break;
                    case "decimal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
                        break;
                    default:
                        validKeys = [];
                }
                if (validKeys.indexOf(e.which) === -1) {
                    e.preventDefault();
                }
            });
            document.querySelector("input#bnr_sec").addEventListener("keypress", function(e) {
                var inputType = document.querySelector("#bnr_tpe2").value;
                var validKeys = [];
                switch (inputType) {
                    case "binary":
                        validKeys = [48, 49, 8];
                        break;
                    case "hexadecimal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 97, 98, 99, 100, 101, 102];
                        break;
                    case "octal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55];
                        break;
                    case "decimal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
                        break;
                    default:
                        validKeys = [];
                }
                if (validKeys.indexOf(e.which) === -1) {
                    e.preventDefault();
                }
            });
        </script>
    @endpush
</form>
</div>
