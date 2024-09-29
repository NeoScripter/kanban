<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title> @yield('title') | {{ config('app.name')}}</title>

    @vite('resources/sass/app.scss')
</head>

<body>
    <header class="header">

    </header>

    <div class="wrapper">
    Hello world
    </div>

    @vite('resources/ts/app.ts')
</body>

</html>
