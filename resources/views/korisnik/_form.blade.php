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