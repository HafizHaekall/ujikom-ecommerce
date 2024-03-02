@extends('layouts.main')

@section('title', $product->name)
@section('container')

<section class="bg-white dark:bg-gray-900">
    <div class="flex flex-row gap-8 py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 lg:px-28">
        <img class="w-80 h-80 block rounded-xl" src="{{ url('storage/' . $product->image) }}" alt="dashboard image">
        <div class="mt-4 md:mt-0">
            <p class="font-bold text-gray-900 md:text-2xl dark:text-gray-400">{{ $product->name }}</p>
            <p class="mb-4 font-medium text-gray-900 dark:text-gray-400">{{ $product->description }}</p>
            <h2 class="mb-10 text-3xl tracking-tight font-extrabold text-gray-900 dark:text-white">Rp{{ $product->price }}</h2>

            <form action="{{ route('add_to_cart', $product) }}" method="post" class="mb-4 max-w-xs mx-auto">
                @csrf
                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Stok:</label>
                <div class="relative flex items-center max-w-[8rem]">
                    <button type="button" id="decrement-button" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-l-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                        </svg>
                    </button>
                    <input type="text" id="quantity-input" name="amount" data-input-counter data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="1" required />
                    <button type="button" id="increment-button" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-r-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-4">
                    <button type="submit" class="flex items-center justify-center text-white bg-primary-20 border-[1.5px] border-primary-20 hover:text-primary-20 hover:bg-transparent duration-[400ms] font-medium rounded-lg text-sm px-4 py-2">
                        <i data-feather="shopping-cart" class="w-5 mr-2"></i>
                        Masukkan Keranjang
                    </button>
                </div>
            </form>          
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
            @endif
        </div>
    </div>
</section>

@endsection