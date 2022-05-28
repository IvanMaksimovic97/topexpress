<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css'.'?v='.time()) }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  {{-- <link rel="stylesheet" href="{{ asset('star_admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('star_admin/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('star_admin/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
  <style>
    * {
      text-transform: uppercase;
    }
  </style>
  @yield('custom-css')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="{{ route('cms.dashboard') }}">
            <img style="width:100%; height:70px;" src="{{ asset('star_admin/images/topexpresslogo2.jpg') }}" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('cms.dashboard') }}">
            <img style="width:100%; height:auto;" src="{{ asset('star_admin/images/topexpresslogo2.jpg') }}" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Dobro došli, <span class="text-black fw-bold">{{ App\Korisnik::ulogovanKorisnik()->ime .' '.App\Korisnik::ulogovanKorisnik()->prezime }}</span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"><span class="icon-menu"></span></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <p class="mb-1 mt-3 font-weight-semibold">{{ App\Korisnik::ulogovanKorisnik()->ime .' '.App\Korisnik::ulogovanKorisnik()->prezime }}</p>
                <p class="fw-light text-muted mb-0">{{ App\Korisnik::ulogovanKorisnik()->email }}</p>
              </div>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Poruke</a>
              <a class="dropdown-item" href="{{ route('cms.logout') }}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Odjavi se</a>
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
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial:partials/_sidebar.html -->
      @include('partials.nav')
      <!-- partial -->
      <div class="main-panel" style="margin-left: 220px">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">topexpress.rs</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © {{ date('Y') }}. Sva prava zadržana.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('star_admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('star_admin/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('star_admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('star_admin/vendors/progressbar.js/progressbar.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('star_admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('star_admin/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('star_admin/js/template.js') }}"></script>
  <script src="{{ asset('star_admin/js/settings.js') }}"></script>
  <script src="{{ asset('star_admin/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('star_admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
  <script src="{{ asset('star_admin/js/dashboard.js') }}"></script>
  <script src="{{ asset('star_admin/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->

  <script>
    var razduzi = false;

    $(document).on('change', '.posiljka-status', function() {
      const id = $(this).data('id');
      const dostava_id = $(this).data('spisakid');
      const status = parseInt($(this).val());

      let rowColor = '';
      let row = $(this).parent().parent();

      switch(status) {
        case 2:
          rowColor = 'table-success';
        break;
        case 3:
          rowColor = 'table-danger';
        break;
        case 4:
          rowColor = 'table-info';
        break;
        default:
          // code block
      }

      $.ajax({
        url: '{{ route('cms.posiljka-status') }}' + '/' + id + '/' + dostava_id + '/' + status,
        method: 'get',
        success: function (data) {
          row.removeClass('table-success');
          row.removeClass('table-danger');
          row.removeClass('table-info');
          row.addClass(rowColor);
          
          razduzi = data.razduzi;
        },
        error: function (err) {
          alert('Neuspešna izmena statusa.');
        }
      })
    });

    $(document).on('click', '#razduzi', function(e) {
      // e.preventDefault();
      // console.log(razduzi);
      if (!razduzi) {
        e.preventDefault();
        alert('NIJE MOGUĆE RAZDUŽITI SPISAK, PROVERITE STATUSE POŠILJAKA!');
      }
    })
  </script>

  @yield('custom-js')
</body>
</html>