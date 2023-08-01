@extends('layout.master')
@section('title', 'Home')

@section('content')
@include('header')

<div class="container p-5">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="fs-4" style="width: fit-content;">
        <p>Welcome {{ auth()->user()->name }}</p>
    </div>

    <div class="fs-4" style="width: fit-content;">
        <form action="/filter" method="get">
            <button type="submit" class="btn btn-success" name="action" value="Male">Male</button>
            <button type="submit" class="btn btn-success" name="action" value="Female">Female</button>
        </form>
    </div>


    <div class="fs-4 d-flex" style="width: fit-content;">
        <p>Your Wallet: IDR {{ auth()->user()->money }}.00</p>
        <button type="button" class="btn btn-success ms-3" style="height:fit-content" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Top Up
        </button>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Top Up Money</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/topup" method="POST">
                    @csrf
                    <div class="modal-body d-flex justify-content-center">
                        <input type="number" name="money" id="money" value="0">
                        <button type="button" class="btn btn-success ms-3" onclick="addMoney()">+</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Top Up</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
    </div>

    <div class="row mt-3" >
        <div class="col-md-10 mx-auto">
            <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
                <div class="carousel-inner">
                    @foreach($users->chunk(3) as $key => $chunk)
                      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row">
                          @foreach($chunk as $user)
                          <form action="/addfriend" method="post">
                            @csrf
                            <div class="col-md-4 mx-auto">
                                <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                                <input type="hidden" id="name" name="name" value="{{ $user->name }}">
                                <div class="card">
                                    <img src="/storage/{{ $user->image }}" class="card-img-top" style="height: 20vw" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $user->name }}</h5>
                                        <p class="card-text">{{ $user->gender }}</p>
                                        <button type="submit" class="btn btn-success">Add Friend</button>
                            </form>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" style="margin-left: -10vw" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon btn btn-success" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" style="margin-right: -10vw" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                    <span class="carousel-control-next-icon btn btn-success" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>


    </div>
</div>

@endsection

@section('script')
<script>
    function addMoney() {
        var amount = document.getElementById('money');
        amount.value = parseInt(amount.value) + 100;
    };
</script>
@endsection
