@extends('layouts.app')

@section('header')
<header class="header header-inverse h-fullscreen pb-80" data-parallax="{{ asset('assets/img/bg-man1.jpg ') }}" data-overlay="8">
    <div class="container text-center">

    <div class="row h-full">
        <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

        <h1 class="hidden-sm-down">Enenga-Mènè ... <span class="text-primary" data-type="Apprentissage évolutif, Vidéos en ligne, Auto-évaluation, Enseignants qualifiés"></span></h1>
        <p class="hidden-md-up">La Meilleure Application-Web de cours en ligne (optimisée pour le Système éducatif Gabonais)</p>
        <br>
        <p class="lead text-white fs-20 hidden-sm-down"><span class="fw-400">Enenga-Mènè</span> est une application-web de cours en ligne <br> évolutive et Optimisée pour le <span class="mark-border">Système Educatif Gabonais  </span>.</p>

        <br><br><br>

        <a class="btn btn-lg btn-round w-200 btn-primary mr-16" href="/coursall">Voir plus</a>

        </div>

        <div class="col-12 align-self-end text-center">
        <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
        </div>

    </div>

    </div>
</header>
@stop

@section('content')

<section class="section">
  <div class="container">
    <header class="section-header">
      <h2>Les Cours Disponibles</h2>
      <hr>
      <p class="lead">Liste des cours disponibles dans le système.</p>
    </header>

    <div class="swiper-container swiper-button-circular" data-slides-per-view="5" data-space-between="50" data-centered-slides="true">
      <div class="swiper-wrapper pb-0">

        @forelse($cours as $c)
          <div class="swiper-slide">

            <div class="card card-bordered card-hover-shadow">
              <a href="{{ route('cours', $c->id) }}"><img class="card-img-top" src="{{ $c->image_path }}" alt="Card image cap"></a>
              <div class="card-block">
                <h4 class="card-title"><a href="{{ route('cours', $c->id) }}">{{ $c->libelle }}</a></h4>
                <p class="card-text d-inline-block text-truncate" style="max-width: 150px;">{{ $c->description }}</p>
                <a class="fw-600 fs-12" href="{{ route('cours', $c->id) }}">En savoir plus <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
              </div>
            </div>

          </div>
        @empty
        @endforelse

      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>

  </div>
</section>

<section class="section">
  <div class="container">
    <header class="section-header">
      <small></small>
      <h2>Cours par Matière</h2>
      <hr>
      <p class="lead"></p>
    </header>


    <div data-provide="shuffle">
      <div class="text-center gap-multiline-items-2" data-shuffle="filter">
        <button class="btn btn-w-md btn-outline btn-round btn-info active" data-shuffle="button">All</button>
        @forelse($matieres as $m)
          <button class="btn btn-outline btn-round btn-info" data-shuffle="button" data-group="{{ $m->code }}">{{ $m->libelle }}</button>
        @empty
        @endforelse
      </div>

      <br><br>

      <div class="row gap-y text-center" data-shuffle="list">

        @forelse($cours as $cm)
          <div class="col-12 col-md-6 col-lg-4 portfolio-2" data-shuffle="item" data-groups="{{ $cm->matiere->code }}">
            <p><a href="demo-helpato.html"><img src="{{ $cm->image_path }}" alt="demo helpato landing"></a></p>
            <p><strong>{{ $cm->libelle }}</strong></p>
            <p class="card-text d-inline-block text-truncate" style="max-width: 150px;"><small>{{ $cm->description }}</small></p>
          </div>
        @empty
        @endforelse

      </div>

    </div>


  </div>
</section>


<section class="section">
  <div class="container">
    <header class="section-header">
      <h2>Nos Auteurs</h2>
      <hr>
      <p class="lead">Des Auteurs hautement qualifiés préparent et mettent en place les cours proposés.</p>
    </header>



    <div class="swiper-container swiper-button-circular" data-slides-per-view="2" data-space-between="50" data-centered-slides="true">
      <div class="swiper-wrapper pb-0">

        @forelse($auteurs as $a)

            <div class="swiper-slide">
              <div class="card card-shadowed">
                <div class="card-block px-30">
                  <div class="rating mb-12">
                  <label class="fa fa-star active"></label>
                  <label class="fa fa-star active"></label>
                  <label class="fa fa-star active"></label>
                  <label class="fa fa-star active"></label>
                  <label class="fa fa-star active"></label>
                  </div>

                  <p class="text-quoted mb-0">{{ $a->resume }}</p>
                  <div class="media align-items-center pb-0">
                    <img class="avatar avatar-xs" src="assets/img/avatar/1.jpg" alt="...">
                    <div class="media-body lh-1">
                      <h6 class="mb-0">{{ $a->personne->nom_complet }}</h6>
                      <small>{{ $a->personne->email }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        @empty
        @endforelse

      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>

  </div>
</section>

@stop
