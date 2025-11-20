<header>
    <nav>
        <div class="weblogo-container">
            <div class="weblogo-frame">
                <img src="{{ asset('img/weblogo.png')}}" alt="Logo" class="logo" />
            </div>
        </div>
        <ul>
            {{ $slot }}
        </ul>
    </nav>
</header>