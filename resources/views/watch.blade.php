@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #9ac29d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $session->libelle }}</h1>
        <p class="fs-20 opacity-70">{{  $chapitre->libelle }}</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
  <div class="section bg-grey">
    <div class="container">

      <div class="row gap-y text-center">
        <div class="col-12">

            <vue-player default_session="{{$session}}"></vue-player>

            <a href="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->getSessionPrec()->id]) }}" class="btn btn-info">Session Précédente</a>
            <a href="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->getSessionSuiv()->id]) }}" class="btn btn-info">Session Suivante</a>
            
        </div>
        <div class="col-12">

        </div>
      </div>
    </div>
  </div>
@stop
