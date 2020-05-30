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
      @php
        $nextSession = $session->sessionSuiv();
        $prevSession = $session->sessionPrec();
      @endphp
      <div class="row gap-y text-center">
        <div class="col-12">

            <vue-player default_session="{{$session}}"
            @if($nextSession->id !== $session->id)
                next_session_url="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->sessionSuiv()->id]) }}"
            @endif
            ></vue-player>

            <nav class="flexbox mb-50">
              @if($prevSession->id !== $session->id)
              <a class="btn btn-white" href="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->sessionPrec()->id]) }}"><i class="fa fa-backward fs-9 mr-4" aria-hidden="true"></i> Session Précédente</a>
              @else
              <a class="btn btn-white disabled" href="#"><i class="fa fa-backward fs-9 mr-4" aria-hidden="true"></i> Session Précédente</a>
              @endif
              @if($nextSession->id !== $session->id)
              <a class="btn btn-white" href="{{ route('cours.watch', ['chapitre' => $session->chapitre, 'session' => $session->sessionSuiv()->id]) }}">Session Suivante <i class="fa fa-forward fs-9 ml-4" aria-hidden="true"></i></a>
              @else
              <a class="btn btn-white disabled" href="#">Session Suivante <i class="fa fa-forward fs-9 ml-4" aria-hidden="true"></i></a>
              @endif
            </nav>

        </div>
        <div class="col-12">

          <header class="section-header">
            <small><strong>Chapitre:</strong></small>
            <h2>{{ $chapitre->libelle }}</h2>
            <hr>
            <p>{{ $chapitre->description }}</p>
            <p class="text-center">
              <span class="badge badge-danger">{{ $chapitre->duree }}</span>
            </p>
          </header>

          <ul class="list-group">
            @foreach($chapitre->getSessionsOrdonnees() as $s)
              <li class="list-group-item
              @if($s->id == $session->id)
                active
              @endif">
                <a href="{{ route('cours.watch', ['chapitre' => $chapitre->id, 'session' => $s->id]) }}">{{ $s->libelle }} </a>
                <small><span class="badge badge badge-secondary p-5"> {{ $s->duree_hhmmss }}</span>
                @auth
                  @if(auth()->user()->aTermineeSession($s))
                    <label class="badge badge-success">terminée</label>
                  @endif
                @endauth
                </small>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@stop
