<div x-data="{ 
    unit_open: false, 
    i_v_open: false, 
    f_v_open: false, 
    c_v_open: false, 
    force_open: false, 
    time_open: false 
}">
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12  mt-lg-2" id="optional">
                <label for="operation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" wire:model.live="operation" id="operation">
                        <option value="1">{{ $lang[2] }}</option>
                        <option value="2">{{ $lang[3] }}</option>
                        <option value="3">{{ $lang[4] }}</option>
                    </select>
                </div>
            </div>

            <div class="col-span-12 px-2 mt-0 mt-lg-2" wire:ignore>
                <p class="col s12 font_s28 black-text txt" x-show="$wire.operation == '1'">
                    <b class="col s12 center">
                        $$\Delta P=m(V_f - {V_i})$$
                    </b>
                </p>
                <p class="col s12 font_s28 black-text txt" x-show="$wire.operation == '2'" x-cloak>
                    <b class="col s12 center">
                        $$\Delta P =m\Delta V$$
                    </b>
                </p>
                <p class="col s12 font_s28 black-text txt" x-show="$wire.operation == '3'" x-cloak>
                    <b class="col s12 center">
                        $$\Delta P =F.T$$
                    </b>
                </p>
            </div>

            @if($operation == '1' || $operation == '2')
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mass">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="mass" id="mass" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="unit_open = !unit_open">{{ $mass_unit }} ▾</label>
                    <div x-show="unit_open" @click.away="unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'kg'); unit_open = false">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'g'); unit_open = false">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'mg'); unit_open = false">mg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'µg'); unit_open = false">µg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'tons(t)'); unit_open = false">tons(t)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'US ton'); unit_open = false">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'long ton'); unit_open = false">long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'oz'); unit_open = false">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'lb'); unit_open = false">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'stone'); unit_open = false">stone</p>
                    </div>
                 </div>
            </div>
            @endif

            @if($operation == '1')
            <div class="col-span-12 md:col-span-6 lg:col-span-6 i_velocity">
                <label for="i_velocity" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="i_velocity" id="i_velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="i_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="i_v_open = !i_v_open">{{ $i_velocity_unit }} ▾</label>
                    <div x-show="i_v_open" @click.away="i_v_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('i_velocity_unit', 'm/s'); i_v_open = false">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('i_velocity_unit', 'km/h'); i_v_open = false">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('i_velocity_unit', 'ft/s'); i_v_open = false">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('i_velocity_unit', 'mph'); i_v_open = false">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('i_velocity_unit', 'knots'); i_v_open = false">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('i_velocity_unit', 'ft/min'); i_v_open = false">ft/min</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 f_velocity">
                <label for="f_velocity" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="f_velocity" id="f_velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="f_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="f_v_open = !f_v_open">{{ $f_velocity_unit }} ▾</label>
                    <div x-show="f_v_open" @click.away="f_v_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_velocity_unit', 'm/s'); f_v_open = false">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_velocity_unit', 'km/h'); f_v_open = false">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_velocity_unit', 'ft/s'); f_v_open = false">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_velocity_unit', 'mph'); f_v_open = false">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_velocity_unit', 'knots'); f_v_open = false">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_velocity_unit', 'ft/min'); f_v_open = false">ft/min</p>
                    </div>
                 </div>
            </div>
            @endif

            @if($operation == '2')
            <div class="col-span-12 md:col-span-6 lg:col-span-6 chnage_velocity">
                <label for="chnage_velocity" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="c_velocity" id="chnage_velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="c_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="c_v_open = !c_v_open">{{ $c_velocity_unit }} ▾</label>
                    <div x-show="c_v_open" @click.away="c_v_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('c_velocity_unit', 'm/s'); c_v_open = false">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('c_velocity_unit', 'km/h'); c_v_open = false">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('c_velocity_unit', 'ft/s'); c_v_open = false">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('c_velocity_unit', 'mph'); c_v_open = false">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('c_velocity_unit', 'knots'); c_v_open = false">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('c_velocity_unit', 'ft/min'); c_v_open = false">ft/min</p>
                    </div>
                 </div>
            </div>
            @endif

            @if($operation == '3')
            <div class="col-span-12 md:col-span-6 lg:col-span-6 force">
                <label for="force" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="force" id="force" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="force_open = !force_open">{{ $force_unit }} ▾</label>
                    <div x-show="force_open" @click.away="force_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('force_unit', 'N'); force_open = false">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('force_unit', 'KN'); force_open = false">KN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('force_unit', 'MN'); force_open = false">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('force_unit', 'GN'); force_open = false">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('force_unit', 'TN'); force_open = false">TN</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 time">
                <label for="time" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="time" id="time" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="time_open = !time_open">{{ $time_unit }} ▾</label>
                    <div x-show="time_open" @click.away="time_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', 'sec'); time_open = false">sec</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', 'min'); time_open = false">min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', 'hr'); time_open = false">hr</p>
                    </div>
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
 <hr>
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @if ($operation == '1')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['initial_momentum'], 2) }} Ns</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['final_momentum'], 2) }} Ns</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['change_momentum_val'], 2) }} Ns</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full text-center text-[25px]">
                                <p>{{ $lang[12] }}</p>
                                <p class="my-3"><strong
                                        class="bg-sky px-3 py-2 ">{{ round($detail['change_momentum_val'], 2) }}</strong>
                                </p>
                            </div>
                        @endif
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset

</form>

@push('calculatorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
</script>
@endpush
</div>
