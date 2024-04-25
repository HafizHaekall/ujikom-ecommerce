<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="fixed top-0 z-40 inline-flex items-center p-[5px] mt-2 ml-3 text-sm bg-primary-20 text-white hover:bg-white hover:text-primary-20 duration-[400ms] rounded-lg lg:hidden focus:outline-none focus:ring-2 focus:ring-primary-10">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar" class="fixed bg-primary-20 top-0 left-0 z-40 min-h-full w-[250px] transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidenav">
    <div class="overflow-y-auto py-5 px-3">
      <div class="flex flex-col justify-between items-start">
        <div class="flex items-center p-2 pb-0 mb-6">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('img/logo.png') }}" class="h-8 text-white" alt="E-COMMERCE Logo" />
                <h1 class="text-white text-2xl font-bold">GRIDMERCE</h1>
            </a>
          </div>
          <div>
            <button type="button" data-drawer-hide="default-sidebar" aria-controls="default-sidebar" class="lg:hidden text-white bg-transparent hover:bg-white hover:text-primary-20 rounded-lg text-sm py-4 px-2 my-auto absolute top-8 right-3 inline-flex items-center">
                <i class="fa-solid fa-xmark fa-xl"></i>
                <span class="sr-only">Close menu</span>
            </button>
        </div>
      </div>

      @php
          $routeName = request()->route()->getName();
      @endphp

        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ $routeName === 'dashboard' ? 'bg-white text-primary-20 group' : 'text-white' }} flex items-center p-2 py-auto text-base font-normal rounded-lg hover:bg-white hover:text-primary-20 group duration-[400ms]">
                  <i data-feather="grid" class="h-5 w-5"></i>
                  <span class="ml-3">Dashboard</span>
                </a>
              </li>
            <li>
                <hr>
            <li>
                <a href="{{ route('create_product') }}" class="{{ $routeName === 'create_product' ? 'bg-white text-primary-20 group' : 'text-white' }} flex items-center p-2 py-auto text-base font-normal rounded-lg hover:bg-white hover:text-primary-20 group duration-[400ms]">
                    <i data-feather="package" class="h-5 w-5"></i>
                    <span class="ml-3">Data Produk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('index_order') }}" class="{{ $routeName === 'index_order' ? 'bg-white text-primary-20 group' : 'text-white' }} flex items-center p-2 py-auto text-base font-normal rounded-lg hover:bg-white hover:text-primary-20 group duration-[400ms]">
                    <i data-feather="shopping-cart" class="h-5 w-5"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Data Order</span>
                </a>
            </li>
                <hr>
            <li>
                <a href="{{ route('profile.admin') }}" class="{{ $routeName === 'profile.admin' ? 'bg-white text-primary-20 group' : 'text-white' }} flex items-center p-2 py-auto text-base font-normal rounded-lg hover:bg-white hover:text-primary-20 group duration-[400ms]">
                    <i data-feather="user" class="h-5 w-5"></i>
                    <span class="flex-1 ml-3 whitespace-nowrap">Profile</span>
                </a>
            </li>
        </ul>

            <div class="flex flex-row justify-between absolute bottom-0 left-0 p-4 w-full whitespace-nowrap z-20 bg-primary-20 border-t border-white">
              <div class="flex flex-row">
                <img src="{{ Storage::url(auth()->user()->photo) }}" class="h-10 w-10 my-auto rounded-full object-cover"
                    alt="Profile" />
                <ul class="my-auto">
                    <li class="ml-3 text-white max-w-[100px] truncate">{{ auth()->user()->name }}</li>
                    <li class="ml-3 text-white text-xs">{{ auth()->user()->email }}</li>
                </ul>
              </div>
              <div>
                <button type="button" data-tooltip-target="tooltip-logout" data-modal-target="logout-modal" data-modal-toggle="logout-modal" class="p-2 ml-9 text-base font-normal text-white rounded-lg hover:bg-white hover:text-primary-20 group duration-[400ms]">
                    <i data-feather="log-out" class="h-5 w-5"></i>
                </button>
                <div id="tooltip-logout" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-black rounded-lg shadow-sm opacity-0 transition-opacity duration-[400ms] tooltip">
                    Keluar
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
              </div>
            </div>
    </div>
</aside>

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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="button" data-modal-toggle="logout-modal" class="w-20 py-2 px-3 mr-3 text-sm font-medium text-neutral-60 bg-white rounded-lg border border-neutral-30 hover:bg-neutral-20 duration-[400ms] hover:text-black">
                        Tidak
                    </button>
                    <button type="submit" class="w-20 py-2 px-3 text-sm font-medium text-center text-white bg-primary-20 rounded-lg duration-[400ms]">
                        Ya
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>
