<style>
    .bg-gray {
    background: #f8f6f6;
    }
    .bg-orange{
        background: #38A169;
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


<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2 relative">
                    <input type="radio" name="time" id="stat" class="cursor-pointer" value="stat" checked {{ isset($_POST['time']) && $_POST['time'] === 'stat' ? 'checked' : '' }}>
                    <label for="stat" class="font-s-14 cursor-pointer text-blue pe-lg-3 pe-2">{{ $lang['1'] }}</label>
                    <input type="radio" class="cursor-pointer" name="time" id="dyna" value="dyna" {{ isset($_POST['time']) && $_POST['time'] === 'dyna' ? 'checked' : '' }}>
                    <label for="dyna" class="font-s-14 cursor-pointer text-blue">{{ $lang['2'] }}</label>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <!-- Time Input Fields -->
                <div class="flex gap-5 mt-3 items-center">
                    <!-- Hours Input -->
                    <div class="{{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} w-full inputshow">
                        <div class="w-full pt-1 pb-2">
                            <input type="text" name="hours" id="hours" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38A169]" value="{{ isset($request->hours) ? $request->hours : '' }}" aria-label="input" />
                        </div>
                    </div>
                    <!-- Separator -->
                    <p class="mb-1">:</p>
                    <!-- Minutes Input -->
                    <div class="{{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} w-full inputshow">
                        <div class="w-full pt-1 pb-2">
                            <input type="text" name="minuts" id="minuts" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38A169]" value="{{ isset($request->minuts) ? $request->minuts : '' }}" aria-label="input" />
                        </div>
                    </div>
                    <!-- Separator -->
                    <p class="mb-1">:</p>
                    <!-- Seconds Input -->
                    <div class="{{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} w-full inputshow">
                        <div class="w-full pt-1 pb-2">
                            <input type="text" name="sec" id="sec" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38A169]" value="{{ isset($request->sec) ? $request->sec : '' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="flex gap-5 mt-2 items-center">
                    <!-- Hours Input -->
                    <div class="{{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} w-full inputshow">
                        <label for="hrs" class="text-sm text-[#38A169]">{{$lang['3']}}</label>
                        <div class="w-full pt-1 pb-2">
                            <input type="text" name="hrs" id="hrs" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38A169]" value="{{ isset($request->hrs) ? $request->hrs : '' }}" aria-label="input" autocomplete="off" />
                        </div>
                    </div>
                    <!-- Separator -->
                    <p class="mt-2">:</p>
                    <!-- Minutes Input -->
                    <div class="{{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} w-full inputshow">
                        <label for="min" class="text-sm text-[#38A169]">{{$lang['4']}}</label>
                        <div class="w-full pt-1 pb-2">
                            <input type="text" name="min" id="min" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38A169]" value="{{ isset($request->min) ? $request->min : '' }}" aria-label="input" autocomplete="off" />
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
                    <div class="w-full bg-light-blue result p-3 rounded-lg mt-3 overflow-auto">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full text-center">
                                <span class="pr-4 text-sm block md:inline-block">Output Time Format:</span>
                                <input type="radio" name="time_st" id="twhr" class="cursor-pointer ml-3" value="twhr" checked>
                                <label for="twhr" class="text-sm cursor-pointer text-[#38A169] pr-4 md:pr-6">12 Hours am/pm</label>
                                <input type="radio" class="cursor-pointer" name="time_st" id="tfhr" value="tfhr">
                                <label for="tfhr" class="text-sm cursor-pointer text-[#38A169]">24 Hours</label>
                                <div>
                                    <p class="text-xl bg-[#2845F5] text-white px-4 py-2 rounded-lg inline-block my-3">
                                        <strong id="currentTime">{{$detail['hoursadding']->format('h:i A')}}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    @endisset
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

            @isset($detail)
                document.addEventListener('DOMContentLoaded', (event) => {
                    var currentTime = document.getElementById('currentTime');
                    var twhrChecked = document.getElementById('twhr');
                    var tfhrChecked = document.getElementById('tfhr');

                    function updateCurrentTime() {
                        if (twhrChecked.checked) {
                            currentTime.innerHTML = "{{$detail['hoursadding']->format('h:i:s A')}}";
                            console.log('12 hours');
                        } else if (tfhrChecked.checked) {
                            currentTime.innerHTML = "{{$detail['hoursadding']->format('H:i:s ')}}";
                            console.log('24 hours');
                        }
                    }
                    twhrChecked.addEventListener('click', updateCurrentTime);
                    tfhrChecked.addEventListener('click', updateCurrentTime);

                    // Initialize the current time display based on the initially checked radio button
                    updateCurrentTime();
                });
            @endisset

            function formatTime(hours, minutes, seconds) {
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0' + minutes : minutes;
                return `${hours}:${minutes}:${seconds < 10 ? '0' + seconds : seconds} ${ampm}`;
            }

            function formatDate(currentDate) {
                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const day = daysOfWeek[currentDate.getDay()];
                const date = currentDate.getDate();
                const month = months[currentDate.getMonth()];
                const year = currentDate.getFullYear();
                
                // Added a check for the correct date suffix
                const suffix = date === 1 || date === 21 || date === 31 ? 'st' :
                            date === 2 || date === 22 ? 'nd' :
                            date === 3 || date === 23 ? 'rd' : 'th';

                return `${day} ${date}${suffix} ${month} ${year}`;
            }

            function addRows(startHour, endHour, tableBody) {
                const now = new Date();
                for (let i = startHour; i <= endHour; i++) {
                    const row = document.createElement('tr');

                    const hoursFromCell = document.createElement('td');
                    hoursFromCell.textContent = `${i} Hours`;
                    hoursFromCell.classList.add('bg-gray');
                    row.appendChild(hoursFromCell);

                    const timeCell = document.createElement('td');
                    const futureTime = new Date(now.getTime() + i * 60 * 60 * 1000);
                    timeCell.textContent = formatTime(futureTime.getHours(), futureTime.getMinutes(), futureTime.getSeconds());
                    row.appendChild(timeCell);
                    
                    const dateCell = document.createElement('td');
                    // Set only the date part for the third column
                    dateCell.textContent = futureTime.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                    row.appendChild(dateCell);

                    tableBody.appendChild(row);
                }
            }

            
            document.addEventListener('DOMContentLoaded', function () {
                const tableBody = document.getElementById('hoursTable').querySelector('tbody');
                addRows(1, 96, tableBody);
            });

            const now = new Date();
            function getTimeDifference(targetDate) {
                const diff = targetDate - now;
                return {
                    hours: Math.floor(diff / (1000 * 60 * 60)),
                    minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
                };
            }
            function getNextSaturdayMidnight() {
                const daysUntilSaturday = (6 - now.getDay() + 7) % 7;
                const nextSaturday = new Date(now.getFullYear(), now.getMonth(), now.getDate() + daysUntilSaturday);
                nextSaturday.setHours(0, 0, 0, 0);
                return nextSaturday;
            }
            function getNext7AM() {
                const next7AM = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 7, 0, 0);
                if (now >= next7AM) next7AM.setDate(next7AM.getDate() + 1);
                return next7AM;
            }
            function formatDate(date) {
                return date.toLocaleString('en-US', { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });
            }
            const saturdayMidnight = getNextSaturdayMidnight();
            const timeToSaturday = getTimeDifference(saturdayMidnight);
            document.getElementById('saturdayMidnight').innerHTML = `${timeToSaturday.hours} hours ${timeToSaturday.minutes} minutes`;
            document.getElementById('timeToSaturday').innerHTML = `${formatDate(now)} - ${formatDate(saturdayMidnight)}`;
            const next7AM = getNext7AM();
            const timeTo7AM = getTimeDifference(next7AM);
            document.getElementById('next7AM').innerHTML = `${timeTo7AM.hours} hours ${timeTo7AM.minutes} minutes`;
            document.getElementById('timeTo7AM').innerHTML = `${formatDate(now)} - ${formatDate(next7AM)}`;
        </script>
    @endpush
</form>