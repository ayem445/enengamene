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
            <p class="text-center">
              <span class="badge badge-dark">{{ $cour->duree }}</span>
            </p>
          </div>
        </div>

      </div>
    </section>

    <section class="section bg-gray">
        <div class="container">
          <header class="section-header">
            <h2>Les Chapitres du Cours</h2>
          </header>

          <div class="accordion" id="accordion-chapitres">

              @forelse($cour->chapitres as $chapitre)

                <div class="card">
                  <h3 class="card-title">
                    <a class="d-flex" data-toggle="collapse" data-parent="#accordion-chapitres" href="#{{ $chapitre->code }}">
                      <span class="mr-auto">{{ $chapitre->libelle }}</span>
                      <span class="text-lighter hidden-sm-down"><i class="fa fa-signal mr-8"></i> {{ $chapitre->difficulte->libelle }}</span>
                    </a>
                  </h3>

                  <div id="{{ $chapitre->code }}" class="collapse in">
                    <div class="card-block">
                    <p>{{ $chapitre->description }}</p>
                    <table class="table table-cart">
                      <tbody valign="middle">

                        @forelse($chapitre->sessions as $session)
                        <tr>

                          <td>
                            <h5>{{ $session->libelle }}</h5>
                            <p>{{ $session->description }}</p>
                          </td>

                          <td valign="center">
                            <label><i class="fa fa-file-video-o mr-0"></i></label>
                            <p>{{ $session->duree_hhmmss }}</p>
                          </td>

                          <td>
                            <a class="btn btn-xs btn-round btn-success" href="{{ route('cours.watch', ['chapitre' => $chapitre->id, 'session' => $session->id]) }}">Visionner <i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                          </td>
                        </tr>
                        @empty
                        @endforelse
                      </tbody>
                    </table>

                  </div>
                  </div>
                </div>

              @empty
              @endforelse
          </div>

        </div>
      </section>
@endsection
