@extends('admin.temp.main')

@section('admin')
<style>
    .page-title-new{
        color: #347d4f !important;
        font-size: 15px !important;
    }
    .page-title-index{
        color: red !important;
        font-size: 15px !important;
    }
</style>
<ul class="nav nav-list collapse in">

</ul>
<div class="header row">   
    <div class="col-lg-6"><h1 class="page-title">{{$is}}s</h1></div>
    <div class="col-lg-6"><h2 class="page-title h4">Total {{$is}}s : {{ $total }}</h2></div>      
</div>
<div class="header row">   
   
    <div class="col-lg-3"><p class="page-title-new h4"> Health {{$is}}s : {{ $healthcount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Math {{$is}}s : {{ $mathcount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Everyday Life {{$is}}s : {{ $everydayLifecount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Finace {{$is}}s : {{ $financecount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Physic {{$is}}s : {{ $physicscount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Chemistry {{$is}}s : {{ $chemistrycount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Statistic {{$is}}s : {{ $statisticscount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Construction {{$is}}s : {{ $Constructioncount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> Pet {{$is}}s : {{ $petscount }}</p></div>      
    <div class="col-lg-3"><p class="page-title-new h4"> timedate {{$is}}s : {{ $timedatecount }}</p></div> 
    
    <div class="col-lg-3"><p class="page-title-index h4"> index {{$is}}s : {{ $indexcount }}</p></div>  
       <div class="col-lg-3"><p class="page-title-index h4">Total No-Index {{$is}}s : {{ $noindexcount }}</p></div> 
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
                        <th class="col-md-4">Parent</th>
                        <th class="col-md-4">cal link</th>
                        <th class="col-md-4">Index</th>
                        <th class="col-md-4">Status</th>
                        <th class="col-md-4">Category</th>
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
                          
                            <td>
                            <?php if ($row->parent!='') {
                                echo $row->parent;
                            } else {
                                echo $row->cal_title;
                            }
                                ?>
                            </td>
                            <td><?=$row->cal_link?></td>
                            <td>
                                <?php if($row->no_index == 0){ ?>
                                    <span style="color: green;font-weight:800'">index</span>
                               <?php }else{ ?>
                                <span style="color: red;font-weight:800'">No Index</span>

                               <?php } ?>
                            </td>


                            <td>
                                <?php if($row->show_hide == 1){ ?>
                                    <span style="color: green;font-weight:800'">show</span>
                               <?php }else{ ?>
                                <span style="color: red;font-weight:800'">Hide</span>

                               <?php } ?>
                            </td>
                            <td><?=$row->cal_cat?></td>
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