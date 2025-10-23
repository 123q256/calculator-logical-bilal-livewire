@extends('admin.temp.main')

@section('admin')
<ul class="nav nav-list collapse in">

</ul>
<div class="header">         
    <h1 class="page-title">Pending {{$is}}s</h1>
</div>
<div class="main-content">
    <div class="col-md-12">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                All Pages
            </div>
            <table class="table table-bordered table-first-column-check table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Page Title</th>
                        <th>Add by</th>
                        <th>Update by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach ($pages as $row) {?>
                        <?php $id=$row->cal_id; ?>
                        <tr>
                            <td style="text-align: center"><?=$i?></td>
                            <td><?=$row->cal_title?></td>
                            <td>{{ $row->add_by }}</td>
                            <td>{{ $row->update_by }}</td>
                            <td>
                                <a href="{{ url('admin/edit-'.strtolower($is).'/'.$id) }}" class="label label-success">View Profile</a>
                                <a href="{{ url('admin/approve/'.$id) }}" class="label label-info">Approved</a>
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