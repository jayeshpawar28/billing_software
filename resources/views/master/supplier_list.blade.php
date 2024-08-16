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
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="">Supplierss > List</h6>
                                <div class="buttons">
                                    <a href="{{route('suppliers')}}" class="btn btn-sm btn-primary">Supplier Add</a> | 
                                    <a href="{{route('supplier_list')}}" class="btn btn-sm btn-primary">Supplier List</a>                                
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">Supplier Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$row->supplier_name}}</td>
                                            <td>{{$row->mobile}}</td>
                                            <td>{{$row->address}}</td>
                                            <td>{{$row->remark}}</td>
                                            <td><a href="{{route('supplier_update_view', $row->supplier_pk)}}">Update</a> | <a href="{{route('supplier_delete', $row->supplier_pk)}}">Delete</a></td>
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

