@extends('layouts.user_type.guest')

@section('content')
<main class="main-content mt-0">
  <section>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow-lg">
            <div class="card-header bg-transparent text-center">
              <h3 class="font-weight-bolder">Selamat Datang </h3>
            </div>
            <div class="card-body">
              <form role="form" method="POST" action="/session">
                @csrf
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                  @error('password')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="rememberMe">
                  <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
