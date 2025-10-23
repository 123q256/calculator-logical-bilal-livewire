<style>
    @media (max-width: 480px) {
        .calculator-box{
            padding-right: 0.25rem;
            padding-left: 0.25rem;
        }
    }
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .veloTabs:hover{
        background: #dcdcdc73;
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .velocitytab a{
       text-decoration: none;
        position: relative;
        top: 2px
    }
    input[type="date"],input[type="time"]{
        min-width: 85%;
        margin: 0px auto;
    }
    .gap-10{
        gap: 20px;
    }
</style>
   <form class="row position-relative" action="{{ url()->current() }}/" method="POST">
       @csrf
       <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif



        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 text-center  gap-4">
                <a href="{{ url('date-duration-calculator') }}/" class=" cursor-pointer py-2 text-[#2845F5] border-b-2 border-[#2845F5] " id="date_cal">
                    <strong>{{ $lang['1'] }}</strong>
                </a>
                <a href="{{ url('date-calculator') }}/" class=" cursor-pointer py-2" id="time_cal">
                    <strong>{{ $lang['2'] }}</strong>
                </a>
            </div>
            <div class="grid grid-cols-1  mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="s_date" class="font-s-14 text-blue">{{$lang['6']}}:</label>
                    <span class="font-s-14 text-end text-blue text-decoration-underline now cursor-pointer"> {{isset($lang['now']) ? $lang['now'] : 'Now'}}</span>
                    <input type="date" step="any" name="s_date" id="s_date" class="input" aria-label="input"
                    value="{{ isset(request()->s_date) ? request()->s_date : '' }}"/>
                </div>
                <div class="space-y-2 relative">
                    <label for="e_date" class="font-s-14 text-blue">{{$lang['8']}}:</label>
                        <span class="font-s-14 text-end text-blue text-decoration-underline now cursor-pointer"> {{isset($lang['now']) ? $lang['now'] : 'Now'}}</span>
                    <input type="date" step="any" name="e_date" id="e_date" class="input" aria-label="input"
                        value="{{ isset(request()->e_date) ? request()->e_date : '' }}"/>
                </div>
                <div class="space-y-2 relative">
                    <input type="checkbox" name="checkbox" id="checkbox" {{ isset(request()->checkbox) && request()->checkbox != 'checked'  ? 'checked' :'' }}/>
                    <label for="checkbox" class="font-s-14 text-blue">{{$lang['9']}}:</label>
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
                <div class="w-full bg-light-blue rounded-lg p-4 mt-6">
                    <div class="mb-4">
                        <div class="text-base grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2 w-3/5"><strong>{{ $lang['10'] }}:</strong></td>
                                    <td class="border-b py-2">{{ $detail['from'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2 w-3/5"><strong>{{ $lang['11'] }}:</strong></td>
                                    <td class="border-b py-2">{{ $detail['to'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        {{ $detail['years'] }} {{ $lang[12] }}, {{ $detail['months'] }} {{ $lang[13] }}, {{ $detail['days'] }} {{ $lang[14] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        {{ number_format(floor($detail['days'] / 7)) }} {{ $lang[15] }}, {{ number_format(floor($detail['days'] % 7)) }} {{ $lang[14] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        {{ $detail['days'] }} {{ $lang[14] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        {{ $detail['days'] * 24 }} {{ $lang[16] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">
                                        {{ $detail['days'] * 24 * 60 }} {{ $lang[17] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2">
                                        {{ $detail['days'] * 24 * 60 * 60 }} {{ $lang[18] }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.querySelectorAll('.now').forEach(label => {
                label.addEventListener('click', function() {
                    const now = new Date();
                    
                    // Get the current year, month, and date
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so we add 1
                    const date = String(now.getDate()).padStart(2, '0');

                    // Format the date as yyyy-MM-dd
                    const formattedDate = `${year}-${month}-${date}`;
                    
                    // Find the closest div with the class 'col-6' and get the input[type="date"] inside it
                    const dateInput = label.closest('.col-6').querySelector('input[type="date"]');
                    if (dateInput) {
                        dateInput.value = formattedDate;
                    }
                });
            });
        </script>
    @endpush
</form>
