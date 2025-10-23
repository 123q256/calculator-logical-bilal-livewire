@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<div class="row">
		<p class="col-sm-12 h2">Edit Sub-Converter</p>
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
			<form method="POST" action="{{ url('admin/edit-sub-converter/'.$page->cal_id) }}/" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="_token" id="key_token" value="{{ csrf_token() }}">
				<div class="col-md-6 col-md-12">
					<div class="form-group">
						<label class="h4">Select Converter Category</label>
						<select class="form-control" required name="cal_cat" id="cat_cal">
                            @foreach($parent as $value)
				        		<?php 
				        			$url=$value->cal_link;
				        			$url=explode('/', $url);
                                    $select = '';
                                    if ($page->cal_cat==$value->cal_title) {
                                        $select = 'selected';
                                    }
				        		 ?>
				        		 @if(count($url)===1 && $value->is_calculator=='Converter')
				        			<option {{ $select }} value="{{$value->cal_title}}">{{$value->cal_title}}</option>
				        		@endif
				        	@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="h4">Sub Converter Title</label>
						<input class='form-control' type='text' name='cal_title' id="naam" value="{{$page->cal_title}}" required placeholder="Converter Title" />
					</div>
					<div class="form-group">
				        <label class="h4">Sub Converter URL</label>
						<input class='form-control' type='text' name='cal_url' id="cal_url" value="{{$page->cal_link}}" required placeholder="Page Url" />
					</div>
					<div class="form-group">
				        <label class="checkbox-inline">
							@if ($page->no_index==1)
								<input type="checkbox" name="noindex" checked data-toggle="toggle"> Noindex
							@else
								<input type="checkbox" name="noindex" data-toggle="toggle"> Noindex
							@endif
				        </label>
				    </div>
                    <div class="form-group">
				        <label class="checkbox-inline">
							@if ($page->is_show==1)
								<input type="checkbox" name="is_show" checked data-toggle="toggle"> Is Show on Category Page?
							@else
								<input type="checkbox" name="is_show" data-toggle="toggle"> Is Show on Category Page?
							@endif
				        </label>
				    </div>
					<div class="form-group">
				        <label class="h4">Converter Search By</label>
						<input class='form-control' type='text' name='cal_search' id="cal_search" value="{{$page->image_class}}" required placeholder="Search by" />
					</div>
					<div class="form-group">
						<label class="h4">Select Parent</label>
				        <input class="form-control" type="text" name="parent" list="p" id="parent" value="{{$page->parent}}">
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
					<div class="form-group">
			            <label class="h4">Page Content</label>
			            <textarea class="ckeditor" name="content" id="ckeditor_content" required>{!! $page->content !!}</textarea>
			        </div>
					<div class="form-group">
						<label class="h4">Converter Short Description</label>
						<textarea class="form-control" name="cal_des" style="height:100px">{{ $page->cal_detail }}</textarea>
					</div>
					<input type="hidden" name="is_calculator" value="Sub-Converter">
					@if ($page->cal_img)	
						<div class="form-group">
							<label>Icon</label>
							<div style="width: 134px; height: 116px; margin: 5px;">
								<img src="{{url('assets/img/'.$page->cal_img)}}" style="width: 100%;height: 100%;object-fit: cover;">
							</div>
						</div>
					@endif
					<div class="form-group">
						<label class="h4">Converter Icon</label>
        				<input type="file" name="cal_img" class="form-control" accept=".png,.jpg,.jpeg,.gif,.webp">
					</div>
			        <div class="form-group">
						<label class="h4">Meta Title</label>
						<input class='form-control' type='text' name='meta_title' value="{{$page->meta_title}}" required placeholder="Meta Tile" />
					</div>
					<div class="form-group">
				        <label class="h4">Meta Description</label>
						<input class='form-control' type='text' name='meta_des' value="{{$page->meta_des}}" required placeholder="Meta Description" />
					</div>
					<div class="form-group">
						<label class="checkbox-inline">
							@if (($page->is_aprove==0))
								<input type="checkbox" name="aprove" data-toggle="toggle"> Approved
							@else
								<input type="checkbox" checked name="aprove" data-toggle="toggle"> Approved
							@endif
						</label>
					</div>
					<div class="form-group">
						<label class="checkbox-inline">
							@if (($page->clarity==0))
								<input type="checkbox" name="clarity" data-toggle="toggle"> Clarity
							@else
								<input type="checkbox" checked name="clarity" data-toggle="toggle"> Clarity
							@endif
						</label>
					</div>
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="add_calculator" class="btn btn-primary" value="Update Converter">
			        </div>
			    </div>
				<div class="col-md-6 col-md-12">
					<label class="col-md-12 h4">Page Keys</label>
					<div class="col-md-12 add_keys">
						@php
							$keys=json_decode($page->lang_keys);
						@endphp
						@foreach ($keys as $key => $value)
							<div class="col-md-6">
								<input type="text" name="keyname[]" value="{{$key}}" style="margin-top: 5px;" class="form-control col-md-6" placeholder="Key Name">
							</div>
							<div class="col-md-6">
								<input type="text" name="keyvalue[]" value="{{$value}}" style="margin-top: 5px;" class="form-control col-md-6" placeholder="Key Value">
							</div>  
						@endforeach
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
		$(window).on('load', function (){
			// $( '#ckeditor_content' ).ckeditor();
		});
		// CKEDITOR.replace( 'ckeditor_content' );
	</script>
@endsection