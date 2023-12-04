<div class="container">
    <div class="header__content">
        <div class="header__logo">
            <img src="#" alt="Logo">
        </div>
        <nav>
            @auth
                <ul>{{ auth()->user()->name }}</ul>
            @endauth
        </nav>
    </div>
</div>
