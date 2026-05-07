<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="from" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="from" id="from" class="input my-2">
                            <option value="353146667214.89">Cubic Feet [ft³]</option>
                            <option value="6.1023744094732E+14">Cubic Inch [in³]</option>
                            <option value="42267528377304">Cups (US)</option>
                            <option value="40000000000000">Cups (Metric)</option>
                            <option value="2641720523581.5">Gallons (US)</option>
                            <option value="2199692482990.9">Gallons (UK)</option>
                            <option value="10000000000000">Liter [L]</option>
                            <option value="1.0E+16">Milliliters [mL]</option>
                            <option value="21133764188652">Pints (US)</option>
                            <option value="17597539863927">Pints (UK)</option>
                            <option value="10566882094326">Quarts (US) [qt]</option>
                            <option value="8798769931963.5">Quarts (UK)</option>
                            <option value="6.7628045403686E+14">Tablespoons (US)</option>
                            <option value="5.6312127564566E+14">Tablespoons (UK)</option>
                        </select>
                    </div> 

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="vol" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" wire:model.live="vol" id="vol" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="temp" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                        <select wire:model.live="temp" id="temp" class="input my-2">
                            <option value="0.99987">32°F / 0°C</option>
                            <option value="1.00000">39.2°F / 4.0°C</option>
                            <option value="0.99999">40°F / 4.4°C</option>
                            <option value="0.99975">50°F / 10°C</option>
                            <option value="0.99907">60°F / 15.6°C</option>
                            <option value="0.99802">70°F / 21°C (room temp)</option>
                            <option value="0.99669">80°F / 26.7°C</option>
                            <option value="0.99510">90°F / 32.2°C</option>
                            <option value="0.99318">100°F / 37.8°C</option>
                            <option value="0.98870">120°F / 48.9°C</option>
                            <option value="0.98338">140°F / 60°C</option>
                            <option value="0.97729">160°F / 71.1°C</option>
                            <option value="0.97056">180°F / 82.2°C</option>
                            <option value="0.96333">200°F / 93.3°C</option>
                            <option value="0.95865">212°F / 100°C</option>
                        </select>
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
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" wire:key="result-{{ $result_key }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-8">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full my-2">
                            <p class="text-[20px] mt-1 font-bold"><strong>{{$lang[14]}}</strong></p>
                            <div class="grid grid-cols-1 overflow-auto">
                                <table class="w-full lg:text-[20px] md:text-[20px] text-[16px] text-left">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang[15]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['gram'],5)}} g</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[16]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['lbs'],5)}} lbs</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[17]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['onz'],5)}} oz</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[18]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['kg'],5)}} kg</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
