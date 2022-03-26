@extends('template.app')
@section('title', 'Top Express | Prijem')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
<form action="{{ route('cms.dostava.store') }}" method="POST">
    @csrf
    <div class="row">
        @include('dostava._form')
        <div id="posiljke-render"></div>
        <div class="col-md-4">
            <button type="submit" id="unesi" class="btn btn-primary mb-2">Unesi</button>
        </div>
    </div>
</form>
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
        url: '{{ route('cms.posiljke') }}' + '/' + posiljke_ids,
        method: 'get',
        success: function (data) {
            $('#posiljke-render').html(data);
        }
    })
});
</script>
@endsection