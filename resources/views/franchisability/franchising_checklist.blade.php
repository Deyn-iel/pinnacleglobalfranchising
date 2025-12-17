<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franchising Checklist | Pinnacle Global</title>

    <!-- ✅ BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css" rel="stylesheet">
    <!-- ✅ CSS FILES (ORDER MATTERS) -->
    @vite(['resources/css/header/app.css', 
            'resources/css/header/app.css',
            'resources/css/footer/app.css',
            'resources/css/franchisability/app.css',
            'resources/css/chatbot/app.css',
            'resources/css/scroll/app.css',

            // js files
            'resources/js/header/app.js',
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

<!-- ============================
     FRANCHISE NOW SECTION
============================= -->
<section class="franchise-section text-center mt-5">

    <h2 class="franchise-title">Franchising Checklist</h2>
    <div class="underline"></div>
</section>

<div class="keys">
        <h2>1. Evaluate Franchising Feasibility</h2>
        <h2>Gather Key Information</h2>
        <ul>
            <li><strong>Attend Franchise Seminars & Webinars</strong>Learn from industry experts, franchisors, and consultants. </li>
        </ul>
        <ul>
            <li><strong>Read Franchising Books</strong>Gain foundational knowledge about the franchising process, benefits, and risks. </li>
        </ul>
        <ul>
            <li><strong>Consult a Franchise Analyst</strong>Get a professional evaluation of your business's potential to franchise. </li>
        </ul>
        <ul>
            <li><strong>Take a Franchisability Assessment</strong>Use online quizzes or tools to gauge your business’s readiness.  </li>
        </ul>
        <h2>Explore All Growth Options</h2>
        <ul>
            <li><strong>Expand Internally</strong>Open new company-owned locations and maintain full control.  </li>
        </ul>
        <ul>
            <li><strong>Seek Investors</strong>Raise capital to grow without franchising.</li>
        </ul>
        <ul>
            <li><strong>Consider Franchising Models</strong>
                <ul>
                    <li><strong>Traditional Franchising:</strong> Replicate your entire business model under a brand. </li>
                </ul>
                <ul>
                    <li><strong>Business Opportunity:</strong> Provide tools or services without strict brand control. </li>
                </ul>
                <ul>
                    <li><strong>Licensing:</strong> Allow use of your IP without a full franchise agreement.  </li>
                </ul>
            </li>
        </ul>
        <h2>2. Meet With a Franchise Consultant</h2>
        <h2>Visit the Consultant’s Office</h2>
        <ul>
            <li>Evaluate the environment and professionalism of the team.</li>
        </ul>
        <h2>Assess Their Franchise Development Approach</h2>
        <ul>
            <li>Do they use <strong>proven systems?</strong> </li>
            <li>Is work done <strong>in-house</strong>, or is it <strong>outsourced</strong>? </li>
        </ul>
        <h2>Evaluate the Firm's Experience</h2>
        <ul>
            <li>How long have they been in business?</li>
            <li>Review their <strong>client portfolio</strong> and <strong>industry reputation.</strong></li>
            <li>Contact references to understand why others chose them and what value they gained.  </li>
        </ul>
        <h2>Review Their Internal Operations</h2>
        <ul>
            <li>Is their team <strong>collaborative and communicative</strong>? 
                <ul>
                    <li>Are they co-located or working remotely? </li>
                    <li>How often do team members meet face-to-face?</li>
                </ul>
            </li>
            <li>Will a <strong>dedicated project manager</strong> lead your franchise development? </li>
        </ul>
        <h2>3. Decide if Franchising is Right for You</h2>
        <h2>Seek Trusted Opinions</h2>
        <ul>
            <li>Meet in person with consultants.</li>
            <li>Speak with advisors, mentors, close friends, and family. </li>
        </ul>
        <h2>Evaluate Your Resources</h2>
        <ul>
            <li><strong>Financial:</strong> Can you fund the franchise launch?</li>
            <li><strong>Team:</strong> Do you have the right people to support franchisees? </li>
            <li><strong>Motivation:</strong> Are you truly committed to building a franchise network?</li>
        </ul>
        <h2>4. If You Decide to Franchise</h2>
        <h2>Hire the Right Franchise Consultant</h2>
        <ul>
            <li>Ensure they offer a <strong>proven system</strong> and a <strong>transparent process.</strong> </li>
            <li>Visit their offices to assess culture and professionalism. </li>
        </ul>
        <h2>Retain a Franchise Attorney</h2>
        <ul>
            <li>They will handle:
                <ul>
                    <li>Franchise Disclosure Document (FDD) </li>
                    <li>Franchise Agreement </li>
                    <li>Regulatory compliance </li>
                </ul>
            </li>
        </ul>
        <h2>5. Common Mistakes to Avoid</h2>
        <ul>
            <li><strong>Don’t Make Assumptions</strong>
                <ul>
                    Franchising success depends on preparation, not guesswork.
                </ul>
            </li>
            <li><strong>Don’t Rely Solely on a Lawyer</strong>
                <ul>
                    Legal documents don’t build franchises—solid systems and support do.
                </ul>
            </li>
            <li><strong>Not All Lawyers Are Franchise Experts</strong>
                <ul>
                    Ask about experience specifically in franchise law.
                </ul>
            </li>
            <li><strong>Being a Franchisor Is Different from Being a Franchisee</strong>
                <ul>
                    Running a franchise system requires leadership, coaching, and operational support skills.
                </ul>
            </li>
        </ul>
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
