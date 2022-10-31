@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3"> Basic Wizard</h4>
                    <div id="basicwizard">

                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-4">
                            <li class="nav-item">
                                <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span class="d-none d-sm-inline">Sub Mata Pelajaran</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile me-1"></i>
                                    <span class="d-none d-sm-inline">List Mata Pelajaran</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content b-0 mb-0 pt-0">
                            <div class="tab-pane" id="basictab1">
                                {{-- <div class="row">
                                    <div class="col-12">
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="userName">User name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="userName" name="userName" value="Coderthemes">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="password"> Password</label>
                                            <div class="col-md-9">
                                                <input type="password" id="password" name="password" class="form-control" value="123456789">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-md-3 col-form-label" for="confirm">Re Password</label>
                                            <div class="col-md-9">
                                                <input type="password" id="confirm" name="confirm" class="form-control" value="123456789">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row --> --}}
                                <a href="{{ url('sub_mapel/add') }}" class="mt-2 btn btn-primary">
                                    Add Sub Mapel
                                </a>

                                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                                    <thead class="table-light">
                                        <tr>
                                            <th data-field="sub_mapel_no">Sub Mapel No</th>
                                            <th data-field="sub_mapel_name" data-sortable="true">Sub Mapel Name</th>
                                            <th data-field="action" data-sortable="false" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub_mapels as $sub_mapel)
                                            <tr>
                                                <td>{{ $sub_mapel->sub_mapel_no }}</td>
                                                <td>{{ $sub_mapel->sub_mapel_name }}</td>
                                                <td>
                                                    <a href="{{ url('sub_mapel/edit/' . $sub_mapel->sub_mapel_id) }}" class="btn btn-info">Edit</a>
                                                    <a href="{{ url('sub_mapel/delete/' . $sub_mapel->sub_mapel_id) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="basictab2">
                                <a href="{{ url('list_mapel/add') }}" class="mt-2 btn btn-primary">
                                    Add Sub Mapel
                                </a>

                                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                                    <thead class="table-light">
                                        <tr>
                                            <th data-field="id">#</th>
                                            <th data-field="mapel_name" data-sortable="true">Sub Mapel Name</th>
                                            <th data-field="sub_mapel_no">List Mapel No</th>
                                            <th data-field="list_mapel_name" data-sortable="true">List Mapel Name</th>
                                            <th data-field="list_mapel_link" data-sortable="true">List Mapel Link</th>
                                            {{-- <th data-field="list_mapel_desc" data-sortable="true">List Mapel Desc</th> --}}
                                            <th data-field="action" data-sortable="false" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($sub_mapels as $sub_mapel)
                                            @foreach ($sub_mapel->list_mapel as $list_mapel)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $list_mapel->sub_mapel->sub_mapel_name }}</td>
                                                    <td>{{ $list_mapel->list_mapel_no }}</td>
                                                    <td>{{ $list_mapel->list_mapel_name }}</td>
                                                    <td>{{ $list_mapel->list_mapel_link }}</td>
                                                    {{-- <td>{{ $list_mapel->list_mapel_desc }}</td> --}}
                                                    <td>
                                                        <a href="{{ url('list_mapel/edit/' . $list_mapel->list_mapel_id) }}" class="btn btn-info">Edit</a>
                                                        <a href="{{ url('list_mapel/delete/' . $list_mapel->list_mapel_id) }}" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- tab-content -->
                    </div> <!-- end #basicwizard-->
    </div>
        </div>
    </div>
</div>
@endsection
