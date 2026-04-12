<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
<div class="card shadow-sm border-0" style="max-width: 560px; width: 100%;">
    <div class="card-body p-4 p-md-5">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('register') }}">Registration</a></li>
        </ul>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="row g-3">
            @csrf
            <div class="col-md-6">
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                       placeholder="First name" value="{{ old('first_name') }}" required>
                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                       placeholder="Last name" value="{{ old('last_name') }}" required>
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="E-mail" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Repeat password" required>
            </div>
            <div class="col-12">
                <button class="btn btn-dark btn-lg w-100">Sign up</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

