@extends('layouts.dashboardmain')

@section('title', 'Profil')
@section('container')

<section class="bg-white dark:bg-gray-900">
    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="">
    @csrf
        <div class="flex gap-8 items-start px-4 mx-auto max-w-screen-xl lg:px-6">

            <div class="flex mt-4 md:mt-0">
                <div class="flex flex-col items-center justify-start px-6 mx-auto ">
                    <div class="w-[1000px] h-[530px] bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 sm:p-8">
                            <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Profil Saya
                            </h1>
                            <div class="flex gap-4">
                                <img class="w-24 rounded-full" src="{{ url('storage/' . Auth::user()->photo) }}" alt="user photo">
                                <div>
                                    <input type="file" id="photo" name="photo" class="relative w-60 h-10 mt-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help">
                                    <p class="mt-2 text-sm text-center text-gray-500" id="file_input_help">PNG, JPG or JPEG(MAX. 5MB)</p>
                                </div>
                            </div>
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="name" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" placeholder="" required="">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" placeholder="" required="">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="address" class="block mb-2 text-sm font-medium text-black">Alamat</label>
                                    <textarea name="address" id="address" rows="4"
                                    class="block p-2.5 w-full text-sm text-black bg-neutral-10 rounded-lg border border-gray-300 focus:ring-primary-20 focus:border-primary-20"
                                    placeholder="Tambahkan Alamat lengkap">{{ old('address', Auth::user()->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-start px-6 mx-auto">
                    <div class="w-[1000px] h-[530px] bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 sm:p-8">
                            <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Ubah Kata Sandi
                            </h1>
                            <div class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi lama</label>
                                    <input type="password" name="current_password" id="current_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" placeholder="">
                                </div>
                                <div>
                                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi baru</label>
                                    <input type="password" name="new_password" id="new_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi kata sandi</label>
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="text-center text-white w-52 bg-primary-20 hover:text-primary-20 border-[1.5px] border-primary-20 hover:bg-transparent hover:border-[1.5px] hover:border-primary-20 duration-300 font-medium rounded-lg text-sm px-4 py-2">
                                    <span class="flex justify-center"><i data-feather="check-square" class="h-5 w-4 mr-2"></i>Simpan Perubahan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection