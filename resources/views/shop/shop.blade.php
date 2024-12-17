@extends('shop.layout')

@section('content')
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="text-decoration-none text-primary h3" href="#" data-brand="all" id="allMobilesLink">
                            All Products
                        </a>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Brands
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">
                            @foreach($categories as $category)
                            <li class="py-2">
                                <a class="text-decoration-none text-muted h5 d-flex align-items-center" href="#" data-brand="{{ $category->brand }}">
                                    <i class="fas fa-mobile-alt me-2"></i>{{ $category->brand }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <h2 class="h3 mb-0">Our Products</h2>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" id="brandFilter">
                            <option value="all">All Brands</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->brand }}">{{ $category->brand }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-4" id="productsContainer">
                    @if(count($products) > 0)
                        @foreach ($products as $item)
                            <div class="col-md-4 product-item" data-brand="{{ $item->brand }}">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <a href="{{ route('shop.show', ['id' => $item->id]) }}">
                                            <img class="card-img-top" 
                                                 src="{{ asset('images/'.$item->product_image) }}" 
                                                 alt="{{ $item->name }}"
                                                 style="height: 250px; object-fit: contain;">
                                        </a>
                                        <div class="product-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 d-flex align-items-center justify-content-center opacity-0 transition-all">
                                            <div class="d-flex gap-2">
                                                <a class="btn btn-primary btn-sm" href="{{ route('shop.show', ['id' => $item->id]) }}" title="View Details">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a class="btn btn-primary btn-sm" href="{{ route('shop.show', ['id' => $item->id]) }}" title="Add to Cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>
                                                <a class="btn btn-primary btn-sm" href="{{ route('shop.show', ['id' => $item->id]) }}" title="Add to Wishlist">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            <a href="{{ route('shop.show', ['id' => $item->id]) }}" class="text-decoration-none text-dark">
                                                {{ $item->name }}
                                            </a>
                                        </h5>
                                        <div class="d-flex justify-content-center mb-2">
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-muted fa fa-star"></i>
                                        </div>
                                        <p class="h5 text-primary mb-0">₹{{ number_format($item->price) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <div class="alert alert-info">
                                <h4 class="alert-heading">No Products Found</h4>
                                <p class="mb-0">Sorry, we couldn't find any products matching your criteria.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Brands Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 mx-auto">
                    <h2 class="mb-4">Featured Brands</h2>
                    <p class="text-muted">
                        Discover premium mobile phones from leading brands worldwide. We offer the latest models with cutting-edge technology and exceptional quality.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .product-overlay {
            background: rgba(255, 255, 255, 0.9);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .card:hover .product-overlay {
            opacity: 1;
        }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandFilter = document.getElementById('brandFilter');
            const productItems = document.querySelectorAll('.product-item');
            const sidebarBrandLinks = document.querySelectorAll('.collapse.show a[data-brand]');
            const allMobilesLink = document.getElementById('allMobilesLink');

            function filterProducts(selectedBrand) {
                let visibleCount = 0;
                productItems.forEach(item => {
                    const itemBrand = item.dataset.brand;
                    if (selectedBrand === 'all' || itemBrand === selectedBrand) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                const noProductsMessage = document.querySelector('.no-products-message') || createNoProductsMessage();
                noProductsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            function createNoProductsMessage() {
                const message = document.createElement('div');
                message.className = 'col-12 text-center no-products-message';
                message.innerHTML = `
                    <div class="alert alert-info">
                        <h4 class="alert-heading">No Products Found</h4>
                        <p class="mb-0">Sorry, we couldn't find any products matching your criteria.</p>
                    </div>
                `;
                document.getElementById('productsContainer').appendChild(message);
                return message;
            }

            brandFilter.addEventListener('change', function() {
                filterProducts(this.value);
            });

            sidebarBrandLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedBrand = this.dataset.brand;
                    brandFilter.value = selectedBrand;
                    filterProducts(selectedBrand);
                });
            });

            allMobilesLink.addEventListener('click', function(e) {
                e.preventDefault();
                brandFilter.value = 'all';
                filterProducts('all');
            });
        });
    </script>
@endsection
