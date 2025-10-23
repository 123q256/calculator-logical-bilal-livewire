<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4" id="f1">
                    <div class="space-y-2">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="relative w-full ">
                            <input type="number" name="first" id="first" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first'])?$_POST['first']:'1300' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'yr' }} ▾</label>
                            <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'yr' }}" id="units1" class="hidden">
                            <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'yr')">/yr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'mon')">/mon</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="operations1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <select class="input" name="operations1" id="operations1">
                            <option value="1"
                                {{ isset($_POST['operations1']) && $_POST['operations1'] == '1' ? 'selected' : '' }}>
                                {{ $lang['5'] }}</option>
                            <option value="2"
                                {{ isset($_POST['operations1']) && $_POST['operations1'] == '2' ? 'selected' : '' }}>
                                {{ $lang['6'] }}</option>
                        </select>
                    </div>
                    <div class="space-y-2 hidden" id="country">
                        <label for="operations2" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <select class="input" name="operations2" id="operations2">
                            <option class="hidel" value="1&&Afghanistan"  {{ isset($_POST['operations2']) && $_POST['operations2']=='1&&Afghanistan'?'selected':''}}>Afghanistan</option>
                            <option class="hidel" value="2&&Albania (Tirane)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='2&&Albania (Tirane)'?'selected':''}}>Albania (Tirane)</option>
                            <option class="hidel" value="3&&Algeria (Algiers)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='3&&Algeria (Algiers)'?'selected':''}}>Algeria (Algiers)</option>
                            <option class="hidel" value="4&&Am. Samoa (Pago Pago)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='4&&Am. Samoa (Pago Pago)'?'selected':''}}>Am. Samoa (Pago Pago)</option>
                            <option class="hidel" value="5&&Andorra (Andorra la Vella)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='5&&Andorra (Andorra la Vella)'?'selected':''}}>Andorra (Andorra la Vella)</option>
                            <option class="hidel" value="6&&Angola (Luanda)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='6&&Angola (Luanda)'?'selected':''}}>Angola (Luanda)</option>
                            <option class="hidel" value="7&&Antigua and Barbuda (W. Indies)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='7&&Antigua and Barbuda (W. Indies)'?'selected':''}}> Antigua and Barbuda (W. Indies)</option>
                            <option class="hidel" value="8&&Argentina (Buenos Aires)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='8&&Argentina (Buenos Aires)'?'selected':''}}>Argentina (Buenos Aires)</option>
                            <option class="hidel" value="9&&Armenia (Yerevan)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='9&&Armenia (Yerevan)'?'selected':''}}>Armenia (Yerevan)</option>
                            <option class="hidel" value="10&&Aruba (Oranjestad)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='10&&Aruba (Oranjestad)'?'selected':''}}>Aruba (Oranjestad)</option>
                            <option class="hidel" value="11&&Australia (Canberra)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='11&&Australia (Canberra)'?'selected':''}}>Australia (Canberra)</option>
                            <option class="hidel" value="12&&Austria (Vienna)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='12&&Austria (Vienna)'?'selected':''}}>Austria (Vienna)</option>
                            <option class="hidel" value="13&&Azerbaijan (Baku)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='13&&Azerbaijan (Baku)'?'selected':''}}>Azerbaijan (Baku)</option>
                            <option class="hidel" value="14&&Bahamas (Nassau)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='14&&Bahamas (Nassau)'?'selected':''}}>Bahamas (Nassau)</option>
                            <option class="hidel" value="15&&Bahrain (Manama)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='115&&Bahrain (Manama)'?'selected':''}}>Bahrain (Manama)</option>
                            <option class="hidel" value="16&&Bangladesh (Dhaka)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='16&&Bangladesh (Dhaka)'?'selected':''}}>Bangladesh (Dhaka)</option>
                            <option class="hidel" value="17&&Barbados (Bridgetown)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='17&&Barbados (Bridgetown)'?'selected':''}}>Barbados (Bridgetown)</option>
                            <option class="hidel" value="18&&Belarus (Minsk)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='18&&Belarus (Minsk)'?'selected':''}}>Belarus (Minsk)</option>
                            <option class="hidel" value="19&&Belgium (Brussels)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='19&&Belgium (Brussels)'?'selected':''}}>Belgium (Brussels)</option>
                            <option class="hidel" value="20&&Belize (Belmopan)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='20&&Belize (Belmopan)'?'selected':''}}>Belize (Belmopan)</option>
                            <option class="hidel" value="21&&Benin (Porto-Novo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='21&&Benin (Porto-Novo)'?'selected':''}}>Benin (Porto-Novo)</option>
                            <option class="hidel" value="22&&Bhutan (Thimphu)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='22&&Bhutan (Thimphu)'?'selected':''}}>Bhutan (Thimphu)</option>
                            <option class="hidel" value="23&&Bolivia (La Paz)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='23&&Bolivia (La Paz)'?'selected':''}}>Bolivia (La Paz)</option>
                            <option class="hidel" value="24&&Bosnia and Herzegovina (Sarajevo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='24&&Bosnia and Herzegovina (Sarajevo)'?'selected':''}}> Bosnia and Herzegovina (Sarajevo)</option>
                            <option class="hidel" value="25&&Botswana (Gaborone)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='25&&Botswana (Gaborone)'?'selected':''}}>Botswana (Gaborone)</option>
                            <option class="hidel" value="26&&Brazil (Brasilia)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='26&&Brazil (Brasilia)'?'selected':''}}>Brazil (Brasilia)</option>
                            <option class="hidel" value="27&&British Virgin Islands (Road Town)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='27&&British Virgin Islands (Road Town)'?'selected':''}}> British Virgin Islands (Road Town)</option>
                            <option class="hidel" value="28&&Brunei Darussalam (Bandar Seri Begawan)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='28&&Brunei Darussalam (Bandar Seri Begawan)'?'selected':''}}> Brunei Darussalam (Bandar Seri Begawan)</option>
                            <option class="hidel" value="29&&Bulgaria (Sofia)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='29&&Bulgaria (Sofia)'?'selected':''}}>Bulgaria (Sofia)</option>
                            <option class="hidel" value="30&&Burkina Faso (Ouagadougou)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='30&&Burkina Faso (Ouagadougou)'?'selected':''}}>Burkina Faso (Ouagadougou) </option>
                            <option class="hidel" value="31&&Burundi (Bujumbura)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='31&&Burundi (Bujumbura)'?'selected':''}}>Burundi (Bujumbura)</option>
                            <option class="hidel" value="32&&Cambodia (Phnom Penh)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='32&&Cambodia (Phnom Penh)'?'selected':''}}>Cambodia (Phnom Penh)</option>
                            <option class="hidel" value="33&&Cameroon (Yaounde)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='33&&Cameroon (Yaounde)'?'selected':''}}>Cameroon (Yaounde)</option>
                            <option class="hidel_can" value="34&&Canada"  {{ isset($_POST['operations2']) && $_POST['operations2']=='34&&Canada'?'selected':''}}>Canada</option>
                            <option class="hidel" value="35&&Cape Verde (Praia)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='35&&Cape Verde (Praia)'?'selected':''}}>Cape Verde (Praia)</option>
                            <option class="hidel" value="36&&Cayman Islands (George Town)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='36&&Cayman Islands (George Town)'?'selected':''}}>Cayman Islands (George Town)</option>
                            <option class="hidel" value="37&&Central African Republic (Bangui)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='37&&Central African Republic (Bangui)'?'selected':''}}> Central African Republic (Bangui)</option>
                            <option class="hidel" value="38&&Chad (N'Djamena)"  {{ isset($_POST['operations2']) && $_POST['operations2']=="38&&Chad (N'Djamena)"?'selected':''}}>Chad (N'Djamena)</option>
                            <option class="hidel" value="39&&Chile (Santiago)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='39&&Chile (Santiago)'?'selected':''}}>Chile (Santiago)</option>
                            <option class="hidel" value="40&&China (Beijing)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='40&&China (Beijing)'?'selected':''}}>China (Beijing)</option>
                            <option class="hidel" value="41&&Colombia (Bogota)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='41&&Colombia (Bogota)'?'selected':''}}>Colombia (Bogota)</option>
                            <option class="hidel" value="42&&Comros (Moroni)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='42&&Comros (Moroni)'?'selected':''}}>Comros (Moroni)</option>
                            <option class="hidel" value="43&&Congo (Brazzaville)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='43&&Congo (Brazzaville)'?'selected':''}}>Congo (Brazzaville)</option>
                            <option class="hidel" value="44&&Congo (Kinshasa)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='44&&Congo (Kinshasa)'?'selected':''}}>Congo (Kinshasa)</option>
                            <option class="hidel" value="45&&Costa Rica (San Jose)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='45&&Costa Rica (San Jose)'?'selected':''}}>Costa Rica (San Jose)</option>
                            <option class="hidel" value="46&&Cote d'Ivoire (Yamoussoukro)"  {{ isset($_POST['operations2']) && $_POST['operations2']=="46&&Cote d'Ivoire (Yamoussoukro)"?'selected':''}}>Cote d'Ivoire (Yamoussoukro)</option>
                            <option class="hidel" value="47&&Croatia (Zagreb)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='47&&Croatia (Zagreb)'?'selected':''}}>Croatia (Zagreb)</option>
                            <option class="hidel" value="48&&Cuba (Havana)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='48&&Cuba (Havana)'?'selected':''}}>Cuba (Havana)</option>
                            <option class="hidel" value="49&&Cyprus (Nicosia)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='49&&Cyprus (Nicosia)'?'selected':''}}>Cyprus (Nicosia)</option>
                            <option class="hidel" value="50&&Czech Republic (Prague)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='50&&Czech Republic (Prague)'?'selected':''}}>Czech Republic (Prague)</option>
                            <option class="hidel" value="51&&Denmark (Copenhagen)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='51&&Denmark (Copenhagen)'?'selected':''}}>Denmark (Copenhagen)</option>
                            <option class="hidel" value="52&&Djibouti (Djibouti)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='52&&Djibouti (Djibouti)'?'selected':''}}>Djibouti (Djibouti)</option>
                            <option class="hidel" value="53&&Dominica (Roseau)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='53&&Dominica (Roseau)'?'selected':''}}>Dominica (Roseau)</option>
                            <option class="hidel" value="54&&Dominica Republic (Santo Domingo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='54&&Dominica Republic (Santo Domingo)'?'selected':''}}>Dominica Republic (Santo Domingo)</option>
                            <option class="hidel" value="55&&East Timor (Dili)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='55&&East Timor (Dili)'?'selected':''}}>East Timor (Dili)</option>
                            <option class="hidel" value="56&&Ecuador (Quito)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='56&&Ecuador (Quito)'?'selected':''}}>Ecuador (Quito)</option>
                            <option class="hidel" value="57&&Egypt (Cairo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='57&&Egypt (Cairo)'?'selected':''}}>Egypt (Cairo)</option>
                            <option class="hidel" value="58&&El Salvador (San Salvador)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='58&&El Salvador (San Salvador)'?'selected':''}}>El Salvador (San Salvador)</option>
                            <option class="hidel" value="59&&Equatorial Guinea (Malabo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='59&&Equatorial Guinea (Malabo)'?'selected':''}}>Equatorial Guinea (Malabo)</option>
                            <option class="hidel" value="60&&Eritrea (Asmara)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='60&&Eritrea (Asmara)'?'selected':''}}>Eritrea (Asmara)</option>
                            <option class="hidel" value="61&&Estonia (Tallinn)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='61&&Estonia (Tallinn)'?'selected':''}}>Estonia (Tallinn)</option>
                            <option class="hidel" value="62&&Ethiopia (Addis Ababa)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='62&&Ethiopia (Addis Ababa)'?'selected':''}}>Ethiopia (Addis Ababa)</option>
                            <option class="hidel" value="63&&Falkland Islands (Stanley)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='63&&Falkland Islands (Stanley)'?'selected':''}}>Falkland Islands (Stanley)</option>
                            <option class="hidel" value="64&&Faroe Islands (Torshavn)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='64&&Faroe Islands (Torshavn)'?'selected':''}}>Faroe Islands (Torshavn)</option>
                            <option class="hidel" value="65&&Fiji (Suva)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='65&&Fiji (Suva)'?'selected':''}}>Fiji (Suva)</option>
                            <option class="hidel" value="66&&Finland (Helsinki)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='66&&Finland (Helsinki)'?'selected':''}}>Finland (Helsinki)</option>
                            <option class="hidel" value="67&&France (Paris)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='67&&France (Paris)'?'selected':''}}>France (Paris)</option>
                            <option class="hidel" value="68&&Gabon (Libreville)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='68&&Gabon (Libreville)'?'selected':''}}>Gabon (Libreville)</option>
                            <option class="hidel" value="69&&Gambia (Banjul)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='69&&Gambia (Banjul)'?'selected':''}}>Gambia (Banjul)</option>
                            <option class="hidel" value="70&&Georgia (Tbilisi)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='70&&Georgia (Tbilisi)'?'selected':''}}>Georgia (Tbilisi)</option>
                            <option class="hidel" value="71&&Germany (Berlin)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='71&&Germany (Berlin)'?'selected':''}}>Germany (Berlin)</option>
                            <option class="hidel" value="72&&Ghana (Accra)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='72&&Ghana (Accra)'?'selected':''}}>Ghana (Accra)</option>
                            <option class="hidel" value="73&&Greece (Athens)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='73&&Greece (Athens)'?'selected':''}}>Greece (Athens)</option>
                            <option class="hidel" value="74&&Greenland (Nuuk)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='74&&Greenland (Nuuk)'?'selected':''}}>Greenland (Nuuk)</option>
                            <option class="hidel" value="75&&Guadeloupe (Basse-Terre)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='75&&Guadeloupe (Basse-Terre)'?'selected':''}}>Guadeloupe (Basse-Terre)</option>
                            <option class="hidel" value="76&&Guatemala (Guatemala)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='76&&Guatemala (Guatemala)'?'selected':''}}>Guatemala (Guatemala)</option>
                            <option class="hidel" value="77&&Guernsey (St. Peter Port)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='77&&Guernsey (St. Peter Port)'?'selected':''}}>Guernsey (St. Peter Port)</option>
                            <option class="hidel" value="78&&Guiana (Cayenne)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='78&&Guiana (Cayenne)'?'selected':''}}>Guiana (Cayenne)</option>
                            <option class="hidel" value="79&&Guinea (Conakry)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='79&&Guinea (Conakry)'?'selected':''}}>Guinea (Conakry)</option>
                            <option class="hidel" value="80&&Guinea-Bissau (Bissau)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='80&&Guinea-Bissau (Bissau)'?'selected':''}}>Guinea-Bissau (Bissau)</option>
                            <option class="hidel" value="81&&Guyana (Georgetown)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='81&&Guyana (Georgetown)'?'selected':''}}>Guyana (Georgetown)</option>
                            <option class="hidel" value="82&&Haiti (Port-au-Prince)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='82&&Haiti (Port-au-Prince)'?'selected':''}}>Haiti (Port-au-Prince)</option>
                            <option class="hidel" value="83&&Heard and McDonald Islands()"  {{ isset($_POST['operations2']) && $_POST['operations2']=='83&&Heard and McDonald Islands()'?'selected':''}}>Heard and McDonald Islands()</option>
                            <option class="hidel" value="84&&Honduras (Tegucigalpa)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='84&&Honduras (Tegucigalpa)'?'selected':''}}>Honduras (Tegucigalpa)</option>
                            <option class="hidel" value="85&&Hungary (Budapest)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='85&&Hungary (Budapest)'?'selected':''}}>Hungary (Budapest)</option>
                            <option class="hidel" value="86&&Iceland (Reykjavik)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='86&&Iceland (Reykjavik)'?'selected':''}}>Iceland (Reykjavik)</option>
                            <option class="hidel" value="87&&India (New Delhi)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='87&&India (New Delhi)'?'selected':''}}>India (New Delhi)</option>
                            <option class="hidel" value="88&&Indonesia (Jakarta)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='88&&Indonesia (Jakarta)'?'selected':''}}>Indonesia (Jakarta)</option>
                            <option class="hidel" value="89&&Iran (Tehran)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='89&&Iran (Tehran)'?'selected':''}}>Iran (Tehran)</option>
                            <option class="hidel" value="90&&Iraq (Baghdad)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='90&&Iraq (Baghdad)'?'selected':''}}>Iraq (Baghdad)</option>
                            <option class="hidel" value="91&&Ireland (Dublin)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='91&&Ireland (Dublin)'?'selected':''}}>Ireland (Dublin)</option>
                            <option class="hidel" value="92&&Israel (Jerusalem)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='92&&Israel (Jerusalem)'?'selected':''}}>Israel (Jerusalem)</option>
                            <option class="hidel" value="93&&Italy (Rome)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='93&&Italy (Rome)'?'selected':''}}>Italy (Rome)</option>
                            <option class="hidel" value="94&&Jamaica (Kingston)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='94&&Jamaica (Kingston)'?'selected':''}}>Jamaica (Kingston)</option>
                            <option class="hidel" value="95&&Jordan (Amman)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='95&&Jordan (Amman)'?'selected':''}}>Jordan (Amman)</option>
                            <option class="hidel" value="96&&Kazakhstan (Astana)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='96&&Kazakhstan (Astana)'?'selected':''}}>Kazakhstan (Astana)</option>
                            <option class="hidel" value="97&&Kenya (Nairobi)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='97&&Kenya (Nairobi)'?'selected':''}}>Kenya (Nairobi)</option>
                            <option class="hidel" value="98&&Kiribati (Tarawa)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='98&&Kiribati (Tarawa)'?'selected':''}}>Kiribati (Tarawa)</option>
                            <option class="hidel" value="99&&Kuwait (Kuwait)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='99&&Kuwait (Kuwait)'?'selected':''}}>Kuwait (Kuwait)</option>
                            <option class="hidel" value="100&&Kyrgyzstan (Bishkek)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='100&&Kyrgyzstan (Bishkek)'?'selected':''}}>Kyrgyzstan (Bishkek)</option>
                            <option class="hidel" value="101&&Laos (Vientiane)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='101&&Laos (Vientiane)'?'selected':''}}>Laos (Vientiane)</option>
                            <option class="hidel" value="102&&Latvia (Riga)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='102&&Latvia (Riga)'?'selected':''}}>Latvia (Riga)</option>
                            <option class="hidel" value="103&&Lebanon (Beirut)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='103&&Lebanon (Beirut)'?'selected':''}}>Lebanon (Beirut)</option>
                            <option class="hidel" value="104&&Lesotho (Maseru)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='104&&Lesotho (Maseru)'?'selected':''}}>Lesotho (Maseru)</option>
                            <option class="hidel" value="105&&Liberia (Monrovia)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='105&&Liberia (Monrovia)'?'selected':''}}>Liberia (Monrovia)</option>
                            <option class="hidel" value="106&&Libya (Tripoli)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='106&&Libya (Tripoli)'?'selected':''}}>Libya (Tripoli)</option>
                            <option class="hidel" value="107&&Liechtenstein (Vaduz)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='107&&Liechtenstein (Vaduz)'?'selected':''}}>Liechtenstein (Vaduz)</option>
                            <option class="hidel" value="108&&Lithuania (Vilnius)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='108&&Lithuania (Vilnius)'?'selected':''}}>Lithuania (Vilnius)</option>
                            <option class="hidel" value="109&&Luxembourg (Luxembourg City)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='109&&Luxembourg (Luxembourg City)'?'selected':''}}>Luxembourg (Luxembourg City)</option>
                            <option class="hidel" value="110&&Macao, China (Macau)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='110&&Macao, China (Macau)'?'selected':''}}>Macao, China (Macau)</option>
                            <option class="hidel" value="111&&Macedonia (Skopje)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='111&&Macedonia (Skopje)'?'selected':''}}>Macedonia (Skopje)</option>
                            <option class="hidel" value="112&&Madagascar (Antananarivo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='112&&Madagascar (Antananarivo)'?'selected':''}}>Madagascar (Antananarivo)</option>
                            <option class="hidel" value="113&&Malawi (Lilongwe)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='113&&Malawi (Lilongwe)'?'selected':''}}>Malawi (Lilongwe)</option>
                            <option class="hidel" value="114&&Malaysia (Kuala Lumpur)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='114&&Malaysia (Kuala Lumpur)'?'selected':''}}>Malaysia (Kuala Lumpur)</option>
                            <option class="hidel" value="115&&Maldives (Male)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='115&&Maldives (Male)'?'selected':''}}>Maldives (Male)</option>
                            <option class="hidel" value="116&&Mali (Bamako)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='116&&Mali (Bamako)'?'selected':''}}>Mali (Bamako)</option>
                            <option class="hidel" value="117&&Malta (Valletta)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='117&&Malta (Valletta)'?'selected':''}}>Malta (Valletta)</option>
                            <option class="hidel" value="118&&Martinique (Fort-de-France)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='118&&Martinique (Fort-de-France)'?'selected':''}}>Martinique (Fort-de-France)</option>
                            <option class="hidel" value="119&&Mauritania (Nouakchott)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='119&&Mauritania (Nouakchott)'?'selected':''}}>Mauritania (Nouakchott)</option>
                            <option class="hidel" value="120&&Mayotte (Mamoudzou)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='120&&Mayotte (Mamoudzou)'?'selected':''}}>Mayotte (Mamoudzou)</option>
                            <option class="hidel" value="121&&Mexico (Mexico City)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='121&&Mexico (Mexico City)'?'selected':''}}>Mexico (Mexico City)</option>
                            <option class="hidel" value="122&&Micronesia (Palikir)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='122&&Micronesia (Palikir)'?'selected':''}}>Micronesia (Palikir)</option>
                            <option class="hidel" value="123&&Moldova (Chisinau)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='123&&Moldova (Chisinau)'?'selected':''}}>Moldova (Chisinau)</option>
                            <option class="hidel" value="124&&Mozambique (Maputo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='124&&Mozambique (Maputo)'?'selected':''}}>Mozambique (Maputo)</option>
                            <option class="hidel" value="125&&Myanmar (Yangon)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='125&&Myanmar (Yangon)'?'selected':''}}>Myanmar (Yangon)</option>
                            <option class="hidel" value="126&&Namibia (Windhoek)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='126&&Namibia (Windhoek)'?'selected':''}}>Namibia (Windhoek)</option>
                            <option class="hidel" value="127&&Nepal (Kathmandu)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='127&&Nepal (Kathmandu)'?'selected':''}}>Nepal (Kathmandu)</option>
                            <option class="hidel" value="128&&Netherlands (Amsterdam)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='128&&Netherlands (Amsterdam)'?'selected':''}}>Netherlands (Amsterdam)</option>
                            <option class="hidel" value="129&&Netherlands Antilles (Willemstad)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='129&&Netherlands Antilles (Willemstad)'?'selected':''}}> Netherlands Antilles (Willemstad)</option>
                            <option class="hidel" value="130&&New Caledonia (Noumea)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='130&&New Caledonia (Noumea)'?'selected':''}}>New Caledonia (Noumea)</option>
                            <option class="hidel" value="131&&New Zealand (Wellington)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='131&&New Zealand (Wellington)'?'selected':''}}>New Zealand (Wellington)</option>
                            <option class="hidel" value="132&&Nicaragua (Managua)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='132&&Nicaragua (Managua)'?'selected':''}}>Nicaragua (Managua)</option>
                            <option class="hidel" value="133&&Niger (Niamey)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='133&&Niger (Niamey)'?'selected':''}}>Niger (Niamey)</option>
                            <option class="hidel" value="134&&Nigeria (Abuja)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='134&&Nigeria (Abuja)'?'selected':''}}>Nigeria (Abuja)</option>
                            <option class="hidel" value="135&&Norfolk Island (Kingston)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='135&&Norfolk Island (Kingston)'?'selected':''}}>Norfolk Island (Kingston)</option>
                            <option class="hidel" value="136&&North Korea (Pyongyang)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='136&&North Korea (Pyongyang)'?'selected':''}}>North Korea (Pyongyang)</option>
                            <option class="hidel" value="137&&Northern Mariana Islands (Saipan)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='137&&Northern Mariana Islands (Saipan)'?'selected':''}}>Northern Mariana Islands (Saipan)</option>
                            <option class="hidel" value="138&&Norway (Oslo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='138&&Norway (Oslo)'?'selected':''}}>Norway (Oslo)</option>
                            <option class="hidel" value="139&&Oman (Muscat)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='139&&Oman (Muscat)'?'selected':''}}>Oman (Muscat)</option>
                            <option class="hidel" value="140&&Pakistan (Islamabad)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='140&&Pakistan (Islamabad)'?'selected':''}}>Pakistan (Islamabad)</option>
                            <option class="hidel" value="141&&Palau (Koror)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='141&&Palau (Koror)'?'selected':''}}>Palau (Koror)</option>
                            <option class="hidel" value="142&&Panama (Panama City)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='142&&Panama (Panama City)'?'selected':''}}>Panama (Panama City)</option>
                            <option class="hidel" value="143&&Papua New Guinea (Port Moresby)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='143&&Papua New Guinea (Port Moresby)'?'selected':''}}> Papua New Guinea (Port Moresby)</option>
                            <option class="hidel" value="144&&Paraguay (Asuncion)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='144&&Paraguay (Asuncion)'?'selected':''}}>Paraguay (Asuncion)</option>
                            <option class="hidel" value="145&&Peru (Lima)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='145&&Peru (Lima)'?'selected':''}}>Peru (Lima)</option>
                            <option class="hidel" value="146&&Philippines (Manila)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='146&&Philippines (Manila)'?'selected':''}}>Philippines (Manila)</option>
                            <option class="hidel" value="147&&Poland (Warsaw)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='147&&Poland (Warsaw)'?'selected':''}}>Poland (Warsaw)</option>
                            <option class="hidel" value="148&&Polynesia (Papeete)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='148&&Polynesia (Papeete)'?'selected':''}}>Polynesia (Papeete)</option>
                            <option class="hidel" value="149&&Portugal (Lisbon)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='149&&Portugal (Lisbon)'?'selected':''}}>Portugal (Lisbon)</option>
                            <option class="hidel" value="150&&Puerto Rico (San Juan)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='150&&Puerto Rico (San Juan)'?'selected':''}}>Puerto Rico (San Juan)</option>
                            <option class="hidel" value="151&&Qatar (Doha)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='151&&Qatar (Doha)'?'selected':''}}>Qatar (Doha)</option>
                            <option class="hidel" value="152&&Rawanda (Kigali)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='152&&Rawanda (Kigali)'?'selected':''}}>Rawanda (Kigali)</option>
                            <option class="hidel" value="153&&Romania (Bucharest)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='153&&Romania (Bucharest)'?'selected':''}}>Romania (Bucharest)</option>
                            <option class="hidel" value="154&&Russia(Moscow)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='154&&Russia(Moscow)'?'selected':''}}>Russia(Moscow)</option>
                            <option class="hidel" value="155&&Saint Kitts and Nevis (Basseterre)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='155&&Saint Kitts and Nevis (Basseterre)'?'selected':''}}>Saint Kitts and Nevis (Basseterre)</option>
                            <option class="hidel" value="156&&Saint Lucia (Castries)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='156&&Saint Lucia (Castries)'?'selected':''}}>Saint Lucia (Castries)</option>
                            <option class="hidel" value="157&&Saint Pierre and Miquelon (Saint-Pierre)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='157&&Saint Pierre and Miquelon (Saint-Pierre)'?'selected':''}}> Saint Pierre and Miquelon (Saint-Pierre)</option>
                            <option class="hidel" value="158&&Saint vincent and the Grenadines (Kingstown)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='158&&Saint vincent and the Grenadines (Kingstown)'?'selected':''}}>Saint vincent and the Grenadines (Kingstown)</option>
                            <option class="hidel" value="159&&Samoa (Apia)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='159&&Samoa (Apia)'?'selected':''}}>Samoa (Apia)</option>
                            <option class="hidel" value="160&&San Marino (San Marino)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='160&&San Marino (San Marino)'?'selected':''}}>San Marino (San Marino)</option>
                            <option class="hidel" value="161&&Sao Tome and Principe (Sao Tome)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='161&&Sao Tome and Principe (Sao Tome)'?'selected':''}}>Sao Tome and Principe (Sao Tome)</option>
                            <option class="hidel" value="162&&Saudi Arabia (Riyadh)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='162&&Saudi Arabia (Riyadh)'?'selected':''}}>Saudi Arabia (Riyadh)</option>
                            <option class="hidel" value="163&&Senegal (Dakar)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='163&&Senegal (Dakar)'?'selected':''}}>Senegal (Dakar)</option>
                            <option class="hidel" value="164&&Serbia (Belgrade)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='164&&Serbia (Belgrade)'?'selected':''}}>Serbia (Belgrade)</option>
                            <option class="hidel" value="165&&Sierra Leone (Freetown)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='165&&Sierra Leone (Freetown)'?'selected':''}}>Sierra Leone (Freetown)</option>
                            <option class="hidel" value="166&&Slovakia (Bratislava)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='166&&Slovakia (Bratislava)'?'selected':''}}>Slovakia (Bratislava)</option>
                            <option class="hidel" value="167&&Slovenia (Ljubljana)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='167&&Slovenia (Ljubljana)'?'selected':''}}>Slovenia (Ljubljana)</option>
                            <option class="hidel" value="168&&Solomon Islands (Honiara)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='168&&Solomon Islands (Honiara)'?'selected':''}}>Solomon Islands (Honiara)</option>
                            <option class="hidel" value="169&&Somalia (Mogadishu)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='169&&Somalia (Mogadishu)'?'selected':''}}>Somalia (Mogadishu)</option>
                            <option class="hidel" value="170&&South Africa (Pretoria)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='170&&South Africa (Pretoria)'?'selected':''}}>South Africa (Pretoria)</option>
                            <option class="hidel" value="171&&South Korea (Seoul)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='171&&South Korea (Seoul)'?'selected':''}}>South Korea (Seoul)</option>
                            <option class="hidel" value="172&&Spain (Madrid)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='172&&Spain (Madrid)'?'selected':''}}>Spain (Madrid)</option>
                            <option class="hidel" value="173&&Sudan (Khartoum)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='173&&Sudan (Khartoum)'?'selected':''}}>Sudan (Khartoum)</option>
                            <option class="hidel" value="174&&Suriname (Paramaribo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='174&&Suriname (Paramaribo)'?'selected':''}}>Suriname (Paramaribo) </option>
                            <option class="hidel" value="175&&Swaziland (Mbabane)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='175&&Swaziland (Mbabane)'?'selected':''}}>Swaziland (Mbabane)</option>
                            <option class="hidel" value="176&&Sweden (Stockholm)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='176&&Sweden (Stockholm)'?'selected':''}}>Sweden (Stockholm)</option>
                            <option class="hidel" value="177&&Switzerland (Bern)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='177&&Switzerland (Bern)'?'selected':''}}>Switzerland (Bern)</option>
                            <option class="hidel" value="178&&Syria (Damascus)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='178&&Syria (Damascus)'?'selected':''}}>Syria (Damascus)</option>
                            <option class="hidel" value="179&&Tajikistan (Dushanbe)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='179&&Tajikistan (Dushanbe)'?'selected':''}}>Tajikistan (Dushanbe)</option>
                            <option class="hidel" value="180&&Tanzania (Dodoma)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='180&&Tanzania (Dodoma)'?'selected':''}}>Tanzania (Dodoma)</option>
                            <option class="hidel" value="181&&Thailand (Bangkok)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='181&&Thailand (Bangkok)'?'selected':''}}>Thailand (Bangkok)</option>
                            <option class="hidel" value="182&&Togo (Lome)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='182&&Togo (Lome)'?'selected':''}}>Togo (Lome)</option>
                            <option class="hidel" value="183&&Tonga (Nuku'alofa)"  {{ isset($_POST['operations2']) && $_POST['operations2']=="183&&Tonga (Nuku'alofa)"?'selected':''}}>Tonga (Nuku'alofa)</option>
                            <option class="hidel" value="184&&Tunisia (Tunis)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='184&&Tunisia (Tunis)'?'selected':''}}>Tunisia (Tunis)</option>
                            <option class="hidel" value="185&&Turkey (Ankara)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='185&&Turkey (Ankara)'?'selected':''}}>Turkey (Ankara)</option>
                            <option class="hidel" value="186&&Turkmenistan (Ashgabat)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='186&&Turkmenistan (Ashgabat)'?'selected':''}}>Turkmenistan (Ashgabat)</option>
                            <option class="hidel" value="187&&Tuvalu (Funafuti)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='187&&Tuvalu (Funafuti)'?'selected':''}}>Tuvalu (Funafuti)</option>
                            <option class="hidel" value="188&&Uganda (Kampala)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='188&&Uganda (Kampala)'?'selected':''}}>Uganda (Kampala)</option>
                            <option class="hidel" value="189&&Ukraine (Kiev)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='189&&Ukraine (Kiev)'?'selected':''}}>Ukraine (Kiev)</option>
                            <option class="hidel" value="190&&United Arab Emirates (Abu Dhabi)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='190&&United Arab Emirates (Abu Dhabi)'?'selected':''}}> United Arab Emirates (Abu Dhabi)</option>
                            <option class="hidel" value="191&&United Kingdom (London)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='191&&United Kingdom (London)'?'selected':''}}>United Kingdom (London)</option>
                            <option class="hidel" value="192&&Uruguay (Montevideo)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='192&&Uruguay (Montevideo)'?'selected':''}}>Uruguay (Montevideo)</option>
                            <option class="hidel" value="193&&US of Virgin Islands (Charlotte Amalie)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='193&&US of Virgin Islands (Charlotte Amalie)'?'selected':''}}>US of Virgin Islands (Charlotte Amalie)</option>
                            <option class="hidel_usa" value="194&&USA"  {{ isset($_POST['operations2']) && $_POST['operations2']=='194&&USA'?'selected':''}}>USA</option>
                            <option class="hidel" value="195&&Uzbekistan (Tashkent)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='195&&Uzbekistan (Tashkent)'?'selected':''}}>Uzbekistan (Tashkent)</option>
                            <option class="hidel" value="196&&Vanuatu (Port-Vila)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='196&&Vanuatu (Port-Vila)'?'selected':''}}>Vanuatu (Port-Vila)</option>
                            <option class="hidel" value="197&&Venezuela (Caracas)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='197&&Venezuela (Caracas)'?'selected':''}}>Venezuela (Caracas)</option>
                            <option class="hidel" value="198&&Viet Nam (Hanoi)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='198&&Viet Nam (Hanoi)'?'selected':''}}>Viet Nam (Hanoi)</option>
                            <option class="hidel" value="199&&Zambia (Lusaka)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='199&&Zambia (Lusaka)'?'selected':''}}>Zambia (Lusaka)</option>
                            <option class="hidel" value="200&&Zimbabwe (Harare)"  {{ isset($_POST['operations2']) && $_POST['operations2']=='200&&Zimbabwe (Harare)'?'selected':''}}>Zimbabwe (Harare)</option>
                        </select>
                    </div>
                    <div class="space-y-2 hidden"  id="can_city">
                        <label for="operations3" class="font-s-14 text-blue">{{ $lang['8'] }}/{{ $lang['9'] }}
                            ({{ $lang['10'] }}):</label>
                            <select class="input" name="operations3" id="operations3">
                                <option value="1&&Alberta (Calgary)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='1&&Alberta (Calgary)'?'selected':''}}>Alberta (Calgary)</option>
                                <option value="2&&Alberta (Edmonton)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='2&&Alberta (Edmonton)'?'selected':''}}>Alberta (Edmonton)</option>
                                <option value="3&&British Columbia (Nelson)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='3&&British Columbia (Nelson)'?'selected':''}}>British Columbia (Nelson)</option>
                                <option value="4&&British Columbia (Vancouver)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='4&&British Columbia (Vancouver)'?'selected':''}}>British Columbia (Vancouver)</option>
                                <option value="5&&British Columbia (Victoria)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='5&&British Columbia (Victoria)'?'selected':''}}>British Columbia (Victoria)</option>
                                <option value="6&&Manitoba (Winnipeg)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='6&&Manitoba (Winnipeg)'?'selected':''}}>Manitoba (Winnipeg)</option>
                                <option value="7&&New Brunswick (Fredericton)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='7&&New Brunswick (Fredericton)'?'selected':''}}>New Brunswick (Fredericton)</option>
                                <option value="8&&Newfoundland (St. John's)"  {{ isset($_POST['operations3']) && $_POST['operations3']=="8&&Newfoundland (St. John's)"?'selected':''}}>Newfoundland (St. John's)</option>
                                <option value="9&&Northwest Territories (Yellowknife)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='9&&Northwest Territories (Yellowknife)'?'selected':''}}>Northwest Territories (Yellowknife)</option>
                                <option value="10&&Nova Scotia (Halifax)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='10&&Nova Scotia (Halifax)'?'selected':''}}>Nova Scotia (Halifax)</option>
                                <option value="11&&Nunavut (Iqaluit)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='11&&Nunavut (Iqaluit)'?'selected':''}}>Nunavut (Iqaluit)</option>
                                <option value="12&&Ontario (Kingston)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='12&&Ontario (Kingston)'?'selected':''}}>Ontario (Kingston)</option>
                                <option value="13&&Ontario (London)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='13&&Ontario (London)'?'selected':''}}>Ontario (London)</option>
                                <option value="14&&Ontario (Ottawa)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='14&&Ontario (Ottawa)'?'selected':''}}>Ontario (Ottawa)</option>
                                <option value="15&&Ontario (Toronto)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='15&&Ontario (Toronto)'?'selected':''}}>Ontario (Toronto)</option>
                                <option value="16&&Quebec (Montreal)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='16&&Quebec (Montreal)'?'selected':''}}>Quebec (Montreal)</option>
                                <option value="17&&Quebec (Quebec)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='17&&Quebec (Quebec)'?'selected':''}}>Quebec (Quebec)</option>
                                <option value="18&&Saskatchewan (Moose Jaw)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='18&&Saskatchewan (Moose Jaw)'?'selected':''}} >Saskatchewan (Moose Jaw)</option>
                                <option value="19&&Yukon (Whitehorse)"  {{ isset($_POST['operations3']) && $_POST['operations3']=='19&&Yukon (Whitehorse)'?'selected':''}}>Yukon (Whitehorse)</option>
                            </select>
                    </div>
                    <div class="space-y-2 hidden" id="usa_city">
                        <label for="operations4"
                        class="font-s-14 text-blue">{{ $lang['11'] }}({{ $lang['10'] }}):</label>
                        <select class="input" name="operations4" id="operations4">
                            <option value="1&&Alaska (Anchorage)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='1&&Alaska (Anchorage)'?'selected':''}}>Alaska (Anchorage)</option>
                            <option value="2&&Alaska (Juneau)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='2&&Alaska (Juneau)'?'selected':''}}>Alaska (Juneau)</option>
                            <option value="3&&Alaska (Sitka)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='3&&Alaska (Sitka)'?'selected':''}}>Alaska (Sitka)</option>
                            <option value="4&&Alabama (Birmingham)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='4&&Alabama (Birmingham)'?'selected':''}}>Alabama (Birmingham)</option>
                            <option value="5&&Alabama (Mobile)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='5&&Alabama (Mobile)'?'selected':''}}>Alabama (Mobile)</option>
                            <option value="6&&Alabama (Montgomery)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='6&&Alabama (Montgomery)'?'selected':''}}>Alabama (Montgomery)</option>
                            <option value="7&&Alaska (Nome)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='7&&Alaska (Nome)'?'selected':''}}>Alaska (Nome)</option>
                            <option value="8&&Arizona (Flagstaff)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='8&&Arizona (Flagstaff)'?'selected':''}}>Arizona (Flagstaff)</option>
                            <option value="9&&Arizona (Phoenix)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='9&&Arizona (Phoenix)'?'selected':''}}>Arizona (Phoenix)</option>
                            <option value="10&&Arkansas (Hot Springs)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='10&&Arkansas (Hot Springs)'?'selected':''}}>Arkansas (Hot Springs)</option>
                            <option value="11&&California (El Centro)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='11&&California (El Centro)'?'selected':''}}>California (El Centro)</option>
                            <option value="12&&California (Fresno)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='12&&California (Fresno)'?'selected':''}}>California (Fresno)</option>
                            <option value="13&&California (Long Beach)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='13&&California (Long Beach)'?'selected':''}}>California (Long Beach)</option>
                            <option value="14&&California (Los Angeles)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='14&&California (Los Angeles)'?'selected':''}}>California (Los Angeles)</option>
                            <option value="15&&California (Oakland)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='15&&California (Oakland)'?'selected':''}}>California (Oakland)</option>
                            <option value="16&&California (Sacramento)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='16&&California (Sacramento)'?'selected':''}}>California (Sacramento)</option>
                            <option value="17&&California (San Diego)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='17&&California (San Diego)'?'selected':''}}>California (San Diego)</option>
                            <option value="18&&California (San Francisco)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='18&&California (San Francisco)'?'selected':''}}>California (San Francisco)</option>
                            <option value="19&&California (San Jose)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='19&&California (San Jose)'?'selected':''}}>California (San Jose)</option>
                            <option value="20&&Colorado (Denver)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='20&&Colorado (Denver)'?'selected':''}}>Colorado (Denver)</option>
                            <option value="21&&Colorado (Grand Junction)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='21&&Colorado (Grand Junction)'?'selected':''}}>Colorado (Grand Junction)</option>
                            <option value="22&&Connecticut (New Haven)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='22&&Connecticut (New Haven)'?'selected':''}}>Connecticut (New Haven)</option>
                            <option value="23&&D.C. (Washington)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='23&&D.C. (Washington)'?'selected':''}}>D.C. (Washington)</option>
                            <option value="24&&Florida (Jacksonville)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='24&&Florida (Jacksonville)'?'selected':''}}>Florida (Jacksonville)</option>
                            <option value="25&&Florida (Key West)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='25&&Florida (Key West)'?'selected':''}}>Florida (Key West)</option>
                            <option value="26&&Florida (Miami)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='26&&Florida (Miami)'?'selected':''}}>Florida (Miami)</option>
                            <option value="27&&Florida (Tampa)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='27&&Florida (Tampa)'?'selected':''}}>Florida (Tampa)</option>
                            <option value="28&&Georgia (Atlanta)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='28&&Georgia (Atlanta)'?'selected':''}}>Georgia (Atlanta)</option>
                            <option value="29&&Georgia (Savannah)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='29&&Georgia (Savannah)'?'selected':''}}>Georgia (Savannah)</option>
                            <option value="30&&Hawaii (Honolulu)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='30&&Hawaii (Honolulu)'?'selected':''}}>Hawaii (Honolulu)</option>
                            <option value="31&&Idaho (Boise)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='31&&Idaho (Boise)'?'selected':''}}>Idaho (Boise)</option>
                            <option value="32&&Idaho (Idaho Falls)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='32&&Idaho (Idaho Falls)'?'selected':''}}>Idaho (Idaho Falls)</option>
                            <option value="33&&Idaho (Lewiston)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='33&&Idaho (Lewiston)'?'selected':''}}>Idaho (Lewiston)</option>
                            <option value="34&&Illinois (Chicago)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='34&&Illinois (Chicago)'?'selected':''}}>Illinois (Chicago)</option>
                            <option value="35&&Illinois (Springfield)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='35&&Illinois (Springfield)'?'selected':''}}>Illinois (Springfield)</option>
                            <option value="36&&Indiana (Indianapolis)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='36&&Indiana (Indianapolis)'?'selected':''}}>Indiana (Indianapolis)</option>
                            <option value="37&&Iowa (Des Moines)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='37&&Iowa (Des Moines)'?'selected':''}}>Iowa (Des Moines)</option>
                            <option value="38&&Iowa (Dubuque)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='38&&Iowa (Dubuque)'?'selected':''}}>Iowa (Dubuque)</option>
                            <option value="39&&Kansas (Wichita)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='39&&Kansas (Wichita)'?'selected':''}}>Kansas (Wichita)</option>
                            <option value="40&&Kentucky (Louisville)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='40&&Kentucky (Louisville)'?'selected':''}}>Kentucky (Louisville)</option>
                            <option value="41&&Louisiana (New Orleans)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='41&&Louisiana (New Orleans)'?'selected':''}}>Louisiana (New Orleans)</option>
                            <option value="42&&Louisiana (Shreveport)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='42&&Louisiana (Shreveport)'?'selected':''}}>Louisiana (Shreveport)</option>
                            <option value="43&&Maine (Bangor)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='43&&Maine (Bangor)'?'selected':''}}>Maine (Bangor)</option>
                            <option value="44&&Maine (Eastport)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='44&&Maine (Eastport)'?'selected':''}}>Maine (Eastport)</option>
                            <option value="45&&Maine (Portland)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='45&&Maine (Portland)'?'selected':''}}>Maine (Portland)</option>
                            <option value="46&&Maryland (Baltimore)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='46&&Maryland (Baltimore)'?'selected':''}}>Maryland (Baltimore)</option>
                            <option value="47&&Massachusetts (Boston)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='47&&Massachusetts (Boston)'?'selected':''}}>Massachusetts (Boston)</option>
                            <option value="48&&Massachusetts (Springfield)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='48&&Massachusetts (Springfield)'?'selected':''}}>Massachusetts (Springfield)</option>
                            <option value="49&&Michigan (Detroit)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='49&&Michigan (Detroit)'?'selected':''}}>Michigan (Detroit)</option>
                            <option value="50&&Michigan (Grand Rapids)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='50&&Michigan (Grand Rapids)'?'selected':''}}>Michigan (Grand Rapids)</option>
                            <option value="51&&Minnesota (Duluth)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='51&&Minnesota (Duluth)'?'selected':''}}>Minnesota (Duluth)</option>
                            <option value="52&&Minnesota (Minneapolis)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='52&&Minnesota (Minneapolis)'?'selected':''}}>Minnesota (Minneapolis)</option>
                            <option value="53&&Mississippi (Jackson)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='53&&Mississippi (Jackson)'?'selected':''}}>Mississippi (Jackson)</option>
                            <option value="54&&Missouri (Kansas City)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='54&&Missouri (Kansas City)'?'selected':''}}>Missouri (Kansas City)</option>
                            <option value="55&&Missouri (Springfield)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='55&&Missouri (Springfield)'?'selected':''}}>Missouri (Springfield)</option>
                            <option value="56&&Missouri (St. Louis)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='56&&Missouri (St. Louis)'?'selected':''}}>Missouri (St. Louis)</option>
                            <option value="57&&Montana (Havre)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='57&&Montana (Havre)'?'selected':''}}>Montana (Havre)</option>
                            <option value="58&&Montana (Helena)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='58&&Montana (Helena)'?'selected':''}}>Montana (Helena)</option>
                            <option value="59&&Nebraska (Lincoln)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='59&&Nebraska (Lincoln)'?'selected':''}}>Nebraska (Lincoln)</option>
                            <option value="60&&Nebraska (Omaha)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='60&&Nebraska (Omaha)'?'selected':''}}>Nebraska (Omaha)</option>
                            <option value="61&&Nevada (Las Vegas)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='61&&Nevada (Las Vegas)'?'selected':''}}>Nevada (Las Vegas)</option>
                            <option value="62&&Nevada (Reno)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='62&&Nevada (Reno)'?'selected':''}}>Nevada (Reno)</option>
                            <option value="63&&New Hampshire (Manchester)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='63&&New Hampshire (Manchester)'?'selected':''}}>New Hampshire (Manchester)</option>
                            <option value="64&&New Jersey (Newark)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='64&&New Jersey (Newark)'?'selected':''}}>New Jersey (Newark)</option>
                            <option value="65&&New Mexico (Albuquerque)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='65&&New Mexico (Albuquerque)'?'selected':''}}>New Mexico (Albuquerque)</option>
                            <option value="66&&New Mexico (Carlsbad)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='66&&New Mexico (Carlsbad)'?'selected':''}}>New Mexico (Carlsbad)</option>
                            <option value="67&&New Mexico (Santa Fe)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='67&&New Mexico (Santa Fe)'?'selected':''}}>New Mexico (Santa Fe)</option>
                            <option value="68&&New York (Albany)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='68&&New York (Albany)'?'selected':''}}>New York (Albany)</option>
                            <option value="69&&New York (Buffalo)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='69&&New York (Buffalo)'?'selected':''}}>New York (Buffalo)</option>
                            <option value="70&&New York (New York)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='70&&New York (New York)'?'selected':''}}>New York (New York)</option>
                            <option value="71&&New York (Syracuse)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='71&&New York (Syracuse)'?'selected':''}}>New York (Syracuse)</option>
                            <option value="72&&North Carolina (Charlotte)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='72&&North Carolina (Charlotte)'?'selected':''}}>North Carolina (Charlotte)</option>
                            <option value="73&&North Carolina (Raleigh)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='73&&North Carolina (Raleigh)'?'selected':''}}>North Carolina (Raleigh)</option>
                            <option value="74&&North Carolina (Wilmington)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='74&&North Carolina (Wilmington)'?'selected':''}}>North Carolina (Wilmington)</option>
                            <option value="75&&North Dakota (Bismarck)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='75&&North Dakota (Bismarck)'?'selected':''}}>North Dakota (Bismarck)</option>
                            <option value="76&&North Dakota (Fargo)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='76&&North Dakota (Fargo)'?'selected':''}}>North Dakota (Fargo)</option>
                            <option value="77&&Ohio (Cincinnati)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='77&&Ohio (Cincinnati)'?'selected':''}}>Ohio (Cincinnati)</option>
                            <option value="78&&Ohio (Cleveland)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='78&&Ohio (Cleveland)'?'selected':''}}>Ohio (Cleveland)</option>
                            <option value="79&&Ohio (Columbus)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='79&&Ohio (Columbus)'?'selected':''}}>Ohio (Columbus)</option>
                            <option value="80&&Ohio (Toledo)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='80&&Ohio (Toledo)'?'selected':''}}>Ohio (Toledo)</option>
                            <option value="81&&Oklahoma (Oklahoma City)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='81&&Oklahoma (Oklahoma City)'?'selected':''}}>Oklahoma (Oklahoma City)</option>
                            <option value="82&&Oklahoma (Tulsa)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='82&&Oklahoma (Tulsa)'?'selected':''}}>Oklahoma (Tulsa)</option>
                            <option value="83&&Oregon (Baker)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='83&&Oregon (Baker)'?'selected':''}}>Oregon (Baker)</option>
                            <option value="84&&Oregon (Eugene)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='84&&Oregon (Eugene)'?'selected':''}}>Oregon (Eugene)</option>
                            <option value="85&&Oregon (Klamath Falls)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='85&&Oregon (Klamath Falls)'?'selected':''}}>Oregon (Klamath Falls)</option>
                            <option value="86&&Oregon (Portland)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='86&&Oregon (Portland)'?'selected':''}}>Oregon (Portland)</option>
                            <option value="87&&Pennsylvania (Philadelphia)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='87&&Pennsylvania (Philadelphia)'?'selected':''}}>Pennsylvania (Philadelphia)</option>
                            <option value="88&&Pennsylvania (Pittsburgh)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='88&&Pennsylvania (Pittsburgh)'?'selected':''}}>Pennsylvania (Pittsburgh)</option>
                            <option value="89&&Puerto Rico (San Juan)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='89&&Puerto Rico (San Juan)'?'selected':''}}>Puerto Rico (San Juan)</option>
                            <option value="90&&Rhode Island (Providence)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='90&&Rhode Island (Providence)'?'selected':''}}>Rhode Island (Providence)</option>
                            <option value="91&&South Carolina (Charleston)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='91&&South Carolina (Charleston)'?'selected':''}}>South Carolina (Charleston)</option>
                            <option value="92&&South Carolina (Columbia)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='92&&South Carolina (Columbia)'?'selected':''}}>South Carolina (Columbia)</option>
                            <option value="93&&South Dakota (Pierre)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='93&&South Dakota (Pierre)'?'selected':''}}>South Dakota (Pierre)</option>
                            <option value="94&&South Dakota (Sioux Falls)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='94&&South Dakota (Sioux Falls)'?'selected':''}}>South Dakota (Sioux Falls)</option>
                            <option value="95&&Tennessee (Knoxville)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='95&&Tennessee (Knoxville)'?'selected':''}}>Tennessee (Knoxville)</option>
                            <option value="96&&Tennessee (Memphis)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='96&&Tennessee (Memphis)'?'selected':''}}>Tennessee (Memphis)</option>
                            <option value="97&&Tennessee (Nashville)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='97&&Tennessee (Nashville)'?'selected':''}}>Tennessee (Nashville)</option>
                            <option value="98&&Texas (Amarillo)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='98&&Texas (Amarillo)'?'selected':''}}>Texas (Amarillo)</option>
                            <option value="99&&Texas (Austin)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='99&&Texas (Austin)'?'selected':''}}>Texas (Austin)</option>
                            <option value="100&&Texas (Dallas)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='100&&Texas (Dallas)'?'selected':''}}>Texas (Dallas)</option>
                            <option value="101&&Texas (El Paso)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='101&&Texas (El Paso)'?'selected':''}}>Texas (El Paso)</option>
                            <option value="102&&Texas (Fort Worth)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='102&&Texas (Fort Worth)'?'selected':''}}>Texas (Fort Worth)</option>
                            <option value="103&&Texas (Houston)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='103&&Texas (Houston)'?'selected':''}}>Texas (Houston)</option>
                            <option value="104&&Texas (San Antonio)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='104&&Texas (San Antonio)'?'selected':''}}>Texas (San Antonio)</option>
                            <option value="105&&Utah (Richfield)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='105&&Utah (Richfield)'?'selected':''}}>Utah (Richfield)</option>
                            <option value="106&&Utah (Salt Lake City)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='106&&Utah (Salt Lake City)'?'selected':''}}>Utah (Salt Lake City)</option>
                            <option value="107&&Vermont (Montpelier)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='107&&Vermont (Montpelier)'?'selected':''}}>Vermont (Montpelier)</option>
                            <option value="108&&Virginia (Richmond)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='108&&Virginia (Richmond)'?'selected':''}}>Virginia (Richmond)</option>
                            <option value="109&&Virginia (Roanoke)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='109&&Virginia (Roanoke)'?'selected':''}}>Virginia (Roanoke)</option>
                            <option value="110&&Virginia (Virginia Beach)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='110&&Virginia (Virginia Beach)'?'selected':''}}>Virginia (Virginia Beach)</option>
                            <option value="111&&Washington (Seattle)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='111&&Washington (Seattle)'?'selected':''}}>Washington (Seattle)</option>
                            <option value="112&&Washington (Spokane)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='112&&Washington (Spokane)'?'selected':''}}>Washington (Spokane)</option>
                            <option value="113&&West Virginia (Charleston)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='113&&West Virginia (Charleston)'?'selected':''}}>West Virginia (Charleston)</option>
                            <option value="114&&Wisconsin (Milwaukee)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='114&&Wisconsin (Milwaukee)'?'selected':''}}>Wisconsin (Milwaukee)</option>
                            <option value="115&&Wyoming (Cheyenne)"  {{ isset($_POST['operations4']) && $_POST['operations4']=='115&&Wyoming (Cheyenne)'?'selected':''}}>Wyoming (Cheyenne)</option>
                        </select>
                    </div>
                    <div class="space-y-2 tno relative">
                        <label for="second" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                        <input type="number" step="any" name="second" id="second" class="input"
                                aria-label="input" placeholder="50"
                                value="{{ isset($_POST['second']) ? $_POST['second'] : '50' }}" />
                            <span class="text-blue input_unit txt1">{{ $lang[19] }}</span>
                    </div>
                    <div class="space-y-2 tno relative">
                        <label for="third" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                        <input type="number" step="any" name="third" id="third" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['third']) ? $_POST['third'] : '50' }}" />
                         <span class="text-blue input_unit txt1">%</span>
                    </div>
                    <div class="space-y-2 tno relative">
                        <label for="four" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                        <input type="number" step="any" name="four" id="four" class="input"
                        aria-label="input" placeholder="85"
                        value="{{ isset($_POST['four']) ? $_POST['four'] : '85' }}" />
                    <span class="text-blue input_unit txt1">%</span>
                    </div>
                    <div class="space-y-2" id="f1">
                        <label for="five" class="font-s-14 text-blue">{{ $lang['15'] }}</label>
                        <div class="relative w-full ">
                            <input type="number" name="five" id="five" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five'])?$_POST['five']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units5_dropdown')">{{ isset($_POST['units5'])?$_POST['units5']:'m²' }} ▾</label>
                            <input type="text" name="units5" value="{{ isset($_POST['units5'])?$_POST['units5']:'m²' }}" id="units5" class="hidden">
                            <div id="units5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'm²')">m²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'km²')">km²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'ft²')">ft²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'yd²')">yd²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'mi²')">mi²</p>
                           
                            </div>
                        </div>
                    </div>      
                    <div class="space-y-2" id="f1">
                        <label for="six" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                        <div class="relative w-full ">
                            <input type="number" name="six" id="six" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['six'])?$_POST['six']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units6" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units6_dropdown')">{{ isset($_POST['units6'])?$_POST['units6']:'cm²' }} ▾</label>
                            <input type="text" name="units6" value="{{ isset($_POST['units6'])?$_POST['units6']:'cm²' }}" id="units6" class="hidden">
                            <div id="units6_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'cm²')">cm²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'm²')">m²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'in²')">in²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units6', 'ft²')">ft²</p>
                           
                            </div>
                        </div>
                    </div>    
                    <div class="space-y-2" id="f1">
                        <label for="seven" class="font-s-14 text-blue">{{ $lang['17'] }}</label>
                        <div class="relative w-full ">
                            <input type="number" name="seven" id="seven" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['seven'])?$_POST['seven']:'300' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="units7" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units7_dropdown')">{{ isset($_POST['units7'])?$_POST['units7']:'W' }} ▾</label>
                            <input type="text" name="units7" value="{{ isset($_POST['units7'])?$_POST['units7']:'W' }}" id="units7" class="hidden">
                            <div id="units7_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units7', 'W')">W</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units7', 'kW')">kW</p>
                           
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
                    <div class="w-full  p-3 rounded-lg mt-3">
                        <div class="lg:w-2/3 mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-7/10"><strong>{{ $lang[18] }}</strong></td>
                                    <td class="py-2 border-b border-gray-300">{{ $detail['sas_ans'] }} (kW)</td>
                                </tr>
                                @if(isset($detail['shph']) && $detail['shph']!="")
                                    <tr>
                                        <td class="py-2 border-b border-gray-300 w-7/10"><strong>{{ $lang[12] }}</strong></td>
                                        <td class="py-2 border-b border-gray-300">{{ $detail['shph'] }} ({{ $lang['19'] }})</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-7/10"><strong>{{ $lang[20] }}</strong></td>
                                    <td class="py-2 border-b border-gray-300">{{ $detail['panels_ans'] }} ({{ $lang['21'] }})</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-7/10"><strong>{{ $lang[22] }}</strong></td>
                                    <td class="py-2 border-b border-gray-300">{{ $detail['area_ans'] }} (m²)</td>
                                </tr>
                            </table>
                            <p class="mt-2" id="line">{{ $detail['line'] }}</p>
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
    document.getElementById('operations1').addEventListener('change', function() {
        var cal = this.value;

        if (cal === '1') {
            document.getElementById('country').classList.add('d-none');
            document.getElementById('can_city').classList.add('d-none');
            document.getElementById('usa_city').classList.add('d-none');
            document.querySelectorAll('.tno').forEach(function(element) {
                element.classList.remove('d-none');
            });
        } else if (cal === '2') {
            document.getElementById('country').classList.remove('d-none');
            document.querySelectorAll('.tno').forEach(function(element) {
                element.classList.add('d-none');
            });
        }
    });
});

@if(isset($detail))
    var call = "{{$_POST['operations1']}}";

    if (call === '1') {
        document.getElementById('country').classList.add('d-none');
        document.getElementById('can_city').classList.add('d-none');
        document.getElementById('usa_city').classList.add('d-none');
        document.querySelectorAll('.tno').forEach(function(element) {
            element.classList.remove('d-none');
        });
    } else if (call === '2') {
        document.getElementById('country').classList.remove('d-none');
        document.querySelectorAll('.tno').forEach(function(element) {
            element.classList.add('d-none');
        });
    }
@endif

@if(isset($error))
    var calr = "{{$_POST['operations1']}}";

    if (calr === '1') {
        document.getElementById('country').classList.add('d-none');
        document.getElementById('can_city').classList.add('d-none');
        document.getElementById('usa_city').classList.add('d-none');
        document.querySelectorAll('.tno').forEach(function(element) {
            element.classList.remove('d-none');
        });
    } else if (calr === '2') {
        document.getElementById('country').classList.remove('d-none');
        document.querySelectorAll('.tno').forEach(function(element) {
            element.classList.add('d-none');
        });
    }

@endif

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('operations2').addEventListener('change', function() {
        var cal = this.value;

        if (cal === '34&&Canada') {
            document.getElementById('can_city').classList.remove('d-none');
            document.getElementById('usa_city').classList.add('d-none');
        } else if (cal === '194&&USA') {
            document.getElementById('usa_city').classList.remove('d-none');
            document.getElementById('can_city').classList.add('d-none');
        } else {
            document.getElementById('can_city').classList.add('d-none');
            document.getElementById('usa_city').classList.add('d-none');
        }
    });
});

@if(isset($detail))
    var calx = "{{$_POST['operations2']}}";
    if (calx === '34&amp;&amp;Canada') {
            document.getElementById('can_city').classList.remove('d-none');
            document.getElementById('usa_city').classList.add('d-none');
        } else if (calx === '194&amp;&amp;USA') {
            document.getElementById('usa_city').classList.remove('d-none');
            document.getElementById('can_city').classList.add('d-none');
        } else {
            document.getElementById('can_city').classList.add('d-none');
            document.getElementById('usa_city').classList.add('d-none');
        }
@endif

@if(isset($error))
    var cals = "{{$_POST['operations2']}}";

    if (calx === '34&amp;&amp;Canada') {
            document.getElementById('can_city').classList.remove('d-none');
            document.getElementById('usa_city').classList.add('d-none');
        } else if (calx === '194&amp;&amp;USA') {
            document.getElementById('usa_city').classList.remove('d-none');
            document.getElementById('can_city').classList.add('d-none');
        } else {
            document.getElementById('can_city').classList.add('d-none');
            document.getElementById('usa_city').classList.add('d-none');
        }

@endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>