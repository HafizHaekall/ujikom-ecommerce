@extends('layouts.main')

@section('title', 'Login')
@section('container')

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    <input type="password" name="password" required autocomplete="current-password">
    <button type="submit">Login</button>
</form>


@endsection