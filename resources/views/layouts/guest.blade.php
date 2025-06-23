<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jeantex</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 " style=" background-color:#dde6ec; "> <!--ruta de la imagen de fondo-->
        
            <div class=" w-full bg-white shadow-lg  " style="width: 1400px; height: 500px;">
                {{ $slot }}
            </div>
        
    </div>
    </div>
    </div>
</body>

</html>