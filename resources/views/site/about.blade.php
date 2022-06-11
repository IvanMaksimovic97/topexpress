@extends('template.site')
@section('title', 'TOP EXPRESS')
@section('content')
<!-- Header Start -->
<div class="jumbotron jumbotron-fluid mb-5">
    <div class="container text-center py-5">
        <h1 class="text-white display-3">O nama</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="{{ route('index') }}">Početna</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">O nama</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <p>PREDUZEĆE TOPEXPRESS 2022 DOO IZ BEOGRADA OSNOVANO JE SA CILJEM DA SE DUGOGODISNJE ISKUSTVO U RADU U KURIRSKIM SLUŽBAMA UNAPREDI I KVALITET USLUGA PREZENTUJE NA PRAVI NAČIN.</p>
                <p>UPRAVO KVALITET USLUGA UZ BRZINU KOJA JE NEOPHODNA SU DVA NAJVAŽNIJA USLOVA ZA POSLOVANJE PREDUZEĆA.</p>
                <p>TOPEXPRESS 2022 I KURIRSKI SERVIS T-EXPRESS  SA SVOJIM ZAPOSLENIM GLAVNI AKCENAT JE STAVIO NA KVALITET SVOJIH USLUGA.</p>
                <p>ZADOVOLJSTVO NAŠIH KLIJENATA JE GLAVNO MERILO NAŠEG RADA.</p>
                <p>NAŠA MISIJA JE DA UŠTEDIMO VAŠE VREME, A NE DA GA GUBITE TRAŽEĆI SVOJU POŠILJKU PO RAZNIM ISPORUČNIM ŠALTERIMA I CALL CENTRIMA,A KOJU STE PORUČILI I ŽELITE  DA VAM SE DONESE NA TAČNO ODREĐENU ADRESU.</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection