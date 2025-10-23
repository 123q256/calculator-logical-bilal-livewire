<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="w-full my-2">
                <span class="font-s-14 pe-2 pe-lg-3"><strong>{{ $lang['1'] }}: </strong></span>
                <input type="radio" name="form" id="raw" value="raw" checked {{ isset(request()->form) && request()->form === 'raw' ? 'checked' : '' }}>
                <label for="raw" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['2'] }}:</label>
                <input type="radio" name="form" id="summary" value="summary" {{ isset(request()->form) && request()->form === 'summary' ? 'checked' : '' }}>
                <label for="summary" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
            </div>
            <div class="grid grid-cols-1 mt-5 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">{!! $lang['4'] !!} (g/mol):</label>
                        <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->x)?request()->x:'3' }}" />
                </div>
                <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue" id="text">{!! $lang['5'] !!}:</label>
                        <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->y)?request()->y:'2' }}" />
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
                            <p><strong class="md:text-[20px] lg:text-[20px]">{!! $lang[7] !!}</strong></p>
                            <p><strong class="text-[#119154] md:text-[25px] lg:text-[25px]">{!! $detail['ans'] !!}<span class="text-[#119154] md:text-[20px] lg:text-[20px]"> {!! ((request()->form=='raw')?$lang[8]:'') !!}</span></strong></p>
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
                    document.getElementById('text').textContent = '{!! $lang[5] !!}:'
                }
                document.getElementById('summary').addEventListener('click', function(){
                    document.getElementById('text').textContent = '{!! $lang[6] !!}:'
                })
                document.getElementById('raw').addEventListener('click', function(){
                    document.getElementById('text').textContent = '{!! $lang[5] !!}:'
                })
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>