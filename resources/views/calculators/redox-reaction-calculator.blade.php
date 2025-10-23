<style>
    .t_set tr{
        border-color:transparent
    }
    .t_set tr td:hover{
        cursor:pointer
    }
    .t_set .btn-small{
        display:table-cell
    }
    .bt_set{
        background: #2845F5;
        letter-spacing: 0.5px;
        cursor: pointer;
        padding: 0 16px;
        font-size: 13px;
        min-height: 32.4px;
        border: none;
        border-radius: 2px;
        box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);
    }
    .t1{
        background:#F4CDCD;
    }
    .t2{
        background:#ACDFEC;
    }
    .t3{
        background:#85E185;
    }
    .t4{
        background:#EACE5D;
    }
    .t5{
        background:#F1F165;
    }
    .t6{
        background:#E5BDE5;
    }
    .t7{
        background:#F6D4A2;
    }
    .t8{
        background:#FACCDB;
    }
    .t9{
        background:#9EE5D4;
    }
    .t10{
        background:#E9E9E9;
    }
    .check{
        padding: 5px
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1    gap-4">
                    <div class="space-y-2 relative">
                        <label for="eq" class="font-s-14 text-blue">&nbsp;</label>
                        <button type="button" class="bt_set text-white" id="load_example">{!! $lang['2'] !!}</button>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="eq" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <input type="text" step="any" name="eq" id="eq" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->eq)?request()->eq:'Cr2O7^2- + H^+ + e^- = Cr^3+ + H2O' }}" />
                    </div>
                </div>
           </div>
           <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                    <div class="w-full overflow-auto px-2">
                        <table class="w-full t_set text-center" cellpadding="7">
                        <tbody>
                            <tr>
                            <td class="check t3">H</td>
                            <td colspan="16"></td>
                            <td class="check t6">He</td>
                            </tr>
                            <tr>
                            <td class="check t4">Li</td>
                            <td class="check t5">Be</td>
                            <td colspan="10"></td>
                            <td class="check t9">B</td>
                            <td class="check t3">C</td>
                            <td class="check t3">N</td>
                            <td class="check t3">O</td>
                            <td class="check t3">F</td>
                            <td class="check t6">Ne</td>
                            </tr>
                            <tr>
                            <td class="check t4">Na</td>
                            <td class="check t5">Mg</td>
                            <td colspan="10"></td>
                            <td class="check t2">Al</td>
                            <td class="check t9">Si</td>
                            <td class="check t3">P</td>
                            <td class="check t3">S</td>
                            <td class="check t3">Cl</td>
                            <td class="check t6">Ar</td>
                            </tr>
                            <tr>
                            <td class="check t4">K</td>
                            <td class="check t5">Ca</td>
                            <td class="check t1">Sc</td>
                            <td class="check t1">Ti</td>
                            <td class="check t1">V</td>
                            <td class="check t1">Cr</td>
                            <td class="check t1">Mn</td>
                            <td class="check t1">Fe</td>
                            <td class="check t1">Co</td>
                            <td class="check t1">Ni</td>
                            <td class="check t1">Cu</td>
                            <td class="check t1">Zn</td>
                            <td class="check t2">Ga</td>
                            <td class="check t9">Ge</td>
                            <td class="check t9">As</td>
                            <td class="check t3">Se</td>
                            <td class="check t3">Br</td>
                            <td class="check t6">Kr</td>
                            </tr>
                            <tr>
                            <td class="check t4">Rb</td>
                            <td class="check t5">Sr</td>
                            <td class="check t1">Y</td>
                            <td class="check t1">Zr</td>
                            <td class="check t1">Nb</td>
                            <td class="check t1">Mo</td>
                            <td class="check t1">Tc</td>
                            <td class="check t1">Ru</td>
                            <td class="check t1">Rh</td>
                            <td class="check t1">Pd</td>
                            <td class="check t1">Ag</td>
                            <td class="check t1">Cd</td>
                            <td class="check t2">In</td>
                            <td class="check t2">Sn</td>
                            <td class="check t9">Sb</td>
                            <td class="check t9">Te</td>
                            <td class="check t3">I</td>
                            <td class="check t6">Xe</td>
                            </tr>
                            <tr>
                            <td class="check t4">Cs</td>
                            <td class="check t5">Ba</td>
                            <td class="check t7">La</td>
                            <td class="check t1">Hf</td>
                            <td class="check t1">Ta</td>
                            <td class="check t1">W</td>
                            <td class="check t1">Re</td>
                            <td class="check t1">Os</td>
                            <td class="check t1">Ir</td>
                            <td class="check t1">Pt</td>
                            <td class="check t1">Au</td>
                            <td class="check t1">Hg</td>
                            <td class="check t2">TI</td>
                            <td class="check t2">Pb</td>
                            <td class="check t2">Bi</td>
                            <td class="check t9">Po</td>
                            <td class="check t9">At</td>
                            <td class="check t6">Rn</td>
                            </tr>
                            <tr>
                            <td class="check t4">Fr</td>
                            <td class="check t5">Ra</td>
                            <td class="check t8">Ac</td>
                            <td class="check t1">Rf</td>
                            <td class="check t1">Db</td>
                            <td class="check t1">Sg</td>
                            <td class="check t1">Bh</td>
                            <td class="check t1">Hs</td>
                            <td class="check t10">Mt</td>
                            <td class="check t10">Ds</td>
                            <td class="check t10">Rg</td>
                            <td class="check t10">Cn</td>
                            <td class="check t10">Nh</td>
                            <td class="check t10">FI</td>
                            <td class="check t10">Mc</td>
                            <td class="check t10">Lv</td>
                            <td class="check t10">Ts</td>
                            <td class="check t10">Og</td>
                            </tr>
                            <tr>
                            <td colspan="18"></td>
                            </tr>
                            <tr>
                            <td colspan="4" class="text-start"><strong>{{ $lang['3'] }}</strong></td>
                            <td class="check t7">Ce</td>
                            <td class="check t7">Pr</td>
                            <td class="check t7">Nd</td>
                            <td class="check t7">Pm</td>
                            <td class="check t7">Sm</td>
                            <td class="check t7">Eu</td>
                            <td class="check t7">Gd</td>
                            <td class="check t7">Tb</td>
                            <td class="check t7">Dy</td>
                            <td class="check t7">Ho</td>
                            <td class="check t7">Er</td>
                            <td class="check t7">Tm</td>
                            <td class="check t7">Yb</td>
                            <td class="check t7">Lu</td>
                            </tr>
                            <tr>
                            <td colspan="4" class="text-start"><strong>{{ $lang['4'] }}</strong></td>
                            <td class="check t8">Th</td>
                            <td class="check t8">Pa</td>
                            <td class="check t8">U</td>
                            <td class="check t8">Np</td>
                            <td class="check t8">Pu</td>
                            <td class="check t8">Am</td>
                            <td class="check t8">Cm</td>
                            <td class="check t8">Bk</td>
                            <td class="check t8">Cf</td>
                            <td class="check t8">Es</td>
                            <td class="check t8">Fm</td>
                            <td class="check t8">Md</td>
                            <td class="check t8">No</td>
                            <td class="check t8">Lr</td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="col-10">
                        <table class="w-full mt-3 text-center t_set" cellpadding="7">
                            <tbody>
                            <tr>
                                <td id="spc" class="text-white radius-20 bt_set">{{ $lang['5'] }}</td>
                                <td class="check t6">1</td>
                                <td class="check t6">2</td>
                                <td class="check t6">3</td>
                                <td class="check t6">4</td>
                                <td class="check t6">5</td>
                                <td class="check t6">6</td>
                                <td class="check t6">7</td>
                                <td class="check t6">8</td>
                                <td class="check t6">9</td>
                                <td class="check t6">0</td>
                                <td class="check t6">+</td>
                                <td class="check t6">=</td>
                                <td id="clr" class="text-white radius-20 bt_set mt-3">{{ $lang['6'] }}</td>
                            </tr>
                            </tbody>
                        </table>
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
                        <div class="w-full text-center">
                            <input type="hidden" id="input_equ" value="{!! $detail['eq'] !!}">
                            <p><strong>{!! $lang[7] !!}</strong></p>
                            <p class="md:text-[20px] lg:text-[20px] ">{!! $detail['eq'] !!}</p>
                            <b><span id="message" class="text-red"></span></b>
                            <code id="codevalid"></code>
                            <p class=""><strong>{!! $lang[8] !!}:</strong></p>
                            <div class="md:text-[20px] lg:text-[20px]" id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="{{ asset('js/reaction.js') }}"></script>
        @endisset
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @isset($detail)
                    redox_reaction()
                @endisset

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
                    document.querySelector("#eq").value = t;
                });

                document.querySelectorAll('.check').forEach(function(element) {
                    element.addEventListener('click', function() {
                        var value = this.textContent;
                        var eq_val = document.querySelector('#eq').value;
                        document.querySelector('#eq').value = eq_val + value;
                    });
                });

                document.querySelector('#spc').addEventListener('click', function() {
                    var value = document.querySelector('#eq').value;
                    document.querySelector('#eq').value = value + ' ';
                });

                document.querySelector('#clr').addEventListener('click', function() {
                    document.querySelector('#eq').value = '';
                });
            });

            @if(isset($detail))
                function loadMathJax(){
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            @endif
        </script>
    @endpush
</form>