@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Question Quiz Data</h4>
                <a href="{{ url('question/add') }}" class="mt-2 btn btn-primary">
                    Add Question Quiz
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id">#</th>
                            <th data-field="mapel_name" data-sortable="true">Mapel Name</th>
                            <th data-field="question_no">Sub Mapel Name</th>
                            <th data-field="question_name" data-sortable="true">Question</th>
                            <th data-field="action" data-sortable="false" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($question_quizs as $question)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $question->sub_mapel->mapel->mapel_name }}</td>
                                <td>{{ $question->sub_mapel->sub_mapel_name }}</td>
                                <td>{{ $question->question }}</td>
                                <td>
                                    <a href="{{ url('question/edit/' . $question->question_id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('question/delete/' . $question->question_id) }}" class="btn btn-danger">Delete</a>
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
