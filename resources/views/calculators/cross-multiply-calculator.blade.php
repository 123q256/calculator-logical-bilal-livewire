<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-8">
                <div class="col-lg-10">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-6">
                            <label for="a" class="font-s-14 text-blue">A:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a'])?$_POST['a']:'' }}" aria-label="input"/>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="c" class="font-s-14 text-blue">C:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" name="c" id="c" class="input" value="{{ isset($_POST['c'])?$_POST['c']:'13' }}" aria-label="input"/>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="b" class="font-s-14 text-blue">B:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($_POST['b'])?$_POST['b']:'2' }}" aria-label="input"/>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="d" class="font-s-14 text-blue">D:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="d" id="d" class="input" value="{{ isset($_POST['d'])?$_POST['d']:'3' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-4 text-center flex items-center">
                <p class="text-[32px]">
                    <strong>
                        <span class="quadratic_fraction">
                            <span class="num">A</span>
                            <span>B</span>
                        </span> = 
                        <span class="quadratic_fraction">
                            <span class="num">C</span>
                            <span>D</span>
                        </span>
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
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @if(isset($detail['a_val']))
                                <div class="w-full md:w-[30%] lg:w-[30%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>A = </strong></td>
                                            <td class="py-2 border-b">{{round($detail['a_val'],5)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>{{$lang['2']}}</strong></p>
                                    <p class="mt-2">
                                        {{$lang['3']}}:  
                                        <span class="quadratic_fraction">
                                            <span class="num">A</span>
                                            <span>{{$_POST['b']}}</span>
                                        </span> = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['c']}}</span>
                                            <span>{{$_POST['d']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">{{$lang['4']}}:</p>
                                    <p class="mt-2">
                                        A × {{$_POST['d']}} = {{$_POST['c']}} × {{$_POST['b']}}
                                    </p>
                                    <p class="mt-2">
                                        A = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['c']}} × {{$_POST['b']}}</span>
                                            <span>{{$_POST['d']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        A = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['c'] * $_POST['b']}}</span>
                                            <span>{{$_POST['d']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        A = {{round($detail['a_val'],5)}}
                                    </p>
                                </div>
                            @elseif(isset($detail['b_val']))
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>B = </strong></td>
                                            <td class="py-2 border-b">{{round($detail['b_val'],5)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 font-s-16">
                                    <p class="mt-2"><strong>{{$lang['2']}}</strong></p>
                                    <p class="mt-2">
                                        {{$lang['3']}}:  
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a']}}</span>
                                            <span>B</span>
                                        </span> = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['c']}}</span>
                                            <span>{{$_POST['d']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">{{$lang['4']}}:</p>
                                    <p class="mt-2">
                                        {{$_POST['a']}} × {{$_POST['d']}} = {{$_POST['c']}} × B
                                    </p>
                                    <p class="mt-2">
                                        B = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a']}} × {{$_POST['d']}}</span>
                                            <span>{{$_POST['c']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        B = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a'] * $_POST['d']}}</span>
                                            <span>{{$_POST['c']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        B = {{round($detail['b_val'],5)}}
                                    </p>
                                </div>
                            @elseif(isset($detail['c_val']))
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>C = </strong></td>
                                            <td class="py-2 border-b">{{round($detail['c_val'],5)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 font-s-16">
                                    <p class="mt-2"><strong>{{$lang['2']}}</strong></p>
                                    <p class="mt-2">
                                        {{$lang['3']}}:  
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a']}}</span>
                                            <span>{{$_POST['b']}}</span>
                                        </span> = 
                                        <span class="quadratic_fraction">
                                            <span class="num">C</span>
                                            <span>{{$_POST['d']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">{{$lang['4']}}:</p>
                                    <p class="mt-2">
                                        {{$_POST['a']}} × {{$_POST['d']}} = C × {{$_POST['b']}}
                                    </p>
                                    <p class="mt-2">
                                        C = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a']}} × {{$_POST['d']}}</span>
                                            <span>{{$_POST['b']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        C = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a'] * $_POST['d']}}</span>
                                            <span>{{$_POST['b']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        C = {{round($detail['c_val'],5)}}
                                    </p>
                                </div>
                            @else
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>D = </strong></td>
                                            <td class="py-2 border-b">{{round($detail['d_val'],5)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 font-s-16">
                                    <p class="mt-2"><strong>{{$lang['2']}}</strong></p>
                                    <p class="mt-2">
                                        {{$lang['3']}}:  
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['a']}}</span>
                                            <span>{{$_POST['b']}}</span>
                                        </span> = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['c']}}</span>
                                            <span>D</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">{{$lang['4']}}:</p>
                                    <p class="mt-2">
                                        {{$_POST['a']}} × D = {{$_POST['c']}} × {{$_POST['b']}}
                                    </p>
                                    <p class="mt-2">
                                        D = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['b']}} × {{$_POST['c']}}</span>
                                            <span>{{$_POST['a']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        D = 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['b'] * $_POST['c']}}</span>
                                            <span>{{$_POST['a']}}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        D = {{round($detail['d_val'],5)}}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>