@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Sub Mapel Data</h4>
                <a href="{{ url('choice/add') }}" class="mt-2 btn btn-primary">
                    Add Sub Mapel
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id">#</th>
                            <th data-field="question_name" data-sortable="true">Question</th>
                            <th data-field="choice_name">Choice Name</th>
                            <th data-field="choice_score" data-sortable="true">Choice Score</th>
                            <th data-field="action" data-sortable="false" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($choice_quizs as $choice)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $choice->question->question }}</td>
                                <td>{{ $choice->choice_name }}</td>
                                <td>{{ $choice->choice_score }}</td>
                                <td>
                                    <a href="{{ url('choice/edit/' . $choice->choice_id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('choice/delete/' . $choice->choice_id) }}" class="btn btn-danger">Delete</a>
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
