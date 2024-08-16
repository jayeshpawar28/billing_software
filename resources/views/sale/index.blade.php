@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->


        <div class="container-fluid pt-4 px-4">
            <form method="POST" action="{{ route('temp_sale_save') }}">
                @csrf
                <div class="row bg-light p-4 rounded h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Sale > Add</h6>
                        <div class="buttons">
                            @include('Sale.tabs')
                        </div>
                    </div>
                    <div class="col-8">
                        <select class="form-select" aria-label="Default select example" name="product_fk">
                            <option selected>--Select Product--</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->product_pk }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary float-start">ADD</button>
                    </div>
                </div>

            </form>
        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Sale > List</h6>
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">QTY</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_item = count($temp_sale_data);
                                        $total_qty = 0;
                                        $total_amount = 0;
                                    @endphp
                                    @foreach ($temp_sale_data as $data)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $data->product->product_name }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('temp_sale_update', $data->temp_sale_pk) }}">
                                                    @csrf
                                                    <input type="number" name="rate" value="{{ $data->rate }}">
                                            </td>
                                            <td>
                                                <input type="number" name="qty" value="{{ $data->qty }}">
                                                <button type="submit" class="btn btn-success btn-sm">Change</button>
                                                </form>
                                            </td>
                                            <td><b>{{ formatIndianCurrency($data->amount) }}</b></td>
                                            <td><a href="{{ route('temp_sale_delete', $data->temp_sale_pk) }}">Delete</a>
                                            </td>
                                        </tr>
                                        @php
                                            $total_qty += $data->qty;
                                            $total_amount += $data->amount;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                <h5>Total Item : {{ $total_item }} &nbsp;&nbsp; | &nbsp;&nbsp; Total Qty :
                                    {{ $total_qty }} &nbsp;&nbsp; | &nbsp;&nbsp; Total Amt :
                                    {{ formatIndianCurrency($total_amount) }}</h5>
                            </div>
                            <div class="text-center m-3">
                                <a class="btn btn-success" href="{{ route('confirm_sale') }}">Create Bill</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
