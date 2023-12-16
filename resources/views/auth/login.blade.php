@extends('layouts.app')

@section('content')
    <section>
        <div class="container-fluid bg-color-1 vh-100" >
            <div class="row align-items-center">
                <div class="col-md-5 d-none d-md-block p-0 vh-100">
                    <img src="{{ asset('Assets/Categories/CategoryImage7.jpg') }}" class="w-100 h-100"
                        style="object-fit: cover; filter: blur(0px);" alt="">
                </div>
                <div class="col-md-7 px-5">
                    <div class="">
                        <div class="d-flex flex-column align-items-center">
                            <div>
                                <p class="sub-heading text-black mb-2 text-center" >Artificial Flower Shop</p>
                                <h1 class="heading mb-5 text-center">Welcome to Efleurlasting</h1>
                            </div>

                            <form method="POST" action="{{ route('login') }}" class="w-75">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-pink-color fw-bold mt-4 w-100">{{ __('Login') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
