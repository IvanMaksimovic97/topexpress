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
            <form action="">
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
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-primary" type="submit">Pretraži</button>
                    <a href="{{ route('cms.posiljka.index') }}" class="btn btn-sm btn-primary">Resetuj</a>
                    <button type="button" class="btn btn-sm btn-primary" id="ponisti-datum">Poništi datum</button>
                </div>
            </form>
        </div>
    </div>
</div>
<x-posiljka-tabela :posiljke="$posiljke"></x-posiljka-tabela>
@endsection

@section('custom-js')
<script>
$(document).on('click', '#ponisti-datum', function(e) {
    $('#datum').val('');
});
</script>
@endsection