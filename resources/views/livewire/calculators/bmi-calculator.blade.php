<div>
    @isset($detail)
        <style>
            .bg-red{
                background-color: red !important;
            }
            .speech-bubble-area {
                position: absolute;
                width: 18%;
                top: -29px;
                background: {{ $detail['color'] }};
                left: {{ $detail['left'] }}%
            }

            @keyframes bmi_res {
                from { left: 2%; }
                to { left: {{ $detail['left'] }}% }
            }

            .speech-bubble:after {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                bottom: 0;
                left: 40%;
                border: 8px solid transparent;
                border-bottom: 0;
                margin-bottom: -7px;
                border-top-color: {{ $detail['color'] }};
            }
        </style>
    @endisset

    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="row">
                <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                    <div class="flex flex-wrap items-center bg-blue-200 border border-[#2845F5] text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type === 'lbs' ? 'tagsUnit select_lang' : 'bg-white hover_tags hover:text-white' }}"
                                wire:click="$set('unit_type', 'lbs')">
                                {{ $lang['imperial'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $unit_type === 'kg' ? 'tagsUnit select_lang' : 'bg-white hover_tags hover:text-white' }}"
                                wire:click="$set('unit_type', 'kg')">
                                {{ $lang['metric'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 lg:w-[70%] w-full mx-auto">
                    <div class="grid grid-cols-2 gap-2 mt-4">

                        <div class="px-2 py-1">
                            <label for="stage" class="label"> {!! $lang['age_stages'] !!}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="stage" id="stage">
                                    <option value="child"> Child & Teen</option>
                                    <option value="adult"> Adult</option>
                                </select>
                            </div>
                        </div>

                        <div class="px-2 py-1">
                            <label for="gender" class="label"> {!! $lang['gen'] !!}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="gender" id="gender">
                                    <option value="Male"> Male</option>
                                    <option value="Female"> Female</option>
                                </select>
                            </div>
                        </div>

                        @if ($stage === 'child')
                            <div class="px-2 py-1 age_input">
                                <label for="age" class="label"> {!! $lang['age'] !!}:</label>
                                <div class="w-full py-2">
                                    <input type="number" wire:model.live="age" id="age" min="1" max="20"
                                        aria-label="input" placeholder="00" required />
                                </div>
                            </div>
                        @endif

                        @if ($unit_type === 'lbs')
                            <div class="px-2 py-1 height_ft_in">
                                <label for="ft_in" class="label"> {!! $lang['height'] !!} (ft/in):</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="ft_in" id="ft_in">
                                        <option value="55">4ft 7in</option>
                                        <option value="56">4ft 8in</option>
                                        <option value="57">4ft 9in</option>
                                        <option value="58">4ft 10in</option>
                                        <option value="59">4ft 11in</option>
                                        <option value="60">5ft 0in</option>
                                        <option value="61">5ft 1in</option>
                                        <option value="62">5ft 2in</option>
                                        <option value="63">5ft 3in</option>
                                        <option value="64">5ft 4in</option>
                                        <option value="65">5ft 5in</option>
                                        <option value="66">5ft 6in</option>
                                        <option value="67">5ft 7in</option>
                                        <option value="68">5ft 8in</option>
                                        <option value="69">5ft 9in</option>
                                        <option value="70">5ft 10in</option>
                                        <option value="71">5ft 11in</option>
                                        <option value="72">6ft 0in</option>
                                        <option value="73">6ft 1in</option>
                                        <option value="74">6ft 2in</option>
                                        <option value="75">6ft 3in</option>
                                        <option value="76">6ft 4in</option>
                                        <option value="77">6ft 5in</option>
                                        <option value="78">6ft 6in</option>
                                        <option value="79">6ft 7in</option>
                                        <option value="80">6ft 8in</option>
                                        <option value="81">6ft 9in</option>
                                        <option value="82">6ft 10in</option>
                                        <option value="83">6ft 11in</option>
                                        <option value="84">7ft 0in</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="px-2 py-1 height_cm">
                                <label for="height_cm" class="label"> {!! $lang['height'] !!}:</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.live="height_cm" id="height_cm"
                                        class="pr-10" aria-label="input" placeholder="00" required />
                                    <span class="input_unit">cm</span>
                                </div>
                            </div>
                        @endif

                        <div class="px-2 py-1">
                            <label for="weight" class="label" id="tdee_weight_text">{!! $lang['weight'] !!} ({{ $unit_type }}):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="weight" id="weight"
                                    class=" pr-10" aria-label="input" placeholder="00" required />
                                <span class="input_unit" id="lbs_or_kg">{{ $unit_type }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 justify-center">
                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>
        @isset($detail)
          <hr style="height: 1px; background-color: #e5e7eb;">
            {{-- result --}}
               <div id="result-section" wire:loading.remove wire:target="calculate"
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg p-4 flex items-center justify-center">
                        <div class="col-12  rounded-lg ">
                            <div class="flex flex-wrap my-2 ">
                                @if (isset($detail['BMI']))
                                    <div class="lg:w-7/12 lg:pr-3">
                                        <div class="text-center pt-1 pb-2">
                                            <p
                                                class=" bg-gradient-to-r from-red-400 to-pink-500 text-white font-s-13 relative inline-block rounded-full shadow-lg p-3">
                                                {!! $lang['your_bmi'] !!}
                                            </p>
                                            <p class="font-s-13 text-xl font-bold text-gray-700">
                                                {{ round($detail['BMI'], 1) }}</p>
                                        </div>
                                        <div class="grid grid-cols-4  mt-6 relative">
                                            <div class="speech-bubble-area text-center radius-5 pt-2px rounded">
                                                <p class="speech-bubble text-white font-s-13 position-relative">
                                                    {{ $detail['BMI'] }}</p>
                                            </div>

                                            <div
                                                class="text-center bg-blue-500 py-2 px-1 transition transform hover:scale-105 rounded-tl-[25px] rounded-bl-[25px]">
                                                <p class="text-white text-sm">{{ $lang['underw'] }}</p>
                                                <p class="text-white text-sm">&lt;18.5</p>
                                            </div>

                                            <div class="text-center bg-green-500 py-2 px-1 transition transform hover:scale-105">
                                                <p class="text-white text-sm">{{ $lang['health'] }}</p>
                                                <p class="text-white text-sm">18.5 - 24.9</p>
                                            </div>
                                            <div
                                                class="text-center bg-yellow-500 py-2 px-1 transition transform hover:scale-105">
                                                <p class="text-white text-sm">{{ $lang['overw'] }}</p>
                                                <p class="text-white text-sm">25.0 - 29.9</p>
                                            </div>
                                            <div
                                                class="text-center bg-red-500  py-2 px-1 transition transform hover:scale-105 rounded-tr-[25px] rounded-br-[25px]">
                                                <p class="text-white text-sm">{{ $lang['ob'] }}</p>
                                                <p class="text-white text-sm">&gt;30.0</p>
                                            </div>
                                        </div>
                                        <p class="mt-4 text-center text-lg text-gray-700">
                                            @php
                                                if (isset($detail['under'])) {
                                                    echo $lang['under'];
                                                } elseif (isset($detail['healthy'])) {
                                                    echo $lang['healthy'];
                                                } elseif (isset($detail['over'])) {
                                                    echo $lang['over'];
                                                } elseif (isset($detail['obese1'])) {
                                                    echo $lang['obese1'];
                                                } elseif (isset($detail['obese2'])) {
                                                    echo $lang['obese2'];
                                                } elseif (isset($detail['obese3'])) {
                                                    echo $lang['obese3'];
                                                }
                                            @endphp
                                        </p>
                                        <p class="mt-2 text-center text-xl font-bold text-blue-600">{{ $lang['range'] }}
                                        </p>
                                        <p class="mt-1 text-center text-gray-600">{{ $lang['w_r'] }}</p>
                                        <p class="text-center text-2xl font-bold text-gray-800">{{ $detail['ibw'] }}</p>
                                        <p class="mt-4 text-center">
                                            <strong>
                                                <span class="text-blue-500 text-lg">{{ $lang['your_pi'] }}</span><br>
                                                <span class="text-2xl">{{ $detail['PI'] }} kg/m<sup>3</sup></span>
                                            </strong>
                                        </p>
                                    </div>
                                    <!-- Classification Table -->
                                    <div class="lg:w-5/12 lg:pl-3 mt-6 lg:mt-0">
                                        <div class="w-full overflow-auto">
                                            <table class="w-full border border-blue-500 rounded-lg text-sm">
                                                <thead>
                                                    <tr
                                                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center">
                                                        <th class="p-2 rounded-tl-lg">BMI</th>
                                                        <th class="p-2 rounded-tr-lg">{{ $lang['classi'] }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        class="text-center {{ isset($detail['under']) ? $detail['under'] : '' }}">
                                                        <td class="p-2 border-b border-gray-300">&lt; 18.5</td>
                                                        <td class="p-2 border-b border-gray-300">{{ $lang['underw'] }}</td>
                                                    </tr>
                                                    <tr
                                                        class="text-center {{ isset($detail['healthy']) ? $detail['healthy'] : '' }}">
                                                        <td class="p-2 border-b border-gray-300">18.5 - 24.9</td>
                                                        <td class="p-2 border-b border-gray-300">{{ $lang['healthyw'] }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="text-center {{ isset($detail['over']) ? $detail['over'] : '' }}">
                                                        <td class="p-2 border-b border-gray-300">25 - 29.9</td>
                                                        <td class="p-2 border-b border-gray-300">{{ $lang['overw'] }}</td>
                                                    </tr>
                                                    <tr
                                                        class="text-center {{ isset($detail['obese1']) ? $detail['obese1'] : '' }}">
                                                        <td class="p-2 border-b border-gray-300">&gt;30 - 34.9</td>
                                                        <td class="p-2 border-b border-gray-300">{{ $lang['obese1w'] }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="text-center {{ isset($detail['obese2']) ? $detail['obese2'] : '' }}">
                                                        <td class="p-2 border-b border-gray-300">&gt;35 - 39.9</td>
                                                        <td class="p-2 border-b border-gray-300">{{ $lang['obese2w'] }}
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        class="text-center {{ isset($detail['obese3']) ? $detail['obese3'] : '' }}">
                                                        <td class="p-2 border-b border-gray-300 rounded-bl-lg">40 &gt;</td>
                                                        <td class="p-2 border-b border-gray-300 rounded-br-lg">
                                                            {{ $lang['obese3w'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Additional Information -->
                                        <div class="w-full mt-4">
                                            <p class="text-lg text-blue-500 font-bold">{{ $lang['metter'] }}</p>
                                            <ul class="list-disc pl-6 mt-2 text-gray-700">
                                                <li class="py-1">{{ $lang['metter1'] }}</li>
                                                <li class="py-1">{{ $lang['metter2'] }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Image Section -->
                                    <div class="w-full mt-6 py-4">
                                        <div class="flex flex-col md:flex-row gap-3">
                                            <img src="{{ asset('images/bmitable.webp') }}"
                                                class="md:w-1/2 rounded-lg shadow-md" alt="Body Mass Index (BMI) Table">
                                            <img src="{{ asset('images/bmigraph.png') }}"
                                                class="md:w-1/2 rounded-lg shadow-md" alt="Body Mass Index (BMI) Chart">
                                        </div>
                                        <div class="md:w-2/3 text-center mt-4 mx-auto">
                                            <p class="w-full text-gray-800"><b>{{ $lang['wthr'] }}</b></p>
                                        </div>
                                    </div>
                                @elseif(isset($detail['BMI_kid']))
                                    <div class="lg:flex gap-6 mt-2 w-full">
                                        <!-- BMI Info Section -->
                                        <div class="lg:w-1/2  lg:p-6 md:p-4 p-2">
                                            <div class="text-center mb-5">
                                                <!-- Child BMI -->
                                                <p
                                                    class="inline-block bg-blue-500 text-white text-lg px-4 py-1 rounded-full shadow-lg">
                                                    <strong class="text-white">{!! $lang['child_bmi'] !!}</strong>
                                                </p>
                                            </div>
                                            <div class="text-center mb-6">
                                                <!-- BMI Value -->
                                                <p class="text-4xl font-bold text-green-500">
                                                    {{ round($detail['BMI_kid'], 1) }}
                                                </p>
                                                <!-- BMI Status -->
                                                <p class="text-2xl font-semibold text-blue-500">
                                                    {{ $detail['Status'] }}
                                                </p>
                                            </div>

                                            <!-- BMI Range Bars -->
                                            <div class="flex mt-10 relative">
                                                <div class="speech-bubble-area text-center radius-5 pt-2px rounded">
                                                    <p class="speech-bubble text-white font-s-13 position-relative">
                                                        {{ $detail['percent'] }}%</p>
                                                </div>
                                                <div
                                                    class="w-1/6 bg-blue-500 text-white text-sm py-2 rounded-l-full text-center">
                                                    <p class="text-white">&lt; 5%</p>
                                                </div>
                                                <div class="w-5/12 bg-green-500 text-white text-sm py-2 text-center">
                                                    <p class="text-white">5 - 84.9%</p>
                                                </div>
                                                <div class="w-3/12 bg-yellow-500 text-white text-sm py-2 text-center">
                                                    <p class="text-white">85 - 94.9%</p>
                                                </div>
                                                <div
                                                    class="w-1/6 bg-red-500 text-white text-sm py-2 rounded-r-full text-center">
                                                    <p class="text-white">> 95%</p>
                                                </div>
                                            </div>

                                            <!-- Explanation of Range -->
                                            <p class="w-full mt-4 text-center text-lg">
                                                <strong class="text-blue-500">{{ $lang['range1'] }}</strong>
                                            </p>
                                        </div>
                                        <!-- BMI Classification Table -->
                                        <div class="lg:w-1/2  rounded-lg lg:p-6 md:p-4 p-2">
                                            <div class="overflow-auto">
                                                <table class="w-full border text-sm bg-[#ffffff]">
                                                    <thead class="bg-[#2845F5] text-white text-center">
                                                        <tr>
                                                            <th class="py-2 rounded-tl-lg text-white">{{ $lang['per'] }}
                                                            </th>
                                                            <th class="py-2 rounded-tr-lg text-white ">{{ $lang['classi'] }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            class="text-center {{ isset($detail['under']) ? $detail['under'] : '' }}">
                                                            <td class="py-2 border-b">
                                                                < 5%</td>
                                                            <td class="py-2 border-b">{{ $lang['underw'] }}</td>
                                                        </tr>
                                                        <tr
                                                            class="text-center {{ isset($detail['healthy']) ? $detail['healthy'] : '' }}">
                                                            <td class="py-2 border-b">5% - 84.9%</td>
                                                            <td class="py-2 border-b">{{ $lang['healthyw'] }}</td>
                                                        </tr>
                                                        <tr
                                                            class="text-center {{ isset($detail['over']) ? $detail['over'] : '' }}">
                                                            <td class="py-2 border-b">85% - 94.9%</td>
                                                            <td class="py-2 border-b">{{ $lang['overw'] }}</td>
                                                        </tr>
                                                        <tr
                                                            class="text-center {{ isset($detail['obese1']) ? $detail['obese1'] : '' }}">
                                                            <td class="py-2 border-b rounded-bl-lg">> 95%</td>
                                                            <td class="py-2 border-b rounded-br-lg">{{ $lang['ob'] }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Display BMI Percent -->
                                            <p class="w-full text-lg text-center mt-4">
                                                <strong>{{ $lang['per'] }}:</strong>
                                                <strong class="text-green-500">{{ $detail['percent'] }}%</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Child-specific Message -->
                                    <div class="w-full text-center lg:mt-2 md:mt-2">
                                        <strong class="text-[#2845F5] text-md">
                                            @php
                                                if (isset($detail['under'])) {
                                                    echo $lang['child1'];
                                                } elseif (isset($detail['healthy'])) {
                                                    echo $lang['child2'];
                                                } elseif (isset($detail['over'])) {
                                                    echo $lang['child3'];
                                                } elseif (isset($detail['obese1'])) {
                                                    echo $lang['child4'];
                                                }
                                            @endphp
                                        </strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
