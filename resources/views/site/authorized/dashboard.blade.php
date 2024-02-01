@extends('template.site')
@section('title', 'Dashboard | TOP EXPRESS 2022 d.o.o.')
@section('content')

<!-- Contact Start -->
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="{{ route('dashboard-site') }}" class="list-group-item list-group-item-action active"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                <a href="{{ route('posiljke-site') }}" class="list-group-item list-group-item-action"><i class="fa fa-envelope"></i> <span>Moje pošiljke</span></a>
                <a href="{{ route('moja-firma') }}" class="list-group-item list-group-item-action"><i class="fa fa-building"></i> <span>Moja firma</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-comments"></i> <span>Moje poruke</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> <span>Moj profil</span></a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"><i class="fa fa-power-off"></i> <span>Odjavi se</span></a>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('posiljke-nova-site') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i> Nova pošiljka</a>
                    <a href="{{ route('posiljke-excel-unos') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i><i class="mdi mdi-file-excel"></i> Unos pošiljki excel</a>
                </div>
            </div>

            <span class="h4">Dobro došli <strong>{{ App\Korisnik::ulogovanKorisnikSite()->ime . ' ' . App\Korisnik::ulogovanKorisnikSite()->prezime }}</strong></span>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection