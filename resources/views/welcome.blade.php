<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title> {{ config('app.name') }}</title>

    @vite('resources/sass/app.scss')
</head>

<body>
    {{-- @include('partials.flash-script') --}}

    @if (session('success'))
        <div class="flash-message">
            {{ session('success') }}
        </div>
    @endif

    @auth
        @include('popups.create-board')

        @include('popups.edit-board')

        @include('popups.delete-board')

        @include('popups.add-task')

        @include('popups.display-task')
    @endauth

    @livewire('signup')

    @livewire('login')

    <div class="wrapper">
        @include ('partials.header')
        <main class="main">

            @include('partials.sidebar')

            @include ('partials.dashboard')
        </main>
    </div>

    @vite('resources/ts/app.ts')
    @livewireScripts
</body>

</html>
