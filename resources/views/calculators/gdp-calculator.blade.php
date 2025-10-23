<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-6">
                <label for="consumption" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="consumption" id="consumption" class="input"
                        aria-label="input" placeholder="413"
                        value="{{ isset($_POST['consumption']) ? $_POST['consumption'] : '10' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="consumption_unit" class="label">&nbsp;</label>
                <div class="w-100 py-2 ">
                    <select name="consumption_unit" id="consumption_unit" class="input">
                        <option value="{{ $lang[6] }}" {{ isset($_POST['consumption_unit']) && $_POST['consumption_unit'] == $lang[6] ? 'selected' : '' }}>
                            {{ $lang[6] }}
                        </option>
                        <option value="{{ $lang[7] }}" {{ isset($_POST['consumption_unit']) && $_POST['consumption_unit'] == $lang[7] ? 'selected' : '' }}>
                            {{ $lang[7] }}
                        </option>
                        <option value="{{ $lang[8] }}" {{ isset($_POST['consumption_unit']) && $_POST['consumption_unit'] == $lang[8] ? 'selected' : '' }}>
                            {{ $lang[8] }}
                        </option>
                    </select>
                    
                </div>
            </div>
            <div class="col-span-6">
                <label for="investment" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="investment" id="investment" class="input"
                        aria-label="input" placeholder="413"
                        value="{{ isset($_POST['investment']) ? $_POST['investment'] : '8' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="investment_unit" class="label">&nbsp;</label>
                <div class="w-100 py-2 ">
                    <select name="investment_unit" id="investment_unit" class="input">
                        <option value="{{ $lang[6] }}" {{ isset($_POST['investment_unit']) && $_POST['investment_unit'] == $lang[6] ? 'selected' : '' }}>
                            {{ $lang[6] }}
                        </option>
                        <option value="{{ $lang[7] }}" {{ isset($_POST['investment_unit']) && $_POST['investment_unit'] == $lang[7] ? 'selected' : '' }}>
                            {{ $lang[7] }}
                        </option>
                        <option value="{{ $lang[8] }}" {{ isset($_POST['investment_unit']) && $_POST['investment_unit'] == $lang[8] ? 'selected' : '' }}>
                            {{ $lang[8] }}
                        </option>
                    </select>
                    
                </div>
            </div>
            <div class="col-span-6">
                <label for="purchases" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="purchases" id="purchases" class="input"
                        aria-label="input" placeholder="413"
                        value="{{ isset($_POST['purchases']) ? $_POST['purchases'] : '6' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="purchases_unit" class="label">&nbsp;</label>
                <div class="w-100 py-2">
                    <select name="purchases_unit" id="purchases_unit" class="input">
                        <option value="{{ $lang[6] }}" {{ isset($_POST['purchases_unit']) && $_POST['purchases_unit'] == $lang[6] ? 'selected' : '' }}>
                            {{ $lang[6] }}
                        </option>
                        <option value="{{ $lang[7] }}" {{ isset($_POST['purchases_unit']) && $_POST['purchases_unit'] == $lang[7] ? 'selected' : '' }}>
                            {{ $lang[7] }}
                        </option>
                        <option value="{{ $lang[8] }}" {{ isset($_POST['purchases_unit']) && $_POST['purchases_unit'] == $lang[8] ? 'selected' : '' }}>
                            {{ $lang[8] }}
                        </option>
                    </select>
                    
                </div>
            </div>
            <div class="col-span-6">
                <label for="exports" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="exports" id="exports" class="input" aria-label="input"
                        placeholder="4" value="{{ isset($_POST['exports']) ? $_POST['exports'] : '4' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="exports_unit" class="label">&nbsp;</label>
                <div class="w-100 py-2">
                    <select name="exports_unit" id="exports_unit" class="input">
                        <option value="{{ $lang[6] }}" {{ isset($_POST['exports_unit']) && $_POST['exports_unit'] == $lang[6] ? 'selected' : '' }}>
                            {{ $lang[6] }}
                        </option>
                        <option value="{{ $lang[7] }}" {{ isset($_POST['exports_unit']) && $_POST['exports_unit'] == $lang[7] ? 'selected' : '' }}>
                            {{ $lang[7] }}
                        </option>
                        <option value="{{ $lang[8] }}" {{ isset($_POST['exports_unit']) && $_POST['exports_unit'] == $lang[8] ? 'selected' : '' }}>
                            {{ $lang[8] }}
                        </option>
                    </select>
                    
                </div>
            </div>
            <div class="col-span-6">
                <label for="imports" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="imports" id="imports" class="input"
                        aria-label="input" placeholder="4"
                        value="{{ isset($_POST['imports']) ? $_POST['imports'] : '2' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="imports_unit" class="label">&nbsp;</label>
                <div class="w-100 py-2 ">
                    <select name="imports_unit" id="imports_unit" class="input">
                        <option value="{{ $lang[6] }}" {{ isset($_POST['imports_unit']) && $_POST['imports_unit'] == $lang[6] ? 'selected' : '' }}>
                            {{ $lang[6] }}
                        </option>
                        <option value="{{ $lang[7] }}" {{ isset($_POST['imports_unit']) && $_POST['imports_unit'] == $lang[7] ? 'selected' : '' }}>
                            {{ $lang[7] }}
                        </option>
                        <option value="{{ $lang[8] }}" {{ isset($_POST['imports_unit']) && $_POST['imports_unit'] == $lang[8] ? 'selected' : '' }}>
                            {{ $lang[8] }}
                        </option>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>GDP  </strong>
                                </td>
                                <td class="py-2 border-b">{{ round($detail['gdp'], 4) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang['9'] }} </strong></td>
                                <td class="py-2 border-b"> {{ round($detail['net_export'], 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px] mt-2">
                        <p class="mt-2"><strong>{{ $lang['10'] }}</strong></p>
                        <p class="mt-2">{{ $lang['11'] }}.</p>
                        <p class="mt-2">GDP = {{ $lang['1'] }} + {{ $lang['2'] }} + {{ $lang['3'] }} +
                            {{ $lang['9'] }}</p>
                        <p class="mt-2">{{ $lang['12'] }}.</p>
                        <p class="mt-2">{{ $lang['9'] }} = {{ $lang['4'] }}- {{ $lang['5'] }}</p>
                        <p class="mt-2">{{ $lang['9'] }} = {{ isset($_POST['exports']) ? $_POST['exports'] : '' }}-
                            {{ isset($_POST['imports']) ? $_POST['imports'] : '' }}</p>
                        <p class="mt-2">{{ $lang['9'] }} = {{ round($detail['net_export'], 4) }}</p>
                        <p class="mt-2">{{ $lang['13'] }}:</p>
                        <p class="mt-2">GDP = {{ isset($_POST['consumption']) ? $_POST['consumption'] : '' }} +
                            {{ isset($_POST['investment']) ? $_POST['investment'] : '' }} +
                            {{ isset($_POST['purchases']) ? $_POST['purchases'] : '' }} + {{ round($detail['net_export'], 4) }}</p>
                        <p class="mt-2">GDP = {{ round($detail['gdp'], 4) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
