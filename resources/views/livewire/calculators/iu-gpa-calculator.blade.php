<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <!-- Cumulative GPA Section -->
                    <div class="col-span-12" x-data="{ open: true }">
                        <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 cursor-pointer flex items-center justify-between bg-white p-3 rounded-lg border" @click="open = !open">
                                <strong class="text-blue font-s-18">{{ $lang['6'] }} {{ $lang['4'] }}</strong>
                                <span x-text="open ? '▲' : '▼'" class="text-blue"></span>
                            </div>
                            <div class="col-span-12" x-show="open" x-transition x-cloak>
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mt-2">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="currentGpa" class="text-blue font-s-14">{{ $lang['3'] }}</label>
                                        <input type="number" step="any" min="0" max="5" wire:model.live="currentGpa" id="currentGpa" class="input mt-2" placeholder="0.0">
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="currentCredits" class="text-blue font-s-14">{{ $lang['5'] }}</label>
                                        <input type="number" step="any" min="0" wire:model.live="currentCredits" id="currentCredits" class="input mt-2" placeholder="0.0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courses List -->
                    <div class="col-span-12">
                        <div class="border rounded-lg p-4 bg-white shadow-sm">
                            <div class="grid grid-cols-12 gap-2 text-blue-700 font-bold mb-4">
                                <div class="col-span-4 text-sm">{{ $lang['credit'] }}</div>
                                <div class="col-span-4 text-sm">{{ $lang['grade'] }}</div>
                                <div class="col-span-4 text-sm">{{ $lang['g_p'] }}</div>
                            </div>

                            <div class="space-y-4">
                                @foreach($courses as $index => $course)
                                    <div class="grid grid-cols-12 gap-2 items-center relative" wire:key="course-{{ $index }}">
                                        <!-- Credits -->
                                        <div class="col-span-4">
                                            <input type="number" step="any" min="0" wire:model.live="courses.{{ $index }}.credit" class="input" placeholder="{{ $lang['credit'] }}">
                                        </div>

                                        <!-- Grade -->
                                        <div class="col-span-4">
                                            <select wire:model.live="courses.{{ $index }}.grade" class="input">
                                                <option value="" selected disabled>{{ $lang['grade'] }}</option>
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
                                        </div>

                                        <!-- Grade Points (Auto-calculated UI helper) -->
                                        <div class="col-span-3">
                                            <input type="text" class="input bg-gray-50" readonly 
                                                value="{{ (is_numeric($courses[$index]['grade']) && is_numeric($courses[$index]['credit'])) ? number_format((float)$courses[$index]['grade'] * (float)$courses[$index]['credit'], 2) : '0.00' }}">
                                        </div>

                                        <!-- Remove Button -->
                                        <div class="col-span-1 flex justify-center">
                                            @if(count($courses) > 1)
                                                <button type="button" wire:click="removeCourse({{ $index }})" class="text-gray-400 hover:text-red-500">
                                                    <img src="{{ asset('images/close.png') }}" class="w-4 h-4" alt="remove">
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                <button type="button" wire:click="addCourse" class="bg-blue-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-800 transition-colors flex items-center">
                                    <span class="text-xl me-2">+</span> {{ $lang['add_course'] }}
                                </button>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full">
                            <div class="w-full text-center mt-4">
                                <div class="bg-[#F6FAFC] rounded-lg p-6 shadow-sm border border-blue-100">
                                    <p class="text-5xl font-bold text-green-700">{{ $detail['gpa'] }}</p>
                                    <p class="text-xl font-bold text-blue-800 mt-2">{{ $lang['cum'] }}</p>
                                    <p class="text-xl font-bold text-blue-800">{{ $lang['gpa'] }}</p>
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
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
