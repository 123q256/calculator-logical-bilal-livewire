<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full lg:w-7/12 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                <div class="px-2 lg:pr-4">
                    <label for="x" class="label">{!! $lang['x'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="x" id="x" class="input w-full border border-gray-300 rounded-md px-3 py-2" aria-label="input" placeholder="Norm: 0.5 - 2.5" value="{{ isset($_POST['x'])?$_POST['x']:'' }}" />
                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2">%</span>
                    </div>
                </div>
                <div class="px-2 lg:pr-4">
                    <label for="y" class="label">{!! $lang['y'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="y" id="y" class="input w-full border border-gray-300 rounded-md px-3 py-2" aria-label="input" placeholder="Norm: 36 - 51" value="{{ isset($_POST['y'])?$_POST['y']:'' }}" />
                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2">%</span>
                    </div>
                </div>
                <div class="px-2 lg:pr-4">
                    <label for="z" class="label">{!! $lang['z'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="z" id="z" class="input w-full border border-gray-300 rounded-md px-3 py-2" aria-label="input" placeholder="Norm: 36 - 51" value="{{ isset($_POST['z'])?$_POST['z']:'' }}" />
                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2">%</span>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full  rounded-lg mt-3">
                        <div class="w-full mt-3">
                            <div class="w-full lg:w-9/12 flex flex-col md:flex-row justify-between">
                                <div>
                                    <p class="text-lg">{{ $lang['ans'] }}</p>
                                    <p class="text-4xl">
                                        <strong class="text-green-600">
                                            @if($detail['x'])
                                                {{ $detail['x'] }}
                                            @else
                                                0.0
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                                <div class="border-r-2 pr-3 mr-3 hidden md:block"></div>
                                <div>
                                    <p class="text-lg">{{ $lang['ans1'] }}</p>
                                    <p class="text-4xl">
                                        <strong class="text-green-600">
                                            @if($detail['y'])
                                                {{ $detail['y'] }}
                                            @else
                                                0.0
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                            </div>
                            <p class="text-xl mt-2">
                                <strong class="text-[#3E9960]">
                                    @if($detail['ans'])
                                        {{ $detail['ans'] }}
                                    @else
                                        Adequate / Hypoproliferation
                                    @endif
                                </strong>
                            </p>
                            <p>
                                <strong>
                                    @if($detail['ans_p'])
                                        {{ $detail['ans_p'] }}
                                    @else
                                        Reticulocyte index ≥2 / <2 indicates Adequate / Hypoproliferation response
                                    @endif
                                </strong>
                            </p>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>

    
    @endisset
</form>