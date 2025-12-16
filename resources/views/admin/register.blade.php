<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Register User</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    /* =========================
   GLOBAL RESET
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Inter", Arial, sans-serif;
}

/* =========================
   BODY
========================= */
body {
    min-height: 100vh;
    background: #0d3553;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* =========================
   REGISTER CARD
========================= */
.register-container {
    width: 100%;
    max-width: 420px;
    background: rgba(255, 255, 255, 0.95);
    padding: 32px 28px;
    border-radius: 16px;

    /* Depth */
    box-shadow:
        0 20px 45px rgba(0, 0, 0, 0.25),
        inset 0 1px 0 rgba(255, 255, 255, 0.6);

    animation: fadeUp 0.6s ease;
}

/* =========================
   TITLE
========================= */
.register-container h2 {
    text-align: center;
    margin-bottom: 24px;
    font-size: 26px;
    font-weight: 700;
    color: #0d3553;
}

/* =========================
   LABELS
========================= */
.register-container label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #374151;
}

/* =========================
   INPUTS
========================= */
.register-container input {
    width: 100%;
    padding: 13px 14px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    margin-bottom: 16px;
    background: #ffffff;
    transition: 0.25s ease;
}

/* Focus Effect */
.register-container input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
}

/* =========================
   ACTIONS ROW
========================= */
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    margin-top: 18px;
    flex-wrap: wrap;
}

/* Link */
.actions a {
    font-size: 13px;
    color: #2563eb;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s ease;
}

.actions a:hover {
    text-decoration: underline;
}

/* =========================
   BUTTON
========================= */
button {
    background: linear-gradient(135deg, #2563eb, #1e4fc6);
    color: #ffffff;
    border: none;
    padding: 12px 26px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.25s ease;
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.45);
}

/* Hover */
button:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 28px rgba(37, 99, 235, 0.55);
}

/* =========================
   ANIMATION
========================= */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =========================
   RESPONSIVE
========================= */

/* Tablets */
@media (max-width: 768px) {
    .register-container {
        padding: 28px 24px;
    }

    .register-container h2 {
        font-size: 24px;
    }
}

/* Mobile */
@media (max-width: 480px) {
    body {
        padding: 15px;
    }

    .register-container {
        padding: 24px 20px;
        border-radius: 14px;
    }

    .register-container h2 {
        font-size: 22px;
    }

    .actions {
        flex-direction: column;
        align-items: stretch;
    }

    button {
        width: 100%;
        text-align: center;
    }
}

</style>
</head>
<body>

<div class="register-container">
    <h2>Create Users Account</h2>

    <form method="POST" action="{{ route('admin.users.register') }}">
        @csrf

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <div class="actions">
            <a href="{{ route('admin.users-account') }}">Back</a>
            <button type="submit">Register User</button>
        </div>
    </form>
</div>

</body>
</html>
