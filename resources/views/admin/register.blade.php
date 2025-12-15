<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<title>Register User</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #0d3553, #1e4fc6);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-container {
        width: 100%;
        max-width: 420px;
        background: white;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #0d3553;
    }

    label {
        display: block;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .actions a {
        font-size: 13px;
        color: #2563eb;
        text-decoration: none;
        font-weight: bold;
    }

    button {
        background: #2563eb;
        color: white;
        border: none;
        padding: 12px 22px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
    }

    button:hover {
        background: #1e4fc6;
    }
</style>
</head>
<body>

<div class="register-container">
    <h2>Create Account</h2>

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
