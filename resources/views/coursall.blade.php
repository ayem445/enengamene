@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-laptop.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Liste des Cours</h1>
        <p class="fs-18 opacity-70">Liste Exhaustive des Cours</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
  <div class="section bg-grey">
    <div class="container">

      <div class="row gap-y">
        <div class="col-12">
            <vue-cours></vue-cours>
        </div>
      </div>
    </div>
  </div>
@stop
