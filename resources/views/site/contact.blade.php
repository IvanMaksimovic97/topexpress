@extends('template.site')
@section('title', 'TOP EXPRESS')
@section('content')
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid mb-5">
    <div class="container text-center py-5">
        <h1 class="text-white display-3">Kontakt</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="{{ route('index') }}">Početna</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">Kontakt</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 pb-4 pb-lg-0">
                <div class="bg-danger text-dark text-center p-4">
                    <h4 class="m-0"><i class="fa fa-map-marker-alt text-white mr-2"></i>Karađorđev trg 34e, 11080 Zemun, Beograd, Srbija</h4>
                </div>
                <iframe style="width: 100%; height: 470px;"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2829.3118770534306!2d20.417778195106496!3d44.83558160142083!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a650bc8fd131d%3A0xf917ea6d0def2aa5!2z0JrQsNGA0LDRktC-0YDRktC10LIg0KLRgNCzIDM0LCDQkdC10L7Qs9GA0LDQtCAxMTAwMA!5e0!3m2!1ssr!2srs!4v1651854316961!5m2!1ssr!2srs"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col-lg-7">
                <h6 class="text-danger text-uppercase font-weight-bold">Kontaktirajte nas</h6>
                <h1 class="mb-4">Kontakt za bilo koja pitanja</h1>
                <div class="contact-form bg-secondary" style="padding: 30px;">
                    <div id="success"></div>
                    <form name="sentMessage" action="{{ route('send-mail-contact') }}" method="POST" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="name" name="name" placeholder="Ime"
                                required="required" data-validation-required-message="Unesite ime!" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control border-0 p-4" id="email" name="email" placeholder="Email"
                                required="required" data-validation-required-message="Unesite email!" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="telefon" name="telefon" placeholder="Telefon"
                                required="required" data-validation-required-message="Unesite telefon!" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="subject" name="subject" placeholder="Naslov"
                                required="required" data-validation-required-message="Unesite naslov!" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control border-0 py-3 px-4" rows="3" id="message" name="message" placeholder="Poruka"
                                required="required"
                                data-validation-required-message="Unesite poruku!"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-danger py-3 px-4" type="submit" id="sendMessageButton">Pošalji poruku</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection