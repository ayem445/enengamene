@extends('layouts.app')

@section('header')
        <header class="header header-inverse h-fullscreen pb-80" style="background-image: url({{ $cour->image_path }});" data-overlay="8">
            <div class="container text-center">

                <div class="row h-full">
                  <div class="col-12 col-lg-10 offset-lg-1 align-self-center">

                    <h1 class="display-4 hidden-sm-down">{{ $cour->libelle }}</h1>
                    <h1 class="hidden-md-up">{{ $cour->libelle }}</h1>
                    <br>
                    <br><br><br>
                    @auth
                      @aDemarreLeCours($cour)
                        <a href="{{ route('cours.learning', $cour->id) }}" class="btn btn-lg btn-primary mr-16 btn-round">Poursuivre l'Apprentissage</a>
                      @else
                        <a href="{{ route('cours.learning', $cour->id) }}" class="btn btn-lg btn-primary mr-16 btn-round">Commencer à Apprendre</a>
                      @endaDemarreLeCours
                    @else
                          <a href="{{ route('cours.learning', $cour->id) }}"  class="btn btn-lg btn-primary mr-16 btn-round">Commencer à Apprendre</a>
                    @endauth
                  </div>

                  <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
                  </div>

                </div>

              </div>
        </header>
@endsection

@section('content')
    <section class="section">
      <div class="container">
        <header class="section-header">
          <small><strong>DESCRIPTION du COURS</strong></small>
          <h2>De quoi parle ce cours</h2>
          <hr>
        </header>



        <div class="row gap-y">

          <div class="col-12 offset-md-2 col-md-8 mb-30">
            <p class="text-center">
              {{ $cour->description }}
            </p>
          </div>
        </div>

      </div>
    </section>

    <section class="section bg-gray">
        <div class="container">
          <header class="section-header">
            <h2>Video Lessons</h2>
            <hr>
            <p class="lead">Sneak peek of the lessons already available in this course</p>
          </header>
        </div>
      </section>
@endsection