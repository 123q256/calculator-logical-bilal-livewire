<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="date" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="date" name="date" id="date" class="input" aria-label="input"  value="{{ isset($_POST['date'])?$_POST['date']: date('Y-m-d')}}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="period" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <select name="period" id="period" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Days", "Weeks", "Years"];
                            $val = ["Days", "Weeks", "Years"];
                            optionsList($val,$name,isset($_POST['period'])?$_POST['period']:'Days');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="Number" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <input type="number" step="any" name="Number" id="Number" class="input" aria-label="input"  value="{{ isset($_POST['Number'])?$_POST['Number']:'40' }}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="before_after" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <select name="before_after" id="before_after" class="input">
                        @php
                            $name = ["After", "Before"  ];
                            $val = ["After", "Before"  ];
                            optionsList($val,$name,isset($_POST['before_after'])?$_POST['before_after']:'After');
                        @endphp
                    </select>
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
            <div class="flex justify-between items-center pb-2 border-b-2 border-b-black">
                <p class="text-blue text-2xl font-semibold">{{ $lang['res'] }}</p>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            </div>
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue rounded-lg p-4 mt-6">
                    <div class="text-center">
                        <p class="text-lg font-bold">{{ $lang['5'] }}</p>
                        <p class="text-4xl bg-[#2845F5] text-white px-4 py-2 rounded-lg inline-block my-4">
                            <strong>{{ $detail['answer'] }}</strong>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    @endisset
</form>