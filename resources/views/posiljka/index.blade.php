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
                            <input type="text" class="form-control" value="{!! request()->search !!}" name="search" placeholder="Pretraga po broju pošiljke">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Pošiljalac</h4>
                            <input type="text" class="form-control" value="{!! request()->search_po !!}" name="search_po" placeholder="Pretraga po broju pošiljaocu">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Primalac</h4>
                            <input type="text" class="form-control" value="{!! request()->search_pr !!}" name="search_pr" placeholder="Pretraga po broju primaocu">
                        </div>
                        <div class="col">
                            <h4 class="card-title">Datum</h4>
                            <input type="date" class="form-control" value="{!! request()->date ? date('Y-m-d', strtotime(request()->date)) : '' !!}" name="date" id="datum" placeholder="datum">
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