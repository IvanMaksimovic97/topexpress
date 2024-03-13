@extends('template.site')
@section('title', 'Moje pošiljke | TOP EXPRESS 2022 d.o.o.')
@section('content')

<!-- Contact Start -->
<div class="container-fluid py-4 px-sm-3 px-md-5">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="list-group">
                <a href="{{ route('dashboard-site') }}" class="list-group-item list-group-item-action"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                <a href="{{ route('posiljke-site') }}" class="list-group-item list-group-item-action active"><i class="fa fa-envelope"></i> <span>Moje pošiljke</span></a>
                <a href="{{ route('moja-firma') }}" class="list-group-item list-group-item-action"><i class="fa fa-building"></i> <span>Moja firma</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-comments"></i> <span>Moje poruke</span></a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> <span>Moj profil</span></a>
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"><i class="fa fa-power-off"></i> <span>Odjavi se</span></a>
            </div>
        </div>
        <div class="col-lg-9 grid-margin stretch-card">
            <div class="card mb-4">
              <div class="card-body">
                <a href="{{ route('posiljke-nova-site') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i> Nova pošiljka</a>
                <a href="{{ route('posiljke-excel-unos') }}" class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i><i class="mdi mdi-file-excel"></i> Unos pošiljki excel</a>
              </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="">
                        <div class="input-group">
                            <div class="row">
                                <div class="col">
                                    <h4 class="card-title">Broj</h4>
                                    <input type="text" class="form-control form-control-sm" value="{!! request()->search !!}" name="search" placeholder="Pretraga po broju pošiljke">
                                </div>
                                {{-- <div class="col">
                                    <h4 class="card-title">Pošiljalac</h4>
                                    <input type="text" class="form-control form-control-sm" value="{!! request()->search_po !!}" name="search_po" placeholder="Pretraga po broju pošiljaocu">
                                </div> --}}
                                <div class="col">
                                    <h4 class="card-title">Primalac</h4>
                                    <input type="text" class="form-control form-control-sm" value="{!! request()->search_pr !!}" name="search_pr" placeholder="Pretraga po primaocu">
                                </div>
                                <div class="col">
                                  <h4 class="card-title">Datum od</h4>
                                  <input type="date" class="form-control form-control-sm" value="{!! date('Y-m-d', strtotime(request()->date_from ?? now())) !!}" name="date_from" id="date_from" placeholder="datum od">
                                </div>
                                <div class="col">
                                  <h4 class="card-title">Datum do</h4>
                                  <input type="date" class="form-control form-control-sm" value="{!! date('Y-m-d', strtotime(request()->date_to ?? now())) !!}" name="date_to" id="date_to" placeholder="datum do">
                                </div>
                            </div>
                            <div class="row">
                              <div class="col mt-3">
                                <h4 class="card-title">Mesto</h4>
                                  <input type="text" class="form-control form-control-sm" value="{!! request()->search_mesto !!}" name="search_mesto" id="search_mesto" placeholder="Pretraga po mestu">
                              </div>
                              <div class="col mt-3">
                                <h4 class="card-title">Adresa</h4>
                                  <input type="text" class="form-control form-control-sm" value="{!! request()->search_adresa !!}" name="search_adresa" id="search_adresa" placeholder="Pretraga po adresi">
                              </div>
                              <div class="col mt-3">
                                <h4 class="card-title">Lično preuzimanje</h4>
                                <select class="form-control form-control-sm" name="licno_preuzimanje" id="">
                                  <option value="-1">Izaberi</option>
                                  <option @if(request()->licno_preuzimanje == 1) selected="selected" @endif value="1">Ne</option>
                                  <option @if(request()->licno_preuzimanje == 2) selected="selected" @endif value="2">Da</option>
                                </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col mt-3">
                                <h4 class="card-title">Vrsta usluge</h4>
                                <select class="form-control form-control-sm" name="vrste_usluga" id="vrste_usluga">
                                  <option value="-1">Izaberi</option>
                                  @foreach ($vrste_usluga as $item)
                                    <option @if(request()->vrste_usluga == $item->id) selected="selected" @endif value="{{$item->id}}">{{$item->naziv}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col mt-3">
                                <h4 class="card-title">Način plaćanja</h4>
                                <select class="form-control form-control-sm" name="nacini_placanja" id="nacini_placanja">
                                  <option value="-1">Izaberi</option>
                                  @foreach ($nacini_placanja as $item)
                                    <option @if(request()->nacini_placanja == $item->id) selected="selected" @endif value="{{$item->id}}">{{$item->naziv}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col mt-3">
                                <h4 class="card-title">Sortiraj po</h4>
                                <select class="form-control form-control-sm" name="sortBy">
                                  <option value="-1">Izaberi...</option>
                                  <option @if(request()->sortBy == 1) selected="selected" @endif value="1">Broj pošiljke RASTUĆE</option>
                                  <option @if(request()->sortBy == 2) selected="selected" @endif value="2">Broj pošiljke OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 3) selected="selected" @endif value="3">Datum prijema RASTUĆE</option>
                                  <option @if(request()->sortBy == 4) selected="selected" @endif value="4">Datum prijema OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 5) selected="selected" @endif value="5">Otkupnina RASTUĆE</option>
                                  <option @if(request()->sortBy == 6) selected="selected" @endif value="6">Otkupnina OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 7) selected="selected" @endif value="7">Primalac RASTUĆE</option>
                                  <option @if(request()->sortBy == 8) selected="selected" @endif value="8">Primalac OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 9) selected="selected" @endif value="9">Mesto RASTUĆE</option>
                                  <option @if(request()->sortBy == 10) selected="selected" @endif value="10">Mesto OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 11) selected="selected" @endif value="11">Adresa RASTUĆE</option>
                                  <option @if(request()->sortBy == 12) selected="selected" @endif value="12">Adresa OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 13) selected="selected" @endif value="13">Masa RASTUĆE</option>
                                  <option @if(request()->sortBy == 14) selected="selected" @endif value="14">Masa OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 15) selected="selected" @endif value="15">Poštarina RASTUĆE</option>
                                  <option @if(request()->sortBy == 16) selected="selected" @endif value="16">Poštarina OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 17) selected="selected" @endif value="17">Vrsta usluge RASTUĆE</option>
                                  <option @if(request()->sortBy == 18) selected="selected" @endif value="18">Vrsta usluge OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 19) selected="selected" @endif value="19">Način plaćanja RASTUĆE</option>
                                  <option @if(request()->sortBy == 20) selected="selected" @endif value="20">Način plaćanja OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 21) selected="selected" @endif value="21">Opis sadržine RASTUĆE</option>
                                  <option @if(request()->sortBy == 22) selected="selected" @endif value="22">Opis sadržine OPADAJUĆE</option>
                                  <option @if(request()->sortBy == 23) selected="selected" @endif value="23">Lično preuzimanje RASTUĆE</option>
                                  <option @if(request()->sortBy == 24) selected="selected" @endif value="24">Lično preuzimanje OPADAJUĆE</option>
                                </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col mt-3">
                                <h4 class="card-title">Status</h4>
                                <select class="form-control form-control-sm" name="status_posiljke" id="status_posiljke">
                                    <option value="-2">Izaberi</option>
                                    <option value="-1" @if(request()->status_posiljke == '-1') selected @endif>U pripremi</option>
                                    <option value="0" @if(request()->status_posiljke == '0') selected @endif>Primljena</option>
                                    <option value="1" @if(request()->status_posiljke == '1') selected @endif>Na dostavi</option>
                                    <option value="2" @if(request()->status_posiljke == '2') selected @endif>Uručena</option>
                                    <option value="3" @if(request()->status_posiljke == '3') selected @endif>Vraćena</option>
                                    <option value="4" @if(request()->status_posiljke == '4') selected @endif>Za narednu dostavu</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            {{-- <a href="{{ route('posiljke-nova-site') }}?prethodna" class="btn btn-sm btn-danger"><i class="fa fa-plus" aria-hidden="true"></i> Nova prethodna pošiljka</a> --}}
                            <button class="btn btn-sm btn-danger" type="submit">Pretraži</button>
                            <a href="{{ route('posiljke-site') }}" class="btn btn-sm btn-danger">Resetuj</a>
                            <button type="button" class="btn btn-sm btn-danger" id="ponisti-datum">Poništi datum</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Lista pošiljaka (ukupno: {{ $posiljke->count() }} )</h4>
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['stampajadresnice' => '1']) }}" id="stampaj-adresnice" class="btn btn-sm btn-danger">Štampaj adresnice <i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['stampajadresnicea4' => '1']) }}" id="stampaj-adresnice-a4" class="btn btn-sm btn-danger">Štampaj adresnice A4 <i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['stampajadresnicea4l' => '1']) }}" id="stampaj-adresnice-a4-l" class="btn btn-sm btn-danger">Štampaj adresnice A4 LandScape<i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['stampajspisak' => '1']) }}" id="stampaj-spisak" class="btn btn-sm btn-danger">Štampaj spisak <i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  @if(Route::currentRouteName() == 'posiljke-site')
                    <a href="{{ request()->fullUrlWithQuery(['exportexcel' => '1']) }}" id="izvoz-excel" class="btn btn-sm btn-danger">Izvoz u excel <i class="ti-printer btn-icon-append"></i></a>
                  @endif
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr>
                          {{-- <th>Štampaj</th> --}}
                          <th><input type="checkbox" class="ml-3 mr-3" id="check-all"/></th>
                          <th>Izmeni</th>
                          <th>RB</th>
                          <th>Broj pošiljke</th>
                          <th>Status pošiljke</th>
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
                          $rb = 1;
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
                                  <td><input type="checkbox" class="check-item ml-3 mr-3" data-id="{{ $posiljka->id }}"/></td>
                                  {{-- <td><a href="{{ route('cms.posiljka.show', $posiljka) }}" class="btn btn-sm btn-danger">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td> --}}
                                  <td><a href="{{ route('posiljka-izmena-site', $posiljka->id) }}" class="btn btn-sm btn-danger">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                                  <td>{!! $rb !!}</td>
                                  <td>{!! $posiljka->broj_posiljke !!}</td>
                                  <td>
                                    @if($posiljka->status_po_spisku == '-1') U pripremi @endif
                                    @if($posiljka->status_po_spisku == 0) Primljena @endif
                                    @if($posiljka->status_po_spisku == 1) Na dostavi @endif
                                    @if($posiljka->status_po_spisku == 2) Uručena @endif
                                    @if($posiljka->status_po_spisku == 3) Vraćena @endif
                                    @if($posiljka->status_po_spisku == 4) Za narednu dostavu @endif
                                  </td>
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
                              @php
                                $rb++;
                              @endphp
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>UKUPNO</td>
                            <td>{{ number_format((float) $sum_posiljka->otkupnina, 2) }}</td>
                            <td>{{ number_format((float) $sum_posiljka->postarina, 2) }}</td>
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
            <button type="button" class="btn btn-sm btn-danger mt-3" data-toggle="modal" data-target="#posiljke-brisanje-modal">Obriši pošiljke</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="posiljke-brisanje-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Potvrda brisanja pošiljki</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Da li ste sigurni da želite da obrišete izabrane pošiljke?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Zatvori</button>
        <button type="button" class="btn btn-sm btn-danger" id="obrisi-posiljke"><span id="obrisi-spinner" class="spinner-border spinner-border-sm d-none"></span> Obriši</button>
      </div>
    </div>
  </div>
</div>

<!-- Contact End -->
@endsection

@section('custom-js')

@if($unete_posiljke != 'null')
<script>
$.toast({
    text: "Uspešno ste uvezli {{ $unete_posiljke }} pošiljki", // Text that is to be shown in the toast
    heading: 'Obaveštenje', // Optional heading to be shown on the toast
    icon: 'success', // Type of toast icon
    showHideTransition: 'fade', // fade, slide or plain
    allowToastClose: true, // Boolean value true or false
    hideAfter: false, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
    position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
    textAlign: 'left',  // Text alignment i.e. left, right or center
    loader: true,  // Whether to show loader or not. True by default
    loaderBg: '#9EC600',  // Background color of the toast loader
});
</script>
@endif
<script>
let stampaj_adresnice_route = '{!! request()->fullUrlWithQuery(['stampajadresnice' => '1']) !!}';
let stampaj_adresnice_a4_route = '{!! request()->fullUrlWithQuery(['stampajadresnicea4' => '1']) !!}';
let stampaj_adresnice_a4_l_route = '{!! request()->fullUrlWithQuery(['stampajadresnicea4l' => '1']) !!}';
let stampaj_spisak_route = '{!! request()->fullUrlWithQuery(['stampajspisak' => '1']) !!}';
let izvoz_excel_route = '{!! request()->fullUrlWithQuery(['exportexcel' => '1']) !!}';

let stampaj_adresnice_obj = $('#stampaj-adresnice');
let stampaj_adresnice_a4_obj = $('#stampaj-adresnice-a4');
let stampaj_adresnice_a4_l_obj = $('#stampaj-adresnice-a4-l');
let stampaj_spisak_obj = $('#stampaj-spisak');
let izvoz_excel_obj = $('#izvoz-excel');

function setHrefs()
{
  const posiljke = $('.check-item:checkbox:checked');
  const ids = [];

  posiljke.each(function () {
    ids.push($(this).data('id'));
  });

  let result = ids.join(',');
  let route = '&ids=' + result;

  if (ids.length == 0) {
    route = '&ids=0';
  }

  stampaj_adresnice_obj.attr('href', stampaj_adresnice_route + route);
  stampaj_adresnice_a4_obj.attr('href', stampaj_adresnice_a4_route + route);
  stampaj_adresnice_a4_l_obj.attr('href', stampaj_adresnice_a4_l_route + route);
  stampaj_spisak_obj.attr('href', stampaj_spisak_route + route);
  izvoz_excel_obj.attr('href', izvoz_excel_route + route);
}

$(document).on('click', '.check-item', function(e) {
  setHrefs();
});

$(document).on('click', '#check-all', function(e) {
  if (this.checked) {
    $('.check-item').not(this).prop('checked', true);
  } else {
    $('.check-item').not(this).prop('checked', false);
  }
  
  setHrefs();
});

$(document).on('click', '#obrisi-posiljke', function(e) {
  const c_ids = [];
  const posiljke = $('.check-item:checkbox:checked');

  $('.check-item:checkbox:checked').each(function () {
    c_ids.push($(this).data('id'));
  });
  
  let spinner = $('#obrisi-spinner');
  spinner.removeClass('d-none');

  let btn = $('#obrisi-posiljke');
  btn.attr('disabled', 'disabled');
  
  $.ajax({
    url: '{{ route('posiljke-delete-mass') }}',
    method: 'post',
    data: {
      _token: '{{ csrf_token() }}',
      c_ids: c_ids
    },
    success: function(data) {
      $('.check-item:checkbox:checked').each(function () {
        let id = $(this).data('id');
        if (data.includes(id)) {
          $(this).parent().parent().remove();
        }
      });
      spinner.addClass('d-none');
      btn.removeAttr('disabled');
    },
    error: function(err) {

    }
  });
});
</script>
@endsection