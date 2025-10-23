<style>

.quadratic_fraction {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    font-size: .9em;
}
.quadratic_fraction .num {
    top: 0;
    padding: 0 .3rem;
    display: block;
    white-space: nowrap;
    border-bottom: 1px solid black;
}

</style>



<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-4">
                        <label for="hh" class="label">HH:</label>
                        <div class="w-100 py-2">
                            <input type="number" name="hh" id="hh" min="0" maxlength="2" class="input" value="{{ isset($_POST['hh']) ? $_POST['hh'] : '2' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="mm" class="label">MM:</label>
                        <div class="w-100 py-2">
                            <input type="number" name="mm" id="mm" min="0" maxlength="2" class="input" value="{{ isset($_POST['mm']) ? $_POST['mm'] : '13' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="ss" class="label">SS:</label>
                        <div class="w-100 py-2">
                            <input type="number" name="ss" id="ss" min="0" maxlength="2" class="input" value="{{ isset($_POST['ss']) ? $_POST['ss'] : '21' }}" aria-label="input" />
                        </div>
                    </div>
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
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Time in Hours</strong></td>
                                    <td class="py-2 border-b">{{$detail['hours']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Time in Minutes</strong></td>
                                    <td class="py-2 border-b">{{$detail['mins']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>Time in Seconds</strong></td>
                                    <td class="py-2 border-b">{{$detail['secs']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px] mt-2">
                            <p class="mt-2"><strong>{{$lang[5]}}</strong></p>
                            <p class="mt-2">{{$lang[6]}}: {{ $detail['hour'] . ':' . $detail['min'] . ':' . $detail['sec'] }} ({{ $detail['hour'] . ' ' . $lang[2] . ' ' . $detail['min'] . ' ' . $lang[3] . ' ' . $detail['sec'] . ' ' . $lang[4]  }})</p>
                            <p class="mt-2">{{$lang[7]}}</p>
                            <p class="mt-2">
                                {{$detail['hour']}}hr + ({{$detail['min']}}min ×
                                <span class="quadratic_fraction">
                                    <span class="num">1hr</span>
                                    <span>60min</span>
                                </span>) + ({{$detail['sec']}}sec ×
                                <span class="quadratic_fraction">
                                    <span class="num">1hr</span>
                                    <span>3600sec</span>
                                </span>)
                            </p>
                            <p class="mt-2">= {{$detail['hour']}}hr + {{round($detail['min']/60, 4)}}hr + {{round($detail['sec']/3600, 4)}}hr</p>
                            <p class="mt-2">= {{$detail['hours']}}hr</p>
                            <p class="mt-2">{{$lang[8]}}</p>
                            <p class="mt-2">
                                ({{$detail['hour']}}hr × 60min) + {{$detail['min']}}min + ({{$detail['sec']}}sec ×
                                <span class="quadratic_fraction">
                                    <span class="num">1min</span>
                                    <span>60sec</span>
                                </span>)
                            </p>
                            <p class="mt-2">= {{$detail['hour']*60}}min + {{$detail['min']}}min + {{round($detail['sec']/60, 4)}}min</p>
                            <p class="mt-2">= {{$detail['mins']}}min</p>
                            <p class="mt-2">{{$lang[9]}}</p>
                            <p class="mt-2">({{$detail['hour']}}hr × 3600sec) + ({{$detail['min']}}min × 60sec) + {{$detail['sec']}}sec</p>
                            <p class="mt-2">= {{$detail['hour']*3600}}sec + {{$detail['min']*60}}sec + {{$detail['sec']}}sec</p>
                            <p class="mt-2">= {{$detail['secs']}}sec</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
