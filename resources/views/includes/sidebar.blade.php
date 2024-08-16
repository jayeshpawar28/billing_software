<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h4 class="text-primary"></i>Billing Soft</h4>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="ms-3">
                {{-- <h6 class="mb-0">{{ Auth::user()->username ?? 'Guest' }}</h6> --}}
                {{-- <h6 class="mb-0">{{ Auth::user()->username }}</h6> --}}
                <h6 class="mb-0">@if(Auth::check())
                    {{ucfirst(Auth::user()->username) }}
                @else
                    Guest
                @endif
                </h6>
                {{-- <span>Admin</span> --}}
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{route('home')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Home</a>
            <div class="nav-item dropdown">
                <a href="{{route('suppliers')}}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Master</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{route('supplier_list')}}" class="dropdown-item">Suppliers</a>
                    <a href="{{route('customer_list')}}" class="dropdown-item">Customers</a>
                </div>
            </div>
            <a href="{{route('product_view')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Products</a>
            <a href="{{route('purchase')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Purchase</a>
            <a href="{{route('stock')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Stock</a>
            <a href="{{route('sale')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Sale</a>
            <a href="{{route('report')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Report</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->