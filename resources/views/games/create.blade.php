@extends('layouts.app')

@section('title', 'Play Game')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <nav>
        <a href="{{ route('games.index') }}">← Back to History</a>
    </nav>
    <x-balance />
</div>

<p class="text-muted">
    Two dice will be rolled. Your selected option will determine win or loss.
</p>

<form method="POST" action="{{ route('games.store') }}">
    @csrf

    <select class="form-select mb-2" name="bet">
        <option value="">Select Bet</option>
        <option value="below_7" {{ old('bet')=='below_7'?'selected':'' }}>Below 7</option>
        <option value="above_7" {{ old('bet')=='above_7'?'selected':'' }}>Above 7</option>
        <option value="lucky_7" {{ old('bet')=='lucky_7'?'selected':'' }}>Lucky 7</option>
    </select>

    @error('bet')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    <button class="btn btn-info btn-sm mt-2">Play ₹10</button>
</form>

@endsection

