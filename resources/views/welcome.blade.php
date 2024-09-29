<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title> {{ config('app.name')}}</title>

    @vite('resources/sass/app.scss')
</head>

<body>
    <div class="wrapper">
        @include ('partials.header')
        <main class="main main--no-sidebar">
            @include ('partials.sidebar')
            <div class="dashboard">
                hello

                <button class="sidebar__show-btn">
                    <img src="{{ asset('images/show-bar.svg') }}" alt="show bar">
                </button>
            </div>
        </main>
    </div>

    @vite('resources/ts/app.ts')
</body>

</html>
