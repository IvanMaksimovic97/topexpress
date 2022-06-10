<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista radnika</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    {{-- <th>Štampaj</th> --}}
                    <th>Izmeni</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>JMBG</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($radnici as $radnik)
                        <tr>
                          <td><a href="{{ route('cms.radnik.edit', $radnik) }}" class="btn btn-sm btn-primary">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                          <td>{!! $radnik->ime !!}</td>
                          <td>{!! $radnik->prezime !!}</td>
                          <td>{!! $radnik->jmbg !!}</td>
                          <td>{!! $radnik->email !!}</td>
                          <td>{!! $radnik->telefon !!}</td>
                          <td>{!! $radnik->id !!}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>