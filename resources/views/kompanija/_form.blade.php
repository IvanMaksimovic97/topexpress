<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="form-group">
                        <label>Naziv</label>
                        <input type="text" class="form-control" value="{!! $kompanija->naziv !!}" name="naziv" id="naziv" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Pun naziv</label>
                        <input type="text" class="form-control" value="{!! $kompanija->naziv_pun !!}" name="naziv_pun" id="naziv_pun" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>PIB</label>
                        <input type="text" class="form-control" value="{!! $kompanija->pib !!}" name="pib" id="pib" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Matični broj</label>
                        <input type="text" class="form-control" value="{!! $kompanija->mbr !!}" name="mbr" id="mbr" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Adresa</label>
                        <input type="text" class="form-control" value="{!! $kompanija->adresa !!}" name="adresa" id="adresa" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{!! $kompanija->email !!}" name="email" id="email" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Web sajt</label>
                        <input type="text" class="form-control" value="{!! $kompanija->websajt !!}" name="websajt" id="websajt" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="text" class="form-control" value="{!! $kompanija->telefon !!}" name="telefon" id="telefon" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Mobilni</label>
                        <input type="text" class="form-control" value="{!! $kompanija->mobilni !!}" name="mobilni" id="mobilni" />
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>