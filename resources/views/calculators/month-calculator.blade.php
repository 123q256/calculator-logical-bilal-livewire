@php
    if(isset($_POST['submit'])){
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);
}elseif(isset($_GET['res_link'])){
    $start_date = trim($_GET['start_date']);
    $end_date = trim($_GET['end_date']);
}
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="start_date" class="label">{{ $lang['1'] }}:</label>
                    <input type="date" name="start_date" id="start_date" class="input" aria-label="input"  value="{{ isset($_POST['start_date'])?$_POST['start_date']:date('Y-m-d') }}" />
                </div>
                <div class="space-y-2">
                    <label for="end_date" class="label">{{ $lang['2'] }}:</label>
                    <input type="date" name="end_date" id="end_date" class="input" aria-label="input" value="{{ isset($_POST['end_date'])?$_POST['end_date']: date('Y-m-d', strtotime('+ 170 days')) }}" />
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
                <div class="w-full bg-light-blue p-1 rounded-lg mt-6">
                    <div class="flex justify-center my-6">
                        <div class="text-center border bg-[#2845F5] text-white rounded-lg ">
                            <p class="text-2xl  px-6 py-1 inline-block my-6">
                                <strong class="text-blue">{{ $detail['months'] }}</strong>
                                <span class="text-xl">{{ $lang['4'] }}</span>
                                <strong class="text-blue">{{ $detail['days'] }}</strong>
                                <span class="text-xl">{{ $lang['5'] }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>