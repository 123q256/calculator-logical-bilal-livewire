<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="build_date" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                    <input type="date" step="any" name="build_date" id="build_date" class="input" aria-label="input"
                            value="{{ isset(request()->build_date) ? request()->build_date : '' }}" />
                </div>
                <div class="space-y-2">
                    <label for="structure_type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="structure_type" id="structure_type" class="input my-2">
                        <option value="concrete"  {{ isset(request()->structure_type) && request()->structure_type === 'concrete' ? 'selected' : '' }}>{{$lang[3]}}</option>
                        <option value="cement-bricks" {{ isset(request()->structure_type) && request()->structure_type === 'cement-bricks' ? 'selected' : '' }}>{{$lang[4]}}</option>
                        <option value="wooden" {{ isset(request()->structure_type) && request()->structure_type === 'wooden' ? 'selected' : '' }}>{{$lang[5]}}</option>
                        <option value="stone" {{ isset(request()->structure_type) && request()->structure_type === 'stone' ? 'selected' : '' }}>{{$lang[6]}}</option>
                    </select>
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
                <div class="w-full p-3 rounded-lg mt-3">
                    @php
                        $structure_type = request()->structure_type;
                    @endphp
                    <div class="my-1 text-center">
                        <p class="text-[22px]">{{ $lang[7] }}</p>
                        <div class="flex justify-center text-lg my-2">
                            <div class="pr-4">
                                <p><strong class="text-[#119154] text-[26px]">{{ $detail['years'] }}</strong></p>
                                <p class="text-[18px]">{{ $lang[8] }}</p>
                            </div>
                            <div class="pr-4">
                                <p><strong class="text-[#119154] text-[26px]">{{ $detail['months'] }}</strong></p>
                                <p class="text-[18px]">{{ $lang[9] }}</p>
                            </div>
                            <div>
                                <p><strong class="text-[#119154] text-[26px]">{{ $detail['days'] }}</strong></p>
                                <p class="text-[18px]">{{ $lang[10] }}</p>
                            </div>
                        </div>
                        <p class="mt-2 ">{{ $lang[11] }} 
                            @if($structure_type == 'concrete')
                                {{ $lang[12] }} <strong>{{ $detail['predicted_age'] }}</strong> {{ $lang[16] }}
                            @elseif($structure_type == 'cement-bricks')
                                {{ $lang[13] }} <strong>{{ $detail['predicted_age'] }}</strong> {{ $lang[16] }}
                            @elseif($structure_type == 'wooden')
                                {{ $lang[14] }} <strong>{{ $detail['predicted_age'] }}</strong> {{ $lang[16] }}
                            @elseif($structure_type == 'stone')  
                                {{ $lang[15] }} <strong>{{ $detail['predicted_age'] }}</strong> {{ $lang[16] }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
