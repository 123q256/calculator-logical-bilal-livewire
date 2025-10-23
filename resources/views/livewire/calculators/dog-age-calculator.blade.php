<div>
    <form wire:submit.prevent="calculate">


        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <strong class="text-blue pe-lg-3">{{ $lang['1'] }} :</strong>

                        <input type="radio" id="bedtime" value="1" name="operations"
                            wire:click="changeOperation('1')" @checked($operations == '1')>
                        <label for="bedtime" class="label pe-lg-3 pe-2">{{ $lang['2'] }}:</label>

                        <input type="radio" id="wkup" value="2" name="operations"
                            wire:click="changeOperation('2')" @checked($operations == '2')>
                        <label for="wkup" class="label">{{ $lang['3'] }}:</label>

                        {{-- <input type="hidden" name="operations"  id="operations" value="1"> --}}
                    </div>
                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 simple_vr {{ $operations == '1' ? '' : 'hidden' }}">
                        <label for="breeds" class="label">{{ $lang['4'] }}</label>
                        <div class="w-full py-2">

                            <select name="brd" id="breeds" wire:model="brd" class="input">
                                <option value="1"> {{ $lang['5'] }}</option>
                                <option value="2"> {{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 simple_vr {{ $operations == '2' ? 'hidden' : '' }}">
                        <label for="age" class="label">{{ $lang['1'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model="age" id="age" class="input"
                                aria-label="input" />
                        </div>
                    </div>

                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 ad_vr {{ $operations == '1' ? 'hidden' : '' }}">
                        <label for="dogAge" class="label">{{ $lang['11'] }}</label>
                        <div class="w-full py-2">
                            <select class="input" id="dogAge" wire:model="dogAge">
                                <option value="0">{{ $lang['12'] }}</option>
                                <option value="0.25">3 {{ $lang['13'] }}</option>
                                <option value="0.5">6 {{ $lang['13'] }}</option>
                                <option value="0.75">9 {{ $lang['13'] }}</option>
                                <option value="1">12 {{ $lang['13'] }}</option>
                                <option value="1.5">18 {{ $lang['13'] }}</option>
                                <option value="2">2 {{ $lang['14'] }}</option>
                                <option value="3">3 {{ $lang['14'] }}</option>
                                <option value="4">4 {{ $lang['14'] }}</option>
                                <option value="5">5 {{ $lang['14'] }}</option>
                                <option value="6">6 {{ $lang['14'] }}</option>
                                <option value="7">7 {{ $lang['14'] }}</option>
                                <option value="8">8 {{ $lang['14'] }}</option>
                                <option value="9">9 {{ $lang['14'] }}</option>
                                <option value="10">10 {{ $lang['14'] }}</option>
                                <option value="11">11 {{ $lang['14'] }}</option>
                                <option value="12">12 {{ $lang['14'] }}</option>
                                <option value="13">13 {{ $lang['14'] }}</option>
                                <option value="14">14 {{ $lang['14'] }}</option>
                                <option value="15">15 {{ $lang['14'] }}</option>
                                <option value="16">16 {{ $lang['14'] }}</option>
                                <option value="17">17 {{ $lang['14'] }}</option>
                                <option value="18">18 {{ $lang['14'] }}</option>
                                <option value="19">19 {{ $lang['14'] }}</option>
                                <option value="20">20 {{ $lang['14'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 ad_vr {{ $operations == '1' ? 'hidden' : '' }}">
                        <label for="dogBreed" class="label">{!! $lang['15'] !!}</label>
                        <div class="w-full py-2">
                            <select class="input" wire:model="dogBreed" id="dogBreed">
                                <option value="0">{{ $lang['16'] }}</option>
                                <option value="1&&Affenpinscher">Affenpinscher</option>
                                <option value="2&&Afghan Hound">Afghan Hound</option>
                                <option value="3&&Airedale Terrier">Airedale Terrier</option>
                                <option value="4&&Akita">Akita</option>
                                <option value="5&&Alaskan Malamute">Alaskan Malamute</option>
                                <option value="6&&American Cocker Spaniel">American Cocker Spaniel</option>
                                <option value="7&&American Eskimo Dog">American Eskimo Dog</option>
                                <option value="8&&American Foxhound">American Foxhound</option>
                                <option value="9&&American Staffordshire Terrier">American Staffordshire Terrier
                                </option>
                                <option value="10&&American Water Spaniel">American Water Spaniel</option>
                                <option value="11&&Anatolian Shepherd Dog">Anatolian Shepherd Dog</option>
                                <option value="12&&Australian Cattle Dog">Australian Cattle Dog</option>
                                <option value="13&&Australian Shepherd">Australian Shepherd</option>
                                <option value="14&&Australian Silky Terrier">Australian Silky Terrier</option>
                                <option value="15&&Australian Terrier">Australian Terrier</option>
                                <option value="16&&Basenji">Basenji</option>
                                <option value="17&&Basset Hound">Basset Hound</option>
                                <option value="18&&Beagle">Beagle</option>
                                <option value="19&&Bearded Collie">Bearded Collie</option>
                                <option value="20&&Beauceron">Beauceron</option>
                                <option value="21&&Belgian Shepherd">Belgian Shepherd</option>
                                <option value="22&&Bedlington Terrier">Bedlington Terrier</option>
                                <option value="23&&Belgian Shepherd Malinois">Belgian Shepherd Malinois</option>
                                <option value="24&&Bernese Mountain Dog">Bernese Mountain Dog</option>
                                <option value="25&&Bichon Frise">Bichon Frise</option>
                                <option value="26&&Black and Tan Coonhound">Black and Tan Coonhound</option>
                                <option value="27&&Black Russian Terrier">Black Russian Terrier</option>
                                <option value="28&&Bloodhound">Bloodhound</option>
                                <option value="29&&Bluetick Coonhound">Bluetick Coonhound</option>
                                <option value="30&&Border Collie">Border Collie</option>
                                <option value="31&&Border Terrier">Border Terrier</option>
                                <option value="32&&Borzoi">Borzoi</option>
                                <option value="33&&Boston Terrier">Boston Terrier</option>
                                <option value="34&&Briard">Briard</option>
                                <option value="35&&Bouvier des Flandres">Bouvier des Flandres</option>
                                <option value="36&&Boxer">Boxer</option>
                                <option value="37&&Boykin Spaniel">Boykin Spaniel</option>
                                <option value="38&&Brittany">Brittany</option>
                                <option value="39&&Bull Terrier">Bull Terrier</option>
                                <option value="40&&Bulldog">Bulldog</option>
                                <option value="41&&Bullmastiff">Bullmastiff</option>
                                <option value="42&&Cairn Terrier">Cairn Terrier</option>
                                <option value="43&&Canaan Dog">Canaan Dog</option>
                                <option value="44&&Cane Corso">Cane Corso</option>
                                <option value="45&&Cavalier King Charles Spaniel">Cavalier King Charles Spaniel
                                </option>
                                <option value="46&&Cesky Terrier">Cesky Terrier</option>
                                <option value="47&&Chesapeake Bay Retriever">Chesapeake Bay Retriever</option>
                                <option value="48&&Chihuahua">Chihuahua</option>
                                <option value="49&&Chinese Crested Dog">Chinese Crested Dog</option>
                                <option value="50&&Chow Chow">Chow Chow</option>
                                <option value="51&&Clumber Spaniel">Clumber Spaniel</option>
                                <option value="52&&Curly Coated Retriever">Curly Coated Retriever</option>
                                <option value="53&&Dachshund">Dachshund</option>
                                <option value="54&&Dalmatian">Dalmatian</option>
                                <option value="55&&Dandie Dinmont Terrier">Dandie Dinmont Terrier</option>
                                <option value="56&&Doberman Pinscher">Doberman Pinscher</option>
                                <option value="57&&Dogue de Bordeaux">Dogue de Bordeaux</option>
                                <option value="58&&English Bulldog">English Bulldog</option>
                                <option value="59&&English Cocker Spaniel">English Cocker Spaniel</option>
                                <option value="60&&English Coonhound">English Coonhound</option>
                                <option value="61&&English Foxhound">English Foxhound</option>
                                <option value="62&&English Mastiff">English Mastiff</option>
                                <option value="63&&English Setter">English Setter</option>
                                <option value="64&&English Springer Spaniel">English Springer Spaniel</option>
                                <option value="65&&Entlebucher Mountain Dog">Entlebucher Mountain Dog</option>
                                <option value="66&&Field Spaniel">Field Spaniel</option>
                                <option value="67&&Finnish Lapphund">Finnish Lapphund</option>
                                <option value="68&&Finnish Spitz">Finnish Spitz</option>
                                <option value="69&&Flat-Coated Retriever">Flat-Coated Retriever</option>
                                <option value="70&&French Bulldog">French Bulldog</option>
                                <option value="71&&German Pinscher">German Pinscher</option>
                                <option value="72&&German Shepherd">German Shepherd</option>
                                <option value="73&&German Shorthaired Pointer">German Shorthaired Pointer</option>
                                <option value="74&&German Wirehaired Pointer">German Wirehaired Pointer</option>
                                <option value="75&&Giant Schnauzer">Giant Schnauzer</option>
                                <option value="76&&Glen of Imaal Terrier">Glen of Imaal Terrier</option>
                                <option value="77&&Golden Retriever">Golden Retriever</option>
                                <option value="78&&Gordon Setter">Gordon Setter</option>
                                <option value="79&&Great Dane">Great Dane</option>
                                <option value="80&&Great Pyrenees">Great Pyrenees</option>
                                <option value="81&&Greater Swiss Mountain Dog">Greater Swiss Mountain Dog</option>
                                <option value="82&&Greyhound">Greyhound</option>
                                <option value="83&&Griffon Bruxellois">Griffon Bruxellois</option>
                                <option value="84&&Harrier">Harrier</option>
                                <option value="85&&Havanese">Havanese</option>
                                <option value="86&&Ibizan Hound">Ibizan Hound</option>
                                <option value="87&&Icelandic Sheepdog">Icelandic Sheepdog</option>
                                <option value="88&&Irish Red and White Setter">Irish Red and White Setter</option>
                                <option value="89&&Irish Setter">Irish Setter</option>
                                <option value="90&&Irish Soft-coated Wheaten Terrier">Irish Soft-coated Wheaten
                                    Terrier</option>
                                <option value="91&&Irish Terrier">Irish Terrier</option>
                                <option value="92&&Irish Water Spaniel">Irish Water Spaniel</option>
                                <option value="93&&Irish Wolfhound">Irish Wolfhound</option>
                                <option value="94&&Italian Greyhound">Italian Greyhound</option>
                                <option value="95&&Jack Russell Terrier">Jack Russell Terrier</option>
                                <option value="96&&Japanese Chin">Japanese Chin</option>
                                <option value="97&&Keeshond">Keeshond</option>
                                <option value="98&&Kerry Blue Terrier">Kerry Blue Terrier</option>
                                <option value="99&&King Charles Spaniel">King Charles Spaniel</option>
                                <option value="100&&Komondor">Komondor</option>
                                <option value="101&&Kuvasz">Kuvasz</option>
                                <option value="102&&Labrador Retriever">Labrador Retriever</option>
                                <option value="103&&Lakeland Terrier">Lakeland Terrier</option>
                                <option value="104&&Leonberger">Leonberger</option>
                                <option value="105&&Lhasa Apso">Lhasa Apso</option>
                                <option value="106&&Lowchen">Lowchen</option>
                                <option value="107&&Maltese">Maltese</option>
                                <option value="108&&Manchester Terrier">Manchester Terrier</option>
                                <option value="109&&Mexican Hairless Dog">Mexican Hairless Dog</option>
                                <option value="110&&Miniature Pinscher">Miniature Pinscher</option>
                                <option value="111&&Miniature Schnauzer">Miniature Schnauzer</option>
                                <option value="112&&Neapolitan Mastiff">Neapolitan Mastiff</option>
                                <option value="113&&Newfoundland">Newfoundland</option>
                                <option value="114&&Norfolk Terrier">Norfolk Terrier</option>
                                <option value="115&&Norwegian Buhund">Norwegian Buhund</option>
                                <option value="116&&Norwegian Elkhound">Norwegian Elkhound</option>
                                <option value="117&&Norwegian Lundehund">Norwegian Lundehund</option>
                                <option value="118&&Norwich Terrier">Norwich Terrier</option>
                                <option value="119&&Nova Scotia Duck Tolling Retriever">Nova Scotia Duck Tolling
                                    Retriever' 12</option>
                                <option value="120&&Old English Sheepdog">Old English Sheepdog</option>
                                <option value="121&&Otterhound">Otterhound</option>
                                <option value="122&&Papillon">Papillon</option>
                                <option value="123&&Parson Russell Terrier">Parson Russell Terrier</option>
                                <option value="124&&Pekingese">Pekingese</option>
                                <option value="125&&Pembroke Welsh Corgi">Pembroke Welsh Corgi</option>
                                <option value="126&&Petit Basset Griffon Vendeen">Petit Basset Griffon Vendeen
                                </option>
                                <option value="127&&Pharaoh Hound">Pharaoh Hound</option>
                                <option value="128&&Plott Hound">Plott Hound</option>
                                <option value="129&&Pointer">Pointer</option>
                                <option value="130&&Polish Lowland Sheepdog">Polish Lowland Sheepdog</option>
                                <option value="131&&Pomeranian">Pomeranian</option>
                                <option value="132&&Poodle">Poodle</option>
                                <option value="133&&Portuguese Water Dog">Portuguese Water Dog</option>
                                <option value="134&&Pug">Pug</option>
                                <option value="135&&Puli">Puli</option>
                                <option value="136&&Pyrenean Shepherd">Pyrenean Shepherd</option>
                                <option value="137&&Redbone Coonhound">Redbone Coonhound</option>
                                <option value="138&&Rhodesian Ridgeback">Rhodesian Ridgeback</option>
                                <option value="139&&Rottweiler">Rottweiler</option>
                                <option value="140&&Rough Collie">Rough Collie</option>
                                <option value="141&&Saluki">Saluki</option>
                                <option value="142&&Samoyed">Samoyed</option>
                                <option value="143&&Schipperke">Schipperke</option>
                                <option value="144&&Scottish Deerhound">Scottish Deerhound</option>
                                <option value="145&&Scottish Terrier">Scottish Terrier</option>
                                <option value="146&&Sealyham Terrier">Sealyham Terrier</option>
                                <option value="147&&Shar Pei">Shar Pei</option>
                                <option value="148&&Shetland Sheepdog">Shetland Sheepdog</option>
                                <option value="149&&Shiba Inu">Shiba Inu</option>
                                <option value="150&&Shih Tzu">Shih Tzu</option>
                                <option value="151&&Siberian Huskie">Siberian Huskie</option>
                                <option value="152&&Skye Terrier">Skye Terrier</option>
                                <option value="153&&Smooth Fox Terrier">Smooth Fox Terrier</option>
                                <option value="154&&Spinone Italiano">Spinone Italiano</option>
                                <option value="155&&St. Bernard">St. Bernard</option>
                                <option value="156&&Staffordshire Bull Terrier">Staffordshire Bull Terrier</option>
                                <option value="157&&Standard Schnauzer">Standard Schnauzer</option>
                                <option value="158&&Sussex Spaniel">Sussex Spaniel</option>
                                <option value="159&&Swedish Vallhund">Swedish Vallhund</option>
                                <option value="160&&Tibetan Mastiff">Tibetan Mastiff</option>
                                <option value="161&&Tibetan Spaniel">Tibetan Spaniel</option>
                                <option value="162&&Tibetan Terrier">Tibetan Terrier</option>
                                <option value="163&&Toy Fox Terrier">Toy Fox Terrier</option>
                                <option value="164&&Treeing Walker Coonhound">Treeing Walker Coonhound</option>
                                <option value="165&&Tervuren">Tervuren</option>
                                <option value="166&&Vizsla">Vizsla</option>
                                <option value="167&&Weimaraner">Weimaraner</option>
                                <option value="168&&Welsh Springer Spaniel">Welsh Springer Spaniel</option>
                                <option value="169&&Welsh Terrier">Welsh Terrier</option>
                                <option value="170&&West Highland White Terrier">West Highland White Terrier
                                </option>
                                <option value="171&&Whippet">Whippet</option>
                                <option value="172&&Wire Hair Fox Terrier">Wire Hair Fox Terrier</option>
                                <option value="173&&Wirehaired Pointing Griffon">Wirehaired Pointing Griffon
                                </option>
                                <option value="174&&Xoloitzcuintle ">Xoloitzcuintle </option>
                                <option value="175&&Yorkshire Terrier">Yorkshire Terrier</option>
                            </select>
                        </div>
                    </div>
                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 ad_vr {{ $operations == '1' ? 'hidden' : '' }}">
                        <label for="a" class="label">{{ $lang['17'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="a" id="a" class="input"
                                aria-label="input" wire:model="a" />
                        </div>
                    </div>
                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 ad_vr {{ $operations == '1' ? 'hidden' : '' }}">
                        <label for="b" class="label">{{ $lang['18'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="b" id="b" class="input"
                                aria-label="input" wire:model="b" />
                        </div>
                    </div>
                    <div
                        class="col-span-12 md:col-span-6 lg:col-span-6 ad_vr {{ $operations == '1' ? 'hidden' : '' }}">
                        <label for="c" class="label">{{ $lang['19'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" id="c" class="input" aria-label="input"
                                wire:model="c" />
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">

                            <div class="row my-2">
                              @if (isset($detail['operations']) && $detail['operations'] === '1')

                                    <div class="text-center">
                                        <p class="my-3 text-[18px]">{{ $lang['33'] }} <strong
                                                class="text-[32px] bg-sky px-3 py-2 rounded-lg text-blue-500">{{ round($detail['answer']) }}
                                            </strong> {{ $lang['34'] }}</p>
                                    </div>
                                @else
                                    <div class="w-full md:w-[80%] lg:w-[80%] flex justify-between">
                                        <div>
                                            <p class="pe-lg-5">In human years, your dog is <strong
                                                    class="text-green-500 text-[21px]">
                                                    {{ number_format($detail['dogHumanAge'], 1) }} </strong> years old
                                                and<br> is considerd <strong
                                                    class="text-green-500 text-[21px]">{{ $detail['type'] }}</strong>
                                            </p>
                                        </div>
                                        <div>
                                            <img src="{{ asset('images/dogs/' . $detail['images'] . '.png') }}"
                                                id="im" class="max-image" alt="Dog Images" width="140px"
                                                height="140px">
                                        </div>
                                    </div>
                                    <div class="w-full md:w-[80%] lg:w-[80%] text-[18px]">
                                        <p class="text-[20px] mt-2"><strong>{{ $detail['name'] . ' Details' }}</strong>
                                        </p>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b py-2">{{ $lang['23'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f1'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['24'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f2'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['25'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f3'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['26'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f4'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['27'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f5'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['28'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f6'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['29'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f7'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['30'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f8'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['31'] }}</td>
                                                <td class="border-b py-2">{{ $detail['f9'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endisset
      
    </form>
</div>
