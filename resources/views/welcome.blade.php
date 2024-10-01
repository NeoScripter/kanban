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

    <div class="overlay" id="createBoardPopup">
        @include('popups.create-board')
    </div>
    <div class="overlay" id="editBoardPopup">
        @include('popups.edit-board')
    </div>
    <div class="overlay" id="overlaySignup">
        @livewire('signup')
    </div>
    <div class="overlay" id="overlayLogin">
        @livewire('login')
    </div>
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
