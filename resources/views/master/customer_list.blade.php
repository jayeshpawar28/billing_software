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
                                <h6 class="">Customers > List</h6>
                                <div class="buttons">
                                    <a href="{{route('customers')}}" class="btn btn-sm btn-primary">Customer Add</a> | 
                                    <a href="{{route('customer_list')}}" class="btn btn-sm btn-primary">Customers List</a>                                
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sr.</th>
                                            <th scope="col">Cstomer Name</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$row->customer_name}}</td>
                                            <td>{{$row->mobile}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->address}}</td>
                                            <td><a href="{{route('customer_update_view', $row->customer_pk)}}">Update</a> | <a href="{{route('customer_delete', $row->customer_pk)}}">Delete</a></td>
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

