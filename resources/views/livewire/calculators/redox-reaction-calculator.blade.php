<div>
    <style>
        .tagsUnit {
            background-color: #2845F5 !important;
            color: white !important;
        }
        .tab:hover {
            background-color: #f3f4f6;
        }
        .tagsUnit:hover {
            background-color: #1e3a8a !important;
        }
        /* Custom scrollbar for table */
        .table-container::-webkit-scrollbar {
            height: 6px;
        }
        .table-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .t_set tr { border-color:transparent }
        .check { padding: 8px 5px; font-weight: 500; cursor: pointer !important; transition: opacity 0.2s ease, filter 0.2s ease; }
        .check:hover { opacity: 0.8; filter: brightness(0.9); }
        .t1{ background:#F4CDCD; }
        .t2{ background:#ACDFEC; }
        .t3{ background:#85E185; }
        .t4{ background:#EACE5D; }
        .t5{ background:#F1F165; }
        .t6{ background:#E5BDE5; }
        .t7{ background:#F6D4A2; }
        .t8{ background:#FACCDB; }
        .t9{ background:#9EE5D4; }
        .t10{ background:#E9E9E9; }
    </style>

    <div class="w-full" wire:key="main-redox-container">
        <form wire:submit.prevent="calculate">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
                @if ($error)
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 font-semibold mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $error }}
                    </div>
                @endif

                <div class="w-full mx-auto">
                    
                    {{-- Input Section --}}
                    <div class="space-y-4">
                        <div class="mb-4">
                            <button type="button" id="load_example" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition-all active:scale-95">
                                {!! $lang['2'] !!}
                            </button>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label class="label font-bold text-gray-800 text-sm mb-2">{!! $lang['1'] !!}:</label>
                            <input type="text" wire:model="eq" id="chemical-eq-input" class="border border-blue-500 p-3 rounded-lg focus:ring-2 focus:ring-blue-300 w-full outline-none font-medium text-lg text-gray-800 transition-all bg-white" placeholder="Cr2O7^2- + H^+ + e^- = Cr^3+ + H2O">
                        </div>
                    </div>

                    {{-- Periodic Table Keyboard --}}
                    <div class="w-full overflow-auto mt-6">
                        <table class="w-full t_set text-center text-sm md:text-base border-separate" style="border-spacing: 2px;">
                        <tbody>
                            <tr>
                                <td class="check t3 rounded-sm">H</td>
                                <td colspan="16"></td>
                                <td class="check t6 rounded-sm">He</td>
                            </tr>
                            <tr>
                                <td class="check t4 rounded-sm">Li</td>
                                <td class="check t5 rounded-sm">Be</td>
                                <td colspan="10"></td>
                                <td class="check t9 rounded-sm">B</td>
                                <td class="check t3 rounded-sm">C</td>
                                <td class="check t3 rounded-sm">N</td>
                                <td class="check t3 rounded-sm">O</td>
                                <td class="check t3 rounded-sm">F</td>
                                <td class="check t6 rounded-sm">Ne</td>
                            </tr>
                            <tr>
                                <td class="check t4 rounded-sm">Na</td>
                                <td class="check t5 rounded-sm">Mg</td>
                                <td colspan="10"></td>
                                <td class="check t2 rounded-sm">Al</td>
                                <td class="check t9 rounded-sm">Si</td>
                                <td class="check t3 rounded-sm">P</td>
                                <td class="check t3 rounded-sm">S</td>
                                <td class="check t3 rounded-sm">Cl</td>
                                <td class="check t6 rounded-sm">Ar</td>
                            </tr>
                            <tr>
                                <td class="check t4 rounded-sm">K</td>
                                <td class="check t5 rounded-sm">Ca</td>
                                <td class="check t1 rounded-sm">Sc</td>
                                <td class="check t1 rounded-sm">Ti</td>
                                <td class="check t1 rounded-sm">V</td>
                                <td class="check t1 rounded-sm">Cr</td>
                                <td class="check t1 rounded-sm">Mn</td>
                                <td class="check t1 rounded-sm">Fe</td>
                                <td class="check t1 rounded-sm">Co</td>
                                <td class="check t1 rounded-sm">Ni</td>
                                <td class="check t1 rounded-sm">Cu</td>
                                <td class="check t1 rounded-sm">Zn</td>
                                <td class="check t2 rounded-sm">Ga</td>
                                <td class="check t9 rounded-sm">Ge</td>
                                <td class="check t9 rounded-sm">As</td>
                                <td class="check t3 rounded-sm">Se</td>
                                <td class="check t3 rounded-sm">Br</td>
                                <td class="check t6 rounded-sm">Kr</td>
                            </tr>
                            <tr>
                                <td class="check t4 rounded-sm">Rb</td>
                                <td class="check t5 rounded-sm">Sr</td>
                                <td class="check t1 rounded-sm">Y</td>
                                <td class="check t1 rounded-sm">Zr</td>
                                <td class="check t1 rounded-sm">Nb</td>
                                <td class="check t1 rounded-sm">Mo</td>
                                <td class="check t1 rounded-sm">Tc</td>
                                <td class="check t1 rounded-sm">Ru</td>
                                <td class="check t1 rounded-sm">Rh</td>
                                <td class="check t1 rounded-sm">Pd</td>
                                <td class="check t1 rounded-sm">Ag</td>
                                <td class="check t1 rounded-sm">Cd</td>
                                <td class="check t2 rounded-sm">In</td>
                                <td class="check t2 rounded-sm">Sn</td>
                                <td class="check t9 rounded-sm">Sb</td>
                                <td class="check t9 rounded-sm">Te</td>
                                <td class="check t3 rounded-sm">I</td>
                                <td class="check t6 rounded-sm">Xe</td>
                            </tr>
                            <tr>
                                <td class="check t4 rounded-sm">Cs</td>
                                <td class="check t5 rounded-sm">Ba</td>
                                <td class="check t7 rounded-sm">La</td>
                                <td class="check t1 rounded-sm">Hf</td>
                                <td class="check t1 rounded-sm">Ta</td>
                                <td class="check t1 rounded-sm">W</td>
                                <td class="check t1 rounded-sm">Re</td>
                                <td class="check t1 rounded-sm">Os</td>
                                <td class="check t1 rounded-sm">Ir</td>
                                <td class="check t1 rounded-sm">Pt</td>
                                <td class="check t1 rounded-sm">Au</td>
                                <td class="check t1 rounded-sm">Hg</td>
                                <td class="check t2 rounded-sm">TI</td>
                                <td class="check t2 rounded-sm">Pb</td>
                                <td class="check t2 rounded-sm">Bi</td>
                                <td class="check t9 rounded-sm">Po</td>
                                <td class="check t9 rounded-sm">At</td>
                                <td class="check t6 rounded-sm">Rn</td>
                            </tr>
                            <tr>
                                <td class="check t4 rounded-sm">Fr</td>
                                <td class="check t5 rounded-sm">Ra</td>
                                <td class="check t8 rounded-sm">Ac</td>
                                <td class="check t1 rounded-sm">Rf</td>
                                <td class="check t1 rounded-sm">Db</td>
                                <td class="check t1 rounded-sm">Sg</td>
                                <td class="check t1 rounded-sm">Bh</td>
                                <td class="check t1 rounded-sm">Hs</td>
                                <td class="check t10 rounded-sm">Mt</td>
                                <td class="check t10 rounded-sm">Ds</td>
                                <td class="check t10 rounded-sm">Rg</td>
                                <td class="check t10 rounded-sm">Cn</td>
                                <td class="check t10 rounded-sm">Nh</td>
                                <td class="check t10 rounded-sm">FI</td>
                                <td class="check t10 rounded-sm">Mc</td>
                                <td class="check t10 rounded-sm">Lv</td>
                                <td class="check t10 rounded-sm">Ts</td>
                                <td class="check t10 rounded-sm">Og</td>
                            </tr>
                            <tr>
                                <td colspan="18" class="py-2"></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-left font-bold text-gray-800 uppercase text-xs">{{ $lang['3'] }}</td>
                                <td class="check t7 rounded-sm">Ce</td>
                                <td class="check t7 rounded-sm">Pr</td>
                                <td class="check t7 rounded-sm">Nd</td>
                                <td class="check t7 rounded-sm">Pm</td>
                                <td class="check t7 rounded-sm">Sm</td>
                                <td class="check t7 rounded-sm">Eu</td>
                                <td class="check t7 rounded-sm">Gd</td>
                                <td class="check t7 rounded-sm">Tb</td>
                                <td class="check t7 rounded-sm">Dy</td>
                                <td class="check t7 rounded-sm">Ho</td>
                                <td class="check t7 rounded-sm">Er</td>
                                <td class="check t7 rounded-sm">Tm</td>
                                <td class="check t7 rounded-sm">Yb</td>
                                <td class="check t7 rounded-sm">Lu</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-left font-bold text-gray-800 uppercase text-xs">{{ $lang['4'] }}</td>
                                <td class="check t8 rounded-sm">Th</td>
                                <td class="check t8 rounded-sm">Pa</td>
                                <td class="check t8 rounded-sm">U</td>
                                <td class="check t8 rounded-sm">Np</td>
                                <td class="check t8 rounded-sm">Pu</td>
                                <td class="check t8 rounded-sm">Am</td>
                                <td class="check t8 rounded-sm">Cm</td>
                                <td class="check t8 rounded-sm">Bk</td>
                                <td class="check t8 rounded-sm">Cf</td>
                                <td class="check t8 rounded-sm">Es</td>
                                <td class="check t8 rounded-sm">Fm</td>
                                <td class="check t8 rounded-sm">Md</td>
                                <td class="check t8 rounded-sm">No</td>
                                <td class="check t8 rounded-sm">Lr</td>
                            </tr>
                        </tbody>
                        </table>
                        
                        <div class="w-full lg:w-10/12 mt-4 mx-auto">
                            <table class="w-full text-center t_set border-separate" style="border-spacing: 2px;">
                                <tbody>
                                <tr>
                                    <td id="spc" class="text-white bg-blue-600 rounded cursor-pointer hover:bg-blue-700 font-bold px-4 py-2">{{ $lang['5'] }}</td>
                                    <td class="check t6 rounded-sm">1</td>
                                    <td class="check t6 rounded-sm">2</td>
                                    <td class="check t6 rounded-sm">3</td>
                                    <td class="check t6 rounded-sm">4</td>
                                    <td class="check t6 rounded-sm">5</td>
                                    <td class="check t6 rounded-sm">6</td>
                                    <td class="check t6 rounded-sm">7</td>
                                    <td class="check t6 rounded-sm">8</td>
                                    <td class="check t6 rounded-sm">9</td>
                                    <td class="check t6 rounded-sm">0</td>
                                    <td class="check t6 rounded-sm">^</td>
                                    <td class="check t6 rounded-sm">-</td>
                                    <td class="check t6 rounded-sm">+</td>
                                    <td class="check t6 rounded-sm">=</td>
                                    <td class="check t6 rounded-sm">e</td>
                                    <td id="clr" class="text-white bg-blue-600 rounded cursor-pointer hover:bg-blue-700 font-bold px-4 py-2">{{ $lang['6'] }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        @if ($type == 'calculator')
                            @include('inc.button')
                        @elseif ($type == 'widget')
                            @include('inc.widget-button')
                        @endif
                    </div>
                </div>
            </div>
        </form>
        <hr>

        @if($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 rounded-lg mt-6">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="mt-4">
                        {{-- Your Input --}}
                        <div class="text-center mb-4">
                            <h3 class="font-bold text-gray-800 text-lg">{!! $lang[7] !!}</h3>
                            <p class="text-gray-700 mt-1">{{ $eq }}</p>
                        </div>

                        {{-- Balanced Equation Box --}}
                        <div class="text-center mb-8">
                            <b><span id="message" class="text-red-500 block mb-2"></span></b>
                            <code id="codevalid" class="hidden"></code>
                            
                            <h3 class="font-bold text-gray-800 text-lg mb-3">{!! $lang[8] !!}:</h3>
                            
                            {{-- Container for the PHP generated HTML --}}
                            <div id="result" class="text-xl md:text-2xl font-bold tracking-wide flex items-center justify-center flex-wrap">
                                @if(!empty($reactants))
                                    @foreach($reactants as $index => $r)
                                        @if($index > 0) <span class="mx-2 text-gray-600">+</span> @endif
                                        <span class="inline-flex items-baseline">
                                            @if($r['coeff'] > 1)<span class="text-[#0004FD] font-bold mr-1">{{ $r['coeff'] }}</span>@endif
                                            <span class="font-bold text-[#00821A]">{!! $r['html'] !!}</span>
                                        </span>
                                    @endforeach
                                    
                                    <span class="text-black font-bold mx-4 text-3xl align-middle">&rarr;</span>
                                    
                                    @foreach($products as $index => $p)
                                        @if($index > 0) <span class="mx-2 text-gray-600">+</span> @endif
                                        <span class="inline-flex items-baseline">
                                            @if($p['coeff'] > 1)<span class="text-[#0004FD] font-bold mr-1">{{ $p['coeff'] }}</span>@endif
                                            <span class="font-bold text-[#00821A]">{!! $p['html'] !!}</span>
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                function hideResult() {
                    const resultSection = document.querySelector('#result-section');
                    if (resultSection) resultSection.classList.add('hidden');
                }

                document.querySelector('#chemical-eq-input').addEventListener('input', hideResult);

                document.querySelector('#load_example').addEventListener('click', function() {
                    var eq = [
                        "Cr2O7^2- + H^+ + e^- = Cr^3+ + H2O",
                        "S^2- + I2 = I^- + S",
                        "Mg + HCl = MgCl2 + H2",
                        "C6H12O6 + O2 = CO2 + H2O",
                        "H2 + O2 = H2O",
                        "Al + Fe2O4 = Fe + Al2O3",
                        "Fe + O2 = Fe2O3",
                        "NH3 + O2 = NO + H2O"
                    ];
                    var t = eq[Math.floor(Math.random() * eq.length)];
                    var inputEl = document.querySelector("#chemical-eq-input");
                    inputEl.value = t;
                    hideResult();
                    inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                });

                document.querySelectorAll('.check').forEach(function(element) {
                    element.addEventListener('click', function() {
                        var value = this.textContent;
                        var inputEl = document.querySelector('#chemical-eq-input');
                        inputEl.value = inputEl.value + value;
                        hideResult();
                        inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                    });
                });

                document.querySelector('#spc').addEventListener('click', function() {
                    var inputEl = document.querySelector('#chemical-eq-input');
                    inputEl.value = inputEl.value + ' ';
                    hideResult();
                    inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                });

                document.querySelector('#clr').addEventListener('click', function() {
                    var inputEl = document.querySelector('#chemical-eq-input');
                    inputEl.value = '';
                    hideResult();
                    inputEl.dispatchEvent(new Event('input', { bubbles: true }));
                });
            });
        </script>
    @endpush
</div>
