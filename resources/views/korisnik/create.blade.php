@extends('template.app')
@section('title', 'Top Express | Unos korisnika')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>
@endsection

@section('content')
<form action="{{ route('cms.korisnik.store') }}" method="POST">
    @csrf
    <div class="row">
        @include('korisnik._form')
        <div class="col-md-4">
            <button type="submit" id="unesi" class="btn btn-primary mb-2">Unesi</button>
        </div>
    </div>
</form>
@endsection

@section('custom-js')
<script src="{{ asset('star_admin/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('star_admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
$(function() {
    var naselje_id = $("#naselje_id").select2();
    var ulica_id = $("#ulica_id").select2();
});
</script>
@endsection