<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group" id="firma-div">
                        <label>Firma</label>
                        <select class="js-example-basic-single w-100" name="kompanija_id" id="kompanija_id" required>
                            <option value="">Izaberi</option>
                            @foreach ($kompanije as $kompanija)
                                <option value="{{ $kompanija->id }}">{{ $kompanija->naziv }}</option>
                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Broj</label>
                        <input type="text" class="form-control" value="{!! $ugovor->broj_ugovora !!}" name="broj_ugovora" id="broj_ugovora" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Početak</label>
                        <input type="date" class="form-control" value="{!! $ugovor->pocetak ? date('Y-m-d', strtotime($ugovor->pocetak)) : '' !!}" name="pocetak" id="pocetak"  />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Kraj</label>
                        <input type="date" class="form-control" value="{!! $ugovor->kraj ? date('Y-m-d', strtotime($ugovor->kraj)) : '' !!}" name="kraj" id="kraj"  />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Opis</label>
                        <textarea style="width: 100%; border: 1px solid #dee2e6; font-weight: 400; font-size: 0.875rem;border-radius: 4px;" name="opis" id="opis" cols="30" rows="7" required>{!! $ugovor->opis !!}</textarea>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>