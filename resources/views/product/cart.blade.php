@extends('layouts.main')

@section('title', 'Cart')
@section('container')

<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-neutral-60">
        <thead class="text-sm text-neutral-60 uppercase bg-neutral-10">
            <tr>
                <th scope="col" class="px-4 py-4">Produk</th>
                <th scope="col" class="px-4 py-3">Jumlah</th>
                <th scope="col" class="px-4 py-3">Diskon</th>
                <th scope="col" class="px-4 py-3">Total Harga</th>
                <th scope="col" class="px-4 py-3">Aksi</th>
                <th scope="col" class="px-4 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            @php
                $total_price = 0;
            @endphp
            @php
                $total_price += $cart->product->price * $cart->amount;
            @endphp
                @if ($total_price >= 200000)
                @php
                    $discount = 0.2 * $total_price;
                    $disc = '20%';
                @endphp
            @else
                @php
                    $discount = 0;
                    $disc = '0%';
                @endphp
            @endif
            @php
                $total_bayar = $total_price - $discount;
            @endphp
                <tr class="border-b">
                    <td class="flex gap-6 px-4 py-3 max-w-[20rem]"><img src="{{ url('/storage/' . $cart->product->image) }}" class="w-16 h-16 object-cover rounded"><span class="text-lg truncate">{{ $cart->product->name }}</span></td>
                    <td class="px-4 py-3 max-w-[10rem]">{{ $cart->amount }}</td>
                    <td class="px-4 py-3 max-w-[10rem]">{{ $disc }}</td>
                    <td class="px-4 py-3">Rp. {{ number_format($total_bayar, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center space-x-2">
                            <button type="button" data-drawer-target="drawer-update-product" data-drawer-show="drawer-update-product" aria-controls="drawer-update-product" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
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
            @endforeach
        </tbody>
    </table>
</div>

@endsection