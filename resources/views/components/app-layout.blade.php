<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }} | TiketKuy</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    @stack('styles')
</head>

<body>
    <div class="relative flex flex-col w-full min-h-screen max-w-[640px] mx-auto bg-white">
        {{ $slot }}
    </div>

    @stack('scripts')
</body>

</html>
