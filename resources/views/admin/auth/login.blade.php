<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | PPP District Dadu</title>
    <link rel="stylesheet" href="{{ asset('Assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <style>
        body.login-body {
            background: linear-gradient(135deg, #070d09 0%, #0d1a12 50%, #060a08 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .login-header {
            background: #090e0b;
            padding: 32px 28px;
            text-align: center;
            border-bottom: 3px solid var(--admin-green);
        }
        .login-header img {
            width: 78px;
            height: auto;
            margin-bottom: 12px;
        }
        .login-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 0;
        }
        .login-subtitle {
            color: var(--admin-gold);
            font-size: 13px;
            font-weight: 600;
            margin-top: 4px;
        }
        .login-body-content {
            padding: 32px 28px;
        }
    </style>
</head>
<body class="login-body">
    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('Assets/images/PPP-1024x564.png') }}" alt="PPP Logo">
            <h1 class="login-title">Pakistan Peoples Party</h1>
            <div class="login-subtitle">District Dadu &bull; Admin Portal</div>
        </div>
        <div class="login-body-content">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label for="email" class="admin-label">Email Address <span class="required">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                        <input type="email" id="email" name="email" class="admin-input border-start-0" value="{{ old('email', 'admin@pppdadu.com') }}" required autofocus placeholder="admin@pppdadu.com">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label for="password" class="admin-label">Password <span class="required">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" id="password" name="password" class="admin-input border-start-0" required placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                        <label class="form-check-label text-muted" for="remember" style="font-size: 13px;">
                            Remember me
                        </label>
                    </div>
                </div>

                <button type="submit" class="admin-btn admin-btn-primary w-100 py-2 fs-6">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Sign In to Dashboard</span>
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted" style="font-size: 13px;">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Live Website
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('Assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
