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
    <link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}">
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

    <div class="text">
        <h2>Get in Touch</h2>
        <div class="hr"></div>
    </div>

    <div class="contact-section container mt-5">

    <div class="row justify-content-center">

        <!-- LEFT FORM -->
        <div class="col-md-6 mb-4">
            <h3 class="section-title">Contact Us</h3>

            <form>

                <div class="field-group">
                    <input type="text" class="form-field" placeholder=" " required>
                    <label>Full Name*</label>
                </div>

                <div class="field-group">
                    <input type="email" class="form-field" placeholder=" " required>
                    <label>Email Address*</label>
                </div>

                <div class="field-group">
                    <textarea class="form-field textarea" rows="5" placeholder=" " required></textarea>
                    <label class="label-message">Message*</label>
                </div>

                <button class="btn-submit w-100 mt-2">SEND</button>

            </form>
            <p class="recaptcha">
            This site is protected by reCAPTCHA and the <a href="https://policies.google.com/privacy" target="_blank">Google Privacy</a> Policy and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.
        </p>
        </div>


        <!-- RIGHT INFO -->
        <div class="col-md-5 text-start">
            <h3 class="section-title">Pinnacle Global Franchising Group</h3>

            <p>G Building, San Fermin, Cauayan City, Isabela 3305</p>
            <p>(078) 2582529 | 0916 169 7513</p>

            <h4 class="section-title mt-4">Office Hours</h4>
            <p>Open today <strong>08:30 – 17:30</strong></p>
        </div>

    </div>

</div>



    <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!4v1764042137958!6m8!1m7!1swA0k5r0z2CZXI99xTFpnVg!2m2!1d16.93307477261983!2d121.7656557130238!3f265.8663620251052!4f7.2472207469750884!5f0.586434097488085" 
    width="100%" 
  height="350" 
  style="border:0;" 
  allowfullscreen="" 
  loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>


</div><!-- END MAIN WRAPPER -->

{{-- ✅ chatbot --}}
    @include('partials.chatbot')
    </main>


<footer class="footer text-center">
    <h4>Pinnacle Global Franchising Group Inc.</h4>
    <p>Unit 2, G Building, San Fermin, Cauayan City, Isabela 3305</p>
    <p>(078) 2582529 | 0916 169 7513</p>
    <p>© 2025 Pinnacle Global</p>
</footer>


    <!-- ✅ SCRIPTS -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
