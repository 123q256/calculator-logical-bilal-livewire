<style>
    .bin_cell{
		padding: 5px 14px;
		border: 1px solid #1e5b80;
		background: #2845F5;
		color: white;
	}
</style>
@php
    $cal=trim(request()->cal);
    $dec=trim(request()->dec);
    $bnry=trim(request()->bnry);
    $hex=trim(request()->hex);
    $bits=trim(request()->bits);
@endphp
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">

		   <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
			<input type="hidden" name="selection" id="calculator_time" value="{{ isset(request()->selection) ? request()->selection : 'distance' }}">
			<div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
				<div class="lg:w-1/2 w-full px-2 py-1">
					<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white   pacetab {{ isset(request()->selection) && request()->selection !== 'distance'  ? '' :'tagsUnit' }}" id="btw_first" onclick="change_tab(tab_val='f_tab')">
							{{ $lang['24'] }}
					</div>
				</div>
				<div class="lg:w-1/2 w-full px-2 py-1">
					<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === 'add_sub'  ? 'tagsUnit' :'' }}" id="btw_second" onclick="change_tab(tab_val='s_tab')">
							{{ $lang['26'] }}
					</div>
				</div>
			</div>
		</div>

			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 {{ isset($_POST['submit']) && $_POST['submit'] == 'distance' ? 'row' : 'hidden' }} twocomp mt-3">
					<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-6 ">
							<label for="dcal" class="font-s-14 text-blue"><?=$lang['1']?>:</label>
							<div class="py-2">
								<select id="dcal" name="cal" class="input">
									@php
										function optionsList($arr1,$arr2,$unit){
										foreach($arr1 as $index => $name){
									@endphp
										<option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
											{{ $arr2[$index] }}
										</option>
									@php
										}}
										$name = [$lang['2'],$lang['3'],$lang['4']];
										$val = ["dec_cal","bnry_cal","hex_cal"];
										optionsList($val,$name,isset($_POST['cal'])?$_POST['cal']:'dec_cal'); 
									@endphp
								</select>
							</div>
						</div>
						<div class="col-span-6 {{ isset($_POST['cal']) && $_POST['cal'] === 'hex_cal' ? 'hidden' : 'block' }}" id="bit">
							<label for="bits" class="font-s-14 text-blue"><?=$lang['5']?>:</label>
							<div class="py-2">
								<select id="bits" name="bits" class="input">
									@php
										$name = ["4-bit","8-bit","12-bit","16-bit",$lang['6']];
										$val = ["4","8","12","16","other"];
										optionsList($val,$name,isset($_POST['bits'])?$_POST['bits']:'8'); 
									@endphp
								</select>
							</div>
						</div>
						<div id="dec" class="col-span-6  {{ isset($_POST['cal']) && $_POST['cal'] !== 'dec_cal' ? 'hidden' : 'block' }}">
							<div class="input-field col m6 s12 margin_zero padding_l_r_20">
								<label for="dec_val" class="font-s-14 text-blue"><?=$lang['2']?>:</label>
								<div class="py-2">
									<input type="number" min="-128" max="127" name="dec" id="dec_val" placeholder="10" value="<?=isset($_POST['dec'])?$_POST['dec']:'5'?>" class="input">
								</div>
							</div>
						</div>
						<div id="bnry" class="col-span-6  {{ isset($_POST['cal']) && $_POST['cal'] === 'bnry_cal' ? 'block' : 'hidden' }}">
							<div class="input-field col m6 s12 margin_zero padding_l_r_20">
								<label for="bnry_val" class="font-s-14 text-blue"><?=$lang['3']?>:</label>
								<div class="py-2">
									<input type="number" maxlength="8" name="bnry" id="bnry_val" placeholder="1010" value="<?=isset($_POST['bnry'])?$_POST['bnry']:'0101'?>" class="input">
								</div>
							</div>
						</div>
						<div id="hex" class="col-span-6  {{ isset($_POST['cal']) && $_POST['cal'] === 'hex_cal' ? 'block' : 'hidden' }}">
							<div class="input-field col m6 s12 margin_zero padding_l_r_20">
								<label for="hex_val" class="font-s-14 text-blue"><?=$lang['4']?>:</label>
								<div class="py-2">
									<input type="text" maxlength="16" min="" name="hex" id="hex_val" placeholder="A" value="<?=isset($_POST['hex'])?$_POST['hex']:'F'?>" class="input">
								</div>
							</div>
						</div>
						
						<div class="col-span-6 hidden" id="no_of_bits">
							<label for="n_o_b" class="font-s-14 text-blue"><?=$lang['7']?>:</label>
							<div class="py-2">
								<input type="number" min="2" max="70" name="no_of_bits" id="n_o_b" value="<?=isset($_POST['no_of_bits'])?$_POST['no_of_bits']:'8'?>" class="input">
							</div>
						</div>

						<div id="dec_rng" class="col-span-12 text-[12px] {{ isset($_POST['cal']) && $_POST['cal'] !== 'dec_cal' ? 'hidden' : 'block' }}">
							<div>
								<p><?=$lang['8']?><span id="dec_range">-128 to 127</span></p>
							</div>
						</div>
						<div id="bnry_rng" class="col-span-12 text-[12px] {{ isset($_POST['cal']) && $_POST['cal'] === 'bnry_cal' ? 'block' : 'hidden' }}">
							<div>
								<p><?=$lang['9']?><span id="bnry_range">8 <?=$lang[16]?></span></p>
							</div>
						</div>
						<div id="hex_rng" class="col-span-12 text-[12px] {{ isset($_POST['cal']) && $_POST['cal'] === 'hex_cal' ? 'block' : 'hidden' }}">
							<div>
								<p><?=$lang['10']?><span id="hex_range">0-9 and A-F (16-Digits)</span></p>
							</div>
						</div>
					</div>
                </div>
                <div class="col-span-12 {{ isset($_POST['submit']) && $_POST['submit'] === 'add_sub' ? 'row' : 'hidden' }} twocomp2 mt-3">
					<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-5">
                        <label for="one" class="font-s-14 text-blue">{!!$lang['25']!!} 1:</label>
                        <div class="py-2">
                            <input type="number" maxlength="8" id="one" name="no" value="<?=isset($_POST['no'])?$_POST['no']:'11101'?>" class="input only_binary">
                        </div>
                    </div>
                    <div class="col-span-2 flex justify-center items-center mt-4">
                        <select name="action"  class="input mt-lg-4">
                            <option value="+"><b>+</b></option>
                            <option value="-"><b>-</b></option>
                        </select>
                    </div>
                    <div class="col-span-5">
                        <label for="two" class="font-s-14 text-blue">{!!$lang['25']!!} 2:</label>
                        <div class="py-2">
                            <input type="number" maxlength="8" id="two" name="no1" value="<?=isset($_POST['no1'])?$_POST['no1']:'10110'?>" class="input only_binary">
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
    @else
	
	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
		<div class="">
			@if ($type == 'calculator')
			@include('inc.copy-pdf')
			@endif
			<div class="rounded-lg  flex items-center justify-center">
				<div class="w-full mt-3">
					<div class="w-full">
						@if(request()->submit === 'add_sub')
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
					<div class="col-12 text-center my-[25px]">
						<a href="{{ url()->current() }}/" class="calculate px-6 py-3 sm:px-6 sm:py-3 font-semibold bg-[#2845F5] text-white rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base" id="">
							@if (app()->getLocale() == 'en')
								RESET
							@else
								{{ $lang['reset'] ?? 'RESET' }}
							@endif
						</a>
					</div>
				</div>
	
				</div>
			</div>
		</div>
	
	
    @endif
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@push('calculatorJS')
    <script>
        var distance =  document.querySelector('[name="submit"]').value = "distance";
        if(distance){
            document.querySelectorAll('.twocomp2').forEach(function(el) {
                el.classList.add('hidden');
                el.classList.remove('row');
            });
            document.querySelectorAll('.twocomp').forEach(function(el) {
                el.classList.remove('hidden');
                el.classList.add('row');
            });
        }
        function change_tab(element) {
            if (element === "f_tab") {
                document.getElementById("btw_first").classList.add('tagsUnit');
                document.getElementById("btw_second").classList.remove('tagsUnit');
                document.querySelectorAll('.twocomp2').forEach(function(el) {
                    el.classList.add('hidden');
                    el.classList.remove('row');
                });
                document.querySelectorAll('.twocomp').forEach(function(el) {
                    el.classList.remove('hidden');
                    el.classList.add('row');
                });
                document.querySelector('[name="submit"]').value = "distance";
                document.querySelector('[name="selection"]').value = "distance";
            } else if (element === "s_tab") {
                document.getElementById("btw_second").classList.add('tagsUnit');
                document.getElementById("btw_first").classList.remove('tagsUnit');
                document.querySelectorAll('.twocomp2').forEach(function(el) {
                    el.classList.remove('hidden');
                    el.classList.add('row');
                });
                document.querySelectorAll('.twocomp').forEach(function(el) {
                    el.classList.add('hidden');
                    el.classList.remove('row');
                });
                document.querySelector('[name="submit"]').value = "add_sub";
                document.querySelector('[name="selection"]').value = "add_sub";
            } 
        }

        function bits(){
			if($('#bits').val()==='other'){
				$('#no_of_bits').show();
				$('#n_o_b').on('input',function(){
					if($(this).val()!=''){
						if($('input[name="cal"]:checked').val()==='bnry_cal'){
							var min=Math.pow(2,$(this).val()-1)*(-1);
							var max=Math.pow(2,$(this).val()-1)-1;
							if($(this).val()<55){
								$('#dec_val').attr('min',min);
								$('#dec_val').attr('max',max);
								$('#dec_range').text(min+' to '+max);
								$('#dec_rng').show();
							}else{
								$('#dec_val').attr('min','');
								$('#dec_val').attr('max','');
								$('#dec_range').text('');
								$('#dec_rng').hide();
							}
						}else{
							$('#bnry_val').attr('maxlength',$(this).val());
							$('#bnry_range').text($(this).val()+' <?=$lang[16]?>');
						}
					}else{
						$('#dec_val').attr('min','');
						$('#dec_val').attr('max','');
						$('#dec_range').text('');
						$('#bnry_val').attr('maxlength','');
						$('#bnry_range').text('');
					}
				});
			}else if($('#bits').val()==='4'){
				$('#no_of_bits').hide();
				$('#n_o_b').val('4');
				if($('input[name="cal"]:checked').val()==='bnry_cal'){
					$('#dec_val').attr('min','-8');
					$('#dec_val').attr('max','7');
					$('#dec_range').text('-8 to 7');
				}else if($('input[name="cal"]:checked').val()==='dec_cal'){
					$('#bnry_val').attr('maxlength','4');
					$('#bnry_range').text('4 <?=$lang[16]?>');
				}
			}else if($('#bits').val()==='8'){
				$('#no_of_bits').hide();
				$('#n_o_b').val('8');
				if($('input[name="cal"]:checked').val()==='bnry_cal'){
					$('#dec_val').attr('min','-128');
					$('#dec_val').attr('max','127');
					$('#dec_range').text('-128 to 127');
				}else{
					$('#bnry_val').attr('maxlength','8');
					$('#bnry_range').text('8 <?=$lang[16]?>');
				}
			}else if($('#bits').val()==='12'){
				$('#no_of_bits').hide();
				$('#n_o_b').val('12');
				if($('input[name="cal"]:checked').val()==='bnry_cal'){
					$('#dec_val').attr('min','-2048');
					$('#dec_val').attr('max','2047');
					$('#dec_range').text('-2048 to 2047');
				}else{
					$('#bnry_val').attr('maxlength','12');
					$('#bnry_range').text('12 <?=$lang[16]?>');
				}
			}else if($('#bits').val()==='16'){
				$('#no_of_bits').hide();
				$('#n_o_b').val('16');
				if($('input[name="cal"]:checked').val()==='bnry_cal'){
					$('#dec_val').attr('min','-32768');
					$('#dec_val').attr('max','32767');
					$('#dec_range').text('-32768 to 32767');
				}else{
					$('#bnry_val').attr('maxlength','16');
					$('#bnry_range').text('16 <?=$lang[16]?>');
				}
			}
		}

		$('#dcal').change(function(){
			var chang = $(this).val();
			if(chang == 'dec_cal'){
				$('#dec,#dec_rng,#bit').show();
				$('#bnry,#bnry_rng,#hex,#hex_rng').hide();
				bits();
			}else if(chang == 'bnry_cal'){
				$('#bnry,#bnry_rng,#bit').show();
            	$('#dec,#dec_rng,#hex,#hex_rng').hide();
				bits();
			}else if(chang == 'hex_cal'){
				$('#hex').show();
				$('#dec,#bnry').hide();
			}
		});

		$('#bits').on('change',function(){
			bits();
		});
		$('#bnry_val').on('keydown',function(e){
			if(e.which != 48 && e.which != 49 && e.which != 8 && e.which != 13 && e.which != 17 && e.which != 65 && e.which != 67 && e.which != 86){
		    e.preventDefault();
		  }
		});
		$('.only_binary').on('keydown',function(e){
			if(e.which != 48 && e.which != 49 && e.which != 8 && e.which != 13 && e.which != 17 && e.which != 65 && e.which != 67 && e.which != 86){
		    e.preventDefault();
		  }
		});
		<?php if($bits==='other'){
			    if(!empty($no_of_bits)){
				if($cal==='bnry_cal'){ ?>
					var min=Math.pow(2,$('#n_o_b').val()-1)*(-1);
					var max=Math.pow(2,$('#n_o_b').val()-1)-1;
					<?php if($no_of_bits<55){ ?>
						$('#dec_val').attr('min',min);
						$('#dec_val').attr('max',max);
						$('#dec_range').text(min+' to '+max);
						$('#dec_rng').show();
					<?php }else{ ?>
						$('#dec_val').attr('min','');
						$('#dec_val').attr('max','');
						$('#dec_range').text('');
						$('#dec_rng').hide();
					<?php } ?>
                <?php }else{ ?>
                    $('#bnry_val').attr('maxlength',$('#n_o_b').val());
                    $('#bnry_range').text($('#n_o_b').val()+' <?=$lang[16]?>');
                <?php } ?>
                <?php }else{ ?>
                        $('#dec_val').attr('min','');
                        $('#dec_val').attr('max','');
                        $('#dec_range').text('');
                        $('#bnry_val').attr('maxlength','');
                        $('#bnry_range').text('');
                <?php } ?>
		<?php }elseif($bits==='4'){
			if($cal==='bnry_cal'){ ?>
				$('#dec_val').attr('min','-8');
				$('#dec_val').attr('max','7');
				$('#dec_range').text('-8 to 7');
			<?php }else{ ?>
				$('#bnry_val').attr('maxlength','4');
				$('#bnry_range').text('4 <?=$lang[16]?>');
			<?php } ?>
		<?php }elseif($bits==='8'){
			if($cal==='bnry_cal'){ ?>
				$('#dec_val').attr('min','-128');
				$('#dec_val').attr('max','127');
				$('#dec_range').text('-128 to 127');
			<?php }else{ ?>
				$('#bnry_val').attr('maxlength','8');
				$('#bnry_range').text('8 <?=$lang[16]?>');
			<?php } ?>
		<?php }elseif($bits==='12'){
			if($cal==='bnry_cal'){ ?>
				$('#dec_val').attr('min','-2048');
				$('#dec_val').attr('max','2047');
				$('#dec_range').text('-2048 to 2047');
			<?php }else{ ?>
				$('#bnry_val').attr('maxlength','12');
				$('#bnry_range').text('12 <?=$lang[16]?>');
			<?php } ?>
		<?php }elseif($bits==='16'){
			if($cal==='bnry_cal'){ ?>
				$('#dec_val').attr('min','-32768');
				$('#dec_val').attr('max','32767');
				$('#dec_range').text('-32768 to 32767');
			<?php }else{ ?>
				$('#bnry_val').attr('maxlength','16');
				$('#bnry_range').text('16 <?=$lang[16]?>');
			<?php } ?>
		<?php } ?>  
    </script>
@endpush
