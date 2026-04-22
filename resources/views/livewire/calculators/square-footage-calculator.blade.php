<div>
    <form wire:submit.prevent="calculate">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
                @if ($error)
                    <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
                @endif

                <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                    <!-- Tab Selection: Single/Multiple Rooms -->
                    <div class="w-full mb-6">
                        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 p-1 max-w-2xl mx-auto">
                            <div class="lg:w-1/2 w-full px-1">
                                <div wire:click="setRoomUnit('1')" class="py-2 cursor-pointer rounded-md transition-all duration-300 {{ $room_unit == '1' ? 'bg-[#2845F5] text-white shadow-md' : 'bg-white hover:bg-gray-50' }}">
                                    {{ $lang[2] ?? 'Single Area' }}/{{ $lang[3] ?? 'Room' }}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-1">
                                <div wire:click="setRoomUnit('2')" class="py-2 cursor-pointer rounded-md transition-all duration-300 {{ $room_unit == '2' ? 'bg-[#2845F5] text-white shadow-md' : 'bg-white hover:bg-gray-50' }}">
                                    {{ $lang[4] ?? 'Multiple Areas' }}/{{ $lang[3] ?? 'Room' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity (Global for Single Mode) -->
                    @if($room_unit == '1')
                        <div class="mb-4 max-w-2xl mx-auto">
                            <label for="quantity" class="label">{{ $lang['21'] ?? 'Quantity' }}</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model="quantity" id="quantity" class="input" />
                            </div>
                        </div>
                    @endif

                    <!-- Rooms Loop -->
                    <div class="grid grid-cols-1 {{ $room_unit == '2' ? 'md:grid-cols-2' : '' }} gap-6">
                        @foreach($rooms as $index => $room)
                            <div class="room-block relative p-6 border rounded-lg bg-gray-50/50 shadow-sm">
                                @if($room_unit == '2' && count($rooms) > 1)
                                    <button type="button" wire:click="removeRoom({{ $index }})" class="absolute top-4 right-4 text-red-500 hover:text-red-700 transition-colors" title="Remove Room">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                @endif
                                @if($room_unit == '2')
                                    <h3 class="font-bold text-blue-600 mb-4">Area / Room {{ $index + 1 }}</h3>
                                @endif

                                <div class="grid grid-cols-12 gap-4">
                                    <!-- Shape Selection -->
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang['5'] ?? 'Project Shape' }}</label>
                                        <div class="w-full py-2">
                                            <select wire:model.live="rooms.{{ $index }}.shape" class="input">
                                                <option value="sq">{{ $lang[6] ?? 'Square' }}</option>
                                                <option value="rec">{{ $lang[7] ?? 'Rectangle' }}</option>
                                                <option value="recbor">{{ $lang[8] ?? 'Rectangle Border' }}</option>
                                                <option value="tra">{{ $lang[9] ?? 'Trapezoid' }}</option>
                                                <option value="para">{{ $lang[10] ?? 'Parallelogram' }}</option>
                                                <option value="tri">{{ $lang[11] ?? 'Triangle' }}</option>
                                                <option value="cir">{{ $lang[12] ?? 'Circle' }}</option>
                                                <option value="ell">{{ $lang[13] ?? 'Ellipse' }}</option>
                                                <option value="sec">{{ $lang[14] ?? 'Sector' }}</option>
                                                <option value="hex">{{ $lang[15] ?? 'Hexagon' }}</option>
                                                <option value="oct">{{ $lang[16] ?? 'Octagon' }}</option>
                                                <option value="ann">{{ $lang[17] ?? 'Annulus' }}</option>
                                                <option value="cirborder">{{ $lang[18] ?? 'Circle Border' }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Shape Illustration -->
                                    <div class="col-span-12 md:col-span-6 flex justify-center items-center">
                                        @php
                                            $img = match($room['shape']) {
                                                'sq' => 'square.png',
                                                'rec' => 'rectangle.png',
                                                'recbor' => 'rectangle_border.png',
                                                'para' => 'pp.png',
                                                'tri' => 'triangle.png',
                                                'cir' => 'circle.png',
                                                'ell' => 'ellipse.png',
                                                'sec' => 'ss.png',
                                                'oct' => 'octagon.png',
                                                'ann' => 'Annulus.png',
                                                'cirborder' => 'circle_border.png',
                                                'hex' => 'hexagon.png',
                                                'tra' => 'Trapezoid.png',
                                                default => 'k1.png'
                                            };
                                        @endphp
                                        <img src="{{ asset('images/' . $img) }}" alt="Shape" class="max-h-32 object-contain">
                                    </div>

                                    <!-- Conditional Inputs based on Shape -->
                                    <div class="col-span-12 grid grid-cols-12 gap-4">
                                        {{-- Length / Width Group --}}
                                        @if(in_array($room['shape'], ['rec', 'recbor']))
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang['19'] ?? 'Length' }} (l)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.{{ $room['shape'] == 'rec' ? 'length' : 'inner_length' }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_l_{{ $index }}')">{{ $room['shape'] == 'rec' ? $room['length_unit'] : $room['inner_length_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_l_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('{{ $room['shape'] == 'rec' ? 'length_unit' : 'inner_length_unit' }}', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang['20'] ?? 'Width' }} (w)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.{{ $room['shape'] == 'rec' ? 'width' : 'inner_width' }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_w_{{ $index }}')">{{ $room['shape'] == 'rec' ? $room['width_unit'] : $room['inner_width_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_w_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('{{ $room['shape'] == 'rec' ? 'width_unit' : 'inner_width_unit' }}', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Square / Side A --}}
                                        @if(in_array($room['shape'], ['sq', 'tri', 'tra', 'hex', 'oct']))
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang['25'] ?? 'Side' }} (a)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.sidealength" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_sa_{{ $index }}')">{{ $room['sidealength_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_sa_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sidealength_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Side B --}}
                                        @if(in_array($room['shape'], ['tri', 'tra']))
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang['25'] ?? 'Side' }} (b)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.sideblength" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_sb_{{ $index }}')">{{ $room['sideblength_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_sb_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sideblength_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Side C --}}
                                        @if($room['shape'] == 'tri')
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang['25'] ?? 'Side' }} (c)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.sideclength" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_sc_{{ $index }}')">{{ $room['sideclength_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_sc_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('sideclength_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Height / Base --}}
                                        @if(in_array($room['shape'], ['para', 'tra']))
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $room['shape'] == 'para' ? ($lang[29] ?? 'Base') : ($lang[27] ?? 'Height') }}</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.{{ $room['shape'] == 'para' ? 'base' : 'height' }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_bh_{{ $index }}')">{{ $room['shape'] == 'para' ? $room['base_unit'] : $room['height_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_bh_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('{{ $room['shape'] == 'para' ? 'base_unit' : 'height_unit' }}', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($room['shape'] == 'para')
                                                <div class="col-span-12 md:col-span-6">
                                                    <label class="label">{{ $lang[27] ?? 'Height' }}</label>
                                                    <div class="relative w-full py-2">
                                                        <input type="number" wire:model="rooms.{{ $index }}.height" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                        <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_h2_{{ $index }}')">{{ $room['height_unit'] }} ▾</label>
                                                        @if ($showDropdown === 'unit_h2_' . $index)
                                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                                @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('height_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                        {{-- Circle / Diameter --}}
                                        @if($room['shape'] == 'cir')
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang[28] ?? 'Diameter' }}</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.diameter" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_dia_{{ $index }}')">{{ $room['diameter_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_dia_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('diameter_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Ellipse --}}
                                        @if($room['shape'] == 'ell')
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">Axis (a)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.axisa" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_aa_{{ $index }}')">{{ $room['axisa_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_aa_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('axisa_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">Axis (b)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.axisb" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_ab_{{ $index }}')">{{ $room['axisb_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_ab_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('axisb_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Sector --}}
                                        @if($room['shape'] == 'sec')
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang[31] ?? 'Radius' }} (r)</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.radius" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_rad_{{ $index }}')">{{ $room['radius_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_rad_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('radius_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang[32] ?? 'Angle' }} °</label>
                                                <div class="w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.angle" step="any" class="input" />
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Annulus / Circular Border --}}
                                        @if(in_array($room['shape'], ['ann', 'cirborder']))
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $room['shape'] == 'ann' ? ($lang[34] ?? 'Outer Diameter') : ($lang[33] ?? 'Inner Diameter') }}</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.{{ $room['shape'] == 'ann' ? 'outer_diameter' : 'inner_diameter' }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_od_{{ $index }}')">{{ $room['shape'] == 'ann' ? $room['outer_diameter_unit'] : $room['inner_diameter_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_od_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('{{ $room['shape'] == 'ann' ? 'outer_diameter_unit' : 'inner_diameter_unit' }}', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $room['shape'] == 'ann' ? ($lang[33] ?? 'Inner Diameter') : ($lang[24] ?? 'Border Width') }}</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.{{ $room['shape'] == 'ann' ? 'inner_diameter' : 'border_width' }}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_id_{{ $index }}')">{{ $room['shape'] == 'ann' ? $room['inner_diameter_unit'] : $room['border_width_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_id_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('{{ $room['shape'] == 'ann' ? 'inner_diameter_unit' : 'border_width_unit' }}', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Rectangle Border --}}
                                        @if($room['shape'] == 'recbor')
                                            <div class="col-span-12 md:col-span-6">
                                                <label class="label">{{ $lang[24] ?? 'Border Width' }}</label>
                                                <div class="relative w-full py-2">
                                                    <input type="number" wire:model="rooms.{{ $index }}.border_width" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('unit_bw_{{ $index }}')">{{ $room['border_width_unit'] }} ▾</label>
                                                    @if ($showDropdown === 'unit_bw_' . $index)
                                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                            @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $u)
                                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('border_width_unit', '{{ $u }}', {{ $index }})">{{ $u }}</p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add More Button -->
                    @if($room_unit == '2' && count($rooms) < 10)
                        <div class="mt-4 flex justify-center">
                            <button type="button" wire:click="addRoom" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-bold shadow-md transition-all">
                                + {{ $lang['add_more'] ?? 'Add More Rooms' }}
                            </button>
                        </div>
                    @endif

                    <!-- Pricing Section -->
                    <div class="mt-8 pt-8 border-t">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-6">
                                <label for="price" class="label">{{ $lang[36] ?? 'Price' }} ({{ $lang[37] ?? 'per unit' }}):</label>
                                <div class="relative w-full py-2">
                                    <input type="number" wire:model="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 z-20" wire:click="toggleOverlay('price_unit_dropdown')">{{ $price_unit }} ▾</label>
                                    @if ($showDropdown === 'price_unit_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["ft²", "yd²", "m²"] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('price_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
            <hr>
            @if(isset($detail))
            <!-- Result Section -->
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div>
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2 lg:w-[90%] md:w-[90%] w-full">
                                <div class="grid lg:grid-cols-1 md:grid-cols-1 grid-cols-1">
                                    <table class="w-full border-collapse">
                                        <!-- Main Total -->
                                        <tr>
                                            <td  class="border-b py-3 font-bold text-blue-700">{{ $lang['39'] ?? 'Total Square Footage' }} :</td>
                                            <td class="border-b py-3 font-bold text-blue-700 text-right">{{ number_format($detail['ans'], 2) }} ft²</td>
                                        </tr>
                                        <!-- Cost -->
                                        @if(isset($detail['cost']))
                                            <tr>
                                                <td class="border-b py-3 font-bold text-green-700">{{ $lang[43] ?? 'Total Estimated Cost' }} :</td>
                                                <td class="border-b py-3 font-bold text-green-700 text-right">{{ $currancy }} {{ number_format($detail['cost'], 2) }}</td>
                                            </tr>
                                        @endif
                                        <!-- Unit Conversions -->
                                        <tr>
                                            <td colspan="2" class="pt-6 pb-2 text-sm text-gray-500 uppercase tracking-widest">{{ $lang['other_units'] ?? 'Square Footage in Other Units' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 text-sm">{{ $lang[40] ?? 'Square Yards' }} :</td>
                                            <td class="border-b py-2 text-sm text-right">{{ number_format($detail['sqyards'], 4) }} yd²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 text-sm">{{ $lang[41] ?? 'Square Meters' }} :</td>
                                            <td class="border-b py-2 text-sm text-right">{{ number_format($detail['sqmeters'], 4) }} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 text-sm">{{ $lang[42] ?? 'Acres' }} :</td>
                                            <td class="border-b py-2 text-sm text-right">{{ number_format($detail['acres'], 6) }} acres</td>
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
