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
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form id="registerForm" class="row g-3" method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="col-md-6">
          <input name="first_name" class="form-control" placeholder="First name" value="{{ old('first_name') }}" required>
        </div>
        <div class="col-md-6">
          <input name="last_name" class="form-control" placeholder="Last name" value="{{ old('last_name') }}" required>
        </div>
        <div class="col-12">
          <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
        </div>
        <div class="col-12">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="col-12">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
        </div>
        <div class="col-12">
          <button class="btn btn-dark btn-lg w-100" type="submit">Sign up</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>