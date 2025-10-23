<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="date" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <input type="date" name="date" id="date" class="input" aria-label="input"  value="{{ isset($_POST['date'])?$_POST['date']: date('Y-m-d')}}" />
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="rent" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="rent" id="rent" class="input" aria-label="input"  value="{{ isset($_POST['rent'])?$_POST['rent']:'640' }}" />
                        <span class="input_unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="bill_on" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2"> 
                        <select name="bill_on" id="bill_on" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
                                $val = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'
                                ,'25','26','27','28','29','30','31'];
                                optionsList($val,$name,isset($_POST['bill_on'])?$_POST['bill_on']: '1');
                            @endphp
                        </select>
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
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full py-2">
                        <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto lg:text-[20px] md:text-[20px] text-[16px]">
                            @if($detail['res']==1)
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{$lang[4]}} :</strong></td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['pror'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[9]}} :</strong></td>
                                        <td class="border-b py-2">{{date('M ,d,Y',strtotime($detail['date'])) }} - {{ date('M ,d,Y',strtotime($detail['end_date']))}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2 pt-3">
                                            {{date('F',strtotime($detail['date']))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">
                                            {{$detail['d']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['6']}} :</td>
                                        <td class="border-b py-2">
                                            {{$detail['days_in_mon']}} </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[7]}} / {{$lang[8]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['per_day'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[4]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['pror'],2)}}</td>
                                    </tr>
                                </table>
                            @endif
                            @if($detail['res']==2)
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{$lang[4]}} :</strong></td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['pror']+$detail['pror1'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang[9]}} :</strong></td>
                                        <td class="border-b py-2">{{date('M ,d,Y',strtotime($detail['date'])) }} - {{ date('M ,d,Y',strtotime($detail['end_date']))}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pb-2 pt-3">
                                            {{date('F',strtotime($detail['date']))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">
                                            {{$detail['d']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['6']}} :</td>
                                        <td class="border-b py-2">
                                            {{$detail['days_in_mon']}} </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[7]}} / {{$lang[8]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['per_day'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[4]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['pror'],2)}}</td>
                                    </tr>
            
                                    <tr>
                                        <td class="pb-2 pt-3">
                                            {{date('F',strtotime($detail['end_date']))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['5']}} :</td>
                                        <td class="border-b py-2">
                                            {{$detail['d1']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['6']}} :</td>
                                        <td class="border-b py-2">
                                            {{$detail['days_in_mon1']}} </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[7]}} / {{$lang[8]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['per_day1'],2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang[4]}} :</td>
                                        <td class="border-b py-2">{{$currancy.' '.round($detail['pror1'],2)}}</td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>