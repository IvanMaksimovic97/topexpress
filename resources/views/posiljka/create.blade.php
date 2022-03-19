@extends('template.app')
@section('title', 'Top Express | Prijem')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
<form action="{{ route('cms.posiljka.store') }}" method="POST">
    @csrf
    <div class="row">
        @include('posiljka._form')
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary mb-2">Unesi</button>
        </div>
    </div>
</form>
@endsection

@section('custom-js')
<script src="{{ asset('star_admin/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('star_admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>

{{-- <script src="{{ asset('star_admin/js/typeahead.js') }}"></script> --}}
<script>
var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        var substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        for (var i = 0; i < strs.length; i++) {
            if (substrRegex.test(strs[i])) {
            matches.push(strs[i]);
            }
        }

        cb(matches);
    };
};

var firme = JSON.parse('{!! $kompanije !!}');
var ulice = JSON.parse('{!! $ulice !!}');
var naselja = JSON.parse('{!! $naselja !!}');
var primalacPosiljalac = JSON.parse('{!! $primalacPosiljalac !!}');

var firme_typeahead;
var firma_typeahead;

var po_ulice_typeahead;
var po_ulica_typeahead;

var pr_ulice_typeahead;
var pr_ulica_typeahead;

var po_naselja_typeahead;
var po_naselje_typeahead;

var primaoci;
var primalac;

var posiljaoci;
var posiljalac;

$(function () {
    $("#vrsta-usluge").select2();
    $("#nacin-placanja").select2();

    $('#firma-div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'firme',
        source: function (query, process) {
            kompanije = [];
            map = {};
        
            $.each(firme, function (i, item) {
                map[item.naziv] = item;
                kompanije.push(item.naziv);
            });
        
            process(kompanije);
        }
    });

    $('.korisnik-typeahead .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'korisnici',
        source: substringMatcher(korisnici)
    });

    $('.naselje-typeahead .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'naselja',
        source: substringMatcher(naselja)
    });

    $('.ulica-typeahead .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'ulica',
        source: substringMatcher(ulice)
    });

    $('#firma').bind('typeahead:select', function (ev, suggestion) {
        let item = map[suggestion];
        $('#firma_id').val(item.id);
    });
});

$(document).on('input', '#firma', function (e) {
    $('#firma_id').val('');
});

$(document).on('change', '#vrsta-usluge', function () {
    if (this.value == '-1') {
        $('#masa').attr('disabled', 'disabled');
    } else {
        $('#masa').removeAttr('disabled');
    }
});

$(document).on('click', '#ima_vrednost', function () {
    if (this.checked) {
        $('#vrednost').removeAttr('disabled');
    } else {
        $('#vrednost').attr('disabled', 'disabled');
        $('#vrednost').val('');
    }
});

$(document).on('click', '#ima_otkupninu', function () {
    if (this.checked) {
        $('#otkupnina').removeAttr('disabled');
        $('#nalog-za-uplatu').removeAttr('disabled');
        $('#postanska-uputnica').removeAttr('disabled');
        $('#postnet-uputnica').removeAttr('disabled');
    } else {
        $('#otkupnina').attr('disabled', 'disabled');
        $('#otkupnina').val('');
        $('#nalog-za-uplatu').attr('disabled', 'disabled');
        $('#nalog-za-uplatu').attr('checked', false);
        $('#postanska-uputnica').attr('disabled', 'disabled');
        $('#postanska-uputnica').attr('checked', false);
        $('#postnet-uputnica').attr('disabled', 'disabled');
        $('#postnet-uputnica').attr('checked', false);
    }
});

$(document).on('click', '#postarina-izracunaj', function(e) {
    
    let route = '{{ route('cena-postarine', ["#vrsta#", "#masa#"]) }}';
    let masa = parseFloat($('#masa').val());
    let id_vrsta = $('#vrsta-usluge').val();

    route = route.replace('#vrsta#', id_vrsta);
    route = route.replace('#masa#', masa);

    $('#masa').removeClass('is-invalid');
    
    $.ajax({
        url: route,
        method: 'get',
        success: function(cena) {
            $('#postarina').val(parseFloat(cena)+ '.00');
        },
        error: function(error) {
            $('#masa').addClass('is-invalid');
            $('#postarina').val('Greška!');
        }
    })
})
</script>
@endsection