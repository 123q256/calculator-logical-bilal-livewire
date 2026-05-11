<div>
    <style>
        .image { width: 100%; transition: transform 0.5s ease; }
        .zoomed { transform: scale(2); }
        .zoom-container { overflow: hidden; max-height: 400px; position: relative; transition: transform 0.5s ease; }
        .list-disc li { margin-bottom: 0.5rem; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                {{-- Gender Selection --}}
                <div class="w-full mb-6">
                    <label class="block text-[14px] font-semibold mb-2">{!! $lang['gen'] !!}:</label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" wire:model.live="gender" value="men" class="w-4 h-4 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 text-[14px]">{{ $lang['male'] }}</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" wire:model.live="gender" value="women" class="w-4 h-4 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2 text-[14px]">{{ $lang['female'] }}</span>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 items-center">
                    {{-- Input Fields --}}
                    <div class="col-span-12 md:col-span-8">
                        <div class="grid grid-cols-12 gap-4">
                            {{-- Bust/Chest --}}
                            <div class="col-span-6">
                                <label for="chest" class="text-[14px] font-semibold">{!! $lang['bust'] !!}:</label>
                                <div class="relative w-full mt-1" x-data="{ open: false }">
                                    <input type="number" wire:model.live="chest" id="chest" step="any" class="input pr-12" placeholder="00" />
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                        <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                            {{ $bust_units }} ▾
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('bust_units', 'in'); open = false">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('bust_units', 'cm'); open = false">centimeters (cm)</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Waist --}}
                            <div class="col-span-6">
                                <label for="waist" class="text-[14px] font-semibold">{!! $lang['Waist'] !!}:</label>
                                <div class="relative w-full mt-1" x-data="{ open: false }">
                                    <input type="number" wire:model.live="waist" id="waist" step="any" class="input pr-12" placeholder="00" />
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                        <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                            {{ $waist_units }} ▾
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('waist_units', 'in'); open = false">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('waist_units', 'cm'); open = false">centimeters (cm)</p>
                                    </div>
                                </div>
                            </div>

                            {{-- High Hip --}}
                            <div class="col-span-6">
                                <label for="high" class="text-[14px] font-semibold">{!! $lang['high'] !!}:</label>
                                <div class="relative w-full mt-1" x-data="{ open: false }">
                                    <input type="number" wire:model.live="high" id="high" step="any" class="input pr-12" placeholder="00" />
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                        <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                            {{ $high_units }} ▾
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('high_units', 'in'); open = false">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('high_units', 'cm'); open = false">centimeters (cm)</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Hip --}}
                            <div class="col-span-6">
                                <label for="hip" class="text-[14px] font-semibold">{!! $lang['Hip'] !!}:</label>
                                <div class="relative w-full mt-1" x-data="{ open: false }">
                                    <input type="number" wire:model.live="hip" id="hip" step="any" class="input pr-12" placeholder="00" />
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                        <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                            {{ $hip_units }} ▾
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('hip_units', 'in'); open = false">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('hip_units', 'cm'); open = false">centimeters (cm)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Gender Image --}}
                    <div class="col-span-12 md:col-span-4 flex justify-center">
                        <img src="{{ $gender == 'men' ? asset('images/bodyshapes/male_shape_new.png') : asset('images/bodyshapes/new_female_shape_new.png') }}" 
                             alt="Body Shape Illustration" 
                             class="max-w-full h-64 object-contain transition-opacity duration-300"
                             @if($device == 'mobile') height="240px" @else height="270px" @endif>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                {{-- Primary Result --}}
                                <div class="bg-white border rounded-xl p-6 shadow-sm">
                                    <div class="flex flex-col md:flex-row justify-around items-center space-y-6 md:space-y-0">
                                        <div class="text-center md:text-left">
                                            <p class="text-xl font-bold text-gray-700">{{ $lang['ans'] }}</p>
                                            <p class="my-3"><strong class="text-green-700 text-3xl">{{ $detail['shape'] }}</strong></p>
                                            <p class="text-lg font-bold text-gray-700">{{ $lang['whr'] }}</p>
                                            <p><strong class="text-green-700 text-xl">{{ $detail['whr'] }}</strong></p>
                                        </div>
                                        <div class="hidden md:block h-48 w-px bg-gray-200"></div>
                                        <div class="text-center" x-data="{ zoomed: false }">
                                            <img src="{{ asset('images/bodyshapes/' . $detail['img'] . '.png') }}" 
                                                 alt="{{ $gender }} body shape result" 
                                                 class="mx-auto cursor-zoom-in transition-transform duration-300"
                                                 :class="{ 'scale-150': zoomed }"
                                                 @click="zoomed = !zoomed"
                                                 width="150" 
                                                 style="object-fit:contain">
                                            @if($device == 'mobile')
                                                <p class="mt-4 text-sm font-medium text-gray-600"><strong>Remember:</strong> your body is a gift, treat it with kindness.</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if($device == 'desktop')
                                        <p class="text-sm text-center mt-6 text-gray-600 font-medium"><strong>Remember:</strong> your body is a gift, treat it with kindness and it will treat you even better</p>
                                    @endif
                                </div>

                                {{-- Male Descriptions --}}
                                @if($gender == 'men')
                                    <div class="w-full bg-white border rounded-xl p-6 mt-6 shadow-sm">
                                        @foreach(['Rectangle', 'Trapezoid', 'Triangle', 'Oval', 'Inverted Triangle'] as $s)
                                            @if($detail['shape'] == $s)
                                                <div class="space-y-4">
                                                    <p class="text-xl font-bold text-blue-700">{{ $s }} Body Shape:</p>
                                                    <p class="text-gray-700 leading-relaxed">
                                                        @if($s == 'Rectangle')
                                                            Most of the men in this world possess this body shape. If your body is rectangular, your shoulders, waist, and hips measure the same value. Every 4 men out of 10 have this particular body type.
                                                        @elseif($s == 'Trapezoid')
                                                            The trapezoid body shape, also known as the "wedge", is characterized by broader shoulders and a narrower waist. Men with this body type often have a muscular upper body and a more tapered waistline.
                                                        @elseif($s == 'Triangle')
                                                            You must have a wider waist if this body shape belongs to you. Men with triangular bodies have narrow shoulders. It is suggested to wear dark-colored costumes that highlight the upper half of the body.
                                                        @elseif($s == 'Oval')
                                                            The oval body shape, also known as the "round" or "apple" shape, is characterized by a fuller midsection and a more rounded appearance.
                                                        @elseif($s == 'Inverted Triangle')
                                                            The inverted triangle body shape is characterized by broader shoulders and a narrower waist. Men with this body type often have a muscular upper body.
                                                        @endif
                                                    </p>
                                                    
                                                    <p class="text-lg font-bold text-blue-700 mt-4">Celebrities with this shape:</p>
                                                    <ul class="list-disc pl-5 text-gray-700 grid grid-cols-2 gap-2">
                                                        @if($s == 'Rectangle')
                                                            <li>David Beckham</li><li>Ryan Reynolds</li><li>Ashton Kutcher</li><li>Jared Leto</li>
                                                        @elseif($s == 'Trapezoid')
                                                            <li>Chris Evans</li><li>Henry Cavill</li><li>Brad Pitt</li><li>Dwayne Johnson</li>
                                                        @elseif($s == 'Triangle')
                                                            <li>Tom Cruise</li><li>Hugh Jackman</li><li>Brad Pitt</li><li>Dwayne Johnson</li>
                                                        @elseif($s == 'Oval')
                                                            <li>James Corden</li><li>Jack Black</li><li>Zach Miko</li><li>Jack Black</li>
                                                        @elseif($s == 'Inverted Triangle')
                                                            <li>Chris Hemsworth</li><li>Chris Evans</li><li>Ryan Gosling</li><li>Brad Pitt</li>
                                                        @endif
                                                    </ul>

                                                    <p class="text-lg font-bold text-blue-700 mt-4">Style Tips:</p>
                                                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                                                        @if($s == 'Rectangle')
                                                            <li>Add volume to your shoulders with structured jackets and blazers</li>
                                                            <li>Create the illusion of a waist with belts and accessories</li>
                                                            <li>Wear vertical stripes to elongate your silhouette</li>
                                                        @elseif($s == 'Trapezoid')
                                                            <li>Use belts to accentuate your natural waistline</li>
                                                            <li>Wear V-neck shirts or tapered sleeves</li>
                                                            <li>Opt for slim-fitting clothing</li>
                                                        @elseif($s == 'Triangle')
                                                            <li>Choose clothing that adds volume to your hips and legs</li>
                                                            <li>Opt for shirts with subtle detailing around the shoulders</li>
                                                            <li>Use belts to cinch your waist</li>
                                                        @elseif($s == 'Oval')
                                                            <li>Opt for V-necks or vertical stripes to elongate your torso</li>
                                                            <li>Layering can help add dimension and break up the rounded shape</li>
                                                            <li>Avoid overly tight-fitting garments</li>
                                                        @elseif($s == 'Inverted Triangle')
                                                            <li>Balance broader shoulders with narrower waist</li>
                                                            <li>Wear pants that showcase your legs</li>
                                                            <li>Avoid bulky or oversized clothing</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Female Descriptions --}}
                                @if($gender == 'women')
                                    <div class="w-full bg-white border rounded-xl p-6 mt-6 shadow-sm">
                                        @foreach(['Hourglass', 'Bottom Hourglass', 'Top Hourglass', 'Spoon', 'Triangle', 'Inverted Triangle', 'Rectangle'] as $s)
                                            @if($detail['shape'] == $s)
                                                <div class="space-y-4">
                                                    <p class="text-xl font-bold text-blue-700">{{ $s }} Body Shape:</p>
                                                    <p class="text-gray-700 leading-relaxed">
                                                        @if($s == 'Hourglass')
                                                            Hourglass body shape consists of larger hips and bust measurements along with a narrower waist. It is a body kind almost every woman wishes to have.
                                                        @elseif($s == 'Bottom Hourglass')
                                                            Usually, a bottom hourglass body shape constitutes a larger waist to hip ratio than the bust. Almost 9% of the total women in the world have this body figure.
                                                        @elseif($s == 'Top Hourglass')
                                                            The top hourglass shape is defined by a greater bust circumference than hip circumference.
                                                        @elseif($s == 'Spoon')
                                                            Spoon shaped body is similar to pear shaped, but typically has a larger belly. Women with such a shape have thinner necklines and slim waist.
                                                        @elseif($s == 'Triangle')
                                                            This body shape is quite similar to hourglass. The larger hip size than bust and waist give it the name of pear shaped figure.
                                                        @elseif($s == 'Inverted Triangle')
                                                            An inverted triangular body shape has large measurements for shoulders and bust but the waist and hips are small enough.
                                                        @elseif($s == 'Rectangle')
                                                            A rectangular body shape is a kind of straight figure having almost equal measurements for bust, waist, and hips.
                                                        @endif
                                                    </p>

                                                    <p class="text-lg font-bold text-blue-700 mt-4">Celebrities with this shape:</p>
                                                    <ul class="list-disc pl-5 text-gray-700 grid grid-cols-2 gap-2">
                                                        @if($s == 'Hourglass')
                                                            <li>Salma Hayek</li><li>Scarlett Johansson</li><li>Marilyn Monroe</li><li>Sophia Loren</li>
                                                        @elseif($s == 'Bottom Hourglass')
                                                            <li>Jennifer Lopez</li><li>Tyra Banks</li><li>Sofia Vergara</li><li>Sara Ramirez</li>
                                                        @elseif($s == 'Top Hourglass')
                                                            <li>Emilia Clarke</li><li>Halle Berry</li><li>Jayne Mansfield</li><li>Jenna Dewan</li>
                                                        @elseif($s == 'Spoon')
                                                            <li>Jennifer Love Hewitt</li><li>Cameron Diaz</li><li>Cheryl Burke</li>
                                                        @elseif($s == 'Triangle')
                                                            <li>Beyonce</li><li>Shakira</li><li>Rihanna</li><li>Kim Kardashian</li>
                                                        @elseif($s == 'Inverted Triangle')
                                                            <li>Angelina Jolie</li><li>Naomi Campbell</li><li>Charlize Theron</li><li>Demi Moore</li>
                                                        @elseif($s == 'Rectangle')
                                                            <li>Gigi Hadid</li><li>Kendall Jenner</li><li>Cameron Diaz</li><li>Kate Moss</li>
                                                        @endif
                                                    </ul>

                                                    <p class="text-lg font-bold text-blue-700 mt-4">Style Tips:</p>
                                                    <ul class="list-disc pl-5 text-gray-700 space-y-2">
                                                        @if($s == 'Hourglass')
                                                            <li>Wear dresses that highlight your waist and hips</li>
                                                            <li>Use jumpsuits that fit your body dimensions</li>
                                                            <li>Try using thinner border lined tops</li>
                                                        @elseif($s == 'Bottom Hourglass')
                                                            <li>Use simple tops with straight jeans</li>
                                                            <li>Avoid straight costumes that make you look odd</li>
                                                            <li>Never use low waisted skirts</li>
                                                        @elseif($s == 'Top Hourglass')
                                                            <li>Don't use flexible tops that broaden your shoulders</li>
                                                            <li>Use wrap dresses to create a catchy silhouette</li>
                                                        @elseif($s == 'Spoon')
                                                            <li>Use A-line shirts with princess cut designs</li>
                                                            <li>Wear long pants for the lower part of the body</li>
                                                        @elseif($s == 'Triangle')
                                                            <li>Use bright colored tops to highlight the upper area</li>
                                                            <li>Use dark colored skirts or pants for the bottom area</li>
                                                        @elseif($s == 'Inverted Triangle')
                                                            <li>Try wearing blouses with asymmetrical necklines</li>
                                                            <li>Use longer pants to show off your legs</li>
                                                        @elseif($s == 'Rectangle')
                                                            <li>Avoid tucking tops into trousers</li>
                                                            <li>Use dark colored belts around the waist</li>
                                                            <li>Create illusion around the waist area</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Comparison Chart --}}
                                <p class="text-lg font-bold my-6 text-gray-700">Reference Body Shapes Guide:</p>
                                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 zoom-container flex items-center justify-center" x-data="{ zoomed: false }">
                                    <img src="{{ $gender == 'men' ? asset('images/bodyshapes/new_male_result_shape.png') : asset('images/bodyshapes/bodyshape_femalenew.png') }}" 
                                         alt="Body Shapes Guide" 
                                         class="max-w-full cursor-zoom-in transition-transform duration-500"
                                         :class="{ 'scale-150': zoomed, 'pt-4': '{{ $gender }}' == 'women' }"
                                         @click="zoomed = !zoomed">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
