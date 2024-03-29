<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="TOP EXPRESS 2022 d.o.o. je firma koja se bavi pružanjem poštanskih usluga." />
    <meta name="author" content="Ivan Maksimović" />
    <meta name="keywords" content="top express 2022, topexpress, kurirska služba, top, express, pošta, slanje paketa, poštanske usluge, dostava" />
    <meta name="classification" content="Prijem pošiljki, Dostava pošiljki">
    <meta property="og:title" content="TOP EXPRESS 2022 d.o.o. - Beograd-Zemun">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://topexpress.rs">
    <meta property="og:site_name" content="TOP EXPRESS 2022 d.o.o. - Beograd-Zemun">
    <meta property="og:image" content="{{ asset('favicon.ico') }}">
    <!--dodaj logo-->
    <meta property="og:description" content="TOP EXPRESS 2022 d.o.o. je firma koja se bavi pružanjem poštanskih usluga.">

    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('logistics-company/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('logistics-company/css/style.css') }}" rel="stylesheet">
    
    @yield('custom-css')
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+381 11 7777733</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>office@topexpress.rs</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @if (App\Korisnik::ulogovanKorisnikSite())
                    <a class="text-white px-2" href="#">
                        <i class="fa fa-user"></i> {{ App\Korisnik::ulogovanKorisnikSite()->ime . ' ' . App\Korisnik::ulogovanKorisnikSite()->prezime }}
                    </a>
                    <a class="text-white px-2" href="{{ route('logout') }}">
                        <i class="fa fa-power-off"></i> Odjavi se
                    </a>
                    @endif
                    {{-- <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
            <a href="{{ route('index') }}" class="navbar-brand ml-lg-3">
                <h1 class="m-0 display-5 text-uppercase text-danger"><i class="fa fa-truck mr-2"></i>TOP EXPRESS 2022</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="{{ route('index') }}" class="nav-item nav-link">POČETNA</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">O NAMA</a>
                    <a href="{{ route('cenovnik') }}" class="nav-item nav-link">CENOVNIK</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="blog.html" class="dropdown-item">Blog Grid</a>
                            <a href="single.html" class="dropdown-item">Blog Detail</a>
                        </div>
                    </div> --}}
                    <a href="{{ route('contact') }}" class="nav-item nav-link">KONTAKT</a>
                    @if (App\Korisnik::ulogovanKorisnikSite())
                    <a href="{{ route('dashboard-site') }}" class="nav-item nav-link">DASHBOARD</a>
                    @else
                    <a href="{{ route('registracija') }}" class="nav-item nav-link">PRIJAVI SE</a>
                    @endif
                </div>
                {{-- <a href="" class="btn btn-primary py-2 px-4 d-none d-lg-block">Get A Quote</a> --}}
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h3 class="text-danger mb-4">TOP EXPRESS 2022</h3>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Karađorđev trg 34e, 11080 Zemun, Beograd, Srbija</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+381 11 7777733</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+381 66 8150900</p>
                        <p><i class="fa fa-envelope mr-2"></i>office@topexpress.rs</p>
                        <p><i class="fa fa-pencil-alt mr-2"></i>PIB: 112891757</p>
                        <p><i class="fa fa-pencil-alt mr-2"></i>Matični broj: 21762130</p>
                        <p><i class="fa fa-university mr-2"></i>Tekući račun: 265-1070310001720-83</p>
                        <p><i class="fa fa-university mr-2"></i>Tekući račun: 200-3455770101956-84</p>
                        {{-- <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                        </div> --}}
                    </div>
                    <div class="col-md-6 mb-5">
                        <h3 class="text-danger mb-4">Linkovi</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="{{ route('index') }}"><i class="fa fa-angle-right mr-2"></i>Početna</a>
                            <a class="text-white mb-2" href="{{ route('about') }}"><i class="fa fa-angle-right mr-2"></i>O nama</a>
                            <a class="text-white mb-2" href="{{ route('cenovnik') }}"><i class="fa fa-angle-right mr-2"></i>Cenovnik</a>
                            <a class="text-white mb-2" href="{{ route('contact') }}"><i class="fa fa-angle-right mr-2"></i>Kontakt</a>
                            <a class="text-white mb-2" href="{{ asset('site/tpe_opsti_uslovi.pdf') }}"><i class="fa fa-angle-right mr-2"></i>Opšti uslovi (PDF)</a>
                            <a class="text-white mb-2" href="{{ asset('site/tpe_cenovnik.pdf') }}"><i class="fa fa-angle-right mr-2"></i>Cenovnik usluga (PDF)</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-5">
                <h3 class="text-danger mb-4">Newsletter</h3>
                <p>Prijava za newsletter</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Vaš e-mail">
                        <div class="input-group-append">
                            <button class="btn btn-danger px-4">Prijavi se</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#" class="text-danger">TOP EXPRESS 2022</a>. Sva prava zadržana. 
				
				<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
				Designed by <a href="https://htmlcodex.com" class="text-danger">HTML Codex</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-danger back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script>
        const csrf_token = "{{ csrf_token() }}";
        const contact_route = "{{ route('send-mail-contact') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('logistics-company/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('logistics-company/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('logistics-company/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('logistics-company/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('logistics-company/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('logistics-company/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('logistics-company/js/main.js') }}"></script>

    @yield('custom-js')
</body>

</html>