<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="calculate" id="calculate">
                        <option value="1"
                            {{ isset($_POST['calculate']) && $_POST['calculate'] == '1' ? 'selected' : '' }}>
                            Friction Coefficient</option>
                        <option value="2"
                            {{ isset($_POST['calculate']) && $_POST['calculate'] == '2' ? 'selected' : '' }}>
                            Normal Force</option>
                        <option value="3"
                            {{ isset($_POST['calculate']) && $_POST['calculate'] == '3' ? 'selected' : '' }}>
                            Friction</option>
                        <option value="4"
                            {{ isset($_POST['calculate']) && $_POST['calculate'] == '4' ? 'selected' : '' }}>
                            Frictional Force</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 friction_coefficient px-2 d-none">
                <label for="fr_co" class="font-s-14 text-blue">{{ $lang['2'] }} (μ)</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="fr_co" id="fr_co" class="input" aria-label="input"
                        placeholder="00" value="{{ isset($_POST['fr_co']) ? $_POST['fr_co'] : '0.2' }}" />
                </div>
            </div>
            <div class="col-span-12 normal_force">
                <label for="force" class="font-s-14 text-blue">{{ $lang['3'] }} (N)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="force" id="force" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force']) ? $_POST['force'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('force_unit_dropdown')">{{ isset($_POST['force_unit'])?$_POST['force_unit']:'N' }} ▾</label>
                    <input type="text" name="force_unit" value="{{ isset($_POST['force_unit'])?$_POST['force_unit']:'N' }}" id="force_unit" class="hidden">
                    <div id="force_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="force_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'MN')">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'GN')">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'TN')">TN</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 friction">
                <label for="fr" class="font-s-14 text-blue">{{ $lang['4'] }} (F)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fr" id="fr" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fr']) ? $_POST['fr'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fr_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fr_unit_dropdown')">{{ isset($_POST['fr_unit'])?$_POST['fr_unit']:'N' }} ▾</label>
                    <input type="text" name="fr_unit" value="{{ isset($_POST['fr_unit'])?$_POST['fr_unit']:'N' }}" id="fr_unit" class="hidden">
                    <div id="fr_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fr_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'MN')">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'GN')">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit', 'TN')">TN</p>
                    </div>
                 </div>
            </div>
           
            <div class="col-span-12 mass px-2 d-none">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['5'] }} (m)</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="mass" id="mass" class="input" aria-label="input"
                        placeholder="00" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '13' }}" />
                    <span class="text-blue input_unit">kg</span>
                </div>
            </div>
            <div class="col-span-12 plane px-2 d-none">
                <label for="plane" class="font-s-14 text-blue">{{ $lang['6'] }} (θ)</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="plane" id="plane" class="input"
                        aria-label="input" placeholder="00"
                        value="{{ isset($_POST['plane']) ? $_POST['plane'] : '30' }}" />
                    <span class="text-blue input_unit">kg</span>
                </div>
            </div>
            <div class="col-span-12 gravity px-2 d-none">
                <label for="gravity" class="font-s-14 text-blue">{{ $lang['7'] }} (g)</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="gravity" id="gravity" class="input"
                        aria-label="input" placeholder="00"
                        value="{{ isset($_POST['gravity']) ? $_POST['gravity'] : '9.81' }}" />
                    <span class="text-blue input_unit">kg</span>
                </div>
            </div>
         
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>
    @isset($detail)

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="col-full mt-3">
                    @if (isset($detail['friction_coefficient']) && $detail['friction_coefficient'] != '')
                        <div class="w-full text-center text-[18px]">
                            <p>{{ $lang['2'] }} (μ)</p>
                            <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">
                                    @php
                                        $str = $detail['friction_coefficient'];
                                        echo $str;
                                    @endphp
                                </strong></p>
                        </div>
                    @endif
                    @if (isset($detail['calculate_force']) && $detail['calculate_force'] != '')
                        <div class="w-full text-center text-[18px]">
                            <p>{{ $lang['3'] }}</p>
                            <p class="my-3"><strong
                                    class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ round($detail['calculate_force'], 2) }}
                                    (N)</strong></p>
                        </div>
                    @endif
                    @if (isset($detail['friction']) && $detail['friction'] != '')
                        <div class="w-full text-center text-[18px]">
                            <p>{{ $lang['4'] }}</p>
                            <p class="my-3"><strong
                                    class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ round($detail['friction'], 2) }}
                                    (N)</strong></p>
                        </div>
                    @endif
                    @if (isset($detail['friction2']) && $detail['friction2'] != '')
                        <div class="w-full text-center text-[18px]">
                            <p>{{ $lang['8'] }}</p>
                            <p class="my-3"><strong
                                    class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ round($detail['friction2'], 2) }}
                                    (N)</strong></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($error))
            var a = "{{ $_POST['calculate'] }}";
            var normalForceElements = document.querySelectorAll('.normal_force');
            var frictionElements = document.querySelectorAll('.friction');
            var frictionCoefficientElements = document.querySelectorAll('.friction_coefficient');
            var massElements = document.querySelectorAll('.mass');
            var planeElements = document.querySelectorAll('.plane');
            var gravityElements = document.querySelectorAll('.gravity');

            function hideElements(elements) {
                elements.forEach(function(element) {
                    element.classList.add('d-none');
                });
            }

            function showElements(elements) {
                elements.forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }

            if (a === "1") {
                showElements(normalForceElements);
                showElements(frictionElements);
                hideElements(frictionCoefficientElements);
                hideElements(massElements);
                hideElements(planeElements);
                hideElements(gravityElements);
            } else if (a === "2") {
                showElements(frictionCoefficientElements);
                showElements(frictionElements);
                hideElements(normalForceElements);
                hideElements(massElements);
                hideElements(planeElements);
                hideElements(gravityElements);
            } else if (a === "3") {
                showElements(frictionCoefficientElements);
                showElements(normalForceElements);
                hideElements(frictionElements);
                hideElements(massElements);
                hideElements(planeElements);
                hideElements(gravityElements);
            } else if (a === "4") {
                showElements(frictionCoefficientElements);
                showElements(massElements);
                showElements(planeElements);
                showElements(gravityElements);
                hideElements(frictionElements);
                hideElements(normalForceElements);
            }
        @endif

        @if (isset($detail))
            var a = "{{ $_POST['calculate'] }}";
            var normalForceElements = document.querySelectorAll('.normal_force');
            var frictionElements = document.querySelectorAll('.friction');
            var frictionCoefficientElements = document.querySelectorAll('.friction_coefficient');
            var massElements = document.querySelectorAll('.mass');
            var planeElements = document.querySelectorAll('.plane');
            var gravityElements = document.querySelectorAll('.gravity');

            function hideElements(elements) {
                elements.forEach(function(element) {
                    element.classList.add('d-none');
                });
            }

            function showElements(elements) {
                elements.forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }

            if (a === "1") {
                showElements(normalForceElements);
                showElements(frictionElements);
                hideElements(frictionCoefficientElements);
                hideElements(massElements);
                hideElements(planeElements);
                hideElements(gravityElements);
            } else if (a === "2") {
                showElements(frictionCoefficientElements);
                showElements(frictionElements);
                hideElements(normalForceElements);
                hideElements(massElements);
                hideElements(planeElements);
                hideElements(gravityElements);
            } else if (a === "3") {
                showElements(frictionCoefficientElements);
                showElements(normalForceElements);
                hideElements(frictionElements);
                hideElements(massElements);
                hideElements(planeElements);
                hideElements(gravityElements);
            } else if (a === "4") {
                showElements(frictionCoefficientElements);
                showElements(massElements);
                showElements(planeElements);
                showElements(gravityElements);
                hideElements(frictionElements);
                hideElements(normalForceElements);
            }
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('calculate').addEventListener('change', function() {
                var a = this.value;

                var normalForceElements = document.querySelectorAll('.normal_force');
                var frictionElements = document.querySelectorAll('.friction');
                var frictionCoefficientElements = document.querySelectorAll('.friction_coefficient');
                var massElements = document.querySelectorAll('.mass');
                var planeElements = document.querySelectorAll('.plane');
                var gravityElements = document.querySelectorAll('.gravity');

                function hideElements(elements) {
                    elements.forEach(function(element) {
                        element.classList.add('d-none');
                    });
                }

                function showElements(elements) {
                    elements.forEach(function(element) {
                        element.classList.remove('d-none');
                    });
                }

                if (a === "1") {
                    showElements(normalForceElements);
                    showElements(frictionElements);
                    hideElements(frictionCoefficientElements);
                    hideElements(massElements);
                    hideElements(planeElements);
                    hideElements(gravityElements);
                } else if (a === "2") {
                    showElements(frictionCoefficientElements);
                    showElements(frictionElements);
                    hideElements(normalForceElements);
                    hideElements(massElements);
                    hideElements(planeElements);
                    hideElements(gravityElements);
                } else if (a === "3") {
                    showElements(frictionCoefficientElements);
                    showElements(normalForceElements);
                    hideElements(frictionElements);
                    hideElements(massElements);
                    hideElements(planeElements);
                    hideElements(gravityElements);
                } else if (a === "4") {
                    showElements(frictionCoefficientElements);
                    showElements(massElements);
                    showElements(planeElements);
                    showElements(gravityElements);
                    hideElements(frictionElements);
                    hideElements(normalForceElements);
                }
            });
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>