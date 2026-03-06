<style>
    .date_today {
        font-size: 32px;
    }

    .date_today1 {
        font-size: 35px;
        font-weight: 700;
    }

    .font14 {
        font-size: 14px
    }

    #time {
        color: #38A169;
    }
</style>
<style>
    .containe {
        display: inline-block;
        background-color: white;
        border-radius: 15px;
    }

    header {
        margin: 5px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 10px;
    }

    .header-display {
        display: flex;
        align-items: center;
    }

    .header-display p {
        color: var(--accent);
        margin: 5px;
        font-size: 1.2rem;
        word-spacing: 0.5rem;
    }

    pre {
        padding: 10px;
        margin: 0;
        cursor: pointer;
        font-size: 1.2rem;
        color: var(--accent);
    }

    .days,
    .week {
        display: grid;
        grid-template-columns: repeat(7, 36px);
        margin: auto;
        padding: 0 15px;
        justify-content: space-between;
    }

    .week div,
    .days div {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 1.8rem;
        width: 1.8em;
        border-radius: 100%;
    }

    .days div:hover {
        background: #1971a959;
        color: white;
        cursor: pointer;
    }

    .week div {
        opacity: 0.5;
    }

    .current-date {
        background-color: #1670a7c4;
        color: white;
    }

    .display-selected {
        /* margin-bottom: 10px; */
        padding: 10px 0px;
        text-align: center;
    }

    .font-s-40 {
        font-size: 2.5em;
    }

    .selected_date {
        background: #1971a959;
        color: white;
    }
</style>
  <form wire:submit.prevent="calculate" class="row">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto text-center ">

            <div class="w-full flex justify-center">
                <div class="w-20">
                    <div class="article-thumbnail article-thumbnail-spaceless">
                        <img fetchpriority="high" src="{{ asset('images/r_days.png') }}"
                            alt="icon for a calendar with one day highlighted red " width="80" height="auto"
                            decoding="async" loading="eager">
                    </div>
                </div>
            </div>
            <h2 class="mt-3 text-sm date_today">{{ $lang['1'] }}</h2>
            <p class="text-xl mt-2 mb-1  mt-[20px]">
                <span class="text-[16px] my-5 date_today1">{{ now()->format('l, F j, Y') }}</span>
            </p>
            <h2 id="time" class="text-[26px] font-bold"></h2>
            <div id="gmt" class="mt-2  "></div>
            <div class="w-full mt-3">
                <div class="col-lg-7 mx-auto">
                    <div class="containe">
                        <div class="calendar bg-[#ffffff]">
                            <header>
                                <pre class="left">◀</pre>
                                <div class="header-display">
                                    <p class="display">""</p>
                                </div>
                                <pre class="right">▶</pre>
                            </header>
                            <div class="week">
                                <div>Su</div>
                                <div>Mo</div>
                                <div>Tu</div>
                                <div>We</div>
                                <div>Th</div>
                                <div>Fr</div>
                                <div>Sa</div>
                            </div>
                            <div class="days"></div>
                        </div>
                        <div class="display-selected">
                            <p class="selected"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto  ">
            <p class="text-base mt-3 text-left">
                {{ $lang['2'] }}, {{ now()->format('F jS') }}, {{ $lang['3'] }}
                <strong class="text-blue">{{ now()->dayOfYear }}</strong>
                {{ $lang['4'] }} {{ now()->isLeapYear() ? '366 is a leap year' : '365 is not a leap year' }}
                {{ $lang['5'] }} {{ now()->year }}.
            </p>
            <div id="date-info" class="text-base elementrySteps"></div>
        </div>
    </div>
</form>
@push('calculatorJS')
    <script>
        function getDayOfYear(date) {
            const start = new Date(date.getFullYear(), 0, 0);
            const diff = date - start + (start.getTimezoneOffset() - date.getTimezoneOffset()) * 60 * 1000;
            const oneDay = 1000 * 60 * 60 * 24;
            return Math.floor(diff / oneDay);
        }

        function getWeekNumber(date) {
            const start = new Date(date.getFullYear(), 0, 1);
            const days = Math.floor((date - start) / (24 * 60 * 60 * 1000));
            return Math.ceil((days + start.getDay() + 1) / 7);
        }

        function getRemainingDaysInYear(date) {
            const end = new Date(date.getFullYear(), 11, 31);
            const oneDay = 1000 * 60 * 60 * 24;
            return Math.floor((end - date) / oneDay);
        }

        function getWeekStartEnd(date) {
            const startOfWeek = new Date(date);
            const endOfWeek = new Date(date);
            const dayOfWeek = date.getDay();
            const diff = date.getDate() - dayOfWeek + (dayOfWeek == 0 ? -6 : 1); // adjust when day is sunday
            startOfWeek.setDate(diff);
            endOfWeek.setDate(diff + 6);
            return {
                startOfWeek,
                endOfWeek
            };
        }

        function getMonthNumber(date) {
            return date.getMonth() + 1;
        }

        function formatDateString(date) {
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return date.toLocaleDateString('en-US', options);
        }

        const today = new Date();
        const remainingDays = getRemainingDaysInYear(today);
        const weekNumber = getWeekNumber(today);
        const {
            startOfWeek,
            endOfWeek
        } = getWeekStartEnd(today);
        const monthNumber = getMonthNumber(today);

        document.getElementById('date-info').innerHTML = `
            <p class="mt-1">There are <strong class="text-blue"> ${remainingDays} </strong> days remaining in this year <strong class="text-blue"> ${today.getFullYear()} </strong>.</p>
            <p class="mt-1">The current week number: ${weekNumber} (of 52)</p>
            <p class="mt-1">The current week: <strong class="text-blue"> ${formatDateString(startOfWeek)} – ${formatDateString(endOfWeek)} </strong> </p>
            <p class="mt-1">The year <strong class="text-blue"> ${today.getFullYear()} </strong> has 52 weeks.</p>
            <p class="mt-1">Today's month number is:<strong class="text-blue"> ${monthNumber} </strong></p>
        `;

        function updateTime() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true,
                timeZone: Intl.DateTimeFormat().resolvedOptions().timeZone // Get the user's time zone
            };
            const timeString = new Intl.DateTimeFormat(undefined, options).format(now);

            document.getElementById('time').textContent = timeString;

            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: options.timeZone
            };
            const dateString = new Intl.DateTimeFormat(undefined, dateOptions).format(now);
        }

        updateTime();
        setInterval(updateTime, 1000);

        const display = document.querySelector(".display");
        const days = document.querySelector(".days");
        const previous = document.querySelector(".left");
        const next = document.querySelector(".right");
        const selected = document.querySelector(".selected");

        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        function displayCalendar() {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const firstDayIndex = firstDay.getDay();
            const numberOfDays = lastDay.getDate();
            const formattedDate = date.toLocaleString("en-US", {
                month: "long",
                year: "numeric"
            });

            display.innerHTML = `${formattedDate}`;
            days.innerHTML = "";

            for (let x = 0; x < firstDayIndex; x++) {
                const div = document.createElement("div");
                days.appendChild(div);
            }

            for (let i = 1; i <= numberOfDays; i++) {
                const div = document.createElement("div");
                const currentDate = new Date(year, month, i);
                div.dataset.date = currentDate.toDateString();
                div.innerHTML = i;
                days.appendChild(div);

                if (
                    currentDate.getFullYear() === new Date().getFullYear() &&
                    currentDate.getMonth() === new Date().getMonth() &&
                    currentDate.getDate() === new Date().getDate()
                ) {
                    div.classList.add("current-date");
                }
            }

            displaySelected();
        }

        previous.addEventListener("click", () => {
            if (month === 0) {
                month = 11;
                year--;
            } else {
                month--;
            }
            date.setMonth(month);
            displayCalendar();
        });

        next.addEventListener("click", () => {
            if (month === 11) {
                month = 0;
                year++;
            } else {
                month++;
            }
            date.setMonth(month);
            displayCalendar();
        });

        function displaySelected() {
            const dayElements = document.querySelectorAll(".days div");
            dayElements.forEach(day => {
                day.addEventListener("click", e => {
                    dayElements.forEach(day => day.classList.remove('selected_date'));
                    e.target.classList.add('selected_date');
                    const selectedDate = e.target.dataset.date;
                    selected.innerHTML = `Selected Date: ${selectedDate}`;
                });
            });
        }
        displayCalendar();

        function updateGMT() {
            const now = new Date();
            const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            const offset = now.getTimezoneOffset();
            const offsetHours = Math.floor(Math.abs(offset) / 60);
            const offsetMinutes = Math.abs(offset) % 60;
            const gmtSign = offset <= 0 ? "+" : "-";
            const gmtString = `GMT${gmtSign}${offsetHours}:${offsetMinutes < 10 ? '0' : ''}${offsetMinutes}`;
            const formattedString = `${timeZone} (${gmtString})`;

            document.getElementById('gmt').innerHTML = formattedString;
        }

        updateGMT();

        // displayCalendar();
        var now = new Date();
        var day = now.getDate();
        var months = now.getMonth() + 1; // Monthss are zero-indexed, so add 1

        // Add leading zeros if day or months is less than 10
        if (day < 10) {
            day = '0' + day;
        }
        if (months < 10) {
            months = '0' + months;
        }

        // Format the date in three formats
        var mmddyyyy = months + '-' + day + '-' + year;
        var ddmmyyyy = day + '-' + months + '-' + year;
        var yyyymmdd = year + '-' + months + '-' + day;

        // Insert the formatted dates into the HTML
        document.getElementById("mmddyyyy").innerHTML = mmddyyyy;
        document.getElementById("ddmmyyyy").innerHTML = ddmmyyyy;
        document.getElementById("yyyymmdd").innerHTML = yyyymmdd;
    </script>
@endpush
