@extends('includes.main')

@section('content')

        <!-- Content Start -->
        <div class="content">

            {{-- navbar --}}
            @include('includes.navbar')
            {{-- navbar --}}
            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-4">Stock > Update</h6>
                                <div class="buttons">
                                    <a class="btn btn-sm btn-warning" href="{{route('stock_update')}}">Update Stock</a>
                                </div>
                            </div>
                            <form action="{{route('stock_update_save')}}" method="post">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr.</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">QTY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$product->product_name}}</td>
                                                <td><input type="number" name="product_qty[{{$product->product_pk}}]"value="{{$product->qty ?? ''}}"></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center m-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->
            
        
            
@endsection

