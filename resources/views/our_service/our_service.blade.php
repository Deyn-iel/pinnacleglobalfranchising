<!DOCTYPE html>
<html lang="{{ str_replace('-', '-', app()->getLocale()) }}">
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
    <link rel="stylesheet" href="{{ asset('css/our_service/our_service.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
</head>

<body>
{{-- ✅ HEADER --}}
    @include('partials.header')

    <main>
<div class="main-wrapper"><!-- START WRAPPER -->

    <!-- IMAGE + CENTERED TITLE -->
    <div class="image">
        <div class="image-item logo-item">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo">
        </div>
    </div>


</div><!-- END MAIN WRAPPER -->




    <div class="first-services">
        <h2>Services</h2>
    <div class="underline"></div>
    <p>While the needs of franchisors may vary, certain foundational consulting services are vital for any business preparing to franchise.
        Pinnacle Global Franchising Group is built to deliver these services with both speed and precision.
        <br><br> Whether it's updating a single document or managing a full-scale franchise development program, our experienced team adapts to meet the specific requirements of each client. With all franchise solutions offered under one roof, we provide expert guidance, identify opportunities, resolve challenges, and implement strategies efficiently, ensuring your business stays competitive and compliant in today’s marketplace.</p>
    </div>
    
    <div class="second-services">
    <h2>Strategic Planning</h2>
    <div class="underline"></div>

    <p><strong>Strategic Franchise Planning</strong>
    <br>Every successful franchise journey begins with a solid, strategic business plan.
        At Pinnacle Global Franchising, our expert consultants work closely with you to evaluate your current market position and analyze the competitive landscape.
        Based on this assessment, we help you determine where to expand, who your ideal franchisees are, and how best to position your brand for growth.
    <br><br>We also guide you in setting essential financial parameters including franchise fees, royalty rates, and marketing fund contributions. Once your strategy is defined, Pinnacle Global Franchising develops tailored programs and professionally designed materials to support your franchise rollout.
    <br><br><strong>Our Strategic Planning Services Include:</strong></p>
    <ul>
        <li>On-site Business Evaluation by a Senior Consultant
            <br>(Franchisability Review and Business Model Assessment)</li>
        <li>Franchise Structure Development and Revenue Stream Design</li>
        <li>Comprehensive Competitor Analysis and Market Research</li>
    </ul>

    <h2>Legal Documentation</h2>
    <div class="underline"></div>
    <p><strong>Franchise Legal Agreements</strong>
        <br><br>A well-crafted franchise agreement is essential to clearly define the legal and operational relationship between the franchisor and the franchisee. Pinnacle Global Franchising’s legal team will prepare a comprehensive Franchise Agreement tailored to your business and aligned with current industry standards and evolving franchise laws.
        <br><br>This agreement will be developed based on insights gathered from our in-depth program analysis and strategic recommendations ensuring all aspects of the franchise offering are thoroughly covered.
        <br><br><strong>Types of Agreements We Offer:</strong>
    </p>
    <ul>
        <li><strong>Unit Franchise Agreement</strong> – For individual franchise locations.</li>
        <li><strong>Area Development Agreement</strong> – For franchisees developing multiple units within a specific territory.</li>
        <li><strong>Master Franchise Agreement</strong> – For granting franchise rights across a wider region or country.</li>
        <li><strong>Joint Venture Agreement</strong> – For collaborative ownership and operation of franchise units.</li>
    </ul>

    <h2>Franchise Sales Training</h2>
    <div class="underline"></div>
    <p><strong>Franchise Sales Training & Support</strong>
        <br><br>While Pinnacle Global Franchising does not act as a broker for our clients, we provide comprehensive <strong>franchise sales training</strong> as part of our core services. Our seasoned franchise consultants, with years of industry experience, equip new and existing franchisors with the skills and knowledge needed to effectively sell their franchise.
        <br><br>Participants receive hands-on training, a detailed “how-to” manual, and personalized guidance on proven sales techniques. To ensure continued success, we also offer <strong>ongoing implementation consulting</strong> helping clients apply what they’ve learned to real-world sales situations.
        <br><br>For entrepreneurs seeking to <strong>invest in a franchise</strong> or get support in <strong>franchise reselling</strong>, we recommend visiting our trusted partner, <strong>U-Franchise Sales & Management</strong> the leading franchise sales company in the Philippines.
    </p>

    <h2>Operations Services</h2>
    <div class="underline"></div>
    <p><strong>Franchise Operations Manual Development</strong>
        <br><br>Pinnacle Global Franchising’s team of expert consultants will create a detailed <strong>Franchise Operations Manual</strong> that outlines every essential task needed to run your business covering processes from opening to daily operations through to closing.
        <br><br>This manual becomes an indispensable reference for franchisees, reinforcing training and ensuring operational consistency across all units.
        <br><br><strong>Our Operations Support Includes:</strong>
    </p>
    <ul>
        <li><strong>Initial Analysis & Framework Design</strong> – A thorough assessment of your current systems and processes.</li>
        <li><strong>Customized Operations Manual Development</strong> – Step-by-step procedures tailored to your business model.</li>
        <li><strong>Operations Consulting</strong> – Expert guidance to streamline workflows and maximize efficiency.</li>
    </ul>

    <h2>Franchise Marketing Services</h2>
    <div class="underline"></div>
    <p><strong>Franchise Marketing Strategy & Support</strong>
        <br><br>Once you've identified your ideal franchise markets and target franchisee profile during the planning phase, the next step is to effectively communicate your opportunity. Pinnacle Global Franchising will craft a <strong>comprehensive marketing strategy</strong> tailored to attract the right prospects—using both media and non-media channels that are cost-effective and results-driven.
        <br><br>Our team will develop your <strong>core franchise messaging and content</strong>, to be featured in marketing materials such as brochures, websites, advertisements, and more—ensuring a clear, compelling presentation of your brand.
        <br><br><strong>Our Franchise Marketing Services Include:</strong>
    </p>
    <ul>
        <li><strong>Franchise Marketing Plan</strong> – A targeted, strategic roadmap for lead generation.</li>
        <li><strong>Franchise Brochure Content & Core Messaging</strong> – Professionally written, brand-aligned materials.</li>
        <li><strong>Marketing Consulting & Ongoing Support</strong> – Expert guidance through every stage of your campaign.</li>
        <li><strong>Media & Non-Media Outreach</strong> – Leveraging networks, events, and platforms to boost visibility.</li>
    </ul>

    <h2>Special Services</h2>
    <div class="underline"></div>
    <p><strong>Ongoing Support & Supplemental Franchise Services</strong>
        <br><br>At Pinnacle Global Franchising, we are committed to the long-term success of every client. Beyond initial development, we offer a range of <strong>supplemental services</strong> designed to support continuous growth, optimize performance, and strengthen your franchise system over time.
        <br><br>Whether you're expanding locally or internationally, refining your model, or equipping your team with the right skills—our consultants provide expert guidance every step of the way.
        <br><br><strong>Our Extended Franchise Services Include:</strong>
    </p>
    <ul>
        <li><strong>International Franchising Support</strong></li>
        <li><strong>Master Franchise & Area Development Programs</strong></li>
        <li><strong>Franchise Trainings & Seminars</strong></li>
        <li><strong>Franchise Program Audit & Review</strong></li>
        <li><strong>Franchise Management Training & Consulting</strong></li>
        <li><strong>General Franchise Consulting</strong></li>
        <li><strong>Business Modeling & Prototype Development</strong></li>
        <li><strong>Franchisability Studies</strong></li>
    </ul>
    </div>

{{-- ✅ chatbot --}}
    @include('partials.chatbot')

</main>
{{-- ✅ FOOTER --}}
    @include('partials.footer')


</body>
</html>
