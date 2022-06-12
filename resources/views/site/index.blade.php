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
<script>
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
	<table class="table table-bordered table-sm">
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

	return datum.getDate() + '.' + (datum.getMonth() + 1) + '.' + datum.getFullYear() + '.' + ' ' + datum.getHours() + ':' + datum.getMinutes() + ':' + datum.getSeconds();
}

function korisnikRender(element)
{
	return `${element.naziv}`;
}
</script>
@endsection