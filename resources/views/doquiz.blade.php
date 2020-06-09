@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-cup.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>QUIZ</h1>
        <p class="fs-18 opacity-70">Réalisez un meilleur Score pour valider vos acquis.</p>

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
            <vue-doquiz default_quiz="{{ $quiz }}" default_questions="{{ $questions }}"></vue-doquiz>
        </div>
      </div>
    </div>
  </div>
@stop
