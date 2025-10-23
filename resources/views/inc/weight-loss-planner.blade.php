@if(app()->getLocale() == 'en')
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
        
        .gap-20{
            gap: 20px
        }
        
        
        .generate{
            background: var(--light-blue);
            color: var(--white);
            border-radius: 7px;
            /* padding: 9px 25px; */
            font-size: 16px;
            border: none;
            outline: 0;
            cursor: pointer;
        }

        .wantOptions,.downloadBoxes{
            background-color: #F5F5F5;
            border-radius: 10px;
            border: 1px solid transparent;
        }

        .wantOptions.activeWantoption{
            background-color: white;
            border: 1px solid #D2D2D2
        }

        .markImage{
            display: none;
        }

        .wantOptions.activeWantoption .markImage{
            display: block
        }

        .foodsTypes{
            background: white;
            border: 1px solid #EEEEEE
        }
        
        .foodsTypes.activeFood{
            background: #1670a75c;
            border: 1px solid transparent
        }

        #allFoods{
            max-height: 350px;
            overflow: auto;
        }

        #allFoods::-webkit-scrollbar,.mealsSection::-webkit-scrollbar {
            width: 7px;
            height: 10px;
        }
        #allFoods::-webkit-scrollbar-thumb, .mealsSection::-webkit-scrollbar-thumb{
            background: var(--light-blue);
            border-radius: 5px;
        }
        #allFoods::-webkit-scrollbar-track, .mealsSection::-webkit-scrollbar-track{
            background-color: white;
            border-radius: 5px;
        }

        #previewDownload{
            background: var(--light-blue);
            color: var(--white);
            font-size: 16px
        }

        .mealTimes{
            background: #F5F5F5;
            color: #000000;
            font-size: 16px;
            padding: 5px 25px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold
        }
        .previewBtns{
            background: #F5F5F5;
            color: #000000;
            font-size: 16px;
        }

        .mealTimes.activemealTimes, .previewBtns.activePreview{
            background: var(--light-blue);
            color: var(--white);
        }

        .spliter{
            width: 1px;
            background: #C8C6C6;
        }

        .rightBorder{
            border-right: 1px solid white;
        }

        .border_btm{
            border-bottom: 1px solid #D2D2D2
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

        #generateMeals{
            animation: button-pulse 1s infinite;
        }

        @keyframes button-pulse {
            0% {
                box-shadow: 0 0 0 0px #1670a7;
            }
            100% {
                box-shadow: 0 0 0 5px #fff;
            }
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
    </style>
    <div id="mealsPopup" class="modal">
        {{-- <div class="modal-content row"> --}}
        <div class="col-lg-5 col-12 mx-auto">
            <form>
                <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                <div class="col-12 bg-white radius-10">
                    <div class="col-12" id="want_meals">
                        <div class="col-12 px-3 py-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="font-s-18"><b>Which kind of diet do you want?</b></p>
                                <img loading="lazy" decoding="async" src="{{ asset('assets/img/cancel.png') }}" alt="cancel image" height="13px" width="13px" class="cancelMeal cursor-pointer">
                            </div>
                            <div class="d-flex align-items-center justify-content-between wantOptions cursor-pointer activeWantoption py-2 px-3 mt-2" data-value="anything">
                                <div class="d-flex align-items-center gap-20">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/sandwich.png') }}" alt="sandwich" height="31px" width="26px">
                                    <div>
                                        <p class="font-s-18">Anything</p>
                                        <p class="font-s-13">Excludes: Nothing</p>
                                    </div>
                                </div>
                                <img class="markImage" loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/greenTick.png') }}" alt="green mark" height="16px" width="18px">
                            </div>
                            <div class="d-flex align-items-center justify-content-between wantOptions cursor-pointer py-2 px-3 mt-2" data-value="keto">
                                <div class="d-flex align-items-center gap-20">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/keto.png') }}" alt="keto" height="31px" width="26px">
                                    <div>
                                        <p class="font-s-18">Keto</p>
                                        <p class="font-s-13">Excludes: Grains, Legumes, Starchy Veges.</p>
                                    </div>
                                </div>
                                <img class="markImage" loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/greenTick.png') }}" alt="green mark" height="16px" width="18px">
                            </div>
                            <div class="d-flex align-items-center justify-content-between wantOptions cursor-pointer py-2 px-3 mt-2" data-value="vegetarian">
                                <div class="d-flex align-items-center gap-20">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/vegetarian.png') }}" alt="vegetarian" height="31px" width="33px">
                                    <div>
                                        <p class="font-s-18">Vegetarian</p>
                                        <p class="font-s-13">Excludes: Red Meat, Poultry, Fish, Shellfish.</p>
                                    </div>
                                </div>
                                <img class="markImage" loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/greenTick.png') }}" alt="green mark" height="16px" width="18px">
                            </div>
                            <div class="d-flex align-items-center justify-content-between wantOptions cursor-pointer py-2 px-3 mt-2" data-value="vegan">
                                <div class="d-flex align-items-center gap-20">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/vegan.png') }}" alt="vegan" height="31px" width="31px">
                                    <div>
                                        <p class="font-s-18">Vegan</p>
                                        <p class="font-s-13">Excludes: Red Meat, Poultry, Fish, Dairy, Egg, Honey.</p>
                                    </div>
                                </div>
                                <img class="markImage" loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/greenTick.png') }}" alt="green mark" height="16px" width="18px">
                            </div>
                            <div class="d-flex align-items-center justify-content-between wantOptions cursor-pointer py-2 px-3 mt-2" data-value="paleo">
                                <div class="d-flex align-items-center gap-20">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/paleo.png') }}" alt="paleo" height="33px" width="34px">
                                    <div>
                                        <p class="font-s-18">Paleo</p>
                                        <p class="font-s-13">Excludes: Grains, Legumes, Starchy Veges, Dairy.</p>
                                    </div>
                                </div>
                                <img class="markImage" loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/greenTick.png') }}" alt="green mark" height="16px" width="18px">
                            </div>
                            <div class="d-flex align-items-center justify-content-between wantOptions cursor-pointer py-2 px-3 mt-2" data-value="mediterranean">
                                <div class="d-flex align-items-center gap-20">
                                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/mediterranean.png') }}" alt="mediterranean" height="31px" width="29px">
                                    <div>
                                        <p class="font-s-18">Mediterranean</p>
                                        <p class="font-s-13">Excludes: Red Meat, Fruit Juice, Starchy Veges.</p>
                                    </div>
                                </div>
                                <img class="markImage" loading="lazy" decoding="async" src="{{ asset('assets/img/meals_images/greenTick.png') }}" alt="green mark" height="16px" width="18px">
                            </div>
                        </div>
                        <input type="hidden" name="want_meals_input" id="want_meals_input" value="anything">
                        <div class="d-flex align-items-center justify-content-end p-3 pt-0" style="gap: 20px;">
                            <p class="font-s-16 cursor-pointer cancelMeal">Cancel</p>
                            <p class="py-2 px-3 generate" id="nextBtn_1">Next</p>
                        </div>
                    </div>
                    <div class="col-12 d-none" id="food_like">
                        <div class="d-flex align-items-center justify-content-between p-3 pb-2">
                            <p class="font-s-18"><b>Which kind of food do you like?</b></p>
                            <img loading="lazy" decoding="async" src="{{ asset('assets/img/cancel.png') }}" alt="cancel image" height="13px" width="13px" class="cancelMeal cursor-pointer">
                        </div>
                        <div class="col-12 px-3 mb-3">
                            <input type="text" id="searchFood" name="searchFood" class="input" placeholder="search">
                        </div>
                        <div class="col-12 p-3 pt-0" id="allFoods">
                            <div class="d-flex align-items-center justify-content-between mb-2 font-s-15 headingAllFoods">
                                <p>Protien</p>
                                <p id="allProtein">Select All</p>
                            </div>
                            <div class="d-flex align-items-center gap-15 flex-wrap font-s-14" id="proteinContainer"></div>
                            <div class="d-flex align-items-center justify-content-between mt-3 mb-2 font-s-15 headingAllFoods">
                                <p>Carbs</p>
                                <p id="allCarbs">Select All</p>
                            </div>
                            <div class="d-flex align-items-center gap-15 flex-wrap font-s-14" id="carbsContainer"></div>
                            <div class="d-flex align-items-center justify-content-between mt-3 mb-2 font-s-15 headingAllFoods">
                                <p>Fats</p>
                                <p id="allFats">Select All</p>
                            </div>
                            <div class="d-flex align-items-center gap-15 flex-wrap font-s-14" id="fatsContainer"></div>
                            <div class="d-flex align-items-center justify-content-between mt-3 mb-2 font-s-15 headingAllFoods">
                                <p>Fruits</p>
                                <p id="allFruits">Select All</p>
                            </div>
                            <div class="d-flex align-items-center gap-15 flex-wrap font-s-14" id="fruitsContainer"></div>
                            <div class="d-flex align-items-center justify-content-between mt-3 mb-2 font-s-15 headingAllFoods">
                                <p>Vegetables</p>
                                <p id="allVegetables">Select All</p>
                            </div>
                            <div class="d-flex align-items-center gap-15 flex-wrap font-s-14" id="vegetablesContainer"></div>
                            <div class="d-flex align-items-center justify-content-between mt-3 mb-2 font-s-15 headingAllFoods">
                                <p>Dairy and Milk Alternatives</p>
                                <p id="allDairy">Select All</p>
                            </div>
                            <div class="d-flex align-items-center gap-15 flex-wrap font-s-14" id="dairyContainer"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end p-3" style="gap: 20px;border-top: 1px solid #E6E6E6">
                            <p class="font-s-16 cursor-pointer" id="backBtn_1">Back</p>
                            <p class="py-2 px-3 generate" id="nextBtn_2">Generate Meals</p>
                        </div>
                    </div>
                    <div class="col-12 d-none" id="loading">
                        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 440px;">
                            <img loading="eager" decoding="async" src="{{ asset('assets/img/meal_gif.gif') }}" alt="loading meal gif" height="100%" width="300px">
                            <p class="font-s-18 mt-3"><b>Generating Meals<span class="loading-dots"></span></b></p>
                        </div>
                    </div>
                    <div class="col-12 d-none" id="final_download">
                        <div class="col-12 p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-15">
                                    <p class="mealTimes activemealTimes" data-value="breakfast">Breakfast</p>
                                    <p class="mealTimes" data-value="lunch">Lunch</p>
                                    <p class="mealTimes" data-value="dinner">Dinner</p>
                                </div>
                                <img loading="lazy" decoding="async" src="{{ asset('assets/img/cancel.png') }}" alt="cancel image" height="15px" width="15px" class="cancelMeal cursor-pointer">
                            </div>
                            <div class="mealsSection" id="breakfast"></div>
                            <div class="mealsSection d-none" id="lunch"></div>
                            <div class="mealsSection d-none" id="dinner"></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end p-3" style="gap: 20px;border-top: 1px solid #E6E6E6">
                            <p class="font-s-16 cursor-pointer" id="backBtn_2">Back</p>
                            <p class="py-2 px-3 generate" id="downloadBtn">Download All</p>
                        </div>
                    </div>
                    <div class="col-12 p-3 d-none" id="previewSection"></div>
                </div>
            </form>
        </div>  
    </div>
    @if($page === "tdee-calculator")
        <style>
            @keyframes button-pulse {
                0% {
                    box-shadow: 0 0 0 0px #52cf5b;
                }
                100% {
                    box-shadow: 0 0 0 5px #fff;
                }
            }
        </style>
        
        <div class="lg:flex items-center mt-3 gap-2">
            <p class="text-sm font-bold">Want to know what you should eat?</p>
            <button type="button" class="bg-[#52cf5b] text-white rounded-md py-2 px-3 border-0 cursor-pointer mt-2 lg:mt-0 animate-button-pulse" style="animation: button-pulse 1s infinite;" id="generateMeals">
                Generate Meals
                <img loading="lazy" decoding="async" src="{{ asset('assets/img/new_right_arrow.png') }}" alt="right arrow image" class="ml-2 h-full w-4">
            </button>
        </div>
    
    @else
        <div class="lg:flex items-center justify-between bg-sky-100 border rounded-lg px-3 py-2 mt-2">
            <div>
                <p class="text-lg">Want to know what you should eat?</p>
            </div>
            <div class="mt-2 lg:mt-0">
                <button type="button" class="bg-blue-500 text-white px-3 py-2 rounded-lg flex items-center" id="generateMeals">
                    Generate Meals
                    <img loading="lazy" decoding="async" src="{{ asset('assets/img/new_right_arrow.png') }}" alt="right arrow image" class="ml-2 h-full w-4">
                </button>
            </div>
        </div>
    @endif
    <script>
        document.getElementById('searchFood').addEventListener('input', function() {
            var val = clearText(this.value);
            var boxMeals = Array.from(document.querySelectorAll('.foodsTypes'));
            // const allFoodsHeadings = document.querySelectorAll('.headingAllFoods');
            boxMeals.forEach(function(boxMeal) {
                var myVal = clearText(boxMeal.textContent);
                if (myVal.match(val)) {
                    boxMeal.style.display = 'flex';
                    // allFoodsHeadings.forEach(function(element) {
                    //     element.style.display = '';
                    // });
                } else {
                    boxMeal.style.display = 'none';
                    // allFoodsHeadings.forEach(function(element) {
                    //     element.style.display = 'none';
                    // });

                }
            });
        });
        function clearText(text) {
            return text.trim().toLowerCase();
        }
        function previewDownload(element){
            document.getElementById('downloadpreviewSection').classList.remove("d-none");
            const mealName = element.getAttribute('data-mealname');
            const ingredients = JSON.parse(element.getAttribute('data-ingredients'));
            const meal_recipe = element.getAttribute('data-recipe');
            const downloadpreviewSection = document.getElementById('downloadpreviewSection');
            downloadpreviewSection.innerHTML = '';
            downloadpreviewSection.innerHTML = `
                <div class="col-12 p-3">
                    <p class="font-s-18"><b>${mealName}</b></p>
                    <p class="font-s-16 mt-2">Ingredients</p>
                    <div class="col-12 ingredientDeatils">
                        ${ingredients.map(ingredient => `
                            <div class="d-flex align-items-center justify-content-between mt-3 border_btm pb-1">
                                <p>${ingredient.name}</p>
                                <p>${ingredient.quantity} / ${ingredient.calories} kcal</p>
                            </div>
                        `).join('')}
                    </div>
                    <p class="font-s-16 mt-2">How to Make?</p>
                    <div class="col-12 mt-3 content">
                        <p>${meal_recipe}</p>
                    </div>
                </div>
            `;
            var n = document.querySelector('#downloadpreviewSection');
            html2pdf().from(n).set({
                margin: [15, 5, 5, 5],
                filename: `${mealName} Details by calculator-online.net.pdf`,
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
                    e.textWithLink(" Calculator-Online.net", 31, 15, {
                        url: "https://calculator-online.net/"
                    });
                    var allMathText = "Calculator-Online.net " + pageNumber + "/" + t;
                    var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                    e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                        url: "https://calculator-online.net/"
                    });
                }
                downloadpreviewSection.classList.add("d-none");
            }).save().catch((e)=>{
            }
            );
        }
        function generateMealHTML(mealType, meals) {
            let html = `<p class="font-s-20"><b class="text-blue">${mealType}</b></p>`;
            meals.forEach(meal => {
                html += `<p class="font-s-16 mt-2"><b>${meal.meal_name}</b></p>`;
                html += `<p class="font-s-16 mt-2">Ingredients</p>`;
                html += '<div class="col-12 ingredientDeatils font-s-14">';
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
        function allMealsDownload(breakfast,lunch,dinner) {
            const allMealsDownloadSection = document.getElementById('allMealsDownloadSection');
            allMealsDownloadSection.classList.remove("d-none");
            allMealsDownloadSection.innerHTML = '';
            let html = '';
            html += generateMealHTML('Breakfast', breakfast);
            html += generateMealHTML('Lunch', lunch);
            html += generateMealHTML('Dinner', dinner);
            allMealsDownloadSection.innerHTML = html;

            var n = document.querySelector('#allMealsDownloadSection');
            html2pdf().from(n).set({
                margin: [15, 5, 5, 5],
                filename: `Meals Details by calculator-online.net.pdf`,
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
                    e.textWithLink(" Calculator-Online.net", 31, 15, {
                        url: "https://calculator-online.net/"
                    });
                    var allMathText = "Calculator-Online.net " + pageNumber + "/" + t;
                    var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                    e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                        url: "https://calculator-online.net/"
                    });
                }
                downloadpreviewSection.classList.add("d-none");
            }).save().catch((e)=>{
            }
            );
        }
        function mealsPreview(element) {
            const mealName = element.getAttribute('data-mealname');
            const ingredients = JSON.parse(element.getAttribute('data-ingredients'));
            const meal_recipe = element.getAttribute('data-recipe');
            document.getElementById('final_download').classList.add("d-none");
            document.getElementById('previewSection').classList.remove("d-none");
            const previewSection = document.getElementById('previewSection');
            previewSection.innerHTML = '';
            previewSection.innerHTML = `
                <div class="col-12" id="previewContent">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <p class="font-s-18"><b>${mealName}</b></p>
                        <div class="col-lg-5 mt-lg-0 mt-2">
                            <div class="row align-items-center bg-white text-center border radius-10 p-1">
                                <div class="col-6 py-2 cursor-pointer radius-5 previewBtns activePreview" data-value="ingredients">Ingredients</div>
                                <div class="col-6 py-2 cursor-pointer radius-5 previewBtns" data-value="recipe">Making</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 ingredientDeatils">
                        ${ingredients.map(ingredient => `
                            <div class="d-flex align-items-center justify-content-between mt-3 border_btm pb-1">
                                <p>${ingredient.name}</p>
                                <p>${ingredient.quantity} / ${ingredient.calories} kcal</p>
                            </div>
                        `).join('')}
                    </div>
                    <div class="col-12 recipeDetail mt-3 d-none content">
                        <p>${meal_recipe}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-3 gap-20">
                        <p class="font-s-16 cursor-pointer" id="backFinal">Back</p>
                        <p class="py-2 px-3 radius-5 cursor-pointer" data-mealname="${mealName}" data-ingredients='${JSON.stringify(ingredients)}' data-recipe="${meal_recipe}" onclick="previewDownload(this)" id="previewDownload">Download</p>
                    </div>
                </div>
            `;
            const previewBtns = previewSection.querySelectorAll('.previewBtns');
            const ingredientDeatils = previewSection.querySelector('.ingredientDeatils');
            const recipeDetail = previewSection.querySelector('.recipeDetail');
            let detailsText = "Ingredients";
            previewBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    previewBtns.forEach(b => b.classList.remove('activePreview'));
                    btn.classList.add('activePreview');
                    if (btn.dataset.value === 'ingredients') {
                        ingredientDeatils.classList.remove('d-none');
                        recipeDetail.classList.add('d-none');
                        detailsText = "Ingredients";
                    } else {
                        ingredientDeatils.classList.add('d-none');
                        recipeDetail.classList.remove('d-none');
                        detailsText = "Making";
                    }
                });
            });

            const backFinal = previewSection.querySelector('#backFinal');
            backFinal.addEventListener('click', () => {
                previewSection.classList.add('d-none');
                document.getElementById('final_download').classList.remove('d-none');
            });

        }

        function renderMeals(meals, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            meals.forEach(meal => {
                container.innerHTML += createMealHtml(meal);
            });
        }

        function getRandomImage() {
            const mealsImages = [
                "ic_chicken.png",
                "ic_beef.png",
                "ic_fish.png",
                "ic_tuna.png",
                "ic_egg_whole.png",
                "ic_turkey.png",
                "ic_pork.png",
                "ic_ham.png",
                "ic_tofu.png",
                "ic_soy.png",
                // "ic_meals.png",
                "ic_tempeh.png",
                "ic_seitan.png",
                "ic_protein_pwoder.png",
                // "ic_nuts_seeds.png",
                "ic_potato.png",
                "ic_beans.png",
                "ic_rice.png",
                "ic_corn.png",
                "ic_popcorn.png",
                "ic_chickpeas.png",
                // "ic_green_beans.png",
                "ic_lentils.png",
                "ic_bread.png",
                "ic_oats.png",
                "ic_pasta.png",
                "ic_tortilla.png",
                "ic_cereal.png",
                "ic_peas.png",
                "ic_sweet_potato.png",
                "ic_cassava.png",
                // "ic_butternut_squash.png",
                "ic_quinoa.png",
                // "ic_cottage_cheese.png",
                "ic_walnuts.png",
                "ic_almonds.png",
                "ic_chocolate.png",
                "ic_avocado.png",
                "ic_peanuts.png",
                "ic_peacans.png",
                "ic_chia.png",
                "ic_olives.png",
                "ic_cashews.png",
                // "ic_pumpkin_seeds.png",
                // "ic_coconut_oil.png",
                // "ic_sausages.png",
                "ic_graps.png",
                "ic_orange.png",
                "ic_kiwi.png",
                "ic_apple.png",
                "ic_banana.png",
                "ic_strawberries.png",
                "ic_watermelon.png",
                "ic_mango.png",
                "ic_peach.png",
                "ic_pear.png",
                "ic_dragon_fruit.png",
                "ic_papaya.png",
                "ic_dates.png",
                "ic_blueberry.png",
                "ic_pineapple.png",
                // "ic_grenadia.png",
                // "ic_figs.png",
                "ic_tangerines.png",
                // "ic_lychee.png",
                "ic_cantaloupe.png",
                // "ic_cherries.png",
                "ic_onion.png",
                "ic_cabbage.png",
                "ic_cucumber.png",
                "ic_carrot.png",
                "ic_tomato.png",
                "ic_broccoli.png",
                "ic_basil.png",
                "ic_squash.png",
                "ic_spinach.png",
                "ic_lettuce.png",
                "ic_cauliflower.png",
                "ic_bell_pepper.png",
                "ic_mushrooms.png",
                "ic_zucchini.png",
                "ic_chard.png",
                "ic_radish.png",
                "ic_beet.png",
                "ic_celery.png",
                "ic_eggplant.png",
                // "ic_pumpkin.png",
                // "ic_garlic.png",
                "ic_asparagus.png",
                // "ic_black_coffee.png",
                "ic_soy_milk.png",
                "ic_coconut_milk.png",
                "ic_white_sheese.png",
                "ic_almond_milk.png",
                "ic_yogurt.png",
                "ic_milk.png",
                "ic_oat_milk.png",
                // "ic_coconut_water.png",
                // "ic_herbal_tea.png",
            ];
            const randomIndex = Math.floor(Math.random() * mealsImages.length);
            const baseImageUrl = "{{ asset('assets/img/meals_images') }}/";
            return `${baseImageUrl}${mealsImages[randomIndex]}`;
        }

        function createMealHtml(meal) {
            let caloriesImage = "{{ asset('assets/img/meals_images/calories.png') }}";
            let timeImage = "{{ asset('assets/img/meals_images/time.png') }}";
            let previewImage = "{{ asset('assets/img/meals_images/preview.png') }}";
            let downloadImage = "{{ asset('assets/img/meals_images/download.png') }}";
            let randomImage1 = getRandomImage();
            let randomImage2 = getRandomImage();
            let randomImage3 = getRandomImage();
            return `
                <div class="d-lg-flex align-items-center justify-content-between p-3 mt-3 downloadBoxes">
                    <div>
                        <p>${meal.meal_name}</p>
                        <div class="d-flex align-items-center gap-10 mt-2">
                            <img loading="lazy" decoding="async" src="${randomImage1}" alt="sandwich" height="15px" width="15px">
                            <span class="spliter">&nbsp;</span>
                            <img loading="lazy" decoding="async" src="${randomImage2}" alt="sandwich" height="15px" width="15px">
                            <span class="spliter">&nbsp;</span>
                            <img loading="lazy" decoding="async" src="${randomImage3}" alt="sandwich" height="15px" width="15px">
                        </div>
                    </div>
                    <div class="d-flex align-items-center font-s-12 mt-lg-0 mt-3">
                        <div class="rightBorder pe-3 text-center">
                            <p class="d-flex align-items-center gap-5 bg-white py-1 px-2 radius-10 white-nowrap">
                                <img loading="lazy" decoding="async" src="${caloriesImage}" alt="calories" height="14px" width="14px">
                                <span>${meal.total_calories}</span>
                            </p>
                            <p class="d-flex align-items-center gap-5 bg-white py-1 px-2 radius-10 white-nowrap mt-2">
                                <img loading="lazy" decoding="async" src="${timeImage}" alt="time" height="14px" width="14px">
                                <span>${meal.meal_time}</span>
                            </p>
                        </div>
                        <div class="rightBorder px-3 text-center cursor-pointer" data-mealname="${meal.meal_name}" data-ingredients='${JSON.stringify(meal.ingredients)}' data-recipe="${meal.meal_recipe}" onclick="mealsPreview(this)">
                            <img loading="lazy" decoding="async" src="${previewImage}" alt="preview" height="15px" width="20px">
                            <p class="mt-2">Preview</p>
                        </div>
                        <div class="text-center ps-3 cursor-pointer" data-mealname="${meal.meal_name}" data-ingredients='${JSON.stringify(meal.ingredients)}' data-recipe="${meal.meal_recipe}" onclick="previewDownload(this)">
                            <img loading="lazy" decoding="async" src="${downloadImage}" alt="download" height="15px" width="15px">
                            <p class="mt-2">Download</p>
                        </div>
                    </div>
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
                    foodDiv.classList.add('d-flex', 'align-items-center', 'gap-10', 'px-3', 'py-1', 'radius-20', 'cursor-pointer', 'foodsTypes');
                    foodDiv.dataset.value = item;
                    foodDiv.onclick = function() {
                        checkedFood.call(this);
                    };
                    const img = document.createElement('img');
                    img.src = `{{ asset('assets/img/meals_images/${key}.png') }}`;
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
        document.addEventListener('DOMContentLoaded', (event) => {
            let mealsPopup = document.getElementById("mealsPopup");
            if(mealsPopup){
                let generateMeals = document.getElementById("generateMeals");
                let spans = document.querySelectorAll('.cancelMeal');
                generateMeals.onclick = function() {
                    mealsPopup.style.display = "flex";
                    mealsPopup.style.justifyContent = "center";
                    mealsPopup.style.alignItems = "center";
                    mealsPopup.style.paddingTop = "0px";
                    document.body.classList.add('no-scroll');
                }
                spans.forEach(span => {
                    span.onclick = function() {
                        mealsPopup.style.display = "none";
                        mealsPopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    }
                });
                window.onclick = function(event) {
                    if (event.target === mealsPopup) {
                        mealsPopup.style.display = "none";
                        mealsPopup.style.paddingTop = "100px";
                        document.body.classList.remove('no-scroll');
                    }
                }
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const options = document.querySelectorAll('.wantOptions');
            const want_meals_input = document.getElementById('want_meals_input');
            options.forEach(option => {
                option.addEventListener('click', function() {
                    options.forEach(opt => opt.classList.remove('activeWantoption'));
                    this.classList.add('activeWantoption');
                    want_meals_input.value = this.getAttribute('data-value');
                });
            });

            const mealTimes = document.querySelectorAll('.mealTimes');
            mealTimes.forEach(option => {
                option.addEventListener('click', function() {
                    mealTimes.forEach(opt => opt.classList.remove('activemealTimes'));
                    this.classList.add('activemealTimes');
                    const mealTimesValue = this.getAttribute('data-value');
                    if(mealTimesValue == "breakfast"){
                        document.getElementById('breakfast').classList.remove("d-none");
                        document.getElementById('lunch').classList.add("d-none");
                        document.getElementById('dinner').classList.add("d-none");
                    }else if(mealTimesValue == "lunch"){
                        document.getElementById('breakfast').classList.add("d-none");
                        document.getElementById('lunch').classList.remove("d-none");
                        document.getElementById('dinner').classList.add("d-none");
                    }else{
                        document.getElementById('breakfast').classList.add("d-none");
                        document.getElementById('lunch').classList.add("d-none");
                        document.getElementById('dinner').classList.remove("d-none");
                    }
                });
            });
        });
        document.getElementById('nextBtn_1').addEventListener('click', function() {
            document.getElementById('want_meals').classList.add("d-none");
            document.getElementById('final_download').classList.add("d-none");
            document.getElementById('food_like').classList.remove("d-none");
            let wantMealsInput = document.getElementById('want_meals_input').value;
            checkMeal(wantMealsInput);
        });
        document.getElementById('backBtn_1').addEventListener('click', function() {
            document.getElementById('want_meals').classList.remove("d-none");
            document.getElementById('final_download').classList.add("d-none");
            document.getElementById('food_like').classList.add("d-none");
        });
        document.getElementById('nextBtn_2').addEventListener('click', function() {
            document.getElementById('want_meals').classList.add("d-none");
            document.getElementById('food_like').classList.add("d-none");
            document.getElementById('loading').classList.remove("d-none");
            const activeFoods = Array.from(document.querySelectorAll('.foodsTypes.activeFood'))
                .map(element => element.getAttribute('data-value'))
                .join(', ');

            let dietType = document.getElementById('want_meals_input').value;
            const csrfToken = document.getElementById('csrf_token').value;
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('activeFoods', activeFoods);
            formData.append('dietType', dietType);
            fetch('{{ route('weightlossMeals') }}/', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading').classList.add("d-none");
                document.getElementById('final_download').classList.remove("d-none");
                renderMeals(data.response.breakfast, 'breakfast');
                renderMeals(data.response.lunch, 'lunch');
                renderMeals(data.response.dinner, 'dinner');

                document.getElementById('downloadBtn').onclick = function() {
                    allMealsDownload(data.response.breakfast, data.response.lunch, data.response.dinner);
                };
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
        document.getElementById('backBtn_2').addEventListener('click', function() {
            document.getElementById('want_meals').classList.add("d-none");
            document.getElementById('final_download').classList.add("d-none");
            document.getElementById('food_like').classList.remove("d-none");
        });
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
@endif