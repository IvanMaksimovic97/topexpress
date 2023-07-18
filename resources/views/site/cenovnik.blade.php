@extends('template.site')
@section('title', 'TOP EXPRESS 2022 d.o.o.')
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

                <h1 class="d-flex justify-content-center">TOP EXPRESS 2022 d.o.o. Beograd-Zemun</h1>
                <h3 class="d-flex justify-content-center">Cenovnik poštanskih usluga u unutrašnjem poštanskom saobraćaju</h3>
                <h3 class="d-flex justify-content-center">Cena za pošiljke standardnih dimenzija (maksimalno do 60x60x60cm)</h3>

                <h3 class="d-flex justify-content-center mt-5" id="danaszasutra">Cenovnik usluge "Danas za sutra"</h3>
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
                        <td>258.33</td>
                        <td>320.00</td>
                      </tr>
                      <tr>
                        <td>1.01 do 3</td>
                        <td>291.67</td>
                        <td>370.00</td>
                      </tr>
                      <tr>
                        <td>3.01 do 5</td>
                        <td>358.33</td>
                        <td>450.00</td>
                      </tr>
                      <tr>
                        <td>5.01 do 10</td>
                        <td>450.00</td>
                        <td>560.00</td>
                      </tr>
                      <tr>
                        <td>10.01 do 15</td>
                        <td>541.67</td>
                        <td>670.00</td>
                      </tr>
                      <tr>
                        <td>15.01 do 20</td>
                        <td>608.33</td>
                        <td>750.00</td>
                      </tr>
                      <tr>
                        <td>20.01 do 30</td>
                        <td>966.67</td>
                        <td>1180.00</td>
                      </tr>
                      <tr>
                        <td>30.01 do 50</td>
                        <td>1291.67</td>
                        <td>1570.00</td>
                      </tr>
                      <tr>
                        <td>Nakon 50 kg svaki naredni kilogram <span class="text-danger">do 100 kg</span></td>
                        <td>41.67</td>
                        <td>50.00</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3 class="d-flex justify-content-center mt-5" id="danaszadanas">Cenovnik usluge "Danas za danas"</h3>
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
                        <td>450.00</td>
                        <td>560.00</td>
                      </tr>
                      <tr>
                        <td>2.01 do 5</td>
                        <td>608.33</td>
                        <td>750.00</td>
                      </tr>
                      <tr>
                        <td>5.01 do 10</td>
                        <td>700.00</td>
                        <td>860.00</td>
                      </tr>
                      <tr>
                        <td>10.01 do 20</td>
                        <td>766.67</td>
                        <td>940.00</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3 class="d-flex justify-content-center mt-5" id="danaszaodmah">Cenovnik usluge "Danas za odmah"</h3>
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
                        <td>do 20 kg (područje Beograda)</td>
                        <td>800.00</td>
                        <td>980.00</td>
                      </tr>
                    </tbody>
                  </table>

                  <h3 class="d-flex justify-content-center mt-5 mb-5">Cene za pošiljke van standradnih dimenzija ( preko 60x60x60 cm )</h3>
                  <p><strong>* Pošiljke velikih gabarita ( Gabaritne pošiljke ) -</strong> to su pošiljke van standardnih dimenzija ( neka od dimenzija prelazi 90x90x90cm ). Maksimalna dimenzija gabaritnih pošiljaka ( koje prelaze dimenzije 90x90x90cm ) ne sme biti veća od tri metra ( 300cm ), a masa im je maksimalno 10kg. Takva pošiljka podleže naplati dopunske poštarine na cenu po masi za pošiljke standardnih dimenzija. Za ovu vrstu pošiljaka primenjuje se obračun poštarine tako što se na cenovni stav po masi za pošiljku standardnih dimenzija, iznos ukupne poštarine uvećava za 600,00 dinara bez PDV-a, odnosno 720,00 dinara sa PDV-om.</p>
                  <p><strong>* GLOMAZNA pošiljka</strong> je pošiljka van standardnih dimenzija čija najveća dimenzija prelazi 60x60x60cm, pri čemu je zbir dužine i obima pošiljke na najširem mestu poprečno maksimalno do 300 cm , s tim da najveća dimenzija pošiljke može biti do 150 cm, a ukupne mase od 10 kg do 100 kg. Takva pošiljka podleže naplati dopunske poštarine na cenu po masi za pošiljke standardnih dimenzija. Za ovu vrstu pošiljaka primenjuje se obračun poštarine tako što se na cenovni stav po masi za pošiljku standardnih dimenzija, iznos ukupne poštarine uvećava za 1250,00 dinara bez PDV-a, odnosno 1.500,00 dinara sa PDV-om.</p>
                  <p><strong>* Paletirana pošiljka</strong> je jedna ili više kutija složenih na ravnu standardnu euro paletu, od istog pošiljaoca za istog primaoca maksimalne težine do 600kg i visine do 1,85 m. Za ovu vrstu pošiljaka propisuje se cenovni stav od 10.000,00 dinara bez PDV-a, odnosno 12.000,00 dinara sa PDV-om.</p>

                  <h3 class="d-flex justify-content-center mt-5 mb-5">Dodatna cena na cenu za pošiljke standardnih i van standardnih dimenzija za dopunske i dodatne usluge:</h3>
                  <p class="mb-1">* Vrednosna poštanska pošiljka naplaćuje se 1% od naznačene vrednosti, a minimalno 20,00 dinara sa PDV-om za vrednosti do 2000,00 dinara</p>
                  <p class="mb-1">* Pošiljka sa plaćenim odgovorom 120,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Pošiljka sa zahtevom za vraćanje potpisane dokumentacije 120,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Ponovna dostava 50,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Pošiljka sa ličnim uručenjem 120,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Elektronska potvrda o uručenju SMS poruka 18,00 dinara sa PDV-om </p>    
                  <p class="mb-1">* Pošiljka sa povratnicom 150,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Dokaz o isporuci pošiljke naknadno 120,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Izmena ili ispravka adrese primaoca ( na zahtev pošiljaoca ili primaoca ) 112,50 dinara sa PDV-om</p>
                  <p class="mb-1">* Ležarina po danu 30,00 dinara sa PDV-om</p>
                  <p class="mb-1">* Pakovanje pošiljaka 12,00 dinara sa PDV-om</p>
                  <p class="mb-1">* <span class="text-danger">Registrovana poštanska</span> pošiljka na kojoj je označeno da poštarinu plača primalac, a koju je isti odbio da plati, dupla poštarina se naplaćuje pošiljaocu pošto mu se pošiljka vrati</p>
                
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection