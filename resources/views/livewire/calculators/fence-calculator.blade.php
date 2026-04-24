<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Left Column: Primary Dimensions -->
                    <div class="space-y-6">
                        
                        <!-- Fence Length & Post Spacing -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="label">{{ $lang['6'] ?? 'Fence Length' }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="f_length" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('fl')">{{ $fl_units }} ▾</label>
                                    @if ($showDropdown === 'fl')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('fl_units', '{{ $name }}')">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="label">{{ $lang['7'] ?? 'Post Spacing' }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="post_space" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('po')">{{ $po_units }} ▾</label>
                                    @if ($showDropdown === 'po')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('po_units', '{{ $name }}')">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Height Configuration -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex flex-wrap gap-4 mb-3">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="drop1" value="2" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">{{ $lang['8'] ?? 'Fence Height' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="drop1" value="1" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">{{ $lang['9'] ?? 'Post Height' }}</span>
                                </label>
                            </div>

                            <div class="w-full sm:w-1/2">
                                <label class="label">
                                    @if ($drop1 == '2') {{ $lang['8'] ?? 'Fence Height' }}
                                    @else {{ $lang['9'] ?? 'Post Height' }}
                                    @endif:
                                </label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model="first" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u1')">{{ $units1 }} ▾</label>
                                    @if ($showDropdown === 'u1')
                                        <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units1', '{{ $name }}')">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Rails Configuration -->
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-sm font-bold text-gray-700 mb-3">{{ $lang['13'] ?? 'Rails' }}</h3>
                            <div class="flex flex-wrap gap-4 mb-3">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="drop2" value="2" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">{{ $lang['14'] ?? 'Rails per Section' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="drop2" value="1" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">{{ $lang['15'] ?? 'Total Rails' }}</span>
                                </label>
                            </div>

                            <div class="w-full sm:w-1/2">
                                <label class="label">
                                    @if ($drop2 == '2') {{ $lang['14'] ?? 'Rails per Section' }}
                                    @else {{ $lang['15'] ?? 'Total Rails' }}
                                    @endif:
                                </label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" wire:model="second" class="input" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Secondary Details -->
                    <div class="space-y-6">
                        
                        <!-- Picket Configuration -->
                        <div class="border border-gray-100 bg-gray-50/50 p-4 rounded-xl">
                            <h3 class="text-sm font-bold text-gray-700 mb-3">{{ $lang['10'] ?? 'Pickets' }}</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="label">{{ $lang['11'] ?? 'Picket Width' }}:</label>
                                    <div class="relative w-full py-2">
                                        <input type="number" step="any" wire:model="p_width" class="input bg-white" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('pw')">{{ $pw_units }} ▾</label>
                                        @if ($showDropdown === 'pw')
                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('pw_units', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="label">{{ $lang['12'] ?? 'Picket Spacing' }}:</label>
                                    <div class="relative w-full py-2">
                                        <input type="number" step="any" wire:model="p_spacing" class="input bg-white" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('ps')">{{ $ps_units }} ▾</label>
                                        @if ($showDropdown === 'ps')
                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('ps_units', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Post Configuration -->
                        <div class="border border-gray-100 bg-gray-50/50 p-4 rounded-xl">
                            <h3 class="text-sm font-bold text-gray-700 mb-3">{{ $lang['17'] ?? 'Posts' }}</h3>
                            <div class="flex flex-wrap gap-4 mb-3">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="drop3" value="1" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">{{ $lang['18'] ?? 'Square Post' }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="drop3" value="2" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">{{ $lang['19'] ?? 'Round Post' }}</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="label">
                                        @if ($drop3 == '1') {{ $lang['20'] ?? 'Post Width' }}
                                        @else {{ $lang['31'] ?? 'Post Diameter' }}
                                        @endif:
                                    </label>
                                    <div class="relative w-full py-2">
                                        <input type="number" step="any" wire:model="third" class="input bg-white" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u3')">{{ $units3 }} ▾</label>
                                        @if ($showDropdown === 'u3')
                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units3', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if ($drop3 == '1')
                                <div>
                                    <label class="label">{{ $lang['21'] ?? 'Post Depth' }}:</label>
                                    <div class="relative w-full py-2">
                                        <input type="number" step="any" wire:model="four" class="input bg-white" />
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-5 z-20" wire:click="toggleOverlay('u4')">{{ $units4 }} ▾</label>
                                        @if ($showDropdown === 'u4')
                                            <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                                @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('units4', '{{ $name }}')">{{ $name }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-8">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr class="border-gray-100">

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="max-w-4xl mx-auto">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="w-full gap-8 mt-5">
                        <!-- Primary Material Count -->
                    <div class="grid grid-cols-12 gap-4 mb-3">
    
                        <!-- Left Column -->
                        <div class="col-span-12 md:col-span-6">
                            <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100 
                                        text-center h-full flex flex-col justify-center items-center">
                                    <h3 class="text-blue-800 text-md uppercase tracking-widest mb-1 font-bold">
                                        {{ $lang['16'] ?? 'Number of Posts' }}
                                    </h3>       
                                    <div class="text-4xl font-black text-blue-900">
                                        {{ number_format($detail['no_post'] ?? 0) }}
                                    </div>
                                </div>
                            </div>
    
                        <!-- Right Column -->
                        <div class="col-span-12 md:col-span-6">
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 overflow-auto">
                                <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">
                                    Material Breakdown
                                </h3>

                                <table class="w-full text-sm">
                                    @isset($detail['no_sections'])
                                    <tr>
                                        <td class="py-2 text-gray-600 font-medium">
                                            {{ $lang['22'] ?? 'Fence Sections' }}
                                        </td>
                                        <td class="py-2 text-right font-bold">
                                                {{ number_format($detail['no_sections']) }}
                                        </td>
                                    </tr>
                                    @endisset

                                    @isset($detail['no_rails'])
                                    <tr class="border-t border-gray-100">
                                        <td class="py-2 text-gray-600 font-medium">
                                            {{ $lang['14'] ?? 'Total Rails' }}
                                        </td>
                                        <td class="py-2 text-right font-bold">
                                            {{ number_format($detail['no_rails']) }}
                                        </td>
                                    </tr>
                                    @endisset

                                    @isset($detail['rails_section'])
                                    <tr class="border-t border-gray-100">
                                        <td class="py-2 text-gray-600 font-medium">
                                            {{ $lang['15'] ?? 'Rails per Section' }}
                                        </td>
                                        <td class="py-2 text-right font-bold">
                                            {{ number_format($detail['rails_section']) }}
                                        </td>
                                    </tr>
                                    @endisset

                                    @isset($detail['no_pickets'])
                                    <tr class="border-t border-gray-100">
                                        <td class="py-2 text-gray-600 font-medium">
                                            {{ $lang['23'] ?? 'Number of Pickets' }}
                                        </td>
                                        <td class="py-2 text-right font-bold">
                                            {{ number_format($detail['no_pickets']) }}
                                        </td>
                                    </tr>
                                    @endisset
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                        <!-- Secondary Volume & Pricing -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 overflow-auto">
                                <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Concrete Required (Post Holes)</h3>
                                <table class="w-full text-sm">
                                    @isset($detail['c_volume'])
                                    <tr>
                                        <td class="py-2 text-gray-600">{{ $lang['24'] ?? 'Cubic Inches' }}</td>
                                        <td class="py-2 text-right font-bold">{{ number_format($detail['c_volume'], 2) }} in³</td>
                                    </tr>
                                    @endisset
                                    @isset($detail['ft_volume'])
                                    <tr class="border-t border-gray-100">
                                        <td class="py-2 text-gray-600">{{ $lang['25'] ?? 'Cubic Feet' }}</td>
                                        <td class="py-2 text-right font-bold">{{ number_format($detail['ft_volume'], 2) }} ft³</td>
                                    </tr>
                                    @endisset
                                    @isset($detail['yd_volume'])
                                    <tr class="border-t border-gray-100">
                                        <td class="py-2 text-gray-600">{{ $lang['26'] ?? 'Cubic Yards' }}</td>
                                        <td class="py-2 text-right font-bold">{{ number_format($detail['yd_volume'], 2) }} yd³</td>
                                    </tr>
                                    @endisset
                                </table>
                            </div>

                            <div class="bg-green-50/50 p-6 rounded-xl border border-green-100">
                                <h3 class="font-bold text-green-800 mb-2">{{ $lang['27'] ?? 'Average Fence Costs' }}</h3>
                                <table class="w-full text-sm">
                                    <tr class="border-b border-green-100/50">
                                        <td class="py-1 text-gray-600">{{ $lang['28'] ?? 'Wire Fence' }}</td>
                                        <td class="py-1 text-right text-green-700 font-semibold">3 {{ $currancy }} - 7 {{ $currancy }}</td>
                                    </tr>
                                    <tr class="border-b border-green-100/50">
                                        <td class="py-1 text-gray-600">{{ $lang['29'] ?? 'Wood Fence' }}</td>
                                        <td class="py-1 text-right text-green-700 font-semibold">18 {{ $currancy }} - 35 {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 text-gray-600">{{ $lang['30'] ?? 'Vinyl Fence' }}</td>
                                        <td class="py-1 text-right text-green-700 font-semibold">25 {{ $currancy }} - 50 {{ $currancy }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
