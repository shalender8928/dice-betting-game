@extends('layouts.app')

@section('title', 'Game Result')

@section('content')

<h3 class="mb-3">Game Result</h3>

<h5 class="{{ $result ? 'text-success' : 'text-danger' }}">
    {{ $result ? 'Congratulations!' : 'Better Luck Next Time!' }}
</h5>

<table class="table w-50">
    <tr><th>Dice</th><td>{{ $dice1 }} , {{ $dice2 }}</td></tr>
    <tr><th>Sum</th><td>{{ $sum }}</td></tr>
    <tr><th>Result</th><td>{{ $result ? 'Win' : 'Loss' }}</td></tr>
    <tr><th>Balance</th><td>₹{{ $balance }}</td></tr>
</table>

<div class="d-flex gap-2">
    <a href="{{ route('games.index') }}" class="btn btn-secondary">History</a>
    <a href="{{ route('games.play') }}" class="btn btn-success">Play Again</a>
    <form method="POST" action="{{ route('games.exit') }}">
        @csrf
        <button class="btn btn-danger">Exit Game</button>
    </form>
</div>

@endsection

