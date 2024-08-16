@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->


        <div class="container-fluid pt-4 px-4">
            <form method="POST" action="{{isset($selected_pro) ? route('product_update', $selected_pro->product_pk) : route('product_save')}}">
                @csrf
                <div class="row bg-light p-4 rounded h-100">

                    <div class="col-3">
                        <h6 class="mb-4">Product Add</h6>
                    </div>
                    <div class="col-3">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" name="product_name"
                                value="{{ old('product_name', isset($selected_pro) ? $selected_pro->product_name : '') }}">
                            <label for="floatingInput">Product Name</label>
                            <span class="text-danger">
                                @error('product_name')
                                    {{ $message  }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('product_rate') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" name="product_rate"
                                value="{{ old('product_rate', isset($selected_pro) ? $selected_pro->product_rate : '') }}">
                            <label for="floatingInput">Product Rate</label>
                            <span class="text-danger">
                                @error('product_rate')
                                    {{ $message  }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-3">
                        <button type="submit" class="btn btn-primary mt-3 float-end">Save</button>
                    </div>
                </div>

            </form>
        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Products > List</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr.</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Rate</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $row)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$row->product_name}}</td>
                                    <td>{{formatIndianCurrency($row->product_rate)}}</td>
                                    <td><a href="{{route('product_update_view', $row->product_pk)}}">Update</a> | <a href="{{route('product_delete', $row->product_pk)}}">Delete</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
