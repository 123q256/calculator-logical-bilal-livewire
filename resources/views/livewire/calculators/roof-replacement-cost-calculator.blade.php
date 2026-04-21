<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="size1" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Length' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model="size1" id="size1" class="input" />
                            <span class="input_unit text-blue">ft</span>
                        </div>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="size2" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Width' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model="size2" id="size2" class="input" />
                            <span class="input_unit text-blue">ft</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2 relative">
                        <label for="slop" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Slope' }}:</label>
                        <select class="input" wire:model="slop" id="slop">
                            @php
                                $slop_names = [($lang['2'] ?? 'Flat (0:12)'), ($lang['5'] ?? '3:12'), ($lang['6'] ?? '5:12'), ($lang['7'] ?? '7:12'), ($lang['8'] ?? '9:12'), ($lang['9'] ?? '10:12'), ($lang['10'] ?? '12:12')];
                                $slop_vals = ["zero", "three", "five", "seven", "nine", "ten", "twelve"];
                            @endphp
                            @foreach ($slop_vals as $index => $val)
                                <option value="{{ $val }}">{{ $slop_names[$index] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="difficulty" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Difficulty' }}:</label>
                        <select class="input" wire:model="difficulty" id="difficulty">
                            @php
                                $diff_names = [($lang['12'] ?? 'Simple'), ($lang['13'] ?? 'Medium'), ($lang['14'] ?? 'Difficult')];
                                $diff_vals = ["Simple", "Medium", "Difficult"];
                            @endphp
                            @foreach ($diff_vals as $index => $val)
                                <option value="{{ $val }}">{{ $diff_names[$index] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="existing" class="font-s-14 text-blue">{{ $lang['15'] ?? 'Existing Layers' }}:</label>
                        <select class="input" wire:model="existing" id="existing">
                            <option value="yes">YES - 1 layer</option>
                            <option value="yes2">YES - 2 layers</option>
                            <option value="no">NO tear-off</option>
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="floor" class="font-s-14 text-blue">{{ $lang['16'] ?? 'Stories' }}:</label>
                        <select class="input" wire:model="floor" id="floor">
                            <option value="1">{{ $lang['17'] ?? '1 story' }}</option>
                            <option value="2">{{ $lang['18'] ?? '2 stories' }}</option>
                            <option value="3">{{ $lang['19'] ?? '3 stories' }}</option>
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="material" class="font-s-14 text-blue">{{ $lang['20'] ?? 'Material' }}:</label>
                        <select class="input" wire:model="material" id="material">
                            @php
                                $mat_names = [($lang['21'] ?? 'Basic Shingles'), ($lang['22'] ?? 'Architectural'), ($lang['23'] ?? 'Wood Shingles'), ($lang['24'] ?? 'Metal (Basic)'), ($lang['25'] ?? 'Standing Seam'), ($lang['26'] ?? 'Clay Tile'), ($lang['27'] ?? 'Slate'), ($lang['28'] ?? 'Concrete'), ($lang['29'] ?? 'EPDM'), ($lang['30'] ?? 'TPO')];
                                $mat_vals = ["0", "1", "11", "4", "5", "6", "7", "12", "13", "14"];
                            @endphp
                            @foreach ($mat_vals as $index => $val)
                                <option value="{{ $val }}">{{ $mat_names[$index] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="region" class="font-s-14 text-blue">{{ $lang['31'] ?? 'Region' }}:</label>
                        <select class="input" wire:model="region" id="region">
                            @php
                                $reg_names = [($lang['32'] ?? 'National'), ($lang['33'] ?? 'New England'), ($lang['34'] ?? 'Mid-Atlantic'), ($lang['35'] ?? 'South Atlantic'), ($lang['36'] ?? 'E.S. Central'), ($lang['37'] ?? 'W.S. Central'), ($lang['38'] ?? 'E.N. Central'), ($lang['39'] ?? 'W.N. Central'), ($lang['40'] ?? 'Mountain'), ($lang['41'] ?? 'Pacific')];
                                $reg_vals = ["na", "ne", "ma", "sa", "esc", "wsc", "enc", "wnc", "m", "p"];
                            @endphp
                            @foreach ($reg_vals as $index => $val)
                                <option value="{{ $val }}">{{ $reg_names[$index] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full mt-2">
                                <div class="grid lg:grid-cols-1 md:grid-cols-1 grid-cols-1 font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-4"><strong>{{ $lang['42'] ?? 'Low Estimate' }} :</strong></td>
                                            <td class="border-b py-4 text-xl font-bold text-green-600">{{ $detail['result'][0] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-4"><strong>{{ $lang['43'] ?? 'Mid Estimate' }} :</strong></td>
                                            <td class="border-b py-4 text-xl font-bold text-blue-600">{{ $detail['result'][1] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-4"><strong>{{ $lang['44'] ?? 'High Estimate' }} :</strong></td>
                                            <td class="border-b py-4 text-xl font-bold text-red-600">{{ $detail['result'][2] ?? 'N/A' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
