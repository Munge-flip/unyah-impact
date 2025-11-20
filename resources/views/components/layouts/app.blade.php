<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Hoyo Piloting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <!-- Header Navigation -->
    @if (isset($header))
    {{ $header }}
    @else
    <x-user.header />
    @endif

    <main class="profile-container">
        <!-- Sidebar Navigation -->
        @if (isset($sidebar))
        {{ $sidebar }}
        @endif

        <!-- Main Content Area -->
        {{ $slot }}
    </main>

    <x-footer />

    <script src="js/user-profile.js"></script>
</body>
</html>
