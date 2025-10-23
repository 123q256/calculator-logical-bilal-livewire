<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <table class="w-full">
                        <tr>
                            <td colspan="3" class="pb-2">
                                <label for="s_f" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="number" name="s_f" id="s_f" class="input" aria-label="input"
                                    placeholder="2" value="{{ isset($_POST['s_f']) ? $_POST['s_f'] : '4' }}" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="pt-2">
                                <label for="str_f" class="font-s-14 text-blue my-2">{{ $lang['2'] }}:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="str_f" id="str_f" class="input my-2" aria-label="input"
                                    placeholder="str" value="{{ isset($_POST['str_f']) ? $_POST['str_f'] : '' }}" />
                            </td>
                            <td>
                                <input type="number" name="dex_f" id="dex_f" class="input my-2" aria-label="input"
                                    placeholder="dex" value="{{ isset($_POST['dex_f']) ? $_POST['dex_f'] : '137' }}" />

                            </td>
                            <td>
                                <input type="number" name="int_f" id="int_f" class="input my-2" aria-label="input"
                                    placeholder="int" value="{{ isset($_POST['int_f']) ? $_POST['int_f'] : '' }}" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="pb-2">
                                <label for="r_f" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="r_f" id="r_f" class="input" aria-label="input"
                                    placeholder="R" value="{{ isset($_POST['r_f']) ? $_POST['r_f'] : '3' }}" />
                            </td>
                            <td>
                                <input type="number" name="g_f" id="g_f" class="input" aria-label="input"
                                    placeholder="G" value="{{ isset($_POST['g_f']) ? $_POST['g_f'] : '' }}" />
                            </td>
                            <td>
                                <input type="number" name="b_f" id="b_f" class="input" aria-label="input"
                                    placeholder="B" value="{{ isset($_POST['b_f']) ? $_POST['b_f'] : '' }}" />
                            </td>
                        </tr>
                    </table>
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
                    <div class="w-full text-center">
                        <div class="w-full">
                            <input type="hidden" id="s_f" value="{{$detail['s_f']}}">
                            <input type="hidden" id="str_f" value="{{$detail['str_f']}}">
                            <input type="hidden" id="dex_f" value="{{$detail['dex_f']}}">
                            <input type="hidden" id="int_f" value="{{$detail['int_f']}}">
                            <input type="hidden" id="r_f" value="{{$detail['r_f']}}">
                            <input type="hidden" id="g_f" value="{{$detail['g_f']}}">
                            <input type="hidden" id="b_f" value="{{$detail['b_f']}}">
                            <div class="overflow-auto">
                                <table class="w-full" id="table">
                                  <thead>
                                    <tr class="head">
                                      <th class="border-b py-2">{{$lang['5']}}</th>
                                      <th class="border-b py-2">{{$lang['6']}}<br><span class="tab_sub">({{$lang['7']}})</span></th>
                                      <th class="border-b py-2">{{$lang['8']}}</th>
                                      <th class="border-b py-2">{{$lang['9']}}<br><span class="tab_sub">({{$lang['10']}})</span></th>
                                      <th class="border-b py-2">{{$lang['11']}}<br><span class="tab_sub">({{$lang['7']}})</span></th>
                                      <th class="border-b py-2">{{$lang['12']}}<br><span class="tab_sub">({{$lang['13']}})</span></th>
                                    </tr>
                                  </thead>
                                  <tbody id="tbody">
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @include('inc.vorici-calculator')
            </div>
        </div>
    </div>

        
    @endisset
</form>