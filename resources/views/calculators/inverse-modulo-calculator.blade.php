<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <p class="col-span-12 text-center my-3 text-[18px]">
                    <strong id="changeText">
                        @if (isset($_POST['opr']) && $_POST['opr'] === '2')
                            a + x = 0 mod m
                        @else
                            a * x = 1 mod m
                        @endif
                    </strong>
                </p>
                <div class="col-span-12">
                    <label for="opr" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select class="input" aria-label="select" name="opr" id="opr">
                            <option value="1">{{$lang[2]}}</option>
                            <option value="2" {{ isset($_POST['opr']) && $_POST['opr']=='2'?'selected':'' }}>{{$lang[3]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a" class="font-s-14 text-blue">{{$lang[4]}} a</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : '2' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b" class="font-s-14 text-blue">{{$lang[5]}} m</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : '5' }}" aria-label="input" />
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
                        @if($detail['res']=='no')
                            <div class="w-full text-center">
                                <p><strong class="bg-sky px-3 py-2 text-[22px] rounded-lg text-blue">{{$lang['6']}}</strong></p>
                            </div>
                        @else
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>Inverse Modulo </strong></td>
                                        <td class="py-2 border-b mx-3">{{$detail['res']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full font-s-16">
                                <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                                <p class="mt-2">{{ $_POST['a'] }} {{ ($_POST['opr'] == 1) ? '*' : '+' }} x = 1 mod {{ $_POST['b'] }}</p>
                                <p class="mt-2">{{$lang['8']}}: x = {{$detail['res']}}</p>
                                <p class="mt-2">{{ $lang['9'] }} {{ $_POST['a'] }} {{ ($_POST['opr'] == 1) ? '*' : '+' }} {{ $detail['res'] }} =  {{ $_POST['a'] + $detail['res'] }}</p>
                                <p class="mt-2">and {{$_POST['a']+$detail['res']}} = 1 mod {{ $_POST['b'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('opr').addEventListener('change', function() {
                if(this.value === '2'){
                    document.getElementById('changeText').textContent = "a + x = 0 mod m";
                }else{
                    document.getElementById('changeText').textContent = "a * x = 1 mod m";
                }
            });
        </script>
    @endpush
</form>
