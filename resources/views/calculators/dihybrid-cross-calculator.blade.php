<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <span class="text-blue font-s-14 border-end pe-2 pe-md-3">A, B - {{ $lang[1] }}</span>
                    <span class="text-blue font-s-14 ps-2 ps-md-3">a, b - {{ $lang[2] }}</span>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mtype1" class="font-s-14 text-blue">{!! $lang['3'] !!} 1:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="mtype1" id="mtype1" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["AA","Aa","aa"];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset($_POST['mtype1'])?$_POST['mtype1']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mtype2" class="font-s-14 text-blue">{!! $lang['3'] !!} 2:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="mtype2" id="mtype2" class="input">
                            @php
                                $name = ["BB","Bb","bb"];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset($_POST['mtype2'])?$_POST['mtype2']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ftype1" class="font-s-14 text-blue">{!! $lang['4'] !!} 1:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="ftype1" id="ftype1" class="input">
                            @php
                                $name = ["AA","Aa","aa"];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset($_POST['ftype1'])?$_POST['ftype1']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ftype2" class="font-s-14 text-blue">{!! $lang['4'] !!} 2:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="ftype2" id="ftype2" class="input">
                            @php
                                $name = ["BB","Bb","bb"];
                                $val = ["0","1","2"];
                                optionsList($val,$name,isset($_POST['ftype2'])?$_POST['ftype2']:'1');
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
    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2">AABB</td>
                                        <td class="border-b"><strong>{{ $detail['finalRes']*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AABb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][1]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AAbb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][2]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AaBB</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][3]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AaBb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][4]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Aabb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][5]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">aaBB</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][6]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">aaBb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][7]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">aabb</td>
                                        <td><strong>{{ $detail['tablResults'][8]*100 }}%</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="mt-2"><strong class="text-blue font-s-18"><?=$lang[5]?></strong></p>
                            <div class="w-full overflow-auto">
                                {!! $detail['table'] !!}
                            </div>
                            <p class="mt-2"><strong class="text-blue font-s-18"><?=$lang[6]?></strong></p>
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0"><tr><td class="border-b py-2"><b><?=$lang['res']?></b></td><td class="border-b"><b><?=$lang[7]?></b></td><td class="border-b"><b><?=$lang[8]?></b></td></tr><tr><td class="border-b py-2">AABB</td><td class="border-b">AABB</td><td class="border-b">AB</td></tr><tr><td class="border-b py-2">AABb</td><td class="border-b">AABb</td><td class="border-b">AB</td></tr><tr><td class="border-b py-2">AaBB</td><td class="border-b">AaBB</td><td class="border-b">AB</td></tr><tr><td class="border-b py-2">AaBb</td><td class="border-b">AaBb</td><td class="border-b">AB</td></tr><tr><td class="border-b py-2">AAbb</td><td class="border-b">AAbb</td><td class="border-b">Ab</td></tr><tr><td class="border-b py-2">Aabb</td><td class="border-b">Aabb</td><td class="border-b">Ab</td></tr><tr><td class="border-b py-2">aaBB</td><td class="border-b">aaBB</td><td class="border-b">aB</td></tr><tr><td class="border-b py-2">aaBb</td><td class="border-b">aaBb</td><td class="border-b">aB</td></tr><tr><td class="py-2">aabb</td><td>aabb</td><td>ab</td></tr></table>
                            </div>
                        </div>
                        <div class="w-full text-center mt-[30px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>