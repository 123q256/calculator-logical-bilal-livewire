<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ calc_type: @entangle('calc_type'), similarity: @entangle('similarity') }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php 
                $request = request();
            @endphp
            <div class="col-span-12">
                <label for="type" class="label"><?=$lang['1']?>:</label>
                <div class="w-full py-2">
                    <select wire:model.live="calc_type" class="input" id="type"  aria-label="select">
                        <option value="1">{{$lang[2]}}</option>
                        <option value="2" {{ isset($calc_type) && $calc_type=='2'?'selected':'' }}>{{$lang[3]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" id="similarity_criterion_select" x-show="calc_type === '1'">
                <label for="similarity" class="label" id="similarity_criterion"><?=$lang['4']?>:</label>
                <div class="w-full py-2">
                    <select wire:model.live="similarity" class="input" id="similarity"  aria-label="select">
                        <option value="SSS">{{"$lang[5] (SSS)"}}</option>
                        <option value="SAS" {{ isset($similarity) && $similarity=='SAS'?'selected':'' }}>{{"$lang[6] (SAS)"}}</option>
                        <option value="ASA" {{ isset($similarity) && $similarity=='ASA'?'selected':'' }}>{{"$lang[7] (ASA)"}}</option>
                    </select>
                </div>
            </div>
            <p class="col-span-12 text-[18px]"><strong>△ABC</strong></p>

            <div class="col-span-12 md:col-span-4 lg:col-span-4 ABC_f_input">
                <label for="ABC_f" class="label" id="ABC_f_text" x-text="similarity === 'ASA' ? '∠BAC (α₁)' : 'AB (a)'"></label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="ABC_f" id="ABC_f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="ABC_f_unit_main" x-show="similarity !== 'ASA'">
                        <label for="ABC_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_f_unit_dropdown').classList.toggle('hidden')">{{ $ABC_f_unit }} ▾</label>
                        <input type="text" wire:model="ABC_f_unit"  id="ABC_f_unit" class="hidden">
                        <div id="ABC_f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_f_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'mm'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'cm'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'm'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'km'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'in'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'ft'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'yd'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_unit', 'mi'); document.getElementById('ABC_f_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                    </div>
                    <div id="ABC_f_deg_rad_main" x-show="similarity === 'ASA'" style="display: none;">
                        <label for="ABC_f_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_f_deg_rad_dropdown').classList.toggle('hidden')">{{ $ABC_f_deg_rad }} ▾</label>
                        <input type="text" wire:model="ABC_f_deg_rad"  id="ABC_f_deg_rad" class="hidden">
                        <div id="ABC_f_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_f_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_deg_rad', 'deg'); document.getElementById('ABC_f_deg_rad_dropdown').classList.add('hidden')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_f_deg_rad', 'rad'); document.getElementById('ABC_f_deg_rad_dropdown').classList.add('hidden')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 ABC_s_input">
                <label for="ABC_s" class="label" id="ABC_s_text" x-text="similarity === 'ASA' ? '∠ABC (β₁)' : 'BC (b)'"></label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="ABC_s" id="ABC_s" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="ABC_s_unit_main" x-show="similarity !== 'ASA'">
                        <label for="ABC_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_s_unit_dropdown').classList.toggle('hidden')">{{ $ABC_s_unit }} ▾</label>
                        <input type="text" wire:model="ABC_s_unit"  id="ABC_s_unit" class="hidden">
                        <div id="ABC_s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_s_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'mm'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'cm'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'm'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'km'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'in'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'ft'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'yd'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_unit', 'mi'); document.getElementById('ABC_s_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                    </div>
                    <div id="ABC_s_deg_rad_main" x-show="similarity === 'ASA'" style="display: none;">
                        <label for="ABC_s_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_s_deg_rad_dropdown').classList.toggle('hidden')">{{ $ABC_s_deg_rad }} ▾</label>
                        <input type="text" wire:model="ABC_s_deg_rad"  id="ABC_s_deg_rad" class="hidden">
                        <div id="ABC_s_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_s_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_deg_rad', 'deg'); document.getElementById('ABC_s_deg_rad_dropdown').classList.add('hidden')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_s_deg_rad', 'rad'); document.getElementById('ABC_s_deg_rad_dropdown').classList.add('hidden')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4" id="ABC_third_input">
                <label for="ABC_t" class="label" id="ABC_t_text" x-text="similarity === 'SSS' ? 'AC (c)' : (similarity === 'SAS' ? '∠BAC (α₁)' : '∠ACB (γ₁)')"></label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="ABC_t" id="ABC_t" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="ABC_t_unit_main" x-show="similarity === 'SSS'">
                        <label for="ABC_t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_t_unit_dropdown').classList.toggle('hidden')">{{ $ABC_t_unit }} ▾</label>
                        <input type="text" wire:model="ABC_t_unit"  id="ABC_t_unit" class="hidden">
                        <div id="ABC_t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'mm'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'cm'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'm'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'km'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'in'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'ft'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'yd'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_unit', 'mi'); document.getElementById('ABC_t_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                    </div>
                    <div id="ABC_t_deg_rad_main" x-show="similarity !== 'SSS'" style="display: none;">
                        <label for="ABC_t_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_t_deg_rad_dropdown').classList.toggle('hidden')">{{ $ABC_t_deg_rad }} ▾</label>
                        <input type="text" wire:model="ABC_t_deg_rad"  id="ABC_t_deg_rad" class="hidden">
                        <div id="ABC_t_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_t_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_deg_rad', 'deg'); document.getElementById('ABC_t_deg_rad_dropdown').classList.add('hidden')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_t_deg_rad', 'rad'); document.getElementById('ABC_t_deg_rad_dropdown').classList.add('hidden')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12" x-show="calc_type === '1' && similarity !== 'SAS' && similarity !== 'SSS'" style="display: none;" id="corresponding_ABC">
                <label for="ABC_corresponding" class="label"><?= $lang[8] ?> △ABC:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="ABC_corresponding" id="ABC_corresponding" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="ABC_corresponding_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ABC_corresponding_unit_dropdown').classList.toggle('hidden')">{{ $ABC_corresponding_unit }} ▾</label>
                    <input type="text" wire:model="ABC_corresponding_unit"  id="ABC_corresponding_unit" class="hidden">
                    <div id="ABC_corresponding_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_corresponding_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'mm'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'cm'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'm'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'km'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'in'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'ft'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'yd'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ABC_corresponding_unit', 'mi'); document.getElementById('ABC_corresponding_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4" id="scale_factor_input" x-show="calc_type === '2'" style="display: none;">
                <label for="scale_factor" class="label"><?= $lang[9] ?>:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model="scale_factor" id="scale_factor" class="input" aria-label="input"  />
                </div>
            </div>
            <p class="col-span-12 text-[18px] DEF_inputs" x-show="calc_type === '1'"><strong>△DEF</strong></p>

            <div class="col-span-12 md:col-span-4 lg:col-span-4 DEF_inputs DEF_f_input" x-show="calc_type === '1'">
                <label for="DEF_f" class="label" id="DEF_f_text" x-text="similarity === 'ASA' ? '∠EDF (α₂)' : 'DE (d)'"></label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="DEF_f" id="DEF_f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="DEF_f_unit_main" x-show="similarity !== 'ASA'">
                        <label for="DEF_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_f_unit_dropdown').classList.toggle('hidden')">{{ $DEF_f_unit }} ▾</label>
                        <input type="text" wire:model="DEF_f_unit"  id="DEF_f_unit" class="hidden">
                        <div id="DEF_f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_f_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'mm'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'cm'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'm'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'km'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'in'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'ft'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'yd'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_unit', 'mi'); document.getElementById('DEF_f_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                    </div>
                    <div id="DEF_f_deg_rad_main" x-show="similarity === 'ASA'" style="display: none;">
                        <label for="DEF_f_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_f_deg_rad_dropdown').classList.toggle('hidden')">{{ $DEF_f_deg_rad }} ▾</label>
                        <input type="text" wire:model="DEF_f_deg_rad"  id="DEF_f_deg_rad" class="hidden">
                        <div id="DEF_f_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_f_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_deg_rad', 'deg'); document.getElementById('DEF_f_deg_rad_dropdown').classList.add('hidden')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_f_deg_rad', 'rad'); document.getElementById('DEF_f_deg_rad_dropdown').classList.add('hidden')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 DEF_inputs DEF_s_input" x-show="calc_type === '1'">
                <label for="DEF_s" class="label" id="DEF_s_text" x-text="similarity === 'ASA' ? '∠DEF (β₂)' : 'EF (e)'"></label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="DEF_s" id="DEF_s" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="DEF_s_unit_main" x-show="similarity !== 'ASA'">
                        <label for="DEF_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_s_unit_dropdown').classList.toggle('hidden')">{{ $DEF_s_unit }} ▾</label>
                        <input type="text" wire:model="DEF_s_unit"  id="DEF_s_unit" class="hidden">
                        <div id="DEF_s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_s_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'mm'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'cm'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'm'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'km'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'in'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'ft'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'yd'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_unit', 'mi'); document.getElementById('DEF_s_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                    </div>
                    <div id="DEF_s_deg_rad_main" x-show="similarity === 'ASA'" style="display: none;">
                        <label for="DEF_s_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_s_deg_rad_dropdown').classList.toggle('hidden')">{{ $DEF_s_deg_rad }} ▾</label>
                        <input type="text" wire:model="DEF_s_deg_rad"  id="DEF_s_deg_rad" class="hidden">
                        <div id="DEF_s_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_s_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_deg_rad', 'deg'); document.getElementById('DEF_s_deg_rad_dropdown').classList.add('hidden')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_s_deg_rad', 'rad'); document.getElementById('DEF_s_deg_rad_dropdown').classList.add('hidden')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 DEF_inputs" id="DEF_third_input">
                <label for="DEF_t" class="label" id="DEF_t_text" x-text="similarity === 'SSS' ? 'DF (f)' : (similarity === 'SAS' ? '∠EDF (α₂)' : '∠DFE (γ₂)')"></label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="DEF_t" id="DEF_t" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="DEF_t_unit_main" x-show="similarity === 'SSS'">
                        <label for="DEF_t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_t_unit_dropdown').classList.toggle('hidden')">{{ $DEF_t_unit }} ▾</label>
                        <input type="text" wire:model="DEF_t_unit"  id="DEF_t_unit" class="hidden">
                        <div id="DEF_t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'mm'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'cm'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'm'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'km'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'in'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'ft'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'yd'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_unit', 'mi'); document.getElementById('DEF_t_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                        </div>
                    </div>
                    <div id="DEF_t_deg_rad_main" x-show="similarity !== 'SSS'" style="display: none;">

                        <label for="DEF_t_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_t_deg_rad_dropdown').classList.toggle('hidden')">{{ $DEF_t_deg_rad }} ▾</label>
                        <input type="text" wire:model="DEF_t_deg_rad"  id="DEF_t_deg_rad" class="hidden">
                        <div id="DEF_t_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_t_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_deg_rad', 'deg'); document.getElementById('DEF_t_deg_rad_dropdown').classList.add('hidden')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_t_deg_rad', 'rad'); document.getElementById('DEF_t_deg_rad_dropdown').classList.add('hidden')">radians (rad)</p>
                        </div>


                    </div>
                 </div>
            </div>
            <div class="col-span-12" x-show="calc_type === '1' && similarity !== 'SAS' && similarity !== 'SSS'" style="display: none;" id="corresponding_DEF">
                <label for="DEF_corresponding" class="label"><?= $lang[8] ?> △DEF:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="DEF_corresponding" id="DEF_corresponding" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="DEF_corresponding_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('DEF_corresponding_unit_dropdown').classList.toggle('hidden')">{{ $DEF_corresponding_unit }} ▾</label>
                    <input type="text" wire:model="DEF_corresponding_unit"  id="DEF_corresponding_unit" class="hidden">
                    <div id="DEF_corresponding_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_corresponding_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'mm'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">millimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'cm'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'm'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'km'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'in'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'ft'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'yd'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('DEF_corresponding_unit', 'mi'); document.getElementById('DEF_corresponding_unit_dropdown').classList.add('hidden')">miles (mi)</p>
                    </div>
                 </div>
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
                        <div class="w-full lg:w-[80%] overflow-auto mt-2">
                            <table class="w-full font-s-18">
                                @if($calc_type === "2")
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[13] ?> △ABC</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['ABC_area_ans'] ?> (cm²)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[14] ?> △ABC</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['ABC_perimeter_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>DE (d)</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_f_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>EF (e)</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_s_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>DF (f)</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_t_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[13] ?> △DEF</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_area_ans'] ?> (cm²)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[14] ?> △DEF</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_perimeter_ans'] ?> (cm)</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong><?= $lang[10] ?></strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['symbol'] ?> △DEF</td>
                                    </tr>
                                    @if($similarity === "ASA" && $detail['jawab'] === "equal")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong><?= $lang[9] ?> (k)</strong></td>
                                            <td class="py-2 border-b"><?= $detail['scale_ans'] ?></td>
                                        </tr>
                                    @endif
                                    @if($similarity === "ASA")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>∠ACB (γ₁)</strong></td>
                                            <td class="py-2 border-b"><?= $detail['ACB_jawab'] ?> (deg)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>∠DFE (γ₂)</strong></td>
                                            <td class="py-2 border-b"><?= $detail['DEF_jawab'] ?> (deg)</td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </div>
                        @if($calc_type === "1")
                            <p class="mt-2"><?= ($detail['jawab'] === "equal") ? "$lang[11]" : "$lang[12]"; ?></p> 
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
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('morph.updated', (el, component) => {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body);
            }
        });
    });
    window.MJrerender = function() {
        if (typeof renderMathInElement === 'function') {
            renderMathInElement(document.body);
        }
    };
</script>
        
       
    @endpush
</form>
</div>
