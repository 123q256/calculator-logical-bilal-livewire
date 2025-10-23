@extends('admin.temp.main')

@section('admin')
<ul class="nav nav-list collapse in">

</ul>
<div class="header">         
    <h1 class="page-title">{{$is}}s</h1>
</div>
<div class="main-content">
    <div class="row">
        <button class="btn btn-primary col-md-2" style="margin: -15px 0px 10px 20px;"><a href="{{ url('admin/add-'. strtolower($is)) }}" style="color: #fff">Add New {{$is}}</a></button>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Pages
            </div>
            <table class="table table-bordered table-first-column-check table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-4">Page Title</th>
                        <th class="col-md-4">Converter Category</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach ($pages as $row) {?>
                        <?php $id=$row->cal_id; ?>
                        <tr>
                            <td style="text-align: center"><?=$i?></td>
                            <td><?=$row->cal_title?></td>
                            <td><a href="{{ url()->current() }}?cal_cat={{$row->cal_cat}}">{{$row->cal_cat}}</a></td>
                            <td>
                                <a href="{{ url('admin/edit-'.strtolower($is).'/'.$id) }}" class="label label-success">View Profile</a>
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
</script>
@endsection