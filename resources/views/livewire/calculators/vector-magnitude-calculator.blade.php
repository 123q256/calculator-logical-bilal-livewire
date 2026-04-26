<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    {{-- Dimension Selection --}}
                    <div class="col-span-6">
                        <label for="dem" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="dem" id="dem" class="input">
                                <option value="2">2-D</option>
                                <option value="3">3-D</option>
                                <option value="4">4-D</option>
                                <option value="5">5-D</option>
                            </select>
                        </div>
                    </div>

                    {{-- Representation Selection --}}
                    <div class="col-span-6">
                        <label for="a_rep" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="a_rep" id="a_rep" class="input">
                                <option value="coor">{{ $lang['3'] }}</option>
                                <option value="point">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Coordinate Inputs --}}
                    @if ($a_rep === 'coor')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-4">
                                <div class="col-span-6">
                                    <label for="ax" class="font-s-14 text-blue">x</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="ax" class="input"
                                            placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="ay" class="font-s-14 text-blue">y</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="ay" class="input"
                                            placeholder="00" />
                                    </div>
                                </div>
                                @if ($dem >= 3)
                                    <div class="col-span-6">
                                        <label for="az" class="font-s-14 text-blue">z</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="az" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                                @if ($dem >= 4)
                                    <div class="col-span-6">
                                        <label for="w" class="font-s-14 text-blue">w</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="w" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                                @if ($dem >= 5)
                                    <div class="col-span-6">
                                        <label for="t" class="font-s-14 text-blue">t</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="t" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        {{-- Point Inputs --}}
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-4">
                                <p class="col-span-12"><strong>{{ $lang['5'] }} (A):</strong></p>
                                <div class="col-span-6">
                                    <label for="a1" class="font-s-14 text-blue">x</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="a1" class="input"
                                            placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="a2" class="font-s-14 text-blue">y</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="a2" class="input"
                                            placeholder="00" />
                                    </div>
                                </div>
                                @if ($dem >= 3)
                                    <div class="col-span-6">
                                        <label for="a3" class="font-s-14 text-blue">z</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="a3" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                                @if ($dem >= 4)
                                    <div class="col-span-6">
                                        <label for="a4" class="font-s-14 text-blue">w</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="a4" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                                @if ($dem >= 5)
                                    <div class="col-span-6">
                                        <label for="a5" class="font-s-14 text-blue">t</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="a5" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif

                                <p class="col-span-12 mt-4"><strong>{{ $lang['5'] }} (B):</strong></p>
                                <div class="col-span-6">
                                    <label for="b1" class="font-s-14 text-blue">x</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="b1" class="input"
                                            placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="b2" class="font-s-14 text-blue">y</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="b2" class="input"
                                            placeholder="00" />
                                    </div>
                                </div>
                                @if ($dem >= 3)
                                    <div class="col-span-6">
                                        <label for="b3" class="font-s-14 text-blue">z</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="b3" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                                @if ($dem >= 4)
                                    <div class="col-span-6">
                                        <label for="b4" class="font-s-14 text-blue">w</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="b4" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                                @if ($dem >= 5)
                                    <div class="col-span-6">
                                        <label for="b5" class="font-s-14 text-blue">t</label>
                                        <div class="w-full py-2">
                                            <input type="number" step="any" wire:model.live="b5" class="input"
                                                placeholder="00" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
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
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-[20px] overflow-x-auto">
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                            <td class="py-2 border-b"> {{ $detail['mag'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-4">{{ $lang['8'] }}:</p>
                                <div class="mt-2" wire:ignore wire:key="steps-{{ md5(json_encode($detail)) }}">
                                    <div class="overflow-x-auto">
                                    <p class="mt-2"><strong>{{ $lang['9'] }}: \( |\vec v| =
                                            \sqrt{\sum\limits_{i=1}^{n} |x_i|^2}\) ,
                                            {{ $lang['10'] }} \(x_i , i= 1....n\) {{ $lang['11'] }}.</strong></p>

                                    @if ($a_rep === 'coor')
                                        <p class="mt-4">{{ $lang['12'] }}:</p>
                                        @if ($dem == '2')
                                            <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 +
                                                ({{ $ay }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} +
                                                {{ pow($ay, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                                        @elseif ($dem == '3')
                                            <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2 + a_z^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                                ({{ $az }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} +
                                                {{ pow($ay, 2) }} +
                                                {{ pow($az, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                                        @elseif ($dem == '4')
                                            <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2 + a_z^2 + a_w^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                                ({{ $az }})^2 + ({{ $w }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} +
                                                {{ pow($ay, 2) }} +
                                                {{ pow($az, 2) }} + {{ pow($w, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                                        @elseif ($dem == '5')
                                            <p class="mt-2">\[ |\vec v| = \sqrt{a_x^2 + a_y^2 + a_z^2 + a_w^2 + a_t^2}\]
                                            </p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{({{ $ax }})^2 + ({{ $ay }})^2 +
                                                ({{ $az }})^2 + ({{ $w }})^2 + ({{ $t }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec v| = \sqrt{ {{ pow($ax, 2) }} +
                                                {{ pow($ay, 2) }} +
                                                {{ pow($az, 2) }} + {{ pow($w, 2) }} + {{ pow($t, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec v| = {{ $detail['mag'] }}\]</p>
                                        @endif
                                    @else
                                        <p class="mt-4">{{ $lang['13'] }}:</p>
                                        @if ($dem == '2')
                                            @php
                                                $v_x = $b1 - $a1;
                                                $v_y = $b2 - $a2;
                                            @endphp
                                            <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{ {{ $b1 }} - ({{ $a1 }}),{{ $b2 }} -
                                                ({{ $a2 }})\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{ {{ $v_x }},{{ $v_y }}\}\]</p>
                                            <p class="mt-4">{{ $lang['12'] }}:</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $v_x }})^2 +
                                                ({{ $v_y }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($v_x, 2) }} +
                                                {{ pow($v_y, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                                        @elseif ($dem == '3')
                                            @php
                                                $v_x = $b1 - $a1;
                                                $v_y = $b2 - $a2;
                                                $v_z = $b3 - $a3;
                                            @endphp
                                            <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y,B_z - A_z\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{ {{ $b1 }} - ({{ $a1 }}),{{ $b2 }} -
                                                ({{ $a2 }}),{{ $b3 }} - ({{ $a3 }})\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{ {{ $v_x }},{{ $v_y }},{{ $v_z }}\}\]</p>
                                            <p class="mt-4">{{ $lang['12'] }}:</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2 + AB_z^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $v_x }})^2 + ({{ $v_y }})^2 +
                                                ({{ $v_z }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($v_x, 2) }} +
                                                {{ pow($v_y, 2) }} + {{ pow($v_z, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                                        @elseif ($dem == '4')
                                            @php
                                                $v_x = $b1 - $a1;
                                                $v_y = $b2 - $a2;
                                                $v_z = $b3 - $a3;
                                                $v_w = $b4 - $a4;
                                            @endphp
                                            <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y,B_z - A_z,B_w - A_w\}\]
                                            </p>
                                            <p class="mt-2">\[ \vec{AB} = \{ {{ $b1 }} - ({{ $a1 }}),{{ $b2 }} -
                                                ({{ $a2 }}),{{ $b3 }} - ({{ $a3 }}),{{ $b4 }} -
                                                ({{ $a4 }})\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{
                                                {{ $v_x }},{{ $v_y }},{{ $v_z }},{{ $v_w }}\}\]</p>
                                            <p class="mt-4">{{ $lang['12'] }}:</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2 + AB_z^2 +
                                                AB_w^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $v_x }})^2 + ({{ $v_y }})^2 +
                                                ({{ $v_z }})^2 + ({{ $v_w }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($v_x, 2) }} +
                                                {{ pow($v_y, 2) }} + {{ pow($v_z, 2) }} + {{ pow($v_w, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                                        @elseif ($dem == '5')
                                            @php
                                                $v_x = $b1 - $a1;
                                                $v_y = $b2 - $a2;
                                                $v_z = $b3 - $a3;
                                                $v_w = $b4 - $a4;
                                                $v_t = $b5 - $a5;
                                            @endphp
                                            <p class="mt-2">\[ \vec{AB} = \{B_x - A_x,B_y - A_y,B_z - A_z,B_w - A_w,B_t -
                                                A_t\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{ {{ $b1 }} - ({{ $a1 }}),{{ $b2 }} -
                                                ({{ $a2 }}),{{ $b3 }} - ({{ $a3 }}),{{ $b4 }} -
                                                ({{ $a4 }}),{{ $b5 }} - ({{ $a5 }})\}\]</p>
                                            <p class="mt-2">\[ \vec{AB} = \{
                                                {{ $v_x }},{{ $v_y }},{{ $v_z }},{{ $v_w }},{{ $v_t }}\}\]
                                            </p>
                                            <p class="mt-4">{{ $lang['12'] }}:</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{AB_x^2 + AB_y^2 + AB_z^2 + AB_w^2 +
                                                AB_t^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{({{ $v_x }})^2 + ({{ $v_y }})^2 +
                                                ({{ $v_z }})^2 + ({{ $v_w }})^2 + ({{ $v_t }})^2}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = \sqrt{ {{ pow($v_x, 2) }} +
                                                {{ pow($v_y, 2) }} + {{ pow($v_z, 2) }} + {{ pow($v_w, 2) }} +
                                                {{ pow($v_t, 2) }}}\]</p>
                                            <p class="mt-2">\[ |\vec{AB}| = {{ $detail['mag'] }}\]</p>
                                            @endif
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
