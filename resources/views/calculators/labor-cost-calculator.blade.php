<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
            <div class="col-span-12">
                <label for="h_p_w" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="h_p_w" id="h_p_w" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['x'])?$_POST['x']:'40' }}" min="0" />
                    <span class="text-blue input_unit">{{ $lang['2']}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="p_r" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="p_r" id="p_r" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['p_r'])?$_POST['p_r']:'10' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}/{{ $lang['2']}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="a_d_p_y" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="a_d_p_y" id="a_d_p_y" class="input" aria-label="input" placeholder="15" value="{{ isset($_POST['a_d_p_y'])?$_POST['a_d_p_y']:'15' }}" min="0" />
                    <span class="text-blue input_unit">{{ $lang['5']}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <p><strong><?= $lang['23']?></strong></p>
            </div>
            <div class="col-span-6">
                <label for="tax" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="tax" id="tax" class="input" aria-label="input" placeholder="900" value="{{ isset($_POST['tax'])?$_POST['tax']:'900' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div> 
             <div class="col-span-6">
                <label for="insurance" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="insurance" id="insurance" class="input" aria-label="input" placeholder="600" value="{{ isset($_POST['insurance'])?$_POST['insurance']:'600' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="benefits" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="benefits" id="benefits" class="input" aria-label="input" placeholder="1200" value="{{ isset($_POST['benefits'])?$_POST['benefits']:'1200' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="overtime" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="overtime" id="overtime" class="input" aria-label="input" placeholder="800" value="{{ isset($_POST['overtime'])?$_POST['overtime']:'800' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="supplies" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="supplies" id="supplies" class="input" aria-label="input" placeholder="400" value="{{ isset($_POST['supplies'])?$_POST['supplies']:'400' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="total_revenue" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="total_revenue" id="total_revenue" class="input" aria-label="input" placeholder="80000" value="{{ isset($_POST['total_revenue'])?$_POST['total_revenue']:'80000' }}" min="0" />
                    <span class="text-blue input_unit">{{ $currancy }}</span>
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
                        @if(isset($detail))
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['12'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy}} {{ round($detail['annual_p_labor_cost'],2) }}</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['13'] }} </strong></td>
                                    <td class="py-2 border-b">{{$currancy}} {{ round($detail['h_l_cost'],3) }}</td>
                                </tr>
                            </table>
                        </div>
                        @endif
                
                        <div class="col-12  text-[16px]">
                                    @if(isset($detail))
                                    <div class="col ">
                                        <p class="mt-3"><strong>{{ $lang['15']}}</strong></p>
                                        <p class="mt-2"><strong>{{$lang['16']}} {{$lang['17']}}.</strong> </p>
                                        <p class="mt-2">  {{$lang['18']}} {{$lang['2']}} {{$lang['19']}}  = {{$lang['1']}} x 52</p>
                                        <p class="mt-2">  {{$lang['18']}} {{$lang['2']}} {{$lang['19']}}  = {{$detail['h_p_w']}} x 52</p>
                                        <p class="mt-2">  {{$lang['18']}} {{$lang['2']}} {{$lang['19']}}  = {{$detail['g_h_per_year']}}  {{$lang['2']}}</p>
                                        <p class="mt-2">  {{$lang['17']}}  =  {{$lang['18']}} {{$lang['2']}} {{$lang['19']}} x {{$lang['3']}} </p>
                                        <p class="mt-2">  {{$lang['17']}}  = {{$detail['g_h_per_year']}} x {{ $detail['p_r']}}</p>
                                        <p class="mt-2"> {{$lang['17']}}  =  {{$detail['gross_pay']}} {{ $currancy}}</p>
                                        <p class="mt-2 "><strong> {{$lang['16']}} {{$lang['22']}} {{$lang['2']}} {{$lang['20']}}.</strong></p>
                                        <p class="mt-2"> {{$lang['2']}} {{$lang['21']}} {{$lang['20']}} {{$lang['19']}} = {{$lang['4']}} x 8</p>
                                        <p class="mt-2"> {{$lang['2']}} {{$lang['21']}} {{$lang['20']}} {{$lang['19']}} = {{$detail['a_d_p_y']}} x 8</p>
                                        <p class="mt-2"> {{$lang['2']}} {{$lang['21']}} {{$lang['20']}} {{$lang['19']}} = {{ $detail['n_w_p_year'] }} {{$lang['2']}} </p>
                                        <p class="mt-2"> {{$lang['22']}} {{$lang['2']}} {{$lang['20']}}  =  Gross {{$lang['2']}} {{$lang['19']}}  - {{$lang['2']}} {{$lang['21']}} {{$lang['20']}} {{ $lang['19']}}</p>
                                        <p class="mt-2"> {{$lang['22']}}  {{$lang['2']}} {{$lang['20']}}  = {{$detail['g_h_per_year']}} - {{ $detail['n_w_p_year'] }}</p>
                                        <p class="mt-2"> {{$lang['22']}} {{$lang['2']}} {{$lang['20']}}  = {{$detail['net_h_work']}} {{$lang['2']}} </p>
                                        <p class="mt-2"> <strong>{{$lang['16']}} {{$lang['23']}}.</strong> </p>
                                        <p class="mt-2"> {{$lang['24']}}  = {{$lang['6']}} + {{$lang['7']}} + {{$lang['8']}} + {{$lang['9']}} + {{ $lang['10']}}</p>
                                        <p class="mt-2"> {{$lang['24']}}  = {{$detail['tax']}} + {{$detail['insurance']}} + {{$detail['benefits']}} + {{$detail['overtime']}} + {{$detail['supplies'] }}</p>
                                        <p class="mt-2"> { {{$lang['24']}} } = {{$detail['annual_cost']}} \ {{ $currancy}}</p>
                                        <p class="mt-2"><strong> {{$lang['16']}} {{$lang['25']}}.</strong> </p>
                                        <p class="mt-2"> {{ $lang['12']}}  =  {{$lang['17']}} +  {{$lang['24']}} </p>
                                        <p class="mt-2"> {{ $lang['12']}}  = {{$detail['gross_pay']}} + {{ $detail['annual_cost'] }}</p>
                                        <p class="mt-2">  {{$lang['12']}} = {{round($detail['annual_p_labor_cost'],2)}} {{ $currancy}}</p>
                                        <p class="mt-2">
                                            {{ $lang['13']}} = 
                                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                                    <span class="num">{{ $lang['12'] }}</span>
                                                    <span class="visually-hidden"> / </span>
                                                    <span class="den">  Net {{$lang['2']}} {{ $lang['20']}}</span>
                                                </span> 
                                        </p>
                                        <p class="mt-2">
                                            {{ $lang['13']}} = 
                                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                                    <span class="num">{{ round($detail['annual_p_labor_cost'],2) }}</span>
                                                    <span class="visually-hidden"> / </span>
                                                    <span class="den">{{$detail['net_h_work']}}</span>
                                                </span> 
                                        </p>
                                        <p class="mt-2">
                                            {{ $lang['13']}} = 
                                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                                    <span class="num">{{ round($detail['h_l_cost'],3) }}</span>
                                                    <span class="visually-hidden"> / </span>
                                                    <span class="den">{{$detail['total_revenue']}}</span>
                                                </span> x 100
                                        </p>
                                        <p class="mt-2"> {{$lang['13']}} = {{round($detail['h_l_cost'],3)}} {{$currancy}}  </p>
                                        <p class="mt-2"> <strong> {{$lang['16']}} {{$lang['26']}}.</strong> </p>
                                        <p class="mt-2">
                                            {{ $lang['26']}} = 
                                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                                    <span class="num">{{$lang['12']}}</span>
                                                    <span class="visually-hidden"> / </span>
                                                    <span class="den">{{ $lang['11'] }}</span>
                                                </span> x 100
                                            </p>
                                        <p class="mt-2">
                                        {{ $lang['26']}} = 
                                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                                <span class="num">{{ round($detail['annual_p_labor_cost'],2) }}</span>
                                                <span class="visually-hidden"> / </span>
                                                <span class="den">{{$detail['total_revenue']}}</span>
                                            </span> x 100
                                        </p>
                                        <p class="mt-2"> {{ $lang['26']}}  = {{$detail['l_c_percentge']}} x 100</p>
                                        <p class="mt-2"> {{$lang['26']}} = {{round($detail['l_c_percentge'] * 100 ,1)}} %</p>
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>