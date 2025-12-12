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
            'resources/css/main/app.css',
            'resources/css/chatbot/app.css',
            'resources/css/scroll/app.css',
            
            // js files
            'resources/js/chatbot/app.js',
            'resources/js/scroll/app.js',
            'resources/js/app.js'])
    
<!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>

<body>

    {{-- ✅ HEADER --}}
    @include('partials.header')

    {{-- ✅ PAGE CONTENT --}}
    <main>
        
        {{-- <div class="promo-image-container">
    <img src="{{ asset('img/1fj.jpg') }}" alt="Be a KI Owner">
    </div> --}}

        <!-- IMAGE + VIDEO SECTION -->
    <div class="image">

        <div class="image-item logo-item">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo">
        </div>

        <div class="image-item video-item">
            <iframe
                src="https://player.vimeo.com/video/1101086567?h=fada1a13bc&autoplay=1&loop=1&autopause=0&muted=1&title=0&byline=0&portrait=0&controls=0"
                frameborder="0"
                allow="autoplay; fullscreen"
                allowfullscreen>
            </iframe>
        </div>

    </div>


<!-- ============================
     FRANCHISE NOW SECTION
============================= -->
<section class="franchise-section text-center mt-5">

    <h2 class="franchise-title">FRANCHISE NOW!</h2>
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

<div class="franchise-now-container">


    <h2 class="franchise-title">
        START FRANCHISING
    </h2>
    <div class="underline"></div>

    <!-- STEPS -->
    <div class="franchise-steps">

        <div class="step">
    <div class="step-icon">1</div>
    <h3>Submit Franchise Application</h3>
    <p>Complete and submit the official franchise application form together with the required initial documents.</p>
        </div>

        <div class="step">
            <div class="step-icon">2</div>
            <h3>Attend Franchise Orientation</h3>
            <p>Participate in the orientation to understand the franchise model, investment details, operational guidelines, and brand standards.</p>
        </div>

        <div class="step">
            <div class="step-icon">3</div>
            <h3>Evaluation, Approval & Contract Signing</h3>
            <p>Your application will undergo review and assessment. Once approved, you will proceed with the Franchise Agreement signing.</p>
        </div>

        <div class="step">
            <div class="step-icon">4</div>
            <h3>Site Preparation & Training Program</h3>
            <p>We coordinate with you on store layout, design requirements, equipment setup, and conduct hands-on training for franchisees and staff.</p>
        </div>

        <div class="step">
            <div class="step-icon">5</div>
            <h3>Store Installation & Pre-Opening Assistance</h3>
            <p>Our team provides full support in store setup, branding, product preparation, and pre-opening activities to ensure operational readiness.</p>
        </div>

        <div class="step">
            <div class="step-icon">6</div>
            <h3>Grand Opening & Continuous Support</h3>
            <p>Launch your franchise store with our on-site assistance. Receive ongoing operational guidance, marketing support, and performance monitoring.</p>
        </div>
        
    </div>

    <!-- CTA BUTTON -->
    <div class="franchise-now-button-wrapper">
        <a href="{{ route('franchise.process') }}" class="franchise-now-btn">Fill-up</a>
    </div>
{{-- <h1 class="section-title">Kape Ilokano Drinks</h1>
<div class="drinks-container">

        <!-- SLIDE FROM LEFT -->
        <div class="drink-card" data-aos="fade-right" data-aos-duration="1000">
            <img src="{{ asset('img/coco ilokano.png') }}" alt="">
        </div>

        <!-- ZOOM IN + FLOAT -->
        <div class="drink-card" data-aos="zoom-in-up" data-aos-duration="1200">
            <img src="{{ asset('img/GUEST23.png') }}" alt="Drink 2">
        </div>

        <!-- SLIDE FROM RIGHT -->
        <div class="drink-card" data-aos="fade-left" data-aos-duration="1000">
            <img src="{{ asset('img/GUEST2.png') }}" alt="Drink 3">
        </div>

    </div> --}}
    <p class="recaptcha">
            This site is protected by reCAPTCHA and the <a href="https://policies.google.com/privacy" target="_blank">Google Privacy</a> Policy and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.
        </p>
</div>
  
<!-- INQUIRE NOW FORM -->

{{-- <section class="inquire text-center">
    

    <h2 class="inquire-title">INQUIRE NOW!</h2>
    <div class="underline"></div>

    <p class="inquire-sub">Feel free to inquire or <a href="{{ url('/login') }}" class="login-btn">Login</a> as a user.</p>

    <div class="container mt-4">
        <form>

            <div class="field-group">
                <input type="text" class="form-field" placeholder="" required>
                <label>Full Name*</label>
            </div>

            <div class="field-group">
                <input type="email" class="form-field" placeholder="" required>
                <label>Email*</label>
            </div>

            <div class="field-group">
                <textarea class="form-field" placeholder="" rows="5" required></textarea>
                <label class="label-message">Message*</label>
            </div>



            <button type="submit" class="btn-submit mt-2">SUBMIT</button>

        </form>

        
    </div>
    
</section> --}}

{{-- ✅ chatbot --}}
    @include('partials.chatbot')
    @include('partials.scroll-top')
    </main>

    {{-- ✅ FOOTER --}}
    @include('partials.footer')

    <!-- ✅ SCRIPTS -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,   // animation plays every scroll
            offset: 100,   // trigger earlier
            easing: 'ease-out-back',
        });
    </script>
</body>
</html>
