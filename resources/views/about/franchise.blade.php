<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinnacle Global</title>

    <!-- ✅ BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ CSS FILES (ORDER MATTERS) -->
    @vite(['resources/css/header/app.css', 
            'resources/css/header/app.css',
            'resources/css/footer/app.css',
            'resources/css/about/app.css',
            'resources/css/chatbot/app.css',
            'resources/css/scroll/app.css',

            // js files
            'resources/js/chatbot/app.js',
            'resources/js/scroll/app.js',
            'resources/js/app.js'])
</head>

<body>

    {{-- ✅ HEADER --}}
    @include('partials.header')

    {{-- ✅ PAGE CONTENT --}}
    <main>
        <!-- IMAGE + CENTERED TITLE -->
    <div class="image">
        <div class="image-item logo-item">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo">
        </div>
    </div>

    {{-- ✅ chatbot --}}
    @include('partials.chatbot')
    @include('partials.scroll-top')

    </main>

    {{-- ✅ FOOTER --}}
    @include('partials.footer')


</body>
</html>