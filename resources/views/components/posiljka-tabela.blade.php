<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista pošiljaka</h4>
            <div class="table-responsive pt-3">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Štampaj</th>
                    <th>Izmeni</th>
                    <th>Status pošiljke</th>
                    <th>Broj pošiljke</th>
                    <th>Datum prijema</th>
                    <th>Vrsta usluge</th>
                    <th>Način plaćanja</th>
                    <th>Pošiljalac</th>
                    <th>Primalac</th>
                    <th>Adresa</th>
                    <th>Masa</th>
                    <th>Ima vrednost</th>
                    <th>Vrednost</th>
                    <th>Ima otkupninu</th>
                    <th>Otkupnina</th>
                    <th>Otkupnina vrsta</th>
                    <th>Poštarina</th>
                    <th>Povratnica</th>
                    <th>Lično preuzimanje</th>
                    <th>Firma</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $brojUrucenih = 0;
                    $brojVracenih = 0;
                    $brojZaNarednu = 0;
                    $iznos = 0;
                    $postarina = 0;
                  @endphp
                    @foreach ($posiljke as $posiljka)
                      @php
                        
                        $rowColor = '';
                        switch ($posiljka->status) {
                          case 1:
                            $rowColor = 'table-success';
                            $iznos += $posiljka->otkupnina;
                            $postarina += $posiljka->postarina;
                            $brojUrucenih++;
                            break;
                          case 2:
                            $rowColor = 'table-danger';
                            $brojVracenih++;
                            break;
                          case 3:
                            $rowColor = 'table-info';
                            $brojZaNarednu++;
                            break;
                          default:
                            # code...
                            break;
                        }
                      @endphp
                        <tr @if($rowColor != '') class="{{ $rowColor }}" @endif>
                            <td><a href="{{ route('cms.posiljka.show', $posiljka) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td>
                            <td><a href="{{ route('cms.posiljka.edit', $posiljka) }}" class="btn btn-sm btn-danger">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                            <td>
                              <select class="posiljka-status" data-id="{!! $posiljka->id !!}" @if($posiljka->status == 1)  @endif>
                                <option value="0" @if($posiljka->status == 0) selected @endif>Nije uručena</option>
                                <option value="1" @if($posiljka->status == 1) selected @endif>Uručena</option>
                                <option value="2" @if($posiljka->status == 2) selected @endif>Vraćena</option>
                                <option value="3" @if($posiljka->status == 3) selected @endif>Za narednu dostavu</option>
                              </select>
                            </td>
                            <td>{!! $posiljka->broj_posiljke !!}</td>
                            <td>{!! date('d.m.Y. H:i:s', strtotime($posiljka->created_at)) !!}</td>
                            <td>{!! $posiljka->vrstaUsluge->naziv !!}</td>
                            <td>{!! $posiljka->nacinPlacanja->naziv !!}</td>
                            <td>{!! $posiljka->posiljalac->naziv !!}</td>
                            <td>{!! $posiljka->primalac->naziv !!}</td>
                            <td>{!! $posiljka->primalac->ulica.' br. '.$posiljka->primalac->broj !!}{!! $posiljka->primalac->stan ? '/'.$posiljka->primalac->stan : '' !!}</td>
                            <td>{!! $posiljka->masa_kg !!} kg</td>
                            <td>{!! $posiljka->ima_vrednost ? 'Da' : 'Ne' !!}</td>
                            <td>{!! $posiljka->vrednost !!}</td>
                            <td>{!! $posiljka->ima_otkupninu ? 'Da' : 'Ne' !!}</td>
                            <td>{!! $posiljka->otkupnina !!}</td>
                            <td>{!! $posiljka->otkupnina_vrsta !!}</td>
                            <td>{!! $posiljka->postarina !!}</td>
                            <td>{!! $posiljka->povratnica ? 'Da' : 'Ne' !!}</td>
                            <td>{!! $posiljka->licno_preuzimanje ? 'Da' : 'Ne' !!}</td>
                            <td>{!! $posiljka->firma ? $posiljka->firma->naziv : '' !!}</td>
                            <td>{!! $posiljka->id !!}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    @if ($dostava)
      @if ($dostava->status)
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-0">Izveštaj</h4>
            <div class="table-responsive pt-3">
                    <div class="table-responsive">
                      <table class="table" style="white-space: nowrap!important; width: 1%!important;">
                        <thead>
                          
                        </thead>
                        <tbody>
                          <tr>
                            <th>Br. uručenih:</th>
                            <td>{{ $brojUrucenih }}</td>
                          </tr>
                          <tr>
                            <th>Br. vraćenih:</th>
                            <td>{{ $brojVracenih }}</td>
                          </tr>
                          <tr>
                            <th>Br. za narednu dostavu:</th>
                            <td>{{ $brojZaNarednu }}</td>
                          </tr>
                          <tr>
                            <th>Naplaćeno ukupno:</th>
                            <td>{{ number_format($iznos, 2) }} RSD</td>
                          </tr>
                          <tr>
                            <th>Poštarina ukupno:</th>
                            <td>{{ number_format($postarina, 2) }} RSD</td>
                          </tr>
                          <tr>
                            <th>UKUPNO:</th>
                            <th>{{ number_format($postarina + $iznos, 2) }} RSD</th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-0">Izveštaj po pošiljaocu</h4>
          <div class="table-responsive pt-3">
                  <div class="table-responsive">
                    <table class="table" style="white-space: nowrap!important; width: 1%!important;">
                      <thead>
                        <tr>
                          <th>Ime i prezime</th>
                          <th>NALOG iznos</th>
                          <th>UPUTNICA iznos</th>
                          <th>UKUPAN iznos</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($posiljaociIzvestaj as $posiljaocItem)
                          <tr>
                            <td>{{ $posiljaocItem['naziv'] }}</td>
                            <td>{{ number_format($posiljaocItem['nalog_iznos'], 2) }} rsd</td>
                            <td>{{ number_format($posiljaocItem['uputnica_iznos'], 2) }} rsd</td>
                            <td>{{ number_format($posiljaocItem['ukupan_iznos'], 2) }} rsd</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
          </div>
        </div>
      </div>
  </div>
      @endif
    @endif

</div>