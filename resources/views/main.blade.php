<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - CV Algroup</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('style/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('style/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('style/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('style/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('style/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('style/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('style/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('style/plugins/dropzone/min/dropzone.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('style/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-success"> <!-- navbar-dark navbar-light -->
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-white">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a> --}}
       {{-- <div class="text-white"><i class="fas fa-user"></i> {{ Auth::user()->name }}</div> --}}
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4"> <!--sidebar-dark-primary -->
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-success">
      {{-- <img src="{{asset('style/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <i class="fab fa-glide fa-lg"></i> -
      <span class="brand-text font-weight-light">CV Algroup</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('style/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div> --}}

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}
      <hr>
      <div class="row">
        <i class="fab fa-reddit fa-4x text-dark" style="display: block;margin: 0 auto;"></i>
      </div>
      <div class="row">
        <p class="font-weight-bold" style="display: block; margin: 0 auto;">{{ Auth::user()->name }}</p>
      </div>
      <div class="row">
        <p style="display: block; margin: 0 auto;" class="text-secondary">{{ Auth::user()->role_name }}</p>
      </div>
      <hr>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link">
              <i class="nav-icon fas fa-igloo"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          @if(auth()->user()->role == "staf" || auth()->user()->role == "superadmin")
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('staf/supplier')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p class="text">Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('staf/barang')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p class="text">Barang</p>
                </a>
              </li>
              @if(auth()->user()->role == "superadmin")
              <li class="nav-item">
                <a href="{{url('staf/user')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p class="text">User</p>
                </a>
              </li>
              @endif
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-window-restore"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('staf/laporan/perencanaan/data')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p class="text">Perencanaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('staf/laporan/brgmasuk/data')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p class="text">Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('staf/laporan/brgkeluar/data')}}" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p class="text">Barang Keluar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{url('staf/perencanaan')}}" class="nav-link">
              <i class="nav-icon fas fa-feather-alt"></i>
              <p class="text">Perencanaan</p>
            </a>
          </li>
          @endif

          {{-- @if(auth()->user()->role == "user")
          <li class="nav-item">
            <a href="{{url('user/pengajuan')}}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p class="text">Pengajuan Brg</p>
            </a>
          </li>
          @endif --}}

          @if(auth()->user()->role == "ketua")
          <li class="nav-item">
            <a href="{{url('ketua/approvement')}}" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p class="text">Approvement</p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{url('staf/chat')}}" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p class="text">Pesan</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="return confirm('Apakah Yakin Akan Keluar ?');">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @yield('header_content')
    </section>

    <!-- Content -->
    <section class="content">
        @yield('content')
    </section>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2021 <a href="">CV Algroup</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('style/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('style/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('style/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('style/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('style/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('style/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('style/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('style/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('style/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('style/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('style/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('style/plugins/dropzone/min/dropzone.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('style/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('style/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('style/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('style/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('style/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('style/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('style/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('style/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('style/dist/js/demo.js')}}"></script>
<!-- Page specific script -->

@yield('jscript')

</body>
</html>
