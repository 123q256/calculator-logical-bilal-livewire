<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <p><strong> {{ $lang['1'] }}</strong></p>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['first'])?$_POST['first']:'35' }}" />
                        <span class="text-blue input-unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 ">
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="15" value="{{ isset($_POST['second'])?$_POST['second']:'15' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <p><strong>At time point 2</strong></p>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="third" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="45" value="{{ isset($_POST['third'])?$_POST['third']:'45' }}" />
                        <span class="text-blue input-unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="four" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 ">
                        <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['four'])?$_POST['four']:'25' }}" />
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
                    <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{$lang[4]}} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['elasticity']}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{$lang[5]}} </strong></td>
                                <td class="py-2 border-b"> 
                                    @if ($detail['elasticity'] >= 0)
                                    {{ $lang[6] }}
                                    @else
                                        {{ $lang[7] }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>