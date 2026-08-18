 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Midnight<sup>Lux</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="{{ route('home') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     @if (auth()->user()->hasRole('admin'))
     <!-- Divider -->
     <hr class="sidebar-divider">

     <div class="sidebar-heading">
         User Management
     </div>

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
             aria-expanded="true" aria-controls="collapseUsers">
             <i class="fas fa-fw fa-users"></i>
             <span>Users</span>
         </a>
         <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('users.index') }}">Index</a>
                 <a class="collapse-item" href="{{ route('users.create') }}">Add</a>
             </div>
         </div>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Cars Management
     </div>
      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
             aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-car"></i>
             <span>Cars</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{route('cars.index')}}">Index</a>
                 <a class="collapse-item" href="{{route('cars.create')}}">Add</a>
             </div>
         </div>
     </li>

     <hr class="sidebar-divider">

     <div class="sidebar-heading">
         Promotions
     </div>

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupons"
             aria-expanded="true" aria-controls="collapseCoupons">
            <i class="fas fa-fw fa-tags"></i>
            <span>Coupons</span>
         </a>
         <div id="collapseCoupons" class="collapse" aria-labelledby="headingCoupons" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('coupons.index') }}">Index</a>
                 <a class="collapse-item" href="{{ route('coupons.create') }}">Add</a>
             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="{{ route('veteranDiscounts.index') }}">
            <i class="fas fa-fw fa-medal"></i>
            <span>Veteran Discount</span>
         </a>
     </li>

     <hr class="sidebar-divider">

     <div class="sidebar-heading">
         Rentals
     </div>

     <li class="nav-item">
         <a class="nav-link" href="{{ route('rentDetails.index') }}">
             <i class="fas fa-fw fa-clipboard-list"></i>
             <span>Rent Requests</span>
         </a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="{{ route('transactions.index') }}">
             <i class="fas fa-fw fa-money-bill-wave"></i>
             <span>Transactions</span>
         </a>
     </li>

     <hr class="sidebar-divider">

     <div class="sidebar-heading">
         Website
     </div>

     <li class="nav-item">
         <a class="nav-link" href="{{ route('settings.index') }}">
             <i class="fas fa-fw fa-cog"></i>
             <span>Site Settings</span>
         </a>
     </li>
     @endif

     @if (auth()->user()->hasRole('customer'))
     <hr class="sidebar-divider">

     <div class="sidebar-heading">
         Rentals
     </div>

     <li class="nav-item">
         <a class="nav-link" href="{{ route('myRequests.index') }}">
             <i class="fas fa-fw fa-clipboard-list"></i>
             <span>My Requests</span>
         </a>
     </li>
     @endif

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>



 </ul>
 <!-- End of Sidebar -->
