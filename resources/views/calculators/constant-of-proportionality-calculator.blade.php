<style>
.fractionUpDown {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    font-size: .9em;
}
.fractionUpDown .num {
    top: 0;
    padding: 0 .3rem;
    display: block;
    white-space: nowrap;
    border-bottom: 1px solid var(--text-color);
}
.visually-hidden {
    width: 1px;
    height: 1px;
    margin: -1px;
    padding: 0;
    border: 0;
    position: absolute;
    clip: rect(0 0 0 0);
    overflow: hidden;
}
.fractionUpDown .den {
    line-height: 15px;
    display: block;
    width: 100%;
    white-space: nowrap;
}

</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 text-center">
                    <p>
                    k = <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                            <span class="num">y</span>
                            <span class="visually-hidden"> / </span>
                            <span class="den">x</span>
                        </span>
                    </p>
                </div>
                <div class="col-span-12">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['1'] }} (Y):</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="3" value="{{ isset($_POST['y'])?$_POST['y']:'3' }}" />

                    </div>
                </div>
                <div class="col-span-12">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['2'] }} (X):</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="5" value="{{ isset($_POST['x'])?$_POST['x']:'5' }}" />
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
                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                    <table class="w-full font-s-18">
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{$lang[3]}} (K)</strong></td>
                            <td class="py-2 border-b"> {{ $detail['ans'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w-full font-s-16">
                    <p class="mt-2">
                        {{$lang[3]}} (K) =
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">y</span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">x</span>
                            </span>
                    </p>
                    <p class="mt-2">
                        {{$lang[3]}} (K) =
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">{{$_POST['y']}}</span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">{{$_POST['x']}}</span>
                            </span>
                    </p>
                    <p class="mt-2">{{$lang[3]}} (K) = {{$detail['ans']}} </p>
                </div>
            </div>
        </div>
    </div>
</div>
    
    @endisset
</form>