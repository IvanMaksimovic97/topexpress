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
                                <option value="-1" @if(request()->status_posiljke == '0') selected @endif>U pripremi</option>
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
<x-posiljka-tabela :posiljke="$posiljke" :posiljkePoPosiljaocu="$posiljkePoPosiljaocu"></x-posiljka-tabela>
@endsection

@section('custom-js')
<script>
$(document).on('click', '#ponisti-datum', function(e) {
    $('#datum').val('');
});
</script>
@endsection