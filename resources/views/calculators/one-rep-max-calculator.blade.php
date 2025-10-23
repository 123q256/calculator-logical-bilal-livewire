<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">   


                <div class="col-lg-6 col-12 px-2 pe-lg-4">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'lbs' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'lbs' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                     </div>
                </div>
            <div class="col-lg-6 px-2 ps-lg-4">
                <label for="rep" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="rep" id="rep" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['rep'])?$_POST['rep']:'20' }}" />
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
                    @php
                        $weight_unit = $detail['request']->weight_unit;
                    @endphp
                    <div class="w-full">
                        <div class="w-full text-center">
                            <p class="text-[20px]"><strong>{{ $lang[3] }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong>{{ round($detail['ans'],1) }} <span class="font_size22">{{ $weight_unit }}</span></strong></p>
                        </div>
                    </div>
                        <div class="w-full overflow-auto mt-3">
                            <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                <tr>
                                    <th class="text-start text-blue border-b py-2">% of 1RM</th>
                                    <th class="text-start text-blue border-b py-2">{{ $lang[4] }}</th>
                                    <th class="text-start text-blue border-b py-2">{{ $lang[5] }} 1RM</th>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">100%</td>
                                    <td class="border-b py-2">{{ round($detail['ans'],1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">1</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">95%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.95,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">2</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">90%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.90,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">4</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">85%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.85,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">6</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">80%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.80,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">8</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">75%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.75,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">10</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">70%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.70,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">12</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">65%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.65,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">16</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">60%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.60,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">20</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">55%</td>
                                    <td class="border-b py-2">{{ round($detail['ans']*0.55,1).' '.$weight_unit }}</td>
                                    <td class="border-b py-2">24</td>
                                </tr>
                                <tr>
                                    <td class="py-2">50%</td>
                                    <td class="py-2">{{ round($detail['ans']*0.5,1).' '.$weight_unit }}</td>
                                    <td class="py-2">30</td>
                                </tr>
                            </table>
                        </div>
                        <p class="text-[20px] mt-3"><strong class="text-blue">{{ $lang[6] }} % of 1RM</strong></p>
                        <div class="w-full overflow-auto">
                            <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                            <tr>
                                <th class="text-start text-blue border-b py-2">{{ $lang[2] }}</th>
                                <th class="text-start text-blue border-b py-2">{{ $lang[4] }}</th>
                                <th class="text-start text-blue border-b py-2">% of 1RM</th>
                            </tr>
                            <tr>
                                <td class="border-b py-2">1</td>
                                <td class="border-b py-2">{{ round($detail['ans'],1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">100%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">2</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.97,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">97%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">3</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.94,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">94%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">4</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.92,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">92%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">5</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.89,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">89%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">6</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.86,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">86%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">7</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.83,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">83%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">8</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.81,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">81%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">9</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.78,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">78%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">10</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.75,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">75%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">11</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.73,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">73%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">12</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.71,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">71%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">13</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.70,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">70%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">14</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.68,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">68%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">15</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.67,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">67%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">16</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.65,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">65%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">17</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.64,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">64%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">18</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.63,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">63%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">19</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.61,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">61%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">20</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.60,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">60%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">21</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.59,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">59%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">22</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.58,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">58%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">23</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.57,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">57%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">24</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.56,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">56%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">25</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.55,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">55%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">26</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.54,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">54%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">27</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.53,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">53%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">28</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.52,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">52%</td>
                            </tr>
                            <tr>
                                <td class="border-b py-2">29</td>
                                <td class="border-b py-2">{{ round($detail['ans']*0.51,1).' '.$weight_unit }}</td>
                                <td class="border-b py-2">51%</td>
                            </tr>
                            <tr>
                                <td class="py-2">30</td>
                                <td class="py-2">{{ round($detail['ans']*0.50,1).' '.$weight_unit }}</td>
                                <td class="py-2">50%</td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>