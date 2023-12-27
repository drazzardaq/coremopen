<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
				<meta name="description" content="Author: drazzardaq, Applicaiton: Corem">
				<meta name="theme-color" content="#07193f">
				<meta name="csrf-token" content="{{ csrf_token() }}">
				@if (env('APP_URL') === 'https://corem.management')
					<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
				@endif
				
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

				<!-- Favicon -->
				<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
				<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}">
				<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/android-chrome-512x512.png') }}">
				<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
				<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
				<link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

        <!-- Fonts -->
				<link rel="preconnect" href="https://fonts.googleapis.com">
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
				<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
				
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

				<!-- Google tag (gtag.js) -->
				@if (env('APP_URL') === 'https://corem.management')
					<script async src="https://www.googletagmanager.com/gtag/js?id=G-CH641X821K"></script>
					<script>
						window.dataLayer = window.dataLayer || [];
						function gtag(){dataLayer.push(arguments);}
						gtag('js', new Date());

						gtag('config', 'G-CH641X821K');
					</script>
				@endif
    </head>
    <body class="font-sans antialiased tracking-wide overflow-x-hidden selection:text-white selection:bg-accent h-[100dvh]">
        @inertia
    </body>
</html>