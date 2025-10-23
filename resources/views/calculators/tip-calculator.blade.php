<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-3  gap-4">
                <div class="col-12 px-2">
                    <label for="for" class="font-s-14 text-blue">{{ $lang['for'] }}:</label>
                    <select name="for" id="for" class="input my-2">
                        <option value="share">{{ $lang['share'] }}</option>
                        <option value="single" {{ isset($_POST['for']) && $_POST['for'] === "single" ? 'selected' : '' }}>{{ $lang['single'] }}</option>
                    </select>
                </div>
            </div>
            <div class="share {{ isset($_POST['for']) && $_POST['for'] === "single" ? 'd-none' : 'row' }}">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                    <div class="col-lg-6 col-12 px-2 pe-lg-4">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['x'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="text" name="x" id="x" class="input" aria-label="input"
                                placeholder="{{ $lang['x'] }}" value="{{ isset($_POST['x']) ? $_POST['x'] : '4' }}" />
                                <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 px-2 ps-lg-4 tip ">
                        <label for="y" class="font-s-14 text-blue">{{ $lang['y'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="text" name="y" id="y" class="input" aria-label="input"
                                placeholder="{{ $lang['y'] }}" value="{{ isset($_POST['y']) ? $_POST['y'] : '2' }}" />
                                <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 px-2 pe-lg-4 ppl">
                        <label for="z" class="font-s-14 text-blue">{{ $lang['z'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="text" name="z" id="z" class="input" aria-label="input"
                                placeholder="{{ $lang['z'] }}" value="{{ isset($_POST['z']) ? $_POST['z'] : '1' }}" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 px-2 ps-lg-4">
                        <label for="round" class="font-s-14 text-blue">{{ $lang['round'] }} {{$currancy}}:</label>
                        <select name="round" id="round" class="input my-2">
                            <option value="yes" selected>{{ $lang['yes'] }}</option>
                            <option value="no"{{ isset($_POST['rounds']) && $_POST['rounds'] === "no" ? 'selected' : '' }}>{{ $lang['no'] }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="single {{ isset($_POST['for']) && $_POST['for'] === "single" ? 'row' : 'd-none' }}">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                    <div class="col-lg-6 col-12 px-2 pe-lg-4">
                        <label for="xs" class="font-s-14 text-blue">{{ $lang['x'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="text" name="xs" id="xs" class="input" aria-label="input" value="{{ isset($_POST['xs']) ? $_POST['xs'] : '4' }}" />
                                <span class="text-blue input_unit">{{$currancy}}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 px-2 ps-lg-4">
                        <label for="rounds" class="font-s-14 text-blue">{{ $lang['round'] }} {{$currancy}}:</label>
                        <select name="rounds" id="rounds" class="input my-2">
                            <option value="yes" selected>{{ $lang['yes'] }}</option>
                            <option value="no"  {{ isset($_POST['rounds']) && $_POST['rounds'] === "no" ? 'selected' : '' }}>{{ $lang['no'] }}</option>
                        </select>
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
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%] text-[18px] overflow-auto">
                            @if ($_POST['for'] === 'single')
                                <table class="w-full text-center">
                                    <tbody>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['y'] }}</strong></td>
                                            <td class="border-b py-2"><strong>{{ $lang['a'] }}</strong></td>
                                            <td class="border-b py-2"><strong>{{ $lang['b'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>5%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (5 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (5 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (5 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (5 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>10%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (10 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (10 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (10 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (10 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>12%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (12 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (12 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (12 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (12 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>14%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (14 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (14 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (14 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (14 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>15%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (15 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (15 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (15 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (15 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>18%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (18 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (18 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (18 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (18 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>20%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (20 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (20 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (20 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (20 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>25%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (25 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (25 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (25 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (25 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>30%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (30 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (30 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (30 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (30 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p>50%</p>
                                            </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (50 / 100))}}
                                                        @else
                                                            {{round($_POST['xs'] * (50 / 100), 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                            <td class="border-b py-2">
                                                    @if (isset($detail))
                                                        @if ($_POST['rounds'] == 'yes')
                                                            {{ round($_POST['xs'] * (50 / 100) + $_POST['xs'])}}
                                                        @else
                                                            {{round($_POST['xs'] * (50 / 100) + $_POST['xs'], 2)}}
                                                        @endif
                                                    @else
                                                            '00'
                                                    @endif {{$currancy}}
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="w-full">
                                    <tbody>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p><strong>{{ $lang['a'] }} :<strong></p>
                                            </td>
                                            <td class="border-b py-2">{{$currancy}} {{ isset($detail) ? $detail['a'] : '0.0' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p><strong>{{ $lang['b'] }} :<strong></p>
                                            </td>
                                            <td class="border-b py-2">{{$currancy}} {{ isset($detail) ? $detail['b'] : '0.0' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p><strong>{{ $lang['c'] }} :<strong></p>
                                            </td>
                                            <td class="border-b py-2">{{$currancy}} {{ isset($detail) ? $detail['c'] : '0.0' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">
                                                <p><strong>{{ $lang['d'] }} :<strong></p>
                                            </td>
                                            <td class="border-b py-2">{{$currancy}} {{ isset($detail) ? $detail['d'] : '0.0' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS') 
        <script>
            document.getElementById('for').addEventListener('change', function() {
                var value = this.value;
                var y = document.querySelector('.share');
                var z = document.querySelector('.single')
                if (value == 'share') {
                    y.classList.add('row');
                    y.classList.remove('d-none');
                    z.classList.add('d-none');
                } else {
                    z.classList.remove('d-none');
                    z.classList.add('row');
                    y.classList.add('d-none');
                }
            });
        </script>
    @endpush 
</form>
