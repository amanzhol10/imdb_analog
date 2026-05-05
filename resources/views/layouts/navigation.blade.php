<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.*')">
                        {{ __('Movies') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tv-series.index')" :active="request()->routeIs('tv-series.*')">
                        {{ __('TV Series') }}
                    </x-nav-link>
                    <x-nav-link :href="route('actors.index')" :active="request()->routeIs('actors.*')">
                        {{ __('Actors') }}
                    </x-nav-link>
                    <x-nav-link :href="route('genres.index')" :active="request()->routeIs('genres.*')">
                        {{ __('Genres') }}
                    </x-nav-link>
                    <x-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                        {{ __('Reviews') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <a href="{{ route('profile.show', Auth::user()) }}" class="px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700">
                    {{ Auth::user()->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}" class="ms-4">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 dark:text-red-400">
                        {{ __('Log Out') }}
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 px-3 py-2">{{ __('Sign In') }}</a>
                @endauth
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('movies.index')" :active="request()->routeIs('movies.*')">
                {{ __('Movies') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tv-series.index')" :active="request()->routeIs('tv-series.*')">
                {{ __('TV Series') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('actors.index')" :active="request()->routeIs('actors.*')">
                {{ __('Actors') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('genres.index')" :active="request()->routeIs('genres.*')">
                {{ __('Genres') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                {{ __('Reviews') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>