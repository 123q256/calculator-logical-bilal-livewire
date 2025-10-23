<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-6">
                <label for="i_p" class="font-s-14 text-blue">{{ $lang['ip'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="i_p" id="i_p" class="input" aria-label="input" placeholder="40000" value="{{ isset($_POST['i_p'])?$_POST['i_p']:'40000' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="n_p" class="font-s-14 text-blue">{{ $lang['np'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="n_p" id="n_p" class="input" aria-label="input" placeholder="60000" value="{{ isset($_POST['n_p'])?$_POST['n_p']:'60000' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="i_q" class="font-s-14 text-blue">{{ $lang['iq'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="i_q" id="i_q" class="input" aria-label="input" placeholder="4000" value="{{ isset($_POST['i_q'])?$_POST['i_q']:'4000' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="n_q" class="font-s-14 text-blue">{{ $lang['nq'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="n_q" id="n_q" class="input" aria-label="input" placeholder="5000" value="{{ isset($_POST['n_q'])?$_POST['n_q']:'5000' }}" />
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
                    <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['ans'] }}</strong></td>
                                <td class="py-2 border-b"> {{round($detail['ie'],4)}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['type'] }}</strong></td>
                                <td class="py-2 border-b">{{$detail['sr']}}</td>
                            </tr>
                        </table>
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['qc'] }}</td>
                                <td class="py-2 border-b"> <strong> {{$detail['cq']}} %</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['ic'] }}</td>
                                <td class="py-2 border-b"> <strong> {{$detail['cp']}} %</strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['ir'] }}</td>
                                <td class="py-2 border-b"> <strong> {{ $currancy}} {{number_format($detail['ir'],2)}} </strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['fr'] }}</td>
                                <td class="py-2 border-b"> <strong>{{ $currancy}} {{number_format($detail['fr'],2)}} </strong></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['ri'] }}</td>
                                <td class="py-2 border-b"> <strong>{{$detail['rin']}} %</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>