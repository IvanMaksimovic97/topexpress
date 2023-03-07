<div>
  <div class="modal fade" id="izvestajiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Izvestaji</h5>
          <button type="button" class="close"  onclick="$('#izvestajiModal').modal('hide');">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <h4 class="card-title">Pošiljke na dostavi: {{ $posiljke->where('status_po_spisku', 1)->count() }}</h4>
              <h4 class="card-title">Vraćene pošiljke: {{ $posiljke->where('status_po_spisku', 3)->count() }}</h4>
              <h4 class="card-title">Za narednu dostavu pošiljke: {{ $posiljke->where('status_po_spisku', 4)->count() }}</h4>
              <h4 class="card-title">Uručene pošiljke: {{ $posiljke->where('status_po_spisku', 2)->count() }}</h4>
              <hr>
            @php
                $ukupnoVrednost = (float) $posiljke->where('status_po_spisku', 2)->sum('vrednost');
                $ukupnoPostarina = (float) $posiljke->where('status_po_spisku', 2)->sum('postarina');
                $ukupno = $ukupnoVrednost + $ukupnoPostarina;

                $posiljalacGotovinskiUkupnoVrednost = (float)$posiljke->where('nacin_placanja_id', 1)->where('status_po_spisku', 2)->sum('vrednost');
                $posiljalacGotovinskiUkupnoPostarina = (float) $posiljke->where('nacin_placanja_id', 1)->where('status_po_spisku', 2)->sum('postarina');
                $posiljalacGotovinskiUkupno = $posiljalacGotovinskiUkupnoVrednost + $posiljalacGotovinskiUkupnoPostarina;

                $posiljalacFakturomUkupnoVrednost = (float) $posiljke->where('nacin_placanja_id', 2)->where('status_po_spisku', 2)->sum('vrednost');
                $posiljalacFakturomUkupnoPostarina = (float) $posiljke->where('nacin_placanja_id', 2)->where('status_po_spisku', 2)->sum('postarina');
                $posiljalacFakturomUkupno = $posiljalacFakturomUkupnoVrednost + $posiljalacFakturomUkupnoPostarina;

                $primalacGotovinskiUkupnoVrednost = (float) $posiljke->where('nacin_placanja_id', 3)->where('status_po_spisku', 2)->sum('vrednost');
                $primalacGotovinskiUkupnoPostarina = (float) $posiljke->where('nacin_placanja_id', 3)->where('status_po_spisku', 2)->sum('postarina');
                $primalacGotovinskiUkupno = $primalacGotovinskiUkupnoVrednost + $primalacGotovinskiUkupnoPostarina;

                $primalacFakturomUkupnoVrednost = (float) $posiljke->where('nacin_placanja_id', 4)->where('status_po_spisku', 2)->sum('vrednost');
                $primalacFakturomUkupnoPostarina = (float) $posiljke->where('nacin_placanja_id', 4)->where('status_po_spisku', 2)->sum('postarina');
                $primalacFakturomUkupno = $primalacFakturomUkupnoVrednost +  $primalacFakturomUkupnoPostarina;
            @endphp
            <h4 class="card-title">Pošiljalac gotovinski vrednost: {{ number_format($posiljalacGotovinskiUkupnoVrednost, 2) }}</h4>
            <h4 class="card-title">Pošiljalac gotovinski poštarina: {{ number_format($posiljalacGotovinskiUkupnoPostarina, 2) }}</h4>
            <h4 class="card-title">Pošiljalac gotovinski ukupno: {{ number_format($posiljalacGotovinskiUkupno, 2) }}</h4>
            <hr>
            <h4 class="card-title">Pošiljalac fakturom vrednost: {{ number_format($posiljalacFakturomUkupnoVrednost, 2) }}</h4>
            <h4 class="card-title">Pošiljalac fakturom poštarina: {{ number_format($posiljalacFakturomUkupnoPostarina, 2) }}</h4>
            <h4 class="card-title">Pošiljalac fakturom ukupno: {{ number_format($posiljalacFakturomUkupno, 2) }}</h4>
            <hr>
            <h4 class="card-title">Primalac gotovinski vrednost: {{ number_format($primalacGotovinskiUkupnoVrednost, 2) }}</h4>
            <h4 class="card-title">Primalac gotovinski poštarina: {{ number_format($primalacGotovinskiUkupnoPostarina, 2) }}</h4>
            <h4 class="card-title">Primalac gotovinski ukupno: {{ number_format($primalacGotovinskiUkupno, 2) }}</h4>
            <hr>
            <h4 class="card-title">Primalac fakturom vrednost: {{ number_format($primalacFakturomUkupnoVrednost, 2) }}</h4>
            <h4 class="card-title">Primalac fakturom poštarina: {{ number_format($primalacFakturomUkupnoPostarina, 2) }}</h4>
            <h4 class="card-title">Primalac fakturom ukupno: {{ number_format($primalacFakturomUkupno, 2) }}</h4>
            <hr>
            <h4 class="card-title">Ukupna poštarina: {{ number_format($ukupnoPostarina, 2) }}</h4>
            <h4 class="card-title">Ukupna vrednost: {{ number_format($ukupnoVrednost, 2) }}</h4>
            <h4 class="card-title">Ukupno: {{ number_format($ukupno, 2) }}</h4>
            @foreach ($posiljkePoPosiljaocu as $item)
                <hr>
                <p>Pošiljalac: <strong>{!! $item['ime_prezime'] !!}</strong></p>
                <p>Primljene: {!! $item['primljene']['broj'] !!} ({!! number_format($item['primljene']['iznos'], 2) !!} rsd)</p>
                <p>Uručene: {!! $item['urucene']['broj'] !!} ({!! number_format($item['urucene']['iznos'], 2) !!} rsd)</p>
                <p>Na dostavi: {!! $item['na_dostavi']['broj'] !!} ({!! number_format($item['na_dostavi']['iznos'], 2) !!} rsd)</p>
                <p>Vraćene: {!! $item['vracene']['broj'] !!} ({!! number_format($item['vracene']['iznos'], 2) !!} rsd)</p>
                <p>Za narednu: {!! $item['za_narednu']['broj'] !!} ({!! number_format($item['za_narednu']['iznos'], 2) !!} rsd)</p>
                <p>Nezadužene: {!! $item['nezaduzene']['broj'] !!} ({!! number_format($item['nezaduzene']['iznos'], 2) !!} rsd)</p>
                <p>Ukupno: {!! $item['ukupno']['broj'] !!} ({!! number_format($item['ukupno']['iznos'], 2) !!} rsd)</p>
            @endforeach
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="$('#izvestajiModal').modal('hide');">Zatvori</button>
        </div>
      </div>
    </div>
  </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Lista pošiljaka</h4>
            <button type="button" class="btn btn-primary btn-sm" onclick="$('#izvestajiModal').modal('show');" >
              Izveštaji
            </button>
            <hr>
            <h4 class="card-title">Ukupno pošiljaka: {{ $posiljke->count() }}</h4>
            @if(Route::currentRouteName() == 'cms.posiljka.index')
              <a href="{{ request()->fullUrlWithQuery(['stampajadresnice' => '1']) }}" class="btn btn-sm btn-primary">Štampaj sve adresnice  <i class="ti-printer btn-icon-append"></i></a>
            @endif
            @if(Route::currentRouteName() == 'cms.posiljka.index')
              <a href="{{ request()->fullUrlWithQuery(['stampajspisak' => '1']) }}" class="btn btn-sm btn-primary">Štampaj spisak  <i class="ti-printer btn-icon-append"></i></a>
            @endif
            <div class="table-responsive pt-3">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    @if (Route::currentRouteName() != 'cms.posiljke-stornirane')
                      <th>Štampaj</th>
                      <th>Izmeni</th>
                    @else
                      <th>Vrati</th>
                    @endif
                    <th>Status pošiljke</th>
                    @if(Route::currentRouteName() != 'cms.posiljka.index' && Route::currentRouteName() != 'cms.posiljke-stornirane')
                      <th>Vraćena</th>
                    @endif
                    <th>Broj pošiljke</th>
                    <th>Datum prijema</th>
                    <th>Vrsta usluge</th>
                    <th>Način plaćanja</th>
                    <th>Pošiljalac</th>
                    <th>Primalac</th>
                    <th>Mesto</th>
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
                    <th>Uneo</th>
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
                    $iznosGotovina = 0;
                    $iznosFaktura = 0;
                  @endphp
                    @foreach ($posiljke as $posiljka)
                      @php
                        
                        $rowColor = '';
                        switch ($posiljka->status_po_spisku) {
                          case 2:
                            $rowColor = 'table-success';
                            $iznos += $posiljka->otkupnina;
                            $postarina += $posiljka->postarina;

                            if (in_array($posiljka->nacin_placanja_id, ['1', '3'])) {
                              $iznosGotovina += $posiljka->otkupnina;
                            }

                            if (in_array($posiljka->nacin_placanja_id, ['2', '4'])) {
                              $iznosFaktura += $posiljka->otkupnina;
                            }

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
                            @if(Route::currentRouteName() != 'cms.posiljke-stornirane')
                            <td><a href="{{ route('cms.posiljka.show', $posiljka) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td>
                            <td><a href="{{ route('cms.posiljka.edit', $posiljka) }}" class="btn btn-sm btn-danger">Izmeni  <i class="mdi mdi-lead-pencil"></i></a></td>
                            @else
                            <td><a href="{{ route('cms.posiljka-restore', $posiljka->id) }}" class="btn btn-sm btn-primary">Vrati  <i class="mdi mdi-lead-pencil"></i></a></td>
                            @endif
                            @if(Route::currentRouteName() != 'cms.posiljka.index' && Route::currentRouteName() != 'cms.posiljke-stornirane')
                            <td>
                              <select class="posiljka-status" data-id="{!! $posiljka->id !!}" data-spisakid="{!! $posiljka->id_dostava !!}"
                                @if ($dostava)
                                  @if ($dostava->status && strtotime(date('Y-m-d', strtotime($dostava->created_at))) < strtotime(date('Y-m-d', strtotime('-2 days'))))
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
                            @else
                            <td>
                              @if($posiljka->status_po_spisku == '-1') U pripremi @endif
                              @if($posiljka->status_po_spisku == 0) Primljena @endif
                              @if($posiljka->status_po_spisku == 1) Na dostavi @endif
                              @if($posiljka->status_po_spisku == 2) Uručena @endif
                              @if($posiljka->status_po_spisku == 3) Vraćena @endif
                              @if($posiljka->status_po_spisku == 4) Za narednu dostavu @endif
                            </td>
                            @endif
                            <td>{!! $posiljka->broj_posiljke !!}</td>
                            <td>{!! date('d.m.Y. H:i:s', strtotime($posiljka->created_at)) !!}</td>
                            <td>{!! $posiljka->vrstaUsluge->naziv !!}</td>
                            <td>{!! $posiljka->nacinPlacanja->naziv !!}</td>
                            <td>{!! $posiljka->posiljalac->naziv !!}</td>
                            <td>{!! $posiljka->primalac->naziv !!}</td>
                            <td>{!! $posiljka->primalac->naselje !!}</td>
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
                            <td>{!! $posiljka->vlasnik ? $posiljka->vlasnik->ime.' '.$posiljka->vlasnik->prezime : '' !!}</td>
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
                            <th>Gotovina ukupno:</th>
                            <td>{{ number_format($iznosGotovina, 2) }} RSD</td>
                          </tr>
                          <tr>
                            <th>Faktura ukupno:</th>
                            <td>{{ number_format($iznosFaktura, 2) }} RSD</td>
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
                          <th>Iznos</th>
                          <th>NALOG iznos</th>
                          <th>UKUPAN iznos</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                           $iznosUkupan = 0;
                        @endphp
                        @foreach ($posiljaociIzvestaj as $p_id => $posiljaocItem)
                          @php
                            $subIterations = 0;
                          @endphp
                          @foreach ($posiljaocItem['urucene_posiljke'] as $urucena_posiljka)
                            @php
                              $iznosUkupan += (float) $urucena_posiljka->vrednost;
                              $stavka_prikaz = number_format((float) $urucena_posiljka->vrednost, 2);

                              if ($urucena_posiljka->nacin_placanja_id == 2 || $urucena_posiljka->nacin_placanja_id == 4) {
                                $iznosUkupan += (float) $urucena_posiljka->postarina;
                                $stavka_prikaz .= ' + ' . number_format((float) $urucena_posiljka->postarina, 2);
                              }
                            @endphp
                            <tr>
                              @if ($subIterations == 0)
                                <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}"><a href="{{ route('cms.posiljalac-izvestaj', [$dostava->id, $p_id]) }}" class="btn btn-sm btn-primary">Štampaj  <i class="ti-printer btn-icon-append"></i></a></td>
                                <td rowspan="{{ count($posiljaocItem['urucene_posiljke']) }}">{{ $posiljaocItem['naziv'] }}</td>
                              @endif
                              <td>{{ $urucena_posiljka->primalac->naziv }}</td>
                              <td>{{ $urucena_posiljka->broj_posiljke }}</td>
                              <td>{{ $urucena_posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? $stavka_prikaz : 0.00 }}</td>
                              <td>{{ $urucena_posiljka->otkupnina_vrsta == 'TOP EXPRESS iznos' ? $stavka_prikaz : 0.00 }}</td>
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