@extends('layouts.content')

@section('body')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Sort &amp; Format Column</h4>
                <p class="sub-header mb-0">
                    Example of sort & format column.
                </p>

                <table data-toggle="table" data-sort-name="id" data-page-list="[5, 10, 20]" data-page-size="5"
                    data-buttons-class="xs btn-light" data-pagination="true" data-show-pagination-switch="true"
                    class="table-borderless ">
                    <thead class="table-light">
                        <tr>
                            <th data-field="id" data-sortable="true" data-formatter="invoiceFormatter">Order ID</th>
                            <th data-field="name" data-sortable="true">Name</th>
                            <th data-field="date" data-sortable="true" data-formatter="dateFormatter">Order date</th>
                            <th data-field="amount" data-align="center" data-sortable="true" data-sorter="priceSorter">Price</th>
                            <th data-field="status" data-align="center" data-sortable="true" data-formatter="statusFormatter">Status</th>
                            <th data-field="name" data-sortable="true" >Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>UB-1609</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Unpaid</td>
                        </tr>
                        <tr>
                            <td>UB-1610</td>
                            <td>Woldt</td>
                            <td>24 Jun 2017</td>
                            <td>$ 15.00</td>
                            <td>Paid</td>
                        </tr>

                        <tr>
                            <td>UB-1611</td>
                            <td>Leonardo</td>
                            <td>25 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Shipped</td>
                        </tr>

                        <tr>
                            <td>UB-1612</td>
                            <td>Halladay</td>
                            <td>27 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Refunded</td>
                        </tr>

                        <tr>
                            <td>UB-1613</td>
                            <td>Badgett</td>
                            <td>28 Jun 2017</td>
                            <td>$ 95.00</td>
                            <td>Unpaid</td>
                        </tr>
                        <tr>
                            <td>UB-1614</td>
                            <td>Boudreaux</td>
                            <td>29 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Paid</td>
                        </tr>

                        <tr>
                            <td>UB-1615</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Shipped</td>
                        </tr>

                        <tr>
                            <td>UB-1616</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Refunded</td>
                        </tr>

                        <tr>
                            <td>UB-1617</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Unpaid</td>
                        </tr>
                        <tr>
                            <td>UB-1618</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Paid</td>
                        </tr>

                        <tr>
                            <td>UB-1619</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Shipped</td>
                        </tr>

                        <tr>
                            <td>UB-1620</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Refunded</td>
                        </tr>

                        <tr>
                            <td>UB-1621</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Unpaid</td>
                        </tr>
                        <tr>
                            <td>UB-1622</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Paid</td>
                        </tr>

                        <tr>
                            <td>UB-1623</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Shipped</td>
                        </tr>

                        <tr>
                            <td>UB-1624</td>
                            <td>Boudreaux</td>
                            <td>22 Jun 2017</td>
                            <td>$ 35.00</td>
                            <td>Refunded</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->
@endsection
