@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-0">
                <div class="card-header p-3 d-flex align-items-center justify-content-between">
                    <a href="{{ route('user.setting') }}"><button class="btn btn-outline-success">Back</button></a>
                    <div class="mx-auto text-center">
                        <h2 class="fw-bolder m-0">Account Settings</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gx-5 mb-4">
                        <div class="col-md-3 mb-3">
                            <p class="fw-bold fs-5">Profile Picture</p>
                            @if ($user->profile_image)
                                <div style="max-width: 300px; oveflow: hidden" class="mb-3">
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile-image"
                                        class="img-fluid" style="max-height: 300px;">
                                </div>
                            @else
                                <div style="max-width: 300px; oveflow: hidden" class="mb-3">
                                    <img src="{{ asset('Assets/profile.png') }}" alt="Profile-image"
                                        class="img-fluid">
                                </div>
                            @endif

                            <p class="fw-bold fs-5">Personal Information</p>
                            <p class="card-text">Edit your profile according to your preferences. Make a cool username. Also
                                make sure to fill your full name, your active email, and other information such as your
                                birthdate, phone number, gender, and age correctly.</p>
                            <p class="fw-bold fs-5">Address Information</p>
                            <p class="card-text">Edit your Address as <span class="text-danger">detail</span> as possible in
                                order to have a better shipping
                                experience. Include description about your house looks or your apartment number.</p>
                            <p class="fw-bold fs-5">Change Password</p>
                            <p class="card-text">Update your password associated with your account. And make sure to <span
                                    class="text-danger">remember</span> it!</p>
                        </div>
                        <div class="col-md-9">
                            <form method="POST" action="{{ route('user.update', $user) }}" class="row g-3">
                                @method('put')
                                @csrf
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ $user->username }}" required autocomplete="username" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $user->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $user->email }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="New Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirm New Password" required
                                        autocomplete="new-password">
                                </div>
                                <div class="col-md-6">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                                        value="{{ $user->birthdate }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" class="form-select" name="gender" value="{{ old('gender') }}"
                                        required>
                                        <option {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age"
                                        min="1" max="100" value="{{ $user->age }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Surabaya" value="{{ $user->city }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="district" class="form-label">District</label>
                                    <input type="text" class="form-control" id="district" name="district"
                                        placeholder="Sambikerep" value="{{ $user->district }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="province" name="province"
                                        placeholder="Jawa Timur" value="{{ $user->province }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="zipcode" class="form-label">Zipcode</label>
                                    <input type="number" class="form-control" id="zipcode" name="zipcode"
                                        min="1" placeholder="60216" value="{{ $user->zipcode }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Please fill your address completely with detail."
                                        value="{{ $user->address }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="08xxxxxxxxxx" value="{{ $user->phone }}" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-md-3 mb-3">
                            <p class="fw-bold fs-5">Closing Chapter: Account Deactivation</p>
                            <p class="card-text">Account deletion feature. If you want to delete your account, you can
                                follow the steps on this section. <span class="text-danger">Warning: </span>All of your
                                data will be deleted if you delete your account. Please proceed carefully</p>
                        </div>
                        <div class="col-md-9">
                            <p>
                                <button class="btn btn-danger" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Are you sure you want to delete your account?
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <p class="fw-bold fs-5">Account Deletion: Last Confirmation Step</p>
                                    <p><span class="text-danger">Warning: </span>All of your
                                        data will be deleted when you delete your account. Please proceed carefully</p>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" id="delete" name="delete">Delete
                                            Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
