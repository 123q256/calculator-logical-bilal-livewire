<style>

  .rc {
      background-color: #fd0100;
  }
  .result .tablesx tr td {
      border: 1px solid #ddd;
      padding: 5px;
  }
  .nela {
      background-color: #e0e9f9;
  }
  .kc {
      background-color: #fadf52;
  }
  .oc {
      background-color: #eb8d0f;
  }
  .kkc {
      background-color: #fdfc86;
  }
  </style>
  
  
  
  <form class="row" action="{{ url()->current() }}/" method="POST">
      @csrf
      <div class="col-12 col-lg-6 mx-auto">
          <div class="row">
          </div>
      </div>


      <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                  <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }} </label>
                    <select name="find" id="find" class="input">
                      <option value="1" {{ isset($_POST['find']) && $_POST['find'] == '1' ? 'selected' : '' }}>
                          {{ $lang['2'] }} & {{ $lang['3'] }}</option>
                      <option value="2" {{ isset($_POST['find']) && $_POST['find'] == '2' ? 'selected' : '' }}>
                          {{ $lang['4'] }} & {{ $lang['5'] }}</option>
                      <option value="3" {{ isset($_POST['find']) && $_POST['find'] == '3' ? 'selected' : '' }}>
                          {{ $lang['6'] }} & {{ $lang['5'] }}</option>
                  </select>
                </div>
                <div class="space-y-2 at">
                  <label for="temp" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="temp" id="temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp'])?$_POST['temp']:'32' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_unit_dropdown')">{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }} ▾</label>
                        <input type="text" name="temp_unit" value="{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }}" id="temp_unit" class="hidden">
                        <div id="temp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°K')">°K</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 rh">
                  <label for="hum" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="hum" id="hum" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hum'])?$_POST['hum']:'32' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="hum_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hum_unit_dropdown')">{{ isset($_POST['hum_unit'])?$_POST['hum_unit']:'%' }} ▾</label>
                        <input type="text" name="hum_unit" value="{{ isset($_POST['hum_unit'])?$_POST['hum_unit']:'%' }}" id="hum_unit" class="hidden">
                        <div id="hum_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hum_unit', '%')">%</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hum_unit', '‰')">‰</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hum_unit', '‱')">‱</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden dp">
                  <label for="dew_point" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="dew_point" id="dew_point" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dew_point'])?$_POST['dew_point']:'32' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dew_point_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dew_point_unit_dropdown')">{{ isset($_POST['dew_point_unit'])?$_POST['dew_point_unit']:'°C' }} ▾</label>
                        <input type="text" name="dew_point_unit" value="{{ isset($_POST['dew_point_unit'])?$_POST['dew_point_unit']:'°C' }}" id="dew_point_unit" class="hidden">
                        <div id="dew_point_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dew_point_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dew_point_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dew_point_unit', '°K')">°K</p>
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
              <div class="w-full lg:p-3 md:p-3 radius-10 mt-3 ">
                  <div class="w-full mt-2">
                      @php
                      $tmv = $detail['tmv'];
                      $temp_unit = $detail['temp_unit'];
                      if ($temp_unit == '1') {
                          $ans = $tmv * 1.8 + 32;
                      } elseif ($temp_unit == '2') {
                          $ans = $tmv;
                      } else {
                          $ans = (($tmv - 273.15) * 9) / 5 + 32;
                      }
                      @endphp
                      <table class="lg:w-[50%] md:w-[50%] w-full font-s-18">
                         <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} </strong></td>
                             <td class="py-2 border-b"> {{ round(($detail['hi'] - 32) * (5 / 9), 3) }} (<sup>o</sup>C)</td>
                         </tr>
                         <tr>
                          <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} </strong></td>
                           <td class="py-2 border-b"> {{ round($detail['hi'], 3) }}  (<sup>o</sup>F)</td>
                       </tr>
                       <tr>
                          <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} </strong></td>
                           <td class="py-2 border-b"> {{ round(($detail['hi'] - 32) * (5 / 9) + 273, 3) }} (<sup>o</sup>K)</td>
                       </tr>
                      </table>
                  </div>
                  <div class="lg:w-[50%] md:w-[50%] w-full mt-2 my-3">
                      <table class="w-full font-s-18">
                          @if(isset($detail['dp']) && $detail['dp']!="")
                      <tr>
                          <td class="py-2 border-b" width="50%"><strong>{{ $lang[5] }}</strong></td>
                          <td class="py-2 border-b"> {{ round($detail['dp'], 3) }} <sup>o</sup> (C)</td>
                      </tr>
                      @endif
                      @if(isset($detail['hum']) && $detail['hum']!="")
                      <tr>
                          <td class="py-2 border-b" width="50%"><strong>{{ $lang[3] }}</strong></td>
                          <td class="py-2 border-b"> {{ round($detail['hum'], 3) }} (%)</td>
                      </tr>
                      @endif
                      @if(isset($detail['temp']) && $detail['temp']!="")
                      <tr>
                          <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] }}</strong></td>
                          <td class="py-2 border-b"> {{ round($detail['temp'] * (9 / 5) + 32, 3) }} (<sup>o</sup>F)/ {{round($detail['temp'], 3)}} (<sup>o</sup>C) </td>
                      </tr>
                      @endif
                      @if(isset($detail['ans']) && $detail['ans']!="")
                      <tr>
                          <td class="py-2 border-b" width="50%"><strong>α(T,RH) </strong></td>
                          <td class="py-2 border-b"> {{ round($detail['ans'], 3)}} </td>
                      </tr>
                      @endif
                      </table>
                  </div>
                  <div class="w-full font-s-20 overflow-auto">
                    @php
                    for ($i = 0; $i <= 208; $i++) {
                        ${"d" . $i} = null;
                    }
                    @endphp
                          @if ($detail['humm'] <= '40' && $ans < '81')
                             @php $d1 = 'border:3px dashed #000;font-weight:600';@endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '81' && $ans < '83')
                            @php  $d2 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '83' && $ans < '85')
                            @php  $d3 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '85' && $ans < '88')
                            @php  $d4 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '88' && $ans < '90')
                            @php  $d5 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '90' && $ans < '92')
                            @php  $d6 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '92' && $ans < '94')
                            @php  $d7 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '94' && $ans < '96')
                            @php  $d8 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '96' && $ans < '98')
                            @php  $d9 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '98' && $ans < '100')
                            @php  $d10 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '100' && $ans < '102')
                            @php  $d11 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '102' && $ans < '104')
                            @php  $d12 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '104' && $ans < '106')
                            @php  $d13 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '106' && $ans < '108')
                            @php  $d14 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '108' && $ans < '110')
                            @php  $d15 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] <= '40' && $detail['humm'] < '43' && $ans >= '110')
                            @php  $d16 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans < '81')
                            @php  $d17 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '81' && $ans < '83')
                            @php  $d18 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '83' && $ans < '85')
                            @php  $d19 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '85' && $ans < '88')
                            @php  $d20 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '88' && $ans < '90')
                            @php  $d21 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '90' && $ans < '92')
                            @php  $d22 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '92' && $ans < '94')
                            @php  $d23 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '94' && $ans < '96')
                            @php  $d24 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '96' && $ans < '98')
                            @php  $d25 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '98' && $ans < '100')
                            @php  $d26 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '100' && $ans < '102')
                            @php  $d27 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '102' && $ans < '104')
                            @php  $d28 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '104' && $ans < '106')
                            @php  $d29 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '106' && $ans < '108')
                            @php  $d30 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '108' && $ans < '110')
                            @php  $d31 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '43' && $detail['humm'] < '48' && $ans >= '110')
                            @php  $d32 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans < '81')
                            @php  $d33 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '81' && $ans < '83')
                            @php  $d34 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '83' && $ans < '85')
                            @php  $d35 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '85' && $ans < '88')
                            @php  $d36 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '88' && $ans < '90')
                            @php  $d37 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '90' && $ans < '92')
                            @php  $d38 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '92' && $ans < '94')
                            @php  $d39 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '94' && $ans < '96')
                            @php  $d40 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '96' && $ans < '98')
                            @php  $d41 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '98' && $ans < '100')
                            @php  $d42 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '100' && $ans < '102')
                            @php  $d43 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '102' && $ans < '104')
                            @php  $d44 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '104' && $ans < '106')
                            @php  $d45 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '106' && $ans < '108')
                            @php  $d46 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '108' && $ans < '110')
                            @php  $d47 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '48' && $detail['humm'] < '53' && $ans >= '110')
                            @php  $d48 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans <= '81')
                            @php  $d49 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '81' && $ans < '83')
                            @php  $d50 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '83' && $ans < '85')
                            @php  $d51 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '85' && $ans < '88')
                            @php  $d52 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '88' && $ans < '90')
                            @php  $d53 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '90' && $ans < '92')
                            @php  $d54 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '92' && $ans < '94')
                            @php  $d55 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '94' && $ans < '96')
                            @php  $d56 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '96' && $ans < '98')
                            @php  $d57 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '98' && $ans < '100')
                            @php  $d58 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '100' && $ans < '102')
                            @php  $d59 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '102' && $ans < '104')
                            @php  $d60 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '104' && $ans < '106')
                            @php  $d61 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '106' && $ans < '108')
                            @php  $d62 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '108' && $ans < '110')
                            @php  $d63 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '53' && $detail['humm'] < '58' && $ans >= '110')
                            @php  $d64 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans < '81')
                            @php  $d65 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '81' && $ans < '83')
                            @php  $d66 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '83' && $ans < '85')
                            @php  $d67 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '85' && $ans < '88')
                            @php  $d68 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '88' && $ans < '90')
                            @php  $d69 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '90' && $ans < '92')
                            @php  $d70 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '92' && $ans < '94')
                            @php  $d71 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '94' && $ans < '96')
                            @php  $d72 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '96' && $ans < '98')
                            @php  $d73 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '98' && $ans < '100')
                            @php  $d74 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '100' && $ans < '102')
                            @php  $d75 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '102' && $ans < '104')
                            @php  $d76 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '104' && $ans < '106')
                            @php  $d77 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '106' && $ans < '108')
                            @php  $d78 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '108' && $ans < '110')
                            @php  $d79 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '58' && $detail['humm'] < '63' && $ans >= '110')
                            @php  $d80 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans <= '81')
                              //2
                            @php  $d81 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '81' && $ans < '83')
                              //3
                            @php  $d82 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '83' && $ans < '85')
                              //3
                            @php  $d83 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '85' && $ans < '88')
                              //3
                            @php  $d84 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '88' && $ans < '90')
                              //4
                            @php  $d85 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '90' && $ans < '92')
                              //4
                            @php  $d86 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '92' && $ans < '94')
                              //4
                            @php  $d87 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '94' && $ans < '96')
                              //5
                            @php  $d88 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '96' && $ans < '98')
                              //6
                            @php  $d89 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '98' && $ans < '100')
                              //6
                            @php  $d90 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '100' && $ans < '102')
                              //7
                            @php  $d91 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '102' && $ans < '104')
                              //7
                            @php  $d92 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '104' && $ans < '106')
                              //8
                            @php  $d93 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '106' && $ans < '108')
                              //8
                            @php  $d94 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '108' && $ans < '110')
                              //9
                            @php  $d95 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '63' && $detail['humm'] < '68' && $ans >= '110')
                            @php  $d96 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans <= '81')
                            @php  $d97 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '81' && $ans < '83')
                            @php  $d98 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '83' && $ans < '85')
                            @php  $d99 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '85' && $ans < '88')
                            @php  $d100 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '88' && $ans < '90')
                            @php  $d101 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '90' && $ans < '92')
                            @php  $d102 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '92' && $ans < '94')
                            @php  $d103 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '94' && $ans < '96')
                            @php  $d104 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '96' && $ans < '98')
                            @php  $d105 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '98' && $ans < '100')
                            @php  $d106 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '100' && $ans < '102')
                            @php  $d107 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '102' && $ans < '104')
                            @php  $d108 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '104' && $ans < '106')
                            @php  $d109 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '106' && $ans < '108')
                            @php  $d110 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '108' && $ans < '110')
                            @php  $d111 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '68' && $detail['humm'] < '73' && $ans >= '110')
                            @php  $d112 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans < '81')
                            @php  $d113 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '81' && $ans < '83')
                            @php  $d114 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '83' && $ans < '85')
                            @php  $d115 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '85' && $ans < '88')
                            @php  $d116 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '88' && $ans < '90')
                            @php  $d117 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '90' && $ans < '92')
                            @php  $d118 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '92' && $ans < '94')
                            @php  $d119 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '94' && $ans < '96')
                            @php  $d120 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '96' && $ans < '98')
                            @php  $d121 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '98' && $ans < '100')
                            @php  $d122 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '100' && $ans < '102')
                            @php  $d123 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '102' && $ans < '104')
                            @php  $d124 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '104' && $ans < '106')
                            @php  $d125 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '106' && $ans < '108')
                            @php  $d126 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '108' && $ans < '110')
                            @php  $d127 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '73' && $detail['humm'] < '78' && $ans >= '110')
                            @php  $d128 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans < '81')
                            @php  $d129 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '81' && $ans < '83')
                            @php  $d130 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '83' && $ans < '85')
                            @php  $d131 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '85' && $ans < '88')
                            @php  $d132 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '88' && $ans < '90')
                            @php  $d133 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '90' && $ans < '92')
                            @php  $d134 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '92' && $ans < '94')
                            @php  $d135 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '94' && $ans < '96')
                            @php  $d136 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '96' && $ans < '98')
                            @php  $d137 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '98' && $ans < '100')
                            @php  $d138 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '100' && $ans < '102')
                            @php  $d139 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '102' && $ans < '104')
                            @php  $d140 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '104' && $ans < '106')
                            @php  $d141 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '106' && $ans < '108')
                            @php  $d142 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '108' && $ans < '110')
                            @php  $d143 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans >= '110')
                            @php  $d144 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '78' && $detail['humm'] < '83' && $ans < '81')
                            @php  $d145 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '81' && $ans < '83')
                            @php  $d146 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '83' && $ans < '85')
                            @php  $d147 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '85' && $ans < '88')
                            @php  $d148 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '88' && $ans < '90')
                            @php  $d149 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '90' && $ans < '92')
                            @php  $d150 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '92' && $ans < '94')
                            @php  $d151 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '94' && $ans < '96')
                            @php  $d152 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '96' && $ans < '98')
                            @php  $d153 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '98' && $ans < '100')
                            @php  $d154 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '100' && $ans < '102')
                            @php  $d155 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '102' && $ans < '104')
                            @php  $d156 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '104' && $ans < '106')
                            @php  $d157 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '106' && $ans < '108')
                            @php  $d158 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '108' && $ans < '110')
                            @php  $d159 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '83' && $detail['humm'] < '88' && $ans >= '110')
                            @php  $d160 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans < '81')
                            @php  $d161 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '81' && $ans < '83')
                            @php  $d162 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '83' && $ans < '85')
                            @php  $d163 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '85' && $ans < '88')
                            @php  $d164 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '88' && $ans < '90')
                            @php  $d165 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '90' && $ans < '92')
                            @php  $d166 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '92' && $ans <= '94')
                            @php  $d167 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '94' && $ans < '96')
                            @php  $d168 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '96' && $ans < '98')
                            @php  $d169 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '98' && $ans < '100')
                            @php  $d170 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '100' && $ans < '102')
                            @php  $d171 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '102' && $ans < '104')
                            @php  $d172 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '104' && $ans < '106')
                            @php  $d173 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '106' && $ans < '108')
                            @php  $d174 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '108' && $ans < '110')
                            @php  $d175 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '88' && $detail['humm'] < '93' && $ans >= '110')
                            @php  $d176 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans <= '81')
                            @php  $d177 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '81' && $ans < '83')
                            @php  $d178 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '83' && $ans < '85')
                            @php  $d179 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '85' && $ans < '88')
                            @php  $d180 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '88' && $ans < '90')
                            @php  $d181 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '90' && $ans < '92')
                            @php  $d182 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '92' && $ans < '94')
                            @php  $d183 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '94' && $ans < '96')
                            @php  $d184 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '96' && $ans < '98')
                            @php  $d185 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '98' && $ans < '100')
                            @php  $d186 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '100' && $ans < '102')
                            @php  $d187 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '102' && $ans < '104')
                            @php  $d188 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '104' && $ans < '106')
                            @php  $d189 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '106' && $ans < '108')
                            @php  $d190 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '108' && $ans < '110')
                            @php  $d191 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '93' && $detail['humm'] < '98' && $ans >= '110')
                            @php  $d192 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans < '81')
                            @php  $d193 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '81' && $ans < '83')
                            @php  $d194 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '83' && $ans < '85')
                            @php  $d195 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '85' && $ans < '88')
                            @php  $d196 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '88' && $ans < '90')
                            @php  $d197 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '90' && $ans < '92')
                            @php  $d198 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '92' && $ans < '94')
                            @php  $d199 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '94' && $ans < '96')
                            @php  $d200 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '96' && $ans < '98')
                            @php  $d201 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '98' && $ans < '100')
                            @php  $d202 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '100' && $ans < '102')
                            @php  $d203 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '102' && $ans < '104')
                            @php  $d204 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '104' && $ans < '106')
                            @php  $d205 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '106' && $ans < '108')
                            @php  $d206 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '108' && $ans < '110')
                            @php  $d207 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          @if ($detail['humm'] >= '98' && $ans >= '110')
                            @php  $d208 = 'border:3px dashed #000;font-weight:600'; @endphp
                          @endif
                          <p class="col mb-2 s12 font_size22 center color_blue margin_top_10">Heat Index Chart (Apparent Temperature)
                          </p>
                           <div class="col s12 dk o">
                              <table class="table tablesx w-full">
                                  <tbody>
                                      <tr>
                                          <td rowspan="2" class="p nela"><strong>{{$lang['8'] }} (°F)</strong></th>
                                          <td colspan="13" class="p nela"><strong>{{$lang['6'] }} (%)</strong></th>
                                      </tr>
                                      <tr>
                                          <td class="nela">40</td>
                                          <td class="nela">45</td>
                                          <td class="nela">50</td>
                                          <td class="nela">55</td>
                                          <td class="nela">60</td>
                                          <td class="nela">65</td>
                                          <td class="nela">70</td>
                                          <td class="nela">75</td>
                                          <td class="nela">80</td>
                                          <td class="nela">85</td>
                                          <td class="nela">90</td>
                                          <td class="nela">95</td>
                                          <td class="nela">100</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">110</td>
                                          <td class="rc white-text" style='{{$d16 }}'>136</span></td>
                                          <td class="rc white-text" style='{{$d32 }}'>143</td>
                                          <td class="rc white-text" style='{{ $d48 }}'>152</td>
                                          <td class="rc white-text" style='{{ $d64 }}'>161</td>
                                          <td class="rc white-text" style='{{ $d80 }}'>171</td>
                                          <td class="rc white-text" style='{{$d96 }}'>182</td>
                                          <td class="rc white-text" style='{{$d112 }}'>194</td>
                                          <td class="rc white-text" style='{{$d128 }}'>206</td>
                                          <td class="rc white-text" style='{{$d144 }}'>219</td>
                                          <td class="rc white-text" style='{{$d160 }}'>233</td>
                                          <td class="rc white-text" style='{{$d176 }}'>247</td>
                                          <td class="rc white-text" style='{{$d192 }}'>262</td>
                                          <td class="rc white-text" style='{{$d208 }}'>278</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">108</td>
                                          <td class="rc white-text" style='{{$d15 }}'>130</td>
                                          <td class="rc white-text" style='{{$d31 }}'>137</td>
                                          <td class="rc white-text" style='{{ $d47 }}'>144</td>
                                          <td class="rc white-text" style='{{ $d63 }}'>153</td>
                                          <td class="rc white-text" style='{{ $d79 }}'>162</td>
                                          <td class="rc white-text" style='{{$d95 }}'>172</td>
                                          <td class="rc white-text" style='{{$d111 }}'>182</td>
                                          <td class="rc white-text" style='{{$d127 }}'>193</td>
                                          <td class="rc white-text" style='{{$d143 }}'>205</td>
                                          <td class="rc white-text" style='{{$d159 }}'>218</td>
                                          <td class="rc white-text" style='{{$d175 }}'>231</td>
                                          <td class="rc white-text" style='{{$d191 }}'>245</td>
                                          <td class="rc white-text" style='{{$d207 }}'>260</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">106</td>
                                          <td class="oc text-white" style='{{$d14 }}'>124</td>
                                          <td class="rc white-text" style='{{$d30 }}'>130</td>
                                          <td class="rc white-text" style='{{ $d46 }}'>137</td>
                                          <td class="rc white-text" style='{{ $d62 }}'>145</td>
                                          <td class="rc white-text" style='{{ $d78 }}'>153</td>
                                          <td class="rc white-text" style='{{$d94 }}'>162</td>
                                          <td class="rc white-text" style='{{$d110 }}'>172</td>
                                          <td class="rc white-text" style='{{$d126 }}'>182</td>
                                          <td class="rc white-text" style='{{$d142 }}'>193</td>
                                          <td class="rc white-text" style='{{$d158 }}'>204</td>
                                          <td class="rc white-text" style='{{$d174 }}'>216</td>
                                          <td class="rc white-text" style='{{$d190 }}'>229</td>
                                          <td class="rc white-text" style='{{$d206 }}'>243</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">104</td>
                                          <td class="oc text-white" style='{{$d13 }}'>119</td>
                                          <td class="oc text-white" style='{{$d29 }}'>124</td>
                                          <td class="rc white-text" style='{{ $d45 }}'>131</td>
                                          <td class="rc white-text" style='{{ $d61 }}'>137</td>
                                          <td class="rc white-text" style='{{ $d77 }}'>145</td>
                                          <td class="rc white-text" style='{{$d93 }}'>153</td>
                                          <td class="rc white-text" style='{{$d109 }}'>161</td>
                                          <td class="rc white-text" style='{{$d125 }}'>171</td>
                                          <td class="rc white-text" style='{{$d141 }}'>181</td>
                                          <td class="rc white-text" style='{{$d157 }}'>191</td>
                                          <td class="rc white-text" style='{{$d173 }}'>202</td>
                                          <td class="rc white-text" style='{{$d189 }}'>214</td>
                                          <td class="rc white-text" style='{{$d205 }}'>226</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">102</td>
                                          <td class="oc text-white" style='{{$d12 }}'>114</td>
                                          <td class="oc text-white" style='{{$d28 }}'>119</td>
                                          <td class="oc text-white" style='{{ $d44 }}'>124</td>
                                          <td class="rc white-text" style='{{ $d60 }}'>130</td>
                                          <td class="rc white-text" style='{{ $d76 }}'>137</td>
                                          <td class="rc white-text" style='{{$d92 }}'>144</td>
                                          <td class="rc white-text" style='{{$d108 }}'>152</td>
                                          <td class="rc white-text" style='{{$d124 }}'>160</td>
                                          <td class="rc white-text" style='{{$d140 }}'>169</td>
                                          <td class="rc white-text" style='{{$d156 }}'>179</td>
                                          <td class="rc white-text" style='{{$d172 }}'>189</td>
                                          <td class="rc white-text" style='{{$d188 }}'>199</td>
                                          <td class="rc white-text" style='{{$d204 }}'>210</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">100</td>
                                          <td class="oc text-white" style='{{$d11 }}'>109</td>
                                          <td class="oc text-white" style='{{$d27 }}'>114</td>
                                          <td class="oc text-white" style='{{ $d43 }}'>118</td>
                                          <td class="oc text-white" style='{{ $d59 }}'>124</td>
                                          <td class="rc white-text" style='{{ $d75 }}'>129</td>
                                          <td class="rc white-text" style='{{$d91 }}'>136</td>
                                          <td class="rc white-text" style='{{$d107 }}'>143</td>
                                          <td class="rc white-text" style='{{$d123 }}'>150</td>
                                          <td class="rc white-text" style='{{$d139 }}'>158</td>
                                          <td class="rc white-text" style='{{$d155 }}'>167</td>
                                          <td class="rc white-text" style='{{$d171 }}'>176</td>
                                          <td class="rc white-text" style='{{$d187 }}'>185</td>
                                          <td class="rc white-text" style='{{$d203 }}'>195</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">98</td>
                                          <td class="oc text-white" style='{{$d10 }}'>105</td>
                                          <td class="oc text-white" style='{{$d26 }}'>109</td>
                                          <td class="oc text-white" style='{{ $d42 }}'>113</td>
                                          <td class="oc text-white" style='{{ $d58 }}'>117</td>
                                          <td class="oc text-white" style='{{ $d74 }}'>123</td>
                                          <td class="rc white-text" style='{{$d90 }}'>128</td>
                                          <td class="rc white-text" style='{{$d106 }}'>134</td>
                                          <td class="rc white-text" style='{{$d122 }}'>141</td>
                                          <td class="rc white-text" style='{{$d138 }}'>148</td>
                                          <td class="rc white-text" style='{{$d154 }}'>156</td>
                                          <td class="rc white-text" style='{{$d170 }}'>164</td>
                                          <td class="rc white-text" style='{{$d186 }}'>172</td>
                                          <td class="rc white-text" style='{{$d202 }}'>181</td>
                                      </tr>
                                      <tr>
      
                                          <td class="p nela">96</td>
                                          <td class="kc" style='{{$d9 }}'>101</td>
                                          <td class="oc text-white" style='{{$d25 }}'>104</td>
                                          <td class="oc text-white" style='{{ $d41 }}'>108</td>
                                          <td class="oc text-white" style='{{ $d57 }}'>112</td>
                                          <td class="oc text-white" style='{{ $d73 }}'>116</td>
                                          <td class="oc text-white" style='{{$d89 }}'>121</td>
                                          <td class="oc text-white" style='{{$d105 }}'>126</td>
                                          <td class="rc white-text" style='{{$d121 }}'>132</td>
                                          <td class="rc white-text" style='{{$d137 }}'>138</td>
                                          <td class="rc white-text" style='{{$d153 }}'>145</td>
                                          <td class="rc white-text" style='{{$d169 }}'>152</td>
                                          <td class="rc white-text" style='{{$d185 }}'>160</td>
                                          <td class="rc white-text" style='{{$d191 }}'>168</td>
                                      </tr>
                                      <tr>
      
                                          <td class="p nela">94</td>
                                          <td class="kc" style='{{$d8 }}'>97</td>
                                          <td class="kc" style='{{$d24 }}'>100</td>
                                          <td class="kc" style='{{ $d40 }}'>102</td>
                                          <td class="oc text-white" style='{{ $d56 }}'>106</td>
                                          <td class="oc text-white" style='{{ $d72 }}'>110</td>
                                          <td class="oc text-white" style='{{$d88 }}'>114</td>
                                          <td class="oc text-white" style='{{$d104 }}'>119</td>
                                          <td class="oc text-white" style='{{$d120 }}'>124</td>
                                          <td class="rc white-text" style='{{$d136 }}'>129</td>
                                          <td class="rc white-text" style='{{$d152 }}'>135</td>
                                          <td class="rc white-text" style='{{$d168 }}'>141</td>
                                          <td class="rc white-text" style='{{$d184 }}'>148</td>
                                          <td class="rc white-text" style='{{$d200 }}'>155</td>
                                      </tr>
                                      <tr>
      
                                          <td class="p nela">92</td>
                                          <td class="kc" style='{{$d7 }}'>94</td>
                                          <td class="kc" style='{{$d23 }}'>96</td>
                                          <td class="kc" style='{{ $d39 }}'>99</td>
                                          <td class="kc" style='{{ $d55 }}'>101</td>
                                          <td class="oc text-white" style='{{ $d71 }}'>105</td>
                                          <td class="oc text-white" style='{{$d87 }}'>108</td>
                                          <td class="oc text-white" style='{{$d103 }}'>112</td>
                                          <td class="oc text-white" style='{{$d119 }}'>116</td>
                                          <td class="oc text-white" style='{{$d135 }}'>121</td>
                                          <td class="oc text-white" style='{{$d151 }}'>126</td>
                                          <td class="rc white-text" style='{{$d167 }}'>131</td>
                                          <td class="rc white-text" style='{{$d183 }}'>137</td>
                                          <td class="rc white-text" style='{{$d199 }}'>143</td>
                                      </tr>
                                      <tr>
      
                                          <td class="p nela">90</td>
                                          <td class="kc" style='{{$d6 }}'>91</td>
                                          <td class="kc" style='{{ $d22 }}'>93</td>
                                          <td class="kc" style='{{ $d38 }}'>95</td>
                                          <td class="kc" style='{{ $d54 }}'>97</td>
                                          <td class="kc" style='{{ $d70 }}'>100</td>
                                          <td class="kc" style='{{$d86 }}'>103</td>
                                          <td class="oc text-white" style='{{$d102 }}'>106</td>
                                          <td class="oc text-white" style='{{$d118 }}'>109</td>
                                          <td class="oc text-white" style='{{$d134 }}'>113</td>
                                          <td class="oc text-white" style='{{$d150 }}'>117</td>
                                          <td class="oc text-white" style='{{$d166 }}'>122</td>
                                          <td class="oc text-white" style='{{$d182 }}'>127</td>
                                          <td class="rc white-text" style='{{$d198 }}'>132</td>
                                      </tr>
                                      <tr>
      
                                          <td class="p nela">88</td>
                                          <td class="kkc" style='{{$d5 }}'>88</td>
                                          <td class="kkc" style='{{ $d21 }}'>89</td>
                                          <td class="kc" style='{{ $d37 }}'>91</td>
                                          <td class="kc" style='{{ $d53 }}'>93</td>
                                          <td class="kc" style='{{ $d69 }}'>95</td>
                                          <td class="kc" style='{{$d85 }}'>98</td>
                                          <td class="kc" style='{{$d101 }}'>100</td>
                                          <td class="kc" style='{{$d117 }}'>103</td>
                                          <td class="oc text-white" style='{{$d133 }}'>106</td>
                                          <td class="oc text-white" style='{{$d149 }}'>110</td>
                                          <td class="oc text-white" style='{{$d165 }}'>113</td>
                                          <td class="oc text-white" style='{{$d181 }}'>117</td>
                                          <td class="oc text-white" style='{{$d197 }}'>121</td>
                                      </tr>
                                      <tr>
      
                                          <td class="p nela">86</td>
                                          <td class="kkc" style='{{$d4 }}'>85</td>
                                          <td class="kkc" style='{{ $d20 }}'>87</td>
                                          <td class="kkc" style='{{ $d36 }}'>88</td>
                                          <td class="kkc" style='{{ $d52 }}'>89</td>
                                          <td class="kc" style='{{ $d68 }}'>91</td>
                                          <td class="kc" style='{{$d84 }}'>93</td>
                                          <td class="kc" style='{{$d100 }}'>95</td>
                                          <td class="kc" style='{{$d116 }}'>97</td>
                                          <td class="kc" style='{{$d132 }}'>100</td>
                                          <td class="kc" style='{{$d148 }}'>102</td>
                                          <td class="oc text-white" style='{{$d164 }}'>105</td>
                                          <td class="oc text-white" style='{{$d180 }}'>108</td>
                                          <td class="oc text-white" style='{{$d196 }}'>112</td>
                                      </tr>
                                      <tr>
                                          <td class="p nela">84</td>
                                          <td class="kkc" style='{{$d3 }}'>83</td>
                                          <td class="kkc" style='{{ $d19 }}'>84</td>
                                          <td class="kkc" style='{{ $d35 }}'>85</td>
                                          <td class="kkc" style='{{ $d51 }}'>86</td>
                                          <td class="kkc" style='{{ $d67 }}'>88</td>

            </div>
                                        <td class="kkc" style='{{$d83 }}'>89</td>
                                        <td class="kkc" style='{{$d99 }}'>90</td>
                                        <td class="kkc" style='{{$d115 }}'>92</td>
                                        <td class="kc" style='{{$d131 }}'>94</td>
                                        <td class="kc" style='{{$d147 }}'>96</td>
                                        <td class="kc" style='{{$d163 }}'>98</td>
                                        <td class="kc" style='{{$d179 }}'>100</td>
                                        <td class="kc" style='{{$d195 }}'>103</td>
                                    </tr>
                                    <tr>
                                        <td class="p nela">82</td>
                                        <td class="kkc" style='{{ $d2;}}'>81</td>
                                        <td class="kkc" style='{{ $d18 }}'>82</td>
                                        <td class="kkc" style='{{ $d34 }}'>83</td>
                                        <td class="kkc" style='{{ $d50 }}'>84</td>
                                        <td class="kkc" style='{{ $d66 }}'>84</td>
                                        <td class="kkc" style='{{ $d82 }}'>85</td>
                                        <td class="kkc" style='{{$d98 }}'>86</td>
                                        <td class="kkc" style='{{$d114 }}'>88</td>
                                        <td class="kkc" style='{{$d130 }}'>89</td>
                                        <td class="kkc" style='{{$d146 }}'>90</td>
                                        <td class="kkc" style='{{$d162 }}'>91</td>
                                        <td class="kkc" style='{{$d178 }}'>93</td>
                                        <td class="kkc" style='{{$d194 }}'>95</td>
                                    </tr>
                                    <tr>
                                        <td class="p nela">80</td>
                                        <td class="kkc" style='{{ $d1;}}'>80</td>
                                        <td class="kkc" style='{{ $d17 }}'>80</td>
                                        <td class="kkc" style='{{ $d33 }}'>81</td>
                                        <td class="kkc" style='{{ $d49 }}'>81</td>
                                        <td class="kkc" style='{{ $d65 }}'>82</td>
                                        <td class="kkc" style='{{$d81 }}'>82</td>
                                        <td class="kkc" style='{{$d97 }}'>83</td>
                                        <td class="kkc" style='{{$d113 }}'>84</td>
                                        <td class="kkc" style='{{$d129 }}'>84</td>
                                        <td class="kkc" style='{{$d145 }}'>85</td>
                                        <td class="kkc" style='{{$d161 }}'>86</td>
                                        <td class="kkc" style='{{$d177 }}'>86</td>
                                        <td class="kkc" style='{{$d193 }}'>87</td>
                                    </tr>
                                    <tr>
                                        <td class="p gr" colspan="2"><strong>{{$lang['9'] }}:</strong></td>
                                        <td class="p kkc font_size16" colspan="3">{{$lang['10'] }}</td>
                                        <td class="p kc  font_size16" colspan="3">{{$lang['11'] }}</td>
                                        <td class="p oc  font_size16" colspan="3">{{$lang['12'] }}</td>
                                        <td class="p rc  font_size16" colspan="3">{{$lang['13'] }}</td>
                                    </tr>
                                </tbody>
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
      document.addEventListener("DOMContentLoaded", function() {
          document.getElementById("find").addEventListener("change", function() {
              var a = this.value;
  
              var dpElements = document.querySelectorAll(".dp");
              var atElements = document.querySelectorAll(".at");
              var rhElements = document.querySelectorAll(".rh");
  
              function showElements(elements) {
                  elements.forEach(function(element) {
                      element.style.display = "block";
                  });
              }
  
              function hideElements(elements) {
                  elements.forEach(function(element) {
                      element.style.display = "none";
                  });
              }
  
              if (a === "1") {
                  hideElements(dpElements);
                  showElements(atElements);
                  showElements(rhElements);
              } else if (a === "2") {
                  showElements(atElements);
                  showElements(dpElements);
                  hideElements(rhElements);
              } else if (a === "3") {
                  showElements(rhElements);
                  showElements(dpElements);
                  hideElements(atElements);
              }
          });
      });
  
      @if(isset($detail))
           var a = "{{$_POST['find']}}";
              var dpElements = document.querySelectorAll(".dp");
              var atElements = document.querySelectorAll(".at");
              var rhElements = document.querySelectorAll(".rh");
  
              function showElements(elements) {
                  elements.forEach(function(element) {
                      element.style.display = "block";
                  });
              }
  
              function hideElements(elements) {
                  elements.forEach(function(element) {
                      element.style.display = "none";
                  });
              }
  
              if (a === "1") {
                  hideElements(dpElements);
                  showElements(atElements);
                  showElements(rhElements);
              } else if (a === "2") {
                  showElements(atElements);
                  showElements(dpElements);
                  hideElements(rhElements);
              } else if (a === "3") {
                  showElements(rhElements);
                  showElements(dpElements);
                  hideElements(atElements);
              }
      @endif
  </script>
  @endpush
  <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>