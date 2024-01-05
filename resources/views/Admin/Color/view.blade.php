@extends('layouts.app')

@section('content')
    <section>
        <div class="container-lg">
            <div class="card my-3 my-md-4 shadow-lg" style="border: none;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <a href="{{ route('products.view') }}">
                        <button class="btn btn-info fw-bold text-white">Back</button>
                    </a>
                    <h1 class="heading mx-auto mb-0">View Colors</h1>
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
                                    <th scope="col">#</th>
                                    <th scope="col">Color Name</th>
                                    <th scope="col" class="text-center">ProductColor Count</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $index => $color)
                                    <tr>
                                        <th scope="row" class="align-middle">{{ $index + 1 }}</th>
                                        <td class="align-middle">{{ $color->color_name }}</td>
                                        <td class="text-center align-middle">{{ $color->productColors->count() }}</td>
                                        <td class="text-center">
                                            @if (!$color->productColors->count() > 0)
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal_{{ $color->id }}">
                                                    Delete
                                                </button>
                                                <div class="modal fade" id="deleteModal_{{ $color->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Delete Color
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this color?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <form
                                                                    action="{{ route('color.destroy', ['color' => $color->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <button type="button" class="btn btn-secondary" disabled>
                                                    Cannot Delete
                                                </button>
                                            @endif
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
