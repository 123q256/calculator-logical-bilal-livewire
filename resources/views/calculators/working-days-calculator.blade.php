<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="start_date" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="date" name="start_date" id="start_date" class="input" aria-label="input"  value="{{ isset($_POST['start_date'])?$_POST['start_date']: date('')}}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="end_date" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <input type="date" name="end_date" id="end_date" class="input" aria-label="input"  value="{{ isset($_POST['end_date'])?$_POST['end_date']: date('')}}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="working_days" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <select name="working_days" id="working_days" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Include all days of week", "Exclude weekends", "Exclude only sunday"];
                            optionsList($name,$name,isset($_POST['working_days'])?$_POST['working_days']:'Exclude only sunday');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="include_end_date" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <select name="include_end_date" id="include_end_date" class="input">
                        @php
                            $name = ["Yes", "No"];
                            optionsList($name,$name,isset($_POST['include_end_date'])?$_POST['include_end_date']:'Yes');
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
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  rounded-lg p-4 mt-6">
                    <div class="text-center">
                        <p class="text-xl font-bold">{{ $lang['5'] }}</p>
                        <p class="text-4xl bg-[#2845F5] text-white px-4 py-2 rounded-lg inline-block my-4">
                            <strong >{{ $detail['answer'] }}</strong>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    @endisset
</form>