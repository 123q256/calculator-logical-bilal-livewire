<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 px-2">
                    <label for="n" class="label n_text">{{ $lang['6'] }}?</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="n" id="n" value="{{ isset($_POST['n'])?$_POST['n']:'6' }}" maxlength="6" class="input " aria-label="input" placeholder="00" />
                        <span class="input_unit n_icon">(n)</span>
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="r" class="label r_text">{{ $lang['7'] }}?</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="r" id="r" value="{{ isset($_POST['r'])?$_POST['r']:'2' }}" class="input " aria-label="input" placeholder="00" />
                        <span class="input_unit n_icon">(r)</span>
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
                        @php
                            $n=request()->n;
                            $r=request()->r;
                        @endphp 
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['9']}}</strong></p>
                        <div class="flex justify-center">
                            <p class="text-[25px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ $detail['res-ans'] }}</strong>
                            </p>
                        </div>
                    </div>
                        <div>
                            <p class="w-full mt-3 text-[20px]"><b class="text-blue"><?=$lang['12']?>:</b></p>
                            <p class="w-full mt-2"><strong><?=$lang['13']?></strong></p>
                            <p class="w-full mt-2">C(n, r) = n! / (r! * (n - r)!)</p>
                            <p class="w-full mt-2">{{$lang['17']}} n = {{$n}} {{$lang['18']}} r = {{$n}} . {{$lang['19']}}:</p>
                            <p class="w-full mt-2">C(n, r) = ?</p>
                            <p class="w-full mt-2">C(n, r) = C({{$n ." , ". $r}})</p>
                            <p class="w-full mt-2">= {{$n."! / "." ( ". $r."!". " ( ".$n ." - ". $r." )! )"}}</p>
                            <p class="w-full mt-2">= {{$n."! / ". $r."! x ". $n - $r."!"}}</p>
                            <p class="w-full mt-2">= {{ $detail['res-ans'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>