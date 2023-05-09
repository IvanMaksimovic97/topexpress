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
                        <input type="text" class="form-control" value="{!! old('naziv') ?? $naselje->naziv !!}" name="naziv" id="naziv" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Poštanski broj</label>
                        <input type="text" class="form-control" value="{!! old('postanski_broj') ?? $naselje->postanski_broj !!}" name="postanski_broj" id="postanski_broj" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Grad</label>
                        <select class="form-control" name="id_te_grad" id="">
                            <option value="-1">Izaberi grad...</option>
                            @foreach ($gradovi as $grad)
                                <option @if($grad->id == $naselje->id_te_grad) selected="selected" @endif value="{{ $grad->id }}">{{ $grad->naziv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label>Opština</label>
                        <select class="form-control" name="id_te_opstina" id="">
                            <option value="-1">Izaberi opštinu...</option>
                            @foreach ($opstine as $opstina)
                                <option @if($opstina->id == $naselje->id_te_opstina) selected="selected" @endif value="{{ $opstina->id }}">{{ $opstina->naziv }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>