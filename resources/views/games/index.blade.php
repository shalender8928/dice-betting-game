@extends('layouts.app')

@section('title', 'Game History')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4 class="text-primary">Game History</h4>
    <a href="{{ route('games.play') }}" class="btn btn-primary btn-sm">Play Now</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Bet</th>
            <th>Dice</th>
            <th>Sum</th>
            <th>Balance</th>
            <th>Result</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($gameResults as $game)
            <tr class="{{ $game->result ? 'table-success' : 'table-danger' }}">
                <td>{{ $gameResults->firstItem() + $loop->index }}</td>
                <td>{{ ucfirst(str_replace('_',' ', $game->bet)) }}</td>
                <td>{{ $game->dice1 }} , {{ $game->dice2 }}</td>
                <td>{{ $game->sum }}</td>
                <td>₹{{ $game->balance }}</td>
                <td>{{ $game->result ? 'Win' : 'Loss' }}</td>
                <td>{{ $game->created_at->format('d M Y h:i A') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No games played yet</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $gameResults->links() }}

@endsection

