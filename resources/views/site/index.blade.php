@extends('template.site')
@section('title', 'TOP EXPRESS 2022 d.o.o.')
@section('content')
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid mb-5">
	<div class="container text-center py-5">
		{{-- <h1 class="text-primary mb-4">Safe & Faster</h1> --}}
		<h1 class="text-white display-3 mb-5">Praćenje pošiljke</h1>
		<div class="mx-auto" style="width: 100%; max-width: 600px;">
			<div class="input-group">
				<input type="text" id="broj_posiljke" class="form-control border-light" style="padding: 30px;" placeholder="Unesite broj pošiljke">
				<div class="input-group-append">
					<button class="btn btn-danger px-3" id="pretraga">Pretraga</button>
				</div>
				<div class="invalid-feedback">
					Pogrešan format! Format pošiljke je: TEXXXXXXBG (X mora biti broj!)
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Header End -->


<!-- About Start -->
{{-- <div class="container-fluid py-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5 pb-4 pb-lg-0">
				<img class="img-fluid w-100" src="{{ asset('logistics-company/img/about.jpg') }}" alt="">
				<div class="bg-primary text-dark text-center p-4">
					<h3 class="m-0">25+ Years Experience</h3>
				</div>
			</div>
			<div class="col-lg-7">
				<h6 class="text-primary text-uppercase font-weight-bold">About Us</h6>
				<h1 class="mb-4">Trusted & Faster Logistic Service Provider</h1>
				<p class="mb-4">Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo</p>
				<div class="d-flex align-items-center pt-2">
					<button type="button" class="btn-play" data-toggle="modal"
						data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
						<span></span>
					</button>
					<h5 class="font-weight-bold m-0 ml-4">Play Video</h5>
				</div>
			</div>
		</div>
	</div>
	<!-- Video Modal -->
	<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>        
					<!-- 16:9 aspect ratio -->
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> --}}
<!-- About End -->


<!--  Quote Request Start -->
{{-- <div class="container-fluid bg-secondary my-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 py-5 py-lg-0">
				<h6 class="text-primary text-uppercase font-weight-bold">Get A Quote</h6>
				<h1 class="mb-4">Request A Free Quote</h1>
				<p class="mb-4">Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos et erat sed diam duo</p>
				<div class="row">
					<div class="col-sm-4">
						<h1 class="text-primary mb-2" data-toggle="counter-up">225</h1>
						<h6 class="font-weight-bold mb-4">SKilled Experts</h6>
					</div>
					<div class="col-sm-4">
						<h1 class="text-primary mb-2" data-toggle="counter-up">1050</h1>
						<h6 class="font-weight-bold mb-4">Happy Clients</h6>
					</div>
					<div class="col-sm-4">
						<h1 class="text-primary mb-2" data-toggle="counter-up">2500</h1>
						<h6 class="font-weight-bold mb-4">Complete Projects</h6>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="bg-primary py-5 px-4 px-sm-5">
					<form class="py-5">
						<div class="form-group">
							<input type="text" class="form-control border-0 p-4" placeholder="Your Name" required="required" />
						</div>
						<div class="form-group">
							<input type="email" class="form-control border-0 p-4" placeholder="Your Email" required="required" />
						</div>
						<div class="form-group">
							<select class="custom-select border-0 px-4" style="height: 47px;">
								<option selected>Select A Service</option>
								<option value="1">Service 1</option>
								<option value="2">Service 1</option>
								<option value="3">Service 1</option>
							</select>
						</div>
						<div>
							<button class="btn btn-dark btn-block border-0 py-3" type="submit">Get A Quote</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div> --}}
<!-- Quote Request Start -->

<!-- Features Start -->
<div class="container-fluid bg-secondary my-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5">
				<img class="img-fluid w-50" src="{{ asset('site/images/nemanja_dostavljac.jpg') }}" alt="dostavljac">
			</div>
			<div class="col-lg-7 py-5 py-lg-0">
				{{-- <h6 class="text-danger text-uppercase font-weight-bold">Preuzimanje</h6> --}}
				<h1 class="mb-4">Preuzimanje pošiljaka</h1>
				<p class="mb-4">Zakažite kurira u vreme kada Vam odgovara da pošaljete pošiljku</p>
				{{-- <ul class="list-inline">
					<li><h6><i class="far fa-dot-circle text-primary mr-3"></i>Best In Industry</h6>
					<li><h6><i class="far fa-dot-circle text-primary mr-3"></i>Emergency Services</h6></li>
					<li><h6><i class="far fa-dot-circle text-primary mr-3"></i>24/7 Customer Support</h6></li>
				</ul>
				<a href="" class="btn btn-primary mt-3 py-2 px-4">Learn More</a> --}}
			</div>
		</div>
	</div>
</div>
<!-- Features End -->

<!-- Services Start -->
<div class="container-fluid pt-5">
	<div class="container">
		<div class="text-center pb-2">
			<h6 class="text-danger text-uppercase font-weight-bold">Naše usluge</h6>
			<h1 class="mb-4">Sve usluge</h1>
		</div>
		<div class="row pb-3">
			<div class="col-lg-4 col-md-6 text-center mb-5">
				<div class="d-flex align-items-center justify-content-center bg-danger mb-4 p-4">
					{{-- <i class="fa fa-2x fa-truck text-dark pr-3"></i> --}}
					<h6 class="text-white font-weight-medium m-0">Danas za sutra</h6>
				</div>
				<p>Pošiljke koje pošaljete u toku dana, biće isporučene prvog narednog dana.</p>
				<a class="border-bottom text-decoration-none" href="{{ route('cenovnik') }}#danaszasutra">Cenovnik</a>
			</div>
			<div class="col-lg-4 col-md-6 text-center mb-5">
				<div class="d-flex align-items-center justify-content-center bg-danger mb-4 p-4">
					{{-- <i class="fa fa-2x fa fa-plane text-dark pr-3"></i> --}}
					<h6 class="text-white font-weight-medium m-0">Danas za danas</h6>
				</div>
				<p>Pošiljke koje koje pošaljete u toku dana, biče isporučene istog dana do 19:00h.</p>
				<a class="border-bottom text-decoration-none" href="{{ route('cenovnik') }}#danaszadanas">Cenovnik</a>
			</div>
			<div class="col-lg-4 col-md-6 text-center mb-5">
				<div class="d-flex align-items-center justify-content-center bg-danger mb-4 p-4">
					{{-- <i class="fa fa-2x fa fa-rocket text-dark pr-3"></i> --}}
					<h6 class="text-white font-weight-medium m-0">Danas za odmah</h6>
				</div>
				<p>Pošiljke koje pošaljete u toku dana, biće isporučene u roku od tri sata od vašeg poziva.</p>
				<a class="border-bottom text-decoration-none" href="{{ route('cenovnik') }}#danaszaodmah">Cenovnik</a>
			</div>
			{{-- <div class="col-lg-3 col-md-6 text-center mb-5">
				<div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
					<i class="fa fa-2x fa-store text-dark pr-3"></i>
					<h6 class="text-white font-weight-medium m-0">Cargo Storage</h6>
				</div>
				<p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet diam sea est diam</p>
				<a class="border-bottom text-decoration-none" href="">Read More</a>
			</div> --}}
		</div>
	</div>
</div>
<!-- Services End -->


<!-- Features Start -->
<div class="container-fluid bg-secondary my-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 py-5 py-lg-0">
				{{-- <h6 class="text-danger text-uppercase font-weight-bold">Preuzimanje</h6> --}}
				<h1 class="mb-4">Dostava pošiljaka</h1>
				<p class="mb-4">Dostavljanje pošiljaka u dogovoreno vreme na mesto gde Vama odgovara!</p>
				{{-- <ul class="list-inline">
					<li><h6><i class="far fa-dot-circle text-primary mr-3"></i>Best In Industry</h6>
					<li><h6><i class="far fa-dot-circle text-primary mr-3"></i>Emergency Services</h6></li>
					<li><h6><i class="far fa-dot-circle text-primary mr-3"></i>24/7 Customer Support</h6></li>
				</ul>
				<a href="" class="btn btn-primary mt-3 py-2 px-4">Learn More</a> --}}
			</div>
			<div class="col-lg-5">
				<img class="img-fluid w-100" src="{{ asset('site/images/dostavljac3.jpg') }}" alt="dostavljac">
			</div>
		</div>
	</div>
</div>
<!-- Features End -->


<!-- Pricing Plan Start -->
{{-- <div class="container-fluid pt-5">
	<div class="container">
		<div class="text-center pb-2">
			<h6 class="text-primary text-uppercase font-weight-bold">Pricing Plan</h6>
			<h1 class="mb-4">Affordable Pricing Packages</h1>
		</div>
		<div class="row">
			<div class="col-md-4 mb-5">
				<div class="bg-secondary">
					<div class="text-center p-4">
						<h1 class="display-4 mb-0">
							<small class="align-top text-muted font-weight-medium" style="font-size: 22px; line-height: 45px;">$</small>49<small class="align-bottom text-muted font-weight-medium" style="font-size: 16px; line-height: 40px;">/Mo</small>
						</h1>
					</div>
					<div class="bg-primary text-center p-4">
						<h3 class="m-0">Basic</h3>
					</div>
					<div class="d-flex flex-column align-items-center py-4">
						<p>HTML5 & CSS3</p>
						<p>Bootstrap 4</p>
						<p>Responsive Layout</p>
						<p>Compatible With All Browsers</p>
						<a href="" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-5">
				<div class="bg-secondary">
					<div class="text-center p-4">
						<h1 class="display-4 mb-0">
							<small class="align-top text-muted font-weight-medium" style="font-size: 22px; line-height: 45px;">$</small>99<small class="align-bottom text-muted font-weight-medium" style="font-size: 16px; line-height: 40px;">/Mo</small>
						</h1>
					</div>
					<div class="bg-primary text-center p-4">
						<h3 class="m-0">Premium</h3>
					</div>
					<div class="d-flex flex-column align-items-center py-4">
						<p>HTML5 & CSS3</p>
						<p>Bootstrap 4</p>
						<p>Responsive Layout</p>
						<p>Compatible With All Browsers</p>
						<a href="" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-5">
				<div class="bg-secondary">
					<div class="text-center p-4">
						<h1 class="display-4 mb-0">
							<small class="align-top text-muted font-weight-medium" style="font-size: 22px; line-height: 45px;">$</small>149<small class="align-bottom text-muted font-weight-medium" style="font-size: 16px; line-height: 40px;">/Mo</small>
						</h1>
					</div>
					<div class="bg-primary text-center p-4">
						<h3 class="m-0">Business</h3>
					</div>
					<div class="d-flex flex-column align-items-center py-4">
						<p>HTML5 & CSS3</p>
						<p>Bootstrap 4</p>
						<p>Responsive Layout</p>
						<p>Compatible With All Browsers</p>
						<a href="" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> --}}
<!-- Pricing Plan End -->


<!-- Team Start -->
{{-- <div class="container-fluid pt-5">
	<div class="container">
		<div class="text-center pb-2">
			<h6 class="text-primary text-uppercase font-weight-bold">Delivery Team</h6>
			<h1 class="mb-4">Meet Our Delivery Team</h1>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="team card position-relative overflow-hidden border-0 mb-5">
					<img class="card-img-top" src="{{ asset('logistics-company/img/team-1.jpg') }}" alt="">
					<div class="card-body text-center p-0">
						<div class="team-text d-flex flex-column justify-content-center bg-secondary">
							<h5 class="font-weight-bold">Full Name</h5>
							<span>Designation</span>
						</div>
						<div class="team-social d-flex align-items-center justify-content-center bg-primary">
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
							<a class="btn btn-outline-dark btn-social" href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="team card position-relative overflow-hidden border-0 mb-5">
					<img class="card-img-top" src="{{ asset('logistics-company/img/team-2.jpg') }}" alt="">
					<div class="card-body text-center p-0">
						<div class="team-text d-flex flex-column justify-content-center bg-secondary">
							<h5 class="font-weight-bold">Full Name</h5>
							<span>Designation</span>
						</div>
						<div class="team-social d-flex align-items-center justify-content-center bg-primary">
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
							<a class="btn btn-outline-dark btn-social" href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="team card position-relative overflow-hidden border-0 mb-5">
					<img class="card-img-top" src="{{ asset('logistics-company/img/team-3.jpg') }}" alt="">
					<div class="card-body text-center p-0">
						<div class="team-text d-flex flex-column justify-content-center bg-secondary">
							<h5 class="font-weight-bold">Full Name</h5>
							<span>Designation</span>
						</div>
						<div class="team-social d-flex align-items-center justify-content-center bg-primary">
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
							<a class="btn btn-outline-dark btn-social" href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="team card position-relative overflow-hidden border-0 mb-5">
					<img class="card-img-top" src="{{ asset('logistics-company/img/team-4.jpg') }}" alt="">
					<div class="card-body text-center p-0">
						<div class="team-text d-flex flex-column justify-content-center bg-secondary">
							<h5 class="font-weight-bold">Full Name</h5>
							<span>Designation</span>
						</div>
						<div class="team-social d-flex align-items-center justify-content-center bg-primary">
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
							<a class="btn btn-outline-dark btn-social" href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> --}}
<!-- Team End -->


<!-- Testimonial Start -->
{{-- <div class="container-fluid py-5">
	<div class="container">
		<div class="text-center pb-2">
			<h6 class="text-danger text-uppercase font-weight-bold">Recenzije</h6>
			<h1 class="mb-4">Šta kažu naši klijenti</h1>
		</div>
		<div class="owl-carousel testimonial-carousel">
			<div class="position-relative bg-secondary p-4">
				<i class="fa fa-3x fa-quote-right text-danger position-absolute" style="top: -6px; right: 0;"></i>
				<div class="d-flex align-items-center mb-3">
					<img class="img-fluid rounded-circle" src="{{ asset('logistics-company/img/testimonial-1.jpg') }}" style="width: 60px; height: 60px;" alt="klijent">
					<div class="ml-3">
						<h6 class="font-weight-semi-bold m-0">Igor Petrović</h6>
						<small>- Ekonimsita</small>
					</div>
				</div>
				<p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
			</div>
			<div class="position-relative bg-secondary p-4">
				<i class="fa fa-3x fa-quote-right text-danger position-absolute" style="top: -6px; right: 0;"></i>
				<div class="d-flex align-items-center mb-3">
					<img class="img-fluid rounded-circle" src="{{ asset('logistics-company/img/testimonial-2.jpg') }}" style="width: 60px; height: 60px;" alt="klijent">
					<div class="ml-3">
						<h6 class="font-weight-semi-bold m-0">Marko Lazić</h6>
						<small>- Advokat</small>
					</div>
				</div>
				<p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
			</div>
			<div class="position-relative bg-secondary p-4">
				<i class="fa fa-3x fa-quote-right text-danger position-absolute" style="top: -6px; right: 0;"></i>
				<div class="d-flex align-items-center mb-3">
					<img class="img-fluid rounded-circle" src="{{ asset('logistics-company/img/testimonial-3.jpg') }}" style="width: 60px; height: 60px;" alt="klijent">
					<div class="ml-3">
						<h6 class="font-weight-semi-bold m-0">Miroslav Stefanović</h6>
						<small>- Profesor</small>
					</div>
				</div>
				<p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
			</div>
			<div class="position-relative bg-secondary p-4">
				<i class="fa fa-3x fa-quote-right text-danger position-absolute" style="top: -6px; right: 0;"></i>
				<div class="d-flex align-items-center mb-3">
					<img class="img-fluid rounded-circle" src="{{ asset('logistics-company/img/testimonial-4.jpg') }}" style="width: 60px; height: 60px;" alt="klijent">
					<div class="ml-3">
						<h6 class="font-weight-semi-bold m-0">Lazar Jovanović</h6>
						<small>- Pravnik</small>
					</div>
				</div>
				<p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr clita lorem. Dolor ipsum sanct clita</p>
			</div>
		</div>
	</div>
</div> --}}
<!-- Testimonial End -->

<div class="container-fluid my-5">
	<div class="container">
		<div class="row align-items-center">
			<div class="col">
				<h4>Na mapi su označene opštine crvenom bojom na kojima vršimo usluge</h4>
				<ul>
					<li>Beograd</li>
					<li>Novi Sad</li>
					<li>Smederevo</li>
					<li>Arandjelovac</li>
					<li>Sremski Karlovci</li>
					<li>Stara Pazova</li>
					<li>Inđija</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="map" style="height:500px;width:100%"></div>

<!-- Modal -->
<div class="modal fade" id="posiljka-status-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Pretraga pošiljke</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" id="posiljka-telo">
			<div class="text-center">
				<div class="spinner-border" role="status">
				  	<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		{{-- <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-danger">Save changes</button>
		</div> --}}
	  </div>
	</div>
</div>
@endsection

@section('custom-js')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
<script>
// Initialize and add the map
function initMap() {
//   // The location of Uluru
//   const uluru = { lat: 44.787197, lng: 20.457273 };
//   // The map, centered at Uluru
//   const map = new google.maps.Map(document.getElementById("map"), {
//     zoom: 12,
//     center: uluru,
//   });
//   // The marker, positioned at Uluru
//   const marker = new google.maps.Marker({
//     position: uluru,
//     map: map,
//   });

// Initialize some map with center at Bucaramanga
	var map = new google.maps.Map(document.getElementById('map'), {
		center: {
			lat: 44.787197,
			lng: 20.457273
		},
		zoom: 9,
		mapTypeId: 'roadmap'
	});

	// An array with the coordinates of the boundaries of Bucaramanga, extracted manually from the GADM database
	var BelgradeDelimiters = [
		{ lng: 20.4333248130001, lat: 44.4128532410001 },
		{ lng: 20.4270172120002, lat: 44.4082183840002 },
		{ lng: 20.4241905220001, lat: 44.4065093990001 },
		{ lng: 20.4219684610002, lat: 44.4056091320001 },
		{ lng: 20.4196033480001, lat: 44.404937745 },
		{ lng: 20.4135227200001, lat: 44.4037742610001 },
		{ lng: 20.4114170070002, lat: 44.4032630920001 },
		{ lng: 20.4095382680001, lat: 44.402545929 },
		{ lng: 20.4074211120001, lat: 44.4011154190002 },
		{ lng: 20.402978896, lat: 44.3968658450001 },
		{ lng: 20.3988780970001, lat: 44.3925323490002 },
		{ lng: 20.397314071, lat: 44.390605926 },
		{ lng: 20.3967018120001, lat: 44.3893508900001 },
		{ lng: 20.3965435020002, lat: 44.3884315490002 },
		{ lng: 20.3969936380001, lat: 44.3861732490002 },
		{ lng: 20.3984546660002, lat: 44.3834724420001 },
		{ lng: 20.399551391, lat: 44.3821792610001 },
		{ lng: 20.4054317480001, lat: 44.3781242370002 },
		{ lng: 20.4127159120001, lat: 44.3725852970002 },
		{ lng: 20.415555953, lat: 44.3711776740001 },
		{ lng: 20.4195003500001, lat: 44.3696060180001 },
		{ lng: 20.422065735, lat: 44.368183136 },
		{ lng: 20.4269466390001, lat: 44.363765716 },
		{ lng: 20.4312496180001, lat: 44.3602600100001 },
		{ lng: 20.4328079210001, lat: 44.3582229610002 },
		{ lng: 20.4332466120001, lat: 44.3569908140001 },
		{ lng: 20.4332408910001, lat: 44.35610962 },
		{ lng: 20.4325466160001, lat: 44.354553222 },
		{ lng: 20.431167602, lat: 44.3530998240001 },
		{ lng: 20.4231910710001, lat: 44.3478736890001 },
		{ lng: 20.4195804590001, lat: 44.3450393690001 },
		{ lng: 20.4182415010002, lat: 44.3437461860001 },
		{ lng: 20.4115543360001, lat: 44.335838318 },
		{ lng: 20.4088840480001, lat: 44.3330917360001 },
		{ lng: 20.404031753, lat: 44.3292808530001 },
		{ lng: 20.4015178680002, lat: 44.3268852230001 },
		{ lng: 20.4003353120002, lat: 44.3247413630002 },
		{ lng: 20.4000988010001, lat: 44.3237304700001 },
		{ lng: 20.4000873560001, lat: 44.3200912470002 },
		{ lng: 20.4006690980001, lat: 44.312713624 },
		{ lng: 20.400619508, lat: 44.3101844780002 },
		{ lng: 20.4001045240001, lat: 44.3080825820002 },
		{ lng: 20.3990325930001, lat: 44.306240083 },
		{ lng: 20.397470475, lat: 44.304489136 },
		{ lng: 20.3923988350001, lat: 44.2997818000001 },
		{ lng: 20.389503479, lat: 44.2955474850002 },
		{ lng: 20.389083862, lat: 44.2942886360001 },
		{ lng: 20.3843727120001, lat: 44.292541504 },
		{ lng: 20.3779201520001, lat: 44.2908020020001 },
		{ lng: 20.374404907, lat: 44.2903633120001 },
		{ lng: 20.3709163660002, lat: 44.2902717600002 },
		{ lng: 20.363178253, lat: 44.2908363340002 },
		{ lng: 20.360218047, lat: 44.2907028200001 },
		{ lng: 20.3580379480001, lat: 44.290225983 },
		{ lng: 20.3560867310002, lat: 44.28942871 },
		{ lng: 20.3529605870002, lat: 44.287006379 },
		{ lng: 20.3506107320002, lat: 44.2844123850001 },
		{ lng: 20.349254608, lat: 44.28243637 },
		{ lng: 20.3465328210002, lat: 44.2775421140001 },
		{ lng: 20.3449268330002, lat: 44.2726898190002 },
		{ lng: 20.3441829680002, lat: 44.2712135320002 },
		{ lng: 20.3430652610002, lat: 44.2698555000001 },
		{ lng: 20.3415660860002, lat: 44.2686576850002 },
		{ lng: 20.3330383310001, lat: 44.2631950380002 },
		{ lng: 20.3315982810001, lat: 44.2618331920001 },
		{ lng: 20.3288078300001, lat: 44.258491516 },
		{ lng: 20.3267402660001, lat: 44.25656128 },
		{ lng: 20.3241329190001, lat: 44.254959107 },
		{ lng: 20.3179988860001, lat: 44.2523422250001 },
		{ lng: 20.3132686620001, lat: 44.2509803780001 },
		{ lng: 20.309425354, lat: 44.250495911 },
		{ lng: 20.30730629, lat: 44.2507247920001 },
		{ lng: 20.305271148, lat: 44.2513237000001 },
		{ lng: 20.2979259480002, lat: 44.255073548 },
		{ lng: 20.2939796460001, lat: 44.2564048780002 },
		{ lng: 20.2921409600001, lat: 44.2567100520001 },
		{ lng: 20.290128708, lat: 44.2566337590001 },
		{ lng: 20.2882595060001, lat: 44.2561492930001 },
		{ lng: 20.286195756, lat: 44.2549400340001 },
		{ lng: 20.28484726, lat: 44.2532653810001 },
		{ lng: 20.284444809, lat: 44.2513923650001 },
		{ lng: 20.2849617010002, lat: 44.2464256280002 },
		{ lng: 20.2847099310001, lat: 44.2443695070001 },
		{ lng: 20.283897401, lat: 44.2424964910001 },
		{ lng: 20.2824344630001, lat: 44.2411270140001 },
		{ lng: 20.2809047710001, lat: 44.2406044000001 },
		{ lng: 20.2790985110001, lat: 44.2404594430001 },
		{ lng: 20.2752857200001, lat: 44.2409057620001 },
		{ lng: 20.2692317960001, lat: 44.2419586180001 },
		{ lng: 20.2645568850001, lat: 44.243370057 },
		{ lng: 20.2616443630002, lat: 44.2448120120001 },
		{ lng: 20.2592258450001, lat: 44.2466392530002 },
		{ lng: 20.2567729950002, lat: 44.2492904670002 },
		{ lng: 20.251329422, lat: 44.2584304800001 },
		{ lng: 20.2487945560001, lat: 44.2614593500001 },
		{ lng: 20.2463378910001, lat: 44.263267517 },
		{ lng: 20.2406959540002, lat: 44.2666511530001 },
		{ lng: 20.2266902930002, lat: 44.2762031560002 },
		{ lng: 20.2203712470001, lat: 44.2798995970001 },
		{ lng: 20.2163105010002, lat: 44.2819709780001 },
		{ lng: 20.2128887180002, lat: 44.2843551630001 },
		{ lng: 20.2102394100002, lat: 44.2867050180001 },
		{ lng: 20.2056903840001, lat: 44.291908264 },
		{ lng: 20.1989955900001, lat: 44.300510407 },
		{ lng: 20.1923122420001, lat: 44.3081436150002 },
		{ lng: 20.1880016320001, lat: 44.3157806400001 },
		{ lng: 20.1871299740001, lat: 44.3178901670001 },
		{ lng: 20.1869831090002, lat: 44.319915771 },
		{ lng: 20.1880989070001, lat: 44.3233566280001 },
		{ lng: 20.1899394980001, lat: 44.3261261000001 },
		{ lng: 20.1914768220001, lat: 44.3280563350002 },
		{ lng: 20.1936035150001, lat: 44.3301506040002 },
		{ lng: 20.2004928600002, lat: 44.3362503050001 },
		{ lng: 20.2020606990001, lat: 44.3384170530002 },
		{ lng: 20.2026901250002, lat: 44.3404617320001 },
		{ lng: 20.2026386260001, lat: 44.3425445570001 },
		{ lng: 20.2019119270001, lat: 44.3445701590002 },
		{ lng: 20.2005653380001, lat: 44.3463478100001 },
		{ lng: 20.19878006, lat: 44.3480033880001 },
		{ lng: 20.1935119630002, lat: 44.352123261 },
		{ lng: 20.1923084260001, lat: 44.353576661 },
		{ lng: 20.19147873, lat: 44.3551406870001 },
		{ lng: 20.190977097, lat: 44.357212067 },
		{ lng: 20.1910305020001, lat: 44.3592796330001 },
		{ lng: 20.191440583, lat: 44.3607559200001 },
		{ lng: 20.192224503, lat: 44.3621025080001 },
		{ lng: 20.194114686, lat: 44.3638000500001 },
		{ lng: 20.1973438250001, lat: 44.365859985 },
		{ lng: 20.1991901390001, lat: 44.3673820500002 },
		{ lng: 20.20005989, lat: 44.3690834050001 },
		{ lng: 20.1992626200002, lat: 44.373996735 },
		{ lng: 20.1996707920002, lat: 44.3753280630001 },
		{ lng: 20.2005882270001, lat: 44.3765869140001 },
		{ lng: 20.2036952980001, lat: 44.3787803650001 },
		{ lng: 20.2110843660001, lat: 44.3827819820002 },
		{ lng: 20.21344757, lat: 44.3844223020002 },
		{ lng: 20.2153625490001, lat: 44.3862876890001 },
		{ lng: 20.2166786190001, lat: 44.3882446280001 },
		{ lng: 20.2193222050001, lat: 44.393215179 },
		{ lng: 20.2216835030001, lat: 44.3997230540002 },
		{ lng: 20.2257595070001, lat: 44.4077301040001 },
		{ lng: 20.2264671320001, lat: 44.4102668750001 },
		{ lng: 20.2268047330001, lat: 44.4129028310001 },
		{ lng: 20.2268180840002, lat: 44.4182510370001 },
		{ lng: 20.2259616860002, lat: 44.423347473 },
		{ lng: 20.22492981, lat: 44.4255943310001 },
		{ lng: 20.2215328210001, lat: 44.4299850470002 },
		{ lng: 20.2204818720001, lat: 44.4319305430002 },
		{ lng: 20.220237733, lat: 44.434196472 },
		{ lng: 20.221160889, lat: 44.4382438660001 },
		{ lng: 20.225378036, lat: 44.4459457400001 },
		{ lng: 20.2261352540002, lat: 44.4479942330001 },
		{ lng: 20.2264442440001, lat: 44.4494476310001 },
		{ lng: 20.2263450620001, lat: 44.4515190130001 },
		{ lng: 20.223684312, lat: 44.4588470470001 },
		{ lng: 20.221378326, lat: 44.4683876040002 },
		{ lng: 20.2175464640001, lat: 44.4787216180001 },
		{ lng: 20.2142486570001, lat: 44.4818573000002 },
		{ lng: 20.211292266, lat: 44.484176636 },
		{ lng: 20.2080154420001, lat: 44.4863014230001 },
		{ lng: 20.200870513, lat: 44.4897575380001 },
		{ lng: 20.199098587, lat: 44.4909057610002 },
		{ lng: 20.1977672570002, lat: 44.4922180180001 },
		{ lng: 20.1968612670001, lat: 44.4936294560001 },
		{ lng: 20.19638443, lat: 44.4958381650001 },
		{ lng: 20.1999244690001, lat: 44.5069313050001 },
		{ lng: 20.2001419060001, lat: 44.5083427430002 },
		{ lng: 20.1998214710001, lat: 44.5103225710002 },
		{ lng: 20.1983833310002, lat: 44.5126609810001 },
		{ lng: 20.1941871650001, lat: 44.5172042840002 },
		{ lng: 20.192476272, lat: 44.519557954 },
		{ lng: 20.1917037960002, lat: 44.521556855 },
		{ lng: 20.190242767, lat: 44.5279235840002 },
		{ lng: 20.19029808, lat: 44.5328636170001 },
		{ lng: 20.1899776450001, lat: 44.5349044810002 },
		{ lng: 20.1893844600002, lat: 44.536312104 },
		{ lng: 20.187267303, lat: 44.5395469660002 },
		{ lng: 20.1860942830002, lat: 44.540729523 },
		{ lng: 20.184761048, lat: 44.5417594920001 },
		{ lng: 20.1824207310001, lat: 44.5429229740001 },
		{ lng: 20.1806869500001, lat: 44.5432281500001 },
		{ lng: 20.1789321900001, lat: 44.5431327810001 },
		{ lng: 20.1765747070001, lat: 44.5422630310001 },
		{ lng: 20.175291062, lat: 44.5412712090001 },
		{ lng: 20.1726722720001, lat: 44.5384445190002 },
		{ lng: 20.1703624730002, lat: 44.5349082960001 },
		{ lng: 20.1694698340002, lat: 44.528072358 },
		{ lng: 20.1679306020001, lat: 44.5253219610001 },
		{ lng: 20.1654701240001, lat: 44.5223808290002 },
		{ lng: 20.161052704, lat: 44.5185966490002 },
		{ lng: 20.158353806, lat: 44.51563263 },
		{ lng: 20.1562671650001, lat: 44.512836457 },
		{ lng: 20.1539897910002, lat: 44.5087203990001 },
		{ lng: 20.1515541070001, lat: 44.5057868960002 },
		{ lng: 20.1480140690001, lat: 44.5034790030001 },
		{ lng: 20.1444091800001, lat: 44.501663208 },
		{ lng: 20.1302394860002, lat: 44.495559692 },
		{ lng: 20.1278095240002, lat: 44.4951629640001 },
		{ lng: 20.12538147, lat: 44.4957084660001 },
		{ lng: 20.123306273, lat: 44.4971084600001 },
		{ lng: 20.121551514, lat: 44.4990196240001 },
		{ lng: 20.1154842370001, lat: 44.50704956 },
		{ lng: 20.1098384850001, lat: 44.512832641 },
		{ lng: 20.1089000710001, lat: 44.5142250070002 },
		{ lng: 20.1058177940001, lat: 44.520442963 },
		{ lng: 20.1039791100002, lat: 44.5224304210001 },
		{ lng: 20.101455689, lat: 44.523983001 },
		{ lng: 20.0993785870001, lat: 44.5248374940001 },
		{ lng: 20.0951042170001, lat: 44.5259666440001 },
		{ lng: 20.0898914350001, lat: 44.526256561 },
		{ lng: 20.0817909230001, lat: 44.5259437560001 },
		{ lng: 20.0777816770002, lat: 44.5255355840001 },
		{ lng: 20.0740261090002, lat: 44.5247268690001 },
		{ lng: 20.0702972420001, lat: 44.523097992 },
		{ lng: 20.0670890810001, lat: 44.5209770200001 },
		{ lng: 20.0650005340001, lat: 44.5190849320002 },
		{ lng: 20.0605907440001, lat: 44.512962342 },
		{ lng: 20.0592899330002, lat: 44.5117874150001 },
		{ lng: 20.05691719, lat: 44.5102195740001 },
		{ lng: 20.0530567160002, lat: 44.5088577280001 },
		{ lng: 20.0474834450001, lat: 44.5075111390001 },
		{ lng: 20.0446987150001, lat: 44.507167816 },
		{ lng: 20.0433883660001, lat: 44.5072364810001 },
		{ lng: 20.0406665810001, lat: 44.5078735360001 },
		{ lng: 20.0351161960001, lat: 44.5100402830001 },
		{ lng: 20.024097442, lat: 44.5128860470001 },
		{ lng: 20.021940231, lat: 44.5137252810002 },
		{ lng: 20.0162925710001, lat: 44.5165290840001 },
		{ lng: 20.0140972130001, lat: 44.5173072810001 },
		{ lng: 20.0117454530001, lat: 44.5178947460001 },
		{ lng: 20.0078105930001, lat: 44.518486024 },
		{ lng: 19.9997329700001, lat: 44.519294739 },
		{ lng: 19.9959049230002, lat: 44.5200080880002 },
		{ lng: 19.9938907620001, lat: 44.5206375120001 },
		{ lng: 19.9899597170001, lat: 44.522338867 },
		{ lng: 19.988136292, lat: 44.523422242 },
		{ lng: 19.9860267630002, lat: 44.5252418530001 },
		{ lng: 19.9836807250001, lat: 44.5279083250001 },
		{ lng: 19.9816379550001, lat: 44.529716492 },
		{ lng: 19.976125717, lat: 44.5331459060001 },
		{ lng: 19.9740982060001, lat: 44.5347023010002 },
		{ lng: 19.9722862240001, lat: 44.5364112860001 },
		{ lng: 19.9695644390002, lat: 44.5398101810002 },
		{ lng: 19.967391967, lat: 44.5434722900001 },
		{ lng: 19.966213227, lat: 44.5466575620002 },
		{ lng: 19.9661197650001, lat: 44.5490150450001 },
		{ lng: 19.9674358370001, lat: 44.5547256470001 },
		{ lng: 19.967765807, lat: 44.5575675970001 },
		{ lng: 19.9702186590001, lat: 44.5592765800001 },
		{ lng: 19.9707736960002, lat: 44.5597457890001 },
		{ lng: 19.9709701550001, lat: 44.5599975590002 },
		{ lng: 19.9710826880001, lat: 44.5602874750001 },
		{ lng: 19.9711437230001, lat: 44.5609130870001 },
		{ lng: 19.9710788730001, lat: 44.5647697450001 },
		{ lng: 19.9709873210001, lat: 44.575832366 },
		{ lng: 19.970184326, lat: 44.5809173590001 },
		{ lng: 19.969270705, lat: 44.5831794750002 },
		{ lng: 19.9683094030001, lat: 44.5846290580001 },
		{ lng: 19.9633522030001, lat: 44.5893630980001 },
		{ lng: 19.9617519380001, lat: 44.5914955150001 },
		{ lng: 19.9612483970001, lat: 44.5927925110001 },
		{ lng: 19.961194992, lat: 44.5937309270001 },
		{ lng: 19.9619503020002, lat: 44.595825195 },
		{ lng: 19.9681034080002, lat: 44.6026382450001 },
		{ lng: 19.9685878760001, lat: 44.603988648 },
		{ lng: 19.968593598, lat: 44.6053657530002 },
		{ lng: 19.9672946930002, lat: 44.6098136910002 },
		{ lng: 19.96659851, lat: 44.6281509400001 },
		{ lng: 19.9794044500002, lat: 44.6390686040002 },
		{ lng: 19.9867153170001, lat: 44.6465492250001 },
		{ lng: 19.9900054940001, lat: 44.6490669250001 },
		{ lng: 19.9920253760001, lat: 44.649959565 },
		{ lng: 19.9942798620001, lat: 44.6506042470001 },
		{ lng: 20.003602982, lat: 44.6520538330001 },
		{ lng: 20.013833999, lat: 44.6542472830001 },
		{ lng: 20.0160064700001, lat: 44.654953003 },
		{ lng: 20.0179367060001, lat: 44.655876159 },
		{ lng: 20.0195693970001, lat: 44.657047272 },
		{ lng: 20.0267124170001, lat: 44.6633567820002 },
		{ lng: 20.0303554530001, lat: 44.6670722960001 },
		{ lng: 20.0322322850001, lat: 44.668300629 },
		{ lng: 20.0351028450002, lat: 44.6693916330001 },
		{ lng: 20.038055421, lat: 44.6699485790002 },
		{ lng: 20.0476608280001, lat: 44.6707992560001 },
		{ lng: 20.0528545370001, lat: 44.6718177790001 },
		{ lng: 20.057727813, lat: 44.6733818050002 },
		{ lng: 20.0653400420001, lat: 44.6767578130001 },
		{ lng: 20.0789108280001, lat: 44.6817474370001 },
		{ lng: 20.0861377720001, lat: 44.6838684080002 },
		{ lng: 20.0979022980001, lat: 44.6860198970001 },
		{ lng: 20.1015205380002, lat: 44.6872711180002 },
		{ lng: 20.1050910950001, lat: 44.6890907280001 },
		{ lng: 20.1087474830001, lat: 44.6915473930001 },
		{ lng: 20.1040897380001, lat: 44.6940231320002 },
		{ lng: 20.0961456300001, lat: 44.6977844230001 },
		{ lng: 20.092065812, lat: 44.6994018560001 },
		{ lng: 20.0829448700001, lat: 44.7023544320001 },
		{ lng: 20.0812072750001, lat: 44.703235626 },
		{ lng: 20.0801429750002, lat: 44.7041282650001 },
		{ lng: 20.0796699530001, lat: 44.7050819400002 },
		{ lng: 20.0802993780001, lat: 44.7065773000001 },
		{ lng: 20.0822563170001, lat: 44.7078475950001 },
		{ lng: 20.0858669290002, lat: 44.7093467720001 },
		{ lng: 20.0885639200002, lat: 44.710754396 },
		{ lng: 20.091875076, lat: 44.7133522030001 },
		{ lng: 20.0959491740002, lat: 44.7172470100001 },
		{ lng: 20.100761414, lat: 44.7234153740001 },
		{ lng: 20.1031265250001, lat: 44.7290306100002 },
		{ lng: 20.1034774790002, lat: 44.730438233 },
		{ lng: 20.1034126280001, lat: 44.7323913570002 },
		{ lng: 20.1026172640001, lat: 44.734191894 },
		{ lng: 20.0972690580001, lat: 44.7391014090001 },
		{ lng: 20.0968608860001, lat: 44.7400970460001 },
		{ lng: 20.097484588, lat: 44.7416191100001 },
		{ lng: 20.0987243660001, lat: 44.7425575260001 },
		{ lng: 20.104705811, lat: 44.7453498840001 },
		{ lng: 20.1061954490002, lat: 44.746269227 },
		{ lng: 20.107627869, lat: 44.747875213 },
		{ lng: 20.1086349480001, lat: 44.7497673040002 },
		{ lng: 20.1104354850002, lat: 44.7545852670001 },
		{ lng: 20.1104393000001, lat: 44.7565574650002 },
		{ lng: 20.1096858980001, lat: 44.758430482 },
		{ lng: 20.1081447600001, lat: 44.7599487310001 },
		{ lng: 20.1064987180001, lat: 44.7607154850002 },
		{ lng: 20.0986080160001, lat: 44.7625503550001 },
		{ lng: 20.091510773, lat: 44.7647590640001 },
		{ lng: 20.0876712810001, lat: 44.7664604190002 },
		{ lng: 20.0840053560001, lat: 44.7687530510001 },
		{ lng: 20.0826892850002, lat: 44.7701873780001 },
		{ lng: 20.0817470560001, lat: 44.7717971810001 },
		{ lng: 20.0809307100001, lat: 44.774574279 },
		{ lng: 20.0806941990002, lat: 44.7774887080002 },
		{ lng: 20.0809345250001, lat: 44.7803916940001 },
		{ lng: 20.0817623140001, lat: 44.7831459050001 },
		{ lng: 20.082576752, lat: 44.7845726020001 },
		{ lng: 20.0851764690001, lat: 44.7876625070001 },
		{ lng: 20.087152481, lat: 44.7889938350001 },
		{ lng: 20.0889415730001, lat: 44.7895584110001 },
		{ lng: 20.0909538270001, lat: 44.789829254 },
		{ lng: 20.093782425, lat: 44.7898368840001 },
		{ lng: 20.0978374470001, lat: 44.7895240790001 },
		{ lng: 20.1007556920001, lat: 44.7896118160002 },
		{ lng: 20.1077327730002, lat: 44.7910957330001 },
		{ lng: 20.114524842, lat: 44.7933998110001 },
		{ lng: 20.1181945810002, lat: 44.7951049810002 },
		{ lng: 20.1216850270001, lat: 44.7973785400001 },
		{ lng: 20.1229190830001, lat: 44.798797607 },
		{ lng: 20.123786926, lat: 44.8003959660002 },
		{ lng: 20.1244869230002, lat: 44.8029174800001 },
		{ lng: 20.1251316060001, lat: 44.813819885 },
		{ lng: 20.1255435950002, lat: 44.8164863580001 },
		{ lng: 20.1264381400001, lat: 44.8190193190002 },
		{ lng: 20.1278877250002, lat: 44.8211936960001 },
		{ lng: 20.1315040600002, lat: 44.825382232 },
		{ lng: 20.1329994200001, lat: 44.8275947580001 },
		{ lng: 20.1338291160001, lat: 44.8298645020002 },
		{ lng: 20.134578704, lat: 44.8372116090001 },
		{ lng: 20.1359615330001, lat: 44.8441772460001 },
		{ lng: 20.147031785, lat: 44.8601531990001 },
		{ lng: 20.1500873560001, lat: 44.8654403690001 },
		{ lng: 20.1532955160002, lat: 44.8752937310002 },
		{ lng: 20.1537342070001, lat: 44.8775329590002 },
		{ lng: 20.1540374760001, lat: 44.8834648140001 },
		{ lng: 20.1543483730002, lat: 44.8849792480001 },
		{ lng: 20.1550407400002, lat: 44.8863830560001 },
		{ lng: 20.156848908, lat: 44.8882064810001 },
		{ lng: 20.1612968440002, lat: 44.8910484320002 },
		{ lng: 20.1635456090002, lat: 44.8920784000001 },
		{ lng: 20.1657104500001, lat: 44.8927078250001 },
		{ lng: 20.1680088050001, lat: 44.8930511480001 },
		{ lng: 20.1710052490001, lat: 44.8930511480001 },
		{ lng: 20.1791477200001, lat: 44.892059327 },
		{ lng: 20.1871604930001, lat: 44.8916473400001 },
		{ lng: 20.195026397, lat: 44.89181137 },
		{ lng: 20.1980628960002, lat: 44.8921890250001 },
		{ lng: 20.2008056650002, lat: 44.8929176340001 },
		{ lng: 20.2027015690001, lat: 44.893821717 },
		{ lng: 20.2155761720001, lat: 44.901081085 },
		{ lng: 20.2233123770001, lat: 44.9063186650002 },
		{ lng: 20.2299308770001, lat: 44.9094886780002 },
		{ lng: 20.235950469, lat: 44.9129219070001 },
		{ lng: 20.2387580880001, lat: 44.9141960140001 },
		{ lng: 20.2431259150001, lat: 44.9151039120001 },
		{ lng: 20.2463016520002, lat: 44.9153442380001 },
		{ lng: 20.258527755, lat: 44.9155006400001 },
		{ lng: 20.2809104910002, lat: 44.9193077090002 },
		{ lng: 20.2658596030001, lat: 44.933296204 },
		{ lng: 20.2588920590002, lat: 44.9390182500001 },
		{ lng: 20.2576293950002, lat: 44.9405899060001 },
		{ lng: 20.2560195920001, lat: 44.9441223140001 },
		{ lng: 20.2549514770001, lat: 44.9494056710001 },
		{ lng: 20.2550334930002, lat: 44.951538086 },
		{ lng: 20.2557239530001, lat: 44.9535408030001 },
		{ lng: 20.258085251, lat: 44.9563941960002 },
		{ lng: 20.2603073130001, lat: 44.958145141 },
		{ lng: 20.2630939490001, lat: 44.9595375060002 },
		{ lng: 20.270986556, lat: 44.9627075200001 },
		{ lng: 20.274505616, lat: 44.9646301270001 },
		{ lng: 20.2759437560002, lat: 44.965774536 },
		{ lng: 20.2768630990001, lat: 44.9670982360001 },
		{ lng: 20.277238846, lat: 44.9685401930001 },
		{ lng: 20.276514053, lat: 44.9732398980001 },
		{ lng: 20.2766666420001, lat: 44.9755859380001 },
		{ lng: 20.2775669090001, lat: 44.9772148140001 },
		{ lng: 20.2790775300001, lat: 44.978656769 },
		{ lng: 20.282838821, lat: 44.9806251520001 },
		{ lng: 20.2867870340001, lat: 44.9819641120002 },
		{ lng: 20.2898731230001, lat: 44.9825210580001 },
		{ lng: 20.2994556430002, lat: 44.9836845400001 },
		{ lng: 20.3017616280001, lat: 44.984291076 },
		{ lng: 20.303850174, lat: 44.9851455690001 },
		{ lng: 20.3074016570002, lat: 44.98753357 },
		{ lng: 20.3179645550001, lat: 44.9956398010001 },
		{ lng: 20.3201713560001, lat: 44.9977455140001 },
		{ lng: 20.3216953270002, lat: 44.9999465950001 },
		{ lng: 20.3221549990002, lat: 45.0019149790001 },
		{ lng: 20.3221168520001, lat: 45.006790161 },
		{ lng: 20.3233413690001, lat: 45.0124359130002 },
		{ lng: 20.323495864, lat: 45.0152282710001 },
		{ lng: 20.3230628960001, lat: 45.0208549500002 },
		{ lng: 20.3222846990001, lat: 45.0235481260001 },
		{ lng: 20.3180713650002, lat: 45.0316619880001 },
		{ lng: 20.3173542010002, lat: 45.0338897700001 },
		{ lng: 20.3160552980001, lat: 45.04081726 },
		{ lng: 20.3153038030002, lat: 45.0430336010002 },
		{ lng: 20.3135623930002, lat: 45.0459709160001 },
		{ lng: 20.312101365, lat: 45.0479812630001 },
		{ lng: 20.3101463310001, lat: 45.0499992380002 },
		{ lng: 20.3053970330001, lat: 45.053771972 },
		{ lng: 20.2979869840001, lat: 45.058628082 },
		{ lng: 20.2881126410001, lat: 45.0638465890001 },
		{ lng: 20.284185409, lat: 45.067276002 },
		{ lng: 20.282173157, lat: 45.0700378420001 },
		{ lng: 20.2808151240002, lat: 45.0728378300001 },
		{ lng: 20.2776565560001, lat: 45.082328797 },
		{ lng: 20.2877731320002, lat: 45.0807724000001 },
		{ lng: 20.292163848, lat: 45.0797843930002 },
		{ lng: 20.2962417600001, lat: 45.0784263620002 },
		{ lng: 20.3006381980001, lat: 45.0763931270001 },
		{ lng: 20.3027000420001, lat: 45.0751762400002 },
		{ lng: 20.3094005580001, lat: 45.0699310310001 },
		{ lng: 20.312023164, lat: 45.0682754520001 },
		{ lng: 20.3149356850001, lat: 45.0671539310002 },
		{ lng: 20.3171005240001, lat: 45.0667610180001 },
		{ lng: 20.3192710880001, lat: 45.0667686460002 },
		{ lng: 20.3217792510002, lat: 45.0673408500001 },
		{ lng: 20.3242225650002, lat: 45.068328857 },
		{ lng: 20.3286514280001, lat: 45.0705909730002 },
		{ lng: 20.332517624, lat: 45.0732765210001 },
		{ lng: 20.3380260470001, lat: 45.0785140990001 },
		{ lng: 20.339717864, lat: 45.0797157300001 },
		{ lng: 20.3416996, lat: 45.0806427010002 },
		{ lng: 20.3439254760002, lat: 45.0813064570002 },
		{ lng: 20.3476295470001, lat: 45.081871033 },
		{ lng: 20.3515548710002, lat: 45.0820770260001 },
		{ lng: 20.3595561990002, lat: 45.0817451480002 },
		{ lng: 20.3634319300002, lat: 45.08108902 },
		{ lng: 20.3677787790002, lat: 45.0797195430001 },
		{ lng: 20.372615813, lat: 45.0778350840001 },
		{ lng: 20.3759231560002, lat: 45.0762214660002 },
		{ lng: 20.3846797940001, lat: 45.0711898810001 },
		{ lng: 20.3926334390002, lat: 45.0673484810001 },
		{ lng: 20.3937873850001, lat: 45.066734314 },
		{ lng: 20.3951492310001, lat: 45.06513977 },
		{ lng: 20.3958835610002, lat: 45.0632171640002 },
		{ lng: 20.395982743, lat: 45.0611305240001 },
		{ lng: 20.3954467780002, lat: 45.0590934760002 },
		{ lng: 20.3926773080001, lat: 45.0547790540001 },
		{ lng: 20.3917465220001, lat: 45.0526771550001 },
		{ lng: 20.391773223, lat: 45.0502128600001 },
		{ lng: 20.3924045560001, lat: 45.0481376650001 },
		{ lng: 20.3965511320001, lat: 45.0400924680001 },
		{ lng: 20.3974056250001, lat: 45.0372734060001 },
		{ lng: 20.3985157020001, lat: 45.031475067 },
		{ lng: 20.3994369500001, lat: 45.028690339 },
		{ lng: 20.4011917120001, lat: 45.0257568370001 },
		{ lng: 20.4039573670001, lat: 45.0224342360001 },
		{ lng: 20.4078464510002, lat: 45.0193672170001 },
		{ lng: 20.410514832, lat: 45.0177040090001 },
		{ lng: 20.4243011480002, lat: 45.0104713450002 },
		{ lng: 20.4312896730001, lat: 45.0070648200001 },
		{ lng: 20.440282822, lat: 45.0021133430001 },
		{ lng: 20.4425697330001, lat: 45.0003852850002 },
		{ lng: 20.4443264010002, lat: 44.9984207160001 },
		{ lng: 20.4454059590001, lat: 44.996356964 },
		{ lng: 20.4469089520001, lat: 44.9919586180001 },
		{ lng: 20.4479255670001, lat: 44.989818573 },
		{ lng: 20.4498214710001, lat: 44.9874076850001 },
		{ lng: 20.45224762, lat: 44.985141754 },
		{ lng: 20.4578552250001, lat: 44.9808044430001 },
		{ lng: 20.4671478280001, lat: 44.974529266 },
		{ lng: 20.472536088, lat: 44.9717025760001 },
		{ lng: 20.4755420690001, lat: 44.9706497190001 },
		{ lng: 20.4781322480001, lat: 44.970092773 },
		{ lng: 20.4813652040001, lat: 44.969696045 },
		{ lng: 20.4906406410001, lat: 44.9693069460001 },
		{ lng: 20.4917812350001, lat: 44.9689712530001 },
		{ lng: 20.4938449860001, lat: 44.9679451000001 },
		{ lng: 20.4959411620002, lat: 44.9664535530002 },
		{ lng: 20.4974117280001, lat: 44.964790345 },
		{ lng: 20.4983520500002, lat: 44.9630203240001 },
		{ lng: 20.4988861080001, lat: 44.9606704720001 },
		{ lng: 20.4988059990001, lat: 44.9583206190001 },
		{ lng: 20.4978942860001, lat: 44.9528236390001 },
		{ lng: 20.4981098180002, lat: 44.9505462650001 },
		{ lng: 20.4988384250001, lat: 44.9483604430001 },
		{ lng: 20.5000705730001, lat: 44.946430207 },
		{ lng: 20.5049571990002, lat: 44.9407997130002 },
		{ lng: 20.507297517, lat: 44.9385948170001 },
		{ lng: 20.5126762390001, lat: 44.934398651 },
		{ lng: 20.5213451380001, lat: 44.9284286510001 },
		{ lng: 20.5269584660001, lat: 44.925380708 },
		{ lng: 20.5315761570001, lat: 44.9237327580001 },
		{ lng: 20.5440883630001, lat: 44.9199256900001 },
		{ lng: 20.554351807, lat: 44.9157142650001 },
		{ lng: 20.559158325, lat: 44.914348603 },
		{ lng: 20.5679035190001, lat: 44.912452697 },
		{ lng: 20.570228576, lat: 44.9116477970001 },
		{ lng: 20.5731391900001, lat: 44.910282135 },
		{ lng: 20.578697205, lat: 44.9068489070002 },
		{ lng: 20.586584092, lat: 44.9009170540001 },
		{ lng: 20.5930271140001, lat: 44.8948135380001 },
		{ lng: 20.5978794090001, lat: 44.890712738 },
		{ lng: 20.6000499730002, lat: 44.8886146550001 },
		{ lng: 20.6016540530002, lat: 44.886405944 },
		{ lng: 20.6023159020002, lat: 44.8843231190001 },
		{ lng: 20.6023178100001, lat: 44.8821868890001 },
		{ lng: 20.601673127, lat: 44.8801002510002 },
		{ lng: 20.6002597810001, lat: 44.8780212410001 },
		{ lng: 20.596586228, lat: 44.8740005500002 },
		{ lng: 20.595037461, lat: 44.8718910220001 },
		{ lng: 20.5941028590001, lat: 44.8697395330001 },
		{ lng: 20.5918693550001, lat: 44.8607177730001 },
		{ lng: 20.5903015140001, lat: 44.8577690120001 },
		{ lng: 20.5824413300001, lat: 44.8460502630001 },
		{ lng: 20.5766983040001, lat: 44.8385505670001 },
		{ lng: 20.5750427240001, lat: 44.8366622930002 },
		{ lng: 20.5729598990001, lat: 44.8347854630001 },
		{ lng: 20.565731048, lat: 44.8294258120001 },
		{ lng: 20.564498902, lat: 44.8279190060002 },
		{ lng: 20.563610078, lat: 44.8262672430002 },
		{ lng: 20.562942504, lat: 44.8240394590001 },
		{ lng: 20.5625953680001, lat: 44.81937027 },
		{ lng: 20.5633506780001, lat: 44.814846039 },
		{ lng: 20.5643920900001, lat: 44.8127822870002 },
		{ lng: 20.5660285940001, lat: 44.8110847470001 },
		{ lng: 20.5695476540001, lat: 44.8094024660001 },
		{ lng: 20.573467255, lat: 44.8081741330001 },
		{ lng: 20.582618714, lat: 44.8067550670001 },
		{ lng: 20.5847015390002, lat: 44.8062820440001 },
		{ lng: 20.5865268720001, lat: 44.8055763240002 },
		{ lng: 20.5884838110001, lat: 44.804111481 },
		{ lng: 20.5934600820001, lat: 44.7982559210001 },
		{ lng: 20.6012592320001, lat: 44.7924957280001 },
		{ lng: 20.602800369, lat: 44.7908592220002 },
		{ lng: 20.607934952, lat: 44.7838935860001 },
		{ lng: 20.6100997920001, lat: 44.7820396430001 },
		{ lng: 20.6028251650001, lat: 44.767032623 },
		{ lng: 20.5979976650002, lat: 44.7587814340001 },
		{ lng: 20.5968742370001, lat: 44.7551918030002 },
		{ lng: 20.59692955, lat: 44.75309372 },
		{ lng: 20.5973339080001, lat: 44.7516326910001 },
		{ lng: 20.5982151020002, lat: 44.749591828 },
		{ lng: 20.6015663140001, lat: 44.7441215520002 },
		{ lng: 20.6020412440001, lat: 44.742164613 },
		{ lng: 20.602207184, lat: 44.7394638060001 },
		{ lng: 20.6028442390001, lat: 44.737594604 },
		{ lng: 20.6043357840001, lat: 44.735748292 },
		{ lng: 20.6064548480001, lat: 44.734069824 },
		{ lng: 20.6124591820001, lat: 44.7303199780001 },
		{ lng: 20.6145515450001, lat: 44.7287406910001 },
		{ lng: 20.6208362570002, lat: 44.7225875850001 },
		{ lng: 20.6240062710001, lat: 44.7198715210001 },
		{ lng: 20.629764558, lat: 44.716804504 },
		{ lng: 20.641241073, lat: 44.7123260500001 },
		{ lng: 20.645051957, lat: 44.7106170670001 },
		{ lng: 20.6489963540002, lat: 44.7084579480001 },
		{ lng: 20.6522293080001, lat: 44.70576477 },
		{ lng: 20.6557102210001, lat: 44.7022628780002 },
		{ lng: 20.657106399, lat: 44.7003860470001 },
		{ lng: 20.6598682410001, lat: 44.6939201350001 },
		{ lng: 20.6666202550001, lat: 44.6819190970001 },
		{ lng: 20.6684093470001, lat: 44.6796722420001 },
		{ lng: 20.673273087, lat: 44.6749954230001 },
		{ lng: 20.677547455, lat: 44.6681709300001 },
		{ lng: 20.6800861360001, lat: 44.664787292 },
		{ lng: 20.68203354, lat: 44.6627845760001 },
		{ lng: 20.6866912830001, lat: 44.6590232840001 },
		{ lng: 20.6918869020001, lat: 44.655540466 },
		{ lng: 20.696826935, lat: 44.6529235840001 },
		{ lng: 20.7042198170001, lat: 44.6495933530001 },
		{ lng: 20.7069377890002, lat: 44.6486854550001 },
		{ lng: 20.7107963550002, lat: 44.647960663 },
		{ lng: 20.7188434600001, lat: 44.6471748360001 },
		{ lng: 20.7226867670001, lat: 44.6465606700001 },
		{ lng: 20.724916459, lat: 44.6459159850002 },
		{ lng: 20.7269134530001, lat: 44.6450195310001 },
		{ lng: 20.7301769260001, lat: 44.6425323490001 },
		{ lng: 20.7345752720001, lat: 44.6381340030002 },
		{ lng: 20.7367439260001, lat: 44.636291504 },
		{ lng: 20.739269257, lat: 44.6346664430002 },
		{ lng: 20.74136734, lat: 44.633636475 },
		{ lng: 20.7456340800001, lat: 44.63198471 },
		{ lng: 20.7477645870001, lat: 44.6313896190001 },
		{ lng: 20.7509937290001, lat: 44.630901337 },
		{ lng: 20.756639481, lat: 44.6308250430001 },
		{ lng: 20.7649383550001, lat: 44.6314773560002 },
		{ lng: 20.7781925210001, lat: 44.6328964230001 },
		{ lng: 20.7749748230001, lat: 44.6300468440001 },
		{ lng: 20.772855758, lat: 44.6276855480002 },
		{ lng: 20.7714118960001, lat: 44.6251716610001 },
		{ lng: 20.7708415990001, lat: 44.621055603 },
		{ lng: 20.7709751130001, lat: 44.6186676030002 },
		{ lng: 20.7714653010001, lat: 44.6163558970002 },
		{ lng: 20.7724609370001, lat: 44.6141967780002 },
		{ lng: 20.7742195120001, lat: 44.6121521000001 },
		{ lng: 20.7814311980001, lat: 44.6066589360001 },
		{ lng: 20.7837772370001, lat: 44.6035881040001 },
		{ lng: 20.7852687850001, lat: 44.6000595090001 },
		{ lng: 20.7856903070002, lat: 44.5970420850002 },
		{ lng: 20.7851905810002, lat: 44.5948791510001 },
		{ lng: 20.7836971290001, lat: 44.5931701660002 },
		{ lng: 20.7819213880001, lat: 44.5916061400001 },
		{ lng: 20.7807579040002, lat: 44.5900077830001 },
		{ lng: 20.7806892400001, lat: 44.589241029 },
		{ lng: 20.7815322870002, lat: 44.5875930790002 },
		{ lng: 20.7832965850001, lat: 44.5859756460002 },
		{ lng: 20.7856254590001, lat: 44.5844764710002 },
		{ lng: 20.7883396140001, lat: 44.5832099920001 },
		{ lng: 20.7952156060002, lat: 44.5808601390001 },
		{ lng: 20.7977581030001, lat: 44.5792846680001 },
		{ lng: 20.7991600030001, lat: 44.5781059270001 },
		{ lng: 20.8003692620001, lat: 44.5768127440002 },
		{ lng: 20.8017025000001, lat: 44.5748176580001 },
		{ lng: 20.805709838, lat: 44.567817688 },
		{ lng: 20.8066539770001, lat: 44.5650520330001 },
		{ lng: 20.8063507080001, lat: 44.563190461 },
		{ lng: 20.804931641, lat: 44.5614509590002 },
		{ lng: 20.802667618, lat: 44.5600395210001 },
		{ lng: 20.8005657190001, lat: 44.5592575070001 },
		{ lng: 20.7982234950001, lat: 44.5586853030002 },
		{ lng: 20.7885284430001, lat: 44.5573806760002 },
		{ lng: 20.7860279080001, lat: 44.5568618770001 },
		{ lng: 20.7836284630001, lat: 44.556175232 },
		{ lng: 20.7756042470002, lat: 44.5529403680001 },
		{ lng: 20.764743805, lat: 44.5498962410002 },
		{ lng: 20.7619571680001, lat: 44.5487365720001 },
		{ lng: 20.759386062, lat: 44.5470199580001 },
		{ lng: 20.7529201510001, lat: 44.541698456 },
		{ lng: 20.7510566720001, lat: 44.5405426020001 },
		{ lng: 20.7411594380001, lat: 44.5356864920001 },
		{ lng: 20.737104415, lat: 44.5330352780002 },
		{ lng: 20.7502021790002, lat: 44.5225639350002 },
		{ lng: 20.756532668, lat: 44.515670777 },
		{ lng: 20.7579231260001, lat: 44.5134887700001 },
		{ lng: 20.758512496, lat: 44.5116806030001 },
		{ lng: 20.7586040500001, lat: 44.504276276 },
		{ lng: 20.759117127, lat: 44.5022201540001 },
		{ lng: 20.7621059420002, lat: 44.4974899300001 },
		{ lng: 20.7641391750001, lat: 44.4960098280002 },
		{ lng: 20.7660694130001, lat: 44.4954185480001 },
		{ lng: 20.7713432320001, lat: 44.4944114680001 },
		{ lng: 20.779064179, lat: 44.4920043950002 },
		{ lng: 20.7876739500001, lat: 44.4881134030001 },
		{ lng: 20.8044433590001, lat: 44.4740104670001 },
		{ lng: 20.81652832, lat: 44.4674644480002 },
		{ lng: 20.8190021510002, lat: 44.46580124 },
		{ lng: 20.8210811610001, lat: 44.4639396680002 },
		{ lng: 20.8246631630001, lat: 44.459228517 },
		{ lng: 20.8268566130001, lat: 44.4550361630001 },
		{ lng: 20.8310394290002, lat: 44.4485015870001 },
		{ lng: 20.8364524830002, lat: 44.4430541990001 },
		{ lng: 20.8375663750002, lat: 44.4415130620002 },
		{ lng: 20.8383674630002, lat: 44.4398651120001 },
		{ lng: 20.838930129, lat: 44.437675477 },
		{ lng: 20.839071274, lat: 44.435443878 },
		{ lng: 20.8388156890002, lat: 44.433242797 },
		{ lng: 20.8380870820002, lat: 44.4311447140001 },
		{ lng: 20.8364734640001, lat: 44.4288558960001 },
		{ lng: 20.8241806030002, lat: 44.4187278740002 },
		{ lng: 20.8217544550002, lat: 44.4170684810001 },
		{ lng: 20.8190612790001, lat: 44.4159011840001 },
		{ lng: 20.8172702790001, lat: 44.4154815670001 },
		{ lng: 20.8146839130001, lat: 44.4154357920001 },
		{ lng: 20.8118171690001, lat: 44.416042328 },
		{ lng: 20.7935123440001, lat: 44.4222717280001 },
		{ lng: 20.791410445, lat: 44.4228134160002 },
		{ lng: 20.7875232700002, lat: 44.42339325 },
		{ lng: 20.783531189, lat: 44.423572541 },
		{ lng: 20.7795944210001, lat: 44.4234008780001 },
		{ lng: 20.77588272, lat: 44.422794342 },
		{ lng: 20.769527435, lat: 44.4207572940001 },
		{ lng: 20.7599697120002, lat: 44.418342591 },
		{ lng: 20.758350373, lat: 44.4175453190001 },
		{ lng: 20.756744385, lat: 44.4159774780002 },
		{ lng: 20.7557392110002, lat: 44.4140014650002 },
		{ lng: 20.7551250450002, lat: 44.411399841 },
		{ lng: 20.754009247, lat: 44.403137206 },
		{ lng: 20.7529258720002, lat: 44.4006233210001 },
		{ lng: 20.75123024, lat: 44.3986663820001 },
		{ lng: 20.7489757540002, lat: 44.3969573970001 },
		{ lng: 20.7402248390001, lat: 44.391849517 },
		{ lng: 20.7352886200001, lat: 44.388343811 },
		{ lng: 20.7330245970001, lat: 44.3862724310001 },
		{ lng: 20.7314662940001, lat: 44.3840713500001 },
		{ lng: 20.730989456, lat: 44.382076264 },
		{ lng: 20.7315101630001, lat: 44.378528595 },
		{ lng: 20.7323398590001, lat: 44.3764457700001 },
		{ lng: 20.733724594, lat: 44.37431717 },
		{ lng: 20.7368698120001, lat: 44.3702354440002 },
		{ lng: 20.7422409060002, lat: 44.3641738900001 },
		{ lng: 20.7524623870001, lat: 44.354564667 },
		{ lng: 20.7553501130001, lat: 44.352378845 },
		{ lng: 20.7579383840001, lat: 44.3511390690001 },
		{ lng: 20.759906769, lat: 44.3507080070002 },
		{ lng: 20.762008667, lat: 44.3505859380001 },
		{ lng: 20.764873504, lat: 44.3508567810002 },
		{ lng: 20.7729415900002, lat: 44.3530197150001 },
		{ lng: 20.7759704590001, lat: 44.353370667 },
		{ lng: 20.7790126790001, lat: 44.3533020030002 },
		{ lng: 20.7813167570001, lat: 44.3529281610001 },
		{ lng: 20.7834358210001, lat: 44.3522949210002 },
		{ lng: 20.7858924870002, lat: 44.3509674070001 },
		{ lng: 20.7874031070001, lat: 44.3491783150001 },
		{ lng: 20.7878437050001, lat: 44.3473739630002 },
		{ lng: 20.7876377110001, lat: 44.3460159300001 },
		{ lng: 20.786947251, lat: 44.344760896 },
		{ lng: 20.785034179, lat: 44.3431892400002 },
		{ lng: 20.7790164940001, lat: 44.3397903450001 },
		{ lng: 20.7705917370002, lat: 44.3339500440001 },
		{ lng: 20.767608642, lat: 44.3312225340001 },
		{ lng: 20.7667007450001, lat: 44.3298683180001 },
		{ lng: 20.765783309, lat: 44.3272438050001 },
		{ lng: 20.7655372630001, lat: 44.3244514470002 },
		{ lng: 20.7658424370002, lat: 44.3216400150001 },
		{ lng: 20.7667846690001, lat: 44.3189353950001 },
		{ lng: 20.769218445, lat: 44.3151969900001 },
		{ lng: 20.770624161, lat: 44.3125114440002 },
		{ lng: 20.7717342380001, lat: 44.308231354 },
		{ lng: 20.7720432280001, lat: 44.3049850470001 },
		{ lng: 20.7720355990001, lat: 44.2977561950001 },
		{ lng: 20.7574386600002, lat: 44.3053550720001 },
		{ lng: 20.7503604890001, lat: 44.3096351620002 },
		{ lng: 20.7485771180001, lat: 44.3109359730001 },
		{ lng: 20.7470779430001, lat: 44.3123779310002 },
		{ lng: 20.742845535, lat: 44.3171539320001 },
		{ lng: 20.7388782510001, lat: 44.3200263990001 },
		{ lng: 20.7360954280001, lat: 44.3213920600001 },
		{ lng: 20.7313804620001, lat: 44.3227005020001 },
		{ lng: 20.7281627660001, lat: 44.3231239320002 },
		{ lng: 20.7182121280001, lat: 44.323802948 },
		{ lng: 20.7125167850001, lat: 44.3247222890002 },
		{ lng: 20.7101764680002, lat: 44.3254241950002 },
		{ lng: 20.707138061, lat: 44.3267478940002 },
		{ lng: 20.6984691620002, lat: 44.3321266180001 },
		{ lng: 20.69446373, lat: 44.3336067200001 },
		{ lng: 20.6905078890002, lat: 44.334640504 },
		{ lng: 20.687564849, lat: 44.3348999030001 },
		{ lng: 20.6845951070002, lat: 44.334701539 },
		{ lng: 20.677562713, lat: 44.3328971870001 },
		{ lng: 20.66405487, lat: 44.327903748 },
		{ lng: 20.6497974390001, lat: 44.3218345640001 },
		{ lng: 20.6409873960001, lat: 44.3299331660001 },
		{ lng: 20.6359539030001, lat: 44.333789826 },
		{ lng: 20.634105682, lat: 44.3347549440001 },
		{ lng: 20.6272163390001, lat: 44.336704255 },
		{ lng: 20.624700546, lat: 44.3380088820001 },
		{ lng: 20.6229362480001, lat: 44.3398056030001 },
		{ lng: 20.6221904760002, lat: 44.3412704470002 },
		{ lng: 20.621860505, lat: 44.3428115840001 },
		{ lng: 20.6221199050001, lat: 44.3477859500001 },
		{ lng: 20.6204662320002, lat: 44.3557548530001 },
		{ lng: 20.619710922, lat: 44.364276885 },
		{ lng: 20.6190929410001, lat: 44.3669624330001 },
		{ lng: 20.6180896760002, lat: 44.3690376280002 },
		{ lng: 20.616516112, lat: 44.370742798 },
		{ lng: 20.614944458, lat: 44.3716583260001 },
		{ lng: 20.6112995150002, lat: 44.3729896560001 },
		{ lng: 20.6093730920002, lat: 44.3734321590001 },
		{ lng: 20.6064987180002, lat: 44.373657227 },
		{ lng: 20.603601455, lat: 44.3734092710001 },
		{ lng: 20.6002540580001, lat: 44.37253952 },
		{ lng: 20.595523834, lat: 44.3705520640001 },
		{ lng: 20.5889034280001, lat: 44.3681335460001 },
		{ lng: 20.5730094910002, lat: 44.3639144910001 },
		{ lng: 20.5650234220001, lat: 44.3611183170001 },
		{ lng: 20.5527248380002, lat: 44.3587646490001 },
		{ lng: 20.5462265010001, lat: 44.3564071660002 },
		{ lng: 20.54306221, lat: 44.3555679320002 },
		{ lng: 20.5403594960001, lat: 44.3555030820002 },
		{ lng: 20.538520813, lat: 44.3558464050002 },
		{ lng: 20.5365905770001, lat: 44.3565254220002 },
		{ lng: 20.5349121090001, lat: 44.3575057980001 },
		{ lng: 20.5336189280001, lat: 44.3588104240001 },
		{ lng: 20.5326995850002, lat: 44.3603591920001 },
		{ lng: 20.5319271080001, lat: 44.363033294 },
		{ lng: 20.5316581730002, lat: 44.3659324650002 },
		{ lng: 20.5321254730001, lat: 44.3720169080001 },
		{ lng: 20.5329685220001, lat: 44.375068666 },
		{ lng: 20.5364532480002, lat: 44.382938385 },
		{ lng: 20.537912369, lat: 44.385650634 },
		{ lng: 20.521598817, lat: 44.3913650520001 },
		{ lng: 20.509355546, lat: 44.3968315130001 },
		{ lng: 20.5059375760002, lat: 44.3977966310002 },
		{ lng: 20.5011081690002, lat: 44.3983764650002 },
		{ lng: 20.4978504190001, lat: 44.3984642020001 },
		{ lng: 20.487705231, lat: 44.3979988100001 },
		{ lng: 20.4856681830001, lat: 44.398281098 },
		{ lng: 20.483818054, lat: 44.3989181510001 },
		{ lng: 20.477262497, lat: 44.4037322990001 },
		{ lng: 20.469263077, lat: 44.4077644350002 },
		{ lng: 20.4664707190001, lat: 44.409404755 },
		{ lng: 20.4562549600001, lat: 44.4161949160001 },
		{ lng: 20.4538879390001, lat: 44.4171524050001 },
		{ lng: 20.451278687, lat: 44.4178466800001 },
		{ lng: 20.4484100350002, lat: 44.4183158870001 },
		{ lng: 20.442209244, lat: 44.4188957220001 },
		{ lng: 20.4333248130001, lat: 44.4128532410001 }
	];

	NoviSadDelimitiers = [
		{ lng: 19.5335407250001, lat: 45.2405624400001 },
		{ lng: 19.5389766690001, lat: 45.2409172060002 },
		{ lng: 19.5432434090001, lat: 45.2414665220002 },
		{ lng: 19.5474281310001, lat: 45.242412567 },
		{ lng: 19.5515060420001, lat: 45.2439765920002 },
		{ lng: 19.5587635040001, lat: 45.2478294380001 },
		{ lng: 19.5644531260002, lat: 45.2513046260001 },
		{ lng: 19.5721168520001, lat: 45.2579536450002 },
		{ lng: 19.573764802, lat: 45.2591629040001 },
		{ lng: 19.5813274390001, lat: 45.26373291 },
		{ lng: 19.5845031730001, lat: 45.2661628720001 },
		{ lng: 19.5856075290002, lat: 45.2676086420001 },
		{ lng: 19.5863208780001, lat: 45.2692031870001 },
		{ lng: 19.5866718290001, lat: 45.2713546750002 },
		{ lng: 19.586492539, lat: 45.273563386 },
		{ lng: 19.5857963560001, lat: 45.2757415780001 },
		{ lng: 19.5823535920001, lat: 45.2815589910002 },
		{ lng: 19.5818004610001, lat: 45.2836418160001 },
		{ lng: 19.5818843850001, lat: 45.2856674210001 },
		{ lng: 19.5826778420001, lat: 45.2875442510002 },
		{ lng: 19.584236145, lat: 45.289009095 },
		{ lng: 19.5858974460001, lat: 45.2897071850001 },
		{ lng: 19.5878868110001, lat: 45.2901649470001 },
		{ lng: 19.5968437190001, lat: 45.2912750240002 },
		{ lng: 19.59885788, lat: 45.291744233 },
		{ lng: 19.6005687710001, lat: 45.2924613960001 },
		{ lng: 19.6022567750002, lat: 45.2939758300002 },
		{ lng: 19.603294373, lat: 45.295932769 },
		{ lng: 19.603860855, lat: 45.2986602790001 },
		{ lng: 19.6036758410002, lat: 45.3045349120001 },
		{ lng: 19.6025123590002, lat: 45.3104400640001 },
		{ lng: 19.602712631, lat: 45.3124923700001 },
		{ lng: 19.6041984560001, lat: 45.3151245110001 },
		{ lng: 19.6054248810001, lat: 45.3164253240001 },
		{ lng: 19.6069335940002, lat: 45.317504883 },
		{ lng: 19.608781815, lat: 45.318252563 },
		{ lng: 19.6108722680001, lat: 45.3186569220001 },
		{ lng: 19.6137142190001, lat: 45.3186645520001 },
		{ lng: 19.6209297170001, lat: 45.3173332220001 },
		{ lng: 19.6283130650001, lat: 45.3154487610001 },
		{ lng: 19.633588791, lat: 45.314395905 },
		{ lng: 19.6375045770001, lat: 45.3141632090001 },
		{ lng: 19.641311645, lat: 45.3145484920001 },
		{ lng: 19.6444072720001, lat: 45.3155174250001 },
		{ lng: 19.6477012640001, lat: 45.3174972550001 },
		{ lng: 19.6497612010002, lat: 45.3194732670001 },
		{ lng: 19.6516227730002, lat: 45.3217735300001 },
		{ lng: 19.6552505500001, lat: 45.327209473 },
		{ lng: 19.6557273860001, lat: 45.3287658700002 },
		{ lng: 19.656078339, lat: 45.3364181520002 },
		{ lng: 19.6571235660001, lat: 45.341686248 },
		{ lng: 19.6572132100001, lat: 45.343860625 },
		{ lng: 19.6562175760001, lat: 45.3475112910001 },
		{ lng: 19.6529636380002, lat: 45.354125976 },
		{ lng: 19.6507434840001, lat: 45.3626899720001 },
		{ lng: 19.6496372220001, lat: 45.3654365540001 },
		{ lng: 19.6483287810001, lat: 45.3673629760002 },
		{ lng: 19.6434192660001, lat: 45.3729476930001 },
		{ lng: 19.6372528070001, lat: 45.3788185130001 },
		{ lng: 19.6344203950001, lat: 45.382846832 },
		{ lng: 19.6311874380002, lat: 45.3866615310001 },
		{ lng: 19.6195926670001, lat: 45.3980064400002 },
		{ lng: 19.6092853540001, lat: 45.4067420970001 },
		{ lng: 19.6213569650001, lat: 45.4146575930001 },
		{ lng: 19.635303498, lat: 45.4205551140002 },
		{ lng: 19.6428108220002, lat: 45.4247970580001 },
		{ lng: 19.6472873700002, lat: 45.4263038640001 },
		{ lng: 19.6565284730002, lat: 45.4281387320001 },
		{ lng: 19.6646938330001, lat: 45.4308128350001 },
		{ lng: 19.667797088, lat: 45.4313507080001 },
		{ lng: 19.6743144990001, lat: 45.4315795910001 },
		{ lng: 19.6775550830001, lat: 45.4313240060002 },
		{ lng: 19.6806545260002, lat: 45.4307174680001 },
		{ lng: 19.68378067, lat: 45.429477692 },
		{ lng: 19.6864776610001, lat: 45.4276618970001 },
		{ lng: 19.6915798180002, lat: 45.423324586 },
		{ lng: 19.7009525300001, lat: 45.4163322460002 },
		{ lng: 19.7023448950001, lat: 45.415473938 },
		{ lng: 19.7035465240002, lat: 45.4151573190001 },
		{ lng: 19.716896057, lat: 45.4178810110002 },
		{ lng: 19.7290096290001, lat: 45.420639038 },
		{ lng: 19.7330436710001, lat: 45.4211502070002 },
		{ lng: 19.7371273050002, lat: 45.4213409430001 },
		{ lng: 19.7452087410002, lat: 45.4211044320002 },
		{ lng: 19.7571525580001, lat: 45.4193878170001 },
		{ lng: 19.7801074990001, lat: 45.4186134330002 },
		{ lng: 19.7838153850001, lat: 45.4181785580002 },
		{ lng: 19.7863121040002, lat: 45.4176521300001 },
		{ lng: 19.7886753080001, lat: 45.4169311520002 },
		{ lng: 19.7916984570001, lat: 45.4155502320002 },
		{ lng: 19.7942714700001, lat: 45.4137725840001 },
		{ lng: 19.7970581050001, lat: 45.4112129210002 },
		{ lng: 19.801483155, lat: 45.4056205740001 },
		{ lng: 19.8023471830001, lat: 45.4037628170001 },
		{ lng: 19.8024826050001, lat: 45.4017372120002 },
		{ lng: 19.7997741700001, lat: 45.3939590450001 },
		{ lng: 19.7998008740001, lat: 45.3919067390001 },
		{ lng: 19.800985337, lat: 45.389060973 },
		{ lng: 19.8034172060001, lat: 45.3857231140001 },
		{ lng: 19.8066978450001, lat: 45.3828697210002 },
		{ lng: 19.808855056, lat: 45.381477356 },
		{ lng: 19.8119049060001, lat: 45.3800888060001 },
		{ lng: 19.81523323, lat: 45.379058837 },
		{ lng: 19.823667527, lat: 45.377330781 },
		{ lng: 19.8257389070002, lat: 45.3766365060001 },
		{ lng: 19.8284683220002, lat: 45.3751487740001 },
		{ lng: 19.8369789110001, lat: 45.3688812250001 },
		{ lng: 19.8420295710002, lat: 45.3656845100002 },
		{ lng: 19.8449268340001, lat: 45.364269257 },
		{ lng: 19.8472309110001, lat: 45.363418579 },
		{ lng: 19.8557701120001, lat: 45.361248017 },
		{ lng: 19.862737656, lat: 45.3588218690002 },
		{ lng: 19.8724060060001, lat: 45.3538665770001 },
		{ lng: 19.8799457550002, lat: 45.3494834910001 },
		{ lng: 19.8821563730001, lat: 45.3486595150001 },
		{ lng: 19.8845520030001, lat: 45.348102569 },
		{ lng: 19.8877754210001, lat: 45.3477973950002 },
		{ lng: 19.8927803040001, lat: 45.3481369030002 },
		{ lng: 19.8964653010001, lat: 45.349040985 },
		{ lng: 19.9054393770001, lat: 45.3521003720001 },
		{ lng: 19.9090309150001, lat: 45.3525695810001 },
		{ lng: 19.9106540680002, lat: 45.3523216240001 },
		{ lng: 19.9325275410001, lat: 45.3468055730002 },
		{ lng: 19.9376945500002, lat: 45.3461837770001 },
		{ lng: 19.9420299540001, lat: 45.3461227410002 },
		{ lng: 19.945051193, lat: 45.3458366400002 },
		{ lng: 19.9471454610001, lat: 45.345413208 },
		{ lng: 19.9521694190001, lat: 45.3440551770001 },
		{ lng: 19.959039688, lat: 45.3415489190001 },
		{ lng: 19.9646015160001, lat: 45.338615417 },
		{ lng: 19.966201782, lat: 45.3373641960001 },
		{ lng: 19.967409133, lat: 45.3359184260001 },
		{ lng: 19.9682197560001, lat: 45.3343238830002 },
		{ lng: 19.968694686, lat: 45.3321685800001 },
		{ lng: 19.9686508190001, lat: 45.329956056 },
		{ lng: 19.9681034080002, lat: 45.3277816770001 },
		{ lng: 19.967281342, lat: 45.326152803 },
		{ lng: 19.9661369330001, lat: 45.3246459970001 },
		{ lng: 19.9620037070001, lat: 45.320770263 },
		{ lng: 19.9610176090002, lat: 45.3195152290001 },
		{ lng: 19.960210801, lat: 45.3174324040002 },
		{ lng: 19.9602279660001, lat: 45.3164901730001 },
		{ lng: 19.9610252390001, lat: 45.3145446790001 },
		{ lng: 19.962486267, lat: 45.312675476 },
		{ lng: 19.9653720850001, lat: 45.3101844800001 },
		{ lng: 19.9671897880001, lat: 45.3092346200001 },
		{ lng: 19.9723091130001, lat: 45.3074989310001 },
		{ lng: 19.9807910920001, lat: 45.3041114800002 },
		{ lng: 19.984701156, lat: 45.3034210200001 },
		{ lng: 19.9888439180001, lat: 45.3033294680001 },
		{ lng: 19.9929580680002, lat: 45.303787232 },
		{ lng: 19.995065689, lat: 45.3042716980002 },
		{ lng: 20.0089588170001, lat: 45.3082008370001 },
		{ lng: 20.0109405530001, lat: 45.3085174560001 },
		{ lng: 20.0137462620002, lat: 45.30853653 },
		{ lng: 20.0156803130002, lat: 45.3082351680002 },
		{ lng: 20.0199203490002, lat: 45.3069381720001 },
		{ lng: 20.031349182, lat: 45.3028335580001 },
		{ lng: 20.0333023080001, lat: 45.301509858 },
		{ lng: 20.0337295530001, lat: 45.2998619080001 },
		{ lng: 20.0327720640001, lat: 45.2979965210001 },
		{ lng: 20.0311164860001, lat: 45.296340943 },
		{ lng: 20.0299301150001, lat: 45.2955589290002 },
		{ lng: 20.0309696190001, lat: 45.2899093620002 },
		{ lng: 20.0318107610001, lat: 45.287296295 },
		{ lng: 20.0360717780001, lat: 45.2789611820001 },
		{ lng: 20.0386047370002, lat: 45.2761268610001 },
		{ lng: 20.0409259800001, lat: 45.2741355900001 },
		{ lng: 20.0451145170001, lat: 45.2712898250001 },
		{ lng: 20.0464801780001, lat: 45.270111084 },
		{ lng: 20.0474910730001, lat: 45.2682266240001 },
		{ lng: 20.0473365780001, lat: 45.266212464 },
		{ lng: 20.0463981620001, lat: 45.2624931350001 },
		{ lng: 20.046474458, lat: 45.2607612610001 },
		{ lng: 20.046943665, lat: 45.259025575 },
		{ lng: 20.047681809, lat: 45.257598878 },
		{ lng: 20.0493621830001, lat: 45.255214691 },
		{ lng: 20.0526657110001, lat: 45.2515830990001 },
		{ lng: 20.054864884, lat: 45.2496109010002 },
		{ lng: 20.0597381590001, lat: 45.246181488 },
		{ lng: 20.0615234380002, lat: 45.244354248 },
		{ lng: 20.0621681210001, lat: 45.242862702 },
		{ lng: 20.0624694820001, lat: 45.241230011 },
		{ lng: 20.0635452280001, lat: 45.2292213430001 },
		{ lng: 20.0639781960001, lat: 45.2270927430001 },
		{ lng: 20.0647296910001, lat: 45.225479126 },
		{ lng: 20.0658626560001, lat: 45.2239799500002 },
		{ lng: 20.0680694580001, lat: 45.2220993050001 },
		{ lng: 20.073118209, lat: 45.2184906010001 },
		{ lng: 20.0757541650001, lat: 45.2167701720001 },
		{ lng: 20.0825691220001, lat: 45.2136726370001 },
		{ lng: 20.0841274270002, lat: 45.21270752 },
		{ lng: 20.0853862760001, lat: 45.2115936270002 },
		{ lng: 20.0865726470001, lat: 45.2095794680001 },
		{ lng: 20.0865802770001, lat: 45.2072219850002 },
		{ lng: 20.0858993530001, lat: 45.20520401 },
		{ lng: 20.0850925450001, lat: 45.2037887570001 },
		{ lng: 20.0826511380001, lat: 45.2003631590002 },
		{ lng: 20.0768699650001, lat: 45.1941871640001 },
		{ lng: 20.0756034850001, lat: 45.1920013440001 },
		{ lng: 20.0753402710002, lat: 45.1897811900001 },
		{ lng: 20.0756931300002, lat: 45.1881523140001 },
		{ lng: 20.0798015600001, lat: 45.1780548100001 },
		{ lng: 20.080104829, lat: 45.1741104130002 },
		{ lng: 20.079517364, lat: 45.1697883610001 },
		{ lng: 20.0781955720001, lat: 45.1670951850001 },
		{ lng: 20.0761585240001, lat: 45.1647987370001 },
		{ lng: 20.0734958640001, lat: 45.1629905700001 },
		{ lng: 20.0650577540002, lat: 45.159095765 },
		{ lng: 20.0585823050001, lat: 45.155368805 },
		{ lng: 20.0561008460002, lat: 45.1548385630001 },
		{ lng: 20.053398132, lat: 45.1548461910002 },
		{ lng: 20.0507564540001, lat: 45.1553573620001 },
		{ lng: 20.0453224190002, lat: 45.157657623 },
		{ lng: 20.0425987240002, lat: 45.1583251960001 },
		{ lng: 20.0397415150001, lat: 45.1586685170002 },
		{ lng: 20.0357322700001, lat: 45.1585769650001 },
		{ lng: 20.0273914340001, lat: 45.1571578990001 },
		{ lng: 20.0240802760001, lat: 45.1570892330001 },
		{ lng: 20.0213165290001, lat: 45.1578407290001 },
		{ lng: 20.0187606820001, lat: 45.1590843190002 },
		{ lng: 20.0164585110001, lat: 45.160678864 },
		{ lng: 20.0152168280001, lat: 45.1621742240001 },
		{ lng: 20.0147705070001, lat: 45.1637725840002 },
		{ lng: 20.0153446190001, lat: 45.165470123 },
		{ lng: 20.0166149140002, lat: 45.1671943670001 },
		{ lng: 20.0214805590002, lat: 45.172676086 },
		{ lng: 20.0233402260001, lat: 45.1751289360001 },
		{ lng: 20.0242214200002, lat: 45.176628114 },
		{ lng: 20.0249423990001, lat: 45.1788787840001 },
		{ lng: 20.02512741, lat: 45.181224824 },
		{ lng: 20.0248146060001, lat: 45.1835784920001 },
		{ lng: 20.0238971700002, lat: 45.1858329780001 },
		{ lng: 20.0228004460002, lat: 45.1872978210001 },
		{ lng: 20.0191097260002, lat: 45.1906890880001 },
		{ lng: 20.0175457000001, lat: 45.1925544750001 },
		{ lng: 20.016529082, lat: 45.194274903 },
		{ lng: 20.0163364410001, lat: 45.1952018740001 },
		{ lng: 20.0035991660001, lat: 45.200126648 },
		{ lng: 19.9984531400001, lat: 45.2017936710001 },
		{ lng: 19.9946098330001, lat: 45.2024726870001 },
		{ lng: 19.990694046, lat: 45.2028198240001 },
		{ lng: 19.975261688, lat: 45.2033538810002 },
		{ lng: 19.9716510770002, lat: 45.2036705010001 },
		{ lng: 19.9682941440001, lat: 45.204277039 },
		{ lng: 19.9595088950001, lat: 45.2070426940001 },
		{ lng: 19.9562301640001, lat: 45.2076759340001 },
		{ lng: 19.945358277, lat: 45.2087554940001 },
		{ lng: 19.9417057040001, lat: 45.2093734730001 },
		{ lng: 19.9354763040001, lat: 45.2111892710001 },
		{ lng: 19.9302730550001, lat: 45.2130393980001 },
		{ lng: 19.9268856040001, lat: 45.2146186840001 },
		{ lng: 19.9242153170002, lat: 45.2163505550001 },
		{ lng: 19.9231014240001, lat: 45.2174758910002 },
		{ lng: 19.922868728, lat: 45.2180938720001 },
		{ lng: 19.9246921540001, lat: 45.2193298350001 },
		{ lng: 19.9254646300001, lat: 45.2199211120001 },
		{ lng: 19.925762176, lat: 45.2202224740001 },
		{ lng: 19.925945282, lat: 45.2205390940001 },
		{ lng: 19.9259700780001, lat: 45.2209167490001 },
		{ lng: 19.9257144920001, lat: 45.2217178340001 },
		{ lng: 19.9253292090002, lat: 45.2225379950002 },
		{ lng: 19.9249095920002, lat: 45.2233543410002 },
		{ lng: 19.9243812570001, lat: 45.2241363530001 },
		{ lng: 19.9232940680001, lat: 45.2250595090001 },
		{ lng: 19.9210643760001, lat: 45.2266159060001 },
		{ lng: 19.9159889210001, lat: 45.222999572 },
		{ lng: 19.9009056090001, lat: 45.2124519350002 },
		{ lng: 19.8984012600001, lat: 45.2098617560001 },
		{ lng: 19.8958873740001, lat: 45.2048225400001 },
		{ lng: 19.8914680470001, lat: 45.200511933 },
		{ lng: 19.8909244540002, lat: 45.198650361 },
		{ lng: 19.8913536070001, lat: 45.197174072 },
		{ lng: 19.8923587790001, lat: 45.1956863400002 },
		{ lng: 19.895732879, lat: 45.1919708250002 },
		{ lng: 19.896606445, lat: 45.190498351 },
		{ lng: 19.8971233370002, lat: 45.1889457710002 },
		{ lng: 19.8971920000001, lat: 45.1869316090001 },
		{ lng: 19.8967761980001, lat: 45.1853599550001 },
		{ lng: 19.8959941870002, lat: 45.1838455200001 },
		{ lng: 19.8926982870001, lat: 45.179782867 },
		{ lng: 19.890878677, lat: 45.1765289320002 },
		{ lng: 19.8887805940001, lat: 45.1678543100001 },
		{ lng: 19.8869266520002, lat: 45.1632308960001 },
		{ lng: 19.8857078550001, lat: 45.161582946 },
		{ lng: 19.8834648140001, lat: 45.1594276430001 },
		{ lng: 19.8680763240001, lat: 45.1464271540002 },
		{ lng: 19.8660278320001, lat: 45.146995545 },
		{ lng: 19.8622627260002, lat: 45.1474571220001 },
		{ lng: 19.8533573160001, lat: 45.1479034430002 },
		{ lng: 19.836074829, lat: 45.148162842 },
		{ lng: 19.8197040560001, lat: 45.1481666570001 },
		{ lng: 19.8118057240001, lat: 45.1477699290002 },
		{ lng: 19.8080825800001, lat: 45.1472320560001 },
		{ lng: 19.799156189, lat: 45.1452522280001 },
		{ lng: 19.7973060600002, lat: 45.145103454 },
		{ lng: 19.795318604, lat: 45.1453475960002 },
		{ lng: 19.7935237880002, lat: 45.1460304250001 },
		{ lng: 19.7920207970001, lat: 45.1471252440002 },
		{ lng: 19.783855439, lat: 45.157054902 },
		{ lng: 19.7730941770001, lat: 45.1670990000001 },
		{ lng: 19.7715892790001, lat: 45.1700897220001 },
		{ lng: 19.769407272, lat: 45.1787605290002 },
		{ lng: 19.7682743070001, lat: 45.181369781 },
		{ lng: 19.7664394380001, lat: 45.1837577830001 },
		{ lng: 19.7634563440002, lat: 45.1863479620001 },
		{ lng: 19.7617855080001, lat: 45.1882209770001 },
		{ lng: 19.7611522680002, lat: 45.1901245110002 },
		{ lng: 19.7612991330001, lat: 45.1921348580001 },
		{ lng: 19.7646255480001, lat: 45.1999855040001 },
		{ lng: 19.7648220070001, lat: 45.2021026620001 },
		{ lng: 19.764295578, lat: 45.2041854850001 },
		{ lng: 19.7630844110001, lat: 45.206027984 },
		{ lng: 19.7593955980001, lat: 45.2093925470002 },
		{ lng: 19.7560901630001, lat: 45.211605073 },
		{ lng: 19.7532463070002, lat: 45.2130126960001 },
		{ lng: 19.7488403310001, lat: 45.2141037000001 },
		{ lng: 19.7394371030001, lat: 45.2156562800001 },
		{ lng: 19.7311916340001, lat: 45.218273163 },
		{ lng: 19.7275390630001, lat: 45.2189102180001 },
		{ lng: 19.7237186440001, lat: 45.2192344680001 },
		{ lng: 19.7158317570001, lat: 45.2194709790001 },
		{ lng: 19.6919803620001, lat: 45.2194061280001 },
		{ lng: 19.6843986510001, lat: 45.2187805190001 },
		{ lng: 19.6764431010002, lat: 45.2176132200001 },
		{ lng: 19.6538848870001, lat: 45.2169227600002 },
		{ lng: 19.6503257750002, lat: 45.2164688110001 },
		{ lng: 19.6356925960001, lat: 45.2134437560001 },
		{ lng: 19.6321754460002, lat: 45.2130012510001 },
		{ lng: 19.6285171500001, lat: 45.2127914430002 },
		{ lng: 19.6134376530001, lat: 45.2126884460001 },
		{ lng: 19.605962753, lat: 45.2124214180002 },
		{ lng: 19.6023521420001, lat: 45.2119865430002 },
		{ lng: 19.5998821260001, lat: 45.2114562980001 },
		{ lng: 19.5975208280001, lat: 45.2107429500001 },
		{ lng: 19.589569093, lat: 45.2074852000002 },
		{ lng: 19.58721733, lat: 45.2067909250002 },
		{ lng: 19.5847759250001, lat: 45.206306457 },
		{ lng: 19.581590652, lat: 45.2060089110001 },
		{ lng: 19.5783729560001, lat: 45.2060050980001 },
		{ lng: 19.5751953120001, lat: 45.2062873840002 },
		{ lng: 19.567577362, lat: 45.2074775690002 },
		{ lng: 19.5609760280001, lat: 45.2081718440001 },
		{ lng: 19.5553016670002, lat: 45.2092742910001 },
		{ lng: 19.5530166620002, lat: 45.2100753790002 },
		{ lng: 19.5502948770001, lat: 45.211486817 },
		{ lng: 19.548006058, lat: 45.2131767270001 },
		{ lng: 19.5467853550002, lat: 45.2144241330001 },
		{ lng: 19.5459098820002, lat: 45.2157516470002 },
		{ lng: 19.545370102, lat: 45.217758179 },
		{ lng: 19.545280457, lat: 45.2229080200001 },
		{ lng: 19.5438442230002, lat: 45.2264213570001 },
		{ lng: 19.5335407250001, lat: 45.2405624400001 }
	];

	PancevoDelimiters = [
		{ lng: 20.7781925210001, lat: 44.6328964230001 },
		{ lng: 20.7649383550001, lat: 44.6314773560002 },
		{ lng: 20.756639481, lat: 44.6308250430001 },
		{ lng: 20.7509937290001, lat: 44.630901337 },
		{ lng: 20.7477645870001, lat: 44.6313896190001 },
		{ lng: 20.7456340800001, lat: 44.63198471 },
		{ lng: 20.74136734, lat: 44.633636475 },
		{ lng: 20.739269257, lat: 44.6346664430002 },
		{ lng: 20.7367439260001, lat: 44.636291504 },
		{ lng: 20.7345752720001, lat: 44.6381340030002 },
		{ lng: 20.7301769260001, lat: 44.6425323490001 },
		{ lng: 20.7269134530001, lat: 44.6450195310001 },
		{ lng: 20.724916459, lat: 44.6459159850002 },
		{ lng: 20.7226867670001, lat: 44.6465606700001 },
		{ lng: 20.7188434600001, lat: 44.6471748360001 },
		{ lng: 20.7107963550002, lat: 44.647960663 },
		{ lng: 20.7069377890002, lat: 44.6486854550001 },
		{ lng: 20.7042198170001, lat: 44.6495933530001 },
		{ lng: 20.696826935, lat: 44.6529235840001 },
		{ lng: 20.6918869020001, lat: 44.655540466 },
		{ lng: 20.6866912830001, lat: 44.6590232840001 },
		{ lng: 20.68203354, lat: 44.6627845760001 },
		{ lng: 20.6800861360001, lat: 44.664787292 },
		{ lng: 20.677547455, lat: 44.6681709300001 },
		{ lng: 20.673273087, lat: 44.6749954230001 },
		{ lng: 20.6684093470001, lat: 44.6796722420001 },
		{ lng: 20.6666202550001, lat: 44.6819190970001 },
		{ lng: 20.6598682410001, lat: 44.6939201350001 },
		{ lng: 20.657106399, lat: 44.7003860470001 },
		{ lng: 20.6557102210001, lat: 44.7022628780002 },
		{ lng: 20.6522293080001, lat: 44.70576477 },
		{ lng: 20.6489963540002, lat: 44.7084579480001 },
		{ lng: 20.645051957, lat: 44.7106170670001 },
		{ lng: 20.641241073, lat: 44.7123260500001 },
		{ lng: 20.629764558, lat: 44.716804504 },
		{ lng: 20.6240062710001, lat: 44.7198715210001 },
		{ lng: 20.6208362570002, lat: 44.7225875850001 },
		{ lng: 20.6145515450001, lat: 44.7287406910001 },
		{ lng: 20.6124591820001, lat: 44.7303199780001 },
		{ lng: 20.6064548480001, lat: 44.734069824 },
		{ lng: 20.6043357840001, lat: 44.735748292 },
		{ lng: 20.6028442390001, lat: 44.737594604 },
		{ lng: 20.602207184, lat: 44.7394638060001 },
		{ lng: 20.6020412440001, lat: 44.742164613 },
		{ lng: 20.6015663140001, lat: 44.7441215520002 },
		{ lng: 20.5982151020002, lat: 44.749591828 },
		{ lng: 20.5973339080001, lat: 44.7516326910001 },
		{ lng: 20.59692955, lat: 44.75309372 },
		{ lng: 20.5968742370001, lat: 44.7551918030002 },
		{ lng: 20.5979976650002, lat: 44.7587814340001 },
		{ lng: 20.6028251650001, lat: 44.767032623 },
		{ lng: 20.6100997920001, lat: 44.7820396430001 },
		{ lng: 20.607934952, lat: 44.7838935860001 },
		{ lng: 20.602800369, lat: 44.7908592220002 },
		{ lng: 20.6012592320001, lat: 44.7924957280001 },
		{ lng: 20.5934600820001, lat: 44.7982559210001 },
		{ lng: 20.5884838110001, lat: 44.804111481 },
		{ lng: 20.5865268720001, lat: 44.8055763240002 },
		{ lng: 20.5847015390002, lat: 44.8062820440001 },
		{ lng: 20.582618714, lat: 44.8067550670001 },
		{ lng: 20.573467255, lat: 44.8081741330001 },
		{ lng: 20.5695476540001, lat: 44.8094024660001 },
		{ lng: 20.5660285940001, lat: 44.8110847470001 },
		{ lng: 20.5643920900001, lat: 44.8127822870002 },
		{ lng: 20.5633506780001, lat: 44.814846039 },
		{ lng: 20.5625953680001, lat: 44.81937027 },
		{ lng: 20.562942504, lat: 44.8240394590001 },
		{ lng: 20.563610078, lat: 44.8262672430002 },
		{ lng: 20.564498902, lat: 44.8279190060002 },
		{ lng: 20.565731048, lat: 44.8294258120001 },
		{ lng: 20.5729598990001, lat: 44.8347854630001 },
		{ lng: 20.5750427240001, lat: 44.8366622930002 },
		{ lng: 20.5766983040001, lat: 44.8385505670001 },
		{ lng: 20.5824413300001, lat: 44.8460502630001 },
		{ lng: 20.5903015140001, lat: 44.8577690120001 },
		{ lng: 20.5918693550001, lat: 44.8607177730001 },
		{ lng: 20.5941028590001, lat: 44.8697395330001 },
		{ lng: 20.595037461, lat: 44.8718910220001 },
		{ lng: 20.596586228, lat: 44.8740005500002 },
		{ lng: 20.6002597810001, lat: 44.8780212410001 },
		{ lng: 20.601673127, lat: 44.8801002510002 },
		{ lng: 20.6023178100001, lat: 44.8821868890001 },
		{ lng: 20.6023159020002, lat: 44.8843231190001 },
		{ lng: 20.6016540530002, lat: 44.886405944 },
		{ lng: 20.6000499730002, lat: 44.8886146550001 },
		{ lng: 20.5978794090001, lat: 44.890712738 },
		{ lng: 20.5930271140001, lat: 44.8948135380001 },
		{ lng: 20.586584092, lat: 44.9009170540001 },
		{ lng: 20.578697205, lat: 44.9068489070002 },
		{ lng: 20.5731391900001, lat: 44.910282135 },
		{ lng: 20.570228576, lat: 44.9116477970001 },
		{ lng: 20.5679035190001, lat: 44.912452697 },
		{ lng: 20.559158325, lat: 44.914348603 },
		{ lng: 20.554351807, lat: 44.9157142650001 },
		{ lng: 20.5440883630001, lat: 44.9199256900001 },
		{ lng: 20.5315761570001, lat: 44.9237327580001 },
		{ lng: 20.5269584660001, lat: 44.925380708 },
		{ lng: 20.5213451380001, lat: 44.9284286510001 },
		{ lng: 20.5126762390001, lat: 44.934398651 },
		{ lng: 20.507297517, lat: 44.9385948170001 },
		{ lng: 20.5049571990002, lat: 44.9407997130002 },
		{ lng: 20.5000705730001, lat: 44.946430207 },
		{ lng: 20.4988384250001, lat: 44.9483604430001 },
		{ lng: 20.4981098180002, lat: 44.9505462650001 },
		{ lng: 20.4978942860001, lat: 44.9528236390001 },
		{ lng: 20.4988059990001, lat: 44.9583206190001 },
		{ lng: 20.4988861080001, lat: 44.9606704720001 },
		{ lng: 20.4983520500002, lat: 44.9630203240001 },
		{ lng: 20.4974117280001, lat: 44.964790345 },
		{ lng: 20.4959411620002, lat: 44.9664535530002 },
		{ lng: 20.4938449860001, lat: 44.9679451000001 },
		{ lng: 20.4917812350001, lat: 44.9689712530001 },
		{ lng: 20.4906406410001, lat: 44.9693069460001 },
		{ lng: 20.4921646120001, lat: 44.9761848460002 },
		{ lng: 20.4934158320001, lat: 44.9791603080002 },
		{ lng: 20.4956436160001, lat: 44.9822120660001 },
		{ lng: 20.4996528630001, lat: 44.9855575560002 },
		{ lng: 20.502422333, lat: 44.9871940620002 },
		{ lng: 20.5089950560001, lat: 44.9898262030001 },
		{ lng: 20.5111103060001, lat: 44.9904251110001 },
		{ lng: 20.514253615, lat: 44.990970612 },
		{ lng: 20.5240573870001, lat: 44.9917526250002 },
		{ lng: 20.5347633360001, lat: 44.9932746890001 },
		{ lng: 20.5445079800001, lat: 44.9940376280001 },
		{ lng: 20.5476322170001, lat: 44.9945182800001 },
		{ lng: 20.559078216, lat: 44.9974441530002 },
		{ lng: 20.5622882840001, lat: 44.9979553220001 },
		{ lng: 20.5751094820001, lat: 44.9990005500001 },
		{ lng: 20.5925025940002, lat: 45.000938416 },
		{ lng: 20.5932292940001, lat: 44.9986267100001 },
		{ lng: 20.5971698760002, lat: 44.991516114 },
		{ lng: 20.600164413, lat: 44.9843139650002 },
		{ lng: 20.6011753080001, lat: 44.9826087950001 },
		{ lng: 20.6024131770001, lat: 44.9810523990002 },
		{ lng: 20.6065025330001, lat: 44.9770965590001 },
		{ lng: 20.6074237810001, lat: 44.975814819 },
		{ lng: 20.6081428520002, lat: 44.9736824040001 },
		{ lng: 20.6072731020001, lat: 44.9684066770001 },
		{ lng: 20.6072158810001, lat: 44.9662971500001 },
		{ lng: 20.6076812730001, lat: 44.9642524720001 },
		{ lng: 20.6086215970001, lat: 44.9625740060001 },
		{ lng: 20.609960555, lat: 44.9611511240001 },
		{ lng: 20.612066269, lat: 44.95993042 },
		{ lng: 20.6137561800001, lat: 44.959609985 },
		{ lng: 20.6155567170001, lat: 44.9596977240001 },
		{ lng: 20.6172618870002, lat: 44.9601173410001 },
		{ lng: 20.6237525940001, lat: 44.9625167860002 },
		{ lng: 20.627370834, lat: 44.9632301340002 },
		{ lng: 20.639070511, lat: 44.9643173220001 },
		{ lng: 20.6449317940001, lat: 44.9654541010001 },
		{ lng: 20.6498546600001, lat: 44.9670066840002 },
		{ lng: 20.6576843260002, lat: 44.970092773 },
		{ lng: 20.6727581030001, lat: 44.9746589670002 },
		{ lng: 20.6805171960002, lat: 44.9783630380001 },
		{ lng: 20.6826972960001, lat: 44.9791412350002 },
		{ lng: 20.685009002, lat: 44.979743958 },
		{ lng: 20.6929435730001, lat: 44.9811782830001 },
		{ lng: 20.6946792600001, lat: 44.9817276010001 },
		{ lng: 20.6964321140002, lat: 44.9829635620001 },
		{ lng: 20.6968708050001, lat: 44.9841461190002 },
		{ lng: 20.6967697150001, lat: 44.9854965200001 },
		{ lng: 20.6942462920001, lat: 44.9932136540002 },
		{ lng: 20.6937694550001, lat: 44.9940223700001 },
		{ lng: 20.6870250710001, lat: 45.000854492 },
		{ lng: 20.6860237120001, lat: 45.0028839120001 },
		{ lng: 20.6859207150001, lat: 45.0037803640001 },
		{ lng: 20.6866168970001, lat: 45.0064430240002 },
		{ lng: 20.687480927, lat: 45.0077629090001 },
		{ lng: 20.6895084380002, lat: 45.0095367440002 },
		{ lng: 20.6944293980002, lat: 45.0125770570001 },
		{ lng: 20.6994552610001, lat: 45.0151748660001 },
		{ lng: 20.7081356050001, lat: 45.0182571400002 },
		{ lng: 20.7169017790002, lat: 45.0200233460001 },
		{ lng: 20.7193222050001, lat: 45.0208930960001 },
		{ lng: 20.7244110110001, lat: 45.0246047980001 },
		{ lng: 20.730928421, lat: 45.0282173170002 },
		{ lng: 20.7337684640001, lat: 45.02955246 },
		{ lng: 20.738302231, lat: 45.0311927790001 },
		{ lng: 20.7422370910002, lat: 45.0320854180002 },
		{ lng: 20.744314193, lat: 45.0320930480001 },
		{ lng: 20.7463016510002, lat: 45.0317077630001 },
		{ lng: 20.7489662160001, lat: 45.0304069520002 },
		{ lng: 20.7545204160001, lat: 45.0267906200001 },
		{ lng: 20.7600955950002, lat: 45.0240097050001 },
		{ lng: 20.7613983160001, lat: 45.0236015330001 },
		{ lng: 20.7683296210001, lat: 45.0155296320001 },
		{ lng: 20.7728862770001, lat: 45.011577607 },
		{ lng: 20.778085708, lat: 45.0079193110002 },
		{ lng: 20.7809352870001, lat: 45.0062408450001 },
		{ lng: 20.793989181, lat: 44.9996490480001 },
		{ lng: 20.804159165, lat: 44.9970436090001 },
		{ lng: 20.8099899280001, lat: 44.994655609 },
		{ lng: 20.8158740990002, lat: 44.991371155 },
		{ lng: 20.8183422090001, lat: 44.9894676210001 },
		{ lng: 20.8307495110001, lat: 44.979358673 },
		{ lng: 20.8318214410002, lat: 44.9781684870001 },
		{ lng: 20.832843781, lat: 44.9759826670001 },
		{ lng: 20.832939148, lat: 44.9746398940001 },
		{ lng: 20.832374572, lat: 44.9699325560002 },
		{ lng: 20.8326435100001, lat: 44.9679985050001 },
		{ lng: 20.8338298800002, lat: 44.9657783510001 },
		{ lng: 20.8400421140001, lat: 44.959957123 },
		{ lng: 20.8433265680001, lat: 44.9573593140001 },
		{ lng: 20.8452491760002, lat: 44.956272126 },
		{ lng: 20.8492717740001, lat: 44.9545936590001 },
		{ lng: 20.8512916560001, lat: 44.9540176400002 },
		{ lng: 20.854297637, lat: 44.9535713190001 },
		{ lng: 20.857379914, lat: 44.9535255440001 },
		{ lng: 20.860422134, lat: 44.9538803110001 },
		{ lng: 20.8624954230001, lat: 44.95439148 },
		{ lng: 20.8688240050001, lat: 44.9568595880002 },
		{ lng: 20.8714447030002, lat: 44.9584999080001 },
		{ lng: 20.8734703060002, lat: 44.9605178840001 },
		{ lng: 20.876142503, lat: 44.9645538340001 },
		{ lng: 20.8777198790002, lat: 44.966434479 },
		{ lng: 20.8914127360001, lat: 44.9757385250002 },
		{ lng: 20.8991088870001, lat: 44.9568672180001 },
		{ lng: 20.8994998930002, lat: 44.9553642280001 },
		{ lng: 20.8993892670001, lat: 44.9532814030001 },
		{ lng: 20.8966922760001, lat: 44.9476623540002 },
		{ lng: 20.8962574010001, lat: 44.9455718990001 },
		{ lng: 20.896347045, lat: 44.9434471120001 },
		{ lng: 20.8974380490001, lat: 44.93832016 },
		{ lng: 20.8979434970001, lat: 44.9324874880001 },
		{ lng: 20.900411605, lat: 44.9258346570001 },
		{ lng: 20.9010772710001, lat: 44.9232139590001 },
		{ lng: 20.902276993, lat: 44.9122505180001 },
		{ lng: 20.903038026, lat: 44.909641266 },
		{ lng: 20.9037685400001, lat: 44.90813446 },
		{ lng: 20.9058647160002, lat: 44.9045982370001 },
		{ lng: 20.9095287320001, lat: 44.8997879040001 },
		{ lng: 20.9114780420001, lat: 44.8977737420001 },
		{ lng: 20.919969559, lat: 44.8902053840002 },
		{ lng: 20.9223365780001, lat: 44.8884964000002 },
		{ lng: 20.92505455, lat: 44.8870544440001 },
		{ lng: 20.9272918700001, lat: 44.8861999520001 },
		{ lng: 20.9347133630001, lat: 44.8842010510002 },
		{ lng: 20.9365997310001, lat: 44.883487702 },
		{ lng: 20.9387722010001, lat: 44.8820381170001 },
		{ lng: 20.9397201550001, lat: 44.8809738170001 },
		{ lng: 20.940219878, lat: 44.8798446670001 },
		{ lng: 20.9400997150001, lat: 44.8785514840001 },
		{ lng: 20.9393157960002, lat: 44.8773117060001 },
		{ lng: 20.9379596700001, lat: 44.8762092590001 },
		{ lng: 20.9345054630002, lat: 44.8743057250001 },
		{ lng: 20.9192447660002, lat: 44.8677330020001 },
		{ lng: 20.9085445410001, lat: 44.863880158 },
		{ lng: 20.901493073, lat: 44.8619194040002 },
		{ lng: 20.889062881, lat: 44.8599853510001 },
		{ lng: 20.8802642810002, lat: 44.8569335930002 },
		{ lng: 20.8744812000002, lat: 44.8545379640001 },
		{ lng: 20.8573493950001, lat: 44.848190308 },
		{ lng: 20.8504676820001, lat: 44.846641541 },
		{ lng: 20.8466758720001, lat: 44.8450889580001 },
		{ lng: 20.8409481040001, lat: 44.843383788 },
		{ lng: 20.8280334460002, lat: 44.841102601 },
		{ lng: 20.8240547170001, lat: 44.8397216790001 },
		{ lng: 20.8199329370001, lat: 44.8377609250001 },
		{ lng: 20.8114585870001, lat: 44.8320426940001 },
		{ lng: 20.7990131390001, lat: 44.826072692 },
		{ lng: 20.7963008890002, lat: 44.8245162970001 },
		{ lng: 20.7937793740002, lat: 44.8227996840001 },
		{ lng: 20.7907867430001, lat: 44.8203201300001 },
		{ lng: 20.7827758780001, lat: 44.8126297000001 },
		{ lng: 20.7812538140001, lat: 44.8106384290001 },
		{ lng: 20.7804718020001, lat: 44.8087005610001 },
		{ lng: 20.7804698950002, lat: 44.8064155580001 },
		{ lng: 20.781370162, lat: 44.8048057560002 },
		{ lng: 20.782913207, lat: 44.8033523570001 },
		{ lng: 20.7866859440002, lat: 44.8012466440001 },
		{ lng: 20.7950897220001, lat: 44.7975845340001 },
		{ lng: 20.7967205040002, lat: 44.7965049740001 },
		{ lng: 20.7978839880001, lat: 44.795200348 },
		{ lng: 20.798572541, lat: 44.7937316890001 },
		{ lng: 20.7987709050001, lat: 44.791736603 },
		{ lng: 20.797988891, lat: 44.786624909 },
		{ lng: 20.7980709070001, lat: 44.7843933110001 },
		{ lng: 20.79856491, lat: 44.7821922310001 },
		{ lng: 20.8012332910001, lat: 44.7772178650001 },
		{ lng: 20.8050994870001, lat: 44.7729263310001 },
		{ lng: 20.8070964800002, lat: 44.7716941840002 },
		{ lng: 20.808868408, lat: 44.7712364200002 },
		{ lng: 20.8108367930001, lat: 44.7711181640001 },
		{ lng: 20.8179073340001, lat: 44.77167511 },
		{ lng: 20.8210697170002, lat: 44.77167511 },
		{ lng: 20.8241729730001, lat: 44.7714157110001 },
		{ lng: 20.8264808660002, lat: 44.7709693900001 },
		{ lng: 20.8285617830001, lat: 44.7703094490001 },
		{ lng: 20.8308887480002, lat: 44.7689933770001 },
		{ lng: 20.832166672, lat: 44.7672538760002 },
		{ lng: 20.832357406, lat: 44.7663917550001 },
		{ lng: 20.831878662, lat: 44.758949279 },
		{ lng: 20.8321876530001, lat: 44.7561149590002 },
		{ lng: 20.8330211650002, lat: 44.7533988960001 },
		{ lng: 20.835870743, lat: 44.7488365180001 },
		{ lng: 20.8367309560001, lat: 44.7466850290001 },
		{ lng: 20.8367309560001, lat: 44.7457809450001 },
		{ lng: 20.8360137950002, lat: 44.7439193720002 },
		{ lng: 20.8337440490001, lat: 44.7402076730001 },
		{ lng: 20.833545685, lat: 44.7383842480002 },
		{ lng: 20.8338871000001, lat: 44.737056733 },
		{ lng: 20.8355007160001, lat: 44.7337303170001 },
		{ lng: 20.838792801, lat: 44.7289390560001 },
		{ lng: 20.845621108, lat: 44.7204437250002 },
		{ lng: 20.8468933100002, lat: 44.718524933 },
		{ lng: 20.8478546150002, lat: 44.7158012400002 },
		{ lng: 20.8481597890002, lat: 44.7129631040002 },
		{ lng: 20.847921371, lat: 44.7101287840001 },
		{ lng: 20.847024918, lat: 44.707412719 },
		{ lng: 20.8457851410002, lat: 44.7055091850001 },
		{ lng: 20.8410530090002, lat: 44.6999549870001 },
		{ lng: 20.836341858, lat: 44.69536972 },
		{ lng: 20.8340492250001, lat: 44.6936035150002 },
		{ lng: 20.8307170870001, lat: 44.6915740970001 },
		{ lng: 20.8271980290001, lat: 44.688602448 },
		{ lng: 20.8216743460002, lat: 44.6814079280002 },
		{ lng: 20.8187866210001, lat: 44.6786727900002 },
		{ lng: 20.814340592, lat: 44.6750450130001 },
		{ lng: 20.8094863900002, lat: 44.669303894 },
		{ lng: 20.8075618740001, lat: 44.6679000850001 },
		{ lng: 20.80575943, lat: 44.6672401440001 },
		{ lng: 20.8036861430002, lat: 44.666824342 },
		{ lng: 20.794364929, lat: 44.6661491400001 },
		{ lng: 20.789459229, lat: 44.6654510500001 },
		{ lng: 20.7878627790001, lat: 44.6648063650001 },
		{ lng: 20.786460876, lat: 44.6634140020001 },
		{ lng: 20.7859363560001, lat: 44.661632539 },
		{ lng: 20.786960602, lat: 44.653839111 },
		{ lng: 20.7869567870001, lat: 44.6484031690001 },
		{ lng: 20.7865791310001, lat: 44.6456260690001 },
		{ lng: 20.7857456200002, lat: 44.6428642270001 },
		{ lng: 20.7843704230002, lat: 44.6402969370001 },
		{ lng: 20.7825908670002, lat: 44.6378211980002 },
		{ lng: 20.7781925210001, lat: 44.6328964230001 }
	];

	SmederevoDelimiters = [
		{ lng: 21.0263996120001, lat: 44.6910667430001 },
		{ lng: 21.0235347750001, lat: 44.6839599600001 },
		{ lng: 21.0226993560001, lat: 44.6808395390001 },
		{ lng: 21.0230007170001, lat: 44.6787643440001 },
		{ lng: 21.024269104, lat: 44.6766395570001 },
		{ lng: 21.0282306670002, lat: 44.6716079710001 },
		{ lng: 21.029354095, lat: 44.6695060730002 },
		{ lng: 21.029796601, lat: 44.667457582 },
		{ lng: 21.0296363830001, lat: 44.665420532 },
		{ lng: 21.028865814, lat: 44.6634483340001 },
		{ lng: 21.0275192260002, lat: 44.661708832 },
		{ lng: 21.0223255160001, lat: 44.657611848 },
		{ lng: 21.0210056310001, lat: 44.6558952330002 },
		{ lng: 21.0207023620001, lat: 44.654651642 },
		{ lng: 21.0209121700001, lat: 44.6533775320001 },
		{ lng: 21.022556304, lat: 44.6510810850001 },
		{ lng: 21.02519226, lat: 44.6489982600002 },
		{ lng: 21.0293483720002, lat: 44.6463012700002 },
		{ lng: 21.0311145780001, lat: 44.6442337040001 },
		{ lng: 21.0313491810001, lat: 44.6426620480001 },
		{ lng: 21.0294075020001, lat: 44.6380310060001 },
		{ lng: 21.0295085900001, lat: 44.6359214790001 },
		{ lng: 21.0302352910001, lat: 44.6340942390001 },
		{ lng: 21.0321788800001, lat: 44.6315193180001 },
		{ lng: 21.03729248, lat: 44.626335145 },
		{ lng: 21.0394077310002, lat: 44.6235771180002 },
		{ lng: 21.0403537750001, lat: 44.6214942930001 },
		{ lng: 21.0418643960001, lat: 44.6156692500001 },
		{ lng: 21.043729781, lat: 44.612018586 },
		{ lng: 21.046131134, lat: 44.6091117860001 },
		{ lng: 21.048461913, lat: 44.6069259650001 },
		{ lng: 21.0511798850001, lat: 44.604972839 },
		{ lng: 21.055215837, lat: 44.6031723020001 },
		{ lng: 21.0582199100002, lat: 44.602500916 },
		{ lng: 21.0619964600002, lat: 44.6023635870001 },
		{ lng: 21.0670757300002, lat: 44.602336883 },
		{ lng: 21.0697574610001, lat: 44.601364135 },
		{ lng: 21.0708427440001, lat: 44.600826264 },
		{ lng: 21.072633743, lat: 44.5996170050001 },
		{ lng: 21.0733261110001, lat: 44.5989837660002 },
		{ lng: 21.0735034940001, lat: 44.5986480720001 },
		{ lng: 21.0734844200002, lat: 44.5982742300001 },
		{ lng: 21.0730628960001, lat: 44.5974845880001 },
		{ lng: 21.0724086750001, lat: 44.5967102050001 },
		{ lng: 21.071985245, lat: 44.596363068 },
		{ lng: 21.0714626310001, lat: 44.596073152 },
		{ lng: 21.0708656300002, lat: 44.5958213800001 },
		{ lng: 21.0687828070001, lat: 44.595115662 },
		{ lng: 21.0624771120002, lat: 44.5908813480002 },
		{ lng: 21.0601482380002, lat: 44.588653564 },
		{ lng: 21.0586376200001, lat: 44.586292266 },
		{ lng: 21.058206559, lat: 44.5839729300002 },
		{ lng: 21.0586204540001, lat: 44.5825767520001 },
		{ lng: 21.0594615930002, lat: 44.5812454220001 },
		{ lng: 21.0613956440002, lat: 44.5792884830001 },
		{ lng: 21.0702323910001, lat: 44.5738563540002 },
		{ lng: 21.0723800660001, lat: 44.5722770690001 },
		{ lng: 21.0802898420001, lat: 44.5654449470001 },
		{ lng: 21.0851898190001, lat: 44.5623321530001 },
		{ lng: 21.088064194, lat: 44.561004639 },
		{ lng: 21.0928192140001, lat: 44.5596809390001 },
		{ lng: 21.0968456270002, lat: 44.5591354360002 },
		{ lng: 21.1091442110001, lat: 44.5580749510001 },
		{ lng: 21.1229972830001, lat: 44.5560798650001 },
		{ lng: 21.1251602170001, lat: 44.5556106560001 },
		{ lng: 21.1271152490002, lat: 44.5549392700001 },
		{ lng: 21.1295204160002, lat: 44.5534706110002 },
		{ lng: 21.1316967010002, lat: 44.5510520950001 },
		{ lng: 21.1325950630001, lat: 44.5483665470001 },
		{ lng: 21.1325473780001, lat: 44.545536041 },
		{ lng: 21.1316032410001, lat: 44.5428199770002 },
		{ lng: 21.127153398, lat: 44.536827088 },
		{ lng: 21.125417709, lat: 44.532535552 },
		{ lng: 21.1242961890002, lat: 44.530590058 },
		{ lng: 21.1227359780001, lat: 44.5288543700001 },
		{ lng: 21.116853715, lat: 44.5245323170001 },
		{ lng: 21.1149902350001, lat: 44.522533416 },
		{ lng: 21.1140651700002, lat: 44.5212020880001 },
		{ lng: 21.1129245760001, lat: 44.5178604120001 },
		{ lng: 21.1131858830001, lat: 44.5159187310001 },
		{ lng: 21.1141490930001, lat: 44.5142784120001 },
		{ lng: 21.1156959530002, lat: 44.5128021250002 },
		{ lng: 21.1174430850002, lat: 44.5116806030001 },
		{ lng: 21.1212615970001, lat: 44.5098419190001 },
		{ lng: 21.1282672880002, lat: 44.507358552 },
		{ lng: 21.1300392150002, lat: 44.5062980650001 },
		{ lng: 21.1306800830001, lat: 44.5052299500001 },
		{ lng: 21.1307029720001, lat: 44.5039978020001 },
		{ lng: 21.1296787260001, lat: 44.502048493 },
		{ lng: 21.1256446840001, lat: 44.4980354310002 },
		{ lng: 21.1246967320002, lat: 44.4967842100001 },
		{ lng: 21.124288559, lat: 44.495929719 },
		{ lng: 21.1245632170001, lat: 44.4948158270001 },
		{ lng: 21.1159286490001, lat: 44.4834785460002 },
		{ lng: 21.1074638370001, lat: 44.4746932990001 },
		{ lng: 21.1019096370001, lat: 44.4681091310001 },
		{ lng: 21.0949230200001, lat: 44.4612960810001 },
		{ lng: 21.093307494, lat: 44.4600028990002 },
		{ lng: 21.0894737250002, lat: 44.4578323370002 },
		{ lng: 21.0857334140001, lat: 44.4561462400002 },
		{ lng: 21.0809764860001, lat: 44.4545211790001 },
		{ lng: 21.0789794930002, lat: 44.4539566050001 },
		{ lng: 21.0740375510002, lat: 44.4531784060001 },
		{ lng: 21.0711174020001, lat: 44.453235626 },
		{ lng: 21.069076539, lat: 44.4535408030002 },
		{ lng: 21.0662117000001, lat: 44.4542198180001 },
		{ lng: 21.0583305350002, lat: 44.457157135 },
		{ lng: 21.0499229440001, lat: 44.4594917290001 },
		{ lng: 21.039491653, lat: 44.4636764530002 },
		{ lng: 21.0345153820001, lat: 44.4648818970001 },
		{ lng: 21.0311603550001, lat: 44.4651947020001 },
		{ lng: 21.0277175910002, lat: 44.4651718130001 },
		{ lng: 21.024269104, lat: 44.4648056030002 },
		{ lng: 21.0209350580002, lat: 44.4640083310001 },
		{ lng: 21.0176773080001, lat: 44.4626197810002 },
		{ lng: 21.014799118, lat: 44.4609146110001 },
		{ lng: 21.011615754, lat: 44.4585685740001 },
		{ lng: 21.0077037810001, lat: 44.4594917290001 },
		{ lng: 21.0069732660002, lat: 44.4597244260002 },
		{ lng: 21.0066738120001, lat: 44.4598846430001 },
		{ lng: 21.006446839, lat: 44.4600982680001 },
		{ lng: 21.0061244960001, lat: 44.4606170650002 },
		{ lng: 21.004842759, lat: 44.4633979800001 },
		{ lng: 21.0048294060001, lat: 44.46819687 },
		{ lng: 21.0081977840001, lat: 44.4729766840001 },
		{ lng: 21.010688783, lat: 44.4747047420001 },
		{ lng: 21.0110683430001, lat: 44.4750442510002 },
		{ lng: 21.011358262, lat: 44.4754028320001 },
		{ lng: 21.0115127560001, lat: 44.475772857 },
		{ lng: 21.0116195690001, lat: 44.476562499 },
		{ lng: 21.0115737920001, lat: 44.478153229 },
		{ lng: 21.0114765170002, lat: 44.478515626 },
		{ lng: 21.0112781530001, lat: 44.4788246150001 },
		{ lng: 21.0109024050001, lat: 44.4790687570001 },
		{ lng: 21.0098361980001, lat: 44.4794197080001 },
		{ lng: 21.0064868930002, lat: 44.4801826490001 },
		{ lng: 21.001422881, lat: 44.477809905 },
		{ lng: 20.998056411, lat: 44.4730262760001 },
		{ lng: 20.9946861280001, lat: 44.46824646 },
		{ lng: 20.9853610990002, lat: 44.4613647470001 },
		{ lng: 20.978319168, lat: 44.4551467910002 },
		{ lng: 20.969694137, lat: 44.4493980410001 },
		{ lng: 20.966337204, lat: 44.4460906990001 },
		{ lng: 20.9635105120001, lat: 44.44185257 },
		{ lng: 20.9622173310001, lat: 44.441043855 },
		{ lng: 20.9606494900002, lat: 44.4405479440001 },
		{ lng: 20.958250046, lat: 44.4404563900002 },
		{ lng: 20.9558486930001, lat: 44.4411773690001 },
		{ lng: 20.9387340540002, lat: 44.4480323800001 },
		{ lng: 20.934911727, lat: 44.4502754220001 },
		{ lng: 20.9274578100001, lat: 44.4556846610001 },
		{ lng: 20.9205589290002, lat: 44.459480286 },
		{ lng: 20.9193611140001, lat: 44.4604492190002 },
		{ lng: 20.918550491, lat: 44.4620285030001 },
		{ lng: 20.918577194, lat: 44.4638137820001 },
		{ lng: 20.9197692870002, lat: 44.466445923 },
		{ lng: 20.9225521080001, lat: 44.4701004040001 },
		{ lng: 20.9289112080001, lat: 44.4758682240001 },
		{ lng: 20.9315795910002, lat: 44.4772529610001 },
		{ lng: 20.9384956350001, lat: 44.4797897330001 },
		{ lng: 20.9402503970001, lat: 44.4806709290002 },
		{ lng: 20.9415893550001, lat: 44.4816780090002 },
		{ lng: 20.9424571980001, lat: 44.4831657410002 },
		{ lng: 20.9424552930001, lat: 44.4847106940002 },
		{ lng: 20.941579819, lat: 44.4860725400001 },
		{ lng: 20.9397792820001, lat: 44.4870796200001 },
		{ lng: 20.9347267160001, lat: 44.4887466430001 },
		{ lng: 20.9317455290001, lat: 44.48997116 },
		{ lng: 20.9252071370001, lat: 44.4935264590001 },
		{ lng: 20.9139118200002, lat: 44.4991607660001 },
		{ lng: 20.908876419, lat: 44.500999452 },
		{ lng: 20.9023971560001, lat: 44.502105714 },
		{ lng: 20.8901481620001, lat: 44.5031127930002 },
		{ lng: 20.8847808830001, lat: 44.5038604740001 },
		{ lng: 20.872348785, lat: 44.5062675490001 },
		{ lng: 20.869289399, lat: 44.5065956120001 },
		{ lng: 20.8524951930001, lat: 44.5063095100001 },
		{ lng: 20.8448085780001, lat: 44.5059623720001 },
		{ lng: 20.8411121370001, lat: 44.5055236810002 },
		{ lng: 20.8359622950001, lat: 44.5044326780001 },
		{ lng: 20.8249034870001, lat: 44.501049042 },
		{ lng: 20.8098735800001, lat: 44.497016908 },
		{ lng: 20.8041019450001, lat: 44.494972229 },
		{ lng: 20.7876739500001, lat: 44.4881134030001 },
		{ lng: 20.779064179, lat: 44.4920043950002 },
		{ lng: 20.7713432320001, lat: 44.4944114680001 },
		{ lng: 20.7660694130001, lat: 44.4954185480001 },
		{ lng: 20.7641391750001, lat: 44.4960098280002 },
		{ lng: 20.7621059420002, lat: 44.4974899300001 },
		{ lng: 20.759117127, lat: 44.5022201540001 },
		{ lng: 20.7586040500001, lat: 44.504276276 },
		{ lng: 20.758512496, lat: 44.5116806030001 },
		{ lng: 20.7579231260001, lat: 44.5134887700001 },
		{ lng: 20.756532668, lat: 44.515670777 },
		{ lng: 20.7502021790002, lat: 44.5225639350002 },
		{ lng: 20.737104415, lat: 44.5330352780002 },
		{ lng: 20.7411594380001, lat: 44.5356864920001 },
		{ lng: 20.7510566720001, lat: 44.5405426020001 },
		{ lng: 20.7529201510001, lat: 44.541698456 },
		{ lng: 20.759386062, lat: 44.5470199580001 },
		{ lng: 20.7619571680001, lat: 44.5487365720001 },
		{ lng: 20.764743805, lat: 44.5498962410002 },
		{ lng: 20.7756042470002, lat: 44.5529403680001 },
		{ lng: 20.7836284630001, lat: 44.556175232 },
		{ lng: 20.7860279080001, lat: 44.5568618770001 },
		{ lng: 20.7885284430001, lat: 44.5573806760002 },
		{ lng: 20.7982234950001, lat: 44.5586853030002 },
		{ lng: 20.8005657190001, lat: 44.5592575070001 },
		{ lng: 20.802667618, lat: 44.5600395210001 },
		{ lng: 20.804931641, lat: 44.5614509590002 },
		{ lng: 20.8063507080001, lat: 44.563190461 },
		{ lng: 20.8066539770001, lat: 44.5650520330001 },
		{ lng: 20.805709838, lat: 44.567817688 },
		{ lng: 20.8017025000001, lat: 44.5748176580001 },
		{ lng: 20.8003692620001, lat: 44.5768127440002 },
		{ lng: 20.7991600030001, lat: 44.5781059270001 },
		{ lng: 20.7977581030001, lat: 44.5792846680001 },
		{ lng: 20.7952156060002, lat: 44.5808601390001 },
		{ lng: 20.7883396140001, lat: 44.5832099920001 },
		{ lng: 20.7856254590001, lat: 44.5844764710002 },
		{ lng: 20.7832965850001, lat: 44.5859756460002 },
		{ lng: 20.7815322870002, lat: 44.5875930790002 },
		{ lng: 20.7806892400001, lat: 44.589241029 },
		{ lng: 20.7807579040002, lat: 44.5900077830001 },
		{ lng: 20.7819213880001, lat: 44.5916061400001 },
		{ lng: 20.7836971290001, lat: 44.5931701660002 },
		{ lng: 20.7851905810002, lat: 44.5948791510001 },
		{ lng: 20.7856903070002, lat: 44.5970420850002 },
		{ lng: 20.7852687850001, lat: 44.6000595090001 },
		{ lng: 20.7837772370001, lat: 44.6035881040001 },
		{ lng: 20.7814311980001, lat: 44.6066589360001 },
		{ lng: 20.7742195120001, lat: 44.6121521000001 },
		{ lng: 20.7724609370001, lat: 44.6141967780002 },
		{ lng: 20.7714653010001, lat: 44.6163558970002 },
		{ lng: 20.7709751130001, lat: 44.6186676030002 },
		{ lng: 20.7708415990001, lat: 44.621055603 },
		{ lng: 20.7714118960001, lat: 44.6251716610001 },
		{ lng: 20.772855758, lat: 44.6276855480002 },
		{ lng: 20.7749748230001, lat: 44.6300468440001 },
		{ lng: 20.7781925210001, lat: 44.6328964230001 },
		{ lng: 20.7920169830001, lat: 44.6312370300002 },
		{ lng: 20.8008975970002, lat: 44.630458833 },
		{ lng: 20.8094902050001, lat: 44.630256654 },
		{ lng: 20.8136062630001, lat: 44.630378724 },
		{ lng: 20.8380508430001, lat: 44.63306427 },
		{ lng: 20.845375061, lat: 44.6344985970001 },
		{ lng: 20.857507705, lat: 44.637569429 },
		{ lng: 20.8626766200001, lat: 44.638591767 },
		{ lng: 20.8663787830001, lat: 44.6389999390001 },
		{ lng: 20.8816986080001, lat: 44.6397895810001 },
		{ lng: 20.8853244780001, lat: 44.6403427120001 },
		{ lng: 20.8888416280001, lat: 44.641326905 },
		{ lng: 20.8939571380001, lat: 44.6435050970002 },
		{ lng: 20.9027881620001, lat: 44.647739411 },
		{ lng: 20.905590058, lat: 44.6492156990001 },
		{ lng: 20.9080677040002, lat: 44.6508941660002 },
		{ lng: 20.9107818610001, lat: 44.6537208560001 },
		{ lng: 20.9139709480001, lat: 44.6578979490001 },
		{ lng: 20.917346954, lat: 44.661708832 },
		{ lng: 20.9238567360001, lat: 44.6674995420001 },
		{ lng: 20.9282302860001, lat: 44.6702003480001 },
		{ lng: 20.9332542420001, lat: 44.6725997930001 },
		{ lng: 20.9379920960001, lat: 44.674354553 },
		{ lng: 20.9419860840001, lat: 44.6756553660001 },
		{ lng: 20.9523429860001, lat: 44.6782989500002 },
		{ lng: 20.954637527, lat: 44.6792640680001 },
		{ lng: 20.961494445, lat: 44.6850776680001 },
		{ lng: 20.9641304010001, lat: 44.6866531370001 },
		{ lng: 20.9703063960002, lat: 44.6894264220002 },
		{ lng: 20.9770431510001, lat: 44.6919479370002 },
		{ lng: 20.9860553740001, lat: 44.694820404 },
		{ lng: 20.9913120270001, lat: 44.6959152230002 },
		{ lng: 20.9951305390001, lat: 44.6963233950001 },
		{ lng: 21.0032539370002, lat: 44.696437835 },
		{ lng: 21.0116977700001, lat: 44.69574356 },
		{ lng: 21.0158481600001, lat: 44.6949157710001 },
		{ lng: 21.0193595890001, lat: 44.6938247680001 },
		{ lng: 21.0263996120001, lat: 44.6910667430001 }
	];

	ArandjelovacDelimiters = [
		{ lng: 20.389083862, lat: 44.2942886360001 },
		{ lng: 20.389503479, lat: 44.2955474850002 },
		{ lng: 20.3923988350001, lat: 44.2997818000001 },
		{ lng: 20.397470475, lat: 44.304489136 },
		{ lng: 20.3990325930001, lat: 44.306240083 },
		{ lng: 20.4001045240001, lat: 44.3080825820002 },
		{ lng: 20.400619508, lat: 44.3101844780002 },
		{ lng: 20.4006690980001, lat: 44.312713624 },
		{ lng: 20.4000873560001, lat: 44.3200912470002 },
		{ lng: 20.4000988010001, lat: 44.3237304700001 },
		{ lng: 20.4003353120002, lat: 44.3247413630002 },
		{ lng: 20.4015178680002, lat: 44.3268852230001 },
		{ lng: 20.404031753, lat: 44.3292808530001 },
		{ lng: 20.4088840480001, lat: 44.3330917360001 },
		{ lng: 20.4115543360001, lat: 44.335838318 },
		{ lng: 20.4182415010002, lat: 44.3437461860001 },
		{ lng: 20.4195804590001, lat: 44.3450393690001 },
		{ lng: 20.4231910710001, lat: 44.3478736890001 },
		{ lng: 20.431167602, lat: 44.3530998240001 },
		{ lng: 20.4325466160001, lat: 44.354553222 },
		{ lng: 20.4332408910001, lat: 44.35610962 },
		{ lng: 20.4332466120001, lat: 44.3569908140001 },
		{ lng: 20.4328079210001, lat: 44.3582229610002 },
		{ lng: 20.4312496180001, lat: 44.3602600100001 },
		{ lng: 20.4269466390001, lat: 44.363765716 },
		{ lng: 20.422065735, lat: 44.368183136 },
		{ lng: 20.4195003500001, lat: 44.3696060180001 },
		{ lng: 20.415555953, lat: 44.3711776740001 },
		{ lng: 20.4127159120001, lat: 44.3725852970002 },
		{ lng: 20.4054317480001, lat: 44.3781242370002 },
		{ lng: 20.399551391, lat: 44.3821792610001 },
		{ lng: 20.3984546660002, lat: 44.3834724420001 },
		{ lng: 20.3969936380001, lat: 44.3861732490002 },
		{ lng: 20.3965435020002, lat: 44.3884315490002 },
		{ lng: 20.3967018120001, lat: 44.3893508900001 },
		{ lng: 20.397314071, lat: 44.390605926 },
		{ lng: 20.3988780970001, lat: 44.3925323490002 },
		{ lng: 20.402978896, lat: 44.3968658450001 },
		{ lng: 20.4074211120001, lat: 44.4011154190002 },
		{ lng: 20.4095382680001, lat: 44.402545929 },
		{ lng: 20.4114170070002, lat: 44.4032630920001 },
		{ lng: 20.4135227200001, lat: 44.4037742610001 },
		{ lng: 20.4196033480001, lat: 44.404937745 },
		{ lng: 20.4219684610002, lat: 44.4056091320001 },
		{ lng: 20.4241905220001, lat: 44.4065093990001 },
		{ lng: 20.4270172120002, lat: 44.4082183840002 },
		{ lng: 20.4333248130001, lat: 44.4128532410001 },
		{ lng: 20.442209244, lat: 44.4188957220001 },
		{ lng: 20.4484100350002, lat: 44.4183158870001 },
		{ lng: 20.451278687, lat: 44.4178466800001 },
		{ lng: 20.4538879390001, lat: 44.4171524050001 },
		{ lng: 20.4562549600001, lat: 44.4161949160001 },
		{ lng: 20.4664707190001, lat: 44.409404755 },
		{ lng: 20.469263077, lat: 44.4077644350002 },
		{ lng: 20.477262497, lat: 44.4037322990001 },
		{ lng: 20.483818054, lat: 44.3989181510001 },
		{ lng: 20.4856681830001, lat: 44.398281098 },
		{ lng: 20.487705231, lat: 44.3979988100001 },
		{ lng: 20.4978504190001, lat: 44.3984642020001 },
		{ lng: 20.5011081690002, lat: 44.3983764650002 },
		{ lng: 20.5059375760002, lat: 44.3977966310002 },
		{ lng: 20.509355546, lat: 44.3968315130001 },
		{ lng: 20.521598817, lat: 44.3913650520001 },
		{ lng: 20.537912369, lat: 44.385650634 },
		{ lng: 20.5364532480002, lat: 44.382938385 },
		{ lng: 20.5329685220001, lat: 44.375068666 },
		{ lng: 20.5321254730001, lat: 44.3720169080001 },
		{ lng: 20.5316581730002, lat: 44.3659324650002 },
		{ lng: 20.5319271080001, lat: 44.363033294 },
		{ lng: 20.5326995850002, lat: 44.3603591920001 },
		{ lng: 20.5336189280001, lat: 44.3588104240001 },
		{ lng: 20.5349121090001, lat: 44.3575057980001 },
		{ lng: 20.5365905770001, lat: 44.3565254220002 },
		{ lng: 20.538520813, lat: 44.3558464050002 },
		{ lng: 20.5403594960001, lat: 44.3555030820002 },
		{ lng: 20.54306221, lat: 44.3555679320002 },
		{ lng: 20.5462265010001, lat: 44.3564071660002 },
		{ lng: 20.5527248380002, lat: 44.3587646490001 },
		{ lng: 20.5650234220001, lat: 44.3611183170001 },
		{ lng: 20.5730094910002, lat: 44.3639144910001 },
		{ lng: 20.5889034280001, lat: 44.3681335460001 },
		{ lng: 20.595523834, lat: 44.3705520640001 },
		{ lng: 20.6002540580001, lat: 44.37253952 },
		{ lng: 20.603601455, lat: 44.3734092710001 },
		{ lng: 20.6064987180002, lat: 44.373657227 },
		{ lng: 20.6093730920002, lat: 44.3734321590001 },
		{ lng: 20.6112995150002, lat: 44.3729896560001 },
		{ lng: 20.614944458, lat: 44.3716583260001 },
		{ lng: 20.616516112, lat: 44.370742798 },
		{ lng: 20.6180896760002, lat: 44.3690376280002 },
		{ lng: 20.6190929410001, lat: 44.3669624330001 },
		{ lng: 20.619710922, lat: 44.364276885 },
		{ lng: 20.6204662320002, lat: 44.3557548530001 },
		{ lng: 20.6221199050001, lat: 44.3477859500001 },
		{ lng: 20.621860505, lat: 44.3428115840001 },
		{ lng: 20.6221904760002, lat: 44.3412704470002 },
		{ lng: 20.6229362480001, lat: 44.3398056030001 },
		{ lng: 20.624700546, lat: 44.3380088820001 },
		{ lng: 20.6272163390001, lat: 44.336704255 },
		{ lng: 20.634105682, lat: 44.3347549440001 },
		{ lng: 20.6359539030001, lat: 44.333789826 },
		{ lng: 20.6409873960001, lat: 44.3299331660001 },
		{ lng: 20.6497974390001, lat: 44.3218345640001 },
		{ lng: 20.6485977180001, lat: 44.3206253050001 },
		{ lng: 20.6440258040001, lat: 44.3174171440002 },
		{ lng: 20.6424255360001, lat: 44.315616608 },
		{ lng: 20.6420421610001, lat: 44.3135604860001 },
		{ lng: 20.6423835750001, lat: 44.3121910100001 },
		{ lng: 20.643154145, lat: 44.31093216 },
		{ lng: 20.6450653070001, lat: 44.3093872080001 },
		{ lng: 20.64799881, lat: 44.30766678 },
		{ lng: 20.6494789120001, lat: 44.306144714 },
		{ lng: 20.6497287760002, lat: 44.304424286 },
		{ lng: 20.6490402210002, lat: 44.3025665280001 },
		{ lng: 20.6475524890002, lat: 44.3006553660001 },
		{ lng: 20.6416091930001, lat: 44.2948875430001 },
		{ lng: 20.6369991300002, lat: 44.28937912 },
		{ lng: 20.635469438, lat: 44.2872924800002 },
		{ lng: 20.634674073, lat: 44.2852592470001 },
		{ lng: 20.6343746190001, lat: 44.2831039440001 },
		{ lng: 20.6344738010002, lat: 44.2809028630001 },
		{ lng: 20.6349697120001, lat: 44.2787208560001 },
		{ lng: 20.638948441, lat: 44.2684707630002 },
		{ lng: 20.639255523, lat: 44.266345979 },
		{ lng: 20.6390914920001, lat: 44.2642364500002 },
		{ lng: 20.6380233770001, lat: 44.259349823 },
		{ lng: 20.6382694240001, lat: 44.2569961550002 },
		{ lng: 20.6391868590001, lat: 44.2553253170001 },
		{ lng: 20.6406154640001, lat: 44.253780365 },
		{ lng: 20.6449985500001, lat: 44.2501754760001 },
		{ lng: 20.6460075370001, lat: 44.248970032 },
		{ lng: 20.6467685700001, lat: 44.246978761 },
		{ lng: 20.646686554, lat: 44.2460975650001 },
		{ lng: 20.6460914610001, lat: 44.2448997510001 },
		{ lng: 20.644401551, lat: 44.2432708750002 },
		{ lng: 20.6420097340001, lat: 44.2419204720001 },
		{ lng: 20.6398639690001, lat: 44.2411727910001 },
		{ lng: 20.6375045780001, lat: 44.2406501770001 },
		{ lng: 20.6343212140001, lat: 44.240299226 },
		{ lng: 20.6310253150002, lat: 44.240226745 },
		{ lng: 20.6277065270002, lat: 44.2403869620001 },
		{ lng: 20.6219367990001, lat: 44.241355895 },
		{ lng: 20.6195297240001, lat: 44.2420845040002 },
		{ lng: 20.6114406590001, lat: 44.2452888490002 },
		{ lng: 20.606693267, lat: 44.2463073720002 },
		{ lng: 20.6036338810001, lat: 44.2464065550001 },
		{ lng: 20.5902385710002, lat: 44.2453002930001 },
		{ lng: 20.5882072450001, lat: 44.2450332650001 },
		{ lng: 20.5865573880001, lat: 44.2445259090001 },
		{ lng: 20.5851516720002, lat: 44.2431945810001 },
		{ lng: 20.5848846430002, lat: 44.2420120240002 },
		{ lng: 20.5851516720002, lat: 44.2407264710001 },
		{ lng: 20.5863647470001, lat: 44.238883972 },
		{ lng: 20.589168548, lat: 44.2362289430002 },
		{ lng: 20.6017780310002, lat: 44.2271881110001 },
		{ lng: 20.6048011780001, lat: 44.2246551520001 },
		{ lng: 20.6061706550001, lat: 44.222934722 },
		{ lng: 20.606386185, lat: 44.2221336370001 },
		{ lng: 20.6060657500001, lat: 44.2202758800001 },
		{ lng: 20.6048240670001, lat: 44.2175865170001 },
		{ lng: 20.6038894650001, lat: 44.216361999 },
		{ lng: 20.6026229860001, lat: 44.2151031500001 },
		{ lng: 20.6010837560002, lat: 44.2140502930001 },
		{ lng: 20.5992145540001, lat: 44.2133140560002 },
		{ lng: 20.5971126550001, lat: 44.2129096990002 },
		{ lng: 20.5942878730002, lat: 44.2128753660001 },
		{ lng: 20.5851573950002, lat: 44.2140884400001 },
		{ lng: 20.5821876530002, lat: 44.214069367 },
		{ lng: 20.577274323, lat: 44.2131958010001 },
		{ lng: 20.5714893350001, lat: 44.2108802800001 },
		{ lng: 20.5696544640001, lat: 44.2098388680001 },
		{ lng: 20.5647640220001, lat: 44.2057685850002 },
		{ lng: 20.5630397790002, lat: 44.2047233590002 },
		{ lng: 20.554531098, lat: 44.200962067 },
		{ lng: 20.5522747040001, lat: 44.199279786 },
		{ lng: 20.5441665650002, lat: 44.1899795530001 },
		{ lng: 20.5389156340001, lat: 44.1834373480002 },
		{ lng: 20.5362052910002, lat: 44.1811294560001 },
		{ lng: 20.5336456290001, lat: 44.179721832 },
		{ lng: 20.5316391000001, lat: 44.1791038510001 },
		{ lng: 20.5263347620001, lat: 44.1783828740001 },
		{ lng: 20.5144042970001, lat: 44.1777954090001 },
		{ lng: 20.511249542, lat: 44.1778030400001 },
		{ lng: 20.506004334, lat: 44.1783714290001 },
		{ lng: 20.4989891050002, lat: 44.1796913150001 },
		{ lng: 20.4922885890002, lat: 44.1801109330002 },
		{ lng: 20.4901618960002, lat: 44.1804428110001 },
		{ lng: 20.488109588, lat: 44.1810264580001 },
		{ lng: 20.4826908110001, lat: 44.1832313540002 },
		{ lng: 20.4806003580001, lat: 44.1836509710001 },
		{ lng: 20.4784126280001, lat: 44.1836662290002 },
		{ lng: 20.4757614140001, lat: 44.1830673210002 },
		{ lng: 20.4730625150002, lat: 44.1819763180001 },
		{ lng: 20.4619216930001, lat: 44.17604828 },
		{ lng: 20.4568252570001, lat: 44.1761665350001 },
		{ lng: 20.453105927, lat: 44.176673889 },
		{ lng: 20.4502220150002, lat: 44.1775894170001 },
		{ lng: 20.4479351050001, lat: 44.1791191110001 },
		{ lng: 20.4461727150002, lat: 44.1810455320002 },
		{ lng: 20.442619324, lat: 44.1859664920001 },
		{ lng: 20.4404182430001, lat: 44.1895408620001 },
		{ lng: 20.4387245180002, lat: 44.1932296750001 },
		{ lng: 20.435939788, lat: 44.200710298 },
		{ lng: 20.43422699, lat: 44.2073898310002 },
		{ lng: 20.4321994780001, lat: 44.213745117 },
		{ lng: 20.4325370790001, lat: 44.2160911560001 },
		{ lng: 20.4357547770001, lat: 44.2233657840002 },
		{ lng: 20.436185837, lat: 44.2248229980001 },
		{ lng: 20.4361934670001, lat: 44.2269363400002 },
		{ lng: 20.4356384290001, lat: 44.2285995480001 },
		{ lng: 20.4346084600002, lat: 44.2302093500001 },
		{ lng: 20.4270668020002, lat: 44.237251283 },
		{ lng: 20.423141479, lat: 44.2418174740001 },
		{ lng: 20.4240627290001, lat: 44.2480278030001 },
		{ lng: 20.4237747200001, lat: 44.252368926 },
		{ lng: 20.4231910710001, lat: 44.254405976 },
		{ lng: 20.4202594760001, lat: 44.2597618100002 },
		{ lng: 20.416181565, lat: 44.2662963860001 },
		{ lng: 20.4154396050001, lat: 44.2677993770002 },
		{ lng: 20.4148025500001, lat: 44.2700233460001 },
		{ lng: 20.4145183570001, lat: 44.2746429450001 },
		{ lng: 20.4147052760001, lat: 44.2769355770001 },
		{ lng: 20.4157257080001, lat: 44.2820701600001 },
		{ lng: 20.4153976430001, lat: 44.284076692 },
		{ lng: 20.4145946500001, lat: 44.2854270930001 },
		{ lng: 20.4134063720001, lat: 44.2867164610001 },
		{ lng: 20.4113845820001, lat: 44.2883453370002 },
		{ lng: 20.4089756020001, lat: 44.289855958 },
		{ lng: 20.406219483, lat: 44.291179657 },
		{ lng: 20.4024829850001, lat: 44.2923812860001 },
		{ lng: 20.4005146030001, lat: 44.2928085340001 },
		{ lng: 20.389083862, lat: 44.2942886360001 }
	];

	StaraPazovaDelimiters = [
		{ lng: 20.2776565560001, lat: 45.082328797 },
		{ lng: 20.2808151240002, lat: 45.0728378300001 },
		{ lng: 20.282173157, lat: 45.0700378420001 },
		{ lng: 20.284185409, lat: 45.067276002 },
		{ lng: 20.2881126410001, lat: 45.0638465890001 },
		{ lng: 20.2979869840001, lat: 45.058628082 },
		{ lng: 20.3053970330001, lat: 45.053771972 },
		{ lng: 20.3101463310001, lat: 45.0499992380002 },
		{ lng: 20.312101365, lat: 45.0479812630001 },
		{ lng: 20.3135623930002, lat: 45.0459709160001 },
		{ lng: 20.3153038030002, lat: 45.0430336010002 },
		{ lng: 20.3160552980001, lat: 45.04081726 },
		{ lng: 20.3173542010002, lat: 45.0338897700001 },
		{ lng: 20.3180713650002, lat: 45.0316619880001 },
		{ lng: 20.3222846990001, lat: 45.0235481260001 },
		{ lng: 20.3230628960001, lat: 45.0208549500002 },
		{ lng: 20.323495864, lat: 45.0152282710001 },
		{ lng: 20.3233413690001, lat: 45.0124359130002 },
		{ lng: 20.3221168520001, lat: 45.006790161 },
		{ lng: 20.3221549990002, lat: 45.0019149790001 },
		{ lng: 20.3216953270002, lat: 44.9999465950001 },
		{ lng: 20.3201713560001, lat: 44.9977455140001 },
		{ lng: 20.3179645550001, lat: 44.9956398010001 },
		{ lng: 20.3074016570002, lat: 44.98753357 },
		{ lng: 20.303850174, lat: 44.9851455690001 },
		{ lng: 20.3017616280001, lat: 44.984291076 },
		{ lng: 20.2994556430002, lat: 44.9836845400001 },
		{ lng: 20.2898731230001, lat: 44.9825210580001 },
		{ lng: 20.2867870340001, lat: 44.9819641120002 },
		{ lng: 20.282838821, lat: 44.9806251520001 },
		{ lng: 20.2790775300001, lat: 44.978656769 },
		{ lng: 20.2775669090001, lat: 44.9772148140001 },
		{ lng: 20.2766666420001, lat: 44.9755859380001 },
		{ lng: 20.276514053, lat: 44.9732398980001 },
		{ lng: 20.277238846, lat: 44.9685401930001 },
		{ lng: 20.2768630990001, lat: 44.9670982360001 },
		{ lng: 20.2759437560002, lat: 44.965774536 },
		{ lng: 20.274505616, lat: 44.9646301270001 },
		{ lng: 20.270986556, lat: 44.9627075200001 },
		{ lng: 20.2630939490001, lat: 44.9595375060002 },
		{ lng: 20.2603073130001, lat: 44.958145141 },
		{ lng: 20.258085251, lat: 44.9563941960002 },
		{ lng: 20.2557239530001, lat: 44.9535408030001 },
		{ lng: 20.2550334930002, lat: 44.951538086 },
		{ lng: 20.2549514770001, lat: 44.9494056710001 },
		{ lng: 20.2560195920001, lat: 44.9441223140001 },
		{ lng: 20.2576293950002, lat: 44.9405899060001 },
		{ lng: 20.2588920590002, lat: 44.9390182500001 },
		{ lng: 20.2658596030001, lat: 44.933296204 },
		{ lng: 20.2809104910002, lat: 44.9193077090002 },
		{ lng: 20.258527755, lat: 44.9155006400001 },
		{ lng: 20.2463016520002, lat: 44.9153442380001 },
		{ lng: 20.2431259150001, lat: 44.9151039120001 },
		{ lng: 20.2387580880001, lat: 44.9141960140001 },
		{ lng: 20.235950469, lat: 44.9129219070001 },
		{ lng: 20.2299308770001, lat: 44.9094886780002 },
		{ lng: 20.2233123770001, lat: 44.9063186650002 },
		{ lng: 20.2155761720001, lat: 44.901081085 },
		{ lng: 20.2027015690001, lat: 44.893821717 },
		{ lng: 20.2008056650002, lat: 44.8929176340001 },
		{ lng: 20.1980628960002, lat: 44.8921890250001 },
		{ lng: 20.195026397, lat: 44.89181137 },
		{ lng: 20.1871604930001, lat: 44.8916473400001 },
		{ lng: 20.1791477200001, lat: 44.892059327 },
		{ lng: 20.1710052490001, lat: 44.8930511480001 },
		{ lng: 20.1680088050001, lat: 44.8930511480001 },
		{ lng: 20.1657104500001, lat: 44.8927078250001 },
		{ lng: 20.1635456090002, lat: 44.8920784000001 },
		{ lng: 20.1612968440002, lat: 44.8910484320002 },
		{ lng: 20.156848908, lat: 44.8882064810001 },
		{ lng: 20.1550407400002, lat: 44.8863830560001 },
		{ lng: 20.1543483730002, lat: 44.8849792480001 },
		{ lng: 20.1540374760001, lat: 44.8834648140001 },
		{ lng: 20.1537342070001, lat: 44.8775329590002 },
		{ lng: 20.1532955160002, lat: 44.8752937310002 },
		{ lng: 20.1500873560001, lat: 44.8654403690001 },
		{ lng: 20.147031785, lat: 44.8601531990001 },
		{ lng: 20.1359615330001, lat: 44.8441772460001 },
		{ lng: 20.130773543, lat: 44.844146729 },
		{ lng: 20.1265869140001, lat: 44.84444046 },
		{ lng: 20.122455596, lat: 44.8451881400001 },
		{ lng: 20.1183414460002, lat: 44.8466873180002 },
		{ lng: 20.1147232060001, lat: 44.8486633310001 },
		{ lng: 20.1101112370001, lat: 44.8522071840002 },
		{ lng: 20.1074161530001, lat: 44.85554123 },
		{ lng: 20.105892182, lat: 44.858333589 },
		{ lng: 20.1049499510002, lat: 44.862945557 },
		{ lng: 20.104337692, lat: 44.8643531810002 },
		{ lng: 20.1033325200002, lat: 44.8656539920001 },
		{ lng: 20.1012973790001, lat: 44.8672294630001 },
		{ lng: 20.09811592, lat: 44.869167329 },
		{ lng: 20.0959491740002, lat: 44.870914459 },
		{ lng: 20.0882568360001, lat: 44.8789329540001 },
		{ lng: 20.084243775, lat: 44.884090423 },
		{ lng: 20.0810413350001, lat: 44.8893356320002 },
		{ lng: 20.0798435210001, lat: 44.8914833070002 },
		{ lng: 20.0777034760001, lat: 44.8969383250001 },
		{ lng: 20.0755290990002, lat: 44.8994789120001 },
		{ lng: 20.0726490020002, lat: 44.9016151420001 },
		{ lng: 20.0700283040001, lat: 44.9028396620002 },
		{ lng: 20.0680465690001, lat: 44.9032783500001 },
		{ lng: 20.065946578, lat: 44.9034156810001 },
		{ lng: 20.0630893710001, lat: 44.9031753550001 },
		{ lng: 20.05643654, lat: 44.901168823 },
		{ lng: 20.0492343900002, lat: 44.8979072580001 },
		{ lng: 20.047380448, lat: 44.8975830080001 },
		{ lng: 20.0454883570001, lat: 44.8976020810002 },
		{ lng: 20.0428295140001, lat: 44.8982505790001 },
		{ lng: 20.0409259800001, lat: 44.8992576590002 },
		{ lng: 20.039493561, lat: 44.9005355840001 },
		{ lng: 20.0387382500001, lat: 44.901981354 },
		{ lng: 20.0390701290002, lat: 44.9039268500001 },
		{ lng: 20.0414028180002, lat: 44.9076004030002 },
		{ lng: 20.041793824, lat: 44.9089927680002 },
		{ lng: 20.041465758, lat: 44.9118347160002 },
		{ lng: 20.0405654910001, lat: 44.9137878420001 },
		{ lng: 20.0395832050002, lat: 44.915111542 },
		{ lng: 20.0360565200001, lat: 44.9182281500001 },
		{ lng: 20.0332565310002, lat: 44.919788361 },
		{ lng: 20.023061753, lat: 44.9239196770001 },
		{ lng: 20.0075225830001, lat: 44.932518005 },
		{ lng: 20.0029125220001, lat: 44.9344215390001 },
		{ lng: 19.9930992120001, lat: 44.937938691 },
		{ lng: 19.9915313710002, lat: 44.9436187750002 },
		{ lng: 19.9907188430001, lat: 44.9486770620001 },
		{ lng: 19.9907131200001, lat: 44.953338623 },
		{ lng: 19.991060256, lat: 44.9555168150001 },
		{ lng: 19.9918003080001, lat: 44.9575538630001 },
		{ lng: 19.9959011080001, lat: 44.9632606510002 },
		{ lng: 19.9967288970001, lat: 44.9654464730002 },
		{ lng: 19.9983768470001, lat: 44.9722671500001 },
		{ lng: 20.0020084390002, lat: 44.9789123540001 },
		{ lng: 20.0027332310001, lat: 44.98047638 },
		{ lng: 20.0031795490001, lat: 44.9824523920001 },
		{ lng: 20.0031890870002, lat: 44.9845466610001 },
		{ lng: 20.002775193, lat: 44.9867019660002 },
		{ lng: 20.0018825530001, lat: 44.988956452 },
		{ lng: 19.9990501410002, lat: 44.9936408990001 },
		{ lng: 20.0142097480001, lat: 44.9940681470001 },
		{ lng: 20.0336208330001, lat: 44.9942741390001 },
		{ lng: 20.040672301, lat: 44.9948730470001 },
		{ lng: 20.045064927, lat: 44.9956398010001 },
		{ lng: 20.0486812590001, lat: 44.9960250860001 },
		{ lng: 20.0676841740001, lat: 44.9963188170001 },
		{ lng: 20.07138443, lat: 44.9965171810001 },
		{ lng: 20.0748786920001, lat: 44.997005462 },
		{ lng: 20.0771217340001, lat: 44.9976234430001 },
		{ lng: 20.079109192, lat: 44.9985122680002 },
		{ lng: 20.08226776, lat: 45.0010452260001 },
		{ lng: 20.0846576700001, lat: 45.0037040710001 },
		{ lng: 20.0940189360001, lat: 45.016921998 },
		{ lng: 20.096647262, lat: 45.0194282530002 },
		{ lng: 20.0982036590001, lat: 45.020416259 },
		{ lng: 20.0999774930001, lat: 45.0209922790001 },
		{ lng: 20.101877212, lat: 45.0211029060001 },
		{ lng: 20.1045188900001, lat: 45.0204048160001 },
		{ lng: 20.111831665, lat: 45.0155410780001 },
		{ lng: 20.1139373770002, lat: 45.0146331780002 },
		{ lng: 20.116250992, lat: 45.013961792 },
		{ lng: 20.120088577, lat: 45.0133514400002 },
		{ lng: 20.1241188040001, lat: 45.0130538940001 },
		{ lng: 20.203180313, lat: 45.012355804 },
		{ lng: 20.2111587520002, lat: 45.0127220160001 },
		{ lng: 20.2133865370002, lat: 45.0130920410001 },
		{ lng: 20.215391158, lat: 45.0137023920001 },
		{ lng: 20.2178630840002, lat: 45.0151557920001 },
		{ lng: 20.2202243800001, lat: 45.0176086420001 },
		{ lng: 20.2212600710001, lat: 45.019657136 },
		{ lng: 20.2232570640001, lat: 45.0255813610001 },
		{ lng: 20.2240772250001, lat: 45.0293579100001 },
		{ lng: 20.2239894860001, lat: 45.0316276540001 },
		{ lng: 20.2234897600001, lat: 45.0338668820002 },
		{ lng: 20.2222328190001, lat: 45.0369453430002 },
		{ lng: 20.2190399170001, lat: 45.0466384900001 },
		{ lng: 20.218891145, lat: 45.0487632750001 },
		{ lng: 20.2194328300002, lat: 45.0508308410002 },
		{ lng: 20.2209358210001, lat: 45.053012849 },
		{ lng: 20.2337551110001, lat: 45.0648078920001 },
		{ lng: 20.2380390170002, lat: 45.0680503860002 },
		{ lng: 20.2434616090001, lat: 45.0712814330001 },
		{ lng: 20.252050399, lat: 45.0749206550001 },
		{ lng: 20.264951706, lat: 45.0793113710001 },
		{ lng: 20.2694835660001, lat: 45.0806655890001 },
		{ lng: 20.2776565560001, lat: 45.082328797 }
	];

	IndjijaDelimiters = [
		{ lng: 20.0163364410001, lat: 45.1952018740001 },
		{ lng: 20.016529082, lat: 45.194274903 },
		{ lng: 20.0175457000001, lat: 45.1925544750001 },
		{ lng: 20.0191097260002, lat: 45.1906890880001 },
		{ lng: 20.0228004460002, lat: 45.1872978210001 },
		{ lng: 20.0238971700002, lat: 45.1858329780001 },
		{ lng: 20.0248146060001, lat: 45.1835784920001 },
		{ lng: 20.02512741, lat: 45.181224824 },
		{ lng: 20.0249423990001, lat: 45.1788787840001 },
		{ lng: 20.0242214200002, lat: 45.176628114 },
		{ lng: 20.0233402260001, lat: 45.1751289360001 },
		{ lng: 20.0214805590002, lat: 45.172676086 },
		{ lng: 20.0166149140002, lat: 45.1671943670001 },
		{ lng: 20.0153446190001, lat: 45.165470123 },
		{ lng: 20.0147705070001, lat: 45.1637725840002 },
		{ lng: 20.0152168280001, lat: 45.1621742240001 },
		{ lng: 20.0164585110001, lat: 45.160678864 },
		{ lng: 20.0187606820001, lat: 45.1590843190002 },
		{ lng: 20.0213165290001, lat: 45.1578407290001 },
		{ lng: 20.0240802760001, lat: 45.1570892330001 },
		{ lng: 20.0273914340001, lat: 45.1571578990001 },
		{ lng: 20.0357322700001, lat: 45.1585769650001 },
		{ lng: 20.0397415150001, lat: 45.1586685170002 },
		{ lng: 20.0425987240002, lat: 45.1583251960001 },
		{ lng: 20.0453224190002, lat: 45.157657623 },
		{ lng: 20.0507564540001, lat: 45.1553573620001 },
		{ lng: 20.053398132, lat: 45.1548461910002 },
		{ lng: 20.0561008460002, lat: 45.1548385630001 },
		{ lng: 20.0585823050001, lat: 45.155368805 },
		{ lng: 20.0650577540002, lat: 45.159095765 },
		{ lng: 20.0734958640001, lat: 45.1629905700001 },
		{ lng: 20.0761585240001, lat: 45.1647987370001 },
		{ lng: 20.0781955720001, lat: 45.1670951850001 },
		{ lng: 20.079517364, lat: 45.1697883610001 },
		{ lng: 20.080104829, lat: 45.1741104130002 },
		{ lng: 20.0798015600001, lat: 45.1780548100001 },
		{ lng: 20.0986671440002, lat: 45.1782188410001 },
		{ lng: 20.106525422, lat: 45.1778182990001 },
		{ lng: 20.1101417540001, lat: 45.1772804270001 },
		{ lng: 20.1189403540001, lat: 45.174865724 },
		{ lng: 20.1263599390001, lat: 45.1720466620002 },
		{ lng: 20.1305751790001, lat: 45.1706657420002 },
		{ lng: 20.1370162960001, lat: 45.168956757 },
		{ lng: 20.140165328, lat: 45.1684837350002 },
		{ lng: 20.1467628470001, lat: 45.1681594850002 },
		{ lng: 20.1534214020001, lat: 45.1683273320001 },
		{ lng: 20.167503357, lat: 45.1698493960001 },
		{ lng: 20.172761918, lat: 45.1698989860001 },
		{ lng: 20.1774559030002, lat: 45.169162751 },
		{ lng: 20.1854972850001, lat: 45.1671066280002 },
		{ lng: 20.1881351460001, lat: 45.166038513 },
		{ lng: 20.1976032250001, lat: 45.161388397 },
		{ lng: 20.2030677810001, lat: 45.1580657960002 },
		{ lng: 20.234836579, lat: 45.1353721630002 },
		{ lng: 20.2480545040001, lat: 45.1254119870001 },
		{ lng: 20.2516117100001, lat: 45.1236228950001 },
		{ lng: 20.2552013390002, lat: 45.1222877500002 },
		{ lng: 20.2634887700001, lat: 45.119865417 },
		{ lng: 20.2646903990001, lat: 45.1141510010001 },
		{ lng: 20.265441894, lat: 45.1121826170001 },
		{ lng: 20.2688446050001, lat: 45.106941223 },
		{ lng: 20.2724990840001, lat: 45.1020507820002 },
		{ lng: 20.2768783570002, lat: 45.097763061 },
		{ lng: 20.2777442930002, lat: 45.0966148370001 },
		{ lng: 20.27831459, lat: 45.0952186590002 },
		{ lng: 20.2786521900001, lat: 45.090526582 },
		{ lng: 20.2776565560001, lat: 45.082328797 },
		{ lng: 20.2694835660001, lat: 45.0806655890001 },
		{ lng: 20.264951706, lat: 45.0793113710001 },
		{ lng: 20.252050399, lat: 45.0749206550001 },
		{ lng: 20.2434616090001, lat: 45.0712814330001 },
		{ lng: 20.2380390170002, lat: 45.0680503860002 },
		{ lng: 20.2337551110001, lat: 45.0648078920001 },
		{ lng: 20.2209358210001, lat: 45.053012849 },
		{ lng: 20.2194328300002, lat: 45.0508308410002 },
		{ lng: 20.218891145, lat: 45.0487632750001 },
		{ lng: 20.2190399170001, lat: 45.0466384900001 },
		{ lng: 20.2222328190001, lat: 45.0369453430002 },
		{ lng: 20.2234897600001, lat: 45.0338668820002 },
		{ lng: 20.2239894860001, lat: 45.0316276540001 },
		{ lng: 20.2240772250001, lat: 45.0293579100001 },
		{ lng: 20.2232570640001, lat: 45.0255813610001 },
		{ lng: 20.2212600710001, lat: 45.019657136 },
		{ lng: 20.2202243800001, lat: 45.0176086420001 },
		{ lng: 20.2178630840002, lat: 45.0151557920001 },
		{ lng: 20.215391158, lat: 45.0137023920001 },
		{ lng: 20.2133865370002, lat: 45.0130920410001 },
		{ lng: 20.2111587520002, lat: 45.0127220160001 },
		{ lng: 20.203180313, lat: 45.012355804 },
		{ lng: 20.1241188040001, lat: 45.0130538940001 },
		{ lng: 20.120088577, lat: 45.0133514400002 },
		{ lng: 20.116250992, lat: 45.013961792 },
		{ lng: 20.1139373770002, lat: 45.0146331780002 },
		{ lng: 20.111831665, lat: 45.0155410780001 },
		{ lng: 20.1045188900001, lat: 45.0204048160001 },
		{ lng: 20.101877212, lat: 45.0211029060001 },
		{ lng: 20.0999774930001, lat: 45.0209922790001 },
		{ lng: 20.0982036590001, lat: 45.020416259 },
		{ lng: 20.096647262, lat: 45.0194282530002 },
		{ lng: 20.0940189360001, lat: 45.016921998 },
		{ lng: 20.0846576700001, lat: 45.0037040710001 },
		{ lng: 20.08226776, lat: 45.0010452260001 },
		{ lng: 20.079109192, lat: 44.9985122680002 },
		{ lng: 20.0771217340001, lat: 44.9976234430001 },
		{ lng: 20.0748786920001, lat: 44.997005462 },
		{ lng: 20.07138443, lat: 44.9965171810001 },
		{ lng: 20.0676841740001, lat: 44.9963188170001 },
		{ lng: 20.0486812590001, lat: 44.9960250860001 },
		{ lng: 20.045064927, lat: 44.9956398010001 },
		{ lng: 20.040672301, lat: 44.9948730470001 },
		{ lng: 20.0336208330001, lat: 44.9942741390001 },
		{ lng: 20.0142097480001, lat: 44.9940681470001 },
		{ lng: 19.9990501410002, lat: 44.9936408990001 },
		{ lng: 19.9972915660001, lat: 44.9953002940002 },
		{ lng: 19.9951305390001, lat: 44.998252868 },
		{ lng: 19.9936294560001, lat: 45.0033836360002 },
		{ lng: 19.9892120370001, lat: 45.0069046030001 },
		{ lng: 19.9873676310001, lat: 45.0091857900001 },
		{ lng: 19.9855461130002, lat: 45.013519288 },
		{ lng: 19.9838867180001, lat: 45.0165100110001 },
		{ lng: 19.9834117880001, lat: 45.0182113650002 },
		{ lng: 19.983409883, lat: 45.0218467710001 },
		{ lng: 19.9859256750001, lat: 45.0341415400001 },
		{ lng: 19.9874649050001, lat: 45.033851623 },
		{ lng: 19.9893302930001, lat: 45.0341911320002 },
		{ lng: 19.9904727940001, lat: 45.035686492 },
		{ lng: 19.989997864, lat: 45.037723542 },
		{ lng: 19.9884624470001, lat: 45.0393371580001 },
		{ lng: 19.9858417520001, lat: 45.0414848330001 },
		{ lng: 19.9843692780001, lat: 45.043312072 },
		{ lng: 19.9832439420001, lat: 45.045372009 },
		{ lng: 19.981658936, lat: 45.0499572760001 },
		{ lng: 19.981477737, lat: 45.051406861 },
		{ lng: 19.9817485800001, lat: 45.0534248360001 },
		{ lng: 19.9841651910002, lat: 45.0581817630002 },
		{ lng: 19.9846172340002, lat: 45.0601119990001 },
		{ lng: 19.98446083, lat: 45.0620384220001 },
		{ lng: 19.9836273200002, lat: 45.063869477 },
		{ lng: 19.982093811, lat: 45.065364838 },
		{ lng: 19.9805107120002, lat: 45.0661544800001 },
		{ lng: 19.972007751, lat: 45.0687713620001 },
		{ lng: 19.9681186690001, lat: 45.071338655 },
		{ lng: 19.96692276, lat: 45.0725402840001 },
		{ lng: 19.9653873430001, lat: 45.0747680660002 },
		{ lng: 19.9628982540001, lat: 45.0807151790001 },
		{ lng: 19.9588203430001, lat: 45.086071015 },
		{ lng: 19.9582653050002, lat: 45.0874938970002 },
		{ lng: 19.958211899, lat: 45.088947295 },
		{ lng: 19.9589691150002, lat: 45.0908737180001 },
		{ lng: 19.9616355900001, lat: 45.0947151180002 },
		{ lng: 19.9626102450001, lat: 45.096694946 },
		{ lng: 19.9627895360002, lat: 45.0986213690002 },
		{ lng: 19.962459564, lat: 45.0999755870001 },
		{ lng: 19.9612846380002, lat: 45.1022453310002 },
		{ lng: 19.957195282, lat: 45.1082305910002 },
		{ lng: 19.9554080960001, lat: 45.110244751 },
		{ lng: 19.9508705130001, lat: 45.1143302920001 },
		{ lng: 19.9440612790002, lat: 45.119483948 },
		{ lng: 19.9379100810002, lat: 45.1251029970002 },
		{ lng: 19.9293899540002, lat: 45.1305885310002 },
		{ lng: 19.9228496550002, lat: 45.1355018620002 },
		{ lng: 19.912622451, lat: 45.1425781260002 },
		{ lng: 19.9297046660001, lat: 45.1445808420002 },
		{ lng: 19.936311721, lat: 45.1455993650001 },
		{ lng: 19.9409141540001, lat: 45.1465263360002 },
		{ lng: 19.9541721350001, lat: 45.1480712880001 },
		{ lng: 19.9576873780001, lat: 45.148906707 },
		{ lng: 19.961048127, lat: 45.1500129690001 },
		{ lng: 19.9642181390001, lat: 45.1513366710002 },
		{ lng: 19.9734458930002, lat: 45.1557655340001 },
		{ lng: 19.9780273430002, lat: 45.1582069400001 },
		{ lng: 19.9802513120001, lat: 45.1597480780001 },
		{ lng: 19.981153487, lat: 45.1607971190001 },
		{ lng: 19.9814872750001, lat: 45.1618957510001 },
		{ lng: 19.98089981, lat: 45.1634063720001 },
		{ lng: 19.9794788360001, lat: 45.1649169930001 },
		{ lng: 19.9751739500001, lat: 45.168079376 },
		{ lng: 19.9731616980002, lat: 45.1698150640001 },
		{ lng: 19.972366333, lat: 45.171150207 },
		{ lng: 19.9722480770002, lat: 45.1725006100001 },
		{ lng: 19.9727954860001, lat: 45.1736488340001 },
		{ lng: 19.9738464350001, lat: 45.1747131340002 },
		{ lng: 19.9754562380002, lat: 45.1757965100001 },
		{ lng: 19.9822425830001, lat: 45.1793746950001 },
		{ lng: 19.994758607, lat: 45.184272767 },
		{ lng: 20.0163364410001, lat: 45.1952018740001 }
	];

	SremskiKarlovciDelemiters = [
		{ lng: 19.8680763240001, lat: 45.1464271540002 },
		{ lng: 19.8834648140001, lat: 45.1594276430001 },
		{ lng: 19.8857078550001, lat: 45.161582946 },
		{ lng: 19.8869266520002, lat: 45.1632308960001 },
		{ lng: 19.8887805940001, lat: 45.1678543100001 },
		{ lng: 19.890878677, lat: 45.1765289320002 },
		{ lng: 19.8926982870001, lat: 45.179782867 },
		{ lng: 19.8959941870002, lat: 45.1838455200001 },
		{ lng: 19.8967761980001, lat: 45.1853599550001 },
		{ lng: 19.8971920000001, lat: 45.1869316090001 },
		{ lng: 19.8971233370002, lat: 45.1889457710002 },
		{ lng: 19.896606445, lat: 45.190498351 },
		{ lng: 19.895732879, lat: 45.1919708250002 },
		{ lng: 19.8923587790001, lat: 45.1956863400002 },
		{ lng: 19.8913536070001, lat: 45.197174072 },
		{ lng: 19.8909244540002, lat: 45.198650361 },
		{ lng: 19.8914680470001, lat: 45.200511933 },
		{ lng: 19.8958873740001, lat: 45.2048225400001 },
		{ lng: 19.8984012600001, lat: 45.2098617560001 },
		{ lng: 19.9009056090001, lat: 45.2124519350002 },
		{ lng: 19.9159889210001, lat: 45.222999572 },
		{ lng: 19.9210643760001, lat: 45.2266159060001 },
		{ lng: 19.9232940680001, lat: 45.2250595090001 },
		{ lng: 19.9243812570001, lat: 45.2241363530001 },
		{ lng: 19.9249095920002, lat: 45.2233543410002 },
		{ lng: 19.9253292090002, lat: 45.2225379950002 },
		{ lng: 19.9257144920001, lat: 45.2217178340001 },
		{ lng: 19.9259700780001, lat: 45.2209167490001 },
		{ lng: 19.925945282, lat: 45.2205390940001 },
		{ lng: 19.925762176, lat: 45.2202224740001 },
		{ lng: 19.9254646300001, lat: 45.2199211120001 },
		{ lng: 19.9246921540001, lat: 45.2193298350001 },
		{ lng: 19.922868728, lat: 45.2180938720001 },
		{ lng: 19.9231014240001, lat: 45.2174758910002 },
		{ lng: 19.9242153170002, lat: 45.2163505550001 },
		{ lng: 19.9268856040001, lat: 45.2146186840001 },
		{ lng: 19.9302730550001, lat: 45.2130393980001 },
		{ lng: 19.9354763040001, lat: 45.2111892710001 },
		{ lng: 19.9417057040001, lat: 45.2093734730001 },
		{ lng: 19.945358277, lat: 45.2087554940001 },
		{ lng: 19.9562301640001, lat: 45.2076759340001 },
		{ lng: 19.9595088950001, lat: 45.2070426940001 },
		{ lng: 19.9682941440001, lat: 45.204277039 },
		{ lng: 19.9716510770002, lat: 45.2036705010001 },
		{ lng: 19.975261688, lat: 45.2033538810002 },
		{ lng: 19.990694046, lat: 45.2028198240001 },
		{ lng: 19.9946098330001, lat: 45.2024726870001 },
		{ lng: 19.9984531400001, lat: 45.2017936710001 },
		{ lng: 20.0035991660001, lat: 45.200126648 },
		{ lng: 20.0163364410001, lat: 45.1952018740001 },
		{ lng: 19.994758607, lat: 45.184272767 },
		{ lng: 19.9822425830001, lat: 45.1793746950001 },
		{ lng: 19.9754562380002, lat: 45.1757965100001 },
		{ lng: 19.9738464350001, lat: 45.1747131340002 },
		{ lng: 19.9727954860001, lat: 45.1736488340001 },
		{ lng: 19.9722480770002, lat: 45.1725006100001 },
		{ lng: 19.972366333, lat: 45.171150207 },
		{ lng: 19.9731616980002, lat: 45.1698150640001 },
		{ lng: 19.9751739500001, lat: 45.168079376 },
		{ lng: 19.9794788360001, lat: 45.1649169930001 },
		{ lng: 19.98089981, lat: 45.1634063720001 },
		{ lng: 19.9814872750001, lat: 45.1618957510001 },
		{ lng: 19.981153487, lat: 45.1607971190001 },
		{ lng: 19.9802513120001, lat: 45.1597480780001 },
		{ lng: 19.9780273430002, lat: 45.1582069400001 },
		{ lng: 19.9734458930002, lat: 45.1557655340001 },
		{ lng: 19.9642181390001, lat: 45.1513366710002 },
		{ lng: 19.961048127, lat: 45.1500129690001 },
		{ lng: 19.9576873780001, lat: 45.148906707 },
		{ lng: 19.9541721350001, lat: 45.1480712880001 },
		{ lng: 19.9409141540001, lat: 45.1465263360002 },
		{ lng: 19.936311721, lat: 45.1455993650001 },
		{ lng: 19.9297046660001, lat: 45.1445808420002 },
		{ lng: 19.912622451, lat: 45.1425781260002 },
		{ lng: 19.9057502740001, lat: 45.143028259 },
		{ lng: 19.9039955140001, lat: 45.1433639530001 },
		{ lng: 19.8996982580001, lat: 45.14484787 },
		{ lng: 19.89803505, lat: 45.1451492310002 },
		{ lng: 19.883802413, lat: 45.145606995 },
		{ lng: 19.8680763240001, lat: 45.1464271540002 }
	];

	for (const item of BelgradeDelimiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of NoviSadDelimitiers) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of PancevoDelimiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of SmederevoDelimiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of ArandjelovacDelimiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of StaraPazovaDelimiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of IndjijaDelimiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	for (const item of SremskiKarlovciDelemiters) {
		item.lng = item.lng + 0.025;
		item.lat = item.lat + 0.0255;
	}

	// Construct the polygon.
	var BelgradePolygon = new google.maps.Polygon({
		paths: BelgradeDelimiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var NoviSadPolygon = new google.maps.Polygon({
		paths: NoviSadDelimitiers,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var PancevoPolygon = new google.maps.Polygon({
		paths: PancevoDelimiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var SmederevoPolygon = new google.maps.Polygon({
		paths: SmederevoDelimiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var ArandjelovacPolygon = new google.maps.Polygon({
		paths: ArandjelovacDelimiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var StaraPazovaPolygon = new google.maps.Polygon({
		paths: StaraPazovaDelimiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var IndjijaPolygon = new google.maps.Polygon({
		paths: IndjijaDelimiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

	var SremskiKarlovciPolygon = new google.maps.Polygon({
		paths: SremskiKarlovciDelemiters,
		strokeColor: '#FF0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#FF0000',
		fillOpacity: 0.20
	});

// Draw the polygon on the desired map instance
	BelgradePolygon.setMap(map);
	NoviSadPolygon.setMap(map);
	PancevoPolygon.setMap(map);
	SmederevoPolygon.setMap(map);
	ArandjelovacPolygon.setMap(map);
	StaraPazovaPolygon.setMap(map);
	IndjijaPolygon.setMap(map);
	SremskiKarlovciPolygon.setMap(map);
}

window.initMap = initMap;




const brojRegex = /^TE\d{6}BG$/;

$(document).on('keyup', '#broj_posiljke', function(e) {
	if (e.key === 'Enter' || e.keyCode === 13) {
		$('#posiljka-telo').html(`
		<div class="text-center">
			<div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>`);

		const broj_posiljke_element = $('#broj_posiljke');

		broj_posiljke_element.removeClass('is-invalid');

		if (!brojRegex.test(broj_posiljke_element.val())) {
			broj_posiljke_element.addClass('is-invalid');
			return false;
		}

		$.ajax({
			url: '{{ route('pretraga-posiljke') }}' + '/' + broj_posiljke_element.val(),
			method: 'get',
			success: function(data) {
				renderData(data);
			}
		})
		
		$('#posiljka-status-modal').modal('show');
    }
});

$(document).on('click', '#pretraga', function(e) {
	$('#posiljka-telo').html(`
	<div class="text-center">
		<div class="spinner-border" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>`);

	const broj_posiljke_element = $('#broj_posiljke');

	broj_posiljke_element.removeClass('is-invalid');

	if (!brojRegex.test(broj_posiljke_element.val())) {
		broj_posiljke_element.addClass('is-invalid');
		return false;
	}

	$.ajax({
		url: '{{ route('pretraga-posiljke') }}' + '/' + broj_posiljke_element.val(),
		method: 'get',
		success: function(data) {
			renderData(data);
		}
	})
	
	$('#posiljka-status-modal').modal('show');
});

function renderData(data) {
	let html = `
	<table class="table table-bordered table-sm table-responsive w-100">
		<thead>
			<tr class="table-active">
				<th scope="col">Broj</th>
				<th scope="col">Datum</th>
				<th scope="col">Pošiljalac</th>
				<th scope="col">Primalac</th>
				<th scope="col">Status</th>
				<th scope="col">Napomena</th>
			</tr>
		</thead>
		<tbody>`;

	if (data.posiljka) {
	html += 
		`<tr>
			<td>${data.posiljka.broj_posiljke}</td>
			<td>${dateParse(data.posiljka.created_at)}</td>
			<td>${korisnikRender(data.posiljka.posiljalac)}</td>
			<td>${korisnikRender(data.posiljka.primalac)}</td>
			<td>Primljena</td>
			<td></td>
		</tr>`;
	}
	
	data.stavke.forEach(element => {
		let status = '';
		let row_color = '';

		switch(parseInt(element.status)) {
			case 0: status = 'Primljena'; break;
			case 1: status = 'Na dostavi'; break;
			case 2: status = 'Uručena'; row_color = 'table-success'; break;
			case 3: status = 'Vraćena'; row_color = 'table-danger'; break;
			case 4: status = 'Za narednu dostavu'; row_color = 'table-info'; break;
		}

		html += 
		`<tr ${row_color != '' ? 'class="' + row_color + '"' : '' }>
			<td>${element.posiljka.broj_posiljke}</td>
			<td>${dateParse(element.updated_at)}</td>
			<td>${korisnikRender(element.posiljka.posiljalac)}</td>
			<td>${korisnikRender(element.posiljka.primalac)}</td>
			<td>${status}</td>
			<td></td>
		</tr>`;
	});
			
	html += `</tbody></table>`;

	if (data.length == 0 || data.posiljka == null) {
		html = `<span class="text-center text-danger">Tražena pošiljka ne postoji!</span>`;
	}

	$('#posiljka-telo').html(html);
}

function dateParse(date)
{
	let datum = new Date(date);

	return datum.getDate() + '.' + (datum.getMonth() + 1) + '.' + datum.getFullYear() + '.';
}

function korisnikRender(element)
{
	return `${element.naziv}`;
}
</script>
@endsection