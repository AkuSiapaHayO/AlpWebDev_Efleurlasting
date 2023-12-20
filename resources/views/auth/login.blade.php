@extends('layouts.app')

@section('content')
    <section>
        <div class="container" style="max-width: 1540px">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 d-none d-xl-block p-0">
                    <img src="{{ asset('Assets/Categories/CategoryImage7.jpg') }}" class="img-fluid vh-100 w-100"
                        style="object-fit: cover; filter: blur(0px); height: 100vh" alt="">
                </div>
                <div class="col-12 col-xl-6 px-5">
                    <div class="">
                        <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh">
                            <div>
                                <p class="sub-heading text-black mb-2 text-center d-none d-md-block">Artificial Flower Shop
                                </p>
                                <h1 class="heading mb-4 text-center">Welcome to Efleurlasting</h1>
                            </div>

                            <form method="POST" action="{{ route('login') }}" class="w-100" style="max-width: 900px">
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

                                <button type="submit"
                                    class="btn btn-pink-color fw-bold mt-4 w-100">{{ __('Login') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
