<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <input type="hidden" name="unit_type" id="unit_type" value="salary">



           @if (isset($error))
               <div class="col-12 p-2 mt-lg-3">
                   <div class="row align-items-center bg-white text-center border radius-10 p-1">
                       @if($_POST['unit_type'] == 'salary')
                       <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial salary" id="salary">
                            {{ $lang['1'] }}
                        </div>
                       </div>
                       @else
                       <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial salary" id="salary">
                            {{ $lang['1'] }}
                        </div>
                       </div>
                       @endif

                       @if($_POST['unit_type'] == 'hourly')
                        
                           <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white hourly tagsUnit" id="hourly">
                                    {{ $lang['2'] }}
                            </div>
                        </div>
                       @else
                       <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 metric hover_tags hover:text-white hourly " id="hourly">
                                    {{ $lang['2'] }}
                            </div>
                       </div>
                       @endif
                   
                   </div>
               </div>
           @else
               @if(isset($detail))
                    <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                           @if($_POST['unit_type'] == 'salary')
                           <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial salary" id="salary">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                           @elseif($_POST['unit_type'] == '')
                           <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial salary" id="salary">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                           @else
                           <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial salary" id="salary">
                                {{ $lang['1'] }}
                            </div>
                         </div>
                           @endif
                           
                           @if($_POST['unit_type'] == 'hourly')
                           <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white hourly tagsUnit" id="hourly">
                                    {{ $lang['2'] }}
                            </div>
                        </div>
                           @else
                           <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white hourly" id="hourly">
                                    {{ $lang['2'] }}
                            </div>
                        </div>
                           @endif
                       </div>
                   </div>
               @else
               <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial salary" id="salary">
                            {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white hourly" id="hourly">
                                {{ $lang['2'] }}
                        </div>
                    </div>
                </div>
            </div>
                 
               @endif
           @endif



            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="rate" class="label">{{ $lang['3'] }} <span class="label hourly_rate">{{ $lang['4']}}</span><span class="label annual_rate hidden">{{$lang['5'] }}</span></label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="rate" id="rate" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['rate'])?$_POST['rate']:'413' }}" min="0" />
                </div>
            </div>
            <div class="col-span-12 hours_worked">
                <label for="hour_worked" class="label">{{ $lang['6'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="hour_worked" id="hour_worked" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['hour_worked'])?$_POST['hour_worked']:'40' }}" min="0" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="month" class="label">{{ $lang['7'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="month" id="month" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['month'])?$_POST['month']:'10' }}" min="0" />
                </div>
            </div>
            <p class="col-span-12 hourly_rate px-2 mt-2">Note : {{ $lang['8']}}</p>
            <p class="col-span-12 annual_rate px-2 hidden mt-2">Note : {{ $lang['9']}}</p>

            <div class="col-span-6">
                <label for="benefits" class="label">{{ $lang['11'] }} {{ $lang['10'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="benefits" id="benefits" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['benefits'])?$_POST['benefits']:'10' }}" min="0" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="health" class="label">{{ $lang['12'] }} {{ $lang['10'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="health" id="health" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['health'])?$_POST['health']:'10' }}" min="0" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="dental" class="label">{{ $lang['13'] }} {{ $lang['10'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="dental" id="dental" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['dental'])?$_POST['dental']:'10' }}" min="0" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="vision" class="label">{{ $lang['14'] }} {{ $lang['10'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="vision" id="vision" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['vision'])?$_POST['vision']:'10' }}" min="0" />
                </div>
            </div>
            <div class="col-span-12 newrow">

                @if(isset($error))
                    @foreach ($_POST['perk_name'] as $key => $perk_val)
                    <div class="grid grid-cols-12 mt-3  gap-4 append">
                        <div class="col-span-6">
                            <label for="perk_name{{$key}}" class="label">Perk Name:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="perk_name[]" id="perk_name{{$key}}" class="input" aria-label="input" placeholder="10" value="{{ $perk_val }}" min="0" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="annual_contribution{{$key}}" class="flex justify-between label"><div>Annual Contribution:</div> <img src="{{ asset('images/delete_btn.png')}}" alt="Remove" class="remove right mx-1" width="15px" ></label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="annual_contribution[]" id="annual_contribution{{$key}}" class="input" aria-label="input" placeholder="10" value="{{$_POST['annual_contribution'][$key]}}" min="0" />
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                @if(isset($detail['perk_array']) && isset($detail['perk_val']))
                    @php $j =1; @endphp
                    @for ($i = 0; $i < count($detail['perk_array']); $i++)
                        <div class="grid grid-cols-12 mt-3  gap-4 append">
                            <div class="col-span-6">
                                <label for="perk_name{{$j}}" class="label">Perk Name:</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="perk_name[]" id="perk_name{{$j}}" class="input" aria-label="input" placeholder="10" value="{{ $detail['perk_array'][$i] }}" min="0" />
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="annual_contribution{{$j}}" class="flex justify-between label"><div>Annual Contribution:</div> <img src="{{ asset('images/delete_btn.png')}}" alt="Remove" class="remove right mx-1 object-contain" width="15px" ></label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" name="annual_contribution[]" id="annual_contribution{{$j}}" class="input" aria-label="input" placeholder="10" value="{{ $detail['perk_val'][$i] }}" min="0" />
                                </div>
                            </div>
                        </div>
                        @php $j++; @endphp
                    @endfor
                @endif

            </div>
            <div class="col-span-12 text-end mt-3">
                <button type="button"  name="submit" id="newRow"  class="px-3 py-2 mx-2 addmore text-white bg-[#2845F5] rounded-lg"><span>+</span>{{$lang['15']}} </button>
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
                    @if ($detail['submit'] == 'hourly')
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[16] }} </strong></td>
                                    @if(!isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['emp_h_r'],2) }}</td>
                                    @elseif(isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['emp_h_r_p'],2) }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                @if (!isset($detail['perk_array']))
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 2 ,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 4 ,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 12 ,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 52 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r'] / 365 ,2) }} </strong></td>
                                    </tr>
                                    @elseif(isset($detail['perk_array']))
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 2 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 4 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 12 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 52 ,2) }} </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                        <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 365 ,2) }} </strong></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-12 mt-2 font-s-14">
                            <div class="col">
                                <p class="mt-3">{{ $lang['23'] }}</p>
                                <p class="mt-2">{{$lang['24']}} = {{$lang['3']}} {{$lang['4']}} x 4.66484 x {{$lang['6']}} x {{$lang['7']}}
                                    @if ($detail['benefits'] != '')
                                        + {{$lang['11']}}
                                    @endif
                                    @if($detail['health'] != '')
                                        + {{$lang['12']}} 
                                    @endif
                                    @if($detail['dental'] != '')
                                        + {{$lang['13']}} 
                                    @endif
                                    @if($detail['vision'] != '')
                                        + {{$lang['14']}} 
                                    @endif
                                </p>
                                <p class="mt-2">
                                    {{ $lang['24']}} = {{ $detail['rate']}} x 4.66484 x {{ $detail['hour_worked']}} x {{ $detail['month']}}
                                    @if ($detail['benefits'] != '')
                                        +  {{ $detail['benefits']}}
                                    @endif
                                    @if ($detail['health'] != '')
                                        +  {{ $detail['health']}}
                                    @endif
                                    @if ($detail['dental'] != '')
                                        +  {{ $detail['dental'] }}
                                    @endif
                                    @if ($detail['vision'] != '')
                                        +  {{ $detail['vision']}}
                                    @endif
                                </p>
                                <p class="mt-2">{{$lang['24']}} = {{$currancy }} {{round($detail['emp_h_r'],2) }}</p>
                                 @if (isset($detail['perk_array']))
                                    <p class="mt-2">{{ $lang['25']}}. </p>
                                    <p class="mt-2">{{ $lang['24']}} = {{ $lang['24']}}
                                         @if (isset($detail['perk_array']))
                                            + 
                                            @php
                                                $output = '';
                                                foreach ($detail['perk_array'] as $key => $name) {
                                                    $output .= $name . ' + ';
                                                }
                                                $output = rtrim($output, ' +');
                                                echo $output;
                                            @endphp
                                        @endif
                                    </p>
                                    <p class="mt-2">{{$lang['24']}} =  {{round($detail['emp_h_r'],2)}}
                                        @if (isset($detail['perk_array']))
                                            + 
                                            @php
                                                $output = '';
                                                foreach ($detail['perk_array'] as $key => $name) {
                                                    $output .= $detail['perk_val'][$key] . ' + ';
                                                }
                                                $output = rtrim($output, ' +');
                                                echo $output;
                                            @endphp
                                        @endif
                                    </p>
                                    <p class="mt-2">{{$lang['24']}} = {{$currancy }} {{round($detail['emp_h_r_p'],2)}}</p>
                               @endif
                            </div>
                        </div>
                    @endif
            
                    @if ($detail['submit'] == 'salary')
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[16] }} </strong></td>
                                    @if(!isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['anual_salary'],2) }}</td>
                                    @elseif(isset($detail['perk_array']))
                                        <td class="py-2 border-b">{{$currancy }} {{ round($detail['emp_h_r_p'],2) }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full text-[18px]">
                                @if (!isset($detail['perk_array']))
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 2 ,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 4 ,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 12 ,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 52 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['anual_salary'] / 365 ,2) }} </strong></td>
                                </tr>
                                @elseif(isset($detail['perk_array']))
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[17] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 2 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[18] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 4 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[19] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 12 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[20] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 52 ,2) }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang[21] }} </td>
                                    <td class="py-2 border-b">{{$currancy }} <strong> {{ round($detail['emp_h_r_p'] / 365 ,2) }} </strong></td>
                                </tr>
                                @endif
                            </table>
                        </div>
            
                        <div class="col-12 mt-2 font-s-14">
                            <div class="col">
                                <p class="mt-2">{{ $lang['23']}}</p>
                                <p class="mt-2">{{ $lang['5']}} =  {{ $lang['3']}} {{ $lang['5']}}  x 0.0765 </p>
                                <p class="mt-2">{{ $lang['5']}}  = {{ $detail['rate']}}  x 0.0765 </p>
                                <p class="mt-2">{{ $lang['5']}} = {{$currancy }} {{ $detail['per_anum']}} </p>
                                <p class="mt-2">{{ $lang['24']}} = {{ $lang['3']}} {{ $lang['5']}} + {{ $lang['5']}} 
                                    @if ($detail['benefits'] != '')
                                        + {{ $lang['11']}} 
                                    @endif
                                    @if ($detail['health'] != '')
                                        + {{ $lang['12']}} 
                                    @endif
                                    @if ($detail['dental'] != '')
                                        + {{ $lang['13']}} 
                                    @endif
                                    @if ($detail['vision'] != '')
                                        + {{ $lang['14']}} 
                                    @endif
                                </p>
                                <p class="mt-2">{{ $lang['24']}}  = {{ $detail['rate']}} + {{ $detail['per_anum']}}
                                    @if ($detail['benefits'] != '')
                                        + {{ $detail['benefits']}}
                                    @endif
                                    @if ($detail['health'] != '')
                                        + {{ $detail['health']}}
                                    @endif
                                    @if ($detail['dental'] != '')
                                        + {{ $detail['dental']}} 
                                    @endif
                                    @if ($detail['vision'] != '')
                                        + {{ $detail['vision']}}
                                    @endif
                                </p>
                                <p class="mt-2">{{$lang['24']}} = {{$currancy }} {{ round($detail['anual_salary'],2) }}</p>
                                @if (isset($detail['perk_array']))
                                    <p class="mt-2 color_blue">{{ $lang['25']}}. </p>
                                    <p class="mt-2">{{ $lang['24']}}  = {{ $lang['24']}} 
                                        @if (isset($detail['perk_array']))
                                            + 
                                            @php
                                                $output = '';
                                                foreach ($detail['perk_array'] as $key => $name) {
                                                    $output .= $name . ' + ';
                                                }
                                                $output = rtrim($output, ' +');
                                                echo $output;
                                            @endphp
                                @endif
                                    </p>
                                    <p class="mt-2">{{$lang['24']}}  =  {{round($detail['anual_salary'],2)}} 
                                         @if (isset($detail['perk_array']))
                                            + 
                                            @php
                                                $output = '';
                                                foreach ($detail['perk_array'] as $key => $name) {
                                                    $output .= $detail['perk_val'][$key] . ' + ';
                                                }
                                                $output = rtrim($output, ' +');
                                                echo $output;
                                            @endphp
                                        @endif
                                    </p>
                                    <p class="mt-2">{{$lang['24']}} = {{$currancy }} {{ round($detail['emp_h_r_p'],2)}}</p>
                                @endif
                            </div>
                        </div>
            
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
<script>
     var y = 2;
    document.getElementById('newRow').addEventListener('click', function() {
        var length = document.querySelectorAll('.append').length;
        if (length < 4) {
            var html = 
                ' <div class="grid grid-cols-12 mt-3  gap-4 append">'+
                    ' <div class="col-span-6">'+
                        ' <label for="perk_name'+y+'" class="label">Perk Name:</label>'+
                        ' <div class="w-full py-2 position-relative">'+
                            '<input type="number" step="any" name="perk_name[]" id="perk_name'+y+'" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['perk_name[]'])?$_POST['perk_name[]']:'10' }}" min="0" />'+
                            '</div>'+
                            '</div>'+
                            '<div class="col-span-6">'+
                            '<label for="annual_contribution'+y+'" class="flex justify-between label"><div class="text-blue">Annual Contribution:</div> <img src="{{ asset("images/delete_btn.png")}}" alt="Remove" class="remove right mx-1 object-contain" width="15px" ></label>'+
                            '<div class="w-full py-2 position-relative">'+
                            '<input type="number" step="any" name="annual_contribution[]" id="annual_contribution'+y+'" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['annual_contribution[]'])?$_POST['annual_contribution[]']:'10' }}" min="0" />'+
                        '</div>'+
                      '</div>'+
                    '</div>';

            document.querySelector('.newrow').insertAdjacentHTML('beforeend', html);
        } else {
            alert('Only Five Fields are Allowed');
        }
        y++;
    });
    
    document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove')) {
        var parent = event.target.parentElement;
        var ind = Array.prototype.indexOf.call(parent.parentElement.children, parent);
        var appendElements = document.querySelectorAll('.newrow .append');
        if (appendElements[ind]) {
            appendElements[ind].remove();
        }
    }
});

  document.querySelectorAll('#salary').forEach(function(element) {
    element.addEventListener('click', function() {
        this.classList.add('tagsUnit');
        document.querySelectorAll('#hourly').forEach(function(metricElement) {
            metricElement.classList.remove('tagsUnit');
        });
        document.getElementById('unit_type').value = "salary";

        var hourly_rate = document.querySelectorAll('.hourly_rate');
        var hours_worked = document.querySelectorAll('.hours_worked');
        var annual_rate = document.querySelectorAll('.annual_rate');

        if (hourly_rate.length > 0 && hours_worked.length > 0 && annual_rate.length > 0) {
            hourly_rate.forEach(function(rateElement) {
                rateElement.classList.remove('hidden');
            });
            hours_worked.forEach(function(workedElement) {
                workedElement.classList.remove('hidden');
            });
            annual_rate.forEach(function(annualElement) {
                annualElement.classList.add('hidden');
            });
        }
    });
});

    document.querySelectorAll('#hourly').forEach(function(element) {
    element.addEventListener('click', function() {
        if (this.classList.contains('hourly')) {
            this.classList.add('tagsUnit');
            document.querySelectorAll('#salary').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit');
            });

            document.getElementById('unit_type').value = "hourly";

            var hourly_rate = document.querySelectorAll('.hourly_rate');
            var hours_worked = document.querySelectorAll('.hours_worked');
            var annual_rate = document.querySelectorAll('.annual_rate');

            if (hourly_rate.length > 0 && hours_worked.length > 0 && annual_rate.length > 0) {
                hourly_rate.forEach(function(rateElement) {
                    rateElement.classList.add('hidden');
                });
                hours_worked.forEach(function(workedElement) {
                    workedElement.classList.add('hidden');
                });
                annual_rate.forEach(function(annualElement) {
                    annualElement.classList.remove('hidden');
                });
            }
        }
    });
});

@if(isset($detail))
var type = "{{ $_POST['unit_type'] }}";
        if (type == "salary") {
                document.querySelectorAll('#hourly').forEach(function(metricElement) {
                metricElement.classList.remove('tagsUnit');
            });
            document.getElementById('unit_type').value = "salary";

            var hourly_rate = document.querySelectorAll('.hourly_rate');
            var hours_worked = document.querySelectorAll('.hours_worked');
            var annual_rate = document.querySelectorAll('.annual_rate');

            if (hourly_rate.length > 0 && hours_worked.length > 0 && annual_rate.length > 0) {
                hourly_rate.forEach(function(rateElement) {
                    rateElement.classList.remove('hidden');
                });
                hours_worked.forEach(function(workedElement) {
                    workedElement.classList.remove('hidden');
                });
                annual_rate.forEach(function(annualElement) {
                    annualElement.classList.add('hidden');
                });
            }
        } else {
            document.querySelectorAll('#salary').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit');
            });

            document.getElementById('unit_type').value = "hourly";

            var hourly_rate = document.querySelectorAll('.hourly_rate');
            var hours_worked = document.querySelectorAll('.hours_worked');
            var annual_rate = document.querySelectorAll('.annual_rate');

            if (hourly_rate.length > 0 && hours_worked.length > 0 && annual_rate.length > 0) {
                hourly_rate.forEach(function(rateElement) {
                    rateElement.classList.add('hidden');
                });
                hours_worked.forEach(function(workedElement) {
                    workedElement.classList.add('hidden');
                });
                annual_rate.forEach(function(annualElement) {
                    annualElement.classList.remove('hidden');
                });
            }

        }
    @endif

@if(isset($error))
        var type = "{{ $_POST['unit_type'] }}";
        if (type == "salary") {
                document.querySelectorAll('#hourly').forEach(function(metricElement) {
                metricElement.classList.remove('tagsUnit');
            });
            document.getElementById('unit_type').value = "salary";

            var hourly_rate = document.querySelectorAll('.hourly_rate');
            var hours_worked = document.querySelectorAll('.hours_worked');
            var annual_rate = document.querySelectorAll('.annual_rate');

            if (hourly_rate.length > 0 && hours_worked.length > 0 && annual_rate.length > 0) {
                hourly_rate.forEach(function(rateElement) {
                    rateElement.classList.remove('hidden');
                });
                hours_worked.forEach(function(workedElement) {
                    workedElement.classList.remove('hidden');
                });
                annual_rate.forEach(function(annualElement) {
                    annualElement.classList.add('hidden');
                });
            }
        } else {
            document.querySelectorAll('#salary').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit');
            });

            document.getElementById('unit_type').value = "hourly";

            var hourly_rate = document.querySelectorAll('.hourly_rate');
            var hours_worked = document.querySelectorAll('.hours_worked');
            var annual_rate = document.querySelectorAll('.annual_rate');

            if (hourly_rate.length > 0 && hours_worked.length > 0 && annual_rate.length > 0) {
                hourly_rate.forEach(function(rateElement) {
                    rateElement.classList.add('hidden');
                });
                hours_worked.forEach(function(workedElement) {
                    workedElement.classList.add('hidden');
                });
                annual_rate.forEach(function(annualElement) {
                    annualElement.classList.remove('hidden');
                });
            }

        }
    @endif
</script>

@endpush