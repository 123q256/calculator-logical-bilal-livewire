
<style>
img{
    object-fit: contain;
}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="per" class="font-s-14 text-blue">{{ $lang['a'] }}</label>
                    <select name="per" id="per" class="input mt-2">
                        <option value="11@70" {{ isset($_POST['per']) && $_POST['per']=='211@70'?'selected':''}}>70%</option>
                        <option value="1.5@75" {{ isset($_POST['per']) && $_POST['per']=='1.5@75'?'selected':''}}>75%</option>
                        <option value="1.28@80" {{ isset($_POST['per']) && $_POST['per']=='1.28@80'?'selected':''}}>80%</option>
                        <option value="1.44@85" {{ isset($_POST['per']) && $_POST['per']=='1.44@85'?'selected':''}}>85%</option>
                        <option value="1.645@90" {{ isset($_POST['per']) && $_POST['per']=='1.645@90'?'selected':''}}>90%</option>
                        <option value="1.7@91" {{ isset($_POST['per']) && $_POST['per']=='1.7@91'?'selected':''}}>91%</option>
                        <option value="1.75@92" {{ isset($_POST['per']) && $_POST['per']=='1.75@92'?'selected':''}}>92%</option>
                        <option value="1.81@93" {{ isset($_POST['per']) && $_POST['per']=='1.81@93'?'selected':''}}>93%</option>
                        <option value="1.88@94" {{ isset($_POST['per']) && $_POST['per']=='1.88@94'?'selected':''}}>94%</option>
                        <option value="1.96@95"  {{ isset($_POST['per']) && $_POST['per']=='1.96@95'?'selected':''}}>95%</option>
                        <option value="22@96" {{ isset($_POST['per']) && $_POST['per']=='22@96'?'selected':''}}>96%</option>
                        <option value="2.17@97" {{ isset($_POST['per']) && $_POST['per']=='2.17@97'?'selected':''}}>97%</option>
                        <option value="2.33@98" {{ isset($_POST['per']) && $_POST['per']=='2.33@98'?'selected':''}}>98%</option>
                        <option value="2.576@99" {{ isset($_POST['per']) && $_POST['per']=='2.576@99'?'selected':''}}>99%</option>
                        <option value="2.807@99.5" {{ isset($_POST['per']) && $_POST['per']=='2.807@99.5'?'selected':''}}>99.5%</option>
                        <option value="3.29@99.9" {{ isset($_POST['per']) && $_POST['per']=='3.29@99.9'?'selected':''}}>99.9%</option>
                        <option value="3.89@99.99" {{ isset($_POST['per']) && $_POST['per']=='3.89@99.99'?'selected':''}}>99.99%</option>
                        </select>
                </div>
                <div class="col-span-6">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['p'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="x" id="x" min="1" max="99" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['x'])?$_POST['x']:'50' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['n'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="30" value="{{ isset($_POST['y'])?$_POST['y']:'30' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['pp'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="z" id="z" class="input" aria-label="input" placeholder="20" value="{{ isset($_POST['z'])?$_POST['z']:'60' }}" />
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
                        <table class="w-100 text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['ans'] }}</strong></td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['ans']))
                                     {{$detail['ans']}}
                                    @else
                                   <span>  0.0 </span>
                                    @endif
                                 </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full  text-[16px]">
                            <p class="mt-4"><strong> Solution:</strong></p>
                            @php
                                 $z=explode('@', $_POST['per']);
                                $p=round($_POST['x']/100,2);
                            @endphp
            
                            @if(empty($_POST['z']))
                                                
                            <p class="mt-2">MOE=  z x  
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">p x (1 - p)</span>
                                    <span class="quadratic_square-root">n</span>
                                </span>
                            </p>
                            <p class="mt-2">Where: z = {{$z[0]}} for a confidence level (α) of {{$z[1]}}% ,p = {{$p}} and n = {{ $_POST['y'] }}</p>
                            <p class="mt-2">MOE= {{$z[0]}} x
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">{{$p}} (1-{{$p}}) </span>
                                    <span class="quadratic_square-root"> {{ $_POST['y'] }}</span>
                                </span>
                            </p>
                            <p class="mt-2">MOE= {{$z[0]}} x
                                <span class="quadratic_math-eq-token">
                                    <span class="quadratic_square-root">{{$p*(1-$p)}}</span>
                                    <span class="quadratic_square-root"> {{ $_POST['y'] }}</span>
                                </span>
                            </p>
                            <p class="mt-2">MOE= {{$z[0]}} x
                                <span class="quadratic_math-eq-token">
                                    <span >{{sqrt($p*(1-$p))}}</span>
                                    <span > {{ round(sqrt($_POST['y']),2) }}</span>
                                </span>
                            </p>
                            <p class="mt-2">MOE  {{ $detail['ans'] }}</p>
                                @else
                                <p class="mt-2">MOE=  z x  
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">p x (1 - p)</span>
                                        <span class="quadratic_square-root">((N - 1) * n / (N - n))</span>
                                    </span>
                                </p>
                                <p class="mt-2">Where: z = {{$z[0]}} for a confidence level (α) of {{$z[1]}}% ,p = {{$p}}, N = {{$_POST['z']}} and n = {{$_POST['y']}}</p>
                                <p class="mt-2">MOE= {{$z[0]}} x
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">{{$p}}  (1-{{$p}})</span>
                                        <span class="quadratic_square-root"> ({{$_POST['z']}} - 1) * {{$_POST['y']}} / ({{$_POST['z']}} - {{$_POST['y']}})</span>
                                    </span>
                                 </p>
                                 <p class="mt-2">MOE= {{$z[0]}} x
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">{{$p}}  ({{1-$p}})</span>
                                        <span class="quadratic_square-root"> {{$_POST['z']-1}} * {{$_POST['y']}} / ({{$_POST['z'] - $_POST['y']}})</span>
                                    </span>
                                 </p>
                                 <p class="mt-2">MOE= {{$z[0]}} x
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{$p*(1-$p)}})</span>
                                        @if ($_POST['z'] === $_POST['y'] )
                                        <span class="quadratic_square-root">0</span>   
                                        @else
                                        <span class="quadratic_square-root">{{round(sqrt($_POST['z']-1),2)}} * ({{round($_POST['y']/($_POST['z'] - $_POST['y']),2)}}) </span>
                                        @endif
                                    </span>
                                 </p>
                                <p class="mt-2">MOE= {{$z[0]}} x
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{$p*(1-$p)}})</span>
                                        @if ($_POST['z'] === $_POST['y'] )
                                        <span class="quadratic_square-root">0</span>   
                                        @else
                                        <span class="quadratic_square-root">{{round(sqrt($_POST['z']-1),2)}} * ({{round($_POST['y']/($_POST['z'] - $_POST['y']),2)}}) </span>
                                        @endif
                                    </span>
                                 </p>
                                 <p class="mt-2">MOE= {{$z[0]}} x
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{round(sqrt($p*(1-$p)),2)}})</span>
                                        @if ($_POST['z'] === $_POST['y'] )
                                           <span class="quadratic_square-root">0</span>   
                                        @else
                                           <span class="quadratic_square-root">{{round(sqrt($_POST['z']-1),2) * round($_POST['y']/($_POST['z'] - $_POST['y']),2)}}</span>
                                        @endif
                                    </span>
                                 </p>
                                 <p class="mt-2">MOE= {{$z[0]}} x
                                    <span class="quadratic_math-eq-token">
                                        <span class="quadratic_square-root">({{round(sqrt($p*(1-$p)),2)}})</span>
                                        @if ($_POST['z'] === $_POST['y'] )
                                        <span class="">0</span>
                                        @else
                                        <span class="">{{sqrt(round(sqrt($_POST['z']-1),2) * round($_POST['y']/($_POST['z'] - $_POST['y']),2))}} </span>
                                        @endif
                                    </span>
                                 </p>
                                <p class="mt-2">MOE {{$detail['ans']}}
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>