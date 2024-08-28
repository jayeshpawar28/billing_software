@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->


        <div class="container-fluid pt-4 px-4">
            <form method="POST"
                action="{{ isset($customer) ? route('customer_update', $customer->customer_pk) : route('customer_save') }}">
                @csrf
                <div class="row bg-light p-4 rounded h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="">Customers > Add</h6>
                        <div class="buttons">
                            <a href="{{route('customers')}}" class="btn btn-sm btn-primary">Customer Add</a> | 
                            <a href="{{route('customer_list')}}" class="btn btn-sm btn-primary">Customers List</a>                                
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" name="customer_name"
                                value="{{ old('customer_name', isset($customer) ? $customer->customer_name : '') }}">
                            <label for="floatingInput">Customer Name</label>
                            <span class="text-danger">
                                @error('customer_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" name="mobile"
                                value="{{ old('mobile', isset($customer) ? $customer->mobile : '') }}">
                            <label for="floatingInput">Mobile No.</label>
                            <span class="text-danger">
                                @error('mobile')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Password"
                                name="email" value="{{ old('email', isset($customer) ? $customer->email : '') }}">
                            <label for="floatingPassword">Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 120px;"
                                name="address">{{ old('address', isset($customer) ? $customer->address : '') }}</textarea>
                            <label for="floatingTextarea">Address</label>
                        </div>


                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-3">Save</button>

                    </div>
                </div>
        </div>

        </form>
    @endsection
