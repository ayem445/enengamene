@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-laptop.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $cour->libelle }}</h1>
        <p class="fs-18 opacity-70">Personnalisez Les Chapitres & Sessions du Cours</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
<section class="section" id="section-open-positions">
  <div class="container">
    <header class="section-header">
      <small>Chapitres du Cours</small>
      <h2>{{ $cour->libelle }}</h2>
      <hr>
      <p class="lead">{{ $cour->description }}
        <footer class="blockquote-footer">{{ $cour->commentaire }}</footer>
      </p>
    </header>

    <vue-chapitres default_chapitres="{{ $cour->chapitres }}"></vue-chapitres>

  </div>
</section>
@stop
