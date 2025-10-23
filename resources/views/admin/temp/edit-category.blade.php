@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<div class="row">
		<h1 class="col-sm-12 h3">Edit Category</h1>
		<div class="col-sm-12">
			@if(isset($status))
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="alert alert-success">
                            {{ $status }}
                            <button data-dismiss="alert" class="close" type="button">×</button>
                        </div>
                    </div>
                </div>
            @endif
			@if(isset($error))
				<div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="alert alert-danger">
                            {{ $error }}
                            <button data-dismiss="alert" class="close" type="button">×</button>
                        </div>
                    </div>
                </div>
            @endif
			<form method="POST" action="{{ url()->current() }}/" accept-charset="UTF-8" enctype="multipart/form-data">
				@csrf
				<div class="col-md-6 col-md-12">
					@if(count($cats) > 0)
						<div class="form-group">
							<label class="h4">All Categories</label>
							<select class="form-control">
								@foreach ($cats as $row)
									<option value="{{$row->cat_name}}">{{$row->cat_name}}</option>
								@endforeach
							</select>
						</div>
					@endif
					<div class="form-group">
						<label class="h4">Category Name</label>
						<input class='form-control' type='text' name='cat_name' id="cat_name" value="{{$cat_detail->cat_name}}" placeholder="Category Name" />
					</div>
					<div class="form-group">
                        <label class="h4">Category Image</label>
                        <div style="width: 250px; height: 170px; margin: 5px;">
                            <img src="{{url('images/category/'.$cat_detail->img)}}" style="width: 100%;height: 100%;object-fit: cover;">
                        </div>
                        <input type="file" name="img" class="form-control" accept=".png,.jpg,.jpeg,.gif,.webp">
                    </div>
					{{-- <div class="form-group">
				        <label class="checkbox-inline">
				          <input type="checkbox" name="is_del" data-toggle="toggle" {{ $cat_detail->is_del === 1 ? "checked" : '' }}>Delete
				        </label>
				    </div> --}}
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="updateCategory" class="btn btn-primary" value="Update Category">
			        </div>
			    </div>
			</form>
		</div>
	</div>
@endsection