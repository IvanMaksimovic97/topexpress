<div>
    <div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lista korisnika</h4>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th>Izmeni</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Email</th>
                        <th>Pristup</th>
                        <th>Aktivan</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($korisnici as $korisnik)
                            <tr>
                              <td><a href="{{ route('cms.korisnik.edit', $korisnik) }}" class="btn btn-sm btn-primary">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                              <td>{!! $korisnik->ime !!}</td>
                              <td>{!! $korisnik->prezime !!}</td>
                              <td>{!! $korisnik->email !!}</td>
                              <td>{!! $korisnik->pristup == '2' ? 'KORISNIK' : 'TOP EXPRESS KORISNIK' !!}</td>
                              <td>{!! $korisnik->status ? 'AKTIVAN' : 'NEAKTIVAN' !!}</td>
                              <td>{!! $korisnik->id !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>