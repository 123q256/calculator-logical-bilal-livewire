<style>
	ul li{
		list-style: none;
	}
	.gap-6{
		gap: 8px
	}
	.gpa_knob {
		width: 210px;
		height: 210px;
		margin: 0px auto;
		border-radius: 100%;
		padding-top: 10px;
		position: relative;
		background-color: #eaf5fa85;
	}
	.inner_knob, .inner_knob1 {
		width: 215px;
		border-radius: 100%;
		margin: 0px auto;
		background: #B71919;
		height: 180px;
		padding-top: 30px;
	}.z-depth-1 {
		box-shadow: 0 0 6px 3px var(--shadowClr) !important;
	}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
		   <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
			<input type="hidden" name="unit_type" id="unit_type" value="uk">
			<div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
				<div class="lg:w-1/2 w-full px-2 py-1">
					<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial tab"  type="1" id="tab2">
							{{ $lang['1'] }}
					</div>
				</div>
				<div class="lg:w-1/2 w-full px-2 py-1">
					<div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric tab"  type="1" id="tab1">
							{{ $lang['2'] }}
					</div>
				</div>
			</div>
		</div>

			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

				<div class="col-span-12 row radius-5 border p-2 mt-3">
		        	<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 current_gpa cursor-pointer">
							<strong class="font_size16 col s8 padding_0"> {{$lang['26']}} {{$lang['4']}}</strong>
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6 current_input">
							<p class="text-blue font-s-14 mb-1"><?=$lang['3']?></p>
							<input type="number" step="any" min="1" max="5" id="c_gpa" class="input" placeholder="0.0">
						</div>
						<div class="col-span-12 md:col-span-6 lg:col-span-6 current_input">
							<p class="text-blue font-s-14 mb-1"><?=$lang['5']?></p>
							<input type="number" step="any" min="1" id="c_credit" class="input" placeholder="0.0">
						</div>
					</div>
				</div>
				<div class="col-span-12">
					<ul class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4 semester mt-3 border p-2 radius-5">
						<li class="col-span-12">
							<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
								<div class="col-span-8 left">
									<strong class="heading_on_mbl">Semester 1</strong>
								</div>
								<div class="col-span-4 flex" style="position: relative;">
									<strong class="col grade_format">Grade Format: <span class="grade_text black-text" type="1">Letter</span></strong>
										<div class="grade_format ">
											<img src="<?=asset('images/angle_down1.png')?>" alt="gpa" width="12" height="12" class="">
										</div>
									<div class="z-depth-3 grade_type" style="display: none;">
										<div class="color_blue gray_border_bottom">
											<strong>Grade Format</strong>
										</div>
										<div class="gray_border_bottom" type="1">
											<img src="<?=asset('images/letter.png')?>" alt="Grade Format Letter" width="20" height="20">
											<p>Letter</p>
										</div>
										<div class="gray_border_bottom" type="2">
											<img src="<?=asset('images/percentage.png')?>" alt="Grade Format Percentage" width="20" height="20">
											<p>Percentage</p>
										</div>
										<div class="gray_border_bottom" type="3">
											<img src="<?=asset('images/point.png')?>" class="object-contain" alt="Grade Format Point Value" width="20" height="20">
											<p>Point Value</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<strong class="col text-blue">{{ $lang['course']}}</strong>
								<strong class="col text-blue">{{ $lang['credit']}}</strong>
								<strong class="col text-blue">{{ $lang['grade']}}</strong>
								<strong class="col text-blue">{{ $lang['type']}}</strong>
							</div>
							<div class="row border-b  papa_g m_t_n_10 pb-2" id="accept_row1">
								<ul class="get_html">
								
								</ul>
								<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
									<div class="col-span-6 text-left">
										<button type="button" title="Add New Course" class="tagsUnit p-3 border radius-5 cursor-pointer add_course bg-[#2845F5] text-white rounded-lg "><b class="">+ <?=$lang['add_course']?></b></button>
									</div>
									<div class="col-span-6 text-end">
										<button type="button" title="Add New Semester" class="tagsUnit p-3 border radius-5 cursor-pointer add_semester bg-[#2845F5] text-white rounded-lg "><b class="">+ <?=$lang['add_semester']?></b></button>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>

				<div class="col-span-12 row flex justify-center my-3">
					<div class="col-4">
						<button onclick="calculate()" class="calculatef calculate bg-[#2845F5] text-white rounded-lg p-3">{{$lang['calculate']}}</button>
					</div>
				</div>
			</div>

			<div class="col-span-12 bg-light-blue result result1 result_calculator p-3 rounded-lg mt-3 hidden my-3">
				<div class="w-full mx-auto p-4 lg:p-8 md:p-8  rounded-lg  space-y-6 ">
					<div class="">
							@if ($type == 'calculator')
								@include('inc.copy-pdf')
							@endif
						<div class="rounded-lg  flex items-center justify-center">
			
							<div class="w-full">
								<div id="addClass" class="">
									<div class="knob-container text-center z-depth-1 my-2 gpa_knob">
										<div class="inner_knob text-white font-s-32">
											<p class=""><b class="final_cpga text-whiite">0.00</b></p>
											<p><strong class="text-whiite"><?=$lang['cum']?></strong></p>
											<strong class="text-whiite"><?=$lang['10']?></strong>
										</div>
									</div>
									<p class="w-full text-center mb-2 mt-3"><strong><?=$lang['total_g']?> = <span class="black-text font-s-20 total_g">0.0</span></strong></p>
									<p class="w-full text-center border_bottom"><strong><?=$lang['total_h']?> = <span class="black-text font-s-20 total_h">0.0</span></strong></p>
									<ul class="semester_res">
										<li class="semester1">
											<strong class="text-blue text-[25px]"><?=$lang['semester']?> 1</strong>
											<table class="w-full text-center text-[18px]">
												<thead>
													<tr class="lighten-4">
														<td class="text-blue border-b py-2"><strong><?=$lang['course']?></strong></td>
														<td class="text-blue border-b py-2"><strong><?=$lang['grade']?></strong></td>
														<td class="text-blue border-b py-2"><strong><?=$lang['credit']?></strong></td>
														<td class="text-blue border-b py-2"><strong><?=$lang['11']?></strong></td>
													</tr>
												</thead>
												<tbody class="table1">
													<tr>
														<td class="border-b py-2 1subject1">Course 1</td>
														<td class="border-b py-2 1grade1">0.0</td>
														<td class="border-b py-2 1credit1">0.0</td>
														<td class="border-b py-2 1tgrade1">0.0</td>
													</tr>
													<tr>
														<td class="border-b py-2 1subject2">Course 2</td>
														<td class="border-b py-2 1grade2">0.0</td>
														<td class="border-b py-2 1credit2">0.0</td>
														<td class="border-b py-2 1tgrade2">0.0</td>
													</tr>
													<tr>
														<td class="border-b py-2 1subject3">Course 3</td>
														<td class="border-b py-2 1grade3">0.0</td>
														<td class="border-b py-2 1credit3">0.0</td>
														<td class="border-b py-2 1tgrade3">0.0</td>
													</tr>
												</tbody>
												<tfoot>
													<tr class="bg-sky text-center lighten-4">
														<td class="border-b py-2" colspan="2"><strong><?=$lang['12']?></strong></td>
														<td colspan="2" class="border-b py-2 "><strong class=" hour1">0.0</strong></td>
													</tr>
													<tr class="bg-sky text-center lighten-4">
														<td class="border-b py-2 " colspan="2"><strong><?=$lang['10']?></strong></td>
														<td colspan="2" class="border-b py-2 "><strong class=" gpa1">0.0</strong></td>
													</tr>
												</tfoot>
											</table>
										</li>
									</ul>
								</div>
							</div>
			
						</div>
					</div>
				</div>

			</div>


	       <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

				<div class="col-span-12 row border py-4  px-3 mt-3">
					<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
					<div class="col-span-12 text-center">
						<p ><b>{{$lang['25']}}</b></p>
						<p >{{$lang['20']}}</p>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<label for="p_gpas" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
						<div class="w-full py-2 relative">
							<input type="number" id="p_gpas" step="any"  min="1" max="5" value="3"class="input p_gpa"  placeholder="0.0"  />
						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<label for="p_hours" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
						<div class="w-full py-2 relative">
							<input type="number" id="p_hours" step="any"  min="1" max="5" value="3"class="input p_hour"  placeholder="0.0"  />
						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<label for="tgpas" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
						<div class="w-full py-2 relative">
							<input type="number" id="tgpas" step="any"  min="1" max="5" value="3"class="input tgpa"  placeholder="0.0"  />
						</div>
					</div>
					<div class="col-span-12 md:col-span-6 lg:col-span-6">
						<label for="thours" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
						<div class="w-full py-2 relative">
							<input type="number" id="thours" step="any"  min="1" max="5" value="1"class="input thour"  placeholder="0.0"  />
						</div>
					</div>
					<div class="col-span-12 flex justify-content-center">
						<div class="col-4 mt-3">
						<button  class="white-text btn-small  calculatep calculate bg-[#2845F5] text-white rounded-lg p-3">{{$lang['calculate']}}</button>
						</div>
					</div>
					</div>
				</div>
			</div>
			<div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 resultp result hidden">
					<div class="">
							@if ($type == 'calculator')
								@include('inc.copy-pdf')
							@endif
						<div class="rounded-lg  flex items-center justify-center">
							
							<div class="col-12 bg-light-blue result  p-3 radius-10 mt-3 ">
								<p class="col s12 text-center ">
									{{ $lang['21']}} <b class="tgpa">3.4</b>,
									{{ $lang['22']}} <b class="thour">16</b>
									{{ $lang['23']}} <b class="">3.963</b>
									{{ $lang['24']}}</p>
								<div class="col s12 padding_0">
									<div class="knob-container center z-depth-1 gpa_knob">
										<div class="inner_knob1 white-text">
											<p class="text-center font-s-20 mt-3"><strong class="text-white">{{ $lang['res']}}</strong></p>
											<p class="text-center font-s-20"><b class="t_cpga text-white">3.963</b></p>
											<p class="text-center font-s-20"><b class="text-white">{{$lang['10']}}</b></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		
		@if ($type=='widget')
		@include('inc.widget-button')
		@endif
	</div>
	
</form>
@push('calculatorJS')
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
	function calculate(){
		var total_grade=parseFloat(0);
		var total_hour=parseFloat(0);
		var total_gpa=parseFloat(0);
		var semester=$('.semester').children().length;
		var type=$('.grade_text').attr('type');
		var c_type=$('.tab').attr('type');


		for (var k = 1; k <=semester; k++) {
			var s_grade=parseFloat(0);
			var s_hour=parseFloat(0);
			var len=$('#accept_row'+k+' .get_html').children().length;
			var table='';

		
			for (var m = 1; m <= len; m++) {
				var grade=$('#'+k+'grade'+m).val();
				var hour=$('#'+k+'cradits'+m).val();
				var subject=$('#'+k+'subject'+m).val();
				var widget=$('#'+k+'weight'+m).val();
				if (type=='1') {
					if (grade!=null && hour!=null) {
						if (c_type=='1') {
							grade=parseFloat(grade) + parseFloat(widget);
						}
						if (subject=='') {
							subject="<?=$lang['course']?> "+m;
						}
						table+='<tr><td class="border-b px-2">'+subject+'</td><td class="border-b px-2">'+grade+'</td><td class="border-b px-2">'+hour+'</td><td class="border-b px-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
					}
				}
				var grade=$('#'+k+'percent'+m).val();
				if (type=='2') {
					if (grade!=null && hour!=null) {
						if (grade<65) {
							grade=0.0;
						}else if (grade>=65 && grade<=66) {
							grade=1.0;
						}else if (grade>=67 && grade<=69) {
							grade=1.3;
						}else if (grade>=70 && grade<=72) {
							grade=1.7;
						}else if (grade>=73 && grade<=76) {
							grade=2.0;
						}else if (grade>=77 && grade<=79) {
							grade=2.3;
						}else if (grade>=80 && grade<=82) {
							grade=2.7;
						}else if (grade>=83 && grade<=86) {
							grade=3.0
						}else if (grade>=87 && grade<=89) {
							grade=3.3;
						}else if (grade>=90 && grade<=92) {
							grade=3.7;
						}else if (grade>=93 && grade<=100) {
							grade=4.0;
						}
						if (c_type=='1') {
							grade=grade + parseFloat(widget);
						}
						if (subject=='') {
							subject="<?=$lang['course']?> "+m;
						}
						table+='<tr><td class="border-b px-2">'+subject+'</td><td class="border-b px-2">'+grade+'</td><td class="border-b px-2">'+hour+'</td><td class="border-b px-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
					}
				}
				var grade=$('#'+k+'point'+m).val();
				if (type=='3') {
					if (grade!=null && hour!=null) {
						if (c_type=='1') {
							grade=grade + parseFloat(widget);
						}
						if (subject=='') {
							subject="<?=$lang['course']?> "+m;
						}
						table+='<tr><td class="border-b px-2">'+subject+'</td><td class="border-b px-2">'+grade+'</td><td class="border-b px-2">'+hour+'</td ><td class="border-b px-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
					}
				}
			}
			if (s_grade!=0) {
				$('.table'+k).html(table);
				var gpa= (s_grade / s_hour).toPrecision(3);
				total_gpa=total_gpa + parseFloat(gpa);
				total_grade=total_grade + parseFloat(s_grade);
				total_hour=total_hour + parseFloat(s_hour);
				var current_gpa=$('#c_gpa').val();
				var current_hour=$('#c_credit').val();
				if (current_gpa!='' && current_hour!='') {
					var c_grade= current_hour * current_gpa;
					total_grade=total_grade + parseFloat(c_grade);
					total_hour=total_hour + parseFloat(current_hour);
				}
				$('.grade'+k).text((s_grade).toFixed(2));
				$('.hour'+k).text(s_hour);
				$('.gpa'+k).text(gpa);
				var cgpa=(total_grade / total_hour).toPrecision(3);
				if (cgpa>=3.5) {
					$('.inner_knob').css('background','#13699E');
				}
				if (cgpa>2.9 && cgpa<3.5) {
					$('.inner_knob').css('background','#54B725');
				}
				$('.final_cpga').text(cgpa);
				$('.total_h').text(total_hour);
				$('.total_g').text((total_grade).toFixed(2));
			}
		}
	}
	$(document).ready(function(){
	
		$('.calculatep').click(function(){
			event.preventDefault();
			var p_gpa=parseFloat($('.p_gpa').val());
			var p_hour=parseFloat($('.p_hour').val());
			var tgpa=parseFloat($('.tgpa').val());
			var thour=parseFloat($('.thour').val());
			var t_cpga= (((tgpa * (p_hour + thour)) - (p_gpa * p_hour)) / thour).toPrecision(4);
			$('.tgpa').text(tgpa);
			$('.thour').text(thour);
			if (t_cpga>=3.5) {
				$('.inner_knob1').css('background','#13699E');
			}
			if (t_cpga>2.9 && t_cpga<3.5) {
				$('.inner_knob1').css('background','#54B725');
			}
			$('.resultp').css('display','block');
				$('body,html').animate({
					scrollTop: $('.resultp').offset().top
				},1000)
			$('.t_cpga').text(t_cpga);
		})

		$('.current_gpa').click(function(){
			$('.current_input').slideToggle('fast');
			$('.current_gpa img').toggleClass('rotate');
		})
		$('.calculatef').click(function(){
			event.preventDefault();

			var final_cpga=$('.final_cpga').text();
			// alert(final_cpga)
			if (final_cpga>0 && final_cpga <=5) {
				$('.result1').css('display','block');
				$('body,html').animate({
					scrollTop: $('.result1').offset().top
				},1000)
			}else{
				alert("Please fill required fields.");
			}
		})
	
		$('.grade_type div').click(function(){
			var text=$(this).attr('type');
			if (text=='1') {
				$('.grade_text').text('<?=$lang['7']?>');
				$('.grade_text').attr('type','1');
				$('.letter').css('display','block');
				$('.percentage').css('display','none');
				$('.point').css('display','none');
			}
			if (text=='2') {
				$('.grade_text').text('<?=$lang['8']?>');
				$('.grade_text').attr('type','2');
				$('.letter').css('display','none');
				$('.percentage').css('display','block');
				$('.point').css('display','none');
			}
			if (text=='3') {
				$('.grade_text').text('<?=$lang['9']?>');
				$('.grade_text').attr('type','3');
				$('.letter').css('display','none');
				$('.percentage').css('display','none');
				$('.point').css('display','block');
			}
			$('.grade_type').slideToggle('fast');
			$('.grade_format img').toggleClass('rotate');
		});
		$('.grade_format').click(function(){
			$('.grade_type').slideToggle('fast');
			$('.grade_format img').toggleClass('rotate');
		})
		$(document).on('click','#tab1',function(){
			$('.tab').attr('type','2');
			$('#tab1').addClass('tagsUnit');
			$('#tab2').removeClass('tagsUnit');
			$('.gpa_weight .select-wrapper input.select-dropdown').attr('disabled','disabled');
		});
		$(document).on('click','#tab2',function(){
			$('.tab').attr('type','1');
			$('#tab1').removeClass('tagsUnit');
			$('#tab2').addClass('tagsUnit');
			$('.gpa_weight .select-wrapper input.select-dropdown').removeAttr("disabled");
		});
		$(document).on('click','.mbl_remove',function(){
				$(this).parents('.get_html li').remove();
				i--;
		});
		$(document).on('click','.remove',function(){
				$(this).parents('.get_html li').remove();
				i--;
		});
		var j=1;
		$(document).on('click','.add_semester',function(){
			$(this).hide();
			j++;
			add_semester(j);
			semester_res(j);
			add_fields(1,j);
			add_fields(2,j);
			add_fields(3,j);
          
			var type=$('.grade_text').attr('type');
			if (type=='1') {
				$('.letter').css('display','block');
				$('.percentage').css('display','none');
				$('.point').css('display','none');
			}
			if (type=='2') {
				$('.letter').css('display','none');
				$('.percentage').css('display','block');
				$('.point').css('display','none');
			}
			if (type=='3') {
				$('.letter').css('display','none');
				$('.percentage').css('display','none');
				$('.point').css('display','block');
			}
			if ($('.tab').attr('type')=="2") {
				$('.gpa_weight .select-wrapper input.select-dropdown').attr('disabled','disabled');
			} else {
				$('.gpa_weight .select-wrapper input.select-dropdown').removeAttr("disabled");
			}
		});
		var i=3;
		$(document).on('click','.add_course',function(){
			var id=$(this).parents('.papa_g').attr('id');
			var len=$('#'+id+' .get_html').children().length;
			var id_=id.split('w');
			++len;
			add_fields(len,id_[1]);
			var type=$('.grade_text').attr('type');
			if (type=='1') {
				$('.letter').css('display','block');
				$('.percentage').css('display','none');
				$('.point').css('display','none');
			}
			if (type=='2') {
				$('.letter').css('display','none');
				$('.percentage').css('display','block');
				$('.point').css('display','none');
			}
			if (type=='3') {
				$('.letter').css('display','none');
				$('.percentage').css('display','none');
				$('.point').css('display','block');
			}
          
			if ($('.switch').attr('switch')=="off") {
				$('.gpa_weight .select-wrapper input.select-dropdown').attr('disabled','disabled');
			} else {
				$('.gpa_weight .select-wrapper input.select-dropdown').removeAttr("disabled");
			}
		});
        @if(isset($_POST['img_form']) && $_POST['img_form']=="png")
		 	$(document).on('click','#tab1',function(){
				$('.tab').attr('type','2');
				$('.gpa_weight select').attr('disabled','disabled');
			});
			$(document).on('click','#tab2',function(){
				console.log("sdgf");
				$('.tab').attr('type','1');
				$('.gpa_weight select').removeAttr("disabled");
			});
		@endif
		$(document).on('click','.close',function(){
			if (j!=0) {
				$(this).parents('.semester li').remove();
				j--;
			}
		});
		function add_fields(counter,id){
            @if(isset($_POST['img_form']) && $_POST['img_form']=="png")
		 	$('select').addClass('input');
            @endif
			;
			var html='<li class="flex gap-6 mt-2" style="position: relative;">		<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">'+
					        '<div class="col-span-3 ">'+
					          '<input type="text" id="'+id+'subject'+counter+'" class="input" placeholder="<?=$lang['13']?>">'+
					        '</div>'+
					        '<div class="col-span-2 ">'+
					          '<select id="'+id+'cradits'+counter+'" class="input">'+
							      	'<option value="" selected disabled><?=$lang['credit']?></option>'+
							      	'<option value="1">1</option>'+
							      	'<option value="1.5">1.5</option>'+
		                            '<option value="2">2</option>'+
		                            '<option value="2.5">2.5</option>'+
		                            '<option value="3">3</option>'+
		                            '<option value="3.5">3.5</option>'+
		                            '<option value="4">4</option>'+
		                            '<option value="4.5">4.5</option>'+
		                            '<option value="5">5</option>'+
						      	'</select>'+
					        '</div>'+
					        '<div class="col-span-3  letter">'+
					        	'<select id="'+id+'grade'+counter+'" class="grade input">'+
							      	'<option value="" selected disabled><?=$lang['grade']?> A-F</option>'+
							      	'<option value="4.0">A+</option>'+
									'<option value="4.0">A</option>'+
									'<option value="3.7">A-</option>'+
									'<option value="3.3">B+</option>'+
									'<option value="3.0">B</option>'+
									'<option value="2.7">B-</option>'+
									'<option value="2.3">C+</option>'+
									'<option value="2.0">C</option>'+
									'<option value="1.7">C-</option>'+
									'<option value="1.3">D+</option>'+
									'<option value="1.0">D</option>'+
									'<option value="0.7">D-</option>'+
									'<option value="0.0">F</option>'+
						      	'</select>'+
					        '</div>'+
					        '<div class="col-span-2 hidden point">'+
					        	'<input id="'+id+'point'+counter+'" type="number" max="5" min="0" step="any" class="input" placeholder="<?=$lang['grade']?> 0.0">'+
					        '</div>'+
					        '<div class="col-span-2 hidden percentage">'+
					        	'<input id="'+id+'percent'+counter+'" type="number" max="100" min="0" step="any" class="input" placeholder="<?=$lang['grade']?> %">'+
					        '</div>'+
					        '<div class="input-field col-span-3 flex items-center m3 s3 margin_top_10 gpa_weight">'+
					        	'<select id="'+id+'weight'+counter+'" class="input">'+
					        	  '<option value="0.0" selected><?=$lang['14']?></option>'+
							      '<option value="0.5"><?=$lang['15']?></option>'+
							      '<option value="1.0"><?=$lang['16']?></option>'+
							      '<option value="1.0"><?=$lang['17']?></option>'+
					        	'</select>'+
								'</div>'+
					        	'<div class="flex items-center"><img src="<?=asset('images/close.png')?>" alt="GPA Remove Course" class="remove right object-contain" width="16px" height="16px"></div></div>'+
				   		'</li>';
			$('#accept_row'+id+' ul').append(html);
			
            @if(isset($_POST['img_form']) && $_POST['img_form']=="png")
		 	$('select').addClass('input');
            @endif
			;
		}
		add_fields(1,1);
		add_fields(2,1);
		add_fields(3,1);
		add_fields(4,1);
		function semester_res(id){
			var html='<li class=" semester'+id+'">'+
				'<strong class="text-blue text-[25px] mt-2 "><?=$lang['semester']?> '+id+'</strong>'+
				'<table class="w-full text-center text-[18px]">'+
					'<thead>'+
						'<tr class="grey lighten-4">'+
							'<td class="border-b py-2"><strong><?=$lang['course']?></strong></td>'+
							'<td class="border-b py-2"><strong><?=$lang['grade']?></strong></td>'+
							'<td class="border-b py-2"><strong><?=$lang['credit']?></strong></td>'+
							'<td class="border-b py-2"><strong><?=$lang['11']?></strong></td>'+
						'</tr>'+
					'</thead>'+
					'<tbody class="table'+id+'">'+
						'<tr>'+
							'<td class="border-b py-2 1subject1"><?=$lang['course']?> 1</td>'+
							'<td class="border-b py-2 1grade1">0.0</td>'+
							'<td class="border-b py-2 1credit1">0.0</td>'+
							'<td class="border-b py-2 1tgrade1">0.0</td>'+
						'</tr>'+
						'<tr>'+
							'<td class="border-b py-2 1subject2"><?=$lang['course']?> 2</td>'+
							'<td class="border-b py-2 1grade2">0.0</td>'+
							'<td class="border-b py-2 1credit2">0.0</td>'+
							'<td class="border-b py-2 1tgrade2">0.0</td>'+
						'</tr>'+
						'<tr>'+
							'<td class="border-b py-2 1subject3"><?=$lang['course']?> 3</td>'+
							'<td class="border-b py-2 1grade3">0.0</td>'+
							'<td class="border-b py-2 1credit3">0.0</td>'+
							'<td class="border-b py-2 1tgrade3">0.0</td>'+
						'</tr>'+
					'</tbody>'+
					'<tfoot>'+
						'<tr class="bg-white text-center lighten-4">'+
							'<td class="py-2  " colspan="2"><strong><?=$lang['12']?></strong></td>'+
							'<td colspan="2"><strong class="py-2  hour1">0.0</strong></td>'+
						'</tr>'+
						'<tr class="bg-white text-center lighten-4">'+
							'<td class="py-2 " colspan="2"><strong><?=$lang['10']?></strong></td>'+
							'<td colspan="2"><strong class="py-2  gpa1">0.0</strong></td>'+
						'</tr>'+
					'</tfoot>'+
				'</table>'+
			'</li>';
			$('.semester_res').append(html);
		}
		function add_semester(count){
			var semester='<li class="col-span-12">'+
						'<div class="row my-3">'+
							'<div class="col m3 s5 left">'+
								'<strong class="font_size20 heading_on_mbl color_blue"><?=$lang['semester']?> '+count+'</strong>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<strong class="col text-blue">{{ $lang['course']}}</strong>'+
							'<strong class="col text-blue">{{ $lang['credit']}}</strong>'+
							'<strong class="col text-blue">{{ $lang['grade']}}</strong>'+
							'<strong class="col text-blue">{{ $lang['type']}}</strong>'+
						'</div>'+
					      '<div class="row papa_g m_t_n_10" id="accept_row'+count+'">'+
							'<ul class="get_html">'+
					   		'</ul>'+

							   '<div class="row mt-2">'+
							'<div class="col-6 text-left">'+
								'<button type="button" title="Add New Course" class="tagsUnit p-2 border radius-5 cursor-pointer add_course bg-[#2845F5] rounded-lg"><b class="">+ <?=$lang['add_course']?></b></button>'+
							'</div>'+
							'<div class="col-6 text-end">'+
								'<button type="button" title="Add New Semester" class="tagsUnit p-2 border radius-5 cursor-pointer add_semester  bg-[#2845F5] rounded-lg"><b class="">+ <?=$lang['add_semester']?></b></button>'+
							'</div>'+
						'</div>'+
				   '</li>';
				$('.semester').append(semester);
		}
	});
</script>
@endpush
