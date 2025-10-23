@php
    $columns_fixture = request()->columns_fixture;
    $rows_fixture  = request()->rows_fixture;
    $include   = request()->include;
    $units  = request()->units;
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="a" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="a" id="a" class="input" aria-label="input"  value="{{ isset($_POST['a'])?$_POST['a']:'2' }}" />
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="b" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="b" id="b" class="input" aria-label="input"  value="{{ isset($_POST['b'])?$_POST['b']:'2' }}" />
                    </div>
                </div>  
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="columns_fixture" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="columns_fixture" id="columns_fixture" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["1","2","3"];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['columns_fixture'])?$_POST['columns_fixture']:'2');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="rows_fixture" class="label">{{ $lang['4']}}:</label>
                    <div class="w-100 py-2"> 
                        <select name="rows_fixture" id="rows_fixture" class="input">
                            @php
                                $name = ["1","2","3"];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['rows_fixture'])?$_POST['rows_fixture']:'2');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 include">
                    <label for="include" class="label">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="include" id="include" class="input">
                            @php
                                $name = ["Yes","No"];
                                $val = ["yes","no"];
                                optionsList($val,$name,isset($_POST['include'])?$_POST['include']:'no');
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="units" class="label">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="units" id="units" class="input">
                            @php
                                $name = ["mm", "cm", "m", "in", "ft", "yd"];
                                $val = ["mm", "cm", "m", "in", "ft", "yd"];
                                optionsList($val,$name,isset($_POST['units'])?$_POST['units']:'cm');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="p-2  mt-4 radius-5">
                    <img src="{{asset('images/recessed_image/2_2.webp')}}" alt="Stack log" class="set_img max-width" width="300px" height="250px">
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
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  lg:text-[18px] md:text-[18px] text-[16px]">
                            <table class="w-full">
                                @if ($columns_fixture === '1' && $rows_fixture === '1') 
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                @elseif ($columns_fixture === '1' && $rows_fixture === '2' || $columns_fixture === '1' && $rows_fixture === '3') 
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                @elseif ($columns_fixture === '2' && $rows_fixture === '1' || $columns_fixture === '3' && $rows_fixture === '1') 
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                    </tr>
                                @elseif ($columns_fixture === '2' && $rows_fixture === '2') 
                                    @if ($include === 'yes') 
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['y_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['x_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                    @else 
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font_size20"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="clr_blue">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font_size20"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="clr_blue">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                    @endif
                                @elseif ($columns_fixture === '2' && $rows_fixture === '3') 
                                    @if ($include === 'yes') 
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['y_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['15'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['y_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['14'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['x_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                    @else 
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                    @endif
                                @elseif ($columns_fixture === '3' && $rows_fixture === '2') 
                                    @if ($include === 'yes') 
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['y_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['x_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['14'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['x_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                    @else 
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                        </tr>
                                        <tr>
                                            <td  class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                        </tr>
                                    @endif
                                @elseif ($columns_fixture === '3' && $rows_fixture === '3') 
                                    <tr>
                                        <td  class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['a_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td  class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['a_i'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td  class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['b_not'], 2) }} {{ $units }}</td>
                                    </tr>
                                    <tr>
                                        <td  class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                        <td class="border-b py-2">{{ round($detail['b_i'], 2) }} {{ $units }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById("include").addEventListener("change", function() {
            var value = this.value;
            var setImg = document.querySelectorAll(".set_img");
            if (value === "yes") {
                setImg.setAttribute("src", '{{asset("images/recessed_image/2_2_yes.webp")}}');
            } else if (value === "no") {
                setImg.setAttribute("src", "{{asset('images/recessed_image/2_2.webp')}}");
            }
        });

        document.addEventListener('change', function() {
            var firstSelect = document.getElementById('columns_fixture').value;
            var secondSelect = document.getElementById('rows_fixture').value;
            var setImg = document.querySelector('.set_img');
            var inc = document.querySelector(".include");
            
            if (firstSelect === '1' && secondSelect === '1') {
                inc.classList.add('d-none');
                inc.classList.remove('d-block');
                setImg.setAttribute("src", '{{asset("images/recessed_image/1_1.webp")}}');
            } else if(firstSelect === '2' && secondSelect === '2') {
                if (inc === "yes") {
                    setImg.setAttribute("src", '{{asset("images/recessed_image/2_2_yes.webp")}}');
                } else if (inc === "no") {
                    setImg.setAttribute("src", "{{asset('images/recessed_image/2_2.webp')}}");
                }
                inc.classList.add('d-block');
                inc.classList.remove('d-none');
            }else if(firstSelect === '3' && secondSelect === '3'){
                inc.classList.add('d-none');
                inc.classList.remove('d-block');
                setImg.setAttribute("src", '{{asset("images/recessed_image/3_3.webp")}}');
            }else if(firstSelect === '2' && secondSelect === '1'){
                inc.classList.add('d-block');
                inc.classList.remove('d-none');
                setImg.setAttribute("src", '{{asset("images/recessed_image/2_1.webp")}}');
            }else if(firstSelect === '2' && secondSelect === '3'){
                inc.classList.add('d-block');
                inc.classList.remove('d-none');
                setImg.setAttribute("src", '{{asset("images/recessed_image/2_3.webp")}}');
            }else if(firstSelect === '3' && secondSelect === '1'){
                inc.classList.add('d-none');
                inc.classList.remove('d-block');
                setImg.setAttribute("src", '{{asset("images/recessed_image/3_1.webp")}}');
            }else if(firstSelect === '3' && secondSelect === '2'){
                inc.classList.add('d-block');
                inc.classList.remove('d-none');
                setImg.setAttribute("src", '{{asset("images/recessed_image/3_2.webp")}}');
            }else if(firstSelect === '1' && secondSelect === '2'){
                inc.classList.add('d-block');
                inc.classList.remove('d-none');
                setImg.setAttribute("src", '{{asset("images/recessed_image/1_2.webp")}}');
            }else if(firstSelect === '1' && secondSelect === '3'){
                inc.classList.add('d-none');
                inc.classList.remove('d-block');
                setImg.setAttribute("src", '{{asset("images/recessed_image/1_3.webp")}}');
            }
        });
    </script>
@endpush