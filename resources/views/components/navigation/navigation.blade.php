@if (Route::has('login'))
    <nav class="flex items-center justify-end gap-4">
        @auth
            <x-navigation.navigation-link href="{{ url('/dashboard') }}">
                Dashboard
            </x-navigation.navigation-link>

            <form method="POST" action="/logout">
                @csrf
                @method('POST')
                <x-navigation.navigation-link type="button" id="logOut" href="{{ Route('logout') }}">Log
                    Out</x-navigation.navigation-link>
            </form>
        @else
            <x-navigation.navigation-link href="{{ route('login') }}" class="border-transparent!">
                Log in
            </x-navigation.navigation-link>

            @if (Route::has('register'))
                <x-navigation.navigation-link href="{{ route('register') }}">
                    Register
                </x-navigation.navigation-link>
            @endif
        @endauth
    </nav>
@endif
