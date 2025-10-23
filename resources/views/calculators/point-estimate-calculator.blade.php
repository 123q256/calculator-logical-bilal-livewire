<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="success" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <input type="number" step="any" name="success" id="success" value="{{ isset($_POST['success'])?$_POST['success']:'4' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="trials" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <input type="number" step="any" name="trials" id="trials" value="{{ isset($_POST['trials'])?$_POST['trials']:'10' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="ci" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                        <input type="number" step="any" name="ci" id="ci" min="0" max="99.99" value="{{ isset($_POST['ci'])?$_POST['ci']:'95' }}" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                    <input type="hidden" id="rs" name="z" value="1.959964">
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
                    <div class="w-full  mt-3">
                        @php
                            $pe=$detail['pe'];
                            $z=$detail['z'];
                            $mle=$detail['mle'];
                            $laplace=$detail['laplace'];
                            $jeffrey=$detail['jeffrey'];
                            $wilson=$detail['wilson'];
                        @endphp
                        <div class="row">
                            <div class="text-center">
                                <p class="font-s-20"><strong>{{$lang['4']}}</strong></p>
                                <p class="radius-10 d-inline-block my-3">
                                    <strong class="bg-[#2845F5] text-white text-[30px] rounded-lg px-3 py-2">{{ $pe }}</strong>
                                </p>
                            </div>
                            <div class="col-lg-7 mt-2 overflow-auto">
                                <table class="w-100">
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?=$lang['5']?></strong></td>
                                        <td class="py-2 border-b"><?=$z?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?=$lang['6']?> (MLE)</strong></td>
                                        <td class="py-2 border-b"><?=$mle?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?=$lang['7']?></strong></td>
                                        <td class="py-2 border-b"><?=$laplace?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?=$lang['8']?></strong></td>
                                        <td class="py-2 border-b"><?=$jeffrey?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?=$lang['9']?></strong></td>
                                        <td class="py-2 border-b"><?=$wilson?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    
@endpush