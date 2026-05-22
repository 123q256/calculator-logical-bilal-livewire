<div>
  <style>
    .bin_cell{
		padding: 5px 14px;
		border: 1px solid #1e5b80;
		background: #2845F5;
		color: white;
	}
</style>
 <form wire:submit.prevent="calculate">

	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">

		   <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
			<input type="hidden" name="selection" id="calculator_time" value="{{ $submit }}">
			<div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
				<div class="lg:w-1/2 w-full px-2 py-1">
					<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white pacetab {{ $submit !== 'distance' ? '' :'tagsUnit' }}" id="btw_first" wire:click="$set('submit', 'distance')">
							{{ $lang['24'] }}
					</div>
				</div>
				<div class="lg:w-1/2 w-full px-2 py-1">
					<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white pacetab {{ $submit === 'add_sub' ? 'tagsUnit' :'' }}" id="btw_second" wire:click="$set('submit', 'add_sub')">
							{{ $lang['26'] }}
					</div>
				</div>
			</div>
		</div>

			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 {{ $submit == 'distance' ? 'row' : 'hidden' }} twocomp mt-3">
					<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-6 ">
							<label for="dcal" class="font-s-14 text-blue"><?=$lang['1']?>:</label>
							<div class="py-2">
								<select id="dcal" wire:model.live="cal" class="input">
									<option value="dec_cal">{{ $lang['2'] }}</option>
									<option value="bnry_cal">{{ $lang['3'] }}</option>
									<option value="hex_cal">{{ $lang['4'] }}</option>
								</select>
							</div>
						</div>
						<div class="col-span-6 {{ $cal === 'hex_cal' ? 'hidden' : 'block' }}" id="bit">
							<label for="bits" class="font-s-14 text-blue"><?=$lang['5']?>:</label>
							<div class="py-2">
								<select id="bits" wire:model.live="bits" class="input">
									<option value="4">4-bit</option>
									<option value="8">8-bit</option>
									<option value="12">12-bit</option>
									<option value="16">16-bit</option>
									<option value="other">{{ $lang['6'] }}</option>
								</select>
							</div>
						</div>
						<div id="dec" class="col-span-6  {{ $cal !== 'dec_cal' ? 'hidden' : 'block' }}">
							<div class="input-field col m6 s12 margin_zero padding_l_r_20">
								<label for="dec_val" class="font-s-14 text-blue"><?=$lang['2']?>:</label>
								<div class="py-2">
									<input type="number" min="-32768" max="32767" wire:model.live="dec" id="dec_val" placeholder="10" class="input">
								</div>
							</div>
						</div>
						<div id="bnry" class="col-span-6  {{ $cal === 'bnry_cal' ? 'block' : 'hidden' }}">
							<div class="input-field col m6 s12 margin_zero padding_l_r_20">
								<label for="bnry_val" class="font-s-14 text-blue"><?=$lang['3']?>:</label>
								<div class="py-2">
									<input type="number" maxlength="16" wire:model.live="bnry" id="bnry_val" placeholder="1010" class="input">
								</div>
							</div>
						</div>
						<div id="hex" class="col-span-6  {{ $cal === 'hex_cal' ? 'block' : 'hidden' }}">
							<div class="input-field col m6 s12 margin_zero padding_l_r_20">
								<label for="hex_val" class="font-s-14 text-blue"><?=$lang['4']?>:</label>
								<div class="py-2">
									<input type="text" maxlength="16" wire:model.live="hex" id="hex_val" placeholder="A" class="input">
								</div>
							</div>
						</div>
						
						<div class="col-span-6 hidden" id="no_of_bits">
							<label for="n_o_b" class="font-s-14 text-blue"><?=$lang['7']?>:</label>
							<div class="py-2">
								<input type="number" min="2" max="70" wire:model.live="no_of_bits" id="n_o_b" class="input">
							</div>
						</div>

						<div id="dec_rng" class="col-span-12 text-[12px] {{ $cal !== 'dec_cal' ? 'hidden' : 'block' }}">
							<div>
								<p><?=$lang['8']?><span id="dec_range">-128 to 127</span></p>
							</div>
						</div>
						<div id="bnry_rng" class="col-span-12 text-[12px] {{ $cal === 'bnry_cal' ? 'block' : 'hidden' }}">
							<div>
								<p><?=$lang['9']?><span id="bnry_range">8 <?=$lang[16]?></span></p>
							</div>
						</div>
						<div id="hex_rng" class="col-span-12 text-[12px] {{ $cal === 'hex_cal' ? 'block' : 'hidden' }}">
							<div>
								<p><?=$lang['10']?><span id="hex_range">0-9 and A-F (16-Digits)</span></p>
							</div>
						</div>
					</div>
                </div>
                <div class="col-span-12 {{ $submit === 'add_sub' ? 'row' : 'hidden' }} twocomp2 mt-3">
					<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-5">
                        <label for="one" class="font-s-14 text-blue">{!!$lang['25']!!} 1:</label>
                        <div class="py-2">
                            <input type="number" maxlength="16" id="one" wire:model.live="no" class="input only_binary">
                        </div>
                    </div>
                    <div class="col-span-2 flex justify-center items-center mt-4">
                        <select wire:model.live="action" class="input mt-lg-4">
                            <option value="+"><b>+</b></option>
                            <option value="-"><b>-</b></option>
                        </select>
                    </div>
                    <div class="col-span-5">
                        <label for="two" class="font-s-14 text-blue">{!!$lang['25']!!} 2:</label>
                        <div class="py-2">
                            <input type="number" maxlength="16" id="two" wire:model.live="no1" class="input only_binary">
                        </div>
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
    @if(isset($detail))
	<hr>
	<div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
		<div class="">
			@if ($type == 'calculator')
			@include('inc.copy-pdf')
			@endif
			<div class="rounded-lg  flex items-center justify-center">
				<div class="w-full mt-3">
					<div class="w-full">
						@if($submit === 'add_sub')
							<div class="text-center">
								<p class="text-[20px]"><strong><?=(($detail['action']=='+')?'Addition ':'Subtraction ')?>of Two's Complements</strong></p>
								<div class="flex justify-center">
									<p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=$detail['add_sub']?></strong></p>
							</div>
						</div>
						@else
							<div class="text-center">
								<p class="text-[20px]"><strong><?=$lang['11']?></strong></p>
								<div class="flex justify-center">
									<p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?=$detail['_2s']?></strong></p>
							</div>
						</div>
							<p class=""><strong><?=$lang['12']?> <?=$detail['bit']?>-bit <?=$lang['13']?>:</strong></p>
							<div class="w-full md:w-[80%] lg:w-[80% text-[18px]">
								<table class="w-full">
									<tr>
										<td class="border-b py-2"><?=$lang['2']?></td>
										<td class='border-b py-2'><?=$detail['dec']?></td>
									</tr>
									<tr>
										<td class="border-b py-2"><?=$lang['3']?></td>
										<td class='border-b py-2'><?=$detail['binary']?></td>
									</tr>
									<tr>
										<td class="border-b py-2"><?=$lang['4']?></td>
										<td class='border-b py-2'><?=$detail['hex']?></td>
									</tr>
									<tr>
										<td class="border-b py-2"><?=$lang['14']?></td>
										<td class='border-b py-2'><?=$detail['_1s']?></td>
									</tr>
									<tr>
										<td class="border-b py-2"><?=$lang['15']?></td>
										<td class='border-b py-2'><?=$detail['_2s']?></td>
									</tr>
								</table>
							</div>
							<p class="text-[20px] mt-2"><strong><?=$lang[17]?></strong>:</p>
							<p class="text-[18px] mt-2"><strong><?=$lang[18]?> 1:</strong></p>
							<p class="mt-2"><?=$lang[19]?> <a href="<?=asset('ones-complement-calculator/')?>" title="One's complement Calculator" target="_blank"       rel="noopener">One's complement</a> <?=$lang[20]?>:</p>
							<p class="text-center my-2"><?=$lang[21]?></p>
							<div class="overflow-auto w-full md:w-[80%] lg:w-[80% text-[18px] text-center mx-auto">
								<table class="w-full">
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['binary'])));
											foreach ($binary as $key => $value) {
												echo "<td class='bin_cell'>$value</td>";
											}
										?>
									</tr>
								</table>
							</div>
							<p class="text-center my-2"><?=$lang[22]?>:</p>
							<div class="overflow-auto w-full md:w-[80%] lg:w-[80% text-[18px] text-center mx-auto">
								<table class="w-full">
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['binary'])));
											foreach ($binary as $key => $value) {
												echo "<td class='bin_cell'>$value</td>";
											}
										?>
									</tr>
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['binary'])));
											foreach ($binary as $key => $value) {
												echo "<td>↓</td>";
											}
										?>
									</tr>
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['_1s'])));
											foreach ($binary as $key => $value) {
												echo "<td class='bin_cell'>$value</td>";
											}
										?>
									</tr>
								</table>
							</div>
							<p class="text-[18px] mt-2"><strong><?=$lang[18]?> 2:</strong></p>
							<p class="text-center my-2"><?=$lang[23]?>:</p>
							<div class="overflow-auto w-full md:w-[80%] lg:w-[80% text-[18px] text-center mx-auto">
								<table class="w-full">
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['_1s'])));
											foreach ($binary as $key => $value) {
												echo "<td class='bin_cell'>$value</td>";
											}
										?>
									</tr>
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['_1s'])));
											foreach ($binary as $key => $value) {
												if ($key==0) {
													echo "<td>+</td>";
												}elseif ($key+1==count($binary)) {
													echo "<td class='bin_cell'>1</td>";
												}else{
													echo "<td></td>";
												}
											}
										?>
									</tr>
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['_1s'])));
											foreach ($binary as $key => $value) {
												echo "<td>↓</td>";
											}
										?>
									</tr>
									<tr>
										<?php
											$binary = str_split(str_replace(' ','',trim($detail['_2s'])));
											foreach ($binary as $key => $value) {
												echo "<td class='bin_cell'>$value</td>";
											}
										?>
									</tr>
								</table>
							</div>
							<p class="mt-2"><strong><?=$lang['12']?> <?=$detail['bit']?>-bit <?=$lang['13']?>:</strong></p>
							<table class="w-full">
								<tr>
									<td class="border-b py-2"><?=$lang['2']?></td>
									<td class='border-b py-2'><strong><?=$detail['dec']?></strong></td>
								</tr>
								<tr>
									<td class="border-b py-2"><?=$lang['3']?></td>
									<td class='border-b py-2'><strong><?=$detail['binary']?></strong></td>
								</tr>
								<tr>
									<td class="border-b py-2"><?=$lang['15']?></td>
									<td class='border-b py-2'><strong><?=$detail['_2s']?></strong></td>
								</tr>
							</table>
						@endif
					</div>
				</div>
	
				</div>
			</div>
		</div>
	
	
    @endif
</form>
</div>
