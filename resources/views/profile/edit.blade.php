@extends('layouts.main')

@section('title', 'Profil')
@section('container')

<section class="bg-white dark:bg-gray-900">
    <div class="flex gap-8 items-start px-4 mx-auto max-w-screen-xl lg:px-6">
        <div class="">
            <img class="w-56 rounded-full" src="{{ url('storage/' . Auth::user()->photo) }}" alt="user photo">
            <input class="relative w-60 mt-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
            <p class="mt-2 text-sm text-center text-gray-500" id="file_input_help">PNG, JPG or JPEG(MAX. 5MB)</p>
        </div>
        <div class="flex mt-4 md:mt-0">
            <div class="flex flex-col items-center justify-start px-6 mx-auto ">
                <div class="w-[1000px] h-[440px] bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Profil Saya
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="name" name="name" id="name" value="{{ Auth::user()->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" placeholder="" required="">
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" placeholder="" required="">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="address" class="block mb-2 text-sm font-medium text-black">Alamat</label>
                                    <textarea name="address" id="address" rows="4"
                                    class="block p-2.5 w-full text-sm text-black bg-neutral-10 rounded-lg border border-gray-300 focus:ring-primary-20 focus:border-primary-20"
                                    placeholder="Tambahkan Alamat lengkap">{{ old('address') }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center justify-start px-6 mx-auto">
                <div class="w-[1000px] h-[440px] bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Ubah Kata Sandi
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi lama</label>
                                <input type="name" name="name" id="name" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" placeholder="" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi baru</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" required="">
                            </div>
                            <div>
                                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi kata sandi</label>
                                <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-20 focus:border-primary-20 block w-full p-2.5" required="">
                            </div>
                        </form>
                        <form action="" method="post" class="flex justify-end">
                            @csrf
                            <button type="submit" class="text-white w-52 bg-primary-20 hover:text-primary-20 border-[1.5px] border-primary-20 hover:bg-transparent hover:border-[1.5px] hover:border-primary-20 duration-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                                <span class="flex"><i data-feather="check-square" class="h-5 w-4 mr-2"></i>Simpan Perubahan</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection