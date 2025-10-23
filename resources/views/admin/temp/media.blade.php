@extends('admin.temp.main')

@section('admin')
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
<form method="post" action="" enctype="multipart/form-data" class="col-sm-6">
    @csrf
	<div class="form-group">
		<label>Upload An Image</label>
	    <input type="file" name="image" class="form-control" accept=".png,.jpg,.jpeg,.gif">
	</div>
	<div class="form-group">
        <button type="submit" name="upload" value="hy" class="btn btn-primary"><i class="fa fa-plus"></i> Upload Image</button>
    </div>
</form>

<div class="main-content">
    <table class="table table-bordered table-first-column-check table-hover" id="myTable">
        <thead>
            <th>#</th>
            <th>img url</th>
            <th>Preview</th>
        </thead>
        <tbody>
            @php
                $i = 0;
                foreach ($files as $file) {
                    // Check if the file is a valid image
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $i++;
                        // Process your image here, for example, you can get the file name
                        $fileName = pathinfo($file, PATHINFO_BASENAME);
                        echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.url('images/'.$fileName).'</td>
                            <td><img src="'.url('images/'.$fileName).'" width="50" height="50" style="object-fit: cover" alt=""></td>
                            </tr>';
                    }
                }
            @endphp
        </tbody>
    </table>
</div>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection