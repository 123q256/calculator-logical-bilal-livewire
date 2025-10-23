<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif

   

       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">


        <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 text-center  gap-4">
            <a href="{{ url('date-duration-calculator') }}/" class=" cursor-pointer py-2  " id="date_cal">
                <strong>{{ $lang['41'] }}</strong>
            </a>
            <a href="{{ url('date-calculator') }}/" class=" cursor-pointer py-2 text-[#2845F5] border-b-2 border-[#2845F5]" id="time_cal">
                <strong>{{ $lang['42'] }}</strong>
            </a>
           </div>
    


        <div class="flex flex-wrap">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold"><strong>{{ $error }}</strong></p>
            @endif
    
            <div class="w-full lg:w-1/2 px-2 mt-3 lg:pr-4">
                <label for="add_date" class="text-sm text-blue-500">{{$lang['2']}}:</label>
                <div class="w-full py-2">                                  
                    <input type="date" step="any" name="add_date" id="add_date" class="w-full border rounded-md p-2" aria-label="input"
                    value="{{ isset(request()->add_date) ? request()->add_date : date('Y-m-d') }}"/>
                </div>
            </div>
    
            <div class="w-full lg:w-1/2 px-2 mt-3 lg:pl-4">
                <label for="method" class="text-sm text-blue-500"> <?= $lang[45] ?> / {{$lang['46']}}:</label>
                <div class="w-full py-2">                                  
                    <select name="method" id="method" class="w-full border rounded-md p-2">
                        <option value="add"  {{ isset($_POST['method']) && $_POST['method'] === 'add' ? 'selected' : '' }}>Add (+)</option>
                        <option value="sub"  {{ isset($_POST['method']) && $_POST['method'] === 'sub' ? 'selected' : '' }}>Subtract (-)</option>
                    </select>
                </div>
            </div>
    
            <div class="w-full lg:w-1/2 lg:pr-4">
                <div class="flex flex-wrap">
                    <div class="w-1/2 px-2 lg:pr-1">
                        <label for="years" class="text-sm text-blue-500">{{$lang['47']}}:</label>
                        <div class="w-full py-2">                                  
                            <input type="number" step="any" name="years" id="years" class="w-full border rounded-md p-2" aria-label="input"
                            value="{{ isset(request()->years) ? request()->years : '' }}"/>
                        </div>
                    </div>
                    <div class="w-1/2 px-2 lg:pl-1">
                        <label for="months" class="text-sm text-blue-500">{{$lang['48']}}:</label>
                        <div class="w-full py-2">                                  
                            <input type="number" step="any" name="months" id="months" class="w-full border rounded-md p-2" aria-label="input"
                            value="{{ isset(request()->months) ? request()->months : '' }}"/>
                        </div>
                    </div>
                </div>
    
               <div class="flex flex-wrap inc_time hidden">
                    <div class="w-full flex px-2">
                        <div class="w-1/3 py-2 mx-1">
                            <input type="number" step="any" name="add_hrs_f" id="add_hrs_f" class="w-full border rounded-md p-2" aria-label="input"
                                value="{{ isset(request()->add_hrs_f) ? request()->add_hrs_f : ''}}" placeholder="HH" />
                        </div>
                        <div class="w-1/3 py-2 mx-1">
                            <input type="number" step="any" name="add_min_f" id="add_min_f" class="w-full border rounded-md p-2" aria-label="input"
                                value="{{ isset(request()->add_min_f) ? request()->add_min_f : ''}}" placeholder="MM" />
                        </div>
                        <div class="w-1/3 py-2 mx-1">
                            <input type="number" step="any" name="add_sec_f" id="add_sec_f" class="w-full border rounded-md p-2" aria-label="input"
                                value="{{ isset(request()->add_sec_f) ? request()->add_sec_f : ''}}" placeholder="SS" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 lg:pl-4">
                <div class="flex flex-wrap">
                    <div class="w-1/2 px-2 lg:pl-0">
                        <label for="weeks" class="text-sm text-blue-500">{{$lang['49']}}:</label>
                        <div class="w-full py-2">                                  
                            <input type="number" step="any" name="weeks" id="weeks" class="w-full border rounded-md p-2" aria-label="input"
                            value="{{ isset(request()->weeks) ? request()->weeks : '' }}"/>
                        </div>
                    </div>
                    <div class="w-1/2 px-2">
                        <label for="days" class="text-sm text-blue-500">{{$lang['50']}}:</label>
                        <div class="w-full py-2">                                  
                            <input type="number" step="any" name="days" id="days" class="w-full border rounded-md p-2" aria-label="input"
                            value="{{ isset(request()->days) ? request()->days : '' }}"/>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap inc_time hidden">
                    <div class="w-full flex px-2">
                        <div class="w-1/3 py-2 mx-1">                                  
                            <input type="number" step="any" name="add_hrs_s" id="add_hrs_s" class="w-full border rounded-md p-2" aria-label="input"
                                value="{{ isset(request()->add_hrs_s) ? request()->add_hrs_s : ''}}" placeholder="HH" />
                        </div>
                        <div class="w-1/3 py-2 mx-1">                                  
                            <input type="number" step="any" name="add_min_s" id="add_min_s" class="w-full border rounded-md p-2" aria-label="input"
                                value="{{ isset(request()->add_min_s) ? request()->add_min_s : ''}}" placeholder="MM" />
                        </div>
                        <div class="w-1/3 py-2 mx-1">                                  
                            <input type="number" step="any" name="add_sec_s" id="add_sec_s" class="w-full border rounded-md p-2" aria-label="input"
                                value="{{ isset(request()->add_sec_s) ? request()->add_sec_s : ''}}" placeholder="SS" />
                        </div>
                    </div>
                </div> 
            </div>
            <div class="w-full px-2 lg:pr-4 checkinput  {{ isset(request()->checkbox) && request()->checkbox !== 'checked' ? 'block' : 'hidden' }}">
                <label for="repeat" class="text-sm text-blue-500">{{$lang[52] }}:</label>
                <div class="w-full lg:w-1/2 px-2 mt-3 lg:pr-4">
                    <input type="number" name="repeat" id="repeat" class="w-full border rounded-md p-2" {{ isset(request()->repeat) && request()->repeat != 'checked'  ? 'checked' :'' }}    
                    value="{{ isset(request()->repeat) ? request()->repeat : '' }}"/>
                </div>
            </div>
        </div>
        <div class="flex justify-between px-2">
            <div class="w-1/2">                               
                <input type="checkbox" name="checkbox" id="checkbox" {{ isset(request()->checkbox) && request()->checkbox != 'checked'  ? 'checked' :'' }}
                value="{{ isset(request()->checkbox) ? request()->checkbox : date('Y-m-d') }}"/>
                <label for="checkbox" class="text-sm text-blue-500">{{$lang[51] }}:</label>
            </div>
            <div class="w-1/2 text-right">                               
                <p class="text-sm text-blue-500 cursor-pointer underline" id="inctime">
                    @if (isset(request()->inctime) && request()->inctime != 'time_in')
                        {{$lang[63] }}
                    @else
                        {{$lang[62] }}
                    @endif
                </p>
                <input type="hidden" name="inctime" value="time_in" id="incnametime"> 
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
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg lg:p-4 md:p-4 flex items-center justify-center">
                <div class="w-full  lg:p-3 md:p-3 rounded-lg mt-3">
                    <div class="flex flex-wrap">
                        <div class="lg:w-[70%] md:w-[70%] w-[100%] text-base">
                            <table class="w-full">
                                <tr class=" border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                                    @if ($detail['repeat'] > 1)
                                        <td class="py-4 px-6 font-medium text-gray-700"><strong><?= $lang[61] ?> 1 :</strong></td>
                                    @else
                                        <td class="py-4 px-6 font-medium text-gray-700"><strong><?= $lang[61] ?> :</strong></td>
                                    @endif
                                    <td class="py-4 px-6 font-medium text-gray-700">
                                        <?=$detail['ans'][0]?>
                                    </td>
                                </tr>
                                @if ($detail['repeat'] > 1)
                                    @php
                                        $new_array = array_slice($detail['ans'], 1);
                                        $i = 2;
                                    @endphp
                                    @foreach ($new_array as  $value)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                                            <td class="py-4 px-6 font-medium text-gray-700"><strong><?= $lang[61] ?> <?= $i++; ?> :</strong></td>
                                            <td class="py-4 px-6 font-medium text-gray-700">
                                                <?= $value ?>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
        var checkinput = document.querySelector('.checkinput');
        var inc_time = document.querySelectorAll('.inc_time');

        // Event listener for the 'inctime' toggle
        document.getElementById('inctime').addEventListener('click', function() {
            var input = document.getElementById('incnametime');
            if (input.value === 'time_in') {
                input.value = 'time_out';
                inc_time.forEach(element => {
                    element.classList.remove("hidden");
                    element.classList.add("flex");
                });
                document.getElementById('inctime').innerHTML = "{{$lang['63']}}";
            } else {
                input.value = 'time_in';
                inc_time.forEach(element => {
                    element.classList.add("hidden");
                    element.classList.remove("flex");
                });

                document.getElementById('inctime').innerHTML = "{{$lang['62']}}";
            }
        });



        @if(isset($detail) || isset($error))
        var inc_time = document.querySelectorAll('.inc_time');

        inctime = '{{$_POST['inctime']}}';
        if (inctime === 'time_in') {
                inc_time.forEach(element => {
                    element.classList.add("hidden");
                });
                document.getElementById('inctime').innerHTML = "{{$lang['62']}}";
            } else if (inctime === 'time_out') {

                inc_time.forEach(element => {
                    element.classList.remove("hidden");
                
                });
            
                document.getElementById('inctime').innerHTML = "{{$lang['63']}}";
            }

        @endif  

        // Event listener for the 'checkbox' toggle
        document.getElementById('checkbox').addEventListener('click', function() {
            var checkbox = document.getElementById('checkbox');
            if (checkbox.checked) {
                checkinput.classList.remove("hidden");
                checkinput.classList.add("block");
            } else {
                checkinput.classList.add("hidden");
                checkinput.classList.remove("block");
            }
        });
    </script>
    @endpush

</form>
