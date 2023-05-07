<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista firmi</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    {{-- <th>Štampaj</th> --}}
                    <th>Izmeni</th>
                    <th>Naziv</th>
                    <th>Pun naziv</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Vlasnik</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($kompanije as $kompanija)
                        <tr>
                          <td><a href="{{ route('cms.kompanija.edit', $kompanija) }}" class="btn btn-sm btn-primary">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                          <td>{!! $kompanija->naziv !!}</td>
                          <td>{!! $kompanija->naziv_pun !!}</td>
                          <td>{!! $kompanija->email !!}</td>
                          <td>{!! $kompanija->telefon !!}</td>
                          <td>{!! $kompanija->vlasnikNaziv() !!}</td>
                          <td>{!! $kompanija->id !!}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>