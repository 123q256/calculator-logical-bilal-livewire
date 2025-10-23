<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 ">
                    <label for="rs" class="labele">{{ $lang['company'] }} (,):</label>
                    <div class="w-full py-2">
                        <textarea type="number" step="any" name="rs" id="rs" class="input textareaInput" aria-label="textarea input" placeholder="1, 13, 5, 7, 9"  >{{ isset($_POST['rs'])?$_POST['rs']:'1, 13, 5, 7, 9' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12 ">
                    <label for="rm" class="labele">{{ $lang['market'] }} (,):</label>
                    <div class="w-full py-2">
                        <textarea type="number" step="any" name="rm" id="rm" class="input textareaInput" aria-label="textarea input" placeholder="2, 4, 6, 18, 10" >{{ isset($_POST['rm'])?$_POST['rm']:'2, 4, 6, 18, 10' }}</textarea>
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
                    @php
                        $n =  $detail['n'];
                        $rs =  $detail['rs'];
                        $rm =  $detail['rm'];
                        $rs_sum =  $detail['rs_sum'];
                        $rm_sum =  $detail['rm_sum'];
                        $xi2 =  $detail['xi2'];
                        $yi2 =  $detail['yi2'];
                        $xi2_sum =  $detail['xi2_sum'];
                        $yi2_sum =  $detail['yi2_sum'];
                        $xy_sum =  $detail['xy_sum'];
                        $ss_xx =  $detail['ss_xx'];
                        $ss_yy =  $detail['ss_yy'];
                        $ss_xy =  $detail['ss_xy'];
                        $beta_1 =  $detail['beta_1'];
                    @endphp
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>β</strong></td>
                                <td class="py-2 border-b"> {{$beta_1}} </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-ful text-[16px]">
                        <p class="mt-4"><b>{{$lang['solution']}} :</b></p>
                        <p class="mt-">{{$lang['statement1']}}:</p>
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <td class="py-2 border-b"><b>Obs.</b></td>
                                        <td class="py-2 border-b"><b>rM</b></td>
                                        <td class="py-2 border-b"><b>rS</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rm as $key => $value)
                                    <tr>
                                        <td class="py-2 border-b"><?=$key + 1?></td>
                                        <td class="py-2 border-b"><?=$value?></td>
                                        <td class="py-2 border-b"><?=$rs[$key]?></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <p class="mt-2">{{$lang['statement2']}}:</p>
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <td class="py-2 border-b"><b>Obs.</b></td>
                                        <td class="py-2 border-b"><b>rM </b></td>
                                        <td class="py-2 border-b"><b>rS </b></td>
                                        <td class="py-2 border-b"><b>Xᵢ²</b></td>
                                        <td class="py-2 border-b"><b>Yᵢ²</b></td>
                                        <td class="py-2 border-b"><b>Xᵢ &middot; Yᵢ</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($rm as $key => $xi)
                                @php $yi = $rs[$key]; @endphp
                                    <tr>
                                        <td class="py-2 border-b"><?=$key+1?></td>
                                        <td class="py-2 border-b"><?=$xi?></td>
                                        <td class="py-2 border-b"><?=$yi?></td>
                                        <td class="py-2 border-b"><?=$xi2[$key]?></td>
                                        <td class="py-2 border-b"><?=$yi2[$key]?></td>
                                        <td class="py-2 border-b"><?=$xi * $yi?></td>
                                    </tr>
                                    @endforeach
                                <tr>
                                        <td class="py-2 border-b">Sum</td>
                                        <td class="py-2 border-b"><?=$rm_sum?></td>
                                        <td class="py-2 border-b"><?=$rs_sum?></td>
                                        <td class="py-2 border-b"><?=$xi2_sum?></td>
                                        <td class="py-2 border-b"><?=$yi2_sum?></td>
                                        <td class="py-2 border-b"><?=$xy_sum?></td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>