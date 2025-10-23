@extends('admin.temp.main')

@section('admin')
<ul class="nav nav-list collapse in">

</ul>
<div class="header row">   
    <div class="col-lg-6"><h1 class="page-title">Save Inputs</h1></div>      
</div>
<div class="main-content">
    <div class="col-md-12">
        <div class="panel panel-default">
            <table class="table table-bordered table-first-column-check table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-md-4">Calculator Input</th>
                        <th class="col-md-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (array_reverse($data_array) as $item)
                        @php
                            $new_data = $item;
                            unset($new_data['_token']);
                            unset($new_data['timestamp']);
                            unset($new_data['submit']);
                            $entry_string = [];
                            foreach ($new_data as $key => $value) {
                                $entry_string[] = "$key = \"$value\"";
                            }
                            $formatted_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item['timestamp'])->format('l, F d, Y h:i:s A');
                        @endphp
                        <tr>
                            <td>{{ implode(", ", $entry_string) }}</td>
                            <td>{{ $formatted_date }}</td>
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