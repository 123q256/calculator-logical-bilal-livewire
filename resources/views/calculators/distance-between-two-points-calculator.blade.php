<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['dem'] = "2";
                }
            @endphp
            <p class="col-span-12 text-[16px]"><strong>{{$lang[1]}}</strong></p>
            <div class="col-span-6">
                <label for="x1" class="font-s-14 text-blue">x₁:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'90' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="y1" class="font-s-14 text-blue">y₁:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y1" id="y1" value="{{ isset($_POST['y1'])?$_POST['y1']:'27' }}" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12 text-[16px]"><strong>{{$lang[2]}}</strong></p>
            <div class="col-span-6">
                <label for="x2" class="font-s-14 text-blue">x₂:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'17' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="y2" class="font-s-14 text-blue">y₂:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y2" id="y2" value="{{ isset($_POST['y2'])?$_POST['y2']:'39' }}" class="input" aria-label="input" />
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
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                    <td class="py-2 border-b">{{$detail['ans']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full">
                            <p class="mt-2"><strong>{{$lang['8']}}</strong></p>
                            <p class="mt-2">(x₁ , x₂) = ({{$_POST['x1']}} , {{$_POST['x2']}})</p>
                            <p class="mt-2">(y₁ , y₂) = ({{$_POST['y1']}} , {{$_POST['y2']}})</p>
                            <p class="mt-2">
                                d = 
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">(x₂ - x₁)² + (y₂ - y₁)²</span>
                                </span>
                            </p>
                            <p class="mt-2">
                                d = 
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">({{$_POST['x2']}} - {{$_POST['x1']}})² + ({{$_POST['y2']}} - {{$_POST['y1']}})²</span>
                                </span>
                            </p>
                            <p class="mt-2">
                                d = 
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">({{$_POST['x2'] - $_POST['x1']}})² + ({{$_POST['y2'] - $_POST['y1']}})²</span>
                                </span>
                            </p>
                            <p class="mt-2">
                                d = 
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">({{pow(($_POST['x2']-$_POST['x1']),2)}}) + ({{pow(($_POST['y2']-$_POST['y1']),2)}})</span>
                                </span>
                            </p>
                            <p class="mt-2">
                                d = 
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">{{pow(($_POST['x2']-$_POST['x1']),2) + pow(($_POST['y2']-$_POST['y1']),2)}}</span>
                                </span>
                            </p>
                            <p class="mt-2">
                                d = {{$detail['ans']}}
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    @endisset
</form>