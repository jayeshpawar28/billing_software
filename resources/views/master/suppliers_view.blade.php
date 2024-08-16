@extends('includes.main')

@section('content')
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        @include('includes.navbar')

        <!-- Navbar End -->






        <div class="container-fluid pt-4 px-4">
            <form method="POST"
                action="{{ isset($supplier) ? route('supplier_update', $supplier->supplier_pk) : route('supplier_save') }}">
                @csrf
                <div class="row bg-light p-4 rounded h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="">Supplierss > List</h6>
                        <div class="buttons">
                            <a href="{{ route('suppliers') }}" class="btn btn-sm btn-primary">Supplier Add</a> |
                            <a href="{{ route('supplier_list') }}" class="btn btn-sm btn-primary">Supplier List</a>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('supplier_name') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" name="supplier_name"
                                value="{{ old('supplier_name', isset($supplier) ? $supplier->supplier_name : '') }}">
                            <label for="floatingInput">Supplier Name</label>
                            <span class="text-danger">
                                @error('supplier_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 120px;"
                                name="address">{{ old('address', isset($supplier) ? $supplier->address : '') }}</textarea>
                            <label for="floatingTextarea">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" name="mobile"
                                value="{{ old('mobile', isset($supplier) ? $supplier->mobile : '') }}">
                            <label for="floatingInput">Mobile No.</label>
                            <span class="text-danger">
                                @error('mobile')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="Password"
                                name="remark" value="{{ old('remark', isset($supplier) ? $supplier->remark : '') }}">
                            <label for="floatingPassword">Remark</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-3">Save</button>

                    </div>
                </div>
        </div>

        </form>
    @endsection
