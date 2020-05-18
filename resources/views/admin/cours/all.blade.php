@extends('layouts.app')

@section('header')
<header class="header header-inverse bg-fixed" style="background-image: url({{ asset('assets/img/bg-laptop.jpg') }})" data-overlay="8">
  <div class="container text-center">

    <div class="row">
      <div class="col-12 col-lg-8 offset-lg-2">

        <h1>Liste des Cours</h1>
        <p class="fs-18 opacity-70">Liste Exhaustive des Cours</p>

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
            <table class="table">
                <thead>
                    <th>Titre</th>
                    <th>Matière</th>
                    <th colspan="2"></th>
                </thead>
                <tbody>
                    @forelse($cours as $c)
                        <tr>
                            <td><a href="{{ route('cours.show', $c->id) }}">{{ $c->libelle }}</a></td>
                            <td>{{ $c->matiere->libelle }}</td>

                            <td style="width: 10px;">
                                <a href="{{ route('cours.edit', $c->id) }}" alt="Modifer" title="Edit">
                                  <i class="fa fa-pencil-square-o"></i>
                                </a>
                            </td>

                            <td style="width: 10px;">
                              <a href="#" onclick="if(confirm('Etes-vous sur de vouloir supprimer?')) {event.preventDefault(); document.getElementById('index_destroy-form-{{ $c->id }}').submit();}">
                                <i class="ti-trash" style="color:red"></i>
                              </a>
                              <form id="index_destroy-form-{{ $c->id }}" action="{{ action('CourController@destroy', $c->id) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" value="{{ $c->id }}" name="id">
                              </form>
                            </td>
                        </tr>
                    @empty
                        <p class="text-center">Aucun Cour</p>
                    @endforelse
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
@stop
