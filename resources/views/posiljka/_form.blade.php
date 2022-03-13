<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group">
                    <label>Vrsta usluge</label>
                    <select class="js-example-basic-single w-100" id="vrsta-usluge">
                        <option value="-1">Izaberi</option>
                        @foreach ($vrste_usluga as $usluga)
                            <option value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="row">
                <div class="form-group">
                    <label>Način plaćanja</label>
                    <select class="js-example-basic-single w-100" id="nacin-placanja">
                        <option value="-1">Izaberi</option>
                        @foreach ($nacini_placanja as $nacin_placanja)
                            <option value="{{ $nacin_placanja->id }}">{{ $nacin_placanja->naziv }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label>Broj pošiljke</label>
                        <input type="text" class="form-control" name="broj_posiljke" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Broj dolaznice</label>
                        <input type="text" class="form-control" name="broj_dolaznice" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group w-100">
                        <label>Firma</label>
                        <div id="firma-div" class="w-100">
                            <input  class="form-control" type="text" placeholder="Unesite naziv firme">
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Pošiljalac</h4>
      <div class="form-group">
        <label>Naziv</label>
        <div class="korisnik-typeahead">
            <input class="form-control" name="po_naziv" type="text">
        </div>
      </div>
      <div class="form-group">
        <label>Naselje</label>
        <div class="naselje-typeahead">
            <input class="form-control" name="po_naselje" type="text">
        </div>
      </div>
      <div class="form-group">
        <label>Ulica</label>
        <div class="ulica-typeahead">
            <input class="form-control" name="po_ulica" type="text">
        </div>
      </div>
      <div class="form-group">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Broj</label>
                        <input class="form-control" name="po_broj" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Podbroj</label>
                        <input class="form-control" name="po_podbroj" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Sprat</label>
                        <input class="form-control" name="po_sprat" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Stan</label>
                        <input class="form-control" name="po_stan" type="text">
                    </div>
                </div>
            </div>
      </div>
      <div class="form-group">
        <label>Napomena</label>
        <input type="text" name="po_napomena" class="form-control" id="po_napomena">
      </div>
      <div class="form-group">
        <label>Kontakt osoba</label>
        <input type="text" name="po_kontakt_osoba" class="form-control" id="po_kontakt_osoba">
      </div>
      <div class="form-group">
        <label>Kontakt telefon</label>
        <input type="text" name="po_kontakt_telefon" class="form-control" id="po_kontakt_telefon">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="p_email" class="form-control" id="po_email">
      </div>
    </div>
  </div>
</div>
<div class="col-md-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">Primalac</h4>
        <div class="form-group">
          <label>Naziv</label>
          <div class="korisnik-typeahead">
              <input class="form-control" name="pr_naziv" type="text">
          </div>
        </div>
        <div class="form-group">
          <label>Naselje</label>
          <div class="naselje-typeahead">
              <input class="form-control" name="pr_naselje" type="text">
          </div>
        </div>
        <div class="form-group">
          <label>Ulica</label>
          <div class="ulica-typeahead">
              <input class="form-control" name="pr_ulica" type="text">
          </div>
        </div>
        <div class="form-group">
              <div class="row">
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Broj</label>
                          <input class="form-control" name="pr_broj" type="text">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Podbroj</label>
                          <input class="form-control" name="pr_podbroj" type="text">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Sprat</label>
                          <input class="form-control" name="pr_sprat" type="text">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Stan</label>
                          <input class="form-control" name="pr_stan" type="text">
                      </div>
                  </div>
              </div>
        </div>
        <div class="form-group">
          <label>Napomena</label>
          <input type="text" name="pr_napomena" class="form-control" id="pr_napomena">
        </div>
        <div class="form-group">
          <label>Kontakt osoba</label>
          <input type="text" name="pr_kontakt_osoba" class="form-control" id="pr_kontakt_osoba">
        </div>
        <div class="form-group">
          <label>Kontakt telefon</label>
          <input type="text" name="pr_kontakt_telefon" class="form-control" id="pr_kontakt_telefon">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="pr_email" class="form-control" id="pr_email">
        </div>
      </div>
  </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pošiljka</h4>
            <div class="form-group">
              <label>Masa (KG)</label>
              <input type="text" name="masa" class="form-control" id="masa">
            </div>
            <div class="form-group">
              <label>Opis sadržine</label>
              <input type="text" name="sadrzina" class="form-control" id="sadrzina">
            </div>
          </div>
      </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Posebne usluge</h4>
            <div class="form-group mb-0">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                  Vrednost (din)
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-0">
                            <input class="form-control" disabled="disabled" name="vrednost" type="text" placeholder="0.00">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                  Otkupnina (din)
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-0">
                            <input class="form-control" disabled="disabled" name="otkupnina" type="text" placeholder="0.00">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0 px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                      Nalog za uplatu
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group mb-0 px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                      Poštanska uputnica
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="">
                      POSTNET uputnica
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                      Povratnica (UPS)
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                      Lično uručenje
                    <i class="input-helper"></i></label>
                </div>
            </div>
          </div>
      </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Poštarina</h4>
            <div class="form-group">
                <label>Vrednost poštarine (DIN)</label>
                <input type="text" name="vrednost_postarine" class="form-control" id="vrednost_postarine">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-sm btn-primary mb-2">Izračunaj</button>
            </div>
        </div>
    </div>
</div>