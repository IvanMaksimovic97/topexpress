@extends('template.site')
@section('title', 'TOP EXPRESS 2022 d.o.o.')
@section('content')

<!-- Contact Start -->
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="{{ route('dashboard-site') }}" class="list-group-item list-group-item-action"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                <a href="{{ route('posiljke-site') }}" class="list-group-item list-group-item-action"><i class="fa fa-envelope"></i> <span>Moje pošiljke</span></a>
                <a href="{{ route('moja-firma') }}" class="list-group-item list-group-item-action active"><i class="fa fa-building"></i> <span>Moja firma</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-comments"></i> <span>Moje poruke</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> <span>Moj profil</span></a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"><i class="fa fa-power-off"></i> <span>Odjavi se</span></a>
            </div>
        </div>
        <div class="col-lg-9">
            <form action="" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                          <div class="col">
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Naziv</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->naziv ?? '' !!}" name="naziv" id="naziv" required/>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Pun naziv</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->naziv_pun ?? '' !!}" name="naziv_pun" id="naziv_pun" required />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>PIB</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->pib ?? '' !!}" name="pib" id="pib" required />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Matični broj</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->mbr ?? '' !!}" name="mbr" id="mbr" required />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Adresa</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->adresa ?? '' !!}" name="adresa" id="adresa" required />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Email</label>
                                      <input type="email" class="form-control" value="{!! $kompanija->email ?? '' !!}" name="email" id="email" required />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Web sajt</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->websajt ?? '' !!}" name="websajt" id="websajt" />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Telefon</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->telefon ?? '' !!}" name="telefon" id="telefon" required />
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="form-group w-100">
                                      <label>Mobilni</label>
                                      <input type="text" class="form-control" value="{!! $kompanija->mobilni ?? '' !!}" name="mobilni" id="mobilni" />
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
                <input class="btn btn-danger mt-3" type="submit" value="Izmeni">
            </form>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection