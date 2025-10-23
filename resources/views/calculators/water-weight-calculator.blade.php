<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="from" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="from" id="from" class="input my-2">
                        <option value="353146667214.89" {{ isset($_POST['from']) && $_POST['from'] === "353146667214" ? 'selected' : '' }}>Cubic Feet [ft³]</option>
                        <option value="6.1023744094732E+14" {{ isset($_POST['from']) && $_POST['from'] === "6.1023744094732E+14" ? 'selected' : '' }}>Cubic Inch [in³]</option>
                        <option value="42267528377304" {{ isset($_POST['from']) && $_POST['from'] === "42267528377304" ? 'selected' : '' }}>Cups (US)</option>
                        <option value="40000000000000" {{ isset($_POST['from']) && $_POST['from'] === "40000000000000" ? 'selected' : '' }}>Cups (Metric)</option>
                        <option value="2641720523581.5" {{ isset($_POST['from']) && $_POST['from'] === "2641720523581.5" ? 'selected' : '' }}>Gallons (US)</option>
                        <option value="2199692482990.9" {{ isset($_POST['from']) && $_POST['from'] === "2199692482990.9" ? 'selected' : '' }}>Gallons (UK)</option>
                        <option value="10000000000000" {{ isset($_POST['from']) && $_POST['from'] === "10000000000000" ? 'selected' : '' }}>Liter [L]</option>
                        <option value="1.0E+16" {{ isset($_POST['from']) && $_POST['from'] === "1.0E+16" ? 'selected' : '' }}>Milliliters [mL]</option>
                        <option value="21133764188652" {{ isset($_POST['from']) && $_POST['from'] === "21133764188652" ? 'selected' : '' }}>Pints (US)</option>
                        <option value="17597539863927" {{ isset($_POST['from']) && $_POST['from'] === "17597539863927" ? 'selected' : '' }}>Pints (UK)</option>
                        <option value="10566882094326" {{ isset($_POST['from']) && $_POST['from'] === "10566882094326" ? 'selected' : '' }}>Quarts (US) [qt]</option>
                        <option value="8798769931963.5" {{ isset($_POST['from']) && $_POST['from'] === "8798769931963.5" ? 'selected' : '' }}>Quarts (UK)</option>
                        <option value="6.7628045403686E+14" {{ isset($_POST['from']) && $_POST['from'] === "6.7628045403686E+14" ? 'selected' : '' }}>Tablespoons (US)</option>
                        <option value="5.6312127564566E+14" {{ isset($_POST['from']) && $_POST['from'] === "5.6312127564566E+14" ? 'selected' : '' }}>Tablespoons (UK)</option>
                    </select>
                </div> 
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="vol" class="font-s-14 text-blue">{{ $lang['12'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" name="vol" id="vol" class="input" aria-label="input" value="{{ isset($_POST['vol'])?$_POST['vol']:'12' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="temp" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                    <select name="temp" id="temp" class="input my-2">
                        <option value="0.99987" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99987" ? 'selected' : '' }}>32°F / 0°C</option>
                        <option value="1.00000" {{ isset($_POST['temp']) && $_POST['temp'] === "1.00000" ? 'selected' : '' }}>39.2°F / 4.0°C</option>
                        <option value="0.99999" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99999" ? 'selected' : '' }}>40°F / 4.4°C</option>
                        <option value="0.99975" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99975" ? 'selected' : '' }}>50°F / 10°C</option>
                        <option value="0.99907" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99907" ? 'selected' : '' }}>60°F / 15.6°C</option>
                        <option value="0.99802" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99802" ? 'selected' : 'selected' }}>70°F / 21°C (room temp)</option>
                        <option value="0.99669" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99669" ? 'selected' : '' }}>80°F / 26.7°C</option>
                        <option value="0.99510" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99510" ? 'selected' : '' }}>90°F / 32.2°C</option>
                        <option value="0.99318" {{ isset($_POST['temp']) && $_POST['temp'] === "0.99318" ? 'selected' : '' }}>100°F / 37.8°C</option>
                        <option value="0.98870" {{ isset($_POST['temp']) && $_POST['temp'] === "0.98870" ? 'selected' : '' }}>120°F / 48.9°C</option>
                        <option value="0.98338" {{ isset($_POST['temp']) && $_POST['temp'] === "0.98338" ? 'selected' : '' }}>140°F / 60°C</option>
                        <option value="0.97729" {{ isset($_POST['temp']) && $_POST['temp'] === "0.97729" ? 'selected' : '' }}>160°F / 71.1°C</option>
                        <option value="0.97056" {{ isset($_POST['temp']) && $_POST['temp'] === "0.97056" ? 'selected' : '' }}>180°F / 82.2°C</option>
                        <option value="0.96333" {{ isset($_POST['temp']) && $_POST['temp'] === "0.96333" ? 'selected' : '' }}>200°F / 93.3°C</option>
                        <option value="0.95865" {{ isset($_POST['temp']) && $_POST['temp'] === "0.95865" ? 'selected' : '' }}>212°F / 100°C</option>
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
                        <div class="w-full my-2">
                            <p class="text-[20px] mt-1"><strong>{{$lang[14]}}</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                              
                                <table class="w-full lg:text-[20px] md:text-[20px] text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[15]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['gram'],5)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[16]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['lbs'],5)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[17]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['onz'],5)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{$lang[18]}} :</td>
                                        <td class="py-2 border-b">{{round($detail['kg'],5)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>