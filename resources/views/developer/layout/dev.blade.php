<!DOCTYPE html>
<html lang="en" data-bs-theme="{{ $theme }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <link rel="icon" href="/assets/logo.png">

    @vite($vite_sass)

    <link href="{{ asset("fonts/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
    @foreach ($stylesheets as $stylesheet)
        @if (str_contains( $stylesheet, "href"))
            {!! $stylesheet !!}
        @else
            <link href="{{ $stylesheet }}" rel="stylesheet">
        @endif
    @endforeach


</head>

<body>

    <x-symlink-notification />
    <x-symlink-spinner />

    @include('symlink::developer.includes.navbar')
    {{ $slot }}


    @vite($vite_javascript)
    @foreach ($javascript as $js)
        @if (str_contains( $js, "<script"))
            {!! $stylesheet !!}
        @else
            <script src="{{ $js }}"></script>
        @endif
    @endforeach
</body>

</html>
