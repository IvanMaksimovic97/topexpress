<table>
    <thead>
        <tr>
            <th style="font-weight: bold; border:1px solid black">RB</th>
            <th style="font-weight: bold; border:1px solid black">Broj pošiljke</th>
            <th style="font-weight: bold; border:1px solid black">Status pošiljke</th>
            <th style="font-weight: bold; border:1px solid black">Datum prijema</th>
            <th style="font-weight: bold; border:1px solid black">Primalac</th>
            <th style="font-weight: bold; border:1px solid black">Mesto</th>
            <th style="font-weight: bold; border:1px solid black">Adresa</th>
            <th style="font-weight: bold; border:1px solid black">Masa</th>
            {{-- <th>Vrednost</th> --}}
            <th style="font-weight: bold; border:1px solid black">Otkupnina</th>
            <th style="font-weight: bold; border:1px solid black">Poštarina</th>
            <th style="font-weight: bold; border:1px solid black">Vrsta usluge</th>
            <th style="font-weight: bold; border:1px solid black">Način plaćanja</th>
            <th style="font-weight: bold; border:1px solid black">Opis sadržine</th>
            <th style="font-weight: bold; border:1px solid black">Lično preuzimanje</th>
            {{-- <th>Firma</th>
            <th>#</th> --}}
            <th style="font-weight: bold; border:1px solid black">Otkupnina vrsta</th>
          </tr>
    </thead>
    <tbody>
    @php
        $brojUrucenih = 0;
        $brojVracenih = 0;
        $brojZaNarednu = 0;
        $iznos = 0;
        $postarina = 0;
        $rb = 1;
    @endphp
        @foreach ($posiljke as $posiljka)
          @php
            
            $rowColor = '';
            switch ($posiljka->status_po_spisku) {
              case 2:
                $rowColor = '#c3e6cb';
                $iznos += $posiljka->otkupnina;
                $postarina += $posiljka->postarina;
                $brojUrucenih++;
                break;
              case 3:
                $rowColor = '#f5c6cb';
                if ($posiljka->vracena_posiljka) {
                  $postarinaTMP = $posiljka->nacin_placanja_id == 3 ? $posiljka->postarina * 2 : 0;
                  $postarina += $postarinaTMP;
                }
                $brojVracenih++;
                break;
              case 4:
                $rowColor = '#86cfda';
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
            <tr>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $rb !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->broj_posiljke !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>
                  @if($posiljka->status_po_spisku == '-1') U pripremi @endif
                  @if($posiljka->status_po_spisku == 0) Primljena @endif
                  @if($posiljka->status_po_spisku == 1) Na dostavi @endif
                  @if($posiljka->status_po_spisku == 2) Uručena @endif
                  @if($posiljka->status_po_spisku == 3) Vraćena @endif
                  @if($posiljka->status_po_spisku == 4) Za narednu dostavu @endif
                </td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! date('d.m.Y. H:i:s', strtotime($posiljka->created_at)) !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->primalac->naziv !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->primalac->naselje !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->primalac->ulica.' br. '.$posiljka->primalac->broj !!}{!! $posiljka->primalac->stan ? '/'.$posiljka->primalac->stan : '' !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->masa_kg !!} kg</td>
                {{-- <td>{!! $posiljka->vrednost !!}</td> --}}
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! (float) $posiljka->otkupnina !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! (float) $posiljka->postarina !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->vrstaUsluge->naziv !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->nacinPlacanja->naziv !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->sadrzina !!}</td>
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->licno_preuzimanje ? 'Da' : 'Ne' !!}</td>
                {{-- <td>{!! $posiljka->firma ? $posiljka->firma->naziv : '' !!}</td>
                <td>{!! $posiljka->id !!}</td> --}}
                <td @if($rowColor != '') style="background-color: {!! $rowColor !!};border:1px solid #CCCCCC" @endif>{!! $posiljka->otkupnina_vrsta !!}</td>
            </tr>
            @php
              $rb++;
            @endphp
        @endforeach
    </tbody>
</table>