<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if(!isset($detail)){
                    $_POST['operations'] = "4";
                }
            @endphp
            <div class="col-span-8">
                <div class="col-lg-10">
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="x" class="label">x ({{ $lang['1'] }}):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'25' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="n" class="label">n ({{ $lang['2'] }}):</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="n" id="n" class="input" value="{{ isset($_POST['n'])?$_POST['n']:'1' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="d" class="label">d ({{ $lang['3'] }}):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="d" id="d" class="input" value="{{ isset($_POST['d'])?$_POST['d']:'5' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-4 text-center flex items-center justify-end">
                <p class="text-20px ">
                    <strong>
                        x<sup class="text-[14px]">
                            (<span class="quadratic_fraction">
                                <span class="num">n</span>
                                <span>d</span>
                            </span>)
                        </sup> = ?
                    </strong>
                </p>
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
                    <div class="w-full overflow-auto">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['answer'], 3)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-2">{{$lang['6']}} 1:</p>
                                <p class="mt-2">
                                    = &nbsp;&nbsp;{{$_POST['x']}}
                                    <sup class="font-s-12">
                                        (<span class="quadratic_fraction">
                                            <span class="num">{{$_POST['n']}}</span>
                                            <span>{{$_POST['d']}}</span>
                                        </span>)
                                    </sup> 
                                </p>
                                <p class="mt-2">{{$lang['6']}} 2:</p>
                                @if(is_float($detail['ans_f']))
                                    <p class="mt-2">
                                        = &nbsp;&nbsp;<sup>{{$_POST['d']}}</sup>
                                        <span class="quadratic_square-root">({{$_POST['x']}})^{{$_POST['n']}}</span>
                                    </p>
                                    <p class="mt-2">{{$lang['6']}} 3:</p>
                                    <p class="mt-2">
                                        = &nbsp;&nbsp;<sup>{{$_POST['d']}}</sup>
                                        <span class="quadratic_square-root">{{$detail['a']}}</span>
                                    </p>
                                    <p class="mt-2">{{$lang['6']}} 4:</p>
                                    <p class="mt-2">{{$lang['7']}}</p>
                                    <p class="mt-2">
                                        = &nbsp;&nbsp;<sup>{{$_POST['d']}}</sup>
                                        <span class="quadratic_square-root">{{$detail['a']}}</span>
                                    </p>
                                    <p class="mt-2">{{ $detail['answer']}}</p>
                                    @isset($detail['all_roots'])
                                        <p class="mt-2">{{$lang['8']}}</p>
                                        @foreach (($detail['all_roots']) as $index => $value)
                                            <p class="mt-2">{{$detail['all_roots'][$index]}}</p>
                                        @endforeach
                                    @endisset
                                @else
                                    <p class="mt-2">{{$_POST['x']}}<sup class="font-s-14">{{$detail['ans_f']}}</sup></p>
                                    <p class="mt-2">{{$lang['6']}} 3:</p>
                                    <p class="mt-2">{{ $detail['answer']}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>