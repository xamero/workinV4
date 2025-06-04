@extends('public.layouts.main')

@section('header')
    Mission and Vission
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box-shadow p-4">
        <div class="row mb-4">
            <div class="col-md-12 text-center"><img src="{{asset('img/background/logo-tagline.png')}}" alt="" class="img img-fluid"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 py-5">
                <h3 class="text-success">Provincial Vision:</h3>
                <p class="lead text-justify">“Narimat nga arapaap, intay’ amin maragpat!”</p>
                <p class="lead text-justify">(A brighter future, we can all achieve!)</p>

            </div>
            <div class="col-md-6 text-center">
                <img src="{{asset('img/header/vision.png')}}" class="img img-fluid" alt="">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{asset('img/header/mission.png')}}" class="img img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <h3 class="text-success">Provincial Mission:</h3>
                <p class="lead text-justify">“SAPASAP A SALUN-AT” (Accessible Healthcare for All)</p>
                <p class="lead text-justify">“NARIMAT NGA AGLAWLAW” (A Brighter Environment)</p>
                <p class="lead text-justify">“AGTULTULOY A TULONG PARA MANNALON KEN MANGNGALAP” (Continuing Assistance
                    to
                    Farmers and Fisherfolks)</p>
                <p class="lead text-justify">“NAURNOS A TRANSPORTASION” (Organized Transportation)</p>
                <p class="lead text-justify">“ADADU A PAGPUONAN KEN NARUAY A PANGGEDAN” (More Investments and Jobs)</p>
            </div>
        </div>


    </div>
@endsection