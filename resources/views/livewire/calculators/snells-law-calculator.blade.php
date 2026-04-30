<div x-data="{ unit1_open: false, unit2_open: false }">
 <form wire:submit.prevent="calculate">
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="calculation" class="font-s-14 text-blue">{{ $lang[1] }}</label>
                    <div class="w-full py-2 position-relative">
                        <select wire:model.live="calculation" id="calculation" class="input">
                            <option value="from1">Find n1 | Given n2, θ₁ and θ₂</option>
                            <option value="from2">Find n2 | Given n1, θ₁ and θ₂</option>
                            <option value="from3">Find θ₁ | Given n1, n2 and θ₂</option>
                            <option value="from4">Find θ₂ | Given n1, n2 and θ₁</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-span-12 flex justify-center">
                <img src="{{ asset('images/snells_img.svg') }}" alt="Snell's Law" width="250px">
            </div>

            @if($calculation != 'from1')
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="medium1" class="font-s-14 text-blue">{{ $lang[12] }} 1</label>
                    <div class="w-full py-2 position-relative">
                        <select wire:model.live="medium1" id="medium1" class="input">
                            <option value="vacuum">{{ $lang[2] }}</option>
                            <option value="air">{{ $lang[3] }}</option>
                            <option value="water">{{ $lang[4] }} 20°C 🌊</option>
                            <option value="ethanol">{{ $lang[5] }}</option>
                            <option value="ice">{{ $lang[6] }} 🧊</option>
                            <option value="acrylic">{{ $lang[7] }}</option>
                            <option value="window">{{ $lang[8] }}</option>
                            <option value="diamond">{{ $lang[9] }}</option>
                            <option value="custom">{{ $lang[10] }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2">
                <label for="n1" class="font-s-14 text-blue">{{ $lang['11'] }} 1 (n₁)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" wire:model="n1" id="n1" class="input" placeholder="1" x-on:focus="$wire.set('medium1', 'custom')"/>
                </div>
            </div>
            @endif

            @if($calculation != 'from2')
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <div class="col-lg-12 col-12 mt-0 mt-lg-2">
                    <label for="medium2" class="font-s-14 text-blue">{{ $lang[12] }} 2</label>
                    <div class="w-full py-2 position-relative">
                        <select wire:model.live="medium2" id="medium2" class="input">
                            <option value="vacuum">{{ $lang[2] }}</option>
                            <option value="air">{{ $lang[3] }}</option>
                            <option value="water">{{ $lang[4] }} 20°C 🌊</option>
                            <option value="ethanol">{{ $lang[5] }}</option>
                            <option value="ice">{{ $lang[6] }} 🧊</option>
                            <option value="acrylic">{{ $lang[7] }}</option>
                            <option value="window">{{ $lang[8] }}</option>
                            <option value="diamond">{{ $lang[9] }}</option>
                            <option value="custom">{{ $lang[10] }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2">
                <label for="n2" class="font-s-14 text-blue">{{ $lang['11'] }} 2 (n₂)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" wire:model="n2" id="n2" class="input" placeholder="1.000293" x-on:focus="$wire.set('medium2', 'custom')"/>
                </div>
            </div>
            @endif
          
            @if($calculation != 'from3')
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2" id="angle1">
                <label for="angle_first" class="font-s-14 text-blue">{{ $lang['13'] }} (θ₁)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" wire:model="angle_first" id="angle_first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                   <label for="angle_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="unit1_open = !unit1_open">{{ $angle_f_unit }} ▾</label>
                   <div x-show="unit1_open" @click.away="unit1_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'deg'); unit1_open = false">deg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'rad'); unit1_open = false">rad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'gon'); unit1_open = false">gon</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'tr'); unit1_open = false">tr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'arcmin'); unit1_open = false">arcmin</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'arcsec'); unit1_open = false">arcsec</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'mrad'); unit1_open = false">mrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', 'μrad'); unit1_open = false">μrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_f_unit', '* π rad'); unit1_open = false">* π rad</p>
                   </div>
                </div>
            </div>
            @endif

            @if($calculation != 'from4')
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-lg-2" id="angle2">
                <label for="angle_second" class="font-s-14 text-blue">{{ $lang['13'] }} (θ₂)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" wire:model="angle_second" id="angle_second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00"/>
                   <label for="angle_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="unit2_open = !unit2_open">{{ $angle_s_unit }} ▾</label>
                   <div x-show="unit2_open" @click.away="unit2_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'deg'); unit2_open = false">deg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'rad'); unit2_open = false">rad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'gon'); unit2_open = false">gon</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'tr'); unit2_open = false">tr</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'arcmin'); unit2_open = false">arcmin</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'arcsec'); unit2_open = false">arcsec</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'mrad'); unit2_open = false">mrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', 'μrad'); unit2_open = false">μrad</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('angle_s_unit', '* π rad'); unit2_open = false">* π rad</p>
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
                        <div class="w-full text-[18px]">
                            @if ($detail['calculation'] === 'from1')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[11] }} 1 (n₁)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'], 6) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">\(n_1 = (n_2 \cdot \sin(\theta_2)) / \sin(\theta_1)\)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">\(n_1 = ({{ $n2 }} \cdot \sin({{ $angle_second }})) / \sin({{ $angle_first }})\)</p>
                                    <p class="mt-2">\(n_1 = {{ round($detail['jawab'], 6) }}\)</p>
                                </div>
                            @elseif($detail['calculation'] === 'from2')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[11] }} 2 (n₂)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'], 6) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">\(n_2 = (n_1 \cdot \sin(\theta_1)) / \sin(\theta_2)\)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">\(n_2 = ({{ $n1 }} \cdot \sin({{ $angle_first }})) / \sin({{ $angle_second }})\)</p>
                                    <p class="mt-2">\(n_2 = {{ round($detail['jawab'], 6) }}\)</p>
                                </div>
                            @elseif($detail['calculation'] === 'from3')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} (θ₁)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'] * 57.2958, 6) }} deg</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">\(\theta_1 = \sin^{-1}((n_2 \cdot \sin(\theta_2)) / n_1)\)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">\(\theta_1 = \sin^{-1}(({{ $n2 }} \cdot \sin({{ $angle_second }})) / {{ $n1 }})\)</p>
                                    <p class="mt-2">\(\theta_1 = {{ round($detail['jawab'] * 57.2958, 6) }} ^\circ\)</p>
                                </div>
                            @else
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} (θ₂)</strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['jawab'] * 57.2958, 6) }} deg</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full">
                                    <p class="mt-2 margin_top_10"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">\(\theta_2 = \sin^{-1}((n_1 \cdot \sin(\theta_1)) / n_2)\)</p>
                                    <p class="mt-2">{{ $lang[18] }}</p>
                                    <p class="mt-2">\(\theta_2 = \sin^{-1}(({{ $n1 }} \cdot \sin({{ $angle_first }})) / {{ $n2 }})\)</p>
                                    <p class="mt-2">\(\theta_2 = {{ round($detail['jawab'] * 57.2958, 6) }} ^\circ\)</p>
                                </div>
                            @endif
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
