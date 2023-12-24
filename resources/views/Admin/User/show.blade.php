@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card shadow-lg my-1 my-md-4" style="border: none;">
                <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                    <a href="{{ route('user.view') }}"><button class="btn btn-outline-primary">Back</button></a>
                    <h3 class="text-center my-1 mx-auto">{{ $user->name }}'s Details</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Username</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Password</th>
                                <td>{{ $user->password }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Gender</th>
                                <td>{{ $user->gender }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Age</th>
                                <td>{{ $user->age }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Birthdate</th>
                                <td>{{ $user->birthdate }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone</th>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Province</th>
                                <td>{{ $user->province }}</td>
                            </tr>
                            <tr>
                                <th scope="row">City</th>
                                <td>{{ $user->city }}</td>
                            </tr>
                            <tr>
                                <th scope="row">District</th>
                                <td>{{ $user->district }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Zipcode</th>
                                <td>{{ $user->zipcode }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
