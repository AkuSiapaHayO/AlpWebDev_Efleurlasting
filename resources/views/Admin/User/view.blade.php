@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Registered Users</h5>
            <div class="card-body">
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
                                            class="btn btn-outline-success">More</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
