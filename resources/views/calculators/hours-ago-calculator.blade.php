<style>
    .bg-gray {
        background: #f8f6f6;
}
    .bg-orange{
        background: #f8f6f6;
        color: white;
    }
    .cl-orange{
        color: orange;
    }
    .mb_3{
        margin-bottom: -5px; 
    }
    
    @media (min-width: 720px) {
        .ms-6{
            margin-left: 6rem;
        }
    }
    .gap-5{
        gap: 5px;
    }
    .content table, .content th, .content td {
        border: 1px solid #9f9d9d;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }
    .content table tr:hover td {
        color: #fff !important;
        background-color: rgb(0, 0, 0) !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @php
        $request = request();
    @endphp




<div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1    gap-4">
                <div class="space-y-2 relative">
                    <input type="radio" name="time" id="stat" class="cursor-pointer" value="stat" checked {{ isset($_POST['time']) && $_POST['time'] === 'stat' ? 'checked' : '' }}>
                    <label for="stat" class="font-s-14 cursor-pointer text-blue pe-lg-3 pe-2">{{ $lang['1'] }}</label>
                    <input type="radio" class="cursor-pointer" name="time" id="dyna" value="dyna" {{ isset($_POST['time']) && $_POST['time'] === 'dyna' ? 'checked' : '' }}>
                    <label for="dyna" class="font-s-14 cursor-pointer text-blue">{{ $lang['2'] }}</label>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">

                <div class="space-y-2 relative">
                    <div class="flex gap-5 mt-3 items-center">
                        <div class="w-full {{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} inputshow">
                            <div class="w-full pt-1 pb-2">
                                <input type="number" name="hours" id="hours" class="input bg-gray" value="{{ isset($request->hours) ? $request->hours : '' }}" aria-label="input" />
                            </div>
                        </div>
                        <p class="mb-1">:</p>
                        <div class="w-full {{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} inputshow">
                            <div class="w-full pt-1 pb-2">
                                <input type="number" name="minutes" id="minuts" class="input bg-gray" value="{{ isset($request->minutes) ? $request->minutes : '' }}" aria-label="input" />
                            </div>
                        </div>
                        <p class="mb-1">:</p>
                        <div class="w-full {{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} inputshow">
                            <div class="w-full pt-1 pb-2">
                                <input type="number" name="seconds" id="sec" class="input bg-gray" value="{{ isset($request->seconds) ? $request->seconds : '' }}" aria-label="input" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-2 relative">
                    <div class="flex gap-5 mt-2 items-center">
                        <div class="w-full {{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} inputshow">
                            <label for="hrs" class="text-blue text-sm">{{ $lang['3'] }}</label>
                            <div class="w-full pt-1 pb-2">
                                <input type="number" name="hrs" id="hrs" class="input" value="{{ isset($request->hrs) ? $request->hrs : '' }}" aria-label="input" autocomplete="off" />
                            </div>
                        </div>
                        <p class="mt-2">:</p>
                        <div class="w-full {{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} inputshow">
                            <label for="min" class="text-blue text-sm">{{ $lang['4'] }}</label>
                            <div class="w-full pt-1 pb-2">
                                <input type="number" name="min" id="min" class="input" value="{{ isset($request->min) ? $request->min : '' }}" aria-label="input" autocomplete="off" />
                            </div>
                        </div>
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
                <div class="w-full p-3 rounded-lg mt-3 overflow-auto">
                    <div class="lg:w-5/12 mx-auto p-1">
                        <div class=" border-2 rounded-lg bg-[#F6FAFC] p-2 text-center">
                            <p>🕑 Time</p>
                            <p class="text-2xl"><strong class="text-blue">{{ $detail['time'] }}</strong></p>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center text-center">
                        <div class="lg:w-1/2 w-full p-1">
                            <div class="border-2 rounded-lg bg-[#F6FAFC] p-2">
                                <p class="pb-2">📅 Date</p>
                                <p class="text-lg"><strong>{{ $detail['t_date'] }}</strong></p>
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full p-1">
                            <div class="border-2 rounded-lg bg-[#F6FAFC] p-2">
                                <p class="pb-2">🌞 Day</p>
                                <p class="text-lg"><strong>{{ $detail['days'] }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center p-2">
                        What is <strong>{{ $request->hours ? $request->hours : 0 }}</strong> hours, 
                        <strong>{{ $request->minutes ? $request->minutes : 0 }}</strong> minute, 
                        <strong>{{ $request->seconds ? $request->seconds : 0 }}</strong> second ago? 
                        The answer is <strong>{{ $detail['time'] }}</strong> on <strong>{{ $detail['t_date'] }}</strong> 
                        which is <strong>{{ $detail['days'] }}</strong> days from the time of calculation 
                        using this Time Ago Calculator.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
            const statRadio = document.getElementById("stat");
            const dynaRadio = document.getElementById("dyna");
            const hoursInput = document.getElementById("hours");
            const minutesInput = document.getElementById("minuts");
            const secondsInput = document.getElementById("sec");
            let timer;
            function updateLiveTime() {
                const now = new Date();
                hoursInput.value = String(now.getHours()).padStart(2, '0');
                minutesInput.value = String(now.getMinutes()).padStart(2, '0');
                secondsInput.value = String(now.getSeconds()).padStart(2, '0');
            }
            function updateInputs() {
                if (statRadio.checked) {
                    // Set inputs to readonly for live countdown
                    hoursInput.setAttribute("readonly", true);
                    hoursInput.classList.add("bg-gray");
                    minutesInput.classList.add("bg-gray");
                    secondsInput.classList.add("bg-gray");
                    minutesInput.setAttribute("readonly", true);
                    secondsInput.setAttribute("readonly", true);
                    
                    // Start the timer to update the time every second
                    updateLiveTime();
                    clearInterval(timer); // Clear any existing timer
                    timer = setInterval(updateLiveTime, 1000); // Update every second
                } else if (dynaRadio.checked) {
                    // Make inputs editable and stop the live countdown
                    hoursInput.removeAttribute("readonly");
                    minutesInput.removeAttribute("readonly");
                    secondsInput.removeAttribute("readonly");
                    hoursInput.classList.remove("bg-gray");
                    minutesInput.classList.remove("bg-gray");
                    secondsInput.classList.remove("bg-gray");
                    
                    // Stop updating live time
                    clearInterval(timer);
                }
            }
            statRadio.addEventListener("change", updateInputs);
            dynaRadio.addEventListener("change", updateInputs);
            updateInputs();
        });

        function formatDateString(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        function formatTimeString(date) {
            const options = { hour: 'numeric', minute: 'numeric', hour12: true };
            return date.toLocaleTimeString('en-US', options);
        }

        function subtractTime(date, hours, minutes) {
            const newDate = new Date(date);
            newDate.setHours(newDate.getHours() - hours);
            newDate.setMinutes(newDate.getMinutes() - minutes);
            return newDate;
        }

        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        const today = new Date(); 
        const weeksContainer = document.getElementById('weeksContainer').querySelector('tbody');

        for (let i = 1; i <= 50; i++) {
            const subtractedTimeDate = subtractTime(today, i, i); // Subtract i hours and i minutes
            const formattedDate = formatDateString(subtractedTimeDate);
            const formattedDateS = formatDate(subtractedTimeDate);
            const formattedTime = formatTimeString(subtractedTimeDate);
            const weekElement = document.createElement('tr');
            weekElement.innerHTML = `
                <td><time datetime="PT${i}H">${i} Hours ago</time></td>
                <td><time datetime="${formattedDateS}">${formattedDate}</time></td>
                <td><time datetime="${formattedDateS}">${formattedTime}</time></td>
            `;
            weeksContainer.appendChild(weekElement);
        }
        document.querySelectorAll('.todaydate').forEach(element => {
            element.innerHTML = formatDateString(today);
        });
    </script>
@endpush