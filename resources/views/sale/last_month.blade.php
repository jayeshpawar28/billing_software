@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->


        <div class="container-fluid pt-4 px-4">
            <form method="POST" action="{{route('temp_sale_save')}}">
                @csrf
                <div class="row bg-light p-4 rounded h-100">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">sale > Last Month</h6>
                            <div class="buttons">
                                @include('sale.tabs')
                            </div>
                        </div>
                </div>

            </form>
        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Last Month sale > List</h6>
                        @include('sale.table')
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
