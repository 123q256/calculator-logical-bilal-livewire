<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="initial_value" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="initial_value" id="initial_value" class="input" value="{{ isset($_POST['initial_value'])?$_POST['initial_value']:'100' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="final_value" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="final_value" id="final_value" class="input" value="{{ isset($_POST['final_value'])?$_POST['final_value']:'120' }}" aria-label="input"/>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['answer'], 3)}}%</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['difference'], 3)}}</td>
                                </tr>
                            </table>
                            <p class="mt-2">
                                @if($detail['difference'] > 0)
                                    {{$_POST['final_value'] }} is a {{$detail['answer']}} % increase of {{$_POST['initial_value']}}.
                                @elseif($detail['difference'] < 0)
                                    {{$_POST['final_value'] }} is a {{$detail['answer']}} % decrease of {{$_POST['initial_value']}}.
                                @else
                                    The numbers are equal, so there is no percentage change.
                                @endif
                            </p>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>Solution</strong></p>
                            <p class="mt-2">
                                {{$lang[5]}} = 
                                (<span class="quadratic_fraction">
                                    <span class="num">{{$lang[2]}} - {{$lang[1]}}</span>
                                    <span>|{{$lang[1]}}|</span>
                                </span>) × 100
                            </p>
                            <p class="mt-2">
                                {{$lang[5]}} = 
                                (<span class="quadratic_fraction">
                                    <span class="num">{{$_POST['final_value']}} - {{$_POST['initial_value']}}</span>
                                    <span>|{{$_POST['initial_value']}}|</span>
                                </span>) × 100
                            </p>
                            <p class="mt-2">
                                {{$lang[5]}} = 
                                (<span class="quadratic_fraction">
                                    <span class="num">{{$_POST['final_value'] - $_POST['initial_value']}}</span>
                                    <span>{{ abs($_POST['initial_value']) }}</span>
                                </span>) × 100
                            </p>
                            <p class="mt-2">
                                {{$lang[5]}} = {{ abs(($_POST['final_value'] - $_POST['initial_value'])/abs($_POST['initial_value'])) }} × 100
                            </p>
                            <p class="mt-2">
                                {{$lang[5]}} = {{ abs(($_POST['final_value'] - $_POST['initial_value'])/abs($_POST['initial_value'])) * 100 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>