<div>
    <style>
        .inner_knob {
            width: 120px;
            height: 120px;
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
                <div class="grid grid-cols-12 gap-4">
                    <!-- Cumulative Section -->
                    <div class="col-span-12" x-data="{ open: true }">
                        <div class="border rounded-lg bg-white overflow-hidden">
                            <div class="p-3 flex items-center justify-between cursor-pointer hover:bg-gray-50 transition-colors" @click="open = !open">
                                <strong class="">{{ $lang['14'] }} {{ $lang['4'] }}</strong>
                                <img src="{{ asset('images/angle_down1.png') }}" alt="toggle" width="12" class="transition-transform duration-300" :class="open ? 'rotate' : ''">
                            </div>
                            <div x-show="open" x-transition x-cloak class="p-4 border-t">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class=" text-sm font-bold block mb-1">{{ $lang['3'] }}</label>
                                        <input type="number" step="any" wire:model.live="currentGpa" class="input" placeholder="0.0">
                                    </div>
                                    <div>
                                        <label class=" text-sm font-bold block mb-1">{{ $lang['5'] }}</label>
                                        <input type="number" step="any" wire:model.live="currentCredits" class="input" placeholder="0.0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Calculator Section -->
                    <div class="col-span-12">
                        <div class="border rounded-lg p-4 bg-white space-y-6">
                            <h3 class="text-xl font-bold  border-b pb-2">UC GPA Calculator</h3>

                            <div class="space-y-8">
                                @foreach($semesters as $sIndex => $semester)
                                    <div class="space-y-4" wire:key="semester-{{ $sIndex }}">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-bold text-lg text-blue-800">{{ $lang['semester'] }} {{ $sIndex + 1 }}</h4>
                                            @if(count($semesters) > 1)
                                                <button type="button" wire:click="removeSemester({{ $sIndex }})" class="text-red-500 hover:text-red-700 text-sm font-bold">Remove</button>
                                            @endif
                                        </div>

                                        <div class="grid grid-cols-12 gap-2 text-xs font-bold  uppercase tracking-wider mb-2">
                                            <div class="col-span-4">{{ $lang['course'] }}</div>
                                            <div class="col-span-2">{{ $lang['credit'] }}</div>
                                            <div class="col-span-3">{{ $lang['grade'] }}</div>
                                            <div class="col-span-2">Honors/AP/IB</div>
                                            <div class="col-span-1"></div>
                                        </div>

                                        <div class="space-y-3">
                                            @foreach($semester['courses'] as $cIndex => $course)
                                                <div class="grid grid-cols-12 gap-2 items-center" wire:key="sem-{{ $sIndex }}-course-{{ $cIndex }}">
                                                    <div class="col-span-4">
                                                        <input type="text" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.subject" class="input py-1.5" placeholder="{{ $lang['13'] }}">
                                                    </div>

                                                    <div class="col-span-2">
                                                        <input type="number" step="any" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.credit" class="input py-1.5" placeholder="Credits">
                                                    </div>

                                                    <div class="col-span-3">
                                                        <select wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input py-1.5">
                                                            <option value="" disabled selected>{{ $lang['grade'] }}</option>
                                                            <option value="4.0">A (4.0)</option>
                                                            <option value="3.0">B (3.0)</option>
                                                            <option value="2.0">C (2.0)</option>
                                                            <option value="1.0">D (1.0)</option>
                                                            <option value="0.0">F (0.0)</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-span-2 flex justify-center">
                                                        <input type="checkbox" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.isHonors" class="w-5 h-5 cursor-pointer text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                                    </div>

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
                                            <button type="button" wire:click="addCourse({{ $sIndex }})" class=" font-bold flex items-center hover:underline">
                                                <span class="bg-blue-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs me-2">+</span>
                                                {{ $lang['add_course'] }}
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="pt-6 flex justify-center">
                                <button type="button" wire:click="addSemester" class="bg-blue-50  px-6 py-2 rounded-lg font-bold border border-blue-200 hover:bg-blue-100 transition-colors flex items-center">
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
                        <button type="button" wire:click="resetForm" class="bg-gray-100 text-gray-700 px-10 py-3 rounded-lg font-bold text-xl hover:bg-gray-200 transition-all">
                            Reset
                        </button>
                    @endisset
                </div>
            </div>
        </div>

        @isset($detail)
        <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 space-y-8">
                <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center my-12">
                        <!-- Unweighted -->
                        <div class="flex flex-col items-center">
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-xs mb-6">Unweighted</p>
                            <div class="knob-container gpa_knob">
                                <div class="inner_knob bg-gray-600 text-white">
                                    <p class="text-[25px] font-black">{{ $detail['unweightedGpa'] }}</p>
                                    <p class="text-xs font-bold opacity-80 uppercase mt-1">GPA</p>
                                </div>
                            </div>
                        </div>

                        <!-- Capped (Main) -->
                        <div class="flex flex-col items-center">
                            <p class="text-blue-800 font-bold uppercase tracking-widest text-xs mb-6">Weighted Capped</p>
                            <div class="knob-container gpa_knob scale-125">
                                <div class="inner_knob text-white" style="background-color: {{ $detail['color'] }}">
                                    <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest mb-1">CUMULATIVE</p>
                                    <p class="text-[25px] font-black">{{ $detail['cappedGpa'] }}</p>
                                    <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest mt-1">GPA</p>
                                </div>
                            </div>
                        </div>

                        <!-- Fully Weighted -->
                        <div class="flex flex-col items-center">
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-xs mb-6">Fully Weighted</p>
                            <div class="knob-container gpa_knob">
                                <div class="inner_knob bg-blue-900 text-white">
                                    <p class="text-[25px] font-black">{{ $detail['weightedGpa'] }}</p>
                                    <p class="text-xs font-bold opacity-80 uppercase mt-1">GPA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-4xl mx-auto mt-16">
                        <div class="bg-white p-6 rounded-xl border border-blue-200 text-center">
                            <p class="text-blue-600 text-sm font-bold mb-2">Total Grade Points</p>
                            <p class="text-4xl font-black text-blue-900">{{ $detail['totalGradePoints'] }}</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl border border-blue-200 text-center">
                            <p class="text-blue-600 text-sm font-bold mb-2">Total No. of Credits</p>
                            <p class="text-4xl font-black text-blue-900">{{ $detail['totalCredits'] }}</p>
                        </div>
                    </div>

                    <div class="w-full mt-16 space-y-10">
                        @foreach($detail['semesters'] as $sRes)
                            <div class="bg-white border border-gray-200 overflow-hidden">
                                <div class="bg-blue-700 p-4">
                                    <h4 class="text-white font-black text-lg">{{ $sRes['name'] }}</h4>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-base">
                                        <thead>
                                            <tr class="bg-blue-700 text-white font-bold border-b-2 border-gray-100">
                                                <th class="p-4 border-t border-l text-left">Course</th>
                                                <th class="p-4 border-t border-l">Type</th>
                                                <th class="p-4 border-t border-l">Grade</th>
                                                <th class="p-4 border-t border-l">Credit</th>
                                                <th class="p-4 border-t border-l">Grade Point</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($sRes['courses'] as $cRes)
                                                <tr class="transition-colors hover:bg-blue-50/20">
                                                    <td class="p-2 border-b text-left font-medium text-gray-800">{{ $cRes['subject'] }}</td>
                                                    <td class="p-2 border-b text-center">
                                                        @if($cRes['isHonors'])
                                                            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase">Honors/AP</span>
                                                        @else
                                                            <span class="text-gray-400 text-xs italic">Standard</span>
                                                        @endif
                                                    </td>
                                                    <td class="p-2 border-b text-center font-bold">{{ $cRes['grade'] }}</td>
                                                    <td class="p-2 border-b text-center">{{ $cRes['credit'] }}</td>
                                                    <td class="p-2 border-b text-center font-bold ">{{ $cRes['points'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-gray-50/50 font-bold text-blue-800">
                                            <tr>
                                                <td colspan="3" class="p-2 border-b text-right">Total Credit</td>
                                                <td colspan="2" class="p-2 border-b text-center text-blue-900 font-black text-lg">{{ $sRes['totalCredits'] }}</td>
                                            </tr>
                                            <tr class="border-t border-gray-200">
                                                <td colspan="3" class="p-2 border-b text-right font-black">Semester GPA</td>
                                                <td colspan="2" class="p-2 border-b text-center text-green-700 font-black text-2xl">{{ $sRes['gpa'] }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endisset

        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </form>
</div>
