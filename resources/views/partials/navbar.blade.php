<nav class="bg-white border-gray-200 shadow-md sticky w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('img/logo.png') }}" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-bold whitespace-nowrap text-primary-20">GRIDMERCE</span>
    </a>
    <div class="flex items-center md:order-1">
        <form action="" method="">
            <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="lg:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
            <div class="relative hidden md:block">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="w-5 h-5 text-gray-500" data-feather="search"></i>
                <span class="sr-only">Search icon</span>
                </div>
                <input type="text" name="query" id="search-navbar" value="{{ request('query')}}" @if(!request()->is('home')) disabled @endif class="block w-[50vw] p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Produk...">
            </div>
        </form>
        <a data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" href="{{ route('cart') }}" class="flex items-center mr-2 p-3 rounded-full md:ml-10 hover:bg-gray-200 duration-300">
            <i data-feather="shopping-cart"></i>
        </a>
        <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Keranjang
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        </div>
        <div class="items-center justify-between hidden w-full lg:flex md:w-auto md:order-1" id="navbar-search">
            <div class="relative mt-3 md:hidden">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
            </div>
            @if (Auth::check())
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ url('storage/' . Auth::user()->photo) }}" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                    <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                </div>
                <ul class="pt-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 duration-300"><i data-feather="user" class="h-5 w-4 mr-1"></i>Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('index_order') }}" class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 duration-300"><i data-feather="shopping-bag" class="h-5 w-4 mr-1"></i>Pesanan Saya</a>
                    </li>
                    <hr class="mb-2">
                    <li class="flex px-4 py-2 text-sm text-black bg-white hover:bg-gray-100 duration-300">
                        <button type="button" data-modal-target="logout-modal" data-modal-toggle="logout-modal" class="flex w-full text-start">
                            Keluar<i data-feather="log-out" class="h-5 w-4 ml-2"></i>
                        </button>
                        {{-- <a href="{{ route('logout') }}" method="post" class="flex px-4 py-2 text-sm text-black bg-white hover:bg-gray-100 duration-300">
                            <button type="submit" class="flex w-full text-start">Keluar<i data-feather="log-out" class="h-5 w-4 ml-1"></i></button>
                        </a> --}}
                    </li>
                </ul>
            </div>
            @else
            <div class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-4 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <a href="{{ route('login') }}" class="text-primary-20 bg-transparent border-[1.5px] border-primary-20 hover:text-white hover:bg-primary-20 duration-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Masuk</a>
                <a href="{{ route('register') }}" class="text-white bg-primary-20 hover:text-primary-20 border-[1.5px] border-primary-20 hover:bg-transparent hover:border-[1.5px] hover:border-primary-20 duration-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Daftar</a>
            </div>
            @endif
        </div>
    </div>
</nav>

<!-- Logout modal -->
<div id="logout-modal" tabindex="-1" aria-hidden="true"
class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5">
            <button type="button"
                class="text-neutral-60 absolute top-2.5 right-2.5 bg-transparent hover:bg-neutral-20 hover:text-black duration-[400ms] rounded-lg text-sm py-4 px-2 ml-auto inline-flex items-center"
                data-modal-toggle="logout-modal">
                <i data-feather="x"></i>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="text-primary-20 w-11 h-11 my-3.5 mx-auto">
                <i data-feather="log-out" class="h-10 w-10"></i>
            </div>
            <p class="mb-4 text-neutral-60">Apakah Anda Yakin?</p>
            <div class="flex justify-center items-center">
                <a href="{{ route('logout') }}" id="logout" method="POST">
                    <button type="reset" data-modal-toggle="logout-modal" type="button"
                        class="w-20 py-2 px-3 mr-3 text-sm font-medium text-neutral-60 bg-white rounded-lg border border-neutral-30 hover:bg-neutral-20 duration-[400ms] hover:text-black">
                        Tidak
                    </button>
                    <button type="submit"
                        class="w-20 py-2 px-3 text-sm font-medium text-center text-white bg-primary-20 rounded-lg duration-[400ms]">
                        Ya
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>