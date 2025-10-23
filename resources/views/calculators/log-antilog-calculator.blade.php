<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-3 lg:gap-3">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="method" class="font-s-14 text-blue">{{$lang['t_cal']}}</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="method" id="method">
                        <option value="log">{{$lang['log']}}</option>
                        <option value="anti" {{ isset($_POST['method']) && $_POST['method'] == 'anti' ? 'selected' : '' }}>{{$lang['anti']}}</option>
                        <option value="ln" {{ isset($_POST['method']) && $_POST['method'] == 'ln' ? 'selected' : '' }}>ln</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="x" class="font-s-14 text-blue">{{$lang['x']}}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'13' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="y" class="font-s-14 text-blue">{{$lang['y']}}</label>
                <div class="w-100 py-2">
                    <input type="text" step="any" name="y" id="y" class="input" value="{{ isset($_POST['y'])?$_POST['y']:'10' }}" aria-label="input"/>
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
                        <div class="w-full flex justify-center">
                            <div class="w-full text-[18px]">
                                <p class="flex justify-center">
                                    @if($_POST['method'] === "anti")
                                        {{$lang['anti']}}
                                    @elseif($_POST['method'] === "ln")
                                        ln
                                    @else
                                        {{$lang['log']}}
                                    @endif
                                </p>
                                <p class="my-3 flex justify-center"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg ">{{ (isset($detail['ans'])) ? $detail['ans'] : "0.0" }}</strong></p>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('method').addEventListener('change', function() {
                var method = this.value;
                var yInput = document.getElementById('y');
                if (method === 'ln') {
                    yInput.value = 'e';
                } else {
                    yInput.value = '10';
                }
            });
        </script>
    @endpush
</form>