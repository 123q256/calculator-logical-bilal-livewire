<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
         
                <div class="col-span-12">
                    <label for="stock" class="label">{{ $lang['1'] }}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="stock" id="stock" class="input" aria-label="input" placeholder="200" value="{{ isset($_POST['stock'])?$_POST['stock']:'200' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>

                @if(isset($error))
                    @foreach ($_POST['shares'] as $key => $share_val)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="shares1" class="label">{{ $lang[10] }} {{$key+1}} {{ $lang[11] }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="shares[]" id="shares1" class="input" aria-label="input" placeholder="50" value="{{$share_val}}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="prices1" class="label">{{ $lang[12] }} {{$key+1}} {{ $lang[11] }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="prices[]" id="prices1" class="input" aria-label="input" placeholder="50" value="{{$_POST['prices'][$key]}}" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                @if(!isset($detail['shares_values']) && !isset($detail['prices_values']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="shares1" class="label">{{ $lang[10] }} 1 {{ $lang[11] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="shares[]" id="shares1" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['shares[]'])?$_POST['shares[]']:'15' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="prices1" class="label">{{ $lang[12] }} 1 {{ $lang[11] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="prices[]" id="prices1" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['prices[]'])?$_POST['prices[]']:'15' }}" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="shares2" class="label">{{ $lang[10] }} 2 {{ $lang[11] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="shares[]" id="shares2" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['shares[]'])?$_POST['shares[]']:'15' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="prices2" class="label">{{ $lang[12] }} 2 {{ $lang[11] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="prices[]" id="prices2" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['prices[]'])?$_POST['prices[]']:'15' }}" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                @else
                    @php $j =1; @endphp
                    @for ($i = 0; $i < count($detail['shares_values']); $i++)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="shares{{$i}}" class="label">{{ $lang[10] }} {{$j}} {{ $lang[11] }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number"  step="any" name="shares[]" id="shares{{$i}}" class="input" aria-label="input" placeholder="50" value="{{ $detail['shares_values'][$i] }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="prices{{$i}}" class="label">{{ $lang[12] }} {{$j}} {{ $lang[11] }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number"  step="any" name="prices[]" id="prices{{$i}}" class="input" aria-label="input" placeholder="50" value="{{ $detail['prices_values'][$i] }}" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        @php $j++; @endphp
                    @endfor
                @endif
                @endif
            <div class="col-span-12 ">
                <div class="grid grid-cols-12 mt-3  gap-4 add_year">


                </div>
            </div>

            <div class="col-span-12 text-end mt-3">
                <button type="button" name="submit" id="newRow" onclick="add_row(this)" class="px-3 py-2 mx-1 addmore text-white bg-[#2845F5] rounded-[30px]"><span>+</span>{{$lang[7]}}</button>
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
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy }}{{ $detail['cost_basis'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong> {{ $detail['stock_profit'] <= 0 ? "Stock Loss" : "Stock Profit"}} {{  $detail['stock_profit'] <= 0 ? "-":""}} </strong></td>
                                <td class="py-2 border-b"> {{ $currancy}} {{ abs($detail['stock_profit']) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{  $detail['percentage'] <= 0 ? "Loss Percentage" : "Profit Percentage" }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{ $detail['percentage'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{ $detail['total_shares'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
<script>
   @if(isset($detail))
    var x = "{{$detail['arrayLengthshere']}}";
    let add_price = 1000;
    function add_row(element) {
        if (x < 100) {
            var container = document.querySelector(".add_year");

            var div1 = document.createElement("div");
            div1.className = "col-span-12 md:col-span-6 lg:col-span-6";

            var label1 = document.createElement("label");
            label1.setAttribute("for", "shares" + (x));
            label1.className = "label";
            label1.textContent = "{{ $lang[10] }} " + (x) + " {{ $lang['11'] }}";

            var div2 = document.createElement("div");
            div2.className = "w-full py-2 relative";

            var input1 = document.createElement("input");
            input1.setAttribute("type", "number");
            input1.setAttribute("name", "shares[]");
            input1.setAttribute("id", "shares" + (x));
            input1.className = "input";
            input1.setAttribute("aria-label", "input");
            input1.setAttribute("placeholder", "50");
            input1.value = "{{ isset($_POST['shares[]'])?$_POST['shares[]']:'15' }}";

            div2.appendChild(input1);
            div1.appendChild(label1);
            div1.appendChild(div2);

            var div3 = document.createElement("div");
            div3.className = "col-span-12 md:col-span-6 lg:col-span-6";

            var label2 = document.createElement("label");
            label2.setAttribute("for", "prices" + (x));
            label2.className = "label";
            label2.textContent = "{{ $lang[12] }} " + (x) + " {{ $lang['11'] }}";

            var div4 = document.createElement("div");
            div4.className = "w-full py-2 relative";

            var input2 = document.createElement("input");
            input2.setAttribute("type", "number");
            input2.setAttribute("name", "prices[]");
            input2.setAttribute("id", "prices" + (x));
            input2.className = "input";
            input2.setAttribute("aria-label", "input");
            input2.setAttribute("placeholder", "25000");
            input2.value = "{{ isset($_POST['prices[]'])?$_POST['prices[]']:'15' }}";

            var span = document.createElement("span");
            span.className = "text-blue input_unit";
            span.textContent = "{{ $currancy }}";

            div4.appendChild(input2);
            div4.appendChild(span);
            div3.appendChild(label2);
            div3.appendChild(div4);

            container.appendChild(div1);
            container.appendChild(div3);

            x++;
        } else {
            alert('Maximum Limit Reached');
        }
    }
    @else
    var x = 0;
    let add_price = 1000;
    function add_row(element) {
        if (x < 100) {
            var container = document.querySelector(".add_year");

            var div1 = document.createElement("div");
            div1.className = "col-span-12 md:col-span-6 lg:col-span-6";

            var label1 = document.createElement("label");
            label1.setAttribute("for", "shares" + (3 + x));
            label1.className = "label";
            label1.textContent = "{{ $lang[10] }} " + (3 + x) + " {{ $lang['11'] }}";

            var div2 = document.createElement("div");
            div2.className = "w-full py-2 relative";

            var input1 = document.createElement("input");
            input1.setAttribute("type", "number");
            input1.setAttribute("name", "shares[]");
            input1.setAttribute("id", "shares" + (3 + x));
            input1.className = "input";
            input1.setAttribute("aria-label", "input");
            input1.setAttribute("placeholder", "50");
            input1.value = "{{ isset($_POST['shares[]'])?$_POST['shares[]']:'15' }}";

            div2.appendChild(input1);
            div1.appendChild(label1);
            div1.appendChild(div2);

            var div3 = document.createElement("div");
            div3.className = "col-span-12 md:col-span-6 lg:col-span-6";

            var label2 = document.createElement("label");
            label2.setAttribute("for", "prices" + (3 + x));
            label2.className = "label";
            label2.textContent = "{{ $lang[12] }} " + (3 + x) + " {{ $lang['11'] }}";

            var div4 = document.createElement("div");
            div4.className = "w-full py-2 relative";

            var input2 = document.createElement("input");
            input2.setAttribute("type", "number");
            input2.setAttribute("name", "prices[]");
            input2.setAttribute("id", "prices" + (3 + x));
            input2.className = "input";
            input2.setAttribute("aria-label", "input");
            input2.setAttribute("placeholder", "25000");
            input2.value = "{{ isset($_POST['prices[]'])?$_POST['prices[]']:'15' }}";

            var span = document.createElement("span");
            span.className = "text-blue input_unit";
            span.textContent = "{{ $currancy }}";

            div4.appendChild(input2);
            div4.appendChild(span);
            div3.appendChild(label2);
            div3.appendChild(div4);

            container.appendChild(div1);
            container.appendChild(div3);

            x++;
        } else {
            alert('Maximum Limit Reached');
        }
    }
    @endif

</script>
@endpush
