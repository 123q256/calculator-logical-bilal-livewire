<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">


                <div class="col-span-12 px-2">
                    <label for="gravity" class="font-s-14 text-blue">{{ $lang[1] }} (g) (m/s^2):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="gravity" id="gravity" class="input"
                            value="{{ isset($_POST['gravity']) ? $_POST['gravity'] : '5' }}" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="volume" class="font-s-14 text-blue">{{ $lang[2] }} (m^3):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="volume" id="volume" class="input"
                            value="{{ isset($_POST['volume']) ? $_POST['volume'] : '10' }}" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="density" class="font-s-14 text-blue">{{ $lang[3] }} (kg/m^3):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="density" id="density" class="input"
                            value="{{ isset($_POST['density']) ? $_POST['density'] : '15' }}" aria-label="input"
                            placeholder="00" />
                    </div>
                </div>


            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </div>



        @isset($detail)
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg ">
                        <div class="w-full  mt-3">
                            @php
                                $request = request();
                                $density = trim($request->density);
                                $volume = trim($request->volume);
                                $gravity = trim($request->gravity);
                            @endphp
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[18px]"><strong>{{ $lang['4'] }} (N)</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ round($detail['answer'], 7) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong>{{ $lang[5] }}</strong></p>
                                <p class="w-full mt-2">{{ $lang[6] }}.</p>
                                <p class="w-full mt-2">B=P∗V∗G</p>
                                <p class="w-full mt-2">{{ $lang[7] }}</p>
                                <p class="w-full mt-2">{{ $lang[8] }}</p>
                                <p class="w-full mt-2">{{ $lang[9] }}</p>
                                <p class="w-full mt-2">{{ $lang[10] }}</p>
                                <p class="w-full mt-2">B={{ $density }}∗{{ $volume }}∗{{ $gravity }}</p>
                                <p class="w-full mt-2">B = {{ $detail['answer'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
</form>
@push('calculatorJS')
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>