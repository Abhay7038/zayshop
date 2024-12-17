<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
    <style>
      .footer {
          position: fixed;
          bottom: 0;
          width: 100%;
          background-color: #f8f9fa;
          padding: 20px;
          box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
      }

      /* Sidebar styling */
      .sidebar {
        background: #fff;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
      }

      .sidebar .nav {
        padding: 1rem;
      }

      .sidebar .nav-item {
        margin-bottom: 0.5rem;
      }

      .sidebar .nav-link {
        padding: 0.8rem 1rem;
        color: #333;
        border-radius: 5px;
        transition: all 0.3s ease;
      }

      .sidebar .nav-link:hover {
        background: #f8f9fa;
      }

      .sidebar .nav.sub-menu .nav-item .nav-link.active {
        color: #000;
        /* background: white; */
      }

      /* .sidebar .nav-link.active {
        background: #4B49AC;
        color: #fff;
      } */

      .sidebar .menu-title {
        font-size: 0.9rem;
        font-weight: 500;
      }

      .sidebar .menu-icon {
        margin-right: 0.8rem;
        font-size: 1.1rem;
      }

      .sidebar .menu-arrow {
        margin-left: auto;
      }

      .sidebar .nav-category {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #888;
        padding: 1rem;
        margin-top: 1rem;
      }

      /* Submenu styling */
      .sidebar .nav-item .collapse {
        margin-top: 0.5rem;
      }

      .sidebar .nav.sub-menu {
        padding: 0.5rem 0 0.5rem 2.5rem;
        background: #f8f9fa;
        border-radius: 5px;
      }

      .sidebar .nav.sub-menu .nav-item {
        margin: 0.3rem 0;
      }

      .sidebar .nav.sub-menu .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        color: #555;
        border-radius: 4px;
      }

      .sidebar .nav.sub-menu .nav-link.active1 {
        background: #4B49AC !important;
        color: #fff !important;
      }

      .sidebar .nav.sub-menu .nav-link:hover {
        background: #4B49AC;
        color: #fff;
      }

      /* Fix for selection transparency */
      ::selection {
        background: #4B49AC;
        color: #fff;
      }

      ::-moz-selection {
        background: #4B49AC;
        color: #fff;
      }

    </style>
    @yield('style')
  </head>
  <body class="with-welcome-text">
    <!-- Add debug info at top of page -->
    {{-- <div style="position: fixed; top: 0; right: 0; background: #fff; padding: 10px; z-index: 9999;">
      Current Route: {{ Route::currentRouteName() }}<br>
      Request Path: {{ request()->path() }}
    </div>
     --}}
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 fw-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/star-admin-pro/" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/star-admin-pro/"><i class="ti-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="ti-close text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
              <img src="{{asset('assets/images/logo.svg')}}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">Admin</span></h1>
              <h3 class="welcome-sub-text">Your performance summary this week </h3>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block">
              <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 fw-medium float-start">Select category</p>
                </a>
                <div class="dropdown-divider"></div>
                @if(isset($categories))
                  @foreach($categories as $category)
                  <a class="dropdown-item preview-item">
                    <div class="preview-item-content flex-grow py-2">
                      <p class="preview-subject ellipsis fw-medium text-dark">{{$category->name}}</p>
                      <p class="fw-light small-text mb-0">{{$category->description}}</p>
                    </div>
                  </a>
                  @endforeach
                @endif
              </div>
            </li>
            <li class="nav-item d-none d-lg-block">
              <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                <span class="input-group-addon input-group-prepend border-right">
                  <span class="icon-calendar input-group-text calendar-icon"></span>
                </span>
                <input type="text" class="form-control">
              </div>
            </li>
            <li class="nav-item">
              <form class="search-form" action="#">
                <i class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
              </form>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="icon-bell"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-alert m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                    <p class="fw-light small-text mb-0"> Just now </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-lock-outline m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                    <p class="fw-light small-text mb-0"> Private message </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                    <p class="fw-light small-text mb-0"> 2 days ago </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon-mail icon-lg"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 fw-medium float-start">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('assets/images/faces/face10.jpg')}}" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Marian Garner </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('assets/images/faces/face12.jpg')}}" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">David Grey </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Travis Jenkins </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image">
                  <p class="mb-1 mt-3 fw-semibold">Allen Moreno</p>
                  <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                </div>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <!-- Visit Site Link -->
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}" href="{{route('shop.index')}}">
                <i class="mdi mdi-storefront menu-icon"></i>
                <span class="menu-title">Visit Site</span>
              </a>
            </li>

            <!-- Dashboard Section -->
            <li class="nav-item nav-category">Dashboard Options</li>

            <!-- Products Section -->
            <li class="nav-item">
              <a class="nav-link {{ request()->is('products*') || request()->is('categories*') ? 'active' : '' }}" 
                 data-bs-toggle="collapse" href="#products-menu" 
                 aria-expanded="{{ request()->is('products*') || request()->is('categories*') ? 'true' : 'false' }}" 
                 aria-controls="products-menu">
                <i class="menu-icon mdi mdi-package-variant"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ request()->is('products*') || request()->is('categories*') ? 'show' : '' }}" id="products-menu">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('products') ? 'active1' : '' }}" href="{{ route('products.index') }}">
                      All Products
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('products/create') ? 'active1' : '' }}" href="{{ route('products.create') }}">
                      Add Product
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories') ? 'active1' : '' }}" href="{{ route('admin.categories.index') }}">
                      All Categories
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories/create') ? 'active1' : '' }}" href="{{ route('categories.create') }}">
                      Add Category
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <!-- Orders Section -->
            <li class="nav-item">
              <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}" 
                 data-bs-toggle="collapse" href="#orders-menu"
                 aria-expanded="{{ request()->is('orders*') ? 'true' : 'false' }}" 
                 aria-controls="orders-menu">
                <i class="menu-icon mdi mdi-cart"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ request()->is('orders*') ? 'show' : '' }}" id="orders-menu">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('orders') || request()->is('orders/*') && !request()->has('status') ? 'active1' : '' }}" 
                       href="{{ route('orders.index') }}">
                      All Orders
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <!-- User Management Section -->
            <li class="nav-item">
              <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}" 
                 data-bs-toggle="collapse" href="#user-menu"
                 aria-expanded="{{ request()->is('user*') ? 'true' : 'false' }}" 
                 aria-controls="user-menu">
                <i class="menu-icon mdi mdi-account-group"></i>
                <span class="menu-title">User Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ request()->is('user*') ? 'show' : '' }}" id="user-menu">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('user/profile') ? 'active1' : '' }}" href="pages/samples/blank-page.html">
                      Profile
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('login') ? 'active1' : '' }}" href="pages/samples/login.html">
                      Login
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ request()->is('register') ? 'active1' : '' }}" href="pages/samples/register.html">
                      Register
                    </a>
                  </li>
                </ul>
              </div>
            </li>

          </ul>
        </nav>

        <!-- Main Content -->
        @yield('admincontent')

        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
            </span>
            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">
              Copyright © 2023. All rights reserved.
            </span>
          </div>
        </footer>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/template.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <!-- <script src="{{asset('assets/js/Chart.roundedBarCharts.js')}}"></script> -->
    <!-- End custom js for this page-->
    
    <!-- Debug script -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
          if(link.classList.contains('active')) {
            console.log('Active link found:', link.href);
            console.log('Current route:', '{{ Route::currentRouteName() }}');
            console.log('Link classes:', link.className);
          }
        });
      });
    </script>
  </body>
</html>
