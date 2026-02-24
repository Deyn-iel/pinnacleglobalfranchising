<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin · Email a User</title>

<link rel="icon" type="image/png" href="{{ asset('img/logo1-removebg-preview.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite(['resources/css/admin/app.css'])

<style>
    body {
        background: #f5f6fa;
        overflow-x: hidden;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    }

    aside { width: 260px; z-index: 999; }

    main {
        margin-left: 260px;
        padding: clamp(20px, 2.5vw, 34px);
        max-width: calc(100vw - 260px);
    }

    .page-header {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 22px;
        box-shadow: 0 10px 30px rgba(15,23,42,.08);
        margin-bottom: 22px;
    }
    .card-soft {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 10px 28px rgba(15,23,42,.08);
        border: none;
        overflow: hidden;
    }
    .btn-primary {
        background: #000;
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover { background: #333; }

    .alert.hide {
        opacity: 0;
        max-height: 0;
        padding: 0;
        margin: 0;
        transition: all .4s ease;
    }
</style>
</head>

<body>

@include('admin-sidebar.navbar')
@include('admin-sidebar.sidebar')

<main>

    <!-- HEADER -->
    <div class="page-header">
        <h4 class="fw-bold mb-1">
            <i class="fa-solid fa-envelope me-2"></i>Email a User
        </h4>
        <p class="text-muted mb-0">
            Send a secure password reset / set-password link. (No passwords are collected.)
        </p>
    </div>

    <!-- ALERTS -->
    @if(session('success'))
        <div class="alert alert-success auto-hide">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger auto-hide">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- FORM -->
    <div class="card card-soft">
        <div class="card-body p-4 p-lg-5">
            <form action="{{ route('admin.users.email.send') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12">
                    <label class="form-label fw-semibold">User Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="e.g. user@example.com"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">
                        We will send a <strong>secure link</strong> so the user can set a new password safely.
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Email Type</label>
                    <select name="type" class="form-select">
                        <option value="reset" {{ old('type') === 'reset' ? 'selected' : '' }}>Password Activate Link</option>
                    </select>
                    <div class="form-text">
                        “Invite” is useful for newly created accounts. “Reset” is for existing users who forgot their password.
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Optional Message (shown in email)</label>
                    <textarea name="message" rows="3" class="form-control" placeholder="e.g. Hi! Please use the link below to set your password.">{{ old('message') }}</textarea>
                </div>

                <div class="col-12 d-flex gap-2 mt-2">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-paper-plane me-2"></i>Send Email
                    </button>

                    <a href="{{ route('admin.users-account') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back to Users
                    </a>
                </div>
            </form>
        </div>
    </div>

</main>

<script>
    setTimeout(() => {
        document.querySelectorAll('.auto-hide').forEach(alert => {
            alert.classList.add('hide');
            setTimeout(() => alert.remove(), 400);
        });
    }, 3000);
</script>

</body>
</html>
