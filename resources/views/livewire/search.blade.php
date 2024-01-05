<div>
    <form wire:submit.prevent="submitSearch" class="form-inline d-flex gap-2 ms-auto my-4" style="max-width: 400px; padding: 0 12px">
        <input wire:model="search" type="text" class="form-control" placeholder="Search by product name" />
        <button type="submit" class="btn btn-info text-white fw-bold">Search</button>
    </form>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-0">
        @foreach ($products as $product)
            <div class="col mb-4">
                <a class="link-offset-2 link-underline link-underline-opacity-0"
                    href="{{ route('product.show', ['product' => $product->id]) }}">
                    <div class="card shadow-lg h-100 new" style="transition: 0.3s; border-radius: 7px;">
                        @if (File::exists(public_path($product->images->first()->image_name)))
                            <img src="{{ asset('Products/' . $product->images->first()->image_name) }}"
                                class="d-block w-100" alt="..." style="max-height: 400px; object-fit: cover;">
                        @else
                            <img src="{{ asset('Assets/Products/' . $product->images->first()->image_name) }}"
                                class="d-block w-100" alt="..." style="max-height: 400px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-title mb-3 text" style="max-height: 50px; overflow: hidden;">
                                {{ $product->category->category_name }} - {{ $product->product_name }}
                            </p>
                            <p class="mb-0 text">
                                Rp {{ number_format($product->price, 0, '.', ',') }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
