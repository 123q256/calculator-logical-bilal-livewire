<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-span-12">
                <label for="velocity" class="font-s-14 text-blue">{{ $lang[1] }} (ft/s - FPS):</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="velocity" id="velocity" class="input" value="{{ isset($_POST['velocity'])?$_POST['velocity']:'700' }}" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="weight" class="font-s-14 text-blue"><?=$lang['2']?> (<?=$lang['3']?>):</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="weight" id="weight" class="input" value="{{ isset($_POST['weight'])?$_POST['weight']:'12.5' }}" aria-label="input" placeholder="00" />
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
                        @php
                            $request = request();
                            $velocity = trim($request->velocity);
                            $weight = trim($request->weight);
                        @endphp 
                        <div class="row">
                            <div class="text-center">
                                <p class="text-[18px]"><strong>FPE ({{ $lang['4']}})</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[21px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ round($detail['answer'], 7) }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[18px]"><strong>{{ $lang['5']}}</strong></p>
                            <p class="w-full mt-2">{{ $lang['6']}}.</p>
                            <p class="w-full mt-2">FPE=V<sup>2</sup>∗W/450240</p>
                            <p class="w-full mt-2">{{ $lang['7']}}</p>
                            <p class="w-full mt-2">{{ $lang['8']}} (ft/s)</p>
                            <p class="w-full mt-2">{{ $lang['9']}} ({{ $lang['11']}})</p>
                            <p class="w-full mt-2">{{ $lang['10']}} ({{ $lang['11']}})</p>
                            <p class="w-full mt-2">FPE={{ $velocity;}}<sup>2</sup>∗{{ $weight;}}/450240</p>
                            <p class="w-full mt-2">{{  $lang[10] }}</p>
                            <p class="w-full mt-2">FPE = {{  $detail['answer'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>