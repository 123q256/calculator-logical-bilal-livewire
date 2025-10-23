<style>
    @media (max-width: 360px) {
        .calculator-box{
            padding-right: 0rem;
            padding-left: 0rem;
        }
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                   <div class="w-full px-2 mb-2">
                       <p><strong class="text-blue">{{ $lang['limit'] }}</strong></p>
                   </div>
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="lx" class="font-s-14 text-blue">{{ $lang['Mass'] }}</label>
                            <div class="relative w-full ">
                                <input type="number" name="lx" id="lx" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['lx'])?$_POST['lx']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit_x" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_x_dropdown')">{{ isset($_POST['unit_x'])?$_POST['unit_x']:'g' }} ▾</label>
                                <input type="text" name="unit_x" value="{{ isset($_POST['unit_x'])?$_POST['unit_x']:'g' }}" id="unit_x" class="hidden">
                                <div id="unit_x_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'µg')">micrograms (µg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'lbs')">pounds (lbs)</p>
                                </div>
                            </div>
                       </div>
                       <div class="space-y-2 ">
                        <label for="ly" class="font-s-14 text-blue">{!! $lang['weight'] !!}:</label>
                        <div class="w-full py-2 relative">
                        <input type="number" step="any" name="ly" id="ly" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->ly)?request()->ly:'50' }}" />
                        <span class="text-blue input_unit">g / mol</span>
                        </div>
                       </div>
                       <div class="space-y-2 relative">
                        <label for="sx" class="font-s-14 text-blue">{!! $lang['sat'] !!}:</label>
                        <input type="number" step="any" name="sx" id="sx" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->sx)?request()->sx:'0.75' }}" />
                       </div>
                    </div>
                    <div class="col-12 px-2 my-2">
                        <p><strong class="text-blue">{{ $lang['dp'] }}</strong></p>
                    </div>
                    <div class="grid grid-cols-1 my-3 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 relative">
                            <label for="dx" class="font-s-14 text-blue">Mole(s):</label>
                            <input type="number" step="any" name="dx" id="dx" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->dx)?request()->dx:'0.16' }}" />
                        </div>
                        <div class="space-y-2 ">
                            <label for="dy" class="font-s-14 text-blue">{!! $lang['weight'] !!}:</label>
                            <div class="w-full py-2 relative">
                            <input type="number" step="any" name="dy" id="dy" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->dy)?request()->dy:'48' }}" />
                            <span class="text-blue input_unit">g / mol</span>
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
                    <div class="w-full  mt-3">
                       
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2 text-[20px]">
                            <table class="w-100">
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['theo'] }}</strong></td>
                                    <td class="border-b py-2">{{ (isset($detail['ans'])) ? $detail['ans'].' g' : '00 g' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['limit'] }} (moles)</strong></td>
                                    <td class="border-b py-2">{{ (isset($detail['mole'])) ? $detail['mole'] : '00' }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{ $lang['sp'] }}</strong></td>
                                    <td class="border-b py-2">{{ (isset($detail['st'])) ? $detail['st'] : '00' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>