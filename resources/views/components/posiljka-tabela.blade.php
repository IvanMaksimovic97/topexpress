<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista pošiljaka</h4>
            @if(Route::currentRouteName() == 'cms.posiljka.index')
              <a href="{{ request()->fullUrlWithQuery(['stampajadresnice' => '1']) }}" class="btn btn-sm btn-primary">Štampaj sve  <i class="ti-printer btn-icon-append"></i></a>
            @endif
            <div class="table-responsive pt-3">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th>Štampaj</th>
                    <th>Izmeni</th>
                    @if(Route::currentRouteName() != 'cms.posiljka.index')
                      <th>Status pošiljke</th>
                      <th>Vraćena</th>
                    @endif
                    <th>Broj pošiljke</th>
                    <th>Datum prijema</th>
                    <th>Vrsta usluge</th>
                    <th>Način plaćanja</th>
                    <th>Pošiljalac</th>
                    <th>Primalac</th>
                    <th>Adresa</th>
                    <th>Masa</th>
                    {{-- <th>Ima vrednost</th> --}}
                    <th>Vrednost</th>
                    {{-- <th>Ima otkupninu</th> --}}
                    <th>Otkupnina</th>
                    <th>Otkupnina vrsta</th>
                    <th>Poštarina</th>
                    {{-- <th>Povratnica</th> --}}
                    {{-- <th>Lično preuzimanje</th> --}}
                    {{-- <th>Firma</th> --}}
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
                        switch ($posiljka->status_po_spisku) {
                          case 2:
                            $rowColor = 'table-success';
                            $iznos += $posiljka->otkupnina;
                            $postarina += $posiljka->postarina;
                            $brojUrucenih++;
                            break;
                          case 3:
                            $rowColor = 'table-danger';
                            if ($posiljka->vracena_posiljka) {
                              $postarinaTMP = $posiljka->nacin_placanja_id == 3 ? $posiljka->postarina * 2 : 0;
                              $postarina += $postarinaTMP;
                            }
                            $brojVracenih++;
                            break;
                          case 4:
                            $rowColor = 'table-info';
                            if ($posiljka->vracena_posiljka) {
                              $postarinaTMP = $posiljka->nacin_placanja_id == 3 ? $posiljka->postarina * 2 : 0;
                              $postarina += $postarinaTMP;
                            }
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
                            @if(Route::currentRouteName() != 'cms.posiljka.index')
                            <td>
                              <select class="posiljka-status" data-id="{!! $posiljka->id !!}" data-spisakid="{!! $posiljka->id_dostava !!}"
                                @if ($dostava)
                                  @if ($dostava->status && strtotime(date('Y-m-d', strtotime($dostava->created_at))) != strtotime(date('Y-m-d', strtotime(now()))))
                                    disabled="disabled"
                                  @endif
                                @endif
                                @if ($posiljka->status_po_spisku != '0' && 
                                    $posiljka->status_po_spisku != '1' && 
                                    $posiljka->status_po_spisku != '2' && 
                                    $posiljka->status_po_spisku != '3' && 
                                    $posiljka->status_po_spisku != '4')
                                    disabled="disabled"
                                @endif
                                >
                                <option value="0" @if($posiljka->status_po_spisku == 0) selected @endif>Primljena</option>
                                <option value="1" @if($posiljka->status_po_spisku == 1) selected @endif>Na dostavi</option>
                                <option value="2" @if($posiljka->status_po_spisku == 2) selected @endif>Uručena</option>
                                <option value="3" @if($posiljka->status_po_spisku == 3) selected @endif>Vraćena</option>
                                <option value="4" @if($posiljka->status_po_spisku == 4) selected @endif>Za narednu dostavu</option>
                              </select>
                            </td>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox"
                                  
                                  @if ($dostava)
                                    @if ($dostava->status && strtotime(date('Y-m-d', strtotime($dostava->created_at))) != strtotime(date('Y-m-d', strtotime(now()))))
                                      disabled="disabled"
                                    @endif
                                  @endif

                                  @if($posiljka->vracena_posiljka) checked="checked" @endif value="1" class="form-check-input return" data-id="{!! $posiljka->id !!}" data-spisakid="{!! $posiljka->id_dostava !!}">
                                  @if($posiljka->vracena_posiljka && $posiljka->status_po_spisku == 3)
                                    @if($posiljka->nacin_placanja_id == 1)
                                      Iznos poštarine: 0
                                    @endif
                                    @if($posiljka->nacin_placanja_id == 3)
                                      Iznos poštarine: {{ number_format(((float) $posiljka->postarina) * 2, 2) }}
                                    @endif
                                  @endif
                                  <i class="input-helper"></i>
                                </label>
                              </div>
                            </td>
                            @endif
                            <td>{!! $posiljka->broj_posiljke !!}</td>
                            <td>{!! date('d.m.Y. H:i:s', strtotime($posiljka->created_at)) !!}</td>
                            <td>{!! $posiljka->vrstaUsluge->naziv !!}</td>
                            <td>{!! $posiljka->nacinPlacanja->naziv !!}</td>
                            <td>{!! $posiljka->posiljalac->naziv !!}</td>
                            <td>{!! $posiljka->primalac->naziv !!}</td>
                            <td>{!! $posiljka->primalac->ulica.' br. '.$posiljka->primalac->broj !!}{!! $posiljka->primalac->stan ? '/'.$posiljka->primalac->stan : '' !!}</td>
                            <td>{!! $posiljka->masa_kg !!} kg</td>
                            {{-- <td>{!! $posiljka->ima_vrednost ? 'Da' : 'Ne' !!}</td> --}}
                            <td>{!! $posiljka->vrednost !!}</td>
                            {{-- <td>{!! $posiljka->ima_otkupninu ? 'Da' : 'Ne' !!}</td> --}}
                            <td>{!! $posiljka->otkupnina !!}</td>
                            <td>{!! $posiljka->otkupnina_vrsta !!}</td>
                            <td>{!! $posiljka->postarina !!}</td>
                            {{-- <td>{!! $posiljka->povratnica ? 'Da' : 'Ne' !!}</td> --}}
                            {{-- <td>{!! $posiljka->licno_preuzimanje ? 'Da' : 'Ne' !!}</td> --}}
                            {{-- <td>{!! $posiljka->firma ? $posiljka->firma->naziv : '' !!}</td> --}}
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
                    <table class="table table-bordered table-sm" style="white-space: nowrap!important; width: 1%!important;">
                      <thead>
                        <tr>
                          <th>Štampaj</th>
                          <th>Posiljalac</th>
                          <th>Primalac</th>
                          <th>Broj pošiljke</th>
                          <th>UPUTNICA iznos</th>
                          <th>NALOG iznos</th>
                          <th>UKUPAN iznos</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($posiljaociIzvestaj as $p_id => $posiljaocItem)
                          @php
                            $subIterations = 0;
                          @endphp
                          @foreach ($posiljaocItem['urucene_posiljke'] as $urucena_posiljka)
                            <tr>
                              @if ($subIterations == 0)
                                <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}"><a href="{{ route('cms.posiljalac-izvestaj', [$dostava->id, $p_id]) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td>
                                <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}">{{ $posiljaocItem['naziv'] }}</td>
                              @endif
                              <td>{{ $urucena_posiljka->primalac->naziv }}</td>
                              <td>{{ $urucena_posiljka->broj_posiljke }}</td>
                              <td>{{ $urucena_posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? number_format((float) $urucena_posiljka->vrednost, 2) : 0.00 }}</td>
                              <td>{{ $urucena_posiljka->otkupnina_vrsta == 'TOP EXPRESS uputnica' ? number_format((float) $urucena_posiljka->vrednost, 2) : 0.00 }}</td>
                              @if ($subIterations == 0)
                                <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}">{{ number_format((float) $posiljaocItem['ukupan_iznos'], 2) }}</td>
                              @endif
                            </tr>
                            @php
                              $subIterations++;
                              if ($subIterations == count($posiljaocItem['urucene_posiljke'])) {
                                $subIterations = 0;
                              }
                            @endphp
                          @endforeach
                          {{-- <tr>
                            <td>{{ $posiljaocItem['naziv'] }}</td>
                            <td>{{ number_format($posiljaocItem['nalog_iznos'], 2) }} rsd</td>
                            <td>{{ number_format($posiljaocItem['uputnica_iznos'], 2) }} rsd</td>
                            <td>{{ number_format($posiljaocItem['ukupan_iznos'], 2) }} rsd</td>
                          </tr> --}}
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