<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
                    <div class="grid grid-cols-1   gap-4">
                        
                        <div class="space-y-2">
                            <span class="font-s-14 pe-2 pe-lg-3"><strong>{{ $lang['1'] }}: </strong></span>
                            <input type="radio" name="form" id="raw" value="raw" checked {{ isset(request()->form) && request()->form === 'raw' ? 'checked' : '' }}>
                            <label for="raw" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['2'] }}:</label>
                            <input type="radio" name="form" id="summary" value="summary" {{ isset(request()->form) && request()->form === 'summary' ? 'checked' : '' }}>
                            <label for="summary" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        </div>

                        <div class="space-y-2 relative">
                            <label for="x" class="font-s-14 text-blue" id="text">{!! $lang['4'] !!}:</label>
                                <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->x)?request()->x:'13' }}" />
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
                        <p><strong class="text-[18px]">{!! $lang[5] !!}</strong></p>
                        <p><strong class="text-[#119154] md:text-[25px] lg:text-[25px]">{!! $detail['ans'] !!}<span class="text-[#119154] mf:text-[15] lg:text-[15]"> {!! ((request()->form=='raw')?$lang[6]:$lang[4]) !!}</span></strong></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if(document.getElementById('summary').checked){
                    document.getElementById('text').textContent = '{!! $lang[6] !!}:'
                }else{
                    document.getElementById('text').textContent = '{!! $lang[4] !!}:'
                }
                document.getElementById('summary').addEventListener('click', function(){
                    document.getElementById('text').textContent = '{!! $lang[6] !!}:'
                })
                document.getElementById('raw').addEventListener('click', function(){
                    document.getElementById('text').textContent = '{!! $lang[4] !!}:'
                })
            });
        </script>
    @endpush
</form>