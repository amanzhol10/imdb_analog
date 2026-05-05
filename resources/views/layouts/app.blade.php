<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .responsive-container {
                width: 100%;
            }
            .poster-wrapper {
                width: 100%;
            }

            

            .responsive-title {
                font-size: 3vw;
            }
            .responsive-subtitle {
                font-size: 1.5vw;
            }


            @media (min-width: 1024px) {
                .movie-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 1.5rem;
                }
                .movie-detail-grid {
                    display: grid;
                    grid-template-columns: 1fr 2fr;
                    gap: 1.5rem;
                }
                .responsive-title {
                    font-size: 2vw;
                }
                .responsive-subtitle {
                    font-size: 1.2vw;
                }
            }

            @media (min-width: 640px) and (max-width: 1023px) {
                .movie-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 1rem;
                }
                .movie-detail-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 1rem;
                }
                .responsive-title {
                    font-size: 3.5vw;
                }
                .responsive-subtitle {
                    font-size: 2vw;
                }
            }

            @media (max-width: 639px) {
                .movie-grid {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }
                .movie-detail-grid {
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }
                .responsive-title {
                    font-size: 6vw;
                }
                .responsive-subtitle {
                    font-size: 3.5vw;
                }
                .lang-switcher {
                    justify-content: center;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 py-2 flex justify-end gap-2 lang-switcher">
                    <a href="{{ route('locale.switch', 'en') }}"
                       class="text-sm px-3 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200' }}">
                        🇬🇧 EN
                    </a>
                    <a href="{{ route('locale.switch', 'ru') }}"
                       class="text-sm px-3 py-1 rounded {{ app()->getLocale() === 'ru' ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200' }}">
                        🇷🇺 RU
                    </a>
                    <a href="{{ route('locale.switch', 'kk') }}"
                       class="text-sm px-3 py-1 rounded {{ app()->getLocale() === 'kk' ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200' }}">
                        🇰🇿 KK
                    </a>
                </div>
            </div>

            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
               
                {{ $slot }}
             
            </main>
        </div>
    </body>
</html>