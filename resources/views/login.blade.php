<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
  <div class="card shadow-sm border-0" style="max-width: 560px; width: 100%;">
    <div class="card-body p-4 p-md-5">
      <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active" href="{{ route('login') }}">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registration</a></li>
      </ul>

      @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form id="loginForm" class="vstack gap-3" method="POST" action="{{ route('login.post') }}">
        @csrf

        <div>
          <label class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div>
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-dark btn-lg mt-2" type="submit">Sign in</button>
      </form>
    </div>
  </div>
</body>
</html>