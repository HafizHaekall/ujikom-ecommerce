@extends('layouts.main')

@section('title', 'Tambah')
@section('container')

        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
        <button type="button" id="createProductModalButton" data-modal-target="createProductModal"
            data-modal-toggle="createProductModal"
            class="flex items-center justify-center text-white bg-primary-20 border-[1.5px] border-primary-20 hover:text-primary-20 hover:bg-transparent duration-[400ms] font-medium rounded-lg text-sm px-4 py-2">
            <i data-feather="plus" class="w-5 mr-1"></i>
            <span>Tambah Produk</span>
        </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-neutral-60">
                <thead class="text-sm text-neutral-60 uppercase bg-neutral-10">
                    <tr>
                        <th scope="col" class="px-4 py-4">Gambar</th>
                        <th scope="col" class="px-4 py-3">Nama Produk</th>
                        <th scope="col" class="px-4 py-3">Deskripsi</th>
                        <th scope="col" class="px-4 py-3">Harga</th>
                        <th scope="col" class="px-4 py-3">Stok</th>
                        <th scope="col" class="px-4 py-3">Aksi</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="px-4 py-3 max-w-[5rem]"><img src="{{ url('storage/' . $product->image) }}" alt=""></td>
                            <td class="px-4 py-3 max-w-[10rem]">{{ $product->name }}</td>
                            <td class="px-4 py-3 max-w-[15rem] truncate">{{ $product->description }}</td>
                            <td class="px-4 py-3 max-w-[10rem]">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 max-w-[5rem]">{{ $product->stock }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{-- <div class="flex items-center space-x-2">
                                    <a href="{{ route('show_order', $product) }}" data-modal-target="default-modal" data-modal-toggle="default-modal" class="py-2 px-3 flex items-center text-sm font-medium text-center text-primary-20 bg-transparent border-[1.5px] border-primary-20 rounded-lg hover:text-white hover:bg-primary-20 duration-300">
                                        <i data-feather="eye" class="h-5 w-4"></i>
                                    </a>
                                    @if (Auth::user()->is_admin == true && $product->is_paid == true)
                                    <a href="{{ route('nota', $product->id) }}" target="blank" class="flex items-center bg-primary-20 text-white hover:text-primary-20 border-[1.5px] border-primary-20 hover:bg-transparent  font-medium rounded-lg text-sm px-3 py-2 text-center duration-300">
                                        <i data-feather="printer" class="h-5 w-4"></i>
                                    </a>
                                    @endif
                                    @if (Auth::user()->is_admin == true && $product->is_paid == false)
                                    <button type="button" onclick="confirmOrder('{{ route('confirm_payment', $product->id) }}')" data-modal-target="confirm-modal" data-modal-toggle="confirm-modal" class="flex items-center bg-green-500 text-white hover:text-green-500 border-[1.5px] border-green-500 hover:bg-transparent font-medium rounded-lg text-sm px-3 py-2 text-center duration-300">
                                        <i data-feather="check-square" class="h-5 w-4"></i>
                                    </button>
                                    @endif
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Create modal -->
        <div id="createProductModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                    <h3 class="text-xl font-semibold text-gray-900">Tambah Produk</h3>
                    <button type="button"
                        class="text-gray-900 duration-[400ms] rounded-lg text-sm p-2 ml-auto inline-flex items-center"
                        data-modal-target="createProductModal" data-modal-toggle="createProductModal">
                        <i data-feather="x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="image" class="block mb-2 text-sm font-medium text-black">Gambar</label>
                            <input type="file" id="image" name="image"
                                class="form-control @error('image') is-invalid @enderror bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full cursor-pointer">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama Produk</label>
                            <input type="text" name="name" id="name"
                                class="bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full p-2.5"
                                placeholder="Masukkan Nama Produk" required="">
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-black">Harga</label>
                            <input type="number" name="price" id="price"
                                class="bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full p-2.5"
                                placeholder="Masukkan Harga" required>
                        </div>
                        <div>
                            <label for="stock" class="block mb-2 text-sm font-medium text-black">Stok</label>
                            <input type="text" name="stock" id="stock"
                                class="bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full p-2.5"
                                placeholder="Masukkan Stok" required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-black">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                class="block p-2.5 w-full text-sm text-black bg-neutral-10 rounded-lg border border-neutral-30 focus:ring-primary-20 focus:border-primary-40"
                                placeholder="Tambahkan deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end items-center">
                        <button type="submit"
                            class="inline-flex items-center text-white bg-primary-20 border-[1.5px] border-primary-20 hover:text-primary-20 hover:bg-transparent duration-[400ms] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection