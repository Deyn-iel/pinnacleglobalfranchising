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
    <link rel="stylesheet" href="{{ asset('css/about/pinnacle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">

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


</div><!-- END MAIN WRAPPER -->



<!-- ============================
     FRANCHISE NOW SECTION
============================= -->
<section class="franchise-section text-center mt-5">

    <h2 class="franchise-title">About Us</h2>
    <div class="underline"></div>
    <div class="main-img">
    <div class="img1">
        <h2>Pinnacle Global Franchising</h2>
        <p> We help you overcome these roadblocks by creating the complete franchising blueprint your business needs—from operations 
            to legal, branding to training. <br><br>
            Let us do the heavy lifting while you focus on growing your vision.</p>
        <img src="{{ asset('img/pinnacle_global.webp') }}" alt="Logo">
    </div>
    <div class="img2">
        <h2>Mission</h2>
        <p>Dedicated to empowering Filipinos to fulfill their entrepreneurial dreams through accessible and budget-friendly franchising opportunities.
        <br><br>
            Our mission is to create a supportive network that cultivates a wise generation of business-minded individuals, reduce unemployment and promotes sustainable entrepreneurship.</p>
        <img src="{{ asset('img/mission.webp') }}" alt="Logo">
    </div>
    <div class="img3">
        <h2>Vision</h2>
        <p>We envision a future where every Filipino has the opportunity to own and operate their own successful business, contributing to a thriving economy and empowered communities. 
        <br><br>
            By fostering innovation, collaboration, and a strong business mindset, we aspire to inspire a culture of entrepreneurship that generations to come will embrace.</p>
        <img src="{{ asset('img/vision.webp') }}" alt="Logo">
    </div>
    </div>
</section>

{{-- ✅ chatbot --}}
    @include('partials.chatbot')
    </main>

    {{-- ✅ FOOTER --}}
    @include('partials.footer')

    <!-- ✅ SCRIPTS -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
