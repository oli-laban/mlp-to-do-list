<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MLP To-Do</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>

    <div>
        <div class="container">
            @include('layouts.header')
        </div>

        <main class="container">
            {{ $slot }}
        </main>
    </div>

    <footer>
        Copyright &copy; {{ date('Y') }} All Rights Reserved.
    </footer>

    @livewireScripts
</body>
</html>
