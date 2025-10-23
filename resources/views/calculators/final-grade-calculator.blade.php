<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 " id="bit">
					<label for="selection" class="label"><?=$lang['5']?>:</label>
					<div>
						<select id="selection" name="selection" class="input">
							@php
								function optionsList($arr1,$arr2,$unit){
								foreach($arr1 as $index => $name){
							@endphp
								<option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
									{{ $arr2[$index] }}
								</option>
							@php
								}}
								$name = [$lang[2],$lang[3],$lang[4]." & ".$lang[5]];
                				$val = ["1","2","3"];
								optionsList($val,$name,isset($_POST['selection'])?$_POST['selection']:'1');
							@endphp
						</select>
					</div>
				</div>
				<div class="col-span-12   tabs mt-2">
					<div class="col-12 col-lg-9 mx-auto mt-2  w-full">
						<input type="hidden" id="type" name="type" value="<?=isset($_POST['type'])?$_POST['type']:'first'?>">
						<div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
							<div class="lg:w-1/2 w-full px-2 py-1">
								<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="percentage">
										{{ $lang['7'] }}
								</div>
							</div>
							<div class="lg:w-1/2 w-full px-2 py-1">
								<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="letter">
										{{ $lang['8'] }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 grading_system mt-2  ">
					<label for="grading_system" class="label"><?=$lang['5']?>:</label>
					<div>
						<select id="grading_system" name="grading_system" class="input">
							@php
								$name =[$lang[10],$lang[7],"USA ".$lang[11],"USA (".$lang[12].")","Canada","GCSE","Australian (".$lang[13].")","Australian (".$lang[14].")","India (CCE)"];
                    			$val = ["1","2","3","4","5","6","7","8","9"];
								optionsList($val,$name,isset($_POST['grading_system'])?$_POST['grading_system']:'2');
							@endphp
						</select>
					</div>
					<div class="aggressive d-none">
						<input type="hidden" step="any" name="current_grade" value="<?=isset($_POST['current_grade'])?$_POST['current_grade']:'4'?>" class="input">
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 current_grade  ">
					<label for="current_grade" class="label"><?=$lang['2']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="current_grade" name="current_grade" value="<?=isset($_POST['current_grade'])?$_POST['current_grade']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 final_exam_grade  ">
					<label for="final_exam_grade2" class="label"><?=$lang['15']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="final_exam_grade2" name="final_exam_grade2" value="<?=isset($_POST['final_exam_grade2'])?$_POST['final_exam_grade2']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 current_grade2  ">
					<label for="current_grade2" class="label"><?=$lang['15']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="current_grade2" name="current_grade2[]" value="<?=isset($_POST['current_grade2[]'])?$_POST['current_grade2[]']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 weight2  ">
					<label for="final_exam_weight2" class="label"><?=$lang['16']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="final_exam_weight2" name="final_exam_weight2[]" value="<?=isset($_POST['final_exam_weight2[]'])?$_POST['final_exam_weight2[]']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 ">
                   <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd2">	

				   </div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 cur_letter mt-2  ">
					<label for="current_letter" class="label"><?=$lang[2]?> (<?=$lang[8]?>):</label>
					<div>
						<select id="current_letter" name="current_letter[]" class="input">
							@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
                  				$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
								optionsList($val,$name,isset($_POST['current_letter[]'])?$_POST['current_letter[]']:'A+');
							@endphp
						</select>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 pollard  ">
					<label for="pollard" class="label"><?=$lang['16']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="pollard" name="pollard[]" value="<?=isset($_POST['pollard[]'])?$_POST['pollard[]']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 ">
					<div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4 cd3">

					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 target_grade mt-2  ">
					<label for="target_letter" class="label"><?=$lang[2]?> (<?=$lang[8]?>):</label>
					<div>
						<select id="target_letter" name="target_letter" class="input">
							@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
                  				$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
								optionsList($val,$name,isset($_POST['target_letter'])?$_POST['target_letter']:'A+');
							@endphp
						</select>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 target_grade2  ">
					<label for="target_grade2" class="label"><?=$lang['5']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="target_grade2" name="target_grade2" value="<?=isset($_POST['target_grade2'])?$_POST['target_grade2']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 total_weights2  ">
					<label for="total_weight2" class="label"><?=$lang['17']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="total_weight2" name="total_weight2" value="<?=isset($_POST['total_weight2'])?$_POST['total_weight2']:'8'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 final_exam_weight2  ">
					<label for="final_exam_weight3" class="label"><?=$lang['18']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="final_exam_weight3" name="final_exam_weight3" value="<?=isset($_POST['final_exam_weight3'])?$_POST['final_exam_weight3']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 grading_system2  ">
					<label for="grading_system2" class="label"><?=$lang[19]?>:</label>
					<div>
						<select id="grading_system2" name="grading_system2" class="input">
							@php
 								$name =["Numbers","Percentage","USA Standard","USA (Advance Program)","Canada","GCSE","Australian (Schools)","Australian (University)","India (CCE)"];
                    			$val = ["1","2","3","4","5","6","7","8","9"];
								optionsList($val,$name,isset($_POST['grading_system2'])?$_POST['grading_system2']:'2');
							@endphp
						</select>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 you_want  ">
					<label for="you_want" class="label"><?=$lang['20']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="you_want" name="you_want" value="<?=isset($_POST['you_want'])?$_POST['you_want']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 grade_you_want  ">
					<label for="final_exam_grade1" class="label"><?=$lang['21']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="final_exam_grade1" name="final_exam_grade1" value="<?=isset($_POST['final_exam_grade1'])?$_POST['final_exam_grade1']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 your_grade_was  ">
					<label for="grade_was" class="label"><?=$lang['22']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="grade_was" name="grade_was[]" value="<?=isset($_POST['grade_was[]'])?$_POST['grade_was[]']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 worth  ">
					<label for="worth" class="label"><?=$lang['21']?>:</label>
					<div class=" relative">
						<input type="number" step="any" id="worth" name="worth[]" value="<?=isset($_POST['worth[]'])?$_POST['worth[]']:'4'?>" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 ">

					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd4">

					</div>
				</div>
				<div class="col-span-12 usa">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade3">
							<?php
							$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
							$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade3'])?$_POST['current_grade3']:'A+');

							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade3">
							<?php
							$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
							$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade3'])?$_POST['target_grade3']:'A+');

							?>
						</select>
					</div>
					</div>
				</div>
				<div class="col-span-12 advanced_usa">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade4">
							<?php
							$name =['A','B','C','D','E/F',$lang[24].' (0)'];
							$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade4'])?$_POST['current_grade4']:'A+');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade4">
							<?php
							$name =['A','B','C','D','E/F',$lang[24].' (0)'];
							$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade4'])?$_POST['target_grade4']:'A+');
							?>
						</select>
					</div>
				   </div>
				</div>
				<div class="col-span-12 australian_schools">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade5">
							<?php
							$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade5'])?$_POST['current_grade5']:'Band6');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade5">
							<?php
							$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade5'])?$_POST['target_grade5']:'Band6');
							?>
						</select>
					</div>
					</div>
				</div>
				<div class="col-span-12 australian_university">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade6">
							<?php
							$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
							$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade6'])?$_POST['current_grade6']:'HD');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade6">
							<?php
							$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
							$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade6'])?$_POST['target_grade6']:'HD');
							?>
						</select>
					</div>
					</div>
				</div>
				<div class="col-span-12 india">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade7">
							<?php
							$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade7'])?$_POST['current_grade7']:'A1');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade7">
							<?php
							$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade7'])?$_POST['target_grade7']:'A1');
							?>
						</select>
					</div>
					</div>
				</div>
				<div class="col-span-12 canada">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">

					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade8">
							<?php
							$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade8'])?$_POST['current_grade8']:'A+');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade8">
							<?php
							$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade8'])?$_POST['target_grade8']:'A+');
							?>
						</select>
					</div>
					</div>
				</div>
				<div class="col-span-12 gcse">
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[2]?></p>
						<select class="input" name="current_grade9">
							<?php
							$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['current_grade9'])?$_POST['current_grade9']:'A*');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[5]?></p>
						<select class="input" name="target_grade9">
							<?php
							$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['target_grade9'])?$_POST['target_grade9']:'A*');
							?>
						</select>
					</div>
			  	</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 final_exam_weight relative">
					<p class="label"><?=$lang[18]?>:</p>
					<input type="number" step="any" name="final_exam_weight" value="<?=isset($_POST['final_exam_weight'])?$_POST['final_exam_weight']:'6'?>" class="input">
					<span class="absolute right-3 top-8 text-blue">%</span>
				</div>
				<div class="col-span-12 usa_div"><!--USA Standard -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">

						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[22]?>:</p>
							<select class="input" name="c[]" id="choice"> 
								<?php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								optionsList($val,$name,isset($_POST['c[]'])?$_POST['c[]']:'A+');
								?>             
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
							<p class="label"><?=$lang[23]?>:</p>
							<input type="number" step="any" name="grade_was2[]" value="<?=isset($_POST['grade_was[]'])?$_POST['grade_was[]']:'4'?>" class="input">
							<span class="absolute right-3 top-8 text-blue">%</span>
						</div>
						<div class="col-span-12 ">
							<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd5">

							</div>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[20]?>..</p>
							<select class="input" name="undertaker">
								<?php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								optionsList($val,$name,isset($_POST['undertaker'])?$_POST['undertaker']:'A+');
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-span-12 advanced_div"><!--Advanced USA Standard -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[22]?></p>
						<select class="input" name="c2[]">
							<?php
							$name =['A','B','C','D','E/F',$lang[24].' (0)'];
							$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['c2[]'])?$_POST['c2[]']:'A');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
						<p class="label"><?=$lang[23]?>:</p>
						<input type="number" step="any" name="grade_was3[]" value="<?=isset($_POST['grade_was3[]'])?$_POST['grade_was3[]']:'4'?>" class="input">
						<span class="absolute right-3 top-8 text-blue">%</span>
					</div>
					<div class="col-span-12 ">
						<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd6">

						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[20]?>..</p>
						<select class="input" name="undertaker2">
							<?php
							$name =['A','B','C','D','E/F',$lang[24].' (0)'];
							$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['undertake2'])?$_POST['undertake2']:'A');
							?>
						</select>
					</div>
				  </div>
				</div>
				<div class="col-span-12 canada_div"><!--Canada div -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[22]?></p>
						<select class="input" name="c3[]">
							<?php
							$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['c3[]'])?$_POST['c3[]']:'A+');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
						<p class="label"><?=$lang[23]?>:</p>
						<input type="number" step="any" name="grade_was4[]" value="<?=isset($_POST['grade_was4[]'])?$_POST['grade_was4[]']:'4'?>" class="input">
						<span class="absolute right-3 top-8 text-blue">%</span>
					</div>
					<div class="col-span-12 ">
						<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd7">

						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[20]?>..</p>
						<select class="input" name="undertaker3">
							<?php
							$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['undertaker3'])?$_POST['undertaker3']:'A+');
							?>
						</select>
					</div>
					</div>
				</div>
			  	<div class="col-span-12 gcse_div"><!--GCSE div -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 ">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[22]?></p>
						<select class="input" name="c4[]">
							<?php
							$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['c4[]'])?$_POST['c4[]']:'A*');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
						<p class="label"><?=$lang[23]?>:</p>
						<input type="number" step="any" name="grade_was5[]" value="<?=isset($_POST['grade_was4[]'])?$_POST['grade_was4[]']:'4'?>" class="input">
						<span class="absolute right-3 top-8 text-blue">%</span>
					</div>
					<div class="col-span-12 ">
						<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd8">

						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[20]?>..</p>
						<select class="input" name="undertaker4">
							<?php
							$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['undertaker4'])?$_POST['undertaker4']:'A*');
							?>
						</select>
					</div>
				  </div>
			  	</div>
			  	<div class="col-span-12 australian_school_div"><!--Australian School div -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 gcse_div">

					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[22]?></p>
						<select class="input" name="c5[]">
							<?php
							$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['c5[]'])?$_POST['c5[]']:'Band6');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
						<p class="label"><?=$lang[23]?>:</p>
						<input type="number" step="any" name="grade_was6[]" value="<?=isset($_POST['grade_was6[]'])?$_POST['grade_was6[]']:'4'?>" class="input">
						<span class="absolute right-3 top-8 text-blue">%</span>
					</div>
					<div class="col-span-12 ">
						<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd9">

						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[20]?>..</p>
						<select class="input" name="undertaker5">
							<?php
							$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['undertaker5'])?$_POST['undertaker5']:'Band6');
							?>
						</select>
					</div>
				</div>
			  	</div>
			  	<div class="col-span-12 australian_university_div"><!--Australian University div -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 gcse_div">
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[22]?></p>
						<select class="input" name="c6[]">
							<option value="No grade (0)"><?=$lang[24]?> (0)</option>    
							<?php
							$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
							$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['c6[]'])?$_POST['c6[]']:'HD');
							?>
						</select>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
						<p class="label"><?=$lang[23]?>:</p>
						<input type="number" step="any" name="grade_was7[]" value="<?=isset($_POST['grade_was6[]'])?$_POST['grade_was6[]']:'4'?>" class="input">
						<span class="absolute right-3 top-8 text-blue">%</span>
					</div>
					<div class="col-span-12 ">
						<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd10">

						</div>
					</div>
				  	<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[20]?>..</p>
						<select class="input" name="undertaker6">
							<?php
							$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
							$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['undertaker6'])?$_POST['undertaker6']:'HD');
							?>
						</select>
					</div>
					</div>
				</div>
			   	<div class="col-span-12 india_div"><!--India div -->
					<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 india_div">

				  	<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[22]?></p>
						<select class="input" name="c7[]">  
							<?php
							$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['c7[]'])?$_POST['c7[]']:'A1');
							?>
						</select>
				  	</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
						<p class="label"><?=$lang[23]?>:</p>
						<input type="number" step="any" name="grade_was8[]" value="<?=isset($_POST['grade_was6[]'])?$_POST['grade_was6[]']:'4'?>" class="input">
						<span class="absolute right-3 top-8 text-blue">%</span>
					</div>
					<div class="col-span-12 ">
						<div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 cd11">

						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<p class="label"><?=$lang[20]?>..</p>
						<select class="input" name="undertaker7">
							<?php
							$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
							optionsList($val,$name,isset($_POST['undertaker7'])?$_POST['undertaker7']:'A1');
							?>
						</select>
					</div>
					</div>
			   	</div>

				<div class="col-span-12 mt-2" id="btn2">
					<button type="button" title="Add More Fields" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg" ><b><span class="font-s-18">+</span><?=$lang[26]?></b></button>
				</div>
				<div class="col-span-12 mt-2" id="btn3">
					<button type="button" title="Add More Fields" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg" ><b><span class="font-s-18">+</span><?=$lang[26]?></b></button>
				</div>
				 <div class="col-span-12 mt-2" id="btn4">
					<button type="button" title="Add Exam" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg" ><b><span class="font-s-18">+</span><?=$lang[27]?></b></button>
				</div> 
				<div class="col-span-12 mt-2" id="btn5">
					<button type="button" title="Add Exam" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg" ><b><span class="font-s-18">+</span><?=$lang[28]?>2</b></button>
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
						<div class="w-full text-[18px] text-center">
							<?php if(!empty($detail['subtraction']) && !empty($detail['read'])){ ?>
								<p class=""><strong><? echo $detail['read'] ?></strong>
								<p><span class="text-blue text-[20px]"><?=$lang[29]?> </span> <?php echo"<span class='text-blue text-[20px] my-2'>".$detail['subtraction']."</span>"; ?> <span class="black-text">%</span><?=$lang[32]?></p>
							<?php } ?>
							<?php if(!empty($detail['final_result'])): ?>
								<p class=""><?=$lang[33]?></p>
								<p class="text-blue text-[20px] my-2"><strong><?=round($detail['final_result'],2)?></strong>
							<?php endif; ?>
							<?php if(!empty($detail['fg'])){ ?>
								<p class=""><?=$lang[33]?></p>
								<p class="text-blue text-[20px] my-2"><strong><?=round($detail['fg'],2)?> (<?php echo $detail['assign']; ?> <?=$lang[34]?>)</strong>
								<?php 
									$method=$detail['method'];
									$cgw=$detail['cgw'];
									$cg=$detail['cg'];
									$fgw=$detail['fgw'];
								?>
								<div id="tbldiv" class="w-full md:w-[80%] lg:w-[80%]">
									<h5 class="text-start"><b><?=$lang[35]?></b></h5>
									<table class="w-100 striped" id="tbl2">
										<tr>
											<td class="border-b py-2"><?=$lang[2]?> (%)</td>
											<td class="border-b py-2"><?=$lang[15]?> (%)</td>
											<td class="border-b py-2"><?=$lang[36]?> (%)</td>
										</tr>
									</table>
								</div>
							<?php }?>
							<?php if(!empty($detail['Grades'])): ?>
								<p class="text-blue text-[20px] my-2"><?=$lang[30]?> <?php echo $detail['Grades'] ?> <?=$lang[31]?></p>
							<?php endif; ?>
							<?php if(!empty($detail['fg2'])): ?>
								<div id="fgl"></div>
									<?php 
										$method4=$detail['method4'];
										$cgw2=$detail['cgw2'];
										$cg2=$detail['cg2'];
										$fg2=$detail['fg2'];
										$difference=$detail['difference'];
									?>
									<p class=""><?=$lang[33]?></p>
									<p class=""><strong><?=round($detail['fg2'],2)?> (<?php echo $detail['assign_grade']; ?> <?=$lang[34]?>)</strong></p>
							<p class="asad"><b><?=$lang[35]?></b></p>
							<table class="w-100" id="tbl2">
								<tr>
									<td class="border-b py-2"><?=$lang[2]?> (%)</td>
									<td class="border-b py-2"><?=$lang[15]?> (%)</td>
									<td class="border-b py-2"><?=$lang[36]?> (%)</td>
								</tr>
							</table>
							<?php endif; ?> 
							<?php if(!empty($detail['nawaz'])){?>
								<?php if($detail['nawaz']=="CONGRATULATIONS!!
									No matter what you do, you will get your desired grade or higher!
									Just check the requirements of your particular subject" || $detail['nawaz']=="I am sorry, but with your current grades it is impossible to get the grade you want."){ ?>
								<p><span class="text-blue text-[20px] my-2"><?php echo $detail['nawaz'] ?></p>  
							<?php }else{ ?>
								<p><span class="text-blue text-[20px] my-2"><?=$lang[30]?></span> <?php echo"<span class='text-blue text-[20px] my-2'>".$detail['nawaz']."</span>"; ?> <?=$lang[31]?> </p>
							<?php } ?>
							<?php } ?>
							<?php if(!empty($detail['final_ten']) && !empty($detail['final_eleven'])){ ?>
								<?php if($detail['final']>10000){ ?>
								<p><?php echo"<span class=' text-blue text-[20px] my-2'>".$detail['final_eleven']."</span>"; ?></p>
							<?php }else if($detail['final']<0){?>
								<p><?php echo"<span class=' font_size28 center margin_top_10 text-accent-4'>".$detail['final_eleven']."</span>"; ?></p>
							<?php }else if($detail['final']>0 && $detail['final']<10000){?>
								<p><span><?=$lang[30]?></span> <?php echo"<span class=' text-blue text-[20px] my-2 '>".$detail['final_eleven']."</span>"; ?> <?=$lang[31]?> </p>
							<?php } ?>
								<p><span><?=$lang[29]?> </span> <?php echo"<span class=' text-blue text-[20px] my-2 '>".$detail['final_ten']."</span>"; ?> <span class="black-text">%</span> <?=$lang[32]?></p>
							<?php }?>
						</div>
						<div class="col-12 text-center my-[25px]">
							<a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
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
	   	@if(isset($detail))
	   		@if(!empty($detail['fg']))
				var met = <?php echo json_encode($method); ?>;
				if(met=="3"){
					var cg=<?php echo json_encode($cg); ?>;
					var cgw=<?php echo json_encode($cgw); ?>;
					var fgw=<?php echo json_encode($fgw); ?>;
					var g=50;
					var grade=((cgw*cg)+(fgw*g))/(fgw+cgw);
					function DrawTable(cg,cgw,fgw)
					{
						var grade;
						var tableRef = document.getElementById('tbl2').getElementsByTagName('tbody')[0];
						var len=tableRef.rows.length;
						for(var i=1; i<len; i++)
							tableRef.deleteRow(1);
						for(var i=0,g=50; g<=100; i++,g+=5) {
							grade=((cgw*cg)+(fgw*g))/(fgw+cgw);
							console.log("The value of cgw is"+cgw);
							console.log("The value of fgw is"+fgw);
							console.log("The value of cg is"+cg);
							console.log("The value of g is"+g);
							var row=tableRef.insertRow(i+1);
							row.innerHTML="<tr>\
								<td class='border-b py-2'>"+cg+"</td>\
								<td class='border-b py-2'>"+g+"</td>\
								<td class='border-b py-2'>"+(grade).toFixed(0)+"</td>\
							</tr>";
						}
						// $('#tbldiv').style.display="block";
					}
						DrawTable(cg,cgw,fgw);
				}
			@endif
			@if(!empty($detail['fg2']))
				var method4 = <?php echo json_encode($method4); ?>;
				if(method4=="4"){
					var glook=[-1,4.33,4.00, 3.67, 3.33, 3.00, 2.67, 2.33, 2.00, 1.67, 1.33, 1.00, 0.67, 0];
						var letter=['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
					var cgw2=<?php echo json_encode($detail['cgw2']); ?>;
					console.log("The value of cgw2 is"+cgw2);
					var cg2=<?php echo json_encode($detail['cg2']); ?>;
					console.log("The value of cg2 is"+cg2);
					var difference=<?php echo json_encode($detail['difference']); ?>;
					var fg2=<?php echo json_encode($detail['fg2']); ?>;
					console.log("The value of fg2 is"+fg2);
					function GetLetterFromGPA(gpa)
					{
						var letter="";
						var lettertbl=['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
						var gpatbl=[4.33,4.00, 3.67, 3.33, 3.00, 2.67, 2.33, 2.00, 1.67, 1.33, 1.00, 0.67, 0];
						for(var i=0; i<gpatbl.length; i++)
							if( gpa>=gpatbl[i] )
							{
								letter = lettertbl[i];
								break;
							}
						return letter;
					}
				function DrawLetterTable(cg2,cgw2,difference)
				{
					var gpa=[0.67,1.00,1.33,1.67,2.00,2.33,2.67,3.00,3.33,3.67,4.00,4.33];
					var grade;
					var tableRef = document.getElementById('tbl2').getElementsByTagName('tbody')[0];
					var len=tableRef.rows.length;
					for(var i=1; i<len; i++)
						tableRef.deleteRow(1);
					for(var i=0; i<12; i++) {
						var g=gpa[i];
						grade=(cgw2*cg2+difference*g)/(cgw2+difference);
						var row=tableRef.insertRow(i+1);
						row.innerHTML="<tr>\
							<td class='border-b py-2'>"+GetLetterFromGPA(cg2)+"</td>\
							<td class='border-b py-2'>"+GetLetterFromGPA(g)+"</td>\
							<td class='border-b py-2'>"+GetLetterFromGPA(grade)+"</td>\
						</tr>";
					}
					// $('#tbldiv').style.display="block";
				}
				DrawLetterTable(cg2,cgw2,difference);
				}
			@endif
		@endif

		var gradea = document.getElementById('selection').value;
		if (gradea == "1") { // Percentage & Numbers
			var elementsToShow = [
				".current_grade", ".grade_you_want", ".final_exam_weight", ".grading_system"
			];
			var elementsToHide = [
				".final_exam_grade", ".current_grade2", ".weight2", ".target_grade2", 
				".total_weights2", ".final_exam_weight2", ".tabs", ".cd2", "#btn2", 
				".cd3", ".target_grade", ".add_exam", "#btn4", ".your_grade_was",
				".worth", ".you_want", ".grading_system2", ".cur_letter", ".cd4", 
				".cd5", ".cd6", ".cd7", ".cd8", ".cd9", ".cd10", ".cd11", ".usa_div", 
				".advanced_div", ".canada_div", ".gcse_div", ".australian_school_div", 
				".australian_university_div", ".india_div", "#btn4", "#btn5", ".usa", 
				".advanced_usa", ".australian_schools", ".australian_university", 
				".india", ".pollard", ".per", ".cur_letter", "#btn3",".canada",".gcse"
			];

			elementsToShow.forEach(function(selector) {
				document.querySelectorAll(selector).forEach(function(element) {
					element.style.display = 'block';
				});
			});

			elementsToHide.forEach(function(selector) {
				document.querySelectorAll(selector).forEach(function(element) {
					element.style.display = 'none';
				});
			});
		}

		$('#letter').on('click',function(){
			$("#btn3,.cd3,.target_grade,.weight2,.pollard").show();
			$("#btn2,.current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,.target_grade2,.current_grade2,.cd2,.grading_system,.weight2").hide();
			$("#percentage").removeClass("tagsUnit");
			$("#letter").addClass("tagsUnit");
			$("#type").val('second');

		});

		$('#percentage').on('click',function(){
			$("#btn2,.target_grade2,.current_grade2,.cd2,.weight2").show();
			$("#btn3,.cd3,.target_grade,.grading_system,.pollard").hide();
			$("#percentage").addClass("tagsUnit");
			$("#letter").removeClass("tagsUnit");
			$("#type").val('first');
		});
		$("#grading_system2").on("change",function(){
			var grade=$(this).val();
			if(grade=="1" || grade=="2"){//Percentage & Numbers
				$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.usa_div").hide();
				$(".your_grade_was,.worth,.you_want").show();
			}
			else if(grade=="3"){//Simple USA
			$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".usa_div,.cd5").show();
			}else if(grade=="4"){//Advanced USA 
			$(".usa_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".advanced_div,.cd6").show(); 
			}else if(grade=="5"){//Canada
			$(".usa_div,.advanced_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".canada_div,.cd7").show(); 
			}else if(grade=="6"){//GCSE
			$(".usa_div,.advanced_div,.canada_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".gcse_div,.cd8").show(); 
			}else if(grade=="7"){
			$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".australian_school_div,.cd9").show(); 
			}else if(grade=="8"){
			$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".australian_university_div,.cd10").show(); 
			}else if(grade=="9"){
			$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.your_grade_was,.worth,.you_want,.cd4").hide();
			$(".india_div,.cd11").show(); 
			}
		});
		$("#selection").on("change",function(){
			var a=$(this).val();
			if(a=="1"){
				$(".current_grade,.grade_you_want,.final_exam_weight,.grading_system").show();
				$(".final_exam_grade,.current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,.cd2,#btn2,.cd3,.target_grade,.add_exam,.your_grade_was,.worth,.you_want,.grading_system2,.cur_letter,.cd4,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,#btn4,#btn5,.usa,.advanced_usa,.australian_schools,.australian_university,.india,.pollard").hide();
			var q4=$("#grading_system").val();
			if(q4=="1"){
				$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.per,.cur_letter").hide();
				$(".current_grade,.grade_you_want,.final_exam_weight").show();
				}else if(q4=="2"){
				$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.cur_letter").hide();
				$(".current_grade,.grade_you_want,.final_exam_weight,.per").show();
				}else if(q4=="3"){//USA
					$(".advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".usa").show();
				}else if(q4=="4"){//Advanced
				$(".usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".advanced_usa").show();
				}else if(q4=="5"){//Canada
				$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
				$(".canada").show();
				}else if(q4=="6"){//GCSE
				$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.current_grade,.grade_you_want,.per.cur_letter").hide();
				$(".gcse").show();
				}else if(q4=="7"){//GCSE
				$(".usa,.advanced_usa,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
				$(".australian_schools").show();
				}else if(q4=="8"){//Australian Schools
				$(".usa,.advanced_usa,.australian_schools,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
				$(".australian_university").show();
				}else if(q4=="9"){//India
				$(".usa,.advanced_usa,.australian_schools,.canada,.gcse,.australian_university,.current_grade,.grade_you_want,.per,.cur_letter,.your_grade_was,.worth,.current_grade,.cur_letter").hide();
				$(".india").show();
				}
			}else if(a=="2"){
				$(".current_grade,.final_exam_grade,.final_exam_weight").show();
				$(".grade_you_want,.current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,.cd2,#btn2,.cd3,.target_grade,.grading_system,.add_exam,.your_grade_was,.worth,.you_want,.grading_system2,.cur_letter,.cd4,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,#btn4,#btn5,.advanced_usa,.australian_schools,.australian_university,.india,.usa,.pollard,.usa,.advanced_usa,.canada,.gcse,.australian_schools,.australian_university,.india,#btn3").hide();
			}else if(a=="3"){
				$(".current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,#btn2,.cd2").show();
				$(".current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,#btn3,.cd3,#btn4,.your_grade_was,.worth,.you_want,.grading_system2,.grading_system,.cur_letter,.cd4,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,#btn4,#btn5,.india,.australian_university,.australian_schools,.gcse,.canada,.usa,.advanced_usa").hide();
				var define=$("#percentage").attr("class");
				if(define=="active border_1px"){
					$("#btn2,.target_grade2,.current_grade2,.cd2,.weight2").show();
					$("#btn3,.cd3,.target_grade,.grading_system,.cur_letter").hide();    
				}else if(define=="border_1px"){
					$("#btn3,.cd3,.cur_letter,.pollard,.target_grade,.total_weights2,.final_exam_weight2").show();
					$("#btn2,.current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,.target_grade2,.current_grade2,.cd2,.grading_system,.weight2").hide();
				}
			}else if(a=="4"){
					$(".your_grade_was,.worth,.you_want,#btn4,.grading_system2,.cd4").show();
					$(" .final_exam_grade,.current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,.cd2,#btn2,#btn3,.cd3,.target_grade,.usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.final_exam_weight,.grading_system,.cur_letter,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.pollard,.per").hide();
				var q1=$("#grading_system2").val();
				if(q1=="1"){//Percentage & Numbers
					$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd2,.cd3,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.usa_div,.pollard,.per,#btn5").hide();
					$(".your_grade_was,.worth,.you_want,.cd4").show();
				}else if(q1=="2"){
					$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd2,.cd3,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.usa_div,.pollard").hide();
					$(".your_grade_was,.worth,.you_want,.cd4,.per").show();
				}
				else if(q1=="3"){//Simple USA
					$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd2,.cd3,.cd4,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".usa_div,.cd5").show();
					var q2=$("#selection").val();
					if(q2=="3"){
					$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard").hide();
					$(".usa_div,.cd5,.grading_system2,.btn5").show();
					}
				}else if(q1=="4"){//Advanced USA 
					$(".usa_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".advanced_div,.cd6").show(); 
				}else if(q1=="5"){//Canada
					$(".usa_div,.advanced_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".canada_div,.cd7").show(); 
				}else if(q1=="6"){//GCSE
					$(".usa_div,.advanced_div,.canada_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".gcse_div,.cd8").show(); 
				}else if(q1=="7"){
					$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".australian_school_div,.cd9").show(); 
				}else if(q1=="8"){
					$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".australian_university_div,.cd10").show(); 
				}else if(q1=="9"){
					$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".india_div,.cd11").show(); 
				}
			}
		});
		
		var x=1;
		$("#btn2").click(function(){
		if(12 > x){
			x++;
			function add_fields(counter){
				var html=
				'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
				'<p class="label"><?=$lang[2]?> </p>'+
				'<input type="number" step="any" name="current_grade2[]" value="<?=isset($_POST['current_grade2[]'])?$_POST['current_grade2[]']:''?>" class="input">'+
				'<span class="absolute right-3 top-8 text-blue">%</span>'+
				'</div>'+
				'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
				'<p class="label"><?=$lang[16]?> </p>'+
				'<input type="number" step="any" name="final_exam_weight2[]" value="<?=isset($_POST['final_exam_weight2[]'])?$_POST['final_exam_weight2[]']:''?>" class="input">'+
				'<span class="absolute right-3 top-8 text-blue">%</span>'+
				'</div>';
			$(".cd2").append(html);
		}
		add_fields(x);
		}else{
			alert('<?=$lang[25]?>');
		}
		});
		var y=1;
		$("#btn3").click(function(){
		if(10 > y){
			y++;
			function add_fields(counter){
				var html2=
			'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
				'<p class="label"><?=$lang[2]?> (<?=$lang[8]?>)</p>'+
				'<select class="input" name="current_letter[]" id="choice">'+
					'<option value="A+">A+</option>'+
					'<option value="A">A</option>'+
					'<option value="A-">A-</option>'+
					'<option value="B+">B+</option>'+
					'<option value="B">B</option>'+
					'<option value="B-">B-</option>'+
					'<option value="C+">C+</option>'+
					'<option value="C">C</option>'+
					'<option value="C-">C-</option>'+
					'<option value="D+">D+</option>'+
					'<option value="D">D</option>'+
					'<option value="D-">D-</option>'+
					'<option value="F">F</option>'+              
				'</select>'+
			'</div>'+
			'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
				'<p class="label"><?=$lang[16]?></p>'+
				'<input type="number" step="any" name="pollard[]" value="<?=isset($_POST['pollard[]'])?$_POST['pollard[]']:''?>" class="input">'+
				'<span class="absolute right-3 top-8 text-blue">%</span>'+
			'</div>';
			$(".cd3").append(html2);
		}
		add_fields(y);
		}else{
			alert('<?=$lang[25]?>');
		}
		});
		var z=1;
		$("#btn4").on("click",function(){
		if(10>z){
			z++;
			var html5=
			'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
				'<p class="label"><?=$lang[22]?>:</p>'+
				'<input type="number" step="any" name="grade_was[]" value="<?=isset($_POST['grade_was[]'])?$_POST['grade_was[]']:''?>" class="input">'+
				'<span class="absolute right-3 top-8 text-blue">%</span>'+
				'</div>'+
			'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
				'<p class="label"><?=$lang[23]?>:</p>'+
				'<input type="number" step="any" name="worth[]" value="<?=isset($_POST['worth[]'])?$_POST['worth[]']:''?>" class="input">'+
				'<span class="absolute right-3 top-8 text-blue">%</span>'+
				'</div>';
			$(".cd4").append(html5);
		}else{
			alert('<?=$lang[25]?>');
		}
		});
		$('#letter').click(function(){
			$("#btn3,.cd3,.target_grade,.weight2,.cur_letter").show();
			$("#btn2,.current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,.target_grade2,.current_grade2,.cd2,.grading_system,.pollard").hide();
		});
		$('#percentage').click(function(){
		$("#btn2,.target_grade2,.current_grade2,.cd2,.weight2").show();
		$("#btn3,.cd3,.target_grade,.grading_system,.cur_letter").hide();
		});
		$("#grading_system").on("change",function(){
		var q=$(this).val();
		if(q=="1"){
			$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.per,.cur_letter").hide();
			$(".current_grade,.grade_you_want,.final_exam_weight").show();
		}else if(q=="2"){
			$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.cur_letter").hide();
			$(".current_grade,.grade_you_want,.final_exam_weight,.per").show();
		}else if(q=="3"){//USA
			$(".advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
			$(".usa").show();
		}else if(q=="4"){//Advanced
			$(".usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
			$(".advanced_usa").show();
		}else if(q=="5"){//Canada
			$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
			$(".canada").show();
		}else if(q=="6"){//GCSE
			$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.current_grade,.grade_you_want,.per.cur_letter").hide();
			$(".gcse").show();
		}else if(q=="7"){//GCSE
			$(".usa,.advanced_usa,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
			$(".australian_schools").show();
		}else if(q=="8"){//Australian Schools
			$(".usa,.advanced_usa,.australian_schools,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
			$(".australian_university").show();
		}else if(q=="9"){//India
			$(".usa,.advanced_usa,.australian_schools,.canada,.gcse,.australian_university,.current_grade,.grade_you_want,.per,.cur_letter,.your_grade_was,.worth,.current_grade,.cur_letter").hide();
			$(".india").show();
		}
		});
		$("#grading_system2").on("change",function(){
			var grade=$(this).val();
			if(grade=="1" || grade=="2"){
				$("#btn4").show();
				$("#btn5").hide();
			}else if(grade=="3" || grade=="4" || grade=="5" || grade=="6" || grade=="7" || grade=="8" || grade=="9"){
				$("#btn4").hide();
				$("#btn5").show();
			}    
		});
		z=1;
		y=1;
		a=1;
		b=1;
		c=1;
		d=1;
		e=1;
		$("#btn5").on("click",function(){
			var p=$("#grading_system2").val();
			if(p=="3"){
				if(10>z){
					var t=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
						'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c[]" id="choice">'+
							'<option value="A+">A+</option>'+
							'<option value="A">A</option>'+
							'<option value="A-">A-</option>'+
							'<option value="B+">B+</option>'+
							'<option value="B">B</option>'+
							'<option value="B-">B-</option>'+
							'<option value="C+">C+</option>'+
							'<option value="C">C</option>'+
							'<option value="C-">C-</option>'+
							'<option value="D+">D+</option>'+
							'<option value="D">D</option>'+
							'<option value="D-">D-</option>'+
							'<option value="F">F</option>'+              
						'</select>'+
						'</div>'+
						'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
							'<p class="label"><?=$lang[23]?>:</p>'+
							'<input type="number" step="any" name="grade_was2[]" value="<?=isset($_POST['grade_was2[]'])?$_POST['grade_was2[]']:''?>" class="input">'+
							'<span class="absolute right-3 top-8 text-blue">%</span>'+
						'</div>';
					$(".cd5").append(t);
				}else{
					alert('<?=$lang[25]?>');
				}
				z++;      
				}else if(p=="4"){
				if(10>y){
					var t2=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
							'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c2[]" id="choice">'+
								'<option value="A">A</option>'+
								'<option value="B">B</option>'+
								'<option value="C">C</option>'+
								'<option value="D">D</option>'+
								'<option value="E/F">E/F</option>'+
								'<option value="No grade (0)"><?=$lang[24]?> (0)</option>'+              
							'</select>'+
						'</div>'+
					'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
							'<p class="label"><?=$lang[23]?>:</p>'+
							'<input type="number" step="any" name="grade_was3[]" value="<?=isset($_POST['grade_was3[]'])?$_POST['grade_was3[]']:''?>" class="input">'+
							'<span class="absolute right-3 top-8 text-blue">%</span>'+
						'</div>';
					$(".cd6").append(t2);
				}else{
					alert('<?=$lang[25]?>');    
				}
				y++;
				}else if(p=="5"){
				if(10>a){
					var t3=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
							'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c3[]" id="choice">'+
								'<option value="A+">A+</option>'+
								'<option value="A">A</option>'+
								'<option value="A-">A-</option>'+
								'<option value="B+">B+</option>'+
								'<option value="B">B</option>'+
								'<option value="B-">B-</option>'+
								'<option value="C+">C+</option>'+
								'<option value="C">C</option>'+
								'<option value="C-">C-</option>'+
								'<option value="D+">D+</option>'+
								'<option value="D">D</option>'+
								'<option value="D-">D-</option>'+
								'<option value="R">R</option>'+
								'<option value="No grade (0)"><?=$lang[24]?> (0)</option>'+              
							'</select>'+
						'</div>'+
					'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
							'<p class="label"><?=$lang[23]?>:</p>'+
							'<input type="number" step="any" name="grade_was4[]" value="<?=isset($_POST['grade_was4[]'])?$_POST['grade_was4[]']:''?>" class="input">'+
							'<span class="absolute right-3 top-8 text-blue">%</span>'+
					'</div>';
						
				$(".cd7").append(t3);
				}else{
					alert('<?=$lang[25]?>');  
				}
				a++;
				}else if(p=="6"){
				if(10>b){
					var t3=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
							'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c4[]" id="choice">'+
								'<option value="A+">A+</option>'+
								'<option value="A">A</option>'+
								'<option value="A-">A-</option>'+
								'<option value="B+">B+</option>'+
								'<option value="B">B</option>'+
								'<option value="B-">B-</option>'+
								'<option value="C+">C+</option>'+
								'<option value="C">C</option>'+
								'<option value="C-">C-</option>'+
								'<option value="D+">D+</option>'+
								'<option value="D">D</option>'+
								'<option value="D-">D-</option>'+
								'<option value="R">R</option>'+
								'<option value="No grade (0)">No grade (0)</option>'+              
							'</select>'+
						'</div>'+
					'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
						'<p class="label"><?=$lang[23]?>:</p>'+
						'<input type="number" step="any" name="grade_was5[]" value="<?=isset($_POST['grade_was4[]'])?$_POST['grade_was4[]']:''?>" class="input">'+
						'<span class="absolute right-3 top-8 text-blue">%</span>'+
					'</div>';   
						$(".cd8").append(t3);
				}else{
					alert('<?=$lang[25]?>'); 
				}
				b++;
				}else if(p=="7"){
				if(10>c){
					var t3=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
							'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c5[]" id="choice">'+
								'<option value="Band6">Band6</option>'+
								'<option value="Band5">Band5</option>'+
								'<option value="Band4">Band4</option>'+
								'<option value="Band3">Band3</option>'+
								'<option value="Band2">Band2</option>'+
								'<option value="Band1">Band1</option>'+
								'<option value="No grade (0)"><?=$lang[24]?> (0)</option>'+              
							'</select>'+
						'</div>'+
					'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
						'<p class="label"><?=$lang[23]?>:</p>'+
						'<input type="number" step="any" name="grade_was6[]" value="<?=isset($_POST['grade_was6[]'])?$_POST['grade_was6[]']:''?>" class="input">'+
						'<span class="absolute right-3 top-8 text-blue">%</span>'+
					'</div>';   
					$(".cd9").append(t3);
				}else{
					alert('<?=$lang[25]?>'); 
				}
				c++;
				}else if(p=="8"){
				if(10>d){
					var t3=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
							'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c6[]" id="choice">'+
								'<option value="HD">HD</option>'+
								'<option value="D">D</option>'+
								'<option value="Cr">Cr</option>'+
								'<option value="P">P</option>'+
								'<option value="F">F</option>'+
								'<option value="No grade (0)"><?=$lang[24]?> (0)</option>'+              
							'</select>'+
						'</div>'+
					'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
							'<p class="label"><?=$lang[23]?>:</p>'+
							'<input type="number" step="any" name="grade_was7[]" value="<?=isset($_POST['grade_was7[]'])?$_POST['grade_was7[]']:''?>" class="input">'+
							'<span class="absolute right-3 top-8 text-blue">%</span>'+
						'</div>';
						$(".cd10").append(t3);
				}else{
					alert('<?=$lang[25]?>'); 
				}
				}else if(p=="9"){
				if(10>e){
					var t3=
					'<div class="col-span-12 md:col-span-6 lg:col-span-6">'+
						'<p class="label"><?=$lang[22]?></p>'+
							'<select class="input" name="c7[]" id="choice">'+
								'<option value="A1">A1</option>'+
								'<option value="A2">A2</option>'+
								'<option value="B1">B1</option>'+
								'<option value="B2">B2</option>'+
								'<option value="C1">C1</option>'+
								'<option value="C2">C2</option>'+
								'<option value="D">D</option>'+
								'<option value="E1">E1</option>'+
								'<option value="E2">E2</option>'+
								'<option value="No grade (0)"><?=$lang[24]?> (0)</option>'+              
							'</select>'+
						'</div>'+
					'<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">'+
						'<p class="label"><?=$lang[23]?>:</p>'+
						'<input type="number" step="any" name="grade_was8[]" value="<?=isset($_POST['grade_was8[]'])?$_POST['grade_was8[]']:''?>" class="input">'+
						'<span class="absolute right-3 top-8 text-blue">%</span>'+
						'</div>';
						$(".cd11").append(t3);
				}else{
					alert('<?=$lang[25]?>');  
				}
				e++;
				}
		});
		$('#letter').on('click',function(){
		$("#btn3,.cd3,.target_grade,.weight2,.pollard").show();
			$("#btn2,.current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,.target_grade2,.current_grade2,.cd2,.grading_system,.weight2").hide();
			$("#percentage").removeClass("active");
		});
		$('#percentage').on('click',function(){
		$("#btn2,.target_grade2,.current_grade2,.cd2,.weight2").show();
		$("#btn3,.cd3,.target_grade,.grading_system,.pollard").hide();
		$("#percentage").removeClass("active");
		$("#letter").addClass("active");
		});
	
	
	@if(isset($detail) || isset($error))
		var first = $('#type').val();
		if(first === 'first'){
			$("#btn2,.target_grade2,.current_grade2,.cd2,.weight2").show();
			$("#btn3,.cd3,.target_grade,.grading_system,.pollard").hide();
			$("#percentage").addClass("tagsUnit");
			$("#letter").removeClass("tagsUnit");
			$("#type").val('first');	
		}else if(first === 'second'){
			console.log('s');
			$("#btn3,.cd3,.target_grade,.weight2,.pollard").show();
			$("#btn2,.current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,.target_grade2,.current_grade2,.cd2,.grading_system,.weight2").hide();
			$("#percentage").removeClass("tagsUnit");
			$("#letter").addClass("tagsUnit");
			$("#type").val('second');
		}
		// $("#grading_system2").on("change",function(){
			var grade=$("#grading_system2").val();
			if(grade=="1" || grade=="2"){//Percentage & Numbers
				$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.usa_div").hide();
				$(".your_grade_was,.worth,.you_want").show();
			}
			else if(grade=="3"){//Simple USA
				$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".usa_div,.cd5").show();
			}else if(grade=="4"){//Advanced USA 
				$(".usa_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".advanced_div,.cd6").show(); 
			}else if(grade=="5"){//Canada
				$(".usa_div,.advanced_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".canada_div,.cd7").show(); 
			}else if(grade=="6"){//GCSE
				$(".usa_div,.advanced_div,.canada_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".gcse_div,.cd8").show(); 
			}else if(grade=="7"){
				$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd10,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".australian_school_div,.cd9").show(); 
			}else if(grade=="8"){
				$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd11,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".australian_university_div,.cd10").show(); 
			}else if(grade=="9"){
				$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.your_grade_was,.worth,.you_want,.cd4").hide();
				$(".india_div,.cd11").show(); 
			}
		// });
		// $("#selection").on("change",function(){
			var a=$("#selection").val();
			if(a=="1"){
				$(".current_grade,.grade_you_want,.final_exam_weight,.grading_system").show();
				$(".final_exam_grade,.current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,.cd2,#btn2,.cd3,.target_grade,.add_exam,.your_grade_was,.worth,.you_want,.grading_system2,.cur_letter,.cd4,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,#btn4,#btn5,.usa,.advanced_usa,.australian_schools,.australian_university,.india,.pollard").hide();
				var q4=$("#grading_system").val();
				if(q4=="1"){
					$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.per,.cur_letter").hide();
					$(".current_grade,.grade_you_want,.final_exam_weight").show();
				}else if(q4=="2"){
					$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.cur_letter").hide();
					$(".current_grade,.grade_you_want,.final_exam_weight,.per").show();
				}else if(q4=="3"){//USA
					$(".advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".usa").show();
				}else if(q4=="4"){//Advanced
					$(".usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".advanced_usa").show();
				}else if(q4=="5"){//Canada
					$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".canada").show();
				}else if(q4=="6"){//GCSE
					$(".usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.current_grade,.grade_you_want,.per.cur_letter").hide();
					$(".gcse").show();
				}else if(q4=="7"){//GCSE
					$(".usa,.advanced_usa,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".australian_schools").show();
				}else if(q4=="8"){//Australian Schools
					$(".usa,.advanced_usa,.australian_schools,.india,.canada,.gcse,.current_grade,.grade_you_want,.per,.cur_letter").hide();
					$(".australian_university").show();
				}else if(q4=="9"){//India
					$(".usa,.advanced_usa,.australian_schools,.canada,.gcse,.australian_university,.current_grade,.grade_you_want,.per,.cur_letter,.your_grade_was,.worth,.current_grade,.cur_letter").hide();
					$(".india").show();
				}
			}else if(a=="2"){
				$(".current_grade,.final_exam_grade,.final_exam_weight").show();
				$(".grade_you_want,.current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,.cd2,#btn2,.cd3,.target_grade,.grading_system,.add_exam,.your_grade_was,.worth,.you_want,.grading_system2,.cur_letter,.cd4,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,#btn4,#btn5,.advanced_usa,.australian_schools,.australian_university,.india,.usa,.pollard,.usa,.advanced_usa,.canada,.gcse,.australian_schools,.australian_university,.india,#btn3").hide();
			}else if(a=="3"){
				$(".current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,#btn2,.cd2").show();
				$(".current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,#btn3,.cd3,#btn4,.your_grade_was,.worth,.you_want,.grading_system2,.grading_system,.cur_letter,.cd4,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,#btn4,#btn5,.india,.australian_university,.australian_schools,.gcse,.canada,.usa,.advanced_usa").hide();
				var define=$("#percentage").attr("class");
				if(define=="active border_1px"){
					$("#btn2,.target_grade2,.current_grade2,.cd2,.weight2").show();
					$("#btn3,.cd3,.target_grade,.grading_system,.cur_letter").hide();    
				}else if(define=="border_1px"){
					$("#btn3,.cd3,.cur_letter,.pollard,.target_grade,.total_weights2,.final_exam_weight2").show();
					$("#btn2,.current_grade,.grade_you_want,.final_exam_weight,.final_exam_grade,.target_grade2,.current_grade2,.cd2,.grading_system,.weight2").hide();
				}
			}else if(a=="4"){
				$(".your_grade_was,.worth,.you_want,#btn4,.grading_system2,.cd4").show();
				$(" .final_exam_grade,.current_grade2,.weight2,.target_grade2,.total_weights2,.final_exam_weight2,.tabs,.cd2,#btn2,#btn3,.cd3,.target_grade,.usa,.advanced_usa,.australian_schools,.australian_university,.india,.canada,.gcse,.current_grade,.grade_you_want,.final_exam_weight,.grading_system,.cur_letter,.usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.pollard,.per,#btn5").hide();
				var q1=$("#grading_system2").val();
				if(q1=="1"){//Percentage & Numbers
					$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd2,.cd3,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.usa_div,.pollard,.per,#btn5").hide();
					$(".your_grade_was,.worth,.you_want,.cd4").show();
				}else if(q1=="2"){
					$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd2,.cd3,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.usa_div,.pollard").hide();
					$(".your_grade_was,.worth,.you_want,.cd4,.per").show();
				}
				else if(q1=="3"){//Simple USA
						$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd2,.cd3,.cd4,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
						$(".usa_div,.cd5").show();
					var q2=$("#selection").val();
					if(q2=="3"){
						$(".advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd6,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard").hide();
						$(".usa_div,.cd5,.grading_system2,.btn5").show();
					}
				}else if(q1=="4"){//Advanced USA 
					$(".usa_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd7,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".advanced_div,.cd6").show(); 
				}else if(q1=="5"){//Canada
					$(".usa_div,.advanced_div,.gcse_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd8,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".canada_div,.cd7").show(); 
				}else if(q1=="6"){//GCSE
					$(".usa_div,.advanced_div,.canada_div,.australian_school_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd9,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".gcse_div,.cd8").show(); 
				}else if(q1=="7"){
					$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_university_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd10,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".australian_school_div,.cd9").show(); 
				}else if(q1=="8"){
					$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.india_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd11,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".australian_university_div,.cd10").show(); 
				}else if(q1=="9"){
					$(".usa_div,.advanced_div,.canada_div,.gcse_div,.australian_school_div,.australian_university_div,.cd5,.cd6,.cd7,.cd8,.cd9,.cd10,.your_grade_was,.worth,.you_want,.pollard,.per").hide();
					$(".india_div,.cd11").show(); 
				}
			}
		// });
	@endif
    
   </script>
@endpush
