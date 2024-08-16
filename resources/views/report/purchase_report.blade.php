@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->

        @php
            $fromDate = date('Y-m-01');                           
            $toDate = date('Y-m-t');                           
        @endphp
        <div class="container-fluid pt-4 px-4">
            <form action="{{route('purchase_filter')}}" method="POST">
                @csrf
                <div class="row g-4">
                    <h6>Purchase > Report</h6>
                    <div class="col-md-6">
                        <div class="">
                            From  Date :
                            <input type="date" name="fromDate" value="{{request('fromDate') ?? $fromDate}}" class="form-control mt-2"
                                id="purchase_date">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="">
                            To  Date :
                            <input type="date" name="toDate" value="{{request('toDate') ?? $toDate}}" class="form-control mt-2"
                                id="purchase_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            Select Supplier :
                            <select class="form-select" aria-label="Default select example" name="supplier_fk">
                                <option selected>--Select Supplier--</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->supplier_pk }}" {{ $supplier->supplier_pk == request('supplier_fk') ? 'selected' : '' }}>
                                        {{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="">
                            Remark :
                            <input type="text" name="remark" value="@if(request('remark')){{request('remark')}}@endif" class="form-control mt-2"
                                id="remark">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn-sm btn-success">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Customer > List</h6><br>
                        <small>Click On Bill for Detail</small>
                        <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">Purchase Date</th>
                                            <th scope="col">Bill</th>
                                            <th scope="col">Suppier Name</th>
                                            <th scope="col">Total Items	</th>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Paid Amount</th>
                                            <th scope="col">Pending Amount</th>
                                            <th scope="col">Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_amount = 0;
                                            $total_paid = 0;
                                            $total_pending = 0;
                                        @endphp
                                        @foreach ($data as $row)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>@if ($row->purchase_date){{ \Carbon\Carbon::parse($row->purchase_date)->format('d-m-Y')}}@endif</td>
                                        <td>@if ($row->bill_no)<a href="{{route('purchase_detail', $row->purchase_pk)}}">{{$row->bill_no}}</a>@endif</td>
                                        <td>@if ($row->supplier->supplier_name){{$row->supplier->supplier_name}}@endif</td>
                                        <td>@if ($row->count){{$row->count}}@endif</td>
                                        <td class="text-end">@if ($row->total_amount	){{formatIndianCurrency($row->total_amount)}}@endif</td>
                                        <td class="text-end">@if ($row->paid_amt){{formatIndianCurrency($row->paid_amt)}}@endif</td>
                                        <td class="text-end">@if ($row->pending_amt){{formatIndianCurrency($row->pending_amt)}}@endif</td>
                                        <td>@if ($row->remark){{$row->remark}}@endif</td>
                                    </tr>
                                    @php
                                        $total_amount +=  $row->total_amount;
                                        $total_paid +=  $row->paid_amt;
                                        $total_pending +=  $row->pending_amt;
                                    @endphp
                                    @endforeach 
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <h5>Total : {{formatIndianCurrency($total_amount)}} &nbsp;&nbsp; | &nbsp;&nbsp; Total Paid : {{formatIndianCurrency($total_paid)}} &nbsp;&nbsp; | &nbsp;&nbsp; Total Pending : {{formatIndianCurrency($total_pending)}}</h5>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
