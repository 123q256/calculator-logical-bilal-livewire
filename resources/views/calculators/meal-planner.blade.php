<style>
    .no-scroll{
        overflow: hidden;
    }

    .white-nowrap{
        white-space: nowrap;
    }

    .gap-5{
        gap: 5px
    }
    
    .gap-10{
        gap: 10px
    }

    .gap-15{
        gap: 15px
    }

    .foodsTypes{
        border: 1px solid #E1E1E1
    }
    
    .foodsTypes:hover{
        background: #EEF5F9;
        border: 1px solid transparent
    }

    .foodsTypes.activeFood{
        background: #EEF5F9;
        border: 1px solid transparent
    }

    #allFoods{
        max-height: 350px;
        overflow: auto;
    }

    #allFoods::-webkit-scrollbar,.mealsSection::-webkit-scrollbar {
        width: 10px;
    }
    #allFoods::-webkit-scrollbar-thumb, .mealsSection::-webkit-scrollbar-thumb{
        background: #CBCACA;
        border-radius: 7px;
    }
    #allFoods::-webkit-scrollbar-track, .mealsSection::-webkit-scrollbar-track{
        background-color: #F1F1F1;
        border-radius: 7px;
    }

    .hover-underline:hover,.mealNamePopup:hover{
        text-decoration: underline
    }

    .loading-dots {
        display: inline-block;
        position: relative;
        font-size: 1.5em;
    }

    .loading-dots::after {
        content: '...';
        animation: dots 1.5s steps(5, end) infinite;
    }

    @keyframes dots {
        0%, 20% {
            content: '.';
        }
        40% {
            content: '..';
        }
        60%, 100% {
            content: '...';
        }
    }

    .previewBtns{
        background: #F5F5F5;
        color: #000000;
        font-size: 16px;
    }

    .previewBtns.activePreview{
        background: var(--light-blue);
        color: var(--white);
    }

    .border_btm{
        border-bottom: 1px solid #D2D2D2
    }


    .base-timer {
        position: relative;
        width: 50px;
        height: 50px;
        margin-top: 20px
    }

    .base-timer__svg {
        transform: scaleX(-1);
    }

    .base-timer__circle {
        fill: none;
        stroke: none;
    }

    .base-timer__path-elapsed {
        stroke-width: 7px;
        stroke: grey;
    }

    .base-timer__path-remaining {
        stroke-width: 7px;
        stroke-linecap: round;
        transform: rotate(90deg);
        transform-origin: center;
        transition: 1s linear all;
        fill-rule: nonzero;
        stroke: currentColor;
    }

    .base-timer__path-remaining.green {
        color: rgb(65, 184, 131);
    }

    .base-timer__path-remaining.orange {
        color: orange;
    }

    .base-timer__path-remaining.red {
        color: red;
    }

    .base-timer__label {
        position: absolute;
        width: 50px;
        height: 50px;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .dayHeading{
        font-weight: bold;
        font-size: 18px
    }

    .checkBtns{
        font-size: 14px;
        padding: 5px 12px
    }

    .checkBtns:hover{
        background: #1670a752
    }

    .mealTimes,.goal_weight{
        background: #F5F5F5;
        color: #000000;
        font-size: 14px;
        padding: 5px 12px;
        border-radius: 10px;
        cursor: pointer;
    }

    .mealTimes.activemealTimes,.goal_weight.activeGoal{
        background: #2845F5;
        color: white;

    }

    .text_chota{
        font-size: 15px;
        letter-spacing: .5px;
        line-height: 32px;
    }

    .new-gray{
        color: #838080
    }

    #add_more_days:disabled {
        background: #2845F5;
        cursor: not-allowed;
        color: white;
    }

    @media (max-width: 480px){
        .text_chota{
            font-size: 14px;
        }
        
        .checkBtns{
            font-size: 12px;
            padding: 5px 10px
        }
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 mt-2 px-2">I want to:</p>
                    <div class="col-span-12 px-2">
                        <div class="flex items-center gap-10 my-2 px-2">
                        <p class="d-lg-block hidden">I want to:</p>
                        <p class="goal_weight" data-value="lose" title="0.5 kg/week">Lose weight</p>
                        <p class="goal_weight activeGoal" data-value="maintain">Maintain Weight</p>
                        <p class="goal_weight" data-value="gain" title="0.5 kg/week">Weight Gain</p>
                        <input type="hidden" name="goal_weight" value="maintain" id="goal_weight">
                    </div>
                    </div>
                    <div class="col-span-6">
                        <label for="age" class="font-s-14 text-blue">Age:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="age" id="age" class="input" aria-label="input" value="25" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="gender" class="font-s-14 text-blue">Gender:</label>
                        <div class="w-full py-2">
                            <select class="input" name="gender" id="gender" aria-label="select input">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="height_in" class="font-s-14 text-blue px-2">Height:</label>
                        <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-8 hidden cm_input">
                                <input type="number" step="any" name="height_cm" id="height_cm" class="input" aria-label="input" value="170" placeholder="cm" />
                            </div>
                            <div class="col-span-4 ftin_input">
                                <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" value="5" placeholder="ft" />
                            </div>
                            <div class="col-span-4 ftin_input">
                                <input type="number" step="any" name="height_in" id="height_in" class="input" aria-label="input" value="9" placeholder="in" />
                            </div>
                            <div class="col-span-4">
                                <select class="input" name="unit_h" id="unit_h" onchange="change_height(this)" aria-label="select input">
                                    <option value="ft/in">ft/in</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="weight" class="font-s-14 text-blue px-2">Weight:</label>
                        <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-8">
                                <input type="number" step="any" name="weight" id="weight" class="input" aria-label="input" value="158" />
                            </div>
                            <div class="col-span-4">
                                <select class="input" name="unit" id="unit" aria-label="select input">
                                    <option value="lbs">lbs</option>
                                    <option value="kg">kg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="activity" class="font-s-14 text-blue">Choose Activity Level:</label>
                        <div class="w-full py-2">
                            <select name="activity" id="activity" class="input" aria-label="input select">
                                <option value="1">Basal Metabolic Rate (BMR)</option>
                                <option value="1.2">Sedentary: little or no exercise</option>
                                <option value="1.375">Light: exercise 1-3 times/week</option>
                                <option value="1.465" selected>Moderate: exercise 4-5 times/week</option>
                                <option value="1.55">Active: daily exercise or intense exercise 3-4 times/week</option>
                                <option value="1.725">Very Active: intense exercise 6-7 times/week</option>
                                <option value="1.9">Extra Active: very intense exercise daily, or physical job</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="formula" class="font-s-14 text-blue">Formula:</label>
                        <div class="w-full py-2">
                            <select name="formula" id="formula" onchange="formula_change(this)" class="input" aria-label="input select">
                                <option value="mifflin">Mifflin St Jeor</option>
                                <option value="revised">Revised Harris-Benedict</option>
                                <option value="katch">Katch-McArdle</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6 hidden" id="percent_input">
                        <label for="percent" class="font-s-14 text-blue">Body Fat %:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="percent" id="percent" class="input" aria-label="input" value="" placeholder="0" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 px-2 hidden mt-2" id="calories_show">
                        <div class="flex items-center justify-between bg-[#F6FAFC] p-2 rounded-lg" style="border: 1px solid #c1b8b899;">
                            <p class="text-[18px] flex items-center">
                                <img loading="eager" decoding="async" src="{{ asset('images/sc-weight.png') }}" alt="calories answer" height="100%" width="40px">
                                <b>Calories</b>
                            </p>
                            <p class="font-s-20"><b class="text-blue" id="cal_pop_ans"></b></p>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-span-6 text-center my-2">
                <button type="button" class="calculate bg-[#2845F5] text-white  rounded-lg p-3" onclick="calculate_calories()">Calculate</button>
            </div>
        @if ($type=='widget')
        @include('inc.widget-button')
        @endif
    </div>
    <script src="{{ url('js/html2pdf.bundle.js') }}"></script>
    <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
    <script>
        document.querySelectorAll('.goal_weight').forEach(element => {
            element.addEventListener('click', function() {
                document.querySelectorAll('.goal_weight').forEach(el => el.classList.remove('activeGoal'));
                this.classList.add('activeGoal');
                document.getElementById('goal_weight').value = this.getAttribute('data-value');
            });
        });
        function formula_change(element) {
            let formula_val = element.value;
            if (formula_val == "mifflin" || formula_val == "revised") {
                document.getElementById("percent_input").classList.add("hidden");
            } else {
                document.getElementById("percent_input").classList.remove("hidden");
            }
        }
        function calculate_calories() {
            let age = document.getElementById("age").value;
            let gender = document.getElementById("gender").value;
            let unit_h = document.getElementById("unit_h").value;
            let height_cm = document.getElementById("height_cm").value;
            let height_ft = document.getElementById("height_ft").value;
            let height_in = document.getElementById("height_in").value;
            let weight = document.getElementById("weight").value;
            let unit = document.getElementById("unit").value;
            let activity = document.getElementById("activity").value;
            let formula = document.getElementById("formula").value;
            let percent = document.getElementById("percent").value;
            let goal_weight = document.getElementById("goal_weight").value;
            let BMR;
            if (!isNaN(age) && age.trim() !== "") {
                if (!isNaN(weight) && weight.trim() !== "") {
                    if(unit == "lbs"){
                        weight = weight / 2.205;
                    }
                    if (unit_h == "ft/in") {
                        height_cm = height_ft * 30.48;
                        if (height_in !== null && height_in !== undefined) {
                            height_in = height_in * 2.54;
                            height_cm += height_in;
                        }
                    }
                    if (height_in !== null && height_in !== undefined) {
                        if(gender == "male"){
                            if(formula == "mifflin"){
                                BMR = Math.round((10 * weight) + (6.25 * height_cm) - (5 * age) + 5);
                            }else if(formula == "revised"){
                                BMR = Math.round((13.397 * weight) + (4.799 * height_cm) - (5.677 * age) + 88.362);
                            }else{
                                if (!isNaN(percent) && percent.trim() !== "") {
                                    BMR = Math.round(370 + 21.6 * (1 - percent)) * weight;
                                }else{
                                    alert("Please enter a valid numeric percent.");
                                    return; 
                                }
                            }
                        } else {
                            if(formula == "mifflin"){
                                BMR = Math.round((10 * weight) + (6.25 * height_cm) - (5 * age) + 161);
                            }else if(formula == "revised"){
                                BMR = Math.round((9.247 * weight) + (3.098 * height_cm) - (4.330 * age) + 447.593);
                            }else{
                                if (!isNaN(percent) && percent.trim() !== "") {
                                    BMR = Math.round(370 + 21.6 * (1 - percent)) * weight;
                                }else{
                                    alert("Please enter a valid numeric percent.");
                                    return; 
                                }
                            }
                        }
                        let cal_ans = Math.round(activity * BMR);
                        if(goal_weight == "lose"){
                            cal_ans = Math.round(cal_ans - 500);
                        } else if(goal_weight == "gain"){
                            cal_ans = Math.round(cal_ans + 500);
                        }
                        document.getElementById("calories_show").classList.remove("hidden");
                        document.getElementById('cal_pop_ans').textContent = cal_ans + " kcal";
                        document.getElementById("eat_calories").value = cal_ans;
                    } else {
                        alert("Please enter a valid numeric height.");
                        return;   
                    }
                }else{
                    alert("Please enter a valid numeric weight.");
                    return;   
                }
            }else{
                alert("Please enter a valid numeric age.");
                return;   
            }
        }
        function change_height(element) {
            let ft_in_val = element.value;
            if(ft_in_val === "cm") {
                document.querySelectorAll('.cm_input').forEach(function(element) {
                    element.classList.remove('hidden');
                });
                document.querySelectorAll('.ftin_input').forEach(function(element) {
                    element.classList.add('hidden');
                });
            } else{
                document.querySelectorAll('.cm_input').forEach(function(element) {
                    element.classList.add('hidden');
                });
                document.querySelectorAll('.ftin_input').forEach(function(element) {
                    element.classList.remove('hidden');
                });
            }
        }
        function calorie_cal() {
            let caloriePopup = document.getElementById("caloriePopup");
            if (caloriePopup) {
                caloriePopup.style.display = "flex";
                caloriePopup.style.justifyContent = "center";
                caloriePopup.style.alignItems = "center";
                caloriePopup.style.paddingTop = "0px";
                document.body.classList.add('no-scroll');
                let spans = caloriePopup.querySelectorAll('.cancelMeal');
                spans.forEach(span => {
                    span.onclick = function() {
                        caloriePopup.style.display = "none";
                        caloriePopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    };
                });
                window.onclick = function(event) {
                    if (event.target === caloriePopup) {
                        caloriePopup.style.display = "none";
                        caloriePopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    }
                };
            }
        }
        document.getElementById('searchFood').addEventListener('input', function() {
            var val = clearText(this.value);
            var boxMeals = Array.from(document.querySelectorAll('.foodsTypes'));
            boxMeals.forEach(function(boxMeal) {
                var myVal = clearText(boxMeal.textContent);
                if (myVal.match(val)) {
                    boxMeal.style.display = 'flex';
                } else {
                    boxMeal.style.display = 'none';
                }
            });
        });
        function initializeTimer() {
            const FULL_DASH_ARRAY = 283;
            const WARNING_THRESHOLD = 10;
            const ALERT_THRESHOLD = 5;

            const COLOR_CODES = {
            info: {
                color: "green"
            },
            warning: {
                color: "orange",
                threshold: WARNING_THRESHOLD
            },
            alert: {
                color: "red",
                threshold: ALERT_THRESHOLD
            }
            };

            const TIME_LIMIT = 25;
            let timePassed = 0;
            let timeLeft = TIME_LIMIT;
            let timerInterval = null;
            let remainingPathColor = COLOR_CODES.info.color;

            document.getElementById("app").innerHTML = `
            <div class="base-timer">
            <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <g class="base-timer__circle">
                <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                <path
                    id="base-timer-path-remaining"
                    stroke-dasharray="283"
                    class="base-timer__path-remaining ${remainingPathColor}"
                    d="
                    M 50, 50
                    m -45, 0
                    a 45,45 0 1,0 90,0
                    a 45,45 0 1,0 -90,0
                    "
                ></path>
                </g>
            </svg>
            <span id="base-timer-label" class="base-timer__label">${formatTime(
                timeLeft
            )}</span>
            </div>
            `;

            startTimer();

            function onTimesUp() {
            clearInterval(timerInterval);
            }

            function startTimer() {
            timerInterval = setInterval(() => {
                timePassed = timePassed += 1;
                timeLeft = TIME_LIMIT - timePassed;
                document.getElementById("base-timer-label").innerHTML = formatTime(
                timeLeft
                );
                setCircleDasharray();
                setRemainingPathColor(timeLeft);

                if (timeLeft === 0) {
                onTimesUp();
                }
            }, 1000);
            }

            function formatTime(time) {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;

            if (seconds < 10) {
                seconds = `0${seconds}`;
            }

            return `${minutes}:${seconds}`;
            }

            function setRemainingPathColor(timeLeft) {
            const { alert, warning, info } = COLOR_CODES;
            if (timeLeft <= alert.threshold) {
                document
                .getElementById("base-timer-path-remaining")
                .classList.remove(warning.color);
                document
                .getElementById("base-timer-path-remaining")
                .classList.add(alert.color);
            } else if (timeLeft <= warning.threshold) {
                document
                .getElementById("base-timer-path-remaining")
                .classList.remove(info.color);
                document
                .getElementById("base-timer-path-remaining")
                .classList.add(warning.color);
            }
            }

            function calculateTimeFraction() {
            const rawTimeFraction = timeLeft / TIME_LIMIT;
            return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
            }

            function setCircleDasharray() {
            const circleDasharray = `${(
                calculateTimeFraction() * FULL_DASH_ARRAY
            ).toFixed(0)} 283`;
            document
                .getElementById("base-timer-path-remaining")
                .setAttribute("stroke-dasharray", circleDasharray);
            }
        }
        let timerInterval = null;
        function new_initializeTimer() {
            const FULL_DASH_ARRAY = 283;
            const WARNING_THRESHOLD = 10;
            const ALERT_THRESHOLD = 5;

            const COLOR_CODES = {
                info: {
                    color: "green"
                },
                warning: {
                    color: "orange",
                    threshold: WARNING_THRESHOLD
                },
                alert: {
                    color: "red",
                    threshold: ALERT_THRESHOLD
                }
            };

            const TIME_LIMIT = 25;
            let timePassed = 0;
            let timeLeft = TIME_LIMIT;
            let remainingPathColor = COLOR_CODES.info.color;

            // Clear any existing timer
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
            }

            document.getElementById("new_app").innerHTML = `
                <div class="base-timer">
                    <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <g class="base-timer__circle">
                            <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                            <path
                                id="new-base-timer-path-remaining"
                                stroke-dasharray="283"
                                class="base-timer__path-remaining ${remainingPathColor}"
                                d="
                                M 50, 50
                                m -45, 0
                                a 45,45 0 1,0 90,0
                                a 45,45 0 1,0 -90,0
                                "
                            ></path>
                        </g>
                    </svg>
                    <span id="new-base-timer-label" class="base-timer__label">${formatTime(timeLeft)}</span>
                </div>
            `;

            startTimer();

            function startTimer() {
                timerInterval = setInterval(() => {
                    timePassed += 1;
                    timeLeft = TIME_LIMIT - timePassed;
                    document.getElementById("new-base-timer-label").innerHTML = formatTime(timeLeft);
                    setCircleDasharray();
                    setRemainingPathColor(timeLeft);
                    if (timeLeft === 0) {
                        clearInterval(timerInterval);
                    }
                }, 1000);
            }

            function formatTime(time) {
                const minutes = Math.floor(time / 60);
                let seconds = time % 60;
                if (seconds < 10) {
                    seconds = `0${seconds}`;
                }
                return `${minutes}:${seconds}`;
            }

            function setRemainingPathColor(timeLeft) {
                const { alert, warning, info } = COLOR_CODES;
                if (timeLeft <= alert.threshold) {
                    document.getElementById("new-base-timer-path-remaining").classList.remove(warning.color);
                    document.getElementById("new-base-timer-path-remaining").classList.add(alert.color);
                } else if (timeLeft <= warning.threshold) {
                    document.getElementById("new-base-timer-path-remaining").classList.remove(info.color);
                    document.getElementById("new-base-timer-path-remaining").classList.add(warning.color);
                }
            }

            function calculateTimeFraction() {
                const rawTimeFraction = timeLeft / TIME_LIMIT;
                return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
            }

            function setCircleDasharray() {
                const circleDasharray = `${(calculateTimeFraction() * FULL_DASH_ARRAY).toFixed(0)} 283`;
                document.getElementById("new-base-timer-path-remaining").setAttribute("stroke-dasharray", circleDasharray);
            }
        }
        function previewDownload(element) {
            const downloadpreviewSection = document.getElementById('downloadpreviewSection');
            downloadpreviewSection.classList.remove("hidden");
            const dayValue = element.getAttribute('data-day');
            const mealsData = element.getAttribute('data-meals');
            const mealsArray = JSON.parse(mealsData);
            element.children[1].innerText = 'Downloading...';
            downloadpreviewSection.innerHTML = '';
            let previewContent = '';
            previewContent = `
                <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #E6E6E6">
                    <p><b class="font-s-20 text-blue">${dayValue}</b></p>
                </div>`;
            Object.keys(mealsArray).forEach((mealType, index) => {
                const mealDetails = mealsArray[mealType];
                previewContent += `<p class="font-s-18 ${index !== 0 ? 'mt-4' : ''}"><b>${mealType.charAt(0).toUpperCase() + mealType.slice(1)}</b></p>`;
                mealDetails.forEach((meal, mealIndex) => {
                    let uniqueID = `chart_${mealType}_${index}_${mealIndex}`;
                    previewContent +=  `
                        <p class="font-s-18 mb-2"><b>${meal.meal_name}</b></p>
                        <div class="row font-s-12">
                            <p class="col-12 font-s-12 new-gray">🍳 Preparation Time: ${meal.meal_time} and 🍽️ Cook Time: ${meal.cook_time}</p>
                            <div class="col-lg-6 col-12 pe-lg-3">
                                <div class="col-12 ingredientDetails mt-2">
                                    <p><b class="font-s-16 text-blue">Ingredients</b></p>
                                    <div class="col-12">
                                        ${meal.ingredients.map(ingredient => `
                                            <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                                <p>${ingredient.name}</p>
                                                <p>${ingredient.quantity} / ${ingredient.calories}</p>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                                <div class="col-12 recipeDetail mt-2">
                                    <p><b class="font-s-16 text-blue">Making</b></p>
                                    <p class="mt-1 font-s-12">${meal.meal_recipe}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 ps-lg-3">
                                <div class="col-12 recipeDetail mt-2">
                                    <p><b class="font-s-16 text-blue">Details</b></p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="ids_remove" id="${uniqueID}" style="width:180px;height:180px"></div>
                                    </div>
                                    <div class="col-12 popupDetails">
                                        <div class="d-flex align-items-center justify-content-between border_btm pb-2">
                                            <p>Carbs</p>
                                            <p>${meal.carbs}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                            <p>Fat</p>
                                            <p>${meal.fat}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                            <p>Protein</p>
                                            <p>${meal.protein}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                })
            });
            downloadpreviewSection.innerHTML = previewContent;

            // Function to render charts
            function renderCharts() {
                return new Promise((resolve) => {
                    Object.keys(mealsArray).forEach((mealType, index) => {
                        const mealDetails_2 = mealsArray[mealType];
                        mealDetails_2.forEach((meal, mealIndex) => {
                            let uniqueID = `chart_${mealType}_${index}_${mealIndex}`;
                            var totalDetails = parseFloat(meal.carbs) + parseFloat(meal.fat) + parseFloat(meal.protein);
                            var carbsPercentage = (parseFloat(meal.carbs) / totalDetails) * 100;
                            var fatPercentage = (parseFloat(meal.fat) / totalDetails) * 100;
                            var proteinPercentage = (parseFloat(meal.protein) / totalDetails) * 100;
                            
                            // Ensure container exists
                            var container = document.getElementById(uniqueID);
                            if (container) {
                                var chart = new CanvasJS.Chart(uniqueID, {
                                    theme: "light2",
                                    animationEnabled: true,
                                    height: 180,
                                    width: 180,
                                    data: [{
                                        type: "pie",
                                        indexLabel: "{y}",
                                        yValueFormatString: "#,##0.00\"%\"",
                                        indexLabelPlacement: "inside",
                                        indexLabelFontColor: "#FFFFFF",
                                        indexLabelFontSize: 10,
                                        legendText: "{label}",
                                        dataPoints: [
                                            { y: proteinPercentage, label: "Protein", color: "#F8AD3E" },
                                            { y: fatPercentage, label: "Fat", color: "#6F3535" },
                                            { y: carbsPercentage, label: "Carbs", color: "#1670A7" }
                                        ]
                                    }]
                                });
                                chart.render();
                            } else {
                                console.error(`Container with ID ${uniqueID} not found.`);
                            }
                        });
                    });

                    // Wait for a short time to ensure charts are fully rendered
                    setTimeout(() => resolve(), 2000);
                });
            }

            renderCharts().then(() => {
                setTimeout(() => {
                    var n = document.querySelector('#downloadpreviewSection');
                    html2pdf().from(n).set({
                        margin: [15, 5, 5, 5],
                        filename: `${dayValue} Meals Details by technical-calculator.pdf`,
                        image: {
                            type: "jpeg",
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2,
                            logging: !0,
                            dpi: 192,
                            letterRendering: !0,
                        },
                        jsPDF: {
                            unit: "mm",
                            format: "a4",
                            orientation: "p"
                        },
                        pagebreak: {
                            before: ".page-break",
                            avoid: "table"
                        },
                    }).toPdf().get("pdf").then(function(e) {
                        var t = e.internal.getNumberOfPages();
                        for (let pageNumber = 1; pageNumber <= t; pageNumber++) {
                            e.setPage(pageNumber);
                            e.setFontSize(8);
                            e.setTextColor(150);
                            e.text(15, 15, "Results from");
                            e.setTextColor(0, 0, 255);
                            e.textWithLink(" technical-calculator", 31, 15, {
                                url: "https://technical-calculator/"
                            });
                            var allMathText = "technical-calculator " + pageNumber + "/" + t;
                            var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                            e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                                url: "https://technical-calculator/"
                            });
                        }
                        downloadpreviewSection.classList.add("hidden");
                        element.children[1].innerText = 'Download';
                    }).save().catch((e) => {
                        console.error(e);
                    });
                }, 5000); // Adjust the delay if needed
            });
        }
        function clearText(text) {
            return text.trim().toLowerCase();
        }
        function updatePreview(element) {
            const allMealTimes = document.querySelectorAll('.mealTimes');
            allMealTimes.forEach(el => el.classList.remove('activemealTimes'));
            element.classList.add('activemealTimes');
            const new_value = element.getAttribute('data-value');
            const new_details = JSON.parse(element.getAttribute('data-details'));
            document.getElementById('new_meal_name').textContent = new_details[0].meal_name;
            document.getElementById('new_prep_time').textContent = new_details[0].meal_time;
            document.getElementById('new_cook_time').textContent = new_details[0].cook_time;
            document.getElementById('new_making').textContent = new_details[0].meal_recipe;
            document.getElementById('new_carbs').textContent = new_details[0].carbs;
            document.getElementById('new_fat').textContent = new_details[0].fat;
            document.getElementById('new_protein').textContent = new_details[0].protein;
            const ingredientsHTML = new_details[0].ingredients.map(ingredient => `
                <div class="d-flex align-items-center justify-content-between border_btm py-2">
                    <p>${ingredient.name}</p>
                    <p>${ingredient.quantity} / ${ingredient.calories}</p>
                </div>
            `).join('');
            document.getElementById('new_ingredients').innerHTML = ingredientsHTML;
            var totalDetails = parseFloat(new_details[0].carbs) + parseFloat(new_details[0].fat) + parseFloat(new_details[0].protein);
            var carbsPercentage = (parseFloat(new_details[0].carbs) / totalDetails) * 100;
            var fatPercentage = (parseFloat(new_details[0].fat) / totalDetails) * 100;
            var proteinPercentage = (parseFloat(new_details[0].protein) / totalDetails) * 100;
            var chart = new CanvasJS.Chart("new_piechart", {
                theme: "light2",
                animationEnabled: true,
                height: 180,
                width: 180,
                data: [{
                    type: "pie",
                    indexLabel: "{y}",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "#FFFFFF",
                    indexLabelFontSize: 10,
                    legendText: "{label}",
                    dataPoints: [
                        { y: proteinPercentage, label: "Protein", color: "#F8AD3E" },
                        { y: fatPercentage, label: "Fat", color: "#6F3535" },
                        { y: carbsPercentage, label: "Carbs", color: "#1670A7" }
                    ]
                }]
            });
            chart.render();
        }
        function new_mealsPreview(element) {
            let mealsPopup = document.getElementById("previewPopup");
            if (mealsPopup) {
                const dayValue = element.getAttribute('data-day');
                const mealsData = element.getAttribute('data-meals');
                const mealsArray = JSON.parse(mealsData);
                previewSection.innerHTML = '';
                let previewContent = `
                    <div class="col-12 p-3" id="previewContent">
                        <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #E6E6E6">
                            <p><b class="font-s-20 text-blue">${dayValue}</b></p>
                            <div class="d-flex align-items-center gap-10">`;
                                Object.keys(mealsArray).forEach((mealType, index) => {
                                    const mealDetails = JSON.stringify(mealsArray[mealType]);
                                    previewContent += `
                                        <p class="mealTimes ${index === 0 ? 'activemealTimes' : ''}" data-value="${mealType}" data-details='${mealDetails}' onclick="updatePreview(this)">
                                            ${(mealType.charAt(0).toUpperCase() + mealType.slice(1)).replace(/_/g, ' ')}
                                        </p>`;
                                });
                                previewContent += `
                                <img loading="lazy" decoding="async" src="{{ asset('images/cancel.png') }}" alt="cancel image" height="10px" width="10px" class="cancelMeal cursor-pointer">
                            </div>
                        </div>
                        <p class="font-s-22 mb-2"><b id="new_meal_name">${mealsArray.breakfast[0].meal_name}</b></p>
                        <div class="row font-s-12">
                            <p class="col-12 font-s-12 new-gray">🍳 Preperation Time: <span id="new_prep_time">${mealsArray.breakfast[0].meal_time}</span> and 🍽️ Cook Time: <span id="new_cook_time">${mealsArray.breakfast[0].cook_time}</span></p>
                            <div class="col-lg-6 col-12 pe-lg-3">
                                <div class="col-12 ingredientDeatils mt-2">
                                    <p><b class="font-s-16 text-blue text-decoration-underline">Ingredient</b></p>
                                    <div class="col-12" id="new_ingredients">
                                        ${mealsArray.breakfast[0].ingredients.map(ingredient => `
                                            <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                                <p>${ingredient.name}</p>
                                                <p>${ingredient.quantity} / ${ingredient.calories}</p>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                                <div class="col-12 recipeDetail mt-2">
                                    <p><b class="font-s-16 text-blue text-decoration-underline">Making</b></p>
                                    <p class="mt-1 font-s-12" id="new_making">${mealsArray.breakfast[0].meal_recipe}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 ps-lg-3">
                                <div class="col-12 recipeDetail mt-2">
                                    <p><b class="font-s-16 text-blue text-decoration-underline">Deatils</b></p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div id="new_piechart" style="width:180px;height:180px"></div>
                                    </div>
                                    <div class="col-12 popupDeatils">
                                        <div class="d-flex align-items-center justify-content-between border_btm pb-2">
                                            <p>Carbs</p>
                                            <p id="new_carbs">${mealsArray.breakfast[0].carbs}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                            <p>Fat</p>
                                            <p id="new_fat">${mealsArray.breakfast[0].fat}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                            <p>Protein</p>
                                            <p id="new_protein">${mealsArray.breakfast[0].protein}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                previewSection.innerHTML = previewContent;
                var totalDetails = parseFloat(mealsArray.breakfast[0].carbs) + parseFloat(mealsArray.breakfast[0].fat) + parseFloat(mealsArray.breakfast[0].protein);
                var carbsPercentage = (parseFloat(mealsArray.breakfast[0].carbs) / totalDetails) * 100;
                var fatPercentage = (parseFloat(mealsArray.breakfast[0].fat) / totalDetails) * 100;
                var proteinPercentage = (parseFloat(mealsArray.breakfast[0].protein) / totalDetails) * 100;
                var chart = new CanvasJS.Chart("new_piechart", {
                    theme: "light2",
                    animationEnabled: true,
                    height: 180,
                    width: 180,
                    data: [{
                        type: "pie",
                        indexLabel: "{y}",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabelPlacement: "inside",
                        indexLabelFontColor: "#FFFFFF",
                        indexLabelFontSize: 10,
                        legendText: "{label}",
                        dataPoints: [
                            { y: proteinPercentage, label: "Protein", color: "#F8AD3E" },
                            { y: fatPercentage, label: "Fat", color: "#6F3535" },
                            { y: carbsPercentage, label: "Carbs", color: "#1670A7" }
                        ]
                    }]
                });
                chart.render();

                mealsPopup.style.display = "flex";
                mealsPopup.style.justifyContent = "center";
                mealsPopup.style.alignItems = "center";
                mealsPopup.style.paddingTop = "0px";
                document.body.classList.add('no-scroll');
                let spans = mealsPopup.querySelectorAll('.cancelMeal');
                spans.forEach(span => {
                    span.onclick = function() {
                        mealsPopup.style.display = "none";
                        mealsPopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    };
                });
                window.onclick = function(event) {
                    if (event.target === mealsPopup) {
                        mealsPopup.style.display = "none";
                        mealsPopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    }
                };
            }
        }
        function caloriesDetails(element) {
            let detailsPopup = document.getElementById("detailsPopup");
            const meal_carbs = element.getAttribute('data-carbs');
            const meal_fat = element.getAttribute('data-fat');
            const data_protein = element.getAttribute('data-protein');
            const data_calories = element.getAttribute('data-calories');
            if (detailsPopup) {
                const caloriesSection = document.getElementById("caloriesSection");
                caloriesSection.innerHTML = '';
                caloriesSection.innerHTML = `
                    <div class="col-12 p-3" id="previewContent">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <p class="font-s-18"><b>Calories Details</b></p>
                            <img loading="lazy" decoding="async" src="{{ asset('images/cancel.png') }}" alt="cancel image" height="13px" width="13px" class="cancelMeal cursor-pointer">
                        </div>
                        <div class="row font-s-12">
                            <div class="d-flex align-items-center justify-content-between border_btm pb-1">
                                <p>Carbs</p>
                                <p>${meal_carbs}g</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-2 border_btm pb-1">
                                <p>Fat</p>
                                <p>${meal_fat}g</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-2 border_btm pb-1">
                                <p>Protein</p>
                                <p>${data_protein}g</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <div id="piechart_main" style="width:200px;height:200px"></div>
                            </div>
                        </div>
                    </div>
                `;
                var totalDetails = parseFloat(meal_carbs) + parseFloat(meal_fat) + parseFloat(data_protein);
                var carbsPercentage = (parseFloat(meal_carbs) / totalDetails) * 100;
                var fatPercentage = (parseFloat(meal_fat) / totalDetails) * 100;
                var proteinPercentage = (parseFloat(data_protein) / totalDetails) * 100;
                var chart = new CanvasJS.Chart("piechart_main", {
                    theme: "light2",
                    animationEnabled: true,
                    height: 200,
                    width: 200,
                    data: [{
                        type: "pie",
                        indexLabel: "{y}",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabelPlacement: "inside",
                        indexLabelFontColor: "#FFFFFF",
                        indexLabelFontSize: 10,
                        legendText: "{label}",
                        dataPoints: [
                            { y: proteinPercentage, label: "Protein", color: "#F8AD3E" },
                            { y: fatPercentage, label: "Fat", color: "#6F3535" },
                            { y: carbsPercentage, label: "Carbs", color: "#1670A7" }
                        ]
                    }]
                });
                chart.render();
                detailsPopup.style.display = "flex";
                detailsPopup.style.justifyContent = "center";
                detailsPopup.style.alignItems = "center";
                detailsPopup.style.paddingTop = "0px";
                document.body.classList.add('no-scroll');
                let spans = detailsPopup.querySelectorAll('.cancelMeal');
                spans.forEach(span => {
                    span.onclick = function() {
                        detailsPopup.style.display = "none";
                        detailsPopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    };
                });
                window.onclick = function(event) {
                    if (event.target === detailsPopup) {
                        detailsPopup.style.display = "none";
                        detailsPopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    }
                };
            }
        }
        function renderMeals(meals, containerId, checkMealName) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            meals.forEach(meal => {
                container.innerHTML += createMealHtml(meal, checkMealName);
            });
        }
        function getRandomEmoji(mealType) {
            const emojis = {
                breakfast: ["🍳", "🥞", "🥓", "☕", "🧇", "🥐", "🍯"],
                snack: ["🍎", "🍪", "🥜", "🍿", "🥨", "🍫", "🍩"],
                snack_1: ["🍎", "🍪", "🥜", "🍿", "🥨", "🍫", "🍩"],
                lunch: ["🍔", "🥗", "🍣", "🌮", "🍕", "🍜", "🍝"],
                snack_2: ["🍎", "🍪", "🥜", "🍿", "🥨", "🍫", "🍩"],
                dinner: ["🍲", "🍛", "🍤", "🍖", "🥩", "🥘", "🍚"]
            };
            
            const mealEmojis = emojis[mealType.toLowerCase()] || ["🍽️"];
            return mealEmojis[Math.floor(Math.random() * mealEmojis.length)];
        }
        function createMealHtml(meal,checkMealName) {
            let timeImage = "{{ asset('images/meals_images/black_time.png') }}";
            let previewImage = "{{ asset('images/meals_images/preview.png') }}";
            let downloadImage = "{{ asset('images/meals_images/black_download.png') }}";
            return `
                <div class="d-flex align-items-center mt-1 downloadBoxes">
                    <p class="text_chota"><b class="d-lg-inline-block d-block">${getRandomEmoji(checkMealName)} ${checkMealName.replace(/_/g, ' ')}</b> - ${meal.meal_name} <span class="font-s-14 new-gray">(${meal.total_calories})</span></p>
                </div>
            `;
        }
        function checkedFood() {
            this.classList.toggle('activeFood');
        }
        function appendFoodItems(array, container) {
            container.innerHTML = '';
            for (const key in array) {
                if (array.hasOwnProperty(key)) {
                    const item = array[key];
                    const foodDiv = document.createElement('div');
                    foodDiv.classList.add('d-flex', 'align-items-center', 'gap-15', 'px-3', 'py-2', 'radius-5', 'cursor-pointer', 'foodsTypes');
                    foodDiv.dataset.value = item;
                    foodDiv.onclick = function() {
                        checkedFood.call(this);
                    };
                    const img = document.createElement('img');
                    img.src = `{{ asset('images/meals_images/${key}.png') }}`;
                    img.alt = `${item} image`;
                    img.height = 20;
                    img.width = 20;
                    const p = document.createElement('p');
                    p.textContent = item;
                    foodDiv.appendChild(img);
                    foodDiv.appendChild(p);
                    container.appendChild(foodDiv);
                }
            }
        }
        function checkMeal(wantMealsInputValue) {
            let proteinArray, carbsArray, fatsArray, fruitsArray, vegetablesArray, dairyArray, zain;
            if(wantMealsInputValue == "anything"){
                proteinArray = {
                    "ic_chicken": "Chicken",
                    "ic_beef": "Beef",
                    "ic_fish": "Fish",
                    "ic_tuna": "Tuna",
                    "ic_egg_whole": "Egg - Whole",
                    "ic_turkey": "Turkey",
                    "ic_pork": "Pork",
                    "ic_ham": "Ham",
                    "ic_tofu": "Tofu",
                    "ic_soy": "Soy",
                    // "ic_meals": "Mutton",
                    "ic_tempeh": "Tempeh",
                    "ic_seitan": "Seitan",
                    "ic_protein_pwoder": "Protein Pwoder",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                };
                carbsArray = {
                    "ic_potato": "Potato",
                    "ic_beans": "Beans",
                    "ic_rice": "Rice",
                    "ic_corn": "Corns",
                    "ic_popcorn": "Popcorn",
                    "ic_chickpeas": "Chickpeas",
                    // "ic_green_beans": "Green Beans",
                    "ic_lentils": "Lentils",
                    "ic_bread": "Bread",
                    "ic_oats": "Oats",
                    "ic_pasta": "Pasta",
                    "ic_tortilla": "Tortilla",
                    "ic_cereal": "Cereal",
                    "ic_peas": "Peas",
                    "ic_sweet_potato": "Sweet Potatoes",
                    "ic_cassava": "Cassava",
                    // "ic_butternut_squash": "Butternut Squash",
                    "ic_quinoa": "Quinoa",
                    // "ic_cottage_cheese": "Cottage Cheese",
                };
                fatsArray = {
                    "ic_walnuts": "Walnuts",
                    "ic_almonds": "Almonds",
                    "ic_chocolate": "Chocolate",
                    "ic_avocado": "Avocado",
                    "ic_peanuts": "Peanuts",
                    "ic_peacans": "Peacans",
                    "ic_chia": "Chia",
                    "ic_olives": "Olives",
                    "ic_cashews": "Cashews",
                    // "ic_pumpkin_seeds": "Pumpkin Seeds",
                    // "ic_coconut_oil": "Coconut Oil",
                    // "ic_sausages": "Sausages",
                };
                fruitsArray = {
                    "ic_graps": "Graps",
                    "ic_orange": "Orange",
                    "ic_kiwi": "Kiwi",
                    "ic_apple": "Apple",
                    "ic_banana": "Banana",
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_mango": "Mango",
                    "ic_peach": "Peach",
                    "ic_pear": "Pear",
                    "ic_dragon_fruit": "Dragon Fruit",
                    "ic_papaya": "Papaya",
                    "ic_dates": "Dates",
                    "ic_blueberry": "Blueberries",
                    "ic_pineapple": "Pineapple",
                    // "ic_grenadia": "Grenadia",
                    // "ic_figs": "Figs",
                    "ic_tangerines": "Tangerines",
                    // "ic_lychee": "Lychee",
                    "ic_cantaloupe": "Cantaloupe",
                    // "ic_cherries": "Cherries",
                };
                vegetablesArray = {
                    "ic_onion": "Onion",
                    "ic_cabbage": "Cabbage",
                    "ic_cucumber": "Cucumber",
                    "ic_carrot": "Carrot",
                    "ic_tomato": "Tomato",
                    "ic_broccoli": "Broccoli",
                    "ic_basil": "Basil",
                    "ic_squash": "Squash",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_cauliflower": "Cauliflower",
                    "ic_bell_pepper": "Bell Pepper",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    "ic_chard": "Chard",
                    "ic_radish": "Radish",
                    "ic_beet": "Beet",
                    "ic_celery": "Celery",
                    "ic_eggplant": "Eggplant",
                    // "ic_pumpkin": "Pumpkin",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    // "ic_black_coffee": "Black Coffee",
                    "ic_soy_milk": "Soy Milk",
                    "ic_coconut_milk": "Coconut Milk",
                    "ic_white_sheese": "White Sheese",
                    "ic_almond_milk": "Almond Milk",
                    "ic_yogurt": "Yogurt",
                    "ic_milk": "Milk",
                    "ic_oat_milk": "Oat Milk",
                    // "ic_coconut_water": "Coconut Water",
                    // "ic_herbal_tea": "Herbal Tea",
                };
            }else if(wantMealsInputValue == "keto"){
                proteinArray = {
                    "ic_chicken": "Chicken",
                    "ic_beef": "Beef",
                    "ic_fish": "Fish",
                    "ic_tuna": "Tuna",
                    "ic_egg_whole": "Egg - Whole",
                    // "ic_egg_white": "Egg - White",
                    "ic_turkey": "Turkey",
                    "ic_pork": "Pork",
                    "ic_ham": "Ham",
                    "ic_tofu": "Tofu",
                    "ic_soy": "Soy",
                    "ic_tempeh": "Tempeh",
                    "ic_seitan": "Seitan",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                    // "ic_meals": "Mutton",
                };
                carbsArray = {
                    // "ic_green_beans": "Green Beans",
                    // "ic_cottage_cheese": "Cottage Cheese",
                };
                fatsArray = {
                    "ic_walnuts": "Walnuts",
                    "ic_almonds": "Almonds",
                    "ic_avocado": "Avocado",
                    "ic_peacans": "Peacans",
                    // "ic_chia_seeds": "Chia Seeds",
                    "ic_olives": "Olives",
                    // "ic_coconut_oil": "Coconut Oil",
                };
                fruitsArray = {
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_blueberry": "Blueberries",
                    // "ic_watermelon": "Raspberries",
                    // "ic_watermelon": "Blackberries",
                };
                vegetablesArray = {
                    "ic_onion": "Onion",
                    "ic_cabbage": "Cabbage",
                    "ic_cucumber": "Cucumber",
                    "ic_carrot": "Carrot",
                    "ic_tomato": "Tomato",
                    "ic_broccoli": "Broccoli",
                    "ic_basil": "Basil",
                    "ic_squash": "Squash",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_cauliflower": "Cauliflower",
                    "ic_bell_pepper": "Bell Pepper",
                    // "ic_turnip": "Turnip",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    "ic_chard": "Chard",
                    "ic_radish": "Radish",
                    "ic_celery": "Celery",
                    "ic_eggplant": "Eggplant",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    // "ic_black_coffee": "Black Coffee",
                    "ic_coconut_milk": "Coconut Milk",
                    "ic_white_sheese": "White Sheese",
                    "ic_almond_milk": "Almond Milk",
                    // "ic_coconut_water": "Coconut Water",
                    // "ic_herbal_tea": "Herbal Tea",
                };
            }else if(wantMealsInputValue == "vegetarian"){
                proteinArray = {
                    "ic_tofu": "Tofu",
                    "ic_soy": "Soy",
                    "ic_tempeh": "Tempeh",
                    "ic_seitan": "Seitan",
                    "ic_protein_pwoder": "Protein Pwoder",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                };
                carbsArray = {
                    "ic_potato": "Potato",
                    "ic_beans": "Beans",
                    "ic_rice": "Rice",
                    "ic_corn": "Corns",
                    "ic_popcorn": "Popcorn",
                    "ic_chickpeas": "Chickpeas",
                    // "ic_green_beans": "Green Beans",
                    "ic_lentils": "Lentils",
                    "ic_bread": "Bread",
                    "ic_oats": "Oats",
                    "ic_pasta": "Pasta",
                    "ic_tortilla": "Tortilla",
                    "ic_cereal": "Cereal",
                    "ic_peas": "Peas",
                    "ic_sweet_potato": "Sweet Potatoes",
                    "ic_cassava": "Cassava",
                    // "ic_butternut_squash": "Butternut Squash",
                    "ic_quinoa": "Quinoa",
                    // "ic_cottage_cheese": "Cottage Cheese",
                };
                fatsArray = {
                    "ic_walnuts": "Walnuts",
                    "ic_almonds": "Almonds",
                    "ic_chocolate": "Chocolate",
                    "ic_avocado": "Avocado",
                    "ic_peanuts": "Peanuts",
                    "ic_peacans": "Peacans",
                    "ic_chia": "Chia",
                    "ic_olives": "Olives",
                    "ic_cashews": "Cashews",
                    // "ic_pumpkin_seeds": "Pumpkin Seeds",
                    // "ic_coconut_oil": "Coconut Oil",
                };
                fruitsArray = {
                    "ic_graps": "Graps",
                    "ic_orange": "Orange",
                    "ic_kiwi": "Kiwi",
                    "ic_apple": "Apple",
                    "ic_banana": "Banana",
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_mango": "Mango",
                    "ic_peach": "Peach",
                    "ic_pear": "Pear",
                    "ic_dragon_fruit": "Dragon Fruit",
                    "ic_papaya": "Papaya",
                    "ic_dates": "Dates",
                    "ic_blueberry": "Blueberries",
                    "ic_pineapple": "Pineapple",
                    // "ic_grenadia": "Grenadia",
                    // "ic_figs": "Figs",
                    "ic_tangerines": "Tangerines",
                    // "ic_lychee": "Lychee",
                    "ic_cantaloupe": "Cantaloupe",
                    // "ic_cherries": "Cherries",
                };
                vegetablesArray = {
                    "ic_onion": "Onion",
                    "ic_cabbage": "Cabbage",
                    "ic_cucumber": "Cucumber",
                    "ic_carrot": "Carrot",
                    "ic_tomato": "Tomato",
                    "ic_broccoli": "Broccoli",
                    "ic_basil": "Basil",
                    "ic_squash": "Squash",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_cauliflower": "Cauliflower",
                    "ic_bell_pepper": "Bell Pepper",
                    // "ic_turnip": "Turnip",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    "ic_chard": "Chard",
                    "ic_radish": "Radish",
                    "ic_beet": "Beet",
                    "ic_celery": "Celery",
                    "ic_eggplant": "Eggplant",
                    // "ic_pumpkin": "Pumpkin",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    // "ic_black_coffee": "Black Coffee",
                    "ic_soy_milk": "Soy Milk",
                    "ic_coconut_milk": "Coconut Milk",
                    "ic_white_sheese": "White Sheese",
                    "ic_almond_milk": "Almond Milk",
                    "ic_yogurt": "Yogurt",
                    "ic_milk": "Milk",
                    "ic_oat_milk": "Oat Milk",
                    // "ic_coconut_water": "Coconut Water",
                    // "ic_herbal_tea": "Herbal Tea",
                };
            }else if(wantMealsInputValue == "vegan"){
                proteinArray = {
                    "ic_tofu": "Tofu",
                    "ic_soy": "Soy",
                    "ic_tempeh": "Tempeh",
                    "ic_seitan": "Seitan",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                };
                carbsArray = {
                    "ic_potato": "Potato",
                    "ic_beans": "Beans",
                    "ic_rice": "Rice",
                    "ic_corn": "Corns",
                    "ic_popcorn": "Popcorn",
                    "ic_chickpeas": "Chickpeas",
                    // "ic_green_beans": "Green Beans",
                    "ic_lentils": "Lentils",
                    "ic_bread": "Bread",
                    "ic_oats": "Oats",
                    "ic_pasta": "Pasta",
                    "ic_tortilla": "Tortilla",
                    "ic_cereal": "Cereal",
                    "ic_peas": "Peas",
                    "ic_sweet_potato": "Sweet Potatoes",
                    "ic_cassava": "Cassava",
                    // "ic_butternut_squash": "Butternut Squash",
                    "ic_quinoa": "Quinoa",
                };
                fatsArray = {
                    "ic_walnuts": "Walnuts",
                    "ic_almonds": "Almonds",
                    "ic_avocado": "Avocado",
                    "ic_chia": "Chia",
                    "ic_olives": "Olives",
                    // "ic_pumpkin_seeds": "Pumpkin Seeds",
                };
                fruitsArray = {
                    "ic_graps": "Graps",
                    "ic_orange": "Orange",
                    "ic_kiwi": "Kiwi",
                    "ic_apple": "Apple",
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_mango": "Mango",
                    "ic_peach": "Peach",
                    "ic_pear": "Pear",
                    "ic_dragon_fruit": "Dragon Fruit",
                    "ic_papaya": "Papaya",
                    "ic_dates": "Dates",
                    "ic_blueberry": "Blueberries",
                    "ic_pineapple": "Pineapple",
                    // "ic_figs": "Figs",
                    "ic_tangerines": "Tangerines",
                    // "ic_lychee": "Lychee",
                    "ic_cantaloupe": "Cantaloupe",
                    // "ic_cherries": "Cherries",
                };
                vegetablesArray = {
                    "ic_onion": "Onion",
                    "ic_cabbage": "Cabbage",
                    "ic_cucumber": "Cucumber",
                    "ic_carrot": "Carrot",
                    "ic_tomato": "Tomato",
                    "ic_broccoli": "Broccoli",
                    "ic_basil": "Basil",
                    "ic_squash": "Squash",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_cauliflower": "Cauliflower",
                    "ic_bell_pepper": "Bell Pepper",
                    "ic_turnip": "Turnip",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    "ic_chard": "Chard",
                    "ic_radish": "Radish",
                    "ic_beet": "Beet",
                    "ic_celery": "Celery",
                    "ic_eggplant": "Eggplant",
                    // "ic_pumpkin": "Pumpkin",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    // "ic_black_coffee": "Black Coffee",
                    "ic_soy_milk": "Soy Milk",
                    "ic_coconut_milk": "Coconut Milk",
                    "ic_almond_milk": "Almond Milk",
                    "ic_oat_milk": "Oat Milk",
                    // "ic_coconut_water": "Coconut Water",
                    // "ic_herbal_tea": "Herbal Tea",
                };
            }else if(wantMealsInputValue == "vegetarian"){
                proteinArray = {
                    "ic_tofu": "Tofu",
                    "ic_soy": "Soy",
                    "ic_tempeh": "Tempeh",
                    "ic_seitan": "Seitan",
                    "ic_protein_pwoder": "Protein Pwoder",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                };
                carbsArray = {      
                    "ic_potato": "Potato",
                    "ic_beans": "Beans",
                    "ic_rice": "Rice",
                    "ic_corn": "Corns",
                    "ic_popcorn": "Popcorn",
                    "ic_chickpeas": "Chickpeas",
                    // "ic_green_beans": "Green Beans",
                    "ic_lentils": "Lentils",
                    "ic_bread": "Bread",
                    "ic_oats": "Oats",
                    "ic_pasta": "Pasta",
                    "ic_tortilla": "Tortilla",
                    "ic_cereal": "Cereal",
                    "ic_peas": "Peas",
                    "ic_sweet_potato": "Sweet Potatoes",
                    "ic_cassava": "Cassava",
                    // "ic_butternut_squash": "Butternut Squash",
                    "ic_quinoa": "Quinoa",
                    // "ic_cottage_cheese": "Cottage Cheese",
                };
                fatsArray = {
                    "ic_walnuts": "Walnuts",
                    "ic_almonds": "Almonds",
                    "ic_chocolate": "Chocolate",
                    "ic_avocado": "Avocado",
                    "ic_peanuts": "Peanuts",
                    "ic_peacans": "Peacans",
                    "ic_chia": "Chia",
                    "ic_olives": "Olives",
                    "ic_cashews": "Cashews",
                    // "ic_pumpkin_seeds": "Pumpkin Seeds",
                    // "ic_coconut_oil": "Coconut Oil",
                    // "ic_sausages": "Sausages",
                };
                fruitsArray = {
                    "ic_graps": "Graps",
                    "ic_orange": "Orange",
                    "ic_kiwi": "Kiwi",
                    "ic_apple": "Apple",
                    "ic_banana": "Banana",
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_mango": "Mango",
                    "ic_peach": "Peach",
                    "ic_pear": "Pear",
                    "ic_dragon_fruit": "Dragon Fruit",
                    "ic_papaya": "Papaya",
                    "ic_dates": "Dates",
                    "ic_blueberry": "Blueberries",
                    "ic_pineapple": "Pineapple",
                    // "ic_grenadia": "Grenadia",
                    // "ic_figs": "Figs",
                    "ic_tangerines": "Tangerines",
                    // "ic_lychee": "Lychee",
                    "ic_cantaloupe": "Cantaloupe",
                    // "ic_cherries": "Cherries",
                };
                vegetablesArray = {
                    "ic_onion": "Onion",
                    "ic_cabbage": "Cabbage",
                    "ic_cucumber": "Cucumber",
                    "ic_carrot": "Carrot",
                    "ic_tomato": "Tomato",
                    "ic_broccoli": "Broccoli",
                    "ic_basil": "Basil",
                    "ic_squash": "Squash",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_cauliflower": "Cauliflower",
                    "ic_bell_pepper": "Bell Pepper",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    "ic_chard": "Chard",
                    "ic_radish": "Radish",
                    "ic_beet": "Beet",
                    "ic_celery": "Celery",
                    "ic_eggplant": "Eggplant",
                    // "ic_pumpkin": "Pumpkin",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    // "ic_black_coffee": "Black Coffee",
                    "ic_soy_milk": "Soy Milk",
                    "ic_coconut_milk": "Coconut Milk",
                    "ic_white_sheese": "White Sheese",
                    "ic_almond_milk": "Almond Milk",
                    "ic_yogurt": "Yogurt",
                    "ic_milk": "Milk",
                    "ic_oat_milk": "Oat Milk",
                    // "ic_coconut_water": "Coconut Water",
                    // "ic_herbal_tea": "Herbal Tea",
                };
            }else if(wantMealsInputValue == "paleo"){
                proteinArray = {
                    "ic_chicken": "Chicken",
                    "ic_beef": "Beef",
                    "ic_fish": "Fish",
                    "ic_tuna": "Tuna",
                    "ic_egg_whole": "Egg - Whole",
                    "ic_turkey": "Turkey",
                    "ic_pork": "Pork",
                    "ic_ham": "Ham",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                };
                carbsArray = {
                    "ic_sweet_potato": "Sweet Potatoes",
                    // "ic_butternut_squash": "Butternut Squash",
                    "ic_corn": "Corns",
                    "ic_oats": "Oats",
                    "ic_quinoa": "Quinoa",
                };
                fatsArray = {
                    "ic_walnuts": "Walnuts",
                    "ic_almonds": "Almonds",
                    "ic_chocolate": "Chocolate",
                    "ic_avocado": "Avocado",
                    "ic_peacans": "Peacans",
                    "ic_chia": "Chia",
                    "ic_olives": "Olives",
                    "ic_cashews": "Cashews",
                    // "ic_pumpkin_seeds": "Pumpkin Seeds",
                };
                fruitsArray = {
                    "ic_graps": "Graps",
                    "ic_orange": "Orange",
                    "ic_kiwi": "Kiwi",
                    "ic_apple": "Apple",
                    "ic_banana": "Banana",
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_mango": "Mango",
                    "ic_peach": "Peach",
                    "ic_pear": "Pear",
                    "ic_dates": "Dates",
                    "ic_blueberry": "Blueberries",
                    "ic_pineapple": "Pineapple",
                    // "ic_figs": "Figs",
                    "ic_tangerines": "Tangerines",
                    "ic_cantaloupe": "Cantaloupe",
                    // "ic_cherries": "Cherries",
                };
                vegetablesArray = {
                    "ic_onion": "Onion",
                    "ic_cabbage": "Cabbage",
                    "ic_cucumber": "Cucumber",
                    "ic_carrot": "Carrot",
                    "ic_tomato": "Tomato",
                    "ic_broccoli": "Broccoli",
                    "ic_basil": "Basil",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_cauliflower": "Cauliflower",
                    "ic_bell_pepper": "Bell Pepper",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    // "ic_black_coffee": "Black Coffee",
                    "ic_coconut_milk": "Coconut Milk",
                    "ic_almond_milk": "Almond Milk",
                    // "ic_herbal_tea": "Herbal Tea",
                };
            }else if(wantMealsInputValue == "mediterranean"){
                proteinArray = {
                    "ic_chicken": "Chicken",
                    "ic_fish": "Fish",
                    "ic_tuna": "Tuna",
                    "ic_egg_whole": "Egg - Whole",
                    "ic_turkey": "Turkey",
                    "ic_pork": "Pork",
                    "ic_tofu": "Tofu",
                    // "ic_nuts_seeds": "Nuts and Seeds",
                };
                carbsArray = {
                    "ic_beans": "Beans",
                    "ic_chickpeas": "Chickpeas",
                    // "ic_green_beans": "Green Beans",
                    "ic_lentils": "Lentils",
                    "ic_oats": "Oats",
                    "ic_pasta": "Pasta",
                    "ic_peas": "Peas",
                    "ic_quinoa": "Quinoa",
                };
                fatsArray = {
                    "ic_olives": "Olives",
                };
                fruitsArray = {
                    "ic_graps": "Graps",
                    "ic_orange": "Orange",
                    "ic_kiwi": "Kiwi",
                    "ic_apple": "Apple",
                    "ic_strawberries": "Strawberries",
                    "ic_watermelon": "Watermelon",
                    "ic_mango": "Mango",
                    "ic_peach": "Peach",
                    "ic_pear": "Pear",
                    "ic_dates": "Dates",
                    "ic_blueberry": "Blueberries",
                    "ic_pineapple": "Pineapple",
                    // "ic_figs": "Figs",
                    "ic_tangerines": "Tangerines",
                    "ic_cantaloupe": "Cantaloupe",
                    // "ic_cherries": "Cherries",
                };
                vegetablesArray = {
                    "ic_tomato": "Tomato",
                    "ic_basil": "Basil",
                    "ic_spinach": "Spinach",
                    "ic_lettuce": "Lettuce",
                    "ic_bell_pepper": "Bell Pepper",
                    "ic_mushrooms": "Mushrooms",
                    "ic_zucchini": "Zucchini",
                    // "ic_garlic": "Garlic",
                    "ic_asparagus": "Asparagus",
                };
                dairyArray = {
                    "ic_yogurt": "Yogurt",
                    // "ic_herbal_tea": "Herbal Tea",
                    "ic_milk": "Milk",
                    "ic_white_sheese": "White Sheese",
                };
            }
            const proteinContainer = document.querySelector('#proteinContainer');
            const carbsContainer = document.querySelector('#carbsContainer');
            const fatsContainer = document.querySelector('#fatsContainer');
            const fruitsContainer = document.querySelector('#fruitsContainer');
            const vegetablesContainer = document.querySelector('#vegetablesContainer');
            const dairyContainer = document.querySelector('#dairyContainer');
            appendFoodItems(proteinArray, proteinContainer);
            appendFoodItems(carbsArray, carbsContainer);
            appendFoodItems(fatsArray, fatsContainer);
            appendFoodItems(fruitsArray, fruitsContainer);
            appendFoodItems(vegetablesArray, vegetablesContainer);
            appendFoodItems(dairyArray, dairyContainer);
        }
        function allMealsDownload(button) {
            const allMealsDownloadSection = document.getElementById('allMealsDownloadSection');
            allMealsDownloadSection.classList.remove("hidden");
            const mealsData = document.getElementById('downloadBtn').getAttribute('data-meals');
            const allMeals = JSON.parse(mealsData);
            button.disabled = true;
            button.innerText = 'Downloading...';
            let previewContent = '';

            // Loop through each day
            Object.keys(allMeals).forEach(dayKey => {
                const mealsArray = allMeals[dayKey];
                previewContent += `
                    <div class="page-break">
                        <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #E6E6E6">
                            <p><b class="font-s-20 text-blue">${dayKey}</b></p>
                        </div>`;

                Object.keys(mealsArray).forEach((mealType, index) => {
                    const mealDetails = mealsArray[mealType];
                    previewContent += `<p class="font-s-18 ${index !== 0 ? 'mt-4' : ''}"><b>${mealType.charAt(0).toUpperCase() + mealType.slice(1)}</b></p>`;
                    mealDetails.forEach((meal, mealIndex) => {
                        let uniqueID = `chart_${dayKey}_${mealType}_${mealIndex}`;
                        previewContent +=  `
                            <p class="font-s-18 mb-2"><b>${meal.meal_name}</b></p>
                            <div class="row font-s-12">
                                <p class="col-12 font-s-12 new-gray">🍳 Preparation Time: ${meal.meal_time} and 🍽️ Cook Time: ${meal.cook_time}</p>
                                <div class="col-lg-6 col-12 pe-lg-3">
                                    <div class="col-12 ingredientDetails mt-2">
                                        <p><b class="font-s-16 text-blue">Ingredients</b></p>
                                        <div class="col-12">
                                            ${meal.ingredients.map(ingredient => `
                                                <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                                    <p>${ingredient.name}</p>
                                                    <p>${ingredient.quantity} / ${ingredient.calories}</p>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                    <div class="col-12 recipeDetail mt-2">
                                        <p><b class="font-s-16 text-blue">Making</b></p>
                                        <p class="mt-1 font-s-12">${meal.meal_recipe}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 ps-lg-3">
                                    <div class="col-12 recipeDetail mt-2">
                                        <p><b class="font-s-16 text-blue">Details</b></p>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="ids_remove" id="${uniqueID}" style="width:180px;height:180px"></div>
                                        </div>
                                        <div class="col-12 popupDetails">
                                            <div class="d-flex align-items-center justify-content-between border_btm pb-2">
                                                <p>Carbs</p>
                                                <p>${meal.carbs}</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                                <p>Fat</p>
                                                <p>${meal.fat}</p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between border_btm py-2">
                                                <p>Protein</p>
                                                <p>${meal.protein}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                });
                previewContent += '</div>';
            });

            allMealsDownloadSection.innerHTML = previewContent;

            // Function to render charts
            function renderCharts() {
                return new Promise((resolve) => {
                    Object.keys(allMeals).forEach(dayKey => {
                        const mealsArray = allMeals[dayKey];
                        Object.keys(mealsArray).forEach(mealType => {
                            const mealDetails = mealsArray[mealType];
                            mealDetails.forEach((meal, mealIndex) => {
                                let uniqueID = `chart_${dayKey}_${mealType}_${mealIndex}`;
                                var totalDetails = parseFloat(meal.carbs) + parseFloat(meal.fat) + parseFloat(meal.protein);
                                var carbsPercentage = (parseFloat(meal.carbs) / totalDetails) * 100;
                                var fatPercentage = (parseFloat(meal.fat) / totalDetails) * 100;
                                var proteinPercentage = (parseFloat(meal.protein) / totalDetails) * 100;
                                
                                // Ensure container exists
                                var container = document.getElementById(uniqueID);
                                if (container) {
                                    var chart = new CanvasJS.Chart(uniqueID, {
                                        theme: "light2",
                                        animationEnabled: true,
                                        height: 180,
                                        width: 180,
                                        data: [{
                                            type: "pie",
                                            indexLabel: "{y}",
                                            yValueFormatString: "#,##0.00\"%\"",
                                            indexLabelPlacement: "inside",
                                            indexLabelFontColor: "#FFFFFF",
                                            indexLabelFontSize: 10,
                                            legendText: "{label}",
                                            dataPoints: [
                                                { y: proteinPercentage, label: "Protein", color: "#F8AD3E" },
                                                { y: fatPercentage, label: "Fat", color: "#6F3535" },
                                                { y: carbsPercentage, label: "Carbs", color: "#1670A7" }
                                            ]
                                        }]
                                    });
                                    chart.render();
                                } else {
                                    console.error(`Container with ID ${uniqueID} not found.`);
                                }
                            });
                        });
                    });

                    // Wait for a short time to ensure charts are fully rendered
                    setTimeout(() => resolve(), 2000);
                });
            }

            renderCharts().then(() => {
                setTimeout(() => {
                    var n = document.querySelector('#allMealsDownloadSection');
                    html2pdf().from(n).set({
                        margin: [15, 5, 5, 5],
                        filename: `Meals_Details_7_Days.pdf`,
                        image: {
                            type: "jpeg",
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2,
                            logging: !0,
                            dpi: 192,
                            letterRendering: !0,
                        },
                        jsPDF: {
                            unit: "mm",
                            format: "a4",
                            orientation: "p"
                        },
                        pagebreak: {
                            before: ".page-break",
                            avoid: "table"
                        },
                    }).toPdf().get("pdf").then(function(e) {
                        var t = e.internal.getNumberOfPages();
                        for (let pageNumber = 1; pageNumber <= t; pageNumber++) {
                            e.setPage(pageNumber);
                            e.setFontSize(8);
                            e.setTextColor(150);
                            e.text(15, 15, "Results from");
                            e.setTextColor(0, 0, 255);
                            e.textWithLink(" technical-calculator", 31, 15, {
                                url: "https://technical-calculator/"
                            });
                            var allMathText = "technical-calculator " + pageNumber + "/" + t;
                            var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                            e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                                url: "https://technical-calculator/"
                            });
                        }
                        allMealsDownloadSection.classList.add("hidden");
                        button.disabled = false;
                        button.innerText = 'Download All';
                    }).save().catch((e) => {
                        console.error(e);
                    });
                }, 5000); // Adjust the delay if needed
            });
        }
        function generateMealHTML(mealType, meals) {
            let html = `<p class="mt-2"><b>${mealType}</b></p>`;
            meals.forEach(meal => {
                html += `<p class="font-s-16 mt-2"><b>${meal.meal_name}</b></p>`;
                html += `<p class="font-s-16 mt-2">Ingredients</p>`;
                html += '<div class="col-12 ingredientDetails font-s-14">';
                meal.ingredients.forEach(ingredient => {
                    html += `
                        <div class="d-flex align-items-center justify-content-between mt-2 border_btm pb-1">
                            <p>${ingredient.name}</p>
                            <p>${ingredient.quantity} / ${ingredient.calories} kcal</p>
                        </div>
                    `;
                });
                html += `</div>`;
                html += `<p class="font-s-16 mt-2">Making</p>`;
                html += `<div class="col-12 mt-2">
                            <p class="font-s-14" style="line-height: 1.7;">${meal.meal_recipe}</p>
                        </div>`;
            });

            return html;
        }
        document.getElementById('nextBtn_1').addEventListener('click', function() {
            document.getElementById('want_meals').classList.add("hidden");
            document.getElementById('food_like').classList.remove("hidden");
            let wantMealsInput = document.getElementById('diet_type').value;
            checkMeal(wantMealsInput);
        });
        document.getElementById('backBtn_1').addEventListener('click', function() {
            document.getElementById('want_meals').classList.remove("hidden");
            document.getElementById('final_download').classList.add("hidden");
            document.getElementById('food_like').classList.add("hidden");
        });
        document.getElementById('backBtn_2').addEventListener('click', function() {
            document.getElementById('want_meals').classList.add("hidden");
            document.getElementById('final_download').classList.add("hidden");
            document.getElementById('food_like').classList.remove("hidden");
        });
        document.getElementById('nextBtn_2').addEventListener('click', function() {
            document.getElementById('want_meals').classList.add("hidden");
            document.getElementById('food_like').classList.add("hidden");
            document.getElementById('loading').classList.remove("hidden");
            initializeTimer();
            const activeFoods = Array.from(document.querySelectorAll('.foodsTypes.activeFood'))
                .map(element => element.getAttribute('data-value'))
                .join(', ');

            let dietType = document.getElementById('diet_type').value;
            let meals_per_day = document.getElementById('meals_per_day').value;
            let eat_calories = document.getElementById('eat_calories').value;
            // let goal = document.getElementById('goal').value;
            const csrfToken = document.getElementById('csrf_token').value;
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('activeFoods', activeFoods);
            formData.append('dietType', dietType);
            formData.append('meals_per_day', meals_per_day);
            formData.append('eat_calories', eat_calories);
            formData.append('check_days', "day_1");
            // formData.append('goal', goal);
            fetch('{{ route('mealPlanner') }}/', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading').classList.add("hidden");
                document.getElementById('final_download').classList.remove("hidden");
                const days = Object.keys(data.response);
                let colonImg = document.getElementById('colon_img');
                let totalCaloriesFirstDay = 0;
                let totalCarbsFirstDay = 0;
                let totalFatFirstDay = 0;
                let totalProtienFirstDay = 0;
                let totalCarbsAllDays = 0;
                let totalFatAllDays = 0;
                let totalProtienAllDays = 0;
                let totalCaloriesAllDays = 0;
                days.forEach((day, index) => {
                    const meals = data.response[day];
    
                    // Create a container div for the entire day
                    let dayContainer = document.createElement('div');
                    dayContainer.id = day;
                    dayContainer.className = 'dayContainer p-lg-3 p-2 bg-white radius-10';
                    
                    // Create a heading for the day with the updated structure
                    let new_dayHeading = document.createElement('div');
                    new_dayHeading.className = 'd-flex align-items-center justify-content-between';
                    
                    
                    let dayHeadingContainer = document.createElement('div');
                    dayHeadingContainer.className = 'dayHeading d-flex align-items-center gap-10';
    
                    let dayHeadingText = document.createElement('p');
                    dayHeadingText.innerHTML = `<strong class="font-s-16 text-blue">Day ${index + 1}</strong>`;
                    dayHeadingContainer.appendChild(dayHeadingText);
    
                    let nutritionInfo = document.createElement('p');
                    nutritionInfo.className = 'd-flex align-items-center gap-5 mt-1';
    
                    let caloriesSpan = document.createElement('span');
                    caloriesSpan.className = 'new-gray font-s-14 daysCal';
                    nutritionInfo.appendChild(caloriesSpan);
    
                    let caloriesTooltipImg = document.createElement('img');
                    caloriesTooltipImg.loading = 'eager';
                    caloriesTooltipImg.decoding = 'async';
                    caloriesTooltipImg.src = '{{ asset("images/meals_images/cal_tool.png") }}';
                    caloriesTooltipImg.alt = 'calories tooltip';
                    caloriesTooltipImg.height = 15;
                    caloriesTooltipImg.width = 15;
                    caloriesTooltipImg.className = 'cursor-pointer colon_img';
                    caloriesTooltipImg.onclick = () => caloriesDetails(caloriesTooltipImg);
                    nutritionInfo.appendChild(caloriesTooltipImg);
    
                    dayHeadingContainer.appendChild(nutritionInfo);
                    new_dayHeading.appendChild(dayHeadingContainer);
    
                    let new_pre_down = document.createElement('div');
                    new_pre_down.className = 'd-flex align-items-center gap-10 mt-lg-0 mt-2';
                    let newBTns = `
                        <div class="d-flex align-items-center justify-content-center gap-5 bg-light-blue radius-10 cursor-pointer previewBox checkBtns" data-day="Day ${index + 1}" data-meals='${JSON.stringify(meals).replace(/'/g, "&quot;")}' onclick="new_mealsPreview(this)">
                            <img loading="lazy" decoding="async" src="{{ asset('images/meals_images/preview.png') }}" alt="preview" height="10px" width="14px">
                            <p class="white-nowrap">Preview</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-5 bg-light-blue radius-10 cursor-pointer checkBtns" data-day="Day ${index + 1}" data-meals='${JSON.stringify(meals).replace(/'/g, "&quot;")}' onclick="previewDownload(this)">
                            <img loading="lazy" decoding="async" src="{{ asset('images/meals_images/black_download.png') }}" alt="download" height="14px" width="14px">
                            <p class="white-nowrap">Download</p>
                        </div>
                    `;
                    new_pre_down.innerHTML = newBTns;  // Use innerHTML to insert the content
                    new_dayHeading.appendChild(new_pre_down);
    
    
    
                    dayContainer.appendChild(new_dayHeading);
    
                    // Append the day container to the main container (e.g., 'all_meals')
                    document.getElementById('all_meals').appendChild(dayContainer);
    
                    // Initialize daily totals
                    let dailyTotalCalories = 0;
                    let dailyTotalCarbs = 0;
                    let dailyTotalFat = 0;
                    let dailyTotalProtein = 0;
                    Object.keys(meals).forEach(mealType => {
    
                        let mealTypeContainer = document.createElement('div');
                        mealTypeContainer.id = `${day}_${mealType}_details`;
                        mealTypeContainer.className = 'mealTypeContainer';
    
                        // Create a heading for the meal type (e.g., Breakfast, Snack)
                        let mealTypeHeading = document.createElement('p');
                        mealTypeHeading.className = 'mealTypeHeading';
                        let checkMealName = `${mealType.charAt(0).toUpperCase() + mealType.slice(1)}`;
                        mealTypeHeading.textContent = checkMealName;
                        mealTypeContainer.appendChild(mealTypeHeading);
    
                        // Append the meal type container to the day's container
                        dayContainer.appendChild(mealTypeContainer);
    
                        // Step 3: Render the meal details in the meal type container
                        renderMeals(meals[mealType], `${day}_${mealType}_details`, checkMealName);
    
                        // Calculate totals for each meal type
                        let mealTypeTotalCalories = 0;
                        let mealTypeTotalCarbs = 0;
                        let mealTypeTotalFat = 0;
                        let mealTypeTotalProtein = 0;
    
                        meals[mealType].forEach(meal => {
                            let calories = parseInt(meal.total_calories.replace(/\D/g, ''));
                            mealTypeTotalCalories += calories;
                            let carbs = parseInt(meal.carbs.replace(/\D/g, ''));
                            mealTypeTotalCarbs += carbs;
                            let fat = parseInt(meal.fat.replace(/\D/g, ''));
                            mealTypeTotalFat += fat;
                            let protein = parseInt(meal.protein.replace(/\D/g, ''));
                            mealTypeTotalProtein += protein;
    
                            totalCaloriesAllDays += parseInt(meal.total_calories.replace('g', ''));
                            totalCarbsAllDays += parseInt(meal.carbs.replace('g', ''));
                            totalFatAllDays += parseInt(meal.fat.replace('g', ''));
                            totalProtienAllDays += parseInt(meal.protein.replace('g', ''));
                        });
    
                        // Update daily totals
                        dailyTotalCalories += mealTypeTotalCalories;
                        dailyTotalCarbs += mealTypeTotalCarbs;
                        dailyTotalFat += mealTypeTotalFat;
                        dailyTotalProtein += mealTypeTotalProtein;
                    });
    
                    // Update the calories display after calculation
                    caloriesSpan.innerHTML = `${dailyTotalCalories} kcal`;
    
                    // Update the tooltip image attributes for the day
                    caloriesTooltipImg.setAttribute('data-carbs', dailyTotalCarbs);
                    caloriesTooltipImg.setAttribute('data-fat', dailyTotalFat);
                    caloriesTooltipImg.setAttribute('data-protein', dailyTotalProtein);
                    caloriesTooltipImg.setAttribute('data-calories', dailyTotalCalories);
                });
                document.getElementById('eat_cal').textContent = totalCaloriesAllDays + ' kcal';
                document.getElementById('colon_img').setAttribute('data-calories', totalCaloriesAllDays);
                document.getElementById('colon_img').setAttribute('data-carbs', totalCarbsAllDays);
                document.getElementById('colon_img').setAttribute('data-fat', totalFatAllDays);
                document.getElementById('colon_img').setAttribute('data-protein', totalProtienAllDays);
                document.getElementById('downloadBtn').setAttribute('data-meals', JSON.stringify(data.response));
            })
            .catch(error => {
                console.error('Error:', error);
            });
        })
        document.getElementById('add_more_days').addEventListener('click', function() {
            document.getElementById('new_loading').classList.replace("hidden","d-flex");
            document.getElementById('add_more_days').disabled = true;
            new_initializeTimer();
            var dataValue = this.getAttribute('data-value');
            const activeFoods = Array.from(document.querySelectorAll('.foodsTypes.activeFood'))
                .map(element => element.getAttribute('data-value'))
                .join(', ');
            let dietType = document.getElementById('diet_type').value;
            let meals_per_day = document.getElementById('meals_per_day').value;
            let eat_calories = document.getElementById('eat_calories').value;
            const csrfToken = document.getElementById('csrf_token').value;
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('activeFoods', activeFoods);
            formData.append('dietType', dietType);
            formData.append('meals_per_day', meals_per_day);
            formData.append('eat_calories', eat_calories);
            formData.append('check_days', dataValue);
            // formData.append('goal', goal);
            fetch('{{ route('mealPlanner') }}/', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('new_loading').classList.replace("d-flex","hidden");
                const days = Object.keys(data.response);
                let colonImg = document.getElementById('colon_img');
                let totalCaloriesFirstDay = 0;
                let totalCarbsFirstDay = 0;
                let totalFatFirstDay = 0;
                let totalProtienFirstDay = 0;
                let totalCarbsAllDays = 0;
                let totalFatAllDays = 0;
                let totalProtienAllDays = 0;
                let totalCaloriesAllDays = 0;
                let dayNumber = parseInt(dataValue.split('_')[1]);
                let new_dayNumber = parseInt(dataValue.split('_')[1]);
                days.forEach((day, index) => {
                    const meals = data.response[day];
    
                    // Create a container div for the entire day
                    let dayContainer = document.createElement('div');
                    dayContainer.id = day;
                    dayContainer.className = 'dayContainer p-lg-3 p-2 bg-white radius-10 mt-3';
                    
                    // Create a heading for the day with the updated structure
                    let new_dayHeading = document.createElement('div');
                    new_dayHeading.className = 'd-flex align-items-center justify-content-between';
                    
                    
                    let dayHeadingContainer = document.createElement('div');
                    dayHeadingContainer.className = 'dayHeading d-flex align-items-center gap-10';
    
                    let dayHeadingText = document.createElement('p');
                    dayHeadingText.innerHTML = `<strong class="font-s-16 text-blue">Day ${dayNumber}</strong>`;
                    dayHeadingContainer.appendChild(dayHeadingText);
    
                    let nutritionInfo = document.createElement('p');
                    nutritionInfo.className = 'd-flex align-items-center gap-5 mt-1';
    
                    let caloriesSpan = document.createElement('span');
                    caloriesSpan.className = 'new-gray font-s-14 daysCal';
                    nutritionInfo.appendChild(caloriesSpan);
    
                    let caloriesTooltipImg = document.createElement('img');
                    caloriesTooltipImg.loading = 'eager';
                    caloriesTooltipImg.decoding = 'async';
                    caloriesTooltipImg.src = '{{ asset("images/meals_images/cal_tool.png") }}';
                    caloriesTooltipImg.alt = 'calories tooltip';
                    caloriesTooltipImg.height = 15;
                    caloriesTooltipImg.width = 15;
                    caloriesTooltipImg.className = 'cursor-pointer colon_img';
                    caloriesTooltipImg.onclick = () => caloriesDetails(caloriesTooltipImg);
                    nutritionInfo.appendChild(caloriesTooltipImg);
    
                    dayHeadingContainer.appendChild(nutritionInfo);
                    new_dayHeading.appendChild(dayHeadingContainer);
    
                    let new_pre_down = document.createElement('div');
                    new_pre_down.className = 'd-flex align-items-center gap-10 mt-lg-0 mt-2';
                    let newBTns = `
                        <div class="d-flex align-items-center justify-content-center gap-5 bg-light-blue radius-10 cursor-pointer previewBox checkBtns" data-day="Day ${new_dayNumber++}" data-meals='${JSON.stringify(meals).replace(/'/g, "&quot;")}' onclick="new_mealsPreview(this)">
                            <img loading="lazy" decoding="async" src="{{ asset('images/meals_images/preview.png') }}" alt="preview" height="10px" width="14px">
                            <p class="white-nowrap">Preview</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-5 bg-light-blue radius-10 cursor-pointer checkBtns" data-day="Day ${new_dayNumber++}" data-meals='${JSON.stringify(meals).replace(/'/g, "&quot;")}' onclick="previewDownload(this)">
                            <img loading="lazy" decoding="async" src="{{ asset('images/meals_images/black_download.png') }}" alt="download" height="14px" width="14px">
                            <p class="white-nowrap">Download</p>
                        </div>
                    `;
                    new_pre_down.innerHTML = newBTns;  // Use innerHTML to insert the content
                    new_dayHeading.appendChild(new_pre_down);
    
    
    
                    dayContainer.appendChild(new_dayHeading);
    
                    // Append the day container to the main container (e.g., 'all_meals')
                    document.getElementById('all_meals').appendChild(dayContainer);
    
                    // Initialize daily totals
                    let dailyTotalCalories = 0;
                    let dailyTotalCarbs = 0;
                    let dailyTotalFat = 0;
                    let dailyTotalProtein = 0;
                    Object.keys(meals).forEach(mealType => {
    
                        let mealTypeContainer = document.createElement('div');
                        mealTypeContainer.id = `${day}_${mealType}_details`;
                        mealTypeContainer.className = 'mealTypeContainer';
    
                        // Create a heading for the meal type (e.g., Breakfast, Snack)
                        let mealTypeHeading = document.createElement('p');
                        mealTypeHeading.className = 'mealTypeHeading';
                        let checkMealName = `${mealType.charAt(0).toUpperCase() + mealType.slice(1)}`;
                        mealTypeHeading.textContent = checkMealName;
                        mealTypeContainer.appendChild(mealTypeHeading);
    
                        // Append the meal type container to the day's container
                        dayContainer.appendChild(mealTypeContainer);
    
                        // Step 3: Render the meal details in the meal type container
                        renderMeals(meals[mealType], `${day}_${mealType}_details`, checkMealName);
    
                        // Calculate totals for each meal type
                        let mealTypeTotalCalories = 0;
                        let mealTypeTotalCarbs = 0;
                        let mealTypeTotalFat = 0;
                        let mealTypeTotalProtein = 0;
    
                        meals[mealType].forEach(meal => {
                            let calories = parseInt(meal.total_calories.replace(/\D/g, ''));
                            mealTypeTotalCalories += calories;
                            let carbs = parseInt(meal.carbs.replace(/\D/g, ''));
                            mealTypeTotalCarbs += carbs;
                            let fat = parseInt(meal.fat.replace(/\D/g, ''));
                            mealTypeTotalFat += fat;
                            let protein = parseInt(meal.protein.replace(/\D/g, ''));
                            mealTypeTotalProtein += protein;
    
                            totalCaloriesAllDays += parseInt(meal.total_calories.replace('g', ''));
                            totalCarbsAllDays += parseInt(meal.carbs.replace('g', ''));
                            totalFatAllDays += parseInt(meal.fat.replace('g', ''));
                            totalProtienAllDays += parseInt(meal.protein.replace('g', ''));
                        });
    
                        // Update daily totals
                        dailyTotalCalories += mealTypeTotalCalories;
                        dailyTotalCarbs += mealTypeTotalCarbs;
                        dailyTotalFat += mealTypeTotalFat;
                        dailyTotalProtein += mealTypeTotalProtein;
                    });
    
                    // Update the calories display after calculation
                    caloriesSpan.innerHTML = `${dailyTotalCalories} kcal`;
    
                    // Update the tooltip image attributes for the day
                    caloriesTooltipImg.setAttribute('data-carbs', dailyTotalCarbs);
                    caloriesTooltipImg.setAttribute('data-fat', dailyTotalFat);
                    caloriesTooltipImg.setAttribute('data-protein', dailyTotalProtein);
                    caloriesTooltipImg.setAttribute('data-calories', dailyTotalCalories);
                });
                document.getElementById('eat_cal').textContent = totalCaloriesAllDays + ' kcal';
                document.getElementById('colon_img').setAttribute('data-calories', totalCaloriesAllDays);
                document.getElementById('colon_img').setAttribute('data-carbs', totalCarbsAllDays);
                document.getElementById('colon_img').setAttribute('data-fat', totalFatAllDays);
                document.getElementById('colon_img').setAttribute('data-protein', totalProtienAllDays);
                document.getElementById('downloadBtn').setAttribute('data-meals', JSON.stringify(data.response));
                dayNumber++;
                document.getElementById('add_more_days').setAttribute('data-value', `day_${dayNumber}`);
                document.getElementById('add_more_days').innerText = `Day ${dayNumber}`;
                document.getElementById('add_more_days').disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        })
        document.addEventListener('DOMContentLoaded', function() {
            const sections = [
                { allId: 'allProtein', containerId: 'proteinContainer' },
                { allId: 'allCarbs', containerId: 'carbsContainer' },
                { allId: 'allFats', containerId: 'fatsContainer' },
                { allId: 'allFruits', containerId: 'fruitsContainer' },
                { allId: 'allVegetables', containerId: 'vegetablesContainer' },
                { allId: 'allDairy', containerId: 'dairyContainer' }
            ];
            sections.forEach(section => {
                const allElement = document.getElementById(section.allId);
                const containerElement = document.getElementById(section.containerId);
                if (allElement && containerElement) {
                    allElement.addEventListener('click', function() {
                        const foodsTypes = containerElement.querySelectorAll('.foodsTypes');
                        foodsTypes.forEach(foodType => {
                            foodType.classList.add('activeFood');
                        });
                    });
                }
            });
        });
    </script>
</form>