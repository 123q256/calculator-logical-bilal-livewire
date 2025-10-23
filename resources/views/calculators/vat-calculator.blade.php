<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-4">
                <div class="space-y-2">
                    <label for="method" class="font-s-14 text-blue">To Calculate:</label>
                    <select name="method" id="method" class="input">
                        <option value="add" {{ isset($_POST['method']) && $_POST['method']=='add'?'selected':''}} ><?=$lang['add']?></option>
                        <option value="remove" {{ isset($_POST['method']) && $_POST['method']=='remove'?'selected':''}}><?=$lang['remove']?></option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="amount" class="font-s-14 text-blue">Net Price:</label>
                    <input type="number" class="input" step="any" id="amount" value="{{ isset($_POST['amount'])?$_POST['amount']:'30' }}" name="amount" placeholder="00">
                    <span class="input_unit">{{$currancy }}</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="vat" class="font-s-14 text-blue">{{ $lang['rate'] }} %</label>
                    <input type="number" class="input" id="vat" step="any" value="{{ isset($_POST['vat'])?$_POST['vat']:'20' }}" name="vat" placeholder="00">
                    <span class="input_unit">%</span>
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
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-4">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-7/10 font-bold">Your Value-Added Tax (VAT)</td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['vatAmount'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-7/10 font-bold">{{ $lang['net_price'] }}</td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['net'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-7/10 font-bold">{{ $lang['gross_price'] }}</td>
                                    <td class="py-2 border-b">{{ $currancy }} {{ $detail['gross'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endisset
</form>