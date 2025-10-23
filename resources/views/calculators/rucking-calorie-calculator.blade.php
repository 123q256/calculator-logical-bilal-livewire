<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 px-2">
                    <div class="grid grid-cols-12   gap-1">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn1" value="0.95" checked {{ isset(request()->activities) && request()->activities === 'btn1' ? 'checked' : '' }}>
                            <label for="btn1" class="text-[12px]">{{ $lang['2'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn2" value="3.0" {{ isset(request()->activities) && request()->activities === 'btn2' ? 'checked' : '' }}>
                            <label for="btn2" class="text-[12px]">{{ $lang['3'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn3" value="7.8" {{ isset(request()->activities) && request()->activities === 'btn3' ? 'checked' : '' }}>
                            <label for="btn3" class="text-[12px]">{{ $lang['4'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn4" value="8.5" {{ isset(request()->activities) && request()->activities === 'btn4' ? 'checked' : '' }}>
                            <label for="btn4" class="text-[12px]">{{ $lang['5'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn5" value="8.2" {{ isset(request()->activities) && request()->activities === 'btn5' ? 'checked' : '' }}>
                            <label for="btn5" class="text-[12px]">{{ $lang['6'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn6" value="9.0" {{ isset(request()->activities) && request()->activities === 'btn6' ? 'checked' : '' }}>
                            <label for="btn6" class="text-[12px]">{{ $lang['7'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn7" value="10.0" {{ isset(request()->activities) && request()->activities === 'btn7' ? 'checked' : '' }}>
                            <label for="btn7" class="text-[12px]">{{ $lang['8'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn8" value="10.7" {{ isset(request()->activities) && request()->activities === 'btn8' ? 'checked' : '' }}>
                            <label for="btn8" class="text-[12px]">{{ $lang['9'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn9" value="8.0" {{ isset(request()->activities) && request()->activities === 'btn9' ? 'checked' : '' }}>
                            <label for="btn9" class="text-[12px]">{{ $lang['10'] }}:</label>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <input type="radio" name="activities" id="btn10" value="4.5" {{ isset(request()->activities) && request()->activities === 'btn10' ? 'checked' : '' }}>
                            <label for="btn10" class="text-[12px]">{{ $lang['11'] }}:</label>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="text-[12px]">{!! $lang['12'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="weight" id="weight" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->weight)?request()->weight:'80' }}" />
                        <span class="text-blue input_unit">lbs</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="time" class="text-[12px]">{!! $lang['13'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="time" id="time" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->time)?request()->time:'2' }}" />
                        <span class="text-blue input_unit">hours</span>
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
                    <div class="w-full text-center">
                        <p>{{ $lang[14] }}</p>
                        <p><strong class="text-green-700 text-[32px]">{{ $detail['calories'] }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>