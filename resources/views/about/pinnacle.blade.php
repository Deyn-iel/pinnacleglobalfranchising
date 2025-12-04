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


</div><!-- END MAIN WRAPPER -->



<section class="about-section">

    <h2 class="about-title">About Us</h2>
    <div class="about-underline"></div>

    <!-- ROW 1 -->
    <div class="about-row">
        <div class="about-img">
            <img src="{{ asset('img/pinnacle_global.webp') }}" alt="Pinnacle Logo">
        </div>

        <div class="about-text">
            <h3>Pinnacle Global Franchising</h3>
            <p>We help you overcome these roadblocks by creating the complete franchising blueprint your business needs—from
                operations to legal, branding to training.</p>
            <p>Let us do the heavy lifting while you focus on growing your vision.</p>
        </div>
    </div>

    <!-- ROW 2 -->
    <div class="about-row reverse">
        <div class="about-img">
            <img src="{{ asset('img/mission.webp') }}" alt="Mission">
        </div>
        <div class="about-text">
            <h3>Mission</h3>

            <p>Dedicated to empowering Filipinos to fulfill their entrepreneurial dreams through accessible and
                budget-friendly franchising opportunities.</p>

            <p>Our mission is to create a supportive network that cultivates a wise generation of business-minded
                individuals, reduce unemployment and promotes sustainable entrepreneurship.</p>
        </div>

        
    </div>

    <!-- ROW 3 -->
    <div class="about-row">
        <div class="about-img">
            <img src="{{ asset('img/vision.webp') }}" alt="Vision">
        </div>

        <div class="about-text">
            <h3>Vision</h3>
            <p>We envision a future where every Filipino has the opportunity to own and operate their own successful
                business, contributing to a thriving economy and empowered communities.</p>

            <p>By fostering innovation, collaboration, and a strong business mindset, we aspire to inspire a culture of
                entrepreneurship that generations to come will embrace.</p>
        </div>
    </div>

</section>


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
