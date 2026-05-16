 <div>
 <form wire:submit.prevent="calculate">
           

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['know'] }}:</label>
                    <select class="input" aria-label="select" wire:model.live="to_calculate" name="to_calculate" id="to_calculate">
                        <option value="rad">{{$lang['rad']}}</option>
                        <option value="tsa">{{$lang['tsa']}}</option>
                        <option value="vol">{{$lang['vol']}}</option>
                        <option value="csa">{{$lang['cfa']}}</option>
                        <option value="cf">{{$lang['bc']}}</option>
                    </select>
                </div>
                <div class="space-y-2" x-data="{ openUnit: false }">
                    <label for="value" class="font-s-14 text-blue">
                        {{$lang['enter']}} 
                        <span id="textChanged">
                            @if($to_calculate =='tsa')
                                {{$lang['tsa']}}
                            @elseif($to_calculate =='vol')
                                {{$lang['vol']}}
                            @elseif($to_calculate =='csa')
                                {{$lang['cfa']}}
                            @elseif($to_calculate =='cf')
                                {{$lang['bc']}}
                            @else
                                {{$lang['rad']}}
                            @endif
                        </span>
                    </label>
                    <div class="relative w-full ">
                        <input type="number" wire:model.live="value" name="value" id="value" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="openUnit = !openUnit">{{ $unit }} ▾</label>
                        <input type="text" wire:model.live="unit" name="unit" id="unit" class="hidden">
                        <div x-show="openUnit" @click.away="openUnit = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'in'); openUnit = false">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'ft'); openUnit = false">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'yd'); openUnit = false">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'cm'); openUnit = false">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'm'); openUnit = false">meters (m)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="rof" class="font-s-14 text-blue">{{ $lang['round'] }}:</label>
                    <select class="input" aria-label="select" wire:model.live="rof" name="rof" id="rof">
                        @for ($i = 0; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg flex items-center ">
                <div class="w-full lg:w-[80%] rounded-lg mt-3 overflow-auto">
                    <div class=" flex-col space-y-3">
                        <div class="w-full mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['rad']}}</td>
                                    <td class="py-2 border-b border-gray-300">{{$detail['radi']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bc']}}</td>
                                    <td class="py-2 border-b border-gray-300">{{$detail['cs']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['vol']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['vs']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['cfa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['as']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['as']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['tsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['tsas']!!}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-3 text-lg"><strong>In terms of Pi π</strong></p>
                        <div class="w-full mt-3">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bc']}}</td>
                                    <td class="py-2 border-b border-gray-300">{{$detail['pcs']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['vol']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['pvs']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['cfa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['pas']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['pbs']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['tsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['ptsas']!!}</td>
                                </tr>
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
