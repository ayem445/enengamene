@extends('layouts.app')

@section('header')
<header class="header header-inverse h-fullscreen pb-80" data-parallax="{{ asset('assets/img/bg-man1.jpg ') }}" data-overlay="8">
    <div class="container text-center">

    <div class="row h-full">
        <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

        <h1 class="display-4 hidden-sm-down">Inenga-Mènè</h1>
        <h1 class="hidden-md-up">La Meilleure Application-Web de cours en ligne (optimisée pour le Système éducatif Gabonais)</h1>
        <br>
        <p class="lead text-white fs-20 hidden-sm-down"><span class="fw-400">Inenga-Mènè</span> est une application-web de cours en ligne <br> évolutive et Optimisée pour le <span class="mark-border">Système Educatif Gabonais  </span>.</p>

        <br><br><br>

        <a class="btn btn-lg btn-round w-200 btn-primary mr-16" href="/series">Voir plus</a>

        </div>

        <div class="col-12 align-self-end text-center">
        <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
        </div>

    </div>

    </div>
</header>
@stop

@section('content')

<section class="section bg-gray">
  <div class="container">
    <header class="section-header">
      <small>lessons</small>
      <h2>Featured Screencasts</h2>
      <hr>
      <p class="lead"></p>
    </header>
    @forelse($cours as $c)
      <div class="card mb-30">
        <div class="row">
          <div class="col-12 col-md-4 align-self-center">
            <a href="{{ route('cours', $c->id) }}"><img src="{{ $c->image_path }}" alt="..."></a>
          </div>

          <div class="col-12 col-md-8">
            <div class="card-block">
              <h4 class="card-title">{{ $c->libelle }}</h4>

              <p class="card-text">{{ $c->description }}</p>
              <a class="fw-600 fs-12" href="{{ route('cours', $c->id) }}">Plus de détails <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
            </div>
          </div>
        </div>
      </div>
    @empty
    @endforelse

  </div>
</section>

@stop
