@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #1ac28d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>{{ $user->name }}</h1>
        <p class="fs-20 opacity-70">{{ $user->username }}</p>
        <br>
        <h1>{{ $user->getNombreTotalSessionsTerminees() }}</h1>
        <p class="fs-20 opacity-70">Session(s) terminée(s)</p>
      </div>
    </div>

  </div>
</header>
@stop

@section('content')
<section class="section" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Cours en cours de lecture ...</h2>
        <hr>
        </header>

        <div class="row gap-5">
            @forelse($cours as $c)
                <div class="card mb-30">
                <div class="row">
                    <div class="col-12 col-md-4 align-self-center">
                    <a href=""><img src="{{ $c->image_path }}" alt="..."></a>
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

    </div>
</section>

@if(auth()->id() === $user->id)
  <section class="section bg-gray" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Modifier votre Profile</h2>
        <hr>
        </header>


        <div class="row gap-5">


        <div class="col-12 col-md-4">
            <ul class="nav nav-vertical">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#infos-connexion">
                <h6>Infos Connexion</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#infos-perso">
                <h6>Infos Personnelles</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#learning-profile">
                <h6>Profile Apprentissage</h6>
                </a>
            </li>
            </ul>
        </div>


        <div class="col-12 col-md-8 align-self-center">
            <div class="tab-content">

            <div class="tab-pane fade show active" id="infos-connexion">
                <form action="{{ route('cours.store')  }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="username" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="email" placeholder="E-mail">
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider Infos Connexion</button>
                    </form>
            </div>

            <div class="tab-pane fade text-center" id="infos-perso">
              <form action="{{ route('cours.store')  }}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="email" placeholder="E-mail">
                      </div>
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="nom" placeholder="Nom">
                      </div>
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="prenom" placeholder="Prénom">
                      </div>
                      <div class="form-group">
                        <select name="sexe" class="form-control">
                            <option>Sexe ?</option>
                            <option>M</option>
                            <option>F</option>
                        </select>
                      </div>
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="adresse" placeholder="Adresse">
                      </div>
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="telephone" placeholder="Téléphone">
                      </div>
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="fonction" placeholder="Fonction">
                      </div>
                      <div class="form-group">
                          <input class="form-control form-control-lg" type="text" name="pays" placeholder="Pays">
                      </div>

                      <button class="btn btn-lg btn-primary btn-block" type="submit">Valider Infos Personnelles</button>
                  </form>
            </div>

            <div class="tab-pane fade" id="learning-profile">
                <p> <h5>Plan d'Apprentissage</h5> </p>
                <p>En cours de Construction ...</p>
            </div>

            </div>
        </div>


        </div>


    </div>
  </section>
@endif

@endsection

@section('scripts')

@endsection
