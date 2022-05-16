<div>
    @if(count($cenovnik) > 0)
        <div id="ugg">
        @foreach ($cenovnik as $index => $item)
            <div class="row cenovnik-red">
                <div class="col">
                    <div class="form-group" id="vrsta-usluge-div">
                        <label>Vrsta usluge</label>
                        <select class="js-example-basic-single w-100" name="red[{{$index}}][vrsta_usluge]" id="vrsta-usluge" required>
                            <option value="">Izaberi</option>
                            @foreach ($vrste_usluga as $usluga)
                                <option 
                                @if ($item->vrsta_usluge_id == $usluga->id)
                                    selected
                                @endif
                                value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Opis</label>
                        <input type="text" class="form-control" value="{{ $item->masa_kg }}"  name="red[{{$index}}][opis]" required/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>MIN kg</label>
                        <input type="text" class="form-control" value="{{ number_format($item->min_kg, 1) }}" name="red[{{$index}}][min_kg]" required/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>MAX kg</label>
                        <input type="text" class="form-control" value="{{ number_format($item->max_kg, 1) }}"  name="red[{{$index}}][max_kg]" required/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Cena (din)</label>
                        <input type="text" class="form-control" value="{{ number_format(floatval($item->cena_sa_pdv), 2, '.', '') }}" name="red[{{$index}}][cena]" required/>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <button type="button" class="btn btn-sm btn-primary" id="dodaj">Dodaj</button>
        <button type="button" class="btn btn-sm btn-danger" id="ukloni">Ukloni</button>
    @else
    <div id="ugg">
        <div class="row cenovnik-red">
            <div class="col">
              <div class="form-group" id="vrsta-usluge-div">
                  <label>Vrsta usluge</label>
                  <select class="js-example-basic-single w-100" name="red[0][vrsta_usluge]" id="vrsta-usluge" required>
                      <option value="">Izaberi</option>
                      @foreach ($vrste_usluga as $usluga)
                          <option 
                          value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                      @endforeach
                  </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Opis</label>
                    <input type="text" class="form-control"  name="red[0][opis]" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>MIN kg</label>
                    <input type="text" class="form-control"  name="red[0][min_kg]" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>MAX kg</label>
                    <input type="text" class="form-control"  name="red[0][max_kg]" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Cena (din)</label>
                    <input type="text" class="form-control"  name="red[0][cena]" required/>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-primary" id="dodaj">Dodaj</button>
    <button type="button" class="btn btn-sm btn-danger" id="ukloni">Ukloni</button>
    @endif
</div>

<script>
var brojReda = {{ count($cenovnik) > 0 ? count($cenovnik) : 1 }};

var renderCenovnikHtml = function ()
{
    let html = `
        <div class="row cenovnik-red">
            <div class="col">
              <div class="form-group" id="vrsta-usluge-div">
                  <label>Vrsta usluge</label>
                  <select class="js-example-basic-single w-100" name="red[${brojReda}][vrsta_usluge]" required>
                      <option value="">Izaberi</option>
                      @foreach ($vrste_usluga as $usluga)
                          <option 
                          value="{{ $usluga->id }}">{{ $usluga->naziv }}</option>
                      @endforeach
                  </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Opis</label>
                    <input type="text" class="form-control" name="red[${brojReda}][opis]" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>MIN kg</label>
                    <input type="text" class="form-control" name="red[${brojReda}][min_kg]" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>MAX kg</label>
                    <input type="text" class="form-control" name="red[${brojReda}][max_kg]" required/>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Cena (din)</label>
                    <input type="text" class="form-control" name="red[${brojReda}][cena]" required/>
                </div>
            </div>
        </div>
    `;

    document.getElementById('ugg').insertAdjacentHTML('beforeend', html);
    brojReda++;
}

document.addEventListener('click', function(e) {

    if(e.target && e.target.id == 'dodaj') {
        renderCenovnikHtml();
    }

    if(e.target && e.target.id == 'ukloni') {
        let rows = document.getElementsByClassName('cenovnik-red');
        rows[rows.length - 1].remove();
        brojReda--;
    }
});

</script>