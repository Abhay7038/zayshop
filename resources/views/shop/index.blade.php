@extends('shop.layout')

@section('content')
<!-- Hero Carousel Section -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid rounded shadow" src="{{ asset('assets/img/banner_img_01.jpg') }}" alt="Featured Mobile Phone">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-primary"><b>Mobile</b> Store</h1>
                            <h3 class="h2">Your Premium Mobile Phone Destination</h3>
                            <p class="lead">
                                Welcome to our premium mobile phone store, featuring the latest smartphones from top brands.
                                Discover cutting-edge technology, competitive prices, and exceptional customer service.
                            </p>
                            <a href="#featured-products" class="btn btn-primary mt-3">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid rounded shadow" src="{{ asset('assets/img/banner_img_02.jpg') }}" alt="Latest Smartphones">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Latest Models</h1>
                            <h3 class="h2">Find Your Perfect Device</h3>
                            <p class="lead">
                                Browse our extensive collection of the newest smartphone models.
                                From flagship devices to budget-friendly options, we have something for everyone.
                            </p>
                            <a href="#latest-products" class="btn btn-primary mt-3">View Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid rounded shadow" src="{{ asset('assets/img/banner_img_03.jpg') }}" alt="Special Offers">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Special Offers</h1>
                            <h3 class="h2">Exclusive Deals & Discounts</h3>
                            <p class="lead">
                                Take advantage of our limited-time offers and special promotions.
                                Get the best value for your money with our competitive pricing.
                            </p>
                            <a href="#special-offers" class="btn btn-primary mt-3">View Deals</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>

<!-- Latest Products Section -->
<section class="container py-5" id="latest-products">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h2 class="h1 text-primary">Latest Products</h2>
            <p class="lead">
                Discover our newest arrivals - featuring cutting-edge technology and innovative designs.
                Stay ahead with the latest mobile technology.
            </p>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-12 col-md-4 p-4 mt-3">
                    <div class="card h-100 shadow-sm hover-shadow">
                        <div class="image-container text-center p-3">
                            <div class="fixed-size-img-container">
                                <a href="{{route('shop.show',['id' => $product->id])}}" class="text-decoration-none">
                                    <img src="{{ asset('images/' . $product->product_image) }}" class="fixed-size-img rounded" alt="{{ $product->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center mb-3">{{ $product->name }}</h5>
                            <p class="card-text text-muted text-center mb-3">{{ $product->description }}</p>
                            <p class="card-text text-primary text-center fw-bold mb-3">₹{{ number_format($product->price) }}</p>
                            <div class="mt-auto text-center">
                                <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @if (Route::has('login'))
                                        @auth
                                            <button class="btn btn-primary addToCart w-100" data-product-id="{{ $product->id }}">
                                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                            </button>   
                                        @else
                                            <button type="button" class="btn btn-secondary w-100" disabled>
                                                <i class="fas fa-lock me-2"></i>Login to Purchase
                                            </button>    
                                        @endauth
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="bg-light py-5" id="featured-products">
    <div class="container">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h2 class="h1 text-primary">Featured Products</h2>
                <p class="lead">
                    Explore our premium collection of high-end smartphones.
                    These are our most exclusive and advanced devices.
                </p>
            </div>
        </div>
        <div class="row">
            @foreach ($products->sortByDesc('price')->take(3) as $featuredProduct)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="image-container text-center p-3">
                        <div class="fixed-size-img-container">
                            <a href="{{ route('shop.show', ['id' => $featuredProduct->id]) }}" class="text-decoration-none">
                                <img src="{{ asset('images/' . $featuredProduct->product_image) }}" class="fixed-size-img rounded" alt="{{ $featuredProduct->name }}">
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="ratings">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>
                            <span class="text-primary fw-bold">₹{{ number_format($featuredProduct->price) }}</span>
                        </div>
                        <h4 class="card-title">
                            <a href="{{ route('shop.show', ['id' => $featuredProduct->id]) }}" class="text-decoration-none text-dark">{{ $featuredProduct->name }}</a>
                        </h4>
                        <p class="card-text text-muted">
                            {{ $featuredProduct->description }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Premium Product</span>
                            <a href="{{ route('shop.show', ['id' => $featuredProduct->id]) }}" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Add to cart functionality
    $('.addToCart').click(function(e) {
        e.preventDefault();

        const productId = $(this).data('product-id');
        const button = $(this);

        // Disable button and show loading state
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Adding...');

        $.ajax({
            url: '{{ route('cart.store') }}',
            type: 'POST',
            data: {
                product_id: productId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update cart count with animation
                const cartCount = $('#cartItemCount');
                cartCount.fadeOut(200, function() {
                    $(this).text(response.cartItemCount).fadeIn(200);
                });

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart!',
                    text: 'Item has been added to your cart successfully.',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Reset button state
                button.prop('disabled', false).html('<i class="fas fa-shopping-cart me-2"></i>Add to Cart');
            },
            error: function(xhr, status, error) {
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.'
                });

                // Reset button state
                button.prop('disabled', false).html('<i class="fas fa-shopping-cart me-2"></i>Add to Cart');
                console.error(xhr.responseText);
            }
        });
    });

    // Add hover effects
    $('.card').hover(
        function() { $(this).addClass('shadow-lg').css('transform', 'translateY(-5px)'); },
        function() { $(this).removeClass('shadow-lg').css('transform', 'translateY(0)'); }
    );
});
</script>
@endsection