<div>
    <style>
        .gpa_knob {
            width: 210px;
            height: 210px;
            margin: 0px auto;
            border-radius: 100%;
            padding-top: 10px;
            position: relative;
            background-color: #eaf5fa85;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .inner_knob, .inner_knob1 {
            width: 180px;
            height: 180px;
            border-radius: 100%;
            margin: 0px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }
        
        .rotate {
            transform: rotate(180deg);
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mt-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <!-- Mode Selector -->
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full mb-6">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="$set('mode', '1')" class="px-3 py-2 cursor-pointer rounded-md transition-all duration-300 {{ $mode == '1' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50 text-blue-700' }}">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="$set('mode', '2')" class="px-3 py-2 cursor-pointer rounded-md transition-all duration-300 {{ $mode == '2' ? 'bg-[#2845F5] text-white' : 'bg-white hover:bg-blue-50 text-blue-700' }}">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <!-- Cumulative GPA Section -->
                    <div class="col-span-12" x-data="{ open: false }">
                        <div class="border rounded-lg bg-white overflow-hidden ">
                            <div class="p-3 flex items-center justify-between cursor-pointer hover:bg-gray-50 transition-colors" @click="open = !open">
                                <strong class="text-blue-700">{{ $lang['26'] }} {{ $lang['4'] }}</strong>
                                <img src="{{ asset('images/angle_down1.png') }}" alt="toggle" width="12" class="transition-transform duration-300" :class="open ? 'rotate' : ''">
                            </div>
                            <div x-show="open" x-transition x-cloak class="p-4 border-t bg-blue-50/30">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-blue-700 text-sm font-bold block mb-1">{{ $lang['3'] }}</label>
                                        <input type="number" step="any" wire:model.live="currentGpa" class="input" placeholder="0.0">
                                    </div>
                                    <div>
                                        <label class="text-blue-700 text-sm font-bold block mb-1">{{ $lang['5'] }}</label>
                                        <input type="number" step="any" wire:model.live="currentCredits" class="input" placeholder="0.0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main GPA Calculator -->
                    <div class="col-span-12">
                        <div class="border rounded-lg p-4 bg-white  space-y-6">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-xl font-bold text-blue-700">GPA Calculator</h3>
                                </div>
                                
                                <!-- Grade Format Selector -->
                                <div class="flex items-center gap-2" x-data="{ open: false }">
                                    <strong class="text-sm text-gray-600">Grade Format:</strong>
                                    <div class="relative">
                                        <button type="button" @click="open = !open" class="flex items-center gap-2 bg-blue-50 px-3 py-1.5 rounded border border-blue-200 text-blue-700 font-bold hover:bg-blue-100 transition-colors">
                                            <span class="grade_text">@if($gradeFormat == '1') Letter @elseif($gradeFormat == '2') Percentage @else Point Value @endif</span>
                                            <img src="{{ asset('images/angle_down1.png') }}" alt="arrow" width="10" :class="open ? 'rotate' : ''">
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white border rounded  z-50">
                                            <div wire:click="$set('gradeFormat', '1'); open = false" class="p-3 hover:bg-blue-50 cursor-pointer border-b flex items-center gap-2">
                                                <img src="{{ asset('images/letter.png') }}" class="w-5 h-5 opacity-70"> Letter
                                            </div>
                                            <div wire:click="$set('gradeFormat', '2'); open = false" class="p-3 hover:bg-blue-50 cursor-pointer border-b flex items-center gap-2">
                                                <img src="{{ asset('images/percentage.png') }}" class="w-5 h-5 opacity-70"> Percentage
                                            </div>
                                            <div wire:click="$set('gradeFormat', '3'); open = false" class="p-3 hover:bg-blue-50 cursor-pointer flex items-center gap-2">
                                                <img src="{{ asset('images/point.png') }}" class="w-5 h-5 opacity-70"> Point Value
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-8">
                                @foreach($semesters as $sIndex => $semester)
                                    <div class="space-y-4" wire:key="semester-{{ $sIndex }}">
                                        <div class="flex items-center justify-between border-b pb-2">
                                            <h4 class="font-bold text-lg text-blue-800">Semester {{ $sIndex + 1 }}</h4>
                                            @if(count($semesters) > 1)
                                                <button type="button" wire:click="removeSemester({{ $sIndex }})" class="text-red-500 hover:text-red-700 text-sm font-bold">Remove Semester</button>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-12 gap-2 text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">
                                            <div class="col-span-4">{{ $lang['course'] }}</div>
                                            <div class="col-span-2">{{ $lang['credit'] }}</div>
                                            <div class="col-span-3">{{ $lang['grade'] }}</div>
                                            @if($mode == '1') <div class="col-span-2">{{ $lang['14'] }}</div> @endif
                                            <div class="col-span-1"></div>
                                        </div>

                                        <div class="space-y-3">
                                            @foreach($semester['courses'] as $cIndex => $course)
                                                <div class="grid grid-cols-12 gap-2 items-center" wire:key="sem-{{ $sIndex }}-course-{{ $cIndex }}">
                                                    <div class="col-span-4">
                                                        <input type="text" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.subject" class="input py-1.5" placeholder="{{ $lang['13'] }}">
                                                    </div>

                                                    <div class="col-span-2">
                                                        <select wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.credit" class="input py-1.5">
                                                            <option value="" disabled selected>{{ $lang['credit'] }}</option>
                                                            @foreach(['1', '1.5', '2', '2.5', '3', '3.5', '4', '4.5', '5'] as $cr)
                                                                <option value="{{ $cr }}">{{ $cr }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-span-3">
                                                        @if($gradeFormat == '1')
                                                            <select wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input py-1.5">
                                                                <option value="" disabled selected>{{ $lang['grade'] }}</option>
                                                                <option value="4.0">A+</option>
                                                                <option value="4.0">A</option>
                                                                <option value="3.7">A-</option>
                                                                <option value="3.3">B+</option>
                                                                <option value="3.0">B</option>
                                                                <option value="2.7">B-</option>
                                                                <option value="2.3">C+</option>
                                                                <option value="2.0">C</option>
                                                                <option value="1.7">C-</option>
                                                                <option value="1.3">D+</option>
                                                                <option value="1.0">D</option>
                                                                <option value="0.7">D-</option>
                                                                <option value="0.0">F</option>
                                                            </select>
                                                        @elseif($gradeFormat == '2')
                                                            <input type="number" step="any" min="0" max="100" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input py-1.5" placeholder="0-100%">
                                                        @else
                                                            <input type="number" step="any" min="0" max="5" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input py-1.5" placeholder="0.0">
                                                        @endif
                                                    </div>

                                                    @if($mode == '1')
                                                        <div class="col-span-2">
                                                            <select wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.weight" class="input py-1.5">
                                                                <option value="0.0">Regular</option>
                                                                <option value="0.5">Honors</option>
                                                                <option value="1.0">AP/IB</option>
                                                            </select>
                                                        </div>
                                                    @endif

                                                    <div class="col-span-1 flex justify-center">
                                                        @if(count($semester['courses']) > 1)
                                                            <button type="button" wire:click="removeCourse({{ $sIndex }}, {{ $cIndex }})" class="text-gray-400 hover:text-red-500">
                                                                <img src="{{ asset('images/close.png') }}" class="w-4 h-4" alt="remove">
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="pt-2">
                                            <button type="button" wire:click="addCourse({{ $sIndex }})" class="text-blue-700 font-bold flex items-center hover:underline">
                                                <span class="bg-blue-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs me-2">+</span>
                                                {{ $lang['add_course'] }}
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="pt-4 flex justify-center">
                                <button type="button" wire:click="addSemester" class="bg-blue-50 text-blue-700 px-6 py-2 rounded-lg font-bold border border-blue-200 hover:bg-blue-100 transition-colors flex items-center">
                                    <span class="text-xl me-2">+</span> {{ $lang['add_semester'] }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-4 mt-8">
                    <button type="submit" class="bg-[#2845F5] text-white px-10 py-3 rounded-lg font-bold text-xl hover:bg-blue-800 transition-all">
                        {{ $lang['calculate'] }}
                    </button>
                    @isset($detail)
                        <button type="button" wire:click="resetCalculator" class="bg-gray-100 text-gray-700 px-10 py-3 rounded-lg font-bold text-xl hover:bg-gray-200 transition-all">
                            Reset
                        </button>
                    @endisset
                </div>
            </div>
        </div>

        <!-- Standard Result Section -->
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 space-y-6">
                <div class=" ">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif

                    <div class="flex flex-col items-center mt-5" >
                        <div class="">
                            <div class="inner_knob text-white " style="background-color: {{ $detail['color'] }}">
                                <p class="text-xs font-bold opacity-80 uppercase tracking-widest mb-1">{{ $lang['cum'] }}</p>
                                <p class="text-4xl font-black">{{ $detail['cgpa'] }}</p>
                                <p class="text-xs font-bold opacity-80 uppercase tracking-widest mt-1">{{ $lang['10'] }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 w-full max-w-md mt-10">
                            <div class="bg-white p-4 rounded-xl  border border-blue-100 text-center">
                                <p class="text-blue-600 text-sm font-bold mb-1">{{ $lang['total_g'] }}</p>
                                <p class="text-2xl font-black text-blue-900">{{ $detail['totalGradePoints'] }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-xl  border border-blue-100 text-center">
                                <p class="text-blue-600 text-sm font-bold mb-1">{{ $lang['total_h'] }}</p>
                                <p class="text-2xl font-black text-blue-900">{{ $detail['totalCredits'] }}</p>
                            </div>
                        </div>

                        <div class="w-full mt-12 space-y-8">
                            @foreach($detail['semesters'] as $sRes)
                                <div class="bg-white  border border-gray-100 overflow-hidden">
                                    <div class="bg-blue-700 p-3">
                                        <h4 class="text-white font-bold">{{ $sRes['name'] }}</h4>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-sm">
                                            <thead>
                                                <tr class="bg-gray-50 text-blue-700 font-bold border-b">
                                                    <th class="p-3 text-left">{{ $lang['course'] }}</th>
                                                    <th class="p-3 text-center">{{ $lang['grade'] }}</th>
                                                    <th class="p-3 text-center">{{ $lang['credit'] }}</th>
                                                    <th class="p-3 text-center">{{ $lang['11'] }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y">
                                                @foreach($sRes['courses'] as $cRes)
                                                    <tr class="hover:bg-blue-50/30 transition-colors">
                                                        <td class="p-3 text-left font-medium">{{ $cRes['subject'] }}</td>
                                                        <td class="p-3 text-center">{{ $cRes['grade'] }}</td>
                                                        <td class="p-3 text-center">{{ $cRes['credit'] }}</td>
                                                        <td class="p-3 text-center font-bold text-blue-700">{{ $cRes['points'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="bg-gray-50 font-bold text-blue-800">
                                                <tr>
                                                    <td colspan="2" class="p-3 text-right">{{ $lang['12'] }}</td>
                                                    <td colspan="2" class="p-3 text-center text-blue-900">{{ $sRes['totalCredits'] }}</td>
                                                </tr>
                                                <tr class="border-t border-gray-200">
                                                    <td colspan="2" class="p-3 text-right">{{ $lang['10'] }}</td>
                                                    <td colspan="2" class="p-3 text-center text-green-700 text-lg">{{ $sRes['gpa'] }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        <!-- GPA Planning Section -->
          <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
        <div class="w-full mx-auto p-6 lg:p-10 bg-[#F6FAFC] border mb-5">
            <div class="text-center space-y-2 mb-8">
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight">{{ $lang['25'] }}</h2>
                <p class="text-gray-600 text-sm font-medium px-4 lg:px-20">{{ $lang['20'] }}</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 gap-x-8 gap-y-6">
                <div class="space-y-1">
                    <label class="text-gray-800 text-sm font-bold block mb-2">Current GPA:</label>
                    <input type="number" step="any" wire:model.live="pGpa" class="input border-blue-500 rounded-xl" placeholder="0.0">
                </div>
                <div class="space-y-1">
                    <label class="text-gray-800 text-sm font-bold block mb-2">Credits Completed:</label>
                    <input type="number" step="any" wire:model.live="pHours" class="input border-blue-500 rounded-xl" placeholder="0.0">
                </div>
                <div class="space-y-1">
                    <label class="text-gray-800 text-sm font-bold block mb-2">Target GPA:</label>
                    <input type="number" step="any" wire:model.live="tGpa" class="input border-blue-500 rounded-xl" placeholder="0.0">
                </div>
                <div class="space-y-1">
                    <label class="text-gray-800 text-sm font-bold block mb-2">Additional Credits:</label>
                    <input type="number" step="any" wire:model.live="tHours" class="input border-blue-500 rounded-xl" placeholder="0.0">
                </div>
            </div>

            <div class="flex flex-wrap justify-center md:justify-start items-center gap-4 max-w-4xl mx-auto pt-8">
                <button type="button" wire:click="calculatePlanning" class="bg-[#2845F5] text-white px-8 py-2.5 rounded-lg font-bold hover:bg-blue-800 transition-all">
                    Calculate
                </button>
                @isset($planningDetail)
                    <button type="button" wire:click="resetPlanning" class="bg-gray-100 text-gray-700 px-8 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition-all">
                        Reset
                    </button>
                @endisset
            </div>

            @isset($planningDetail)
                <div id="planning-result-section" class="mt-10 pt-10 border-t border-gray-300">
                    <div class="">
                            @if ($type == 'calculator')
                                @include('inc.copy-pdf')
                            @endif

                        <div class="flex flex-col items-center mt-5">
                            <p class="text-center text-lg text-gray-800 leading-relaxed font-medium mb-10 max-w-2xl">
                                If you want to attain a target GPA <b class="text-blue-700">{{ $planningDetail['tGpa'] }}</b>, then the GPA for the next <b class="text-blue-700">{{ $planningDetail['tHours'] }}</b> credits you needs to be <b class="text-blue-700">{{ $planningDetail['requiredGpa'] }}</b> or higher.
                            </p>

                            <div class="">
                                <div class="inner_knob1 text-white " style="background-color: {{ $planningDetail['color'] }}">
                                    <p class="text-xs font-bold opacity-80 uppercase tracking-widest mb-1">Result</p>
                                    <p class="text-3xl font-black">{{ $planningDetail['requiredGpa'] }}</p>
                                    <p class="text-xs font-bold opacity-80 uppercase tracking-widest mt-1">GPA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
        </div>

        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </form>
</div>
