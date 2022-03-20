@extends('template.app')
@section('title', 'Top Express | Posiljke')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Lista pošiljaka</h4>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Štampaj</th>
                <th>#</th>
                <th>Broj pošiljke</th>
                <th>Vrsta usluge</th>
                <th>Način plaćanja</th>
                <th>Firma</th>
                <th>Pošiljalac</th>
                <th>Primalac</th>
                <th>Masa</th>
                <th>Ima vrednost</th>
                <th>Vrednost</th>
                <th>Ima otkupninu</th>
                <th>Otkupnina</th>
                <th>Otkupnina vrsta</th>
                <th>Poštarina</th>
                <th>Povratnica</th>
                <th>Lično preuzimanje</th>
                <th>Status</th>
                <th>Datum prijema</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posiljke as $posiljka)
                    <tr>
                        <th><a href="#" class="btn btn-sm btn-primary">Štampaj</a></th>
                        <td>{!! $posiljka->id !!}</td>
                        <td>{!! $posiljka->broj_posiljke !!}</td>
                        <td>{!! $posiljka->vrstaUsluge->naziv !!}</td>
                        <td>{!! $posiljka->nacinPlacanja->naziv !!}</td>
                        <td>{!! $posiljka->firma ? $posiljka->firma->naziv : '' !!}</td>
                        <td>{!! $posiljka->posiljalac->naziv !!}</td>
                        <td>{!! $posiljka->primalac->naziv !!}</td>
                        <td>{!! $posiljka->masa_kg !!} kg</td>
                        <td>{!! $posiljka->ima_vrednost ? 'Da' : 'Ne' !!}</td>
                        <td>{!! $posiljka->vrednost !!}</td>
                        <td>{!! $posiljka->ima_otkupninu ? 'Da' : 'Ne' !!}</td>
                        <td>{!! $posiljka->otkupnina !!}</td>
                        <td>{!! $posiljka->otkupnina_vrsta !!}</td>
                        <td>{!! $posiljka->postarina !!}</td>
                        <td>{!! $posiljka->povratnica ? 'Da' : 'Ne' !!}</td>
                        <td>{!! $posiljka->licno_preuzimanje ? 'Da' : 'Ne' !!}</td>
                        <td>{!! $posiljka->status !!}</td>
                        <td>{!! date('d.m.Y. H:i:s', strtotime($posiljka->created_at)) !!}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
