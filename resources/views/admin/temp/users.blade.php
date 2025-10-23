@extends('admin.temp.main')

@section('admin')
<ul class="nav nav-list collapse in">

</ul>
<div class="header">         
    <h1 class="page-title">Users</h1>
</div>
<div class="main-content">
    <div class="row">
        <button class="btn btn-primary col-md-2" style="margin: -15px 0px 10px 20px;"><a href="{{ url('admin/add-user') }}" style="color: #fff">Add New User</a></button>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                All Users
            </div>
            <table class="table table-bordered table-first-column-check table-hover" id="myTable">
                <thead>
                    <tr>
                        <td class="col-md-1">#</th>
                        <th class="col-md-6">Name</th>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-2">Is Active?</th>
                        <th class="col-md-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($users as $row)
                        @php
                            $i++;
                            $title = $row->admin_name;
                            $active = $row->is_active;
                            $id = $row->admin_id;
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $title }}</td>
                            <td>{{ (($row->role==1) ? 'Admin' : 'Editor') }}</td>
                            <td>{{ (($active==1) ? 'Active' : 'Not Active') }}</td>
                            <td>
                                <a href="{{url('admin/edit-user/'.$id)}}" class="label label-info">Edit User</a>
                            </td>
                        </tr>
                    @endforeach
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