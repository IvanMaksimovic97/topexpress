@extends('template.site')
@section('title', 'TOP EXPRESS 2022 d.o.o.')
@section('content')

<!-- Contact Start -->
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="list-group">
                <a href="{{ route('dashboard-site') }}" class="list-group-item list-group-item-action"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                <a href="{{ route('posiljke-site') }}" class="list-group-item list-group-item-action active"><i class="fa fa-envelope"></i> <span>Moje pošiljke</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-building"></i> <span>Moja firma</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-comments"></i> <span>Moje poruke</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> <span>Moj profil</span></a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"><i class="fa fa-power-off"></i> <span>Odjavi se</span></a>
            </div>
        </div>
        <div class="col-lg-9 grid-margin stretch-card">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="">
                        <div class="input-group">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Broj</h4>
                                    <input type="text" class="form-control" value="{!! request()->search !!}" name="search" placeholder="Pretraga po broju pošiljke">
                                </div>
                                {{-- <div class="col">
                                    <h4 class="card-title">Pošiljalac</h4>
                                    <input type="text" class="form-control" value="{!! request()->search_po !!}" name="search_po" placeholder="Pretraga po broju pošiljaocu">
                                </div> --}}
                                <div class="col">
                                    <h4 class="card-title">Primalac</h4>
                                    <input type="text" class="form-control" value="{!! request()->search_pr !!}" name="search_pr" placeholder="Pretraga po broju primaocu">
                                </div>
                                <div class="col">
                                    <h4 class="card-title">Datum</h4>
                                    <input type="date" class="form-control" value="{!! request()->date ? date('Y-m-d', strtotime(request()->date)) : '' !!}" name="date" id="datum" placeholder="datum">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('posiljke-nova-site') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i> Nova pošiljka</a>
                            <button class="btn btn-sm btn-danger" type="submit">Pretraži</button>
                            <a href="{{ route('posiljke-site') }}" class="btn btn-sm btn-danger">Resetuj</a>
                            <button type="button" class="btn btn-sm btn-danger" id="ponisti-datum">Poništi datum</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lista pošiljaka</h4>
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['stampajadresnice' => '1']) }}" class="btn btn-sm btn-danger">Štampaj sve adresnice <i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['stampajspisak' => '1']) }}" class="btn btn-sm btn-danger">Štampaj spisak <i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr>
                          {{-- <th>Štampaj</th> --}}
                          <th>Izmeni</th>
                          <th>Broj pošiljke</th>
                          <th>Datum prijema</th>
                          <th>Primalac</th>
                          <th>Mesto</th>
                          <th>Adresa</th>
                          <th>Masa</th>
                          {{-- <th>Vrednost</th> --}}
                          <th>Otkupnina</th>
                          <th>Poštarina</th>
                          <th>Vrsta usluge</th>
                          <th>Način plaćanja</th>
                          <th>Opis sadržine</th>
                          <th>Lično preuzimanje</th>
                          {{-- <th>Firma</th>
                          <th>#</th> --}}
                          <th>Otkupnina vrsta</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $brojUrucenih = 0;
                          $brojVracenih = 0;
                          $brojZaNarednu = 0;
                          $iznos = 0;
                          $postarina = 0;
                        @endphp
                          @foreach ($posiljke as $posiljka)
                            @php
                              
                              $rowColor = '';
                              switch ($posiljka->status_po_spisku) {
                                case 2:
                                  $rowColor = 'table-success';
                                  $iznos += $posiljka->otkupnina;
                                  $postarina += $posiljka->postarina;
                                  $brojUrucenih++;
                                  break;
                                case 3:
                                  $rowColor = 'table-danger';
                                  if ($posiljka->vracena_posiljka) {
                                    $postarinaTMP = $posiljka->nacin_placanja_id == 3 ? $posiljka->postarina * 2 : 0;
                                    $postarina += $postarinaTMP;
                                  }
                                  $brojVracenih++;
                                  break;
                                case 4:
                                  $rowColor = 'table-info';
                                  if ($posiljka->vracena_posiljka) {
                                    $postarinaTMP = $posiljka->nacin_placanja_id == 3 ? $posiljka->postarina * 2 : 0;
                                    $postarina += $postarinaTMP;
                                  }
                                  $brojZaNarednu++;
                                  break;
                                default:
                                  # code...
                                  break;
                              }
                            @endphp
                              <tr @if($rowColor != '') class="{{ $rowColor }}" @endif>
                                  {{-- <td><a href="{{ route('cms.posiljka.show', $posiljka) }}" class="btn btn-sm btn-danger">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td> --}}
                                  <td><a href="{{ route('posiljka-izmena-site', $posiljka->id) }}" class="btn btn-sm btn-danger">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                                  <td>{!! $posiljka->broj_posiljke !!}</td>
                                  <td>{!! date('d.m.Y. H:i:s', strtotime($posiljka->created_at)) !!}</td>
                                  <td>{!! $posiljka->primalac->naziv !!}</td>
                                  <td>{!! $posiljka->primalac->naselje !!}</td>
                                  <td>{!! $posiljka->primalac->ulica.' br. '.$posiljka->primalac->broj !!}{!! $posiljka->primalac->stan ? '/'.$posiljka->primalac->stan : '' !!}</td>
                                  <td>{!! $posiljka->masa_kg !!} kg</td>
                                  {{-- <td>{!! $posiljka->vrednost !!}</td> --}}
                                  <td>{!! $posiljka->otkupnina !!}</td>
                                  <td>{!! $posiljka->postarina !!}</td>
                                  <td>{!! $posiljka->vrstaUsluge->naziv !!}</td>
                                  <td>{!! $posiljka->nacinPlacanja->naziv !!}</td>
                                  <td>{!! $posiljka->sadrzina !!}</td>
                                  <td>{!! $posiljka->licno_preuzimanje ? 'Da' : 'Ne' !!}</td>
                                  {{-- <td>{!! $posiljka->firma ? $posiljka->firma->naziv : '' !!}</td>
                                  <td>{!! $posiljka->id !!}</td> --}}
                                  <td>{!! $posiljka->otkupnina_vrsta !!}</td>
                              </tr>
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>UKUPNO</td>
                            <td>{{ number_format((float) $sum_posiljka->otkupnina, 2) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection