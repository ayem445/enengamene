@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-laptop.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Laravel Vue-Vuex Pagination with Search</h1>
        <p class="fs-18 opacity-70">Edit Product</p>

      </div>
    </div>

  </div>
</header>
@stop

@section('content')

<section class="section">
  <div class="container">



  <div class="bg-white shadow-md rounded px-3 md:px-8 pt-3 md:pt-6 pb-3 md:pb-8 mb-4">

      <div class="mb-4">

          <h2 class="text-blue-600 text-lg font-bold mb-3 border-b border-gray-400 pb-2">Edit {{ $product->name }}</h2>

      </div>

  </div>




</div>
</section>
@stop
