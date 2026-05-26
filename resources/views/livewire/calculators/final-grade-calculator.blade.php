<div>
 <form wire:submit.prevent="calculate">

	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 " id="bit">
					<label for="selection" class="label"><?=$lang['5']?>:</label>
					<div>
						<select id="selection" wire:model.live="selection" class="input">
							@php
								function optionsList($arr1,$arr2,$unit){
								foreach($arr1 as $index => $name){
							@endphp
								<option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
									{{ $arr2[$index] }}
								</option>
							@php
								}}
								$name = [$lang[2],$lang[3],$lang[4]." & ".$lang[5], $lang[6] ?? 'Previous Exams'];
                				$val = ["1","2","3","4"];
								optionsList($val,$name,$selection);
							@endphp
						</select>
					</div>
				</div>

				<!-- Selection 3 Tabs -->
				@if($selection == '3')
				<div class="col-span-12 tabs mt-2">
					<div class="col-12 col-lg-9 mx-auto mt-2  w-full">
						<div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
							<div class="lg:w-1/2 w-full px-2 py-1">
								<div wire:click="$set('type_selection', 'first')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $type_selection === 'first' ? 'tagsUnit' : '' }}" id="percentage">
										{{ $lang['7'] }}
								</div>
							</div>
							<div class="lg:w-1/2 w-full px-2 py-1">
								<div wire:click="$set('type_selection', 'second')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $type_selection === 'second' ? 'tagsUnit' : '' }}" id="letter">
										{{ $lang['8'] }}
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif

				<!-- Selection 1 Grading System -->
				@if($selection == '1')
				<div class="col-span-12 md:col-span-6 lg:col-span-6 grading_system mt-2">
					<label for="grading_system" class="label"><?=$lang['5']?>:</label>
					<div>
						<select id="grading_system" wire:model.live="grading_system" class="input">
							@php
								$name =[$lang[10],$lang[7],"USA ".$lang[11],"USA (".$lang[12].")","Canada","GCSE","Australian (".$lang[13].")","Australian (".$lang[14].")","India (CCE)"];
                    			$val = ["1","2","3","4","5","6","7","8","9"];
								optionsList($val,$name,$grading_system);
							@endphp
						</select>
					</div>
				</div>
				@endif

				<!-- Current Grade: Selection 2, or Selection 1 under Numbers/Percentage -->
				@if($selection == '2' || ($selection == '1' && in_array($grading_system, ['1', '2'])))
				<div class="col-span-12 md:col-span-6 lg:col-span-6 current_grade">
					<label for="current_grade" class="label"><?=$lang['2']?>:</label>
					<div class="relative">
						<input type="number" step="any" id="current_grade" wire:model="current_grade" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				@endif

				<!-- Final Exam Grade: Selection 2 only -->
				@if($selection == '2')
				<div class="col-span-12 md:col-span-6 lg:col-span-6 final_exam_grade">
					<label for="final_exam_grade2" class="label"><?=$lang['15']?>:</label>
					<div class="relative">
						<input type="number" step="any" id="final_exam_grade2" wire:model="final_exam_grade2" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				@endif

				<!-- Selection 3 Percentage inputs -->
				@if($selection == '3' && $type_selection == 'first')
				<div class="col-span-12 md:col-span-6 lg:col-span-6 current_grade2">
					<label for="current_grade2" class="label"><?=$lang['15']?>:</label>
					<div class="relative">
						<input type="number" step="any" id="current_grade2" wire:model="current_grade2.0" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 weight2">
					<label for="final_exam_weight2" class="label"><?=$lang['16']?>:</label>
					<div class="relative">
						<input type="number" step="any" id="final_exam_weight2" wire:model="final_exam_weight2.0" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12">
                   <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd2">
						@foreach($current_grade2 as $index => $val)
							@if($index > 0)
								<div class="col-span-12 md:col-span-6 lg:col-span-6">
									<p class="label"><?=$lang['15']?>:</p>
									<div class="relative">
										<input type="number" step="any" wire:model="current_grade2.{{$index}}" class="input">
										<span class="absolute right-3 top-3 text-blue">%</span>
									</div>
								</div>
								<div class="col-span-12 md:col-span-6 lg:col-span-6">
									<p class="label"><?=$lang['16']?>:</p>
									<div class="relative">
										<input type="number" step="any" wire:model="final_exam_weight2.{{$index}}" class="input">
										<span class="absolute right-3 top-3 text-blue">%</span>
									</div>
								</div>
							@endif
						@endforeach
                    </div>
				</div>
				@endif

				<!-- Selection 3 Letter inputs -->
				@if($selection == '3' && $type_selection == 'second')
				<div class="col-span-12 md:col-span-6 lg:col-span-6 cur_letter mt-2">
					<label for="current_letter" class="label"><?=$lang[2]?> (<?=$lang[8]?>):</label>
					<div>
						<select id="current_letter" wire:model="current_letter.0" class="input">
							@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
                  				$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
								optionsList($val,$name,$current_letter[0] ?? 'A+');
							@endphp
						</select>
					</div>
				</div>
				<div class="col-span-12 md:col-span-6 lg:col-span-6 pollard">
					<label for="pollard" class="label"><?=$lang['16']?>:</label>
					<div class="relative">
						<input type="number" step="any" id="pollard" wire:model="pollard.0" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				<div class="col-span-12">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd3">
						@foreach($current_letter as $index => $val)
							@if($index > 0)
								<div class="col-span-12 md:col-span-6 lg:col-span-6">
									<p class="label"><?=$lang[2]?> (<?=$lang[8]?>):</p>
									<select class="input" wire:model="current_letter.{{$index}}">
										<option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option>
										<option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option>
										<option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option>
										<option value="D+">D+</option><option value="D">D</option><option value="D-">D-</option>
										<option value="F">F</option>
									</select>
								</div>
								<div class="col-span-12 md:col-span-6 lg:col-span-6">
									<p class="label"><?=$lang['16']?>:</p>
									<div class="relative">
										<input type="number" step="any" wire:model="pollard.{{$index}}" class="input">
										<span class="absolute right-3 top-3 text-blue">%</span>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				@endif

				<!-- Target Grade for Selection 3 Percentage/Letter tabs -->
				@if($selection == '3')
					@if($type_selection == 'first')
					<div class="col-span-12 md:col-span-6 lg:col-span-6 target_grade2">
						<label for="target_grade2" class="label"><?=$lang['5']?>:</label>
						<div class="relative">
							<input type="number" step="any" id="target_grade2" wire:model="target_grade2" class="input">
							<span class="text-blue input_unit">%</span>
						</div>
					</div>
					@else
					<div class="col-span-12 md:col-span-6 lg:col-span-6 target_grade mt-2">
						<label for="target_letter" class="label"><?=$lang[2]?> (<?=$lang[8]?>):</label>
						<div>
							<select id="target_letter" wire:model="target_letter" class="input">
								@php
									$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
									$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F'];
									optionsList($val,$name,$target_letter);
								@endphp
							</select>
						</div>
					</div>
					@endif

					<!-- Total Weights 2 / Final Exam Weight 2 -->
					<div class="col-span-12 md:col-span-6 lg:col-span-6 total_weights2">
						<label for="total_weight2" class="label"><?=$lang['17']?>:</label>
						<div class="relative">
							<input type="number" step="any" id="total_weight2" wire:model="total_weight2" class="input">
							<span class="text-blue input_unit">%</span>
						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6 final_exam_weight2">
						<label for="final_exam_weight3" class="label"><?=$lang['18']?>:</label>
						<div class="relative">
							<input type="number" step="any" id="final_exam_weight3" wire:model="final_exam_weight3" class="input">
							<span class="text-blue input_unit">%</span>
						</div>
					</div>
				@endif

				<!-- Selection 1 Grading Systems (USA, Canada, GCSE, Australian, India) -->
				@if($selection == '1' && $grading_system == '3')
				<div class="col-span-12 usa">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade3">
								@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade3);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade3">
								@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade3);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				@if($selection == '1' && $grading_system == '4')
				<div class="col-span-12 advanced_usa">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade4">
								@php
								$name =['A','B','C','D','E/F',$lang[24].' (0)'];
								$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade4);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade4">
								@php
								$name =['A','B','C','D','E/F',$lang[24].' (0)'];
								$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade4);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				@if($selection == '1' && $grading_system == '7')
				<div class="col-span-12 australian_schools">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade5">
								@php
								$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
								$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade5);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade5">
								@php
								$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
								$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade5);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				@if($selection == '1' && $grading_system == '8')
				<div class="col-span-12 australian_university">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade6">
								@php
								$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
								$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade6);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade6">
								@php
								$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
								$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade6);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				@if($selection == '1' && $grading_system == '9')
				<div class="col-span-12 india">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade7">
								@php
								$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
								$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade7);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade7">
								@php
								$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
								$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade7);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				@if($selection == '1' && $grading_system == '5')
				<div class="col-span-12 canada">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade8">
								@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
								$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade8);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade8">
								@php
								$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
								$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade8);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				@if($selection == '1' && $grading_system == '6')
				<div class="col-span-12 gcse">
					<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[2]?></p>
							<select class="input" wire:model="current_grade9">
								@php
								$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
								$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
								optionsList($val,$name,$current_grade9);
								@endphp
							</select>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6">
							<p class="label"><?=$lang[5]?></p>
							<select class="input" wire:model="target_grade9">
								@php
								$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
								$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
								optionsList($val,$name,$target_grade9);
								@endphp
							</select>
						</div>
					</div>
				</div>
				@endif

				<!-- Final Exam Weight: Selection 1 & 2 -->
				@if($selection == '1' || $selection == '2')
				<div class="col-span-12 md:col-span-6 lg:col-span-6 final_exam_weight relative">
					<p class="label"><?=$lang[18]?>:</p>
					<input type="number" step="any" wire:model="final_exam_weight" class="input">
					<span class="absolute right-3 top-9 text-blue">%</span>
				</div>
				@endif

				<!-- Grade You Want: Selection 1 under Numbers/Percentage only -->
				@if($selection == '1' && in_array($grading_system, ['1', '2']))
				<div class="col-span-12 md:col-span-6 lg:col-span-6 grade_you_want">
					<label for="final_exam_grade1" class="label"><?=$lang['21']?>:</label>
					<div class="relative">
						<input type="number" step="any" id="final_exam_grade1" wire:model="final_exam_grade1" class="input">
						<span class="text-blue input_unit">%</span>
					</div>
				</div>
				@endif

				<!-- Selection 4 fields -->
				@if($selection == '4')
					<div class="col-span-12 md:col-span-6 lg:col-span-6 grading_system2">
						<label for="grading_system2" class="label"><?=$lang[19]?>:</label>
						<div>
							<select id="grading_system2" wire:model.live="grading_system2" class="input">
								@php
									$name =["Numbers","Percentage","USA Standard","USA (Advance Program)","Canada","GCSE","Australian (Schools)","Australian (University)","India (CCE)"];
									$val = ["1","2","3","4","5","6","7","8","9"];
									optionsList($val,$name,$grading_system2);
								@endphp
							</select>
						</div>
					</div>

					<!-- Selection 4: Numbers/Percentage inputs -->
					@if(in_array($grading_system2, ['1', '2']))
						<div class="col-span-12 md:col-span-6 lg:col-span-6 your_grade_was">
							<label for="grade_was" class="label"><?=$lang['22']?>:</label>
							<div class="relative">
								<input type="number" step="any" id="grade_was" wire:model="grade_was.0" class="input">
								<span class="text-blue input_unit">%</span>
							</div>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6 worth">
							<label for="worth" class="label"><?=$lang['23']?>:</label>
							<div class="relative">
								<input type="number" step="any" id="worth" wire:model="worth.0" class="input">
								<span class="text-blue input_unit">%</span>
							</div>
						</div>
						<div class="col-span-12">
							<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd4">
								@foreach($grade_was as $index => $val)
									@if($index > 0)
										<div class="col-span-12 md:col-span-6 lg:col-span-6">
											<p class="label"><?=$lang['22']?>:</p>
											<div class="relative">
												<input type="number" step="any" wire:model="grade_was.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										</div>
										<div class="col-span-12 md:col-span-6 lg:col-span-6">
											<p class="label"><?=$lang['23']?>:</p>
											<div class="relative">
												<input type="number" step="any" wire:model="worth.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										</div>
									@endif
								@endforeach
							</div>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6 you_want">
							<label for="you_want" class="label"><?=$lang['20']?>:</label>
							<div class="relative">
								<input type="number" step="any" id="you_want" wire:model="you_want" class="input">
								<span class="text-blue input_unit">%</span>
							</div>
						</div>
					@endif

					<!-- Selection 4: Simple USA -->
					@if($grading_system2 == '3')
					<div class="col-span-12 usa_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?>:</p>
								<select class="input" wire:model="c.0"> 
									@php
									$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
									$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
									optionsList($val,$name,$c[0] ?? 'A+');
									@endphp             
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was2.0" class="input">
								<span class="absolute right-3 top-9 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd5">
									@foreach($c as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c.{{$index}}">
													<option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option>
													<option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option>
													<option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option>
													<option value="D+">D+</option><option value="D">D</option><option value="D-">D-</option>
													<option value="F">F</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was2.{{$index}}" class="input">
												<span class="absolute right-3 top-9 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker">
									@php
									$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
									$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif

					<!-- Selection 4: Advanced USA -->
					@if($grading_system2 == '4')
					<div class="col-span-12 advanced_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?></p>
								<select class="input" wire:model="c2.0">
									@php
									$name =['A','B','C','D','E/F',$lang[24].' (0)'];
									$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
									optionsList($val,$name,$c2[0] ?? 'A');
									@endphp
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was3.0" class="input">
								<span class="absolute right-3 top-3 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd6">
									@foreach($c2 as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c2.{{$index}}">
													<option value="A">A</option><option value="B">B</option><option value="C">C</option>
													<option value="D">D</option><option value="E/F">E/F</option><option value="No grade (0)"><?=$lang[24]?> (0)</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was3.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker2">
									@php
									$name =['A','B','C','D','E/F',$lang[24].' (0)'];
									$val = ['A','B','C','D','E/F',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker2);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif

					<!-- Selection 4: Canada -->
					@if($grading_system2 == '5')
					<div class="col-span-12 canada_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?></p>
								<select class="input" wire:model="c3.0">
									@php
									$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
									$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
									optionsList($val,$name,$c3[0] ?? 'A+');
									@endphp
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was4.0" class="input">
								<span class="absolute right-3 top-3 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd7">
									@foreach($c3 as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c3.{{$index}}">
													<option value="A+">A+</option><option value="A">A</option><option value="A-">A-</option>
													<option value="B+">B+</option><option value="B">B</option><option value="B-">B-</option>
													<option value="C+">C+</option><option value="C">C</option><option value="C-">C-</option>
													<option value="D+">D+</option><option value="D">D</option><option value="D-">D-</option>
													<option value="R">R</option><option value="No grade (0)"><?=$lang[24]?> (0)</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was4.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker3">
									@php
									$name =['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
									$val = ['A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','R',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker3);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif

					<!-- Selection 4: GCSE -->
					@if($grading_system2 == '6')
					<div class="col-span-12 gcse_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?></p>
								<select class="input" wire:model="c4.0">
									@php
									$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
									$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
									optionsList($val,$name,$c4[0] ?? 'A*');
									@endphp
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was5.0" class="input">
								<span class="absolute right-3 top-3 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd8">
									@foreach($c4 as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c4.{{$index}}">
													<option value="A*">A*</option><option value="A">A</option><option value="B">B</option>
													<option value="C">C</option><option value="D">D</option><option value="E">E</option>
													<option value="Fail">Fail</option><option value="No grade (0)">No grade (0)</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was5.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker4">
									@php
									$name =['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
									$val = ['A*','A','B','C','D','E','Fail',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker4);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif

					<!-- Selection 4: Australian Schools -->
					@if($grading_system2 == '7')
					<div class="col-span-12 australian_school_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?></p>
								<select class="input" wire:model="c5.0">
									@php
									$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
									$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
									optionsList($val,$name,$c5[0] ?? 'Band6');
									@endphp
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was6.0" class="input">
								<span class="absolute right-3 top-3 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd9">
									@foreach($c5 as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c5.{{$index}}">
													<option value="Band6">Band6</option><option value="Band5">Band5</option><option value="Band4">Band4</option>
													<option value="Band3">Band3</option><option value="Band2">Band2</option><option value="Band1">Band1</option>
													<option value="No grade (0)"><?=$lang[24]?> (0)</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was6.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker5">
									@php
									$name =['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
									$val = ['Band6','Band5','Band4','Band3','Band2','Band1',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker5);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif

					<!-- Selection 4: Australian University -->
					@if($grading_system2 == '8')
					<div class="col-span-12 australian_university_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?></p>
								<select class="input" wire:model="c6.0">
									@php
									$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
									$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
									optionsList($val,$name,$c6[0] ?? 'HD');
									@endphp
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was7.0" class="input">
								<span class="absolute right-3 top-3 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd10">
									@foreach($c6 as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c6.{{$index}}">
													<option value="HD">HD</option><option value="D">D</option><option value="Cr">Cr</option>
													<option value="P">P</option><option value="F">F</option><option value="No grade (0)"><?=$lang[24]?> (0)</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was7.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker6">
									@php
									$name =['HD','D','Cr','P','F',$lang[24].' (0)'];
									$val = ['HD','D','Cr','P','F',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker6);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif

					<!-- Selection 4: India -->
					@if($grading_system2 == '9')
					<div class="col-span-12 india_div">
						<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[22]?></p>
								<select class="input" wire:model="c7.0">
									@php
									$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
									$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
									optionsList($val,$name,$c7[0] ?? 'A1');
									@endphp
								</select>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
								<p class="label"><?=$lang[23]?>:</p>
								<input type="number" step="any" wire:model="grade_was8.0" class="input">
								<span class="absolute right-3 top-3 text-blue">%</span>
							</div>
							<div class="col-span-12">
								<div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 cd11">
									@foreach($c7 as $index => $val)
										@if($index > 0)
											<div class="col-span-12 md:col-span-6 lg:col-span-6">
												<p class="label"><?=$lang[22]?></p>
												<select class="input" wire:model="c7.{{$index}}">
													<option value="A1">A1</option><option value="A2">A2</option><option value="B1">B1</option>
													<option value="B2">B2</option><option value="C1">C1</option><option value="C2">C2</option>
													<option value="D">D</option><option value="E1">E1</option><option value="E2">E2</option>
													<option value="No grade (0)"><?=$lang[24]?> (0)</option>
												</select>
											</div>
											<div class="col-span-12 md:col-span-6 lg:col-span-6 relative">
												<p class="label"><?=$lang[23]?>:</p>
												<input type="number" step="any" wire:model="grade_was8.{{$index}}" class="input">
												<span class="absolute right-3 top-3 text-blue">%</span>
											</div>
										@endif
									@endforeach
								</div>
							</div>
							<div class="col-span-12 md:col-span-6 lg:col-span-6">
								<p class="label"><?=$lang[20]?>..</p>
								<select class="input" wire:model="undertaker7">
									@php
									$name =['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
									$val = ['A1','A2','B1','B2','C1','C2','D','E1','E2',$lang[24].' (0)'];
									optionsList($val,$name,$undertaker7);
									@endphp
								</select>
							</div>
						</div>
					</div>
					@endif
				@endif

				<!-- Dynamic Buttons (wire:click="addField") -->
				@if($selection == '3')
					@if($type_selection == 'first')
					<div class="col-span-12 mt-2" id="btn2">
						<button type="button" wire:click="addField('cd2')" title="Add More Fields" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg"><b><span class="font-s-18">+</span><?=$lang[26]?></b></button>
					</div>
					@else
					<div class="col-span-12 mt-2" id="btn3">
						<button type="button" wire:click="addField('cd3')" title="Add More Fields" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg"><b><span class="font-s-18">+</span><?=$lang[26]?></b></button>
					</div>
					@endif
				@endif

				@if($selection == '4')
					@if(in_array($grading_system2, ['1', '2']))
					<div class="col-span-12 mt-2" id="btn4">
						<button type="button" wire:click="addField('cd4')" title="Add Exam" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg"><b><span class="font-s-18">+</span><?=$lang[27]?></b></button>
					</div>
					@else
					<div class="col-span-12 mt-2" id="btn5">
						<button type="button" wire:click="addField('cd{{ (int)$grading_system2 + 2 }}')" title="Add Exam" class="tagsUnit border p-2 cursor-pointer bg-[#99EA48] rounded-lg"><b><span class="font-s-18">+</span><?=$lang[28]?>2</b></button>
					</div>
					@endif
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

      @if ($detail)
      <hr>
	<div id="result-section" wire:key="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
			<div class="">
					@if ($type == 'calculator')
						@include('inc.copy-pdf')
					@endif
				<div class="w-full mt-3">
					<div class="w-full text-[18px] text-center">
						@if(!empty($detail['subtraction']) && !empty($detail['read']))
							<p class=""><strong>{{ $detail['read'] }}</strong></p>
							<p><span class="text-blue text-[20px]">{{ $lang[29] }} </span> <span class="text-blue text-[20px] my-2">{{ $detail['subtraction'] }}</span> <span class="black-text">%</span>{{ $lang[32] }}</p>
						@endif
						@if(!empty($detail['final_result']))
							<p class="">{{ $lang[33] }}</p>
							<p class="text-blue text-[20px] my-2"><strong>{{ round($detail['final_result'], 2) }}</strong></p>
						@endif
						@if(!empty($detail['fg']))
							@php 
								$method=$detail['method'];
								$cgw=$detail['cgw'];
								$cg=$detail['cg'];
								$fgw=$detail['fgw'];
							@endphp
							<p class="">{{ $lang[33] }}</p>
							<p class="text-blue text-[20px] my-2"><strong>{{ round($detail['fg'],2) }} ({{ $detail['assign'] }} {{ $lang[34] }})</strong></p>
							
							@if($method == '3')
							<div id="tbldiv" class="w-full lg:w-[100%] overflow-auto mt-4">
								<h5 class="text-start mb-2"><b>{{ $lang[35] }}</b></h5>
								<table class="w-full striped" id="tbl2">
									<thead>
										<tr class="bg-gray-100">
											<th class="border-b py-2 text-left px-2">{{ $lang[2] }} (%)</th>
											<th class="border-b py-2 text-left px-2">{{ $lang[15] }} (%)</th>
											<th class="border-b py-2 text-left px-2">{{ $lang[36] }} (%)</th>
										</tr>
									</thead>
									<tbody>
										@for($g = 50; $g <= 100; $g += 5)
											@php
												$grade = (($cgw * $cg) + ($fgw * $g)) / ($fgw + $cgw);
											@endphp
											<tr>
												<td class="border-b py-2 px-2">{{ round($cg, 2) }}</td>
												<td class="border-b py-2 px-2">{{ $g }}</td>
												<td class="border-b py-2 px-2">{{ round($grade, 0) }}</td>
											</tr>
										@endfor
									</tbody>
								</table>
							</div>
							@endif
						@endif
						@if(!empty($detail['Grades']))
							<p class="text-blue text-[20px] my-2">{{ $lang[30] }} {{ $detail['Grades'] }} {{ $lang[31] }}</p>
						@endif
						@if(!empty($detail['fg2']))
							@php 
								$method4=$detail['method4'];
								$cgw2=$detail['cgw2'];
								$cg2=$detail['cg2'];
								$fg2=$detail['fg2'];
								$difference=$detail['difference'];
								$gpas = [0.67, 1.00, 1.33, 1.67, 2.00, 2.33, 2.67, 3.00, 3.33, 3.67, 4.00, 4.33];
							@endphp
							<p class="">{{ $lang[33] }}</p>
							<p class="text-blue text-[20px] my-2"><strong>{{ round($detail['fg2'], 2) }} ({{ $detail['assign_grade'] }} {{ $lang[34] }})</strong></p>
							@if($method4 == '4')
							<div class="w-full lg:w-[100%] overflow-auto mt-4">
								<p class="asad text-start mb-2"><b>{{ $lang[35] }}</b></p>
								<table class="w-full striped" id="tbl2">
									<thead>
										<tr class="bg-gray-100">
											<th class="border-b py-2 text-left px-2">{{ $lang[2] }} (%)</th>
											<th class="border-b py-2 text-left px-2">{{ $lang[15] }} (%)</th>
											<th class="border-b py-2 text-left px-2">{{ $lang[36] }} (%)</th>
										</tr>
									</thead>
									<tbody>
										@foreach($gpas as $g)
											@php
												$grade = ($cgw2 * $cg2 + $difference * $g) / ($cgw2 + $difference);
											@endphp
											<tr>
												<td class="border-b py-2 px-2">{{ $this->getLetterFromGPA($cg2) }}</td>
												<td class="border-b py-2 px-2">{{ $this->getLetterFromGPA($g) }}</td>
												<td class="border-b py-2 px-2">{{ $this->getLetterFromGPA($grade) }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
						@endif 
						@if(!empty($detail['nawaz']))
							@if($detail['nawaz']=="CONGRATULATIONS!!\nNo matter what you do, you will get your desired grade or higher!\nJust check the requirements of your particular subject" || $detail['nawaz']=="I am sorry, but with your current grades it is impossible to get the grade you want.")
								<p><span class="text-blue text-[20px] my-2">{{ $detail['nawaz'] }}</span></p>  
							@else
								<p><span class="text-blue text-[20px] my-2">{{ $lang[30] }}</span> <span class="text-blue text-[20px] my-2">{{ $detail['nawaz'] }}</span> {{ $lang[31] }} </p>
							@endif
						@endif
						@if(isset($detail['final10']) && isset($detail['final11']))
							@php
								$val11 = $detail['final11'];
								$isMessage = false;
								if (is_string($val11) && (
									str_contains(strtolower($val11), 'congratulations') || 
									str_contains(strtolower($val11), 'sorry') || 
									str_contains(strtolower($val11), 'impossible')
								)) {
									$isMessage = true;
								}
							@endphp
							@if($isMessage)
								<p><span class="text-blue text-[20px] my-2">{!! $val11 !!}</span></p>
							@else
								<p><span>{{ $lang[30] }}</span> <span class="text-blue text-[20px] my-2"><strong>{{ is_numeric($val11) ? round($val11, 2) : $val11 }}</strong></span> {{ $lang[31] }} </p>
							@endif
							<p><span>{{ $lang[29] }} </span> <span class="text-blue text-[20px] my-2"><strong>{{ $detail['final10'] }}</strong></span> <span class="black-text">%</span> {{ $lang[32] }}</p>
						@endif
					</div>
				
				</div>
			</div>
		</div>
	
    @endif
</form>
</div>
