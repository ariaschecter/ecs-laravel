@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">User Data</h4>
                <a href="{{ url('user/add') }}" class="mt-2 btn btn-primary">
                    Add User
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id"
                    data-page-list="[10, 25, 100, all]" data-page-size="10" data-pagination="true"
                    data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true">#</th>
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="email" data-sortable="true">Email</th>
                            <th data-field="user_city" data-sortable="true">City</th>
                            <th data-field="action" data-sortable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_city }}</td>

                            <td>
                                <a href="{{ url('user/edit/' . $user->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('user/delete/' . $user->id) }}" class="btn btn-danger">Delete</a>
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