<div>
  <form wire:submit.prevent="calculate" class="row">
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 ">
                    <label for="for" class="font-s-14 text-blue">Calculating For:</label>
                    <select name="for" id="for" class="input" wire:model.live="for">
                        @php
                            $forNames = [$lang['single_pro'],$lang['multiple_events'],$lang['two'],$lang['events'],$lang['con_pro']];
                            $forVals  = [1,2,3,4,5];
                        @endphp
                        @foreach($forVals as $i => $val)
                            <option value="{{ $val }}">{{ $forNames[$i] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-3  gap-4 single" style="{{ $for == '1' ? '' : 'display:none;' }}">
                <div class="space-y-2">
                    <label for="nbr1" class="font-s-14 text-blue">{{ $lang['no_out'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="nbr1" id="nbr1" wire:model="nbr1" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="event" class="font-s-14 text-blue">{{ $lang['no_events'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" name="event" id="event" wire:model="event" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-3   gap-4 multi" style="{{ $for == '2' ? '' : 'display:none;' }}">
                <div class="space-y-2">
                    <label for="nbr2" class="font-s-14 text-blue">{{ $lang['no_out_n'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="nbr2" id="nbr2" wire:model="nbr2" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="event_a" class="font-s-14 text-blue">{{ $lang['no_out_a'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="event_a" id="event_a" wire:model="event_a" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="event_b" class="font-s-14 text-blue">{{ $lang['no_out_b'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="1" name="event_b" id="event_b" wire:model="event_b" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1  mt-3   gap-4 solver" style="{{ $for == '3' ? '' : 'display:none;' }}">
              
                <div class="space-y-2">
                    <label for="format" class="font-s-14 text-blue">{{ $lang['format'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="format" id="format" class="input" wire:model.live="format">
                            <option value="1">{{ $lang['dec'] }}</option>
                            <option value="2">Percent</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="pro_a" class="font-s-14 text-blue">{{ $lang['pro_of'] }} P(A)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" max="1" name="pro_a" id="pro_a" wire:model="pro_a" class="input" aria-label="input" placeholder="values between 0 and 1" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="pro_b" class="font-s-14 text-blue">{{ $lang['pro_of'] }} P(B)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" max="1" name="pro_b" id="pro_b" wire:model="pro_b" class="input" aria-label="input" placeholder="values between 0 and 1" />
                    </div>
                </div>

            </div>
            <div class="grid grid-cols-1 gap-4 mt-3 events" style="{{ $for == '4' ? '' : 'display:none;' }}">
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
                                <input type="number" step="any" min="0" max="1" name="eve_a" id="eve_a" wire:model="eve_a" class="input" aria-label="input" placeholder="e.g. 0.0632" />
                            </div>
                        </td>
                        <td class="ps-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="1" name="rep_a" id="rep_a" wire:model="rep_a" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pe-1"><label for="rep_b" class="font-s-14 text-blue"><?=$lang['event']?>&nbsp;B</label></td>
                        <td class="pe-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="0" max="1" name="eve_b" id="eve_b" wire:model="eve_b" class="input" aria-label="input" placeholder="e.g. 0.0341" />
                            </div>
                        </td>
                        <td class="ps-1">
                            <div class="w-100 py-1">
                                <input type="number" step="any" min="1" name="rep_b" id="rep_b" wire:model="rep_b" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="grid grid-cols-1 mt-3    gap-4 condi" style="{{ $for == '5' ? '' : 'display:none;' }}">
                <div class="space-y-2">
                    <label for="andb" class="font-s-14 text-blue">P(A and B)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" name="andb" id="andb" wire:model="andb" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="prob_b" class="font-s-14 text-blue">P(B)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" name="prob_b" id="prob_b" wire:model="prob_b" class="input" aria-label="input" placeholder="00" />
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
      <hr style="height: 1px; background-color: #e5e7eb;">
           <div id="result-section" wire:loading.remove wire:target="calculate"
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
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
                                        <p>P(A∩B) = <?=$detail['pro_a']?> * <?=$detail['pro_b']?></p>
                                        <p>P(A∩B) = <?=$detail['both_events']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(A∪B)  = P(A) + P(B) - P(A∩B)</p>
                                        <p>P(A∪B) = <?=$detail['pro_a']?> + <?=$detail['pro_b']?> - <?=$detail['both_events']?></p>
                                        <p>P(A∪B) = <?=$detail['either_events']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(AΔB) =	P(A) + P(B) - 2P(A∩B)</p>
                                        <p>P(AΔB) = <?=$detail['pro_a']?> + <?=$detail['pro_b']?> - 2 * <?=$detail['both_events']?></p>
                                        <p>P(AΔB) = <?=$detail['not_both']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P((A∪B)')  = 1 - P(A∪B)</p>
                                        <p>P((A∪B)') = 1 - <?=$detail['either_events']?></p>
                                        <p>P((A∪B)') = <?=$detail['nor_both']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(A <?=$lang['occr']?> <?=$lang['nb']?> B) =	P(A) × (1- P(B))</p>
                                        <p>P(A <?=$lang['occr']?> <?=$lang['nb']?> B) = <?=$detail['pro_a']?> × (1 - <?=$detail['pro_b']?>)</p>
                                        <p>P(A <?=$lang['occr']?> <?=$lang['nb']?> B) = <?=$detail['anotb']?></p>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <p>P(B <?=$lang['occr']?> <?=$lang['nb']?> A)  = (1 - P(A)) × P(B)</p>
                                        <p>P(B <?=$lang['occr']?> <?=$lang['nb']?> A) = (1 - <?=$detail['pro_a']?>) × <?=$detail['pro_b']?></p>
                                        <p>P(B <?=$lang['occr']?> <?=$lang['nb']?> A) = <?=$detail['bnota']?></p>
                                    </div>
                                </div>
                            </div>
                        @endif
            
                        @if (isset($detail['Events']))
                            @php
                                $eve_a = $detail['eve_a'] ?? $eve_a;
                                $rep_a = $detail['rep_a'] ?? $rep_a;
                                $eve_b = $detail['eve_b'] ?? $eve_b;
                                $rep_b = $detail['rep_b'] ?? $rep_b;
                            @endphp
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> {{ $rep_a }} <?=$lang['time']?></td>
                                        <td class="py-2 border-b"><b>{{ round(pow($eve_a, $rep_a),5) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['not']?> <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b>{{ round(pow((1-$eve_a), $rep_a),5) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b>{{ round(1-(pow((1-$eve_a), $rep_a)),5) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?> {{ $rep_b }} <?=$lang['time']?></td>
                                        <td class="py-2 border-b"><b>{{ round(pow($eve_b, $rep_b),5) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['not']?> <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b>{{ round(pow((1-$eve_b), $rep_b),5) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b>{{ round(1-(pow((1-$eve_b), $rep_b)),5) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> {{ $rep_a }} <?=$lang['time']?> and B <?=$lang['occr']?> {{ $rep_b }} <?=$lang['time']?></td>
                                        <td class="py-2 border-b"><b>{{ round(pow($eve_a, $rep_a) * pow($eve_b, $rep_b),9) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> neither A nor B <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b>{{ round(pow((1-$eve_a), $rep_a) * pow((1-$eve_b), $rep_b),9) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> both A and B <?=$lang['occr']?></td>
                                        <td class="py-2 border-b"><b>{{ round((1-pow((1-$eve_a), $rep_a)) * (1-pow((1-$eve_b), $rep_b)),9) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> {{ $rep_a }} <?=$lang['time']?> <?=$lang['nb']?> B</td>
                                        <td class="py-2 border-b"><b>{{ round((pow($eve_a, $rep_a)) * pow((1-$eve_b), $rep_b),9) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?> {{ $rep_b }} <?=$lang['time']?> <?=$lang['nb']?> A</td>
                                        <td class="py-2 border-b"><b>{{ round((pow((1-$eve_a), $rep_a)) * pow($eve_b, $rep_b),9) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> A <?=$lang['occr']?> <?=$lang['nb']?> B</td>
                                        <td class="py-2 border-b"><b>{{ round((1-pow((1-$eve_a), $rep_a)) * pow((1-$eve_b), $rep_b),9) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><?=$lang['pro_of']?> B <?=$lang['occr']?> <?=$lang['nb']?> A</td>
                                        <td class="py-2 border-b"><b>{{ round((pow((1-$eve_a), $rep_a)) * (1-pow((1-$eve_b), $rep_b)),9) }}</b></td>
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

</div>
