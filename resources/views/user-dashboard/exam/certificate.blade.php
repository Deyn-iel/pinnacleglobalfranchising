<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Kape Ilokano | Certificate of Passing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* ============ RESET ============ */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    width: 100%;
    height: 100%;
}

/* ============ VIEWPORT ============ */
body {
    background: #f3f6f4;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    font-family: "Times New Roman", serif;
}

/* ============ SCALE CONTAINER ============ */
.viewer {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ============ CERTIFICATE (FIXED CANVAS) ============ */
.certificate {
    width: 1120px;   /* FIXED DESIGN SIZE */
    height: 630px;   /* LANDSCAPE */
    background: #fff;
    border: 12px solid #1b5e20;
    padding: 45px 60px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* ============ HEADER ============ */
.certificate-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    width: 90px;
}

/* ============ TITLE ============ */
.title {
    text-align: center;
}

.title h1 {
    font-size: 40px;
    letter-spacing: 2px;
    color: #1b5e20;
}

.title h2 {
    font-size: 20px;
    font-weight: normal;
    margin-top: 6px;
}

/* ============ BODY ============ */
.content {
    text-align: center;
}

.student-name {
    font-size: 34px;
    font-weight: bold;
    margin: 18px 0;
    text-transform: uppercase;
}

.exam-text {
    font-size: 18px;
    line-height: 1.6;
}

/* ============ SIGNATURES ============ */
.signatures {
    display: flex;
    justify-content: space-between;
    padding: 0 80px;
}

.signature-box {
    width: 300px;
    text-align: center;
    position: relative;
}

/* SIGNATURE IMAGE */
.signature-box img {
    width: 260px;
    position: absolute;
    top: -38px;
    left: 50%;
    transform: translateX(-50%);
}

/* LINE + NAME */
.signature-name {
    margin-top: 28px;
    padding-top: 6px;
    border-top: 2px solid #000;
    font-weight: bold;
}

.signature-title {
    font-size: 14px;
    margin-top: 2px;
}

/* ============ FOOTER ============ */
.footer {
    text-align: center;
    font-size: 14px;
}

/* ============ AUTO SCALE (CANVA STYLE) ============ */
@media (max-aspect-ratio: 16/9) {
    .certificate {
        transform: scale(calc(100vw / 1120));
        transform-origin: center;
    }
}

@media (min-aspect-ratio: 16/9) {
    .certificate {
        transform: scale(calc(100vh / 630));
        transform-origin: center;
    }
}
</style>
</head>

<body>

<div class="viewer">
    <div class="certificate">

        <!-- HEADER -->
        <div class="certificate-header">
            <img src="logo1-removebg-preview.png" class="logo">
            <img src="Untitled-2.png" class="logo">
        </div>

        <!-- TITLE -->
        <div class="title">
            <h1>CERTIFICATE OF PASSING</h1>
            <h2>This certifies that</h2>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <div class="student-name">Juan Dela Cruz</div>
            <div class="exam-text">
                has successfully passed the <strong>Kape Ilokano Entrance Examination</strong><br>
                and is hereby recognized as qualified to proceed<br>
                in accordance with the standards and values of Kape Ilokano.
            </div>
        </div>

        <!-- SIGNATURES -->
        <div class="signatures">

            <div class="signature-box">
                <img src="Screenshot_2026-01-13_101815-removebg-preview.png">
                <div class="signature-name">Alenmark Kenneth Fernandez</div>
                <div class="signature-title">President</div>
            </div>

            <div class="signature-box">
                <img src="Screenshot_2026-01-13_101819-removebg-preview.png">
                <div class="signature-name">John Cedrick Babaran Tan</div>
                <div class="signature-title">Chief Executive Officer (CEO)</div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer">
            Issued this <strong>___ day of __________, 2026</strong><br>
            Kape Ilokano Franchising
        </div>

    </div>
</div>

</body>
</html>

