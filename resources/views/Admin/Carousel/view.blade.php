@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                @foreach ($carousels as $carousel)
                    <div class="card">
                        <div class="card-body">
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection