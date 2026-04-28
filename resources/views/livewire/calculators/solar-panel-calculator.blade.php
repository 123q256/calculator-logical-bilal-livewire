<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Consumption --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="first" class="label">{{ $lang['1'] ?? 'Electricity Consumption' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units1')">
                                /{{ $units1 }} ▾
                            </label>
                            @if ($openDropdown === 'units1')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', 'yr')">/yr</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units1', 'mon')">/mon</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Calculation Method --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="calculation_type" class="label">{{ $lang['4'] ?? 'Calculation Method' }}</label>
                        <select wire:model.live="calculation_type" id="calculation_type" class="input">
                            <option value="1">{{ $lang['5'] ?? 'Manual Input' }}</option>
                            <option value="2">{{ $lang['6'] ?? 'Select Location' }}</option>
                        </select>
                    </div>

                    {{-- Location Selection (Only for Mode 2) --}}
                    @if ($calculation_type == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="operations2" class="label">{{ $lang['7'] ?? 'Country' }}</label>
                            <select wire:model.live="operations2" id="operations2" class="input">
                                <option value="1&&Afghanistan (Kabul)">Afghanistan (Kabul)</option>
                                <option value="2&&Albania (Tirane)">Albania (Tirane)</option>
                                <option value="3&&Algeria (Algiers)">Algeria (Algiers)</option>
                                <option value="4&&Am. Samoa (Pago Pago)">Am. Samoa (Pago Pago)</option>
                                <option value="5&&Andorra (Andorra la Vella)">Andorra (Andorra la Vella)</option>
                                <option value="6&&Angola (Luanda)">Angola (Luanda)</option>
                                <option value="7&&Antigua and Barbuda (W. Indies)">Antigua and Barbuda (W. Indies)</option>
                                <option value="8&&Argentina (Buenos Aires)">Argentina (Buenos Aires)</option>
                                <option value="9&&Armenia (Yerevan)">Armenia (Yerevan)</option>
                                <option value="10&&Aruba (Oranjestad)">Aruba (Oranjestad)</option>
                                <option value="11&&Australia (Canberra)">Australia (Canberra)</option>
                                <option value="12&&Austria (Vienna)">Austria (Vienna)</option>
                                <option value="13&&Azerbaijan (Baku)">Azerbaijan (Baku)</option>
                                <option value="14&&Bahamas (Nassau)">Bahamas (Nassau)</option>
                                <option value="15&&Bahrain (Manama)">Bahrain (Manama)</option>
                                <option value="16&&Bangladesh (Dhaka)">Bangladesh (Dhaka)</option>
                                <option value="17&&Barbados (Bridgetown)">Barbados (Bridgetown)</option>
                                <option value="18&&Belarus (Minsk)">Belarus (Minsk)</option>
                                <option value="19&&Belgium (Brussels)">Belgium (Brussels)</option>
                                <option value="20&&Belize (Belmopan)">Belize (Belmopan)</option>
                                <option value="21&&Benin (Porto-Novo)">Benin (Porto-Novo)</option>
                                <option value="22&&Bhutan (Thimphu)">Bhutan (Thimphu)</option>
                                <option value="23&&Bolivia (La Paz)">Bolivia (La Paz)</option>
                                <option value="24&&Bosnia and Herzegovina (Sarajevo)">Bosnia and Herzegovina (Sarajevo)</option>
                                <option value="25&&Botswana (Gaborone)">Botswana (Gaborone)</option>
                                <option value="26&&Brazil (Brasilia)">Brazil (Brasilia)</option>
                                <option value="27&&British Virgin Islands (Road Town)">British Virgin Islands (Road Town)</option>
                                <option value="28&&Brunei Darussalam (Bandar Seri Begawan)">Brunei Darussalam (Bandar Seri Begawan)</option>
                                <option value="29&&Bulgaria (Sofia)">Bulgaria (Sofia)</option>
                                <option value="30&&Burkina Faso (Ouagadougou)">Burkina Faso (Ouagadougou)</option>
                                <option value="31&&Burundi (Bujumbura)">Burundi (Bujumbura)</option>
                                <option value="32&&Cambodia (Phnom Penh)">Cambodia (Phnom Penh)</option>
                                <option value="33&&Cameroon (Yaounde)">Cameroon (Yaounde)</option>
                                <option value="34&&Canada">Canada</option>
                                <option value="35&&Cape Verde (Praia)">Cape Verde (Praia)</option>
                                <option value="36&&Cayman Islands (George Town)">Cayman Islands (George Town)</option>
                                <option value="37&&Central African Republic (Bangui)">Central African Republic (Bangui)</option>
                                <option value="38&&Chad (N'Djamena)">Chad (N'Djamena)</option>
                                <option value="39&&Chile (Santiago)">Chile (Santiago)</option>
                                <option value="40&&China (Beijing)">China (Beijing)</option>
                                <option value="41&&Colombia (Bogota)">Colombia (Bogota)</option>
                                <option value="42&&Comros (Moroni)">Comros (Moroni)</option>
                                <option value="43&&Congo (Brazzaville)">Congo (Brazzaville)</option>
                                <option value="44&&Congo (Kinshasa)">Congo (Kinshasa)</option>
                                <option value="45&&Costa Rica (San Jose)">Costa Rica (San Jose)</option>
                                <option value="46&&Cote d'Ivoire (Yamoussoukro)">Cote d'Ivoire (Yamoussoukro)</option>
                                <option value="47&&Croatia (Zagreb)">Croatia (Zagreb)</option>
                                <option value="48&&Cuba (Havana)">Cuba (Havana)</option>
                                <option value="49&&Cyprus (Nicosia)">Cyprus (Nicosia)</option>
                                <option value="50&&Czech Republic (Prague)">Czech Republic (Prague)</option>
                                <option value="51&&Denmark (Copenhagen)">Denmark (Copenhagen)</option>
                                <option value="52&&Djibouti (Djibouti)">Djibouti (Djibouti)</option>
                                <option value="53&&Dominica (Roseau)">Dominica (Roseau)</option>
                                <option value="54&&Dominica Republic (Santo Domingo)">Dominica Republic (Santo Domingo)</option>
                                <option value="55&&East Timor (Dili)">East Timor (Dili)</option>
                                <option value="56&&Ecuador (Quito)">Ecuador (Quito)</option>
                                <option value="57&&Egypt (Cairo)">Egypt (Cairo)</option>
                                <option value="58&&El Salvador (San Salvador)">El Salvador (San Salvador)</option>
                                <option value="59&&Equatorial Guinea (Malabo)">Equatorial Guinea (Malabo)</option>
                                <option value="60&&Eritrea (Asmara)">Eritrea (Asmara)</option>
                                <option value="61&&Estonia (Tallinn)">Estonia (Tallinn)</option>
                                <option value="62&&Ethiopia (Addis Ababa)">Ethiopia (Addis Ababa)</option>
                                <option value="63&&Falkland Islands (Stanley)">Falkland Islands (Stanley)</option>
                                <option value="64&&Faroe Islands (Torshavn)">Faroe Islands (Torshavn)</option>
                                <option value="65&&Fiji (Suva)">Fiji (Suva)</option>
                                <option value="66&&Finland (Helsinki)">Finland (Helsinki)</option>
                                <option value="67&&France (Paris)">France (Paris)</option>
                                <option value="68&&Gabon (Libreville)">Gabon (Libreville)</option>
                                <option value="69&&Gambia (Banjul)">Gambia (Banjul)</option>
                                <option value="70&&Georgia (Tbilisi)">Georgia (Tbilisi)</option>
                                <option value="71&&Germany (Berlin)">Germany (Berlin)</option>
                                <option value="72&&Ghana (Accra)">Ghana (Accra)</option>
                                <option value="73&&Greece (Athens)">Greece (Athens)</option>
                                <option value="74&&Greenland (Nuuk)">Greenland (Nuuk)</option>
                                <option value="75&&Guadeloupe (Basse-Terre)">Guadeloupe (Basse-Terre)</option>
                                <option value="76&&Guatemala (Guatemala)">Guatemala (Guatemala)</option>
                                <option value="77&&Guernsey (St. Peter Port)">Guernsey (St. Peter Port)</option>
                                <option value="78&&Guiana (Cayenne)">Guiana (Cayenne)</option>
                                <option value="79&&Guinea (Conakry)">Guinea (Conakry)</option>
                                <option value="80&&Guinea-Bissau (Bissau)">Guinea-Bissau (Bissau)</option>
                                <option value="81&&Guyana (Georgetown)">Guyana (Georgetown)</option>
                                <option value="82&&Haiti (Port-au-Prince)">Haiti (Port-au-Prince)</option>
                                <option value="83&&Heard and McDonald Islands()">Heard and McDonald Islands()</option>
                                <option value="84&&Honduras (Tegucigalpa)">Honduras (Tegucigalpa)</option>
                                <option value="85&&Hungary (Budapest)">Hungary (Budapest)</option>
                                <option value="86&&Iceland (Reykjavik)">Iceland (Reykjavik)</option>
                                <option value="87&&India (New Delhi)">India (New Delhi)</option>
                                <option value="88&&Indonesia (Jakarta)">Indonesia (Jakarta)</option>
                                <option value="89&&Iran (Tehran)">Iran (Tehran)</option>
                                <option value="90&&Iraq (Baghdad)">Iraq (Baghdad)</option>
                                <option value="91&&Ireland (Dublin)">Ireland (Dublin)</option>
                                <option value="92&&Israel (Jerusalem)">Israel (Jerusalem)</option>
                                <option value="93&&Italy (Rome)">Italy (Rome)</option>
                                <option value="94&&Jamaica (Kingston)">Jamaica (Kingston)</option>
                                <option value="95&&Jordan (Amman)">Jordan (Amman)</option>
                                <option value="96&&Kazakhstan (Astana)">Kazakhstan (Astana)</option>
                                <option value="97&&Kenya (Nairobi)">Kenya (Nairobi)</option>
                                <option value="98&&Kiribati (Tarawa)">Kiribati (Tarawa)</option>
                                <option value="99&&Kuwait (Kuwait)">Kuwait (Kuwait)</option>
                                <option value="100&&Kyrgyzstan (Bishkek)">Kyrgyzstan (Bishkek)</option>
                                <option value="101&&Laos (Vientiane)">Laos (Vientiane)</option>
                                <option value="102&&Latvia (Riga)">Latvia (Riga)</option>
                                <option value="103&&Lebanon (Beirut)">Lebanon (Beirut)</option>
                                <option value="104&&Lesotho (Maseru)">Lesotho (Maseru)</option>
                                <option value="105&&Liberia (Monrovia)">Liberia (Monrovia)</option>
                                <option value="106&&Libya (Tripoli)">Libya (Tripoli)</option>
                                <option value="107&&Liechtenstein (Vaduz)">Liechtenstein (Vaduz)</option>
                                <option value="108&&Lithuania (Vilnius)">Lithuania (Vilnius)</option>
                                <option value="109&&Luxembourg (Luxembourg City)">Luxembourg (Luxembourg City)</option>
                                <option value="110&&Macao, China (Macau)">Macao, China (Macau)</option>
                                <option value="111&&Macedonia (Skopje)">Macedonia (Skopje)</option>
                                <option value="112&&Madagascar (Antananarivo)">Madagascar (Antananarivo)</option>
                                <option value="113&&Malawi (Lilongwe)">Malawi (Lilongwe)</option>
                                <option value="114&&Malaysia (Kuala Lumpur)">Malaysia (Kuala Lumpur)</option>
                                <option value="115&&Maldives (Male)">Maldives (Male)</option>
                                <option value="116&&Mali (Bamako)">Mali (Bamako)</option>
                                <option value="117&&Malta (Valletta)">Malta (Valletta)</option>
                                <option value="118&&Martinique (Fort-de-France)">Martinique (Fort-de-France)</option>
                                <option value="119&&Mauritania (Nouakchott)">Mauritania (Nouakchott)</option>
                                <option value="120&&Mayotte (Mamoudzou)">Mayotte (Mamoudzou)</option>
                                <option value="121&&Mexico (Mexico City)">Mexico (Mexico City)</option>
                                <option value="122&&Micronesia (Palikir)">Micronesia (Palikir)</option>
                                <option value="123&&Moldova (Chisinau)">Moldova (Chisinau)</option>
                                <option value="124&&Mozambique (Maputo)">Mozambique (Maputo)</option>
                                <option value="125&&Myanmar (Yangon)">Myanmar (Yangon)</option>
                                <option value="126&&Namibia (Windhoek)">Namibia (Windhoek)</option>
                                <option value="127&&Nepal (Kathmandu)">Nepal (Kathmandu)</option>
                                <option value="128&&Netherlands (Amsterdam)">Netherlands (Amsterdam)</option>
                                <option value="129&&Netherlands Antilles (Willemstad)">Netherlands Antilles (Willemstad)</option>
                                <option value="130&&New Caledonia (Noumea)">New Caledonia (Noumea)</option>
                                <option value="131&&New Zealand (Wellington)">New Zealand (Wellington)</option>
                                <option value="132&&Nicaragua (Managua)">Nicaragua (Managua)</option>
                                <option value="133&&Niger (Niamey)">Niger (Niamey)</option>
                                <option value="134&&Nigeria (Abuja)">Nigeria (Abuja)</option>
                                <option value="135&&Norfolk Island (Kingston)">Norfolk Island (Kingston)</option>
                                <option value="136&&North Korea (Pyongyang)">North Korea (Pyongyang)</option>
                                <option value="137&&Northern Mariana Islands (Saipan)">Northern Mariana Islands (Saipan)</option>
                                <option value="138&&Norway (Oslo)">Norway (Oslo)</option>
                                <option value="139&&Oman (Muscat)">Oman (Muscat)</option>
                                <option value="140&&Pakistan (Islamabad)">Pakistan (Islamabad)</option>
                                <option value="141&&Palau (Koror)">Palau (Koror)</option>
                                <option value="142&&Panama (Panama City)">Panama (Panama City)</option>
                                <option value="143&&Papua New Guinea (Port Moresby)">Papua New Guinea (Port Moresby)</option>
                                <option value="144&&Paraguay (Asuncion)">Paraguay (Asuncion)</option>
                                <option value="145&&Peru (Lima)">Peru (Lima)</option>
                                <option value="146&&Philippines (Manila)">Philippines (Manila)</option>
                                <option value="147&&Poland (Warsaw)">Poland (Warsaw)</option>
                                <option value="148&&Polynesia (Papeete)">Polynesia (Papeete)</option>
                                <option value="149&&Portugal (Lisbon)">Portugal (Lisbon)</option>
                                <option value="150&&Puerto Rico (San Juan)">Puerto Rico (San Juan)</option>
                                <option value="151&&Qatar (Doha)">Qatar (Doha)</option>
                                <option value="152&&Rawanda (Kigali)">Rawanda (Kigali)</option>
                                <option value="153&&Romania (Bucharest)">Romania (Bucharest)</option>
                                <option value="154&&Russia(Moscow)">Russia(Moscow)</option>
                                <option value="155&&Saint Kitts and Nevis (Basseterre)">Saint Kitts and Nevis (Basseterre)</option>
                                <option value="156&&Saint Lucia (Castries)">Saint Lucia (Castries)</option>
                                <option value="157&&Saint Pierre and Miquelon (Saint-Pierre)">Saint Pierre and Miquelon (Saint-Pierre)</option>
                                <option value="158&&Saint vincent and the Grenadines (Kingstown)">Saint vincent and the Grenadines (Kingstown)</option>
                                <option value="159&&Samoa (Apia)">Samoa (Apia)</option>
                                <option value="160&&San Marino (San Marino)">San Marino (San Marino)</option>
                                <option value="161&&Sao Tome and Principe (Sao Tome)">Sao Tome and Principe (Sao Tome)</option>
                                <option value="162&&Saudi Arabia (Riyadh)">Saudi Arabia (Riyadh)</option>
                                <option value="163&&Senegal (Dakar)">Senegal (Dakar)</option>
                                <option value="164&&Serbia (Belgrade)">Serbia (Belgrade)</option>
                                <option value="165&&Sierra Leone (Freetown)">Sierra Leone (Freetown)</option>
                                <option value="166&&Slovakia (Bratislava)">Slovakia (Bratislava)</option>
                                <option value="167&&Slovenia (Ljubljana)">Slovenia (Ljubljana)</option>
                                <option value="168&&Solomon Islands (Honiara)">Solomon Islands (Honiara)</option>
                                <option value="169&&Somalia (Mogadishu)">Somalia (Mogadishu)</option>
                                <option value="170&&South Africa (Pretoria)">South Africa (Pretoria)</option>
                                <option value="171&&South Korea (Seoul)">South Korea (Seoul)</option>
                                <option value="172&&Spain (Madrid)">Spain (Madrid)</option>
                                <option value="173&&Sudan (Khartoum)">Sudan (Khartoum)</option>
                                <option value="174&&Suriname (Paramaribo)">Suriname (Paramaribo)</option>
                                <option value="175&&Swaziland (Mbabane)">Swaziland (Mbabane)</option>
                                <option value="176&&Sweden (Stockholm)">Sweden (Stockholm)</option>
                                <option value="177&&Switzerland (Bern)">Switzerland (Bern)</option>
                                <option value="178&&Syria (Damascus)">Syria (Damascus)</option>
                                <option value="179&&Tajikistan (Dushanbe)">Tajikistan (Dushanbe)</option>
                                <option value="180&&Tanzania (Dodoma)">Tanzania (Dodoma)</option>
                                <option value="181&&Thailand (Bangkok)">Thailand (Bangkok)</option>
                                <option value="182&&Togo (Lome)">Togo (Lome)</option>
                                <option value="183&&Tonga (Nuku'alofa)">Tonga (Nuku'alofa)</option>
                                <option value="184&&Tunisia (Tunis)">Tunisia (Tunis)</option>
                                <option value="185&&Turkey (Ankara)">Turkey (Ankara)</option>
                                <option value="186&&Turkmenistan (Ashgabat)">Turkmenistan (Ashgabat)</option>
                                <option value="187&&Tuvalu (Funafuti)">Tuvalu (Funafuti)</option>
                                <option value="188&&Uganda (Kampala)">Uganda (Kampala)</option>
                                <option value="189&&Ukraine (Kiev)">Ukraine (Kiev)</option>
                                <option value="190&&United Arab Emirates (Abu Dhabi)">United Arab Emirates (Abu Dhabi)</option>
                                <option value="191&&United Kingdom (London)">United Kingdom (London)</option>
                                <option value="192&&Uruguay (Montevideo)">Uruguay (Montevideo)</option>
                                <option value="193&&US of Virgin Islands (Charlotte Amalie)">US of Virgin Islands (Charlotte Amalie)</option>
                                <option value="194&&USA">USA</option>
                                <option value="195&&Uzbekistan (Tashkent)">Uzbekistan (Tashkent)</option>
                                <option value="196&&Vanuatu (Port-Vila)">Vanuatu (Port-Vila)</option>
                                <option value="197&&Venezuela (Caracas)">Venezuela (Caracas)</option>
                                <option value="198&&Viet Nam (Hanoi)">Viet Nam (Hanoi)</option>
                                <option value="199&&Zambia (Lusaka)">Zambia (Lusaka)</option>
                                <option value="200&&Zimbabwe (Harare)">Zimbabwe (Harare)</option>
                            </select>
                        </div>

                        {{-- Sub-location for Canada --}}
                        @if ($operations2 == '34&&Canada')
                            <div class="col-span-12 md:col-span-6">
                                <label for="operations3" class="label">{{ $lang['8'] ?? 'Province' }}/{{ $lang['9'] ?? 'City' }}</label>
                                <select wire:model.live="operations3" id="operations3" class="input">
                                    <option value="1&&Alberta (Calgary)">Alberta (Calgary)</option>
                                    <option value="2&&Alberta (Edmonton)">Alberta (Edmonton)</option>
                                    <option value="3&&British Columbia (Nelson)">British Columbia (Nelson)</option>
                                    <option value="4&&British Columbia (Vancouver)">British Columbia (Vancouver)</option>
                                    <option value="5&&British Columbia (Victoria)">British Columbia (Victoria)</option>
                                    <option value="6&&Manitoba (Winnipeg)">Manitoba (Winnipeg)</option>
                                    <option value="7&&New Brunswick (Fredericton)">New Brunswick (Fredericton)</option>
                                    <option value="8&&Newfoundland (St. John's)">Newfoundland (St. John's)</option>
                                    <option value="9&&Northwest Territories (Yellowknife)">Northwest Territories (Yellowknife)</option>
                                    <option value="10&&Nova Scotia (Halifax)">Nova Scotia (Halifax)</option>
                                    <option value="11&&Nunavut (Iqaluit)">Nunavut (Iqaluit)</option>
                                    <option value="12&&Ontario (Kingston)">Ontario (Kingston)</option>
                                    <option value="13&&Ontario (London)">Ontario (London)</option>
                                    <option value="14&&Ontario (Ottawa)">Ontario (Ottawa)</option>
                                    <option value="15&&Ontario (Toronto)">Ontario (Toronto)</option>
                                    <option value="16&&Quebec (Montreal)">Quebec (Montreal)</option>
                                    <option value="17&&Quebec (Quebec)">Quebec (Quebec)</option>
                                    <option value="18&&Saskatchewan (Moose Jaw)">Saskatchewan (Moose Jaw)</option>
                                    <option value="19&&Yukon (Whitehorse)">Yukon (Whitehorse)</option>
                                </select>
                            </div>
                        @endif

                        {{-- Sub-location for USA --}}
                        @if ($operations2 == '194&&USA')
                            <div class="col-span-12 md:col-span-6">
                                <label for="operations4" class="label">{{ $lang['11'] ?? 'State/City' }}</label>
                                <select wire:model.live="operations4" id="operations4" class="input">
                                    <option value="1&&Alaska (Anchorage)">Alaska (Anchorage)</option>
                                    <option value="2&&Alaska (Juneau)">Alaska (Juneau)</option>
                                    <option value="3&&Alaska (Sitka)">Alaska (Sitka)</option>
                                    <option value="4&&Alabama (Birmingham)">Alabama (Birmingham)</option>
                                    <option value="5&&Alabama (Mobile)">Alabama (Mobile)</option>
                                    <option value="6&&Alabama (Montgomery)">Alabama (Montgomery)</option>
                                    <option value="7&&Alaska (Nome)">Alaska (Nome)</option>
                                    <option value="8&&Arizona (Flagstaff)">Arizona (Flagstaff)</option>
                                    <option value="9&&Arizona (Phoenix)">Arizona (Phoenix)</option>
                                    <option value="10&&Arkansas (Hot Springs)">Arkansas (Hot Springs)</option>
                                    <option value="11&&California (El Centro)">California (El Centro)</option>
                                    <option value="12&&California (Fresno)">California (Fresno)</option>
                                    <option value="13&&California (Long Beach)">California (Long Beach)</option>
                                    <option value="14&&California (Los Angeles)">California (Los Angeles)</option>
                                    <option value="15&&California (Oakland)">California (Oakland)</option>
                                    <option value="16&&California (Sacramento)">California (Sacramento)</option>
                                    <option value="17&&California (San Diego)">California (San Diego)</option>
                                    <option value="18&&California (San Francisco)">California (San Francisco)</option>
                                    <option value="19&&California (San Jose)">California (San Jose)</option>
                                    <option value="20&&Colorado (Denver)">Colorado (Denver)</option>
                                    <option value="21&&Colorado (Grand Junction)">Colorado (Grand Junction)</option>
                                    <option value="22&&Connecticut (New Haven)">Connecticut (New Haven)</option>
                                    <option value="23&&D.C. (Washington)">D.C. (Washington)</option>
                                    <option value="24&&Florida (Jacksonville)">Florida (Jacksonville)</option>
                                    <option value="25&&Florida (Key West)">Florida (Key West)</option>
                                    <option value="26&&Florida (Miami)">Florida (Miami)</option>
                                    <option value="27&&Florida (Tampa)">Florida (Tampa)</option>
                                    <option value="28&&Georgia (Atlanta)">Georgia (Atlanta)</option>
                                    <option value="29&&Georgia (Savannah)">Georgia (Savannah)</option>
                                    <option value="30&&Hawaii (Honolulu)">Hawaii (Honolulu)</option>
                                    <option value="31&&Idaho (Boise)">Idaho (Boise)</option>
                                    <option value="32&&Idaho (Idaho Falls)">Idaho (Idaho Falls)</option>
                                    <option value="33&&Idaho (Lewiston)">Idaho (Lewiston)</option>
                                    <option value="34&&Illinois (Chicago)">Illinois (Chicago)</option>
                                    <option value="35&&Illinois (Springfield)">Illinois (Springfield)</option>
                                    <option value="36&&Indiana (Indianapolis)">Indiana (Indianapolis)</option>
                                    <option value="37&&Iowa (Des Moines)">Iowa (Des Moines)</option>
                                    <option value="38&&Iowa (Dubuque)">Iowa (Dubuque)</option>
                                    <option value="39&&Kansas (Wichita)">Kansas (Wichita)</option>
                                    <option value="40&&Kentucky (Louisville)">Kentucky (Louisville)</option>
                                    <option value="41&&Louisiana (New Orleans)">Louisiana (New Orleans)</option>
                                    <option value="42&&Louisiana (Shreveport)">Louisiana (Shreveport)</option>
                                    <option value="43&&Maine (Bangor)">Maine (Bangor)</option>
                                    <option value="44&&Maine (Eastport)">Maine (Eastport)</option>
                                    <option value="45&&Maine (Portland)">Maine (Portland)</option>
                                    <option value="46&&Maryland (Baltimore)">Maryland (Baltimore)</option>
                                    <option value="47&&Massachusetts (Boston)">Massachusetts (Boston)</option>
                                    <option value="48&&Massachusetts (Springfield)">Massachusetts (Springfield)</option>
                                    <option value="49&&Michigan (Detroit)">Michigan (Detroit)</option>
                                    <option value="50&&Michigan (Grand Rapids)">Michigan (Grand Rapids)</option>
                                    <option value="51&&Minnesota (Duluth)">Minnesota (Duluth)</option>
                                    <option value="52&&Minnesota (Minneapolis)">Minnesota (Minneapolis)</option>
                                    <option value="53&&Mississippi (Jackson)">Mississippi (Jackson)</option>
                                    <option value="54&&Missouri (Kansas City)">Missouri (Kansas City)</option>
                                    <option value="55&&Missouri (Springfield)">Missouri (Springfield)</option>
                                    <option value="56&&Missouri (St. Louis)">Missouri (St. Louis)</option>
                                    <option value="57&&Montana (Havre)">Montana (Havre)</option>
                                    <option value="58&&Montana (Helena)">Montana (Helena)</option>
                                    <option value="59&&Nebraska (Lincoln)">Nebraska (Lincoln)</option>
                                    <option value="60&&Nebraska (Omaha)">Nebraska (Omaha)</option>
                                    <option value="61&&Nevada (Las Vegas)">Nevada (Las Vegas)</option>
                                    <option value="62&&Nevada (Reno)">Nevada (Reno)</option>
                                    <option value="63&&New Hampshire (Manchester)">New Hampshire (Manchester)</option>
                                    <option value="64&&New Jersey (Newark)">New Jersey (Newark)</option>
                                    <option value="65&&New Mexico (Albuquerque)">New Mexico (Albuquerque)</option>
                                    <option value="66&&New Mexico (Carlsbad)">New Mexico (Carlsbad)</option>
                                    <option value="67&&New Mexico (Santa Fe)">New Mexico (Santa Fe)</option>
                                    <option value="68&&New York (Albany)">New York (Albany)</option>
                                    <option value="69&&New York (Buffalo)">New York (Buffalo)</option>
                                    <option value="70&&New York (New York)">New York (New York)</option>
                                    <option value="71&&New York (Syracuse)">New York (Syracuse)</option>
                                    <option value="72&&North Carolina (Charlotte)">North Carolina (Charlotte)</option>
                                    <option value="73&&North Carolina (Raleigh)">North Carolina (Raleigh)</option>
                                    <option value="74&&North Carolina (Wilmington)">North Carolina (Wilmington)</option>
                                    <option value="75&&North Dakota (Bismarck)">North Dakota (Bismarck)</option>
                                    <option value="76&&North Dakota (Fargo)">North Dakota (Fargo)</option>
                                    <option value="77&&Ohio (Cincinnati)">Ohio (Cincinnati)</option>
                                    <option value="78&&Ohio (Cleveland)">Ohio (Cleveland)</option>
                                    <option value="79&&Ohio (Columbus)">Ohio (Columbus)</option>
                                    <option value="80&&Ohio (Toledo)">Ohio (Toledo)</option>
                                    <option value="81&&Oklahoma (Oklahoma City)">Oklahoma (Oklahoma City)</option>
                                    <option value="82&&Oklahoma (Tulsa)">Oklahoma (Tulsa)</option>
                                    <option value="83&&Oregon (Baker)">Oregon (Baker)</option>
                                    <option value="84&&Oregon (Eugene)">Oregon (Eugene)</option>
                                    <option value="85&&Oregon (Klamath Falls)">Oregon (Klamath Falls)</option>
                                    <option value="86&&Oregon (Portland)">Oregon (Portland)</option>
                                    <option value="87&&Pennsylvania (Philadelphia)">Pennsylvania (Philadelphia)</option>
                                    <option value="88&&Pennsylvania (Pittsburgh)">Pennsylvania (Pittsburgh)</option>
                                    <option value="89&&Puerto Rico (San Juan)">Puerto Rico (San Juan)</option>
                                    <option value="90&&Rhode Island (Providence)">Rhode Island (Providence)</option>
                                    <option value="91&&South Carolina (Charleston)">South Carolina (Charleston)</option>
                                    <option value="92&&South Carolina (Columbia)">South Carolina (Columbia)</option>
                                    <option value="93&&South Dakota (Pierre)">South Dakota (Pierre)</option>
                                    <option value="94&&South Dakota (Sioux Falls)">South Dakota (Sioux Falls)</option>
                                    <option value="95&&Tennessee (Knoxville)">Tennessee (Knoxville)</option>
                                    <option value="96&&Tennessee (Memphis)">Tennessee (Memphis)</option>
                                    <option value="97&&Tennessee (Nashville)">Tennessee (Nashville)</option>
                                    <option value="98&&Texas (Amarillo)">Texas (Amarillo)</option>
                                    <option value="99&&Texas (Austin)">Texas (Austin)</option>
                                    <option value="100&&Texas (Dallas)">Texas (Dallas)</option>
                                    <option value="101&&Texas (El Paso)">Texas (El Paso)</option>
                                    <option value="102&&Texas (Fort Worth)">Texas (Fort Worth)</option>
                                    <option value="103&&Texas (Houston)">Texas (Houston)</option>
                                    <option value="104&&Texas (San Antonio)">Texas (San Antonio)</option>
                                    <option value="105&&Utah (Richfield)">Utah (Richfield)</option>
                                    <option value="106&&Utah (Salt Lake City)">Utah (Salt Lake City)</option>
                                    <option value="107&&Vermont (Montpelier)">Vermont (Montpelier)</option>
                                    <option value="108&&Virginia (Richmond)">Virginia (Richmond)</option>
                                    <option value="109&&Virginia (Roanoke)">Virginia (Roanoke)</option>
                                    <option value="110&&Virginia (Virginia Beach)">Virginia (Virginia Beach)</option>
                                    <option value="111&&Washington (Seattle)">Washington (Seattle)</option>
                                    <option value="112&&Washington (Spokane)">Washington (Spokane)</option>
                                    <option value="113&&West Virginia (Charleston)">West Virginia (Charleston)</option>
                                    <option value="114&&Wisconsin (Milwaukee)">Wisconsin (Milwaukee)</option>
                                    <option value="115&&Wyoming (Cheyenne)">Wyoming (Cheyenne)</option>
                                </select>
                            </div>
                        @endif
                    @endif

                    {{-- Sun Hours (Manual Mode Only) --}}
                    @if ($calculation_type == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="second" class="label">{{ $lang['12'] ?? 'Avg. Sunlight Hours' }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="second" id="second" class="input" placeholder="00" />
                                <span class="absolute right-6 top-4 text-sm text-gray-500">{{ $lang['19'] ?? 'h/day' }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- System Parameters --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="third" class="label">{{ $lang['13'] ?? 'Consumption Efficiency' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="third" id="third" class="input" placeholder="00" />
                            <span class="absolute right-6 top-4 text-sm text-gray-500">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="four" class="label">{{ $lang['14'] ?? 'System Efficiency' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="four" id="four" class="input" placeholder="00" />
                            <span class="absolute right-6 top-4 text-sm text-gray-500">%</span>
                        </div>
                    </div>

                    {{-- Roof Area --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="five" class="label">{{ $lang['15'] ?? 'Available Roof Space' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="five" id="five" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units5')">
                                {{ $units5 }} ▾
                            </label>
                            @if ($openDropdown === 'units5')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                    @foreach (['m²', 'km²', 'ft²', 'yd²', 'mi²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units5', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Panel Specifications --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="six" class="label">{{ $lang['16'] ?? 'Area of One Panel' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="six" id="six" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units6')">
                                {{ $units6 }} ▾
                            </label>
                            @if ($openDropdown === 'units6')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                    @foreach (['cm²', 'm²', 'in²', 'ft²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units6', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="seven" class="label">{{ $lang['17'] ?? 'Panel Wattage' }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="seven" id="seven" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('units7')">
                                {{ $units7 }} ▾
                            </label>
                            @if ($openDropdown === 'units7')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['W', 'kW'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('units7', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="text-left space-y-6 overflow-auto">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full mt-2">
                    <div class="w-full md:w-[100%] overflow-auto">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[18] ?? 'System Capacity' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['sas_ans'], 2) }} (kW)</td>
                            </tr>
                            @if (isset($detail['shph']) && $detail['shph'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[12] ?? 'Avg. Sunlight Hours' }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['shph'] }} ({{ $lang['19'] ?? 'h/day' }})</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[20] ?? 'Total Panels Required' }}</strong></td>
                                <td class="py-2 border-b">{{ $detail['panels_ans'] }} ({{ $lang['21'] ?? 'panels' }})</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[22] ?? 'Total Area Covered' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['area_ans'], 2) }} (m²)</td>
                            </tr>
                        </table>
                        
                        <div class="mt-6 p-4 rounded-lg {{ strpos($detail['line'], 'Oops') !== false ? 'bg-red-50 border border-red-200 text-red-700' : 'bg-green-50 border border-green-200 text-green-700' }}">
                            <p class="text-lg font-medium">
                                @if (strpos($detail['line'], 'Oops') !== false)
                                    ⚠️ {{ $detail['line'] }}
                                @else
                                    ✅ {{ $detail['line'] }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
