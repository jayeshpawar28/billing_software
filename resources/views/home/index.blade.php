@extends('includes.main')

@section('content')

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('includes.navbar')

            <!-- Navbar End -->

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-chart-line fa-2x text-primary mb-3"></i>
                                <h6 class="mb-2">Sale Details</h6>
                                <small>Total Sales : <b>{{ $sale ? count($sale) : 0 }}</b></small><br>
                                <a href="{{ route('all_sale')}}" style="text-decoration: none; color: inherit;">
                                    <small><u>Click</u> For More Details &gt;&gt;</small>
                                </a>    
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-list-alt fa-2x text-primary mb-3"></i>
                                <h6 class="mb-2">Purchase Details</h6>
                                <small>Total Purchase : <b>{{ $purchase ? count($purchase) : 0 }}</b></small><br>
                                <a href="{{ route('all_purchase')}}" style="text-decoration: none; color: inherit;">
                                    <small><u>Click</u> For More Details &gt;&gt;</small>
                                </a>    
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-users fa-2x text-primary mb-3"></i>
                                <h6 class="mb-2">Customer Details</h6>
                                <small>Total Customers : <b>{{ $customer ? count($customer) : 0 }}</b></small><br>
                                <a href="{{ route('customer_list')}}" style="text-decoration: none; color: inherit;">
                                    <small><u>Click</u> For More Details &gt;&gt;</small>
                                </a>    
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-light rounded text-center p-4">
                            <i class="fa fa-address-card fa-2x text-primary mb-3"></i>
                                <h6 class="mb-2">Supplier Details</h6>
                                <small>Total Suppliers : <b>{{ $supplier ? count($supplier) : 0 }}</b></small><br>
                                <a href="{{ route('supplier_list')}}" style="text-decoration: none; color: inherit;">
                                    <small><u>Click</u> For More Details &gt;&gt;</small>
                                </a>    
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            
@endsection

