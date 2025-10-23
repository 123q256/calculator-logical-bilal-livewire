<style>
    select{
        outline: none;
        border: 0;
        position: absolute;
        right: 17px;
        top: 17px;
    }
    .image {
        width: 100%;
        transition: transform 0.5s ease;
    }
    .zoomed {
        transform: scale(2);
    }
    .zoom-container {
        overflow: hidden;
        max-height: 400px; /* Adjust as needed */
        position: relative;
        transition: transform 0.5s ease;
    }

</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
     
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
           <div class="w-full">
               <label for="gender" class="pe-3 text-[14px] text-blue">{!! $lang['gen'] !!}:</label> <br>
               <div class="py-2">
                   <input type="radio" name="gender" id="male" value="men"  {{ isset($_POST['gender']) && $_POST['gender'] === 'male' ? 'checked' : '' }}>
                   <label for="male" class="text-[14px] text-blue pe-lg-3 pe-2">{{ $lang['male'] }}</label>
                   <input type="radio" name="gender" id="female" value="women" checked {{ isset($_POST['gender']) && $_POST['gender'] === 'female' ? 'checked' : '' }}>
                   <label for="female" class="text-[14px] text-blue">{{ $lang['female'] }}</label>
               </div>
           </div>
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-8">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                        <div class="col-span-6">
                            <label for="chest" class="text-[14px] text-blue chest">{!! $lang['bust'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="chest" id="chest" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['chest']) ? $_POST['chest'] : '38.6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="bust_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bust_units_dropdown')">{{ isset($_POST['bust_units'])?$_POST['bust_units']:'in' }} ▾</label>
                                <input type="text" name="bust_units" value="{{ isset($_POST['bust_units'])?$_POST['bust_units']:'in' }}" id="bust_units" class="hidden">
                                <div id="bust_units_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bust_units">
                                    <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bust_units', 'in')">inches (in)</p>
                                    <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bust_units', 'cm')">centimeters (cm)</p>
                                </div>
                             </div>
                        </div>

                        {{-- <div class="col-span-6">
                            <label for="chest" class="text-[14px] text-blue chest">{!! $lang['bust'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="chest" id="chest" step="any" min="14" max="98"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['chest']) ? $_POST['chest'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="bust_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bust_units_dropdown')">{{ isset($_POST['bust_units'])?$_POST['bust_units']:'in' }} ▾</label>
                                <input type="text" name="bust_units" value="{{ isset($_POST['bust_units'])?$_POST['bust_units']:'in' }}" id="bust_units" class="hidden">
                                <div id="bust_units_dropdown" class="units bust_units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bust_units">
                                    <p value="in" onclick="changeUnits(this, 'chest', 14, 98)" onclick="setUnit('bust_units', 'in')" class="p-2 hover:bg-gray-100 cursor-pointer" >inches (in)</p>
                                    <p  value="cm" onclick="changeUnits(this, 'chest', 41, 250)" onclick="setUnit('bust_units', 'cm')" class="p-2 hover:bg-gray-100 cursor-pointer" >centimeters (cm)</p>
                                </div>
                             </div>
                        </div> --}}
                        <div class="col-span-6">
                            <label for="waist" class="text-[14px] text-blue">{!! $lang['Waist'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="waist" id="waist" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['waist']) ? $_POST['waist'] : '27.6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="waist_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('waist_units_dropdown')">{{ isset($_POST['waist_units'])?$_POST['waist_units']:'in' }} ▾</label>
                                <input type="text" name="waist_units" value="{{ isset($_POST['waist_units'])?$_POST['waist_units']:'in' }}" id="waist_units" class="hidden">
                                <div id="waist_units_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="waist_units">
                                    <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_units', 'in')">inches (in)</p>
                                    <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('waist_units', 'cm')">centimeters (cm)</p>
                                </div>
                             </div>
                        </div>


                        {{-- <div class="col-span-6">
                            <label for="waist" class="text-[14px] text-blue">{!! $lang['Waist'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="waist" id="waist" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->waist)?request()->waist:'' }}" min="14" max="78" />
                                <label for="waist_units" class="text-blue input_unit text-decoration-underline">{{ isset($_POST['waist_units'])?$_POST['waist_units']:'in' }} ▾</label>
                                <input type="text" name="waist_units" value="{{ isset($_POST['waist_units'])?$_POST['waist_units']:'in' }}" id="waist_units" class="hidden">
                                <div class="units waist_units hidden" to="waist_units">
                                    <p value="in" onclick="changeUnits(this, 'waist', 14, 78)">inches (in)</p>
                                    <p value="cm" onclick="changeUnits(this, 'waist', 41, 200)">centimeters (cm)</p>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-span-6">
                            <label for="high" class="text-[14px] text-blue">{!! $lang['high'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="high" id="high" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['high']) ? $_POST['high'] : '37.4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="high_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('high_units_dropdown')">{{ isset($_POST['high_units'])?$_POST['high_units']:'in' }} ▾</label>
                                <input type="text" name="high_units" value="{{ isset($_POST['high_units'])?$_POST['high_units']:'in' }}" id="high_units" class="hidden">
                                <div id="high_units_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="high_units">
                                    <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('high_units', 'in')">inches (in)</p>
                                    <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('high_units', 'cm')">centimeters (cm)</p>
                                </div>
                             </div>
                        </div>
                        {{-- <div class="col-span-6">
                            <label for="high" class="text-[14px] text-blue">{!! $lang['high'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="high" id="high" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->high)?request()->high:'' }}"  min="14" max="55"/>
                                <label for="high_units" class="text-blue input_unit text-decoration-underline">{{ isset($_POST['high_units'])?$_POST['high_units']:'in' }} ▾</label>
                                <input type="text" name="high_units" value="{{ isset($_POST['high_units'])?$_POST['high_units']:'in' }}" id="high_units" class="hidden">
                                <div class="units high_units hidden" to="high_units">
                                    <p value="in" onclick="changeUnits(this, 'high', 14, 55)">inches (in)</p>
                                    <p value="cm" onclick="changeUnits(this, 'high', 41, 130)">centimeters (cm)</p>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-span-6">
                            <label for="hip" class="text-[14px] text-blue">{!! $lang['Hip'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="hip" id="hip" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hip']) ? $_POST['hip'] : '39.4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="hip_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hip_units_dropdown')">{{ isset($_POST['hip_units'])?$_POST['hip_units']:'in' }} ▾</label>
                                <input type="text" name="hip_units" value="{{ isset($_POST['hip_units'])?$_POST['hip_units']:'in' }}" id="hip_units" class="hidden">
                                <div id="hip_units_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hip_units">
                                    <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hip_units', 'in')">inches (in)</p>
                                    <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hip_units', 'cm')">centimeters (cm)</p>
                                </div>
                             </div>
                        </div>
                        {{-- <div class="col-span-6">
                            <label for="hip" class="text-[14px] text-blue">{!! $lang['Hip'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" name="hip" id="hip" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->hip)?request()->hip:'' }}" min="14" max="47" />
                                <label for="hip_units" class="text-blue input_unit text-decoration-underline">{{ isset($_POST['hip_units'])?$_POST['hip_units']:'in' }} ▾</label>
                                <input type="text" name="hip_units" value="{{ isset($_POST['hip_units'])?$_POST['hip_units']:'in' }}" id="hip_units" class="hidden">
                                <div class="units hip_units hidden" to="hip_units">
                                    <p value="in" onclick="changeUnits(this, 'hip', 14, 47)">inches (in)</p>
                                    <p value="cm" onclick="changeUnits(this, 'hip', 41, 120)">centimeters (cm)</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-span-4 flex items-center justify-center">
                    <div class="col-12 h-100 flex   mt-4 mt-lg-0 py-2">
                        <img src="{{ asset('images/bodyshapes/new_female_shape_new.png') }}" alt="Shape Image" class="max-width img" @if($device == 'mobile')  height="240px" @else height="270px" @endif>
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


    @endunless
    @isset($detail)
        <style>
            @media (max-width: 480px) {
                .calculator-box{
                    padding-right: 0;
                    padding-left: 0;
                    padding-top: 0;
                }
            }
        </style>
      <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <div class="bg-white border radius-10 p-3">
                                <div class="w-full md:w-[80%] lg:w-[80%] flex flex-column flex-md-row justify-between mx-auto items-center">
                                    <div class="">
                                        <p><strong class="text-[21px]">{{ $lang['ans'] }}</strong></p>
                                        <p class="text-center my-2"><strong class="text-green-700 text-[25px] ">{{ $detail['shape'] }}</strong></p>
                                        <p><strong class="text-[18px]">{{ $lang['whr'] }}</strong></p>
                                        <p class="text-center"><strong class="text-green-700 text-[18px]">{{ $detail['whr'] }}</strong></p>
                                    </div>
                                    @php
                                        $img = $detail['img'];
                                    @endphp
                                    <div class="border-r hidden lg:block py-5"></div>
                                    <div class="text-center">
                                        <img src="{{ asset("images/bodyshapes/$img.png") }}" alt="{{ request()->gender }} body shapes" class="imageToZoom shapes" width="150px" @if(request()->gender == 'men')  height="290px" @else height="220px" @endif loading="lazy" id="genderImage" style="object-fit:contain">
                                        @if($device == 'mobile')
                                            <p class="text-[14px]"><strong>Remember:</strong> your body is a gift, treat it with kindness and it will treat you even better</p>
                                        @endif
                                    </div>
                                </div>
                                @if($device == 'desktop')
                                    <p class="text-[14px] text-center"><strong>Remember:</strong> your body is a gift, treat it with kindness and it will treat you even better</p>
                                @endif
                            </div>
                            <div class="w-full bg-white border radius-10 p-3 mt-4 {{ (request()->gender === 'men') ? '' : 'hidden' }}">
                                <div class="w-full {{ ($detail['shape'] === 'Rectangle') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Rectangle Body Shape:</strong></p>
                                    <div class="w-full ">
                                        <p>Most of the men in this world possess this body shape and this is why. Men who have this body type are generally smart-looking individuals with a tall height compared to men of other body shapes. If your body is rectangular, your shoulders, waist, and hips measure the same value. Every 4 men out of 10 have this particular body type.                            </p>
                                        <div class="w-full">
                                            <p class="text-[18px] mt-2"><strong class="text-blue">Celebrites having Rectangle Body Shape:</strong></p>
                                            <div class="col-lg-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">David Beckham</li>
                                                    <li class="py-1">Ryan Reynolds</li>
                                                    <li class="py-1">Ashton Kutcher</li>
                                                    <li class="py-1">Jared Leto</li>
                                                    <li class="py-1">Hugh Grant</li>
                                                    <li class="py-1">Ewan McGregor</li>
                                                    <li class="py-1">Ryan Gosling</li>
                                                    <li class="py-1">Bradley Cooper</li>
                                                </ul>
                                            </div>
                                            <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up?</strong></p>
                                            <div class="w-full">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Add volume to your shoulders with structured jackets and blazers
                                                    </li>
                                                    <li class="py-1">Create the illusion of a waist with belts and accessories</li>
                                                    <li class="py-1">Wear clothing with vertical stripes or patterns to elongate your silhouette</li>
                                                    <li class="py-1">Opt for fitted shirts and pants to enhance your natural shape</li>
                                                    <li class="py-1">Avoid overly baggy or boxy clothing that can make you appear wider</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Trapezoid') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Trapezoid Body Shape:</strong></p>
                                    <div class="w-full ">
                                        <p>The trapezoid body shape, also known as the "wedge", is characterized by broader shoulders and a narrower waist. Men with this body type often have a muscular upper body and a more tapered waistline.                            </p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">Celebrites having Trapezoid Body Shape :</strong></p>
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Chris Evans</li>
                                                    <li class="py-1">Henry Cavill
                                                    </li>
                                                    <li class="py-1">Ryan Reynolds</li>
                                                    <li class="py-1">Brad Pitt</li>
                                                    <li class="py-1">Dwayne Johnson (The Rock)</li>
                                                </ul>
                                            </div>
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">How to dress up?:</strong></p>
                                            <div class="col-span-12">
                                                <ul class=" blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Use belts to accentuate your natural waistline.
                                                    </li>
                                                    <li class="py-1">Wear V-neck shirts or jackets with slightly tapered sleeves.</li>
                                                    <li class="py-1">Wear pants or shorts that showcase your legs.</li>
                                                    <li class="py-1">Opt for slim-fitting clothing to avoid adding bulk to your upper body.</li>
                                                    <li class="py-1">Layering can help create a more balanced silhouette.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Triangle') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Triangle Body Shape:</strong></p>
                                    <div class="w-full ">
                                        <p>You must have a wider waist if this body shape belongs to you. The body type is quite similar to that of the oval shape. Men with triangular bodies have narrow shoulders. This is why it is suggested to wear dark-colored costumes that highlight the upper half of the body. The body type is also known as “The Dad Bold” and a few men in the world have this shape.</p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <p class="text-[18px] mt-2"><strong class="text-blue">Celebrites having Triangle Body Shape :</strong></p>
                                            <div class="col-lg-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Tom Cruise</li>
                                                    <li class="py-1">Ryan Reynolds
                    
                                                    </li>
                                                    <li class="py-1">Hugh Jackman
                                                    </li>
                                                    <li class="py-1">Brad Pitt</li>
                                                    <li class="py-1">Dwayne Johnson</li>
                                                </ul>
                                            </div>
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">How to dress up?:</strong></p>
                                            <div class="col-span-12 ">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Choose clothing that adds volume to your hips and legs
                                                    </li>
                                                    <li class="py-1">Opt for shirts and jackets with subtle detailing or patterns around the shoulder area
                                                    </li>
                                                    <li class="py-1">Use belts or accessories to cinch your waist and create a more defined silhouette</li>
                                                    <li class="py-1">Wearing clothing with vertical stripes can help to create a more balanced appearance
                                                    </li>
                                                    <li class="py-1">Steer clear of bulky or oversized clothing that can make your upper body appear even broader</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Oval') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Oval Body Shape:</strong></p>
                                    <div class="w-full ">
                                        <p>The oval body shape, also known as the "round" or "apple" shape, is characterized by a fuller midsection and a more rounded appearance. Men with this body type often have a larger chest and waist, with their shoulders and hips measuring similarly.
                                        </p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">Celebrites having Oval Body Shape :</strong></p>
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">James Corden</li>
                                                    <li class="py-1">Elton John
                                                    </li>
                                                    <li class="py-1">Ryan Reynolds</li>
                                                    <li class="py-1">John Goodman</li>
                                                    <li class="py-1">Jack Black</li>
                                                    <li class="py-1">Zach Miko</li>
                                                </ul>
                                            </div>
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">How to dress up?:</strong></p>
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Opt for clothing with V-necks or vertical stripes to help elongate your torso
                                                    </li>
                                                    <li class="py-1">Layering can help add dimension and break up the rounded shape. Choose pieces that complement each other and create a visually appealing effect
                                                    </li>
                                                    <li class="py-1">Steer clear of overly tight-fitting garments that can accentuate your midsection
                                                    </li>
                                                    <li class="py-1">Use color and pattern to draw attention away from your midsection and create a more balanced look
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Inverted Triangle') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Inverted Triangle Body Shape:</strong></p>
                                    <div class="w-full ">
                                        <p>The inverted triangle body shape, also known as the "wedge" or "triangle" shape, is characterized by broader shoulders and a narrower waist. Men with this body type often have a muscular upper body and a more tapered waistline.                           </p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">Celebrites having Inverted Triangle Body Shape :</strong></p>
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Brad Pitt
                                                    </li>
                                                    <li class="py-1">Chris Hemsworth
                    
                                                    </li>
                                                    <li class="py-1">Chris Evan</li>
                                                    <li class="py-1">Ryan Gosling</li>
                                                </ul>
                                            </div>
                                            <p class="col-span-12 text-[18px] mt-2"><strong class="text-blue">How to dress up?:</strong></p>
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Opt for clothing that balances the broader shoulders with the narrower waist. For example, try wearing V-neck shirts or jackets with slightly tapered sleeves.
                    
                                                    </li>
                                                    <li class="py-1">Since the upper body is often more prominent, consider wearing pants or shorts that showcase your legs to create a balanced overall look.
                                                    </li>
                                                    <li class="py-1">Steer clear of bulky or oversized clothing that can make your upper body appear even broader.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full bg-white border radius-10 p-3 mt-4 {{ (request()->gender === 'women') ? '' : 'hidden' }}">
                                <div class="w-full {{ ($detail['shape'] === 'Hourglass') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Hourglass Body Shape:</strong></p>
                                    <div class="w-full {{ (request()->gender === 'men') ? 'hidden' : '' }}">
                                        <p>Hourglass body shape consists of larger hips and bust measurements along with a narrower waist. Approximately 8.4% of the total women population around the globe have such a body type. Moreover, it is a body kind almost every woman wishes to have. This body figure is very attractive and adds beauty to the women’s personality.</p>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities having hourglass body shape:</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Christina Hendricks</li>
                                                    <li class="py-1">Salma Hayek</li>
                                                    <li class="py-1">Kim Novak</li>
                                                    <li class="py-1">Elizabeth Taylor</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Sophia Loren</li>
                                                    <li class="py-1">Scarlett Johansson</li>
                                                    <li class="py-1">Marilyn Monroe</li>
                                                    <li class="py-1">Ursula Andress</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Raquel Welch</li>
                                                    <li class="py-1">Marilyn Monroe</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up an hourglass body shape?</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">You must use undergarments and costumes that best fit your slim body</li>
                                                    <li class="py-1">Wear up dresses that go on prominent your waist and hips </li>
                                                    <li class="py-1">Use jumpsuits that increase to your body dimensions </li>
                                                    <li class="py-1">Try using the thinner border lined tops </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Bottom') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Bottom Hourglass Body Shape:</strong></p>
                                    <div class="w-full">
                                        <p>Usually, a bottom hourglass body shape constitutes a larger waist to hip ratio than the bust. Almost 9% of the total women in the world are having this body figure. Putting up considerable dresses enhances attraction towards the women having this kind of body figure.</p>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities having bottom hourglass body shape:</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Tyra Banks</li>
                                                    <li class="py-1">Sofia Vergara</li>
                                                    <li class="py-1">Jennifer Lopez</li>
                                                    <li class="py-1">America Ferrera</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Katherine Heigl</li>
                                                    <li class="py-1">Tyra Banks</li>
                                                    <li class="py-1">Sara Ramirez</li>
                                                    <li class="py-1">Jordin Sparks</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up a bottom hourglass body shape?</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Use simple tops with jeans that are straight</li>
                                                    <li class="py-1">You should use scarf or anything that will give a particular highlight to your face dimensions</li>
                                                    <li class="py-1">Try avoiding straight costumes that make you look odd enough</li>
                                                    <li class="py-1">Never use low waisted skirts due to the bulk accumulated in your lower body</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Top Hourglass') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Top Hourglass Body Shape:</strong></p>
                                    <div class="w-full">
                                        <p>The top hourglass shape is defined by a greater bust circumference than hip circumference. As well as the ratios of their bust-to-waist and hips-to-waist measurements are significant enough to result in a distinct waistline. Approximately, less than 10% of the global women population comprise such a figure.</p>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities with top hourglass body shape:</strong></p>
                                          <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Emilia Clarke</li>
                                                    <li class="py-1">Emma Roberts</li>
                                                    <li class="py-1">Dita von Teese</li>
                                                    <li class="py-1">Kat Dennings</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Jenna Dewan</li>
                                                    <li class="py-1">Bridget Bardot</li>
                                                    <li class="py-1">Halle Berry</li>
                                                    <li class="py-1">Jayne Mansfield</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up an upper hourglass body shape?</strong></p>
                                          <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Don't use flexible tops that broaden your shoulder and bust</li>
                                                    <li class="py-1">Use nipped dresses that add to the dimensions of such body</li>
                                                    <li class="py-1">Using wrap dresses may be a great option as they create a catchy silhouette</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Spoon') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Spoon Shaped Body:</strong></p>
                                    <div class="w-full">
                                        <p>Spoon shaped body is just like a pear shaped. Women having such a body figure have broader hips than that of the bust and shoulders. But a spoon shaped body typically has a larger belly than a pear one. Women with such a shape have thinner necklines and slim waist that give their figure a charming sight.</p>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities having an spoon body shape:</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Cheryl Burke</li>
                                                    <li class="py-1">Jennifer Love Hewitt</li>
                                                    <li class="py-1">Cameron Diaz</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up an inverted triangle body shape?</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Use A line shirts with princess cut designs </li>
                                                    <li class="py-1">You may use strapless costumes in case you have this kind of body. Try using dresses with one strap as well</li>
                                                    <li class="py-1">For lower part of the body, you should better wear long pants</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full  {{ ($detail['shape'] === 'Triangle') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Triangle Body Shape:</strong></p>
                                    <div class="w-full">
                                        <p>This body shape is quite similar to that of the hourglass. The larger hip size than bust and waist give it the name of pear shaped figure. All around the globe, typically 21% of women have such a body type. A flat stomach adds to the beauty of the shape as well. People also call the triangular shaped body a pear one.</p>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities having pear body shape:</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Kate Winslet</li>
                                                    <li class="py-1">Beyonce</li>
                                                    <li class="py-1">Jennifer Lopez</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Shakira</li>
                                                    <li class="py-1">Paris Hilton</li>
                                                    <li class="py-1">Rihanna</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Kim Kardashian </li>
                                                    <li class="py-1">Christina Aguilera</li>
                                                    <li class="py-1">Eva Longoria</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up a pear body shape?</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">You should try to use bright colored tops to prominent your upper area of the body</li>
                                                    <li class="py-1">Use costumes that helps you prominent your shoulders and bust specially</li>
                                                    <li class="py-1">Try using clothes having long sleeves to highlight your arms’ dimensions</li>
                                                    <li class="py-1">Use dark colored skirts or pants to cover your bottom body area</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Inverted Triangle') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Inverted Triangle Body Shape:</strong></p>
                                    <p>An inverted triangular body shape has large measurements for shoulders and bust but the measure of waist and hips are small enough. On an average, about 10% of the total ladies around the globe have this body shape. Another name used for this body kind is strawberry shaped.</p>
                                    <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities having an inverted triangle body shape:</strong></p>
                                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <ul class="blue-marker float-start ps-3 list-disc">
                                                <li class="py-1">Giselle Bundchen</li>
                                                <li class="py-1">Angelina Jolie</li>
                                                <li class="py-1">Naomi Campbell</li>
                                            </ul>
                                        </div>
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <ul class="blue-marker float-start ps-3 list-disc">
                                                <li class="py-1">Renee Zellweger</li>
                                                <li class="py-1">Charlize Theron</li>
                                                <li class="py-1">Demi Moore</li>
                                            </ul>
                                        </div>
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <ul class="blue-marker float-start ps-3 list-disc">
                                                <li class="py-1">Catherine Zeta-Jones</li>
                                                <li class="py-1">Federica Pellegrini</li>
                                                <li class="py-1">Jennifer Garner</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up an inverted triangle body shape?</strong></p>
                                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                        <div class="col-span-12">
                                            <ul class="blue-marker float-start ps-3 list-disc">
                                                <li class="py-1">Try wearing blouses with asymmetrical necklines</li>
                                                <li class="py-1">Use longer pants to show off your long legs </li>
                                                <li class="py-1">Use leather jackets and uppers that extent to the hips </li>
                                                <li class="py-1">Try to wear tops with wider straps</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full {{ ($detail['shape'] === 'Rectangle') ? '' : 'hidden' }}">
                                    <p class="text-[18px]"><strong class="text-blue">Rectangle Body Shape:</strong></p>
                                    <div class="w-full">
                                        <p>A rectangular body shape is a kind of straight figure having almost equal measurements for bust, waist, and hips. Women having such a body shape are relatively tall and seem physically active enough. Almost 46% of the total women population around the globe has this figure type. A good fact to consider here is that if weight is increased, it gets distributed thoroughly around the whole body.</p>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">Celebrities having rectangular body shape:</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Kate Hudson </li>
                                                    <li class="py-1">Gigi Hadid </li>
                                                    <li class="py-1">Cameron Diaz</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Kendall Jenner</li>
                                                    <li class="py-1">Sienna Miller</li>
                                                    <li class="py-1">Kate Moss</li>
                                                </ul>
                                            </div>
                                            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Gwyneth Paltrow</li>
                                                    <li class="py-1">Gwen Stefani</li>
                                                    <li class="py-1">Natalie Portman</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-[18px] mt-2"><strong class="text-blue">How to dress up a rectangular body shape?</strong></p>
                                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                            <div class="col-span-12">
                                                <ul class="blue-marker float-start ps-3 list-disc">
                                                    <li class="py-1">Avoid tucking your tops into trousers</li>
                                                    <li class="py-1">Use dark colored belts around your waist area that seem prominent</li>
                                                    <li class="py-1">Wear such tops in which your shoulders and waist get prominent </li>
                                                    <li class="py-1">Use such costumes that create illusion around your waist area</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="w-full text-[18px] my-3"><strong>Different Body Shapes are:</strong></p>
                            <div class="w-full bg-sky border rounded-lg p-2 zoom-container flex items-center">
                                <div class="w-full text-center">
                                    @php
                                        $imgs = (request()->gender === 'men') ? 'images/bodyshapes/new_male_result_shape.png' : 'images/bodyshapes/bodyshape_femalenew.png';
                                    @endphp
                                    <img src="{{ asset($imgs) }}" alt="Body Shapes" class="max-width image imageToZoom {{ (request()->gender === 'men') ? '' : 'pt-2' }}">
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-center mt-[30px]">
                            <a href="{{ url()->current() }}">
                                <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                    @if (app()->getLocale() == 'en')
                                        RESET
                                    @else
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    @endif
                                </a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            @if(!isset($detail))
                document.addEventListener('DOMContentLoaded', function() {
                    var img = document.querySelector('.img');
                    document.getElementById('male').addEventListener('click', function() {
                        img.setAttribute('src',"{{ asset('images/bodyshapes/male_shape_new.png') }}");
                    });
                    document.getElementById('female').addEventListener('click', function() {
                        img.setAttribute('src',"{{ asset('images/bodyshapes/new_female_shape_new.png') }}");
                    });
                });
                function changeUnits(element, inputId, minValue, maxValue) {
                    var inputField = document.getElementById(inputId);
                    inputField.min = minValue;
                    inputField.max = maxValue;
                    var unitLabel = element.closest('.relative').querySelector('.input_unit');
                    unitLabel.innerHTML = element.innerHTML;
                    var hiddenInput = element.closest('.relative').querySelector('.hidden');
                    hiddenInput.value = element.getAttribute('value');
                    element.closest('.units').classList.add('hidden');
                }
            @endif
                @if($device == 'mobile' && isset($detail))
                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('.imageToZoom').forEach(ele => {
                            ele.addEventListener('click', function() {
                                ele.classList.toggle('zoomed');
                                const zoomContainer = ele.closest('.zoom-container');
                                if (ele.classList.contains('zoomed')) {
                                    zoomContainer.style.overflow = 'auto';
                                    zoomContainer.style.height = '200px';
                                } else {
                                    zoomContainer.style.overflow = 'hidden';
                                    zoomContainer.style.height = '';
                                }
                            });
                        });
                    });
                @endif
        </script>
    @endpush
</form>