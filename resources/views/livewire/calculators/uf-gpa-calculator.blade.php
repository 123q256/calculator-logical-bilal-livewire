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
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form space-y-6 mt-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="p-6 bg-white space-y-6">
                    <h3 class="text-xl font-bold pb-3">UF GPA Calculator</h3>

                    <div class="space-y-4">
                        <!-- Headers matching screenshot -->
                        <div class="grid grid-cols-12 gap-3 text-xs font-bold uppercase tracking-wider text-gray-500 pb-2">
                            <div class="col-span-4"># OF CREDITS</div>
                            <div class="col-span-4">GRADE POINTS</div>
                            <div class="col-span-3">GRADE</div>
                            <div class="col-span-1"></div>
                        </div>

                        <div class="space-y-3">
                            @foreach($courses as $index => $course)
                                <div class="grid grid-cols-12 gap-3 items-center" wire:key="course-{{ $index }}">
                                    <!-- Credits Input -->
                                    <div class="col-span-4">
                                        <input type="number" step="any" wire:model.live="courses.{{ $index }}.credit" class="input py-2" placeholder="Credits">
                                    </div>

                                    <!-- Grade Points Input (Auto-calculated) -->
                                    <div class="col-span-4">
                                        <input type="number" step="any" wire:model.live="courses.{{ $index }}.points" class="input py-2" placeholder="0.000">
                                    </div>

                                    <!-- Grade Select -->
                                    <div class="col-span-3">
                                        <select wire:model.live="courses.{{ $index }}.grade" class="input py-2">
                                            <option value="" disabled selected>{{ $lang['grade'] ?? 'Grade' }}</option>
                                            <option value="4.00">A (4.00)</option>
                                            <option value="3.67">A- (3.67)</option>
                                            <option value="3.33">B+ (3.33)</option>
                                            <option value="3.00">B (3.00)</option>
                                            <option value="2.67">B- (2.67)</option>
                                            <option value="2.33">C+ (2.33)</option>
                                            <option value="2.00">C (2.00)</option>
                                            <option value="1.67">C- (1.67)</option>
                                            <option value="1.33">D+ (1.33)</option>
                                            <option value="1.00">D (1.00)</option>
                                            <option value="0.67">D- (0.67)</option>
                                            <option value="0.00">E/F (0.00)</option>
                                        </select>
                                    </div>

                                    <div class="col-span-1 flex justify-center">
                                        @if(count($courses) > 1)
                                            <button type="button" wire:click="removeCourse({{ $index }})" class="text-gray-400 hover:text-red-500 transition-colors">
                                                <img src="{{ asset('images/close.png') }}" class="w-4 h-4" alt="remove">
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-4 border-t">
                            <button type="button" wire:click="addCourse" class="font-bold flex items-center text-blue-700 hover:text-blue-900 transition-colors">
                                <span class="bg-blue-700 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs me-2">+</span>
                                Add Course
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap justify-center items-center gap-4 mt-10">
                    <button type="submit" class="bg-[#2845F5] text-white px-12 py-3 rounded-xl font-bold text-xl hover:bg-blue-800 transition-all shadow-lg hover:shadow-blue-200">
                        {{ $lang['calculate'] ?? 'Calculate' }}
                    </button>
                    @isset($detail)
                        <button type="button" wire:click="resetForm" class="bg-gray-100 text-gray-700 px-12 py-3 rounded-xl font-bold text-xl hover:bg-gray-200 transition-all border border-gray-200">
                            Reset
                        </button>
                    @endisset
                </div>
            </div>
        </div>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mb-3">
                <div class="bg-[#F6FAFC] border border-gray-200 rounded-lg p-8 shadow-sm">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="flex flex-col items-center mt-6">
                        <div class="bg-white rounded-lg py-10 px-4 text-center w-full border border-gray-100 shadow-sm">
                            <p class="text-[40px] font-bold text-black leading-none mb-2">{{ $detail['gpa'] }}</p>
                            <p class="text-[22px] font-bold text-black uppercase tracking-wide">Cumulative</p>
                            <p class="text-[22px] font-bold text-black uppercase tracking-wide">GPA</p>
                        </div>
                    </div>

                    <div class="mt-10 space-y-3 text-center text-black">
                        <p class="text-[18px]">
                            <strong>Total Grade Points = <span class="text-[24px] ml-1 font-bold">{{ $detail['totalGradePoints'] }}</span></strong>
                        </p>
                        <p class="text-[18px]">
                            <strong>Total # of Credits = <span class="text-[24px] ml-1 font-bold">{{ $detail['totalCredits'] }}</span></strong>
                        </p>
                        <p class="text-[18px]">
                            <strong>Grade Point Deficit (DPC) = <span class="text-[24px] ml-1 font-bold">{{ $detail['deficitPoints'] }}</span></strong>
                        </p>
                    </div>

                    @if((float)$detail['deficitPoints'] > 0)
                        <div class="mt-8 p-4 bg-red-50 border border-red-100 rounded-xl text-red-800 text-sm text-center font-bold">
                            Academic Alert: You have deficit points. A GPA of 2.0 or higher is required to remain in good academic standing at UF.
                        </div>
                    @endif
                </div>
            </div>
        @endisset

        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </form>
</div>
