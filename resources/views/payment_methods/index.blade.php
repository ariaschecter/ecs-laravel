@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Payment Method</h4>
                <a href="{{ url('payment_method/add') }}" class="mt-2 btn btn-primary">
                    Add Payment Method
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id" data-page-list="[10, 25, 100, all]"
                    data-page-size="10" data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true">#</th>
                            <th data-field="user_name" data-sortable="true">Payment Name</th>
                            <th data-field="rekening" data-sortable="true">Rekening</th>
                            <th data-field="action" data-sortable="false" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($payment_methods as $payment_method)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $payment_method->payment_method_name }}</td>
                                <td>{{ $payment_method->payment_method_rek }}</td>
                                <td>
                                    <a href="{{ url('payment_method/edit/' . $payment_method->payment_method_id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('payment_method/delete/' . $payment_method->payment_method_id) }}" class="btn btn-danger">Delete</a>
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
