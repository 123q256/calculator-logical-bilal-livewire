<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

            <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                <input type="hidden"  name="unit" value="millimeters" id="h_element">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit wed" id="wed">
                            {{$lang['2']}}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel" id="rel">
                            {{$lang['3']}}
                        </div>
                    </div>
                </div>
            </div>
       </div>
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="to_measure" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="to_measure" id="to_measure" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang[5], $lang[6]];
                                $val = ['d_o_r', 'c_o_f'];
                                optionsList($val,$name,isset($_POST['to_measure'])?$_POST['to_measure']:'d_o_r');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 d_o_r_mm">
                    <label for="d_o_r_mm" class="label">{{ $lang['8'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <select name="d_o_r_mm" id="d_o_r_mm" class="input">
                            @php
                                $name = ['9.91', '10.72', '11.53', '11.95', '12.37', '12.60', '12.78', '13.00', '13.21', '13.41', '13.61', '13.83', '14.05', '14.15', '14.25', '14.36', '14.45', '14.56', '14.65', '14.86', '15.04', '15.27', '15.40', '15.53', '15.70', '15.80', '15.90', '16.00', '16.10', '16.30', '16.41', '16.51', '16.71', '16.92', '17.13', '17.35', '17.45', '17.75', '17.97', '18.19', '18.35', '18.53', '18.61', '18.69', '18.80', '18.89', '19.10', '19.22', '19.31', '19.41', '19.51', '19.62', '19.84', '20.02', '20.20', '20.32', '20.44', '20.68', '20.76', '20.85', '20.94', '21.08', '21.18', '21.24', '21.30', '21.49', '21.69', '21.89', '22.10', '22.33', '22.60'];
                                $val = ['9.91', '10.72', '11.53', '11.95', '12.37', '12.60', '12.78', '13.00', '13.21', '13.41', '13.61', '13.83', '14.05', '14.15', '14.25', '14.36', '14.45', '14.56', '14.65', '14.86', '15.04', '15.27', '15.40', '15.53', '15.70', '15.80', '15.90', '16.00', '16.10', '16.30', '16.41', '16.51', '16.71', '16.92', '17.13', '17.35', '17.45', '17.75', '17.97', '18.19', '18.35', '18.53', '18.61', '18.69', '18.80', '18.89', '19.10', '19.22', '19.31', '19.41', '19.51', '19.62', '19.84', '20.02', '20.20', '20.32', '20.44', '20.68', '20.76', '20.85', '20.94', '21.08', '21.18', '21.24', '21.30', '21.49', '21.69', '21.89', '22.10', '22.33', '22.60'];
                                optionsList($val,$name,isset($_POST['d_o_r_mm'])?$_POST['d_o_r_mm']:'10.72');
                            @endphp
                        </select>
                        <span class="input_unit text-blue">mm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden d_o_r_in">
                    <label for="d_o_r_in" class="label">{{ $lang['8'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <select name="d_o_r_in" id="d_o_r_in" class="input">
                            @php
                            $name = ['0.39', '0.442', '0.454', '0.474', '0.482', '0.487', '0.496', '0.503', '0.512', '0.520', '0.528', '0.536', '0.544', '0.553', '0.557', '0.561', '0.565', '0.569', '0.573', '0.577', '0.585', '0.592', '0.601', '0.606', '0.611', '0.618', '0.622', '0.626', '0.630', '0.634', '0.642', '0.646', '0.650', '0.658', '0.666', '0.674', '0.683', '0.687', '0.699', '0.707', '0.716', '0.722', '0.729', '0.733', '0.736', '0.740', '0.748', '0.752', '0.757', '0.760', '0.764', '0.768', '0.772', '0.781', '0.788', '0.797', '0.800', '0.805', '0.814', '0.817', '0.821', '0.824', '0.830', '0.834', '0.836', '0.839', '0.846', '0.854', '0.862', '0.870', '0.879', '0.891'];
                                $val = ['0.39', '0.442', '0.454', '0.474', '0.482', '0.487', '0.496', '0.503', '0.512', '0.520', '0.528', '0.536', '0.544', '0.553', '0.557', '0.561', '0.565', '0.569', '0.573', '0.577', '0.585', '0.592', '0.601', '0.606', '0.611', '0.618', '0.622', '0.626', '0.630', '0.634', '0.642', '0.646', '0.650', '0.658', '0.666', '0.674', '0.683', '0.687', '0.699', '0.707', '0.716', '0.722', '0.729', '0.733', '0.736', '0.740', '0.748', '0.752', '0.757', '0.760', '0.764', '0.768', '0.772', '0.781', '0.788', '0.797', '0.800', '0.805', '0.814', '0.817', '0.821', '0.824', '0.830', '0.834', '0.836', '0.839', '0.846', '0.854', '0.862', '0.870', '0.879', '0.891'];
                                optionsList($val,$name,isset($_POST['d_o_r_in'])?$_POST['d_o_r_in']:'0.442');
                            @endphp
                        </select>
                        <span class="input_unit text-blue">in</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden c_o_f_mm">
                    <label for="c_o_f_mm" class="label">{{ $lang['7'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <select name="c_o_f_mm" id="c_o_f_mm" class="input">
                            @php
                                $name = ['31.13', '33.68', '36.22', '37.54', '38.26', '38.86', '39.58', '40.15', '40.84', '41.50', '42.13', '42.76', '43.45', '44.14', '44.45', '44.77', '45.11', '45.40', '45.74', '46.02', '46.68', '47.25', '47.97', '48.38', '48.79', '49.32', '49.64', '49.95', '50.27', '50.58', '51.21', '51.55', '51.87', '52.50', '53.16', '53.82', '54.51', '54.82', '55.76', '56.45', '57.15', '57.65', '58.21', '58.47', '58.72', '59.06', '59.34', '60.00', '60.38', '60.66', '60.98', '61.29', '61.64', '62.33', '62.89', '63.46', '63.84', '64.21', '64.97', '65.22', '65.50', '65.78', '66.22', '66.54', '66.73', '66.92', '67.51', '68.14', '68.77', '69.43', '70.15', '71.00'];
                                $val = ['31.13', '33.68', '36.22', '37.54', '38.26', '38.86', '39.58', '40.15', '40.84', '41.50', '42.13', '42.76', '43.45', '44.14', '44.45', '44.77', '45.11', '45.40', '45.74', '46.02', '46.68', '47.25', '47.97', '48.38', '48.79', '49.32', '49.64', '49.95', '50.27', '50.58', '51.21', '51.55', '51.87', '52.50', '53.16', '53.82', '54.51', '54.82', '55.76', '56.45', '57.15', '57.65', '58.21', '58.47', '58.72', '59.06', '59.34', '60.00', '60.38', '60.66', '60.98', '61.29', '61.64', '62.33', '62.89', '63.46', '63.84', '64.21', '64.97', '65.22', '65.50', '65.78', '66.22', '66.54', '66.73', '66.92', '67.51', '68.14', '68.77', '69.43', '70.15', '71.00'];
                                optionsList($val,$name,isset($_POST['c_o_f_mm'])?$_POST['c_o_f_mm']:'33.68');
                            @endphp
                        </select>
                        <span class="input_unit text-blue">mm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden c_o_f_in">
                    <label for="c_o_f_in" class="label">{{ $lang['7'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <select name="c_o_f_in" id="c_o_f_in" class="input">
                            @php
                                $name = ['1.22', '1.39', '1.43', '1.49', '1.51', '1.53', '1.56', '1.58', '1.61', '1.63', '1.66', '1.68', '1.71', '1.74', '1.75', '1.76', '1.77', '1.79', '1.80', '1.81', '1.84', '1.86', '1.89', '1.90', '1.92', '1.94', '1.95', '1.97', '1.98', '1.99', '2.02', '2.03', '2.04', '2.07', '2.09', '2.12', '2.15', '2.16', '2.20', '2.22', '2.25', '2.27', '2.29', '2.30', '2.31', '2.32', '2.35', '2.36', '2.38', '2.39', '2.40', '2.41', '2.43', '2.45', '2.48', '2.50', '2.51', '2.53', '2.56', '2.57', '2.58', '2.59', '2.61', '2.62', '2.63', '2.64', '2.66', '2.68', '2.71', '2.73', '2.76', '2.80'];
                                $val = ['1.22', '1.39', '1.43', '1.49', '1.51', '1.53', '1.56', '1.58', '1.61', '1.63', '1.66', '1.68', '1.71', '1.74', '1.75', '1.76', '1.77', '1.79', '1.80', '1.81', '1.84', '1.86', '1.89', '1.90', '1.92', '1.94', '1.95', '1.97', '1.98', '1.99', '2.02', '2.03', '2.04', '2.07', '2.09', '2.12', '2.15', '2.16', '2.20', '2.22', '2.25', '2.27', '2.29', '2.30', '2.31', '2.32', '2.35', '2.36', '2.38', '2.39', '2.40', '2.41', '2.43', '2.45', '2.48', '2.50', '2.51', '2.53', '2.56', '2.57', '2.58', '2.59', '2.61', '2.62', '2.63', '2.64', '2.66', '2.68', '2.71', '2.73', '2.76', '2.80'];
                                optionsList($val,$name,isset($_POST['c_o_f_in'])?$_POST['c_o_f_in']:'1.39');
                            @endphp
                        </select>
                        <span class="input_unit text-blue">in</span>
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
                            $unit     = request()->unit;
                            $cd       = request()->to_measure;
                            $dia_mm		= request()->d_o_r_mm;
                            $dia_in		= request()->d_o_r_in;
                            $cir_mm		= request()->c_o_f_mm;
                            $cir_in		= request()->c_o_f_in;
                        @endphp
                        <div class="w-full my-2">
                           <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2"><strong>
                                        @if ($cd=='d_o_r')
                                            {{$lang[7]}} :
                                        @elseif($cd=='c_o_f')
                                            {{$lang[8]}} :
                                        @endif    
                                    </strong></td>
                                    <td class="border-b py-2">{{round($detail['ring_size'], 4)}} {{$detail['unit']}} </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full  overflow-auto">
                            <table class="w-full mt-2">
                                <tbody>
                                    <tr>
                                        <td class="border-b p-2"><b>{!!$lang[9]!!}</b></td>
                                        <td class="border-b p-2"><b>{!!$lang[10]!!}</b></td>
                                        <td class="border-b p-2"><b>{{$lang[11]}}</b></td>
                                        <td class="border-b p-2"><b>{{$lang[12]}}</b></td>
                                        <td class="border-b p-2"><b>{{$lang[13]}}</b></td>
                                        <td class="border-b p-2"><b>{{$lang[14]}}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b p-2">{{ $detail['uk_au']}}</td>
                                        <td class="border-b p-2">{{ $detail['us_ca']}}</td>
                                        <td class="border-b p-2">{{ $detail['f']}}</td>
                                        <td class="border-b p-2">{{ $detail['g']}}</td>
                                        <td class="border-b p-2">{{ $detail['j']}}</td>
                                        <td class="border-b p-2">{{ $detail['s']}}</td>
                                    </tr>
                                </tbody>
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
        var d_o_r_mm = document.querySelector('.d_o_r_mm');
        var c_o_f_mm = document.querySelector('.c_o_f_mm');
        var d_o_r_in = document.querySelector('.d_o_r_in');
        var c_o_f_in = document.querySelector('.c_o_f_in');
        @if(request()->unit === 'millimeters')
            document.getElementById('to_measure').addEventListener('change',function(){
                var to_measure = this.value;
                if(to_measure == 'd_o_r'){
                    c_o_f_mm.style.display = "none";
                    d_o_r_mm.style.display = "block";
                    d_o_r_in.style.display = "none";
                    c_o_f_in.style.display = "none";
                }else{
                    d_o_r_mm.style.display = "none";
                    c_o_f_mm.style.display = "block" ;
                    d_o_r_in.style.display = "none";
                    c_o_f_in.style.display = "none";
                }
            });
        @else
            document.getElementById('to_measure').addEventListener('change',function(){
                var to_measure = this.value;
                if(to_measure == 'd_o_r'){
                    d_o_r_in.style.display = "block";
                    c_o_f_mm.style.display = "none";
                    d_o_r_mm.style.display = "none";
                    c_o_f_in.style.display = "none";
                }else{
                    c_o_f_in.style.display = "block";
                    d_o_r_mm.style.display = "none";
                    c_o_f_mm.style.display = "none" ;
                    d_o_r_in.style.display = "none";
                }
            });
        @endif
        document.querySelectorAll('.wed').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('h_element').value = "millimeters";
                document.querySelectorAll('.rel').forEach(function(element) {
                    element.classList.remove('tagsUnit')
                });
                c_o_f_mm.style.display = "none";
                d_o_r_mm.style.display = "block";
                d_o_r_in.style.display = "none";
                c_o_f_in.style.display = "none";
            });
        });
        document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('h_element').value = "inches";
                document.querySelectorAll('.wed').forEach(function(element) {
                    element.classList.remove('tagsUnit')
                });
                c_o_f_mm.style.display = "none";
                d_o_r_mm.style.display = "none";
                d_o_r_in.style.display = "block";
                c_o_f_in.style.display = "none";
            });
        });
        @if(isset($detail))
            @if(request()->unit == 'millimeters')
                    document.querySelector('.wed').classList.add('tagsUnit');
                    document.getElementById('h_element').value = "millimeters";
                    document.querySelectorAll('.rel').forEach(function(element) {
                        element.classList.remove('tagsUnit')
                    });
                    c_o_f_mm.style.display = "none";
                    d_o_r_mm.style.display = "block";
                    d_o_r_in.style.display = "none";
                    c_o_f_in.style.display = "none";
                    var to_measure = document.getElementById('to_measure').value;
                    if(to_measure == 'd_o_r'){
                        c_o_f_mm.style.display = "none";
                        d_o_r_mm.style.display = "block";
                        d_o_r_in.style.display = "none";
                        c_o_f_in.style.display = "none";
                    }else{
                        d_o_r_mm.style.display = "none";
                        c_o_f_mm.style.display = "block" ;
                        d_o_r_in.style.display = "none";
                        c_o_f_in.style.display = "none";
                    }
            @endif
            @if(request()->unit == 'inches')
                    document.querySelector('.rel').classList.add('tagsUnit');
                    document.getElementById('h_element').value = "inches";
                    document.querySelectorAll('.wed').forEach(function(element) {
                        element.classList.remove('tagsUnit')
                    });
                    c_o_f_mm.style.display = "none";
                    d_o_r_mm.style.display = "none";
                    d_o_r_in.style.display = "block";
                    c_o_f_in.style.display = "none";
                    var to_measure = document.getElementById('to_measure').value
                    if(to_measure == 'd_o_r'){
                        d_o_r_in.style.display = "block";
                        c_o_f_mm.style.display = "none";
                        d_o_r_mm.style.display = "none";
                        c_o_f_in.style.display = "none";
                    }else{
                        c_o_f_in.style.display = "block";
                        d_o_r_mm.style.display = "none";
                        c_o_f_mm.style.display = "none" ;
                        d_o_r_in.style.display = "none";
                    }
            @endif
        @endif
    </script>
@endpush