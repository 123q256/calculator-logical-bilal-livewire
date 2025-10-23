@extends('admin.temp.main')

@section('admin')
<ul class="nav nav-list collapse in">

</ul>
<div class="header">         
    <h1 class="page-title">Posts</h1>
</div>
<div class="main-content">
    <div class="row">
        <button class="btn btn-primary col-md-2" style="margin: -15px 0px 10px 20px;"><a href="{{ url('admin/add-post') }}" style="color: #fff">Add New Post</a></button>
    </div>
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
                All Posts
            </div>
            <table class="table table-bordered table-first-column-check table-hover" id="myTable1">
                <thead>
                    <tr>
                        <td class="col-md-1">Date</th>
                        <th class="col-md-6">Title</th>
                        <th class="col-md-2">category</th>
                        <th class="col-md-2">status</th>
                        <th class="col-md-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $row)
                        @php
                            $title = $row->post_title;
                            $date = $row->post_time;
                            $cat = $row->post_cat;
                            $postId = $row->post_id;
                            $knowledge = $row->knowledge;
                            $post_url = $row->post_url;
                            $show_hide = $row->show_hide;
                        @endphp
                        <tr>
                            <td>{{ date("d M, Y", strtotime($date)) }}</td>
                            <td>{{ $title }}</td>
                            <td>{{ $cat }}</td>
                            <td>
                                @if ($show_hide==1)
                               <span style="color: green;">show</span>
                            @else
                            <span style="color: red;">hide</span>
                            @endif
                            </td>
                            <td>
                                @if ($row->is_aprove==1)
                                    @if ($knowledge==1)
                                        <a href="{{url($cat.'/'.$post_url.'/')}}" class="label label-success" target="_blank">View Post</a> 
                                    @else
                                        <a href="{{url('blog/'.$post_url.'/')}}" class="label label-success" target="_blank">View Post</a> 
                                    @endif
                                @endif
                                <a href="{{url('admin/edit-post/'.$postId)}}" class="label label-info">Edit post</a>
                                <span href="{{url('admin/delete-post/'.$postId)}}" class="label label-danger" onclick="deletePost(this)">Delete</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function deletePost(elem){
        let text = "Are you Sure?";
        let link = $(elem).attr('href');
        if (confirm(text) == true) {
            window.location=link;
        }
    }
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
@endsection