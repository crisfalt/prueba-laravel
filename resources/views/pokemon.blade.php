@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>{{ $pokemon['name'] }}</h1>
                    <img src="{{ $pokemon['sprites']['front_default'] }}" alt="{{ $pokemon['name'] }}">
                    <h2>Abilities: </h2>
                    <ul>
                        @foreach ($pokemon['abilities'] as $ability)
                            <li>{{ $ability['ability']['name'] }}</li>
                        @endforeach
                    </ul>
                    <h3>Types:</h3>
                    <ul>
                        @foreach ($pokemon['types'] as $type)
                            <li>{{ $type['type']['name'] }}</li>
                        @endforeach
                    </ul>
                    
                    <h3>Stats:</h3>
                    <ul>
                        @foreach ($pokemon['stats'] as $stat)
                            <li>{{ $stat['stat']['name'] }}: {{ $stat['base_stat'] }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection