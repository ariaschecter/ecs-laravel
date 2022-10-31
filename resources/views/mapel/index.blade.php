@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Mapel Data</h4>
                <a href="{{ url('mapel/add') }}" class="mt-2 btn btn-primary">
                    Add Mapel
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true">#</th>
                            <th data-field="mapel_name" data-sortable="true">Mapel Name</th>
                            <th data-field="mapel_picture" data-sortable="true">Mapel Picture</th>
                            <th data-field="semester" data-sortable="true">Semester</th>
                            <th data-field="active" data-sortable="true">Active</th>
                            <th data-field="action" data-sortable="false" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($mapels as $mapel)
                        @php
                            $mapel_active = ($mapel->mapel_active ? 'Active': 'Not Active');
                        @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $mapel->mapel_name }}</td>
                                <td><img src="{{ asset('storage/' . $mapel->mapel_picture) }}" alt="{{ 'Foto '. $mapel->mapel_name }}" class="" width="75"></td>
                                <td>{{ $mapel->semester_id }}</td>
                                <td>{{ $mapel_active }}</td>
                                <td>
                                    <a href="{{ url('mapel/show/' . $mapel->mapel_id) }}" class="btn btn-primary">Show</a>
                                    <a href="{{ url('mapel/edit/' . $mapel->mapel_id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('mapel/delete/' . $mapel->mapel_id) }}" class="btn btn-danger">Delete</a>
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
