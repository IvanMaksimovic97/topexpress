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
            <button type="submit" id="unesi" class="btn btn-primary mb-2">Unesi</button>
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

var pr_naselja_typeahead;
var pr_naselje_typeahead;

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
            firme_typeahead = [];
            firma_typeahead = {};
        
            $.each(firme, function (i, item) {
                firma_typeahead[item.naziv] = item;
                firme_typeahead.push(item.naziv);
            });
        
            process(firme_typeahead);
        }
    });

    $('#posiljalac_div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'posiljaoci',
        source: function (query, process) {
            posiljaoci = [];
            posiljalac = {};
        
            $.each(primalacPosiljalac, function (i, item) {
                posiljalac[item.naziv] = item;
                posiljaoci.push(item.naziv);
            });
        
            process(posiljaoci);
        }
    });

    $('#primalac_div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'primaoci',
        source: function (query, process) {
            primaoci = [];
            primalac = {};
        
            $.each(primalacPosiljalac, function (i, item) {
                primalac[item.naziv] = item;
                primaoci.push(item.naziv);
            });
        
            process(primaoci);
        }
    });

    $('#po_naselje_div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'po_naselja',
        source: function (query, process) {
            po_naselja_typeahead = [];
            po_naselje_typeahead = {};
        
            $.each(naselja, function (i, item) {
                po_naselje_typeahead[item.naziv] = item;
                po_naselja_typeahead.push(item.naziv);
            });
        
            process(po_naselja_typeahead);
        }
    });

    $('#pr_naselje_div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'pr_naselja',
        source: function (query, process) {
            pr_naselja_typeahead = [];
            pr_naselje_typeahead = {};
        
            $.each(naselja, function (i, item) {
                pr_naselje_typeahead[item.naziv] = item;
                pr_naselja_typeahead.push(item.naziv);
            });
        
            process(pr_naselja_typeahead);
        }
    });

    $('#po_ulica_div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'po_ulica',
        source: function (query, process) {
            po_ulice_typeahead = [];
            po_ulica_typeahead = {};
        
            $.each(ulice, function (i, item) {
                po_ulica_typeahead[item.naziv] = item;
                po_ulice_typeahead.push(item.naziv);
            });
        
            process(po_ulice_typeahead);
        }
    });

    $('#pr_ulica_div .form-control').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'pr_ulica',
        source: function (query, process) {
            pr_ulice_typeahead = [];
            pr_ulica_typeahead = {};
        
            $.each(ulice, function (i, item) {
                pr_ulica_typeahead[item.naziv] = item;
                pr_ulice_typeahead.push(item.naziv);
            });
        
            process(pr_ulice_typeahead);
        }
    });

    $('#firma').bind('typeahead:select', function (ev, suggestion) {
        let item = firma_typeahead[suggestion];
        $('#firma_id').val(item.id);
    });

    $('#po_naziv').bind('typeahead:select', function (ev, suggestion) {
        let item = posiljalac[suggestion];

        $('#posiljalac_id').val(item.id);
        $('#po_naselje').val(item.naselje);
        $('#po_naselje_id').val(item.naselje_id);
        $('#po_ulica').val(item.ulica);
        $('#po_ulica_id').val(item.ulica_id);
        $('#po_broj').val(item.broj);
        $('#po_podbroj').val(item.podbroj);
        $('#po_sprat').val(item.sprat);
        $('#po_stan').val(item.stan);
        $('#po_napomena').val(item.napomena);
        $('#po_kontakt_osoba').val(item.kontakt_osoba);
        $('#po_kontakt_telefon').val(item.kontakt_telefon);
        $('#po_email').val(item.email);
    });

    $('#pr_naziv').bind('typeahead:select', function (ev, suggestion) {
        let item = primalac[suggestion];
        
        $('#primalac_id').val(item.id);
        $('#pr_naselje').val(item.naselje);
        $('#pr_naselje_id').val(item.naselje_id);
        $('#pr_ulica').val(item.ulica);
        $('#pr_ulica_id').val(item.ulica_id);
        $('#pr_broj').val(item.broj);
        $('#pr_podbroj').val(item.podbroj);
        $('#pr_sprat').val(item.sprat);
        $('#pr_stan').val(item.stan);
        $('#pr_napomena').val(item.napomena);
        $('#pr_kontakt_osoba').val(item.kontakt_osoba);
        $('#pr_kontakt_telefon').val(item.kontakt_telefon);
        $('#pr_email').val(item.email);
    });

    $('#po_naselje').bind('typeahead:select', function (ev, suggestion) {
        let item = po_naselje_typeahead[suggestion];
        $('#po_naselje_id').val(item.id);
    });

    $('#pr_naselje').bind('typeahead:select', function (ev, suggestion) {
        let item = pr_naselje_typeahead[suggestion];
        $('#pr_naselje_id').val(item.id);
    });

    $('#po_ulica').bind('typeahead:select', function (ev, suggestion) {
        let item = po_ulica_typeahead[suggestion];
        $('#po_ulica_id').val(item.id);
    });

    $('#pr_ulica').bind('typeahead:select', function (ev, suggestion) {
        let item = pr_ulica_typeahead[suggestion];
        $('#pr_ulica_id').val(item.id);
    });
});

$(document).on('input', '#firma', function (e) {
    $('#firma_id').val('');
});

$(document).on('input', '#po_naziv', function (e) {
    $('#po_naziv_id').val('');
});

$(document).on('input', '#pr_naziv', function (e) {
    $('#pr_naziv_id').val('');
});

$(document).on('input', '#po_naselje', function (e) {
    $('#po_naselje_id').val('');
});

$(document).on('input', '#pr_naselje', function (e) {
    $('#pr_naselje_id').val('');
});

$(document).on('input', '#po_ulica', function (e) {
    $('#po_ulica_id').val('');
});

$(document).on('input', '#pr_ulica', function (e) {
    $('#pr_ulica_id').val('');
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
});

$(document).on('click', '#unesi', function(e) {
    let valid = true;
    let elements = [
        $('#vrsta-usluge'),
        $('#nacin-placanja'),
        $('#broj_posiljke'),
        $('#po_naziv'),
        $('#po_naselje'),
        $('#po_ulica'),
        $('#pr_naziv'),
        $('#pr_naselje'),
        $('#pr_ulica'),
        $('#masa')
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