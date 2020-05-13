@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #a18cd1;">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $cour->libelle }}</h1>
        <p class="fs-20 opacity-70">Personnalisez Les Chapitres & Sessions de votre Cours</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
<div class="section section-inverse">
  <div class="container">

    <div class="row gap-y">
      <div class="col-12">
        <vue-chapitres default_chapitres="{{ $cour->chapitres }}"></vue-chapitres>
      </div>
    </div>
  </div>
</div>
@stop
