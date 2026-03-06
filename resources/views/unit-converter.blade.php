@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
    <div class="max-w-7xl mx-auto  w-full bg-white text-black mb-10 ">
        <div class="max-w-7xl mx-auto flex flex-wrap px-4">

            <div class=" w-full lg:w-[65%] md:w-[65%]  pt-4">
                <div class="row">
                    <h1 class="text-2xl lg:text-2xl md:text-2xl font-semibold my-3 ">Unit Converter</h1>
                </div>
                <div class="set_resultbox w-full p-2 md:p-2 lg:p-2  rounded-[20px]">
                    <div class="grid grid-cols-12 mx-auto relative rounded-lg">

                        @livewire('unit-converter', ['device' => $device])

                    </div>
                </div>
                <div class="col-span-12 mt-4">
                    <div class="col-12 content my-2 contentAll">
                        The conversion calculator is a clever tool that enables to carry out measurement conversions between
                        the unique units of measurements inside exceptional measure structures.

                        This unit dimension calculator offers you with a primary expertise of the systems that presently in
                        use at some point of the sector.
                        <h2 id="History-of-the-Metric-System">Records of the Metric system:</h2>
                        In 1975, the government of French formally adopted the metric gadget of dimension. Gabriel Mouton (a
                        church vicar in Lyons), France, is named as the founder of the metric machine. In 1670, Gabriel did
                        a splendid process as he proposed a decimal gadget of measurement, which the French scientists might
                        couple of years in addition refining.

                        In 1790, the country wide meeting of France (French: Assemblée nationale) known as for an invariable
                        trendy of measurements and weights having as its basis a unit of duration that depends in the
                        world’s circumference. As a comfort the machine of measurements would be decimal based totally in
                        conjunction with larger & smaller multiples of each unit that arrived with the aid of dividing &
                        multiplying by way of 10 and its powers.
                        <h3 id="How-To-Do-Measurement-Conversion-With-This-Metric-Conversion-Calculator">How to Do
                            dimension Conversion With This Metric Conversion Calculator:</h3>
                        Changing measurements turns into smooth with the help of this tool; this converter for gadgets will
                        do unit converter corresponding to size trendy structures. permit’s take a glance the way it works:

                        This specific version of unit conversion calculator full of a six conversion converters, these are:
                        <ul>
                            <li>Length</li>
                            <li>Temperature</li>
                            <li>Area</li>
                            <li>Volume</li>
                            <li>Weight</li>
                            <li>Time</li>
                        </ul>
                        So, in case you want to perform size conversion with this measurement calculator, then surely stick
                        to the mentioned steps:
                        <ul>
                            <li>All you need to make a click at the tab for that you want to carry out measurements
                                conversion</li>
                            <li>Very subsequent, you need to choose the unit from the left drop down container for that you
                                want to transform from and input the value of this selected unit into the given field</li>
                            <li>Then, you have to pick the unit from the proper drop-down box for that you need to get
                                conversions</li>
                            <li>Once finished, the unit size converter calculator perform brief real-time conversions</li>
                        </ul>
                        <h2 id="Metric-Measurement-Conversions"><strong>Metric dimension Conversions:</strong></h2>
                        A listing of metric unit conversions is supplied inside the given metric unit conversion table:
                        <div class="col s12" style="overflow: auto;">
                            <table class="highlight striped font_size18 font_s16_m" style="height: 3271px;" width="755">
                                <caption class="">Common equivalents and conversion elements for U.S. customary and
                                    SI structures</caption>
                                <thead class="">
                                    <tr>
                                        <th colspan="2" scope="col">Approximate commonplace equivalents</th>
                                    </tr>
                                </thead>
                                <tfoot class="">
                                    <tr>
                                        <td colspan="2">*Common term not used in SI.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">**Exact.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Source: National Bureau of Standards Wall Chart.</td>
                                    </tr>
                                </tfoot>
                                <tbody class="">
                                    <tr>
                                        <td scope="row">1 inch</td>
                                        <td>= 25 millimetres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 foot</td>
                                        <td>= 0.3 metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 yard</td>
                                        <td>= 0.9 metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 mile</td>
                                        <td>= 1.6 kilometres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 square inch</td>
                                        <td>= 6.5 square centimetres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 square foot</td>
                                        <td>= 0.09 square metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 square yard</td>
                                        <td>= 0.8 square metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 acre</td>
                                        <td>= 0.4 hectare*</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic inch</td>
                                        <td>= 16 cubic centimetres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic foot</td>
                                        <td>= 0.03 cubic metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic yard</td>
                                        <td>= 0.8 cubic metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 quart (liq)</td>
                                        <td>= 1 litre*</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 gallon</td>
                                        <td>= 0.004 cubic metre</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 ounce (avdp)</td>
                                        <td>= 28 grams</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 pound (avdp)</td>
                                        <td>= 0.45 kilogram</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 horsepower</td>
                                        <td>= 0.75 kilowatt</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 millimetre</td>
                                        <td>= 0.04 inch</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 metre</td>
                                        <td>= 3.3 feet</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 metre</td>
                                        <td>= 1.1 yards</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 kilometre</td>
                                        <td>= 0.6 mile (statute)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 square centimetre</td>
                                        <td>= 0.16 square inch</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 square metre</td>
                                        <td>= 11 square feet</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 square metre</td>
                                        <td>= 1.2 square yards</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 hectare*</td>
                                        <td>= 2.5 acres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic centimetre</td>
                                        <td>= 0.06 cubic inch</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic metre</td>
                                        <td>= 35 cubic feet</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic metre</td>
                                        <td>= 1.3 cubic yards</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 litre*</td>
                                        <td>= 1 quart (liq)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 cubic metre</td>
                                        <td>= 264 gallons</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 gram</td>
                                        <td>= 0.035 ounce (avdp)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 kilogram</td>
                                        <td>= 2.2 pounds (avdp)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">1 kilowatt</td>
                                        <td>= 1.3 horsepower</td>
                                    </tr>
                                </tbody>
                                <thead class="">
                                    <tr>
                                        <th colspan="2" scope="col">conversions accurate within 10 parts per million
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr>
                                        <td scope="row">inches × 25.4**</td>
                                        <td>= millimetres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">feet × 0.3048**</td>
                                        <td>= metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">yards × 0.9144**</td>
                                        <td>= metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">miles × 1.60934</td>
                                        <td>= kilometres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">square inches × 6.4516**</td>
                                        <td>= square centimetres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">square feet × 0.0929030</td>
                                        <td>= square metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">square yards × 0.836127</td>
                                        <td>= square metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">acres × 0.404686</td>
                                        <td>= hectares</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic inches × 16.3871</td>
                                        <td>= cubic centimetres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic feet × 0.0283168</td>
                                        <td>= cubic metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic yards × 0.764555</td>
                                        <td>= cubic metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">quarts (liq) × 0.946353</td>
                                        <td>= litres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">gallons × 0.00378541</td>
                                        <td>= cubic metres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">ounces (avdp) × 28.3495</td>
                                        <td>= grams</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">pounds (avdp) × 0.453592</td>
                                        <td>= kilograms</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">horsepower × 0.745700</td>
                                        <td>= kilowatts</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">millimetres × 0.0393701</td>
                                        <td>= inches</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">metres × 3.28084</td>
                                        <td>= feet</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">metres × 1.09361</td>
                                        <td>= yards</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">kilometres × 0.621371</td>
                                        <td>= miles (statute)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">square centimetres × 0.155000</td>
                                        <td>= square inches</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">square metres × 10.7639</td>
                                        <td>= square feet</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">square metres × 1.19599</td>
                                        <td>= square yards</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">hectares × 2.47105</td>
                                        <td>= acres</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic centimetres × 0.0610237</td>
                                        <td>= cubic inches</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic metres × 35.3147</td>
                                        <td>= cubic feet</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic metres × 1.30795</td>
                                        <td>= cubic yards</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">litres × 1.05669</td>
                                        <td>= quarts (liq)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">cubic metres × 264.172</td>
                                        <td>= gallons</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">grams × 0.0352740</td>
                                        <td>= ounces (avdp)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">kilograms × 2.20462</td>
                                        <td>= pounds (avdp)</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">kilowatts × 1.34102</td>
                                        <td>= horsepower</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h2 id="FAQs"><strong>FAQ’s</strong></h2>
                        <h3 id="Why-Is-Measurement-Important-In-Our-Daily-Life">Why Is size vital In Our every day life?
                        </h3>
                        No question, measurements are something that provides a popular for normal things and approaches.
                        There are sure gadgets from weight, length, temperature, even time is a measurement devices and it
                        does play a crucial position in our daily lives. also, we use a size of money or forex.
                        <h3 id="How-Do-I-Convert-Metric-To-Standard">How Do I Convert Metric to traditional?</h3>
                        The perfect and best manner is to use the metric to standard conversion tables.
                        <h3 id="What-Are-The-Main-Units-Of-Length-In-The-US"><strong>What Are the principle units Of length
                                inside the US?</strong></h3>
                        For measuring the duration units, the U.S. standard size device makes use of the foot, backyard,
                        inch, an mile, these are the most effective four main standard duration measurements in that use in
                        each day lives. when you consider that 1959, these had been stated on the idea of one backyard =
                        0.9144 m, which except for some programs in surveying.
                        <h3 id="What-Is-Metric-To-English-Conversion">what is Metric To English Conversion?</h3>
                        All you want to stick to the metric to English conversion chart to perform these conversions.
                        <h3 id="What-Are-Standard-Units-Of-Measurement"><strong>What Are wellknown units Of size?</strong>
                        </h3>
                        A fashionable unit of dimension is stated to a quantifiable language that assists all people to
                        apprehend the association of the object with the size.

                        Inside the united statesmeasurements, it's miles expressed feet, inches, and pounds, while in metric
                        gadget, centimeters, meters, and kilograms.
                        <h2 id="References"><strong>References:</strong></h2>
                        From the supply of From Wikipedia, the loose encyclopedia - <a
                            href="https://en.wikipedia.org/wiki/Conversion_of_units" rel="nofollow">Conversion of
                            units</a> – Tables of Conversion factors together with the Calculation concerning non-SI gadgets

                        From the source of wikihow – mathematics and Conversions assistance - <a
                            href="https://www.wikihow.com/Convert-Units" rel="nofollow">How to Convert Units</a> –
                        Co-authored by way of individuals

                    </div>
                </div>

            </div>
            <div class="side-bar mt-[100px] w-full lg:w-[33%] md:w-[33%] ml-5  pt-4 hidden md:block">
                @include('inc.converter-sidebar')
            </div>
        </div>
    </div>

@endsection
