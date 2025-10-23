<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
 
            
                {{-- <div class="row">
                    <div class="col-lg col-6 pe-1">
                        <label for="s_hour" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" min="0" max="23" name="s_hour" id="s_hour" class="input" aria-label="input"
                            value="{{ isset(request()->s_hour) ? request()->s_hour : '07' }}" placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="col-lg col-6 px-1 ">
                        <label for="s_min" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" min="0" max="59" name="s_min" id="s_min" class="input" aria-label="input"
                            value="{{ isset(request()->s_min) ? request()->s_min : '30' }}" placeholder="Min" />
                        </div>
                    </div>
                    <div class="col-lg col-6 px-1 ">
                        <label for="s_sec" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" min="0" max="59" name="s_sec" id="s_sec" class="input" aria-label="input"
                            value="{{ isset(request()->s_sec) ? request()->s_sec : '00' }}" placeholder="Sec" />
                        </div>
                    </div>
                    <div class="col-lg col-6 px-1 s_ampm {{ isset($_POST['clock_format']) && $_POST['clock_format'] !== '12' ? 'd-none' : 'd-block' }}">
                        <div class="w-100 py-2">                                  
                            <select name="s_ampm" id="s_ampm" class="input mt-3">
                                @php
                                        function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["AM", "PM",];
                                    $val = ["am", "pm",];
                                    optionsList($val,$name,isset(request()->s_ampm)?request()->s_ampm:'pm');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="row">
                    <div class="col-lg col-6 pe-1 ">
                        <label for="e_hour" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" min="0" max="23" name="e_hour" id="e_hour" class="input" aria-label="input"
                            value="{{ isset(request()->e_hour) ? request()->e_hour : '01' }}" placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="col-lg col-6 px-1 ">
                        <label for="e_min" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" min="0" max="59" name="e_min" id="e_min" class="input" aria-label="input"
                            value="{{ isset(request()->e_min) ? request()->e_min : '30' }}" placeholder="Min" />
                        </div>
                    </div>    
                    <div class="col-lg col-6 px-1 ">
                        <label for="e_sec" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" min="0" max="59" name="e_sec" id="e_sec" class="input" aria-label="input"
                            value="{{ isset(request()->e_sec) ? request()->e_sec : '00' }}" placeholder="Sec" />
                        </div>
                    </div>
                    <div class="col-lg col-6 px-1 e_ampm {{ isset($_POST['clock_format']) && $_POST['clock_format'] !== '12' ? 'd-none' : 'd-block' }}">
                        <div class="w-100 py-2">                                  
                            <select name="e_ampm" id="e_ampm" class="input mt-3">
                                @php
                                    $name = ["AM", "PM",];
                                    $val = ["am", "pm",];
                                    optionsList($val,$name,isset(request()->e_ampm)?request()->e_ampm:'am');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div> --}}

                <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
         <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="mt-0 my-lg-2 text-center">
            <span class="font-s-14 text-blue pe-3">{{ $lang['1'] }}</span>
            <input type="radio" name="clock_format" id="bedtime" value="12" checked {{ isset($_POST['clock_format']) && $_POST['clock_format'] === '12' ? 'checked' : '' }}>
            <label for="bedtime" class="font-s-14 text-blue pe-lg-3 pe-2">12 {{ $lang['2'] }}:</label>
            <input type="radio" name="clock_format" id="wkup" value="24" {{ isset($_POST['clock_format']) && $_POST['clock_format'] === '24' ? 'checked' : '' }}>
            <label for="wkup" class="font-s-14 text-blue">24 {{ $lang['3'] }}:</label>
        </div>
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="flex flex-wrap ">
                <label class="label">{{$lang[6]}}:</label>
                <div class="w-full flex space-x-4">
                    <div class="w-full px-2">
                        <label for="s_hour" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" min="0" max="23" name="s_hour" id="s_hour" class="input" aria-label="input"
                            value="{{ isset(request()->s_hour) ? request()->s_hour : '07' }}" placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <label for="s_min" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" min="0" max="59" name="s_min" id="s_min" class="input" aria-label="input"
                            value="{{ isset(request()->s_min) ? request()->s_min : '30' }}" placeholder="Min" />
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <label for="s_sec" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" min="0" max="59" name="s_sec" id="s_sec" class="input" aria-label="input"
                            value="{{ isset(request()->s_sec) ? request()->s_sec : '00' }}" placeholder="Sec" />
                        </div>
                    </div>
                    <div class="w-full px-2 s_ampm {{ isset($_POST['clock_format']) && $_POST['clock_format'] !== '12' ? 'd-none' : 'd-block' }}">
                        <label for="s_sec" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-full py-2">
                            <select name="s_ampm" id="s_ampm" class="">
                                <option value="am" {{ isset($_POST['s_ampm']) && $_POST['s_ampm'] == 'am' ? 'selected' : '' }}>AM</option>
                                <option value="pm" {{ isset($_POST['s_ampm']) && $_POST['s_ampm'] == 'pm' ? 'selected' : '' }}>PM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <label  class="label">{{$lang[7]}}:</label>
                <div class="w-full flex space-x-4">
                    <div class="w-full px-2">
                        <label for="e_hour" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" min="0" max="23" name="e_hour" id="e_hour" class="input" aria-label="input"
                            value="{{ isset(request()->e_hour) ? request()->e_hour : '01' }}" placeholder="Hrs" />
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <label for="e_min" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" min="0" max="59" name="e_min" id="e_min" class="input" aria-label="input"
                            value="{{ isset(request()->e_min) ? request()->e_min : '30' }}" placeholder="Min" />
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <label for="e_sec" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-full py-2">
                                <input type="number" min="0" max="59" name="e_sec" id="e_sec" class="input" aria-label="input"
                                value="{{ isset(request()->e_sec) ? request()->e_sec : '00' }}" placeholder="Sec" />
                        </div>
                    </div>
                    <div class="w-full px-2 e_ampm {{ isset($_POST['clock_format']) && $_POST['clock_format'] !== '12' ? 'd-none' : 'd-block' }}">
                        <label for="s_sec" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-full py-2">
                            <select name="e_ampm" id="e_ampm" class="">
                                <option value="am" {{ isset($_POST['e_ampm']) && $_POST['e_ampm'] == 'am' ? 'selected' : '' }}>AM</option>
                                <option value="pm" {{ isset($_POST['e_ampm']) && $_POST['e_ampm'] == 'pm' ? 'selected' : '' }}>PM</option>
                            </select>
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
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  rounded-[10px] mt-3">
                    <div class="my-2">
                        <div class="text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="w-[70%] border-b py-2">
                                        <strong>{{$lang[8]}} :</strong>
                                    </td>
                                    <td class="border-b py-2">
                                        {{$detail['first_to_second']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        <strong>{{$lang[9]}} :</strong>
                                    </td>
                                    <td class="border-b py-2">
                                        {{$detail['second_to_first']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        <strong>{{$lang[10]}} :</strong>
                                    </td>
                                    <td class="border-b py-2">
                                        {{$detail['first_to_second_over_night']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        <strong>{{$lang[11]}} :</strong>
                                    </td>
                                    <td class="border-b py-2">
                                        {{$detail['second_to_first_over_night']}}
                                    </td>
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
            document.getElementById('bedtime').addEventListener('click', function() {
                document.querySelector('.s_ampm').style.display = "block";
                document.querySelector('.e_ampm').style.display = "block";
            });
            document.getElementById('wkup').addEventListener('click', function() {
                document.querySelector('.s_ampm').style.display = "none";
                document.querySelector('.e_ampm').style.display = "none";
            });

        </script>
    @endpush
</form>
