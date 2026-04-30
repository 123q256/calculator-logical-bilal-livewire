<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8  input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-4">
                {{-- Pipe Diameter --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="pipe_diameter" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="pipe_diameter" id="pipe_diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="pipe_diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('pipe_diameter_unit')">{{ $pipe_diameter_unit }} ▾</label>
                        @if($dropdowns['pipe_diameter_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['mm', 'm', 'cm', 'in', 'ft'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pipe_diameter_unit', '{{ $unit }}', 'pipe_diameter_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Pipe Length --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="pipe_length" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="pipe_length" id="pipe_length" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="pipe_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('pipe_length_unit')">{{ $pipe_length_unit }} ▾</label>
                        @if($dropdowns['pipe_length_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(['mm', 'm', 'cm', 'in', 'ft'] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pipe_length_unit', '{{ $unit }}', 'pipe_length_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Volumetric Flow --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="volumetric" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="volumetric" id="volumetric" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                        <label for="volumetric_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('volumetric_unit')">{{ $volumetric_unit }} ▾</label>
                        @if($dropdowns['volumetric_unit'] ?? false)
                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-72 overflow-y-auto">
                            @foreach(["US gal/s", "US gal/min", "US gal/hr", "UK gal/s", "UK gal/min", "UK gal/hr", "ft³/s", "ft³/min", "ft³/hr", "m³/s", "m³/min", "m³/hr", "L/s", "L/min", "L/hr", "ml/min", "ml/hr"] as $unit)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('volumetric_unit', '{{ $unit }}', 'volumetric_unit')">{{ $unit }}</p>
                            @endforeach
                        </div>
                        @endif
                     </div>
                </div>

                {{-- Material --}}
                <div class="col-span-12 lg:col-span-6">
                    <label for="material" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                  <div class="w-full py-2 position-relative">
                        <select wire:model="material" id="material" class="input w-full border border-gray-300 p-2 rounded-lg focus:ring-2">
                            @php
                                $materials = [
                                    "130" => "Acrylonitrile Butadiene Stress (ABS)",
                                    "140" => "Aluminium",
                                    "140" => "Asbestos Cement",
                                    "135" => "Asphalt Lining",
                                    "135" => "Brass",
                                    "95" => "Brick Sewer",
                                    "130" => "Cast Iron - New",
                                    "110" => "Cast Iron - 10 years old",
                                    "94.5" => "Cast Iron - 20 years old",
                                    "92.5" => "Cast Iron - 30 years old",
                                    "73.5" => "Cast Iron - 40 years old",
                                    "100" => "Cast Iron - Asphalt coated",
                                    "140" => "Cast Iron - Bituminous lined",
                                    "140" => "Cast Iron - Cement lined",
                                    "120" => "Cast Iron - Sea coated",
                                    "100" => "Cast Iron - Wrought plain",
                                    "135" => "Cement lining",
                                    "120" => "Concrete",
                                    "140" => "Concrete lined, Steel forms",
                                    "120" => "Concrete lined, Wooden forms",
                                    "105" => "Concrete, old",
                                    "135" => "Copper",
                                    "60" => "Corrugated Metal",
                                    "154" => "Ductile Iron Pipe (DIP)",
                                    "120" => "Ductile Iron, cement lined",
                                    "140" => "Fiber",
                                    "150" => "Fiberglass - FRP",
                                    "135" => "Fire hose - Rubber lined",
                                    "120" => "Galvanized Iron",
                                    "130" => "Glass",
                                    "152" => "HDPE",
                                    "135" => "Lead",
                                    "135" => "Metal pipes - very smooth",
                                    "140" => "Plastic",
                                    "140" => "Polyethylene, PE, PEH",
                                    "150" => "Polyvinyl chloride, PVC, CPVC",
                                    "140" => "Smooth pipes",
                                    "145" => "Steel, new unlined",
                                    "60" => "Steel, corrugated",
                                    "110" => "Steel, interior riveted, no projecting rivets",
                                    "100" => "Steel, projecting girth and horizontal rivets",
                                    "95" => "Steel, vitrified, spiral-riveted",
                                    "100" => "Steel, welded and seamless",
                                    "130" => "Tin",
                                    "110" => "Vitrified Clay",
                                    "115" => "Wood Stave",
                                    "120" => "Wooden or Masonry Pipe - Smooth",
                                    "100" => "Wrought iron, plain"
                                ];
                            @endphp
                            @foreach($materials as $val => $name)
                                <option value="{{ $val }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
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

<hr>
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full flex justify-center">
                        <div class="w-full overflow-auto">
                            <table class="w-full ">
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[5] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ $detail['material'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[6] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['head_loss'], 5) }} (m)</strong></td>
                                </tr>
                                <tr>
                                    <td class="p-2 border-b">{{ $lang[7] }}</td>
                                    <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['pressure_loss'], 5) }} (bar)</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
</div>
