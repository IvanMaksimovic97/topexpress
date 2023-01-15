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
                            <option 

                            @if ($posiljka->vrsta_usluge_id)
                                @if($usluga->id == $posiljka->vrsta_usluge_id)
                                    selected="selected" 
                                @endif 
                            @else
                                @if($usluga->id == '2') 
                                    selected="selected" 
                                @endif 
                            @endif

                            value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
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
                            <option

                            @if ($posiljka->nacin_placanja_id )
                                @if($nacin_placanja->id == $posiljka->nacin_placanja_id )
                                    selected="selected" 
                                @endif 
                            @else
                                @if($nacin_placanja->id == '3') 
                                    selected="selected" 
                                @endif 
                            @endif

                            value="{{ $nacin_placanja->id }}">{{ $nacin_placanja->naziv }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label>Broj pošiljke</label>
                        <input @if(!$moze_da_izmeni_broj) disabled="disabled" @endif value="{{ preg_replace('/[^0-9.]+/', '', $posiljka->broj_posiljke) }}" type="text" class="form-control {{ session()->has('errMsg') ? 'is-invalid' : '' }}" name="broj_posiljke" id="broj_posiljke" required />
                        @if(session()->has('errMsg'))
                        <div class="invalid-feedback" id="broj_posiljke-invalid-text">
                           {{ session()->get('errMsg') }}
                        </div>
                        @else
                        <div class="invalid-feedback" id="broj_posiljke-invalid-text">
                            Unesite broj pošiljke!
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Datum i vreme pošiljke</label>
                        <input type="datetime-local" class="form-control" name="created_at" value="{{ $posiljka->created_at ? date('Y-m-d H:i:s', strtotime($posiljka->created_at)) : date('Y-m-d H:i:s') }}">
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
<div class="col-md-12 grid-margin stretch-card mt-4">
  <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Primalac</h4>
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" id="reset-primalac" class="btn btn-sm btn-danger">Resetuj</button>
            </div>
        </div>
        <div class="form-group">
          <label>Naziv</label>
          <div class="korisnik-typeahead" id="primalac_div">
              <input type="hidden" name="primalac_id" id="primalac_id" value="{{ $posiljka->primalac_id }}">
              <input class="form-control" name="pr_naziv" id="pr_naziv" type="text" required value="{{ $posiljka->primalac ? $posiljka->primalac->naziv : '' }}">
          </div>
        </div>
        <div class="form-group">
          <label>Naselje</label>
          <div class="naselje-typeahead" id="pr_naselje_div">
                <input type="hidden" name="pr_naselje_id" id="pr_naselje_id" value="{{ $posiljka->primalac ? $posiljka->primalac->naselje_id : ''}}">
              <input class="form-control" name="pr_naselje" id="pr_naselje" type="text" required value="{{ $posiljka->primalac ? $posiljka->primalac->naselje : '' }}">
          </div>
        </div>
        <div class="form-group">
          <label>Ulica</label>
          <div class="ulica-typeahead" id="pr_ulica_div">
                <input type="hidden" name="pr_ulica_id" id="pr_ulica_id" value="{{ $posiljka->primalac ? $posiljka->primalac->ulica_id : '' }}">
              <input class="form-control" name="pr_ulica" id="pr_ulica" type="text" required value="{{ $posiljka->primalac ? $posiljka->primalac->ulica : '' }}">
          </div>
        </div>
        <div class="form-group">
              <div class="row">
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Broj</label>
                          <input class="form-control" name="pr_broj" id="pr_broj" type="text" value="{{ $posiljka->primalac ? $posiljka->primalac->broj : '' }}">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Podbroj</label>
                          <input class="form-control" name="pr_podbroj" id="pr_podbroj" type="text" value="{{ $posiljka->primalac ? $posiljka->primalac->podbroj : '' }}">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Sprat</label>
                          <input class="form-control" name="pr_sprat" id="pr_sprat" type="text" value="{{ $posiljka->primalac ? $posiljka->primalac->sprat : '' }}">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group mb-0">
                          <label>Stan</label>
                          <input class="form-control" name="pr_stan" id="pr_stan" type="text" value="{{ $posiljka->primalac ? $posiljka->primalac->stan : '' }}">
                      </div>
                  </div>
              </div>
        </div>
        <div class="form-group">
          <label>Napomena</label>
          <input type="text" name="pr_napomena" class="form-control" id="pr_napomena" value="{{ $posiljka->primalac ? $posiljka->primalac->napomena : '' }}">
        </div>
        <div class="form-group">
          <label>Kontakt osoba</label>
          <input type="text" name="pr_kontakt_osoba" class="form-control" id="pr_kontakt_osoba" value="{{ $posiljka->primalac ? $posiljka->primalac->kontakt_osoba : '' }}">
        </div>
        <div class="form-group">
          <label>Kontakt telefon</label>
          <input type="text" name="pr_kontakt_telefon" class="form-control" id="pr_kontakt_telefon" required value="{{ $posiljka->primalac ? $posiljka->primalac->kontakt_telefon : '' }}">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="pr_email" class="form-control" id="pr_email" value="{{ $posiljka->primalac ? $posiljka->primalac->email : '' }}">
        </div>
      </div>
  </div>
</div>
<div class="col-md-4 grid-margin stretch-card mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pošiljka</h4>
            <div class="form-group">
              <label>Masa (KG)</label>
              <input value="{{ $posiljka->masa_kg }}" type="text" name="masa_kg" class="form-control" id="masa" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <div class="form-group">
              <label>Opis sadržine</label>
              <textarea style="width: 100%; border: 1px solid #dee2e6; font-weight: 400; font-size: 0.875rem;border-radius: 4px;" name="sadrzina" id="sadrzina" cols="30" rows="7">{{ $posiljka->sadrzina }}</textarea>
            </div>
          </div>
      </div>
</div>
<div class="col-md-4 grid-margin stretch-card mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Posebne usluge</h4>
            <div class="form-group mb-0">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0">
                            <div class="form-check">
                                <label class="form-check-label">
                                  <input {{ $posiljka->ima_vrednost ? 'checked="checked"' : ''}} type="checkbox" value="ima_vrednost" name="ima_vrednost" class="form-check-input" id="ima_vrednost">
                                  Vrednost (DIN)
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-0">
                            <input class="form-control" value="{{ $posiljka->vrednost }}" {{ $posiljka->ima_vrednost ? '' : 'disabled'}} name="vrednost" type="text" placeholder="0.00" id="vrednost" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
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
                                  <input {{ $posiljka->ima_otkupninu ? 'checked="checked"' : '' }} type="checkbox" value="ima_otkupninu" name="ima_otkupninu" class="form-check-input" id="ima_otkupninu">
                                  Otkupnina (DIN)
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-0">
                            <input class="form-control" value="{{ $posiljka->otkupnina }}" {{ $posiljka->ima_otkupninu ? '' : 'disabled'}} name="otkupnina" type="text" placeholder="0.00" id="otkupnina" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0 px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input {{ $posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? 'checked="checked"' : '' }} type="radio" {{ $posiljka->ima_otkupninu ? '' : 'disabled' }} class="form-check-input radio-uplata" name="otkupnina_vrsta" value="Nalog za uplatu" id="nalog-za-uplatu">
                      Nalog za uplatu
                    <i class="input-helper"></i></label>
                </div>
                <input value="{{ $posiljka->broj_racuna }}" class="form-control {{ $posiljka->otkupnina_vrsta == 'Nalog za uplatu' ? '' : 'd-none' }}" name="broj_racuna" type="text" placeholder="Broj računa" id="broj_racuna" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                <input type="hidden" id="racun_id" name="racun_id">
            </div>
            <div class="form-group mb-0 px-4">
                <div class="form-check">
                    <label class="form-check-label">
                      <input {{ $posiljka->otkupnina_vrsta == 'TOP EXPRESS iznos' ? 'checked="checked"' : '' }} type="radio" {{ $posiljka->ima_otkupninu ? '' : 'disabled' }} class="form-check-input radio-uplata" name="otkupnina_vrsta" value="TOP EXPRESS iznos" id="postanska-uputnica">
                      TOP EXPRESS iznos
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group px-4 text-danger d-none" id="otkupnina-vrsta-upozorenje">Izaberite opciju iznad!</div>
            <div class="form-group mt-4 mb-0">
                <div class="form-check">
                    <label class="form-check-label">
                      <input {{ $posiljka->povratnica ? 'checked="checked"' : '' }} type="checkbox" value="povratnica" name="povratnica" class="form-check-input">
                      Povratnica (UPS)
                    <i class="input-helper"></i></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                      <input {{ $posiljka->licno_preuzimanje ? 'checked="checked"' : '' }} type="checkbox" value="licno_urucenje" name="licno_urucenje" class="form-check-input">
                      Lično uručenje
                    <i class="input-helper"></i></label>
                </div>
            </div>
          </div>
      </div>
</div>
<div class="col-md-4 grid-margin stretch-card mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Poštarina</h4>
            <div class="form-group">
                <label>Vrednost poštarine (DIN)</label>
                <input type="text" disabled="disabled" name="postarina" class="form-control" id="postarina" placeholder="0.00">
            </div>
            <div class="form-group">
                <button type="button" id="postarina-izracunaj" class="btn btn-sm btn-danger mb-2">Izračunaj</button>
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" id="rucni-unos" value="rucni-unos-postarine" name="rucni_unos" class="form-check-input">
                      Unesi ručno
                    <i class="input-helper"></i></label>
                </div>
            </div>
        </div>
    </div>
</div>