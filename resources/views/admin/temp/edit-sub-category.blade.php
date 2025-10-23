@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<div class="row">
		<h1 class="col-sm-12 h3">Edit Sub Category</h1>
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
			<form method="POST" action="{{ url()->current() }}/" accept-charset="UTF-8">
				@csrf
				<div class="col-md-6 col-md-12">
					@if(count($cats) > 0)
						<div class="form-group">
							<label class="h4">All Categories</label>
							<select class="form-control" name="cat_parent">
								@foreach ($cats as $row)
									<option value="{{$row->cat_id}}" {{$cat_detail->cat_parent == $row->cat_id ?'selected':''}}>{{$row->cat_name}}</option>
								@endforeach
							</select>
						</div>
					@endif
					<div class="form-group">
						<label class="h4">Category Name</label>
						<input class='form-control' type='text' name='cat_name' id="cat_name" value="{{$cat_detail->cat_name}}" placeholder="Category Name" />
					</div>
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="updateCategory" class="btn btn-primary" value="Update Category">
			        </div>
			    </div>
			</form>
		</div>
	</div>
@endsection