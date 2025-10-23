<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @if (isset($error))
           <div class="col-12 mx-auto mt-2 w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                       @if ($_POST['unit_type'] == 'submit')

                       <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit submit" id="submit">
                            Basis Point Calculator
                        </div>
                    </div>
                       @else
                       <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  submit" id="submit">
                            Basis Point Calculator
                        </div>
                    </div>
                       @endif

                       @if ($_POST['unit_type'] == 'submit1')
                       <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit submit1" id="submit1">
                            What is x bps of y?
                        </div>
                    </div>
                       @else
                       <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  submit1" id="submit1">
                            What is x bps of y?
                        </div>
                    </div>
                       @endif

                   </div>
               </div>
           @else
               @if (isset($detail))

               <div class="col-12 mx-auto mt-2 w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    @if ($_POST['unit_type'] == 'submit')
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit submit" id="submit">
                            Basis Point Calculator
                        </div>
                    </div>
                    @elseif($_POST['unit_type'] == '')

                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit submit" id="submit">
                            Basis Point Calculator
                        </div>
                    </div>

                    @else
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  submit" id="submit">
                            Basis Point Calculator
                        </div>
                    </div>

                    @endif
                    @if ($_POST['unit_type'] == 'submit1')
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit submit1" id="submit1">
                            What is x bps of y?
                        </div>
                    </div>
                    @else
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white submit1" id="submit1">
                            What is x bps of y?
                        </div>
                    </div>
                    @endif
                </div>
            </div>
               @else
               <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit submit" id="submit">
                            Basis Point Calculator
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white submit1" id="submit1">
                            What is x bps of y?
                        </div>
                    </div>
                </div>
               </div>
               @endif
           @endif

           <input type="hidden" name="unit_type" id="unit_type" value="submit">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12" id="firsts">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <p class="col-span-12 py-2"><strong>{{ $lang[1] }}:</strong> {{ $lang[2] }}.</p>
                    <div class="col-span-6">
                        <label for="dec" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" class="input" name="dec" id="dec"
                                value="{{ isset($_POST['dec']) ? $_POST['dec'] : '25' }}" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="percent" class="font-s-14 text-blue">{{ $lang['4'] }} (%):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" class="input" name="percent" id="percent"
                                value="{{ isset($_POST['percent']) ? $_POST['percent'] : '' }}" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="perm" class="font-s-14 text-blue">{{ $lang['5'] }} (‰):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" class="input" name="perm" id="perm"
                                value="{{ isset($_POST['perm']) ? $_POST['perm'] : '' }}" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="bsp" class="font-s-14 text-blue">{{ $lang['6'] }} (‰):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" class="input" name="bsp" id="bsp"
                                value="{{ isset($_POST['bsp']) ? $_POST['bsp'] : '' }}" placeholder="00">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-12 hidden" id="second">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                    <p class="col-span-12 my-2"><strong>{{ $lang[7] }}?</strong></p>
                    <p class="col-span-12 "><strong>{{ $lang[1] }}:</strong> {{ $lang[8] }}.</p>

                    <div class="col-span-6 ">
                        <label for="bps1" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="bps1" id="bps1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bps1']) ? $_POST['bps1'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="bps_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bps_unit_dropdown')">{{ isset($_POST['bps_unit'])?$_POST['bps_unit']:'decimal' }} ▾</label>
                            <input type="text" name="bps_unit" value="{{ isset($_POST['bps_unit'])?$_POST['bps_unit']:'decimal' }}" id="bps_unit" class="hidden">
                            <div id="bps_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bps_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bps_unit', 'decimal')">decimal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bps_unit', 'percent')">percent</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bps_unit', 'permille')">permille</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bps_unit', 'bps')">bps</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6">
                        <label for="of" class="font-s-14 text-blue">{{ $lang[9] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" class="input" name="of" id="of"
                                value="{{ isset($_POST['of']) ? $_POST['of'] : '10000' }}" placeholder="00">
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6 ">
                        <label for="equals" class="font-s-14 text-blue">{{ $lang[10] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" class="input" name="equals" id="equals"
                                value="{{ isset($_POST['equals']) ? $_POST['equals'] : '10' }}" placeholder="00">
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            @if ($detail['ans'] == 1)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (%) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['percent'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (‰)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['perm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['bsp'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 2)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dec'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (‰)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['perm'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['bsp'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 3)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dec'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (%)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['percent'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['bsp'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 4)
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dec'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (%)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['percent'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (‰) </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['perm'] }}</td>
                                </tr>
                            @elseif($detail['ans'] == 5)
                                <p class="mt-2">
                                    <strong>
                                        {{ $detail['bps1'] }} bps {{ $lang[9] }} {{ $currancy }} {{ $detail['of'] }}
                                        {{ $lang[10] }} {{ $currancy }} {{ $detail['equals'] }}
                                    </strong>
                                </p>
                                <p class="mt-2"><strong>{{ $lang[12] }}:</strong></p>
                                <p class="mt-2">
                                    {{ $lang[13] }} {{ $detail['bps1'] }} bps {{ $lang[14] }} {{ $currancy }}
                                    {{ $detail['of'] }}
                                    {{ $lang[15] }} {{ $currancy }} {{ $detail['equals'] }} {{ $lang[16] }}
                                    {{ $currancy }} {{ $detail['equals'] + $detail['of'] }}
                                </p>
                            @endif
        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endisset
</form>
@push('calculatorJS')
<script>
    @if (isset($detail))
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'submit')
            document.querySelectorAll('.submit1').forEach(function(metricElement) {
                metricElement.classList.remove('tagsUnit')
            })
            document.getElementById('unit_type').value = "submit"
            var firsts = document.getElementById('firsts');
            var second = document.getElementById('second');

            if (firsts && second) {
                firsts.classList.remove('hidden');
                second.classList.add('hidden');
            }
        @endif
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'submit1')
            document.querySelectorAll('.submit').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit')
            })

            document.getElementById('unit_type').value = "submit1"
            var firsts = document.getElementById('firsts');
            var second = document.getElementById('second');

            if (firsts && second) {
                firsts.classList.add('hidden');
                second.classList.remove('hidden');
            }
        @endif
    @endif

    @if (isset($error))
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'submit')
            document.querySelectorAll('.submit1').forEach(function(metricElement) {
                metricElement.classList.remove('tagsUnit')
            })
            document.getElementById('unit_type').value = "submit"
            var firsts = document.getElementById('firsts');
            var second = document.getElementById('second');

            if (firsts && second) {
                firsts.classList.remove('hidden');
                second.classList.add('hidden');
            }
        @endif
        @if (isset($_POST['unit_type']) && $_POST['unit_type'] === 'submit1')
            document.querySelectorAll('.submit').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit')
            })

            document.getElementById('unit_type').value = "submit1"
            var firsts = document.getElementById('firsts');
            var second = document.getElementById('second');

            if (firsts && second) {
                firsts.classList.add('hidden');
                second.classList.remove('hidden');
            }
        @endif
    @endif


    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.submit').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.submit1').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "submit"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');

                if (firsts && second) {
                    firsts.classList.remove('hidden');
                    second.classList.add('hidden');
                }
            })
        })
        document.querySelectorAll('.submit1').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.submit').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })

                document.getElementById('unit_type').value = "submit1"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');

                if (firsts && second) {
                    firsts.classList.add('hidden');
                    second.classList.remove('hidden');
                }
            })
        })
    });
</script>
@endpush

