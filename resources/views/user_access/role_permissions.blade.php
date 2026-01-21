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
                        <h6 class="mb-0">Manage Permissions for Role: {{ $role->display_name }}</h6>
                        <a href="{{ route('user_access.manage_roles') }}" class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back to Roles
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('user_access.assign_permissions', $role->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <h6>Available Permissions:</h6>
                                @foreach($permissions as $module => $modulePermissions)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">{{ ucfirst($module) }} Module</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($modulePermissions as $permission)
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                           name="permissions[]" value="{{ $permission->id }}" 
                                                           id="permission_{{ $permission->id }}"
                                                           {{ in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                        <strong>{{ $permission->display_name }}</strong>
                                                        @if($permission->description)
                                                            <br><small class="text-muted">{{ $permission->description }}</small>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <h6>Role Information:</h6>
                                <div class="card">
                                    <div class="card-body">
                                        <p><strong>Role Name:</strong> {{ $role->name }}</p>
                                        <p><strong>Display Name:</strong> {{ $role->display_name }}</p>
                                        @if($role->description)
                                            <p><strong>Description:</strong> {{ $role->description }}</p>
                                        @endif
                                        <p><strong>Status:</strong> 
                                            <span class="badge bg-{{ $role->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($role->status) }}
                                            </span>
                                        </p>
                                        <p><strong>Current Permissions:</strong></p>
                                        @if($role->permissions->count() > 0)
                                            @foreach($role->permissions as $permission)
                                                <span class="badge bg-info me-1">{{ $permission->display_name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No permissions assigned</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update Role Permissions
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
