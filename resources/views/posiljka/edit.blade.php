@extends('template.app')
@section('title', 'Top Express | Izmena')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"/>
@endsection
@section('content')
<form action="{{ route('cms.posiljka.update', $posiljka) }}" method="POST">
    @csrf
    <div class="row">
        @include('posiljka._form')
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">ISTORIJA POŠILJKE</h4>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th>Štampaj</th>
                        {{-- <th>Pošiljke</th> --}}
                        <th>Izmeni</th>
                        <th>Status pošiljke</th>
                        <th>Status spiska</th>
                        <th>Broj spiska</th>
                        <th>Zaduženi radnik</th>
                        <th>Broj pošiljki</th>
                        <th>Za naplatu</th>
                        <th>Za datum</th>
                        <th>Datum unosa</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $brojRazduzenih = 0;
                        $iznos = 0;
                        $rowColor = '';
                      @endphp
                        @foreach ($spisak as $stavka)
                        @php
                          if ($stavka->dostava->status) {
                            $iznos += $stavka->dostava->za_naplatu;
                            $brojRazduzenih++;
                          }

                          switch ($stavka->status) {
                          case 2:
                            $rowColor = 'table-success';
                            break;
                          case 3:
                            $rowColor = 'table-danger';
                            break;
                          case 4:
                            $rowColor = 'table-info';
                            break;
                          default:
                            # code...
                            break;
                        }
                        @endphp
                            <tr class="{!! $rowColor !!}">
                                <td><a href="{{ route('cms.dostava.show', $stavka->dostava) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></th>
                                {{-- <td>
                                    <button class="btn btn-sm btn-secondary prikazi" data-id="{{ $stavka->id }}">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        Prikaži
                                    </button>
                                </td> --}}
                                <td><a href="{{ route('cms.dostava.edit', $stavka->dostava) }}" class="btn btn-sm btn-danger">Izmeni</a></td>
                                <td>
                                    <select class="posiljka-status" data-id="{!! $stavka->id !!}" data-spisakid="{!! $stavka->dostava->id !!}" disabled="disabled">
                                      <option value="0" @if($stavka->status == 0) selected @endif>Primljena</option>
                                      <option value="1" @if($stavka->status == 1) selected @endif>Na dostavi</option>
                                      <option value="2" @if($stavka->status == 2) selected @endif>Uručena</option>
                                      <option value="3" @if($stavka->status == 3) selected @endif>Vraćena</option>
                                      <option value="4" @if($stavka->status == 4) selected @endif>Za narednu dostavu</option>
                                    </select>
                                  </td>
                                <td>{!! $stavka->dostava->status ? 'Razdužen' : 'Zadužen' !!}</td>
                                <td>{!! $stavka->dostava->broj_spiska !!}</td>
                                <td>{!! $stavka->dostava->radnik !!}</td>
                                <td>{!! $stavka->dostava->stavke->count() !!}</td>
                                <td>{!! $stavka->dostava->za_naplatu !!} RSD</td>
                                <td>{!! date('d.m.Y.', strtotime($stavka->dostava->za_datum)) !!}</td>
                                <td>{!! date('d.m.Y. H:i:s', strtotime($stavka->dostava->created_at)) !!}</td>
                                <td>{!! $stavka->dostava->id !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            
            {{-- <button type="submit" id="unesi" class="btn btn-primary mb-2">Izmeni</button> --}}
        </div>
    </div>
</form>
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

const brojRegex = /^TE\d{6}BG$/;
var brojJeValidan = false;
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
                if (data == '1') {
                    $('#broj_posiljke-invalid-text').html('Pošiljka sa unetim brojem već postoji!');
                    $(element).addClass('is-invalid');

                    brojNevalidanPoruka = 'Pošiljka sa unetim brojem već postoji!';
                    brojJeValidan = false;
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