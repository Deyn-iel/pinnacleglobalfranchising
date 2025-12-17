<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Admin | Register User</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* =========================
   RESET
========================= */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Inter", system-ui, -apple-system, sans-serif;
}

/* =========================
   BODY
========================= */
body {
    min-height: 100vh;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
}

/* =========================
   ADMIN CARD
========================= */
.admin-card {
    width: 100%;
    max-width: 460px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
    overflow: hidden;
    animation: fadeUp 0.5s ease;
}

/* =========================
   HEADER BAR
========================= */
.admin-card-header {
    background: linear-gradient(135deg, #0d3553, #102f4a);
    padding: 20px 22px;
    color: #ffffff;
}

.admin-card-header h2 {
    font-size: 20px;
    font-weight: 700;
}

.admin-card-header p {
    margin-top: 4px;
    font-size: 13px;
    opacity: 0.9;
}

/* =========================
   BODY
========================= */
.admin-card-body {
    padding: 26px 24px 30px;
}

/* =========================
   ALERT
========================= */
.alert {
    padding: 14px 16px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 18px;
}

.alert-warning {
    background: #ffe1e1;
    color: #7a0000;
    border-left: 5px solid #c00000;
}

.alert.auto-hide {
    overflow: hidden;
    transition:
        opacity 0.6s ease,
        max-height 0.6s ease,
        margin 0.6s ease,
        padding 0.6s ease;
}

.alert.hide {
    opacity: 0;
    max-height: 0;
    margin: 0;
    padding-top: 0;
    padding-bottom: 0;
}

/* =========================
   FORM
========================= */
.form-group {
    margin-bottom: 16px;
}

label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 6px;
    color: #374151;
}

input {
    width: 100%;
    padding: 13px 14px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    transition: 0.25s ease;
}

input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.25);
}

/* =========================
   NOTE
========================= */
.admin-note {
    background: #f9fafb;
    border: 1px dashed #d1d5db;
    border-radius: 10px;
    padding: 12px 14px;
    font-size: 13px;
    color: #4b5563;
    margin-bottom: 18px;
}

/* =========================
   ACTIONS
========================= */
.actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-top: 12px;
}

.actions a {
    font-size: 13px;
    font-weight: 600;
    color: #2563eb;
    text-decoration: none;
}

.actions a:hover {
    text-decoration: underline;
}

/* =========================
   BUTTON
========================= */
button {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #ffffff;
    border: none;
    padding: 12px 26px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    box-shadow: 0 8px 18px rgba(37,99,235,0.45);
}

button:hover {
    transform: translateY(-1px);
    box-shadow: 0 14px 30px rgba(37,99,235,0.55);
}

/* =========================
   ANIMATION
========================= */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 480px) {
    .actions {
        flex-direction: column;
        align-items: stretch;
    }

    button {
        width: 100%;
    }
}
</style>
</head>
<body>

<div class="admin-card">

    <!-- HEADER -->
    <div class="admin-card-header">
        <h2>Register New User</h2>
        <p>Create an account for system access</p>
    </div>

    <!-- BODY -->
    <div class="admin-card-body">

        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div class="alert alert-warning auto-hide">
                <strong>⚠ Warning:</strong> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>

            <div class="admin-note">
                ℹ A temporary password will be generated and required to be changed on first login.
            </div>

            <div class="actions">
                <a href="{{ route('admin.users-account') }}">← Back to Admin Dashboard</a>
                <button type="submit">Register User</button>
            </div>
        </form>
    </div>

</div>

<script>
setTimeout(() => {
    const alert = document.querySelector('.alert.auto-hide');
    if (!alert) return;

    alert.classList.add('hide');

    setTimeout(() => {
        alert.remove();
    }, 600);
}, 5000);
</script>

</body>
</html>
