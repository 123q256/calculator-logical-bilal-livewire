<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if (!isset($detail))    
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <p class="col-span-12 text-[18px] px-2 mt-2"><strong># 1</strong></p>
                    <div class="col-span-6 px-2">
                        <label for="force1" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="force[]" id="force1" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">N</span>
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="angle1" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="angle[]" id="angle1" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">deg</span>
                        </div>
                    </div>
                    <p class="col-span-12 text-[18px] px-2 mt-2"><strong># 2</strong></p>
                    <div class="col-span-6 px-2">
                        <label for="force2" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="force[]" id="force2" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">N</span>
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="angle2" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="angle[]" id="angle2" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">deg</span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-12" id="dynamicInputs">
                 

                        
                    
                </div>
                <div class="col-span-12 flex justify-end px-2 mt-3">
                    <button type="button" id="addInputButton" class="bg-[#2845F5] text-white border rounded px-4 py-1"><strong class="text-blue"><span class="text-[18px] text-blue">+</span> &nbsp;Add</strong></button>
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



        

    @endif
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] px-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['4'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Horizontal'], 2) }} N</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['5'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Vertical'], 2) }} N</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['6'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'], 2) }} N</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['7'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Direction'], 2) }} °</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 mt-3 px-2"><strong><?= $lang['8'] ?></strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] px-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['9'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'] * 0.001,2) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['10'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'] * 0.2248,2 ) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b">{{ $lang['11'] }}</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'] * 100000,2) }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" flex justify-center">
            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                @if (app()->getLocale() == 'en')
                    RESET
                @else
                    {{ $lang['reset'] ?? 'RESET' }}
                @endif
            </a>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (!isset($detail))  
        const maxInputs = 10;
        let currentGroup = 2;

        function removeInput(button) {
            const dynamicInputs = document.getElementById('dynamicInputs');
            const div = button.parentElement.parentElement;
            dynamicInputs.removeChild(div);
            currentGroup--;
        }

        function addInput() {
            const dynamicInputs = document.getElementById('dynamicInputs');

            if (currentGroup < maxInputs) {
                const inputNumber = currentGroup + 1;
                const groupName = String.fromCharCode(65 + currentGroup);

                const div = document.createElement('div');
                div.classList.add('grid');
                div.innerHTML = `<p class="col-span-12 text-[18px] px-2 mt-2"><strong># ${inputNumber}</strong></p>
                    <div class="col-span-6 px-2">
                        <label for="force${inputNumber}" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="force[]" id="force${inputNumber}" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">N</span>
                        </div>
                    </div>
                    <div class="col-span-6 px-2 position-relative">
                        <label for="angle${inputNumber}" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="angle[]" id="angle${inputNumber}" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">deg</span>
                        </div>
                        <img src="{{url('assets/img/close.png')}}" alt="Remove" onclick="removeInput(this)" width='13' style="position:absolute;right:10px;top:7px" class="remove">
                    </div>
                    `;
                dynamicInputs.appendChild(div);
                currentGroup++;
            } else {
                alert('You have reached the maximum limit of ' + maxInputs + ' groups.');
            }
        }

        document.getElementById('addInputButton').addEventListener('click', addInput);
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>