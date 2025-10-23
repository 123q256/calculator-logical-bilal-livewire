<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php 
                $request = request();
                if (!isset($request->submit)) {
                    $request->calFrom = "Million";
                    $request->calto = "Lakh";
                }
            @endphp
            <div class="col-span-12">
                <label for="from" class="font-s-14 text-blue"><?=$lang['1']?></label>
                <div class="w-100 py-2">
                    @if(isset($detail))
                        <input type="number" step="any" name="from" id="from" class="input" value="{{ isset($detail['from_input']) ? $detail['from_input'] : $request->from }}" aria-label="input" />
                    @else
                        <input type="number" step="any" name="from" id="from" class="input" value="{{ isset($request->from) ? $request->from : '10000' }}" aria-label="input" />
                    @endif
                </div>
            </div>
            <div class="col-span-5 ">
                <label for="calFrom" class="font-s-14 text-blue"><?=$lang['2']?></label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="calFrom" id="calFrom">
                        <option value="Hundred" {{ isset($request->calFrom) && $request->calFrom == 'Hundred' ? 'selected' : '' }}><?=$lang['3']?></option>
                        <option value="Thousand" {{ isset($request->calFrom) && $request->calFrom == 'Thousand' ? 'selected' : '' }}><?=$lang['4']?></option>
                        <option value="Lakh" {{ isset($request->calFrom) && $request->calFrom == 'Lakh' ? 'selected' : '' }}><?=$lang['5']?></option>
                        <option value="Million" {{ isset($request->calFrom) && $request->calFrom == 'Million' ? 'selected' : '' }}><?=$lang['6']?></option>
                        <option value="Crore" {{ isset($request->calFrom) && $request->calFrom == 'Crore' ? 'selected' : '' }}><?=$lang['7']?></option>
                        <option value="Billion" {{ isset($request->calFrom) && $request->calFrom == 'Billion' ? 'selected' : '' }}><?=$lang['8']?></option>
                        <option value="Trillion" {{ isset($request->calFrom) && $request->calFrom == 'Trillion' ? 'selected' : '' }}><?=$lang['9']?></option>
                        <option value="Arab" {{ isset($request->calFrom) && $request->calFrom == 'Arab' ? 'selected' : '' }}><?=$lang['10']?></option>
                        <option value="Kharab" {{ isset($request->calFrom) && $request->calFrom == 'Kharab' ? 'selected' : '' }}><?=$lang['11']?></option>
                    </select>
                </div>
            </div>
            <div class="col-span-2 my-auto text-center">
                <button type="button" class="calculate mt-4 bg-[#2845F5] text-white rounded-lg" id="changeunit" style="padding: 5px 10px;cursor: pointer;">⇄</button>
            </div>
            <div class="col-span-5">
                <label for="calto" class="font-s-14 text-blue"><?=$lang['12']?></label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="calto" id="calto">
                        <option value="Hundred" {{ isset($request->calto) && $request->calto == 'Hundred' ? 'selected' : '' }}><?=$lang['3']?></option>
                        <option value="Thousand" {{ isset($request->calto) && $request->calto == 'Thousand' ? 'selected' : '' }}><?=$lang['4']?></option>
                        <option value="Lakh" {{ isset($request->calto) && $request->calto == 'Lakh' ? 'selected' : '' }}><?=$lang['5']?></option>
                        <option value="Million" {{ isset($request->calto) && $request->calto == 'Million' ? 'selected' : '' }}><?=$lang['6']?></option>
                        <option value="Crore" {{ isset($request->calto) && $request->calto == 'Crore' ? 'selected' : '' }}><?=$lang['7']?></option>
                        <option value="Billion" {{ isset($request->calto) && $request->calto == 'Billion' ? 'selected' : '' }}><?=$lang['8']?></option>
                        <option value="Trillion" {{ isset($request->calto) && $request->calto == 'Trillion' ? 'selected' : '' }}><?=$lang['9']?></option>
                        <option value="Arab" {{ isset($request->calto) && $request->calto == 'Arab' ? 'selected' : '' }}><?=$lang['10']?></option>
                        <option value="Kharab" {{ isset($request->calto) && $request->calto == 'Kharab' ? 'selected' : '' }}><?=$lang['11']?></option>
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <style>
                        .people_also{
                            border: 1px solid #ddd;
                            padding: 5px 8px;
                            text-align: left;
                            cursor: pointer;
                            width: 100%;
                            font-size: 14px;
                            color: #000000a3;
                            border-radius: 5px;
                            background: #F8F8F8;
                        }
                        .people_also:hover{
                            background: #0081B0;
                            color: #fff;
                        }
                    </style>
                    <div class="w-full">
                        <div class="col-12 text-[16px]">
                            <p class="mt-2 text-[18px]"><strong><?=number_format($detail['from_input']).' '.$detail['f_u_input']?> = <?=$detail['to'].' '.$detail['t_u_input']?></strong></p>
                            <p class="mt-2"><?=$lang['13']?>:</p>
                            <p class="mt-2"><strong class="ans"></strong></p>
                            <p class="mt-2"><strong><?=$request->calFrom?> <?=$lang['12']?>:</strong></p>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t1']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t2']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t3']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t4']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t5']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t6']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t7']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=number_format($_POST['from']).' '.$request->calFrom?> = </td>
                                        <td class="py-2 border-b"><?=$detail['t8']?></td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="from_new" class="from">
                            <input type="hidden" name="calFrom_new" class="calFrom">
                            <input type="hidden" name="calto_new" class="calto">
                            <p class="my-2"><strong><?=$lang['14']?></strong></p>
                            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                <?=$detail['table']?>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('changeunit').addEventListener('click', function() {
                var from = document.getElementById('calFrom').value;
                var to = document.getElementById('calto').value;
                document.getElementById('calFrom').value = to;
                document.getElementById('calto').value = from;
            });
        </script>
        @isset($detail)
            <script>
                function numberToWords(number) {  
                    var digit = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];  
                    var elevenSeries = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];  
                    var countingByTens = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];  
                    var shortScale = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];  
            
                    number = number.toString(); number = number.replace(/[\, ]/g, ''); if (number != parseFloat(number)) return 'not a number'; var x = number.indexOf('.'); if (x == -1) x = number.length; if (x > 15) return 'too big'; var n = number.split(''); var str = ''; var sk = 0; for (var i = 0; i < x; i++) { if ((x - i) % 3 == 2) { if (n[i] == '1') { str += elevenSeries[Number(n[i + 1])] + ' '; i++; sk = 1; } else if (n[i] != 0) { str += countingByTens[n[i] - 2] + ' '; sk = 1; } } else if (n[i] != 0) { str += digit[n[i]] + ' '; if ((x - i) % 3 == 0) str += 'Hundred '; sk = 1; } if ((x - i) % 3 == 1) { if (sk) str += shortScale[(x - i - 1) / 3] + ' '; sk = 0; } } if (x != number.length) { var y = number.length; str += 'Point '; for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' '; } str = str.replace(/\number+/g, ' '); return str.trim();
                } 
                var ans=numberToWords({{$detail['to']}});
                document.querySelectorAll('.ans').forEach(function(element) {
                    element.textContent = ans + " " + "{{$request->calto}}";
                });
                document.querySelectorAll('.people_also').forEach(function(element) {
                    element.addEventListener('click', function() {
                        var value = this.value;
                        var input = value.split(' ');
                        document.querySelector('.from').value = input[0];
                        document.querySelector('.calFrom').value = input[1];
                        document.querySelector('.calto').value = input[3];
                    });
                });
            </script>
        @endisset
    @endpush
</form>
