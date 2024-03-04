@extends('layouts.main')

@section('title', 'Tambah')
@section('container')

        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3">
        <button type="button" id="createProductModalButton" data-modal-target="createProductModal"
            data-modal-toggle="createProductModal"
            class="flex items-center justify-center text-white bg-primary-20 border-[1.5px] border-primary-20 hover:text-primary-20 hover:bg-transparent duration-[400ms] font-medium rounded-lg text-sm px-4 py-2">
            <i data-feather="plus" class="w-5 mr-1"></i>
            <span>Tambah Produk</span>
        </button>
        </div>

        <div class="">
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
                            <td class="px-4 py-3 max-w-[10rem] font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('edit_product', $product) }}" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-20 border-[1.5px] border-primary-20 rounded-lg hover:text-primary-20 hover:bg-transparent duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-4" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
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

    <!-- Update modal -->
    <div id="updateProductModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5">
                    <h3 class="text-xl font-semibold text-gray-900">Ubah Produk</h3>
                    <button type="button"
                        class="text-gray-900 duration-[400ms] rounded-lg text-sm p-2 ml-auto inline-flex items-center"
                        data-modal-target="updateProductModal" data-modal-toggle="updateProductModal">
                        <i data-feather="x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form id="update-product" method="post" enctype="multipart/form-data">
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
                                placeholder="Tambahkan deskripsi">{{ old('description', $product->description) }}"</textarea>
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
                    <form action="{{ route('delete_product', $product) }}" id="delete_form" method="POST">
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

    <script>
        function updateProduct(formLink) {
            document.getElementById('update-product').action = formLink;
        }
    </script>

@endsection