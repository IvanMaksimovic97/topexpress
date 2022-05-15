@extends('template.app')
@section('title', 'Top Express | Novi ugovor')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<form action="{{ route('cms.ugovor.update', $ugovor) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        @include('ugovor._form')
        <div id="ugovori-render"></div>
        <div class="col-md-4">
            <button type="submit" id="unesi" class="btn btn-primary mb-2">Izmeni</button>
        </div>
    </div>
</form>
@endsection

@section('custom-js')
<script src="{{ asset('star_admin/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('star_admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script>

$(function() {
    var kompanije_select2 = $("#kompanija_id").select2();
});

$(document).on('click', '#unesi', function(e) {
    let valid = true;
    let elements = [
        // $('#naziv'),
        // $('#naziv_pun'),
        // $('#pib'),
        // $('#mbr'),
        // $('#adresa'),
        // $('#email'),
        // $('#telefon')
    ];

    for (const element of elements) {
        element.removeClass('is-invalid');
        if (element.val() == '') {
            element.addClass('is-invalid');
            valid = false;
        }
    }

    if (!valid) {
        e.preventDefault();
    }
});
</script>
@endsection