@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Payment Data</h4>
                <a href="{{ url('payment/add') }}" class="mt-2 btn btn-primary">
                    Add Payment
                </a>

                <table data-toggle="table" data-search="true" data-show-refresh="true" data-sort-name="id"
                    data-page-list="[10, 25, 100, all]" data-page-size="10" data-pagination="true"
                    data-show-pagination-switch="true" class="table-borderless">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true">#</th>
                            <th data-field="payment_ref" data-sortable="true">Ref</th>
                            <th data-field="Picture">Picture</th>
                            <th data-field="user_name" data-sortable="true">User Name</th>
                            <th data-field="payment_price" data-sortable="true">Price</th>
                            <th data-field="user_city" data-sortable="true">Status</th>
                            <th data-field="action" data-sortable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>#{{ $payment->payment_ref }}</td>
                            <td><img src="{{ asset('storage/' . $payment->payment_picture) }}"
                                    alt="{{ 'Foto '. $payment->user->user_name }}" class="" width="75"></td>
                            <td>{{ $payment->user->user_name }}</td>
                            <td>Rp. {{ number_format($payment->payment_price, 0) }}</td>
                            <td>{{ $payment->payment_status }}</td>
                            <td>
                                <a href="{{ url('payment/edit/' . $payment->payment_id) }}"
                                    class="btn btn-info">Edit</a>
                                <a href="{{ url('payment/delete/' . $payment->payment_id) }}"
                                    class="btn btn-danger">Delete</a>
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