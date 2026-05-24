<div>
@php
    if (!function_exists('safe_round')) {
        function safe_round($val, $precision = 5) {
            if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                return 'NAN';
            }
            if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                return 'INF';
            }
            return is_numeric($val) ? round((float)$val, $precision) : $val;
        }
    }
@endphp
  <style>
    .hidden1{
        display: none;
    }
    #onetw{
        background: transparent;
        border: none;
        color: #1670a7;
        outline: none;
    }
</style>
 <form wire:submit.prevent="calculate" @input="$wire.detail = null; $wire.error = null">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ volume_select: @entangle('volume_select').live }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6 ">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="volume_select" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-full py-2">
                            <select wire:model.live="volume_select" id="volume_select" class="input">
                                @php
                                    $nameArr = ["Rectangular Box", "Cube", "Cylinder", "Cone", "Sphere", "Triangular Prism", "Pyramid", "Capsule", "Hemisphere", "Hollow cylinder / tube", "Conical frustum", "Truncated pyramid", "Ellipsoid", "Square", "Column"];
                                    $valArr = ["Rectangular", "Cube", "Cylinder", "Cone", "Sphere", "Triangular", "Pyramid", "Capsule", "Hemisphere", "Hollow", "Conical", "Truncated", "Ellipsoid", "Square", "Column"];
                                @endphp
                                @foreach($valArr as $index => $val)
                                    <option value="{{ $val }}">{{ $nameArr[$index] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 " id="Rectangular" x-show="volume_select === 'Rectangular'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="rec_width" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="rec_width" id="rec_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="rec_width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('rec_width_units_dropdown').classList.toggle('hidden')">{{ $rec_width_units }} ▾</label>
                                    <input type="text" wire:model="rec_width_units"  id="rec_width_units" class="hidden">
                                    <div id="rec_width_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rec_width_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_width_units', 'cm'); document.getElementById('rec_width_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_width_units', 'm'); document.getElementById('rec_width_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_width_units', 'in'); document.getElementById('rec_width_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_width_units', 'ft'); document.getElementById('rec_width_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_width_units', 'yd'); document.getElementById('rec_width_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 ps-lg-0 ps-0">
                                <label for="rec_length" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="rec_length" id="rec_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="rec_length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('rec_length_units_dropdown').classList.toggle('hidden')">{{ $rec_length_units }} ▾</label>
                                    <input type="text" wire:model="rec_length_units"  id="rec_length_units" class="hidden">
                                    <div id="rec_length_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rec_length_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_length_units', 'cm'); document.getElementById('rec_length_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_length_units', 'm'); document.getElementById('rec_length_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_length_units', 'in'); document.getElementById('rec_length_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_length_units', 'ft'); document.getElementById('rec_length_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_length_units', 'yd'); document.getElementById('rec_length_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="rec_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="rec_height" id="rec_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="rec_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('rec_height_units_dropdown').classList.toggle('hidden')">{{ $rec_height_units }} ▾</label>
                                    <input type="text" wire:model="rec_height_units"  id="rec_height_units" class="hidden">
                                    <div id="rec_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rec_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_height_units', 'cm'); document.getElementById('rec_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_height_units', 'm'); document.getElementById('rec_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_height_units', 'in'); document.getElementById('rec_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_height_units', 'ft'); document.getElementById('rec_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('rec_height_units', 'yd'); document.getElementById('rec_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 " id="Cube" x-show="volume_select === 'Cube'">
                        <label for="cub_side" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="cub_side" id="cub_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                            <label for="cub_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('cub_side_units_dropdown').classList.toggle('hidden')">{{ $cub_side_units }} ▾</label>
                            <input type="text" wire:model="cub_side_units"  id="cub_side_units" class="hidden">
                            <div id="cub_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cub_side_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cub_side_units', 'cm'); document.getElementById('cub_side_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cub_side_units', 'm'); document.getElementById('cub_side_units_dropdown').classList.add('hidden')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cub_side_units', 'in'); document.getElementById('cub_side_units_dropdown').classList.add('hidden')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cub_side_units', 'ft'); document.getElementById('cub_side_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cub_side_units', 'yd'); document.getElementById('cub_side_units_dropdown').classList.add('hidden')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 " id="Cylinder" x-show="volume_select === 'Cylinder'">
                        <div class="row"> 
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="cyl_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="cyl_height" id="cyl_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="cyl_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('cyl_height_units_dropdown').classList.toggle('hidden')">{{ $cyl_height_units }} ▾</label>
                                    <input type="text" wire:model="cyl_height_units"  id="cyl_height_units" class="hidden">
                                    <div id="cyl_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cyl_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_height_units', 'cm'); document.getElementById('cyl_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_height_units', 'm'); document.getElementById('cyl_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_height_units', 'in'); document.getElementById('cyl_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_height_units', 'ft'); document.getElementById('cyl_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_height_units', 'yd'); document.getElementById('cyl_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="cyl_diameter" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="cyl_diameter" id="cyl_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="cyl_diameter_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('cyl_diameter_units_dropdown').classList.toggle('hidden')">{{ $cyl_diameter_units }} ▾</label>
                                    <input type="text" wire:model="cyl_diameter_units"  id="cyl_diameter_units" class="hidden">
                                    <div id="cyl_diameter_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cyl_diameter_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_diameter_units', 'cm'); document.getElementById('cyl_diameter_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_diameter_units', 'm'); document.getElementById('cyl_diameter_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_diameter_units', 'in'); document.getElementById('cyl_diameter_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_diameter_units', 'ft'); document.getElementById('cyl_diameter_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cyl_diameter_units', 'yd'); document.getElementById('cyl_diameter_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 " id="Cone" x-show="volume_select === 'Cone'">
                        <div class="row">

                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="con_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="con_height" id="con_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="con_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('con_height_units_dropdown').classList.toggle('hidden')">{{ $con_height_units }} ▾</label>
                                    <input type="text" wire:model="con_height_units"  id="con_height_units" class="hidden">
                                    <div id="con_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="con_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_height_units', 'cm'); document.getElementById('con_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_height_units', 'm'); document.getElementById('con_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_height_units', 'in'); document.getElementById('con_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_height_units', 'ft'); document.getElementById('con_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_height_units', 'yd'); document.getElementById('con_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="con_diameter" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="con_diameter" id="con_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="con_diameter_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('con_diameter_units_dropdown').classList.toggle('hidden')">{{ $con_diameter_units }} ▾</label>
                                    <input type="text" wire:model="con_diameter_units"  id="con_diameter_units" class="hidden">
                                    <div id="con_diameter_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="con_diameter_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_diameter_units', 'cm'); document.getElementById('con_diameter_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_diameter_units', 'm'); document.getElementById('con_diameter_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_diameter_units', 'in'); document.getElementById('con_diameter_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_diameter_units', 'ft'); document.getElementById('con_diameter_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('con_diameter_units', 'yd'); document.getElementById('con_diameter_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="Triangular" x-show="volume_select === 'Triangular'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tri_base" class="font-s-14 text-blue">{{ $lang['5'] }} {{ $lang['3'] }} a</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tri_base" id="tri_base" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tri_base_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tri_base_units_dropdown').classList.toggle('hidden')">{{ $tri_base_units }} ▾</label>
                                    <input type="text" wire:model="tri_base_units"  id="tri_base_units" class="hidden">
                                    <div id="tri_base_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_base_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_base_units', 'cm'); document.getElementById('tri_base_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_base_units', 'm'); document.getElementById('tri_base_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_base_units', 'in'); document.getElementById('tri_base_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_base_units', 'ft'); document.getElementById('tri_base_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_base_units', 'yd'); document.getElementById('tri_base_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="tri_length" class="font-s-14 text-blue">{{ $lang['5'] }} {{ $lang['3'] }} b</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tri_length" id="tri_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tri_length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tri_length_units_dropdown').classList.toggle('hidden')">{{ $tri_length_units }} ▾</label>
                                    <input type="text" wire:model="tri_length_units"  id="tri_length_units" class="hidden">
                                    <div id="tri_length_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_length_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_length_units', 'cm'); document.getElementById('tri_length_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_length_units', 'm'); document.getElementById('tri_length_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_length_units', 'in'); document.getElementById('tri_length_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_length_units', 'ft'); document.getElementById('tri_length_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_length_units', 'yd'); document.getElementById('tri_length_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tri_height" class="font-s-14 text-blue">{{ $lang['5'] }} {{ $lang['3'] }} c</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tri_height" id="tri_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tri_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tri_height_units_dropdown').classList.toggle('hidden')">{{ $tri_height_units }} ▾</label>
                                    <input type="text" wire:model="tri_height_units"  id="tri_height_units" class="hidden">
                                    <div id="tri_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_height_units', 'cm'); document.getElementById('tri_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_height_units', 'm'); document.getElementById('tri_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_height_units', 'in'); document.getElementById('tri_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_height_units', 'ft'); document.getElementById('tri_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_height_units', 'yd'); document.getElementById('tri_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="tri_h" class="font-s-14 text-blue">{{ $lang['4'] }} h</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tri_h" id="tri_h" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tri_h_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tri_h_units_dropdown').classList.toggle('hidden')">{{ $tri_h_units }} ▾</label>
                                    <input type="text" wire:model="tri_h_units"  id="tri_h_units" class="hidden">
                                    <div id="tri_h_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_h_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_h_units', 'cm'); document.getElementById('tri_h_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_h_units', 'm'); document.getElementById('tri_h_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_h_units', 'in'); document.getElementById('tri_h_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_h_units', 'ft'); document.getElementById('tri_h_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tri_h_units', 'yd'); document.getElementById('tri_h_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-12 " id="Sphere" x-show="volume_select === 'Sphere'">
                        <label for="sph_diameter" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="sph_diameter" id="sph_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                            <label for="sph_diameter_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('sph_diameter_units_dropdown').classList.toggle('hidden')">{{ $sph_diameter_units }} ▾</label>
                            <input type="text" wire:model="sph_diameter_units"  id="sph_diameter_units" class="hidden">
                            <div id="sph_diameter_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sph_diameter_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('sph_diameter_units', 'cm'); document.getElementById('sph_diameter_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('sph_diameter_units', 'm'); document.getElementById('sph_diameter_units_dropdown').classList.add('hidden')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('sph_diameter_units', 'in'); document.getElementById('sph_diameter_units_dropdown').classList.add('hidden')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('sph_diameter_units', 'ft'); document.getElementById('sph_diameter_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('sph_diameter_units', 'yd'); document.getElementById('sph_diameter_units_dropdown').classList.add('hidden')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="" id="Pyramid" x-show="volume_select === 'Pyramid'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="pyr_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="pyr_height" id="pyr_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="pyr_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('pyr_height_units_dropdown').classList.toggle('hidden')">{{ $pyr_height_units }} ▾</label>
                                    <input type="text" wire:model="pyr_height_units"  id="pyr_height_units" class="hidden">
                                    <div id="pyr_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pyr_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_height_units', 'cm'); document.getElementById('pyr_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_height_units', 'm'); document.getElementById('pyr_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_height_units', 'in'); document.getElementById('pyr_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_height_units', 'ft'); document.getElementById('pyr_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_height_units', 'yd'); document.getElementById('pyr_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="pyr_side" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="pyr_side" id="pyr_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="pyr_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('pyr_side_units_dropdown').classList.toggle('hidden')">{{ $pyr_side_units }} ▾</label>
                                    <input type="text" wire:model="pyr_side_units"  id="pyr_side_units" class="hidden">
                                    <div id="pyr_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pyr_side_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_side_units', 'cm'); document.getElementById('pyr_side_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_side_units', 'm'); document.getElementById('pyr_side_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_side_units', 'in'); document.getElementById('pyr_side_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_side_units', 'ft'); document.getElementById('pyr_side_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('pyr_side_units', 'yd'); document.getElementById('pyr_side_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="Capsule" x-show="volume_select === 'Capsule'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="cap_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="cap_height" id="cap_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="cap_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('cap_height_units_dropdown').classList.toggle('hidden')">{{ $cap_height_units }} ▾</label>
                                    <input type="text" wire:model="cap_height_units"  id="cap_height_units" class="hidden">
                                    <div id="cap_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cap_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_height_units', 'cm'); document.getElementById('cap_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_height_units', 'm'); document.getElementById('cap_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_height_units', 'in'); document.getElementById('cap_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_height_units', 'ft'); document.getElementById('cap_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_height_units', 'yd'); document.getElementById('cap_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="cap_radius" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="cap_radius" id="cap_radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="cap_radius_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('cap_radius_units_dropdown').classList.toggle('hidden')">{{ $cap_radius_units }} ▾</label>
                                    <input type="text" wire:model="cap_radius_units"  id="cap_radius_units" class="hidden">
                                    <div id="cap_radius_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cap_radius_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_radius_units', 'cm'); document.getElementById('cap_radius_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_radius_units', 'm'); document.getElementById('cap_radius_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_radius_units', 'in'); document.getElementById('cap_radius_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_radius_units', 'ft'); document.getElementById('cap_radius_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('cap_radius_units', 'yd'); document.getElementById('cap_radius_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 " id="Hemisphere" x-show="volume_select === 'Hemisphere'">
                        <label for="hem_radius" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="hem_radius" id="hem_radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                            <label for="hem_radius_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('hem_radius_units_dropdown').classList.toggle('hidden')">{{ $hem_radius_units }} ▾</label>
                            <input type="text" wire:model="hem_radius_units"  id="hem_radius_units" class="hidden">
                            <div id="hem_radius_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hem_radius_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hem_radius_units', 'cm'); document.getElementById('hem_radius_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hem_radius_units', 'm'); document.getElementById('hem_radius_units_dropdown').classList.add('hidden')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hem_radius_units', 'in'); document.getElementById('hem_radius_units_dropdown').classList.add('hidden')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hem_radius_units', 'ft'); document.getElementById('hem_radius_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hem_radius_units', 'yd'); document.getElementById('hem_radius_units_dropdown').classList.add('hidden')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="" id="Hollow" x-show="volume_select === 'Hollow'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="hol_inner_dia" class="font-s-14 text-blue">{{ $lang['22'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="hol_inner_dia" id="hol_inner_dia" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="hol_inner_dia_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('hol_inner_dia_units_dropdown').classList.toggle('hidden')">{{ $hol_inner_dia_units }} ▾</label>
                                    <input type="text" wire:model="hol_inner_dia_units"  id="hol_inner_dia_units" class="hidden">
                                    <div id="hol_inner_dia_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hol_inner_dia_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_inner_dia_units', 'cm'); document.getElementById('hol_inner_dia_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_inner_dia_units', 'm'); document.getElementById('hol_inner_dia_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_inner_dia_units', 'in'); document.getElementById('hol_inner_dia_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_inner_dia_units', 'ft'); document.getElementById('hol_inner_dia_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_inner_dia_units', 'yd'); document.getElementById('hol_inner_dia_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="hol_outer_dia" class="font-s-14 text-blue">{{ $lang['23'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="hol_outer_dia" id="hol_outer_dia" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="hol_outer_dia_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('hol_outer_dia_units_dropdown').classList.toggle('hidden')">{{ $hol_outer_dia_units }} ▾</label>
                                    <input type="text" wire:model="hol_outer_dia_units"  id="hol_outer_dia_units" class="hidden">
                                    <div id="hol_outer_dia_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hol_outer_dia_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_outer_dia_units', 'cm'); document.getElementById('hol_outer_dia_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_outer_dia_units', 'm'); document.getElementById('hol_outer_dia_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_outer_dia_units', 'in'); document.getElementById('hol_outer_dia_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_outer_dia_units', 'ft'); document.getElementById('hol_outer_dia_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_outer_dia_units', 'yd'); document.getElementById('hol_outer_dia_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="hol_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="hol_height" id="hol_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="hol_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('hol_height_units_dropdown').classList.toggle('hidden')">{{ $hol_height_units }} ▾</label>
                                    <input type="text" wire:model="hol_height_units"  id="hol_height_units" class="hidden">
                                    <div id="hol_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hol_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_height_units', 'cm'); document.getElementById('hol_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_height_units', 'm'); document.getElementById('hol_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_height_units', 'in'); document.getElementById('hol_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_height_units', 'ft'); document.getElementById('hol_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('hol_height_units', 'yd'); document.getElementById('hol_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="" id="Conical" x-show="volume_select === 'Conical'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="coni_top_r" class="font-s-14 text-blue">{{ $lang['25'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="coni_top_r" id="coni_top_r" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="coni_top_r_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('coni_top_r_units_dropdown').classList.toggle('hidden')">{{ $coni_top_r_units }} ▾</label>
                                    <input type="text" wire:model="coni_top_r_units"  id="coni_top_r_units" class="hidden">
                                    <div id="coni_top_r_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="coni_top_r_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_top_r_units', 'cm'); document.getElementById('coni_top_r_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_top_r_units', 'm'); document.getElementById('coni_top_r_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_top_r_units', 'in'); document.getElementById('coni_top_r_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_top_r_units', 'ft'); document.getElementById('coni_top_r_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_top_r_units', 'yd'); document.getElementById('coni_top_r_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="coni_bottom_r" class="font-s-14 text-blue">{{ $lang['26'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="coni_bottom_r" id="coni_bottom_r" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="coni_bottom_r_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('coni_bottom_r_units_dropdown').classList.toggle('hidden')">{{ $coni_bottom_r_units }} ▾</label>
                                    <input type="text" wire:model="coni_bottom_r_units"  id="coni_bottom_r_units" class="hidden">
                                    <div id="coni_bottom_r_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="coni_bottom_r_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_bottom_r_units', 'cm'); document.getElementById('coni_bottom_r_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_bottom_r_units', 'm'); document.getElementById('coni_bottom_r_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_bottom_r_units', 'in'); document.getElementById('coni_bottom_r_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_bottom_r_units', 'ft'); document.getElementById('coni_bottom_r_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_bottom_r_units', 'yd'); document.getElementById('coni_bottom_r_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="coni_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="coni_height" id="coni_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="coni_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('coni_height_units_dropdown').classList.toggle('hidden')">{{ $coni_height_units }} ▾</label>
                                    <input type="text" wire:model="coni_height_units"  id="coni_height_units" class="hidden">
                                    <div id="coni_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="coni_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_height_units', 'cm'); document.getElementById('coni_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_height_units', 'm'); document.getElementById('coni_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_height_units', 'in'); document.getElementById('coni_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_height_units', 'ft'); document.getElementById('coni_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('coni_height_units', 'yd'); document.getElementById('coni_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="Truncated" x-show="volume_select === 'Truncated'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tru_base_side" class="font-s-14 text-blue">{{ $lang['29'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tru_base_side" id="tru_base_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tru_base_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tru_base_side_units_dropdown').classList.toggle('hidden')">{{ $tru_base_side_units }} ▾</label>
                                    <input type="text" wire:model="tru_base_side_units"  id="tru_base_side_units" class="hidden">
                                    <div id="tru_base_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tru_base_side_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_base_side_units', 'cm'); document.getElementById('tru_base_side_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_base_side_units', 'm'); document.getElementById('tru_base_side_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_base_side_units', 'in'); document.getElementById('tru_base_side_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_base_side_units', 'ft'); document.getElementById('tru_base_side_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_base_side_units', 'yd'); document.getElementById('tru_base_side_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="tru_top_side" class="font-s-14 text-blue">{{ $lang['28'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tru_top_side" id="tru_top_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tru_top_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tru_top_side_units_dropdown').classList.toggle('hidden')">{{ $tru_top_side_units }} ▾</label>
                                    <input type="text" wire:model="tru_top_side_units"  id="tru_top_side_units" class="hidden">
                                    <div id="tru_top_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tru_top_side_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_top_side_units', 'cm'); document.getElementById('tru_top_side_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_top_side_units', 'm'); document.getElementById('tru_top_side_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_top_side_units', 'in'); document.getElementById('tru_top_side_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_top_side_units', 'ft'); document.getElementById('tru_top_side_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_top_side_units', 'yd'); document.getElementById('tru_top_side_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tru_height" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="tru_height" id="tru_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="tru_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('tru_height_units_dropdown').classList.toggle('hidden')">{{ $tru_height_units }} ▾</label>
                                    <input type="text" wire:model="tru_height_units"  id="tru_height_units" class="hidden">
                                    <div id="tru_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tru_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_height_units', 'cm'); document.getElementById('tru_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_height_units', 'm'); document.getElementById('tru_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_height_units', 'in'); document.getElementById('tru_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_height_units', 'ft'); document.getElementById('tru_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('tru_height_units', 'yd'); document.getElementById('tru_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="Ellipsoid" x-show="volume_select === 'Ellipsoid'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2"> 
                                <label for="ell_sem_a" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="ell_sem_a" id="ell_sem_a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="ell_sem_a_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ell_sem_a_units_dropdown').classList.toggle('hidden')">{{ $ell_sem_a_units }} ▾</label>
                                    <input type="text" wire:model="ell_sem_a_units"  id="ell_sem_a_units" class="hidden">
                                    <div id="ell_sem_a_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ell_sem_a_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_a_units', 'cm'); document.getElementById('ell_sem_a_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_a_units', 'm'); document.getElementById('ell_sem_a_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_a_units', 'in'); document.getElementById('ell_sem_a_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_a_units', 'ft'); document.getElementById('ell_sem_a_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_a_units', 'yd'); document.getElementById('ell_sem_a_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="ell_sem_b" class="font-s-14 text-blue">{{ $lang['32'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="ell_sem_b" id="ell_sem_b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="ell_sem_b_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ell_sem_b_units_dropdown').classList.toggle('hidden')">{{ $ell_sem_b_units }} ▾</label>
                                    <input type="text" wire:model="ell_sem_b_units"  id="ell_sem_b_units" class="hidden">
                                    <div id="ell_sem_b_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ell_sem_b_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_b_units', 'cm'); document.getElementById('ell_sem_b_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_b_units', 'm'); document.getElementById('ell_sem_b_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_b_units', 'in'); document.getElementById('ell_sem_b_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_b_units', 'ft'); document.getElementById('ell_sem_b_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_b_units', 'yd'); document.getElementById('ell_sem_b_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="col_radi" class="font-s-14 text-blue">{{ $lang['33'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="ell_sem_c" id="ell_sem_c" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="ell_sem_c_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('ell_sem_c_units_dropdown').classList.toggle('hidden')">{{ $ell_sem_c_units }} ▾</label>
                                    <input type="text" wire:model="ell_sem_c_units"  id="ell_sem_c_units" class="hidden">
                                    <div id="ell_sem_c_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ell_sem_c_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_c_units', 'cm'); document.getElementById('ell_sem_c_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_c_units', 'm'); document.getElementById('ell_sem_c_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_c_units', 'in'); document.getElementById('ell_sem_c_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_c_units', 'ft'); document.getElementById('ell_sem_c_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('ell_sem_c_units', 'yd'); document.getElementById('ell_sem_c_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="" id="Column" x-show="volume_select === 'Column'">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="col_radi" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="col_radi" id="col_radi" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="col_radi_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('col_radi_units_dropdown').classList.toggle('hidden')">{{ $col_radi_units }} ▾</label>
                                    <input type="text" wire:model="col_radi_units"  id="col_radi_units" class="hidden">
                                    <div id="col_radi_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="col_radi_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_radi_units', 'cm'); document.getElementById('col_radi_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_radi_units', 'm'); document.getElementById('col_radi_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_radi_units', 'in'); document.getElementById('col_radi_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_radi_units', 'ft'); document.getElementById('col_radi_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_radi_units', 'yd'); document.getElementById('col_radi_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>

                            <div class="col-lg-12 col-6">
                                <label for="col_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="col_height" id="col_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                                    <label for="col_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('col_height_units_dropdown').classList.toggle('hidden')">{{ $col_height_units }} ▾</label>
                                    <input type="text" wire:model="col_height_units"  id="col_height_units" class="hidden">
                                    <div id="col_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="col_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_height_units', 'cm'); document.getElementById('col_height_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_height_units', 'm'); document.getElementById('col_height_units_dropdown').classList.add('hidden')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_height_units', 'in'); document.getElementById('col_height_units_dropdown').classList.add('hidden')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_height_units', 'ft'); document.getElementById('col_height_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('col_height_units', 'yd'); document.getElementById('col_height_units_dropdown').classList.add('hidden')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" x-show="volume_select === 'Square'" x-cloak id="Square">
                        <label for="square" class="font-s-14 text-blue">{{ $lang['35'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model="square" id="square" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"  aria-label="input" placeholder="00" />
                            <label for="square_units" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="document.getElementById('square_units_dropdown').classList.toggle('hidden')">{{ $square_units }} ▾</label>
                            <input type="text" wire:model="square_units"  id="square_units" class="hidden">
                            <div id="square_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="square_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('square_units', 'cm'); document.getElementById('square_units_dropdown').classList.add('hidden')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('square_units', 'm'); document.getElementById('square_units_dropdown').classList.add('hidden')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('square_units', 'in'); document.getElementById('square_units_dropdown').classList.add('hidden')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('square_units', 'ft'); document.getElementById('square_units_dropdown').classList.add('hidden')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('square_units', 'yd'); document.getElementById('square_units_dropdown').classList.add('hidden')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6  flex items-center ps-lg-3 justify-center">
                <img x-show="volume_select === 'Rectangular'" x-cloak src="<?= asset('images/rectangular_v_new.png') ?>" loading="lazy" alt="Rectangular" class="ms-5 max-rec_length" width="250px" height="180px" id="Rectangular_img">
                <img x-show="volume_select === 'Cube'" x-cloak src="<?= asset('images/cube_v.png') ?>" loading="lazy" alt="Cube" width="177px" id="Cube_img">
                <img x-show="volume_select === 'Cylinder'" x-cloak src="<?= asset('images/cylinder_v.png') ?>" loading="lazy" alt="Cylinder" width="143px" id="Cylinder_img">
                <img x-show="volume_select === 'Cone'" x-cloak src="<?= asset('images/cone_v.png') ?>" loading="lazy" alt="Cone" width="107px" id="Cone_img">
                <img x-show="volume_select === 'Sphere'" x-cloak src="<?= asset('images/sphere_v.png') ?>" loading="lazy" alt="Sphere" height="150px" width="151px" id="Sphere_img" class="mt-3">
                <img x-show="volume_select === 'Triangular'" x-cloak src="<?= asset('images/triangular_v1.webp') ?>" loading="lazy" alt="Triangular" width="185px" id="Triangular_img">
                <img x-show="volume_select === 'Pyramid'" x-cloak src="<?= asset('images/pyramid_v.png') ?>" loading="lazy" alt="Pyramid" width="205px" id="Pyramid_img">
                <img x-show="volume_select === 'Capsule'" x-cloak src="<?= asset('images/capsule_v.png') ?>" loading="lazy" alt="Capsule" width="126px" id="Capsule_img">
                <img x-show="volume_select === 'Hemisphere'" x-cloak src="<?= asset('images/hemisphere_v.png') ?>" loading="lazy" alt="Hemisphere" width="200px" id="Hemisphere_img" class="ms-4 mt-3">
                <img x-show="volume_select === 'Hollow'" x-cloak src="<?= asset('images/hollow_v.png') ?>" loading="lazy" alt="Hollow" width="144px" id="Hollow_img">
                <img x-show="volume_select === 'Conical'" x-cloak src="<?= asset('images/conical_v.png') ?>" loading="lazy" alt="Conical" width="209px" id="Conical_img">
                <img x-show="volume_select === 'Truncated'" x-cloak src="<?= asset('images/truncated_v.png') ?>" loading="lazy" alt="Truncated" width="270px" id="Truncated_img" class="ms-5">
                <img x-show="volume_select === 'Ellipsoid'" x-cloak src="<?= asset('images/ellipsoid_v.png') ?>" loading="lazy" alt="Ellipsoid" width="145px" id="Ellipsoid_img">
                <img x-show="volume_select === 'Column'" x-cloak src="<?= asset('images/column_v.png') ?>" loading="lazy" alt="column" width="143px" id="Column_img">
                <img x-show="volume_select === 'Square'" x-cloak src="<?= asset('images/square_v.png') ?>" loading="lazy" alt="square" height="150px" width="260px" id="Square_img" class="ms-5 mt-3">
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
                        @php
                            $tri_a = $tri_base;
                            $tri_b = $tri_length;
                            $tri_c = $tri_height;
                            $tri_h = $tri_h;   
                        @endphp
                        <div class="w-full mt-3 flex flex-col lg:flex-row gap-6">
    <div class="w-full  overflow-auto ">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b" width="60%">
                                            <strong><?= $lang['8'] ?> :</strong>
                                        </td>
                                        <td class="border-b py-2">
                                            <div class="flex items-center justify-end gap-2">
                                                <div id="circle_result">
                                                    <?php
                                                        if ($volume_select == 'Rectangular') {
                                                            echo  safe_round($detail['rectangular'], 2);
                                                        } elseif ($volume_select == 'Cube') {
                                                            echo  safe_round($detail['cube'], 2);
                                                        } elseif ($volume_select == 'Cylinder') {
                                                            echo  safe_round($detail['cylinder'], 2);
                                                        } elseif ($volume_select == 'Cone') {
                                                            echo  safe_round($detail['cone'], 2);
                                                        } elseif ($volume_select == 'Sphere') {
                                                            echo  safe_round($detail['sphere'], 2);
                                                        } elseif ($volume_select == 'Triangular') {
                                                            echo  safe_round($detail['triangular'], 2);
                                                        } elseif ($volume_select == 'Pyramid') {
                                                            echo  safe_round($detail['pyramid'], 2);
                                                        } elseif ($volume_select == 'Capsule') {
                                                            echo  safe_round($detail['capsule'], 2);
                                                        } elseif ($volume_select == 'Hemisphere') {
                                                            echo  safe_round($detail['hemisphere'], 2);
                                                        } elseif ($volume_select == 'Hollow') {
                                                            echo  safe_round($detail['hollow'], 2);
                                                        } elseif ($volume_select == 'Conical') {
                                                            echo  safe_round($detail['conical'], 2);
                                                        } elseif ($volume_select == 'Truncated') {
                                                            echo  safe_round($detail['truncated'], 2);
                                                        } elseif ($volume_select == 'Ellipsoid') {
                                                            echo  safe_round($detail['ellipsoid'], 2);
                                                        } elseif ($volume_select == 'Square') {
                                                            echo  safe_round($detail['square'], 2);
                                                        } elseif ($volume_select == 'Column') {
                                                            echo  safe_round($detail['column'], 2);
                                                        }
                                                    ?>
                                                </div>
                                                <select wire:model.live="circle_unit_result" id="onetw" class="p-1 border rounded" style="width:100px">
                                                    @php
                                                        $unitsArr = ["in³","cm³","m³","ft³","yd³"];
                                                    @endphp
                                                    @foreach($unitsArr as $unit)
                                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                          
    </div>
    <div class="w-full  overflow-auto text-start">
                                <?php if ($volume_select == 'Rectangular') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['12'] ?> :</p>
                                    <p class="mt-2">\( V = \text {length} \times \text {width} \times \text {height}\)</p>
                                    <p class="mt-2">\( V = \text {<?php echo $rec_length ?>} \times \text {<?php echo $rec_width ?>} \times \text {<?php echo $rec_height ?>}\)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['rectangular'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Cube') { ?>
                                   
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['13'] ?> :</p>
                                    <p class="mt-2">\( V = \text {Side} \times \text {Side} \times \text {Side}\)</p>
                                    <p class="mt-2">\( V = \text {<?php echo $cub_side ?>} \times \text {<?php echo $cub_side ?>} \times \text {<?php echo $cub_side ?>}\)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['cube'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Cylinder') { ?>
                                  
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['14'] ?> :</p>
                                    <p class="mt-2">\( V = \pi r^2 h \)</p>
                                    <p class="mt-2">\( r = d/2 \)</p>
                                    <p class="mt-2">\( r = <?php echo $cyl_diameter ?>/2 \)</p>
                                    <p class="mt-2">\( r = <?= $detail['radius'] ?> \)</p>
                                    <p class="mt-2">\( V = \pi \times<?= $detail['radius'] ?>^2 \times <?php echo $cyl_height ?> \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['cylinder'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Cone') { ?>
                                   
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['15'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \pi r^2 h \)</p>
                                    <p class="mt-2">\( r = d/2 \)</p>
                                    <p class="mt-2">\( r = <?php echo $con_diameter ?>/2 \)</p>
                                    <p class="mt-2">\( r = <?= $detail['radius'] ?> \)</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \times 3.14 \times {<?= $detail['radius'] ?>}^2 \times <?php echo $con_height ?> \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['cone'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Sphere') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['16'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{4}{3} \pi r^3\)</p>
                                    <p class="mt-2">\( r = d/2 \)</p>
                                    <p class="mt-2">\( r = <?php echo $sph_diameter ?>/2 \)</p>
                                    <p class="mt-2">\( r = <?= $detail['radius'] ?> \)</p>
                                    <p class="mt-2">\( V = \frac{4}{3} \times 3.14 \times <?= $detail['radius'] ?>^3\)</p>
            
                                    <p class="mt-2">\( V = <?= safe_round($detail['sphere'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Triangular') { ?>
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['17'] ?> :</p>
                                    <p class="mt-2">$$V = \frac{1}{4}h \sqrt{(a + b + c)(b + c - a)(c + a - b)(a + b - c)}$$</p>
                                    <p class="mt-2">$$V = \frac{1}{4}{{$tri_h}} \sqrt{({{$tri_a}} + {{$tri_b}} + {{$tri_c}})({{$tri_b}} + {{$tri_c}} - {{$tri_a}})({{$tri_c}} + {{$tri_a}} - {{$tri_b}})({{$tri_a}} + {{$tri_b}} - {{$tri_c}})}$$</p>
                                    <p class="mt-2">$$V = \frac{1}{4}{{$tri_h}} \sqrt{{{$detail['baseArea']}}}$$</p>
                                    <p class="mt-2 text-center">\( V = <?= safe_round($detail['triangular'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Pyramid') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['18'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \times \text{base area} \times \text{height}\)</p>
                                    <p class="mt-2">\( \text {Base Area} = 0.33 \times \text{side} \times \text {side}\)</p>
                                    <p class="mt-2">\( \text {Base Area} = 0.33 \times \text{<?php echo $pyr_side ?>} \times \text {<?php echo $pyr_side ?>}\)</p>
                                    <p class="mt-2">\( \text {Base Area} = <?= $detail['baseArea'] ?>\)</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \times \text{<?= $detail['baseArea'] ?>} \times \text{<?php echo $pyr_height ?>}\)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['pyramid'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Capsule') { ?>
                                  
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['20'] ?> :</p>
                                    <p class="mt-2">\( V = \pi r^2 \left( \frac{4}{3} r + h \right)\)</p>
                                    <p class="mt-2">\( V = 3.14 \times <?php echo $cap_radius ?>^2 \left( \frac{4}{3} \times <?php echo $cap_radius ?> + <?php echo $cap_height ?> \right)\)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['capsule'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Hemisphere') { ?>
                              
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['21'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{2}{3} \pi r^3 \)</p>
                                    <p class="mt-2">\( V = \frac{2}{3} \times 3.14 \times <?php echo $hem_radius ?>^3 \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['hemisphere'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Hollow') { ?>
                                   
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['24'] ?> :</p>
                                    <p class="mt-2">\( V = \pi \cdot h \cdot \frac {(R_{\text{outer}}^2 - R_{\text{inner}}^2)}{4} \)</p>
                                    <p class="mt-2">\( V = 3.14 \times <?php echo $hol_height ?> \times \frac{(<?php echo $hol_outer_dia ?>^2 - <?php echo $hol_inner_dia ?>^2)}{4} \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['hollow'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Conical') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['27'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{h}{3} \left( A_t + A_b + \sqrt{A_t \cdot A_b} \right) \)</p>
                                    <p class="mt-2">\( V = \frac{<?php echo $coni_height ?>}{3} \left( <?php echo $coni_top_r ?> + <?php echo $coni_bottom_r ?> + \sqrt{<?php echo $coni_top_r ?> \cdot <?php echo $coni_bottom_r ?>} \right) \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['conical'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Truncated') { ?>
                                
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['30'] ?> :</p>
                                    <p class="mt-2">\(V = \frac{1}{3} \times h\left(A_1 + A_2 + \sqrt{A_1 \cdot A_2}\right) \)</p>
                                    <p class="mt-2">\(V = \frac{1}{3}\times<?php echo $tru_height ?>\left(<?php echo $tru_top_side ?> + <?php echo $tru_base_side ?> + \sqrt{<?php echo $tru_top_side ?> \cdot <?php echo $tru_base_side ?>}\right) \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['truncated'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Ellipsoid') { ?>
                                  
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['34'] ?> :</p>
                                    <p class="mt-2">\(V = \frac{4}{3} \pi abc \)</p>
                                    <p class="mt-2">\(V = \frac{4}{3} \times 3.14 \times <?php echo $ell_sem_a ?>\times <?php echo $ell_sem_a ?>\times <?php echo $ell_sem_a ?> \)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['ellipsoid'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Square') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['36'] ?> :</p>
                                    <p class="mt-2">\( V = \text {Side} \times \text {Side} \times \text {Side}\)</p>
                                    <p class="mt-2">\( V = \text {<?php echo $square ?>} \times \text {<?php echo $square ?>} \times \text {<?php echo $square ?>}\)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['square'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif ($volume_select == 'Column') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['37'] ?> :</p>
                                    <p class="mt-2">\( V = \pi \cdot r^2 \cdot h\)</p>
                                    <p class="mt-2">\( V = \pi \cdot <?php echo $col_radi ?>^2 \cdot <?php echo $col_height ?>\)</p>
                                    <p class="mt-2">\( V = <?= safe_round($detail['column'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>

    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</div>
