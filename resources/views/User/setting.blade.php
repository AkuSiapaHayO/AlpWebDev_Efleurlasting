@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Edit Profile
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-header">
                                Featured
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Profile</h5>
                                <p class="card-text">Customize your online presence with the ability to edit your profile by
                                    updating your
                                    personal information.
                                </p>
                                @php($user = Auth::user())
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-outline-primary"
                                    id="edit">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
