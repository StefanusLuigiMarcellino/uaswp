@extends('layout.master')
@section('title', 'Login')

@section('content')
    <div class="mask d-flex align-items-center h-80 gradient-custom-3">
        <div class="container h-80">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card my-5" style="border-radius: 15px;">
                        <div class="card-body p-5 text">
                            <h2 class="text-center mb-5">Login</h2>

                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session()->has('failed'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('failed') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="/login" method="POST">
                                @csrf
                                <div class="form-outline mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success text-light">Login</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="/"
                                    class="fw-bold text-body"><u>Register here</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
