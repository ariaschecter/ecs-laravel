@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">User Data</h4>
                <a href="#" class="btn btn-primary mb-0">
                    Add Data
                </a>

                <table data-toggle="table" data-sort-name="id" data-page-list="[10, 25, 50, all]" data-page-size="10"
                    data-buttons-class="xs btn-light" data-pagination="true" data-show-pagination-switch="true"
                    class="table-borderless ">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true">Id</th>
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="email" data-sortable="true">Email</th>
                            <th data-field="date" data-sortable="true" data-formatter="dateFormatter">Created At</th>
                            <th data-field="action" data-sortable="false" >Action</th>
                        </tr>
                    </thead>

                    @php
                        $i = 1;
                    @endphp
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td> Show, Update </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->
@endsection
