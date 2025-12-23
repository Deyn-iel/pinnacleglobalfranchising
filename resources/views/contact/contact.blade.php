<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Contact') | Pinnacle Global</title>

    <!-- ✅ BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css" rel="stylesheet">
    <!-- ✅ CSS FILES (ORDER MATTERS) -->
    @vite(['resources/css/header/app.css', 
            'resources/css/header/app.css',
            'resources/css/footer/app.css',
            'resources/css/contact/app.css',
            'resources/css/chatbot/app.css',
            'resources/css/scroll/app.css',
            
            // js files
            'resources/js/header/app.js',
            'resources/js/chatbot/app.js',
            'resources/js/scroll/app.js',
            'resources/js/contact/app.js',
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

    <div class="text">
        <h2>Get in Touch</h2>
        <div class="hr"></div>
    </div>

    <div class="contact-section container mt-5">

    <div class="row justify-content-center">

        <!-- LEFT FORM -->
        <div class="col-md-6 mb-4">
            <h3 class="section-title">Contact Us</h3>

            <form id="contactForm" action="{{ route('contact.send') }}">
                @csrf

                <div class="field-group">
                    <input type="text" name="name" class="form-field" placeholder=" " required>
                    <label>Full Name*</label>
                </div>

                <div class="field-group">
                    <input type="email" name="email" class="form-field" placeholder=" " required>
                    <label>Email Address*</label>
                </div>

                <div class="field-group">
                    <textarea name="message" class="form-field textarea" rows="5" placeholder=" " required></textarea>
                    <label class="label-message">Message*</label>
                </div>

                <!-- SUCCESS MESSAGE -->
                <div id="successMsg" class="success-msg" style="display:none;">
                    ✔ Your message has been received. We’ll get back to you shortly.
                </div>

                <button type="submit" class="btn-submit w-100 mt-2">SEND</button>
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
            <div class="open-hours">
            <button class="hours-btn">
                Open today <strong>08:30AM – 5:30PM</strong>
                <span class="arrow">▼</span>
            </button>

            <div class="hours-menu">
                <p><strong>Monday:</strong> 08:30AM – 5:30PM</p>
                <p><strong>Tuesday:</strong> 08:30AM – 5:30PM</p>
                <p><strong>Wednesday:</strong> 08:30AM – 5:30PM</p>
                <p><strong>Thursday:</strong> 08:30AM – 5:30PM</p>
                <p><strong>Friday:</strong> 08:30AM – 5:30PM</p>
                <p><strong>Saturday:</strong> 08:30AM – 5:30PM</p>
                <p><strong>Sunday:</strong> Closed</p>
            </div>
        </div>

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
    @include('partials.scroll-top')
    </main>


    {{-- ✅ FOOTER --}}
    @include('partials.footer')

</body>
</html>
