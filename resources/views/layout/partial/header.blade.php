<nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">
<div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

    <div class="w-1/2 pl-2 md:pl-0">
        <a class="text-gray-900 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#"> 
        <div class="brand">
        
						<img src="assets/img/kai.png"width="60px" height="50px" alt="logo">
					</div> 
        </a>
    </div>
    <div class="w-1/2 pr-0">
        <div class="flex relative inline-block float-right">
            <div class="relative text-sm">
                     @php
                        $user = Auth::user();
                    @endphp
                    <button id="userButton" class="flex items-center focus:outline-none mr-3">
                    @if ($user)
                        <span class="hidden md:inline-block">{{ $user->name }}</span>
                        <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                            <g>
                                <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                            </g>
                        </svg>
                        @endif
                    </button>
                <div id="userMenu" class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                    <ul class="list-reset">
                        <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">My account</a></li>
                        <li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Notifications</a></li>
                        <li>
                            <hr class="border-t mx-2 border-gray-400">
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">
                        Logout
                        </a>

                    </ul>
                </div>
            </div>


            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
    <hr class="w-full my-0">

    <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white z-20"id="nav-content">
        <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
            <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('dashboard') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900  border-b-2 border-white hover:border-blue-500">
                    <i class="fas fa-home fa-fw mr-3 "></i><span class="pb-1 md:pb-0 text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('master') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-500">
                <i class="fas fa-folder fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Master</span>
                </a>
            </li>
            <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('katalog') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-500">
                <i class="fa fa-copy fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Katalog</span>
                </a>
            </li>
            <!-- <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('rab') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-500">
                <i class="fa fa-copy fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">RAB</span>
                </a>
            </li>
            <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('hps') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-500">
                <i class="fa fa-copy fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">HPS</span>
                </a>
            </li>
            <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('spk') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-500">
                <i class="fa fa-copy fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">SPK</span>
                </a>
            </li> -->
            <li class="mr-6 my-2 md:my-0">
                <a href="{{ route('admin') }}" class="block py-1 md:py-3 pl-1 align-middle text-blue-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-500">
                <i class="fa fa-copy fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Admin</span>
                </a>
            </li>
           
    
        </ul>

        <div class="relative pull-right pl-4 pr-4 md:pr-0">
            <input type="search"  class="w-full bg-gray-100 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
            <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                </svg>
            </div>
        </div>

    </div>

</div>
</nav>
