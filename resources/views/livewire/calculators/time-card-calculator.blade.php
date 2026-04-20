<div>
    <style>
        .display_none {
            display: none;
        }
    </style>
    @php
        $naam = $inputs['naam'] ?? request()->naam;
        $naam2 = $inputs['naam2'] ?? request()->naam2;
        $naam3 = $inputs['naam3'] ?? request()->naam3;
        $naam4 = $inputs['naam4'] ?? request()->naam4;
    @endphp
    <form wire:submit.prevent="calculate" class="row">
    
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
                @endif
                <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">

                        {{-- WEEK1 --}}
                        <div class="addweek1 row">
                            <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                                <label for="naam" class="font-s-14 text-blue">{{ $lang['1t'] }}:</label>
                                <div class="w-100 py-2">
                                    <input type="text" step="any" name="naam" id="naam"
                                        class="input text-center" aria-label="input"
                                        value="{{ $inputs['naam'] ?? 'Table1' }}" wire:model="inputs.naam" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="space-y-2">
                                    <label for="s_date" class="font-s-14 text-blue">{{ $lang['2t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="s_date" id="s_date"
                                            class="input" aria-label="input"
                                            value="{{ $inputs['s_date'] ?? date('Y-m-d') }}" wire:model="inputs.s_date" />
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="e_date" class="font-s-14 text-blue">{{ $lang['3t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="e_date" id="e_date"
                                            class="input" aria-label="input"
                                            value="{{ $inputs['e_date'] ?? date('Y-m-d') }}" wire:model="inputs.e_date" />
                                    </div>
                                </div>
                                <div class="col-6 text-center  my-2">
                                    <span class="p-2"><strong>{{ $lang['in'] }}</strong></span>
                                </div>
                                <div class="col-6 text-center  my-2">
                                    <span class="p-2"><strong>{{ $lang['out'] }}</strong></span>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row1 {{ ($inputs['selection1'] ?? 7) >= 1 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 mon">{{ $this->getDayLabel('mon', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="cspace-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.0">
                                    </div>
                                    <div class="cspace-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.0">
                                    </div>
                                    <div class="cspace-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="cspace-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.0">
                                    </div>
                                    <div class="cspace-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.0">
                                    </div>
                                    <div class="cspace-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.0">
                                    </div>
                                    <div class="cspace-y-2 time">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="cspace-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4  r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4  r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }}">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.0">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row2 mt-2 {{ ($inputs['selection1'] ?? 7) >= 2 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 tue">{{ $this->getDayLabel('tue', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.1">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}  gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }}  gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.1">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row3 mt-2 {{ ($inputs['selection1'] ?? 7) >= 3 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 wed">{{ $this->getDayLabel('wed', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.2">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.2">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row4 mt-2 {{ ($inputs['selection1'] ?? 7) >= 4 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 thu">{{ $this->getDayLabel('thu', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.3">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.3">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row5 mt-2 {{ ($inputs['selection1'] ?? 7) >= 5 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4  mt-2">
                                    <div class="space-y-2 fri">{{ $this->getDayLabel('fri', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.4">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.4">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row6 mt-2 {{ ($inputs['selection1'] ?? 7) >= 6 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sat">{{ $this->getDayLabel('sat', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.5">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.5">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row7 mt-2 {{ ($inputs['selection1'] ?? 7) >= 7 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7   gap-4">
                                    <div class="space-y-2 sun">{{ $this->getDayLabel('sun', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inmin.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampm[]" class="input" wire:model="inputs.inampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.in.6">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.outmin.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampm[]" class="input" wire:model="inputs.outampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.out.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }}   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inhourl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="inminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl1.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml1[]" class="input" wire:model="inputs.inampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.outhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="outminl1[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl1.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml1[]" class="input" wire:model="inputs.outampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch1.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  r1_lunch2 hidden   gap-4">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inhourl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="inminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.inminl2.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="inampml2[]" class="input" wire:model="inputs.inampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.inlunch2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.outhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="outminl2[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.outminl2.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="outampml2[]" class="input" wire:model="inputs.outampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.outlunch2.6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- WEEK2 --}}
                        <div class="addweek2 mt-2 {{ ($inputs['table_selection'] ?? 1) >= 2 ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                                <label for="naam2"><strong class="text-blue">{{ $lang['7t'] }}</strong></label>
                                <div class="w-100 py-2">
                                    <input type="text" step="any" name="naam2" id="naam2"
                                        class="input text-center" aria-label="input"
                                        value="{{ isset($inputs['naam2']) ? $inputs['naam2'] : 'Table2' }}" wire:model="inputs.naam2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="space-y-2">
                                    <label for="s2_date" class="font-s-14 text-blue">{{ $lang['2t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="s2_date" id="s2_date"
                                            class="input" aria-label="input"
                                            value="{{ isset($inputs['s2_date']) ? $inputs['s2_date'] : date('') }}" wire:model="inputs.s2_date" />
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="e2_date" class="font-s-14 text-blue">{{ $lang['3t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="e2_date" id="e2_date"
                                            class="input" aria-label="input"
                                            value="{{ isset($inputs['e2_date']) ? $inputs['e2_date'] : date('') }}" wire:model="inputs.e2_date" />
                                    </div>
                                </div>
                                <div class="space-y-2 text-center  my-2">
                                    <span class="p-2"><strong>{{ $lang['in'] }}</strong></span>
                                </div>
                                <div class="space-y-2 text-center  my-2">
                                    <span class="p-2"><strong>{{ $lang['out'] }}</strong></span>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row1 {{ ($inputs['selection1'] ?? 7) >= 1 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 mon">{{ $this->getDayLabel('mon', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.0">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.0">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.0">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.0">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row2 {{ ($inputs['selection1'] ?? 7) >= 2 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 tue">{{ $this->getDayLabel('tue', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.1">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.1">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row3 {{ ($inputs['selection1'] ?? 7) >= 3 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 wed">{{ $this->getDayLabel('wed', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.2">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.2">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row4 {{ ($inputs['selection1'] ?? 7) >= 4 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 thu">{{ $this->getDayLabel('thu', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.3">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.3">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row5 {{ ($inputs['selection1'] ?? 7) >= 5 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 fri">{{ $this->getDayLabel('fri', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.4">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.4">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row6 {{ ($inputs['selection1'] ?? 7) >= 6 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sat">{{ $this->getDayLabel('sat', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.5">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.5">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row7 {{ ($inputs['selection1'] ?? 7) >= 7 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sun">{{ $this->getDayLabel('sun', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t2inmin.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampm[]" class="input" wire:model="inputs.t2inampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t2in.6">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t2outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t2outmin.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampm[]" class="input" wire:model="inputs.t2outampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t2out.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t2inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl1.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml1[]" class="input" wire:model="inputs.t2inampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t2outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t2outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl1.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml1[]" class="input" wire:model="inputs.t2outampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch1.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2inminl2.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t2inampml2[]" class="input" wire:model="inputs.t2inampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t2inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2inlunch2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t2outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t2outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t2outminl2.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t2outampml2[]" class="input" wire:model="inputs.t2outampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t2outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t2outlunch2.6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- WEEK3 --}}
                        <div class="addweek3 mt-2 {{ ($inputs['table_selection'] ?? 1) >= 3 ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                                <label for="naam3"><strong
                                        class="text-blue">{{ $lang['6t'] }}</strong></label>
                                <div class="w-100 py-2">
                                    <input type="text" step="any" name="naam3" id="naam3"
                                        class="input text-center" aria-label="input"
                                        value="{{ isset($inputs['naam3']) ? $inputs['naam3'] : 'Table3' }}" wire:model="inputs.naam3" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="space-y-2 pe-lg-3">
                                    <label for="s3_date" class="font-s-14 text-blue">{{ $lang['2t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="s3_date" id="s3_date"
                                            class="input" aria-label="input"
                                            value="{{ isset($inputs['s3_date']) ? $inputs['s3_date'] : date('') }}" wire:model="inputs.s3_date" />
                                    </div>
                                </div>
                                <div class="space-y-2 ps-lg-3">
                                    <label for="e3_date" class="font-s-14 text-blue">{{ $lang['3t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="e3_date" id="e3_date"
                                            class="input" aria-label="input"
                                            value="{{ isset($inputs['e3_date']) ? $inputs['e3_date'] : date('') }}" wire:model="inputs.e3_date" />
                                    </div>
                                </div>
                                <div class="space-y-2 text-center pe-lg-3 my-2">
                                    <span class="p-2"><strong>{{ $lang['in'] }}</strong></span>
                                </div>
                                <div class="space-y-2 text-center ps-lg-3 my-2">
                                    <span class="p-2"><strong>{{ $lang['out'] }}</strong></span>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row1 {{ ($inputs['selection1'] ?? 7) >= 1 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 mon">{{ $this->getDayLabel('mon', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.0">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.0">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.0">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.0">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row2 {{ ($inputs['selection1'] ?? 7) >= 2 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 tue">{{ $this->getDayLabel('tue', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.1">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.1">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row3 {{ ($inputs['selection1'] ?? 7) >= 3 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 wed">{{ $this->getDayLabel('wed', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.2">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.2">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row4 {{ ($inputs['selection1'] ?? 7) >= 4 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 thu">{{ $this->getDayLabel('thu', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.3">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.3">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row5 {{ ($inputs['selection1'] ?? 7) >= 5 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 fri">{{ $this->getDayLabel('fri', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.4">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.4">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row6 {{ ($inputs['selection1'] ?? 7) >= 6 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sat">{{ $this->getDayLabel('sat', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.5">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.5">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row7 {{ ($inputs['selection1'] ?? 7) >= 7 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sun">{{ $this->getDayLabel('sun', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t3inmin.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampm[]" class="input" wire:model="inputs.t3inampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t3in.6">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t3outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t3outmin.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampm[]" class="input" wire:model="inputs.t3outampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t3out.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t3inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl1.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml1[]" class="input" wire:model="inputs.t3inampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t3outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t3outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl1.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml1[]" class="input" wire:model="inputs.t3outampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch1.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3inminl2.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t3inampml2[]" class="input" wire:model="inputs.t3inampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t3inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3inlunch2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t3outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t3outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t3outminl2.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t3outampml2[]" class="input" wire:model="inputs.t3outampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t3outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t3outlunch2.6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- WEEK4 --}}
                        <div class="addweek4 mt-2 {{ ($inputs['table_selection'] ?? 1) >= 4 ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                                <label for="naam4"><strong
                                        class="text-blue">{{ $lang['5t'] }}</strong></label>
                                <div class="w-100 py-2">
                                    <input type="text" step="any" name="naam4" id="naam4"
                                        class="input text-center" aria-label="input"
                                        value="{{ isset($inputs['naam4']) ? $inputs['naam4'] : 'Table4' }}" wire:model="inputs.naam4" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="space-y-2 pe-lg-3">
                                    <label for="s4_date" class="font-s-14 text-blue">{{ $lang['2t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="s4_date" id="s4_date"
                                            class="input" aria-label="input"
                                            value="{{ isset($inputs['s4_date']) ? $inputs['s4_date'] : date('') }}" wire:model="inputs.s4_date" />
                                    </div>
                                </div>
                                <div class="space-y-2 ps-lg-3">
                                    <label for="e4_date" class="font-s-14 text-blue">{{ $lang['3t'] }}:</label>
                                    <div class="w-100 py-2">
                                        <input type="date" step="any" name="e4_date" id="e4_date"
                                            class="input" aria-label="input"
                                            value="{{ isset($inputs['e4_date']) ? $inputs['e4_date'] : date('') }}" wire:model="inputs.e4_date" />
                                    </div>
                                </div>
                                <div class="space-y-2 text-center pe-lg-3 my-2">
                                    <span class="p-2"><strong>{{ $lang['in'] }}</strong></span>
                                </div>
                                <div class="space-y-2 text-center ps-lg-3 my-2">
                                    <span class="p-2"><strong>{{ $lang['out'] }}</strong></span>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row1 {{ ($inputs['selection1'] ?? 7) >= 1 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 mon">{{ $this->getDayLabel('mon', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.0">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.0">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.0">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.0">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.0">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.0">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.0">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.0">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.0">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.0">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row2 {{ ($inputs['selection1'] ?? 7) >= 2 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 tue">{{ $this->getDayLabel('tue', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.1">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.1">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.1">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.1">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.1">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.1">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.1">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.1">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.1">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row3 {{ ($inputs['selection1'] ?? 7) >= 3 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 wed">{{ $this->getDayLabel('wed', $inputs['selection2'] ?? 2) }}:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.2">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.2">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.2">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.2">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.2">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.2">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.2">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.2">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.2">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row4 {{ ($inputs['selection1'] ?? 7) >= 4 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 thu">THU:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.3">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.3">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.3">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.3">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.3">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.3">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.3">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.3">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.3">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row5 {{ ($inputs['selection1'] ?? 7) >= 5 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 fri">FRI:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.4">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.4">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.4">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.4">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.4">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.4">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.4">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.4">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.4">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row6 {{ ($inputs['selection1'] ?? 7) >= 6 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sat">SAT:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.5">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.5">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.5">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.5">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.5">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.5">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.5">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.5">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.5">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center row7 {{ ($inputs['selection1'] ?? 7) >= 7 ? '' : 'hidden' }}">
                                <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                                    <div class="space-y-2 sun">SUN:</div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                            class="input" wire:model="inputs.t4inmin.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampm[]" class="input" wire:model="inputs.t4inampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4in[]"
                                            value="" placeholder="in" class="input fahad" wire:model="inputs.t4in.6">
                                    </div>
                                    <div class="space-y-2 12h ps-lg-2">
                                        <input type="number" name="t4outhour[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhour.6">
                                    </div>
                                    <div class="space-y-2 12h {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                            class="input" wire:model="inputs.t4outmin.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampm[]" class="input" wire:model="inputs.t4outampm.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 display_none ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4out[]"
                                            value="" placeholder="out" class="input fahad" wire:model="inputs.t4out.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 {{ in_array($inputs['lunch'] ?? 1, [2, 3]) ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ">
                                        <input type="number" name="t4inminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl1.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml1[]" class="input" wire:model="inputs.t4inampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch1[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1 ps-lg-2">
                                        <input type="number" name="t4outhourl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl1.6">
                                    </div>
                                    <div class="space-y-2 12h lunch1">
                                        <input type="number" name="t4outminl1[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl1.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml1[]" class="input" wire:model="inputs.t4outampml1.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24h ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch1[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch1.6">
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 {{ ($inputs['lunch'] ?? 1) == 3 ? '' : 'hidden' }} mt-2">
                                    <div class="space-y-2 "></div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4inminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4inminl2.6">
                                    </div>
                                    <div class="space-y-2 time pe-lg-2">
                                        <select name="t4inampml2[]" class="input" wire:model="inputs.t4inampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 pe-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" min="0" max="2400" name="t4inlunch2[]"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4inlunch2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2 ps-lg-2">
                                        <input type="number" name="t4outhourl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outhourl2.6">
                                    </div>
                                    <div class="space-y-2 12h lunch2">
                                        <input type="number" name="t4outminl2[]" value="1"
                                            placeholder="_ _" class="input" wire:model="inputs.t4outminl2.6">
                                    </div>
                                    <div class="space-y-2 time {{ ($inputs['selection3'] ?? 1) == 1 ? '' : 'hidden' }}">
                                        <select name="t4outampml2[]" class="input" wire:model="inputs.t4outampml2.6">
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 24lh2 ps-lg-2 {{ ($inputs['selection3'] ?? 1) == 2 ? '' : 'hidden' }}">
                                        <input type="number" name="t4outlunch2[]" min="0" max="2400"
                                            value="1" placeholder="_ _" class="input" wire:model="inputs.t4outlunch2.6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- advance option --}}
                        <div class="px-md-5 px-2 mb-3 mt-3">
                            <input type="checkbox" name="checkbox" id="check" class="filled-in" wire:model.live="inputs.checkbox">
                            <label for="check">{{ $lang['8t'] }}</label>
                        </div>
                        <div class="row advanceopt {{ ($inputs['checkbox'] ?? false) ? '' : 'hidden' }}">
                            <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                                <div class="space-y-2">
                                    <select name="selection0" id="selection1" class="input"
                                        aria-label="input select" wire:model.live="inputs.selection0">
                                        <option value="1" id="op1">{{ $lang['10t'] }}</option>
                                        <option value="2">{{ $lang['11t'] }}</option>
                                        <option value="3">{{ $lang['12t'] }}</option>
                                        <option value="4">{{ $lang['13t'] }}</option>
                                    </select>
                                </div>
                            </div>
                            {{-- days --}}
                            <div class="space-y-22 days mt-2 {{ ($inputs['selection0'] ?? '1') == '1' ? 'd-md-flex' : 'hidden' }}">
                                <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4">
                                    <div class="space-y-2">
                                        <p class="bg-black text-white px-1">Weeks per Timesheet:</p>
                                        <select name="table_selection" id="timesheet" class="input"
                                            aria-label="input select" wire:model="inputs.table_selection">
                                            <option value="1">1 {{ $lang['15t'] }}/{{ $lang['16t'] }}
                                            </option>
                                            <option value="2">2 {{ $lang['15t'] }}/{{ $lang['16t'] }}
                                            </option>
                                            <option value="3">3 {{ $lang['15t'] }}/{{ $lang['16t'] }}
                                            </option>
                                            <option value="4">4 {{ $lang['15t'] }}/{{ $lang['16t'] }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 px-2">
                                        <p class="bg-black text-white px-1">{{ $lang['17t'] }}:</p>
                                        <select name="selection1" id="hidedays" class="input" wire:model="inputs.selection1">
                                            <option value="1">1 {{ $lang['18t'] }}/{{ $lang['15t'] }}
                                            </option>
                                            <option value="2">2 {{ $lang['19t'] }}/{{ $lang['15t'] }}
                                            </option>
                                            <option value="3">3 {{ $lang['19t'] }}/{{ $lang['15t'] }}
                                            </option>
                                            <option value="4">4 {{ $lang['19t'] }}/{{ $lang['15t'] }}
                                            </option>
                                            <option value="5">5 {{ $lang['19t'] }}/{{ $lang['15t'] }}
                                            </option>
                                            <option value="6">6 {{ $lang['19t'] }}/{{ $lang['15t'] }}
                                            </option>
                                            <option value="7" selected>7
                                                {{ $lang['19t'] }}/{{ $lang['15t'] }}</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="bg-black text-white px-1">{{ $lang['20t'] }}:</p>
                                        <select name="selection2" id="textchange" class="input"
                                            aria-label="input select" wire:model="inputs.selection2">
                                            <option value="1">1, 2, 3, etc.</option>
                                            <option value="2" selected>Mon, Tue, Wed, etc.</option>
                                            <option value="3">Sun, Mon, Tues, etc.</option>
                                            <option value="4">M, T, W, etc.</option>
                                            <option value="5">Mo, Tu, We, etc.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-y-2 mt-2">
                                    <p class="bg-black text-white px-1">{{ $lang['21t'] }}:</p>
                                    <select name="selection3" id="format" class="input"
                                        aria-label="input select" wire:model="inputs.selection3">
                                        <option value="1">12 {{ $lang['22t'] }} (Yes am/pm)</option>
                                        <option value="2">24 {{ $lang['22t'] }} (No am/pm)</option>
                                    </select>
                                </div>
                            </div>
                            {{-- lunch --}}
                            <div class="col-12 lunch mt-2 {{ ($inputs['selection0'] ?? '1') == '2' ? '' : 'hidden' }}">
                                {{-- <div class="d-lg-flex justify-content-between"> --}}
                                <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4">
                                    <div>
                                        <input class="with-gap" name="lunch" value="1" type="radio"
                                            checked="" id="lunch" aria-label="input field" wire:model="inputs.lunch">
                                        <label for="lunch">{{ $lang['24t'] }}</label>
                                    </div>
                                    <div>
                                        <input class="with-gap" name="lunch" value="2" type="radio"
                                            id="lunch1" aria-label="input field" wire:model="inputs.lunch">
                                        <label for="lunch1">1 {{ $lang['25t'] }}</label>
                                    </div>
                                    <div>
                                        <input class="with-gap" name="lunch" value="3" type="radio"
                                            id="lunch2" aria-label="input field" wire:model="inputs.lunch">
                                        <label for="lunch2">2 {{ $lang['25t'] }}</label>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <input type="checkbox" name="advancedcheck" id="check12"
                                        class="filled-in" wire:model.live="inputs.advancedcheck">
                                    <label for="check12">{{ $lang['26t'] }}</label>
                                </div>
                                <div class="advanceopt1 {{ (isset($inputs['advancedcheck']) && $inputs['advancedcheck']) ? '' : 'hidden' }}">
                                    <p class="pb-2">{{ $lang['27t'] }}:</p>
                                    <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4">
                                        <div class="space-y-2 pe-2">
                                            <p class="bg-black text-white px-1"> {{ $lang['28t'] }} 1</p>
                                            <input type="number" name="paid_lunch1" value="8"
                                                min="0" max="59" placeholder="00" class="input " wire:model="inputs.paid_lunch1">
                                        </div>
                                        <div class="space-y-2 ps-2">
                                            <p class="bg-black text-white px-1"> {{ $lang['28t'] }} 2</p>
                                            <input type="number" name="paid_lunch2" value="8"
                                                min="0" max="59" placeholder="00" class="input " wire:model="inputs.paid_lunch2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- advance overtime --}}
                            <div class="justify-content-between overtime my-3 gap-3 {{ ($inputs['selection0'] ?? '1') == '3' ? 'd-md-flex' : 'hidden' }}">
                                <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                                    <div class="space-y-2">
                                        <p class="bg-black text-white px-1">{{ $lang['23t'] }}</p>
                                        <input type="number" name="hour_rate" value="8" placeholder=""
                                            class="input" wire:model="inputs.hour_rate">
                                    </div>
                                    <div class="space-y-2 px-2">
                                        <p class="bg-black text-white px-1"> {{ $lang['29t'] }}:</p>
                                        <select name="overtime" class="input" aria-label="input select"
                                            data-gtm-form-interact-field-id="5" wire:model="inputs.overtime">
                                            <option value="0" selected="">{{ $lang['20t'] }}</option>
                                            <option value="1">{{ $lang['31t'] }} 8 {{ $lang['32t'] }}
                                            </option>
                                            <option value="2">{{ $lang['31t'] }} 40 {{ $lang['32t'] }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="space-y-2 mt-1">
                                        <legend class="bg-black text-white px-1">{{ $lang['33t'] }}:</legend>
                                        <input type="text" name="overtime_pay" value="1.5" placeholder=""
                                            class="input" wire:model="inputs.overtime_pay">
                                    </div>
                                </div>
                            </div>
                            {{-- sick hour --}}
                            <div class="space-y-2 sick_hour my-3 {{ ($inputs['selection0'] ?? '1') == '4' ? '' : 'hidden' }}">
                                <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                                    <div class="space-y-2">
                                        <div class="align-self-center fw-semibold pt-1 m-0">{{ $lang['35t'] }}:
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="align-self-center fw-semibold pt-1 m-0">{{ $lang['36t'] }}:
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                                     {{-- Week 1 --}}
                                    <div class="flex space-x-2">
                                        <div class="self-center font-semibold pt-1 text-end">Week 1:</div>
                                        <div>
                                            <input type="number" name="sick_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.sick_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="sick_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.sick_m">
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <div class="self-center font-semibold pt-1 text-end">Week 1:</div>
                                        <div>
                                            <input type="number" name="v_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.v_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="v_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.v_m">
                                        </div>
                                    </div>

                                    {{-- Week 2 --}}
                                    <div class="flex space-x-2 week2 {{ ($inputs['table_selection'] ?? 1) >= 2 ? '' : 'hidden' }}">
                                        <div class="self-center font-semibold pt-1 text-end">Week 2:</div>
                                        <div>
                                            <input type="number" name="t2sick_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t2sick_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="t2sick_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t2sick_m">
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 week2 {{ ($inputs['table_selection'] ?? 1) >= 2 ? '' : 'hidden' }}">
                                        <div class="self-center font-semibold pt-1 text-end">Week 2:</div>
                                        <div>
                                            <input type="number" name="t2v_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t2v_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="t2v_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t2v_m">
                                        </div>
                                    </div>

                                    {{-- Week 3 --}}
                                    <div class="flex space-x-2 week3 {{ ($inputs['table_selection'] ?? 1) >= 3 ? '' : 'hidden' }}">
                                        <div class="self-center font-semibold pt-1 text-end">Week 3:</div>
                                        <div>
                                            <input type="number" name="t3sick_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t3sick_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="t3sick_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t3sick_m">
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 week3 {{ ($inputs['table_selection'] ?? 1) >= 3 ? '' : 'hidden' }}">
                                        <div class="self-center font-semibold pt-1 text-end">Week 3:</div>
                                        <div>
                                            <input type="number" name="t3v_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t3v_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="t3v_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t3v_m">
                                        </div>
                                    </div>

                                    {{-- Week 4 --}}
                                    <div class="flex space-x-2 week4 {{ ($inputs['table_selection'] ?? 1) >= 4 ? '' : 'hidden' }}">
                                        <div class="self-center font-semibold pt-1 text-end">Week 4:</div>
                                        <div>
                                            <input type="number" name="t4sick_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t4sick_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="t4sick_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t4sick_m">
                                        </div>
                                    </div>

                                    <div class="flex space-x-2 week4 {{ ($inputs['table_selection'] ?? 1) >= 4 ? '' : 'hidden' }}">
                                        <div class="self-center font-semibold pt-1 text-end">Week 4:</div>
                                        <div>
                                            <input type="number" name="t4v_h" value="1"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t4v_h">
                                        </div>
                                        <span>:</span>
                                        <div>
                                            <input type="number" name="t4v_m" value="8"
                                                class="border rounded px-2 py-1 w-16" wire:model="inputs.t4v_m">
                                        </div>
                                    </div>

                                </div>



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
         @if (isset($detail))
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full my-2">
                            <div class="col-lg-8 font-s-18">
                                @if (isset($detail['count_days']))
                                    <table>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['19'] }}</strong></td>
                                            <td class="border-b py-2">{{ $detail['from'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['20'] }}</strong></td>
                                            <td class="border-b py-2">{{ $detail['to'] }}</td>
                                        </tr>
                                    </table>
                                    <div class="col-12">
                                        <p class="mt-2"><strong>{{ $detail['years'] }} {{ $lang['32'] }} ,
                                                {{ $detail['months'] }} {{ $lang['33'] }}
                                                , {{ $detail['days'] }} {{ $lang['34'] }}
                                            </strong></p>
                                        <p class="mt-2"><strong> {{ $lang['35'] }}
                                                {{ number_format(floor($detail['diff'] / 2.628e6)) }}
                                                {{ $lang['33'] }}
                                                , {{ $detail['days'] }} {{ $lang['34'] }}
                                            </strong></p>
                                        <p class="mt-2"><strong> {{ $lang['35'] }}
                                                {{ number_format(floor($detail['t_days'] / 7)) }} {{ $lang['39'] }}
                                                , {{ number_format(floor($detail['t_days'] % 7)) }}
                                                {{ $lang['34'] }}
                                            </strong></p>
                                        <p class="mt-2"><strong>{{ $lang['35'] }} {{ $detail['t_days'] }}
                                                {{ $lang['34'] }}
                                            </strong></p>
                                        <p class="mt-2"><strong>{{ $lang['35'] }} {{ $detail['t_days'] * 24 }}
                                                {{ $lang['36'] }}
                                            </strong></p>
                                        <p class="mt-2"><strong>{{ $lang['35'] }}
                                                {{ $detail['t_days'] * 24 * 60 }} {{ $lang['37'] }}
                                            </strong></p>
                                        <p class="mt-2"><strong>{{ $lang['35'] }}
                                                {{ $detail['t_days'] * 24 * 60 * 60 }} {{ $lang['38'] }}
                                            </strong></p>
                                    </div>
                                    <p class="font-s-20">{{ $lang['21'] }}:</p>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['22'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['getworkdays']['workdays'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['23'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['getworkdays']['weekend'] }}</td>
                                        </tr>
                                        @if ($inputs['holiday_c'] == 'yes')
                                            <tr>
                                                <td class="border-b py-2"><strong>Holidays
                                                        {{ $detail['getworkdays']['holidays'] != 0 ? "<span class='view_holi'>(View Detail)</span>" : '' }}
                                                        :</strong></td>
                                                <td class="border-b py-2">{{ $detail['getworkdays']['holidays'] }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($inputs['holiday_c'] == 'yes' && $detail['getworkdays']['holidays'] != 0)
                                            <tr>
                                                <td colspan="2" class="pt-3"><strong>{{ $lang['25'] }}
                                                        {{ $detail['from'] }} and {{ $detail['to'] }}</strong></td>
                                            </tr>
                                            @if ($count = count($detail['getworkdays']['get_holi']))
                                                @for ($i = 0; $i < $count; $i++)
                                                    <tr>
                                                        <td class="border-b py-2">
                                                            {{ $detail['getworkdays']['dis_holi'][$i] }} :</td>
                                                        <td class="border-b py-2">
                                                            {{ $detail['getworkdays']['get_holi'][$i] }}</td>
                                                    </tr>
                                                @endfor
                                            @endif
                                    </table>
                                @endif
                                </table>
                            @else
                                @if (isset($inputs['cal_bus']))
                                    <p class="my-2"><strong>{{ $detail['date'] }}</strong></p>
                                    @if ($inputs['method'] == '+')
                                        <p class="mb-2">{{ $lang['28'] }} {{ $inputs['days'] }}
                                            {{ $lang['22'] }} {{ $lang['29'] }} {{ $detail['from'] }}
                                            {{ $lang['30'] }} {{ $detail['from_s'] }} {{ $lang['26'] }}
                                            {{ $detail['date_e'] }}</p>
                                    @else
                                        <p class="mb-2">{{ $lang['28'] }} {{ $inputs['days'] }}
                                            {{ $lang['22'] }} before {{ $detail['from'] }} {{ $lang['30'] }}
                                            {{ $detail['date_e'] }} {{ $lang['31'] }} {{ $detail['from_s'] }}
                                            and</p>
                                    @endif
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['22t'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $inputs['days'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['23t'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['weekends'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['24t'] }}
                                                    {{ $detail['holidays'] != 0 ? "<span class='view_holi'>(View Detail)</span>" : '' }}
                                                    :</strong></td>
                                            <td class="border-b py-2">{{ $detail['holidays'] }}</td>
                                        </tr>
                                        @if ($_POST['weekend_c'] == 'yes' && $detail['holidays'] != 0)
                                            {{-- <div class="col s12 margin_top_10 display_none holi_detail"> --}}
                                            <tr>
                                                <td colspan="2" class="pt-2">{{ $lang['25'] }}
                                                    {{ $detail['from'] }} {{ $lang['26'] }}
                                                    {{ $detail['date'] }}</td>
                                            </tr>
                                            {{-- <table class="highlight striped col m10 s12 font_size18 font_s16_m"> --}}
                                            @php $count=count($detail['get_holi'])@endphp
                                            @for ($i = 0; $i < $count; $i++)
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $detail['dis_holi'][$i] }}
                                                            :</strong></td>
                                                    <td class="border-b py-2">{{ $detail['get_holi'][$i] }}</td>
                                                </tr>
                                            @endfor
                                        @endif
                                    </table>
                                @else
                                    <p class="font-s-20"><strong>{{ $inputs['naam'] }}</strong></p>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['46t'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['from'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['37t'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['to'] }}</td>
                                        </tr>
                                        @if (!empty($detail['sick_time']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['38t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['sick_time'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_time']))
                                            <tr>
                                                <td colspan="2" class="border-b py-2">
                                                    {{ $detail['total_time'] }}</td>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                            </tr>
                                        @endif
                                        @if (!empty($detail['sick_pay']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['39t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ round($detail['sick_pay']) }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['v_time']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['41t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['v_time'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['vacation_pay']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['40t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ round($detail['vacation_pay']) }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['regular_time']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['42t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['regular_time'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime2_first']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['43t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['overtime2_first'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime3_first']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['44t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['overtime3_first'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime4_first']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['34t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['overtime4_first'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime5_first']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['33t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['overtime5_first'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime6_first']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['45t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['overtime6_first'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_pay']))
                                            <tr>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                <td colspan="2" class="border-b py-2">
                                                    {{ round($detail['total_pay']) }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <table class="w-100 my-3">
                                        <tr>
                                            @if ($detail['days'])
                                                <td width="30%" class="border-b py-2">
                                                    <strong>{{ $lang['19t'] }}</strong></td>
                                            @endif
                                            @if ($detail['ans_arr'])
                                                <td width="30%" class="border-b py-2">
                                                    <strong>{{ $lang['42t'] }}</strong></td>
                                            @endif
                                            @if ($detail['ansl1_arr'])
                                                <td width="30%" class="border-b py-2">
                                                    <strong>{{ $lang['11t'] }}</strong></td>
                                            @endif
                                            @if ($detail['ansl21_arr'])
                                                <td width="30%" class="border-b py-2">
                                                    <strong>{{ $lang['11t'] }} r1</strong></td>
                                            @endif
                                            @if ($detail['ansl2_arr'])
                                                <td width="30%" class="border-b py-2">
                                                    <strong>{{ $lang['11t'] }} r2</strong></td>
                                            @endif
                                            @if ($detail['overall_time'])
                                                <td width="30%" class="border-b py-2">
                                                    <strong>{{ $lang['44t'] }}</strong></td>
                                            @endif
                                        </tr>
                                        @foreach ($detail['ans_arr'] as $index => $value)
                                            <tr>
                                                @if ($detail['days'])
                                                    <td class="border-b py-2">{{ $detail['days'][$index] }}</td>
                                                @endif
                                                @if ($detail['ans_arr'])
                                                    <td class="border-b py-2">{{ $detail['ans_arr'][$index] }}
                                                    </td>
                                                @endif
                                                @if ($detail['ansl1_arr'])
                                                    <td class="border-b py-2">{{ $detail['ansl1_arr'][$index] }}
                                                    </td>
                                                @endif
                                                @if ($detail['ansl21_arr'])
                                                    <td class="border-b py-2">{{ $detail['ansl21_arr'][$index] }}
                                                    </td>
                                                @endif
                                                @if ($detail['ansl2_arr'])
                                                    <td class="border-b py-2">{{ $detail['ansl2_arr'][$index] }}
                                                    </td>
                                                @endif
                                                @if ($detail['overall_time'])
                                                    <td class="border-b py-2">
                                                        {{ $detail['overall_time'][$index] }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>

                                    @if ($detail['table_selection'] == '2' || $detail['table_selection'] == '3' || $detail['table_selection'] == '4')
                                        <p class="font-s-20 mt-3"><strong>{{ $inputs['naam2'] }}</strong></p>
                                        <table class="w-100">
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['46t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['fromt2'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['37t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['tot2'] }}</td>
                                            </tr>
                                            @if (!empty($detail['sick_timet2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['38t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['sick_timet2'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['total_timet2']))
                                                <tr>
                                                    <td colspan="2" class="border-b py-2">
                                                        {{ $detail['total_timet2'] }}</td>
                                                    {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                                </tr>
                                            @endif
                                            @if (!empty($detail['sick_payt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['39t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ round($detail['sick_payt2']) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['v_timet2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['41t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['v_timet2'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['vacation_payt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['40t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ round($detail['vacation_payt2']) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['regular_timet2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['42t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['regular_timet2'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime2_firstt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['43t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime2_firstt2'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime3_firstt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['44t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime3_firstt2'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime4_firstt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['34t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime4_firstt2'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime5_firstt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['33t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime5_firstt2'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime6_firstt2']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['45t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime6_firstt2'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['total_payt2']))
                                                <tr>
                                                    {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                    <td colspan="2" class="border-b py-2">
                                                        {{ round($detail['total_payt2']) }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                        <table class="w-100 my-3">
                                            <tr>
                                                @if ($detail['dayst2'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['19t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ans_arrt2'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['42t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ansl1_arrt2'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ansl21_arrt2'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }} r1</strong></td>
                                                @endif
                                                @if ($detail['ansl2_arrt2'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }} r2</strong></td>
                                                @endif
                                                @if ($detail['overall_timet2'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['44t'] }}</strong></td>
                                                @endif
                                            </tr>
                                            @foreach ($detail['ans_arrt2'] as $index => $value)
                                                <tr>
                                                    @if ($detail['dayst2'])
                                                        <td class="border-b py-2">{{ $detail['dayst2'][$index] }}
                                                        </td>
                                                    @endif
                                                    @if ($detail['ans_arrt2'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ans_arrt2'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl1_arrt2'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl1_arrt2'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl21_arrt2'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl21_arrt2'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl2_arrt2'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl2_arrt2'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['overall_timet2'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['overall_timet2'][$index] }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif

                                    @if ($detail['table_selection'] == '3' || $detail['table_selection'] == '4')
                                        <p class="font-s-20 mt-3"><strong>{{ $inputs['naam3'] }}</strong></p>
                                        <table class="w-100">
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['46t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['fromt3'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['37t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['tot3'] }}</td>
                                            </tr>
                                            @if (!empty($detail['sick_timet3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['38t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['sick_timet3'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['total_timet3']))
                                                <tr>
                                                    <td colspan="2" class="border-b py-2">
                                                        {{ $detail['total_timet3'] }}</td>
                                                    {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                                </tr>
                                            @endif
                                            @if (!empty($detail['sick_payt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['39t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ round($detail['sick_payt3']) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['v_timet3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['41t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['v_timet3'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['vacation_payt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['40t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ round($detail['vacation_payt3']) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['regular_timet3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['42t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['regular_timet3'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime2_firstt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['43t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime2_firstt3'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime3_firstt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['44t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime3_firstt3'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime4_firstt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['34t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime4_firstt3'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime5_firstt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['33t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime5_firstt3'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime6_firstt3']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['45t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime6_firstt3'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['total_payt3']))
                                                <tr>
                                                    {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                    <td colspan="2" class="border-b py-2">
                                                        {{ round($detail['total_payt3']) }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                        <table class="w-100 my-3">
                                            <tr>
                                                @if ($detail['dayst3'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['19t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ans_arrt3'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['42t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ansl1_arrt3'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ansl21_arrt3'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }} r1</strong></td>
                                                @endif
                                                @if ($detail['ansl2_arrt3'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }} r2</strong></td>
                                                @endif
                                                @if ($detail['overall_timet3'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['44t'] }}</strong></td>
                                                @endif
                                            </tr>
                                            @foreach ($detail['ans_arrt3'] as $index => $value)
                                                <tr>
                                                    @if ($detail['dayst3'])
                                                        <td class="border-b py-2">{{ $detail['dayst3'][$index] }}
                                                        </td>
                                                    @endif
                                                    @if ($detail['ans_arrt3'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ans_arrt3'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl1_arrt3'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl1_arrt3'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl21_arrt3'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl21_arrt3'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl2_arrt3'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl2_arrt3'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['overall_timet3'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['overall_timet3'][$index] }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif

                                    @if ($detail['table_selection'] == '4')
                                        <p class="font-s-20 mt-3"><strong>{{ $inputs['naam4'] }}</strong></p>
                                        <table class="w-100">
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['46t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['fromt4'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['37t'] }} :</strong>
                                                </td>
                                                <td class="border-b py-2">{{ $detail['tot4'] }}</td>
                                            </tr>
                                            @if (!empty($detail['sick_timet4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['38t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['sick_timet4'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['total_timet4']))
                                                <tr>
                                                    <td colspan="2" class="border-b py-2">
                                                        {{ $detail['total_timet4'] }}</td>
                                                    {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                                </tr>
                                            @endif
                                            @if (!empty($detail['sick_payt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['39t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ round($detail['sick_payt4']) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['v_timet4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['41t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['v_timet4'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['vacation_payt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['40t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ round($detail['vacation_payt4']) }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['regular_timet4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['42t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['regular_timet4'] }}</td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime2_firstt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['43t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime2_firstt4'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime3_firstt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['44t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime3_firstt4'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime4_firstt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['34t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime4_firstt4'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime5_firstt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['33t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime5_firstt4'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['overtime6_firstt4']))
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['45t'] }} :</strong>
                                                    </td>
                                                    <td class="border-b py-2">{{ $detail['overtime6_firstt4'] }}
                                                    </td>
                                                </tr>
                                            @endif
                                            @if (!empty($detail['total_payt4']))
                                                <tr>
                                                    {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                    <td colspan="2" class="border-b py-2">
                                                        {{ round($detail['total_payt4']) }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                        <table class="w-100 my-3">
                                            <tr>
                                                @if ($detail['dayst4'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['19t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ans_arrt4'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['42t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ansl1_arrt4'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }}</strong></td>
                                                @endif
                                                @if ($detail['ansl21_arrt4'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }} r1</strong></td>
                                                @endif
                                                @if ($detail['ansl2_arrt4'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['11t'] }} r2</strong></td>
                                                @endif
                                                @if ($detail['overall_timet4'])
                                                    <td width="30%" class="border-b py-2">
                                                        <strong>{{ $lang['44t'] }}</strong></td>
                                                @endif
                                            </tr>
                                            @foreach ($detail['ans_arrt4'] as $index => $value)
                                                <tr>
                                                    @if ($detail['dayst4'])
                                                        <td class="border-b py-2">{{ $detail['dayst4'][$index] }}
                                                        </td>
                                                    @endif
                                                    @if ($detail['ans_arrt4'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ans_arrt4'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl1_arrt4'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl1_arrt4'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl21_arrt4'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl21_arrt4'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['ansl2_arrt4'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['ansl2_arrt4'][$index] }}</td>
                                                    @endif
                                                    @if ($detail['overall_timet4'])
                                                        <td class="border-b py-2">
                                                            {{ $detail['overall_timet4'][$index] }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                @endif
        @endif
</div>
</div>
</div>
<div class="w-full text-center mt-3 mb-5">
    <a href="{{ url()->current() }}/"
        class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3"
        id="">
        @if (app()->getLocale() == 'en')
            RESET
        @else
            {{ $lang['reset'] ?? 'RESET' }}
        @endif
    </a>
</div>
</div>
<space-y-2> </div>

    @endif
    </form>
    @push('calculatorJS')
        <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    @endpush

    </div>
