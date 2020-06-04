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
          <a href="/admin/quizs/{{ $cour->quiz_id }} ">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i> ({{ $cour->quiz->nbquestions }})
          @else
          <a href="/admin/quizcours/create/{{ $cour->id }} ">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
          @endif
          </a>
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
