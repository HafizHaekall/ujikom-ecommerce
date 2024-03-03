@extends('layouts.main')

@section('title', 'Order')
@section('container')

<div class="mx-auto @if(Auth::user()->is_admin == true) w-[70%] @endif w-[50%] relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-base dark:bg-gray-800">
                    <a href="{{ route('index_order') }}" class="w-28 py-2 px-3 flex justify-center items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                        <span class="flex items-center justify-center"><i data-feather="rotate-ccw" class="w-4 h-5 mr-1"></i>Kembali</span>
                    </a>
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-200 text-base text-right">Detail Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="w-[50%] px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Order ID
                </th>
                <td class="px-6 py-4">
                    {{ $order->id }}
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Nama Pemesan
                </th>
                <td class="px-6 py-4">
                    {{ $order->user->name }}
                </td>
            </tr>
            @php
                $total_price = 0;
            @endphp
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Pesanan
                </th>
                @foreach ($order->transactions as $transaction)
                @php
                    $total_price += $transaction->product->price * $transaction->amount;
                @endphp
                <td class="block px-6 pt-1">
                    {{ $transaction->product->name }} | {{ $transaction->amount }}/Pcs
                </td>
            @endforeach
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                @if ($total_price >= 500000)
                    @php
                        $discount = 0.2 * $total_price;
                        $disc = '20%';
                    @endphp
                @elseif ($total_price >= 200000)
                    @php
                        $discount = 0.1 * $total_price;
                        $disc = '10%';
                    @endphp
                @else
                @php
                    $discount = 0;
                    $disc = '0';
                @endphp
                @endif
                @php
                    $total_payment = $total_price - $discount;
                @endphp
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Waktu
                </th>
                <td class="px-6 py-4">
                    {{ $order->created_at }}
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Total Harga
                </th>
                <td class="px-6 py-4">
                    Rp. {{ number_format($total_price, 0, ',', '.') }}
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Diskon
                </th>
                <td class="px-6 py-4">
                    {{ $disc }}
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Total Bayar
                </th>
                <td class="px-6 py-4">
                    Rp. {{ number_format($total_payment, 0, ',', '.') }}
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Status
                </th>
                <td class="px-6 py-4">
                    @if ($order->is_paid == true)
                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                        Paid
                    </span>
                    @else
                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                        Unpaid
                    </span>
                    @endif
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Bukti Pembayaran
                </th>
                <td class="px-6 py-4">
                    @if ($order->payment_receipt)
                        <a href="{{ url('storage/' . $order->payment_receipt) }}" target="blank" class="w-full py-2 px-3 flex justify-center items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                            Lihat bukti pembayaran
                        </a>
                    @endif
                    @if (Auth::user()->is_admin == true && $order->payment_receipt == null)
                        <p>Belum ada</p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>


@endsection