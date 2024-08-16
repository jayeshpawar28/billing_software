@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->


        <div class="container-fluid pt-4 px-4">
           
                @csrf
                <div class="row bg-light p-4 rounded h-100">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">sale > Detail</h6>
                            @include('sale.tabs')
                        </div>
                </div>

        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Details > sale</h6>
                            <div class="buttons">
                            <a class="btn btn-sm btn-warning" href="{{route('sale_update', $data->sale_pk)}}"     target="_blank">Update</a> | 
                             <a class="btn btn-sm btn-danger" href="{{route('sale_delete', $data->sale_pk)}}">Delete</a> | 
                             <a class="btn btn-sm btn-success" href="{{route('sale_print', $data->sale_pk)}}" target="_blank">Print</a>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                sale Date :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->sale_date))
                                {{ \Carbon\Carbon::parse($data->sale_date)->format('d-m-Y')}}
                                @endif
                            </div>
                            
                            <div class="col-md-2">
                                Bill No. :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->bill_no))
                                    {{$data->bill_no;}}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">
                                Customer Name :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->customer_fk))
                                    {{$data->customer->customer_name;}}
                                @endif
                            </div>
                            <div class="col-md-2">
                                Contact No. :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->customer->mobile))
                                    {{$data->customer->mobile;}}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-2">
                                Address :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->customer->address))
                                    {{$data->customer->address;}}
                                @endif
                            </div>
                        </div>

                        <h6 class="mb-4">Products Details :</h6>
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($sale_products as $row)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $row->product->product_name }}</td>
                                            <td>{{ formatIndianCurrency($row->rate) }}</td>
                                            <td>{{ $row->qty }}</td>
                                            <td>{{ formatIndianCurrency($row->amount) }}</td>

                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mb-4">Payment Details :</h6>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                Total Amount :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->total_amount))
                                    <b>{{formatIndianCurrency($data->total_amount)}}</b>
                                @endif
                            </div>
                            
                            <div class="col-md-2">
                                Paid Amount :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->paid_amt))
                                    <b>{{formatIndianCurrency($data->paid_amt)}}</b>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">
                                Pending Amount :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->pending_amt))
                                    <b>{{formatIndianCurrency($data->pending_amt)}}</b>
                                @endif
                            </div>
                            
                            <div class="col-md-2">
                                Remark :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->remark))
                                    {{$data->remark}}
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
