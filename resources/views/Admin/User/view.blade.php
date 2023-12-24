@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card my-3 my-md-4 shadow-lg" style="border: none;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin.setting') }}"><button class="btn btn-outline-primary">Back</button></a>
                        <h5 class="text-center my-1 mx-auto">Registered Users</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-lg">
            <div class="card shadow-lg" style="border: none;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Birthdate</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row" class="align-middle">{{ $user->id }}</th>
                                        <td class="align-middle">{{ $user->username }}</td>
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td class="align-middle">{{ $user->email }}</td>
                                        <td class="align-middle">{{ $user->gender }}</td>
                                        <td class="align-middle">{{ $user->age }}</td>
                                        <td class="align-middle">{{ $user->birthdate }}</td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('user.show', $user->id) }}"><button
                                                    class="btn btn-outline-primary">More</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
