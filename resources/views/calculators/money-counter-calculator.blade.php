<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12">
                    <label for="currency" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" name="currency" id="currency" onchange="change_input(this)">
                            <option value="INR"  {{ isset($_POST['currency']) && $_POST['currency'] == 'INR'?'selected':''}} >INR - Indian Rupee </option>
                            <option value="USD"  {{ isset($_POST['currency']) && $_POST['currency'] == 'USD'?'selected':''}}> USD - US Dollar</option>
                            <option value="EUR"  {{ isset($_POST['currency']) && $_POST['currency'] == 'EUR'?'selected':''}}>EUR - Euro </option>
                            <option value="JPY"  {{ isset($_POST['currency']) && $_POST['currency'] == 'JPY'?'selected':''}}> JPY - Japanese yen</option>
                            <option value="GBP"  {{ isset($_POST['currency']) && $_POST['currency'] == 'GBP'?'selected':''}}> GBP - British Pound</option>
                            <option value="AUD"  {{ isset($_POST['currency']) && $_POST['currency'] == 'AUD'?'selected':''}}> AUD - Australian Dollar</option>
                            <option value="CAD"  {{ isset($_POST['currency']) && $_POST['currency'] == 'CAD'?'selected':''}}> CAD - Canadian Dollar </option>
                            <option value="CHF"  {{ isset($_POST['currency']) && $_POST['currency'] == 'CHF'?'selected':''}}>CHF - Swiss Franc </option>
                            <option value="SEK"  {{ isset($_POST['currency']) && $_POST['currency'] == 'SEK'?'selected':''}}>SEK - Swedish Krona</option>
                            <option value="MXN"  {{ isset($_POST['currency']) && $_POST['currency'] == 'MXN'?'selected':''}}>MXN - Mexican Peso </option>
                            <option value="NZD"  {{ isset($_POST['currency']) && $_POST['currency'] == 'NZD'?'selected':''}}>NZD - New Zealand </option>
                            <option value="PHP"  {{ isset($_POST['currency']) && $_POST['currency'] == 'PHP'?'selected':''}}>PHP - Philippine Peso </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="hours_check" class="font-s-14 text-blue">
                        <input type="checkbox" name="checkbox1" id="hours_check" onclick="hours_disables(this)" value="1" class="filled-in" checked>
                        {{ $lang['2'] }}
                    </label>
                </div>
                <div class="col-span-4">
                    <label for="min_check" class="font-s-14 text-blue">
                        <input type="checkbox" name="checkbox2" id="min_check" onclick="minutes_disables(this)" value="1" class="filled-in" checked>
                        {{ $lang['3'] }}
                    </label>
                </div>
                <div class="col-span-4">
                    <label for="sec_check" class="font-s-14 text-blue">
                        <input type="checkbox" name="checkbox3" id="sec_check" onclick="seconds_disables(this)" value="1" class="filled-in">
                        {{ $lang['4'] }}
                    </label>
                </div>
                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3  gap-4">

                    <div class="col-span-4">
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_1">$ 1</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'1' }}" class="input  hours note_val_1">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_2">$ 2</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'3' }}" class="input  hours note_val_2">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_3">5 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'5' }}" class="input  hours note_val_3">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_4">10 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'7' }}" class="input  hours note_val_4">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_5">$ 20</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'9' }}" class="input  hours note_val_5">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_6">50 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'11' }}" class="input  hours note_val_6">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_7">$ 100</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'13' }}" class="input  hours note_val_7">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_8">$ 100</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'15' }}" class="input  hours note_val_8">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue note_val_9">$ 100</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="bank_notes[]" value="{{ isset($_POST['bank_notes[]'])?$_POST['bank_notes[]']:'17' }}" class="input  hours note_val_9">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue coin_val_1">$ 1</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'2' }}" class="input  minutes coin_val_1">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue coin_val_2">5 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'4' }}" class="input  minutes coin_val_2">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue coin_val_3">10 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'6' }}" class="input  minutes coin_val_3">
                            </div>
                        </div>

                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue coin_val_4">25 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'8' }}" class="input  minutes coin_val_4">
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue coin_val_5">50 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'9' }}" class="input  minutes coin_val_5">
                            </div>
                        </div>

                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue coin_val_6">$ 1</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'10' }}" class="input  minutes coin_val_6">
                            </div>
                        </div>
                        <div class="col-span-4 ">
                            <label for="discount" class="font-s-14 text-blue coin_val_7">1 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'12' }}" class="input  minutes coin_val_7">
                            </div>
                        </div>

                        <div class="col-span-4 ">
                            <label for="discount" class="font-s-14 text-blue coin_val_8">1 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'14' }}" class="input  minutes coin_val_8">
                            </div>
                        </div>
                        <div class="col-span-4 ">
                            <label for="discount" class="font-s-14 text-blue coin_val_9">1 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="coins[]" value="{{ isset($_POST['coins[]'])?$_POST['coins[]']:'16' }}" class="input  minutes coin_val_9">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_1">$ 1</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'1' }}" class="input  seconds roll_val_1" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_2">5 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'2' }}" class="input  seconds roll_val_2" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_3">10 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'3' }}" class="input  seconds roll_val_3" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_4">25 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'4' }}" class="input  seconds roll_val_4" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_5">50 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'5' }}" class="input  seconds roll_val_5" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_6">$ 1</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'6' }}" class="input  seconds roll_val_6" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_7">1 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'7' }}" class="input  seconds roll_val_7" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_8">1 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'8' }}" class="input  seconds roll_val_8" disabled>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <label for="discount" class="font-s-14 text-blue roll_val_9">1 ¢</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" min="0" name="rolls[]" value="{{ isset($_POST['rolls[]'])?$_POST['rolls[]']:'9' }}" class="input  seconds roll_val_9" disabled>
                            </div>
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
                        <table class="w-full font-s-18">
                           <tr>
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }}</strong></td>
                               <td class="py-2 border-b"> {{ $detail['ans_currency'] }} {{ $detail['total_money'] }}</td>
                           </tr>
                        </table>
                  </div>
                    <div class="w-full text-[16px]">
                        <div class="w-full md:w-[60%] lg:w-[60%] ">
                            @if($detail['checkbox1'] !== false)
                                <div class="col">
                                    <p class="col mt-3"><strong>{{ $lang[2] }}</strong></p>
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[7] }}</td>
                                                <td class="py-2 border-b">{{ $lang[8] }}</td>
                                                <td class="py-2 border-b">{{ $lang[9] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($detail['note_input'] as $key => $value)
                                                <tr>
                                                    <td class="py-2 border-b">{{ $detail['ans_currency'] }} {{ $detail['note_quantity'][$key] }}</td>
                                                    <td class="py-2 border-b">{{ $value }}</td>
                                                    <td class="py-2 border-b">{{ $detail['ans_currency'] }} {{ $detail['note_total'][$key] }}</td>
                                                </tr>
                                                @endforeach
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[10] }}</td>
                                                <td class="py-2 border-b">{{ array_sum($detail['note_input']) }}</td>
                                                <td class="py-2 border-b">{{ $detail['ans_currency'] }} {{ array_sum($detail['note_total']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if($detail['checkbox2'] !== false)
                                <div class="col">
                                    <p class="mt-3"><strong>{{ $lang[3] }}</strong></p>
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[7] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[8] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[9] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detail['coins_input'] as $key => $value)
                                                <tr>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['coins_quantity'][$key] }}</td>
                                                    <td class="py-2 border-b" >{{ $value }}</td>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['coins_total'][$key] }}</td>
                                                </tr>
                                                @endforeach
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[11] }}</td>
                                                <td class="py-2 border-b" >{{ array_sum($detail['coins_input']) }}</td>
                                                <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ array_sum($detail['coins_total']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if(($detail['currency'] === "USD" || $detail['currency'] === "EUR" || $detail['currency'] === "JPY" || $detail['currency'] === "GBP" || $detail['currency'] === "AUD" || $detail['currency'] === "CAD" || $detail['currency'] === "CHF" || $detail['currency'] === "SEK" || $detail['currency'] === "NZD" || $detail['currency'] === "INR") && $detail['checkbox3'] !== false)
                                <div class="col">
                                    <p class="mt-3"><strong>{{ $lang[12] }}</strong></p>
                                    <table class="w-full">
                                        <thead>
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[7] }} × {{ $lang[13] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[8] }}</td>
                                                <td class="py-2 border-b" >{{ $lang[9] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detail['rolls_input'] as $key => $value) { ?>
                                                <tr>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['rolls_quantity'][$key] }} × {{ $detail['rolls_count_ans'][$key] }}</td>
                                                    <td class="py-2 border-b" >{{ $value }}</td>
                                                    <td class="py-2 border-b" >{{ $detail['ans_currency'] }} {{ $detail['rolls_total'][$key] }}</td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td class="py-2 border-b" >{{ $lang[14]}}</td>
                                                <td class="py-2 border-b" >{{ array_sum($detail['rolls_input'])}}</td>
                                                <td class="py-2 border-b" >{{ $detail['ans_currency']}} {{ array_sum($detail['rolls_total'])}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
@if(isset($detail))
<script>

document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var type = "{{$detail['checkbox1']}}";
    var checkbox = document.getElementById('hours_check');
    if (type === "1") {
        document.querySelectorAll('.hours').forEach(function (el) {
                el.disabled = false;
            });
        checkbox.setAttribute("checked", "checked"); // Add checked attribute
    } else {
        document.querySelectorAll('.hours').forEach(function (el) {
                el.disabled = true;
            });

        checkbox.removeAttribute("checked"); // Remove checked attribute
    }
});

document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var type1 = "{{$detail['checkbox2']}}";
    var checkbox = document.getElementById('min_check');
    
    if (type1 === "1") {
        document.querySelectorAll('.minutes').forEach(function (el) {
                el.disabled = false;
            });
        checkbox.setAttribute("checked", "checked"); // Add checked attribute
    } else {
        document.querySelectorAll('.minutes').forEach(function (el) {
                el.disabled = true;
            });
        checkbox.removeAttribute("checked"); // Remove checked attribute
    }
});

document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var type2 = "{{$detail['checkbox3']}}";
    var checkbox = document.getElementById('sec_check');
    
    if (type2 === "1") {
        document.querySelectorAll('.seconds').forEach(function (el) {
                el.disabled = false;
            });
        checkbox.setAttribute("checked", "checked"); // Add checked attribute
    } else {
        document.querySelectorAll('.seconds').forEach(function (el) {
                el.disabled = true;
            });
        checkbox.removeAttribute("checked"); // Remove checked attribute
    }
});
 
</script>
@endif

@if(isset($error))
<script>

document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var type = "{{isset($_POST['checkbox1'])}}";
    var checkbox = document.getElementById('hours_check');
    if (type === "1") {
        document.querySelectorAll('.hours').forEach(function (el) {
                el.disabled = false;
            });
        checkbox.setAttribute("checked", "checked"); // Add checked attribute
    } else {
        document.querySelectorAll('.hours').forEach(function (el) {
                el.disabled = true;
            });

        checkbox.removeAttribute("checked"); // Remove checked attribute
    }
});

document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var type1 = "{{isset($_POST['checkbox2'])}}";
    var checkbox = document.getElementById('min_check');
    
    if (type1 === "1") {
        document.querySelectorAll('.minutes').forEach(function (el) {
                el.disabled = false;
            });
        checkbox.setAttribute("checked", "checked"); // Add checked attribute
    } else {
        document.querySelectorAll('.minutes').forEach(function (el) {
                el.disabled = true;
            });
        checkbox.removeAttribute("checked"); // Remove checked attribute
    }
});

document.addEventListener("DOMContentLoaded", function() {
    'use strict';
    var type2 = "{{isset($_POST['checkbox3'])}}";
    var checkbox = document.getElementById('sec_check');
    
    if (type2 === "1") {
        document.querySelectorAll('.seconds').forEach(function (el) {
                el.disabled = false;
            });
        checkbox.setAttribute("checked", "checked"); // Add checked attribute
    } else {
        document.querySelectorAll('.seconds').forEach(function (el) {
                el.disabled = true;
            });
        checkbox.removeAttribute("checked"); // Remove checked attribute
    }
});
 
</script>
@endif

<script>
@if(isset($detail))
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    var currency = "{{$detail['currency']}}";
                if (currency === "USD") {
            document.querySelectorAll('.coin_val_7, .roll_val_7, .note_val_8, .coin_val_8, .roll_val_8, .note_val_9, .coin_val_9, .roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1, .coin_val_1, .roll_val_1, .note_val_2, .coin_val_2, .roll_val_2, .note_val_3, .coin_val_3, .roll_val_3, .note_val_4, .coin_val_4, .roll_val_4, .note_val_5, .coin_val_5, .roll_val_5, .note_val_6, .coin_val_6, .roll_val_6, .note_val_7').forEach(function(element) {
                element.style.display = 'block';
            });


            if (document.querySelector("input#sec_check").checked) {
                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = false;
                });
            } else {
                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = true;
                });
            }

            document.querySelector('.note_val_1').textContent = "$ 1";
            document.querySelector('.coin_val_1').textContent = "1 ¢";
            document.querySelector('.roll_val_1').textContent = "1 ¢";
            document.querySelector('.note_val_2').textContent = "$ 2";
            document.querySelector('.coin_val_2').textContent = "5 ¢";
            document.querySelector('.roll_val_2').textContent = "5 ¢";
            document.querySelector('.note_val_3').textContent = "$ 5";
            document.querySelector('.coin_val_3').textContent = "10 ¢";
            document.querySelector('.roll_val_3').textContent = "10 ¢";
            document.querySelector('.note_val_4').textContent = "10 $";
            document.querySelector('.coin_val_4').textContent = "25 ¢";
            document.querySelector('.roll_val_4').textContent = "25 ¢";
            document.querySelector('.note_val_5').textContent = "20 $";
            document.querySelector('.coin_val_5').textContent = "50 ¢";
            document.querySelector('.roll_val_5').textContent = "50 ¢";
            document.querySelector('.note_val_6').textContent = "$ 50";
            document.querySelector('.coin_val_6').textContent = "$ 1";
            document.querySelector('.roll_val_6').textContent = "$ 1";
            document.querySelector('.note_val_7').textContent = "100 $";

        } else if (currency === "EUR") {

            document.querySelectorAll('.note_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.note_val_7,.coin_val_7,.roll_val_7,.coin_val_8,.roll_val_8').forEach(function(element) {
                element.style.display = 'block';
            });

            document.getElementById('sec_check').setAttribute('disabled', 'true');

            if (document.querySelector("input#sec_check").checked) {
                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = false;
                });
            } else {
                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = true;
                });
            }


                document.querySelector('.note_val_1').textContent = "€ 5";
                document.querySelector('.coin_val_1').textContent = "1 c";
                document.querySelector('.roll_val_1').textContent = "1 c";
                document.querySelector('.note_val_2').textContent = "€ 10";
                document.querySelector('.coin_val_2').textContent = "2 c";
                document.querySelector('.roll_val_2').textContent = "2 c";
                document.querySelector('.note_val_3').textContent = "€ 20";
                document.querySelector('.coin_val_3').textContent = "5 c";
                document.querySelector('.roll_val_3').textContent = "5 c";
                document.querySelector('.note_val_4').textContent = "€ 50";
                document.querySelector('.coin_val_4').textContent = "10 c";
                document.querySelector('.roll_val_4').textContent = "10 c";
                document.querySelector('.note_val_5').textContent = "€ 100";
                document.querySelector('.coin_val_5').textContent = "20 c";
                document.querySelector('.roll_val_5').textContent = "20 c";
                document.querySelector('.note_val_6').textContent = "€ 200";
                document.querySelector('.coin_val_6').textContent = "50 c";
                document.querySelector('.roll_val_6').textContent = "50 c";
                document.querySelector('.note_val_7').textContent = "€ 500";
                document.querySelector('.coin_val_7').textContent = "€ 1";
                document.querySelector('.roll_val_7').textContent = "€ 1";
                document.querySelector('.coin_val_8').textContent = "€ 2";
                document.querySelector('.roll_val_8').textContent = "€ 2";
            // Handle EUR currency
        } else if (currency === "JPY") {

            document.querySelectorAll('.note_val_6,.note_val_5,.note_val_7,.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6').forEach(function(element) {
                element.style.display = 'block';
            });
            
                document.getElementById('sec_check').setAttribute('disabled', 'true');

                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = true;
                });

                document.querySelector('.note_val_1').textContent ="¥ 1000";
                document.querySelector('.note_val_2').textContent ="¥ 2000";
                document.querySelector('.note_val_3').textContent ="¥ 5000";
                document.querySelector('.note_val_4').textContent ="¥ 10000";

                document.querySelector('.coin_val_1').textContent ="¥ 1";
                document.querySelector('.coin_val_2').textContent ="¥ 5";
                document.querySelector('.coin_val_3').textContent ="¥ 10";
                document.querySelector('.coin_val_4').textContent ="¥ 50";
                document.querySelector('.coin_val_5').textContent ="¥ 100";
                document.querySelector('.coin_val_6').textContent ="¥ 500";

                document.querySelector('.roll_val_1').textContent ="¥ 1";
                document.querySelector('.roll_val_2').textContent ="¥ 5";
                document.querySelector('.roll_val_3').textContent ="¥ 10";
                document.querySelector('.roll_val_4').textContent ="¥ 50";
                document.querySelector('.roll_val_5').textContent ="¥ 100";
                document.querySelector('.roll_val_6').textContent ="¥ 500";

        } else if (currency === "GBP") {

            
            document.querySelectorAll('.note_val_6,.note_val_5,.note_val_7,.note_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7,.coin_val_8,.roll_val_8').forEach(function(element) {
                element.style.display = 'block';
            });
                document.getElementById('sec_check').setAttribute('disabled', 'true');

                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = true;
                });
            
            document.querySelector('.note_val_1').textContent = "£ 5";
            document.querySelector('.note_val_2').textContent = "£ 10";
            document.querySelector('.note_val_3').textContent = "£ 20";
            document.querySelector('.note_val_4').textContent = "£ 50";

            document.querySelector('.coin_val_1').textContent = "1 p";
            document.querySelector('.coin_val_2').textContent = "2 p";
            document.querySelector('.coin_val_3').textContent = "5 p";
            document.querySelector('.coin_val_4').textContent = "10 p";
            document.querySelector('.coin_val_5').textContent = "20 p";
            document.querySelector('.coin_val_6').textContent = "50 p";
            document.querySelector('.coin_val_7').textContent = "£ 1";
            document.querySelector('.coin_val_8').textContent = "£ 2";

            document.querySelector('.roll_val_1').textContent = "1 p";
            document.querySelector('.roll_val_2').textContent = "2 p";
            document.querySelector('.roll_val_3').textContent = "5 p";
            document.querySelector('.roll_val_4').textContent = "10 p";
            document.querySelector('.roll_val_5').textContent = "20 p";
            document.querySelector('.roll_val_6').textContent = "50 p";
            document.querySelector('.roll_val_7').textContent = "£ 1";
            document.querySelector('.roll_val_8').textContent = "£ 2";


        } else if (currency === "AUD") {

            document.querySelectorAll('.note_val_7,.note_val_6,.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6').forEach(function(element) {
                element.style.display = 'block';
            });

                document.getElementById('sec_check').setAttribute('disabled', 'true');

                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = true;
                });

                document.querySelector('.note_val_1').textContent ="$ 5";
                document.querySelector('.note_val_2').textContent ="$ 10";
                document.querySelector('.note_val_3').textContent ="$ 20";
                document.querySelector('.note_val_4').textContent ="$ 50";
                document.querySelector('.note_val_5').textContent ="$ 100";

                document.querySelector('.coin_val_1').textContent ="5 c";
                document.querySelector('.coin_val_2').textContent ="10 c";
                document.querySelector('.coin_val_3').textContent ="20 c";
                document.querySelector('.coin_val_4').textContent ="50 c";
                document.querySelector('.coin_val_5').textContent ="$ 1";
                document.querySelector('.coin_val_6').textContent ="$ 2";

                document.querySelector('.roll_val_1').textContent ="5 c";
                document.querySelector('.roll_val_2').textContent ="10 c";
                document.querySelector('.roll_val_3').textContent ="20 c";
                document.querySelector('.roll_val_4').textContent ="50 c";
                document.querySelector('.roll_val_5').textContent ="$ 1";
                document.querySelector('.roll_val_6').textContent ="$ 2";
        } else if (currency === "CAD") {

            document.querySelectorAll('.note_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7').forEach(function(element) {
                element.style.display = 'block';
            });

                document.getElementById('sec_check').setAttribute('disabled', 'true');
                document.querySelectorAll('.seconds').forEach(function(element) {
                    element.disabled = true;
                });
        
                document.querySelector('.note_val_1').textContent = "$ 1";
                document.querySelector('.note_val_2').textContent = "$ 5";
                document.querySelector('.note_val_3').textContent = "$ 10";
                document.querySelector('.note_val_4').textContent = "$ 20";
                document.querySelector('.note_val_5').textContent = "$ 50";
                document.querySelector('.note_val_6').textContent = "$ 100";

                document.querySelector('.coin_val_1').textContent = "1 ¢";
                document.querySelector('.coin_val_2').textContent = "5 ¢";
                document.querySelector('.coin_val_3').textContent = "10 ¢";
                document.querySelector('.coin_val_4').textContent = "25 ¢";
                document.querySelector('.coin_val_5').textContent = "50 ¢";
                document.querySelector('.coin_val_6').textContent = "$ 1";
                document.querySelector('.coin_val_7').textContent = "$ 2";

                document.querySelector('.roll_val_1').textContent = "1 ¢";
                document.querySelector('.roll_val_2').textContent = "5 ¢";
                document.querySelector('.roll_val_3').textContent = "10 ¢";
                document.querySelector('.roll_val_4').textContent = "25 ¢";
                document.querySelector('.roll_val_5').textContent = "50 ¢";
                document.querySelector('.roll_val_6').textContent = "$ 1";
                document.querySelector('.roll_val_7').textContent = "$ 2";


        } else if (currency === "CHF") {

            document.querySelectorAll('.note_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7').forEach(function(element) {
                element.style.display = 'block';
            });
                document.getElementById('sec_check').addEventListener('change', function() {
                    var isChecked = this.checked;
                    var secondsElements = document.querySelectorAll('.seconds');
                    secondsElements.forEach(function(element) {
                        element.disabled = !isChecked;
                    });
                });

                document.querySelector('.note_val_1').textContent ="fr 10";
                document.querySelector('.note_val_2').textContent ="fr 20";
                document.querySelector('.note_val_3').textContent ="fr 50";
                document.querySelector('.note_val_4').textContent ="fr 100";
                document.querySelector('.note_val_5').textContent ="fr 200";
                document.querySelector('.note_val_6').textContent ="fr 1000";

                document.querySelector('.coin_val_1').textContent ="5 c";
                document.querySelector('.coin_val_2').textContent ="10 c";
                document.querySelector('.coin_val_3').textContent ="20 c";
                document.querySelector('.coin_val_4').textContent ="fr ½";
                document.querySelector('.coin_val_5').textContent ="fr 1";
                document.querySelector('.coin_val_6').textContent ="fr 2";
                document.querySelector('.coin_val_7').textContent ="fr 5";

                document.querySelector('.roll_val_1').textContent ="5 c";
                document.querySelector('.roll_val_2').textContent ="10 c";
                document.querySelector('.roll_val_3').textContent ="20 c";
                document.querySelector('.roll_val_4').textContent ="fr ½";
                document.querySelector('.roll_val_5').textContent ="fr 1";
                document.querySelector('.roll_val_6').textContent ="fr 2";
                document.querySelector('.roll_val_7').textContent ="fr 5";
        } else if (currency === "SEK") {

            document.querySelectorAll('.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7,.note_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.note_val_6').forEach(function(element) {
                element.style.display = 'block';
            });
                document.getElementById('sec_check').addEventListener('change', function() {
                    var isChecked = this.checked;
                    var secondsElements = document.querySelectorAll('.seconds');
                    secondsElements.forEach(function(element) {
                        element.disabled = !isChecked;
                    });
                });


                document.querySelector('.note_val_1').textContent ="kr 20";
                document.querySelector('.note_val_2').textContent ="kr 50";
                document.querySelector('.note_val_3').textContent ="kr 100";
                document.querySelector('.note_val_4').textContent ="kr 200";
                document.querySelector('.note_val_5').textContent ="kr 500";
                document.querySelector('.note_val_6').textContent ="kr 1000";

                document.querySelector('.coin_val_1').textContent ="kr 1";
                document.querySelector('.coin_val_2').textContent ="kr 2";
                document.querySelector('.coin_val_3').textContent ="kr 5";
                document.querySelector('.coin_val_4').textContent ="kr 10";

                document.querySelector('.roll_val_1').textContent ="kr 1";
                document.querySelector('.roll_val_2').textContent ="kr 2";
                document.querySelector('.roll_val_3').textContent ="kr 5";
                document.querySelector('.roll_val_4').textContent ="kr 10";


        } else if (currency === "MXN") {

            document.querySelectorAll('.roll_val_5,.roll_val_4,.roll_val_3,.roll_val_2,.roll_val_1,.roll_val_6,.note_val_7,.note_val_6,.note_val_5,.roll_val_7,.note_val_8,.roll_val_8,.note_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.note_val_2,.coin_val_2,.note_val_3,.coin_val_3,.note_val_4,.coin_val_4,.coin_val_5,.coin_val_6,.coin_val_7,.coin_val_8,.coin_val_9').forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('sec_check').setAttribute('disabled', 'true');
            document.querySelectorAll('.seconds').forEach(function(element) {
                element.disabled = true;
            });


            document.querySelector('.note_val_1').textContent ="$ 20";
            document.querySelector('.note_val_2').textContent ="$ 50";
            document.querySelector('.note_val_3').textContent ="$ 100";
            document.querySelector('.note_val_4').textContent ="$ 200";
            document.querySelector('.note_val_5').textContent ="$ 500";
            document.querySelector('.note_val_6').textContent ="$ 1000";

            document.querySelector('.coin_val_1').textContent ="5 ¢";
            document.querySelector('.coin_val_2').textContent ="10 ¢";
            document.querySelector('.coin_val_3').textContent ="20 ¢";
            document.querySelector('.coin_val_4').textContent ="50 ¢";
            document.querySelector('.coin_val_5').textContent ="$ 1";
            document.querySelector('.coin_val_6').textContent ="$ 2";
            document.querySelector('.coin_val_7').textContent ="$ 5";
            document.querySelector('.coin_val_8').textContent ="$ 10";
            document.querySelector('.coin_val_9').textContent ="$ 20";


        } else if (currency === "NZD") {

            document.querySelectorAll('.coin_val_6,.roll_val_6,.note_val_7,.note_val_6,.note_val_5,.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.coin_val_5,.roll_val_5').forEach(function(element) {
                element.style.display = 'block';
            });
                document.getElementById('sec_check').addEventListener('change', function() {
                    var isChecked = this.checked;
                    var secondsElements = document.querySelectorAll('.seconds');
                    secondsElements.forEach(function(element) {
                        element.disabled = !isChecked;
                    });
                });

                document.querySelector('.note_val_1').textContent = "$ 10";
                document.querySelector('.note_val_2').textContent = "$ 20";
                document.querySelector('.note_val_3').textContent = "$ 50";
                document.querySelector('.note_val_4').textContent = "$ 100";

                document.querySelector('.coin_val_1').textContent = "10 c";
                document.querySelector('.coin_val_2').textContent = "20 c";
                document.querySelector('.coin_val_3').textContent = "50 c";
                document.querySelector('.coin_val_4').textContent = "$ 1";
                document.querySelector('.coin_val_5').textContent = "$ 2";

                document.querySelector('.roll_val_1').textContent = "10 c";
                document.querySelector('.roll_val_2').textContent = "20 c";
                document.querySelector('.roll_val_3').textContent = "50 c";
                document.querySelector('.roll_val_4').textContent = "$ 1";
                document.querySelector('.roll_val_5').textContent = "$ 2";
        } else if (currency === "INR") {



            $('.coin_val_7,.roll_val_7,.coin_val_8,.roll_val_8,.coin_val_9,.roll_val_9').hide();

                $('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.note_val_7,.note_val_8,.note_val_9').show();

                $("input#sec_check").attr("disabled", false);

                if ($("input#sec_check").prop("checked") == true) {
                    $('.seconds').prop("disabled", false);
                } else if ($("input#sec_check").prop("checked") == false) {
                    $('.seconds').prop("disabled", true);
                }

                document.querySelector('.note_val_1').textContent ="₹ 2";
                document.querySelector('.note_val_2').textContent ="₹ 5";
                document.querySelector('.note_val_3').textContent ="₹ 10";
                document.querySelector('.note_val_4').textContent ="₹ 20";
                document.querySelector('.note_val_5').textContent ="₹ 50";
                document.querySelector('.note_val_6').textContent ="₹ 100";
                document.querySelector('.note_val_7').textContent ="₹ 200";
                document.querySelector('.note_val_8').textContent ="₹ 500";
                document.querySelector('.note_val_9').textContent ="₹ 2000";

                document.querySelector('.coin_val_1').textContent ="50 paise";
                document.querySelector('.coin_val_2').textContent ="₹ 1";
                document.querySelector('.coin_val_3').textContent ="₹ 2";
                document.querySelector('.coin_val_4').textContent ="₹ 5";
                document.querySelector('.coin_val_5').textContent ="₹ 10";
                document.querySelector('.coin_val_6').textContent ="₹ 20";

                document.querySelector('.roll_val_1').textContent ="50 paise";
                document.querySelector('.roll_val_2').textContent ="₹ 1";
                document.querySelector('.roll_val_3').textContent ="₹ 2";
                document.querySelector('.roll_val_4').textContent ="₹ 5";
                document.querySelector('.roll_val_5').textContent ="₹ 10";
                document.querySelector('.roll_val_6').textContent ="₹ 20";

        } else {

            document.querySelectorAll('.roll_val_5,.roll_val_4,.roll_val_3,.roll_val_2,.roll_val_1,.roll_val_6,.note_val_7,.roll_val_7,.note_val_8,.roll_val_8,.note_val_9,.roll_val_9,.coin_val_9').forEach(function(element) {
                element.style.display = 'none';
            });

            document.querySelectorAll('.note_val_6,.note_val_5,.note_val_1,.coin_val_1,.note_val_2,.coin_val_2,.note_val_3,.coin_val_3,.note_val_4,.coin_val_4,.coin_val_5,.coin_val_6,.coin_val_7,.coin_val_8').forEach(function(element) {
                element.style.display = 'block';
            });
            document.getElementById('sec_check').setAttribute('disabled', 'true');

            document.querySelectorAll('.seconds').forEach(function(element) {
                element.disabled = true;
            });
                document.querySelector('.note_val_1').textContent = "₱ 20";
                document.querySelector('.note_val_2').textContent = "₱ 50";
                document.querySelector('.note_val_3').textContent = "₱ 100";
                document.querySelector('.note_val_4').textContent = "₱ 200";
                document.querySelector('.note_val_5').textContent = "₱ 500";
                document.querySelector('.note_val_6').textContent = "₱ 1000";

                document.querySelector('.coin_val_1').textContent = "1 ¢";
                document.querySelector('.coin_val_2').textContent = "5 ¢";
                document.querySelector('.coin_val_3').textContent = "10 ¢";
                document.querySelector('.coin_val_4').textContent = "25 ¢";
                document.querySelector('.coin_val_5').textContent = "₱ 1";
                document.querySelector('.coin_val_6').textContent = "₱ 5";
                document.querySelector('.coin_val_7').textContent = "₱ 10";
                document.querySelector('.coin_val_8').textContent = "₱ 20";
        }
});
@endif

    function hours_disables(element) {
        if (element.checked) {
            document.querySelectorAll('.hours').forEach(function (el) {
                el.disabled = false;
            });
        } else {
            document.querySelectorAll('.hours').forEach(function (el) {
                el.disabled = true;
            });
        }
    }
    function minutes_disables(element) {
        if (element.checked) {
       
            document.querySelectorAll('.minutes').forEach(function (el) {
                el.disabled = false;
            });
        } else {
            document.querySelectorAll('.minutes').forEach(function (el) {
                el.disabled = true;
            });
        }
    }
    function seconds_disables(element) {
        if (element.checked) {
       
            document.querySelectorAll('.seconds').forEach(function (el) {
                el.disabled = false;
            });
        } else {
            document.querySelectorAll('.seconds').forEach(function (el) {
                el.disabled = true;
            });
        }
    }

    function change_input(element) {
    let values = element.value;
            if (values === "USD") {

            // Hide elements
            let hideElements = document.querySelectorAll('.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
            hideElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Show elements
            let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.note_val_7');
            showElements.forEach(function(element) {
                element.style.display = 'block';
            });

            // Enable input
            document.getElementById("sec_check").disabled = false;

            // Handle seconds class enabling/disabling
            document.getElementById("sec_check").addEventListener("change", function() {
                let secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    if (this.checked) {
                        input.disabled = false;
                    } else {
                        input.disabled = true;
                    }
                });
            });

            document.querySelector('.note_val_1').textContent = "$ 1";
            document.querySelector('.coin_val_1').textContent = "1 ¢";
            document.querySelector('.roll_val_1').textContent = "1 ¢";
            document.querySelector('.note_val_2').textContent = "$ 2";
            document.querySelector('.coin_val_2').textContent = "5 ¢";
            document.querySelector('.roll_val_2').textContent = "5 ¢";
            document.querySelector('.note_val_3').textContent = "$ 5";
            document.querySelector('.coin_val_3').textContent = "10 ¢";
            document.querySelector('.roll_val_3').textContent = "10 ¢";
            document.querySelector('.note_val_4').textContent = "10 $";
            document.querySelector('.coin_val_4').textContent = "25 ¢";
            document.querySelector('.roll_val_4').textContent = "25 ¢";
            document.querySelector('.note_val_5').textContent = "20 $";
            document.querySelector('.coin_val_5').textContent = "50 ¢";
            document.querySelector('.roll_val_5').textContent = "50 ¢";
            document.querySelector('.note_val_6').textContent = "$ 50";
            document.querySelector('.coin_val_6').textContent = "$ 1";
            document.querySelector('.roll_val_6').textContent = "$ 1";
            document.querySelector('.note_val_7').textContent = "100 $";
        
        }else if (values === "EUR"){

            // Hide elements
            let hideElements = document.querySelectorAll('.note_val_8,.note_val_9,.coin_val_9,.roll_val_9');
            hideElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Show elements
            let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.note_val_7,.coin_val_7,.roll_val_7,.coin_val_8,.roll_val_8');
            showElements.forEach(function(element) {
                element.style.display = 'block';
            });
            // Enable input
            document.getElementById("sec_check").disabled = false;
            // Handle seconds class enabling/disabling
            document.getElementById("sec_check").addEventListener("change", function() {
                let secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    if (this.checked) {
                        input.disabled = false;
                    } else {
                        input.disabled = true;
                    }
                });
            });

            document.querySelector('.note_val_1').textContent = "€ 5";
            document.querySelector('.coin_val_1').textContent = "1 c";
            document.querySelector('.roll_val_1').textContent = "1 c";
            document.querySelector('.note_val_2').textContent = "€ 10";
            document.querySelector('.coin_val_2').textContent = "2 c";
            document.querySelector('.roll_val_2').textContent = "2 c";
            document.querySelector('.note_val_3').textContent = "€ 20";
            document.querySelector('.coin_val_3').textContent = "5 c";
            document.querySelector('.roll_val_3').textContent = "5 c";
            document.querySelector('.note_val_4').textContent = "€ 50";
            document.querySelector('.coin_val_4').textContent = "10 c";
            document.querySelector('.roll_val_4').textContent = "10 c";
            document.querySelector('.note_val_5').textContent = "€ 100";
            document.querySelector('.coin_val_5').textContent = "20 c";
            document.querySelector('.roll_val_5').textContent = "20 c";
            document.querySelector('.note_val_6').textContent = "€ 200";
            document.querySelector('.coin_val_6').textContent = "50 c";
            document.querySelector('.roll_val_6').textContent = "50 c";
            document.querySelector('.note_val_7').textContent = "€ 500";
            document.querySelector('.coin_val_7').textContent = "€ 1";
            document.querySelector('.roll_val_7').textContent = "€ 1";
            document.querySelector('.coin_val_8').textContent = "€ 2";
            document.querySelector('.roll_val_8').textContent = "€ 2";
        }else if (values === "JPY"){

            // Hide elements
            let hideElements = document.querySelectorAll('.note_val_6,.note_val_5,.note_val_7,.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
            hideElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Show elements
            let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6');
            showElements.forEach(function(element) {
                element.style.display = 'block';
            });

            // Enable input
            document.getElementById("sec_check").disabled = false;

            // Handle seconds class enabling/disabling
            document.getElementById("sec_check").addEventListener("change", function() {
                let secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    if (this.checked) {
                        input.disabled = false;
                    } else {
                        input.disabled = true;
                    }
                });
            });

            document.querySelector('.note_val_1').textContent ="¥ 1000";
            document.querySelector('.note_val_2').textContent ="¥ 2000";
            document.querySelector('.note_val_3').textContent ="¥ 5000";
            document.querySelector('.note_val_4').textContent ="¥ 10000";

            document.querySelector('.coin_val_1').textContent ="¥ 1";
            document.querySelector('.coin_val_2').textContent ="¥ 5";
            document.querySelector('.coin_val_3').textContent ="¥ 10";
            document.querySelector('.coin_val_4').textContent ="¥ 50";
            document.querySelector('.coin_val_5').textContent ="¥ 100";
            document.querySelector('.coin_val_6').textContent ="¥ 500";

            document.querySelector('.roll_val_1').textContent ="¥ 1";
            document.querySelector('.roll_val_2').textContent ="¥ 5";
            document.querySelector('.roll_val_3').textContent ="¥ 10";
            document.querySelector('.roll_val_4').textContent ="¥ 50";
            document.querySelector('.roll_val_5').textContent ="¥ 100";
            document.querySelector('.roll_val_6').textContent ="¥ 500";
        }else if (values === "GBP"){

                            // Hide elements
                let hideElements = document.querySelectorAll('.note_val_6,.note_val_5,.note_val_7,.note_val_8,.note_val_9,.coin_val_9,.roll_val_9');
                hideElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show elements
                let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7,.coin_val_8,.roll_val_8');
                showElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                // Enable input
                document.getElementById("sec_check").disabled = false;

                // Handle seconds class enabling/disabling
                document.getElementById("sec_check").addEventListener("change", function() {
                    let secondsInputs = document.querySelectorAll('.seconds');
                    secondsInputs.forEach(function(input) {
                        if (this.checked) {
                            input.disabled = false;
                        } else {
                            input.disabled = true;
                        }
                    });
                });
            document.querySelector('.note_val_1').textContent = "£ 5";
            document.querySelector('.note_val_2').textContent = "£ 10";
            document.querySelector('.note_val_3').textContent = "£ 20";
            document.querySelector('.note_val_4').textContent = "£ 50";

            document.querySelector('.coin_val_1').textContent = "1 p";
            document.querySelector('.coin_val_2').textContent = "2 p";
            document.querySelector('.coin_val_3').textContent = "5 p";
            document.querySelector('.coin_val_4').textContent = "10 p";
            document.querySelector('.coin_val_5').textContent = "20 p";
            document.querySelector('.coin_val_6').textContent = "50 p";
            document.querySelector('.coin_val_7').textContent = "£ 1";
            document.querySelector('.coin_val_8').textContent = "£ 2";

            document.querySelector('.roll_val_1').textContent = "1 p";
            document.querySelector('.roll_val_2').textContent = "2 p";
            document.querySelector('.roll_val_3').textContent = "5 p";
            document.querySelector('.roll_val_4').textContent = "10 p";
            document.querySelector('.roll_val_5').textContent = "20 p";
            document.querySelector('.roll_val_6').textContent = "50 p";
            document.querySelector('.roll_val_7').textContent = "£ 1";
            document.querySelector('.roll_val_8').textContent = "£ 2";
        }else if (values === "AUD"){
            // Hide elements
                let hideElements = document.querySelectorAll('.note_val_7,.note_val_6,.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
                hideElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show elements
                let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6');
                showElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                // Enable input
                document.getElementById("sec_check").disabled = false;

                // Handle seconds class enabling/disabling
                document.getElementById("sec_check").addEventListener("change", function() {
                    let secondsInputs = document.querySelectorAll('.seconds');
                    secondsInputs.forEach(function(input) {
                        if (this.checked) {
                            input.disabled = false;
                        } else {
                            input.disabled = true;
                        }
                    });
                });

            document.querySelector('.note_val_1').textContent ="$ 5";
            document.querySelector('.note_val_2').textContent ="$ 10";
            document.querySelector('.note_val_3').textContent ="$ 20";
            document.querySelector('.note_val_4').textContent ="$ 50";
            document.querySelector('.note_val_5').textContent ="$ 100";

            document.querySelector('.coin_val_1').textContent ="5 c";
            document.querySelector('.coin_val_2').textContent ="10 c";
            document.querySelector('.coin_val_3').textContent ="20 c";
            document.querySelector('.coin_val_4').textContent ="50 c";
            document.querySelector('.coin_val_5').textContent ="$ 1";
            document.querySelector('.coin_val_6').textContent ="$ 2";

            document.querySelector('.roll_val_1').textContent ="5 c";
            document.querySelector('.roll_val_2').textContent ="10 c";
            document.querySelector('.roll_val_3').textContent ="20 c";
            document.querySelector('.roll_val_4').textContent ="50 c";
            document.querySelector('.roll_val_5').textContent ="$ 1";
            document.querySelector('.roll_val_6').textContent ="$ 2";
        }else if (values === "CAD"){

            // Hide elements
            let hideElements = document.querySelectorAll('.note_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
            hideElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Show elements
            let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7');
            showElements.forEach(function(element) {
                element.style.display = 'block';
            });

            // Enable input
            document.getElementById("sec_check").disabled = false;

            // Handle seconds class enabling/disabling
            document.getElementById("sec_check").addEventListener("change", function() {
                let secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    if (this.checked) {
                        input.disabled = false;
                    } else {
                        input.disabled = true;
                    }
                });
            });

            document.querySelector('.note_val_1').textContent = "$ 1";
            document.querySelector('.note_val_2').textContent = "$ 5";
            document.querySelector('.note_val_3').textContent = "$ 10";
            document.querySelector('.note_val_4').textContent = "$ 20";
            document.querySelector('.note_val_5').textContent = "$ 50";
            document.querySelector('.note_val_6').textContent = "$ 100";

            document.querySelector('.coin_val_1').textContent = "1 ¢";
            document.querySelector('.coin_val_2').textContent = "5 ¢";
            document.querySelector('.coin_val_3').textContent = "10 ¢";
            document.querySelector('.coin_val_4').textContent = "25 ¢";
            document.querySelector('.coin_val_5').textContent = "50 ¢";
            document.querySelector('.coin_val_6').textContent = "$ 1";
            document.querySelector('.coin_val_7').textContent = "$ 2";

            document.querySelector('.roll_val_1').textContent = "1 ¢";
            document.querySelector('.roll_val_2').textContent = "5 ¢";
            document.querySelector('.roll_val_3').textContent = "10 ¢";
            document.querySelector('.roll_val_4').textContent = "25 ¢";
            document.querySelector('.roll_val_5').textContent = "50 ¢";
            document.querySelector('.roll_val_6').textContent = "$ 1";
            document.querySelector('.roll_val_7').textContent = "$ 2";
        }else if (values === "CHF"){

            // Hide elements
                let hideElements = document.querySelectorAll('.note_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
                hideElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show elements
                let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7');
                showElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                // Enable input
                document.getElementById("sec_check").disabled = false;

                // Handle seconds class enabling/disabling
                document.getElementById("sec_check").addEventListener("change", function() {
                    let secondsInputs = document.querySelectorAll('.seconds');
                    secondsInputs.forEach(function(input) {
                        input.disabled = !this.checked;
                    });
                });

            document.querySelector('.note_val_1').textContent ="fr 10";
            document.querySelector('.note_val_2').textContent ="fr 20";
            document.querySelector('.note_val_3').textContent ="fr 50";
            document.querySelector('.note_val_4').textContent ="fr 100";
            document.querySelector('.note_val_5').textContent ="fr 200";
            document.querySelector('.note_val_6').textContent ="fr 1000";

            document.querySelector('.coin_val_1').textContent ="5 c";
            document.querySelector('.coin_val_2').textContent ="10 c";
            document.querySelector('.coin_val_3').textContent ="20 c";
            document.querySelector('.coin_val_4').textContent ="fr ½";
            document.querySelector('.coin_val_5').textContent ="fr 1";
            document.querySelector('.coin_val_6').textContent ="fr 2";
            document.querySelector('.coin_val_7').textContent ="fr 5";

            document.querySelector('.roll_val_1').textContent ="5 c";
            document.querySelector('.roll_val_2').textContent ="10 c";
            document.querySelector('.roll_val_3').textContent ="20 c";
            document.querySelector('.roll_val_4').textContent ="fr ½";
            document.querySelector('.roll_val_5').textContent ="fr 1";
            document.querySelector('.roll_val_6').textContent ="fr 2";
            document.querySelector('.roll_val_7').textContent ="fr 5";
        }else if (values === "SEK"){

                // Hide elements
                let hideElements = document.querySelectorAll('.coin_val_5,.roll_val_5,.coin_val_6,.roll_val_6,.coin_val_7,.roll_val_7,.note_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
                hideElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show elements
                let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.note_val_6');
                showElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                // Enable input
                document.getElementById("sec_check").disabled = false;

                // Handle seconds class enabling/disabling
                document.getElementById("sec_check").addEventListener("change", function() {
                    let secondsInputs = document.querySelectorAll('.seconds');
                    secondsInputs.forEach(function(input) {
                        input.disabled = !this.checked;
                    });
                });
            document.querySelector('.note_val_1').textContent ="kr 20";
            document.querySelector('.note_val_2').textContent ="kr 50";
            document.querySelector('.note_val_3').textContent ="kr 100";
            document.querySelector('.note_val_4').textContent ="kr 200";
            document.querySelector('.note_val_5').textContent ="kr 500";
            document.querySelector('.note_val_6').textContent ="kr 1000";

            document.querySelector('.coin_val_1').textContent ="kr 1";
            document.querySelector('.coin_val_2').textContent ="kr 2";
            document.querySelector('.coin_val_3').textContent ="kr 5";
            document.querySelector('.coin_val_4').textContent ="kr 10";

            document.querySelector('.roll_val_1').textContent ="kr 1";
            document.querySelector('.roll_val_2').textContent ="kr 2";
            document.querySelector('.roll_val_3').textContent ="kr 5";
            document.querySelector('.roll_val_4').textContent ="kr 10";
        }else if (values === "MXN"){

            // Hide elements
            let hideElements = document.querySelectorAll('.roll_val_5,.roll_val_4,.roll_val_3,.roll_val_2,.roll_val_1,.roll_val_6,.note_val_7,.note_val_6,.note_val_5,.roll_val_7,.note_val_8,.roll_val_8,.note_val_9,.roll_val_9');
            hideElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Show elements
            let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.note_val_2,.coin_val_2,.note_val_3,.coin_val_3,.note_val_4,.coin_val_4,.coin_val_5,.coin_val_6,.coin_val_7,.coin_val_8,.coin_val_9');
            showElements.forEach(function(element) {
                element.style.display = 'block';
            });

            // Disable input
            document.getElementById("sec_check").disabled = true;

            // Disable all elements with class 'seconds'
            let secondsInputs = document.querySelectorAll('.seconds');
            secondsInputs.forEach(function(input) {
                input.disabled = true;
            });
         
            document.querySelector('.note_val_1').textContent ="$ 20";
            document.querySelector('.note_val_2').textContent ="$ 50";
            document.querySelector('.note_val_3').textContent ="$ 100";
            document.querySelector('.note_val_4').textContent ="$ 200";
            document.querySelector('.note_val_5').textContent ="$ 500";
            document.querySelector('.note_val_6').textContent ="$ 1000";

            document.querySelector('.coin_val_1').textContent ="5 ¢";
            document.querySelector('.coin_val_2').textContent ="10 ¢";
            document.querySelector('.coin_val_3').textContent ="20 ¢";
            document.querySelector('.coin_val_4').textContent ="50 ¢";
            document.querySelector('.coin_val_5').textContent ="$ 1";
            document.querySelector('.coin_val_6').textContent ="$ 2";
            document.querySelector('.coin_val_7').textContent ="$ 5";
            document.querySelector('.coin_val_8').textContent ="$ 10";
            document.querySelector('.coin_val_9').textContent ="$ 20";
        }else if (values === "NZD"){

                    // Hide elements
                let hideElements = document.querySelectorAll('.coin_val_6,.roll_val_6,.note_val_7,.note_val_6,.note_val_5,.coin_val_7,.roll_val_7,.note_val_8,.coin_val_8,.roll_val_8,.note_val_9,.coin_val_9,.roll_val_9');
                hideElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show elements
                let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.coin_val_5,.roll_val_5');
                showElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                // Enable input
                document.getElementById("sec_check").disabled = false;

                // Handle seconds class enabling/disabling
                document.getElementById("sec_check").addEventListener("change", function() {
                    let secondsInputs = document.querySelectorAll('.seconds');
                    secondsInputs.forEach(function(input) {
                        input.disabled = !this.checked;
                    });
                });
           
            document.querySelector('.note_val_1').textContent = "$ 10";
            document.querySelector('.note_val_2').textContent = "$ 20";
            document.querySelector('.note_val_3').textContent = "$ 50";
            document.querySelector('.note_val_4').textContent = "$ 100";

            document.querySelector('.coin_val_1').textContent = "10 c";
            document.querySelector('.coin_val_2').textContent = "20 c";
            document.querySelector('.coin_val_3').textContent = "50 c";
            document.querySelector('.coin_val_4').textContent = "$ 1";
            document.querySelector('.coin_val_5').textContent = "$ 2";

            document.querySelector('.roll_val_1').textContent = "10 c";
            document.querySelector('.roll_val_2').textContent = "20 c";
            document.querySelector('.roll_val_3').textContent = "50 c";
            document.querySelector('.roll_val_4').textContent = "$ 1";
            document.querySelector('.roll_val_5').textContent = "$ 2";
        }else if (values === "INR"){

            // Hide elements
            let hideElements = document.querySelectorAll('.coin_val_7,.roll_val_7,.coin_val_8,.roll_val_8,.coin_val_9,.roll_val_9');
            hideElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Show elements
            let showElements = document.querySelectorAll('.note_val_1,.coin_val_1,.roll_val_1,.note_val_2,.coin_val_2,.roll_val_2,.note_val_3,.coin_val_3,.roll_val_3,.note_val_4,.coin_val_4,.roll_val_4,.note_val_5,.coin_val_5,.roll_val_5,.note_val_6,.coin_val_6,.roll_val_6,.note_val_7,.note_val_8,.note_val_9');
            showElements.forEach(function(element) {
                element.style.display = 'block';
            });

            // Enable input
            document.getElementById("sec_check").disabled = false;

            // Handle seconds class enabling/disabling
            document.getElementById("sec_check").addEventListener("change", function() {
                let secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    input.disabled = !this.checked;
                });
            });
        
            document.querySelector('.note_val_1').textContent ="₹ 2";
            document.querySelector('.note_val_2').textContent ="₹ 5";
            document.querySelector('.note_val_3').textContent ="₹ 10";
            document.querySelector('.note_val_4').textContent ="₹ 20";
            document.querySelector('.note_val_5').textContent ="₹ 50";
            document.querySelector('.note_val_6').textContent ="₹ 100";
            document.querySelector('.note_val_7').textContent ="₹ 200";
            document.querySelector('.note_val_8').textContent ="₹ 500";
            document.querySelector('.note_val_9').textContent ="₹ 2000";

            document.querySelector('.coin_val_1').textContent ="50 paise";
            document.querySelector('.coin_val_2').textContent ="₹ 1";
            document.querySelector('.coin_val_3').textContent ="₹ 2";
            document.querySelector('.coin_val_4').textContent ="₹ 5";
            document.querySelector('.coin_val_5').textContent ="₹ 10";
            document.querySelector('.coin_val_6').textContent ="₹ 20";

            document.querySelector('.roll_val_1').textContent ="50 paise";
            document.querySelector('.roll_val_2').textContent ="₹ 1";
            document.querySelector('.roll_val_3').textContent ="₹ 2";
            document.querySelector('.roll_val_4').textContent ="₹ 5";
            document.querySelector('.roll_val_5').textContent ="₹ 10";
            document.querySelector('.roll_val_6').textContent ="₹ 20";

        }else{


                // Hide elements
                let hideElements = document.querySelectorAll('.roll_val_5,.roll_val_4,.roll_val_3,.roll_val_2,.roll_val_1,.roll_val_6,.note_val_7,.roll_val_7,.note_val_8,.roll_val_8,.note_val_9,.roll_val_9,.coin_val_9');
                hideElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show elements
                let showElements = document.querySelectorAll('.note_val_6,.note_val_5,.note_val_1,.coin_val_1,.note_val_2,.coin_val_2,.note_val_3,.coin_val_3,.note_val_4,.coin_val_4,.coin_val_5,.coin_val_6,.coin_val_7,.coin_val_8');
                showElements.forEach(function(element) {
                    element.style.display = 'block';
                });

                // Disable input
                document.getElementById("sec_check").disabled = true;

                // Disable all elements with class 'seconds'
                let secondsInputs = document.querySelectorAll('.seconds');
                secondsInputs.forEach(function(input) {
                    input.disabled = true;
                });
            document.querySelector('.note_val_1').textContent = "₱ 20";
            document.querySelector('.note_val_2').textContent = "₱ 50";
            document.querySelector('.note_val_3').textContent = "₱ 100";
            document.querySelector('.note_val_4').textContent = "₱ 200";
            document.querySelector('.note_val_5').textContent = "₱ 500";
            document.querySelector('.note_val_6').textContent = "₱ 1000";

            document.querySelector('.coin_val_1').textContent = "1 ¢";
            document.querySelector('.coin_val_2').textContent = "5 ¢";
            document.querySelector('.coin_val_3').textContent = "10 ¢";
            document.querySelector('.coin_val_4').textContent = "25 ¢";
            document.querySelector('.coin_val_5').textContent = "₱ 1";
            document.querySelector('.coin_val_6').textContent = "₱ 5";
            document.querySelector('.coin_val_7').textContent = "₱ 10";
            document.querySelector('.coin_val_8').textContent = "₱ 20";
        }
    }

</script>

@endpush