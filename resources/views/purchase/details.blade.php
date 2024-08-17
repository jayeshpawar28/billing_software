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
                            <h6 class="mb-0">Purchase > Detail</h6>
                            <div class="buttons">
                                @include('purchase.tabs')
                            </div>
                        </div>
                </div>

        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        {{-- <h6 class="mb-4">Details > Purchase</h6> --}}
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Details > Purchase</h6>
                            <div class="buttons">
                                <a class="btn btn-sm btn-warning" href="{{route('update', $data->purchase_pk)}}"     target="_blank">Update</a> | 
                            <a class="btn btn-sm btn-danger" href="{{route('purchase_delete', $data->purchase_pk)}}">Delete</a> | <a class="btn btn-sm btn-success" href="{{route('purchase_print', $data->purchase_pk)}}" target="_blank">Print</a>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                Purchase Date :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->purchase_date))
                                   {{ \Carbon\Carbon::parse($data->purchase_date)->format('d-m-Y')}}
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
                                Supplier Name :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->supplier_fk))
                                    {{$data->supplier->supplier_name;}}
                                @endif
                            </div>
                            <div class="col-md-2">
                                Contact No. :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->supplier->mobile))
                                    {{$data->supplier->mobile;}}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-2">
                                Address :
                            </div>
                            <div class="col-md-4"> 
                                @if (isset($data->supplier->address))
                                    {{$data->supplier->address;}}
                                @endif
                            </div>
                        </div>

                        <h6 class="mb-4">Products Details :</h6>
                        <div class="table-responsive">

                            <table class="table table-bordered">
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
                                    
                                    @foreach ($purchse_products as $row)
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
