@extends('layouts.main')

@section('title', 'Dashboard')
@section('container')

<div class="max-w-2xl">
    <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}</h1>
    <img src="{{ asset('img/dashboard.jpg') }}" alt="">
</div>

<script>
    //message with toastr
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>

@endsection