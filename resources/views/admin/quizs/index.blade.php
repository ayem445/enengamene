@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-laptop.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Modélisation Quiz</h1>
        <p class="fs-18 opacity-70">Gestion des Questions/Réponses du Quiz</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')
<section class="section" id="section-open-positions">
  <div class="container">
    <header class="section-header">

      <h2>{{ $quiz->libelle }}</h2>
      <hr>
      <p class="lead">{{ $quiz->description }}
        <footer class="blockquote-footer">{{ $quiz->commentaire }}</footer>
      </p>
    </header>

    <header class="section-header">
      <small>questions du Quiz</small>
    </header>

    <vue-quizquestions default_questions="{{ json_encode($quiz->questions) }}" quiz_id="{{ $quiz->id }}" default_typequestions="{{ $typequestions->toJson() }}"></vue-quizquestions>

  </div>
</section>
@stop
