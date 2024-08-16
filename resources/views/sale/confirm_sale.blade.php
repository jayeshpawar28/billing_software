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
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Products Details</h6>
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
                                    @php
                                        $todayDate = date('Y-m-d');
                                        $total_qty = 0;
                                        $total_amount = 0;
                                    @endphp
                                    @foreach ($temp_sale_data as $data)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $data->product->product_name }}</td>
                                            <td>{{ formatIndianCurrency($data->rate) }}</td>
                                            <td>{{ $data->qty }}</td>
                                            <td>{{ formatIndianCurrency($data->amount) }}</td>

                                        </tr>
                                        @php
                                            $total_qty += $data->qty;
                                            $total_amount += $data->amount;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><b>{{ $total_qty }}</b></td>
                                        <td><b>{{ formatIndianCurrency($total_amount) }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <form method="POST" action="{{route('sale_save')}}">
                                    @csrf
                                <h6 class="mb-4">Customer Details</h6>
                                <input type="hidden" name="total_amount" value="{{$total_amount}}">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        Select Customer :
                                        <select class="form-select" aria-label="Default select example" name="customer_fk">
                                            <option selected>--Select Customer--</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->customer_pk }}">{{ $customer->customer_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            Purchase Date :
                                            <input type="date" name="sale_date" value="{{ $todayDate }}" class="form-control"
                                                id="sale_date">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="">
                                            Paid Amount :
                                            <input type="number" name="paid_amt" value="" class="form-control"
                                                id="paid" oninput="calculatePendingAmount()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            Pending Amount :
                                            <input type="number" name="pending_amt" value="{{$total_amount}}" class="form-control" id="pending_amt" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">   
                                    <div class="col-md-6">
                                        Remark :
                                        <textarea class="form-control"  style="height: 120px;" name="remark"></textarea>
                                    </div>
                                </div>

                                <div class="text-center m-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            <script type="text/javascript">

                                function calculatePendingAmount() {
                                    var totalAmount = {{$total_amount}}; 
                                    var paidAmount = document.getElementById('paid').value;
                                    var pendingAmount = totalAmount - paidAmount; 
                                    
                                    if (pendingAmount < 0) {
                                        pendingAmount = 0;
                                    }
                            
                                    document.getElementById('pending_amt').value = pendingAmount; 
                                }
                            </script>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table End -->
    @endsection
