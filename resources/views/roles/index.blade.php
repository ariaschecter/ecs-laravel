@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Role Data</h4>
                <a href="{{ url('role/add') }}" class="mt-2 btn btn-primary">
                    Add Role
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true">#</th>
                            <th data-field="user_name" data-sortable="true">Name</th>
                            <th data-field="action" data-sortable="false" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>
                                    <a href="{{ url('role/edit/' . $role->role_id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('role/delete/' . $role->role_id) }}" class="btn btn-danger">Delete</a>
                                </td>
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
