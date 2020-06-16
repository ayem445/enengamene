@extends('layouts.app')

@section('header')
<header class="header header-inverse" data-overlay="5">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $session->libelle }}</h1>
        <p class="fs-20 opacity-70">{{  $session->description }}</p>

      </div>
    </div>

  </div>
</header>

@stop


@section('content')
<header class="header header-inverse h-fullscreen p-0 overflow-hidden" data-overlay="5">

  <div class="container text-center">

    @php
      $nextSession = $session->sessionSuiv();
      $prevSession = $session->sessionPrec();
    @endphp

    <div class="row h-full">


      <div class="col-12">

          <header class="section-header">

              <vue-player default_session="{{$session}}"
              @if($nextSession->id !== $session->id)
                  next_session_url="{{ $session->getNextLink() }}"
              @endif
              ></vue-player>


          </header>

          <nav class="flexbox mb-50 p-0">
            @if($prevSession->id !== $session->id)
            <a class="btn btn-white" href="{{ route('cours.watch', ['chapitre' => $session->sessionPrec()->chapitre, 'session' => $session->sessionPrec()->id]) }}"><i class="fa fa-backward fs-9 mr-4" aria-hidden="true"></i> Session Précédente</a>
            @else
            <a class="btn btn-white disabled" href="#"><i class="fa fa-backward fs-9 mr-4" aria-hidden="true"></i> Session Précédente</a>
            @endif
            @if($nextSession->id !== $session->id)
            <a class="btn btn-white" href="{{ $session->getNextLink() }}">Session Suivante <i class="fa fa-forward fs-9 ml-4" aria-hidden="true"></i></a>
            @else
            <a class="btn btn-white disabled" href="#">Session Suivante <i class="fa fa-forward fs-9 ml-4" aria-hidden="true"></i></a>
            @endif
          </nav>

      </div>


    </div>

  </div>
</header>


<section class="section" id="section-intro">
  <div class="container">
    <header class="section-header">
      <small>Headers</small>
      <h2>More Headers</h2>
      <hr>
      <p class="lead">TheSaaS includes several header examples which can be use just by copy and paste the code</p>
    </header>


    <div class="row gap-y">

      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-color.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-color.jpg" alt="..."></p>
          <h6>Solid Color</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-gradient.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-gradient.jpg" alt="..."></p>
          <h6>Gradient</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-particle.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-particle.jpg" alt="..."></p>
          <h6>Particle</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-typing.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-typing.jpg" alt="..."></p>
          <h6>Typing Text</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-image.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-image.jpg" alt="..."></p>
          <h6>Background Image</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-video.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-video.jpg" alt="..."></p>
          <h6>Background Video</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-parallax.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-parallax.jpg" alt="..."></p>
          <h6>Parallax</h6>
        </a>
      </div>


      <div class="col-12 col-md-6 col-lg-4">
        <a class="text-center" href="header-slider.html">
          <p><img class="shadow-2 hover-shadow-5" src="assets/img/header-slider.jpg" alt="..."></p>
          <h6>Slider</h6>
        </a>
      </div>

    </div>


  </div>
</section>
@stop
