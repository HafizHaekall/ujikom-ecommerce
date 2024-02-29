@extends('layouts.main')

@section('title', 'Register')
@section('container')

<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" value="{{ old('name') }}" required autofocus>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <input type="password" name="password" required autocomplete="new-password">
    {{-- <input type="text" name="role" value="{{ old('role') }}" required> --}}
    <input type="file" name="photo">
    <button type="submit">Register</button>
</form>

@endsection