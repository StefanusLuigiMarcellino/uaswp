@extends('layout.master')
@section('title', 'Register')

@section('content')
    <div class="mask d-flex align-items-center h-80 gradient-custom-3">
        <div class="container h-80">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card my-5" style="border-radius: 15px;">
                        <div class="card-body p-5 text">
                            <h2 class="text-center mb-5">Register</h2>
                            <h2 class="text-center mb-5">Price: IDR {{ $random }}</h2>
                            <form action="/register" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="price" name="price" value="{{ $random }}" required>
                                <div class="form-outline mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" id="instagram" name="instagram" placeholder="Instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}" required>
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" id="phone" name="phone" placeholder="Phone Number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <div class="form-group @error('hobbies') is-invalid @enderror">
                                        <label for="hobbies">Hobbies (Select at least 3):</label><br>
                                        <input type="checkbox" name="hobbies[]" value="Sport"> Sport<br>
                                        <input type="checkbox" name="hobbies[]" value="Gaming"> Gaming<br>
                                        <input type="checkbox" name="hobbies[]" value="Watching"> Watching<br>
                                        <input type="checkbox" name="hobbies[]" value="Coding"> Coding<br>
                                        <input type="checkbox" name="hobbies[]" value="Cooking"> Cooking<br>
                                        @error('hobbies')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="gender" class="form-label fw-semibold text-wed">Gender</label>
                                    <div class="form-check @error('gender') is-invalid @enderror">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                                        @if (old('gender')=='male') checked @endif>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check @error('gender') is-invalid @enderror">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                                        @if (old('gender')=='female') checked @endif>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="image" class="form-label">Profile picture</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/png, image/jpg, image/jpeg" required>
                                    @error('image')
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

                                <div class="form-outline mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="form-control @error('confirm_password') is-invalid @enderror" required>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success text-light">Register</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="/login"
                                    class="fw-bold text-body"><u>Login here</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
