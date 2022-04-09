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
            <h4 class="card-title">Pretraga</h4>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" value="{!! request()->search !!}" name="search" placeholder="Pretraga po broju pošiljke">
                    {{-- <input type="date" class="form-control" value="{!! date('Y-m-d', strtotime(request()->date ?? now())) !!}" name="date" placeholder="datum"> --}}
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="submit">Pretraži</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<x-posiljka-tabela :posiljke="$posiljke"></x-posiljka-tabela>
@endsection
