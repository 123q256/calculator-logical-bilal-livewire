<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="singles" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <input type="number" step="any" name="singles" id="singles" class="input" aria-label="input"  value="{{ isset($_POST['singles'])?$_POST['singles']:'7' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="doubles" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="doubles" id="doubles" class="input" aria-label="input" value="{{ isset($_POST['doubles'])?$_POST['doubles']:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="triples" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="triples" id="triples" class="input" aria-label="input" value="{{ isset($_POST['triples'])?$_POST['triples']:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="home" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="home" id="home" class="input" aria-label="input" value="{{ isset($_POST['home'])?$_POST['home']:'2' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="bats" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="bats" id="bats" class="input" aria-label="input" value="{{ isset($_POST['bats'])?$_POST['bats']:'3' }}" />
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
                    <div class="w-full my-2">
                        <div class="text-center">
                            <p class="font-s-20"><strong>{{$lang['6']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong class="text-blue">{{ round($detail['answer'], 4) }} %</strong></p>
                        </div>
                    </div>
                        <div class="">
                            <p class="font-s-20"><strong>{{ $lang[7] }}</strong></p>
                            <p class="mt-2">{{ $lang[8] }}.</p>
                            <p class="mt-2">{{ $lang[6] }} = ({{ $lang[1] }} + 2 x {{ $lang[2] }} + 3 x {{ $lang[3] }} + 4 x {{ $lang[4] }}) / {{ $lang[5] }}</p>
                            <p class="mt-2">{{ $lang[6] }} = ({{$detail['singles']; }} + 2 x {{ $detail['doubles']}} + 3 x {{ $detail['triples'] }} + 4 x {{ $detail['home'] }}) / {{ $detail['bats'] }}</p>
                            <p class="mt-2">{{ $lang[6] }} = {{ round($detail['answer'], 4) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>