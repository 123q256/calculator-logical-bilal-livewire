<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">


            <div class="col-span-6">
                <label for="name" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="text" name="name" id="name" class="input" aria-label="input" placeholder="{{ $lang['1'] }}" value="{{ isset($_POST['name'])?$_POST['name']:'' }}" />
                </div>
            </div>
            
            <div class="col-span-6">
                <label for="resident" class="label">{{ $lang['2'] }}:</label>
                <select name="resident" id="resident" class="input my-2">
                    <option value="">[{{$lang[3]}}]</option>
                    <option value="Afghanistan" {{ isset($_POST['resident']) && $_POST['resident'] === "Afghanistan" ? 'selected' : '' }}>Afghanistan</option>
                    <option value="Albania" {{ isset($_POST['resident']) && $_POST['resident'] === "Albania" ? 'selected' : '' }}>Albania</option>
                    <option value="Algeria" {{ isset($_POST['resident']) && $_POST['resident'] === "Algeria" ? 'selected' : '' }}>Algeria</option>
                    <option value="American Samoa" {{ isset($_POST['resident']) && $_POST['resident'] === "American Samoa" ? 'selected' : '' }}>American Samoa</option>
                    <option value="Andorra" {{ isset($_POST['resident']) && $_POST['resident'] === "Andorra" ? 'selected' : '' }}>Andorra</option>
                    <option value="Angola" {{ isset($_POST['resident']) && $_POST['resident'] === "Angola" ? 'selected' : '' }}>Angola</option>
                    <option value="Anguilla" {{ isset($_POST['resident']) && $_POST['resident'] === "Anguilla" ? 'selected' : '' }}>Anguilla</option>
                    <option value="Antarctica" {{ isset($_POST['resident']) && $_POST['resident'] === "Antarctica" ? 'selected' : '' }}>Antarctica</option>
                    <option value="Antigua and Barbuda" {{ isset($_POST['resident']) && $_POST['resident'] === "Antigua and Barbuda" ? 'selected' : '' }}>Antigua and Barbuda</option>
                    <option value="Argentina" {{ isset($_POST['resident']) && $_POST['resident'] === "Argentina" ? 'selected' : '' }}>Argentina</option>
                    <option value="Armenia" {{ isset($_POST['resident']) && $_POST['resident'] === "Armenia" ? 'selected' : '' }}>Armenia</option>
                    <option value="Aruba" {{ isset($_POST['resident']) && $_POST['resident'] === "Aruba" ? 'selected' : '' }}>Aruba</option>
                    <option value="Australia" {{ isset($_POST['resident']) && $_POST['resident'] === "Australia" ? 'selected' : '' }}>Australia</option>
                    <option value="Austria" {{ isset($_POST['resident']) && $_POST['resident'] === "Austria" ? 'selected' : '' }}>Austria</option>
                    <option value="Azerbaijan" {{ isset($_POST['resident']) && $_POST['resident'] === "Azerbaijan" ? 'selected' : '' }}>Azerbaijan</option>
                    <<option value="Bahamas" {{ isset($_POST['resident']) && $_POST['resident'] === "Bahamas" ? 'selected' : '' }}>Bahamas</option>
                    <option value="Bahrain" {{ isset($_POST['resident']) && $_POST['resident'] === "Bahrain" ? 'selected' : '' }}>Bahrain</option>
                    <option value="Bangladesh" {{ isset($_POST['resident']) && $_POST['resident'] === "Bangladesh" ? 'selected' : '' }}>Bangladesh</option>
                    <option value="Barbados" {{ isset($_POST['resident']) && $_POST['resident'] === "Barbados" ? 'selected' : '' }}>Barbados</option>
                    <option value="Belarus" {{ isset($_POST['resident']) && $_POST['resident'] === "Belarus" ? 'selected' : '' }}>Belarus</option>
                    <option value="Belgium" {{ isset($_POST['resident']) && $_POST['resident'] === "Belgium" ? 'selected' : '' }}>Belgium</option>
                    <option value="Belize" {{ isset($_POST['resident']) && $_POST['resident'] === "Belize" ? 'selected' : '' }}>Belize</option>
                    <option value="Benin" {{ isset($_POST['resident']) && $_POST['resident'] === "Benin" ? 'selected' : '' }}>Benin</option>
                    <option value="Bermuda" {{ isset($_POST['resident']) && $_POST['resident'] === "Bermuda" ? 'selected' : '' }}>Bermuda</option>
                    <option value="Bhutan" {{ isset($_POST['resident']) && $_POST['resident'] === "Bhutan" ? 'selected' : '' }}>Bhutan</option>
                    <option value="Bolivia" {{ isset($_POST['resident']) && $_POST['resident'] === "Bolivia" ? 'selected' : '' }}>Bolivia</option>
                    <option value="Bosnia and Herzegovina" {{ isset($_POST['resident']) && $_POST['resident'] === "Bosnia and Herzegovina" ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                    <option value="Botswana" {{ isset($_POST['resident']) && $_POST['resident'] === "Botswana" ? 'selected' : '' }}>Botswana</option>
                    <option value="Bouvet Island" {{ isset($_POST['resident']) && $_POST['resident'] === "Bouvet Island" ? 'selected' : '' }}>Bouvet Island</option>
                    <option value="Brazil" {{ isset($_POST['resident']) && $_POST['resident'] === "Brazil" ? 'selected' : '' }}>Brazil</option>
                    <option value="British Indian Ocean Territory" {{ isset($_POST['resident']) && $_POST['resident'] === "British Indian Ocean Territory" ? 'selected' : '' }}>British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam" {{ isset($_POST['resident']) && $_POST['resident'] === "Brunei Darussalam" ? 'selected' : '' }}>Brunei Darussalam</option>
                    <option value="Bulgaria" {{ isset($_POST['resident']) && $_POST['resident'] === "Bulgaria" ? 'selected' : '' }}>Bulgaria</option>
                    <option value="Burkina Faso" {{ isset($_POST['resident']) && $_POST['resident'] === "Burkina Faso" ? 'selected' : '' }}>Burkina Faso</option>
                    <option value="Burundi" {{ isset($_POST['resident']) && $_POST['resident'] === "Burundi" ? 'selected' : '' }}>Burundi</option>
                    <option value="Cambodia" {{ isset($_POST['resident']) && $_POST['resident'] === "Cambodia" ? 'selected' : '' }}>Cambodia</option>
                    <option value="Cameroon" {{ isset($_POST['resident']) && $_POST['resident'] === "Cameroon" ? 'selected' : '' }}>Cameroon</option>
                    <option value="Canada" {{ isset($_POST['resident']) && $_POST['resident'] === "Canada" ? 'selected' : '' }}>Canada</option>
                    <option value="Cape Verde" {{ isset($_POST['resident']) && $_POST['resident'] === "Cape Verde" ? 'selected' : '' }}>Cape Verde</option>
                    <option value="Cayman Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Cayman Islands" ? 'selected' : '' }}>Cayman Islands</option>
                    <option value="Central African Republic" {{ isset($_POST['resident']) && $_POST['resident'] === "Central African Republic" ? 'selected' : '' }}>Central African Republic</option>
                    <option value="Chad" {{ isset($_POST['resident']) && $_POST['resident'] === "Chad" ? 'selected' : '' }}>Chad</option>
                    <option value="Chile" {{ isset($_POST['resident']) && $_POST['resident'] === "Chile" ? 'selected' : '' }}>Chile</option>
                    <option value="China" {{ isset($_POST['resident']) && $_POST['resident'] === "China" ? 'selected' : '' }}>China</option>
                    <option value="Christmas Island" {{ isset($_POST['resident']) && $_POST['resident'] === "Christmas Island" ? 'selected' : '' }}>Christmas Island</option>
                    <option value="Cocos (Keeling) Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Cocos (Keeling) Islands" ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                    <option value="Colombia" {{ isset($_POST['resident']) && $_POST['resident'] === "Colombia" ? 'selected' : '' }}>Colombia</option>
                    <option value="Comoros" {{ isset($_POST['resident']) && $_POST['resident'] === "Comoros" ? 'selected' : '' }}>Comoros</option>
                    <option value="Congo" {{ isset($_POST['resident']) && $_POST['resident'] === "Congo" ? 'selected' : '' }}>Congo</option>
                    <option value="Cook Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Cook Islands" ? 'selected' : '' }}>Cook Islands</option>
                    <option value="Costa Rica" {{ isset($_POST['resident']) && $_POST['resident'] === "Costa Rica" ? 'selected' : '' }}>Costa Rica</option>
                    <option value="Croatia (Hrvatska)" {{ isset($_POST['resident']) && $_POST['resident'] === "Croatia (Hrvatska)" ? 'selected' : '' }}>Croatia (Hrvatska)</option>
                    <option value="Cuba" {{ isset($_POST['resident']) && $_POST['resident'] === "Cuba" ? 'selected' : '' }}>Cuba</option>
                    <option value="Cyprus" {{ isset($_POST['resident']) && $_POST['resident'] === "Cyprus" ? 'selected' : '' }}>Cyprus</option>
                    <option value="Czech Republic" {{ isset($_POST['resident']) && $_POST['resident'] === "Czech Republic" ? 'selected' : '' }}>Czech Republic</option>
                    <option value="Denmark" {{ isset($_POST['resident']) && $_POST['resident'] === "Denmark" ? 'selected' : '' }}>Denmark</option>
                    <option value="Djibouti" {{ isset($_POST['resident']) && $_POST['resident'] === "Djibouti" ? 'selected' : '' }}>Djibouti</option>
                    <option value="Dominica" {{ isset($_POST['resident']) && $_POST['resident'] === "Dominica" ? 'selected' : '' }}>Dominica</option>
                    <option value="Dominican Republic" {{ isset($_POST['resident']) && $_POST['resident'] === "Dominican Republic" ? 'selected' : '' }}>Dominican Republic</option>
                    <option value="East Timor" {{ isset($_POST['resident']) && $_POST['resident'] === "East Timor" ? 'selected' : '' }}>East Timor</option>
                    <option value="Ecuador" {{ isset($_POST['resident']) && $_POST['resident'] === "Ecuador" ? 'selected' : '' }}>Ecuador</option>
                    <option value="Egypt" {{ isset($_POST['resident']) && $_POST['resident'] === "Egypt" ? 'selected' : '' }}>Egypt</option>
                    <option value="El Salvador" {{ isset($_POST['resident']) && $_POST['resident'] === "El Salvador" ? 'selected' : '' }}>El Salvador</option>
                    <option value="Equatorial Guinea" {{ isset($_POST['resident']) && $_POST['resident'] === "Equatorial Guinea" ? 'selected' : '' }}>Equatorial Guinea</option>
                    <option value="Eritrea" {{ isset($_POST['resident']) && $_POST['resident'] === "Eritrea" ? 'selected' : '' }}>Eritrea</option>
                    <option value="Estonia" {{ isset($_POST['resident']) && $_POST['resident'] === "Estonia" ? 'selected' : '' }}>Estonia</option>
                    <option value="Ethiopia" {{ isset($_POST['resident']) && $_POST['resident'] === "Ethiopia" ? 'selected' : '' }}>Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)" {{ isset($_POST['resident']) && $_POST['resident'] === "Falkland Islands (Malvinas)" ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Faroe Islands" ? 'selected' : '' }}>Faroe Islands</option>
                    <option value="Fiji" {{ isset($_POST['resident']) && $_POST['resident'] === "Fiji" ? 'selected' : '' }}>Fiji</option>
                    <option value="Finland" {{ isset($_POST['resident']) && $_POST['resident'] === "Finland" ? 'selected' : '' }}>Finland</option>
                    <option value="France" {{ isset($_POST['resident']) && $_POST['resident'] === "France" ? 'selected' : '' }}>France</option>
                    <option value="France, Metropolitan" {{ isset($_POST['resident']) && $_POST['resident'] === "France, Metropolitan" ? 'selected' : '' }}>France, Metropolitan</option>
                    <option value="French Guiana" {{ isset($_POST['resident']) && $_POST['resident'] === "French Guiana" ? 'selected' : '' }}>French Guiana</option>
                    <option value="French Polynesia" {{ isset($_POST['resident']) && $_POST['resident'] === "French Polynesia" ? 'selected' : '' }}>French Polynesia</option>
                    <option value="French Southern Territories" {{ isset($_POST['resident']) && $_POST['resident'] === "French Southern Territories" ? 'selected' : '' }}>French Southern Territories</option>
                    <option value="Gabon" {{ isset($_POST['resident']) && $_POST['resident'] === "Gabon" ? 'selected' : '' }}>Gabon</option>
                    <option value="Gambia" {{ isset($_POST['resident']) && $_POST['resident'] === "Gambia" ? 'selected' : '' }}>Gambia</option>
                    <option value="Georgia" {{ isset($_POST['resident']) && $_POST['resident'] === "Georgia" ? 'selected' : '' }}>Georgia</option>
                    <option value="Germany" {{ isset($_POST['resident']) && $_POST['resident'] === "Germany" ? 'selected' : '' }}>Germany</option>
                    <option value="Ghana" {{ isset($_POST['resident']) && $_POST['resident'] === "Ghana" ? 'selected' : '' }}>Ghana</option>
                    <option value="Gibraltar" {{ isset($_POST['resident']) && $_POST['resident'] === "Gibraltar" ? 'selected' : '' }}>Gibraltar</option>
                    <option value="Greece" {{ isset($_POST['resident']) && $_POST['resident'] === "Greece" ? 'selected' : '' }}>Greece</option>
                    <option value="Greenland" {{ isset($_POST['resident']) && $_POST['resident'] === "Greenland" ? 'selected' : '' }}>Greenland</option>
                    <option value="Grenada" {{ isset($_POST['resident']) && $_POST['resident'] === "Grenada" ? 'selected' : '' }}>Grenada</option>
                    <option value="Guadeloupe" {{ isset($_POST['resident']) && $_POST['resident'] === "Guadeloupe" ? 'selected' : '' }}>Guadeloupe</option>
                    <option value="Guam" {{ isset($_POST['resident']) && $_POST['resident'] === "Guam" ? 'selected' : '' }}>Guam</option>
                    <option value="Guatemala" {{ isset($_POST['resident']) && $_POST['resident'] === "Guatemala" ? 'selected' : '' }}>Guatemala</option>
                    <option value="Guernsey" {{ isset($_POST['resident']) && $_POST['resident'] === "Guernsey" ? 'selected' : '' }}>Guernsey</option>
                    <option value="Guinea" {{ isset($_POST['resident']) && $_POST['resident'] === "Guinea" ? 'selected' : '' }}>Guinea</option>
                    <option value="Guinea-Bissau" {{ isset($_POST['resident']) && $_POST['resident'] === "Guinea-Bissau" ? 'selected' : '' }}>Guinea-Bissau</option>
                    <option value="Guyana" {{ isset($_POST['resident']) && $_POST['resident'] === "Guyana" ? 'selected' : '' }}>Guyana</option>
                    <option value="Haiti" {{ isset($_POST['resident']) && $_POST['resident'] === "Haiti" ? 'selected' : '' }}>Haiti</option>
                    <option value="Heard and Mc Donald Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Heard and Mc Donald Islands" ? 'selected' : '' }}>Heard and Mc Donald Islands</option>
                    <option value="Honduras" {{ isset($_POST['resident']) && $_POST['resident'] === "Honduras" ? 'selected' : '' }}>Honduras</option>
                    <option value="Hong Kong" {{ isset($_POST['resident']) && $_POST['resident'] === "Hong Kong" ? 'selected' : '' }}>Hong Kong</option>
                    <option value="Hungary" {{ isset($_POST['resident']) && $_POST['resident'] === "Hungary" ? 'selected' : '' }}>Hungary</option>
                    <option value="Iceland" {{ isset($_POST['resident']) && $_POST['resident'] === "Iceland" ? 'selected' : '' }}>Iceland</option>
                    <option value="India" {{ isset($_POST['resident']) && $_POST['resident'] === "India" ? 'selected' : '' }}>India</option>
                    <option value="Indonesia" {{ isset($_POST['resident']) && $_POST['resident'] === "Indonesia" ? 'selected' : '' }}>Indonesia</option>
                    <option value="Iran (Islamic Republic of)" {{ isset($_POST['resident']) && $_POST['resident'] === "Iran (Islamic Republic of)" ? 'selected' : '' }}>Iran (Islamic Republic of)</option>
                    <option value="Iraq" {{ isset($_POST['resident']) && $_POST['resident'] === "Iraq" ? 'selected' : '' }}>Iraq</option>
                    <option value="Ireland" {{ isset($_POST['resident']) && $_POST['resident'] === "Ireland" ? 'selected' : '' }}>Ireland</option>
                    <option value="Isle of Man" {{ isset($_POST['resident']) && $_POST['resident'] === "Isle of Man" ? 'selected' : '' }}>Isle of Man</option>
                    <option value="Israel" {{ isset($_POST['resident']) && $_POST['resident'] === "Israel" ? 'selected' : '' }}>Israel</option>
                    <option value="Italy" {{ isset($_POST['resident']) && $_POST['resident'] === "Italy" ? 'selected' : '' }}>Italy</option>
                    <option value="Ivory Coast" {{ isset($_POST['resident']) && $_POST['resident'] === "Ivory Coast" ? 'selected' : '' }}>Ivory Coast</option>
                    <option value="Jamaica" {{ isset($_POST['resident']) && $_POST['resident'] === "Jamaica" ? 'selected' : '' }}>Jamaica</option>
                    <option value="Japan" {{ isset($_POST['resident']) && $_POST['resident'] === "Japan" ? 'selected' : '' }}>Japan</option>
                    <option value="Jersey" {{ isset($_POST['resident']) && $_POST['resident'] === "Jersey" ? 'selected' : '' }}>Jersey</option>
                    <option value="Jordan" {{ isset($_POST['resident']) && $_POST['resident'] === "Jordan" ? 'selected' : '' }}>Jordan</option>
                    <option value="Kazakhstan" {{ isset($_POST['resident']) && $_POST['resident'] === "Kazakhstan" ? 'selected' : '' }}>Kazakhstan</option>
                    <option value="Kenya" {{ isset($_POST['resident']) && $_POST['resident'] === "Kenya" ? 'selected' : '' }}>Kenya</option>
                    <option value="Kiribati" {{ isset($_POST['resident']) && $_POST['resident'] === "Kiribati" ? 'selected' : '' }}>Kiribati</option>
                    <option value="Korea, Democratic People's Republic of" {{ isset($_POST['resident']) && $_POST['resident'] === "Korea, Democratic People's Republic of" ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of" {{ isset($_POST['resident']) && $_POST['resident'] === "Korea, Republic of" ? 'selected' : '' }}>Korea, Republic of</option>
                    <option value="Kosovo" {{ isset($_POST['resident']) && $_POST['resident'] === "Kosovo" ? 'selected' : '' }}>Kosovo</option>
                    <option value="Kuwait" {{ isset($_POST['resident']) && $_POST['resident'] === "Kuwait" ? 'selected' : '' }}>Kuwait</option>
                    <option value="Kyrgyzstan" {{ isset($_POST['resident']) && $_POST['resident'] === "Kyrgyzstan" ? 'selected' : '' }}>Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic" {{ isset($_POST['resident']) && $_POST['resident'] === "Lao People's Democratic Republic" ? 'selected' : '' }}>Lao People's Democratic Republic</option>
                    <option value="Latvia" {{ isset($_POST['resident']) && $_POST['resident'] === "Latvia" ? 'selected' : '' }}>Latvia</option>
                    <option value="Lebanon" {{ isset($_POST['resident']) && $_POST['resident'] === "Lebanon" ? 'selected' : '' }}>Lebanon</option>
                    <option value="Lesotho" {{ isset($_POST['resident']) && $_POST['resident'] === "Lesotho" ? 'selected' : '' }}>Lesotho</option>
                    <option value="Liberia" {{ isset($_POST['resident']) && $_POST['resident'] === "Liberia" ? 'selected' : '' }}>Liberia</option>
                    <option value="Libyan Arab Jamahiriya" {{ isset($_POST['resident']) && $_POST['resident'] === "Libyan Arab Jamahiriya" ? 'selected' : '' }}>Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein" {{ isset($_POST['resident']) && $_POST['resident'] === "Liechtenstein" ? 'selected' : '' }}>Liechtenstein</option>
                    <option value="Lithuania" {{ isset($_POST['resident']) && $_POST['resident'] === "Lithuania" ? 'selected' : '' }}>Lithuania</option>
                    <option value="Luxembourg" {{ isset($_POST['resident']) && $_POST['resident'] === "Luxembourg" ? 'selected' : '' }}>Luxembourg</option>
                    <option value="Macau" {{ isset($_POST['resident']) && $_POST['resident'] === "Macau" ? 'selected' : '' }}>Macau</option>
                    <option value="Macedonia" {{ isset($_POST['resident']) && $_POST['resident'] === "Macedonia" ? 'selected' : '' }}>Macedonia</option>
                    <option value="Madagascar" {{ isset($_POST['resident']) && $_POST['resident'] === "Madagascar" ? 'selected' : '' }}>Madagascar</option>
                    <option value="Malawi" {{ isset($_POST['resident']) && $_POST['resident'] === "Malawi" ? 'selected' : '' }}>Malawi</option>
                    <option value="Malaysia" {{ isset($_POST['resident']) && $_POST['resident'] === "Malaysia" ? 'selected' : '' }}>Malaysia</option>
                    <option value="Maldives" {{ isset($_POST['resident']) && $_POST['resident'] === "Maldives" ? 'selected' : '' }}>Maldives</option>
                    <option value="Mali" {{ isset($_POST['resident']) && $_POST['resident'] === "Mali" ? 'selected' : '' }}>Mali</option>
                    <option value="Malta" {{ isset($_POST['resident']) && $_POST['resident'] === "Malta" ? 'selected' : '' }}>Malta</option>
                    <option value="Marshall Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Marshall Islands" ? 'selected' : '' }}>Marshall Islands</option>
                    <option value="Martinique" {{ isset($_POST['resident']) && $_POST['resident'] === "Martinique" ? 'selected' : '' }}>Martinique</option>
                    <option value="Mauritania" {{ isset($_POST['resident']) && $_POST['resident'] === "Mauritania" ? 'selected' : '' }}>Mauritania</option>
                    <option value="Mauritius" {{ isset($_POST['resident']) && $_POST['resident'] === "Mauritius" ? 'selected' : '' }}>Mauritius</option>
                    <option value="Mayotte" {{ isset($_POST['resident']) && $_POST['resident'] === "Mayotte" ? 'selected' : '' }}>Mayotte</option>
                    <option value="Mexico" {{ isset($_POST['resident']) && $_POST['resident'] === "Mexico" ? 'selected' : '' }}>Mexico</option>
                    <option value="Micronesia, Federated States of" {{ isset($_POST['resident']) && $_POST['resident'] === "Micronesia, Federated States of" ? 'selected' : '' }}>Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of" {{ isset($_POST['resident']) && $_POST['resident'] === "Moldova, Republic of" ? 'selected' : '' }}>Moldova, Republic of</option>
                    <option value="Monaco" {{ isset($_POST['resident']) && $_POST['resident'] === "Monaco" ? 'selected' : '' }}>Monaco</option>
                    <option value="Mongolia" {{ isset($_POST['resident']) && $_POST['resident'] === "Mongolia" ? 'selected' : '' }}>Mongolia</option>
                    <option value="Montenegro" {{ isset($_POST['resident']) && $_POST['resident'] === "Montenegro" ? 'selected' : '' }}>Montenegro</option>
                    <option value="Montserrat" {{ isset($_POST['resident']) && $_POST['resident'] === "Montserrat" ? 'selected' : '' }}>Montserrat</option>
                    <option value="Morocco" {{ isset($_POST['resident']) && $_POST['resident'] === "Morocco" ? 'selected' : '' }}>Morocco</option>
                    <option value="Mozambique" {{ isset($_POST['resident']) && $_POST['resident'] === "Mozambique" ? 'selected' : '' }}>Mozambique</option>
                    <option value="Myanmar" {{ isset($_POST['resident']) && $_POST['resident'] === "Myanmar" ? 'selected' : '' }}>Myanmar</option>
                    <option value="Namibia" {{ isset($_POST['resident']) && $_POST['resident'] === "Namibia" ? 'selected' : '' }}>Namibia</option>
                    <option value="Nauru" {{ isset($_POST['resident']) && $_POST['resident'] === "Nauru" ? 'selected' : '' }}>Nauru</option>
                    <option value="Nepal" {{ isset($_POST['resident']) && $_POST['resident'] === "Nepal" ? 'selected' : '' }}>Nepal</option>
                    <option value="Netherlands" {{ isset($_POST['resident']) && $_POST['resident'] === "Netherlands" ? 'selected' : '' }}>Netherlands</option>
                    <option value="Netherlands Antilles" {{ isset($_POST['resident']) && $_POST['resident'] === "Netherlands Antilles" ? 'selected' : '' }}>Netherlands Antilles</option>
                    <option value="New Caledonia" {{ isset($_POST['resident']) && $_POST['resident'] === "New Caledonia" ? 'selected' : '' }}>New Caledonia</option>
                    <option value="New Zealand" {{ isset($_POST['resident']) && $_POST['resident'] === "New Zealand" ? 'selected' : '' }}>New Zealand</option>
                    <option value="Nicaragua" {{ isset($_POST['resident']) && $_POST['resident'] === "Nicaragua" ? 'selected' : '' }}>Nicaragua</option>
                    <option value="Niger" {{ isset($_POST['resident']) && $_POST['resident'] === "Niger" ? 'selected' : '' }}>Niger</option>
                    <option value="Nigeria" {{ isset($_POST['resident']) && $_POST['resident'] === "Nigeria" ? 'selected' : '' }}>Nigeria</option>
                    <option value="Niue" {{ isset($_POST['resident']) && $_POST['resident'] === "Niue" ? 'selected' : '' }}>Niue</option>
                    <option value="Norfolk Island" {{ isset($_POST['resident']) && $_POST['resident'] === "Norfolk Island" ? 'selected' : '' }}>Norfolk Island</option>
                    <option value="Northern Mariana Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Northern Mariana Islands" ? 'selected' : '' }}>Northern Mariana Islands</option>
                    <option value="Norway" {{ isset($_POST['resident']) && $_POST['resident'] === "Norway" ? 'selected' : '' }}>Norway</option>
                    <option value="Oman" {{ isset($_POST['resident']) && $_POST['resident'] === "Oman" ? 'selected' : '' }}>Oman</option>
                    <option value="Pakistan" {{ isset($_POST['resident']) && $_POST['resident'] === "Pakistan" ? 'selected' : '' }}>Pakistan</option>
                    <option value="Palau" {{ isset($_POST['resident']) && $_POST['resident'] === "Palau" ? 'selected' : '' }}>Palau</option>
                    <option value="Palestine" {{ isset($_POST['resident']) && $_POST['resident'] === "Palestine" ? 'selected' : '' }}>Palestine</option>
                    <option value="Panama" {{ isset($_POST['resident']) && $_POST['resident'] === "Panama" ? 'selected' : '' }}>Panama</option>
                    <option value="Papua New Guinea" {{ isset($_POST['resident']) && $_POST['resident'] === "Papua New Guinea" ? 'selected' : '' }}>Papua New Guinea</option>
                    <option value="Paraguay" {{ isset($_POST['resident']) && $_POST['resident'] === "Paraguay" ? 'selected' : '' }}>Paraguay</option>
                    <option value="Peru" {{ isset($_POST['resident']) && $_POST['resident'] === "Peru" ? 'selected' : '' }}>Peru</option>
                    <option value="Philippines" {{ isset($_POST['resident']) && $_POST['resident'] === "Philippines" ? 'selected' : '' }}>Philippines</option>
                    <option value="Pitcairn" {{ isset($_POST['resident']) && $_POST['resident'] === "Pitcairn" ? 'selected' : '' }}>Pitcairn</option>
                    <option value="Poland" {{ isset($_POST['resident']) && $_POST['resident'] === "Poland" ? 'selected' : '' }}>Poland</option>
                    <option value="Portugal" {{ isset($_POST['resident']) && $_POST['resident'] === "Portugal" ? 'selected' : '' }}>Portugal</option>
                    <option value="Puerto Rico" {{ isset($_POST['resident']) && $_POST['resident'] === "Puerto Rico" ? 'selected' : '' }}>Puerto Rico</option>
                    <option value="Qatar" {{ isset($_POST['resident']) && $_POST['resident'] === "Qatar" ? 'selected' : '' }}>Qatar</option>
                    <option value="Reunion" {{ isset($_POST['resident']) && $_POST['resident'] === "Reunion" ? 'selected' : '' }}>Reunion</option>
                    <option value="Romania" {{ isset($_POST['resident']) && $_POST['resident'] === "Romania" ? 'selected' : '' }}>Romania</option>
                    <option value="Russian Federation" {{ isset($_POST['resident']) && $_POST['resident'] === "Russian Federation" ? 'selected' : '' }}>Russian Federation</option>
                    <option value="Rwanda" {{ isset($_POST['resident']) && $_POST['resident'] === "Rwanda" ? 'selected' : '' }}>Rwanda</option>
                    <option value="Saint Kitts and Nevis" {{ isset($_POST['resident']) && $_POST['resident'] === "Saint Kitts and Nevis" ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" {{ isset($_POST['resident']) && $_POST['resident'] === "Saint Lucia" ? 'selected' : '' }}>Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" {{ isset($_POST['resident']) && $_POST['resident'] === "Saint Vincent and the Grenadines" ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                    <option value="Samoa" {{ isset($_POST['resident']) && $_POST['resident'] === "Samoa" ? 'selected' : '' }}>Samoa</option>
                    <option value="San Marino" {{ isset($_POST['resident']) && $_POST['resident'] === "San Marino" ? 'selected' : '' }}>San Marino</option>
                    <option value="Sao Tome and Principe" {{ isset($_POST['resident']) && $_POST['resident'] === "Sao Tome and Principe" ? 'selected' : '' }}>Sao Tome and Principe</option>
                    <option value="Saudi Arabia" {{ isset($_POST['resident']) && $_POST['resident'] === "Saudi Arabia" ? 'selected' : '' }}>Saudi Arabia</option>
                    <option value="Senegal" {{ isset($_POST['resident']) && $_POST['resident'] === "Senegal" ? 'selected' : '' }}>Senegal</option>
                    <option value="Serbia" {{ isset($_POST['resident']) && $_POST['resident'] === "Serbia" ? 'selected' : '' }}>Serbia</option>
                    <option value="Seychelles" {{ isset($_POST['resident']) && $_POST['resident'] === "Seychelles" ? 'selected' : '' }}>Seychelles</option>
                    <option value="Sierra Leone" {{ isset($_POST['resident']) && $_POST['resident'] === "Sierra Leone" ? 'selected' : '' }}>Sierra Leone</option>
                    <option value="Singapore" {{ isset($_POST['resident']) && $_POST['resident'] === "Singapore" ? 'selected' : '' }}>Singapore</option>
                    <option value="Slovakia" {{ isset($_POST['resident']) && $_POST['resident'] === "Slovakia" ? 'selected' : '' }}>Slovakia</option>
                    <option value="Slovenia" {{ isset($_POST['resident']) && $_POST['resident'] === "Slovenia" ? 'selected' : '' }}>Slovenia</option>
                    <option value="Solomon Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Solomon Islands" ? 'selected' : '' }}>Solomon Islands</option>
                    <option value="Somalia" {{ isset($_POST['resident']) && $_POST['resident'] === "Somalia" ? 'selected' : '' }}>Somalia</option>
                    <option value="South Africa" {{ isset($_POST['resident']) && $_POST['resident'] === "South Africa" ? 'selected' : '' }}>South Africa</option>
                    <option value="South Georgia South Sandwich Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "South Georgia South Sandwich Islands" ? 'selected' : '' }}>South Georgia South Sandwich Islands</option>
                    <option value="South Sudan" {{ isset($_POST['resident']) && $_POST['resident'] === "South Sudan" ? 'selected' : '' }}>South Sudan</option>
                    <option value="Spain" {{ isset($_POST['resident']) && $_POST['resident'] === "Spain" ? 'selected' : '' }}>Spain</option>
                    <option value="Sri Lanka" {{ isset($_POST['resident']) && $_POST['resident'] === "Sri Lanka" ? 'selected' : '' }}>Sri Lanka</option>
                    <option value="St. Helena" {{ isset($_POST['resident']) && $_POST['resident'] === "St. Helena" ? 'selected' : '' }}>St. Helena</option>
                    <option value="St. Pierre and Miquelon" {{ isset($_POST['resident']) && $_POST['resident'] === "St. Pierre and Miquelon" ? 'selected' : '' }}>St. Pierre and Miquelon</option>
                    <option value="Sudan" {{ isset($_POST['resident']) && $_POST['resident'] === "Sudan" ? 'selected' : '' }}>Sudan</option>
                    <option value="Suriname" {{ isset($_POST['resident']) && $_POST['resident'] === "Suriname" ? 'selected' : '' }}>Suriname</option>
                    <option value="Svalbard and Jan Mayen Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Svalbard and Jan Mayen Islands" ? 'selected' : '' }}>Svalbard and Jan Mayen Islands</option>
                    <option value="Swaziland" {{ isset($_POST['resident']) && $_POST['resident'] === "Swaziland" ? 'selected' : '' }}>Swaziland</option>
                    <option value="Sweden" {{ isset($_POST['resident']) && $_POST['resident'] === "Sweden" ? 'selected' : '' }}>Sweden</option>
                    <option value="Switzerland" {{ isset($_POST['resident']) && $_POST['resident'] === "Switzerland" ? 'selected' : '' }}>Switzerland</option>
                    <option value="Syrian Arab Republic" {{ isset($_POST['resident']) && $_POST['resident'] === "Syrian Arab Republic" ? 'selected' : '' }}>Syrian Arab Republic</option>
                    <option value="Taiwan" {{ isset($_POST['resident']) && $_POST['resident'] === "Taiwan" ? 'selected' : '' }}>Taiwan</option>
                    <option value="Tajikistan" {{ isset($_POST['resident']) && $_POST['resident'] === "Tajikistan" ? 'selected' : '' }}>Tajikistan</option>
                    <option value="Tanzania, United Republic of" {{ isset($_POST['resident']) && $_POST['resident'] === "Tanzania, United Republic of" ? 'selected' : '' }}>Tanzania, United Republic of</option>
                    <option value="Thailand" {{ isset($_POST['resident']) && $_POST['resident'] === "Thailand" ? 'selected' : '' }}>Thailand</option>
                    <option value="Togo" {{ isset($_POST['resident']) && $_POST['resident'] === "Togo" ? 'selected' : '' }}>Togo</option>
                    <option value="Tokelau" {{ isset($_POST['resident']) && $_POST['resident'] === "Tokelau" ? 'selected' : '' }}>Tokelau</option>
                    <option value="Tonga" {{ isset($_POST['resident']) && $_POST['resident'] === "Tonga" ? 'selected' : '' }}>Tonga</option>
                    <option value="Trinidad and Tobago" {{ isset($_POST['resident']) && $_POST['resident'] === "Trinidad and Tobago" ? 'selected' : '' }}>Trinidad and Tobago</option>
                    <option value="Tunisia" {{ isset($_POST['resident']) && $_POST['resident'] === "Tunisia" ? 'selected' : '' }}>Tunisia</option>
                    <option value="Turkey" {{ isset($_POST['resident']) && $_POST['resident'] === "Turkey" ? 'selected' : '' }}>Turkey</option>
                    <option value="Turkmenistan" {{ isset($_POST['resident']) && $_POST['resident'] === "Turkmenistan" ? 'selected' : '' }}>Turkmenistan</option>
                    <option value="Turks and Caicos Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Turks and Caicos Islands" ? 'selected' : '' }}>Turks and Caicos Islands</option>
                    <option value="Tuvalu" {{ isset($_POST['resident']) && $_POST['resident'] === "Tuvalu" ? 'selected' : '' }}>Tuvalu</option>
                    <option value="Uganda" {{ isset($_POST['resident']) && $_POST['resident'] === "Uganda" ? 'selected' : '' }}>Uganda</option>
                    <option value="Ukraine" {{ isset($_POST['resident']) && $_POST['resident'] === "Ukraine" ? 'selected' : '' }}>Ukraine</option>
                    <option value="United Arab Emirates" {{ isset($_POST['resident']) && $_POST['resident'] === "United Arab Emirates" ? 'selected' : '' }}>United Arab Emirates</option>
                    <option value="United Kingdom" {{ isset($_POST['resident']) && $_POST['resident'] === "United Kingdom" ? 'selected' : '' }}>United Kingdom</option>
                    <option value="United States" {{ isset($_POST['resident']) && $_POST['resident'] === "United States" ? 'selected' : '' }}>United States</option>
                    <option value="United States minor outlying islands" {{ isset($_POST['resident']) && $_POST['resident'] === "United States minor outlying islands" ? 'selected' : '' }}>United States minor outlying islands</option>
                    <option value="Uruguay" {{ isset($_POST['resident']) && $_POST['resident'] === "Uruguay" ? 'selected' : '' }}>Uruguay</option>
                    <option value="Uzbekistan" {{ isset($_POST['resident']) && $_POST['resident'] === "Uzbekistan" ? 'selected' : '' }}>Uzbekistan</option>
                    <option value="Vanuatu" {{ isset($_POST['resident']) && $_POST['resident'] === "Vanuatu" ? 'selected' : '' }}>Vanuatu</option>
                    <option value="Vatican City State" {{ isset($_POST['resident']) && $_POST['resident'] === "Vatican City State" ? 'selected' : '' }}>Vatican City State</option>
                    <option value="Venezuela" {{ isset($_POST['resident']) && $_POST['resident'] === "Venezuela" ? 'selected' : '' }}>Venezuela</option>
                    <option value="Vietnam" {{ isset($_POST['resident']) && $_POST['resident'] === "Vietnam" ? 'selected' : '' }}>Vietnam</option>
                    <option value="Virgin Islands (British)" {{ isset($_POST['resident']) && $_POST['resident'] === "Virgin Islands (British)" ? 'selected' : '' }}>Virgin Islands (British)</option>
                    <option value="Virgin Islands (U.S.)" {{ isset($_POST['resident']) && $_POST['resident'] === "Virgin Islands (U.S.)" ? 'selected' : '' }}>Virgin Islands (U.S.)</option>
                    <option value="Wallis and Futuna Islands" {{ isset($_POST['resident']) && $_POST['resident'] === "Wallis and Futuna Islands" ? 'selected' : '' }}>Wallis and Futuna Islands</option>
                    <option value="Western Sahara" {{ isset($_POST['resident']) && $_POST['resident'] === "Western Sahara" ? 'selected' : '' }}>Western Sahara</option>
                    <option value="Yemen" {{ isset($_POST['resident']) && $_POST['resident'] === "Yemen" ? 'selected' : '' }}>Yemen</option>
                    <option value="Zaire" {{ isset($_POST['resident']) && $_POST['resident'] === "Zaire" ? 'selected' : '' }}>Zaire</option>
                    <option value="Zambia" {{ isset($_POST['resident']) && $_POST['resident'] === "Zambia" ? 'selected' : '' }}>Zambia</option>
                    <option value="Zimbabwe" {{ isset($_POST['resident']) && $_POST['resident'] === "Zimbabwe" ? 'selected' : '' }}>Zimbabwe</option>

                </select>
            </div> 
            <div class="col-span-6 ">
                <label for="nationality" class="label">{{ $lang['4'] }}:</label>
                <select name="nationality" id="nationality" class="input my-2">
                    <option value="">[{{$lang[3]}}]</option>
                    <option value="Afghanistan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Afghanistan" ? 'selected' : '' }}>Afghanistan</option>
                    <option value="Albania" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Albania" ? 'selected' : '' }}>Albania</option>
                    <option value="Algeria" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Algeria" ? 'selected' : '' }}>Algeria</option>
                    <option value="American Samoa" {{ isset($_POST['nationality']) && $_POST['nationality'] === "American Samoa" ? 'selected' : '' }}>American Samoa</option>
                    <option value="Andorra" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Andorra" ? 'selected' : '' }}>Andorra</option>
                    <option value="Angola" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Angola" ? 'selected' : '' }}>Angola</option>
                    <option value="Anguilla" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Anguilla" ? 'selected' : '' }}>Anguilla</option>
                    <option value="Antarctica" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Antarctica" ? 'selected' : '' }}>Antarctica</option>
                    <option value="Antigua and Barbuda" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Antigua and Barbuda" ? 'selected' : '' }}>Antigua and Barbuda</option>
                    <option value="Argentina" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Argentina" ? 'selected' : '' }}>Argentina</option>
                    <option value="Armenia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Armenia" ? 'selected' : '' }}>Armenia</option>
                    <option value="Aruba" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Aruba" ? 'selected' : '' }}>Aruba</option>
                    <option value="Australia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Australia" ? 'selected' : '' }}>Australia</option>
                    <option value="Austria" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Austria" ? 'selected' : '' }}>Austria</option>
                    <option value="Azerbaijan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Azerbaijan" ? 'selected' : '' }}>Azerbaijan</option>
                    <<option value="Bahamas" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bahamas" ? 'selected' : '' }}>Bahamas</option>
                    <option value="Bahrain" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bahrain" ? 'selected' : '' }}>Bahrain</option>
                    <option value="Bangladesh" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bangladesh" ? 'selected' : '' }}>Bangladesh</option>
                    <option value="Barbados" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Barbados" ? 'selected' : '' }}>Barbados</option>
                    <option value="Belarus" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Belarus" ? 'selected' : '' }}>Belarus</option>
                    <option value="Belgium" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Belgium" ? 'selected' : '' }}>Belgium</option>
                    <option value="Belize" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Belize" ? 'selected' : '' }}>Belize</option>
                    <option value="Benin" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Benin" ? 'selected' : '' }}>Benin</option>
                    <option value="Bermuda" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bermuda" ? 'selected' : '' }}>Bermuda</option>
                    <option value="Bhutan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bhutan" ? 'selected' : '' }}>Bhutan</option>
                    <option value="Bolivia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bolivia" ? 'selected' : '' }}>Bolivia</option>
                    <option value="Bosnia and Herzegovina" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bosnia and Herzegovina" ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                    <option value="Botswana" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Botswana" ? 'selected' : '' }}>Botswana</option>
                    <option value="Bouvet Island" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bouvet Island" ? 'selected' : '' }}>Bouvet Island</option>
                    <option value="Brazil" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Brazil" ? 'selected' : '' }}>Brazil</option>
                    <option value="British Indian Ocean Territory" {{ isset($_POST['nationality']) && $_POST['nationality'] === "British Indian Ocean Territory" ? 'selected' : '' }}>British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Brunei Darussalam" ? 'selected' : '' }}>Brunei Darussalam</option>
                    <option value="Bulgaria" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Bulgaria" ? 'selected' : '' }}>Bulgaria</option>
                    <option value="Burkina Faso" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Burkina Faso" ? 'selected' : '' }}>Burkina Faso</option>
                    <option value="Burundi" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Burundi" ? 'selected' : '' }}>Burundi</option>
                    <option value="Cambodia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cambodia" ? 'selected' : '' }}>Cambodia</option>
                    <option value="Cameroon" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cameroon" ? 'selected' : '' }}>Cameroon</option>
                    <option value="Canada" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Canada" ? 'selected' : '' }}>Canada</option>
                    <option value="Cape Verde" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cape Verde" ? 'selected' : '' }}>Cape Verde</option>
                    <option value="Cayman Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cayman Islands" ? 'selected' : '' }}>Cayman Islands</option>
                    <option value="Central African Republic" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Central African Republic" ? 'selected' : '' }}>Central African Republic</option>
                    <option value="Chad" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Chad" ? 'selected' : '' }}>Chad</option>
                    <option value="Chile" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Chile" ? 'selected' : '' }}>Chile</option>
                    <option value="China" {{ isset($_POST['nationality']) && $_POST['nationality'] === "China" ? 'selected' : '' }}>China</option>
                    <option value="Christmas Island" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Christmas Island" ? 'selected' : '' }}>Christmas Island</option>
                    <option value="Cocos (Keeling) Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cocos (Keeling) Islands" ? 'selected' : '' }}>Cocos (Keeling) Islands</option>
                    <option value="Colombia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Colombia" ? 'selected' : '' }}>Colombia</option>
                    <option value="Comoros" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Comoros" ? 'selected' : '' }}>Comoros</option>
                    <option value="Congo" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Congo" ? 'selected' : '' }}>Congo</option>
                    <option value="Cook Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cook Islands" ? 'selected' : '' }}>Cook Islands</option>
                    <option value="Costa Rica" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Costa Rica" ? 'selected' : '' }}>Costa Rica</option>
                    <option value="Croatia (Hrvatska)" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Croatia (Hrvatska)" ? 'selected' : '' }}>Croatia (Hrvatska)</option>
                    <option value="Cuba" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cuba" ? 'selected' : '' }}>Cuba</option>
                    <option value="Cyprus" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Cyprus" ? 'selected' : '' }}>Cyprus</option>
                    <option value="Czech Republic" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Czech Republic" ? 'selected' : '' }}>Czech Republic</option>
                    <option value="Denmark" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Denmark" ? 'selected' : '' }}>Denmark</option>
                    <option value="Djibouti" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Djibouti" ? 'selected' : '' }}>Djibouti</option>
                    <option value="Dominica" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Dominica" ? 'selected' : '' }}>Dominica</option>
                    <option value="Dominican Republic" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Dominican Republic" ? 'selected' : '' }}>Dominican Republic</option>
                    <option value="East Timor" {{ isset($_POST['nationality']) && $_POST['nationality'] === "East Timor" ? 'selected' : '' }}>East Timor</option>
                    <option value="Ecuador" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Ecuador" ? 'selected' : '' }}>Ecuador</option>
                    <option value="Egypt" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Egypt" ? 'selected' : '' }}>Egypt</option>
                    <option value="El Salvador" {{ isset($_POST['nationality']) && $_POST['nationality'] === "El Salvador" ? 'selected' : '' }}>El Salvador</option>
                    <option value="Equatorial Guinea" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Equatorial Guinea" ? 'selected' : '' }}>Equatorial Guinea</option>
                    <option value="Eritrea" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Eritrea" ? 'selected' : '' }}>Eritrea</option>
                    <option value="Estonia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Estonia" ? 'selected' : '' }}>Estonia</option>
                    <option value="Ethiopia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Ethiopia" ? 'selected' : '' }}>Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Falkland Islands (Malvinas)" ? 'selected' : '' }}>Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Faroe Islands" ? 'selected' : '' }}>Faroe Islands</option>
                    <option value="Fiji" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Fiji" ? 'selected' : '' }}>Fiji</option>
                    <option value="Finland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Finland" ? 'selected' : '' }}>Finland</option>
                    <option value="France" {{ isset($_POST['nationality']) && $_POST['nationality'] === "France" ? 'selected' : '' }}>France</option>
                    <option value="France, Metropolitan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "France, Metropolitan" ? 'selected' : '' }}>France, Metropolitan</option>
                    <option value="French Guiana" {{ isset($_POST['nationality']) && $_POST['nationality'] === "French Guiana" ? 'selected' : '' }}>French Guiana</option>
                    <option value="French Polynesia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "French Polynesia" ? 'selected' : '' }}>French Polynesia</option>
                    <option value="French Southern Territories" {{ isset($_POST['nationality']) && $_POST['nationality'] === "French Southern Territories" ? 'selected' : '' }}>French Southern Territories</option>
                    <option value="Gabon" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Gabon" ? 'selected' : '' }}>Gabon</option>
                    <option value="Gambia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Gambia" ? 'selected' : '' }}>Gambia</option>
                    <option value="Georgia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Georgia" ? 'selected' : '' }}>Georgia</option>
                    <option value="Germany" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Germany" ? 'selected' : '' }}>Germany</option>
                    <option value="Ghana" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Ghana" ? 'selected' : '' }}>Ghana</option>
                    <option value="Gibraltar" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Gibraltar" ? 'selected' : '' }}>Gibraltar</option>
                    <option value="Greece" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Greece" ? 'selected' : '' }}>Greece</option>
                    <option value="Greenland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Greenland" ? 'selected' : '' }}>Greenland</option>
                    <option value="Grenada" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Grenada" ? 'selected' : '' }}>Grenada</option>
                    <option value="Guadeloupe" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guadeloupe" ? 'selected' : '' }}>Guadeloupe</option>
                    <option value="Guam" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guam" ? 'selected' : '' }}>Guam</option>
                    <option value="Guatemala" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guatemala" ? 'selected' : '' }}>Guatemala</option>
                    <option value="Guernsey" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guernsey" ? 'selected' : '' }}>Guernsey</option>
                    <option value="Guinea" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guinea" ? 'selected' : '' }}>Guinea</option>
                    <option value="Guinea-Bissau" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guinea-Bissau" ? 'selected' : '' }}>Guinea-Bissau</option>
                    <option value="Guyana" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Guyana" ? 'selected' : '' }}>Guyana</option>
                    <option value="Haiti" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Haiti" ? 'selected' : '' }}>Haiti</option>
                    <option value="Heard and Mc Donald Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Heard and Mc Donald Islands" ? 'selected' : '' }}>Heard and Mc Donald Islands</option>
                    <option value="Honduras" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Honduras" ? 'selected' : '' }}>Honduras</option>
                    <option value="Hong Kong" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Hong Kong" ? 'selected' : '' }}>Hong Kong</option>
                    <option value="Hungary" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Hungary" ? 'selected' : '' }}>Hungary</option>
                    <option value="Iceland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Iceland" ? 'selected' : '' }}>Iceland</option>
                    <option value="India" {{ isset($_POST['nationality']) && $_POST['nationality'] === "India" ? 'selected' : '' }}>India</option>
                    <option value="Indonesia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Indonesia" ? 'selected' : '' }}>Indonesia</option>
                    <option value="Iran (Islamic Republic of)" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Iran (Islamic Republic of)" ? 'selected' : '' }}>Iran (Islamic Republic of)</option>
                    <option value="Iraq" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Iraq" ? 'selected' : '' }}>Iraq</option>
                    <option value="Ireland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Ireland" ? 'selected' : '' }}>Ireland</option>
                    <option value="Isle of Man" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Isle of Man" ? 'selected' : '' }}>Isle of Man</option>
                    <option value="Israel" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Israel" ? 'selected' : '' }}>Israel</option>
                    <option value="Italy" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Italy" ? 'selected' : '' }}>Italy</option>
                    <option value="Ivory Coast" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Ivory Coast" ? 'selected' : '' }}>Ivory Coast</option>
                    <option value="Jamaica" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Jamaica" ? 'selected' : '' }}>Jamaica</option>
                    <option value="Japan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Japan" ? 'selected' : '' }}>Japan</option>
                    <option value="Jersey" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Jersey" ? 'selected' : '' }}>Jersey</option>
                    <option value="Jordan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Jordan" ? 'selected' : '' }}>Jordan</option>
                    <option value="Kazakhstan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Kazakhstan" ? 'selected' : '' }}>Kazakhstan</option>
                    <option value="Kenya" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Kenya" ? 'selected' : '' }}>Kenya</option>
                    <option value="Kiribati" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Kiribati" ? 'selected' : '' }}>Kiribati</option>
                    <option value="Korea, Democratic People's Republic of" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Korea, Democratic People's Republic of" ? 'selected' : '' }}>Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Korea, Republic of" ? 'selected' : '' }}>Korea, Republic of</option>
                    <option value="Kosovo" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Kosovo" ? 'selected' : '' }}>Kosovo</option>
                    <option value="Kuwait" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Kuwait" ? 'selected' : '' }}>Kuwait</option>
                    <option value="Kyrgyzstan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Kyrgyzstan" ? 'selected' : '' }}>Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Lao People's Democratic Republic" ? 'selected' : '' }}>Lao People's Democratic Republic</option>
                    <option value="Latvia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Latvia" ? 'selected' : '' }}>Latvia</option>
                    <option value="Lebanon" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Lebanon" ? 'selected' : '' }}>Lebanon</option>
                    <option value="Lesotho" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Lesotho" ? 'selected' : '' }}>Lesotho</option>
                    <option value="Liberia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Liberia" ? 'selected' : '' }}>Liberia</option>
                    <option value="Libyan Arab Jamahiriya" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Libyan Arab Jamahiriya" ? 'selected' : '' }}>Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Liechtenstein" ? 'selected' : '' }}>Liechtenstein</option>
                    <option value="Lithuania" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Lithuania" ? 'selected' : '' }}>Lithuania</option>
                    <option value="Luxembourg" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Luxembourg" ? 'selected' : '' }}>Luxembourg</option>
                    <option value="Macau" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Macau" ? 'selected' : '' }}>Macau</option>
                    <option value="Macedonia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Macedonia" ? 'selected' : '' }}>Macedonia</option>
                    <option value="Madagascar" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Madagascar" ? 'selected' : '' }}>Madagascar</option>
                    <option value="Malawi" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Malawi" ? 'selected' : '' }}>Malawi</option>
                    <option value="Malaysia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Malaysia" ? 'selected' : '' }}>Malaysia</option>
                    <option value="Maldives" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Maldives" ? 'selected' : '' }}>Maldives</option>
                    <option value="Mali" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mali" ? 'selected' : '' }}>Mali</option>
                    <option value="Malta" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Malta" ? 'selected' : '' }}>Malta</option>
                    <option value="Marshall Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Marshall Islands" ? 'selected' : '' }}>Marshall Islands</option>
                    <option value="Martinique" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Martinique" ? 'selected' : '' }}>Martinique</option>
                    <option value="Mauritania" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mauritania" ? 'selected' : '' }}>Mauritania</option>
                    <option value="Mauritius" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mauritius" ? 'selected' : '' }}>Mauritius</option>
                    <option value="Mayotte" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mayotte" ? 'selected' : '' }}>Mayotte</option>
                    <option value="Mexico" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mexico" ? 'selected' : '' }}>Mexico</option>
                    <option value="Micronesia, Federated States of" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Micronesia, Federated States of" ? 'selected' : '' }}>Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Moldova, Republic of" ? 'selected' : '' }}>Moldova, Republic of</option>
                    <option value="Monaco" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Monaco" ? 'selected' : '' }}>Monaco</option>
                    <option value="Mongolia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mongolia" ? 'selected' : '' }}>Mongolia</option>
                    <option value="Montenegro" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Montenegro" ? 'selected' : '' }}>Montenegro</option>
                    <option value="Montserrat" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Montserrat" ? 'selected' : '' }}>Montserrat</option>
                    <option value="Morocco" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Morocco" ? 'selected' : '' }}>Morocco</option>
                    <option value="Mozambique" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Mozambique" ? 'selected' : '' }}>Mozambique</option>
                    <option value="Myanmar" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Myanmar" ? 'selected' : '' }}>Myanmar</option>
                    <option value="Namibia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Namibia" ? 'selected' : '' }}>Namibia</option>
                    <option value="Nauru" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Nauru" ? 'selected' : '' }}>Nauru</option>
                    <option value="Nepal" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Nepal" ? 'selected' : '' }}>Nepal</option>
                    <option value="Netherlands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Netherlands" ? 'selected' : '' }}>Netherlands</option>
                    <option value="Netherlands Antilles" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Netherlands Antilles" ? 'selected' : '' }}>Netherlands Antilles</option>
                    <option value="New Caledonia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "New Caledonia" ? 'selected' : '' }}>New Caledonia</option>
                    <option value="New Zealand" {{ isset($_POST['nationality']) && $_POST['nationality'] === "New Zealand" ? 'selected' : '' }}>New Zealand</option>
                    <option value="Nicaragua" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Nicaragua" ? 'selected' : '' }}>Nicaragua</option>
                    <option value="Niger" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Niger" ? 'selected' : '' }}>Niger</option>
                    <option value="Nigeria" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Nigeria" ? 'selected' : '' }}>Nigeria</option>
                    <option value="Niue" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Niue" ? 'selected' : '' }}>Niue</option>
                    <option value="Norfolk Island" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Norfolk Island" ? 'selected' : '' }}>Norfolk Island</option>
                    <option value="Northern Mariana Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Northern Mariana Islands" ? 'selected' : '' }}>Northern Mariana Islands</option>
                    <option value="Norway" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Norway" ? 'selected' : '' }}>Norway</option>
                    <option value="Oman" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Oman" ? 'selected' : '' }}>Oman</option>
                    <option value="Pakistan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Pakistan" ? 'selected' : '' }}>Pakistan</option>
                    <option value="Palau" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Palau" ? 'selected' : '' }}>Palau</option>
                    <option value="Palestine" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Palestine" ? 'selected' : '' }}>Palestine</option>
                    <option value="Panama" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Panama" ? 'selected' : '' }}>Panama</option>
                    <option value="Papua New Guinea" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Papua New Guinea" ? 'selected' : '' }}>Papua New Guinea</option>
                    <option value="Paraguay" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Paraguay" ? 'selected' : '' }}>Paraguay</option>
                    <option value="Peru" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Peru" ? 'selected' : '' }}>Peru</option>
                    <option value="Philippines" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Philippines" ? 'selected' : '' }}>Philippines</option>
                    <option value="Pitcairn" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Pitcairn" ? 'selected' : '' }}>Pitcairn</option>
                    <option value="Poland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Poland" ? 'selected' : '' }}>Poland</option>
                    <option value="Portugal" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Portugal" ? 'selected' : '' }}>Portugal</option>
                    <option value="Puerto Rico" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Puerto Rico" ? 'selected' : '' }}>Puerto Rico</option>
                    <option value="Qatar" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Qatar" ? 'selected' : '' }}>Qatar</option>
                    <option value="Reunion" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Reunion" ? 'selected' : '' }}>Reunion</option>
                    <option value="Romania" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Romania" ? 'selected' : '' }}>Romania</option>
                    <option value="Russian Federation" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Russian Federation" ? 'selected' : '' }}>Russian Federation</option>
                    <option value="Rwanda" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Rwanda" ? 'selected' : '' }}>Rwanda</option>
                    <option value="Saint Kitts and Nevis" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Saint Kitts and Nevis" ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Saint Lucia" ? 'selected' : '' }}>Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Saint Vincent and the Grenadines" ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                    <option value="Samoa" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Samoa" ? 'selected' : '' }}>Samoa</option>
                    <option value="San Marino" {{ isset($_POST['nationality']) && $_POST['nationality'] === "San Marino" ? 'selected' : '' }}>San Marino</option>
                    <option value="Sao Tome and Principe" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Sao Tome and Principe" ? 'selected' : '' }}>Sao Tome and Principe</option>
                    <option value="Saudi Arabia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Saudi Arabia" ? 'selected' : '' }}>Saudi Arabia</option>
                    <option value="Senegal" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Senegal" ? 'selected' : '' }}>Senegal</option>
                    <option value="Serbia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Serbia" ? 'selected' : '' }}>Serbia</option>
                    <option value="Seychelles" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Seychelles" ? 'selected' : '' }}>Seychelles</option>
                    <option value="Sierra Leone" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Sierra Leone" ? 'selected' : '' }}>Sierra Leone</option>
                    <option value="Singapore" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Singapore" ? 'selected' : '' }}>Singapore</option>
                    <option value="Slovakia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Slovakia" ? 'selected' : '' }}>Slovakia</option>
                    <option value="Slovenia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Slovenia" ? 'selected' : '' }}>Slovenia</option>
                    <option value="Solomon Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Solomon Islands" ? 'selected' : '' }}>Solomon Islands</option>
                    <option value="Somalia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Somalia" ? 'selected' : '' }}>Somalia</option>
                    <option value="South Africa" {{ isset($_POST['nationality']) && $_POST['nationality'] === "South Africa" ? 'selected' : '' }}>South Africa</option>
                    <option value="South Georgia South Sandwich Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "South Georgia South Sandwich Islands" ? 'selected' : '' }}>South Georgia South Sandwich Islands</option>
                    <option value="South Sudan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "South Sudan" ? 'selected' : '' }}>South Sudan</option>
                    <option value="Spain" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Spain" ? 'selected' : '' }}>Spain</option>
                    <option value="Sri Lanka" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Sri Lanka" ? 'selected' : '' }}>Sri Lanka</option>
                    <option value="St. Helena" {{ isset($_POST['nationality']) && $_POST['nationality'] === "St. Helena" ? 'selected' : '' }}>St. Helena</option>
                    <option value="St. Pierre and Miquelon" {{ isset($_POST['nationality']) && $_POST['nationality'] === "St. Pierre and Miquelon" ? 'selected' : '' }}>St. Pierre and Miquelon</option>
                    <option value="Sudan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Sudan" ? 'selected' : '' }}>Sudan</option>
                    <option value="Suriname" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Suriname" ? 'selected' : '' }}>Suriname</option>
                    <option value="Svalbard and Jan Mayen Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Svalbard and Jan Mayen Islands" ? 'selected' : '' }}>Svalbard and Jan Mayen Islands</option>
                    <option value="Swaziland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Swaziland" ? 'selected' : '' }}>Swaziland</option>
                    <option value="Sweden" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Sweden" ? 'selected' : '' }}>Sweden</option>
                    <option value="Switzerland" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Switzerland" ? 'selected' : '' }}>Switzerland</option>
                    <option value="Syrian Arab Republic" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Syrian Arab Republic" ? 'selected' : '' }}>Syrian Arab Republic</option>
                    <option value="Taiwan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Taiwan" ? 'selected' : '' }}>Taiwan</option>
                    <option value="Tajikistan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Tajikistan" ? 'selected' : '' }}>Tajikistan</option>
                    <option value="Tanzania, United Republic of" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Tanzania, United Republic of" ? 'selected' : '' }}>Tanzania, United Republic of</option>
                    <option value="Thailand" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Thailand" ? 'selected' : '' }}>Thailand</option>
                    <option value="Togo" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Togo" ? 'selected' : '' }}>Togo</option>
                    <option value="Tokelau" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Tokelau" ? 'selected' : '' }}>Tokelau</option>
                    <option value="Tonga" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Tonga" ? 'selected' : '' }}>Tonga</option>
                    <option value="Trinidad and Tobago" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Trinidad and Tobago" ? 'selected' : '' }}>Trinidad and Tobago</option>
                    <option value="Tunisia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Tunisia" ? 'selected' : '' }}>Tunisia</option>
                    <option value="Turkey" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Turkey" ? 'selected' : '' }}>Turkey</option>
                    <option value="Turkmenistan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Turkmenistan" ? 'selected' : '' }}>Turkmenistan</option>
                    <option value="Turks and Caicos Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Turks and Caicos Islands" ? 'selected' : '' }}>Turks and Caicos Islands</option>
                    <option value="Tuvalu" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Tuvalu" ? 'selected' : '' }}>Tuvalu</option>
                    <option value="Uganda" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Uganda" ? 'selected' : '' }}>Uganda</option>
                    <option value="Ukraine" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Ukraine" ? 'selected' : '' }}>Ukraine</option>
                    <option value="United Arab Emirates" {{ isset($_POST['nationality']) && $_POST['nationality'] === "United Arab Emirates" ? 'selected' : '' }}>United Arab Emirates</option>
                    <option value="United Kingdom" {{ isset($_POST['nationality']) && $_POST['nationality'] === "United Kingdom" ? 'selected' : '' }}>United Kingdom</option>
                    <option value="United States" {{ isset($_POST['nationality']) && $_POST['nationality'] === "United States" ? 'selected' : '' }}>United States</option>
                    <option value="United States minor outlying islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "United States minor outlying islands" ? 'selected' : '' }}>United States minor outlying islands</option>
                    <option value="Uruguay" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Uruguay" ? 'selected' : '' }}>Uruguay</option>
                    <option value="Uzbekistan" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Uzbekistan" ? 'selected' : '' }}>Uzbekistan</option>
                    <option value="Vanuatu" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Vanuatu" ? 'selected' : '' }}>Vanuatu</option>
                    <option value="Vatican City State" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Vatican City State" ? 'selected' : '' }}>Vatican City State</option>
                    <option value="Venezuela" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Venezuela" ? 'selected' : '' }}>Venezuela</option>
                    <option value="Vietnam" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Vietnam" ? 'selected' : '' }}>Vietnam</option>
                    <option value="Virgin Islands (British)" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Virgin Islands (British)" ? 'selected' : '' }}>Virgin Islands (British)</option>
                    <option value="Virgin Islands (U.S.)" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Virgin Islands (U.S.)" ? 'selected' : '' }}>Virgin Islands (U.S.)</option>
                    <option value="Wallis and Futuna Islands" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Wallis and Futuna Islands" ? 'selected' : '' }}>Wallis and Futuna Islands</option>
                    <option value="Western Sahara" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Western Sahara" ? 'selected' : '' }}>Western Sahara</option>
                    <option value="Yemen" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Yemen" ? 'selected' : '' }}>Yemen</option>
                    <option value="Zaire" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Zaire" ? 'selected' : '' }}>Zaire</option>
                    <option value="Zambia" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Zambia" ? 'selected' : '' }}>Zambia</option>
                    <option value="Zimbabwe" {{ isset($_POST['nationality']) && $_POST['nationality'] === "Zimbabwe" ? 'selected' : '' }}>Zimbabwe</option>

                </select>
            </div> 
            <div class="col-span-6 ">
                <label for="travel" class="label">{{ $lang['5'] }}:</label>
                <select name="travel" id="travel" class="input my-2">
                    <option value="">[{{$lang[3]}}]</option>
                    <option value="1"  {{ isset($_POST['travel']) && $_POST['travel'] === "1" ? 'selected' : '' }}>Azerbaijan</option>
                    <option value="2"  {{ isset($_POST['travel']) && $_POST['travel'] === "2" ? 'selected' : '' }}>Maldives</option>
                </select>
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
                    <div class="w-full">
                        <div class="col-lg-12 text-center">
                            <p class="my-3 font-s-20">{{$lang['6']}}</p>
                            <div class="flex justify-center">
                                <p class="lg:text-[25px] md:text-[25px] text-[16px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                    <strong class="font-s-21 text-blue">{{$detail['ans']}}</strong>
                                </p>
                            
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @endisset
</form>