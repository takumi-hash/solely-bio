<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- OGP -->
        @if(Request::routeIs('card.show'))
        <meta property="og:title" content="{{ config('app.name', 'Solely.bio') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:image" content="{{ 'https://www.solely.bio/ogp_images/'. str_replace('http://www.solely.bio/u/', '', Request::url()) .'/ogp.jpg' }}" />
        <meta name="twitter:card" content="summary_large_image" />
        @endif
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
                {{ $slot }}
            </div>
        </div>
        <x-footer></x-footer>
    </body>
</html>
