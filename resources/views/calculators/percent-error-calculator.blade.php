<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 ">
            <div class="col-span-12">
                <label for="av" class="label">{{$lang['accept']}}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="av" min="1" id="av" class="input" value="{{ isset($_POST['av'])?$_POST['av']:'73' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="ov" class="label">{{$lang['observe']}}</label>
                <div class="w-100 py-2">
                    <input type="text" step="any" name="ov" min="1" id="ov" class="input" value="{{ isset($_POST['ov'])?$_POST['ov']:'100' }}" aria-label="input"/>
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
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['percent_err']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['own_error']))?abs($detail['own_error']):'0.0'}}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['non_absolute']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['own_error']))?$detail['own_error']:'0.0'}}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['absolute_err']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['own_error']))?(abs($_POST['ov']-$_POST['av'])):'0.0'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[16px]">
                                <p class="mt-2"><strong>{{$lang['cal']}}</strong></p>
                                <p class="mt-2">
                                    PE = 
                                    <span class="quadratic_fraction">
                                        <span class="num">OV - AV</span>
                                        <span>AV</span>
                                    </span>
                                    × 100
                                </p>
                                <p class="mt-2">
                                    PE = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$_POST['ov']}} - {{$_POST['av']}}</span>
                                        <span>{{$_POST['av']}}</span>
                                    </span>
                                    × 100
                                </p>
                                <p class="mt-2">
                                    PE = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$_POST['ov'] - $_POST['av']}}</span>
                                        <span>{{$_POST['av']}}</span>
                                    </span>
                                    × 100
                                </p>
                                <p class="mt-2">
                                    PE = {{($_POST['ov'] - $_POST['av']) / $_POST['av']}} × 100 
                                </p>
                                <p class="mt-2">
                                    PE = {{$detail['own_error']}}% 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>