@extends('admin.temp.main')
@section('admin')
<ul class="nav nav-list collapse in">
</ul>
<div class="header row">   
<div class="col-lg-6"><h1 class="page-title">Sub Categories</h1></div>      
</div>
<div class="main-content">
<div class="row">
<button class="btn btn-primary col-md-2" style="margin: -15px 0px 10px 20px;"><a href="{{ url('admin/add-sub-category') }}" style="color: #fff">Add New Sub Category</a></button>
</div>
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
@if($error=Session::get('error'))
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="alert alert-danger">
{{ $error }}
<button data-dismiss="alert" class="close" type="button">×</button>
</div>
</div>
</div>
@endif
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
All Sub Categories
</div>
<table class="table table-bordered table-first-column-check table-hover" id="myTable">
<thead>
<tr>
    <th>#</th>
    <th class="col-md-4">Add Sub Category Time/Date</th>
    <th class="col-md-4">Sub Category Name</th>
    <th class="col-md-2">Main Category</th>
    <th class="col-md-2">Action</th>
</tr>
</thead>
<tbody>
<?php $i=1; ?>
<?php foreach ($cats as $row) {?>
    <?php $id=$row->cat_id; ?>

    <?php  
$get_cats = DB::table('categories')->select('cat_id', 'cat_name', 'img', 'is_del', 'cat_time')->where('cat_id', $row->cat_parent)->first();

?>


    <tr>
        <td style="text-align: center"><?=$i?></td>
        @php $date = new DateTime($row->cat_time);@endphp
        <td>{{\Carbon\Carbon::parse($date)->format('h:i:s A l, d/m/Y')}}</td>
        <td><?=$row->cat_name?></td>
        <td><?=$get_cats->cat_name?></td>
        <td>
            <a href="{{ url('admin/edit-sub-category/'.$id) }}" class="label label-success">Edit</a>
            <a href="{{ url('admin/delete-sub-category/'.$id) }}" class="label label-danger delete-category" data-id="{{ $id }}">Delete</a>
        </td>
        </tr>
    <?php $i=$i+1; ?>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
<script>
$(document).ready( function () {
$('#myTable').DataTable();
} );

document.addEventListener('DOMContentLoaded', function() {
const deleteLinks = document.querySelectorAll('.delete-category');
deleteLinks.forEach(link => {
link.addEventListener('click', function(event) {
event.preventDefault();
const isConfirmed = confirm('Are you sure you want to delete this sub category?');
if (isConfirmed) {
window.location.href = this.href;
}
});
});
});
</script>
@endsection