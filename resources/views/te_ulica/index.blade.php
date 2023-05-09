@extends('template.app')
@section('title', 'Top Express | Ulice')
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
                            <h4 class="card-title">Naziv</h4>
                            <input type="text" class="form-control" value="{!! request()->search !!}" name="search" placeholder="Pretraga">
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('cms.te_ulica.create') }}" class="btn btn-sm btn-primary">Dodaj ulicu +</a>
                    <button class="btn btn-sm btn-primary" type="submit">Pretraži</button>
                    <a href="{{ route('cms.te_ulica.index') }}" class="btn btn-sm btn-primary">Resetuj</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Lista ulica</h4>
        <div class="table-responsive pt-3">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                {{-- <th>Štampaj</th> --}}
                <th>Izmeni</th>
                <th>Naziv</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($ulice as $ulica)
                    <tr>
                      <td><a href="{{ route('cms.te_ulica.edit', $ulica) }}" class="btn btn-sm btn-primary">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                      <td>{!! $ulica->naziv !!}</td>
                      <td>{!! $ulica->id !!}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
