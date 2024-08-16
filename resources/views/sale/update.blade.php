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
                    <h6 class="mb-0">sale > Update</h6>
                    @include('sale.tabs')
                </div>
            </div>

        </div>

        <!-- Table Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <form action="{{route('sale_update_save', $data->sale_pk)}}" method="POST">
                    @csrf
                    <div class="bg-light rounded h-100 p-4">
                        {{-- <h6 class="mb-4">Details > sale</h6> --}}
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Update > sale</h6>
                            
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-2">
                                sale Date :
                            </div>
                            <div class="col-md-4">
                                <input type="date" value="@if(isset($data->sale_date)){{$data->sale_date}}@endif" class="form-control" name="sale_date">

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
                                customer Name :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->customer_fk))
                                    {{ $data->customer->customer_name }}
                                @endif
                            </div>
                            <div class="col-md-2">
                                Contact No. :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->customer->mobile))
                                    {{ $data->customer->mobile }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-2">
                                Address :
                            </div>
                            <div class="col-md-4">
                                @if (isset($data->customer->address))
                                    {{ $data->customer->address }}
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
                                    @foreach ($sale_products as $row)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $row->product->product_name }}</td>
                                            <td>
                                                <input type="number" name="rate" id="rate-{{ $row->sale_product_pk }}" value="{{ $row->rate }}">
                                            </td>
                                            <td>
                                                <input type="number" name="qty" id="qty-{{ $row->sale_product_pk }}" value="{{ $row->qty }}">
                                                <span class="btn btn-success btn-sm" onclick="updateProduct({{ $row->sale_product_pk }})">Change</span>
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
                                <input type="number" value="@if(isset($total_amount)){{$total_amount}}@endif"
                                    class="form-control" name="total_amount" id="total_amount" readonly>
                            </div>

                            <div class="col-md-2">
                                Paid Amount :
                            </div>
                            <div class="col-md-4">
                                <input type="number" value="@if(isset($data->paid_amt)){{$data->paid_amt}}@endif"
                                    class="form-control" name="paid_amt" id="paid_amt">
                            </div>
                        </div>

                        <div class="row mb-2">


                            <div class="col-md-2">
                                Remark :
                            </div>
                            <div class="col-md-4">
                                <textarea class="form-control" name="remark">@if (isset($data->remark)){{ $data->remark }}@endif</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success my-2">Save</button>
                        </div>

                    </div>

                </form>
                <script>
                    function updateProduct(sale_product_pk) {
                        var rate = document.getElementById('rate-' + sale_product_pk).value;
                        var qty = document.getElementById('qty-' + sale_product_pk).value;
                        var sale_pk = {{ $data->sale_pk }};
                        var url = '{{ route('sale_product_update', ['id' => ':id', 'sale_pk' => ':sale_pk']) }}';
                        url = url.replace(':id', sale_product_pk).replace(':sale_pk', sale_pk);
                        window.location.href = url + '?rate=' + rate + '&qty=' + qty;
                    }

                </script>

            </div>

        </div>
        <!-- Table End -->
    @endsection
