@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<div class="row">
        {{-- <span class="text-danger bg-info">(This page Not Working Yet)</span> --}}
		<h1 class="col-sm-12 h3">Add New Sub-Converter</h1>
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
            <form method="POST" action="{{ url('admin/add-sub-converter') }}/" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="_token" id="key_token" value="{{ csrf_token() }}">
				<div class="col-md-6 col-md-12">
					<div class="form-group">
						<label class="h4">Select Converter Category</label>
						<select class="form-control" required name="cal_cat" id="cat_cal">
							<option selected disabled>Select Sub-Converter Category</option>
                            @foreach($parent as $value)
				        		<?php 
				        			$url=$value->cal_link;
				        			$url=explode('/', $url);
				        		 ?>
				        		 @if(count($url)===1 && $value->is_calculator=='Converter')
				        			<option value="{{$value->cal_title}}">{{$value->cal_title}}</option>
				        		@endif
				        	@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="h4">Sub-Converter Title</label>
						<input class='form-control' type='text' name='cal_title' id="naam" value="{{old('cal_title')}}" required placeholder="Converter Title" />
					</div>
					<div class="form-group">
				        <label class="h4">Sub-Converter URL</label>
						<input class='form-control' type='text' name='cal_url' id="cal_url" value="{{old('cal_url')}}" required placeholder="Page Url" />
					</div>
					<div class="form-group">
				        <label class="checkbox-inline">
				          <input type="checkbox" name="noindex" data-toggle="toggle"> Noindex
				        </label>
				    </div>
                    <div class="form-group">
				        <label class="checkbox-inline">
				            <input type="checkbox" name="is_show" data-toggle="toggle"> Is Show on Category Page?
				        </label>
				    </div>
					<div class="form-group">
				        <label class="h4">Sub-Converter Search By</label>
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
				        		 @if(count($url)===2 && $value->is_calculator=='Sub-Converter')
				        			<option value="{{$value->cal_title}}">{{$value->cal_title}}</option>
				        		@endif
				        	@endforeach
				        </datalist>
					</div>
					<input type="hidden" name="count_rel" value="0" class="count_rel">
                    <input type="hidden" name="related_cal" value="null">
					<div class="form-group">
			            <label class="h4">Page Content</label>
			            <textarea class="ckeditor" name="content" id="ckeditor_content" required>{{old('content')}}</textarea>
			        </div>
					{{-- <div class="form-group">
						<label class="h4">Sub-Converter Short Description</label>
						<textarea class="form-control" name="cal_des" style="height:100px"></textarea>
					</div> --}}
					<input type="hidden" name="is_calculator" value="Sub-Converter">
					<div class="form-group">
						<label class="h4">Sub-Converter Icon</label>
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
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="add_calculator" class="btn btn-primary" value="Add Sub Converter">
			        </div>
			    </div>
				<div class="col-md-6 col-md-12">
					<label class="col-md-12 h4">Page Keys</label>
					<div class="col-md-12 add_keys">
						<div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="formula1" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="formula2" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="unit1" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="unit2" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="from" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="From" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="to" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="To" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="convert" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Convert" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="clear" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Clear" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="get" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Get" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="widget" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="the Widget!" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="add_site" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="ADD THIS CONVERTER ON YOUR WEBSITE:" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="widget_content" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Add (UNIT1) to (UNIT2) converter to your website to use this unit converter directly. Feel hassle-free to account this widget as it is 100% free." class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="get_code" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Get Code!" class="form-control col-md-6" placeholder="Key Value">
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
                            <input type="text" name="keyvalue[]" value="Try Unit Converter App for your Mobile to get the ease of converting thousands of units. It’s 100% free with ample of features!" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="app_link" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="https://play.google.com/store/apps/details?id=com.eclix.unit.converter.calculator&amp;hl=en_US" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="pop1" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Popular (MAIN CATEGORY)" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="pop2" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value=" Converters" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="other1" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Convert (UNIT1) to" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="other2" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Other (MAIN CATEGORY) Units" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="all" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="All" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="con" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Converter" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="s1" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="Search a unit" class="form-control col-md-6" placeholder="Key Value">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyname[]" readonly="" value="s2" class="form-control col-md-6" placeholder="Key Name">
                        </div>
                        <div class="col-md-6" style="margin-top:10px;">
                            <input type="text" name="keyvalue[]" value="to Convert" class="form-control col-md-6" placeholder="Key Value">
                        </div>
					</div>
					<button type="button" id="add_key" class="btn btn-primary" style="margin: 10px 0px 0px 20px;"><i class="fa fa-plus"></i> Add Key</button>
				</div>
            </form>
		</div>
	</div>
	<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
	<script>
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.disableAutoInline = true;
		$(document).ready(function(){
			"use strict";
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
				url: "{{URL::to('admin/keys')}}",
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
	</script>
@endsection