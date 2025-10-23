<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4"> 

            <div class="col-span-12">{{ $lang['1'] }}</div>
            <div class="col-span-6">
                <label for="right_arm" class="w-full">{{ $lang['2'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="right_arm" id="right_arm">
                        <option value="0" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['right_arm']) && $_POST['right_arm']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="left_arm" class="w-full">{{ $lang['3'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="left_arm" id="left_arm">
                        <option value="0" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['left_arm']) && $_POST['left_arm']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="right_leg" class="w-full">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="right_leg" id="right_leg">
                        <option value="0" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['right_leg']) && $_POST['right_leg']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="left_leg" class="w-full">{{ $lang['5'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="left_leg" id="left_leg">
                        <option value="0" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['left_leg']) && $_POST['left_leg']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="right_foot" class="w-full">{{ $lang['6'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="right_foot" id="right_foot">
                        <option value="0" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['right_foot']) && $_POST['right_foot']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="left_foot" class="w-full">{{ $lang['7'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="left_foot" id="left_foot">
                        <option value="0" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['left_foot']) && $_POST['left_foot']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="back" class="w-full">{{ $lang['8'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="back" id="back">
                        <option value="0" {{ isset($_POST['back']) && $_POST['back']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['back']) && $_POST['back']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['back']) && $_POST['back']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['back']) && $_POST['back']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['back']) && $_POST['back']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['back']) && $_POST['back']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['back']) && $_POST['back']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['back']) && $_POST['back']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['back']) && $_POST['back']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['back']) && $_POST['back']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['back']) && $_POST['back']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ssd" class="w-full">{{ $lang['9'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="ssd" id="ssd">
                        <option value="0" {{ isset($_POST['ssd']) && $_POST['ssd']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['ssd']) && $_POST['ssd']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['ssd']) && $_POST['ssd']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['ssd']) && $_POST['ssd']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['ssd']) && $_POST['ssd']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['ssd']) && $_POST['ssd']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['ssd']) && $_POST['ssd']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['ssd']) && $_POST['ssd']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['ssd']) && $_POST['ssd']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['ssd']) && $_POST['ssd']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['ssd']) && $_POST['ssd']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ptsd" class="w-full">{{ $lang['10'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="ptsd" id="ptsd">
                        <option value="0" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['ptsd']) && $_POST['ptsd']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="tinnitus" class="w-full">{{ $lang['11'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="tinnitus" id="tinnitus">
                        <option value="0" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['tinnitus']) && $_POST['tinnitus']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="migraines" class="w-full">{{ $lang['12'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="migraines" id="migraines">
                        <option value="0" {{ isset($_POST['migraines']) && $_POST['migraines']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['migraines']) && $_POST['migraines']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['migraines']) && $_POST['migraines']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['migraines']) && $_POST['migraines']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['migraines']) && $_POST['migraines']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['migraines']) && $_POST['migraines']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['migraines']) && $_POST['migraines']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['migraines']) && $_POST['migraines']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['migraines']) && $_POST['migraines']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['migraines']) && $_POST['migraines']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['migraines']) && $_POST['migraines']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="sleep_apnea" class="w-full">{{ $lang['13'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="sleep_apnea" id="sleep_apnea">
                        <option value="0" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['sleep_apnea']) && $_POST['sleep_apnea']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="bilateral_upper" class="w-full">{{ $lang['14'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="bilateral_upper" id="bilateral_upper">
                        <option value="0" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['bilateral_upper']) && $_POST['bilateral_upper']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="bilateral_lower" class="w-full">{{ $lang['15'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="bilateral_lower" id="bilateral_lower">
                        <option value="0" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['bilateral_lower']) && $_POST['bilateral_lower']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="others" class="w-full">{{ $lang['16'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="others" id="others">
                        <option value="0" {{ isset($_POST['others']) && $_POST['others']=='0'?'selected':''}}>0%</option>
                        <option value="10" {{ isset($_POST['others']) && $_POST['others']=='10'?'selected':''}}>10%</option>
                        <option value="20" {{ isset($_POST['others']) && $_POST['others']=='20'?'selected':''}}>20%</option>
                        <option value="30" {{ isset($_POST['others']) && $_POST['others']=='30'?'selected':''}}>30%</option>
                        <option value="40" {{ isset($_POST['others']) && $_POST['others']=='40'?'selected':''}}>40%</option>
                        <option value="50" {{ isset($_POST['others']) && $_POST['others']=='50'?'selected':''}}>50%</option>
                        <option value="60" {{ isset($_POST['others']) && $_POST['others']=='60'?'selected':''}}>60%</option>
                        <option value="70" {{ isset($_POST['others']) && $_POST['others']=='70'?'selected':''}}>70%</option>
                        <option value="80" {{ isset($_POST['others']) && $_POST['others']=='80'?'selected':''}}>80%</option>
                        <option value="90" {{ isset($_POST['others']) && $_POST['others']=='90'?'selected':''}}>90%</option>
                        <option value="100" {{ isset($_POST['others']) && $_POST['others']=='100'?'selected':''}}>100%</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">{{$lang[17]}}</div>
            <div class="col-span-6">
                <label for="status" class="w-full">{{ $lang[18] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="status" id="status">
                        <option value="{{ $lang[19] }}" {{ isset($_POST['status']) && $_POST['status'] == $lang[19] ? 'selected' : '' }}>{{ $lang[19] }}</option>
                        <option value="{{ $lang[20] }}" {{ isset($_POST['status']) && $_POST['status'] == $lang[20] ? 'selected' : '' }}>{{ $lang[20] }}</option>
                        
                        
                    </select>
                </div>
            </div>
           
            <div class="col-span-6">
                <label for="under_age" class="w-full">{{ $lang[21] }} 18:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="under_age" id="under_age">
                        <option value="0" {{ isset($_POST['under_age']) && $_POST['under_age']=='0'?'selected':''}}>0</option>
                        <option value="1" {{ isset($_POST['under_age']) && $_POST['under_age']=='1'?'selected':''}}>1</option>
                        <option value="2" {{ isset($_POST['under_age']) && $_POST['under_age']=='2'?'selected':''}}>2</option>
                        <option value="3" {{ isset($_POST['under_age']) && $_POST['under_age']=='3'?'selected':''}}>3</option>
                        <option value="4" {{ isset($_POST['under_age']) && $_POST['under_age']=='4'?'selected':''}}>4</option>
                        <option value="5" {{ isset($_POST['under_age']) && $_POST['under_age']=='5'?'selected':''}}>5</option>
                        <option value="6" {{ isset($_POST['under_age']) && $_POST['under_age']=='6'?'selected':''}}>6</option>
                        <option value="7" {{ isset($_POST['under_age']) && $_POST['under_age']=='7'?'selected':''}}>7</option>
                        <option value="8" {{ isset($_POST['under_age']) && $_POST['under_age']=='8'?'selected':''}}>8</option>
                        <option value="9" {{ isset($_POST['under_age']) && $_POST['under_age']=='9'?'selected':''}}>9</option>
                        <option value="10" {{ isset($_POST['under_age']) && $_POST['under_age']=='10'?'selected':''}}>10</option>
                        <option value="11" {{ isset($_POST['under_age']) && $_POST['under_age']=='11'?'selected':''}}>11</option>
                        <option value="12" {{ isset($_POST['under_age']) && $_POST['under_age']=='12'?'selected':''}}>12</option>
                        <option value="13" {{ isset($_POST['under_age']) && $_POST['under_age']=='13'?'selected':''}}>13</option>
                        <option value="14" {{ isset($_POST['under_age']) && $_POST['under_age']=='14'?'selected':''}}>14</option>
                        <option value="15" {{ isset($_POST['under_age']) && $_POST['under_age']=='15'?'selected':''}}>15</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="over_age" class="w-full">{{ $lang[22] }} 18:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="over_age" id="over_age">
                        <option value="0" {{ isset($_POST['over_age']) && $_POST['over_age']=='0'?'selected':''}}>0</option>
                        <option value="1" {{ isset($_POST['over_age']) && $_POST['over_age']=='1'?'selected':''}}>1</option>
                        <option value="2" {{ isset($_POST['over_age']) && $_POST['over_age']=='2'?'selected':''}}>2</option>
                        <option value="3" {{ isset($_POST['over_age']) && $_POST['over_age']=='3'?'selected':''}}>3</option>
                        <option value="4" {{ isset($_POST['over_age']) && $_POST['over_age']=='4'?'selected':''}}>4</option>
                        <option value="5" {{ isset($_POST['over_age']) && $_POST['over_age']=='5'?'selected':''}}>5</option>
                        <option value="6" {{ isset($_POST['over_age']) && $_POST['over_age']=='6'?'selected':''}}>6</option>
                        <option value="7" {{ isset($_POST['over_age']) && $_POST['over_age']=='7'?'selected':''}}>7</option>
                        <option value="8" {{ isset($_POST['over_age']) && $_POST['over_age']=='8'?'selected':''}}>8</option>
                        <option value="9" {{ isset($_POST['over_age']) && $_POST['over_age']=='9'?'selected':''}}>9</option>
                        <option value="10" {{ isset($_POST['over_age']) && $_POST['over_age']=='10'?'selected':''}}>10</option>
                        <option value="11" {{ isset($_POST['over_age']) && $_POST['over_age']=='11'?'selected':''}}>11</option>
                        <option value="12" {{ isset($_POST['over_age']) && $_POST['over_age']=='12'?'selected':''}}>12</option>
                        <option value="13" {{ isset($_POST['over_age']) && $_POST['over_age']=='13'?'selected':''}}>13</option>
                        <option value="14" {{ isset($_POST['over_age']) && $_POST['over_age']=='14'?'selected':''}}>14</option>
                        <option value="15" {{ isset($_POST['over_age']) && $_POST['over_age']=='15'?'selected':''}}>15</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="parent" class="w-full">{{ $lang[23] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="parent" id="parent">
                        <option value="0" {{ isset($_POST['parent']) && $_POST['parent']=='0'?'selected':''}}>{{ $lang[24]}}</option>
                        <option value="1" {{ isset($_POST['parent']) && $_POST['parent']=='1'?'selected':''}}>1</option>
                        <option value="2" {{ isset($_POST['parent']) && $_POST['parent']=='2'?'selected':''}}>2</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6 d-none married">
                <label for="attendance" class="w-full">{{ $lang[29] }} {{$lang[30] }}?</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="attendance" id="attendance">
                        <option value="No" {{ isset($_POST['attendance']) && $_POST['attendance']=='No'?'selected':''}}>No</option>
                        <option value="Yes" {{ isset($_POST['attendance']) && $_POST['attendance']=='Yes'?'selected':''}}>Yes</option>
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
            

    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[25] }}  </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['total_combined'], 4) }}%</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[26] }}  </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['total_cumulative'], 4) }}%</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="50%"><strong>💵 {{ $lang[27] }}  </strong></td>
                                <td class="py-2 border-b"> {{ $currancy}} {{ round($detail['rate'], 4) }} {{ $lang[28] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')

<script>
     document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    var marriedElements = document.querySelectorAll('.married');
    marriedElements.forEach(function(element) {
        element.style.display = 'none';
    });
    var statusSelect = document.getElementById('status');
    statusSelect.addEventListener('change', function() {
        var selectedValue = this.value;
        marriedElements.forEach(function(element) {
            if (selectedValue === 'Married') {
                element.style.display = 'block';
            } else {
                element.style.display = 'none';
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    @if(isset($detail))
    var dropVals = "{{$detail['status']}}";
    var marriedElements = document.querySelectorAll('.married');
    if (dropVals === 'Married') {
        marriedElements.forEach(function(element) {
            element.style.display = 'block';
        });
    } else {
        marriedElements.forEach(function(element) {
            element.style.display = 'none';
        });
    }
    @endif

});
</script>
@endpush
