@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->


        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card text-center bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Sales Report</h5>
                            <p class="card-text">View All the sales report with Filter.</p>
                            <a href="{{route('sale_report')}}" class="btn btn-primary">View Report</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Purchase Report</h5>
                            <p class="card-text">View All the purchase report with Filter.</p>
                            <a href="{{route('purchase_report')}}" class="btn btn-primary">View Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
