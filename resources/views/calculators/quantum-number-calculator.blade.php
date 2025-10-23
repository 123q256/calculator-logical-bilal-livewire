<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-4">

            <div class="col-span-12 div_center">
                <label for="type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="type" id="type">
                        <option value="principal" {{ isset($_POST['type']) && $_POST['type']=='principal'?'selected':''}}>{{$lang[2]}} </option>
                        <option value="angular" {{ isset($_POST['type']) && $_POST['type']=='angular'?'selected':''}}>{{$lang[3]}} </option>              
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="x" class="font-s-14 text-blue">
                    <span class="n text-blue">{{ $lang['4'] }}:</span>
                    <span class="l d-none text-blue">{{ $lang['5'] }}:</span> 
                </label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="value" id="value" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['value'])?$_POST['value']:'1' }}" min="1" max="7" />
                    <span class="text-blue input-unit" id='errormsg'></span>
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
            
                        @if(isset($detail['type']))
                            @if($detail['type'] == 'principal')
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <p class="mt-2">{{ $lang['6'] }}</p>
                                    <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[7] }} (n)</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['value'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[8] }} (l)</strong></td>
                                        <td class="py-2 border-b"> {!! implode(',',str_split($detail['angular_momentum'])) !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[9] }} (m<sub>s</sub>) </strong></td>
                                        <td class="py-2 border-b"> -1/2, +1/2</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[10] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $detail['value']*$detail['value'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang[11] }} </strong></td>
                                        <td class="py-2 border-b"> {{ 2*$detail['value']*$detail['value'] }}</td>
                                    </tr>
                                    </table>
                                </div>
                                <p class="mt-4">{{ $lang['12'] }}</p>
                                <div class="col-12 col-lg-12 mt-2">
                                     {!! $detail['table'] !!}
                                </div>
                            @endif
                            @if($detail['type'] == 'angular')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <p class="mt-4">{{ $lang['12'] }}</p>
                                <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['13'] }} (m<sub>l</sub>)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['magnetic'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['14'] }} (m<sub>s</sub>)</strong></td>
                                    <td class="py-2 border-b"> -1/2, +1/2</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['10'] }}  </strong></td>
                                    <td class="py-2 border-b"> {{$detail['num_orbital']}}</td>
                                </tr>
                                </table>
                            </div>
                           @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
<script>
@if(isset($error))
    var demovalue = "{{$_POST['type']}}";
        var nElements = document.querySelectorAll('.n');
        var lElements = document.querySelectorAll('.l');
        if (demovalue == 'principal') {
            nElements.forEach(el => el.classList.remove('d-none'));
            lElements.forEach(el => el.classList.add('d-none'));
        } else if (demovalue == 'angular') {
            nElements.forEach(el => el.classList.add('d-none'));
            lElements.forEach(el => el.classList.remove('d-none'));
        }
@endif
@if(isset($detail))
    var demovalue = "{{$_POST['type']}}";
        var nElements = document.querySelectorAll('.n');
        var lElements = document.querySelectorAll('.l');
        if (demovalue == 'principal') {
            nElements.forEach(el => el.classList.remove('d-none'));
            lElements.forEach(el => el.classList.add('d-none'));
        } else if (demovalue == 'angular') {
            nElements.forEach(el => el.classList.add('d-none'));
            lElements.forEach(el => el.classList.remove('d-none'));
        }
@endif
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    document.getElementById('type').addEventListener('change', function() {
        var demovalue = this.value;
        var nElements = document.querySelectorAll('.n');
        var lElements = document.querySelectorAll('.l');
        
        if (demovalue == 'principal') {
            nElements.forEach(el => el.classList.remove('d-none'));
            lElements.forEach(el => el.classList.add('d-none'));
        } else if (demovalue == 'angular') {
            nElements.forEach(el => el.classList.add('d-none'));
            lElements.forEach(el => el.classList.remove('d-none'));
        }
    });
});
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>