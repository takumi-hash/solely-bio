<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-100 sm:items-center py-4 sm:pt-0">
        <!-- @if (Route::has('login')) -->
        <div class="fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        <!-- @endif -->

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 overflow-hidden">
                <x-section class="text-center">
                    <h1 class="text-4xl font-bold my-4">Solely</h1>
                    <p class="text-sm mb-4">
                        An online biography for a more civilized age.
                    </p>
                    <p class="text-base font-bold">
                        Create your complete biography <br />
                        and share it anywhere.
                    </p>
                </x-section>
                <x-section class="text-center">
                    <p class="text-sm">solely.bio/u/your-name</p>
                    <x-ctabutton linkto="/register" text="Create your bio"></x-ctabutton>
                    <p class="text-slate-500">You can create one in a minute :)</p>
                </x-section>
                <x-section>
                    <x-card :user="$demoUser" :links="$links"></x-card>
                </x-section>
                <x-section>
                    <h2 class="text-2xl mb-4">What is Solely for?</h2>
                    <p class="text-left mb-4">
                        This is a simple online profile card service.
                    </p>
                    <p class="text-left mb-4">
                        Once you created your profile, you can share it with a business
                        partner, followers on SNS, friends, and your family members.
                    </p>
                    <p class="text-left mb-4">
                        You don’t have to exchange your paper card anymore.
                    </p>
                </x-section>
                <x-section>
                    <h2 class="text-2xl mb-4">Example Usage</h2>
                    <p class="text-left mb-4">
                        Use it as a business card. You don’t have to waste a bunch of paper
                        anymore every time your job title changes.
                    </p>
                    <p class="text-left mb-4">
                        Use it as a social networking accounts list so your audiences can
                        follow you on every platform.
                    </p>
                    <p class="text-left mb-4">
                        Use it as a portfolio site. Your works and articles can be gathered
                        here, you can engage with your audiences even more.
                    </p>
                </x-section>
                <x-section>
                    <h2 class="text-2xl mb-4">Who can see my profile?</h2>
                    <p class="text-left mb-4">
                        Anyone you share the URL with can see your profile. Basically you
                        want to input the information you want to make visible to public.
                    </p>
                </x-section>

                <x-section>
                    <h2 class="text-2xl mb-4">Aknowlegements</h2>
                    <p class="text-left mb-4">
                        This website uses
                        <ul>
                            <li>
                                <a class="underline" href="https://fonts.google.com/noto/specimen/Noto+Sans+JP">Noto Sans JP</a>, licensed under SIL Open Font License (OFL).
                            </li>
                            <li>
                                <a class="underline" href="https://laravel-icons.com/">Laravel Icons</a>, licensed under MIT License.
                            </li>
                        </ul> 
                    </p>
                </x-section>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</body>

</html>