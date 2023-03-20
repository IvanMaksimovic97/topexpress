@extends('template.app')
@section('title', 'Top Express | Posiljke')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="{!! $routeFilters !!}">
                <div class="input-group">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">Broj</h4>
                            <input type="text" class="form-control form-control-sm" value="{!! request()->search !!}" name="search" placeholder="Pretraga po broju pošiljke">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Pošiljalac</h4>
                            <input type="text" class="form-control form-control-sm" value="{!! request()->search_po !!}" name="search_po" placeholder="Pretraga po broju pošiljaocu">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Primalac</h4>
                            <input type="text" class="form-control form-control-sm" value="{!! request()->search_pr !!}" name="search_pr" placeholder="Pretraga po broju primaocu">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Datum od</h4>
                            <input type="date" class="form-control form-control-sm" value="{!! date('Y-m-d', strtotime(request()->date_from ?? now())) !!}" name="date_from" id="date_from" placeholder="datum od">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Datum do</h4>
                            <input type="date" class="form-control form-control-sm" value="{!! date('Y-m-d', strtotime(request()->date_to ?? now())) !!}" name="date_to" id="date_to" placeholder="datum do">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Način plaćanja</h4>
                            <select class="form-control form-control-sm" name="nacin_placanja_id" id="nacin_placanja_id">
                                <option value="-1">Izaberi</option>
                                @foreach ($nacini_placanja as $item)
                                    <option value="{{ $item->id }}" @if($item->id == request()->nacin_placanja_id) selected @endif>{{ $item->naziv }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Status</h4>
                            <select class="form-control form-control-sm" name="status_posiljke" id="status_posiljke">
                                <option value="-2">Izaberi</option>
                                <option value="-1" @if(request()->status_posiljke == '-1') selected @endif>U pripremi</option>
                                <option value="0" @if(request()->status_posiljke == '0') selected @endif>Primljena</option>
                                <option value="1" @if(request()->status_posiljke == '1') selected @endif>Na dostavi</option>
                                <option value="2" @if(request()->status_posiljke == '2') selected @endif>Uručena</option>
                                <option value="3" @if(request()->status_posiljke == '3') selected @endif>Vraćena</option>
                                <option value="4" @if(request()->status_posiljke == '4') selected @endif>Za narednu dostavu</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-primary" type="submit">Pretraži</button>
                    <a href="{!! $routeFilters !!}" class="btn btn-sm btn-primary">Resetuj</a>
                    <button type="button" class="btn btn-sm btn-primary" id="ponisti-datum">Poništi datum</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(Route::currentRouteName() == 'cms.posiljke-eksterne')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('cms.posiljka-import-multiple') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" id="posiljka-div">
                        <label>Primi pošiljke</label>
                        <select class="js-example-basic-single w-100" name="posiljke[]" id="posiljke" multiple="multiple">
                            {{-- <option value="0">Izaberi</option> --}}
                            @foreach ($posiljke as $posiljka)
                                <option value="{{ $posiljka->id }}">{{ $posiljka->broj_posiljke }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">Primi pošiljke</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<x-posiljka-tabela :posiljke="$posiljke" :posiljkePoPosiljaocu="$posiljkePoPosiljaocu"></x-posiljka-tabela>
@endsection

@section('custom-js')
<script src="{{ asset('star_admin/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('star_admin/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script>
@if(Route::currentRouteName() == 'cms.posiljke-eksterne')
$(function () {
    var posiljke = $("#posiljke").select2();
});
@endif

$(document).on('click', '#ponisti-datum', function(e) {
    $('#datum').val('');
});
</script>
@endsection