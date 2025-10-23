<form class="row inputsection" action="{{url()->current()}}/" method="POST" name="entryForm">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                    <div class="grid grid-cols-12    gap-4">
                        <div class="col-span-7">
                            <label for="no1" class="label">{{ $lang['1'] }}(M)</label>
                            <div class="w-100 py-2 position-relative"> 
                                <input type="number" step="any" name="no1" id="no1" class="input" aria-label="input"  value="{{ isset($_POST['no1'])?$_POST['no1']:'1' }}" />
                            </div>
                        </div>
                        <div class="col-span-5 ">
                            <label for="opt1" class="label">&nbsp;</label>
                            <div class="w-100 py-2"> 
                                <select name="opt1" id="opt1" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}

                                        $name = [
                                            "Chlorine (Cl) - Standard Atomic Weight",
                                            "Chlorine molecule (Cl₂) - Molecular Mass",
                                            "Gram Per Mole",
                                            "Hydrogen (H) - Standard Atomic Weight",
                                            "Hydrogen molecule (H₂) - Molecular Mass",
                                            "Iron (Fe) - Standard Atomic Weight",
                                            "Kilogram Per Mole",
                                            "Oxygen (O) - Standard Atomic Weight",
                                            "Sulfur (S) - Standard Atomic Weight",
                                            "Sulfur molecule (S₈) - Molecular Mass",
                                            "Table salt (sodium chloride) (NaCl) - Molecular Mass",
                                            "Table sugar (sucrose) (C₁₂H₂₂O₁₁) - Molecular Mass",
                                            "Water Molecule (H₂O) - Molecular Mass"
                                        ];
                                        $val = [
                                            "28.20635771303@@Chlorine (Cl) - Standard Atomic Weight",
                                            "14.10317885651@@Chlorine molecule (Cl₂) - Molecular Mass",
                                            "1000@@Gram Per Mole",
                                            "992.122546977@@Hydrogen (H) - Standard Atomic Weight",
                                            "496.0612734885@@Hydrogen molecule (H₂) - Molecular Mass",
                                            "17.90670606142@@Iron (Fe) - Standard Atomic Weight",
                                            "1@@Kilogram Per Mole",
                                            "62.50234383789@@Oxygen (O) - Standard Atomic Weight",
                                            "31.1866521129@@Sulfur (S) - Standard Atomic Weight",
                                            "3.898331514112@@Sulfur molecule (S₈) - Molecular Mass",
                                            "17.11075659692@@Table salt (sodium chloride) (NaCl) - Molecular Mass",
                                            "2.921444006669@@Table sugar (sucrose) (C₁₂H₂₂O₁₁) - Molecular Mass",
                                            "55.50843506179@@Water Molecule (H₂O) - Molecular Mass"
                                        ];

                                        optionsList($val,$name,isset($_POST['opt1'])?$_POST['opt1']: '1@@Kilogram Per Mole' );
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-7 ">
                        <label for="no2" class="label">{{ $lang['2'] }}</label>
                        <div class="w-100 py-2 position-relative"> 
                            <input type="number" step="any" name="no2" id="no2" class="input" aria-label="input"  value="{{ isset($_POST['no2'])?$_POST['no2']:'1' }}" />
                        </div>
                        </div>
                        <div class="col-span-5 lawn_mowed">
                        <label for="opt2" class="label">&nbsp;</label>
                        <div class="w-100 py-2"> 
                            <select name="opt2" id="opt2" class="input">
                                @php
                                  $name = [
                                    "Assarion (Biblical Roman)",
                                    "Atomic Mass Unit",
                                    "Attogram",
                                    "Bekan (Biblical Hebrew)",
                                    "Carat",
                                    "Centigram",
                                    "Dalton",
                                    "Decagram",
                                    "Decigram",
                                    "Denarius (Biblical Roman)",
                                    "Deuteron Mass",
                                    "Didrachma (Biblical Greek)",
                                    "Drachma (Biblical Greek)",
                                    "Earth's Mass",
                                    "Electron Mass (Rest)",
                                    "Exagram",
                                    "Femtogram",
                                    "Gamma",
                                    "Gerah (Biblical Hebrew)",
                                    "Gigagram",
                                    "Gigatonne",
                                    "Grain",
                                    "Gram",
                                    "Hectogram",
                                    "Hundredweight(UK)",
                                    "Jupiter Mass",
                                    "Kilogram",
                                    "Kilo-Force Square Second Per Foot",
                                    "KiloPound",
                                    "Kiloton(Metric)",
                                    "Lepton (Biblical Roman)",
                                    "Megragram",
                                    "Megatonne",
                                    "Microgram",
                                    "Milligram",
                                    "Mina(Biblical Greek)",
                                    "Mina(Biblical Hebrew)",
                                    "Muon Mass",
                                    "Nanogram",
                                    "Neutron Mass",
                                    "Ounce",
                                    "Pennyweight",
                                    "Petagram",
                                    "Picogram",
                                    "Planck Mass",
                                    "Pound",
                                    "Pound(Troy or Apothecary)",
                                    "Poundal",
                                    "Pound-Force Square Second Per Foot",
                                    "Proton Mass",
                                    "Quadrans(Biblical Romans)",
                                    "Quarter(UK)",
                                    "Quarter(US)",
                                    "Quintal",
                                    "Scruple(Apotherapy)",
                                    "Shekel(Biblical Hebrew)",
                                    "Slug",
                                    "Solar Mass",
                                    "Stone (UK)",
                                    "Stone (US)",
                                    "Sun's Mass",
                                    "Talent(Biblical Greek)",
                                    "Talent(Biblical Hebrew)",
                                    "Teragram",
                                    "Tetradrachma(Biblical Greek)",
                                    "Ton (Assay)(UK)",
                                    "Ton (Assay)(US)",
                                    "Ton(Long)",
                                    "Ton(Metric)",
                                    "Ton(Short)",
                                    "Tonne"
                                  ];
                                  $val = [
                                    "4155.8441558@@Assarion (Biblical Roman)",
                                    "6.022136651E+26@@Atomic Mass Unit",
                                    "1E+21@@Attogram",
                                    "175.43859649@@Bekan (Biblical Hebrew)",
                                    "5000@@Carat",
                                    "100000@@Centigram",
                                    "6.022173643E+26@@Dalton",
                                    "100@@Decagram",
                                    "10000@@Decigram",
                                    "259.74025974@@Denarius (Biblical Roman)",
                                    "2.990800894E+26@@Deutron Mass",
                                    "2.990800894E+26@@Didrachma (Biblical Greek)",
                                    "1.67336010709505E-25@@Drachma (Biblical Greek)",
                                    "9.10938970730895E-31@@Earth's Mass",
                                    "1E-15@@Electron Mass (Rest)",
                                    "1E+15@@Exagram",
                                    "1E+18@@Femtogram",
                                    "1000000000@@Gamma",
                                    "1754.3859649@@Gerah (Biblical Hebrew)",
                                    "5.978633201E+26@@Gigagram",
                                    "1E-12@@Gigatonne",
                                    "15432.358353@@Grain",
                                    "1000@@Gram",
                                    "10@@Hectogram",
                                    "0.0196841306@@Hundredweight(UK)",
                                    "5.26592943654555E-28@@Jupiter Mass",
                                    "1@@Kilogram",
                                    "0.1019716213@@Kilo-Force Square Second Per Foot",
                                    "0.0022046226218@@KiloPound",
                                    "1E-06 Kiloton@@Kiloton(Metric)",
                                    "33246.753247@@Lepton (Biblical Roman)",
                                    "0.001@@Megragram",
                                    "1E-09@@Megatonne",
                                    "1000000000@@Microgram",
                                    "1000000@@Milligram",
                                    "2.9411764706@@Mina(Biblical Greek)",
                                    "2.9411764706@@Mina(Biblical Hebrew)",
                                    "5.309172492E+27@@Muon Mass",
                                    "1000000000000@@Nanogram",
                                    "5.970403753E+26@@Neutron Mass",
                                    "35.27396195@@Ounce",
                                    "643.01493137@@Pennyweight",
                                    "1E-12@@Petagram",
                                    "1E+15@@Picogram",
                                    "45940892.448@@Planck Mass",
                                    "45940892.448@@Pound",
                                    "2.6792288807@@Pound(Troy or Apothecary)",
                                    "70.988848424@@Poundal",
                                    "0.0685217658999999@@Pound-Force Square Second Per Foot",
                                    "5.978633201E+26@@Proton Mass",
                                    "16623.376623@@Quadrans(Biblical Romans)",
                                    "0.0787365221999998@@Quarter(UK)",
                                    "0.0881849049000002@@Quarter(US)",
                                    "0.01@@Quintal",
                                    "0.000984206527611061@@Scruple(Apotherapy)",
                                    "87.719298246@@Shekel(Biblical Hebrew)",
                                    "87.719298246@@Slug",
                                    "1.988E+30@@Solar Mass",
                                    "0.1574730444@@Stone (UK)",
                                    "0.1763698097@@Stone (US)",
                                    "5.02765208647562E-31@@Sun's Mass",
                                    "0.0490196078@@Talent(Biblical Greek)",
                                    "0.0292397661@@Talent(Biblical Hebrew)",
                                    "1E-09@@",
                                    "73.529411765@@Tetradrachma(Biblical Greek)",
                                    "30.612244898@@Ton (Assay)(UK)",
                                    "34.285710367@@Ton (Assay)(US)",
                                    "0.000984206527611061@@Ton(Long)",
                                    "0.001@@Ton(Metric)",
                                    "0.0011023113@@Ton(Short)",
                                    "0.001@@Tonne"
                                  ];
                                    optionsList($val,$name,isset($_POST['opt2'])?$_POST['opt2']: '1@@Kilogram Per Mole' );
                                @endphp
                            </select>
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
                    <div class="w-full mt-3 ">
                        <div class="w-full padding_0  canvas_div_pdf font_size18" id="printThis">
                            <div class="col m10 s12">
                              <div class="text-center pt-1 pb-2">
                                <p class=" text-blue-500 text-[20px] relative inline-block rounded-full  p-3">
                                    {!! $lang['3'] !!}
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#ffffff] text-[#ff6d00] px-3 py-2 rounded-lg d-inline-block my-3">

                               {{ round($detail['final_result3'],5) }}</p>
                            </div>
                            </div>



                              <p class="w-full py-2 text-[25px] text-blue-500 margin_top_10"><strong><?=$lang['4']?>:</strong></p>
                              <p class="w-full py-2 font_size20 margin_top_15"><strong><?=$lang['5']?>:</strong></p>
                              <p class="w-full py-2 font_size18"><?=$lang['1']?> = <?=$detail['no1'].' '.$detail['name']?> <br> <?=$lang['2']?> = <?=$detail['no2'].' '.$detail['name2']?></p>
                              <p class="w-full py-2 font_size20 margin_top_15"><strong><?=$lang['6']?>:</strong></p>
                              <p class="w-full py-2 font_size18"><?=$lang['3']?> = <?=$lang['1']?> / <?=$lang['2']?></p>
                              <p class="w-full py-2 font_size20 margin_top_15 text-blue-500"><strong><?=$lang['7']?>:</strong></p>
                              <p class="w-full py-2 font_size18"><strong><?=$lang['1']?>:</strong> 1 <?=$detail['name']?> = <?=$detail['nbr1']?> <?=$lang['8']?></p>
                              <p class="w-full py-2 font_size18"><?=$lang['9']?> <?=$detail['no1'].' '.$detail['name']?> <?=$lang['10']?>, <br> <strong><?=$lang['1']?></strong> = <?=$detail['no1'].' / '.$detail['nbr1']?> = <?=$detail['final_result1']?> <?=$lang['8']?></p>
                              <p class="w-full py-2 font_size18 margin_top_15"><strong><?=$lang['2']?>:</strong> 1 <?=$detail['name2']?> = <?=$detail['nbr2']?> <?=$lang['11']?> </p>
                              <p class="w-full py-2 font_size18"><?=$lang['9']?> <?=$detail['no2'].' '.$detail['name2']?> <?=$lang['12']?>, <br> <strong><?=$lang['2']?></strong> = <?=$detail['no2'].' / '.$detail['nbr2']?> = <?=$detail['final_result2']?> <?=$lang['11']?></p>
                              <p class="w-full py-2 font_size20 margin_top_15 text-blue-500"><strong><?=$lang['3']?>:</strong></p>
                              <p class="w-full py-2 font_size18">= <?=$lang['1']?> / <?=$lang['2']?></p>
                              <p class="w-full py-2 font_size18">= <?=$detail['final_result1']?> / <?=$detail['final_result2']?></p>
                              <p class="w-full py-2 font_size18 orange-text text-accent-4"><strong>= <?=round($detail['final_result3'],5)?></strong></p>
                            </div>
                          </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script src=<?=asset('assets/js/molecular-formula.js?v=0.0.1')?>></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('cal_fifo').addEventListener('click', function() {
            if(document.getElementById('inputformula').value != ''){
                document.querySelector('.result').style.display = "block";
                document.querySelector('.reset').style.display = "block";
                document.querySelector('.bg-light-blue').classList.add('bg-white');
                document.querySelector('.bg-light-blue').classList.add('shadow');
                var formulaValue = document.entryForm.inputFormula.value;
                var updatedFormulaValue = formulaValue.replace(/[A-Z][a-z]?\d*/g, function(match) {
                    var symbol = match.match(/[A-Z][a-z]?/)[0];
                    var number = match.match(/\d+/) ? parseInt(match.match(/\d+/)[0]) : 1; // default to 1 if no number is specified
                    var multipliedValue = (number === 1 ? molarvalue.value : number * molarvalue.value);
                    return symbol + '<sub>' + multipliedValue + '</sub>';
                });
                totlevalue.innerHTML = updatedFormulaValue;

                let scrollTo = document.querySelector('.result');
                let container = document.documentElement || document.body; 
                let scrollAmount = scrollTo.offsetTop - container.getBoundingClientRect().top + container.scrollTop;
                container.scrollTo({
                    top: scrollAmount,
                    behavior: 'smooth'
                });
            }else{
                alert('Please Select any above option');
            }
        });
        function downloadPDF() {
            var n = document.querySelector('.result');
            html2pdf().from(n).set({
                margin: [15, 5, 5, 5],
                filename: "Result by Technical-calculator.com.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    logging: true,
                    dpi: 192,
                    letterRendering: true
                },
                jsPDF: {
                    unit: "mm",
                    format: "a4",
                    orientation: "p"
                },
                pagebreak: {
                    before: ".page-break",
                    avoid: "table"
                },
            }).toPdf().get("pdf").then(function(e) {
                var t = e.internal.getNumberOfPages();
                for (let pageNumber = 1; pageNumber <= t; pageNumber++) {
                    e.setPage(pageNumber);
                    e.setFontSize(8);
                    e.setTextColor(150);
                    e.text(15, 15, "Results from");
                    e.setTextColor(0, 0, 255);
                    e.textWithLink(" Calculator-Online.net", 31, 15, {
                        url: "https://technical-calculator.com/"
                    });
                    var allMathText = "Calculator-Online.net " + pageNumber + "/" + t;
                    var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                    e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                        url: "https://technical-calculator.com/"
                    });
                }
            }).save().catch((e) => {
                console.error(e);
            });
        }

                function printDiv() {
                    var printContents = document.querySelector('.result').innerHTML;
                    var originalContents = document.body.innerHTML;
                    var printableDiv = document.createElement('div');
                    printableDiv.className = 'printable';
                    printableDiv.innerHTML = printContents;
                    document.body.appendChild(printableDiv);

                    var originalStyle = document.body.style.display;
                    document.body.style.display = 'none';
                    printableDiv.style.display = 'block';

                    window.print();

                    printableDiv.remove();
                    document.body.style.display = originalStyle;
                }
                document.getElementById('printButton').addEventListener('click', printDiv);

                // feedback
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('submitFeedback').addEventListener('click', function(event) {
                        event.preventDefault(); 

                        var email = document.getElementById('email').value;
                        var message = document.getElementById('message').value;
                        var name = document.getElementById('name').value;
                        var submitButton = document.getElementById('submitFeedback');
                        var csrfToken = document.querySelector('input[name="_token"]').value;
                        var responseMessage = document.getElementById('response_message');

                        if (!email || !message || !name) {
                            responseMessage.textContent = 'All fields are required.';
                            responseMessage.classList.add('text-danger');
                            responseMessage.classList.remove('green-color');
                            return;
                        }
                        var fullMessage = message + '. This feedback is from, " {{$cal_name}} "';

                        submitButton.disabled = true;
                        submitButton.textContent = 'Sending...';

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '/contact/submit/', true);
                        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                submitButton.disabled = false;
                                submitButton.textContent = 'Submit';
                                // var responseMessage = document.getElementById('response_message');
                                
                                if (xhr.status >= 200 && xhr.status < 300) {
                                    var response = JSON.parse(xhr.responseText);
                                    responseMessage.textContent = response.message;
                                    responseMessage.classList.add('green-color');
                                    responseMessage.classList.remove('text-danger');
                                    document.getElementById('email').value = '';
                                    document.getElementById('message').value = '';
                                    document.getElementById('name').value = '';
                                } else {
                                    responseMessage.textContent = 'An error occurred. Please try again later.';
                                    responseMessage.classList.add('text-danger');
                                    responseMessage.classList.remove('green-color');
                                }
                            }
                        };

                        var data = JSON.stringify({
                            email: email,
                            message: fullMessage,
                            name: name,
                            _token: csrfToken
                        });

                        xhr.send(data);
                    });
                });

                let feedback = document.getElementById("popupDialog");
                if(feedback){
                    let btn = document.getElementById("feedback");
                    let span = document.getElementsByClassName("remove")[0];
                    btn.onclick = function() {
                        feedback.style.display = "block";
                    }
                    span.onclick = function() {
                        feedback.style.display = "none";
                    }
                    window.onclick = function(event) {
                        if (event.target == feedback) {
                            feedback.style.display = "none";
                        }
                    }
                }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>