<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-x-6 gap-y-4">
                    
                    <!-- Fence Length & Post Spacing -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">{{ $lang['6'] ?? 'Fence Length' }} :</label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="f_length" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('fl')">{{ $fl_units }} ▾</label>
                            @if ($showDropdown === 'fl')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('fl_units', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">{{ $lang['7'] ?? 'Post Space' }} :</label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="post_space" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('po')">{{ $po_units }} ▾</label>
                            @if ($showDropdown === 'po')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('po_units', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Height Configuration -->
                    <div class="col-span-12 border-t border-gray-100 pt-2 mt-2">
                        <div class="flex flex-wrap gap-x-6 gap-y-2 mb-1">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="radio" wire:model.live="drop1" value="2" class="form-radio text-blue-600 focus:ring-blue-500 w-3 h-3">
                                <span class="text-[11px] font-semibold">{{ $lang['8'] ?? 'Fence Height' }}</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="radio" wire:model.live="drop1" value="1" class="form-radio text-blue-600 focus:ring-blue-500 w-3 h-3">
                                <span class="text-[11px] font-semibold">{{ $lang['9'] ?? 'Post height' }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">
                            @if ($drop1 == '2') {{ $lang['8'] ?? 'Fence Height' }}
                            @else {{ $lang['9'] ?? 'Post height' }}
                            @endif :
                        </label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="first" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('u1')">{{ $units1 }} ▾</label>
                            @if ($showDropdown === 'u1')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('units1', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Pickets Configuration -->
                    <div class="col-span-12 border-t border-gray-100 pt-2 mt-2">
                        <h3 class="text-[12px] font-bold text-blue-600 mb-2">{{ $lang['10'] ?? 'Number of pickets needed' }}</h3>
                    </div>
                    
                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">{{ $lang['11'] ?? 'Picket Width' }} :</label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="p_width" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('pw')">{{ $pw_units }} ▾</label>
                            @if ($showDropdown === 'pw')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('pw_units', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">{{ $lang['12'] ?? 'Picket Spacing' }} :</label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="p_spacing" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('ps')">{{ $ps_units }} ▾</label>
                            @if ($showDropdown === 'ps')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('ps_units', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Rails Configuration -->
                    <div class="col-span-12 border-t border-gray-100 pt-2 mt-2">
                        <h3 class="text-[12px] font-bold text-blue-600 mb-2">{{ $lang['13'] ?? 'Number of rails needed' }}</h3>
                        <div class="flex flex-wrap gap-x-6 gap-y-2 mb-1">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="radio" wire:model.live="drop2" value="2" class="form-radio text-blue-600 focus:ring-blue-500 w-3 h-3">
                                <span class="text-[11px] font-semibold">{{ $lang['14'] ?? 'Rails per Section' }}</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="radio" wire:model.live="drop2" value="1" class="form-radio text-blue-600 focus:ring-blue-500 w-3 h-3">
                                <span class="text-[11px] font-semibold">{{ $lang['15'] ?? 'Total Rails' }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">
                            @if ($drop2 == '2') {{ $lang['14'] ?? 'Rails per Section' }}
                            @else {{ $lang['15'] ?? 'Total Rails' }}
                            @endif :
                        </label>
                        <div class="w-full py-1">
                            <input type="number" step="any" wire:model="second" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                        </div>
                    </div>

                    <!-- Post Configuration -->
                    <div class="col-span-12 border-t border-gray-100 pt-2 mt-2">
                        <h3 class="text-[12px] font-bold text-blue-600 mb-2">{{ $lang['17'] ?? 'Concrete for post footing' }}</h3>
                        <div class="flex flex-wrap gap-x-6 gap-y-2 mb-1">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="radio" wire:model.live="drop3" value="1" class="form-radio text-blue-600 focus:ring-blue-500 w-3 h-3">
                                <span class="text-[11px] font-semibold">{{ $lang['18'] ?? 'Concrete for Cuboid Shape' }}</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="radio" wire:model.live="drop3" value="2" class="form-radio text-blue-600 focus:ring-blue-500 w-3 h-3">
                                <span class="text-[11px] font-semibold">{{ $lang['19'] ?? 'Concrete for Cylindrical Shape' }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">
                            @if ($drop3 == '1') {{ $lang['20'] ?? 'Post Width' }}
                            @else {{ $lang['31'] ?? 'Post Diameter' }}
                            @endif :
                        </label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="third" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('u3')">{{ $units3 }} ▾</label>
                            @if ($showDropdown === 'u3')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('units3', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($drop3 == '1')
                    <div class="col-span-12 md:col-span-6">
                        <label class="label !text-[11px] !mb-0 font-bold">{{ $lang['21'] ?? 'Post Thickness' }} :</label>
                        <div class="relative w-full py-1">
                            <input type="number" step="any" wire:model="four" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" />
                            <label class="absolute cursor-pointer text-[10px] underline right-6 top-5 z-20 font-medium" wire:click="toggleOverlay('u4')">{{ $units4 }} ▾</label>
                            @if ($showDropdown === 'u4')
                                <div class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (["in","ft","cm","m","yd","mi","km"] as $name)
                                        <p class="p-2 cursor-pointer text-sm" wire:click="setUnit('units4', '{{ $name }}')">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
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

        <hr>

          @isset($detail)
    <div  id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full my-2">
                            <div class="col-lg-8 font-s-18">
                                <div class="lg:w-[80%] w-full pverflow-auto">
                                <table class="w-100">
                                    @if ($detail['no_post'])
                                        <tr>
                                            <td width="70%" class="border-b py-2"><strong> {{$lang['16']}}</strong></td>
                                            <td class="border-b py-2">{{ $detail['no_post']}} 
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($detail['no_sections'])
                                    <tr class="rounded-top bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['22']}}</td>
                                        <td class="border-b py-2">{{ $detail['no_sections'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['post_heigth']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['8']}}</td>
                                        <td class="border-b py-2">{{ $detail['post_heigth'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['fence_heigth']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['9']}}</td>
                                        <td class="border-b py-2">{{ $detail['fence_heigth'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['no_rails']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['14']}}</td>
                                        <td class="border-b py-2">{{ $detail['no_rails'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['rails_section']))
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['15']}}</td>
                                        <td class="border-b py-2">{{ $detail['rails_section'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['no_pickets'])) 
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['23']}}</td>
                                        <td class="border-b py-2">{{ $detail['no_pickets'] }}</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['c_volume']))
                                    <tr class="rounded-bottom bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['24']}}</td>
                                        <td class="border-b py-2">{{ $detail['c_volume'] }} in³</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['ft_volume']))
                                    <tr class="rounded-bottom bg-body-secondary bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['25']}}</td>
                                        <td class="border-b py-2">{{ $detail['ft_volume'] }} ft³</td>
                                    </tr>
                                    @endif
                                    @if (!empty($detail['yd_volume']))
                                    <tr class="rounded-bottom bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['26']}}</td>
                                        <td class="border-b py-2">{{ $detail['yd_volume'] }} yd³</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                                <p class="mt-3 mb-2">{{$lang['27']}}</p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">

                                <table class="w-100">
                                    <tr class="rounded-top bg-light bg-opacity-50">
                                        <td width="70%" class="border-b py-2">{{$lang['28']}}</td>
                                        <td class="border-b py-2"> 3 {{$currancy}} - 7 {{$currancy}} </td>
                                    </tr>
                                    <tr class="bg-body-secondary bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['29']}}</td>
                                        <td class="border-b py-2">18 {{$currancy}} - 35 {{$currancy}}</td>
                                    </tr>
                                    <tr class="bg-light bg-opacity-50">
                                        <td class="border-b py-2">{{$lang['30']}}</td>
                                        <td class="border-b py-2">25 {{$currancy}} - 50 {{$currancy}}</td>
                                    </tr>
                                </table>
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
