<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    {{-- <div class="col-12 col-lg-7 mx-auto">
        <div class="row">
          
            <div class="col-lg-6 col-12 px-2 pe-lg-4  mt-0 mt-lg-2">
                <label for="tax_year" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                     <select name="tax_year" class="input" id="tax_year">
                        <option value="2020" {{ isset($_POST['tax_year']) && $_POST['tax_year']=='2020'?'selected':''}} >2020 (<?=$lang['2']?> 2021)</option>
                        <option value="2019" {{ isset($_POST['tax_year']) && $_POST['tax_year']=='2019'?'selected':''}} >2019 (<?=$lang['2']?> 2020)</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4  mt-0 mt-lg-2">
                <label for="income" class="font-s-14 text-blue">{{ $lang['quantity'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="income" value="{{ isset($_POST['income'])?$_POST['income']:'10' }}" class="input" placeholder="00">
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4  mt-0 mt-lg-2">
                <label for="f_state" class="font-s-14 text-blue">{{ $lang['f_state'] }}:</label>
                <div class="w-100 py-2">
                   <div class="input-field col">
						<select name="f_state" id="f_state" class="input">
                            <option value="s" {{ isset($_POST['f_state']) && $_POST['f_state']=='s'?'selected':''}} ><?=$lang['single']?></option>
                            <option value="m_j" {{ isset($_POST['f_state']) && $_POST['f_state']=='m_j'?'selected':''}}  ><?=$lang['m_join']?></option>
                            <option value="m_s" {{ isset($_POST['f_state']) && $_POST['f_state']=='m_s'?'selected':''}} ><?=$lang['m_sep']?></option>
                            <option value="h" {{ isset($_POST['f_state']) && $_POST['f_state']=='h'?'selected':''}}  ><?=$lang['h_onwer']?></option>
                            <option value="w" {{ isset($_POST['f_state']) && $_POST['f_state']=='w'?'selected':''}} ><?=$lang['5']?></option>
						</select>
					</div>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4  mt-0 mt-lg-2">
                <label for="age" class="font-s-14 text-blue">{{ $lang['age'] }}:</label>
                <div class="w-100 py-2">
				    <input type="number" min="18" max="99" name="age" value="{{ isset($_POST['age'])?$_POST['age']:'20' }}" class="input" placeholder="00">
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4  mt-0 mt-lg-2">
                <label for="k_con" class="font-s-14 text-blue">{{ $lang['k_con'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="k_con" value="{{ isset($_POST['k_con'])?$_POST['k_con']:'12' }}" class="input" placeholder="00">
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4  mt-0 mt-lg-2">
                <label for="ira" class="font-s-14 text-blue">{{ $lang['ira'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="ira" value="{{ isset($_POST['ira'])?$_POST['ira']:'10' }}" class="input" placeholder="00">
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4  mt-0 mt-lg-2">
                <label for="tax_with" class="font-s-14 text-blue">{{ $lang['tax_with'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="tax_with" value="{{ isset($_POST['tax_with'])?$_POST['tax_with']:'15' }}" class="input" placeholder="00">
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4  mt-0 mt-lg-2">
                <label for="ded" class="font-s-14 text-blue">{{ $lang['ded'] }}:</label>
                <div class="w-100 py-2">
                    <select name="ded" id="ded" class="input">
                        <option value="s" {{ isset($_POST['ded']) && $_POST['ded']=='s'?'selected':''}} ><?=$lang['stand']?></option>
                        <option value="i" {{ isset($_POST['ded']) && $_POST['ded']=='i'?'selected':''}} ><?=$lang['item']?></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4 ded  mt-0 mt-lg-2">
                <label for="item" class="font-s-14 text-blue">{{ $lang['item'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="item" value="{{ isset($_POST['item'])?$_POST['item']:'' }}" class="input" placeholder="00">
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="tax_year" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="tax_year" class="input" id="tax_year">
                        <option value="2020" {{ isset($_POST['tax_year']) && $_POST['tax_year']=='2020'?'selected':''}} >2020 (<?=$lang['2']?> 2021)</option>
                        <option value="2019" {{ isset($_POST['tax_year']) && $_POST['tax_year']=='2019'?'selected':''}} >2019 (<?=$lang['2']?> 2020)</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="income" class="font-s-14 text-blue">{{ $lang['quantity'] }}:</label>
                    <input type="number" step="any" name="income" value="{{ isset($_POST['income'])?$_POST['income']:'10' }}" class="input" placeholder="00">
                    <span class="input_unit">{{$currancy }}</span>
                </div>
                <div class="space-y-2">
                    <label for="f_state" class="font-s-14 text-blue">{{ $lang['f_state'] }}:</label>
                    <select name="f_state" id="f_state" class="input">
                        <option value="s" {{ isset($_POST['f_state']) && $_POST['f_state']=='s'?'selected':''}} ><?=$lang['single']?></option>
                        <option value="m_j" {{ isset($_POST['f_state']) && $_POST['f_state']=='m_j'?'selected':''}}  ><?=$lang['m_join']?></option>
                        <option value="m_s" {{ isset($_POST['f_state']) && $_POST['f_state']=='m_s'?'selected':''}} ><?=$lang['m_sep']?></option>
                        <option value="h" {{ isset($_POST['f_state']) && $_POST['f_state']=='h'?'selected':''}}  ><?=$lang['h_onwer']?></option>
                        <option value="w" {{ isset($_POST['f_state']) && $_POST['f_state']=='w'?'selected':''}} ><?=$lang['5']?></option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="age" class="font-s-14 text-blue">{{ $lang['age'] }}:</label>
                    <input type="number" min="18" max="99" name="age" value="{{ isset($_POST['age'])?$_POST['age']:'20' }}" class="input" placeholder="00">
                </div>
                <div class="space-y-2 relative">
                    <label for="k_con" class="font-s-14 text-blue">{{ $lang['k_con'] }}:</label>
                    <input type="number" step="any" name="k_con" value="{{ isset($_POST['k_con'])?$_POST['k_con']:'12' }}" class="input" placeholder="00">
                    <span class="input_unit">{{$currancy }}</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="ira" class="font-s-14 text-blue">{{ $lang['ira'] }}:</label>
                    <input type="number" step="any" name="ira" value="{{ isset($_POST['ira'])?$_POST['ira']:'10' }}" class="input" placeholder="00">
                    <span class="input_unit">{{$currancy }}</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="tax_with" class="font-s-14 text-blue">{{ $lang['tax_with'] }}:</label>
                    <input type="number" step="any" name="tax_with" value="{{ isset($_POST['tax_with'])?$_POST['tax_with']:'15' }}" class="input" placeholder="00">
                    <span class="input_unit">{{$currancy }}</span>
                </div>
                <div class="space-y-2">
                    <label for="ded" class="font-s-14 text-blue">{{ $lang['ded'] }}:</label>
                    <select name="ded" id="ded" class="input">
                        <option value="s" {{ isset($_POST['ded']) && $_POST['ded']=='s'?'selected':''}} ><?=$lang['stand']?></option>
                        <option value="i" {{ isset($_POST['ded']) && $_POST['ded']=='i'?'selected':''}} ><?=$lang['item']?></option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="item" class="font-s-14 text-blue">{{ $lang['item'] }}:</label>
                    <input type="number" step="any" class="" name="item" value="{{ isset($_POST['item'])?$_POST['item']:'' }}" class="input" placeholder="00">
                    <span class="input_unit">{{$currancy }}</span>
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
                <div class="w-full bg-light-blue  rounded-lg mt-6">
                    @isset($detail['e'])
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-4">
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['e'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }}{{ $detail['e'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['a'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }}{{ $detail['a'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['3'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ number_format(isset($detail['s']) ? $detail['s'] : 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['4'] }}</td>
                                <td class="py-2 border-b">{{ isset($detail['m_tax']) ? $detail['m_tax'] : 0 }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['b'] }}</td>
                                <td class="py-2 border-b">{{ $detail['b'] }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['c'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['c'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['d'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['d'] }}</td>
                            </tr>
                        </table>
                    </div>
                    @endisset
                    @isset($detail['f'])
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-4">
                        <table class="w-full text-lg">
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['f'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['f'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['a'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['a'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['3'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ number_format(isset($detail['s']) ? $detail['s'] : 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['4'] }}</td>
                                <td class="py-2 border-b">{{ isset($detail['m_tax']) ? $detail['m_tax'] : 0 }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['b'] }}</td>
                                <td class="py-2 border-b">{{ $detail['b'] }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['c'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['c'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5 font-bold">{{ $lang['d'] }}</td>
                                <td class="py-2 border-b">{{ $currancy }} {{ $detail['d'] }}</td>
                            </tr>
                        </table>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ded = document.getElementById('ded').value;
        if (ded === 'i') {
            document.querySelectorAll('.ded').forEach(function(element) {
                element.style.display = 'block';
            });
        } else {
            document.querySelectorAll('.ded').forEach(function(element) {
                element.style.display = 'none';
            });
        }
        document.getElementById('ded').addEventListener('change', function() {
            var ded = document.getElementById('ded').value;
            if (ded === 'i') {
                document.querySelectorAll('.ded').forEach(function(element) {
                    element.style.display = 'block';
                });
            } else {
                document.querySelectorAll('.ded').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
        });
    });
</script>
@endpush
