<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Game Services' }} - Hoyo Piloting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
</head>
<body>
    <x-public.header/>

    @if(isset($banner) && $banner)
        <div class="banner">
            <img src="{{ $banner }}" alt="{{ $title ?? 'Banner' }}">
        </div>
    @endif

    <main class="services-container">
        @if(isset($sidebar))
            <aside class="sidebar">
                {{ $sidebar }}
            </aside>
        @endif

        <section class="content">
            {{ $slot }}
        </section>
    </main>

    <x-footer/>

    @if(isset($jsFile))
        <script src="{{ asset('js/' . $jsFile) }}"></script>
    @endif
    @stack('scripts')
</body>
</html>