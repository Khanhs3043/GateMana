@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gán thẻ cho người dùng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/assign-card" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">Chọn người dùng:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Chọn người dùng --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} (ID: {{ $user->id }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="card_id">Chọn thẻ:</label>
            <select name="card_id" id="card_id" class="form-control" required>
                <option value="">-- Chọn thẻ --</option>
                @foreach ($unknownCards as $card)
                    <option value="{{ $card->card_id }}">ID: {{ $card->card_id }}</option>
                @endforeach
            </select>
        </div>

        <div style="width:100%; display:flex; justify-content:center"><button type="submit" class="btn btn-primary" style="min-width:300px ">Gán thẻ</button></div>
    </form>
</div>
@endsection
