<nav class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center px-4 py-3">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <span class="text-2xl font-bold text-indigo-800">Dorsu Gym</span>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-6">

        <a href="{{ route('home') }}" 
        class="text-gray-700 hover:text-indigo-800 font-medium px-3 py-2 rounded-md transition-all {{ request()->routeIs('home') ? 'text-indigo-800 font-bold bg-indigo-100 border-b-2 border-indigo-800' : '' }}">
            {{ __('Home') }}
        </a>
        <a href="{{ route('trainor') }}" 
        class="text-gray-700 hover:text-indigo-800 font-medium px-3 py-2 rounded-md transition-all {{ request()->routeIs('trainor') ? 'text-indigo-800 font-bold bg-indigo-100 border-b-2 border-indigo-800' : '' }}">
            {{ __('Your Trainor') }}
        </a>
        <a href="{{ route('subscribe') }}" 
        class="text-gray-700 hover:text-indigo-800 font-medium px-3 py-2 rounded-md transition-all {{ request()->routeIs('subscribe') ? 'text-indigo-800 font-bold bg-indigo-100 border-b-2 border-indigo-800' : '' }}">
            {{ __('Plan') }}
        </a>
        </div>
        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <a href="{{ route('logout') }}" class="bg-yellow-400 text-white px-4 py-2 rounded-md font-semibold hover:bg-yellow-500" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</nav>