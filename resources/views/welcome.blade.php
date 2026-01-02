@extends('layouts.app')

@section('content')

<div class="d-grid justify-content-center align-content-start gap-3">
    <div class="text-center">
        
    @include('partials.svg.dice', [
        'width' => 80,
        'height' => 80,
        'color' => '#000000'
    ])
    </div>
    <h2>Dice Betting Game</h2>
    <p class="text-muted">Try your luck by rolling the dice.</p>

    <a href="{{ route('games.play') }}" class="btn btn-dark">
        Start Playing
    </a>
</div>
@endsection
