@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<div class="row">
		<h1 class="col-sm-12 h3">Add New Calculator</h1>
		<div class="col-sm-12">
			@if($status=Session::get('status'))
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="alert alert-success">
                            {{ $status }}
                            <button data-dismiss="alert" class="close" type="button">×</button>
                        </div>
                    </div>
                </div>
            @endif
			@if ($errors->any())
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                            <button data-dismiss="alert" class="close" type="button">×</button>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
			<form method="POST" action="{{ url('admin/add-calculator') }}/" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="_token" id="key_token" value="{{ csrf_token() }}">
				<input type="hidden" name="cal_cat" id="cayegoryName" value="">
				<div class="col-md-6 col-md-12">
					<div class="form-group">
						<label class="h4">Select Calculator Category</label>
						<select class="form-control" required  id="cat_cal">
							<option selected disabled>Select Calculator Category</option>
							@foreach ($get_cats as $item)
								<option value="{{$item->cat_id}}">{{$item->cat_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
				        <label class="checkbox-inline">
				          <input type="checkbox" name="show_hide" data-toggle="toggle"> Show and hide calculator
				        </label>
				    </div>
					<div class="form-group">
						<label class="h4">Select Calculator Sub Category</label>
						<select class="form-control"  name="cal_sub_cat" id="cal_sub_cat">
						</select>
					</div>
					<div class="form-group">
						<label class="h4">Calculator Title</label>
						<input class='form-control' type='text' name='cal_title' id="naam" value="{{old('cal_title')}}" required placeholder="Calculator Title" />
					</div>
					<div class="form-group">
				        <label class="h4">Calculator URL</label>
						<input class='form-control' type='text' name='cal_url' id="cal_url" value="{{old('cal_url')}}" required placeholder="Page Url" />
					</div>
					<div class="form-group">
				        <label class="checkbox-inline">
				          <input type="checkbox" name="noindex" data-toggle="toggle"> Noindex
				        </label>
				    </div>
					<div class="form-group">
				        <label class="h4">Calculator Search By</label>
						<input class='form-control' type='text' name='cal_search' id="cal_search" value="{{old('cal_search')}}" required placeholder="Search by" />
					</div>
					<div class="form-group">
						<label class="h4">Select Parent</label>
				        <input class="form-control" type="text" name="parent" list="p" id="parent">
				        <datalist id="p">
				        	@foreach($parent as $value)
				        		<?php 
				        			$url=$value->cal_link;
				        			$url=explode('/', $url);
				        		 ?>
				        		 @if(count($url)===1)
				        			<option value="{{$value->cal_title}}">{{$value->cal_title}}</option>
				        		@endif
				        	@endforeach
				        </datalist>
					</div>
					<input type="hidden" name="count_rel" value="0" class="count_rel">
				    <div class="form-group">
						<label class="h4">Select Related Calculator</label><br>
						<button class="add_cal btn btn-primary" type="button">Add Related Cal</button>
						<div class="add_related">
							
						</div>
					</div>
					<div class="form-group">
			            <label class="h4">Page Content</label>
			            <textarea class="ckeditor" name="content" id="ckeditor_content" required>{{old('content')}}</textarea>
			        </div>
					<div class="form-group">
						<label class="h4">Calculator Short Description</label>
						<textarea class="form-control" name="cal_des" style="height:100px"></textarea>
					</div>
					<input type="hidden" name="is_calculator" value="Calculator">
					<div class="form-group">
						<label class="h4">Calculator Icon</label>
        				<input type="file" name="cal_img" class="form-control" accept=".png,.jpg,.jpeg,.gif,.webp">
					</div>
			        <div class="form-group">
						<label class="h4">Meta Title</label>
						<input class='form-control' type='text' name='meta_title' value="{{old('meta_title')}}" required placeholder="Meta Tile" />
					</div>
					<div class="form-group">
				        <label class="h4">Meta Description</label>
						<input class='form-control' type='text' name='meta_des' value="{{old('meta_des')}}" required placeholder="Meta Description" />
					</div>
					<div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" checked name="aprove" data-toggle="toggle"> Approved
						</label>
					</div>
					<div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" checked name="clarity" data-toggle="toggle"> Clarity
						</label>
					</div>
					<div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" name="mathjax" data-toggle="toggle"> Mathjax
						</label>
					</div>
					<div class="form-group">
						<label class="h4">Table of Content:</label>
						<textarea class="form-control" name="TOC" placeholder="Enter Table of Contant" style="height:150px">{{old('TOC')}}</textarea>
					</div>
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="add_calculator" class="btn btn-primary" value="Add Calculator">
			        </div>
			    </div>
				<div class="col-md-6 col-md-12">
					<label class="col-md-12 h4">Page Keys</label>
					<div class="col-md-12 add_keys">
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="calculate" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Calculate" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="reset" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="RE-CALCULATE" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="res" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Result" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="related_cal" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Related" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="more_cal" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" id="cat_change" value="More --" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="get" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Get The" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="widget" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Widget!" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="widget_content" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" id="name_change" value="Add -- to your website to get the ease of using this calculator directly. Feel hassle-free to account this widget as it is 100% free, simple to use, and you can add it on multiple online platforms." class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="add_site" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="ADD THIS CALCULATOR ON YOUR WEBSITE:" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="calculator" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Calculator" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="ave" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Available" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="on" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="on App" class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="app_note" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" id="name_change1" value="Download -- App for Your Mobile, So you can calculate your values in your hand." class="form-control col-md-6" placeholder="Key Value">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyname[]" readonly="" value="get_code" class="form-control col-md-6" placeholder="Key Name">
						</div>
						<div class="col-md-6" style="margin-top:10px;">
							<input type="text" name="keyvalue[]" value="Get Code" class="form-control col-md-6" placeholder="Key Value">
						</div>
					</div>
					<button type="button" id="add_key" class="btn btn-primary" style="margin: 10px 0px 0px 20px;"><i class="fa fa-plus"></i> Add Key</button>
				</div>
			</form>
		</div>
	</div>
	<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
	<script>
		$(document).ready(function(){
			"use strict";
			$('#naam').on("focusout",function(){
				var naam=$(this).val();
				var name_change=$('#name_change').val();
				var name_change1=$('#name_change1').val();
				name_change=name_change.replace("--",naam);
				name_change1=name_change1.replace("--",naam);
				$('#name_change').val(name_change);
				$('#name_change1').val(name_change1);
			});
			$('#cat_cal').on("change",function(){
				var cat_cal=$(this).val();
				var cat_change=$('#cat_change').val();
				cat_change=cat_change.replace("--",cat_cal);
				$('#cat_change').val(cat_change);
			});
			let options = '';
			@foreach ($parent as $value)
				options += '<option value="';
				options += "{{$value->cal_title.'/'.$value->cal_img.'/'.$value->cal_link}}";
				options += '">';
				options += "{{$value->cal_title}}";
				options += "</option>";
			@endforeach	
			function add_related(j){
            	var html='<p style="margin-top:5px">Add '+j+' Related Calculator</p>'+
                '<select class="select2 active form-control" name="related_cal'+j+'">'+
               	'<option disabled selected>Select Related Calculator</option>'+options+'</select>';
               	$('.add_related').append(html);
               	$('.select2').select2();
        	}
			var i=0;
			$('.add_cal').on('click',function(){
				i++;
				add_related(i);
				$('.count_rel').val(i);
			})
			$('#cal_cat').change(function(){
				var str=$(this).val();
				var url = str.split(" ");
				url = url[0].toLowerCase();
				$('#cal_url').val(url+'/')
			})

			var html='<div class="col-md-6" style="margin-top:10px;">'+
		        '<input type="text" name="keyname[]" class="form-control col-md-6" placeholder="Key Name">'+
		    '</div>'+
		    '<div class="col-md-6" style="margin-top:10px;">'+
		        '<input type="text" name="keyvalue[]" class="form-control col-md-6" placeholder="Key Value">'+
		    '</div>';
		    $('#add_key').click(function(){
		        $('.add_keys').append(html);
		    })
		})
		$('#parent').change(function(){
			var parent=$('#parent').val();
			var cal_url=$('#cal_url').val();
			var token=$('#key_token').val();
			if(parent!=''){
				$.ajax({
				type: "post",
				url: "{{URL::to('admin/keys')}}/",
				data: {
					data : parent,
					cal_url : cal_url,
					_token : token
				},
				success: function(data){
					var html='';
					data=$.parseJSON(data);
					$.each(data, function(index, value){
						html+='<div class="col-md-6" style="margin-top:10px;">'+
					'<input type="text" name="keyname[]" readonly value="'+index+'" class="form-control col-md-6" placeholder="Key Name">'+
					'</div>'+
					'<div class="col-md-6" style="margin-top:10px;">'+
						'<input type="text" name="keyvalue[]" value="'+value+'" class="form-control col-md-6" placeholder="Key Value">'+
					'</div>';
						});
						
						$('.add_keys').html(html);
					},
				});
			}
        });
		$(window).on('load', function (){
			// $( '#ckeditor_content' ).ckeditor();
		});
		// CKEDITOR.replace( 'ckeditor_content' );
		$('#cat_cal').change(function(){
			var cal_id=$(this).val();

			console.log(parent)
			var token=$('#key_token').val();
			if(parent!=''){
				$.ajax({
				type: "post",
				url: "{{URL::to('admin/search-subcategory')}}/",
				data: {
					cal_id : cal_id,
					_token : token
				},
				success: function(data){
					var html='';
					var html = '<option value="">Select Subcategory</option>'; 
					$.each(data.data, function(index, value) {
						html += '<option value="' + value.cat_id + '">' + value.cat_name + '</option>';
					});
			        $('#cayegoryName').val(data.categoriesName);
					$('#cal_sub_cat').html(html);
					},
					error: function(xhr, status, error) {
					console.log(xhr.responseText); 
					}
				
				});
			}
        });

	</script>
@endsection