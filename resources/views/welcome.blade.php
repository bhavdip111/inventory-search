<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('products.index') }}" title="{{ __('Products') }}">{{ __('Products') }}</a>
                    @else
                        <a href="{{ route('login') }}" title="{{ __('Login') }}">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" title="{{ __('Register') }}">{{ __('Register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name', 'Laravel') }}
                </div>

                <div class="links">
                    
                </div>
            </div>
        </div>
    </body>
</html>
