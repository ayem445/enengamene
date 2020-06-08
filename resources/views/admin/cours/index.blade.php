@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-laptop.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Modélisation Cours</h1>
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

      <h2>{{ $cour->libelle }}</h2>
      <hr>
      <p class="lead">{{ $cour->description }}
        <p>
          @if($cour->quiz_id)

            <small>
              <div class="btn-group">
                <a href="/admin/quizs/{{ $cour->quiz_id }} ">
                  <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                </a>
              @if($cour->quiz->is_complet)

                  <span class="badge badge-succes">complet</span>
                  <span class="badge badge-info">{{ $cour->quiz->nbquestions }}</span>

              @else

                  <span class="badge badge-danger">complet</span>
                  <span class="badge badge-info">{{ $cour->quiz->nbquestions }}</span>

              @endif

              <span>
                <a href="#" onclick="if(confirm('Etes-vous sur de vouloir supprimer?')) {event.preventDefault(); document.getElementById('index_destroy-form-{{ $cour->quiz->id }}').submit();}">
                  <i class="ti-trash" style="color:red"></i>
                </a>
                <form id="index_destroy-form-{{ $cour->quiz->id }}" action="{{ action('QuizController@destroycour', $cour->id) }}" method="POST" style="display: none;">

                  @csrf
                  <input type="hidden" value="{{ $cour->id }}" name="cour_by_id">
                  <input type="hidden" value="{{ $cour->quiz->id }}" name="id">
                </form>
              </span>

              </div>
            </small>
          @else
          <a href="/admin/quizcours/{{ $cour->id }}/create ">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          </a>
          @endif

        </p>
        <footer class="blockquote-footer">{{ $cour->commentaire }}</footer>
      </p>
    </header>

    <header class="section-header">
      <small>Chapitres du Cours</small>
    </header>

    <vue-chapitres default_chapitres="{{ json_encode($cour->chapitres) }}" cour_id="{{ $cour->id }}" default_difficultes="{{ $difficultes->toJson() }}" ></vue-chapitres>

  </div>
</section>
@stop
