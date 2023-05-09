@extends('template.app')
@section('title', 'Top Express | Izmena naselja')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<form action="{{ route('cms.te_naselje.update', $naselje) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        @include('te_naselje._form')
        <div class="col-md-4">
            <button type="submit" id="unesi" class="btn btn-primary mb-2">Izmeni</button>
        </div>
    </div>
</form>
@endsection

@section('custom-js')
<script>

</script>
@endsection