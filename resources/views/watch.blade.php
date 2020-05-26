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

            <vue-player default_session="{{$session}}"
            @if($session->getSessionSuiv()->id !== $session->id)
                next_session_url="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->getSessionSuiv()->id]) }}"
            @endif
            ></vue-player>

            @if($session->getSessionPrec()->id !== $session->id)
              <a href="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->getSessionPrec()->id]) }}" class="btn btn-info">Session Précédente</a>
            @endif
            @if($session->getSessionSuiv()->id !== $session->id)
              <a href="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->getSessionSuiv()->id]) }}" class="btn btn-info">Session Suivante</a>
            @endif

        </div>
        <div class="col-12">
          <ul class="list-group">
            @foreach($chapitre->getSessionsOrdonnees() as $s)
              <li class="list-group-item">
                <a href="{{ route('cours.watch', ['chapitre' => $chapitre->id, 'session' => $s->id]) }}">{{ $s->libelle }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@stop
