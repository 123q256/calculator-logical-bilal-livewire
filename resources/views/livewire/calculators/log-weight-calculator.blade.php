<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">
                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="category" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select wire:model.live="category" id="category" class="input">
                                    <option value="log">{{ $lang['2'] }}</option>
                                    <option value="board">{{ $lang['3'] }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="woodSelector" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select wire:model.live="woodSelector" id="woodSelector" class="input">
                                    <option value="46@">{{ $lang['5'] }}</option>
                                    <option value="55@">{{ $lang['6'] }}</option>
                                    <option value="47@">{{ $lang['7'] }}</option>
                                    <option value="48@">{{ $lang['8'] }}</option>
                                    <option value="48@@">{{ $lang['9'] }}</option>
                                    <option value="43">{{ $lang['10'] }}</option>
                                    <option value="51@">{{ $lang['11'] }}</option>
                                    <option value="42">{{ $lang['12'] }}</option>
                                    <option value="54@">{{ $lang['13'] }}</option>
                                    <option value="50@@@@@@">{{ $lang['14'] }}</option>
                                    <option value="57">{{ $lang['15'] }}</option>
                                    <option value="46@@">{{ $lang['16'] }}</option>
                                    <option value="45@">{{ $lang['17'] }}</option>
                                    <option value="28">{{ $lang['18'] }}</option>
                                    <option value="45@@">{{ $lang['19'] }}</option>
                                    <option value="55@@">{{ $lang['20'] }}</option>
                                    <option value="50@">{{ $lang['21'] }}</option>
                                    <option value="49@">{{ $lang['22'] }}</option>
                                    <option value="54@@">{{ $lang['23'] }}</option>
                                    <option value="39@">{{ $lang['24'] }}</option>
                                    <option value="29">{{ $lang['25'] }}</option>
                                    <option value="47@@">{{ $lang['26'] }}</option>
                                    <option value="45@@@">{{ $lang['27'] }}</option>
                                    <option value="50@@">{{ $lang['28'] }}</option>
                                    <option value="50@@@">{{ $lang['29'] }}</option>
                                    <option value="49@@">{{ $lang['30'] }}</option>
                                    <option value="41@">{{ $lang['31'] }}</option>
                                    <option value="64@">{{ $lang['32'] }}</option>
                                    <option value="63@">{{ $lang['33'] }}</option>
                                    <option value="41@@">{{ $lang['34'] }}</option>
                                    <option value="51@@">{{ $lang['35'] }}</option>
                                    <option value="58@">{{ $lang['36'] }}</option>
                                    <option value="61@">{{ $lang['37'] }}</option>
                                    <option value="59">{{ $lang['38'] }}</option>
                                    <option value="50@@@@">{{ $lang['39'] }}</option>
                                    <option value="45@@@@">{{ $lang['40'] }}</option>
                                    <option value="56">{{ $lang['41'] }}</option>
                                    <option value="62@">{{ $lang['42'] }}</option>
                                    <option value="66">{{ $lang['43'] }}</option>
                                    <option value="52@">{{ $lang['44'] }}</option>
                                    <option value="76">{{ $lang['45'] }}</option>
                                    <option value="64@@">{{ $lang['46'] }}</option>
                                    <option value="63@@">{{ $lang['47'] }}</option>
                                    <option value="63@@@">{{ $lang['48'] }}</option>
                                    <option value="64@@">{{ $lang['49'] }}</option>
                                    <option value="62@@">{{ $lang['50'] }}</option>
                                    <option value="62@@@">{{ $lang['51'] }}</option>
                                    <option value="61@@">{{ $lang['52'] }}</option>
                                    <option value="63@@@@">{{ $lang['53'] }}</option>
                                    <option value="53">{{ $lang['54'] }}</option>
                                    <option value="39@@">{{ $lang['55'] }}</option>
                                    <option value="55@@@">{{ $lang['56'] }}</option>
                                    <option value="46@@@">{{ $lang['57'] }}</option>
                                    <option value="58@@">{{ $lang['58'] }}</option>
                                    <option value="52@@">{{ $lang['59'] }}</option>
                                    <option value="36">{{ $lang['60'] }}</option>
                                    <option value="38">{{ $lang['61'] }}</option>
                                    <option value="50@@@@@">{{ $lang['62'] }}</option>
                                    <option value="44">{{ $lang['63'] }}</option>
                                    <option value="34">{{ $lang['64'] }}</option>
                                    <option value="32@">{{ $lang['65'] }}</option>
                                    <option value="55@@@@">{{ $lang['66'] }}</option>
                                    <option value="52@@@">{{ $lang['67'] }}</option>
                                    <option value="47@@@">{{ $lang['68'] }}</option>
                                    <option value="58@@@">{{ $lang['69'] }}</option>
                                    <option value="32@@">{{ $lang['70'] }}</option>
                                    <option value="custom">{{ $lang['71'] }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2 {{ $woodSelector === 'custom' ? '' : 'hidden' }}">
                            <label for="custom" class="font-s-14 text-blue">{{ $lang['87'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="custom" id="custom" step="any" class="input" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $custom_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["kg/m³","lb/ft³","lb/yd³","g/cm³","kg/cm³","g/m³"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('custom_unit', '{{ $unit }}'); open = false"> {{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="small_end" class="font-s-14 text-blue">
                                {{ $category == 'log' ? $lang['73'].' ds' : $lang['72'].' w' }}:
                            </label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="small_end" id="small_end" step="any" class="input" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $small_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["cm","m","in","ft","yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('small_unit', '{{ $unit }}'); open = false"> {{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['89'] }} L:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="length" id="length" step="any" class="input" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $length_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["cm","m","in","ft","yd"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('length_unit', '{{ $unit }}'); open = false"> {{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 flex flex-col justify-center">
                        <div>
                            <img src="{{ $category == 'log' ? asset('images/wood_log.webp') : asset('images/wood_board.webp') }}" alt="Wood" class="max-width mt-5" width="500" height="150">
                            
                            <div class="col-12 mt-3 mt-lg-5">
                                <label for="large_end" class="font-s-14 text-blue">
                                    {{ $category == 'log' ? $lang['75'].' dl' : $lang['74'].' t' }}:
                                </label>
                                <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                    <input type="number" wire:model.live="large_end" id="large_end" step="any" class="input" placeholder="00" />
                                    <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $large_unit }} ▾</label>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach (["cm","m","in","ft","yd","mm"] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('large_unit', '{{ $unit }}'); open = false"> {{ $unit }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <p class="col-span-12 font-bold">{{ $lang['76'] }}</p>
                    
                    <div class="col-span-6">
                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="stack_w" class="font-s-14 text-blue">{{ $lang['77'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="stack_w" id="stack_w" step="any" class="input" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $stackw_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["cm", "m", "in", "ft", "yd", "mm"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('stackw_unit', '{{ $unit }}'); open = false"> {{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="stack_h" class="font-s-14 text-blue">{{ $lang['78'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="stack_h" id="stack_h" step="any" class="input" placeholder="00" />
                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $stackh_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["cm", "m", "in", "ft", "yd", "mm"] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('stackh_unit', '{{ $unit }}'); open = false"> {{ $unit }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 flex items-center justify-center">
                        <img src="{{ $category == 'log' ? asset('images/stack_log.webp') : asset('images/stack_board.webp') }}" alt="Stack" class="max-width" width="500" height="150">
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
    </form>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" wire:key="result-{{ $result_key }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 mt-8">
            <div class="w-full">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                
                <div class="mt-3">
                    <div class="w-full lg:w-[80%] overflow-auto">
                        <table class="w-full text-left text-[18px]">
                            @if($category == 'log')
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['79']}}:</strong></td>
                                    <td class="border-b py-2">{{ $detail['dm_of_mid'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['80']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['volume']}} cu ft</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['81']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['weight']}} lb</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['82']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['quantity_stack']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['83']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['weight_stack']}} lb</td>
                                </tr>
                            @else
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['80']}}:</strong></td>
                                    <td class="border-b py-2">{{ $detail['volume'] }} cu ft</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['84']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['weight']}} lb</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['85']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['quantity_stack']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['86']}}:</strong></td>
                                    <td class="border-b py-2">{{$detail['weight_stack']}} lb</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
