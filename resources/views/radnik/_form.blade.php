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
                        <input type="text" class="form-control" value="{!! old('ime') ?? $radnik->ime !!}" name="ime" id="ime" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Prezime</label>
                        <input type="text" class="form-control" value="{!! old('prezime') ?? $radnik->prezime !!}" name="prezime" id="prezime" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>JMBG</label>
                        <input type="text" class="form-control" value="{!! old('jmbg') ?? $radnik->jmbg !!}" name="jmbg" id="jmbg" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="text" class="form-control" value="{!! old('telefon') ?? $radnik->telefon !!}" name="telefon" id="telefon" required />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{!! old('email') ?? $radnik->email !!}" name="email" id="email" required />
                    </div>
                </div>
                @if(Route::currentRouteName() == 'cms.radnik.edit')
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
                @endif
            </div>
          </div>
      </div>
    </div>
</div>