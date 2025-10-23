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
	   <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

				<div class="col-span-12 row radius-5 border p-2 mt-3">
		        	<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
						<div class="col-span-12 current_gpa cursor-pointer">
							<strong class="font_size16 col s8 padding_0"><?=$lang['14']?> <?=$lang['4']?></strong>
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
			<div class="col-span-12 ">
				<ul class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4 semester mt-3 border p-2 radius-5">
					<li class="col-span-12">
						<div class="row mb-2">
							<div class="col-12 left">
								<strong class="font-s-20 heading_on_mbl"><?=$lang['semester']?> 1</strong>
							</div>
						</div>
						<div class="row">
							<strong class="col text-blue"><?=$lang['course']?></strong>
							<strong class="col text-blue"><?=$lang['credit']?></strong>
							<strong class="col text-blue"><?=$lang['grade']?></strong>
						</div>
						<div class="row border-b border_bottom m_t_n_10 pb-2" id="accept_row1">
							<ul class="get_html">
							
							</ul>
							<div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4 row mt-2">
								<div class="col-span-6 text-left">
									<button type="button" title="Add New Course" class="units_active  border radius-5 cursor-pointer add_course bg-[#2845F5] text-white rounded-lg p-3"><b class="">+ <?=$lang['add_course']?></b></button>
								</div>
								<div class="col-span-6 text-end">
									<button type="button" title="Add New Semester" class="units_active  border radius-5 cursor-pointer add_semester bg-[#2845F5] text-white rounded-lg p-3"><b class="">+ <?=$lang['add_semester']?></b></button>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="col-span-12 text-center mt-3">
				<button onclick="calculate()" class="calculate bg-[#2845F5] text-white rounded-lg p-3">{{ $lang['calculate'] }}</button>
			</div>

		</div>
	</div>
	@if ($type=='widget')
	@include('inc.widget-button')
	 @endif
 </div>

 <div class="w-full mx-auto p-4 lg:p-8 md:p-8  rounded-lg shadow-md space-y-6 result hidden result_calculator" id="printThis">
	<div class="">
			@if ($type == 'calculator')
				@include('inc.copy-pdf')
			@endif
		<div class="rounded-lg  flex items-center justify-center">
			<div class="w-full bg-light-blue  mt-3 " >
				<div class="w-full">
					<div id="addClass" class="">
						<div class="knob-container text-center z-depth-1 my-2 gpa_knob">
							<div class="inner_knob text-white font-s-32">
								<p class=""><b class="final_cpga">0.00</b></p>
								<p><strong class=""><?=$lang['cum']?></strong></p>
								<strong class=""><?=$lang['10']?></strong>
							</div>
						</div>
						<p class="w-full text-center mb-2 mt-3"><strong><?=$lang['total_g']?> = <span class="black-text font-s-20 total_g">0.0</span></strong></p>
						<p class="w-full text-center border_bottom"><strong><?=$lang['total_h']?> = <span class="black-text font-s-20 total_h">0.0</span></strong></p>
						<ul class="semester_res">
							<li class="semester1">
								<strong class="text-blue font-s-25"><?=$lang['semester']?> 1</strong>
								<table class="w-full text-center font-s-18">
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


</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@push('calculatorJS')
	<script>
		function calculate(){
			var total_grade=parseFloat(0);
			var total_hour=parseFloat(0);
			var total_gpa=parseFloat(0);
			var semester=$('.semester').children().length;
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
					if (grade!=null && hour!=null) {
						if (subject=='') {
							subject="Course "+m;
						}
						table+='<tr><td class="border-b py-2">'+subject+'</td><td class="border-b py-2">'+grade+'</td><td class="border-b py-2">'+hour+'</td><td class="border-b py-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
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
			$('.current_gpa').click(function(){
				$('.current_input').slideToggle('fast');
				$('.current_gpa img').toggleClass('rotate');
			})
			$('.calculate').click(function(){
				event.preventDefault();
				var final_cpga=$('.final_cpga').text();
				if (final_cpga>0 && final_cpga <=5) {
					$('#printThis').css('display','block');
					$('body,html').animate({
						scrollTop: $('#printThis').offset().top
					},1000)
				}else{
					alert("Please fill required fields.");
				}
			});
			$('.grade_type div').click(function(){
				var text=$(this).attr('type');
				if (text=='1') {
					$('.grade_text').text('Letter');
					$('.grade_text').attr('type','1');
					$('.letter').css('display','block');
					$('.percentage').css('display','none');
					$('.point').css('display','none');
				}
				if (text=='2') {
					$('.grade_text').text('Percentage');
					$('.grade_text').attr('type','2');
					$('.letter').css('display','none');
					$('.percentage').css('display','block');
					$('.point').css('display','none');
				}
				if (text=='3') {
					$('.grade_text').text('Point Value');
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
				$('.gpa_weight .select-wrapper input.select-dropdown').attr('disabled','disabled');
			});
			$(document).on('click','#tab2',function(){
				$('.tab').attr('type','1');
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
				var id=$(this).parents('.border_bottom').attr('id');
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
				
			});

			$(document).on('click','.close',function(){
				if (j!=0) {
					$(this).parents('.semester li').remove();
					j--;
				}
			});

			function add_fields(counter,id){
				var html=
					`<li class="grid grid-cols-12 flex gap-6 mt-2">
						<div class="col-span-4">
							<input type="text" id="${id}subject${counter}" class="input" placeholder="<?=$lang['13']?>">
						</div>
						<div class="col-span-4">
							<input type="number" step="any" min="1" id="${id}cradits${counter}"  class="input" placeholder="Credit">
						</div>
						<div class="col-span-3 gpa_weight">
							<select id="${id}grade${counter}" class="grade input">
								<option value="" selected disabled><?=$lang['grade']?></option>
								<option value="4.0">A+</option>
								<option value="4.0">A</option>
								<option value="3.7">A-</option>
								<option value="3.3">B+</option>
								<option value="3.0">B</option>
								<option value="2.7">B-</option>
								<option value="2.3">C+</option>
								<option value="2.0">C</option>
								<option value="1.7">C-</option>
								<option value="1.3">D+</option>
								<option value="1.0">D</option>
								<option value="0.7">D-</option>
								<option value="0.0">F</option>
							</select>
						</div>
						<div class="col-span-1 flex items-center">
					    	<img src="<?=url('images/close.png')?>" alt="GPA Remove Course" class="remove right" width="15px" height="15px">
						</div>
					</li>`;
				$('#accept_row'+id+' ul').append(html);
				
			}
			add_fields(1,1);
			add_fields(2,1);
			add_fields(3,1);
			function semester_res(id){
				var html='<li class="semester'+id+' mt-2">'+
					'<strong class="text-blue font-s-25"><?=$lang['semester']?> '+id+'</strong>'+
					'<table class="w-100 font-s-18">'+
						'<thead>'+
							'<tr class="lighten-4">'+
								'<td class="border-b py-2"><strong><?=$lang['course']?></strong></td>'+
								'<td class="border-b py-2"><strong><?=$lang['grade']?></strong></td>'+
								'<td class="border-b py-2"><strong><?=$lang['credit']?></strong></td>'+
								'<td class="border-b py-2"><strong><?=$lang['11']?></strong></td>'+
							'</tr>'+
						'</thead>'+
						'<tbody class="table'+id+'">'+
							'<tr>'+
								'<td class="border-b py-2 1subject1">Course 1</td>'+
								'<td class="border-b py-2 1grade1">0.0</td>'+
								'<td class="border-b py-2 1credit1">0.0</td>'+
								'<td class="border-b py-2 1tgrade1">0.0</td>'+
							'</tr>'+
							'<tr>'+
								'<td class="border-b py-2 1subject2">Course 2</td>'+
								'<td class="border-b py-2 1grade2">0.0</td>'+
								'<td class="border-b py-2 1credit2">0.0</td>'+
								'<td class="border-b py-2 1tgrade2">0.0</td>'+
							'</tr>'+
							'<tr>'+
								'<td class="border-b py-2 1subject3">Course 3</td>'+
								'<td class="border-b py-2 1grade3">0.0</td>'+
								'<td class="border-b py-2 1credit3">0.0</td>'+
								'<td class="border-b py-2 1tgrade3">0.0</td>'+
							'</tr>'+
						'</tbody>'+
						'<tfoot>'+
							'<tr class="bg-white text-center lighten-4">'+
								'<td class="border-b py-2" colspan="2"><strong><?=$lang['12']?></strong></td>'+
								'<td colspan="2" class="border-b py-2"><strong class="hour1">0.0</strong></td>'+
							'</tr>'+
							'<tr class="bg-white text-center lighten-4">'+
								'<td class="border-b py-2" colspan="2"><strong><?=$lang['10']?></strong></td>'+
								'<td colspan="2" class="border-b py-2"><strong class="gpa1">0.0</strong></td>'+
							'</tr>'+
						'</tfoot>'+
					'</table>'+
				'</li>';
				$('.semester_res').append(html);
			}

			function add_semester(count){
				var semester=
					`<li class="col-span-12">
						<div class="row my-2">
							<div class="col-12 left">
								<strong class="font-s-20 heading_on_mbl"><?=$lang['semester']?> ${count}</strong>
							</div>
						</div>
						<div class="row">
							<strong class="col text-blue"><?=$lang['course']?></strong>
							<strong class="col text-blue"><?=$lang['credit']?></strong>
							<strong class="col text-blue"><?=$lang['grade']?></strong>
						</div>
						<div class="row border-b m_t_n_10 border_bottom pb-2" id="accept_row${count}">
							<ul class="get_html">
							
							</ul>
							<div class="row mt-2">
								<div class="grid grid-cols-12">
									<div class="col-span-6 text-left">
										<button type="button" title="Add New Course" class="units_active border radius-5 cursor-pointer add_course bg-[#2845F5] text-white rounded-lg p-3"><b>+ <?=$lang['add_course']?></b></button>
									</div>
									<div class="col-span-6 text-end">
										<button type="button" title="Add New Semester" class="units_active p-2 border radius-5 cursor-pointer add_semester bg-[#2845F5] text-white rounded-lg p-3"><b>+ <?=$lang['add_semester']?></b></button>
									</div>
								</div>
							</div>
						</div>
					</li>`;
				$('.semester').append(semester);
			}
		});
	</script>
@endpush