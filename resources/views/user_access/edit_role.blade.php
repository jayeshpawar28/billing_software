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
                        <h6 class="mb-0">Edit Role: {{ $role->display_name }}</h6>
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

                    <form action="{{ route('user_access.update_role', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $role->name) }}" required>
                                    <div class="form-text">Unique identifier for the role (e.g., admin, manager, user)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="display_name" class="form-label">Display Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="display_name" name="display_name" 
                                           value="{{ old('display_name', $role->display_name) }}" required>
                                    <div class="form-text">Human-readable name for the role (e.g., Administrator, Manager, User)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $role->description) }}</textarea>
                                    <div class="form-text">Optional description of the role's purpose and responsibilities</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Role Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Role ID:</strong> {{ $role->id }}</p>
                                        <p><strong>Created:</strong> {{ $role->created_at ? $role->created_at->format('M d, Y') : 'N/A' }}</p>
                                        <p><strong>Updated:</strong> {{ $role->updated_at ? $role->updated_at->format('M d, Y') : 'N/A' }}</p>
                                        <hr>
                                        <p><strong>Current Permissions:</strong></p>
                                        @if($role->permissions->count() > 0)
                                            <span class="badge bg-info">{{ $role->permissions->count() }} permissions assigned</span>
                                        @else
                                            <span class="text-muted">No permissions assigned</span>
                                        @endif
                                        <hr>
                                        <a href="{{ route('user_access.role_permissions', $role->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fa fa-key"></i> Manage Permissions
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update Role
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
