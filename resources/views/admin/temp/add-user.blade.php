@extends('admin.temp.main')

@section('admin')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
	<div class="row">
		<h1 class="col-sm-12 h3">Add New User</h1>
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
			<form method="POST" action="{{ url('admin/add-user') }}/" accept-charset="UTF-8">
				<input type="hidden" name="_token" id="key_token" value="{{ csrf_token() }}">
				<div class="col-md-8 col-md-12">
					<div class="form-group">
						<label class="h4">User Name</label>
						<input class='form-control' type='text' name='name' id="naam" value="{{old('name')}}" required placeholder="Username" />
					</div>
					<div class="form-group">
				        <label class="h4">Password</label>
						<input class='form-control' type='text' name='password' id="password" value="{{old('password')}}" required placeholder="Password" />
					</div>
					<div class="form-group">
				        <label class="h4">Confirm Password</label>
						<input class='form-control' type='text' name='password_confirmation' id="password_confirmation" value="{{old('password_confirmation')}}" required placeholder="Confirm Password" />
					</div>
                    <div class="form-group">
						<label class="checkbox-inline">
							<input type="checkbox" name="active" data-toggle="toggle"> Active
						</label>
					</div>
					<div class="form-group">
						<label class="h4">User Role</label>
                        <select class="form-control" required name="role">
                            <option selected disabled>Select User Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Editor</option>
                        </select>
					</div>
					<div class="form-group mb-5 mt-5">
			            <input type="submit" name="add_user" class="btn btn-primary" value="Add User">
			        </div>
			    </div>
			</form>
		</div>
	</div>
@endsection