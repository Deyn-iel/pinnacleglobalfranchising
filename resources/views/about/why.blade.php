<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinnacle Global</title>

    <!-- ✅ BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ CSS FILES (ORDER MATTERS) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about/why.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
    <link rel="stylesheet" href="{{ asset('css/scroll-top.css') }}">

    <!-- ✅ EXTRA PAGE-SPECIFIC STYLES -->
    @stack('styles')
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

    <!-- ✅ SCRIPTS -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
