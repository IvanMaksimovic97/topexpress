<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group" id="vrsta-div">
                    <label>Vrsta</label>
                    <select class="js-example-basic-single w-100" name="vrsta_usluge_id" id="vrsta-usluge" required>
                        <option value="">Izaberi</option>
                        {{-- @foreach ($vrste_usluga as $usluga)
                            <option value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                        @endforeach --}}
                    </select>
                  </div>
              </div>
              <div class="row">
                <div class="form-group" id="vrsta-usluge-div">
                    <label>Tip</label>
                    <select class="js-example-basic-single w-100" name="nacin_placanja_id" id="nacin-placanja" required>
                        <option value="">Izaberi</option>
                        {{-- @foreach ($nacini_placanja as $nacin_placanja)
                            <option value="{{ $nacin_placanja->id }}">{{ $nacin_placanja->naziv }}</option>
                        @endforeach --}}
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label>Radnik</label>
                        <input type="text" class="form-control" name="broj_posiljke" id="broj_posiljke" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Za datum</label>
                        <input type="date" class="form-control" name="datum" id="datum"/>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>