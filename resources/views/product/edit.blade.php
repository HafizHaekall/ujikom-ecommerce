@extends('layouts.main')

@section('title', 'Edit Produk')
@section('container')

<div id="updateProductModal" class="justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full mx-auto max-w-2xl max-h-full">
        <!-- Edit Content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Edit header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                <h3 class="text-xl font-semibold text-gray-900">Ubah Produk</h3>
                <a href="{{ route('create_product') }}" class="w-28 py-2 px-3 flex justify-center items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                    <span class="flex items-center justify-center"><i data-feather="rotate-ccw" class="w-4 h-5 mr-1"></i>Kembali</span>
                </a>
            </div>

            <!-- Edit body -->
            <form action="{{ route('update_product', $product) }}" method="post" enctype="multipart/form-data">
                @method('patch')
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
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            class="bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full p-2.5"
                            placeholder="Masukkan Nama Produk" required="">
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-black">Harga</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                            class="bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full p-2.5"
                            placeholder="Masukkan Harga" required>
                    </div>
                    <div>
                        <label for="stock" class="block mb-2 text-sm font-medium text-black">Stok</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                            class="bg-neutral-10 border border-neutral-30 text-black text-sm rounded-lg focus:ring-primary-20 focus:border-primary-40 block w-full p-2.5"
                            placeholder="Masukkan Stok" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-black">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="block p-2.5 w-full text-sm text-black bg-neutral-10 rounded-lg border border-neutral-30 focus:ring-primary-20 focus:border-primary-40"
                            placeholder="Tambahkan deskripsi">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center">
                    <button type="submit"
                        class="inline-flex items-center text-white bg-primary-20 border-[1.5px] border-primary-20 hover:text-primary-20 hover:bg-transparent duration-[400ms] font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Ubah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection