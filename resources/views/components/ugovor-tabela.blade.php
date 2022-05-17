<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista ugovora</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    {{-- <th>Štampaj</th> --}}
                    <th>Izmeni</th>
                    <th>Kompanija</th>
                    <th>Broj</th>
                    <th>Početak</th>
                    <th>Kraj</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ugovori as $ugovor)
                        <tr>
                          <td><a href="{{ route('cms.ugovor.edit', $ugovor) }}" class="btn btn-sm btn-primary">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                          <td>{!! $ugovor->kompanija->naziv !!}</td>
                          <td>{!! $ugovor->broj_ugovora !!}</td>
                          <td>{!! $ugovor->pocetak ? date('d.m.Y.', strtotime($ugovor->pocetak)) : '-' !!}</td>
                          <td>{!! $ugovor->kraj ? date('d.m.Y.', strtotime($ugovor->kraj)) : '-' !!}</td>
                          <td>{!! $ugovor->id !!}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>