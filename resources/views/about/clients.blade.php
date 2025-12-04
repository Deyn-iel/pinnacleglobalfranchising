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



<!-- ============================
     FRANCHISE NOW SECTION
============================= -->
<section class="franchise-section text-center mt-5">

    <h2 class="franchise-title">Our CLIENTS</h2>
    <div class="underline"></div>

    <div class="container mt-5">
        <div class="row justify-content-center g-5">

            <!-- KAPE ILOKANO -->
            <div class="col-md-5 col-lg-4 text-center">
                <div class="circle-box">
                    <img src="{{ asset('img/kape.webp') }}" alt="Kape Ilokano">
                </div>
                <h3 class="brand-name mt-3">Kape Ilokano</h3>
                <p class="brand-desc">Serving Naimas Nga Kape</p>
            </div>

            <!-- PATATAS PROJECT -->
            <div class="col-md-5 col-lg-4 text-center">
                <div class="circle-box">
                    <img src="{{ asset('img/patatas.webp') }}" alt="Patatas Project">
                </div>
                <h3 class="brand-name mt-3">Patatas Project</h3>
                <p class="brand-desc">Fries that Fuel Dreams</p>
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="row justify-content-center mt-5 g-5">

            <!-- MARIA COFFEE -->
            <div class="col-md-5 col-lg-4 text-center">
                <div class="circle-box">
                    <img src="{{ asset('img/maria_cofee.webp') }}" alt="Maria Coffee">
                </div>
                <h3 class="brand-name mt-3">Maria Coffee</h3>
                <p class="brand-desc">
                    Something good<br>is going to happen
                </p>
            </div>

            <!-- WINGS 2 GO -->
            <div class="col-md-5 col-lg-4 text-center">
                <div class="circle-box">
                    <img src="{{ asset('img/wings.webp') }}" alt="Wings 2 Go">
                </div>
                <h3 class="brand-name mt-3">Wings 2 Go</h3>
                <p class="brand-desc">Best Chicken Wings of All Time</p>
            </div>

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


