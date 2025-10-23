<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 ">
                    <label for="for" class="font-s-14 text-blue">Calculating For:</label>
                    <select name="for" id="for" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['single_pro'],$lang['multiple_events'],$lang['two'],$lang['events'],$lang['con_pro']];
                            $val = [1,2,3,4,5];
                            optionsList($val,$name,isset($_POST['for'])?$_POST['for']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-3  gap-4 single">
                <div class="space-y-2">
                    <label for="nbr1" class="font-s-14 text-blue">{{ $lang['no_out'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="nbr1" id="nbr1" value="{{ isset($_POST['nbr1'])?$_POST['nbr1']:'6' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="event" class="font-s-14 text-blue">{{ $lang['no_events'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" name="event" id="event" value="{{ isset($_POST['event'])?$_POST['event']:10 }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-3   gap-4 multi hidden">
                <div class="space-y-2">
                    <label for="nbr2" class="font-s-14 text-blue">{{ $lang['no_out_n'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="nbr2" id="nbr2" value="{{ isset($_POST['nbr2'])?$_POST['nbr2']:'' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="event_a" class="font-s-14 text-blue">{{ $lang['no_out_a'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="event_a" id="event_a" value="{{ isset($_POST['event_a'])?$_POST['event_a']:'' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="event_b" class="font-s-14 text-blue">{{ $lang['no_out_b'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="event_b" id="event_b" value="{{ isset($_POST['event_b'])?$_POST['event_b']:'' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  mt-3   gap-4 solver hidden">
              
                <div class="space-y-2">
                    <label for="format" class="font-s-14 text-blue">{{ $lang['format'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="format" id="format" class="input">
                            @php
                                $name = [$lang['dec'],'Percent'];
                                $val = [1,2];
                                optionsList($val,$name,isset($_POST['format'])?$_POST['format']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="pro_a" class="font-s-14 text-blue">{{ $lang['pro_of'] }} P(A)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" max="1" name="pro_a" id="pro_a" value="{{ isset($_POST['pro_a'])?$_POST['pro_a']:'' }}" class="input" aria-label="input" placeholder="values between 0 and 1" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="pro_b" class="font-s-14 text-blue">{{ $lang['pro_of'] }} P(B)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" max="1" name="pro_b" id="pro_b" value="{{ isset($_POST['pro_b'])?$_POST['pro_b']:'' }}" class="input" aria-label="input" placeholder="values between 0 and 1" />
                    </div>
                </div>

            </div>
            <div class="grid grid-cols-1 gap-4 mt-3 events hidden">
                <table class="input_table">
                    <tr>
                        <td class="py-2 border-b">&nbsp;</td>
                        <td class="text-center"><label for="eve_a" class="font-s-14 text-blue"><?=$lang['prob']?></label></td>
                        <td class="text-center"><label for="eve_b" class="font-s-14 text-blue"><?=$lang['rep']?></label></td>
                    </tr>
                    <tr>
                        <td class="pe-1"><label for="rep_a" class="font-s-14 text-blue"><?=$lang['event']?>&nbsp;A</label></td>
                        <td class="pe-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="0" max="1" name="eve_a" id="eve_a" value="{{ isset($_POST['eve_a'])?$_POST['eve_a']:'0.0632' }}" class="input" aria-label="input" placeholder="e.g. 0.0632" />
                            </div>
                        </td>
                        <td class="ps-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="1" name="rep_a" id="rep_a" value="{{ isset($_POST['rep_a'])?$_POST['rep_a']:'6' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pe-1"><label for="rep_b" class="font-s-14 text-blue"><?=$lang['event']?>&nbsp;B</label></td>
                        <td class="pe-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="0" max="1" name="eve_b" id="eve_b" value="{{ isset($_POST['eve_b'])?$_POST['eve_b']:'0.0341' }}" class="input" aria-label="input" placeholder="e.g. 0.0341" />
                            </div>
                        </td>
                        <td class="ps-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="1" name="rep_b" id="rep_b" value="{{ isset($_POST['rep_b'])?$_POST['rep_b']:'4' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="grid grid-cols-1 mt-3    gap-4 condi hidden">
                <div class="space-y-2">
                    <label for="andb" class="font-s-14 text-blue">P(A and B)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="andb" id="andb" value="{{ isset($_POST['andb'])?$_POST['andb']:'' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="prob_b" class="font-s-14 text-blue">P(B)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="prob_b" id="prob_b" value="{{ isset($_POST['prob_b'])?$_POST['prob_b']:'' }}" class="input" aria-label="input" placeholder="00" />
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
                <div class="w-full p-3 radius-10 mt-3">
                    <div class="w-full">
                        @if (isset($detail['Single']))
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full ">
                                    <tr>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="text-blue"><strong><?=$lang['dec']?></strong></td>
                                        <td class="text-blue"><strong><?=$lang['per']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single1.png')?>" alt="Probability" loading="lazy" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_a']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['event_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['event_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single2.png')?>" alt="Probability" loading="lazy" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_a_not']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_occur']*100?> %</b></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
            
                        @if (isset($detail['Solver']))
                            <div class=" mt-2 overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="text-blue"><strong><?=$lang['dec']?></strong></td>
                                        <td class="text-blue"><strong><?=$lang['per']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single4.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_a_not']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_a_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_a_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single6.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_b_not']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_b_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_b_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single7.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_both']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['both_events']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['both_events']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single8.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_either']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['either_events']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['either_events']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single7.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['aorb']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_both']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_both']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single9.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['anorb']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['nor_both']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['nor_both']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single6.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$lang['nb']?> B</td>
                                        <td class="py-2 border-b"><b><?=$detail['anotb']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['anotb']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single4.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?> <?=$lang['nb']?> A:</td>
                                        <td class="py-2 border-b"><b><?=$detail['bnota']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['bnota']*100?> %</b></td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <p class="text-blue font-s-20"><strong>Steps</strong></p>
                                    <div class="col-lg-6">
                                        <p>P(A') = 1 - P(A)</p>
                                        <p>P(A') = 1 - <?=$detail['pro_a']?></p>
                                        <p>P(A') = <?=$detail['not_a_occur']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-lg-0 mt-2">
                                        <p>P(B') = 1 - P(B)</p>
                                        <p>P(B') = 1 - <?=$detail['pro_b']?></p>
                                        <p>P(B') = <?=$detail['not_b_occur']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(A∩B) =	P(A) × P(B)</p>
                                        <p>P(A∩B) = <?=$detail['pro_a']?> * <?=$detail['pro_a']?></p>
                                        <p>P(A∩B) = <?=$detail['both_events']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(A∪B)  = P(A) + P(B) - P(A∩B)</p>
                                        <p>P(A∪B) = <?=$detail['pro_a']?> + <?=$detail['pro_b']?> - <?=$detail['both_events']?></p>
                                        <p>P(A∪B) = <?=$detail['either_events']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(AΔB) =	P(A) + P(B) - 2P(A∩B)</p>
                                        <p>P(AΔB) = <?=$detail['pro_a']?> + <?=$detail['pro_a']?> - 2 * <?=$detail['both_events']?></p>
                                        <p>P(AΔB) = <?=$detail['not_both']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P((A∪B)')  = 1 - P(A∪B)</p>
                                        <p>P((A∪B)') = 1 - <?=$detail['either_events']?></p>
                                        <p>P((A∪B)') = <?=$detail['nor_both']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(A <?=$lang['occr']?> <?=$lang['nb']?> B) =	P(A) × (1- P(B))</p>
                                        <p>P(A <?=$lang['occr']?> <?=$lang['nb']?> B) = <?=$detail['pro_a']?> × (1 - <?=$detail['pro_a']?>)</p>
                                        <p>P(A <?=$lang['occr']?> <?=$lang['nb']?> B) = <?=$detail['anotb']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(B <?=$lang['occr']?> <?=$lang['nb']?> A)  = (1 - P(A)) × P(B)</p>
                                        <p>P(B <?=$lang['occr']?> <?=$lang['nb']?> A) = (1 - <?=$detail['pro_a']?>) × <?=$detail['pro_a']?></p>
                                        <p>P(B <?=$lang['occr']?> <?=$lang['nb']?> A) = <?=$detail['bnota']?></p>
                                    </div>
                                </div>
                            </div>
                        @endif
            
                        @if (isset($detail['Events']))
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$_POST['rep_a']?> <?=$lang['time']?></td>
                                        <td class="py-2 border-b"><b><?=round(pow($_POST['eve_a'], $_POST['rep_a']),5)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['not']?> <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b><?=round(pow((1-$_POST['eve_a']), $_POST['rep_a']),5)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b><?=round(1-(pow((1-$_POST['eve_a']), $_POST['rep_a'])),5)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?> <?=$_POST['rep_b']?> <?=$lang['time']?></td>
                                        <td class="py-2 border-b"><b><?=round(pow($_POST['eve_b'], $_POST['rep_b']),5)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['not']?> <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b><?=round(pow((1-$_POST['eve_b']), $_POST['rep_b']),5)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b><?=round(1-(pow((1-$_POST['eve_b']), $_POST['rep_b'])),5)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$_POST['rep_a']?> <?=$lang['time']?> and B <?=$lang['occr']?> <?=$_POST['rep_b']?> <?=$lang['time']?></td>
                                        <td class="py-2 border-b"><b><?=round(pow($_POST['eve_a'], $_POST['rep_a']) * pow($_POST['eve_b'], $_POST['rep_b']),9)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> neither A nor B <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b><?=round(pow((1-$_POST['eve_a']), $_POST['rep_a']) * pow((1-$_POST['eve_b']), $_POST['rep_b']),9)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> both A and B <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b><?=round((1-pow((1-$_POST['eve_a']), $_POST['rep_a'])) * (1-pow((1-$_POST['eve_b']), $_POST['rep_b'])),9)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$_POST['rep_a']?> <?=$lang['time']?> <?=$lang['nb']?> B</td>
                                        <td class="py-2 border-b"><b><?=round((pow($_POST['eve_a'], $_POST['rep_a'])) * pow((1-$_POST['eve_b']), $_POST['rep_b']),9)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?> <?=$_POST['rep_b']?> <?=$lang['time']?> <?=$lang['nb']?> A</td>
                                        <td class="py-2 border-b"><b><?=round((pow((1-$_POST['eve_a']), $_POST['rep_a'])) * pow($_POST['eve_b'], $_POST['rep_b']),9)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$lang['nb']?> B</td>
                                        <td class="py-2 border-b"><b><?=round((1-pow((1-$_POST['eve_a']), $_POST['rep_a'])) * pow((1-$_POST['eve_b']), $_POST['rep_b']),9)?></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$lang['nb']?> B</td>
                                        <td class="py-2 border-b"><b><?=round((pow((1-$_POST['eve_a']), $_POST['rep_a'])) * (1-pow((1-$_POST['eve_b']), $_POST['rep_b'])),9)?></b></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
            
                        @if (isset($detail['Multiple']))
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="text-blue py-2 border-b"><strong><?=$lang['dec']?></strong></td>
                                        <td class="text-blue py-2 border-b"><strong><?=$lang['per']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single3.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_a']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['event_a_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['event_a_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single4.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_a_not']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_a_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_a_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single5.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_b']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['event_b_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['event_b_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single6.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_occurs_b_not']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_b_occur']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['not_b_occur']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single7.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_both']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['both_events']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['both_events']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single8.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_either']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['either_events']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['either_events']*100?> %</b></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single9.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="text-blue py-2 border-b"><?=$lang['con_pro']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['conditional']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['conditional']*100?> %</b></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
            
                        @if (isset($detail['condi']))
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b">&nbsp;</td>
                                        <td class="py-2 border-b text-blue"><strong><?=$lang['dec']?></strong></td>
                                        <td class="py-2 border-b text-blue"><strong><?=$lang['per']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><img src="<?=url('images/single9.png')?>" loading="lazy" alt="Probability" class="image" width="50"></td>
                                        <td class="py-2 border-b text-blue"><?=$lang['con_pro']?></td>
                                        <td class="py-2 border-b"><b><?=$detail['condi']?></b></td>
                                        <td class="py-2 border-b"><b><?=$detail['condi']*100?> %</b></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        // Initial setup based on value of '#for' and '#format'
        var cal = document.getElementById('for').value;
        if (cal === '1') {
            showElement('.single');
        } else if (cal === '2') {
            showElement('.multi');
        } else if (cal === '3') {
            showElement('.solver');
        } else if (cal === '4') {
            showElement('.events');
        } else if (cal === '5') {
            showElement('.condi');
        }

        var format = document.getElementById('format').value;
        if (format === '1') {
            setAttributes('.input_val', { 'min': '0', 'max': '1', 'placeholder': '<?=$lang['vb']?> 0 and 1' });
        } else {
            setAttributes('.input_val', { 'min': '1', 'placeholder': '<?=$lang['vb']?> 1 and 99 %' });
        }

        // Event listener for '#for' change event
        document.getElementById('for').addEventListener('change', function() {
            var cal = this.value;
            if (cal === '1') {
                showElement('.single');
            } else if (cal === '2') {
                showElement('.multi');
            } else if (cal === '3') {
                showElement('.solver');
            } else if (cal === '4') {
                showElement('.events');
            } else if (cal === '5') {
                showElement('.condi');
            }
        });

        // Event listener for '#format' change event
        document.getElementById('format').addEventListener('change', function() {
            var format = this.value;
            if (format === '1') {
                setAttributes('.input_val', { 'min': '0', 'max': '1', 'placeholder': '<?=$lang['vb']?> 0 and 1' });
            } else {
                setAttributes('.input_val', { 'min': '1', 'placeholder': '<?=$lang['vb']?> 1 and 99 %' });
            }
        });

        // Function to show/hide elements
        function showElement(selector) {
            var elements = document.querySelectorAll('.single, .multi, .solver, .events, .condi');
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
            document.querySelector(selector).style.display = 'block';
        }

        // Function to set attributes for elements
        function setAttributes(selector, attributes) {
            var elements = document.querySelectorAll(selector);
            elements.forEach(function(element) {
                for (var key in attributes) {
                    element.setAttribute(key, attributes[key]);
                }
            });
        }


    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>