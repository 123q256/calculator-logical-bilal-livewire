<div x-data="{ 
    j_open: false, 
    f_open: false, 
    t_open: false,
    show_result: @entangle('detail')
}">
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="calculation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" wire:model.live="calculation" id="calculation">
                        <option value="1"> {{ $lang[2] }} J | {{ $lang[3] }} F, t  </option>
                        <option value="2"> {{ $lang[2] }} F | {{ $lang[3] }} J, t  </option>
                        <option value="3"> {{ $lang[2] }} t | {{ $lang[3] }} J, F  </option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" wire:ignore>
                <p class="col s12 font_size20 center" x-show="$wire.calculation == '1'">
                    $$ J \ = \ F \ t $$
                </p>
                <p class="col s12 font_size20 center" x-show="$wire.calculation == '2'" x-cloak>
                    $$ F \ = \ \frac{J}{t} $$
                </p>
                <p class="col s12 font_size20 center" x-show="$wire.calculation == '3'" x-cloak>
                    $$ t \ = \ \frac{J}{F} $$
                </p>
            </div>

            @if($calculation != '1')
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="impulse" class="font-s-14 text-blue">{{ $lang['4'] }} (J)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model.live="impulse" id="impulse" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="j_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="j_open = !j_open">{{ $j_units }} ▾</label>
                    <div x-show="j_open" @click.away="j_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'dyn·s'); j_open = false">dyn·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'dyn·min'); j_open = false">dyn·min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'dyn·h'); j_open = false">dyn·h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'kg·m/s'); j_open = false">kg·m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'N·s'); j_open = false">N·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'N·min'); j_open = false">N·min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'N·h'); j_open = false">N·h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'mN·s'); j_open = false">mN·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'mN·min'); j_open = false">mN·min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'kN·s'); j_open = false">kN·s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('j_units', 'kN·min'); j_open = false">kN·min</p>
                    </div>
                 </div>
            </div>
            @endif

            @if($calculation != '2')
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="force" class="font-s-14 text-blue">{{ $lang['5'] }} (f)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model.live="force" id="force" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="f_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="f_open = !f_open">{{ $f_units }} ▾</label>
                    <div x-show="f_open" @click.away="f_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'dyn'); f_open = false">dyn</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'kgf'); f_open = false">kgf</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'N'); f_open = false">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'kN'); f_open = false">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'kip'); f_open = false">kip</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'lbf'); f_open = false">lbf</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'ozf'); f_open = false">ozf</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('f_units', 'pdl'); f_open = false">pdl</p>
                    </div>
                 </div>
            </div>
            @endif

            @if($calculation != '3')
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="time" class="font-s-14 text-blue">{{ $lang['6'] }} (t)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model.live="time" id="time" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                    <label for="t_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="t_open = !t_open">{{ $t_units }} ▾</label>
                    <div x-show="t_open" @click.away="t_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('t_units', 'sec'); t_open = false">sec</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('t_units', 'min'); t_open = false">min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('t_units', 'hr'); t_open = false">hr</p>
                    </div>
                 </div>
            </div>
            @endif
            
            @if($calculation == '1')
            <div class="col-span-12">
                <label for="impulse_ans_units" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" wire:model.live="impulse_ans_units" id="impulse_ans_units">
                        <option value="dyn·s"> dyn·s</option>
                        <option value="dyn·min">dyn·min </option>
                        <option value="dyn·h"> dyn·h </option>
                        <option value="kg·m/s"> kg·m/s </option>
                        <option value="N·s"> N·s </option>
                        <option value="N·min"> N·min </option>
                        <option value="N·h"> N·h </option>
                        <option value="mN·s"> mN·s </option>
                        <option value="mN·min"> mN·min </option>
                        <option value="kN·s"> kN·s </option>
                        <option value="kN·min"> kN·min  </option>
                    </select>
                </div>  
            </div>
            @endif

            @if($calculation == '2')
            <div class="col-span-12">
                <label for="force_ans_units" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" wire:model.live="force_ans_units" id="force_ans_units">
                        <option value="dyn"> dyn</option>
                        <option value="kgf">kgf </option>
                        <option value="N"> N</option>
                        <option value="kN"> kN </option>
                        <option value="kip"> kip</option>
                        <option value="lbf"> lbf </option>
                        <option value="ozf"> ozf</option>
                        <option value="pdl"> pdl </option>
                    </select>
                </div>   
            </div>
            @endif

            @if($calculation == '3')
            <div class="col-span-12">
                <label for="time_ans_units" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" wire:model.live="time_ans_units" id="time_ans_units">
                        <option value="sec"> sec</option>
                        <option value="min">min </option>
                        <option value="hr"> hr </option>
                    </select>
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
    
    <div id="result-section" x-show="show_result" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                     @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full text-center text-[18px]">
                            <p>{{ $lang[4] }}</p>
                            @if($calculation == "1")
                            <p><strong>{{ $lang[4]}}</strong></p>
                            @elseif($calculation == "2")
                            <p><strong>{{ $lang[5]}}</strong></p>
                            @else
                            <p><strong>{{ $lang[6]}}</strong></p>
                            @endif
                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ round($detail['answer'], 4) }} {{ $detail['unit_ans']}}</strong></p>
                        </div>
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
