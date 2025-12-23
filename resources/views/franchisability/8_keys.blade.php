<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8-keys | Pinnacle Global</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css" rel="stylesheet">

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

    @include('partials.header')

    <main>
    <div class="image">
        <div class="image-item logo-item">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo">
        </div>
    </div>
    


<!--FRANCHISE NOW SECTION-->
<section class="franchise-section text-center mt-5">

    <h2 class="franchise-title">8 Keys to Franchisability</h2>
    <div class="underline"></div>
</section>

<div class="keys">
        <h2>Size and Longevity</h2>
        <p>How long has your business been operating? 
            <br>
        Are you confident in its long-term performance?</p>
        <h2>Profitability</h2>
        <p>Is your business consistently generating profits? </p>
        <h2>Teachability</h2>
        <p>Can someone else be trained to run your business effectively?</p>
        <h2>Systematization</h2>
        <p>Are your business processes organized in a way that they can be replicated easily? </p>
        <h2>Marketability</h2>
        <p>Can your concept be clearly communicated and marketed to future franchisees? </p>
        <h2>Transferability</h2>
        <p>Do you believe your business model would work well in different locations? </p>
        <h2>Originality</h2>
        <p>What makes your brand stand out from competitors?</p>
        <h2>Affordability</h2>
        <p>After all franchise-related costs, will the franchisee still earn a fair and motivating profit? </p>
    </div>

    @include('partials.chatbot')
    @include('partials.scroll-top')
    </main>

    @include('partials.footer')


</body>
</html>
