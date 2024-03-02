@extends('layouts.main')

@section('title', 'Order')
@section('container')

<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-neutral-60">
        <thead class="text-sm text-neutral-60 uppercase bg-neutral-10">
            <tr>
                <th scope="col" class="px-4 py-4">ORDER ID</th>
                <th scope="col" class="px-4 py-3">Nama Pemesan</th>
                <th scope="col" class="px-4 py-3">Waktu</th>
                <th scope="col" class="px-4 py-3">Total Harga</th>
                <th scope="col" class="px-4 py-3">Status</th>
                <th scope="col" class="px-4 py-3">Bukti Pembayaran</th>
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
            @foreach ($orders as $order)
                @php
                    foreach ($order->transactions as $transaction) {
                        $total_payment += $transaction->product->price * $transaction->amount;
                    }
                @endphp
                <tr class="border-b">
                    <td class="px-4 py-3 max-w-[5rem]">{{ $order->id }}</td>
                    <td class="px-4 py-3 max-w-[10rem]">{{ $order->user->name }}</td>
                    <td class="px-4 py-3 max-w-[10rem]">{{ $order->created_at }}</td>
                    <td class="px-4 py-3 max-w-[10rem]">Rp. {{ number_format($total_payment, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 max-w-[5rem]">
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
                    <td class="px-4 py-3 max-w-[10rem]">
                        @if ($order->is_paid == false && $order->payment_receipt == null && !Auth::user()->is_admin)
                        <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="payment_receipt" id="payment_receipt" class="w-full mb-1">
                            <button type="submit" class="w-full py-2 px-3 flex justify-center items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                                <span class="flex items-center justify-center"><i data-feather="send" class="w-4 h-5 mr-1"></i>Kirim</span>
                            </button>
                        </form>
                        @endif
                        @if ($order->payment_receipt)
                            <a href="{{ url('storage/' . $order->payment_receipt) }}" target="blank" class="w-full py-2 px-3 flex justify-center items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                                Lihat bukti pembayaran
                            </a>
                        @else
                            <p>Belum ada</p>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center space-x-2">
                            <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="py-2 px-3 flex items-center text-sm font-medium text-center text-primary-20 bg-transparent border-[1.5px] border-primary-20 rounded-lg hover:text-white hover:bg-primary-20 duration-300">
                                <i data-feather="eye" class="h-5 w-4"></i>
                            </button>
                            @if (Auth::user()->is_admin)
                            @if (!$order->payment_receipt)
                            <button type="button" data-modal-target="confirm-modal" data-modal-toggle="confirm-modal" class="flex items-center bg-primary-20 text-white hover:text-primary-20 border-[1.5px] border-primary-20 hover:bg-transparent  font-medium rounded-lg text-sm px-3 py-2 text-center duration-300">
                                <i data-feather="check-square" class="h-5 w-4"></i>
                            </button>
                            @endif
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>        
</div>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                @php
                $total_payment = 0;
                @endphp
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Order ID : {{ $order->id }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="flex justify-around p-4 md:p-5 space-y-4">
                <div class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    <span>Nama Pemesan : {{ $order->user->name }}</span><br>
                    <span>Pesanan : </span><br>
                    @foreach ($order->transactions as $transaction)
                        <span>- {{ $transaction->product->name }} | {{ $transaction->amount }} pcs</span><br>
                        @php
                            $total_payment += $transaction->product->price * $transaction->amount;
                        @endphp
                    @endforeach
                </div>
                <div class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    <span>Waktu : {{ $order->created_at }}</span><br>
                    <span>Total Harga : Rp. {{ number_format($total_payment, 0, ',', '.') }}</span><br>
                    <span>Status : </span>
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm modal -->
<div id="confirm-modal" tabindex="-1" aria-hidden="true"
class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
            <button type="button"
                class="text-neutral-60 absolute top-2.5 right-2.5 bg-transparent hover:bg-neutral-20 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center"
                data-modal-toggle="confirm-modal">
                <i data-feather="x"></i>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="text-primary-20 w-11 h-11 my-3.5 mx-auto">
                <i data-feather="check-square" class="h-10 w-10"></i>
            </div>
            <p class="mb-4 text-neutral-60">Konfirmasi Pesanan?</p>
            <div class="flex justify-center items-center">
                <form action="{{ route('confirm_payment', $order) }}" id="confirm_form" method="POST">
                    @csrf
                    <button type="reset" data-modal-toggle="confirm-modal" type="button"
                        class="w-20 py-2 px-3 mr-3 text-sm font-medium text-neutral-60 bg-white rounded-lg border border-neutral-30 hover:bg-neutral-20 duration-[400ms] hover:text-black">
                        Tidak</button>
                    <button type="submit"
                        class="w-20 py-2 px-3 text-sm font-medium text-center text-white bg-primary-20 rounded-lg duration-[400ms]">
                        Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
