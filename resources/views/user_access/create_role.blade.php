@extends('includes.main')

@section('content')
<!-- Navbar Start -->
@include('includes.navbar')
<!-- Navbar End -->

<div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="mb-0">Create New Role</h6>
                        <a href="{{ route('user_access.manage_roles') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Roles
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('user_access.store_role') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                    <div class="form-text">Unique identifier for the role (e.g., admin, manager, user)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="display_name" class="form-label">Display Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="display_name" name="display_name" 
                                           value="{{ old('display_name') }}" required>
                                    <div class="form-text">Human-readable name for the role (e.g., Administrator, Manager, User)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    <div class="form-text">Optional description of the role's purpose and responsibilities</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Role Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Role Name:</strong> Used internally by the system</p>
                                        <p><strong>Display Name:</strong> Shown to users in the interface</p>
                                        <p><strong>Description:</strong> Helps users understand the role's purpose</p>
                                        <hr>
                                        <p class="text-muted">
                                            <small>
                                                After creating the role, you can assign permissions to it 
                                                from the roles management page.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Create Role
                            </button>
                            <a href="{{ route('user_access.manage_roles') }}" class="btn btn-secondary">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
