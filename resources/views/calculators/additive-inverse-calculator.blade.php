<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="nbr" class="font-s-14 text-blue">Enter a Number:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="nbr" id="nbr" value="{{ isset($_POST['nbr'])?$_POST['nbr']:'13' }}" class="input" aria-label="input" />
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Additive Inverse</strong></td>
                                    <td class="py-2 border-b">{{ $detail['ans'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>Solution</strong></p>
                            <p class="mt-2">Additive Inverse = (-1) x Number</p>
                            <p class="mt-2">Additive Inverse = (-1) x {{$_POST['nbr']}}</p>
                            <p class="mt-2">Additive Inverse = {{$detail['ans']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>