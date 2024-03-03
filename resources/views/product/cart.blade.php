@extends('layouts.main')

@section('title', 'Cart')
@section('container')

<section class="pb-12">
<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-neutral-60">
        <thead class="text-sm text-neutral-60 uppercase bg-neutral-10">
            <tr>
                <th scope="col" class="px-4 py-4">Produk</th>
                <th scope="col" class="px-4 py-3">Jumlah</th>
                <th scope="col" class="px-4 py-3">Diskon</th>
                <th scope="col" class="px-4 py-3">Harga</th>
                <th scope="col" class="px-4 py-3">Aksi</th>
                <th scope="col" class="px-4 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_payment = 0;
            @endphp
            @foreach ($carts as $cart)
                @php
                    $price = $cart->product->price * $cart->amount;
                    $discount = 0;
                    $disc = '0%';

                    if ($price >= 500000) {
                        $discount = 0.2 * $price;
                        $disc = '20%';
                    } elseif ($price >= 200000) {
                        $discount = 0.1 * $price;
                        $disc = '10%';
                    }

                    $total_price = $price - $discount;
                    $total_payment += $total_price;
                @endphp
                <tr class="border-b">
                    <td class="flex items-center gap-6 px-4 py-3 max-w-[20rem]">
                        <img src="{{ url('/storage/' . $cart->product->image) }}" class="w-16 h-16 object-cover rounded">
                        <span class="text-lg truncate">{{ $cart->product->name }}</span>
                    </td>
                    <td class="px-4 py-3 max-w-[10rem]">{{ $cart->amount }}</td>
                    <td class="px-4 py-3 max-w-[10rem]">
                        @if ($price >= 200000)
                            {{ $disc }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if ($price >= 200000)
                            <s class="text-xs mr-1 line-through text-red-600">Rp. {{ number_format($price, 0, ',', '.') }}</s>
                        @endif
                        Rp. {{ number_format($total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center space-x-2">
                            <button type="button" onclick="updateAmount({{ $cart->amount }}, '{{ route('update_cart', $cart) }}')" data-modal-target="update-modal" data-modal-toggle="update-modal" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-3 py-2 text-center duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>

            <!-- Update modal -->
            <div id="update-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                        <button type="button"
                            class="text-neutral-60 absolute top-2.5 right-2.5 bg-transparent hover:bg-neutral-20 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center"
                            data-modal-toggle="update-modal">
                            <i data-feather="x"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="flex flex-col items-center justify-center">
                            {{-- Tambah id disini + action kosongin dulu ja --}}
                            <form method="post" id="update-cart" class="mb-4 max-w-xs mx-auto">
                                @method('patch')
                                @csrf
                                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah Stok</label>
                                <div class="relative flex items-center max-w-[8rem]">
                                    <button type="button" id="decrement-button" class="bg-gray-100 border border-gray-300 rounded-l-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg>
                                    </button>
                                    <input type="text" id="amount" name="amount" data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5" required />
                                    <button type="button" id="increment-button" class="bg-gray-100 border border-gray-300 rounded-r-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-4 relative flex items-center">
                                    <button type="submit" class="flex items-center justify-center text-white bg-primary-20 border-[1.5px] border-primary-20 hover:text-primary-20 hover:bg-transparent duration-[400ms] font-medium rounded-lg text-sm w-32 px-4 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4 mr-1" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                        Ubah
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete modal -->
            <div id="delete-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
                        <button type="button"
                            class="text-neutral-60 absolute top-2.5 right-2.5 bg-transparent hover:bg-neutral-20 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center"
                            data-modal-toggle="delete-modal">
                            <i data-feather="x"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="text-primary-20 w-11 h-11 my-3.5 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mb-4 text-neutral-60">Apakah Anda Yakin?</p>
                        <div class="flex justify-center items-center">
                            <form action="{{ route('delete_cart', $cart) }}" id="delete_form" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="reset" data-modal-toggle="delete-modal" type="button"
                                    class="w-20 py-2 px-3 mr-3 text-sm font-medium text-neutral-60 bg-white rounded-lg border border-neutral-30 hover:bg-neutral-20 duration-[400ms] hover:text-black">
                                    Tidak</button>
                                <button type="submit"
                                    class="w-20 py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 duration-[400ms]">
                                    Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Checkout --}}
<nav class="bg-slate-200 border-gray-200 drop-shadow-md fixed w-full z-20 bottom-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-end gap-12 mx-auto p-4">
    <h4 class="text-xl font-semibold">Total Harga : Rp. {{ number_format($total_payment, 0, ',', '.') }}</h4>
        <div class="items-center justify-between hidden w-full lg:flex md:w-auto md:order-1" id="navbar-search">
            <div class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <button type="submit" class="text-white w-48 bg-primary-20 hover:text-primary-20 border-[1.5px] border-primary-20 hover:bg-transparent hover:border-[1.5px] hover:border-primary-20 duration-300 font-medium rounded-lg text-sm px-4 py-2 text-center"
                    @if ($carts->isEmpty()) disabled @endif>Checkout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
</section>

@if ($carts->isEmpty())
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-md text-center lg:py-16 lg:px-12">
        <p data-feather="alert-circle" class="h-16 w-16 mb-5 mx-auto"></p>
        <h1 class="mb-4 text-2xl font-semibold tracking-tight leading-none text-gray-900 lg:mb-6 md:text-4xl dark:text-white">Keranjangmu kosong</h1>
    </div>
</section>
@endif

<script>
        document.addEventListener("DOMContentLoaded", function() {
        const decrementButton = document.getElementById("decrement-button");
        const incrementButton = document.getElementById("increment-button");
        const amount = document.getElementById("amount");

        decrementButton.addEventListener("click", function() {
            let currentValue = parseInt(amount.value);
            if (currentValue > 1) {
                amount.value = currentValue - 1;
            }
        });

        incrementButton.addEventListener("click", function() {
            let currentValue = parseInt(amount.value);
            if (currentValue < parseInt(amount.getAttribute("data-input-counter-max"))) {
                amount.value = currentValue + 1;
            }
        });
    });

    function updateAmount(amount, formLink) {
        document.getElementById('amount').value = amount;
        document.getElementById('update-cart').action = formLink;
    }
</script>

@endsection