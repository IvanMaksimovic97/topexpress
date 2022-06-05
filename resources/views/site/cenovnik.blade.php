@extends('template.site')
@section('title', 'TOP EXPRESS')
@section('content')
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid mb-5">
    <div class="container text-center py-5">
        <h1 class="text-white display-3">Cenovnik</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="{{ route('index') }}">Početna</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">Cenovnik</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col">

                <h1 class="d-flex justify-content-center">TOP EXPRESS d.o.o. Beograd-Zemun</h1>
                <h3 class="d-flex justify-content-center">Cenovnik poštanskih usluga u unutrašnjem poštanskom saobraćaju</h3>
                <h3 class="d-flex justify-content-center">Cena za pošiljke standardnih dimenzija (maksimalno do 60x60x60cm)</h3>

                <h3 class="d-flex justify-content-center mt-5">Cenovnik usluge "Danas za sutra"</h3>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Masa pošiljke (kg)</th>
                        <th scope="col">Cena bez PDV-a (din)</th>
                        <th scope="col">Cena sa PDV-om (din)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>do 1.0</td>
                        <td>208.33</td>
                        <td>250.00</td>
                      </tr>
                      <tr>
                        <td>1.01 do 3</td>
                        <td>241.67</td>
                        <td>290.00</td>
                      </tr>
                      <tr>
                        <td>3.01 do 5</td>
                        <td>308.33</td>
                        <td>370.00</td>
                      </tr>
                      <tr>
                        <td>5.01 do 10</td>
                        <td>400.00</td>
                        <td>480.00</td>
                      </tr>
                      <tr>
                        <td>10.01 do 15</td>
                        <td>491.65</td>
                        <td>590.00</td>
                      </tr>
                      <tr>
                        <td>15.01 do 20</td>
                        <td>558.33</td>
                        <td>670.00</td>
                      </tr>
                      <tr>
                        <td>20.01 do 30</td>
                        <td>916.67</td>
                        <td>1100.00</td>
                      </tr>
                      <tr>
                        <td>30.01 do 50</td>
                        <td>1241.67</td>
                        <td>1490.00</td>
                      </tr>
                      <tr>
                        <td>Nakon 50 kg svaki naredni kilogram <span class="text-danger">do 100 kg</span></td>
                        <td>41.67</td>
                        <td>50.00</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3 class="d-flex justify-content-center mt-5">Cenovnik usluge "Danas za danas"</h3>
                  <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Masa pošiljke (kg)</th>
                        <th scope="col">Cena bez PDV-a (din)</th>
                        <th scope="col">Cena sa PDV-om (din)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>do 2.0</td>
                        <td>400.00</td>
                        <td>480.00</td>
                      </tr>
                      <tr>
                        <td>2.01 do 5</td>
                        <td>558.33</td>
                        <td>670.00</td>
                      </tr>
                      <tr>
                        <td>5.01 do 10</td>
                        <td>650.00</td>
                        <td>780.00</td>
                      </tr>
                      <tr>
                        <td>10.01 do 20</td>
                        <td>716.58</td>
                        <td>860.00</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection