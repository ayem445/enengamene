@extends('layouts.app')

@section('header')
<header class="header header-inverse" style="background-color: #1ac28d">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Kati frantz</h1>
        <p class="fs-20 opacity-70">kati-frantz</p>
        <br>
        <h1>user->getTotalNumberOfCompletedLessons</h1>
        <p class="fs-20 opacity-70">Lessons completed</p>
      </div>
    </div>

  </div>
</header>
@stop

@section('content')
<section class="section" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Series being watched ...</h2>
        <hr>
        </header>


        <div class="row gap-5">


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
                  <a class="nav-link active" data-toggle="tab" href="#home-2">
                  <h6>Personal details</h6>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#messages-2">
                  <h6>Payments & Subscriptions</h6>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#settings-2">
                  <h6>Card details</h6>
                  </a>
              </li>

            </ul>
        </div>


        <div class="col-12 col-md-8 align-self-center">
            <div class="tab-content">

              <div class="tab-pane fade show active" id="home-2">
                  <form action="#" method="POST" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="form-group">
                              <input class="form-control form-control-lg" type="text" name="name" placeholder="Your name">
                          </div>
                          <div class="form-group">
                              <input class="form-control form-control-lg" type="text" name="email" placeholder="Your email">
                          </div>

                          <button class="btn btn-lg btn-primary btn-block" type="submit">Save changes</button>
                      </form>
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
