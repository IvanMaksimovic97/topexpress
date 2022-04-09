<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group" id="vrsta-usluge-div">
                    <label>Vrsta usluge</label>
                    <select class="js-example-basic-single w-100" name="vrsta_usluge_id" id="vrsta-usluge" required>
                        <option value="">Izaberi</option>
                        @foreach ($vrste_usluga as $usluga)
                            <option @if($usluga->id == '2') selected="selected" @endif value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              <div class="row">
                <div class="form-group" id="vrsta-usluge-div">
                    <label>Način plaćanja</label>
                    <select class="js-example-basic-single w-100" name="nacin_placanja_id" id="nacin-placanja" required>
                        <option value="">Izaberi</option>
                        @foreach ($nacini_placanja as $nacin_placanja)
                            <option @if($nacin_placanja->id == '3') selected="selected" @endif value="{{ $nacin_placanja->id }}">{{ $nacin_placanja->naziv }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label>Broj pošiljke</label>
                        <input type="text" class="form-control" name="broj_posiljke" id="broj_posiljke" disabled="disabled" value="{{ $posiljkaBroj }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Broj dolaznice</label>
                        <input type="text" class="form-control" name="broj_dolaznice" id="broj_dolaznice"/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group w-100">
                        <label>Firma</label>
                        <div id="firma-div" class="w-100">
                            <input type="hidden" name="firma_id" id="firma_id">
                            <input class="form-control" type="text" name="ugovor" placeholder="Unesite naziv firme" id="firma">
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
        <div class="korisnik-typeahead" id="posiljalac_div">
            <input type="hidden" name="posiljalac_id" id="posiljalac_id">
            <input class="form-control" name="po_naziv" id="po_naziv" type="text" required>
        </div>
      </div>
      <div class="form-group">
        <label>Naselje</label>
        <div class="naselje-typeahead" id="po_naselje_div">
            <input type="hidden" name="po_naselje_id" id="po_naselje_id">
            <input class="form-control" name="po_naselje" id="po_naselje" type="text" required>
        </div>
      </div>
      <div class="form-group">
        <label>Ulica</label>
        <div class="ulica-typeahead" id="po_ulica_div">
            <input type="hidden" name="po_ulica_id" id="po_ulica_id">
            <input class="form-control" name="po_ulica" id="po_ulica" type="text" required>
        </div>
      </div>
      <div class="form-group">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Broj</label>
                        <input class="form-control" name="po_broj" id="po_broj" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Podbroj</label>
                        <input class="form-control" name="po_podbroj" id="po_podbroj" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Sprat</label>
                        <input class="form-control" name="po_sprat" id="po_sprat" type="text">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-0">
                        <label>Stan</label>
                        <input class="form-control" name="po_stan" id="po_stan" type="text">
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
        <input type="text" name="po_kontakt_telefon" class="form-control" id="po_kontakt_telefon" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="po_email" class="form-control" id="po_email">
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
          <div class="korisnik-typeahead" id="primalac_div">
              <input type="hidden" name="primalac_id" id="primalac_id">
              <input class="form-control" name="pr_naziv" id="pr_naziv" type="text" required>
          </div>
        </div>
        <div class="form-group">
          <label>Naselje</label>
          <div class="naselje-typeahead" id="pr_naselje_div">
                <input type="hidden" name="pr_naselje_id" id="pr_naselje_id">
              <input class="form-control" name="pr_naselje" id="pr_naselje" type="text" required>
          </div>
        </div>
        <div class="form-group">
          <label>Ulica</label>
          <div class="ulica-typeahead" id="pr_ulica_div">
                <input type="hidden" name="pr_ulica_id" id="pr_ulica_id">
              <input class="form-control" name="pr_ulica" id="pr_ulica" type="text" required>
          </div>
        </div>
        <div class="form-group">
              <div class="row">
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Broj</label>
                          <input class="form-control" name="pr_broj" id="pr_broj" type="text">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Podbroj</label>
                          <input class="form-control" name="pr_podbroj" id="pr_podbroj" type="text">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Sprat</label>
                          <input class="form-control" name="pr_sprat" id="pr_sprat" type="text">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Stan</label>
                          <input class="form-control" name="pr_stan" id="pr_stan" type="text">
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
          <input type="text" name="pr_kontakt_telefon" class="form-control" id="pr_kontakt_telefon" required>
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
              <input type="text" name="masa_kg" class="form-control" id="masa" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <div class="form-group">
              <label>Opis sadržine</label>
              <textarea style="width: 100%; border: 1px solid #dee2e6; font-weight: 400; font-size: 0.875rem;border-radius: 4px;" name="sadrzina" id="sadrzina" cols="30" rows="7"></textarea>
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
                                  <input type="checkbox" value="ima_vrednost" name="ima_vrednost" class="form-check-input" id="ima_vrednost">
                                  Vrednost (DIN)
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-0">
                            <input class="form-control" disabled="disabled" name="vrednost" type="text" placeholder="0.00" id="vrednost" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
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
                                  <input type="checkbox" value="ima_otkupninu" name="ima_otkupninu" class="form-check-input" id="ima_otkupninu">
                                  Otkupnina (DIN)
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-0">
                            <input class="form-control" disabled="disabled" name="otkupnina" type="text" placeholder="0.00" id="otkupnina" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0 px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input radio-uplata" disabled="disabled" name="otkupnina_vrsta" value="Nalog za uplatu" id="nalog-za-uplatu">
                      Nalog za uplatu
                    <i class="input-helper"></i></label>
                </div>
                <input class="form-control d-none" name="broj_racuna" type="text" placeholder="Broj računa" id="broj_racuna" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <div class="form-group px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input radio-uplata" disabled="disabled" name="otkupnina_vrsta" value="TOP EXPRESS uputnica" id="postanska-uputnica">
                      TOP EXPRESS uputnica
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" value="povratnica" name="povratnica" class="form-check-input">
                      Povratnica (UPS)
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" value="licno_urucenje" name="licno_urucenje" class="form-check-input">
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
                <input type="text" disabled="disabled" name="postarina" class="form-control" id="postarina" placeholder="0.00">
            </div>
            <div class="form-group">
                <button type="button" id="postarina-izracunaj" class="btn btn-sm btn-primary mb-2">Izračunaj</button>
            </div>
        </div>
    </div>
</div>