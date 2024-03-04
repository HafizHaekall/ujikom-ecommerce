@extends('layouts.main')

@section('title', 'Home')
@section('container')

<div class="flex flex-wrap gap-8 justify-center">
    @if ($products->isEmpty())
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
            <p data-feather="slash" class="h-16 w-16 mb-5 mx-auto"></p>
            <h1 class="mb-4 text-2xl font-semibold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl dark:text-white">Produk tidak tersedia</h1>
        </div>
    </section>
    @endif
    @foreach ($products as $product)
    <div class="max-w-sm lg:w-[250px] bg-white border border-gray-200 rounded-lg shadow hover:border-[1.5px] hover:border-primary-20 hover:-translate-y-1">
        <a href="{{ route('show_product', $product) }}">
            <div class="w-full h-[235px] overflow-hidden">
                <img class="object-cover w-full h-full rounded-t-lg" src="{{ url('storage/' . $product->image) }}" alt="">
            </div>
            <div class="pt-3 pl-3 mb-3">
                <p class="font-medium text-gray-700 dark:text-gray-400">{{ $product->name }}</p>
                <p class="text-xs font-normal text-gray-700 dark:text-gray-400 truncate">{{ $product->description }}</p>
            </div>
            <div class="flex items-center justify-between px-3 mb-2">
                <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Rp. {{ number_format($product->price, 0, ',', '.') }}</h5>
                <p class="font-normal text-xs text-gray-700 dark:text-gray-400">Tersisa {{ $product->stock }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>

@if (Session::has('success'))

    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
    
@endif

@endsection