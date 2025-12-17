<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Exam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* ================= RESET ================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ================= BODY ================= */
body {
    min-height: 100vh;
    background: linear-gradient(180deg, #0d3553 0%, #123f63 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* ================= CONTAINER ================= */
.confirm-container {
    background: #ffffff;
    max-width: 500px;
    width: 100%;
    border-radius: 16px;
    padding: 32px 28px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    animation: fadeUp 0.5s ease;
}

/* ================= HEADER ================= */
.confirm-header {
    text-align: center;
    margin-bottom: 22px;
}

.confirm-header h1 {
    font-size: 24px;
    font-weight: 700;
    color: #0d3553;
}

.confirm-header p {
    margin-top: 8px;
    font-size: 14px;
    color: #555;
}

/* ================= RULES ================= */
.rules {
    background: #f5f8fb;
    border-left: 4px solid #0d3553;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 22px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.rules p {
    font-size: 16px;
    color: #333;
    line-height: 1.5;
}

/* ================= CHECKBOX ================= */
.confirm-check {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 22px;
}

.confirm-check input {
    margin-top: 4px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.confirm-check label {
    font-size: 14px;
    color: #444;
    line-height: 1.4;
    cursor: pointer;
}

/* ================= CONFIRM BUTTON (FIXED STYLE) ================= */
.confirm-btn {
    display: block;
    width: 100%;
    padding: 14px;

    text-align: center;
    text-decoration: none;

    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;

    background: #0d3553;
    color: #ffffff;

    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    transition:
        background 0.25s ease,
        transform 0.2s ease,
        box-shadow 0.2s ease,
        opacity 0.2s ease;

    cursor: not-allowed;
    opacity: 0.6;
}

/* ENABLED STATE */
.confirm-btn.active {
    cursor: pointer;
    opacity: 1;
}

/* HOVER (ONLY WHEN ACTIVE) */
.confirm-btn.active:hover {
    background: #14507a;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.35);
}

/* DISABLED STATE */
.confirm-btn.disabled {
    cursor: not-allowed;
}



/* ================= FOOTER ================= */
.confirm-footer {
    text-align: center;
    margin-top: 18px;
    font-size: 13px;
    color: #777;
}

/* ================= ANIMATION ================= */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= RESPONSIVE ================= */
@media (max-width: 480px) {
    .confirm-container {
        padding: 26px 20px;
    }

    .confirm-header h1 {
        font-size: 22px;
    }
}
</style>
</head>

<body>

<div class="confirm-container">
    <div class="confirm-header">
        <h1>Confirm Before Exam</h1>
        <p>
        <i class="fas fa-exclamation-triangle" style="color:#9e0000; margin-right:6px;"></i>
        Please read and confirm before proceeding
        </p>

    </div>

    <div class="rules">
        <p>• Once the exam starts, you cannot exit or refresh the page.</p>
        <p>• Screenshots, screen recording, and tab switching are not allowed.</p>
        <p>• Opening a new tab or attempting to switch tabs will automatically submit your exam.</p>
        <p>• This exam allows a maximum of one attempt only. Please ensure that all answers are final.</p>
        <p>• Your exam will be automatically submitted when time expires.</p>
        <p>• Once started, the exam cannot be paused.</p>
        <p>• Any violation may result in disqualification.</p>
    </div>

    <div class="confirm-check">
        <input type="checkbox" id="confirmCheck">
        <label for="confirmCheck">
            I have read and understood the rules and agree to proceed with the exam.
        </label>
    </div>

    <a href="exam.html" id="proceedBtn" class="confirm-btn disabled">
        Proceed to Exam
    </a>


    <div class="confirm-footer">
        Secure Online Examination System
    </div>
</div>

<script>
const checkbox = document.getElementById("confirmCheck");
const button = document.getElementById("proceedBtn");

/* Toggle button state */
checkbox.addEventListener("change", () => {
    const isChecked = checkbox.checked;

    button.classList.toggle("active", isChecked);
    button.classList.toggle("disabled", !isChecked);
});

/* Prevent click when disabled */
button.addEventListener("click", (e) => {
    if (button.classList.contains("disabled")) {
        e.preventDefault();
    }
});


</script>


</body>
</html>
