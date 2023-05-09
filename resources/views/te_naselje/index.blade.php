@extends('template.app')
@section('title', 'Top Express | Naselja')
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
                    <a href="{{ route('cms.te_naselje.create') }}" class="btn btn-sm btn-primary">Dodaj naselje +</a>
                    <button class="btn btn-sm btn-primary" type="submit">Pretraži</button>
                    <a href="{{ route('cms.te_naselje.index') }}" class="btn btn-sm btn-primary">Resetuj</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Lista naselja</h4>
        <div class="table-responsive pt-3">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                {{-- <th>Štampaj</th> --}}
                <th>Izmeni</th>
                <th>Grad</th>
                <th>Opstina</th>
                <th>Naziv</th>
                <th>Poštanski broj</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($naselja as $naselje)
                    <tr>
                      <td><a href="{{ route('cms.te_naselje.edit', $naselje) }}" class="btn btn-sm btn-primary">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                      <td>{!! $naselje->grad ? $naselje->grad->naziv : '' !!}</td>
                      <td>{!! $naselje->opstina ? $naselje->opstina->naziv : '' !!}</td>
                      <td>{!! $naselje->naziv !!}</td>
                      <td>{!! $naselje->postanski_broj !!}</td>
                      <td>{!! $naselje->id !!}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
