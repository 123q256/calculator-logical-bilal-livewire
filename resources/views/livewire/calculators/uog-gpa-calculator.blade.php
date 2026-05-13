<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Cumulative GPA Section -->
                    <div class="col-span-12 p-2 border rounded-lg mt-2" x-data="{ open: true }">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 cursor-pointer flex items-center justify-between" @click="open = !open">
                                <strong class="text-blue font-s-18">{{ $lang['14'] }} {{ $lang['4'] }}</strong>
                                <span x-text="open ? '▲' : '▼'" class="text-blue"></span>
                            </div>
                            <div class="col-span-12" x-show="open" x-transition x-cloak>
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                                        <label for="currentGpa" class="text-blue font-s-14">{{ $lang['3'] }}</label>
                                        <input type="number" step="any" min="0" max="5" wire:model.live="currentGpa" id="currentGpa" class="input mt-2" placeholder="0.0">
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                                        <label for="currentCredits" class="text-blue font-s-14">{{ $lang['5'] }}</label>
                                        <input type="number" step="any" min="0" wire:model.live="currentCredits" id="currentCredits" class="input mt-2" placeholder="0.0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grade Format Selector -->
                    <div class="col-span-12">
                        <div class="flex items-center justify-end relative" x-data="{ open: false }">
                            <strong class="text-blue font-s-18 cursor-pointer flex items-center" @click="open = !open">
                                {{ $lang['6'] }}: 
                                <span class="ms-2">
                                    @if($gradeFormat == '1') {{ $lang['7'] }} @elseif($gradeFormat == '2') {{ $lang['8'] }} @else {{ $lang['9'] }} @endif
                                </span>
                                <img src="{{ asset('images/angle_down1.png') }}" class="w-3 h-3 ms-2 transition-transform" :class="open ? 'rotate-180' : ''" alt="dropdown">
                            </strong>
                            
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border rounded-lg shadow-xl top-8 right-0 p-2 w-48" x-cloak>
                                <div class="p-2 border-b font-bold text-blue-700">{{ $lang['6'] }}</div>
                                <div class="p-2 hover:bg-gray-100 cursor-pointer flex items-center" @click="$wire.set('gradeFormat', '1'); open = false">
                                    <img src="{{ asset('images/letter.png') }}" class="w-5 h-5 me-2"> {{ $lang['7'] }}
                                </div>
                                <div class="p-2 hover:bg-gray-100 cursor-pointer flex items-center" @click="$wire.set('gradeFormat', '2'); open = false">
                                    <img src="{{ asset('images/percentage.png') }}" class="w-5 h-5 me-2"> {{ $lang['8'] }}
                                </div>
                                <div class="p-2 hover:bg-gray-100 cursor-pointer flex items-center" @click="$wire.set('gradeFormat', '3'); open = false">
                                    <img src="{{ asset('images/point.png') }}" class="w-5 h-5 me-2"> {{ $lang['9'] }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Semesters List -->
                    <div class="col-span-12 space-y-6">
                        @foreach($semesters as $sIndex => $semester)
                            <div class="border rounded-lg p-4 bg-white shadow-sm relative" wire:key="semester-{{ $sIndex }}">
                                @if(count($semesters) > 1)
                                    <button type="button" wire:click="removeSemester({{ $sIndex }})" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold">
                                        ✕
                                    </button>
                                @endif

                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-blue-700">{{ $lang['semester'] }} {{ $sIndex + 1 }}</h3>
                                </div>

                                <div class="grid grid-cols-12 gap-2 text-blue-700 font-bold mb-2">
                                    <div class="col-span-5 text-sm">{{ $lang['course'] }}</div>
                                    <div class="col-span-3 text-sm">{{ $lang['grade'] }}</div>
                                    <div class="col-span-3 text-sm">{{ $lang['credit'] }}</div>
                                    <div class="col-span-1"></div>
                                </div>

                                <div class="space-y-3">
                                    @foreach($semester['courses'] as $cIndex => $course)
                                        <div class="grid grid-cols-12 gap-2 items-center" wire:key="sem-{{ $sIndex }}-course-{{ $cIndex }}">
                                            <!-- Subject -->
                                            <div class="col-span-5">
                                                <input type="text" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.subject" class="input text-sm" placeholder="{{ $lang['13'] }}">
                                            </div>

                                            <!-- Grade -->
                                            <div class="col-span-3">
                                                @if($gradeFormat == '1')
                                                    <select wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input text-sm">
                                                        <option value="" disabled selected>Grade A-F</option>
                                                        <option value="4.0">A+</option>
                                                        <option value="3.70">A</option>
                                                        <option value="3.40">B+</option>
                                                        <option value="3.00">B</option>
                                                        <option value="2.50">B-</option>
                                                        <option value="2.00">C+</option>
                                                        <option value="1.50">C</option>
                                                        <option value="1.0">D</option>
                                                        <option value="0.0">F</option>
                                                    </select>
                                                @elseif($gradeFormat == '2')
                                                    <input type="number" step="any" min="0" max="100" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input text-sm" placeholder="%">
                                                @else
                                                    <input type="number" step="any" min="0" max="5" wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.grade" class="input text-sm" placeholder="0.0">
                                                @endif
                                            </div>

                                            <!-- Credit -->
                                            <div class="col-span-3">
                                                <select wire:model.live="semesters.{{ $sIndex }}.courses.{{ $cIndex }}.credit" class="input text-sm">
                                                    <option value="" disabled selected>{{ $lang['credit'] }}</option>
                                                    @for($c = 1; $c <= 5; $c += 0.5)
                                                        <option value="{{ $c }}">{{ $c }}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- Remove Course -->
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

                                <div class="mt-4 flex gap-4">
                                    <button type="button" wire:click="addCourse({{ $sIndex }})" class="flex items-center text-blue-700 font-bold hover:underline">
                                        <span class="bg-blue-700 text-white rounded-full w-5 h-5 flex items-center justify-center me-2">+</span>
                                        {{ $lang['add_course'] }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Semester Button -->
                    <div class="col-span-12 flex justify-center mt-4">
                        <button type="button" wire:click="addSemester" class="bg-blue-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-800 transition-colors flex items-center">
                            <span class="text-xl me-2">+</span> {{ $lang['add_semester'] }}
                        </button>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full text-center mt-4">
                                    <div class="bg-[#F6FAFC] rounded-lg p-6 shadow-sm border border-blue-100">
                                        <p class="text-5xl font-bold text-green-700">{{ $detail['cgpa'] }}</p>
                                        <p class="text-xl font-bold text-blue-800 mt-2">{{ $lang['cum'] }}</p>
                                        <p class="text-xl font-bold text-blue-800">{{ $lang['10'] }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-6">
                                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                                        <p class="text-blue-800 font-bold">{{ $lang['total_g'] }}</p>
                                        <p class="text-2xl font-bold text-blue-900">{{ $detail['totalGradePoints'] }}</p>
                                    </div>
                                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                                        <p class="text-blue-800 font-bold">{{ $lang['total_h'] }}</p>
                                        <p class="text-2xl font-bold text-blue-900">{{ $detail['totalCredits'] }}</p>
                                    </div>
                                </div>

                                <div class="mt-8 space-y-6">
                                    @foreach($detail['semesters'] as $sRes)
                                        <div class="space-y-2">
                                            <h4 class="text-lg font-bold text-blue-700">{{ $sRes['name'] }}</h4>
                                            <div class="overflow-x-auto">
                                                <table class="w-full border-collapse">
                                                    <thead>
                                                        <tr class="bg-blue-700 text-white">
                                                            <th class="p-2 border text-left">{{ $lang['course'] }}</th>
                                                            <th class="p-2 border text-center">{{ $lang['grade'] }}</th>
                                                            <th class="p-2 border text-center">{{ $lang['credit'] }}</th>
                                                            <th class="p-2 border text-center">{{ $lang['11'] }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($sRes['courses'] as $cRes)
                                                            <tr class="hover:bg-blue-50">
                                                                <td class="p-2 border text-left">{{ $cRes['subject'] }}</td>
                                                                <td class="p-2 border text-center">{{ $cRes['grade'] }}</td>
                                                                <td class="p-2 border text-center">{{ $cRes['credit'] }}</td>
                                                                <td class="p-2 border text-center font-bold text-blue-700">{{ $cRes['points'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="bg-blue-50">
                                                        <tr>
                                                            <td colspan="2" class="p-2 border font-bold text-blue-800">{{ $lang['12'] }}</td>
                                                            <td colspan="2" class="p-2 border font-bold text-blue-900 text-center">{{ $sRes['totalCredits'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="p-2 border font-bold text-blue-800">{{ $lang['10'] }}</td>
                                                            <td colspan="2" class="p-2 border font-bold text-green-700 text-center">{{ $sRes['gpa'] }}</td>
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
                </div>
            </div>
        @endisset
    </form>
</div>


