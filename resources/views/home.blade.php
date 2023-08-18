@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (isset($message) && !is_null($message))
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Url</th>
                                <th>Favorito</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pokemonList as $pokemon)
                                <tr>
                                    <td>{{ $pokemon['name'] }}</td>
                                    <td>{{ $pokemon['url'] }}</td>
                                    <td>{{ $pokemon['favorite'] }}</td>
                                    <td>
                                        <a href="{{ route('pokemon', $pokemon['id']) }}">Ver</a>
                                        <a href="{{ route('pokemon.favorite', $pokemon['id']) }}">Favorito</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
