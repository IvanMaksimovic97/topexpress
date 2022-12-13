@extends('template.app')
@section('title', 'Top Express | Prijem')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
<form action="{{ route('cms.dostava.update', $dostava) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        @include('dostava._form')
        <div id="posiljke-render">
            <x-posiljka-tabela :posiljke="$dostava->stavke" :dostava="$dostava"></x-posiljka-tabela>
        </div>
        <div class="col-md-8">
            <button type="submit" id="unesi" class="btn btn-primary mb-2">Izmeni</button>
            @if (!$dostava->status)
                <a href="{{ route('cms.razduzi', $dostava) }}" id="razduzi" class="btn btn-success mb-2">Razduži</a>
                <button type="button" id="razduzi-ceo-spisak" class="btn btn-success mb-2" data-toggle="modal" data-target="#razduziModal">RAZDUŽI SVE</button>
            @endif
            <button type="button" id="obrisi-spisak" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal">Obriši</button>
        </div>
    </div>
</form>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Brisanje spiska</h5>
          <button type="button" class="close zatvori-modal-brisanje" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Da li želite da obrišete spisak?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary zatvori-modal-razduzivanje" data-dismiss="modal">Zatvori</button>
          <a href="{{ route('cms.dostava-brisanje', $dostava->id) }}" id="obrisi-spisak-confirm" class="btn btn-danger mb-2">Obriši</a>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="razduziModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Razduživanje spiska</h5>
          <button type="button" class="close zatvori-modal-brisanje" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Da li želite da razdužite spisak?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary zatvori-modal-brisanje" data-dismiss="modal">Zatvori</button>
          <a href="{{ route('cms.razduzi-sve', $dostava->id) }}" id="obrisi-spisak-confirm" class="btn btn-success mb-2">Razduži</a>
        </div>
      </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('star_admin/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('star_admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>

<script>
$(function () {
    var vrsta = $("#vrsta").select2();
    var tip = $("#tip").select2();
    var posiljke = $("#posiljke").select2();
});

$(document).on('change', '#posiljke', function (e) {
    var posiljke_ids = $('#posiljke option:selected').toArray().map(item => parseInt(item.value)).join();
    
    if (posiljke_ids == '') {
        posiljke_ids = 0;
    }

    $.ajax({
        url: '{{ route('cms.posiljke-na-dostavi') }}' + '/' + posiljke_ids + '/' + '{{ $dostava->id }}',
        method: 'get',
        success: function (data) {
            $('#posiljke-render').html(data);
        }
    })
});

let mozeDaSeObrise = true;

$(document).on('click', '#obrisi-spisak', function(e) {
    
    $.ajax({
        url: '{{ route('cms.dostava-brisanje-provera', $dostava->id) }}',
        method: 'get',
        success: function (data) {
            if (data != 0) {
                mozeDaSeObrise = false;
            } else {
                mozeDaSeObrise = true;
            }
        }
    })

    $('#deleteModal').modal('show');
});

$(document).on('click', '#razduzi-ceo-spisak', function(e) {
    $('#razduziModal').modal('show');
});

$(document).on('click', '#obrisi-spisak-confirm', function(e) {
    if (!mozeDaSeObrise) {
        alert('Nije moguće obrisati spisak, prvo uklonite sve pošiljke!');
        e.preventDefault();
    }
});

$(document).on('click', '.zatvori-modal-brisanje', function(e) {
    $('#deleteModal').modal('hide');
});

$(document).on('click', '.zatvori-modal-razduzivanje', function(e) {
    $('#razduziModal').modal('hide');
});
</script>
@endsection