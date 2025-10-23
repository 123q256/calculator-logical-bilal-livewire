<div>
    <style>
        .bg-gradient {
            background-color: #2845F5 !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

                    <div class="space-y-2" x-data="{ open: false }">
                        <label for="age" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Enter Age' }}:</label>

                        <div class="relative w-full">
                            {{-- Age Input --}}
                            <input type="number" id="age" wire:model.defer="age" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- Age Unit Toggle Label --}}
                            <label for="age_selection" class="absolute cursor-pointer text-sm underline right-6 top-4"
                                @click="open = !open">{{ $age_selection }} ▾</label>

                            {{-- Hidden Input for Binding --}}
                            <input type="hidden" wire:model="age_selection" id="age_selection" />

                            {{-- Dropdown --}}
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[40%] mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    wire:click="$set('age_selection', 'days')" @click="open = false">
                                    {{ $lang['2'] ?? 'Days' }}
                                </p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    wire:click="$set('age_selection', 'wks')" @click="open = false">
                                    {{ $lang['3'] ?? 'Weeks' }}
                                </p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                    wire:click="$set('age_selection', 'mon')" @click="open = false">
                                    {{ $lang['4'] ?? 'Months' }}
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="space-y-2" x-data="{ open: false }">
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Enter Weight' }}:</label>

                        <div class="relative w-full">
                            {{-- Weight Input --}}
                            <input type="number" id="weight" wire:model.defer="weight" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />

                            {{-- Unit Display + Toggle --}}
                            <label for="weight_selection"
                                class="absolute cursor-pointer text-sm underline right-6 top-4"
                                @click="open = !open">{{ $weight_selection }} ▾</label>

                            {{-- Hidden Livewire Bound Unit --}}
                            <input type="hidden" id="weight_selection" wire:model="weight_selection" />

                            {{-- Dropdown Menu --}}
                            <div x-show="open" x-cloak @click.outside="open = false"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[25%] md:w-[25%] w-[33%] mt-1 right-0">
                                @foreach (['g', 'dag', 'kg', 'oz', 'lb', 'stone'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click="$set('weight_selection', '{{ $unit }}')"
                                        @click="open = false">
                                        {{ $unit }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="inline-block cursor-pointer current_gpa flex items-center my-3"
                        wire:click="toggleAdvanced">
                        <input type="hidden" name="type" wire:model="mode">

                        <strong class="pr-3">Advance Option</strong>
                        <p class="ml-auto transition-transform transform {{ $show_advanced ? 'rotate-180' : '' }}">▼
                        </p>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-4">
                    <div
                        class="current_input overflow-hidden transition-all duration-500 ease-in-out {{ $show_advanced ? '' : 'hidden' }}">
                        <label for="select_breed" class="font-s-14 text-blue">{!! $lang['17'] !!}:</label>
                        <select class="input" name="select_breed" id="select_breed" wire:model="select_breed">
                            <option value="Affenpinscher"
                                {{ isset($_POST['select_breed']) && $_POST['select_breed'] === 'Affenpinscher' ? 'selected' : '' }}>
                                Affenpinscher</option>
                            <option value="Afghan Hound">Afghan Hound</option>
                            <option value="Airedale Terrier">Airedale Terrier</option>
                            <option value="Akita">Akita</option>
                            <option value="Alaskan Malamute">Alaskan Malamute</option>
                            <option value="American Cocker Spaniel">American Cocker Spaniel</option>
                            <option value="American Eskimo Dog (toy)">American Eskimo Dog (toy)</option>
                            <option value="American Esmiko Dog (miniature)">American Eskimo Dog (miniature)</option>
                            <option value="American Esmiko Dog">American Eskimo Dog</option>
                            <option value="American Foxhound">American Foxhound</option>
                            <option value="American Hairless Terrier">American Hairless Terrier</option>
                            <option value="American Staffordshire Terrier">American Staffordshire Terrier</option>
                            <option value="Anatolian Shepherd Dog">Anatolian Shepherd Dog</option>
                            <option value="Australian Cattle Dog">Australian Cattle Dog</option>
                            <option value="Australian Shepherd">Australian Shepherd</option>
                            <option value="Basenji">Basenji</option>
                            <option value="Basset Hound">Basset Hound</option>
                            <option value="Beagle">Beagle</option>
                            <option value="Bearded Collie">Bearded Collie</option>
                            <option value="Beauceron">Beauceron</option>
                            <option value="Belgian Shepherd">Belgian Shepherd</option>
                            <option value="Bedlington Terrier">Bedlington Terrier</option>
                            <option value="Belgian Shepherd Malinois">Belgian Shepherd Malinois</option>
                            <option value="Bernese Mountain Dog">Bernese Mountain Dog</option>
                            <option value="Bichon Frise">Bichon Frise</option>
                            <option value="Black and Tan Coonhound">Black and Tan Coonhound</option>
                            <option value="Black Russian Terrier">Black Russian Terrier</option>
                            <option value="Bloodhound">Bloodhound</option>
                            <option value="Bluetick Coonhound">Bluetick Coonhound</option>
                            <option value="Border Collie">Border Collie</option>
                            <option value="Border Terrier">Border Terrier</option>
                            <option value="Borzoi">Borzoi</option>
                            <option value="Boston Terrier">Boston Terrier</option>
                            <option value="Briard">Briard</option>
                            <option value="Bouvier des Flandres">Bouvier des Flandres</option>
                            <option value="Boxer">Boxer</option>
                            <option value="Boykin Spaniel">Boykin Spaniel</option>
                            <option value="Brittany">Brittany</option>
                            <option value="Bull Terrier">Bull Terrier</option>
                            <option value="Bulldog">Bulldog</option>
                            <option value="Bullmastiff">Bullmastiff</option>
                            <option value="Cairn Terrier">Cairn Terrier</option>
                            <option value="Canaan Dog">Canaan Dog</option>
                            <option value="Cane Corso">Cane Corso</option>
                            <option value="Cavalier King Charles Spaniel">Cavalier King Charles Spaniel</option>
                            <option value="Cesky Terrier">Cesky Terrier</option>
                            <option value="Chesapeake Bay Retriever">Chesapeake Bay Retriever</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="Chinese Crested Dog">Chinese Crested Dog</option>
                            <option value="Chinese Shar-Pei">Chinese Shar-Pei</option>
                            <option value="Chinook">Chinook</option>
                            <option value="Chow Chow">Chow Chow</option>
                            <option value="Cirnechi dell'Etna">Cirnechi dell'Etna</option>
                            <option value="Collie">Collie</option>
                            <option value="Coton de Tulear">Coton de Tulear</option>
                            <option value="Dachshund (miniature)">Dachshund (miniature)</option>
                            <option value="Dachshund">Dachshund</option>
                            <option value="Dalmatian">Dalmatian</option>
                            <option value="Dandie Dinmont Terrier">Dandie Dinmont Terrier</option>
                            <option value="Doberman Pinscher">Doberman Pinscher</option>
                            <option value="Dogue de Bordeaux">Dogue de Bordeaux</option>
                            <option value="English Foxhound">English Foxhound</option>
                            <option value="English Toy Spaniel">English Toy Spaniel</option>
                            <option value="Entlebucher Mountain Dog">Entlebucher Mountain Dog</option>
                            <option value="Finnish Lapphund">Finnish Lapphund</option>
                            <option value="Finnish Spitz">Finnish Spitz</option>
                            <option value="French Bulldog">French Bulldog</option>
                            <option value="German Pinscher">German Pinscher</option>
                            <option value="German Shepherd">German Shepherd</option>
                            <option value="Giant Schnauzer">Giant Schnauzer</option>
                            <option value="Glen of Imaal Terrier">Glen of Imaal Terrier</option>
                            <option value="Great Dane">Great Dane</option>
                            <option value="Great Pyrenees">Great Pyrenees</option>
                            <option value="Greater Swiss Mountain Dog">Greater Swiss Mountain Dog</option>
                            <option value="Greyhound">Greyhound</option>
                            <option value="Harrier">Harrier</option>
                            <option value="Havanese">Havanese</option>
                            <option value="Ibizan Hound">Ibizan Hound</option>
                            <option value="Icelandic Sheepdog">Icelandic Sheepdog</option>
                            <option value="Irish Red and White Setter">Irish Red and White Setter</option>
                            <option value="Irish Setter">Irish Setter</option>
                            <option value="Irish Soft-coated Wheaten Terrier">Irish Soft-coated Wheaten Terrier
                            </option>
                            <option value="Irish Terrier">Irish Terrier</option>
                            <option value="Irish Wolfhound">Irish Wolfhound</option>
                            <option value="Italian Greyhound">Italian Greyhound</option>
                            <option value="Japanese Chin">Japanese Chin</option>
                            <option value="Keeshonden">Keeshonden</option>
                            <option value="Kerry Blue Terrier">Kerry Blue Terrier</option>
                            <option value="Komondor">Komondorok</option>
                            <option value="Kuvasz">Kuvaszok</option>
                            <option value="Kuvasz">Kuvaszok</option>
                            <option value="Lagottto Romagnoli">Lagottto Romagnoli</option>
                            <option value="Lakeland Terrier">Lakeland Terrier</option>
                            <option value="Leonberger">Leonberger</option>
                            <option value="Lhasa Apso">Lhasa Apso</option>
                            <option value="Lowchen">Lowchen</option>
                            <option value="Maltese">Maltese</option>
                            <option value="Manchester Terrier (Toy)">Manchester Terrier (Toy)</option>
                            <option value="Manchester Terrier">Manchester Terrier</option>
                            <option value="Neapolitan Mastiff">Mastiff</option>
                            <option value="Neapolitan Mastiff">Mastiff</option>
                            <option value="Miniature Pinscher">Miniature Pinscher</option>
                            <option value="Miniature Schnauzer">Miniature Schnauzer</option>
                            <option value="Neapolitan Mastiff">Mastiff</option>
                            <option value="Newfoundland">Newfoundland</option>
                            <option value="Norfolk Terrier">Norfolk Terrier</option>
                            <option value="Norwegian Buhund">Norwegian Buhund</option>
                            <option value="Norwegian Elkhound">Norwegian Elkhound</option>
                            <option value="Norwegian Lundehund">Norwegian Lundehund</option>
                            <option value="Norwich Terrier">Norwich Terrier</option>
                            <option value="Old English Sheepdog">Old English Sheepdog</option>
                            <option value="Otterhound">Otterhound</option>
                            <option value="Papillon">Papillon</option>
                            <option value="Parson Russell Terrier">Parson Russell Terrier</option>
                            <option value="Pekingese">Pekingese</option>
                            <option value="Pembroke Welsh Corgi">Pembroke Welsh Corgi</option>
                            <option value="Petit Basset Griffon Vendeen">Petit Basset Griffon Vendeen</option>
                            <option value="Pharaoh Hound">Pharaoh Hound</option>
                            <option value="Plott">Plott</option>
                            <option value="Polish Lowland Sheepdog">Polish Lowland Sheepdog</option>
                            <option value="Pomeranian">Pomeranian</option>
                            <option value="Poodle">Poodle</option>
                            <option value="Portuguese Water Dog">Portuguese Water Dog</option>
                            <option value="Pug">Pug</option>
                            <option value="Pulik">Pulik</option>
                            <option value="Redbone Coonhound">Redbone Coonhound</option>
                            <option value="Retreiver (Chesapeake Bay)">Retreiver (Chesapeake Bay)</option>
                            <option value="Retreiver (Curly Coated)">Retreiver (Curly Coated)</option>
                            <option value="Retreiver (Flat Coated)">Retreiver (Flat Coated)</option>
                            <option value="Retreiver (Golden)">Retreiver (Golden)</option>
                            <option value="Retreiver (Labrador)">Retreiver (Labrador)/option>
                            <option value="Rhodesian Ridgeback">Rhodesian Ridgeback</option>
                            <option value="Rottweiler">Rottweiler</option>
                            <option value="Russel Terrier">Russel Terrier</option>
                            <option value="Saluki">Saluki</option>
                            <option value="Samoyed">Samoyed</option>
                            <option value="Schipperke">Schipperke</option>
                            <option value="Scottish Deerhound">Scottish Deerhound</option>
                            <option value="Scottish Terrier">Scottish Terrier</option>
                            <option value="Sealyham Terrier">Sealyham Terrier</option>
                            <option value="Setter (English)">Setter (English)</option>
                            <option value="Setter (Gordon)">Setter (Gordon)</option>
                            <option value="Setter (Irish Red and White)">Sealyham Terrier</option>
                            <option value="Setter (Irish)">Setter (Irish)</option>
                            <option value="Shetland Sheepdog">Shetland Sheepdog</option>
                            <option value="Shiba Inu">Shiba Inu</option>
                            <option value="Shih Tzu">Shih Tzu</option>
                            <option value="Siberian Huskie">Siberian Huskie</option>
                            <option value="Silky Terrier">Silky Terrier</option>
                            <option value="Syke Terrier">Syke Terrier</option>
                            <option value="Sloughi">Sloughi</option>
                            <option value="Soft Coated Wheaten Terrier">Soft Coated Wheaten Terrier</option>
                            <option value="Spaniel (American Water)">Spaniel (American Water)</option>
                            <option value="Spaniel (Boykin)">Spaniel (Boykin)</option>
                            <option value="Spaniel (Clumber)">Spaniel (Clumber)</option>
                            <option value="Spaniel (Boykin)">Spaniel (Boykin)</option>
                            <option value="Spaniel (English Cocker)">Spaniel (English Cocker)</option>
                            <option value="Spaniel (English Springer)">Spaniel (English Springer)</option>
                            <option value="Spaniel (Field)">Spaniel (Field)</option>
                            <option value="Spaniel (Irish Water)">Spaniel (Irish Water)</option>
                            <option value="Spaniel (Sussex)">Spaniel (Sussex)</option>
                            <option value="Spaniel (Welsh Springer)">Spaniel (Welsh Springer)</option>
                            <option value="Spaniel Water Dog">Spaniel Water Dog</option>
                            <option value="Spinoni Italiani">Spinoni Italiani</option>
                            <option value="St. Bernard">St. Bernard</option>
                            <option value="Staffordshire Bull Terrier">Staffordshire Bull Terrier</option>
                            <option value="Spinoni Italiani">Spinoni Italiani</option>
                            <option value="Standard Schnauzer">Standard Schnauzer</option>
                            <option value="Swedish Vallhund">Swedish Vallhund</option>
                            <option value="Tibetan Mastiff">Tibetan Mastiff</option>
                            <option value="Tibetan Spaniel">Tibetan Spaniel</option>
                            <option value="Tibetan Terrier">Tibetan Terrier</option>
                            <option value="Toy Fox Terrier">Toy Fox Terrier</option>
                            <option value="Treeing Walker Coonhound">Treeing Walker Coonhound</option>
                            <option value="Vizsla">Vizsla</option>
                            <option value="Weimaraner">Weimaraner</option>
                            <option value="Welsh Terrier">Welsh Terrier</option>
                            <option value="West Highland White Terrier">West Highland White Terrier</option>
                            <option value="Whippet">Whippet</option>
                            <option value="Wirehaired Pointing Griffon">Wirehaired Pointing Griffon</option>
                            <option value="Wirehaired Vizsla">Wirehaired Vizsla</option>
                            <option value="Xoloitzcuintli">Xoloitzcuintli </option>
                            <option value="Yorkshire Terrier">Yorkshire Terrier</option>
                        </select>
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
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full  p-3 rounded-lg mt-3">
                            <div class="my-2">
                                <div class="w-full">
                                    <p class="text-lg font-semibold my-2">{{ $lang['6'] }}</p>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-r-2 pr-4">
                                                <strong
                                                    class="text-4xl text-green">{{ round($detail['puppy1'], 2) }}</strong>
                                                <span class="text-lg text-blue">(Kg)</span>
                                            </td>
                                            <td class="pl-4">
                                                <strong
                                                    class="text-4xl text-green">{{ round($detail['puppy2'], 2) }}</strong>
                                                <span class="text-lg text-blue">(lb)</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <p class="my-3">{{ $lang['7'] }}:
                                        <strong>{{ round($detail['cal4'], 3) }}</strong> -
                                        <strong>{{ round($detail['cal3'], 3) . ' kg' }}</strong>
                                    </p>
                                </div>

                                @if ($detail['type'] == 'first')
                                    <div class="text-lg w-full lg:w-8/12">
                                        <table class="w-full">
                                            <tbody>
                                                <tr class="{{ $detail['h1'] }}">
                                                    <td class="border-b p-2 rounded-l-lg">{{ $lang['8'] }}</td>
                                                    <td class="border-b p-2 rounded-r-lg">&lt; 12 lb / &lt; 5.4 kg</td>
                                                </tr>
                                                <tr class="{{ $detail['h2'] }}">
                                                    <td class="border-b p-2 rounded-l-lg">{{ $lang['9'] }}</td>
                                                    <td class="border-b p-2 rounded-r-lg">12 - 22 lb / 5.4 - 10 kg</td>
                                                </tr>
                                                <tr class="{{ $detail['h3'] }}">
                                                    <td class="border-b p-2 rounded-l-lg">{{ $lang['10'] }}</td>
                                                    <td class="border-b p-2 rounded-r-lg">22 - 57 lb / 10 - 25.9 kg</td>
                                                </tr>
                                                <tr class="{{ $detail['h4'] }}">
                                                    <td class="border-b p-2 rounded-l-lg">{{ $lang['11'] }}</td>
                                                    <td class="border-b p-2 rounded-r-lg">57 - 99 lb / 25.9 - 44.9 kg</td>
                                                </tr>
                                                <tr class="{{ $detail['h5'] }}">
                                                    <td class="border-b p-2 rounded-l-lg">{{ $lang['12'] }}</td>
                                                    <td class="border-b p-2 rounded-r-lg">&gt; 99 lb / &gt; 44.9 kg</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="mt-4 lg:mt-2">
                                        <p class="text-lg font-semibold">{{ $lang['13'] }}
                                            {{ $detail['select_breed'] }} {{ $lang['14'] }}</p>
                                        @if ($detail['names_one'] == '1')
                                            <p class="text-2xl my-2 font-semibold text-blue">{{ $detail['names_zero'] }}
                                            </p>
                                        @else
                                            <p class="text-2xl my-2 font-semibold text-blue">{{ $lang['15'] }}:
                                                {{ $detail['names_zero'] }}</p>
                                            <p class="text-2xl my-2 font-semibold text-blue">{{ $lang['16'] }}:
                                                {{ $detail['names_one'] }}</p>
                                        @endif
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
