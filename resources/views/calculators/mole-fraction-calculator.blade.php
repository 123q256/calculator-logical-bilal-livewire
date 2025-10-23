<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                   <div class="w-full px-2 mb-2">
                       <p><strong class="text-blue">{{ $lang['note'] }}:</strong> {{ $lang['note_val'] }}</p>
                   </div>
                    <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                         <div class="space-y-2">
                            <label for="x" class="label my-3">{{ $lang['sol'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="x" id="x" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x'])?$_POST['x']:'3.5482' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_x" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_x_dropdown')">{{ isset($_POST['unit_x'])?$_POST['unit_x']:'Mole' }} ▾</label>
                                <input type="text" name="unit_x" value="{{ isset($_POST['unit_x'])?$_POST['unit_x']:'Mole' }}" id="unit_x" class="hidden">
                                <div id="unit_x_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden unit_x" to="unit_x">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'Mole')">{{ $lang['m_u'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'Gram')">{{ $lang['Gram'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'Millimole')">{{ $lang['mili'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'PoundMole')">{{ $lang['pound'] }}</p>
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 divide_x hidden">
                            <label for="divide_x" class="label my-2">{!! $lang['mass'] !!}:</label>
                                <input type="number" step="any" name="divide_x" id="divide_x" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->divide_x)?request()->divide_x:'' }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 mt-2">
                            <label for="y" class="label my-3">{{ $lang['solv'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="y" id="y" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y'])?$_POST['y']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_y" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_y_dropdown')">{{ isset($_POST['unit_y'])?$_POST['unit_y']:'Mole' }} ▾</label>
                                <input type="text" name="unit_y" value="{{ isset($_POST['unit_y'])?$_POST['unit_y']:'Mole' }}" id="unit_y" class="hidden">
                                <div id="unit_y_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden unit_y" to="unit_y">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'Mole')">{{ $lang['m_u'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'Gram')">{{ $lang['Gram'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'Millimole')">{{ $lang['mili'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_y', 'PoundMole')">{{ $lang['pound'] }}</p>
                                </div>
                            </div>
                         </div>
                         <div class="space-y-2 divide_y hidden">
                            <label for="divide_y" class="label my-2">{!! $lang['mass'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="divide_y" id="divide_y" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->divide_y)?request()->divide_y:'' }}" />
                            </div>
                        </div>
                    </div>
                        <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                            <div class="space-y-2 mt-2">
                                <label for="z" class="label my-3">{{ $lang['solu'] }}</label>
                                <div class="relative w-full ">
                                    <input type="number" name="z" id="z" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z'])?$_POST['z']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="unit_z" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_z_dropdown')">{{ isset($_POST['unit_z'])?$_POST['unit_z']:'Mole' }} ▾</label>
                                    <input type="text" name="unit_z" value="{{ isset($_POST['unit_z'])?$_POST['unit_z']:'Mole' }}" id="unit_z" class="hidden">
                                    <div id="unit_z_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden unit_z" to="unit_z">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_z', 'Mole')">{{ $lang['m_u'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_z', 'Gram')">{{ $lang['Gram'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_z', 'Millimole')">{{ $lang['mili'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_z', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_z', 'PoundMole')">{{ $lang['pound'] }}</p>
                                    </div>
                                </div>
                             </div>
                             <div class="space-y-2 divide_z hidden">
                                <label for="divide_z" class="label my-2">{!! $lang['mass'] !!}:</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="divide_z" id="divide_z" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->divide_z)?request()->divide_z:'' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                            <div class="space-y-2 mt-2">
                                <label for="a" class="label my-3">{{ $lang['mole'] }}</label>
                                <div class="relative w-full ">
                                    <input type="number" name="z" id="z" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['z'])?$_POST['z']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="unit_a" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_a_dropdown')">{{ isset($_POST['unit_a'])?$_POST['unit_a']:'Mole' }} ▾</label>
                                    <input type="text" name="unit_a" value="{{ isset($_POST['unit_a'])?$_POST['unit_a']:'Mole' }}" id="unit_a" class="hidden">
                                    <div id="unit_a_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden unit_a units" to="unit_a">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'Mole')">{{ $lang['m_u'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'Gram')">{{ $lang['Gram'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'Millimole')">{{ $lang['mili'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'PoundMole')">{{ $lang['pound'] }}</p>
                                    </div>
                                </div>
                             </div>
                             <div class="space-y-2 divide_a hidden">
                                <label for="divide_a" class="label my-2">{!! $lang['mass'] !!}:</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="divide_a" id="divide_a" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->divide_a)?request()->divide_a:'' }}" />
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
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-full col-lg-7" cellspacing="0">
                                <tr>
                                    <td class="border-b py-2">{{ $lang['solute'] }}</td>
                                    <td class="border-b py-2"><strong>{{ $detail['Solute'] }} {{ $lang['m_u'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['solvent'] }}</td>
                                    <td class="border-b py-2"><strong>{{ $detail['Solvent'] }} {{ $lang['m_u'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['solu'] }}</td>
                                    <td class="border-b py-2"><strong>{{ $detail['sol'] }} {{ $lang['m_u'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2">{{ $lang['mole'] }}</td>
                                    <td class="py-2"><strong>{{ $detail['mol'] }} {{ $lang['m_u'] }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function toggleDivide(unitSelector, divideClass) {
                    const unitValue = document.querySelector(unitSelector).value;
                    const divideElement = document.querySelector(divideClass);
                    if (unitValue === 'Gram') {
                        divideElement.style.display = 'block';
                    } else {
                        divideElement.style.display = 'none';
                    }
                }
                
                toggleDivide('#unit_x', '.divide_x');
                toggleDivide('#unit_y', '.divide_y');
                toggleDivide('#unit_z', '.divide_z');
                toggleDivide('#unit_a', '.divide_a');

                function setupClickListener(unitClass, unitSelector, divideClass) {
                    const elements = document.querySelectorAll(unitClass + ' p');
                    elements.forEach(function(element) {
                        element.addEventListener('click', function() {
                            toggleDivide(unitSelector, divideClass);
                        });
                    });
                }

                setupClickListener('.unit_x', '#unit_x', '.divide_x');
                setupClickListener('.unit_y', '#unit_y', '.divide_y');
                setupClickListener('.unit_z', '#unit_z', '.divide_z');
                setupClickListener('.unit_a', '#unit_a', '.divide_a');
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>