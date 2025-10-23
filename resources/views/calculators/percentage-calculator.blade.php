@if(app()->getLocale() == "id")
@php
    $request = request();
    $angka_1= $request->angka_1;
    $angka_2= $request->angka_2;
    $angka_3= $request->angka_3;
    $angka_4= $request->angka_4;
    $pembilang_1= $request->pembilang_1;
    $penyebut_1= $request->penyebut_1;
    $perubahan_1= $request->perubahan_1;
    $perubahan_2= $request->perubahan_2;
@endphp
    <form class="row w-full" id="calcForm" action="{{ url()->current() }}/" method="POST">
        @csrf
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           @php $request = request();@endphp
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
                    {{-- 1 --}}
                <div class="d-flex align-items-center justify-content-center mt-1 mt-lg-4">
                    <p style="white-space: nowrap" id="text1"><?=$lang['what']?> <?=$lang['is']?></p>
                    <div class="px-3">
                        <input type="number" step="any" name="angka_1" id="angka_1" class="input" aria-label="input" value="<?= isset($request->angka_1) ? $request->angka_1 : '' ?>"  />
                    </div>
                    <p style="white-space: nowrap" id="text2">% <?=$lang['of']?></p>
                    <div class="px-3">
                        <input type="number" step="any" name="angka_2" id="angka_2" class="input" aria-label="input" value="<?= isset($request->angka_2) ? $request->angka_2 : '' ?>" />
                    </div>
                    @if($device == 'desktop')
                        <p style="white-space: nowrap" id="text2">=</p>
                        <div class="px-3">
                            <input type="number" readonly step="any" name="hasil_1" id="hasil_1" class="input" aria-label="input" value="{{isset($detail) ? $detail['hasil_1'] : ''}}"/>
                        </div>
                        <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                            <button type="submit" class="calculate" value="1" name="submit">{{ $lang['calculate'] }}</button>
                            @if (isset($detail))
                                <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                    @if ((app()->getLocale() == 'en'))
                                        RESET
                                    @else
                                        @if (isset($lang['reset']))
                                            {{ $lang['reset'] }}
                                        @else
                                            RESET
                                        @endif
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                @if($device =='mobile')
                    <div class="d-flex mt-2 align-items-center mt-3 text-center">
                        <p style="white-space: nowrap" class="col-2 font-s-25" id="text2">=</p>
                        <div class="px-3 d-inline ms-3">
                            <input type="number" readonly step="any" name="hasil_1" id="hasil_1" class="input" aria-label="input" value="{{isset($detail) ? $detail['hasil_1'] : ''}}"/>
                        </div>
                    </div>
                    <div class="text-center mt-1 d-flex justify-content-center flex-wrap mt-3">
                        <button type="submit" class="calculate" value="1" name="submit">{{ $lang['calculate'] }}</button>
                        @if (isset($detail))
                            <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                @if ((app()->getLocale() == 'en'))
                                    RESET
                                @else
                                    @if (isset($lang['reset']))
                                        {{ $lang['reset'] }}
                                    @else
                                        RESET
                                    @endif
                                @endif
                            </a>
                        @endif
                    </div>
                    <hr class="mt-3">
                @endif
                    {{-- 2nd --}}
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <p class="pe-lg-2 col-2" id="text1"><?=$lang['what']?> % <?=$lang['of']?></p>
                    <table class="{{$device == 'mobile' ? 'w-100' : ''}} text-center px-4">
                        <tr class="text-center">
                            <td class="border-b-dark pb-1 text-center">
                                <input type="number" step="any" name="pembilang_1" id="pembilang_1" class="input" aria-label="input" value="<?= isset($request->pembilang_1) ? $request->pembilang_1 : '' ?>"  />
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td class="pt-1 text-center">
                                <input type="number" step="any" name="penyebut_1" id="penyebut_1" class="input" aria-label="input" value="<?= isset($request->penyebut_1) ? $request->penyebut_1 : '' ?>"  />
                            </td>
                        </tr>
                    </table>
                        <p class="ps-2" id="text2">=</p>
                        <div class="px-lg-5 px-2">
                            <input type="number" readonly step="any" name="hasil_2" id="hasil_2" class="input" aria-label="input" value="{{isset($detail) ? round($detail['hasil_2'],2) : ''}}" />
                        </div>
                    @if ($device == 'desktop')
                        <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                            <button type="submit" class="calculate" value="2" name="submit">{{ $lang['calculate'] }}</button>
                            @if (isset($detail))
                                <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                    @if ((app()->getLocale() == 'en'))
                                        RESET
                                    @else
                                        @if (isset($lang['reset']))
                                            {{ $lang['reset'] }}
                                        @else
                                            RESET
                                        @endif
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="mt-3 {{isset($detail) && $detail['hasil_2'] ? 'd-block' : 'd-none'}}" id="step_2_wrapper">
                    <textarea readonly="" class="textareaInput">
                        {{ "( " .$pembilang_1 ." / ". $penyebut_1 ." ) x 100%"}} = {{round($detail['hasil_2'],2)}}%
                    </textarea>
                </div>
                @if ($device == 'mobile')
                    <div class="text-center my-3 d-flex justify-content-center flex-wrap">
                        <button type="submit" class="calculate" value="2" name="submit">{{ $lang['calculate'] }}</button>
                        @if (isset($detail))
                            <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                @if ((app()->getLocale() == 'en'))
                                    RESET
                                @else
                                    @if (isset($lang['reset']))
                                        {{ $lang['reset'] }}
                                    @else
                                        RESET
                                    @endif
                                @endif
                            </a>
                        @endif
                    </div>
                    <hr class="mb-3">
                @endif
                    {{-- 3 --}}
                <div class="d-flex align-items-center justify-content-center mt-2 mt-lg-4">
                    <div class="px-lg-3 px-1">
                        <input type="number" step="any" name="angka_3" id="angka_3" class="input" aria-label="input" value="<?= isset($request->angka_3) ? $request->angka_3 : '' ?>"  />
                    </div>
                    <p style="white-space: nowrap" id="text1"><?=$lang['is']?> </p>
                    <div class="px-lg-3 px-1">
                        <input type="number" step="any" name="angka_4" id="angka_4" class="input" aria-label="input" value="<?= isset($request->angka_4) ? $request->angka_4 : '' ?>" />
                    </div>
                    <p style="white-space: nowrap" id="text2">% <?=$lang['from']?> ?</p>
                    <div class="px-lg-3 px-1">
                        <input type="number" step="any" name="hasil_3" id="hasil_3" class="input" aria-label="input" value="{{isset($detail) ? round($detail['hasil_3'],2) : ''}}" />
                    </div>
                    @if ($device == 'desktop')
                        <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                            <button type="submit" class="calculate" value="3" name="submit">{{ $lang['calculate'] }}</button>
                            @if (isset($detail))
                                <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                    @if ((app()->getLocale() == 'en'))
                                        RESET
                                    @else
                                        @if (isset($lang['reset']))
                                            {{ $lang['reset'] }}
                                        @else
                                            RESET
                                        @endif
                                    @endif
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="mt-3 {{isset($detail) && $detail['hasil_3'] ? 'd-block' : 'd-none'}}" id="step_3_wrapper">
                    <textarea readonly="" class="textareaInput">
                        {{ "( " .$angka_3 ." / ". $angka_4 ." ) x 100%"}} = {{round($detail['hasil_3'],2)}}%
                    </textarea>
                </div>
                @if ($device == 'mobile')
                    <div class="text-center my-3 d-flex justify-content-center flex-wrap">
                        <button type="submit" class="calculate" value="3" name="submit">{{ $lang['calculate'] }}</button>
                        @if (isset($detail))
                            <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                @if ((app()->getLocale() == 'en'))
                                    RESET
                                @else
                                    @if (isset($lang['reset']))
                                        {{ $lang['reset'] }}
                                    @else
                                        RESET
                                    @endif
                                @endif
                            </a>
                        @endif
                    </div>
                    <hr class="mb-2">
                @endif
                
                <p class=" mt-lg-4 mb-3">{{$lang['6']}}</p>
                <div class="d-flex align-items-center justify-content-center mt-0">
                    <p style="white-space: nowrap" id="text1"><?=$lang['from']?></p>
                    <div class="px-lg-3 px-2">
                        <input type="number" step="any" name="perubahan_1" id="perubahan_1" class="input" aria-label="input" value="<?= isset($request->perubahan_1) ? $request->perubahan_1 : '' ?>"  />
                    </div>
                    <p style="white-space: nowrap" id="text2"><?=$lang['to']?></p>
                    <div class="px-lg-3 px-2">
                        <input type="number" step="any" name="perubahan_2" id="perubahan_2" class="input" aria-label="input" value="<?= isset($request->perubahan_2) ? $request->perubahan_2 : '' ?>" />
                    </div>
                    <p style="white-space: nowrap" id="text2">?</p>
                    <div class="ps-lg-3 pe-lg-1 px-2">
                        <input type="number" step="any" name="hasil_4" id="hasil_4" class="input" aria-label="input" value="{{isset($detail) ? $detail['hasil_4'] : ''}}" />
                    </div>
                    <p class="px-lg-2" id="text2">%</p>
                    @if ($device == 'desktop')
                    <div class="text-center mt-1 d-flex justify-content-center flex-wrap">
                        <button type="submit" class="calculate" value="4" name="submit">{{ $lang['calculate'] }}</button>
                        @if (isset($detail))
                            <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                @if ((app()->getLocale() == 'en'))
                                    RESET
                                @else
                                    @if (isset($lang['reset']))
                                        {{ $lang['reset'] }}
                                    @else
                                        RESET
                                    @endif
                                @endif
                            </a>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="mt-3 {{isset($detail) && $detail['hasil_4'] ? 'd-block' : 'd-none'}}" id="step_4_wrapper">
                    <textarea readonly="" class="textareaInput">
                        {{ "( " .$perubahan_2 ." - ". $perubahan_1 ." ) / " .$perubahan_1. " x 100%"}} = {{round($detail['hasil_4'],2)}}%
                    </textarea>
                </div>
                @if ($device == 'mobile')
                    <div class="text-center my-3 d-flex justify-content-center flex-wrap">
                        <button type="submit" class="calculate" value="4" name="submit">{{ $lang['calculate'] }}</button>
                        @if (isset($detail))
                            <a href="{{ url()->current() }}/" class="reset ms-2 text-decoration-none mt-2">
                                @if ((app()->getLocale() == 'en'))
                                    RESET
                                @else
                                    @if (isset($lang['reset']))
                                        {{ $lang['reset'] }}
                                    @else
                                        RESET
                                    @endif
                                @endif
                            </a>
                        @endif
                    </div>
                @endif
                
            </div>
        </div>
         @if ($type == 'calculator')
         @include('inc.button')
        @endif
        @if ($type=='widget')
        @include('inc.widget-button')
         @endif
     </div>
    </form>
    @push('calculatorJS')
        <script>
            @isset($detail)
                function hunting_1(){
                    document.getElementById('step_2_wrapper').classList.add('d-block');
                    document.getElementById('step_2_wrapper').classList.remove('d-block');
                }
            @endisset
        </script>
    @endpush
@else
    <form class="row w-full" action="{{ url()->current() }}/" method="POST">
        @csrf

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           @php $request = request();@endphp
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  gap-2 md:gap-4 lg:gap-4">
                    
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="method" class="font-s-14 text-blue"><?= $lang['choose'] ?>:</label>
                    <div class="w-100 py-2">
                        <select name="method" class="input" id="method" aria-label="select">
                            <optgroup label="Y = P% × X">
                                <option value="1"><?=$lang['what'].' '.$lang['is']?> P% <?=$lang['of']?> X?</option>
                                <option value="2" {{ isset($request->method) && $request->method == '2' ? 'selected' : '' }}>Y <?=$lang['what'].' '.$lang['percent'].' '.$lang['of']?> X?</option>
                                <option value="3" {{ isset($request->method) && $request->method == '3' ? 'selected' : '' }}>Y <?=$lang['is']?> P% <?=$lang['of'].' '.$lang['what']?>?</option>
                            </optgroup>
                            <optgroup label="P% × X = Y">
                                <option value="4" {{ isset($request->method) && $request->method == '4' ? 'selected' : '' }}><?=$lang['what']?> % <?=$lang['of']?> X <?=$lang['is']?> Y?</option>
                                <option value="5" {{ isset($request->method) && $request->method == '5' ? 'selected' : '' }}>P% <?=$lang['of']?> <?=$lang['what']?> <?=$lang['is']?> Y?</option>
                                <option value="6" {{ isset($request->method) && $request->method == '6' ? 'selected' : '' }}>P% <?=$lang['of']?> X <?=$lang['is']?> <?=$lang['what']?>?</option>
                            </optgroup>
                            <optgroup label="Y ÷ X = P%">
                                <option value="7" {{ isset($request->method) && $request->method == '7' ? 'selected' : '' }}>Y <?=$lang['out']?> <?=$lang['of']?> <?=$lang['what']?> <?=$lang['is']?> P%?</option>
                                <option value="8" {{ isset($request->method) && $request->method == '8' ? 'selected' : '' }}><?=$lang['what']?> <?=$lang['out']?> <?=$lang['of']?> X <?=$lang['is']?> P%?</option>
                                <option value="9" {{ isset($request->method) && $request->method == '9' ? 'selected' : '' }}>Y <?=$lang['out']?> <?=$lang['of']?> X <?=$lang['is']?> <?=$lang['what']?> %?</option>
                            </optgroup>
                            <optgroup label="X + (X × P%) = Y">
                                <option value="10" {{ isset($request->method) && $request->method == '10' ? 'selected' : '' }}>X <?=$lang['plus']?> P% <?=$lang['is']?> <?=$lang['what']?>?</option>
                                <option value="11" {{ isset($request->method) && $request->method == '11' ? 'selected' : '' }}>X <?=$lang['plus']?> <?=$lang['what']?> % <?=$lang['is']?> Y?</option>
                                <option value="12" {{ isset($request->method) && $request->method == '12' ? 'selected' : '' }}><?=$lang['what']?> <?=$lang['plus']?> P% <?=$lang['is']?> Y?</option>
                            </optgroup>
                            <optgroup label="X − (X × P%) = Y">
                                <option value="13" {{ isset($request->method) && $request->method == '13' ? 'selected' : '' }}>X <?=$lang['minus']?> P% <?=$lang['is']?> <?=$lang['what']?>?</option>
                                <option value="14" {{ isset($request->method) && $request->method == '14' ? 'selected' : '' }}>X <?=$lang['minus']?> <?=$lang['what']?> % <?=$lang['is']?> Y?</option>
                                <option value="15" {{ isset($request->method) && $request->method == '15' ? 'selected' : '' }}><?=$lang['what']?> <?=$lang['minus']?> P% <?=$lang['is']?> Y?</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-center mt-0 mt-lg-2">
                    <p style="white-space: nowrap" id="text1"><?=$lang['what']?> <?=$lang['is']?></p>
                    <div class="px-3">
                        <input type="number" step="any" name="p" id="p" class="input" aria-label="input" value="<?= isset($request->p) ? $request->p : '' ?>"  />
                    </div>
                    <p style="white-space: nowrap" id="text2">% <?=$lang['of']?></p>
                    <div class="px-3">
                        <input type="number" step="any" name="x" id="x" class="input" aria-label="input" value="<?= isset($request->x) ? $request->x : '' ?>" />
                    </div>
                    <p style="white-space: nowrap" id="text3">?</p>
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
                                <div class="w-full">
                                    @php
                                        $p = $request->p;
                                        $x = $request->x;
                                    @endphp     
                                    <div class="w-full text-[16px]">
                                        <p class="mt-2 text-[18px]"><strong><?=$detail['ans']?></strong></p>
                                        @if($request->method === "1")
                                            <p class="mt-2"><?=$detail['ans']?> <?=$lang['is']?> <?=$p?> % <?=$lang['of']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$lang['what'].' '.$lang['is']?> <?=$p.'% '.$lang['of'].' '.$x.' ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = P% * X</p>
                                            <p class="mt-2">Y = <?=$p.'% * '.$x?></p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">Y = (<?=$p.'/100) * '.$x?></p>
                                            <p class="mt-2">Y = <?=($p/100).' * '.$x?></p>
                                            <p class="mt-2">Y = <?=$detail['ans']?></p>
                                        @elseif($request->method === "2")
                                            <p class="mt-2"><?=$p?> <?=$lang['is']?> <?=$detail['ans']?> of <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['is'].' '.$lang['what'].' % '.$lang['of'].' '.$x.' ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: P% = Y / X</p>
                                            <p class="mt-2">P% = <?=$p.' / '.$x?></p>
                                            <p class="mt-2">P% = <?=$p/$x?></p>
                                            <p class="mt-2"><?=$lang['dec']?>:</p>
                                            <p class="mt-2">P% = <?=$p/$x." * 100"?></p>
                                            <p class="mt-2">P% = <?=$detail['ans']?>%</p>
                                        @elseif($request->method === "3")
                                            <p class="mt-2"><?=$p?> is <?=$x?> % of <?=$detail['ans']?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['is'].' '.$x.' '.$lang['of'].' '.$lang['what'].' ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: X = Y / P%</p>
                                            <p class="mt-2">X = <?=$p.' / '.$x?>%</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">X = <?=$p.' / ('.$x?> / 100)</p>
                                            <p class="mt-2">X = <?=$p.' / '.($x/100)?></p>
                                            <p class="mt-2">= <?=$detail['ans']?></p>
                                        @elseif($request->method === "4")
                                            <p class="mt-2"><?=$detail['ans']?> <?=$lang['of']?> <?=$p?> <?=$lang['is']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$_POST['p'].' '.$lang['is'].' '.$lang['what'].' % '.$lang['of'].' '.$_POST['x'].' ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: P% = Y / X</p>
                                            <p class="mt-2">P% = <?=$x.' / '.$p?></p>
                                            <p class="mt-2">P% = <?=$x/$p?></p>
                                            <p class="mt-2"><?=$lang['dec']?>:</p>
                                            <p class="mt-2">P% = <?=$x/$p." * 100"?></p>
                                            <p class="mt-2">P% = <?=$detail['ans']?></p>
                                        @elseif($request->method === "5")
                                            <p class="mt-2"><?=$p?>% <?=$lang['of']?> <?=$detail['ans']?> <?=$lang['is']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.'% '.$lang['of'].' '.$lang['what'].' '.$lang['is'].' '.$x.' ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: X = Y / P%</p>
                                            <p class="mt-2">X = <?=$x.' / '.$p?>%</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">X = <?=$x.' / ('.$p?> / 100)</p>
                                            <p class="mt-2">X = <?=$x.' / '.$p/100?></p>
                                            <p class="mt-2">X = <?=$detail['ans']?></p>
                                        @elseif($request->method === "6")
                                            <p class="mt-2"><?=$p?>% <?=$lang['of']?> <?=$x?> <?=$lang['is']?> <?=$detail['ans']?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.'% '.$lang['of'].' '.$x.' '.$lang['is'].' '.$lang['what'].' ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = P% * X</p>
                                            <p class="mt-2">Y = <?=$p.'% * '.$x?></p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">Y = (<?=$p.' / 100) * '.$x?></p>
                                            <p class="mt-2">Y = <?=($p/ 100).' * '.$x?></p>
                                            <p class="mt-2">Y = <?=$detail['ans']?></p>
                                        @elseif($request->method === "7")
                                            <p class="mt-2"><?=$p?> <?=$lang['out'].' '.$lang['of']?> <?=$detail['ans']?> <?=$lang['is']?> <?=$x?>%</p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['out'].' '.$lang['of'].' '.$lang['what'].' '.$lang['is'].' '.$x.'% ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: X = Y / P%</p>
                                            <p class="mt-2">X = <?=$p.' / '.$x?>%</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">X = <?=$p.' / ('.$x.' / 100)'?></p>
                                            <p class="mt-2">X = <?=$p.' / '.($x / 100)?></p>
                                            <p class="mt-2">X = <?=$detail['ans']?></p>
                                        @elseif($request->method === "8")
                                            <p class="mt-2"><?=$detail['ans']?> <?=$lang['out'].' '.$lang['of']?> <?=$p.' '.$lang['is']?> <?=$x?>%</p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$lang['what'].' '.$lang['out'].' '.$lang['of']?> <?=$p.' '.$lang['is'].' '.$x.'% ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = P% * X</p>
                                            <p class="mt-2">Y = <?=$x.'% * '.$p?></p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">Y = (<?=$x.' / 100) * '.$p?></p>
                                            <p class="mt-2">Y = <?=($x/100).' * '.$p?></p>
                                            <p class="mt-2">Y = <?=$detail['ans']?></p>
                                        @elseif($request->method === "9")
                                            <p class="mt-2"><?=$p?> <?=$lang['out'].' '.$lang['of']?> <?=$x.' '.$lang['is']?> <?=$detail['ans']?>%</p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['out'].' '.$lang['of'].' '.$x.'% ?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: P% = Y / X</p>
                                            <p class="mt-2">P% = <?=$p.' / '.$x?></p>
                                            <p class="mt-2">P% = <?=$p/$x?></p>
                                            <p class="mt-2"><?=$lang['dec']?>:</p>
                                            <p class="mt-2">P% = (<?=($p/$x)?>) * 100</p>
                                            <p class="mt-2">P% = <?=$detail['ans']?></p>
                                        @elseif($request->method === "10")
                                            <p class="mt-2"><?=$p?> <?=$lang['plus']?> <?=$x?>% <?=$lang['is']?> <?=$detail['ans']?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' plus '.$x.'% is what?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = X + (X × P%)</p>
                                            <p class="mt-2">Y = X(1 + P%)</p>
                                            <p class="mt-2">Y = <?=$p?> * (1 + <?=$x?>%)</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">Y = <?=$p?> * (1 + (<?=$x?> / 100))</p>
                                            <p class="mt-2">Y = <?=$p?> * (1 + <?=$x/100?>)</p>
                                            <p class="mt-2">Y = <?=$p?> * (<?=1+($x/100)?>)</p>
                                            <p class="mt-2">Y = <?=$detail['ans']?></p>
                                        @elseif($request->method === "11")
                                            <p class="mt-2"><?=$p?> <?=$lang['plus']?> <?=$detail['ans']?> <?=$lang['is']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['plus'].' '.$lang['what'].' % '.$lang['is'].' '.$x.'?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = X + (X × P%)</p>
                                            <p class="mt-2">Y = X(1 + P%)</p>
                                            <p class="mt-2"><?=$lang['sol_f']?> P</p>
                                            <p class="mt-2">P% = Y/X - 1</p>
                                            <p class="mt-2">P% = <?=$x?>/<?=$p?> - 1</p>
                                            <p class="mt-2">P% = <?=$x/$p?> - 1</p>
                                            <p class="mt-2">P% = <?=($x/$p)-1?></p>
                                            <p class="mt-2"><?=$lang['dec']?>:</p>
                                            <p class="mt-2">P% = <?=($x/$p)-1?> * 100</p>
                                            <p class="mt-2">P% = <?=$detail['ans']?></p>
                                        @elseif($request->method === "12")
                                            <p class="mt-2"><?=$detail['ans']?> <?=$lang['plus']?> <?=$p?>% <?=$lang['is']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$lang['what'].' '.$lang['plus'].' '.$p.'% '.$lang['is'].' '.$x.'?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = X + (X × P%)</p>
                                            <p class="mt-2">Y = X(1 + P%)</p>
                                            <p class="mt-2"><?=$lang['sol_f']?> X</p>
                                            <p class="mt-2">X = Y/(1 + P%)</p>
                                            <p class="mt-2">X = <?=$x?>/(1 + <?=$p?>%)</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">X = <?=$x?>/(1 + <?=$p/100?>)</p>
                                            <p class="mt-2">X = <?=$x?>/(<?=1+($p/100)?>)</p>
                                            <p class="mt-2">X = <?=$detail['ans']?></p>
                                        @elseif($request->method === "13")
                                            <p class="mt-2"><?=$p?> <?=$lang['minus']?> <?=$x?>% <?=$lang['is']?> <?=$detail['ans']?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['minus'].' '.$x.'% '.$lang['is'].' '.$lang['what'].'?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = X - (X × P%)</p>
                                            <p class="mt-2">Y = X(1 - P%)</p>
                                            <p class="mt-2">Y = <?=$p?> * (1 - <?=$x?>%)</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">Y = <?=$p?> * (1 - (<?=$x?> / 100))</p>
                                            <p class="mt-2">Y = <?=$p?> * (1 - <?=$x/100?>)</p>
                                            <p class="mt-2">Y = <?=$p?> * (<?=1-($x/100)?>)</p>
                                            <p class="mt-2">Y = <?=$detail['ans']?></p>
                                        @elseif($request->method === "14")
                                            <p class="mt-2"><?=$p?> <?=$lang['minus']?> <?=$detail['ans']?> <?=$lang['is']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$p.' '.$lang['minus'].' '.$lang['is'].' % '.$x.'?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = X - (X × P%)</p>
                                            <p class="mt-2">Y = X(1 - P%)</p>
                                            <p class="mt-2"><?=$lang['sol_f']?> P</p>
                                            <p class="mt-2">P% = 1 - Y/X</p>
                                            <p class="mt-2">P% = 1 - <?=$x?>/<?=$p?></p>
                                            <p class="mt-2">P% = 1 - <?=$x/$p?></p>
                                            <p class="mt-2">P% = <?=1-($x/$p)?></p>
                                            <p class="mt-2"><?=$lang['dec']?>:</p>
                                            <p class="mt-2">P% = <?=1-($x/$p)?> * 100</p>
                                            <p class="mt-2">P% = <?=$detail['ans']?></p>
                                        @else
                                            <p class="mt-2"><?=$detail['ans']?> <?=$lang['minus']?> <?=$p?>% <?=$lang['is']?> <?=$x?></p>
                                            <p class="mt-2"><strong><?=$lang['sol']?>:</strong></p>
                                            <p class="mt-2"><?=$lang['what'].' '.$lang['minus'].' '.$p.'% '.$lang['is'].' '.$x.'?'?></p>
                                            <p class="mt-2"><?=$lang['eq']?>: Y = X - (X × P%)</p>
                                            <p class="mt-2">Y = X(1 - P%)</p>
                                            <p class="mt-2"><?=$lang['sol_f']?> X</p>
                                            <p class="mt-2">X = Y/(1 - P%)</p>
                                            <p class="mt-2">X = <?=$x?>/(1 - <?=$p?>%)</p>
                                            <p class="mt-2"><?=$lang['conv']?>:</p>
                                            <p class="mt-2">X = <?=$x?>/(1 - <?=$p/100?>)</p>
                                            <p class="mt-2">X = <?=$x?>/(<?=1-($p/100)?>)</p>
                                            <p class="mt-2">X = <?=$detail['ans']?></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
    @push('calculatorJS')
        <script>
            document.getElementById('method').addEventListener('change', function() {
                var r = this.value;
                if (r === "1"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['is']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "2"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['is']?> <?=$lang['what']?> % <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "3"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['is']?>";
                    document.getElementById('text3').textContent = "% <?=$lang['of']?> <?=$lang['what']?> ?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "4"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> % <?=$lang['of']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "5"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "% <?=$lang['of']?> <?=$lang['what']?> <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "6"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "% <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "<?=$lang['is']?> <?=$lang['what']?> ?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "7"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['out']?> <?=$lang['of']?> <?=$lang['what']?> <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "% ?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "8"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['out']?> <?=$lang['of']?>";
                    document.getElementById('text2').textContent = "<?=$lang['is']?>";
                    document.getElementById('text3').textContent = "% ?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "9"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['out']?> <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "<?=$lang['is']?> <?=$lang['what']?> % ?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "10"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['plus']?>";
                    document.getElementById('text3').textContent = "% <?=$lang['is']?> <?=$lang['what']?> ?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "11"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['plus']?> <?=$lang['what']?> % <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "12"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['plus']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "13"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['minus']?>";
                    document.getElementById('text3').textContent = "% <?=$lang['is']?> <?=$lang['what']?>?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "14"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['minus']?> <?=$lang['what']?> % <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'Y';
                }else{
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['minus']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'Y';
                }
            });
        </script>
        @isset($request->method)
            <script>
                var r = "{{$request->method}}";
                if (r === "1"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['is']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "2"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['is']?> <?=$lang['what']?> % <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "3"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['is']?>";
                    document.getElementById('text3').textContent = "% <?=$lang['of']?> <?=$lang['what']?> ?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "4"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> % <?=$lang['of']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "5"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "% <?=$lang['of']?> <?=$lang['what']?> <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "6"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "% <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "<?=$lang['is']?> <?=$lang['what']?> ?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "7"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['out']?> <?=$lang['of']?> <?=$lang['what']?> <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "% ?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "8"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['out']?> <?=$lang['of']?>";
                    document.getElementById('text2').textContent = "<?=$lang['is']?>";
                    document.getElementById('text3').textContent = "% ?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "9"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['out']?> <?=$lang['of']?>";
                    document.getElementById('text3').textContent = "<?=$lang['is']?> <?=$lang['what']?> % ?";
                    document.getElementById('p').placeholder = 'Y';
                    document.getElementById('x').placeholder = 'X';
                }else if(r === "10"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['plus']?>";
                    document.getElementById('text3').textContent = "% <?=$lang['is']?> <?=$lang['what']?> ?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "11"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['plus']?> <?=$lang['what']?> % <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "12"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['plus']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'Y';
                }else if(r === "13"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['minus']?>";
                    document.getElementById('text3').textContent = "% <?=$lang['is']?> <?=$lang['what']?>?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'P';
                }else if(r === "14"){
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    document.getElementById('text2').textContent = "<?=$lang['minus']?> <?=$lang['what']?> % <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'X';
                    document.getElementById('x').placeholder = 'Y';
                }else{
                    ['#text1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                    document.getElementById('text1').textContent = "<?=$lang['what']?> <?=$lang['minus']?>";
                    document.getElementById('text2').textContent = "% <?=$lang['is']?>";
                    document.getElementById('text3').textContent = "?";
                    document.getElementById('p').placeholder = 'P';
                    document.getElementById('x').placeholder = 'Y';
                }
            </script>
        @endisset
    @endpush
@endif
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>