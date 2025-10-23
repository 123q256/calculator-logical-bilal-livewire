<style>
    img{
        object-fit: contain;
    }
    </style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 text-center my-3 text-[18px]">
                <strong id="changeText">
                    @if (isset($_POST['opr']) && $_POST['opr'] === '2')
                        a - b = ?
                    @elseif (isset($_POST['opr']) && $_POST['opr'] === '3')
                        a x b = ?
                    @elseif (isset($_POST['opr']) && $_POST['opr'] === '4')
                        a ÷ b = ?
                    @elseif (isset($_POST['opr']) && $_POST['opr'] === '5')
                        a<sup class="font-s-14">b</sup> = ?
                    @elseif (isset($_POST['opr']) && $_POST['opr'] === '6')
                        <sup class="font-s-14">b</sup>√a = ?
                    @elseif (isset($_POST['opr']) && $_POST['opr'] === '7')
                        log<sub>a</sub>b = ?
                    @else
                        a + b = ?
                    @endif
                </strong>
            </p>
            <div class="col-span-12">
                <label for="opr" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="opr" id="opr">
                        <option value="1">{{$lang[2]}}</option>
                        <option value="2" {{ isset($_POST['opr']) && $_POST['opr']=='2'?'selected':'' }}>{{$lang[3]}}</option>
                        <option value="3" {{ isset($_POST['opr']) && $_POST['opr']=='3'?'selected':'' }}>{{$lang[4]}}</option>
                        <option value="4" {{ isset($_POST['opr']) && $_POST['opr']=='4'?'selected':'' }}>{{$lang[5]}}</option>
                        <option value="5" {{ isset($_POST['opr']) && $_POST['opr']=='5'?'selected':'' }}>{{$lang[6]}}</option>
                        <option value="6" {{ isset($_POST['opr']) && $_POST['opr']=='6'?'selected':'' }}>{{$lang[7]}}</option>
                        <option value="7" {{ isset($_POST['opr']) && $_POST['opr']=='7'?'selected':'' }}>{{$lang[8]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="a" class="label">a</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : '5' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="b" class="label">b</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : '2' }}" aria-label="input" />
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
                            <div class="w-full text-center text-[20px]">
                                <p>{!!$detail['ansText']!!}</p>
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg ">{!!$detail['ans']!!}</strong></p>
                            </div>
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
                    document.getElementById('changeText').textContent = "a - b = ?";
                }else if (this.value === '3'){
                    document.getElementById('changeText').textContent = "a x b = ?";
                }else if (this.value === '4'){
                    document.getElementById('changeText').textContent = "a ÷ b = ?";
                }else if (this.value === '5'){
                    document.getElementById('changeText').innerHTML = "a<sup class='font-s-14'>b</sup> = ?";
                }else if (this.value === '6'){
                    document.getElementById('changeText').innerHTML = "<sup class='font-s-14'>b</sup>√a = ?";
                }else if (this.value === '7'){
                    document.getElementById('changeText').innerHTML = "log<sub class='font-s-14'>a</sub>b = ?";
                }else{
                    document.getElementById('changeText').textContent = "a + b = ?";
                }
            });
        </script>
    @endpush
</form>
