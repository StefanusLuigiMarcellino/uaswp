@extends('layout.master')
@section('title', 'Profile')

@section('style')

<style>
    #imagePreview{
        width: 5.5vw;
        height: 5.5vw;
        border-radius: 50%;
        object-fit: cover;
    }

    #bearPreview{
        width: 5.5vw;
        height: 5.5vw;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile_picture{
        background-color: #5cb85c;
        color: white;
        height: fit-content;
        border: 1px #5cb85c solid;
        padding: 0.6vw 1.3vw;
        border-radius: 8px;
        font-weight: 600;
        margin-left: 2vw;
        font-size: 0.8vw;
        cursor: pointer;
        z-index: 1;
    }
</style>

@endsection

@section('content')
@include('header')

<div class="mask d-flex align-items-center h-80 gradient-custom-3">
    <div class="container h-80">
        <div class="row d-flex justify-content-center align-items-center h-80">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card my-5" style="border-radius: 15px;">
                    <div class="card-body p-5 text">
                        <h2 class="text-center mb-5">Profile</h2>

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

                        <form action="/profile" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-outline mb-3">
                                @if (auth()->user()->visibility == 'visible')
                                    <img id="imagePreview" src="/storage/{{ auth()->user()->image }}" alt="">
                                @else
                                    <img id="bearPreview" src="/profile.jpg" alt="">
                                @endif
                                <input id="image" class="form-control" style="display: none" accept="image/png, image/jpg, image/jpeg" type="file" name="image"  onchange="showPreview(this)">
                                <input type="hidden" name="oldimage" id="oldimage" value="{{ auth()->user()->image }}">
                                <label for="image" class="profile_picture">Upload new picture</label>
                            </div>

                            <div class="form-outline mb-3">
                                <label for="visibility" class="form-label fw-semibold text-wed">Visibility</label>
                                <div class="form-check @error('visibility') is-invalid @enderror">
                                    <input class="form-check-input" type="radio" name="visibility" id="visible" value="visible"
                                    @if (auth()->user()->visibility =='visible') checked @endif>
                                    <label class="form-check-label" for="visible">Visible</label>
                                </div>
                                <div class="form-check @error('visibility') is-invalid @enderror">
                                    <input class="form-check-input" type="radio" name="visibility" id="invisible" value="invisible"
                                    @if (auth()->user()->visibility =='invisible') checked @endif>
                                    <label class="form-check-label" for="invisible">Invisible</label>
                                </div>
                                @error('visibility')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success text-light">Update Profile</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function showPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            // Update the imagePreview src with the new image
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
