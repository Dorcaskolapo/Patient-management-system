
<!DOCTYPE html>
<html lang="en">

@php
    $admin = Auth::guard('admin')->user();
@endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon-32x32.png')}}">
    <!-- Base Styling  -->
    <link rel="stylesheet" href="{{asset('assets/main/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/main/css/style.css')}}">
</head>

<body>
    @include('sweetalert::alert')
    <div id="main-wrapper" class="show">

        <!-- start logo components -->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html"> <img class="logo-tabib" src="{{asset('assets/images/download.png')}}" alt=""></a>
                <a href="index.html"><img class="brand-title" src="{{asset('assets/images/logo.png')}}" alt=""></a>
            </div>
        </div>
        <!-- End logo components -->


        <!-- start section sidebar -->
        <aside class="left-panel nicescroll-box">
            <nav class="navigation">
                <ul class="list-unstyled main-menu">

                    <li class="has-submenu">
                        <a href="{{ url('/admin/home') }}">
                            <i class="fas fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void()" class="has-arrow mm-collapsed">
                            <i class="fas fa-user-md"></i>
                            <span class="nav-label">Staffs</span>
                        </a>
                        <ul class="list-unstyled mm-collapse">
                            <li><a href="{{ url('/admin/staff') }}">Add Staff</a></li>
                            <li><a href="{{ url('/admin/allStaff') }}">All Staffs</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void()" class="has-arrow mm-collapsed">
                            <i class="fas fa-users"></i>
                            <span class="nav-label">Patients</span>
                        </a>
                        <ul class="list-unstyled mm-collapse">
                            <li><a href="{{ url('/admin/patient') }}">New Patient</a></li>
                            <li><a href="{{ url('/admin/allPatient') }}">All Patients</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="javascript:void()" class="has-arrow mm-collapsed">
                            <i class="fas fa-book-medical"></i>
                            <span class="nav-label">Prescriptions</span>
                        </a>
                        <ul class="list-unstyled mm-collapse">
                            <li><a href="{{ url('/admin/prescription') }}">New Prescription</a></li>
                            <li><a href="{{ url('/admin/allPrescription') }}">All Prescriptions</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ url('/admin/drug') }}">
                            <i class="fas fa-pills"></i>
                            <span class="nav-label">Add Drug</span>
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ url('/admin/test') }}">
                            <i class="fas fa-heartbeat"></i>
                            <span class="nav-label">Add Test</span>
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ url('/admin/bloodgroup') }}">
                            <i class="fas fa-tint"></i>
                            <span class="nav-label">Add Bloodgroup</span>
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="{{ url('/admin/genotype') }}">
                            <i class="fas fa-tint"></i>
                            <span class="nav-label">Add Genotype</span>
                        </a>
                    </li>
                    {{-- <li class="has-submenu">
                        <a href="javascript:void()" class="has-arrow mm-collapsed">
                            <i class="fas fa-file-invoice"></i>
                            <span class="nav-label">Billing</span>
                        </a>
                        <ul class="list-unstyled mm-collapse">
                            <li><a href="{{ url('/admin/billing') }}">Create Invoice</a></li>
                            <li><a href="{{ url('/admin/allBilling') }}">Invoice List</a></li>
                        </ul>
                    </li> --}}
                    <li class="has-submenu">
                        <a href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-in-alt"></i>
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-widgets">
                <div class="copyright text-center">
                    <p class="mb-0"> Admin Dashboard</p>
                    <script>document.write(new Date().getFullYear())</script> &copy; {{ env('APP_NAME') }} 
                </div>
            </div>
        </aside>
        <!-- End section sidebar -->

        <!-- start section header -->
        <div class="header">
            <header class="top-head container-fluid">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
                <div class="header-right">
                    <div class="fullscreen notification_dropdown widget-5">
                        <div class="full">
                            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="fas fa-expand"></i>
                            </a>
                        </div>
                    </div>
                    <div class="my-account-wrapper widget-7">
                        <div class="account-wrapper">
                            <div class="account-control">
                                <a class="login header-profile" href="#" title="Sign in">
                                    <div class="header-info">
                                        <span>{{ $admin->name }}</span>
                                        <small>Admin</small>
                                    </div>
                                    <img src="{{asset('assets/images/client.jpg')}}" alt="people">
                                </a>
                                <div class="account-dropdown-form dropdown-container">
                                    <div class="form-content">
                                        <a href="doctor-settings.html">
                                            <i class="far fa-user"></i>
                                            <span class="ml-2">Profile</span>
                                        </a>
                                        <a href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-in-alt"></i>
                                            <span class="ml-2">Logout </span>
                                            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">@csrf</form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- End section header -->


       
        @yield('content')
            


    </div>

    <!-- JQuery v3.5.1 -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

    <!-- popper js -->
    <script src="{{asset('assets/plugins/popper/popper.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Moment -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>

    <!-- Date Range Picker -->
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.min.js')}}"></script>

    <!-- Datatable -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/init-tdatatable.js')}}"></script>

    <!-- Main Custom JQuery -->
    <script src="{{asset('assets/js/toggleFullScreen.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/option-themes.js')}}"></script>

</body>


</html>