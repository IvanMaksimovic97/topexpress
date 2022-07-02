@extends('template.site')
@section('title', 'TOP EXPRESS 2022 d.o.o.')

@section('custom-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
<style>
    .register{
    background: -webkit-linear-gradient(left, #dc3545, #FF0000);
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 4%;
}
.register-left input{
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    width: 60%;
    background: #f8f9fa;
    font-weight: bold;
    color: #383d41;
    margin-top: 30%;
    margin-bottom: 3%;
    cursor: pointer;
}
.register-right{
    background: #f8f9fa;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #dc3545;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #dc3545;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #dc3545;
    border: 2px solid #dc3545;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
</style>
@endsection

@section('content')
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid mb-0">
    <div class="container text-center py-5">
        <h1 class="text-white display-3">Registracija</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="{{ route('index') }}">Početna</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">Registracija</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Contact Start -->
<div class="container-fluid register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Prijava na sistem</h3>
            <p>Prijavite se na sistem, kako biste mogli da unesete pošiljke</p>
            <input type="submit" name="" value="Prijavi se"/><br/>
        </div>
        <div class="col-md-9 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3  class="register-heading">Registruj se</h3>
                    <form action="" method="POST">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <h4 class="text-center">Korisnik</h4>
                                <div class="form-group">
                                    <input type="text" name="naziv" required class="form-control" placeholder="Ime *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prezime" required class="form-control" placeholder="Prezime *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" required class="form-control" placeholder="Email *" value="" />
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker form-control border" data-live-search="true">
                                        <option selected disabled>Izaberi naselje *</option>
                                        @foreach ($naselja as $n)
                                        <option value="{{ $n->id }}">{{ strtoupper($n->naziv) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="selectpicker form-control border" data-live-search="true">
                                        <option selected disabled>Izaberi ulicu *</option>
                                        @foreach ($ulice as $u)
                                        <option value="{{ $u->id }}">{{ strtoupper($u->naziv) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                   <div class="row">
                                    <div class="col"><input type="text" name="broj" required class="form-control" placeholder="Broj *" value="" /></div>
                                    <div class="col"><input type="text" name="podbroj" class="form-control" placeholder="Pod broj" value="" /></div>
                                    <div class="col"><input type="text" name="sprat" class="form-control" placeholder="Sprat" value="" /></div>
                                    <div class="col"><input type="text" name="stan" class="form-control" placeholder="Stan" value="" /></div>
                                   </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required class="form-control" placeholder="Lozinka *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" required class="form-control" placeholder="Potvrdi lozinku *" value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-center">Firma</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="naziv_firme" name="naziv_firme" disabled placeholder="Naziv firme *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="adresa" name="adresa" disabled placeholder="Adresa *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="pib" name="pib" disabled placeholder="PIB *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="mbr" name="mbr" disabled placeholder="Matični broj *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="telefon" name="telefon" disabled placeholder="Telefon *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="reg_firma" name="reg_firma" value="1" /> Registruj firmu
                                </div>
                                <input type="submit" class="btnRegister"  value="Registruj se"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection

@section('custom-js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).on('click', '#reg_firma', function(e) {
        if ($(this).is(':checked')) {
            $('#naziv_firme').removeAttr('disabled');
            $('#naziv_firme').attr('required', 'required');
            $('#adresa').removeAttr('disabled');
            $('#adresa').attr('required', 'required');
            $('#pib').removeAttr('disabled');
            $('#pib').attr('required', 'required');
            $('#mbr').removeAttr('disabled');
            $('#mbr').attr('required', 'required');
            $('#telefon').removeAttr('disabled');
            $('#telefon').attr('required', 'required');
        } else {
            $('#naziv_firme').attr('disabled', 'disabled');
            $('#naziv_firme').removeAttr('required');
            $('#adresa').attr('disabled', 'disabled');
            $('#adresa').removeAttr('required');
            $('#pib').attr('disabled', 'disabled');
            $('#pib').removeAttr('required');
            $('#mbr').attr('disabled', 'disabled');
            $('#mbr').removeAttr('required');
            $('#telefon').attr('disabled', 'disabled');
            $('#telefon').removeAttr('required');
        }
    });
</script>
@endsection