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
                        <h6 class="mb-0">Manage Roles</h6>
                        <div>
                            <a href="{{ route('user_access.create_role') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Create New Role
                            </a>
                            <a href="{{ route('user_access.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-arrow-left"></i> Back to Users
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Display Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->description ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $role->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($role->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($role->permissions->count() > 0)
                                            <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                                        @else
                                            <span class="text-muted">No permissions</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user_access.role_permissions', $role->id) }}" 
                                           class="btn btn-sm btn-warning me-1">
                                            <i class="fa fa-key"></i> Permissions
                                        </a>
                                        <a href="{{ route('user_access.edit_role', $role->id) }}" 
                                           class="btn btn-sm btn-primary me-1">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('user_access.delete_role', $role->id) }}" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Are you sure you want to delete this role?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No roles found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
