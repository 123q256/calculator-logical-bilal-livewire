<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="win" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="number" step="any" name="win" id="win" class="input" aria-label="input"  value="{{ isset($_POST['win'])?$_POST['win']:'40' }}" />
                </div>
                <div class="space-y-2">
                    <label for="loss" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <input type="number" step="any" name="loss" id="loss" class="input" aria-label="input"  value="{{ isset($_POST['loss'])?$_POST['loss']:'22' }}" />
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
                <div class="rounded-lg  flex items-center">
                    <div class="w-full p-3 rounded-lg mt-3">
                        <div class="my-2">
                            <div class="text-center">
                                <p class="text-lg font-semibold">{{ $lang['3'] }}</p>
                                <p class="text-4xl bg-[#2845F5] text-white px-3 py-2 rounded-lg inline-block my-3">
                                    <strong class="text-blue">{{ $detail['answer'] }}</strong>
                                </p>
                                <p>{{ $lang[4] }} ⚾</p>
                            </div>
                            <div class="">
                                <p class="text-lg font-semibold mt-2">{{ $lang[5] }}</p>
                                <p class="mt-2">{{ $lang[6] }}.</p>
                                <p class="mt-2">{{ $lang[7] }} = T<sub>G</sub> - W<sub>T</sub> - L<sub>O</sub> + 1</p>
                                <p class="mt-2">{{ $lang[7] }} = 162 - {{ $detail['win'] }} - {{ $detail['loss'] }} + 1</p>
                                <p class="mt-2">{{ $lang[7] }} = {{ round($detail['answer'], 4) }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>