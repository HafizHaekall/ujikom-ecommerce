@extends('layouts.main')

@section('title', 'Register')

{{-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" value="{{ old('name') }}" required autofocus>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <input type="password" name="password" required autocomplete="new-password">
    <input type="file" name="photo">
    <button type="submit">Register</button>
</form> --}}

<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="{{ route('home') }}" class="flex items-center mb-6 text-3xl font-bold text-primary-20">
            <img class="h-10 mr-2" src="{{ asset('img/logo.png') }}" alt="logo">
            GRIDMERCE
        </a>
        <div class="lg:flex items-center gap-8">
            <div class="mb-10">
                <div class="flex justify-center">
                    <img src="{{ asset('img/register.png') }}" alt="" class="w-[45vw]">
                </div>
                <h1 class="text-center text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Beli Barang Ori Hanya Di GRIDMERCE
                </h1>
                <p class="text-center text-sm">Gabung dan jadikan hidupmu bermakna</p>
            </div>
            <div class="flex items-center justify-center w-full bg-white rounded-lg shadow-lg md:mt-0 sm:max-w-md py-2 px-4">
                <div class="p-2 space-y-4 md:space-y-6 sm:p-4 w-full">
                    <h1 class="text-center text-xl font-semibold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Daftar Sekarang
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="relative">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input" id="file_input_help">Upload Foto <span class="mt-1 text-sm text-gray-500">| PNG, JPG or JPEG (MAX. 5MB)</p></label>
                            <input type="file" name="photo" id="file_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help">
                        </div>
                        @error('photo')
                        <script>
                            document.getElementById('file_input').style.display = 'none';
                            document.getElementById('file_input_help').style.display = 'none';
                        </script>
                        <div>                   
                            <div class="relative">
                                <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload Foto <span class="mt-1 text-sm text-gray-500" id="file_input_help">| PNG, JPG or JPEG (MAX. 10MB).</p></label>
                                <input type="file" name="photo" id="file_input" class="block w-full text-sm text-red-600 border border-red-600 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help">
                            </div>
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        </div>
                        @enderror
                        <div class="relative">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_outlined" class="absolute text-sm text-gray-900 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nama</label>
                        </div>
                        @error('name')
                        <script>
                            document.getElementById('name').style.display = 'none';
                        </script>
                        <div>   
                            <div class="relative">
                                <input type="text" id="outlined_error" value="{{ old('name') }}" aria-describedby="outlined_error_help" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none border-red-600 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                <label for="outlined_error" class="absolute text-sm text-red-600 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Nama</label>
                            </div>
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">{{ $message }}</p>    
                        </div>
                        @enderror 
                        <div class="relative">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_outlined" class="absolute text-sm text-gray-900 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                        </div>
                        @error('email')
                        <script>
                            document.getElementById('email').style.display = 'none';
                        </script>
                        <div>   
                            <div class="relative">
                                <input type="text" id="outlined_error" value="{{ old('email') }}" aria-describedby="outlined_error_help" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none border-red-600 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                <label for="outlined_error" class="absolute text-sm text-red-600 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email</label>
                            </div>
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">{{ $message }}</p>    
                        </div>
                        @enderror                        
                        <div class="relative">
                            <input type="password" name="password" id="password" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="password" class="absolute text-sm duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 @error('password') text-red-600 text-xs @enderror">Kata Sandi</label>
                        </div>
                        @error('password')
                        <script>
                            document.getElementById('password').style.display = 'none';
                        </script>
                        <div>   
                            <div class="relative">
                                <input type="text" id="outlined_error" aria-describedby="outlined_error_help" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none border-red-600 focus:outline-none focus:ring-0 focus:border-red-600 peer" placeholder=" " />
                                <label for="outlined_error" class="absolute text-sm text-red-600 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto"></label>
                            </div>
                            <p id="outlined_error_help" class="mt-2 text-xs text-red-600">{{ $message }}</p>    
                        </div>
                        @enderror 
                        <button type="submit" class="w-full text-white bg-primary-20 hover:opacity-80 duration-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Daftar</button>
                        <p class="text-center text-sm font-light text-gray-500">
                            Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-primary-20 hover:underline duration-300">Masuk</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
