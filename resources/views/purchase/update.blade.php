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
                    <h6 class="mb-0">Purchase > Update</h6>
                    <div class="buttons">
                        @include('purchase.tabs')
                    </div>
                </div>
            </div>

        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <form action="{{ route('update_save', $data->purchase_pk) }}" method="POST">
                    @csrf
                    {{-- {{route('update_save', $data->purchase_pk)}} --}}
                    <div class="bg-light rounded h-100 p-4">
                        <span class="text-danger m-2">
                            @error('paid_amt')
                                {{$message}}
                            @enderror
                        </span>
                        {{-- <h6 class="mb-4">Details > Purchase</h6> --}}
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Update > Purchase</h6>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                Purchase Date :
                            </div>
                            <div class="col-md-4">
                                <input type="text"
                                    value="@if (isset($data->purchase_date)) {{ $data->purchase_date }} @endif"
                                    class="form-control" name="purchase_date">

                            </div>

                            <div class="col-md-2">
                                Bill No. :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->bill_no))
                                    {{ $data->bill_no }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-2">
                                Supplier Name :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->supplier_fk))
                                    {{ $data->supplier->supplier_name }}
                                @endif
                            </div>
                            <div class="col-md-2">
                                Contact No. :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->supplier->mobile))
                                    {{ $data->supplier->mobile }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-2">
                                Address :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->supplier->address))
                                    {{ $data->supplier->address }}
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
                                    @php
                                        $total_amount = 0;
                                    @endphp
                                    @foreach ($purchse_products as $row)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $row->product->product_name }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('new_product_update', ['id' => $row->purchase_product_pk, 'purchase_pk' => $data->purchase_pk]) }}">
                                                    @csrf
                                                    <input type="number" name="rate" value="{{ $row->rate }}">
                                            </td>
                                            <td>
                                                <input type="number" name="qty" value="{{ $row->qty }}">
                                                <button type="submit" class="btn btn-success btn-sm">Change</button>
                </form>
                </td>
                <td>{{ $row->amount }}</td>

                </tr>
                @php
                    $total_amount += $row->amount;
                @endphp
                @endforeach

                </tbody>
                </table>
            </div>

            <h6 class="my-4">Payment Details :</h6>
            <div class="row mb-2">
                <div class="col-md-2">
                    Total Amount :
                </div>
                <div class="col-md-4">
                    <input type="text" value="@if (isset($data->total_amount)) {{ $data->total_amount }} @endif"
                        class="form-control" name="total_amount" id="total_amount" readonly>
                </div>

                <div class="col-md-2">
                    Paid Amount :
                </div>
                <div class="col-md-4">
                    <input type="text" value="@if (isset($data->paid_amt)) {{ $data->paid_amt }} @endif"
                        class="form-control" name="paid_amt" id="paid_amt">
                </div>
            </div>

            <div class="row mb-2">


                <div class="col-md-2">
                    Remark :
                </div>
                <div class="col-md-4">
                    <textarea class="form-control" name="remark">
                @if (isset($data->remark))
                {{ $data->remark }}
                @endif
                </textarea>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success my-2">Save</button>
            </div>

        </div>

        </form>

    </div>

    </div>
    <!-- Table End -->
@endsection
