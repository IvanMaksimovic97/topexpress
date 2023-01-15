@extends('template.site')
@section('title', 'TOP EXPRESS 2022 d.o.o.')

@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>
@endsection

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
            <form action="{{ route('posiljka-update-site', $posiljka->id) }}" method="POST">
                @csrf
                <div class="row">
                    @include('site.authorized._form_nova_posiljka')
                    <div class="col-md-4 mt-4">
                        <button type="submit" id="unesi" class="btn btn-danger mb-2">Unesi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection

@section('custom-js')
<script src="{{ asset('star_admin/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('star_admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>   
{{-- <script src="{{ asset('star_admin/js/typeahead.js') }}"></script> --}}
<script>
var autocompleteInit = function (element_id, hidden_id, data, name_to_show) {
    $(element_id).autocomplete({
        minLength: 1,
        source: function (request, response) {
            response($.map(data, function (obj, key) {
                
                var name = obj[name_to_show].toUpperCase();
                
                if (name.indexOf(request.term.toUpperCase()) != -1) {			
                    return {
                        label: obj[name_to_show], // Label for Display
                        value: obj.id, // Value
                        obj: obj // Element
                    }
                } else {
                    return null;
                }
            }));			
        },    
        focus: function(event, ui) {
            event.preventDefault();
        },
        // Once a value in the drop down list is selected, do the following:
        select: function(event, ui) {
            event.preventDefault();
            
            $(element_id).val(ui.item.label);
            $(hidden_id).val(ui.item.value);

            if (element_id == '#po_naziv' || element_id == '#pr_naziv') {
                let p_type = '';
                if (element_id == '#po_naziv') {
                    p_type = 'po';
                } else {
                    p_type = 'pr';
                }

                $(`#${p_type}_naselje`).val(ui.item.obj.naselje);
                $(`#${p_type}_naselje_id`).val(ui.item.obj.naselje_id);
                $(`#${p_type}_ulica`).val(ui.item.obj.ulica);
                $(`#${p_type}_ulica_id`).val(ui.item.obj.ulica_id);
                $(`#${p_type}_broj`).val(ui.item.obj.broj);
                $(`#${p_type}_podbroj`).val(ui.item.obj.podbroj);
                $(`#${p_type}_sprat`).val(ui.item.obj.sprat);
                $(`#${p_type}_stan`).val(ui.item.obj.stan);
                $(`#${p_type}_napomena`).val(ui.item.obj.napomena);
                $(`#${p_type}_kontakt_osoba`).val(ui.item.obj.kontakt_osoba);
                $(`#${p_type}_kontakt_telefon`).val(ui.item.obj.kontakt_telefon);
                $(`#${p_type}_email`).val(ui.item.obj.email);
            }
        }
    });
}

var firme = JSON.parse('{!! $kompanije !!}');
var ulice = JSON.parse('{!! $ulice !!}');
var naselja = JSON.parse('{!! $naselja !!}');
var primalacPosiljalac = JSON.parse('{!! $primalacPosiljalac !!}');
var racuni = JSON.parse('{!! $racuni !!}');
var ugovori = JSON.parse('{!! $ugovori !!}');
const posiljka_id = {!! $posiljka->id !!};

$(function () {
    var vrsta_usluge_select2 = $("#vrsta-usluge").select2();
    var nacin_placanja_select2 = $("#nacin-placanja").select2();

    autocompleteInit('#firma', '#firma_id', ugovori, 'naslov');
    autocompleteInit('#po_naziv', '#posiljalac_id', primalacPosiljalac, 'naziv');
    autocompleteInit('#pr_naziv', '#primalac_id', primalacPosiljalac, 'naziv');
    autocompleteInit('#po_naselje', '#po_naselje_id', naselja, 'naziv');
    autocompleteInit('#pr_naselje', '#pr_naselje_id', naselja, 'naziv');
    autocompleteInit('#po_ulica', '#po_ulica_id', ulice, 'naziv');
    autocompleteInit('#pr_ulica', '#pr_ulica_id', ulice, 'naziv');
    autocompleteInit('#broj_racuna', '#racun_id', racuni, 'broj_racuna');
});

$(document).on('input', '#firma', function (e) {
    $('#firma_id').val('');
});

$(document).on('input', '#po_naziv', function (e) {
    $('#posiljalac_id').val('');
});

$(document).on('input', '#pr_naziv', function (e) {
    $('#primalac_id').val('');
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

$(document).on('input', '#otkupnina', function (e) {
    $('#vrednost').val($(this).val());

    let vrednost_val = parseFloat($('#vrednost').val());
    let otkupnina = $(this);

    if (isNaN(vrednost_val)) {
        vrednost_val = 0;
    }

    otkupnina.removeClass('is-invalid');
    
    if (parseFloat(otkupnina.val()) > vrednost_val) {
        otkupnina.addClass('is-invalid');
    }
});

const brojRegex = /^\d{6}$/;
var brojJeValidan = true;
var brojNevalidanPoruka = '';

function validacijaBrojaPosiljke(element)
{
    brojJeValidan = false;

    $('#broj_posiljke-invalid-text').html('');
    $(element).removeClass('is-invalid');

    if (brojRegex.test(element.val())) {
        $.ajax({
            url: '{{ route('broj-posiljke-validacija') }}' + '/' + element.val(),
            method: 'get',
            success: function (data) {
                if (data) {
                    if (data.id != posiljka_id) {
                        $('#broj_posiljke-invalid-text').html('Pošiljka sa unetim brojem već postoji!');
                        $(element).addClass('is-invalid');

                        brojNevalidanPoruka = 'Pošiljka sa unetim brojem već postoji!';
                        brojJeValidan = false;
                    } else {
                        brojJeValidan = true;
                    }
                } else {
                    brojJeValidan = true;
                }
            }
        });
    } else {
        $('#broj_posiljke-invalid-text').html('Neispravan format broja pošiljke!');
        $(element).addClass('is-invalid');

        brojNevalidanPoruka = 'Neispravan format broja pošiljke!';
        brojJeValidan = false;
    }
}

$(document).on('input', '#broj_posiljke', function (e) {
    validacijaBrojaPosiljke($(this));
});

$(document).on('change', '#vrsta-usluge', function () {
    if (this.value == '-1') {
        $('#masa').attr('disabled', 'disabled');
    } else {
        $('#masa').removeAttr('disabled');
    }
});

$(document).on('change', '#nacin-placanja', function(e) {
    const value = this.value;

    if (value != 2 && value != 4 && value != 5) {
        $('#firma_id').val('');
        $('#firma').val('');
        $('#blok-za-firmu').addClass('d-none');
    } else {
        $('#blok-za-firmu').removeClass('d-none');
    }
});

var racunRequired = false;

$(document).on('click', '.radio-uplata', function () {
    if (this.id == 'nalog-za-uplatu') {
        $('#broj_racuna').removeClass('d-none');
        $('#broj_racuna').removeClass('is-invalid');
        $('#broj_racuna').attr('required', '');
        racunRequired = true;
    } else {
        $('#broj_racuna').addClass('d-none');
        $('#broj_racuna').removeAttr('required');
        racunRequired = false;
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
        racunRequired = true;
    } else {
        $('#otkupnina').attr('disabled', 'disabled');
        $('#otkupnina').val('');
        $('#nalog-za-uplatu').attr('disabled', 'disabled');
        $('#nalog-za-uplatu').attr('checked', false);
        $('#postanska-uputnica').attr('disabled', 'disabled');
        $('#postanska-uputnica').attr('checked', false);
        $('#postnet-uputnica').attr('disabled', 'disabled');
        $('#postnet-uputnica').attr('checked', false);
        racunRequired = false;
        $('#broj_racuna').addClass('d-none');
        $('#broj_racuna').removeAttr('required');
    }
});

$(document).on('click', '#postarina-izracunaj', function(e) {
    
    let route = '{{ route('cena-postarine', ["#vrsta#", "#masa#", "#ugovor#"]) }}';
    let masa = parseFloat($('#masa').val());
    let id_vrsta = $('#vrsta-usluge').val();
    let id_ugovor = $('#firma_id').val() != '' ? $('#firma_id').val() : -1;

    route = route.replace('#vrsta#', id_vrsta);
    route = route.replace('#masa#', masa);
    route = route.replace('#ugovor#', id_ugovor);

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

$(document).on('click', '#rucni-unos', function (e) {
    if (this.checked) {
        $('#postarina').removeAttr('disabled');
    } else {
        $('#postarina').attr('disabled', 'disabled');
    }
});

$(document).on('click', '#unesi', function(e) {
    $('#sadrzina').css('border-color', '#dee2e6');
    $('#otkupnina').removeClass('is-invalid');

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
        $('#po_kontakt_telefon'),
        $('#pr_kontakt_telefon'),
        $('#masa')
    ];

    if (racunRequired) {
        elements.push($('#broj_racuna'));
    }

    if ($('#vrsta-usluge').val() == '') {
        $('#vrsta-usluge').data('select2').$container.addClass('is-invalid');
    }

    for (const element of elements) {
        element.removeClass('is-invalid');
        if (element.val() == '') {
            element.addClass('is-invalid');
            valid = false;
        }
    }

    if ($('#sadrzina').val() == '') {
        $('#sadrzina').css('border-color', '#dc3545');
        valid = false;
    }

    if (!brojJeValidan) {
        $('#broj_posiljke-invalid-text').html(brojNevalidanPoruka);
        $('#broj_posiljke').addClass('is-invalid');
        valid = false;
    }

    let vrednost = $('#vrednost');
    let otkupnina = $('#otkupnina');

    let vrednost_val = parseFloat(vrednost.val());
    let otkupnina_val = parseFloat(otkupnina.val());

    if (isNaN(vrednost_val)) {
        vrednost_val = 0;
    }

    if (otkupnina_val > vrednost_val) {
        otkupnina.addClass('is-invalid');
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
    }
});
</script>
@endsection