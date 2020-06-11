@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-image: url({{ asset('assets/img/bg-cup.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Créer un Quiz</h1>
        <p class="fs-20 opacity-70">Pour {{ $elemType }} : {{ $elem->libelle }} </p>
        <p>Ce Quiz sera proposé (une fois <strong>complet</strong>) à l'apprenant à la fin de la rubrique à laquelle il est rattaché</p>

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

          <form action="{{ action($storeRoute, $elem->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <input class="form-control form-control-lg" type="text" name="libelle" placeholder="Libelle du Quiz">
            </div>

            <div class="form-group">
              <textarea class="form-control form-control-lg" name="description" rows="4" placeholder="Description"></textarea>
            </div>

            <div class="form-group">
              <input class="form-control form-control-lg" type="text" name="commentaire" placeholder="Commentaire">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Créer le Quiz</button>
          </form>

        </div>
      </div>
    </div>
  </div>
@stop
