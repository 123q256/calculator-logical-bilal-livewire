<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[35%] md:w-[35%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <select name="operations" id="operations" class="input my-2">
                    <option value="1" selected>mcg to mg</option>
                    <option value="2"
                        {{ isset($_POST['operations']) && $_POST['operations'] === '2' ? 'selected' : '' }}>mg to mcg
                    </option>
                </select>
            </div>
            <div class="col-span-12  one">
                <label for="first" class="font-s-14 text-blue one_text">
                    @if(isset($_POST['operations']) && $_POST['operations'] !== '1')
                        mg
                    @else
                        mcg
                    @endif
                </label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input"
                        value="{{ isset($_POST['first']) ? $_POST['first'] : '3' }}" />
                        @if(isset($_POST['operations']) && $_POST['operations'] !== '1')
                            <span class="text-blue input_unit">mg</span>
                        @else
                            <span class="mcg text-blue input_unit">μg</span>
                        @endif
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
                    <div class="w-full my-4 ">
                        @if($detail['operations'] == 1)
                            <p class=" my-3  text-center"><strong class=" text-[25px] text-center bg-[#2845F5] text-white rounded-lg px-3 py-2">{{$detail['jawab']." mg"}}</strong></p>
                            <p class="font-s-20 mt-2 mb-1"><strong>{{$lang[3]}}:</strong></p>
                            <p class="my-2">{{$lang[4]}} = {{$_POST['first']." μg"}}</p>
                            <p class="my-2">{{$lang[5]}} = {{$_POST['first']." / 1000"}}</p>
                            <p class="my-2">{{$lang[2]}} = {{$detail['jawab']." mg" }}</p>
                        @else
                            <p class="my-3  text-center"><strong  class=" text-[25px] text-center bg-[#2845F5] text-white rounded-lg px-3 py-2">{{$detail['jawab']." μg"}}</strong></p>
                            <p class="font-s-20 mt-2 mb-1"><strong>{{$lang[3]}}:</strong></p>
                            <p class="my-2">{{$lang[4]}} = {{$_POST['first']." mg"}}</p>
                            <p class="my-2">{{$lang[5]}} = {{$_POST['first']." × 1000"}}</p>
                            <p class="my-2">{{$lang[2]}} = {{$detail['jawab']." μg" }}</p>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                var to_cal = this.value;
                var mcg = document.querySelector('.mcg');
                var one = document.querySelector('.one');
                var text = document.querySelector('.one_text');
                if (to_cal == 1) {
                    text.innerHTML = "mcg";
                    mcg.innerHTML = "μg";
                } else if (to_cal == 2) {
                    text.innerHTML = "mg";
                    mcg.innerHTML = "mg";

                }
            });
        </script>
    @endpush
</form>
