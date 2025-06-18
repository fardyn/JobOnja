

<header class="bg-blue-900 text-white p-4" x-data="{open : false}" >
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{url('/')}}">Jobonja</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->is('jobs')" >All jobs</x-nav-link>
            @auth()
            <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')">Bookmarks</x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->is('dashboard') " icon='gauge'>dashboard</x-nav-link>
                <x-logout-button></x-logout-button>
                <div class="flex items-center space-x-3">
                    <a href="{{route('dashboard')}}">
                        @if(Auth::user()->avatar)
                            <img src="{{asset('storage/' . Auth::user()->avatar)}}" alt="Profile image"
                                 class="w-10 h-10 rounded-full " >
                        @else
                            <img src="{{asset('storage/avatars/default.jpg')}}" alt="Profile image"
                                 class="w-10 h-10 rounded-full " >
                        @endif

                    </a>
                    <x-button-link url="/jobs/create" type="button" icon="edit">Create Job</x-button-link>

                </div>
            @else
                <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
                <x-nav-link url="/register" :active="request()->is('register')">register</x-nav-link>
            @endauth
        </nav>
        <button @click="open = !open" id="hamburger" class="text-white md:hidden flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <div x-show="open"
         @click.away="open = false"
        id="mobile-menu"
        class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
    >
        <x-nav-link url="/jobs" :active="request()->is('jobs') " :mobile="true">All jobs</x-nav-link>
        @auth()
        <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Bookmarks</x-nav-link>
        <x-nav-link url="/dashboard" :active="request()->is('dashboard') " icon='gauge' :mobile="true">dashboard</x-nav-link>
            <x-logout-button></x-logout-button>
            <x-button-link url="/jobs/create" type="button" icon="edit" :block="true">Create Job</x-button-link>
        @else
            <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">register</x-nav-link>
        @endauth
    </div>
</header>
