@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ url('assets/admin/lib/jquery.multiselect.css') }}">
<script src="{{url('assets/admin/lib/jquery.multiselect.js')}}" type="text/javascript"></script>
	<div class="row">
		<h1 class="col-sm-12 h3">Add New Post</h1>
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
            <form method="POST" action="{{ url('admin/add-post') }}/" accept-charset="UTF-8" enctype="multipart/form-data">
				<input type="hidden" name="_token" id="key_token" value="{{ csrf_token() }}">
				<div class="col-md-8 col-md-12">
					<div class="form-group">
						<label class="h4">Post Title</label>
						<input class='form-control' type='text' name='title' id="naam" value="{{old('title')}}" required placeholder="Post Title" />
					</div>
					<div class="form-group">
				        <label class="h4">Post URL</label>
						<input class='form-control' type='text' name='post_url' id="post_url" value="{{old('post_url')}}" required placeholder="Post Url" />
					</div>
					
					<div class="form-group">
						<label class="h4">Select Parent</label>
				        <select name="cat" class="form-control">
                            <option value="">--select--</option>
                            <option value="Finance">Finance</option>
                            <option value="Informative">Informative</option>
                            <option value="Math">Math</option>
                            <option value="Health">Health</option>
                        </select>
					</div>
				    <div class="form-group">
						<label class="h4">Short Description</label>
						<textarea class="form-control" name="short_des" placeholder="Enter Short Description">{{old('short_des')}}</textarea>
					</div>
                    <div class="form-group">
                        <label class="h4">Post Image</label>
                        <input type="file" name="post_img" class="form-control" accept=".png,.jpg,.jpeg,.gif,.webp">
                    </div>
                    <div class="form-group">
                        <label>Select Related Calculator</label>
                         <select class="3col active form-control " name="related_cal[]" multiple>
                           <option disabled selected>Select Related Calculator</option>
                           @php
                                foreach ($calculators as $value) {
                                    echo "<option value='".$value->cal_title.'/'.$value->cal_img.'/'.$value->cal_link."'>".$value->cal_title."</option>";
                                }
                           @endphp
                        </select>
                    </div>
					<div class="form-group">
			            <label class="h4">Post Content</label>
			            <textarea class="ckeditor" name="des" id="ckeditor_content" required>{{old('des')}}</textarea>
			        </div>
                    <div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" name="knowledge" data-toggle="toggle"> Is Knowledge Base?
						</label>
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
				          <input type="checkbox" name="show_hide" data-toggle="toggle"> Show and hide calculator
				        </label>
				    </div>
                    
                    @if ($LoginUser['role']=='1')    
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="aprove" checked data-toggle="toggle"> Approved
                            </label>
                        </div>
                    @endif
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="add_post" class="btn btn-primary" value="Add Post">
			        </div>
			    </div>
            </form>
		</div>
	</div>
	<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.disableAutoInline = true;
        $(document).ready(function(){
            $('select[multiple].active.3col').multiselect({
                columns: 1,
                placeholder: 'Select Related Calculator',
                search: true,
                searchOptions: {
                    'default': 'Search Related Calculator'
                },
                selectAll: false
            });
        })
    </script>
@endsection