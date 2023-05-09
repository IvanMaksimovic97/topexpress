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
                        <label>Naziv</label>
                        <input type="text" class="form-control" value="{!! old('naziv') ?? $opstina->naziv !!}" name="naziv" id="naziv" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Grad</label>
                        <select class="form-control" name="id_te_grad" id="">
                            <option value="-1">Izaberi grad...</option>
                            @foreach ($gradovi as $grad)
                                <option @if($grad->id == $opstina->id_te_grad) selected="selected" @endif value="{{ $grad->id }}">{{ $grad->naziv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>