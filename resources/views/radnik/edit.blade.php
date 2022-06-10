@extends('template.app')
@section('title', 'Top Express | Izmena radnika')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('star_admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection

@section('content')
<form action="{{ route('cms.radnik.update', $radnik) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        @include('radnik._form')
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