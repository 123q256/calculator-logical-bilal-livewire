<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf



    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
            <input type="hidden" name="calculator_time" id="calculator_time" value="{{ isset($_POST['calculator_time']) ? $_POST['calculator_time'] : 'date_cal' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  pacetab {{ isset(request()->calculator_time) && request()->calculator_time !== 'date_cal'  ? '' :'tagsUnit' }} " id="date_cal">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab  {{ isset(request()->calculator_time) && request()->calculator_time !== 'date_cal'  ? 'tagsUnit' :'' }}" id="time_cal">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">

               <p class="font-s-14 mt-4 text-blue">{{$lang['3']}}</p>
            <div class="grid grid-cols-5  gap-4 time_betw  {{ isset(request()->calculator_time) && request()->calculator_time !== 'date_cal' ? 'flex' : 'hidden' }}">
                <div class="space-y-2">
                    <label for="start_date" class="text-blue text-sm">Date:</label>
                    <div class="py-2">
                        <input type="date" step="any" name="start_date" id="start_date" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->start_date) ? request()->start_date : date('Y-m-d') }}"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="d_start_h" class="text-blue text-sm">Hrs:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="d_start_h" id="d_start_h" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->d_start_h) ? request()->d_start_h : '8' }}" placeholder="Hrs"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="d_start_m" class="text-blue text-sm">Min:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="d_start_m" id="d_start_m" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->d_start_m) ? request()->d_start_m : '30' }}" placeholder="Min"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="d_start_s" class="text-blue text-sm">Sec:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="d_start_s" id="d_start_s" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->d_start_s) ? request()->d_start_s : '0' }}" placeholder="Sec"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="py-2">
                        <label for="d_start_ampm" class="text-blue text-sm">&nbsp;</label>
                        <select name="d_start_ampm" id="d_start_ampm" class="w-full p-2 border border-gray-300 rounded mt-2">
                            @php
                            $name = ["AM", "PM",];
                            $val = ["am", "pm",];
                            optionsList($val,$name,isset(request()->d_start_ampm)?request()->d_start_ampm:'am');
                        @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4  gap-4 time_due {{ isset(request()->calculator_time) && request()->calculator_time !== 'date_cal' ? 'hidden' : 'flex' }}">
                <div class="space-y-2">
                    <label for="t_start_h" class="text-blue text-sm">Hrs:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="t_start_h" id="t_start_h" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->t_start_h) ? request()->t_start_h : '8' }}" placeholder="Hrs"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="t_start_m" class="text-blue text-sm">Min:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="t_start_m" id="t_start_m" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->t_start_m) ? request()->t_start_m : '30' }}" placeholder="Min"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="t_start_s" class="text-blue text-sm">Sec:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="t_start_s" id="t_start_s" class="w-full p-2 border border-gray-300 rounded"
                            value="{{ isset(request()->t_start_s) ? request()->t_start_s : '0' }}" placeholder="Sec"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="py-2">
                        <label for="t_start_ampm" class="text-blue text-sm">&nbsp;</label>
                        <select name="t_start_ampm" id="t_start_ampm" class="w-full p-2 border border-gray-300 rounded mt-2">
                            @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["AM", "PM",];
                                    $val = ["am", "pm",];
                                    optionsList($val,$name,isset(request()->t_start_ampm)?request()->t_start_ampm:'am');
                                @endphp
                        </select>
                    </div>
                </div>
            </div>
            <p class="font-s-14 text-blue mt-2">{{$lang['6']}}</p>
            <div class="grid grid-cols-5 gap-4 time_betw {{ isset(request()->calculator_time) && request()->calculator_time !== 'date_cal' ? 'flex' : 'hidden' }}">
                <div class="space-y-2">
                    <label for="end_date" class="text-blue text-sm">Date:</label>
                    <div class="py-2">
                        <input type="date" step="any" name="end_date" id="end_date" class="input w-full"
                            value="{{ isset(request()->end_date) ? request()->end_date : date('Y-m-d') }}"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="d_end_h" class="text-blue text-sm">Hrs:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="d_end_h" id="d_end_h" class="input w-full"
                            value="{{ isset(request()->d_end_h) ? request()->d_end_h : '5' }}" placeholder="Hrs"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="d_end_m" class="text-blue text-sm">Min:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="d_end_m" id="d_end_m" class="input w-full"
                            value="{{ isset(request()->d_end_m) ? request()->d_end_m : '30' }}" placeholder="Min"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="d_end_s" class="text-blue text-sm">Sec:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="d_end_s" id="d_end_s" class="input w-full"
                            value="{{ isset(request()->d_end_s) ? request()->d_end_s : '0' }}" placeholder="Sec"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="py-2">
                        <label for="d_end_ampm" class="text-blue text-sm">&nbsp;</label>
                        <select name="d_end_ampm" id="d_end_ampm" class="input w-full mt-2">
                            @php
                            $name = ["AM", "PM",];
                            $val = ["am", "pm",];
                            optionsList($val,$name,isset(request()->d_end_ampm)?request()->d_end_ampm:'pm');
                        @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 time_due {{ isset(request()->calculator_time) && request()->calculator_time !== 'date_cal' ? 'hidden' : 'flex' }}">
                <div class="space-y-2">
                    <label for="t_end_h" class="text-blue text-sm">Hrs:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="t_end_h" id="t_end_h" class="input w-full"
                            value="{{ isset(request()->t_end_h) ? request()->t_end_h : '5' }}" placeholder="Hrs"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="t_end_m" class="text-blue text-sm">Min:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="t_end_m" id="t_end_m" class="input w-full"
                            value="{{ isset(request()->t_end_m) ? request()->t_end_m : '30' }}" placeholder="Min"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="t_end_s" class="text-blue text-sm">Sec:</label>
                    <div class="py-2">
                        <input type="number" step="any" name="t_end_s" id="t_end_s" class="input w-full"
                            value="{{ isset(request()->t_end_s) ? request()->t_end_s : '0' }}" placeholder="Sec"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="py-2">
                        <label for="t_end_ampm" class="text-blue text-sm">&nbsp;</label>
                        <select name="t_end_ampm" id="t_end_ampm" class="input w-full mt-2">
                            @php
                            $name = ["AM", "PM",];
                            $val = ["am", "pm",];
                            optionsList($val,$name,isset(request()->t_end_ampm)?request()->t_end_ampm:'pm');
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
                    <div class="w-full p-3 rounded-lg mt-3">
                        <div class="my-2">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-xl">
                                <table class="w-full">
                                    @if(request()->calculator_time == "time_cal")
                                        <tr>
                                            <td class="border-b py-2 font-semibold"><strong>{{$detail['days_ans']}}</strong></td>
                                            <td class="border-b py-2">{{ $lang[7] }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="w-3/5 border-b py-2 font-semibold"><strong>{{$detail['hours']}}</strong></td>
                                        <td class="border-b py-2">{{ $lang['hours'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold"><strong>{{$detail['minutes']}}</strong></td>
                                        <td class="border-b py-2">{{ $lang['minute'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold"><strong>{{$detail['seconds']}}</strong></td>
                                        <td class="border-b py-2">{{ $lang['second'] }}</td>
                                    </tr>
                                    @if(request()->calculator_time == "time_cal")
                                        <tr>
                                            <td class="border-b py-2 font-semibold">{{ $lang[8] }} :</td>
                                            <td class="border-b py-2">{{ $detail['total_days'] }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="border-b py-2 font-semibold">{{ $lang[9] }} :</td>
                                        <td class="border-b py-2">{{ $detail['total_hours'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold">{{ $lang[10] }} :</td>
                                        <td class="border-b py-2">{{ $detail['total_minutes'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold">{{ $lang[11] }} :</td>
                                        <td class="border-b py-2">{{ $detail['total_seconds'] }}</td>
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
            document.getElementById('date_cal').addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('calculator_time').value = "date_cal";
                document.getElementById('time_cal').classList.remove('tagsUnit');
                
                document.querySelectorAll('.time_due').forEach(element => {
                    element.classList.add("flex");
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.time_betw').forEach(element => {
                    element.classList.remove("flex");
                    element.classList.add("hidden");
                });
            });
            document.getElementById('time_cal').addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('calculator_time').value = "time_cal";
                document.getElementById('date_cal').classList.remove('tagsUnit');

                document.querySelectorAll('.time_due').forEach(element => {
                    element.classList.remove("flex");
                    element.classList.add("hidden");
                });
                document.querySelectorAll('.time_betw').forEach(element => {
                    element.classList.add("flex");
                    element.classList.remove("hidden");
                });
            });

        </script>
    @endpush
</form>
