@extends('layouts.app')

@section('content')
    @php($user = Auth::user())
    <section>
        <div class="container-lg mt-5">
            <div class="card my-1 my-md-4 shadow-lg" style="border: none;">
                <div class="card-body">
                    <div class="row gx-5">
                        <div class="col-md-4">
                            <div style="max-width:500px; overflow:hidden" class="mb-3">
                                @if ($user->profile_image)
                                    <img src="{{ asset($user->profile_image) }}" alt=""
                                        class="img-fluid w-100 rounded" style="max-height:500px; object-fit:cover">
                                @else
                                    <img src="{{ asset('Assets/Icons/profile.png') }}" alt=""
                                        class="img-fluid w-100 rounded" style="max-height:500px; object-fit:cover">
                                @endif
                            </div>
                            <div class="card shadow-lg mb-3" style="border: none;">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom pb-2">Profile</h5>
                                    <p class="card-text">Customize your online presence with the ability to edit your
                                        profile
                                        by
                                        updating your
                                        personal information.
                                    </p>
                                    <a href="{{ route('user.edit', $user) }}"
                                        class="btn btn-info fw-bold text-white w-100" id="edit">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <p class="fw-bold fs-2 my-0 mt-3">{{ $user->username }}</p>
                            </div>
                            <div class="d-flex align-items-center my-1 fs-5">
                                <p class="my-0 me-2 text-secondary">{{ $user->district }},</p>
                                <p class="my-0 text-secondary">{{ $user->city }}</p>
                                <img src="{{ asset('Assets/Icons/maps.svg') }}" alt="" class="img-fluid"
                                    style="max-width: 25px">
                            </div>
                            <div class="my-3 border-bottom">
                                <p class="text-secondary text-uppercase fw-bold mb-1">Contact Infomation</p>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-2 col-form-label">District</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->district }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->city }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Province</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->province }}">
                                </div>
                            </div>
                            <div class="my-3 border-bottom">
                                <p class="text-secondary text-uppercase fw-bold mb-1">Personal Infomation</p>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Birthdate</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->birthdate }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Gender</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->gender }}">
                                </div>
                            </div>
                            <div class="row fw-bold">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Age</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $user->age }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg my-5">
            <p class="sub-heading text-secondary borders-left">
                {{ $user->name }}'s Orders
            </p>
            <h1 class="heading mb-3 pb-1">View All of Your Past Orders</h1>
            <div class="row">
                <div class="col-2">
                    <a href="{{ route('order.view') }}" class="btn btn-info fw-bold text-white w-100" id="edit">View
                        Orders</a>
                </div>
            </div>
        </div>
    </section>
@endsection
