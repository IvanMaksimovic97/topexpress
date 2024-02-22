@extends('template.app')
@section('title', 'Top Express | Dostava')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form action="">
          <div class="input-group">
              <div class="row">
                  <div class="col">
                      <h4 class="card-title">Br. spiska</h4>
                      <input type="text" class="form-control" value="{!! request()->search !!}" name="search" placeholder="Pretraga po broju spiska">
                  </div>
                  <div class="col">
                    <h4 class="card-title">Br. pošiljke</h4>
                    <input type="text" class="form-control" value="{!! request()->search_po !!}" name="search_po" placeholder="Pretraga po broju pošiljke">
                  </div>
                  <div class="col">
                    <h4 class="card-title">Radnik</h4>
                    <input type="text" class="form-control" value="{!! request()->search_radnik !!}" name="search_radnik" placeholder="Pretraga radniku">
                  </div>
                  <div class="col">
                      <h4 class="card-title">Datum od</h4>
                      <input type="date" class="form-control" value="{!! date('Y-m-d', strtotime(request()->date_from ?? now())) !!}" name="date_from" placeholder="datum od">
                  </div>
                  <div class="col">
                    <h4 class="card-title">Datum do</h4>
                    <input type="date" class="form-control" value="{!! date('Y-m-d', strtotime(request()->date_to ?? now())) !!}" name="date_to" placeholder="datum do">
                </div>
              </div>
          </div>
          <div class="mt-3">
              <button class="btn btn-sm btn-primary" type="submit">Pretraži</button>
              <a href="{{ route('cms.dostava.index') }}" class="btn btn-sm btn-primary">Resetuj</a>
          </div>
      </form>
  </div>
  </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Lista dostavnih spiskova</h4>
        <div class="table-responsive pt-3">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th>Štampaj</th>
                <th>Izvoz Excel</th>
                <th>Pošiljke</th>
                <th>Izmeni</th>
                <th>Status</th>
                <th>Broj</th>
                {{-- <th>Vrsta</th>
                <th>Tip</th> --}}
                <th>Broj pošiljki</th>
                <th>Za naplatu</th>
                <th>Za datum</th>
                <th>Zaduženi radnik</th>
                <th>Datum unosa</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              @php
                $brojRazduzenih = 0;
                $iznos = 0;
              @endphp
                @foreach ($spisak as $stavka)
                @php
                  if ($stavka->status) {
                    $iznos += $stavka->za_naplatu;
                    $brojRazduzenih++;
                  }
                @endphp
                    <tr @if($stavka->status) class="table-success" @endif>
                        <td><a href="{{ route('cms.dostava.show', $stavka) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></th>
                        <td><a href="{{ route('cms.dostava-excel', $stavka) }}" class="btn btn-sm btn-success">Izvoz Excel  <i class="mdi mdi-file-excel btn-icon-append"></i></a></th>
                        <td>
                            <button class="btn btn-sm btn-secondary prikazi" data-id="{{ $stavka->id }}">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                Prikaži
                            </button>
                        </td>
                        <td><a href="{{ route('cms.dostava.edit', $stavka) }}" class="btn btn-sm btn-danger">Izmeni</a></td>
                        <td>{!! $stavka->status ? 'Razdužen' : 'Zadužen' !!}</td>
                        <td>{!! $stavka->broj_spiska !!}</td>
                        {{-- <td>{!! $stavka->vrsta !!}</td>
                        <td>{!! $stavka->tip !!}</td> --}}
                        <td>{!! $stavka->stavke->count() !!}</td>
                        <td>{!! $stavka->za_naplatu !!} RSD</td>
                        <td>{!! date('d.m.Y.', strtotime($stavka->za_datum)) !!}</td>
                        <td>{!! $stavka->radnik !!}</td>
                        <td>{!! date('d.m.Y. H:i:s', strtotime($stavka->created_at)) !!}</td>
                        <td>{!! $stavka->id !!}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title mb-0">Izveštaj</h4>
      <div class="table-responsive pt-3">
          <div class="table-responsive">
            <table class="table table-sm" style="white-space: nowrap!important; width: 1%!important;">
              <thead>
                
              </thead>
              <tbody>
                <tr>
                  <th>Br. razduženih:</th>
                  <td>{{ $brojRazduzenih }}</td>
                </tr>
                <tr>
                  <th>UKUPNO:</th>
                  <th>{{ number_format($iznos, 2) }} RSD</th>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title mb-0">Izveštaj po pošiljaocu</h4>
      <form action="{{ route('cms.posiljalac-izvestaj-spiskovi-svi') }}" method="POST">
        @csrf
        <input type="hidden" name="datum" value="{{ request()->date ?? date('Y-m-d') }}">
        <input type="hidden" name="posiljaoci" value="{{ implode(',', array_keys($izvestaj->posiljaociIzvestaj)) }}">
        <input type="hidden" name="spiskovi" value="{{ implode(',', $spisak->pluck('id')->toArray()) }}">
        <input type="hidden" name="date_from" value="{{ request()->date_from ?? date('Y-m-d') }}">
        <input type="hidden" name="date_to" value="{{ request()->date_to ?? date('Y-m-d') }}">
        <button type="submit" class="btn btn-sm btn-primary mt-3">Štampaj sve <i class="ti-printer btn-icon-append"></i></button>
      </form>
      <div class="table-responsive pt-3">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" style="white-space: nowrap!important; width: 1%!important;">
                  <thead>
                    <tr>
                      <th>Štampaj</th>
                      <th>Posiljalac</th>
                      <th>Primalac</th>
                      <th>Broj pošiljke</th>
                      <th>NALOG iznos</th>
                      <th>Iznos</th>
                      <th>UKUPAN iznos</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($izvestaj->posiljaociIzvestaj as $p_id => $posiljaocItem)
                      @php
                        $subIterations = 0;
                      @endphp
                      @foreach ($posiljaocItem['urucene_posiljke'] as $urucena_posiljka)
                        <tr>
                          @if ($subIterations == 0)
                            <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}"><a href="{{ route('cms.posiljalac-izvestaj-spiskovi', [implode(',', $spisak->pluck('id')->toArray()), $p_id, date('Y-m-d', strtotime(request()->date_from ?? now())), date('Y-m-d', strtotime(request()->date_to ?? now()))]) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td>
                            <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}">{{ $posiljaocItem['naziv'] }}</td>
                          @endif
                          <td>{{ $urucena_posiljka->primalac->naziv }}</td>
                          <td>{{ $urucena_posiljka->broj_posiljke }}</td>
                          <td>{{ $urucena_posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? number_format((float) $urucena_posiljka->vrednost, 2) : 0.00 }}</td>
                          <td>{{ $urucena_posiljka->otkupnina_vrsta == 'TOP EXPRESS iznos' ? number_format((float) $urucena_posiljka->vrednost, 2) : 0.00 }}</td>
                          @if ($subIterations == 0)
                            <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}">{{ number_format((float) $posiljaocItem['ukupan_iznos'], 2) }}</td>
                          @endif
                        </tr>
                        @php
                          $subIterations++;
                          if ($subIterations == count($posiljaocItem['urucene_posiljke'])) {
                            $subIterations = 0;
                          }
                        @endphp
                      @endforeach
                      {{-- <tr>
                        <td>{{ $posiljaocItem['naziv'] }}</td>
                        <td>{{ number_format($posiljaocItem['nalog_iznos'], 2) }} rsd</td>
                        <td>{{ number_format($posiljaocItem['uputnica_iznos'], 2) }} rsd</td>
                        <td>{{ number_format($posiljaocItem['ukupan_iznos'], 2) }} rsd</td>
                      </tr> --}}
                    @endforeach
                  </tbody>
                </table>
              </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Spisak pošiljki</h5>
          <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row" id="telo">

            </div>
        </div>
        <div class="modal-footer">
          <a href="#" id="razduzi" class="btn btn-sm btn-success">Razduži</a>
          <button type="button" class="btn btn-sm btn-primary close-modal" data-dismiss="modal">Zatvori</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
$(document).on('click', '.prikazi', function () {
    $('#razduzi').show();
    const id = $(this).data('id');

    $('#razduzi').attr('href', '{{ route('cms.razduzi') }}' + '/' + id);

    let element = $(this);

    element.attr('disabled', 'disabled');
    element.find('.spinner-border').removeClass('d-none');
    
    $('#telo').html('');
    
    $.ajax({
        url: '{{ route('cms.posiljke-unete') }}' + '/' + id,
        method: 'get',
        success: function (data) {
            $('#telo').html(data.html);
            if (data.razduzen) {
              $('#razduzi').hide();
            }
            $('#exampleModal').modal('toggle');

            razduzi = data.razduzi;

            element.removeAttr('disabled');
            element.find('.spinner-border').addClass('d-none');
        }
    })
});

$(document).on('click', '.close-modal', function () {
    $('#exampleModal').modal('hide');
});
</script>
@endsection