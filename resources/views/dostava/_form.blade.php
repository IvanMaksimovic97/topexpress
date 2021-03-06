<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group" id="vrsta-div">
                    <label>Vrsta</label>
                    <select class="js-example-basic-single w-100" name="vrsta" id="vrsta">
                        <option value="">Izaberi</option>
                        {{-- @foreach ($vrste_usluga as $usluga)
                            <option value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                        @endforeach --}}
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group" id="tip-div">
                    <label>Tip</label>
                    <select class="js-example-basic-single w-100" name="tip" id="tip" >
                        <option value="">Izaberi</option>
                        {{-- @foreach ($nacini_placanja as $nacin_placanja)
                            <option value="{{ $nacin_placanja->id }}">{{ $nacin_placanja->naziv }}</option>
                        @endforeach --}}
                    </select>
                  </div>
              </div>
              <div class="row">
                <div class="form-group" id="posiljka-div">
                    <label>Dodaj pošiljku</label>
                    <select class="js-example-basic-single w-100" name="posiljke[]" id="posiljke" multiple="multiple" @if($dostava->status) disabled="disabled" @endif>
                        <option value="0">Izaberi</option>
                        @foreach ($posiljke as $posiljka)
                            <option @if(in_array($posiljka->id, $posiljkeDostave)) selected="selected" @endif value="{{ $posiljka->id }}">{{ $posiljka->broj_posiljke }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label>Broj spiska</label>
                        <input type="text" class="form-control" value="{{ $dostava->broj_spiska ?? $brojDostave }}" name="broj_spiska" id="broj_spiska" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Radnik</label>
                        <input type="text" class="form-control" value="{{ $dostava->radnik }}" name="radnik" id="radnik" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Za datum</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime($dostava->za_datum ?? now())) }}" name="datum" id="datum" required/>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>