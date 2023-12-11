<div class="container">
    <div class="header__content">
        <div class="header__logo">
            <a href="{{ route('albums.index') }}"><img class="logo" src="{{ asset('images/logo-no-background.svg') }}" alt="Logo"></a>
        </div>
        <div class="header__user">
            @auth
                <p class="username">{{ auth()->user()->name }}</p>
                <a class="logout-link" href="{{ route('auth.logout') }}">Выйти</a>
            @endauth
        </div>
    </div>
</div>
