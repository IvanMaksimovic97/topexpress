<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Top Express | Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('star_admin/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  {{-- <link rel="stylesheet" href="{{ asset('star_admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('star_admin/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('star_admin/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo text-center">
                <h2>TOPEXPRESS</h2>
                <img src="{{ asset('star_admin/images/topexpresslogo2.jpg') }}" alt="logo">
              </div>
              <form action="{{ route('cms.login-back') }}" method="POST" class="pt-3">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Lozinka" required>
                </div>
                <div class="mt-3 text-center">
                  <button class="btn btn-primary" type="submit">Prijavi se</button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('star_admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('star_admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('star_admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('star_admin/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('star_admin/js/template.js') }}"></script>
  <script src="{{ asset('star_admin/js/settings.js') }}"></script>
  <script src="{{ asset('star_admin/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
