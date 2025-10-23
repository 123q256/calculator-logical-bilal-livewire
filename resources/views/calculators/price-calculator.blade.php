<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">   
            <div class="col-span-12">
                <label for="price" class="font-s-14 text-blue">{{ $lang['1'] }} (C)</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="price" id="price" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['price'])?$_POST['price']:'500' }}" />
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="gross" class="font-s-14 text-blue">{{ $lang['2'] }} (G)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="gross" min="0" max="100" id="gross" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['gross'])?$_POST['gross']:'70' }}" />
                    <span class="text-blue input_unit">%</span>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} (R) </strong></td>
                                <td class="py-2 border-b"> {{ $currancy.$detail['revenue'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }} (P)</strong></td>
                                <td class="py-2 border-b"> {{ $currancy.$detail['gross_profit'] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }} (M)</strong></td>
                                <td class="py-2 border-b"> {{  $detail['mark_up'] }}%</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px] mt-2">
                        <p class="mt-2"><strong>{{$lang[7]}}</strong></p>
                        <p class="mt-2"> {{ $lang[3] }} = {{ $lang[1] }} / 1 - {{ $lang[2] }} </p>
                        <p class="mt-2"> {{ $lang[3] }} = {{ isset($_POST['price'])?$_POST['price']:'' }} / 1 - {{ isset($_POST['gross'])?$_POST['gross']:'' }}/100 </p>
                        <p class="mt-2"> {{ $lang[3] }} = {{{$detail['revenue']}}}</p>
                        <p class="mt-2"> {{ $lang[4] }} = {{ $lang[3] }} × {{ $lang[2] }} </p>
                        <p class="mt-2"> {{ $lang[4] }} = {{$detail['revenue']}} × {{ isset($_POST['gross'])?$_POST['gross']/100:'' }} </p>
                        <p class="mt-2"> {{ $lang[4] }} = {{$detail['gross_profit']}}  </p>
                        <p class="mt-2"> {{ $lang[5] }} = {{ $lang[4] }} / {{ $lang[1] }}  × 100</p>
                        <p class="mt-2"> {{ $lang[5] }} = {{$detail['gross_profit']}} / {{ isset($_POST['price'])?$_POST['price']:'' }}  × 100 </p>
                        <p class="mt-2"> {{ $lang[5] }} = {{$detail['mark_up']}} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>