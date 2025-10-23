<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 my-4 mx-0">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <p class="label">{{$lang['1']}}:</p>
                    <select class="input" name="want_to" id="want_to">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3']];
                            $val = [1,2];
                            optionsList($val,$name,isset(request()->want_to)?request()->want_to:1);
                        @endphp
                    </select>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <p class="label">{{$lang['4']}}:</p>
                    <select class="input" name="is_frac" id="is_frac">
                        @php
                            $name = [$lang['5'],$lang['6']];
                            $val = [1,2];
                            optionsList($val,$name,isset(request()->is_frac)?request()->is_frac:1);
                        @endphp
                    </select>
                </div>
                <div class="col-span-12  mx-auto firstt ">
                    <table class="w-100">
                        <tr>
                            <td rowspan="2" class="frist_p">
                                <input type="number" class="input first_wNum " name="s1" value="{{ isset($_POST['s1'])?$_POST['s1']:'3' }}" placeholder="whole number">
                            </td>
                            <td class="pb-1">
                                <input type="number" name="n1" value="{{ isset($_POST['n1'])?$_POST['n1']:'2' }}" class="input" placeholder="numerator">
                            </td>
                        </tr>
                        <tr>
                            <td class="bdr-top pt-1">
                                <input type="number" name="d1" min="1" value="{{ isset($_POST['d1'])?$_POST['d1']:'5' }}" class="input" placeholder="denominator">
                            </td>
                        </tr>
                    </table>
                    <div class="col-12">
                        <p class="text-blue mt-3">{{$lang['6']}}:</p>
                        <input type="number" min="1" max="100" name="no" value="{{ isset($_POST['no'])?$_POST['no']:'5' }}" class="input">
                    </div>
                </div>
                <div class="col-span-6 second  pe-lg-2">
                    <table class="w-100">
                        <p class="mt-3 label text-center">{{$lang['7']}}:</p>
                        <tr>
                            <td rowspan="2" class="second_wNum  pe-2">
                                <input type="number" name="s2" placeholder="whole number"
                                    value="{{ isset($_POST['s2'])?$_POST['s2']:'' }}" class="input ">
                            </td>
                            <td class="pb-1">
                                <input type="number" name="n2" value="{{ isset($_POST['n2'])?$_POST['n2']:'2' }}" placeholder="numerator"
                                    class="input">
                            </td>
                        </tr>
                        <tr>
                            <td class="bdr-top pt-1">
                                <input type="number" name="d2" min="1" placeholder="denominator"
                                    class="input" value="{{ isset($_POST['d2'])?$_POST['d2']:'4' }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-span-6 second  ps-lg-2">
                    <table class="w-100">
                        <p class="mt-3 label text-center">{{$lang['8']}}:</p>
                        <tr>
                            <td rowspan="2" class="pe-2 second_wNum ">
                                <input type="number" name="s3" placeholder="whole number"
                                    value="{{ isset($_POST['s3'])?$_POST['s3']:'' }}" class="input">
                            </td>
                            <td class="pb-1">
                                <input type="number" name="n3" class="input" placeholder="numerator"
                                    value="{{ isset($_POST['n3'])?$_POST['n3']:'5' }}">
                            </td>
                        </tr>
                        <tr>
                            <td class="bdr-top pt-1">
                                <input type="number" name="d3" min="1" placeholder="denominator"
                                    class="input" value="{{ isset($_POST['d3'])?$_POST['d3']:'11' }}">
                            </td>
                        </tr>
                    </table>
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
                        @php
                            $want_to = request()->want_to;
                            $is_frac = request()->is_frac;
                        @endphp
                        <div class="w-full">
                            <p class="text-[16px] my-2 clr">{{$lang['9']}}</p>
                            <div>
                                @if($want_to== 1)
                                    <?php if($detail['upper'][0]<$detail['bottom'][0]){ ?>
                                    <p class="text-[16px]">{{$lang['9']}}</p>
                                    <?php }elseif($detail['upper'][0]>$detail['bottom'][0]){ ?>
                                    <p class="text-[16px] mt-1">{{$lang['10']}}</p>
                                    <?php }else{ ?>
                                    <p class="text-[16px] mt-1">{{$lang['11']}}</p>
                                    <?php } ?>
                                    <p class="text-[16px] mt-1">{{$lang['12']}}</p>
                                    <p class="text-[20px] text-blue my-3 text-center"><strong>{{$lang['13']}}</strong></p>
                                    <table class="w-full text-[18px] text-center">
                                        @php    
                                            $i=0;
                                        @endphp
                                        @foreach ($detail['upper'] as $key => $value)
                                            @php    
                                                $i++;
                                            @endphp
                                            @if($i==1)
                                            <tr>
                                            @endif
                                            <td class="border py-2">{{$value.'/'.$detail['bottom'][$key]}}</td>
                                            @if($i==4)
                                                @php    
                                                    $i=0;
                                                @endphp
                                            </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                    <p class="text-[20px] text-blue my-3"><strong>{{$lang['14']}}:</strong></p>
                                    <table class="w-full text-[18px] text-center">
                                        @php
                                            $i=0;
                                            $j=0;
                                        @endphp
                                            @foreach ($detail['upper'] as $key => $value) 
                                            @php
                                            $i++;
                                            $j++;
                                            @endphp
                                            @if ($i==1) 
                                            <tr>
                                            @endif
                                            <td class="border py-2"> {{$detail['upper'][0].'/'.$detail['bottom'][0].' x '.$j.'/'.$j.' = '.$value.'/'.$detail['bottom'][$key]}}</td>
                                            @if ($i==2)
                                            @php
                                                $i=0;
                                            @endphp
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
            
                                @else
                                    @if($detail['same']=='yes')
                                        <p>{{$lang['15']}}</p>
                                    @else
                                        <p>{{$lang['16']}}</p>
                                    @endif
                                    <table class="w-full font-s-18 text-center">
                                        <tr>
                                            <td class="border py-2">{{$detail['input1']}}</td>
                                            <td class="border py-2">{{$detail['sign']}}</td>
                                            <td class="border py-2">{{$detail['input2']}}</td>
                                        </tr>
                                    </table>
                                @endif
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
        var want_to = document.getElementById('want_to').value;
        var is_frac = document.getElementById('is_frac').value;

        if (want_to == 1) {
            document.querySelectorAll('.firstt').forEach(function(element) {
                element.classList.add('d-block');
                element.classList.remove('d-none');
            });
            document.querySelectorAll('.second').forEach(function(element) {
                element.classList.add('d-none');
                element.classList.remove('d-block');
            });
            if (is_frac == 1) {
                document.querySelectorAll('.first_wNum').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
                document.querySelectorAll('.frist_p').forEach(function(element) {
                    element.classList.add('pe-0');
                    element.classList.remove('pe-2');
                });
                document.querySelectorAll('.second_wNum').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('table-cell');
                });
            }
        }

        document.getElementById('want_to').addEventListener('change', function() {
            var want = this.value;
            if (want == 1) {
                document.querySelectorAll('.firstt').forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.second').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
            } else {
                document.querySelectorAll('.second').forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.firstt').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
            }
        });

        document.getElementById('is_frac').addEventListener('change', function() {
            var want = this.value;
            if (want == 1) {
                document.querySelectorAll('.first_wNum').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
                document.querySelectorAll('.frist_p').forEach(function(element) {
                    element.classList.add('pe-0');
                    element.classList.remove('pe-2');
                });
                document.querySelectorAll('.second_wNum').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('table-cell');
                });
            } else {
                document.querySelectorAll('.first_wNum').forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.frist_p').forEach(function(element) {
                    element.classList.add('pe-2');
                    element.classList.remove('pe-0');
                });
                document.querySelectorAll('.second_wNum').forEach(function(element) {
                    element.classList.add('table-cell');
                    element.classList.remove('d-none');
                });
            }
        });

        @if(isset($detail) || isset($error))
            if (want_to == 1) {
                document.querySelectorAll('.firstt').forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.second').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
            } else {
                document.querySelectorAll('.second').forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.firstt').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
            }
            if (is_frac == 1) {
                document.querySelectorAll('.first_wNum').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('d-block');
                });
                document.querySelectorAll('.frist_p').forEach(function(element) {
                    element.classList.add('pe-0');
                    element.classList.remove('pe-2');
                });
                document.querySelectorAll('.second_wNum').forEach(function(element) {
                    element.classList.add('d-none');
                    element.classList.remove('table-cell');
                });
            } else {
                document.querySelectorAll('.first_wNum').forEach(function(element) {
                    element.classList.add('d-block');
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.frist_p').forEach(function(element) {
                    element.classList.add('pe-2');
                    element.classList.remove('pe-0');
                });
                document.querySelectorAll('.second_wNum').forEach(function(element) {
                    element.classList.add('table-cell');
                    element.classList.remove('d-none');
                });
            }
        @endif
    </script>
@endpush