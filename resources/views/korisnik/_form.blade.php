<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="form-group">
                        <label>Ime</label>
                        <input type="text" class="form-control" value="{!! old('ime') ?? $korisnik->ime !!}" name="ime" id="ime" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Prezime</label>
                        <input type="text" class="form-control" value="{!! old('prezime') ?? $korisnik->prezime !!}" name="prezime" id="prezime" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{!! old('email') ?? $korisnik->email !!}" name="email" id="email" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Lozinka</label>
                        <input type="password" class="form-control" value="" name="password" id="password" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Potvrda lozinke</label>
                        <input type="password" class="form-control" value="" name="password_confirmation" id="password_confirmation"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Naselje</label>
                    <select class="js-example-basic-single w-100" data-live-search="true" id="naselje_id" name="naselje_id" required>
                        <option selected disabled value="-1">Izaberi naselje *</option>
                        @foreach ($naselja as $n)
                            <option @if($posiljalac && $posiljalac->naselje_id == $n->id) selected @endif value="{{ $n->id }}">{{ strtoupper($n->naziv) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Ulica</label>
                    <select class="js-example-basic-single w-100" data-live-search="true" id="ulica_id" name="ulica_id" required>
                        <option selected disabled value="-1">Izaberi ulicu *</option>
                        @foreach ($ulice as $u)
                            <option @if($posiljalac && $posiljalac->ulica_id == $u->id) selected @endif value="{{ $u->id }}">{{ strtoupper($u->naziv) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                   <div class="row">
                    <div class="col">
                        <input type="text" name="broj" required class="form-control" placeholder="Broj *" value="{{ old('broj') ?? ($posiljalac ? $posiljalac->broj : '') }}" />
                        @if ($errors->has('broj'))
                        <span class="text-danger">{{ $errors->first('broj') }}</span>
                        @endif
                    </div>
                    <div class="col"><input type="text" name="podbroj" class="form-control" placeholder="Pod broj" value="{{ old('podbroj') ?? ($posiljalac ? $posiljalac->podbroj : '') }}" /></div>
                    <div class="col"><input type="text" name="sprat" class="form-control" placeholder="Sprat" value="{{ old('sprat') ?? ($posiljalac ? $posiljalac->sprat : '') }}" /></div>
                    <div class="col"><input type="text" name="stan" class="form-control" placeholder="Stan" value="{{ old('stan') ?? ($posiljalac ? $posiljalac->stan : '') }}" /></div>
                   </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Tip korisnika</label>
                        <select class="form-control" name="pristup" id="">
                            <option @if ($korisnik->pristup == '1') selected="selected" @endif value="1">TOP EXPRESS korisnik</option>
                            <option @if ($korisnik->pristup == '2') selected="selected" @endif value="2">Korisnik</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Aktivan</label><br>
                        <input type="checkbox" @if ($korisnik->status) checked="checked" @endif class="form-check-input" value="1" name="status" id="status"/>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>