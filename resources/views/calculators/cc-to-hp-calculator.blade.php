<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="solve" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" name="solve" id="solve" onchange="change_text(this)">
                            <option value="1" {{ isset($_POST['solve']) && $_POST['solve'] == '1' ? 'selected' : '' }}> {{ $lang[2] }} </option>
                            <option value="2"  {{ isset($_POST['solve']) && $_POST['solve'] == '2' ? 'selected' : '' }}> {{ $lang[3] }} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="input" class="font-s-14 text-blue" id="cc_hp">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="input" id="input" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['input'])?$_POST['input']:'7' }}" />
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
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[5] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg text-[25px] p-3">{{ round($detail['answer'], 2) }}</strong></p>
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
        var solve_val = "{{$_POST['solve']}}";

        if (solve_val === "1") {
            document.getElementById("cc_hp").textContent = "{{$lang[4] }}";
        } else {
            document.getElementById("cc_hp").textContent = "{{$lang[6] }}";
        }

    @endif
    function change_text(element) {
        let solve_val = element.value;
        if (solve_val === "1") {
            document.getElementById("cc_hp").textContent = "{{$lang[4] }}";
        } else {
            document.getElementById("cc_hp").textContent = "{{$lang[6] }}";
        }
    }
</script>
@endpush
