@extends('layout.master')
@section('title', 'Payment')

@section('content')
    <div class="mask d-flex align-items-center h-80 gradient-custom-3">
        <div class="container h-80">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card my-5" style="border-radius: 15px;">
                        <div class="card-body p-5 text">
                            <h2 class="text-center mb-5">Payment Gateway</h2>
                            <h2 class="text-center mb-5">Price: IDR {{ auth()->user()->price }}</h2>

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

                            <form action="/payment" method="POST">
                                @csrf
                                <div class="form-outline mb-3">
                                    <label for="money" class="form-label">Money</label>
                                    <input type="number" id="money" name="money" placeholder="Input payment" class="form-control @error('money') is-invalid @enderror" value="{{ old('money') }}" required>
                                    @error('money')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success text-light">Pay Registration Fee</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
