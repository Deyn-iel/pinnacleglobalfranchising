<!DOCTYPE html>
<html lang="{{ str_replace('-', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Service | Pinnacle Global</title>

    <!-- ✅ BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- ✅ CSS FILES (ORDER MATTERS) -->
    @vite(['resources/css/header/app.css', 
            'resources/css/header/app.css',
            'resources/css/footer/app.css',
            'resources/css/our_service/app.css',
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

    <main>
<main>
<div class="main-wrapper"><!-- START WRAPPER -->

    <!-- IMAGE + CENTERED TITLE -->
    <div class="image">
        <div class="image-item logo-item">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo">
        </div>
    </div>

</div><!-- END MAIN WRAPPER -->



<!-- ========================= -->
<!--       SERVICES SECTION    -->
<!-- ========================= -->
<section id="services" class="first-services">
    <h2>Services</h2>
    <div class="underline"></div>

    <p>
        While the needs of franchisors may vary, certain foundational consulting services are vital  
        for any business preparing to franchise. Pinnacle Global Franchising Group is built to deliver  
        these services with both speed and precision. <br><br>
        Whether it's updating a single document or managing a full-scale franchise development program,  
        our experienced team adapts to meet the specific requirements of each client. With all franchise  
        solutions offered under one roof, we provide expert guidance, identify opportunities, resolve  
        challenges, and implement strategies efficiently, ensuring your business stays competitive and  
        compliant in today’s marketplace.
    </p>
</section>



<!-- ========================= -->
<!--   STRATEGIC PLANNING     -->
<!-- ========================= -->
<section id="strategic-planning" class="second-services">
    <h2>Strategic Planning</h2>
    <div class="underline"></div>

    <p><strong>Strategic Franchise Planning</strong><br>
    Every successful franchise journey begins with a solid, strategic business plan. At Pinnacle Global 
    Franchising, our expert consultants work closely with you to evaluate your current market position and 
    analyze the competitive landscape.<br><br>

    Based on this assessment, we help you determine where to expand, who your ideal franchisees are, and how 
    best to position your brand for growth.<br><br>

    We also guide you in setting essential financial parameters including franchise fees, royalty rates, and 
    marketing fund contributions. Once your strategy is defined, Pinnacle Global Franchising develops tailored 
    programs and professionally designed materials to support your franchise rollout.<br><br>

    <strong>Our Strategic Planning Services Include:</strong></p>

    <ul>
        <li>On-site Business Evaluation by a Senior Consultant  
            <br>(Franchisability Review and Business Model Assessment)</li>
        <li>Franchise Structure Development and Revenue Stream Design</li>
        <li>Comprehensive Competitor Analysis and Market Research</li>
    </ul>
</section>



<!-- ========================= -->
<!--    LEGAL DOCUMENTATION    -->
<!-- ========================= -->
<section id="legal-docs" class="second-services">
    <h2>Legal Documentation</h2>
    <div class="underline"></div>

    <p><strong>Franchise Legal Agreements</strong><br><br>
    A well-crafted franchise agreement is essential to clearly define the legal and operational relationship 
    between the franchisor and the franchisee. Pinnacle Global Franchising’s legal team will prepare a 
    comprehensive Franchise Agreement tailored to your business and aligned with current industry standards 
    and evolving franchise laws.<br><br>

    <strong>Types of Agreements We Offer:</strong>
    </p>

    <ul>
        <li><strong>Unit Franchise Agreement</strong> – For individual franchise locations.</li>
        <li><strong>Area Development Agreement</strong> – For franchisees developing multiple units.</li>
        <li><strong>Master Franchise Agreement</strong> – For wide regional expansion.</li>
        <li><strong>Joint Venture Agreement</strong> – For shared ownership operations.</li>
    </ul>
</section>



<!-- ========================= -->
<!--   FRANCHISE TRAINING     -->
<!-- ========================= -->
<section id="franchise-training" class="second-services">
    <h2>Franchise Sales Training</h2>
    <div class="underline"></div>

    <p><strong>Franchise Sales Training & Support</strong><br><br>
    While Pinnacle Global Franchising does not act as a broker for our clients, we provide comprehensive 
    franchise sales training as part of our core services. Our seasoned franchise consultants equip new and 
    existing franchisors with the skills and knowledge needed for effective selling.<br><br>

    We also offer <strong>ongoing implementation consulting</strong> helping clients apply what they’ve learned 
    in real-world sales situations.
    </p>
</section>



<!-- ========================= -->
<!--    OPERATIONS SERVICES    -->
<!-- ========================= -->
<section id="operations" class="second-services">
    <h2>Operations Services</h2>
    <div class="underline"></div>

    <p><strong>Franchise Operations Manual Development</strong><br><br>
    Our team will create a detailed Franchise Operations Manual covering all essential tasks—from opening 
    procedures to daily workflows and closing operations.<br><br>

    <strong>Our Operations Support Includes:</strong></p>

    <ul>
        <li><strong>Initial Analysis & Framework Design</strong></li>
        <li><strong>Customized Operations Manual Development</strong></li>
        <li><strong>Operations Consulting</strong></li>
    </ul>
</section>



<!-- ========================= -->
<!--   FRANCHISE MARKETING    -->
<!-- ========================= -->
<section id="franchise-marketing" class="second-services">
    <h2>Franchise Marketing Services</h2>
    <div class="underline"></div>

    <p><strong>Franchise Marketing Strategy & Support</strong><br><br>
    We craft a comprehensive marketing strategy tailored to attract ideal franchise prospects through both 
    media and non-media channels.<br><br>

    <strong>Our Services Include:</strong></p>

    <ul>
        <li><strong>Franchise Marketing Plan</strong></li>
        <li><strong>Brochure Content & Messaging</strong></li>
        <li><strong>Marketing Consulting</strong></li>
        <li><strong>Media & Non-Media Outreach</strong></li>
    </ul>
</section>



<!-- ========================= -->
<!--    SPECIAL SERVICES    -->
<!-- ========================= -->
<section id="special-services" class="second-services">
    <h2>Special Services</h2>
    <div class="underline"></div>

    <p><strong>Ongoing Support & Supplemental Franchise Services</strong><br><br>
    Beyond initial development, we offer supplemental services for continuous growth and performance 
    improvement.<br><br>

    <strong>Our Extended Services Include:</strong></p>

    <ul>
        <li><strong>International Franchising Support</strong></li>
        <li><strong>Master Franchise Programs</strong></li>
        <li><strong>Franchise Trainings & Seminars</strong></li>
        <li><strong>Program Audit & Review</strong></li>
        <li><strong>Management Training</strong></li>
        <li><strong>General Franchise Consulting</strong></li>
        <li><strong>Business Modeling</strong></li>
        <li><strong>Franchisability Studies</strong></li>
    </ul>
</section>


{{-- Chatbot --}}
@include('partials.chatbot')
@include('partials.scroll-top')
</main>

{{-- ✅ FOOTER --}}
    @include('partials.footer')


</body>
</html>
